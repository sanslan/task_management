<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true) ,
            'status' => $this->faker->word(),
            'duration' => $this->faker->word(),
        ];
    }

}
