<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\Rating;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $faker = Faker::create();

        // ------------------------
        // Seed Authors
        // ------------------------
        $authors = [];
        for ($i = 1; $i <= 1000; $i++) {
            $authors[] = [
                'id' => $i,
                'name' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Author::insert($authors);

        // ------------------------
        // Seed Categories
        // ------------------------
        $categories = [];
        for ($i = 1; $i <= 3000; $i++) {
            $categories[] = [
                'id' => $i,
                'name' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Category::insert($categories);

        // ------------------------
        // Seed Books (batched)
        // ------------------------
        $batchSize = 1000;
        $books = [];
        for ($i = 1; $i <= 100000; $i++) {
            $books[] = [
                'title' => $faker->sentence(3),
                'author_id' => rand(1, 1000),
                'category_id' => rand(1, 3000),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($books) >= $batchSize) {
                Book::insert($books);
                $books = [];
            }
        }
        if (!empty($books)) Book::insert($books);

        // ------------------------
        // Seed Ratings (batched)
        // ------------------------
        $ratings = [];
        for ($i = 1; $i <= 500000; $i++) {
            $ratings[] = [
                'book_id' => rand(1, 100000),
                'rating' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($ratings) >= $batchSize) {
                Rating::insert($ratings);
                $ratings = [];
            }
        }
        if (!empty($ratings)) Rating::insert($ratings);
    }
}
