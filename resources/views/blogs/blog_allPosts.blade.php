<div class="max-w-6xl mx-auto px-4 mt-5 mb-24" id="all-posts-section">
    
    <div class="flex items-center gap-6 mb-8">
        <h2 class="text-3xl font-bold text-white whitespace-nowrap">All Blog Posts</h2>
        <div class="h-[3px] bg-white flex-grow rounded-full"></div>
    </div>

    <div class="flex flex-wrap gap-3 mb-10" id="filter-buttons">
        <button class="filter-btn bg-white text-[#0B5F8D] px-5 py-2 rounded-xl font-bold transition" data-target="semua">All</button>
        <button class="filter-btn bg-white/20 text-white hover:bg-white/40 px-5 py-2 rounded-xl font-bold transition" data-target="Sumatra">Sumatra</button>
        <button class="filter-btn bg-white/20 text-white hover:bg-white/40 px-5 py-2 rounded-xl font-bold transition" data-target="Java">Java</button>
        <button class="filter-btn bg-white/20 text-white hover:bg-white/40 px-5 py-2 rounded-xl font-bold transition" data-target="Bali & Nustra">Bali & Nusra</button>
        <button class="filter-btn bg-white/20 text-white hover:bg-white/40 px-5 py-2 rounded-xl font-bold transition" data-target="Kalimantan">Kalimantan</button>
        <button class="filter-btn bg-white/20 text-white hover:bg-white/40 px-5 py-2 rounded-xl font-bold transition" data-target="Sulawesi">Sulawesi</button>
        <button class="filter-btn bg-white/20 text-white hover:bg-white/40 px-5 py-2 rounded-xl font-bold transition" data-target="Maluku">Maluku</button>
        <button class="filter-btn bg-white/20 text-white hover:bg-white/40 px-5 py-2 rounded-xl font-bold transition" data-target="Papua">Papua</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="posts-grid">
        @foreach ($allPosts as $ap)
            <a href = "{{ route('blog-detail',$ap->id) }}" class="post-card relative w-full h-[400px] rounded-2xl overflow-hidden cursor-pointer group shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" data-region="{{ $ap->pulau->name ?? 'lainnya' }}">
                <img src="{{ $ap->image ? asset('storage/' . $ap->image) : asset('assets/Logo1.png') }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 pointer-events-none">
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-white via-white/90 to-transparent z-0"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                    <div class="flex justify-between items-center mb-3">
                        <span class="bg-[#0B1A30] text-white text-xs px-4 py-1.5 rounded-full font-semibold">{{ $ap->pulau->name }}</span>
                        <span class="text-gray-900 text-xs font-bold">{{ $ap->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-gray-900 text-2xl font-bold mb-1 leading-tight">{{ explode(',', $ap->location)[0] }}</h3>
                    <p class="text-gray-800 text-base leading-snug min-h-[48px] line-clamp-2">{{ $ap->title }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>