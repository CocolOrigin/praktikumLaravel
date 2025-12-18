<x-modal name="ktm-modal" focusable maxWidth="md">
    <div class="bg-white overflow-hidden rounded-lg shadow-2xl relative">

        <button x-on:click="$dispatch('close')"
            class="absolute top-3 right-3 z-50 p-2 text-white/70 hover:text-white bg-black/10 hover:bg-black/20 rounded-full transition focus:outline-none"
            title="Tutup">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="bg-blue-600 pt-6 pb-40 relative text-center">

            <div class="z-10 relative px-8">
                <h2 class="text-white font-extrabold text-xl tracking-wider uppercase drop-shadow-md">
                    PROFILE MAHASISWA
                </h2>
                <p class="text-blue-100 text-sm mt-1 font-medium opacity-90">
                    Universitas Teknologi Digital
                </p>
            </div>

            <div class="absolute left-1/2 transform -translate-x-1/2 -bottom-20 w-full flex justify-center z-20">
                <div class="relative">
                    <img src="{{ asset('images/firdaus.jpg') }}" alt="Firdaus Syazwana"
                        class="w-36 h-48 rounded-lg object-cover border-[5px] border-white shadow-2xl bg-gray-200">

                    <div
                        class="absolute -bottom-3 -right-3 bg-yellow-400 text-white p-2 rounded-full border-4 border-white shadow-sm">
                        <svg class="w-4 h-4 text-yellow-900" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 pt-28 pb-8">

            <div class="text-center mb-8">
                <h3 class="font-bold text-gray-900 text-2xl leading-tight">
                    Firdaus Syazwana H.P.
                </h3>
                <div class="mt-3 inline-flex items-center justify-center space-x-2">
                    <span
                        class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200 uppercase tracking-wide">
                        Mahasiswa Aktif
                    </span>
                    <span class="text-gray-400 text-xs">•</span>
                    <span class="text-gray-600 text-sm font-mono">20125100</span>
                </div>
            </div>

            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 text-sm">
                <dl class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1">
                        <dt class="font-semibold text-gray-500 text-xs uppercase tracking-wide pt-1">Alamat</dt>
                        <dd class="col-span-2 text-gray-800 font-medium leading-relaxed">
                            Jl. R Trincing Wesi Komplek Cipageran Asri E6/3
                        </dd>
                    </div>

                    <div class="border-t border-gray-200/50"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1">
                        <dt class="font-semibold text-gray-500 text-xs uppercase tracking-wide pt-1">Wilayah</dt>
                        <dd class="col-span-2 text-gray-800 font-medium leading-relaxed">
                            Kel. Cipageran, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat
                        </dd>
                    </div>

                    <div class="border-t border-gray-200/50"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1">
                        <dt class="font-semibold text-gray-500 text-xs uppercase tracking-wide pt-1">Kontak</dt>
                        <dd class="col-span-2 text-blue-600 font-bold tracking-wide hover:underline cursor-pointer">
                            085855275077
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="mt-8" x-data="{
                activeSlide: 1,
                totalSlides: 3,
                next() { this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1 },
                prev() { this.activeSlide = this.activeSlide === 1 ? this.totalSlides : this.activeSlide - 1 }
            }">

                {{-- <div>
                    <h4
                        class="font-bold text-gray-800 mb-3 ml-1 flex items-center gap-2 text-xs uppercase tracking-wider">
                        <span class="w-2 h-2 bg-blue-500 rounded-full inline-block"></span>
                        Galeri Kegiatan
                    </h4>

                    <div
                        class="relative rounded-xl overflow-hidden shadow-sm bg-white border border-gray-200 group ring-4 ring-gray-50">
                        <div class="relative h-40 w-full flex transition-transform duration-500 ease-out"
                            :style="'transform: translateX(-' + ((activeSlide - 1) * 100) + '%)'">

                            <div
                                class="min-w-full h-full flex flex-col justify-center items-center bg-gray-100 text-gray-400">
                                <svg class="w-10 h-10 mb-1 opacity-50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-xs font-semibold">Dokumentasi 1</span>
                            </div>

                            <div
                                class="min-w-full h-full flex flex-col justify-center items-center bg-gray-200 text-gray-500">
                                <span class="text-xs font-semibold">Dokumentasi 2</span>
                            </div>

                            <div
                                class="min-w-full h-full flex flex-col justify-center items-center bg-gray-100 text-gray-400">
                                <span class="text-xs font-semibold">Dokumentasi 3</span>
                            </div>
                        </div>

                        <button @click="prev()"
                            class="absolute left-0 top-0 bottom-0 px-2 bg-gradient-to-r from-black/40 to-transparent text-white opacity-0 group-hover:opacity-100 transition-opacity flex items-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="next()"
                            class="absolute right-0 top-0 bottom-0 px-2 bg-gradient-to-l from-black/40 to-transparent text-white opacity-0 group-hover:opacity-100 transition-opacity flex items-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex justify-center gap-1.5 mt-3">
                        <template x-for="slide in totalSlides">
                            <button @click="activeSlide = slide"
                                :class="{ 'bg-blue-600 w-6': activeSlide === slide, 'bg-gray-300 w-2': activeSlide !== slide }"
                                class="h-1.5 rounded-full transition-all duration-300"></button>
                        </template>
                    </div>

                </div> --}}
                
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-center border-t border-gray-100">
            <button x-on:click="$dispatch('close')"
                class="w-full sm:w-auto px-6 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                Tutup Kartu
            </button>
        </div>
    </div>
</x-modal>
