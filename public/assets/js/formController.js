document.addEventListener("DOMContentLoaded", function() {
    let loginTab = document.getElementById('login-tab');
    let registerTab = document.getElementById('register-tab');
    let registerForm = document.querySelector('#registerForm form');
    let loginForm = document.querySelector('#loginForm form');
    
    // Check if there are any validation errors
    const hasErrors = document.querySelectorAll('.text-danger').length > 0;
    
    // If there are errors, switch to the register tab
    if (hasErrors) {
        if (registerTab) {
            // Activate register tab
            registerTab.click();
            // Or use Bootstrap's tab method
            const bsRegisterTab = new bootstrap.Tab(registerTab);
            bsRegisterTab.show();
        }
        
        // Check which section has errors to display the correct one
        const section1Errors = document.querySelector('#section-1 .text-danger');
        const section2Errors = document.querySelector('#section-2 .text-danger');
        
        if (section2Errors) {
            document.getElementById('section-1').style.display = 'none';
            document.getElementById('section-2').style.display = 'block';
        } else {
            document.getElementById('section-1').style.display = 'block';
            document.getElementById('section-2').style.display = 'none';
        }
    }
    
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
});