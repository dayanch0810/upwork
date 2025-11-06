<?php

namespace Database\Factories;

use App\Models\Freelancer;
use App\Models\Location;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Freelancer>
 */
class FreelancerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = Location::inRandomOrder()->first();

        return [
            'uuid' => fake()->uuid(),
            'location_id' => $location->id,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'avatar' => null,
            'username' => fake()->unique()->numberBetween(60000000, 65999999),
            'password' => bcrypt('password'),
            'rating' => fake()->randomFloat(1, 0, 5),
            'verified' => fake()->boolean(),
            'total_jobs' => fake()->numberBetween(0, 200),
            'total_earnings' => fake()->numberBetween(0, 100000),
            'previous_clients' => [],
            'remember_token' => Str::random(10),
            'deleted_at' => fake()->boolean(10) ? fake()->dateTimeBetween('-90 days', 'now') : null,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Freelancer $freelancer) {
            $freelancer->freelancerSkills()->sync(Skill::inRandomOrder()
                ->take(fake()->numberBetween(2, 4))
                ->get());
        });
    }
}
