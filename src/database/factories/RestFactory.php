<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class RestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dummyDate = $this->faker->dateTimeBetween('-2years');

        return [
            'user_id' => User::factory(),
            'rest_start' => $dummyDate->format('Y-m-d H:i:s'),
            'rest_end' => $dummyDate->modify('+30minute')->format('Y-m-d H:i:s'),
        ];
    }
}
