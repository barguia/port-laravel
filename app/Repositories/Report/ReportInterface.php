<?php

namespace App\Repositories\Report;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Database\Query\Builder;

interface ReportInterface
{
    public function download(): StreamedResponse;
    public function getQuery(): Builder;
    public function applyFilters(): void;
    public function fileExists(): bool;
}
