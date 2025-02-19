document.addEventListener("DOMContentLoaded", function() {
    let loginTab = document.getElementById('login-tab');
    let registerTab = document.getElementById('register-tab');
    let registerForm = document.querySelector('#registerForm form');
    let loginForm = document.querySelector('#loginForm form');

    if (loginTab && registerForm) {
        loginTab.addEventListener("click", function() {
            registerForm.reset();
            document.querySelectorAll('.text-danger').forEach(el => el.remove()); // Eliminar errores al cambiar a Login
            document.getElementById('section-1').style.display = 'block';
            document.getElementById('section-2').style.display = 'none';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    if (registerTab && loginForm) {
        registerTab.addEventListener("click", function() {
            loginForm.reset();
        });
    }

    // 📌 Buscar errores en el formulario de registro
    const errorElements = document.querySelectorAll('.text-danger');
    if (errorElements.length > 0) {
        let firstError = errorElements[0];

        // Activar la pestaña de registro si hay errores
        let registerTabLink = document.querySelector('[data-bs-target="#registerForm"]'); // Asegúrate de que el selector es el correcto
        if (registerTabLink) {
            registerTabLink.click(); // Activa la pestaña de registro
        }

        // Mostrar la sección donde está el error
        let section1 = document.getElementById('section-1');
        let section2 = document.getElementById('section-2');

        if (section1.contains(firstError)) {
            section1.style.display = 'block';
            section2.style.display = 'none';
        } else if (section2.contains(firstError)) {
            section1.style.display = 'none';
            section2.style.display = 'block';
        }

        // 📌 Desplazar la pantalla hasta el primer error
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
