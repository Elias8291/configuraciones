document.addEventListener("DOMContentLoaded", function() {
    let tipoPersona = document.getElementById('tipo_persona');
    let rfcInput = document.getElementById('rfc');
    if (tipoPersona && rfcInput) {
        tipoPersona.addEventListener('change', function() {
            if (this.value === 'fisica') {
                rfcInput.setAttribute('maxlength', '13');
                rfcInput.placeholder = 'Ejemplo: ABCD123456XYZ';
            } else {
                rfcInput.setAttribute('maxlength', '12');
                rfcInput.placeholder = 'Ejemplo: ABC123456XYZ';
            }
        });
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

    function checkRequiredFields() {
        const name = nameInput.value.trim();
        const firstLastname = firstLastnameInput.value.trim();
        const email = emailInput ? emailInput.value.trim() : '';
        const emailConfirmation = emailConfirmationInput ? emailConfirmationInput.value.trim() : '';

        const hasName = name.length >= 2;
        const hasFirstLastname = firstLastname.length >= 2;
        const hasEmail = email !== '';
        const emailsMatch = email === emailConfirmation || emailConfirmation === '';

        if (hasName && hasFirstLastname && hasEmail && emailsMatch) {
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

    function showErrorMessage(input, message) {
        let errorDiv = input.parentElement.querySelector('.error-message');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-danger mt-1';
            input.parentElement.appendChild(errorDiv);
        }
        errorDiv.textContent = message;
    }

    function removeErrorMessage(input) {
        const errorDiv = input.parentElement.querySelector('.error-message');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        let hasErrors = false;
        
        if (!validateName(nameInput, 2, 60)) hasErrors = true;
        if (!validateName(firstLastnameInput, 2, 50)) hasErrors = true;
        if (!validateName(secondLastnameInput, 2, 50)) hasErrors = true;

        if (emailInput && !validateEmail(emailInput)) hasErrors = true;
        if (emailConfirmationInput && emailConfirmationInput.value.trim() !== '' && !validateEmail(emailConfirmationInput)) hasErrors = true;
        if (emailInput && emailConfirmationInput && emailInput.value !== emailConfirmationInput.value) {
            hasErrors = true;
            showErrorMessage(emailConfirmationInput, 'Los correos electrónicos no coinciden');
        }

        if (hasErrors) {
            e.preventDefault();
        }
    });

    if (document.getElementById('next-button')) {
        document.getElementById('next-button').addEventListener('click', function() {
            document.getElementById('section-1').style.display = 'none';
            document.getElementById('section-2').style.display = 'block';
        });
    }
    
    if (document.getElementById('prev-button')) {
        document.getElementById('prev-button').addEventListener('click', function() {
            document.getElementById('section-2').style.display = 'none';
            document.getElementById('section-1').style.display = 'block';
        });
    }
});
