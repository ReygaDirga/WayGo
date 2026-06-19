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