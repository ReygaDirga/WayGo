const modal = document.getElementById("detailModal");

document.querySelectorAll(".detail-btn").forEach(btn => {

    btn.addEventListener("click", () => {

        document.getElementById("modalName").innerText =
            btn.dataset.name;

        document.getElementById("modalAddress").innerText =
            btn.dataset.address;

        document.getElementById("modalCost").innerText =
            "Rp " + btn.dataset.cost;

        document.getElementById("modalDescription").innerText =
            btn.dataset.description;

        document.getElementById("modalRating").innerHTML =
            "⭐ " + btn.dataset.rating;

        document.getElementById("modalMap").href =
            btn.dataset.map;

        modal.classList.remove("hidden");
        modal.classList.add("flex");

    });

});

document.getElementById("closeModal")
.addEventListener("click", () => {

    modal.classList.remove("flex");
    modal.classList.add("hidden");

});