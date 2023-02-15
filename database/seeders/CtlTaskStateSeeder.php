<?php

namespace Database\Seeders;

use App\Models\Ecommerce\CtlState;
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
            CtlState::firstOrCreate([
                'state' => $taskState
            ]);
        }
    }
}
