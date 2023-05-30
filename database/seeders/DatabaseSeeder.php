<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


       DB::table('users')->insert([
       'first_name' => 'admin',
       'last_name' => 'test',
       'email' => 'admin@test.com',
       'phone_number' => '5325320532',
       'date_of_birth' => '2023-01-01',
       'password' => Hash::make('1'),
       ]);

    }
}
