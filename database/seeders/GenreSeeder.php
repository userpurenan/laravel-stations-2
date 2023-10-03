<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create(['name' => '恋愛']);
        Genre::create(['name' => 'ラブコメ']);
        Genre::create(['name' => 'ホラー']);
        Genre::create(['name' => '推理']);
        Genre::create(['name' => 'コメディ']);
        Genre::create(['name' => 'SF']);
        Genre::create(['name' => 'その他']);
    }
}
