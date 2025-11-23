<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => fake()->sentence(3), // Judul buku (3 kata)
            'isbn' => fake()->isbn13(),
            'published_year' => fake()->year(),

            // Trik Relasi Otomatis:
            // Kalau kita bikin buku tapi tidak sebutkan author_id-nya,
            // Laravel akan otomatis buatkan Author baru.
            // 'author_id' => Author::factory(),

            'author_id' => null,
        ];
    }
}
