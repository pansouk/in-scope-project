<?php

namespace Database\Factories\Projects;


use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projects\=Complex>
 */
class ComplexFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'company_id' => Company::all()->random()->id,
            'budget' => $this->faker->numberBetween(10000, 100000),
            'timeline' => $this->faker->date(),
        ];
    }
}
