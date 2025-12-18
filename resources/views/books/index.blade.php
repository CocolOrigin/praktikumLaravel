<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('books.alert_success')

            <div class="bg-white shadow-lg sm:rounded-xl border border-gray-100 overflow-hidden">

                <div class="p-6 bg-white border-b border-gray-100">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">

                        <div class="flex items-center gap-2">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                            <h3 class="text-xl font-bold text-gray-800">Koleksi Perpustakaan</h3>
                        </div>

                        @if (auth()->user()->role === 'admin')
                            <button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'create-book-modal')"
                                class="group inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Buku
                            </button>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-2 justify-center sm:justify-center md:justify-center">
                        <button
                            class="filter-btn active px-4 py-1.5 text-sm font-medium rounded-full border transition-colors duration-200"
                            data-filter="all">
                            Show All
                        </button>
                        @foreach ($categories as $category)
                            <button
                                class="filter-btn px-4 py-1.5 text-sm font-medium rounded-full border border-gray-200 text-gray-500 hover:border-blue-300 hover:text-blue-600 transition-colors duration-200"
                                data-filter="{{ $category->name }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="ps-8 pe-8 pb-8 bg-white">
                    <table id="booksTable" class="w-full text-left border-collapse">
                        <thead class="bg-gray-">
                            <tr>
                                <th class="pb-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Judul Buku
                                </th>
                                <th class="pb-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Penulis</th>
                                <th class="pb-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Tahun</th>
                                <th class="pb-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">
                                    Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600">
                            @foreach ($books as $book)
                                <tr class="border-b border-gray-50 hover:bg-blue-50/50 cursor-pointer transition-colors duration-200 group"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'book-detail-{{ $book->id }}')">

                                    <td
                                        class="py-4 pr-4 font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                        {{ $book->title }}
                                        <div class="text-xs font-normal text-gray-400 mt-0.5">Diupload oleh:
                                            {{ $book->user ? $book->user->name : 'Anonim' }}</div>
                                    </td>

                                    <td class="py-4 pr-4">
                                        {{ $book->author->name }}
                                    </td>

                                    <td class="py-4 text-center">
                                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-medium">
                                            {{ $book->published_year }}
                                        </span>
                                    </td>

                                    <td class="py-4 text-center">
                                        <div class="flex flex-wrap justify-center gap-1">
                                            @foreach ($book->categories as $category)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
                                                    {{ $category->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>

                                @include('books.modal_showbook', ['book' => $book])
                                @include('books.modal_editbook', ['book' => $book])
                                @include('books.modal_deletebook', ['book' => $book])
                            @endforeach
                        </tbody>
                    </table>
                    @include('books.modal_createbook')
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#booksTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthChange: true, // FITUR INI DIAKTIFKAN KEMBALI (10/25/50)
                lengthMenu: [10, 25, 50, 100],
                language: {
                    search: "", // Label search kita hilangkan lewat CSS nanti biar bersih
                    searchPlaceholder: "Cari judul, penulis...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ buku",
                    paginate: {
                        next: "Berikutnya ›",
                        previous: "‹ Sebelumnya"
                    }
                },
                // Custom DOM positioning untuk memisahkan Search dan Length menu
                dom: '<"flex flex-col md:flex-row justify-between items-center mb-4 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center mt-6 gap-4"ip>'
            });

            // Logika Filter Tombol (Update Style)
            $('.filter-btn').on('click', function() {
                let filter = $(this).data('filter');

                // Reset semua tombol ke style outline abu
                $('.filter-btn').removeClass('bg-blue-600 text-white border-blue-600 shadow-md')
                    .addClass('border-gray-200 text-gray-500 hover:border-blue-300 hover:text-blue-600');

                // Set tombol aktif ke Biru Solid
                $(this).removeClass(
                        'border-gray-200 text-gray-500 hover:border-blue-300 hover:text-blue-600')
                    .addClass('bg-blue-600 text-white border-blue-600 shadow-md');

                if (filter === 'all') {
                    table.column(3).search('').draw(); // Kolom ke-3 (index array) adalah Kategori
                } else {
                    table.column(3).search(filter).draw();
                }
            });

            // Set tombol "Show All" jadi aktif saat pertama load
            $('.filter-btn[data-filter="all"]').trigger('click');
        });
    </script>

    <style>
        /* 1. Styling Search Input */
        .dataTables_filter {
            width: 100%;
            max-width: 300px;
        }

        .dataTables_filter input {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            /* Gray-200 */
            border-radius: 0.5rem;
            /* Rounded-lg */
            outline: none;
            transition: all 0.2s;
            background-color: #f9fafb;
            /* Gray-50 */
        }

        .dataTables_filter input:focus {
            background-color: #fff;
            border-color: #3b82f6;
            /* Blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* 2. Styling Length Menu (Dropdown 10/25/50) */
        .dataTables_length select {
            padding-right: 2rem;
            /* Space for arrow */
            padding-left: 0.75rem;
            padding-top: 0.4rem;
            padding-bottom: 0.4rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            color: #4b5563;
            /* Gray-600 */
            background-color: #fff;
            cursor: pointer;
        }

        .dataTables_length select:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        /* 3. Styling Pagination */
        .dataTables_paginate {
            display: flex;
            gap: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.4rem 0.8rem;
            margin: 0;
            border-radius: 0.375rem;
            /* Rounded-md */
            border: 1px solid transparent;
            color: #6b7280 !important;
            /* Gray-500 */
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
            background: transparent;
        }

        /* Hover state */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
            background: #eff6ff !important;
            /* Blue-50 */
            color: #2563eb !important;
            /* Blue-600 */
            border: 1px solid #bfdbfe;
        }

        /* Active state (Halaman saat ini) */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #3b82f6 !important;
            /* Blue-500 */
            color: white !important;
            border: 1px solid #3b82f6 !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        /* Disabled state */
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #d1d5db !important;
            /* Gray-300 */
            cursor: not-allowed;
        }

        /* 4. Info Text (Showing 1 to 10...) */
        .dataTables_info {
            color: #9ca3af !important;
            /* Gray-400 */
            font-size: 0.875rem;
        }

        /* Hilangkan border default table DataTables */
        table.dataTable.no-footer {
            border-bottom: none;
        }
    </style>

</x-app-layout>
