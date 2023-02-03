<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.General error: 1215 Cannot add foreign key constraint (SQL: alter table `tas
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name() . "'s "  . 'Project',
        ];
    }
}
