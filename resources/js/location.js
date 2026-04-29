const input = document.getElementById('locationSearch');
const results = document.getElementById('locationResults');

let timeout;
input.addEventListener('input', function () {
    clearTimeout(timeout);
    let query = this.value;
    if (query.length < 2) {
        results.classList.add('hidden');
        results.innerHTML = '';
        return;
    }
    timeout = setTimeout(() => {
        searchLocation(query);
    }, 400);
});
async function searchLocation(query) {
    try {
        const res = await fetch(
            `https://nominatim.openstreetmap.org/search?format=json&countrycodes=id&featuretype=city&q=${query}`
        );
        const data = await res.json();
        results.innerHTML = '';
        if (data.length === 0) {
            results.innerHTML = `
            <div class="p-3 text-gray-500">
            No results
            </div>
            `;
        }
        data.slice(0, 5).forEach(place => {
            let item = document.createElement('div');
            item.className =
                'p-3 hover:bg-gray-100 cursor-pointer';
            item.innerHTML = `
                <div class="font-medium">
                ${place.display_name}
                </div>
                `;
            item.addEventListener('click', () => {
                input.value = place.display_name;
                results.classList.add('hidden');
            });
            results.appendChild(item);
        });
        results.classList.remove('hidden');
    }
    catch (error) {
        console.log(error);
    }
}
document.addEventListener('click', function (e) {
    if (!input.contains(e.target) &&
        !results.contains(e.target)) {
        results.classList.add('hidden');
    }
});