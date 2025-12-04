@extends('layout.main')
@section('title', 'Tambah Buku Baru')

@section('content')

<link rel="stylesheet" href="{{ asset('css/create_book.css') }}">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Buku Baru</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('books.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}">

                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3 autocomplete-box">
                        <label class="form-label">Penulis Buku</label>
                        <input type="text" id="authorInput" name="author_name"
                            class="form-control @error('author_name') is-invalid @enderror"
                            autocomplete="off"
                            value="{{ old('author_name') }}">

                        <div id="authorList" class="autocomplete-list">
                            @foreach ($authors as $author)
                            <div class="autocomplete-item" onclick="selectAuthor('{{ $author->name }}')">
                                {{ $author->name }}
                            </div>
                            @endforeach
                        </div>

                        @error('author_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn"
                            class="form-control @error('isbn') is-invalid @enderror"
                            value="{{ old('isbn') }}">

                        @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="published_year"
                            class="form-control @error('published_year') is-invalid @enderror"
                            value="{{ old('published_year') }}">

                        @error('published_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Kategori</label><br>

                    @foreach($categories as $category)
                    <span class="cat-btn"
                        data-id="{{ $category->id }}"
                        onclick="toggleCategory(this)">
                        {{ $category->name }}
                    </span>
                    @endforeach

                    <input type="hidden" name="categories" id="categoriesInput">
                </div>

                <button type="submit" class="btn btn-primary px-4">Simpan</button>

            </form>
        </div>
    </div>
</div>

{{-- AUTOCOMPLETE SCRIPT --}}
<script>
    const input = document.getElementById('authorInput');
    const list = document.getElementById('authorList');

    input.addEventListener('focus', () => {
        list.style.display = 'block';
    });

    input.addEventListener('input', () => {
        const value = input.value.toLowerCase();
        const items = list.querySelectorAll('.autocomplete-item');

        items.forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(value) ? 'block' : 'none';
        });

        list.style.display = 'block';
    });

    document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !list.contains(e.target)) {
            list.style.display = 'none';
        }
    });

    function selectAuthor(name) {
        input.value = name;
        list.style.display = 'none';
    }
</script>

{{-- CATEGORY TOGGLE --}}
<script>
    let selectedCategories = [];

    function toggleCategory(el) {
        const id = el.getAttribute('data-id');

        if (selectedCategories.includes(id)) {
            selectedCategories = selectedCategories.filter(c => c !== id);
            el.classList.remove('active');
        } else {
            selectedCategories.push(id);
            el.classList.add('active');
        }

        document.getElementById('categoriesInput').value = selectedCategories.join(',');
    }
</script>

@endsection