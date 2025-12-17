<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6); //Judul 6 kata//
        return [
            'user_id' => User::factory(), //Otomatis buat user jika tidak ditentukan//
            'category_id' => Category::factory(), //Otomatis buat kategori//
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(5, true), //5 paragraf konten dummy//
            'thumbnail' => fake()->imageUrl(640, 480, 'business', true), //URL gambar dummy//
            'status' => fake()->randomElement(['draft', 'published']),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
