document.addEventListener("DOMContentLoaded", function() {
    // Check if we are on the registration page before applying validation
    if (document.querySelector('form[action*="register"]')) {
        // REGISTRO DE VARIABLES GLOBALES
        const tipoPersona = document.getElementById('tipo_persona');
        const rfcInput = document.getElementById('rfc');
        const razonSocialInput = document.getElementById('razon_social');
        const nameInput = document.getElementById('name');
        const firstLastnameInput = document.getElementById('first_lastname');
        const secondLastnameInput = document.getElementById('second_lastname');
        const emailInput = document.getElementById('email');
        const emailConfirmationInput = document.getElementById('email_confirmation_input');
        const nextButton = document.getElementById('next-button');
        const nameRegex = /^[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]*$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let emailTimeoutId = null;

        if (emailConfirmationInput) {
            emailConfirmationInput.disabled = true;
        }

        // VALIDATE EMAIL
        function validateEmail(input) {
            const emailValue = input.value.trim();
            if (emailValue === '') {
                showErrorMessage(input, 'El correo electrónico es obligatorio');
                return false;
            } else if (!emailValue.includes('@')) {
                showErrorMessage(input, 'Falta el símbolo "@" en el correo electrónico');
                return false;
            } else if (!emailValue.split('@')[1] || !emailValue.split('@')[1].includes('.')) {
                showErrorMessage(input, 'Falta el dominio en el correo electrónico');
                return false;
            } else if (!emailRegex.test(emailValue)) {
                showErrorMessage(input, 'El correo electrónico no tiene un formato válido');
                return false;
            } else {
                removeErrorMessage(input);
                return true;
            }
        }

        // VALIDATE NAME LENGTH AND FORMAT
        function validateName(input, minLength, maxLength) {
            const nameValue = input.value.trim();
            if (nameValue.length < minLength) {
                showErrorMessage(input, `Debe tener al menos ${minLength} caracteres`);
                return false;
            } else if (nameValue.length > maxLength) {
                showErrorMessage(input, `No puede exceder los ${maxLength} caracteres`);
                return false;
            } else if (!nameRegex.test(nameValue)) {
                showErrorMessage(input, 'Solo se permiten letras y espacios');
                return false;
            } else {
                removeErrorMessage(input);
                return true;
            }
        }

        // SHOW ERROR MESSAGE
        function showErrorMessage(input, message) {
            let errorDiv = input.parentElement.querySelector('.error-message');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-danger mt-1';
                input.parentElement.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }

        // REMOVE ERROR MESSAGE
        function removeErrorMessage(input) {
            const errorDiv = input.parentElement.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
        }

        // CHECK IF EMAILS MATCH
        function checkEmailsMatch() {
            if (emailInput && emailConfirmationInput && emailConfirmationInput.value.trim() !== '') {
                const email = emailInput.value.trim();
                const emailConfirmation = emailConfirmationInput.value.trim();
                
                if (email !== emailConfirmation) {
                    showErrorMessage(emailConfirmationInput, 'Los correos electrónicos no coinciden');
                    return false;
                } else {
                    removeErrorMessage(emailConfirmationInput);
                    return true;
                }
            }
            return true;
        }

        // CHECK REQUIRED FIELDS
        function checkRequiredFields() {
            const name = nameInput.value.trim();
            const firstLastname = firstLastnameInput.value.trim();
            const email = emailInput ? emailInput.value.trim() : '';
            const emailConfirmation = emailConfirmationInput ? emailConfirmationInput.value.trim() : '';

            const hasName = name.length >= 2;
            const hasFirstLastname = firstLastname.length >= 2;
            const hasEmail = email !== '';
            const hasEmailConfirmation = emailConfirmation !== '' && emailConfirmationInput;
            const emailsMatch = email === emailConfirmation;

            if (hasName && hasFirstLastname && hasEmail && hasEmailConfirmation && emailsMatch) {
                nextButton.disabled = false;
            } else {
                nextButton.disabled = true;
            }
        }

        // Función para verificar si el correo existe en la BD
        function checkEmailExists(email) {
            fetch(`/check-email?email=${encodeURIComponent(email)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        showErrorMessage(emailInput, 'Este correo electrónico ya está registrado');
                        
                        // Deshabilitar el campo de confirmación y el botón si el correo ya existe
                        if (emailConfirmationInput) {
                            emailConfirmationInput.disabled = true;
                        }
                        if (nextButton) {
                            nextButton.disabled = true;
                        }
                    } else {
                        // Solo remover el mensaje de error de existencia, mantener otros errores si los hay
                        const errorDiv = emailInput.parentElement.querySelector('.error-message');
                        if (errorDiv && errorDiv.textContent === 'Este correo electrónico ya está registrado') {
                            removeErrorMessage(emailInput);
                        }
                        
                        // Habilitar el campo de confirmación si el correo es válido y no existe
                        if (emailConfirmationInput) {
                            emailConfirmationInput.disabled = false;
                        }
                        
                        // Verificar otros campos para habilitar/deshabilitar el botón
                        checkRequiredFields();
                    }
                })
                .catch(error => {
                    console.error('Error al verificar el correo:', error);
                });
        }

        // Añadir validación en tiempo real para verificar si el correo ya existe
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                // Validación básica de formato
                const isValid = validateEmail(this);
                
                // Si el correo tiene formato válido, verificar si existe en la BD
                if (isValid) {
                    clearTimeout(emailTimeoutId);
                    // Esperar a que el usuario termine de escribir (debounce)
                    emailTimeoutId = setTimeout(function() {
                        checkEmailExists(emailInput.value);
                    }, 500);
                }
                
                // Actualizar estado del campo de confirmación
                if (emailConfirmationInput) {
                    emailConfirmationInput.disabled = !isValid;
                    if (emailConfirmationInput.value.trim() !== '') {
                        checkEmailsMatch();
                    }
                }
                
                checkRequiredFields();
            });
        }

        if (emailConfirmationInput) {
            emailConfirmationInput.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    validateEmail(this);
                    checkEmailsMatch();
                } else {
                    removeErrorMessage(this);
                }
                checkRequiredFields();
            });
        }

        if (nameInput) {
            nameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
                validateName(this, 2, 60);
                checkRequiredFields();
            });
        }

        if (firstLastnameInput) {
            firstLastnameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
                validateName(this, 2, 50);
                checkRequiredFields();
            });
        }

        if (secondLastnameInput) {
            secondLastnameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
                validateName(this, 2, 50);
                checkRequiredFields();
            });
        }
    }
});