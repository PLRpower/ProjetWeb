const container = document.querySelector('.login__container');
const loginError = document.querySelector('#loginError');
const formLogin = document.querySelector('#formLogin');

formLogin.addEventListener('submit', async (e) => {
    e.preventDefault();
    const response = await fetch("/connexion", {
        method: "POST",
        body: new FormData(formLogin),
    });

    const jsonData = await response.json();
    if (jsonData.success) {
        container.classList.add('active');
        setTimeout(() => (window.location.href = "/dashboard"), 1500);
    } else {
        loginError.textContent = jsonData.message;
    }
});