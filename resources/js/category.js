document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("itineraryForm");
    const cards = document.querySelectorAll(".grid-cardd .kard");

    const MAX_SELECTION = 3;

    function getSelectedCards() {
        return document.querySelectorAll(".grid-cardd .kard.selected");
    }

    function updateCards() {

        const selectedCards = getSelectedCards();

        const limitReached = selectedCards.length >= MAX_SELECTION;

        cards.forEach(card => {

            const isSelected = card.classList.contains("selected");

            if (limitReached && !isSelected) {
                card.classList.add("disabled");
            } else {
                card.classList.remove("disabled");
            }

        });

        document.getElementById("categories").value =
            Array.from(selectedCards)
                .map(card => card.dataset.category)
                .join(",");
    }

    cards.forEach(card => {

        card.addEventListener("click", () => {

            if (card.classList.contains("disabled")) return;

            card.classList.toggle("selected");

            updateCards();

        });

    });

    if (form) {

        form.addEventListener("submit", function (e) {
            if (getSelectedCards().length === 0) {
                e.preventDefault();
                alert("Please select at least one category.");
                return;
            }

            document
                .getElementById("loadingOverlay")
                .classList.remove("hidden");

            requestAnimationFrame(() => {
                form.submit();
            });

            e.preventDefault();
        });

    }

    updateCards();

});