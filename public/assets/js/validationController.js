document.addEventListener("DOMContentLoaded", function() {
    // Check if we are on the registration page before applying validation
    if (document.querySelector('form[action*="register"]')) {
        // REGISTRATION FORM CODE
        let tipoPersona = document.getElementById('tipo_persona');
        let rfcInput = document.getElementById('rfc');
        let razonSocialInput = document.getElementById('razon_social');

        if (tipoPersona && rfcInput && razonSocialInput) {
            tipoPersona.addEventListener('change', function() {
                // Clear fields when changing person type
                rfcInput.value = '';
                razonSocialInput.value = '';

                if (this.value === 'fisica') {
                    rfcInput.setAttribute('maxlength', '13');
                    rfcInput.placeholder = 'Ejemplo: ABCD123456XYZ';

                    // Apply restriction on business name (only letters and spaces)
                    razonSocialInput.setAttribute('placeholder', 'Ingresa solo letras y espacios');
                    razonSocialInput.addEventListener('input', validarRazonSocial);
                } else {
                    rfcInput.setAttribute('maxlength', '12');
                    rfcInput.placeholder = 'Ejemplo: ABC123456XYZ';

                    // Remove restriction on business name
                    razonSocialInput.setAttribute('placeholder', 'Razón social');
                    razonSocialInput.removeEventListener('input', validarRazonSocial);
                }
            });
        }

        // VALIDATE BUSINESS NAME
        function validarRazonSocial() {
            this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
        }

        const nameInput = document.getElementById('name');
        const firstLastnameInput = document.getElementById('first_lastname');
        const secondLastnameInput = document.getElementById('second_lastname');
        const nameRegex = /^[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]*$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const emailInput = document.getElementById('email');
        const emailConfirmationInput = document.getElementById('email_confirmation');
        const nextButton = document.getElementById('next-button');

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

        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const isValid = validateEmail(this);
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

        // Apply events only to registration form
        const registerForm = document.querySelector('form[action*="register"]');
        
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                let hasErrors = false;
                
                if (!validateName(nameInput, 2, 60)) hasErrors = true;
                if (!validateName(firstLastnameInput, 2, 50)) hasErrors = true;
                if (secondLastnameInput && secondLastnameInput.value.trim() !== '' && !validateName(secondLastnameInput, 2, 50)) hasErrors = true;

                if (emailInput && !validateEmail(emailInput)) hasErrors = true;
                if (emailConfirmationInput && emailConfirmationInput.value.trim() === '') {
                    hasErrors = true;
                    showErrorMessage(emailConfirmationInput, 'La confirmación de correo electrónico es obligatoria');
                } else if (emailConfirmationInput && !validateEmail(emailConfirmationInput)) hasErrors = true;
                if (emailInput && emailConfirmationInput && emailInput.value !== emailConfirmationInput.value) {
                    hasErrors = true;
                    showErrorMessage(emailConfirmationInput, 'Los correos electrónicos no coinciden');
                }

                if (hasErrors) {
                    e.preventDefault();
                }
            });

            // NEXT BUTTON
            if (document.getElementById('next-button')) {
                document.getElementById('next-button').addEventListener('click', function() {
                    document.getElementById('section-1').style.display = 'none';
                    document.getElementById('section-2').style.display = 'block';
                });
            }
            
            // PREV BUTTON
            if (document.getElementById('prev-button')) {
                document.getElementById('prev-button').addEventListener('click', function() {
                    document.getElementById('section-2').style.display = 'none';
                    document.getElementById('section-1').style.display = 'block';
                });
            }
        }
    }

    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        const togglePassword = loginForm.querySelector('.toggle-password');
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const passwordInput = loginForm.querySelector('#password');
                if (passwordInput) {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.querySelector('i').classList.remove('fa-eye');
                        this.querySelector('i').classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        this.querySelector('i').classList.remove('fa-eye-slash');
                        this.querySelector('i').classList.add('fa-eye');
                    }
                }
            });
        }
    }
});
