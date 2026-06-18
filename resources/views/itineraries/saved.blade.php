@extends('layouts.app')

@section('title', 'SavedTrips')

@section('content')

<div class="min-h-screen bg-[#FFF8F0] font-sans text-[#1A1A1A]">
    <section class="bg-[#162D4D] text-white pt-16 pb-24 px-8 md:px-20 relative overflow-hidden">

        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-[-50px] left-1/3 w-64 h-64 bg-teal-500/10 rounded-full blur-2xl"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mt-20">
                Memories you will <span class="text-[#F3A344]">always remember</span>
            </h1>
            <p class="text-gray-400 mt-4 text-lg">Every trip end with story, let's flashback your last trip</p>

            <hr class="border-white/20 my-10">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-3xl font-bold text-[#F3A344]">12</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Completed Trip</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-[#F3A344]">8</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Visited Cities</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-[#F3A344]">34</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Ongoing Days</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-[#F3A344]">5</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Travel Companion</p>
                </div>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-8 md:px-20 pt-12 pb-20 relative z-20">
        
        <h2 class="text-4xl font-bold mb-10">Saved <span class="text-[#F3A344]">Trips</span></h2>

        <div class="bg-white rounded-[2rem] shadow-sm overflow-hidden mb-8 border border-gray-100">
            <div class="relative h-80">
                <img src="https://i.pinimg.com/736x/fe/91/03/fe9103c8fc6256df6bc74e60f739bfbc.jpg" alt="Yogyakarta" class="w-full h-full object-cover">
                <div class="absolute bottom-0 left-0 p-8 text-white bg-gradient-to-t from-black/70 to-transparent w-full">
                    <h3 class="text-3xl font-bold">Yogyakarta</h3>
                    <p class="text-lg opacity-90">Malioboro - Lempuyangan - Bantul</p>
                </div>
                <button class="absolute bottom-8 right-8 bg-white/20 backdrop-blur-md p-3 rounded-xl hover:bg-white/40 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </button>
            </div>
            
            <div class="p-8 grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <div class="flex space-x-6 text-sm font-semibold mb-6">
                        <span class="flex items-center gap-2"><i class="far fa-calendar"></i> 07-11 July 2026</span>
                        <span class="flex items-center gap-2"><i class="far fa-clock"></i> 4 Days 3 Nights</span>
                    </div>
                    <div class="bg-gray-100 rounded-2xl h-32 flex items-center justify-center border border-gray-200">
                        <span class="text-gray-400 italic text-sm">Visual Itinerary Map Placeholder</span>
                    </div>
                    <div class="mt-4 flex items-center gap-3">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-teal-500 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-blue-500 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-pink-500 border-2 border-white"></div>
                        </div>
                        <span class="text-sm text-gray-500">3 Traveler</span>
                        <button class="ml-auto border border-[#F3A344] text-[#F3A344] text-xs px-3 py-1 rounded-full">+ Add Photos</button>
                    </div>
                </div>
                
                <div class="border-l border-gray-100 pl-8">
                    <h4 class="text-[#F3A344] font-bold text-lg mb-3">Travel Highlight</h4>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start gap-2">• Breakfast at Gudeg Yu Djum</li>
                        <li class="flex items-start gap-2">• Trip at Hutan Pinus Mangunan</li>
                        <li class="flex items-start gap-2">• Lunch at RM Mangunan Baru</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Card Bali -->
            <div class="bg-white rounded-[2rem] shadow-sm overflow-hidden border border-gray-100">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&q=80&w=800" alt="Bali" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4 bg-orange-400 text-white text-[10px] px-3 py-1 rounded-lg font-bold">PLANNED</div>
                    <div class="absolute bottom-0 left-0 p-6 text-white w-full">
                        <h3 class="text-2xl font-bold">Bali</h3>
                        <p class="text-sm opacity-90">Ubud - Seminyak - Penida</p>
                    </div>
                    <button class="absolute bottom-6 right-6 bg-white/20 backdrop-blur-md p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <p class="text-sm font-semibold mb-4 text-gray-600 italic">02-09 June 2026</p>
                    <div class="bg-gray-100 rounded-xl h-24 mb-4 border border-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-xs italic">Map View</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 rounded-full bg-blue-600 border-2 border-white"></div>
                            <div class="w-7 h-7 rounded-full bg-purple-600 border-2 border-white"></div>
                            <div class="w-7 h-7 rounded-full bg-gray-400 border-2 border-white"></div>
                        </div>
                        <span class="text-xs text-gray-500">3 Traveler</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-sm overflow-hidden border border-gray-100">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&q=80&w=800" alt="Raja Ampat" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4 bg-orange-400 text-white text-[10px] px-3 py-1 rounded-lg font-bold">PLANNED</div>
                    <div class="absolute bottom-0 left-0 p-6 text-white w-full">
                        <h3 class="text-2xl font-bold">Raja Ampat</h3>
                        <p class="text-sm opacity-90">Papua Barat - Misool - Wayag</p>
                    </div>
                    <button class="absolute bottom-6 right-6 bg-white/20 backdrop-blur-md p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <p class="text-sm font-semibold mb-4 text-gray-600 italic">10-14 Dec 2026</p>
                    <div class="bg-gray-100 rounded-xl h-24 mb-4 border border-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-xs italic">Map View</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            <div class="w-7 h-7 rounded-full bg-indigo-600 border-2 border-white"></div>
                            <div class="w-7 h-7 rounded-full bg-purple-500 border-2 border-white"></div>
                            <div class="w-7 h-7 rounded-full bg-gray-300 border-2 border-white"></div>
                        </div>
                        <span class="text-xs text-gray-500">3 Traveler</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection