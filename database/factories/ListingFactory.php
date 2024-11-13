<?php

namespace Database\Factories;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title'=> fake()->name(),
            'tags'=>'laravel, api,backend',
            'company'=>fake()->company(),
            'location'=>fake()->address(),
            'email' => fake()->safeEmail(),
            'website'=>fake()->url(),
            'description'=> fake()->paragraph(5),
        ];
    }
}
