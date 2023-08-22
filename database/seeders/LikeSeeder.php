<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;


class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Like::factory(50)->create();
    }
}
