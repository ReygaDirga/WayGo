<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/Logo1.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>WayGo</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/date.js',
        'resources/js/location.js'
        ])
</head>
<body class="bg-gradient-to-b from-[#0B5F8D] to-[#55B0CC] min-h-screen flex flex-col">
    
    @include('Component.navbar')
    
    <main class="flex-grow max-w-[1080px] mx-auto px-4 w-full pt-22 pb-20">
        
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 w-full">
            
            <div class="flex items-start gap-4 mb-10 border-b border-gray-200 pb-6">
                <a href="{{ route('profile') }}" class="border-2 border-gray-300 hover:border-gray-400 text-gray-700 hover:text-black rounded-xl p-2.5 transition mt-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Create New Blog Post</h1>
                    <p class="text-sm font-semibold text-gray-600">Share your travel story and inspire others</p>
                </div>
            </div>

            <form action="#" method="POST">
                
                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">1. Basic Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Title</label>
                            <input type="text" class="w-full border-2 border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-[#0B5F8D] transition" placeholder="Enter an interesting title...">
                        </div>
                        <div class="relative w-full">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">Location</label>

                            <div class="flex items-center gap-2">
                                <input
                                    id="locationSearch"
                                    type="text"
                                    placeholder="e.g., Bali, Indonesia"
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-[#0B5F8D] transition"
                                    autocomplete="off"
                                >
                            </div>
                            <div
                                id="locationResults"
                                class="hidden absolute top-full left-0 mt-3 bg-white shadow-xl rounded-xl w-80 z-50 max-h-60 overflow-auto"
                            >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-1.5">2. Cover Image</h2>
                    <p class="text-xs font-bold text-gray-600 mb-4">Upload a beautiful image that represents your story.</p>
                    
                    <label for="cover-upload" class="relative overflow-hidden border-2 border-dashed border-gray-400 hover:border-[#0B5F8D] bg-gray-50 hover:bg-blue-50 rounded-2xl p-10 flex flex-col items-center justify-center cursor-pointer transition group min-h-[250px]">
                        
                        <input type="file" id="cover-upload" class="hidden" accept="image/*" onchange="previewImage(event)">
                        
                        <div id="upload-placeholder" class="flex flex-col items-center z-10 pointer-events-none">
                            <svg class="w-12 h-12 text-[#0B5F8D] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="text-sm font-semibold text-gray-700 mb-1">Click to upload or drag and drop</p>
                            <p class="text-xs font-semibold text-gray-500">Recommended size: 1280x720px (16:9)</p>
                        </div>

                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20" alt="Cover Preview">
                    </label>
                </div>

                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">3. Content</h2>
                    <textarea class="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 h-64 outline-none focus:border-[#0B5F8D] transition resize-y" placeholder="Write your amazing story here..."></textarea>
                </div>

                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-1.5">4. Highlight Information <span class="text-gray-500 font-semibold">(optional)</span></h2>
                    <p class="text-xs font-bold text-gray-600 mb-4">Add useful information to help readers plan their trip</p>
                    
                    <div class="bg-[#FDF5E6] rounded-2xl p-6 md:p-8 border border-orange-200 grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <div>
                            <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Best Time to Visit
                            </div>
                            
                            <div id="best-time-wrapper" class="flex justify-between items-center w-full border-2 border-gray-400 bg-transparent rounded-xl px-4 py-2.5 transition cursor-text">
                                
                                <div class="flex items-center gap-2">
                                    <input type="text" class="timepicker w-16 bg-transparent border-none outline-none font-semibold text-gray-800 text-base text-center cursor-pointer" placeholder="Start">
                                    <span class="font-bold text-gray-500">-</span>
                                    <input type="text" class="timepicker w-16 bg-transparent border-none outline-none font-semibold text-gray-800 text-base text-center cursor-pointer" placeholder="End">
                                </div>
                                
                                <svg class="w-6 h-6 text-gray-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Estimated Cost
                            </div>
                            <div class="relative">
                                <input type="text" class="w-full border-2 border-gray-400 bg-transparent rounded-xl px-4 py-2.5 outline-none focus:border-orange-500 transition font-semibold text-gray-800" placeholder="e.g., IDR 900.000">
                                <svg class="w-5 h-5 text-gray-600 absolute right-4 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                                Tips
                            </div>
                            <input type="text" class="w-full border-2 border-gray-400 bg-transparent rounded-xl px-4 py-2.5 outline-none focus:border-orange-500 transition font-semibold text-gray-800" placeholder="Write a short tip...">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center border-t border-gray-200 pt-6 mt-8 gap-4">
                    <div class="flex items-center gap-2 text-green-600 font-bold text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Auto-saved a few seconds ago
                    </div>

                    <button type="submit" class="bg-[#F59E0B] hover:bg-orange-600 transition text-white px-8 py-3 rounded-xl font-bold flex items-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Publish Post
                    </button>
                </div>

            </form>
        </div>
    </main>

    @include('Component.footer')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <script>
        const timeWrapper = document.getElementById('best-time-wrapper');

        flatpickr(".timepicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            onOpen: function() {
                // Pas popup waktu kebuka, ubah border jadi oren
                timeWrapper.classList.remove('border-gray-400');
                timeWrapper.classList.add('border-orange-500');
            },
            onClose: function() {
                // Pas popup ditutup, balikin ke warna abu-abu
                timeWrapper.classList.remove('border-orange-500');
                timeWrapper.classList.add('border-gray-400');
            }
        });

        // Fungsi buat nampilin preview foto yang diupload
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');

            // Kalau user milih file
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Masukin data gambar ke tag <img>
                    preview.src = e.target.result;
                    // Munculin gambarnya
                    preview.classList.remove('hidden');
                    // Sembunyiin teks & ikon awannya
                    placeholder.classList.add('hidden');
                }

                // Baca file gambarnya
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>