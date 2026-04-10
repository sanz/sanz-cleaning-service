<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'user_code' => 'USR-' . strtoupper(Str::random(6)),
            'user_name' => fake()->name(),
            'user_email' => fake()->unique()->safeEmail(),
            'user_mobile' => fake()->numerify('##########'),
            'user_gender' => fake()->randomElement(['male', 'female']),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'user_img_url' => 'https://i.pravatar.cc/600?u=' . urlencode(fake()->unique()->safeEmail()),
            'user_state' => fake()->state(),
            'user_city' => fake()->city(),
            'address_1' => fake()->buildingNumber(),
            'address_2' => fake()->streetName(),
            'user_pincode' => fake()->numberBetween(100000, 999999),
            'user_status' => 1,
        ];
    }
}
