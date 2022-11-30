<?php

namespace Database\Seeders;

use App\Models\CtlTaskState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CtlTaskStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taskStates = ['To do', 'In progress', 'impediment'];
        foreach ($taskStates as $taskState) {
            CtlTaskState::firstOrCreate([
                'state' => $taskState
            ]);
        }
    }
}
