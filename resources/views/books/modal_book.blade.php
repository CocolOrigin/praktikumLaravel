<div class="modal fade" id="bookModal{{ $book->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Lihat Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-4">
                        @if($book->image ?? false)
                        <img src="{{ asset('storage/'.$book->image) }}" class="img-fluid rounded">
                        @else
                        <div class="border bg-light rounded d-flex justify-content-center align-items-center"
                            style="height: 200px;">
                            <span class="text-muted">No Image</span>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <p><strong>Judul:</strong> {{ $book->title }}</p>
                        <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                        <p><strong>Tahun:</strong> {{ $book->published_year }}</p>

                        <p><strong>Penulis:</strong>
                            <a href="{{ route('authors.show', $book->author->id) }}" title="Lihat Profil Penulis">
                                👁</a>
                            {{ $book->author->name }}
                        </p>

                        <p><strong>Kategori:</strong></p>
                        @foreach($book->categories as $category)
                        <span class="badge bg-secondary">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('books.delete', $book->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Yakin hapus buku ini?')">
                        Hapus
                    </button>
                </form>

                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>