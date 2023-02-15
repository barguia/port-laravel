<?php

namespace Database\Seeders;

use App\Models\Ecommerce\CtlProcess;
use App\Models\Ecommerce\CtlProcessHierarchy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CtlProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstDepthHierarchy = CtlProcessHierarchy::where('depth', 0)->first();
        $secondDepthHierarchy = CtlProcessHierarchy::where('depth', 1)->first();
        $processList = array(
            [
                'process' => 'Big Process 1',
                'ctl_process_hierarchy_id' => $secondDepthHierarchy->id,
                'macro_process' => null
            ],
            [
                'process' => 'Big Process 2',
                'ctl_process_hierarchy_id' => $secondDepthHierarchy->id,
                'macro_process' => null
            ],
            [
                'process' => 'Big Process 3',
                'ctl_process_hierarchy_id' => $secondDepthHierarchy->id,
                'macro_process' => null
            ],
            [
                'process' => 'BP1: Step 1 of 2',
                'ctl_process_hierarchy_id' => $firstDepthHierarchy->id,
                'macro_process' => 'Big Process 1'
            ],
            [
                'process' => 'BP1: Step 2 of 2',
                'ctl_process_hierarchy_id' => $firstDepthHierarchy->id,
                'macro_process' => 'Big Process 1'
            ],
            [
                'process' => 'BP2: Step 1 of 1',
                'ctl_process_hierarchy_id' => $firstDepthHierarchy->id,
                'macro_process' => 'Big Process 2'
            ],
            [
                'process' => 'BP3: Step 1 of 3',
                'ctl_process_hierarchy_id' => $firstDepthHierarchy->id,
                'macro_process' => 'Big Process 3'
            ],
            [
                'process' => 'BP3: Step 2 of 3',
                'ctl_process_hierarchy_id' => $firstDepthHierarchy->id,
                'macro_process' => 'Big Process 3'
            ],
            [
                'process' => 'BP3: Step 3 of 3',
                'ctl_process_hierarchy_id' => $firstDepthHierarchy->id,
                'macro_process' => 'Big Process 3'
            ],

        );


        foreach ($processList as $process) {
            $macroProcessId = null;
            if ($process['macro_process']) {
                if ($field = CtlProcess::where('process', $process['macro_process'])->first()) {
                    $macroProcessId = $field->id ?? null;
                }
            }
            $process['ctl_process_id'] = $macroProcessId;
            unset($process['macro_process']);
            CtlProcess::firstOrCreate($process);
        }
    }
}
