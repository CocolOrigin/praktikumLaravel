@if (session('success'))
    <div x-data="{ show: false }" {{-- UBAH 1: Mulai dari FALSE agar tidak langsung nongol --}}
         x-show="show"
         x-transition:enter="transition ease-out duration-500" {{-- Durasi saya lamain dikit biar smooth --}}
         x-transition:enter-start="opacity-0 -translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-10"
         
         {{-- UBAH 2: Logic Delay --}}
         x-init="
            setTimeout(() => show = true, 500);   {{-- Tunggu 0.5 detik, baru animasi masuk --}}
            setTimeout(() => show = false, 5000); {{-- Tunggu 5 detik, baru animasi keluar --}}
         "
         
         class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[100] w-full max-w-md"
         style="display: none;">
        
        <div class="bg-white border-l-4 border-blue-500 rounded-lg shadow-2xl overflow-hidden p-4 flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0 text-blue-500">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-bold text-gray-900">Berhasil!</p>
                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                </div>
            </div>
            <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-600 focus:outline-none transition">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif