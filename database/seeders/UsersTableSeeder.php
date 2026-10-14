<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Hasnain Sadid',
                'email' => 'hasnainsadid@gmail.com',
                'phone' => '01798537135',
                'designation' => 'abc',
                'address' => 'Banker\'s Hall, House No #54, Road #6, Sector 2, Block D, Aftabnagar, Dhaka-1212',
                'email_verified_at' => NULL,
                'password' => '$2y$12$pvydhmg67nmTHKXav2FeR.Bfzszrro5iVMvAQpzh61PV7rAcBRjw2',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => 'K7Nr9d7bMroHuEWyCWxFgxsO6jKfVL1W76AvwUBvJDqW7yxcUhoeE8psMi6a',
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => NULL,
                'updated_at' => '2026-10-14 10:32:07',
            ),
        ));
        
        
    }
}