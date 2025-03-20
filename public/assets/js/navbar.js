// Toutes les views (header)

const scrollProgress = document.getElementById("scrollProgress")
const headerHamburger = document.getElementById("headerHamburger")
const headerLinks = document.getElementById("headerLinks")
const headerIcon = document.getElementById("headerIcon")
const headerLogin = document.getElementById("headerLogin")

document.addEventListener("DOMContentLoaded", function () {
    window.onscroll = function () {
        updateProgressBar();
    };
});

function updateProgressBar() {
    const maxHeight = document.documentElement.scrollHeight - window.innerHeight;
    const currentScroll = window.scrollY;
    console.log(document.documentElement.scrollHeight);
    const progress = (currentScroll / maxHeight) * 100;

    scrollProgress.value = progress;  // Pourcentage de la page scrollée
    scrollProgress.classList.toggle("visible", currentScroll > 10);  // Faire apparaître la barre de progression après un léger scroll
    headerLogin.classList.toggle("compact", currentScroll > 10);
}

headerHamburger.addEventListener("click", function () {
    headerIcon.innerText = headerLinks.classList.toggle("visible") ? "close" : "menu";
});