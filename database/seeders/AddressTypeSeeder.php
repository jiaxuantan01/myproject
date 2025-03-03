<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class AddressTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('address_types')->insert([
            ['name' => 'Residential Address', 'remark' => '10:00 A.M.- 6:00 P.M', 'status' => '1','create_at' => now(), 'update_at' => now()],
            ['name' => 'Correspondence Address', 'remark' => '10:00 A.M.- 6:00 P.M', 'status' => '1', 'create_at' => now(), 'update_at' => now()],
            ['name' => 'Office Address', 'remark' => '10:00 A.M.- 6:00 P.M', 'status' => '1', 'create_at' => now(), 'update_at' => now()],
            ['name' => 'Temporary Address', 'remark' => '10:00 A.M.- 6:00 P.M', 'status' => '1', 'create_at' => now(), 'update_at' => now()],
            ['name' => 'Pickup Address', 'remark' => '10:00 A.M.- 6:00 P.M', 'status' => '1', 'create_at' => now(), 'update_at' => now()],
        ]);
    }
}
