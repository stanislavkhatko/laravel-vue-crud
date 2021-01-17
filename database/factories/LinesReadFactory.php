<?php

namespace Database\Factories;

use App\Models\Line;
use App\Models\LinesRead;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinesReadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LinesRead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'line_id' => Line::all()->random(1)->first()->id
        ];
    }
}
