<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Genre::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                '恋愛',
                'ラブコメ',
                'ホラー',
                '推理',
                'コメディ',
                'SF',
                'その他',
            ]),
        ];
    }
}
