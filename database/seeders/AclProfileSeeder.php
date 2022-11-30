<?php

namespace Database\Seeders;

use App\Models\Access\AclProfile;
use Illuminate\Database\Seeder;

class AclProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AclProfile::firstOrCreate(['profile' => 'manager']);
        AclProfile::firstOrCreate(['profile' => 'client']);
    }
}
