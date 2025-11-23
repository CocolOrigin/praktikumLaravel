<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

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

    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $perPage = $request->input('per_page', 10);

    //     $books = Book::with('author')
    //         ->when($search, function ($query, $search) {
    //             $query->where('title', 'like', "%{$search}%");
    //         })
    //         ->paginate($perPage)
    //         ->withQueryString();

    //     return view('books.index', compact('books', 'search', 'perPage'));
    // }
}