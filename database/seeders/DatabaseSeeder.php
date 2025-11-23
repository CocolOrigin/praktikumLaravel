<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $authors = Author::factory(20)->create();

        Category::insert([
            ['name' => 'Fiction'],
            ['name' => 'Romance'],
            ['name' => 'Mystery'],
            ['name' => 'Fantasy'],
            ['name' => 'Biography'],
            ['name' => 'Science'],
            ['name' => 'Technology'],
            ['name' => 'Documentary'],
            ['name' => 'History'],
        ]);

        Book::factory(50)->make()->each(function ($book) use ($authors) {
            $book->author_id = $authors->random()->id;
            $book->save();
        });

        $allCategories = Category::pluck('id')->toArray();
        $books = Book::all();
        foreach ($books as $book) {
            $random = collect($allCategories)->random(rand(1, 3));
            $book->categories()->attach($random);
        }

        echo "Seeded 20 authors, 9 categories, and 50 books with categorizing each random.\n";
    }
}
