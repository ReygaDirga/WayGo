// Avatar preview
document.getElementById('avatarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatarPreview');
            const initial = document.getElementById('avatarInitial');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (initial) initial.classList.add('hidden');
        }
        reader.readAsDataURL(file);
    }
});

// Flatpickr date picker
flatpickr('#dob', {
    dateFormat: 'Y-m-d',
    altInput: true,
    altFormat: 'd F, Y',
    maxDate: 'today',
});

//Travel Category
document.querySelectorAll('.category-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const span = this.nextElementSibling;
        const bg = this.dataset.bg;
        const text = this.dataset.text;

        // Cek jumlah yang ter-checked
        const checkedCount = document.querySelectorAll('.category-checkbox:checked').length;

        // Kalau mau check tapi sudah 3, batalkan
        if (this.checked && checkedCount > 3) {
            this.checked = false;
            return;
        }

        if (this.checked) {
            span.className = span.className
                .replace('bg-gray-50', bg)
                .replace('text-gray-400', text)
                .replace('border-gray-200', 'border-current');
        } else {
            span.className = span.className
                .replace(bg, 'bg-gray-50')
                .replace(text, 'text-gray-400')
                .replace('border-current', 'border-gray-200');
        }
    });
});


//Travel Budget
document.querySelectorAll('.budget-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.budget-radio').forEach(r => {
            const span = r.nextElementSibling;
            if (r.checked) {
                span.className = span.className
                    .replace('bg-gray-50', r.dataset.bg)
                    .replace('text-gray-500', r.dataset.text)
                    .replace('border-gray-200', r.dataset.border);
            } else {
                span.className = span.className
                    .replace(r.dataset.bg, 'bg-gray-50')
                    .replace(r.dataset.text, 'text-gray-500')
                    .replace(r.dataset.border, 'border-gray-200');
            }
        });
    });
});