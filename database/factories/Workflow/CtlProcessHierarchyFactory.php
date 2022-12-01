<?php

namespace Database\Factories\Workflow;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CtlProcessHierarchyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hierarchy' => $this->faker->name(),
            'depth' => rand(0, 100),
        ];
    }
}
