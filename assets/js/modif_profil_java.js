document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const locationInput = document.getElementById('location');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const profilePictureContainer = document.querySelector('.profile-picture');
    const profilePicture = document.querySelector('.profile-picture img');
    const form = document.querySelector('.profile');


    // Fonction pour vérifier si un champ est vide
    function isEmpty(input) {
        return input.value.trim() === '';
    }

    // Fonction pour afficher un message d'erreur
    function showError(input, message) {
        const existingError = input.parentElement.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }

        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.textContent = message;
        errorElement.style.color = 'red';
        errorElement.style.fontSize = '12px';
        errorElement.style.marginTop = '5px';

        input.parentElement.appendChild(errorElement);
        input.classList.add('error');
        input.style.borderColor = 'red';
    }

    // Fonction pour supprimer un message d'erreur
    function removeError(input) {
        const existingError = input.parentElement.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        input.classList.remove('error');
        input.style.borderColor = '';
    }

    // Validation des mots de passe
    if (passwordInput && confirmPasswordInput) {
        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);
    }

    function validatePassword() {
        if (isEmpty(passwordInput)) {
            showError(passwordInput, 'Le mot de passe est obligatoire');
        } else if (passwordInput.value !== confirmPasswordInput.value) {
            showError(confirmPasswordInput, 'Les mots de passe ne correspondent pas');
        } else {
            removeError(passwordInput);
            removeError(confirmPasswordInput);
        }
    }

    // Fonction pour ouvrir le sélecteur de fichiers
    function openFilePicker() {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';

        fileInput.addEventListener('change', function(e) {
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    const img = new Image();
                    img.onload = function() {
                        profilePicture.src = event.target.result;

                        profilePicture.style.width = '100%';
                        profilePicture.style.height = '100%';
                        profilePicture.style.objectFit = 'cover';
                        profilePicture.style.borderRadius = '50%';


                    };
                    img.src = event.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        fileInput.click();
    }

    // Gestionnaire d'événements pour le clic sur l'image de profil
    if (profilePictureContainer) {
        profilePictureContainer.addEventListener('click', openFilePicker);

        const editIcon = document.querySelector('.edit-icon');
        if (editIcon) {
            editIcon.addEventListener('click', function(e) {
                e.stopPropagation();
                openFilePicker();
            });
        }
    }

    // Validation du nom
    if (nameInput) {
        nameInput.addEventListener('input', function() {
            if (isEmpty(nameInput)) {
                showError(nameInput, 'Le nom est obligatoire');
            } else {
                removeError(nameInput);
            }
        });
    }

    // Validation de l'e-mail
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            if (isEmpty(emailInput)) {
                showError(emailInput, 'L\'email est obligatoire');
            } else {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    showError(emailInput, 'Veuillez entrer un email valide');
                } else {
                    removeError(emailInput);
                }
            }
        });
    }

    // Validation de la localisation
    if (locationInput) {
        locationInput.addEventListener('input', function() {
            if (isEmpty(locationInput)) {
                showError(locationInput, 'La localisation est obligatoire');
            } else {
                removeError(locationInput);
            }
        });
    }

    // Création du bouton "mettre à jour le profil"
    const verifyButton = document.createElement('button');
    verifyButton.type = 'button';
    verifyButton.id = 'verify-email-button';
    verifyButton.textContent = 'Mettre à jour le profil';
    verifyButton.style.backgroundColor = '#FCB101';
    verifyButton.style.color = 'white';
    verifyButton.style.padding = '10px 15px';
    verifyButton.style.border = 'none';
    verifyButton.style.borderRadius = '5px';
    verifyButton.style.cursor = 'pointer';
    verifyButton.style.marginTop = '20px';

    // Ajout du bouton au formulaire
    if (form) {
        form.appendChild(verifyButton);
    }

    // Gestionnaire d'événements pour le bouton "mettre à jour le profil"
    verifyButton.addEventListener('click', function() {
        let isValid = true;

        // Validation du nom
        if (nameInput && isEmpty(nameInput)) {
            showError(nameInput, 'Le nom est obligatoire');
            isValid = false;
        }

        // Validation de l'e-mail
        if (emailInput && isEmpty(emailInput)) {
            showError(emailInput, 'L\'email est obligatoire');
            isValid = false;
        } else if (emailInput && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
            showError(emailInput, 'Veuillez entrer un email valide');
            isValid = false;
        }

        // Validation de la localisation
        if (locationInput && isEmpty(locationInput)) {
            showError(locationInput, 'La localisation est obligatoire');
            isValid = false;
        }

        // Validation du mot de passe
        if (passwordInput && isEmpty(passwordInput)) {
            showError(passwordInput, 'Le mot de passe est obligatoire');
            isValid = false;
        } else if (passwordInput && confirmPasswordInput && passwordInput.value !== confirmPasswordInput.value) {
            showError(confirmPasswordInput, 'Les mots de passe ne correspondent pas');
            isValid = false;
        }

        // Si tout est valide, mettre à jour le profil
        if (isValid) {

            // Afficher un message de succès
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.textContent = 'Profil mis à jour avec succès';
            successMessage.style.backgroundColor = '#4CAF50';
            successMessage.style.color = 'white';
            successMessage.style.padding = '10px';
            successMessage.style.borderRadius = '5px';
            successMessage.style.marginTop = '15px';
            successMessage.style.textAlign = 'center';
            form.appendChild(successMessage);

            setTimeout(function() {
                successMessage.remove();
            }, 3000);
        }
    });
});