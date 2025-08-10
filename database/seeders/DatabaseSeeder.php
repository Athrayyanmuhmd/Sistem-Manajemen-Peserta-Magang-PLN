<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            UniversitySeeder::class,
            DivisionSeeder::class,
            InternSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin PLN UID Aceh',
            'email' => 'admin@pln-aceh.co.id',
        ]);
    }
}
