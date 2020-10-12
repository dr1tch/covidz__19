<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->username,
            'fname' => $this->faker->firstname,
            'lname' => $this->faker->lastname,
            'email' => $this->faker->unique()->safeEmail,
            'bio' => $this->faker->realText(rand(10,20)),
            'gender' => $this->faker->boolean,
            'birth_date' => $this->faker->date,
            'email_verified_at' => now(),
            'avatar' => $this->faker->imageUrl($width = 500, $height = 500),
            'wilaya_id' => random_int(1, 48),
            'job_id' => random_int(1, 5),
            'disease_id' => random_int(1, 7),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
