<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'quatation-log-books.destroy',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'quatation-log-books.edit',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'quatation-log-books.index',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'quatation-log-books.create',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'roles.create',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'roles.destroy',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'roles.index',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'users.create',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'users.destroy',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'users.edit',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'users.index',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:48:04',
                'updated_at' => '2026-10-10 12:48:04',
            ),
        ));
        
        
    }
}