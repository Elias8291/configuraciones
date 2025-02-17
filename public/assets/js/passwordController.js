// passwordController.js
document.addEventListener("DOMContentLoaded", function() {
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