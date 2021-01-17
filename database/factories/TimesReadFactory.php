<?php

namespace Database\Factories;

use App\Models\TimesRead;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimesReadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimesRead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'minutes' => $this->faker->randomNumber(2)
        ];
    }
}
