document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.post-card');

    // Fungsi utama buat nge-filter dan ngitung kartu
    function filterCards(targetRegion) {
        let visibleCount = 0; // Buat ngitung kartu yang udah ditampilin

        cards.forEach(card => {
            const cardRegion = card.getAttribute('data-region');

            if (targetRegion === 'semua') {
                // Skenario 1: Tombol "Semua" diklik. Tampilin cuma 6 kartu!
                if (visibleCount < 6) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none'; // Sisanya disembunyiin
                }
            } else {
                // Skenario 2: Kategori spesifik diklik (Jawa, Sumatra, dll).
                // Tampilin semua kartu yang sesuai (kebetulan kita emang bikin 6 per kategori)
                if (cardRegion === targetRegion) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }

    // PENTING: Panggil fungsi ini pas halaman pertama kali di-load!
    // Biar pas user baru buka web, yang muncul cuma 6 kartu.
    filterCards('semua');

    // Kasih aksi klik ke semua tombol
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // 1. Ubah warna tombol jadi aktif/non-aktif
            buttons.forEach(btn => {
                btn.classList.remove('bg-white', 'text-[#0B5F8D]');
                btn.classList.add('bg-white/20', 'text-white');
            });
            this.classList.remove('bg-white/20', 'text-white');
            this.classList.add('bg-white', 'text-[#0B5F8D]');

            // 2. Jalankan filter sesuai tombol yang diklik
            const targetRegion = this.getAttribute('data-target');
            filterCards(targetRegion);
        });
    });
});