<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => '2026-10-07 14:18:48',
                'updated_at' => '2026-10-07 14:18:48',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Chairman',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:46:24',
                'updated_at' => '2026-10-10 12:46:24',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Managing Director',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:46:58',
                'updated_at' => '2026-10-11 10:46:00',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Deputy Managing Director',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:47:14',
                'updated_at' => '2026-10-11 10:46:19',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Manager',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:47:31',
                'updated_at' => '2026-10-10 12:47:31',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Employee',
                'guard_name' => 'web',
                'created_at' => '2026-10-10 12:47:38',
                'updated_at' => '2026-10-10 12:47:38',
            ),
        ));
        
        
    }
}