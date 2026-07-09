document.addEventListener("DOMContentLoaded", () => {

    const checkboxes =
        document.querySelectorAll(".sync-checkbox");

    checkboxes.forEach((box) => {

        box.addEventListener("change", () => {

            const group =
                box.dataset.group;

            document
                .querySelectorAll(
                    `[data-group="${group}"]`
                )

                .forEach((target) => {

                    target.checked =
                        box.checked;

                });

        });

    });

});

document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.grid-cardd .kard');

    const MAX_SELECTION = 3;

    function getSelectedCards() {
        return document.querySelectorAll('.grid-cardd .kard.selected');
    }

    function updateCards() {
        const selectedCards = getSelectedCards();

        const limitReached =
            selectedCards.length >= MAX_SELECTION;

        cards.forEach((card) => {
            const isSelected =
                card.classList.contains('selected');

            if (limitReached && !isSelected) {
                card.classList.add('disabled');
            } else {
                card.classList.remove('disabled');
            }
        });

        const selectedCategories = Array.from(selectedCards)
            .map((card) => card.dataset.category);

        const hiddenInput =
            document.getElementById('selectedCategories');

        if (hiddenInput) {
            hiddenInput.value = selectedCategories.join(',');
        }
    }

    cards.forEach((card) => {
        card.addEventListener('click', () => {
            const isSelected = card.classList.contains('selected');
            const selectedCount = getSelectedCards().length;

            if (card.classList.contains('disabled')) {
                return;
            }

            if (isSelected) {
                card.classList.remove('selected');

                updateCards();

                return;
            }

            if (selectedCount >= MAX_SELECTION) {
                return;
            }

            card.classList.add('selected');

            updateCards();
        });
    });

    updateCards();
});