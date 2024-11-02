<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }

    public function admin(): RoleFactory
    {
        return $this->state(function (array $attributes): array {
            return [
                'name' => 'admin'
            ];
        });
    }

    public function user(): RoleFactory
    {
        return $this->state(function (array $attributes): array {
            return [
                'name' => 'user'
            ];
        });
    }
}
