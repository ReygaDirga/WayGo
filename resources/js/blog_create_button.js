document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.getElementById('floating-wrapper');
    const footer = document.querySelector('footer'); 
    
    if (!wrapper || !footer) return;

    let ticking = false;

    function updateButtonPosition() {
        const footerRect = footer.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        if (footerRect.top < windowHeight) {
            const overlap = windowHeight - footerRect.top;
            let pushUp = overlap - 15; 
            if (pushUp < 0) pushUp = 0; 
            
            wrapper.style.transform = `translateY(-${pushUp}px)`;
        } else {
            wrapper.style.transform = 'translateY(0)';
        }
        ticking = false;
    }

    document.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(updateButtonPosition);
            ticking = true;
        }
    });
});