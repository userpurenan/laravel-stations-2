<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => $this->faker->dateTimeBetween('-1 week', '+1 week'),        
            'end_time' =>$this->faker->dateTimeBetween('+1 month'), 
        ];
    }
}
