<?php

namespace App\Repositories\Report;

use App\Models\Report\PcoReport;
use App\Repositories\AbstractCRUDRepository;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
class AbstractReport extends AbstractCRUDRepository implements ReportInterface
{
    private Builder $query;
    private string $fileName;
    private string $randomName;
    private string $fullPath;
    protected $databaseField;
    protected $date_to_delete;

    public function __construct(string $fileName, int $days_in_disk = 1)
    {
        if ($days_in_disk < 0) {
            $this->date_to_delete = null;
        } else{
            $this->date_to_delete = date('Y-m-d H:i:s', strtotime("+ $days_in_disk days"));
        }

        $this->model = app(PcoReport::class);

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
        try {
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

            $this->saveData();

            fclose($fp);
        } catch (\Exception $e) {
            dd($e);
            unlink($this->fullPath);
        }

        return $this->fileExists();
    }

    private function saveData(): void
    {
        $this->databaseField = $this->model->create([
            'user_id' => Auth::user()->id ?? null,
            'date_to_delete' => $this->date_to_delete,
            'file' => $this->fullPath,
            'file_name' => $this->fileName,
            'size' => Storage::disk('report')->size($this->randomName),
        ]);
    }
    public function download(): StreamedResponse
    {
        return Storage::disk('report')->download($this->randomName, $this->fileName);
    }
}
