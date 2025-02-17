document.addEventListener("DOMContentLoaded", function() {
    // "Next" button - Shows the second section
    let nextButton = document.getElementById('next-button');
    if (nextButton) {
        nextButton.addEventListener('click', function() {
            document.getElementById('section-1').style.display = 'none';
            document.getElementById('section-2').style.display = 'block';
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        });
    }

    // "Previous" button - Returns to the first section
    let prevButton = document.getElementById('prev-button');
    if (prevButton) {
        prevButton.addEventListener('click', function() {
            document.getElementById('section-2').style.display = 'none';
            document.getElementById('section-1').style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // RFC field adjustment based on "Tipo de Persona"
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

    // Reset the registration form when switching to "Login"
    let loginTab = document.getElementById('login-tab');
    let registerForm = document.querySelector('#registerForm form');
    if (loginTab && registerForm) {
        loginTab.addEventListener("click", function() {
            registerForm.reset();
            document.getElementById('section-1').style.display = 'block';
            document.getElementById('section-2').style.display = 'none';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Reset the login form when switching to "Register"
    let registerTab = document.getElementById('register-tab');
    let loginForm = document.querySelector('#loginForm form');
    if (registerTab && loginForm) {
        registerTab.addEventListener("click", function() {
            loginForm.reset();
        });
    }

    let passwordField = document.getElementById("password");
    let togglePasswordButton = document.querySelector(".toggle-password");

    if (passwordField && togglePasswordButton) {
        togglePasswordButton.addEventListener("click", function() {
            let toggleIcon = togglePasswordButton.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        });
    }

    
});
    // Cambiar entre secciones con desplazamiento suave
    document.getElementById('next-button').addEventListener('click', function() {
        document.getElementById('section-1').style.display = 'none';
        document.getElementById('section-2').style.display = 'block';
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' }); // Desplazamiento suave al final
    });

    document.getElementById('prev-button').addEventListener('click', function() {
        document.getElementById('section-2').style.display = 'none';
        document.getElementById('section-1').style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' }); // Desplazamiento suave al principio
    });

    document.getElementById('tipo_persona').addEventListener('change', function() {
        var rfcInput = document.getElementById('rfc');
        if (this.value === 'fisica') {
            rfcInput.setAttribute('maxlength', '13');
            rfcInput.placeholder = 'Ejemplo: ABCD123456XYZ';
        } else {
            rfcInput.setAttribute('maxlength', '12');
            rfcInput.placeholder = 'Ejemplo: ABC123456XYZ';
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los campos de nombre y apellidos
    const nameInputs = document.querySelectorAll('#name, #first_lastname, #second_lastname');
    
    // Expresión regular que solo permite letras y espacios
    const nameRegex = /^[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]*$/;
    
    nameInputs.forEach(input => {
        // Validación mientras se escribe
        input.addEventListener('input', function(e) {
            let inputValue = this.value;
            
            // Si el valor no coincide con la expresión regular
            if (!nameRegex.test(inputValue)) {
                // Eliminar caracteres no permitidos
                this.value = inputValue.replace(/[^A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
                
                // Mostrar mensaje de error
                showErrorMessage(this, 'Solo se permiten letras y espacios');
            } else {
                // Remover mensaje de error si existe
                removeErrorMessage(this);
            }
        });

        // Prevenir pegar contenido no válido
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            
            if (nameRegex.test(pastedText)) {
                this.value = pastedText;
            } else {
                showErrorMessage(this, 'El texto pegado contiene caracteres no permitidos');
            }
        });

        // Prevenir teclas especiales
        input.addEventListener('keypress', function(e) {
            const char = String.fromCharCode(e.keyCode || e.which);
            if (!nameRegex.test(char)) {
                e.preventDefault();
                showErrorMessage(this, 'Carácter no permitido');
            }
        });
    });

    // Función para mostrar mensaje de error
    function showErrorMessage(input, message) {
        // Verificar si ya existe un mensaje de error
        let errorDiv = input.parentElement.querySelector('.error-message');
        
        if (!errorDiv) {
            // Crear nuevo mensaje de error
            errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-danger mt-1';
            input.parentElement.appendChild(errorDiv);
        }
        
        errorDiv.textContent = message;
        
        // Remover el mensaje después de 2 segundos
        setTimeout(() => {
            removeErrorMessage(input);
        }, 2000);
    }

    // Función para remover mensaje de error
    function removeErrorMessage(input) {
        const errorDiv = input.parentElement.querySelector('.error-message');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    // Validación antes de enviar el formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        let hasErrors = false;
        
        nameInputs.forEach(input => {
            if (!nameRegex.test(input.value)) {
                hasErrors = true;
                showErrorMessage(input, 'Este campo solo permite letras');
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
        }
    });
});
