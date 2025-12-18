<x-modal name="edit-book-{{ $book->id }}" focusable>
    <div class="p-6">
        
        <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-2">
            <h2 class="text-lg font-bold text-gray-900">
                ✏️ Edit Buku
            </h2>
            <button x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <form method="POST" action="{{ route('books.update', $book->id) }}">
            @csrf
            @method('PATCH')

            <div x-data="{
                authorQuery: '{{ $book->author->name }}',
                showAuthors: false,
                authors: {{ $authors->map(fn($a) => $a->name) }},
                selectedCategories: [{{ $book->categories->pluck('id')->implode(',') }}],
                
                get filteredAuthors() {
                    if (this.authorQuery === '') return [];
                    return this.authors.filter(author => 
                        author.toLowerCase().includes(this.authorQuery.toLowerCase())
                    );
                },
                selectAuthor(name) {
                    this.authorQuery = name;
                    this.showAuthors = false;
                },
                toggleCategory(id) {
                    if (this.selectedCategories.includes(id)) {
                        this.selectedCategories = this.selectedCategories.filter(c => c !== id);
                    } else {
                        this.selectedCategories.push(id);
                    }
                }
            }">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    
                    <div>
                        <x-input-label for="title-{{ $book->id }}" value="Judul Buku" />
                        <x-text-input id="title-{{ $book->id }}" name="title" value="{{ $book->title }}" type="text" class="mt-1 block w-full" required />
                    </div>

                    <div class="relative">
                        <x-input-label for="author-{{ $book->id }}" value="Penulis" />
                        <x-text-input 
                            id="author-{{ $book->id }}"
                            type="text" 
                            name="author_name" 
                            class="mt-1 block w-full" 
                            autocomplete="off"
                            x-model="authorQuery"
                            @focus="showAuthors = true"
                            @click.outside="showAuthors = false"
                        />
                        
                        <div x-show="showAuthors && filteredAuthors.length > 0" 
                             class="absolute z-50 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-48 overflow-y-auto mt-1">
                            <template x-for="author in filteredAuthors">
                                <div @click="selectAuthor(author)" 
                                     class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm text-gray-700"
                                     x-text="author"></div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <x-input-label for="isbn-{{ $book->id }}" value="ISBN" />
                        <x-text-input id="isbn-{{ $book->id }}" name="isbn" value="{{ $book->isbn }}" type="text" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label for="published_year-{{ $book->id }}" value="Tahun Terbit" />
                        <x-text-input id="published_year-{{ $book->id }}" name="published_year" value="{{ $book->published_year }}" type="number" class="mt-1 block w-full" required />
                    </div>
                </div>

                <div class="mb-6">
                    <x-input-label class="mb-2" value="Pilih Kategori" />
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <button type="button" 
                                    @click="toggleCategory({{ $category->id }})"
                                    :class="selectedCategories.includes({{ $category->id }}) 
                                        ? 'bg-blue-600 text-white border-blue-600' 
                                        : 'bg-white text-gray-600 border-gray-300 hover:border-blue-400'"
                                    class="px-3 py-1.5 text-sm rounded-full border transition-colors duration-200">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                    <input type="hidden" name="categories" :value="selectedCategories.join(',')">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                    <x-primary-button class="bg-yellow-500 hover:bg-yellow-600 border-yellow-500 focus:ring-yellow-500">Update Buku</x-primary-button>
                </div>

            </div>
        </form>
    </div>
</x-modal>