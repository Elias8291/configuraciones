// validationController.js
document.addEventListener("DOMContentLoaded", function() {
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

    // Seleccionar todos los campos de nombre y apellidos
    const nameInputs = document.querySelectorAll('#name, #last_name, #second_last_name');
    
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