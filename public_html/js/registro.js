document.addEventListener('DOMContentLoaded', () => {
    const password = document.querySelector('input[name="contrasena"]');
    const confirmation = document.getElementById('contrasena_confirmation');
    const message = document.getElementById('password-confirmation-error');
    if (!password || !confirmation || !message) return;
    password.type = 'password';

    const validate = () => {
        const mismatch = confirmation.value.length > 0 && password.value !== confirmation.value;
        confirmation.setCustomValidity(mismatch ? 'Las contraseñas no coinciden.' : '');
        confirmation.setAttribute('aria-invalid', mismatch ? 'true' : 'false');
        message.textContent = mismatch ? 'Las contraseñas no coinciden.' : '';
    };

    password.addEventListener('input', validate);
    confirmation.addEventListener('input', validate);
});
