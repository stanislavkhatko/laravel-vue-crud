<?php

namespace Database\Factories;

use App\Models\Line;
use Illuminate\Database\Eloquent\Factories\Factory;

class LineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Line::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'line' => $this->faker->randomNumber(),
            'book' => $this->faker->randomElement(['Idiot', 'Anna Karenina', 'The Great Gatsby', 'Don Quixote']),
            'chapter' => rand(1, 100),
        ];
    }
}
