<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/Logo1.png" />
    <title>WayGo</title>
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>
<body class="bg-gradient-to-b from-[#0B5F8D] to-[#55B0CC] min-h-screen flex flex-col">
    
    @include('Component.navbar')
    
    <main class="flex-grow max-w-[1080px] mx-auto px-4 w-full pt-22 pb-20">
        
        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl">
            
            <div class="relative w-full h-[400px]">
                <img src="{{ asset('assets/hero1.jpg') }}" class="w-full h-full object-cover" alt="Borobudur">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                
                <a href="/blog" class="absolute top-6 left-6 md:top-8 md:left-8 flex items-center gap-2 text-white font-semibold hover:text-gray-300 transition z-20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back
                </a>

                <div class="absolute bottom-8 left-6 md:left-10 right-6 z-10">
                    <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-3">Sunrise Over the <br class="hidden md:block"> Majestic Borobudur Temple</h1>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-200">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Magelang, Central Java
                        </span>
                        <span>|</span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            August 20, 2023 by Samudra Bryandhika
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-12">
                
                <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-gray-200 pb-6 mb-8 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Sunrise Over the Majestic Borobudur Temple</h2>
                        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 font-medium">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> Magelang, Central Java</span>
                            <span class="hidden md:inline">|</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> August 20, 2023 by Samudra Bryandhika</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 text-sm font-bold text-gray-800">
                        <div class="w-[2px] h-5 bg-gray-900"></div>
                        Share 
                        <a href="#" class="hover:text-[#0B5F8D] transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                        <a href="#" class="hover:text-[#0B5F8D] transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                        <a href="#" class="hover:text-[#0B5F8D] transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path></svg></a>
                    </div>
                </div>

                <div class="text-gray-800 leading-relaxed space-y-6">
                    <p>It was still dark this morning when I arrived at the Borobudur area. <br> The sky showed no signs of dawn yet. The cold air was immediately felt, and a thin mist enveloped the majestic temple. The atmosphere was so calm—only the soft footsteps of visitors arriving with the same goal.</p>
                    
                    <p>Watching the sunrise from the top of Borobudur. <br> I started climbing the stone steps that felt cold. Every step felt like a journey towards something special. The reliefs on the temple walls looked faint in the dark, but it actually made the atmosphere even more magical. When I finally reached the top, I stopped. <br> The sky slowly changed color. From dark, to purple, then orange. And at that exact second—the sun emerged from behind the hills.</p>

                    <p>Its light illuminated the stupas one by one, creating beautiful shadows and a truly serene atmosphere. <br> "A moment that leaves you speechless." <br> Everyone fell silent. No one spoke. Everyone just enjoyed it. <br> Borobudur is not just a tourist destination. It is an experience. A place where you can pause from the busy world and truly feel the tranquility. <br> If you have the chance, come earlier. Climb to the top, and witness the magic of the sunrise here yourself.</p>
                </div>

                <div class="mt-12 bg-[#FDF5E6] rounded-2xl p-6 md:p-8 border border-orange-200 grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div>
                        <div class="flex items-center gap-2 font-bold text-gray-900 mb-3">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Best Time to Visit
                        </div>
                        <div class="border border-gray-400 rounded-xl px-4 py-3 bg-transparent flex justify-between items-center text-sm font-semibold text-gray-800">
                            05:00 - 06:00 (Sunrise)
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 font-bold text-gray-900 mb-3">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Estimated Cost
                        </div>
                        <div class="border border-gray-400 rounded-xl px-4 py-3 bg-transparent flex justify-between items-center text-sm font-semibold text-gray-800">
                            IDR 900.000 - 1.200.000
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 font-bold text-gray-900 mb-3">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            Tips
                        </div>
                        <div class="border border-gray-400 rounded-xl px-4 py-3 bg-transparent text-sm font-medium text-gray-800 leading-snug">
                            Wear a jacket because the air is quite cold, and don't forget to enjoy the moment without focusing too much on taking photos.
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

    @include('Component.footer')
</body>
</html>