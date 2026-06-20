document.addEventListener('DOMContentLoaded', function() {
    
    // === 1. FLATPICKR JAM (BORDER JADI OREN) ===
    const timeWrapper = document.getElementById('best-time-wrapper');
    if (timeWrapper) {
        flatpickr(".timepicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            onOpen: function() {
                timeWrapper.classList.remove('border-gray-400');
                timeWrapper.classList.add('border-orange-500');
            },
            onClose: function() {
                timeWrapper.classList.remove('border-orange-500');
                timeWrapper.classList.add('border-gray-400');
            }
        });
    }

    // === 2. AUTOSAVE INDICATOR ===
    const indicator = document.getElementById('autosave-indicator');
    const textElement = document.getElementById('autosave-text');
    const checkIcon = document.getElementById('autosave-icon');
    const formInputs = document.querySelectorAll('input, textarea');
    
    let typingTimer;
    const doneTypingInterval = 1000; // Tunggu 1 detik setelah berhenti ngetik

    if (indicator) {
        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                // Pas lagi ngetik: Munculin teks, set jadi abu-abu "Saving..."
                indicator.classList.remove('hidden');
                indicator.classList.replace('text-green-600', 'text-gray-500');
                checkIcon.classList.add('hidden');
                textElement.innerText = 'Saving...';

                clearTimeout(typingTimer);

                // Kalo udah berhenti ngetik selama 1 detik: Ubah jadi hijau "Auto-saved"
                typingTimer = setTimeout(() => {
                    indicator.classList.replace('text-gray-500', 'text-green-600');
                    checkIcon.classList.remove('hidden');
                    textElement.innerText = 'Auto-saved a few seconds ago';
                }, doneTypingInterval);
            });
        });
    }
});

// === 3. PREVIEW IMAGE (MODIFIKASI VITE) ===
// Harus pakai 'window.' supaya tag HTML onchange="previewImage(event)" bisa nemuin fungsinya
window.previewImage = function(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('upload-placeholder');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
};