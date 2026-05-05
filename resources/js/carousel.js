const sliderData = [
    {
        title: "Monas",
        description: "Monas stands as a proud symbol of Indonesia’s independence, featuring iconic architecture, panoramic city views, and a rich historical museum that reflects the nation’s journey and spirit.",
        image: "./assets/monas.png"
    },
    {
        title: "Taman Ayun Temple",
        description: "Taman Ayun Temple offers serene gardens, traditional Balinese architecture, and peaceful surroundings, reflecting the harmony between nature, culture, and spirituality.",
        image: "./assets/Meru.png"
    },
    {
        title: "Prambanan Temple",
        description: "Candi Prambanan showcases majestic Hindu architecture, intricate stone carvings, and timeless legends, offering a breathtaking glimpse into Indonesia’s rich cultural and historical heritage.",
        image: "./assets/Prambanan.png"
    },
    {
        title: "Mount Bromo",
        description: "Mount Bromo captivates visitors with its dramatic volcanic landscapes, mystical sunrise views, and vast sea of sand, creating an unforgettable adventure in the heart of nature.",
        image: "./assets/bromo.png"
    },
    {
        title: "Raja Ampat Islands",
        description: "Raja Ampat enchants travelers with its crystal-clear waters, vibrant marine biodiversity, and untouched island beauty, making it a paradise for divers and nature lovers.",
        image: "./assets/rajaampat.png"
    },
    {
        title: "Lake Toba",
        description: "Lake Toba amazes visitors with its vast volcanic lake, scenic highland views, and unique Batak culture, creating a tranquil escape rich in history and natural beauty.",
        image: "./assets/toba.png"
    }
];

let sliderList = document.querySelector('.image-slider .list');
let nextBtn = document.querySelector('.next');
let prevBtn = document.querySelector('.prev');

let progress = document.querySelector('.progress');

function updateStepper() {
    let stepHeight = 40 + 30;

    progress.innerText = index + 1;

    progress.style.transform = `translateY(${index * stepHeight}px)`;
}

let index = 0;

sliderData.forEach(item => {
    let slide = document.createElement('div');
    slide.classList.add('item');
    slide.innerHTML = `<img src="${item.image}">`;
    sliderList.appendChild(slide);
});

let items = document.querySelectorAll('.image-slider .list .item');

function updateText() {
    document.querySelector('.text-content .title').innerText =
        sliderData[index].title;

    document.querySelector('.text-content .description').innerText =
        sliderData[index].description;
}

function updateSlider() {
    const item = items[0];
    const style = getComputedStyle(sliderList);
    const gap = parseInt(style.gap) || 20;

    let itemWidth = item.offsetWidth + gap;
    let offset = -index * itemWidth;

    sliderList.style.transform = `translateX(${offset}px)`;

    items.forEach(item => item.classList.remove('active'));
    if (items[index]) items[index].classList.add('active');

    updateStepper();
    updateText();
}

nextBtn.onclick = () => {
    index = (index + 1) % sliderData.length;
    updateSlider();
};

prevBtn.onclick = () => {
    index = (index - 1 + sliderData.length) % sliderData.length;
    updateSlider();
};

updateSlider();