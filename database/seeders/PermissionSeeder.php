<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ...$this->generateCRUDPermission('posts'),
            ...$this->generateCRUDPermission('users'),
            ...$this->generateCRUDPermission('comments'),
            ...$this->generatePermissionByName(['leave comment on post', 'read post comments']),
        ];

        \DB::table('permissions')->insert($permissions);
    }

    private function generateCRUDPermission($name, $guardName = 'api')
    {
        $crud = ['create', 'read', 'update', 'delete'];
        $createdAt = Carbon::now()->format(SQL_DATETIME_FORMAT);
        $result = [];
        foreach($crud as $action) {
            $result[] = [
                'name' => "$action $name",
                'guard_name' => $guardName,
                'created_at' => $createdAt,
            ];
        }

        return $result;
    }

    /** 
     * @param string|array $name
     * @param string $guardName
     * 
     * @return array
     */
    private function generatePermissionByName($name, $guardName = 'api') {
        $createdAt = Carbon::now()->format(SQL_DATETIME_FORMAT);
        $result = [];
        if(is_array($name)) {
            foreach($name as $permissionName) {
                $result[] = [
                    'name' => $permissionName,
                    'guard_name' => $guardName,
                    'created_at' => $createdAt,
                ];
            }

            return $result;
        }

        return [
            [
                'name' => $name,
                'guard_name' => $guardName,
                'created_at' => $createdAt,
            ]
        ];
    }
}
