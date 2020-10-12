<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reports;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reports::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1, 30),
            'category_id' => random_int(1, 9),
            'wilaya_id' => random_int(1, 48),
            'title' => $this->faker->realText(rand(10,20)),
            'body' => $this->faker->realText(rand(100,500)),
            'address' => $this->faker->address,
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'created_at' => $this->faker->dateTimeThisYear(),
            'status' => '0'
        ];
    }
}
