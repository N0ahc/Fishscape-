<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\posts>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title' => $this->faker->text(64),
        'user_id' => function () {
            return \App\Models\User::inRandomOrder()->first()->id;
        },
        'image_path' => $this->faker->imageUrl(640, 480, 'animals', true),
        'content' => $this->faker->paragraph,
    ];
}

}
