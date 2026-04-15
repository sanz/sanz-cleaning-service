<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceReviewFactory extends Factory
{
    protected $model = ServiceReview::class;

    public function definition(): array
    {
        return [
            'service_id' => Service::query()->inRandomOrder()->value('service_id') ?? 1,
            'user_id' => Customer::query()->inRandomOrder()->value('id') ?? 1,
            'response_rating' => fake()->numberBetween(3, 5),
            'service_rating' => fake()->numberBetween(3, 5),
            'communication_rating' => fake()->numberBetween(3, 5),
            'price_rating' => fake()->numberBetween(3, 5),
            'title' => fake()->sentence(4),
            'feedback' => fake()->paragraph(),
            'image' => null,
        ];
    }
}
