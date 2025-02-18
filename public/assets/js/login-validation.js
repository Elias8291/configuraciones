document.addEventListener("DOMContentLoaded", function() {
    const passwordInput = document.getElementById('password');
    const togglePassword = document.querySelector('.toggle-password');
    
    // Verificar si existe el botón de visibilidad
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('show-password');
        });
    }
});
