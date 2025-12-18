<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //=========================================
    // Menampilkan daftar buku
    //=========================================
    public function index()
    {
        $books = Book::with(['author', 'categories'])->latest()->get();
        
        $categories = Category::all();

        $authors = Author::all(); 

        return view('books.index', compact('books', 'categories', 'authors'));
    }

    //================================
    // Menambahkan buku baru
    //================================
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
        $validated['user_id'] = Auth::id();

        $author = Author::where('name', $request->author_name)->first();
        if (!$author) {
            $author = Author::create([
                'name' => $request->author_name
            ]);
        }

        $book = Book::create([
            'user_id' => Auth::id(),
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

    //================================
    // Menghapus buku
    //================================
    public function destroy(Book $book)
    {
        $book->categories()->detach();
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    //================================
    // Memperbarui buku
    //================================
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author_name' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'published_year' => 'required|digits:4',
        ]);

        $author = Author::where('name', $request->author_name)->first();
        if (!$author) {
            $author = Author::create([
                'name' => $request->author_name
            ]);
        }

        $book->update([
            'title' => $request->title,
            'author_id' => $author->id, // Pakai ID dari author yang ditemukan/dibuat
            'isbn' => $request->isbn,
            'published_year' => $request->published_year,
        ]);

        $categoryIds = $request->categories ? explode(',', $request->categories) : [];
        $book->categories()->sync($categoryIds);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

}
