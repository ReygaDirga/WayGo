<div class="max-w-6xl mx-auto px-4 mt-5 mb-24" id="all-posts-section">
    <div class="flex items-center gap-6 mb-8">
        <h2 class="text-3xl font-bold text-[#1A365D] whitespace-nowrap">{{ __('messages.alblog') }}</h2>
        <div class="h-[3px] bg-[#1A365D] flex-grow rounded-full"></div>
    </div>

    <div class="flex flex-wrap gap-3 mb-10" id="filter-buttons">
        <button class="filter-btn bg-[#1A365D] text-white shadow-md px-5 py-2 rounded-xl font-bold transition" data-target="semua">{{ __('messages.al') }}</button>
        <button class="filter-btn bg-gray-100 text-[#1A365D] hover:bg-[#1A365D] hover:text-white px-5 py-2 rounded-xl font-bold transition" data-target="Sumatra">{{ __('messages.sm') }}</button>
        <button class="filter-btn bg-gray-100 text-[#1A365D] hover:bg-[#1A365D] hover:text-white px-5 py-2 rounded-xl font-bold transition" data-target="Java">{{ __('messages.jw') }}</button>
        <button class="filter-btn bg-gray-100 text-[#1A365D] hover:bg-[#1A365D] hover:text-white px-5 py-2 rounded-xl font-bold transition" data-target="Bali & Nustra">{{ __('messages.bn') }}</button>
        <button class="filter-btn bg-gray-100 text-[#1A365D] hover:bg-[#1A365D] hover:text-white px-5 py-2 rounded-xl font-bold transition" data-target="Kalimantan">{{ __('messages.kl') }}</button>
        <button class="filter-btn bg-gray-100 text-[#1A365D] hover:bg-[#1A365D] hover:text-white px-5 py-2 rounded-xl font-bold transition" data-target="Sulawesi">{{ __('messages.sl') }}</button>
        <button class="filter-btn bg-gray-100 text-[#1A365D] hover:bg-[#1A365D] hover:text-white px-5 py-2 rounded-xl font-bold transition" data-target="Maluku">{{ __('messages.ml') }}</button>
        <button class="filter-btn bg-gray-100 text-[#1A365D] hover:bg-[#1A365D] hover:text-white px-5 py-2 rounded-xl font-bold transition" data-target="Papua">{{ __('messages.pp') }}</button>
    </div>

    <div class="relative w-full mb-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="text" id="search-input" class="block w-full p-3.5 pl-12 text-sm text-gray-900 border border-gray-200 rounded-2xl bg-gray-50 focus:ring-[#1A365D] focus:border-[#1A365D] shadow-sm transition-colors" placeholder="Cari lokasi atau judul artikel...">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="posts-grid">
        @foreach ($allPosts as $ap)
            <a href="{{ route('blog-detail',$ap->id) }}" 
               class="post-card relative w-full h-[400px] rounded-2xl overflow-hidden cursor-pointer group shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2" 
               data-region="{{ $ap->pulau->name ?? 'lainnya' }}"
               data-location="{{ strtolower($ap->location) }}"
               data-title="{{ strtolower($ap->title) }}">
               
                <img src="{{ $ap->image ? asset('storage/' . $ap->image) : asset('assets/Logo1.png') }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 pointer-events-none">
                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-white via-white/90 to-transparent z-0"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                    <div class="flex justify-between items-center mb-3">
                        <span class="bg-[#1A365D] text-white text-xs px-4 py-1.5 rounded-full font-semibold">{{ $ap->pulau->name }}</span>
                        <span class="text-gray-900 text-xs font-bold">{{ $ap->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-gray-900 text-2xl font-bold mb-1 leading-tight">{{ explode(',', $ap->location)[0] }}</h3>
                    <p class="text-gray-800 text-base leading-snug min-h-[48px] line-clamp-2">{{ $ap->title }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div id="pagination-controls" 
        data-text-prev="{{ __('messages.pr') }}" 
        data-text-next="{{ __('messages.nx') }}"
        class="flex justify-center items-center gap-4 mt-12 text-[#1A365D] font-semibold text-lg">
    </div>
</div>