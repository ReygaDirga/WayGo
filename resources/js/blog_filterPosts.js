document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = Array.from(document.querySelectorAll('.post-card')); 
    const paginationContainer = document.getElementById('pagination-controls');

    // AMBIL DATA TRANSLATION CUMA BUAT PREV & NEXT DARI HTML
    const textPrev = paginationContainer.getAttribute('data-text-prev') || 'Prev';
    const textNext = paginationContainer.getAttribute('data-text-next') || 'Next';

    const cardsPerPage = 6; 
    let currentPage = 1;
    let filteredCards = []; 

    function filterCards(targetRegion) {
        const target = targetRegion.toLowerCase().trim();
        filteredCards = []; 

        cards.forEach(card => {
            const rawRegion = card.getAttribute('data-region') || '';
            const cardRegion = rawRegion.toLowerCase().trim();

            if (target === 'semua' || cardRegion === target || cardRegion.includes(target) || target.includes(cardRegion)) {
                filteredCards.push(card);
            }
            card.style.display = 'none'; 
        });

        currentPage = 1;
        renderPage(currentPage);
        renderPagination();
    }

    function renderPage(page) {
        filteredCards.forEach(card => card.style.display = 'none');
        const startIndex = (page - 1) * cardsPerPage;
        const endIndex = startIndex + cardsPerPage;

        for (let i = startIndex; i < endIndex && i < filteredCards.length; i++) {
            filteredCards[i].style.display = 'block';
        }
    }

    function renderPagination() {
        paginationContainer.innerHTML = ''; 
        const totalPages = Math.ceil(filteredCards.length / cardsPerPage);

        if (totalPages <= 1) return; 

        // 1. Tombol Prev
        const prevContainer = document.createElement('div');
        prevContainer.className = 'w-24 flex justify-end pr-4'; 

        if (currentPage > 1) {
            const prevBtn = document.createElement('button');
            prevBtn.textContent = textPrev; // <-- Ngambil terjemahan dari Laravel
            prevBtn.className = 'hover:text-[#F59E0B] transition-colors text-sm md:text-base font-bold';
            prevBtn.addEventListener('click', () => {
                currentPage--;
                renderPage(currentPage);
                renderPagination(); 
            });
            prevContainer.appendChild(prevBtn);
        }
        paginationContainer.appendChild(prevContainer);

        // 2. Deretan Angka (Tetap standar 1, 2, 3)
        const numbersContainer = document.createElement('div');
        numbersContainer.className = 'flex justify-center items-center gap-4';

        for (let i = 1; i <= totalPages; i++) {
            const numBtn = document.createElement('button');
            numBtn.textContent = i; // <-- Balik lagi ke angka biasa
            
            if (i === currentPage) {
                numBtn.className = 'text-[#F59E0B] underline underline-offset-4 font-bold scale-110 transition-transform';
            } else {
                numBtn.className = 'hover:text-[#F59E0B] transition-colors';
            }

            numBtn.addEventListener('click', () => {
                currentPage = i;
                renderPage(currentPage);
                renderPagination();
            });

            numbersContainer.appendChild(numBtn);
        }
        paginationContainer.appendChild(numbersContainer);

        // 3. Tombol Next
        const nextContainer = document.createElement('div');
        nextContainer.className = 'w-24 flex justify-start pl-4';

        if (currentPage < totalPages) {
            const nextBtn = document.createElement('button');
            nextBtn.textContent = textNext; // <-- Ngambil terjemahan dari Laravel
            nextBtn.className = 'hover:text-[#F59E0B] transition-colors text-sm md:text-base font-bold';
            nextBtn.addEventListener('click', () => {
                currentPage++;
                renderPage(currentPage);
                renderPagination();
            });
            nextContainer.appendChild(nextBtn);
        }
        paginationContainer.appendChild(nextContainer);
    }

    filterCards('semua');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            buttons.forEach(btn => {
                btn.classList.remove('bg-[#1A365D]', 'text-white', 'shadow-md');
                btn.classList.add('bg-gray-100', 'text-[#1A365D]', 'hover:bg-[#1A365D]', 'hover:text-white');
            });
            this.classList.remove('bg-gray-100', 'text-[#1A365D]', 'hover:bg-[#1A365D]', 'hover:text-white');
            this.classList.add('bg-[#1A365D]', 'text-white', 'shadow-md');

            const targetRegion = this.getAttribute('data-target');
            filterCards(targetRegion);
        });
    });
});