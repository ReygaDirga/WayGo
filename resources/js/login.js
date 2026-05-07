document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.querySelector('.login-form');
    const submitBtn = document.querySelector('.submit-btn');

    if (loginForm && submitBtn) {
        loginForm.addEventListener('submit', function (e) {
            // 1. TAHAN form agar tidak langsung terkirim
            e.preventDefault(); 
            
            // 2. Ubah tampilan tombol jadi loading
            submitBtn.classList.add('is-loading');
            submitBtn.innerHTML = `
                <svg class="spinner" viewBox="0 0 50 50">
                    <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                </svg>
                <span>Logging in...</span>
            `;

            // 3. Buat jeda waktu (misal: 2000 ms = 2 detik)
            setTimeout(() => {
                // Setelah 2 detik, paksa form untuk submit ke Laravel
                loginForm.submit(); 
            }, 2000);
        });
    }

    // Fitur toggle show/hide password (mata)
    const togglePass = document.getElementById('togglePass');
    const passwordInput = document.getElementById('password');

    if (togglePass && passwordInput) {
        togglePass.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    }
});