// OCULTAR O MOSTRAR CONTRASEÑA
document.addEventListener("DOMContentLoaded", function() {
    const passwordField1 = document.querySelector('input[name="Pasword"]');
    const passwordField2 = document.querySelector('input[name="ConfirmPassword"]');
    const eyeIcon1 = document.getElementById('password-toggle1');
    const eyeIcon2 = document.getElementById('password-toggle2');

    function togglePasswordVisibility(field, icon) {
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('pw_hide');
            icon.classList.add('pw_show');
            icon.classList.remove('uil-eye-slash');
            icon.classList.add('uil-eye');
        } else {
            field.type = 'password';
            icon.classList.remove('pw_show');
            icon.classList.add('pw_hide');
            icon.classList.remove('uil-eye');
            icon.classList.add('uil-eye-slash');
        }
    }

    eyeIcon1.addEventListener("click", function() {
        togglePasswordVisibility(passwordField1, eyeIcon1);
    });

    eyeIcon2.addEventListener("click", function() {
        togglePasswordVisibility(passwordField2, eyeIcon2);
    });
});
