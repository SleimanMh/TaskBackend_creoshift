<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passenger>
 */
class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'FirstName' => $this->faker->name(),
            'LastName' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => bcrypt('password'),
            'DOB' => $this->faker->date(),
            'passport_expiry_date' => $this->faker->date(),
        ];
    }
}
