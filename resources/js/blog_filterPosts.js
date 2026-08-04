document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = Array.from(document.querySelectorAll('.post-card')); 
    const paginationContainer = document.getElementById('pagination-controls');
    const searchInput = document.getElementById('search-input');

    const textPrev = paginationContainer.getAttribute('data-text-prev') || 'Prev';
    const textNext = paginationContainer.getAttribute('data-text-next') || 'Next';

    const cardsPerPage = 6; 
    let currentPage = 1;
    let filteredCards = []; 

    let activeRegion = 'semua';
    let searchQuery = '';

    function applyFilters() {
        filteredCards = []; 

        cards.forEach(card => {
            const rawRegion = card.getAttribute('data-region') || '';
            const cardRegion = rawRegion.toLowerCase().trim();

            const rawLocation = card.getAttribute('data-location') || '';
            const cardLocation = rawLocation.toLowerCase().trim();

            const rawTitle = card.getAttribute('data-title') || '';
            const cardTitle = rawTitle.toLowerCase().trim();

            const matchRegion = (activeRegion === 'semua' || cardRegion === activeRegion.toLowerCase() || cardRegion.includes(activeRegion.toLowerCase()));

            const matchSearch = cardLocation.includes(searchQuery) || cardTitle.includes(searchQuery);

            if (matchRegion && matchSearch) {
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

        const prevContainer = document.createElement('div');
        prevContainer.className = 'w-24 flex justify-end pr-4'; 

        if (currentPage > 1) {
            const prevBtn = document.createElement('button');
            prevBtn.textContent = textPrev; 
            prevBtn.className = 'hover:text-[#F59E0B] transition-colors text-sm md:text-base font-bold';
            prevBtn.addEventListener('click', () => {
                currentPage--;
                renderPage(currentPage);
                renderPagination(); 
            });
            prevContainer.appendChild(prevBtn);
        }
        paginationContainer.appendChild(prevContainer);

        const numbersContainer = document.createElement('div');
        numbersContainer.className = 'flex justify-center items-center gap-4';

        for (let i = 1; i <= totalPages; i++) {
            const numBtn = document.createElement('button');
            numBtn.textContent = i;
            
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

        const nextContainer = document.createElement('div');
        nextContainer.className = 'w-24 flex justify-start pl-4';

        if (currentPage < totalPages) {
            const nextBtn = document.createElement('button');
            nextBtn.textContent = textNext; 
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

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value.toLowerCase().trim();
            applyFilters();
        });
    }

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            buttons.forEach(btn => {
                btn.classList.remove('bg-[#1A365D]', 'text-white', 'shadow-md');
                btn.classList.add('bg-gray-100', 'text-[#1A365D]', 'hover:bg-[#1A365D]', 'hover:text-white');
            });
            this.classList.remove('bg-gray-100', 'text-[#1A365D]', 'hover:bg-[#1A365D]', 'hover:text-white');
            this.classList.add('bg-[#1A365D]', 'text-white', 'shadow-md');

            activeRegion = this.getAttribute('data-target');
            applyFilters();
        });
    });

    applyFilters();
});