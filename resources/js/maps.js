const popup = document.getElementById("popup");
const title = document.getElementById("popup-title");
const desc = document.getElementById("popup-desc");
const tooltip = document.getElementById("tooltip");
const img = document.getElementById("popup-img");

let isHoveringPopup = false;
let isHoveringState = false;

document.querySelectorAll("svg path").forEach(state => {
    state.addEventListener("click", (e) => {
        e.stopPropagation();

        const name = state.getAttribute("data-name");
        const description = state.getAttribute("data-desc");
        const image = state.getAttribute("data-img");

        title.textContent = name;
        desc.textContent = description;

        popup.classList.remove("hidden");

        let x = e.pageX + 10;
        let y = e.pageY + 10;

        const popupWidth = popup.offsetWidth;
        const popupHeight = popup.offsetHeight;

        if (x + popupWidth > window.innerWidth) {
            x = e.pageX - popupWidth - 10;
        }

        if (y + popupHeight > window.innerHeight) {
            y = e.pageY - popupHeight - 10;
        }

        if (image) {
            img.src = image;
            img.style.display = "block";
        } else {
            img.style.display = "none";
        }

        popup.style.left = x + "px";
        popup.style.top = y + "px";
    });

    state.addEventListener("mouseenter", () => {
        isHoveringState = true;
    });

    state.addEventListener("mouseleave", () => {
        isHoveringState = false;
        checkHide();
    });
});

popup.addEventListener("mouseenter", () => {
    isHoveringPopup = true;
});

popup.addEventListener("mouseleave", () => {
    isHoveringPopup = false;
    checkHide();
});

function checkHide() {
    setTimeout(() => {
        if (!isHoveringPopup && !isHoveringState) {
            popup.classList.add("hidden");
        }
    }, 100);
}

document.querySelectorAll("svg path").forEach(state => {

    state.addEventListener("mouseenter", (e) => {
        const name = state.getAttribute("data-name");

        tooltip.textContent = name;
        tooltip.classList.remove("hidden");
    });

    state.addEventListener("mousemove", (e) => {
        tooltip.style.left = e.pageX + 10 + "px";
        tooltip.style.top = e.pageY + 10 + "px";
    });

    state.addEventListener("mouseleave", () => {
        tooltip.classList.add("hidden");
    });

});