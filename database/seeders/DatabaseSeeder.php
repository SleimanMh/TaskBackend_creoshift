<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Database\Seeder;

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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => '123456',
            'role' => 'admin',
        ]);

        // Create a regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => '123456',
            'role' => 'user',
        ]);
        
        $flights=Flight::factory(50)->create();
        
        $passengers =Passenger::factory(1000)->create();

        $flights->each(function ($flight) use ($passengers) {
            $flight->passengers()->attach($passengers->random(3)->pluck('id'));
        });
    }
}
