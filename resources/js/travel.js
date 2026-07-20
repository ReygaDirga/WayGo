let adults = parseInt(document.getElementById('adultCount').innerText) || 0;
let kids = parseInt(document.getElementById('kidCount').innerText) || 0;

const popup = document.getElementById('travelerPopup');

document
    .getElementById('travelerBtn')
    .addEventListener('click', function () {

        popup.classList.toggle('hidden');

    });

document
    .getElementById('adultPlus')
    .addEventListener('click', function () {

        adults++;
        updateGuests();

    });

document
    .getElementById('adultMinus')
    .addEventListener('click', function () {

        if (adults > 0) {
            adults--;
            updateGuests();
        }

    });

document
    .getElementById('kidPlus')
    .addEventListener('click', function () {

        kids++;
        updateGuests();

    });

document
    .getElementById('kidMinus')
    .addEventListener('click', function () {

        if (kids > 0) {
            kids--;
            updateGuests();
        }

    });

function updateGuests() {

    document.getElementById('adultNumber').innerText = adults;
    document.getElementById('kidNumber').innerText = kids;

    document.getElementById('adultCount').innerText = adults;
    document.getElementById('kidCount').innerText = kids;

    document.getElementById('adultInput').value = adults;
    document.getElementById('kidInput').value = kids;
}

document.addEventListener('click', function (e) {

    if (
        !document
            .getElementById('travelerBtn')
            .contains(e.target)

        &&

        !popup.contains(e.target)
    ) {
        popup.classList.add('hidden');
    }

});

updateGuests();