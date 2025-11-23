@extends('layout.main')

@section('title', 'Author Profile')

@section('content')
<div class="container">
    <h1>Profil Penulis: {{ $author->name }}</h1>
    <hr>

    <h3>Daftar Buku Karangan Beliau:</h3>

    @if($author->books->count() > 0)
    <ul>
        @foreach($author->books as $book)
        <li>
            {{ $book->title }} ({{ $book->published_year }})
        </li>
        @endforeach
    </ul>
    @else
    <p class="text-muted">Belum ada buku yang terdata.</p>
    @endif

    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Kembali</a>

</div>
@endsection