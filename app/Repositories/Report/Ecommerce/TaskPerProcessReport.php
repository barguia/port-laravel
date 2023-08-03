<?php

namespace App\Repositories\Report\Ecommerce;

use App\Repositories\Report\AbstractReport;
use App\Repositories\Report\ReportInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class TaskPerProcessReport extends AbstractReport implements ReportInterface
{
    public function getQuery(): Builder
    {
        return DB::table('ctl_tasks as a')
            ->join('ctl_process as b', 'b.id', 'a.ctl_process_id')
            ->orderBy('a.id');
    }
}
