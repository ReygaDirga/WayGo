document.querySelectorAll(".accordion-btn").forEach(button => {

    button.addEventListener("click", () => {

        const content = button.nextElementSibling;
        const arrow = button.querySelector(".arrow");

        content.classList.toggle("hidden");

        arrow.classList.toggle("rotate-180");

    });

});