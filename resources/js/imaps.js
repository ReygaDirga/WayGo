document.addEventListener("DOMContentLoaded", () => {

    if (!document.getElementById("map")) return;

    navigator.geolocation.getCurrentPosition(

        (pos) => {

            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            console.log(lat, lng);

            const map = L.map("map").setView([lat, lng], 15);

            L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            ).addTo(map);

            L.marker([lat, lng])
                .addTo(map)
                .bindPopup("Lokasi kamu")
                .openPopup();

        },

        (err) => {
            console.log(err);
        },

        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );

});