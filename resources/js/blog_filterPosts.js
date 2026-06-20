// Isi file filter-blog.js

document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.post-card');

    function filterCards(targetRegion) {
        let visibleCount = 0; 

        cards.forEach(card => {
            const cardRegion = card.getAttribute('data-region');

            if (targetRegion === 'semua') {
                if (visibleCount < 6) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none'; 
                }
            } else {
                if (cardRegion === targetRegion) {
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
            buttons.forEach(btn => {
                btn.classList.remove('bg-white', 'text-[#0B5F8D]');
                btn.classList.add('bg-white/20', 'text-white');
            });
            this.classList.remove('bg-white/20', 'text-white');
            this.classList.add('bg-white', 'text-[#0B5F8D]');

            const targetRegion = this.getAttribute('data-target');
            filterCards(targetRegion);
        });
    });
});