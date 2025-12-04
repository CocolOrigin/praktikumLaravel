<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Container\Attributes\Auth;

class BookController extends Controller
{
    public function index()
    {
        // $books = Book::with('author')->get();
        $books = Book::with(['author', 'categories'])->get();
        $categories = Category::all();

        // dd($books->toArray());
        return view('books.index', compact('books', 'categories'));
    }


    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_name' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'published_year' => 'required|digits:4',
        ]);

        $author = Author::where('name', $request->author_name)->first();
        if (!$author) {
            $author = Author::create([
                'name' => $request->author_name
            ]);
        }

        $book = Book::create([
            'title' => $request->title,
            'author_id' => $author->id,
            'isbn' => $request->isbn,
            'published_year' => $request->published_year,
        ]);

        $categoryIds = explode(',', $request->categories);
        $book->categories()->attach($categoryIds);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

}
