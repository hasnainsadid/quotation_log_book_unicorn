<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(UsersTableSeeder::class);
        $this->call(CacheTableSeeder::class);
        $this->call(CacheLocksTableSeeder::class);
        $this->call(JobBatchesTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(QuatationLogBooksTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
    }
}
