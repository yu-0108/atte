<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AttendanceFactory extends Factory
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
            'start_work' => $dummyDate->format('Y-m-d H:i:s'),
            'end_work' => $dummyDate ->modify('+7hours') ->format('Y-m-d H:i:s'),
        ];
    }
}
