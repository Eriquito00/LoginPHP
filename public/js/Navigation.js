const button = document.getElementById("btn_navigation");
const navigation = document.getElementById("navigation");
const main = document.getElementById("main_content");

let navManuallyHidden = false;
let lastWidth = window.innerWidth;

function handleResize() {
    const width = window.innerWidth;
    if (width <= 850) {
        navigation.classList.add("nav_disabled");
        main.classList.add("main_nav_disabled");
        navigation.classList.add("nav_enabled_big");
        navManuallyHidden = false;
    } else {
        navigation.classList.remove("nav_enabled_big");
        if (!navManuallyHidden) {
            navigation.classList.remove("nav_disabled");
            main.classList.remove("main_nav_disabled");
            navigation.classList.remove("nav_enabled_big");
        }
    }
    lastWidth = width;
}

function updateButtonIcon() {
    button.style.backgroundImage = navigation.classList.contains("nav_disabled")
    ? button.style.backgroundImage = 'url("./assets/nav_en.png")'
    : button.style.backgroundImage = 'url("./assets/nav_dis.png")';
}

button.addEventListener("click", () => {
    if (window.innerWidth <= 850) {
        navigation.classList.toggle("nav_disabled");
        navigation.classList.add("nav_enabled_big");
    } else {
        navigation.classList.toggle("nav_disabled");
        main.classList.toggle("main_nav_disabled");
        navManuallyHidden = navigation.classList.contains("nav_disabled");
    }
    updateButtonIcon();
});

window.addEventListener("resize", () => {
    handleResize();
    updateButtonIcon();
});

window.addEventListener("DOMContentLoaded", () => {
    handleResize();
    updateButtonIcon();
});