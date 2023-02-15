<?php

namespace Database\Seeders;

use App\Models\Ecommerce\CtlProcess;
use App\Models\Ecommerce\CtlTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CtlTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taskList = array(
            [
                'process' => 'BP1: Step 1 of 2',
            ],
            [
                'process' => 'BP1: Step 1 of 2',
            ],
            [
                'process' => 'BP1: Step 2 of 2',
            ],
            [
                'process' => 'BP1: Step 2 of 2',
            ],

            [
                'process' => 'BP2: Step 1 of 1',
            ],
            [
                'process' => 'BP2: Step 1 of 1',
            ],
            [
                'process' => 'BP2: Step 1 of 1',
            ],

            [
                'process' => 'BP3: Step 1 of 3',
            ],
            [
                'process' => 'BP3: Step 1 of 3',
            ],

            [
                'process' => 'BP3: Step 2 of 3',
            ],
            [
                'process' => 'BP3: Step 2 of 3',
            ],
            [
                'process' => 'BP3: Step 2 of 3',
            ],

            [
                'process' => 'BP3: Step 3 of 3',
            ],
            [
                'process' => 'BP3: Step 3 of 3',
            ],
            [
                'process' => 'BP3: Step 3 of 3',
            ],
        );

        $oldTextProcess = null;
        $process = null;
        foreach ($taskList as $indice => $task) {
            if ($oldTextProcess !== $task['process']) {
                $process = CtlProcess::where('process', $task['process'])->first();
            }

            if ($process === null) {
                continue;
            }

            CtlTask::firstOrCreate(
                [
                    'task' => 'Task '.($indice+1),
                    'ctl_process_id' => $process->id
                ]
            );
            $oldTextProcess = $task['process'];
        }
    }
}
