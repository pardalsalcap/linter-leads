<?php

namespace Pardalsalcap\LinterLeads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Pardalsalcap\LinterLeads\Models\Lead;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'company' => fake()->company(),
            'city' => fake()->city(),
            'state' => fake('en_US')->state(),
            'country' => fake()->country(),
            'message' => fake()->text(100),
            'source' => fake()->randomElement(['contact', 'newsletter']),
            'ip' => fake()->ipv4(),
            'is_read' => fake()->boolean(),
            'is_spam' => fake()->boolean(),
            'is_success' => fake()->boolean(),
            'is_flagged' => fake()->boolean(),
            'score' => fake()->numberBetween(0, 10),
            'status' => fake()->randomElement(['new',
                'read',
                'follow_up',
                'fail',
                'success',
                'closed',
            ]),
            'data' => [],
            'created_at' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'updated_at' => fake()->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
