const container = document.querySelector('.login__container');
const formLogin = document.querySelector('#formLogin');

formLogin.addEventListener('submit', (e) => {
    e.preventDefault();
    container.classList.add('active');
});