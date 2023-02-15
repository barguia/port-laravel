<?php

namespace Database\Seeders;

use App\Models\Ecommerce\CtlProcessHierarchy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CtlProcessHierarchySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hierarchies = array(
            [
                'hierarchy' => 'Task group',
                'depth' => 0
            ],
            [
                'hierarchy' => 'Process group',
                'depth' => 1
            ],
        );

        foreach ($hierarchies as $item) {
            CtlProcessHierarchy::firstOrCreate($item);
        }
    }
}
