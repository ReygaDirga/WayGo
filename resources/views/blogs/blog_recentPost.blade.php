<div class="max-w-6xl mx-auto px-4 mt-0 pb-0">
    
    <div class="flex items-center gap-6 mb-8">
        <h2 class="text-3xl font-bold text-white whitespace-nowrap">Recent Posts</h2>
        <div class="h-[3px] bg-white flex-grow rounded-full"></div>
    </div>

    <div id="drag-slider" class="cursor-grab flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] select-none">
        @foreach ($recentPosts as $rp)
            <a href="{{ route('blog-detail', $rp->id) }}" class="relative flex-none w-[300px] h-[380px] rounded-2xl overflow-hidden snap-start cursor-pointer group shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{ $rp->image ? asset('storage/' . $rp->image) : asset('assets/Logo1.png') }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 pointer-events-none" alt="Lake Toba">
                <div class="absolute inset-x-0 bottom-0 h-2/5 bg-gradient-to-t from-white via-white/80 to-transparent z-0"></div>
                <div class="absolute bottom-0 left-0 right-0 p-5 z-10">
                    <div class="flex justify-between items-center mb-3">
                        <span class="bg-[#0B1A30] text-white text-xs px-4 py-1.5 rounded-full font-semibold">{{ $rp->pulau->name }}</span>
                        <span class="text-gray-900 text-xs font-bold">{{ $rp->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-gray-900 text-2xl font-bold mb-1">{{ explode(',', $rp->location)[0] }}</h3>
                    <p class="text-gray-800 text-sm leading-snug min-h-[40px] line-clamp-2">{{ $rp->title }}</p>
                </div>
            </a>
        @endforeach
        
    </div>
</div>

<script>
    // SCRIPT DRAG-TO-SCROLL (TIDAK PERLU DIUBAH)
    const slider = document.getElementById('drag-slider');
    let isDown = false;
    let startX;
    let scrollLeft;
    let isDragging = false;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        isDragging = false;
        slider.classList.replace('cursor-grab', 'cursor-grabbing');
        slider.classList.remove('snap-x', 'snap-mandatory');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.replace('cursor-grabbing', 'cursor-grab');
        slider.classList.add('snap-x', 'snap-mandatory');
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.replace('cursor-grabbing', 'cursor-grab');
        slider.classList.add('snap-x', 'snap-mandatory');
        setTimeout(() => { isDragging = false; }, 0);
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        if (Math.abs(walk) > 5) {
            isDragging = true;
        }
        slider.scrollLeft = scrollLeft - walk;
    });

    slider.addEventListener('click', (e) => {
        if (isDragging) {
            e.preventDefault();
            e.stopImmediatePropagation();
        }
    }, true);
</script>