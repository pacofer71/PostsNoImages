<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
            'titulo'=>fake()->unique->sentence(),
            'contenido'=>fake()->text(),
            'estado'=>fake()->randomElement(['Publicado', 'Borrador']),
            'user_id'=>User::all()->random()->id,
        ];
    }
}
