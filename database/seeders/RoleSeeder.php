<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'admin',
                    'guard_name' => 'api',
                    'created_at' => Carbon::now(),
                ],
                [
                    'id' => 2,
                    'name' => 'user',
                    'guard_name' => 'api',
                    'created_at' => Carbon::now(),
                ]
            ]
        );
    }
}
