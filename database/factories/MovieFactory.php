<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Screen;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return 
        [
            'title' => $this->faker->realText(10),
            'image_url' => $this->faker->imageUrl(440, 280, 'movies', true),
            'published_year'=>random_int(2000, 2023),
            'is_showing'=>(bool)random_int(0, 1),
            'description'=> $this->faker->realText(30),
            'genre_id' => Genre::inRandomOrder()->first()->id,   
         ];
    }
}
