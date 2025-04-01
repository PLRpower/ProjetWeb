const container = document.querySelector('.login__container');
const formLogin = document.querySelector('#formLogin');

formLogin.addEventListener('submit', (e) => {
    e.preventDefault();

    fetch("/login", {
        method: "POST",
        body: new FormData(formLogin)
    })
        .then(response => response.text())  // Change json() par text() pour voir ce qui est renvoyé
        .then(data => {
            console.log("Réponse brute :", data);
            try {
                const jsonData = JSON.parse(data);
                if (jsonData.success) {
                    container.classList.add('active');
                    setTimeout(() => window.location.href = "/accueil", 2000);
                } else {
                    document.querySelector("#error-message").textContent = jsonData.message;
                }
            } catch (error) {
                console.error("Erreur lors du parsing JSON :", error);
            }
        })
        .catch(error => console.error("Erreur fetch :", error));

});