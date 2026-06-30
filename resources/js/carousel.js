const sliderData = [
    {
        title: "Monas",
        description: window.lang.demonas,
        image: "./assets/monas.png"
    },
    {
        title: "Taman Ayun Temple",
        description: window.lang.taman,
        image: "./assets/Meru.png"
    },
    {
        title: "Prambanan Temple",
        description: window.lang.prambanan,
        image: "./assets/Prambanan.png"
    },
    {
        title: "Mount Bromo",
        description: window.lang.bromo,
        image: "./assets/bromo.png"
    },
    {
        title: "Raja Ampat Islands",
        description: window.lang.raja,
        image: "./assets/rajaampat.png"
    },
    {
        title: "Lake Toba",
        description: window.lang.toba,
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