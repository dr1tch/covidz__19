<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IdeaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Idea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1, 20),
            'title' => $this->faker->realText(rand(10,20)),
            'body' => $this->faker->realText(rand(100,500)),
            'likes' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->dateTimeThisYear(),
            'status' => '0'
        ];
    }
}
