<x-modal name="delete-book-{{ $book->id }}" focusable>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Apakah Anda yakin ingin menghapus buku ini?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Buku <strong>"{{ $book->title }}"</strong> akan dihapus secara permanen. Tindakan ini tidak bisa dibatalkan.
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Batal') }}
            </x-secondary-button>

            <form method="POST" action="{{ route('books.destroy', $book->id) }}" class="ml-3">
                @csrf
                @method('DELETE')
                
                <x-danger-button>
                    {{ __('Ya, Hapus Buku') }}
                </x-danger-button>
            </form>
        </div>
    </div>
</x-modal>