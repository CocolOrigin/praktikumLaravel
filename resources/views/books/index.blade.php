@extends('layout.main')

@section('title', 'Book List')

@section('content')
<div class="container mt-4">

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">📚 Daftar Buku</h5>
            <button class="btn btn-sm btn-outline-light">+ Tambah Buku</button>
        </div>

        <div class="card-body p-3">

            <div class="mb-3 d-flex flex-wrap gap-1 align-items-center justify-content-center">

                <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="all">
                    Show All
                </button>

                @foreach ($categories as $category)
                <button class="btn btn-sm btn-outline-primary filter-btn"
                    data-filter="{{ $category->name }}">
                    {{ $category->name }}
                </button>
                @endforeach

            </div>


            <table id="booksTable" class="table table-hover table-striped-columns align-middle pt-3">
                <thead class="table-light">
                    <tr>
                        <th>Judul Buku</th>
                        <th class="text-center" style="white-space: nowrap; width: 1%;">
                            
                        </th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <th>
                            <button class="btn btn-sm btn-outline-success"
                                data-bs-toggle="modal"
                                data-bs-target="#bookModal{{ $book->id }}">
                                👁 Lihat
                            </button>

                            @include('books.modal_book', ['book' => $book])
                        </th>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('authors.show', $book->author->id) }}"
                                    title="Lihat Profil Penulis">
                                    👁
                                </a>
                                {{ $book->author->name }}
                            </div>
                        </td>

                        <td class="text-center">{{ $book->published_year }}</td>

                        <td class="text-center">
                            @foreach($book->categories as $category)
                            <span class="badge bg-secondary mx-1">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

<!-- =================================================== -->

<script>
    $(document).ready(function() {

        // Pastikan DataTable tidak double init
        var table = $('#booksTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 100, 1000]
        });

        // Filter tombol
        $('.filter-btn').on('click', function() {
            let filter = $(this).data('filter');

            if (filter === 'all') {
                table.column(4).search('').draw();
            } else {
                table.column(4).search(filter).draw();
            }

            $('.filter-btn').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');
        });

    });
</script>


@endsection