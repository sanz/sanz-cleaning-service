<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'client_code' => 'CLT-' . strtoupper(Str::random(6)),
            'client_name' => fake()->name(),
            'client_email' => fake()->unique()->safeEmail(),
            'client_mobile' => fake()->numerify('##########'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'client_gender' => fake()->randomElement(['Male', 'Female']),
            'client_photo_url' => 'images/default-img/user.png',
            'client_status' => 'Active',
        ];
    }
}
