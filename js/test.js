const toggleButton = document.getElementById('toggleBtn')
const sidebar = document.getElementById('adminSidebar')
const adminHamburger = document.getElementById('adminHamburger')

function changeSidebar() {
    if (sidebar.classList.contains('mobile__visible')) {  // Si la sidebar est ouverte sur mobile
        sidebar.classList.remove('mobile__visible')
    } else {
        sidebar.classList.toggle('close')
        toggleButton.classList.toggle('rotate')
    }
}

function toggleSidebar() {
    sidebar.classList.toggle('mobile__visible')
}

document.addEventListener('click', function (event) {
    if (sidebar.classList.contains('mobile__visible') && !sidebar.contains(event.target) && !adminHamburger.contains(event.target)) {
        sidebar.classList.toggle('mobile__visible')
    }
})