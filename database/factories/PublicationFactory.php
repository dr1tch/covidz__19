<?php

namespace Database\Factories;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->realText(rand(10,20)),
            'body' => $this->faker->realText(rand(100,500)),
            'source' => $this->faker->url,
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
