<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Wemerson Moura',
        //     'email' => 'wems@email.com',
        //     'password'=> bcrypt('123'),
        // ]);
        $this->call([
            UserSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        
    }
}
