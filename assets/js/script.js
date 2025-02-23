const scrollProgress = document.getElementById("scrollProgress")
const headerHamburger = document.getElementById("headerHamburger")
const headerLinks = document.getElementById("headerLinks")
const headerIcon = document.getElementById("headerIcon")
const headerLogin = document.getElementById("headerLogin")

window.onscroll = function () {
    updateProgressBar();
};

function updateProgressBar() {
    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;  // Position du scroll par rapport au haut de la page
    const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;  // Hauteur de la page
    scrollProgress.value = (scrollTop / scrollHeight) * 100;  // Pourcentage de la page scrollée
    scrollProgress.classList.toggle("visible", scrollTop > 10);  // Faire apparaître la barre de progression après un léger scroll
    headerLogin.classList.toggle("compact", scrollTop > 10);
}

headerHamburger.addEventListener("click", function () {
    headerIcon.innerText = headerLinks.classList.toggle("visible") ? "close" : "menu";
});