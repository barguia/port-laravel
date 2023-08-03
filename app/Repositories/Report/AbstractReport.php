<?php

namespace App\Repositories\Report;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
class AbstractReport implements ReportInterface
{
    private Builder $query;
    private string $fileName;
    private string $randomName;
    private string $fullPath;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->setFileInfo();
        $this->setQuery();
        $this->applyFilters();
        $this->makeCsvFile();
    }

    public function getQuery(): Builder
    {
        return $this->query;
    }

    private function setQuery(): void
    {
        $this->query = $this->getQuery();
    }

    public function applyFilters(): void
    {
        //
    }

    private function setFileInfo(): void
    {
        $this->randomName = uniqid('', true);
        $this->fullPath = Storage::disk('report')->path($this->randomName);
    }

    public function fileExists(): bool
    {
        return file_exists($this->fullPath);
    }

    /**
     * @return bool
     */
    private function makeCsvFile(): bool
    {
        $headers = array();
        $fp = fopen($this->fullPath, 'w');
        fprintf($fp, chr(0xEF). chr(0xBB).chr(0xBF));

        $this->query->chunk(100, function($chunkList) use ($fp, $headers) {
            foreach ($chunkList as $item) {
                if (empty($headers)) {
                    foreach ((array) $item as $index => $value) {
                        $headers[] = $index;
                    }
                    fputcsv($fp, $headers);
                }
                fputcsv($fp, (array) $item);
            }
        });

        fclose($fp);
        return $this->fileExists();
    }

    public function download(): StreamedResponse
    {
        return Storage::disk('report')->download($this->randomName, $this->fileName);
    }
}
