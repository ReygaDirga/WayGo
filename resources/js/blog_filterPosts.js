document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.post-card');

    function filterCards(targetRegion) {
        let visibleCount = 0; 
        
        // Ubah target jadi huruf kecil semua biar pencariannya nggak sensitif besar/kecil
        const target = targetRegion.toLowerCase().trim();

        cards.forEach(card => {
            const rawRegion = card.getAttribute('data-region') || '';
            const cardRegion = rawRegion.toLowerCase().trim();

            if (target === 'semua') {
                if (visibleCount < 6) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none'; 
                }
            } else {
                // Logika pencarian yang lebih canggih (ngatasin typo/beda huruf dikit)
                if (cardRegion === target || cardRegion.includes(target) || target.includes(cardRegion)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }

    filterCards('semua');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            
            // 1. Reset SEMUA tombol jadi mode TIDAK AKTIF (Abu-abu, teks Biru)
            buttons.forEach(btn => {
                // Hapus style aktif
                btn.classList.remove('bg-[#1A365D]', 'text-white', 'shadow-md');
                // Tambah style tidak aktif
                btn.classList.add('bg-gray-100', 'text-[#1A365D]', 'hover:bg-[#1A365D]', 'hover:text-white');
            });

            // 2. Ubah HANYA tombol yang diklik jadi mode AKTIF (Biru Gelap, teks Putih)
            this.classList.remove('bg-gray-100', 'text-[#1A365D]', 'hover:bg-[#1A365D]', 'hover:text-white');
            this.classList.add('bg-[#1A365D]', 'text-white', 'shadow-md');

            // 3. Jalankan fungsi filter
            const targetRegion = this.getAttribute('data-target');
            filterCards(targetRegion);
        });
    });
});