// formController.js
document.addEventListener("DOMContentLoaded", function() {
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
});