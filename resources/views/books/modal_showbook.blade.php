<x-modal name="book-detail-{{ $book->id }}" focusable>

    <div class="p-6">

        <div class="flex justify-between items-start mb-4">
            <h2 class="text-lg font-medium text-gray-900">
                📖 Detail Buku
            </h2>
            <button x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="col-span-1">
                @if ($book->image ?? false)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                        class="w-full h-auto rounded-lg shadow-sm object-cover aspect-[3/4]">
                @else
                    <div
                        class="w-full aspect-[3/4] bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex flex-col justify-center items-center text-gray-400">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="text-sm">No Image</span>
                    </div>
                @endif
            </div>

            <div class="col-span-1 md:col-span-2 space-y-3 text-sm text-gray-600">

                <div>
                    <span class="block font-bold text-gray-800 text-base">{{ $book->title }}</span>
                    <span class="text-xs text-gray-500">ISBN: {{ $book->isbn }}</span>
                </div>

                <div class="grid grid-cols-3 gap-2 border-t border-gray-100 pt-3">
                    <span class="font-semibold text-gray-700">Tahun Terbit</span>
                    <span class="col-span-2">: {{ $book->published_year }}</span>

                    <span class="font-semibold text-gray-700">Penulis</span>
                    <div class="col-span-2 flex items-center gap-2">
                        :
                        <span class="font-medium text-gray-900">{{ $book->author->name }}</span>
                        <a href="{{ route('authors.show', $book->author->id) }}"
                            class="text-blue-600 hover:text-blue-800" title="Lihat Profil Penulis">
                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </a>
                    </div>

                    <span class="font-semibold text-gray-700">Kategori</span>
                    <div class="col-span-2 flex flex-wrap gap-1">
                        :
                        @foreach ($book->categories as $category)
                            <span class="bg-gray-200 text-gray-800 text-xs px-2 py-0.5 rounded-full">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-100">

            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Tutup') }}
            </x-secondary-button>

            @if (auth()->user()->role === 'admin')
                <button
                    x-on:click="$dispatch('close'); setTimeout(() => $dispatch('open-modal', 'edit-book-{{ $book->id }}'), 300)"
                    class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 ...">
                    Edit
                </button>

                <button
                    x-on:click="$dispatch('close'); setTimeout(() => $dispatch('open-modal', 'delete-book-{{ $book->id }}'), 300)"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Hapus
                </button>
            @endif
        </div>

    </div>
</x-modal>
