document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('payment-form');
    if (!form) return;

    const fields = {
        name: document.getElementById('card-name'),
        number: document.getElementById('card-number'),
        expiry: document.getElementById('card-expiry'),
        cvv: document.getElementById('card-cvv'),
    };
    const payButton = document.getElementById('pay-button');

    const digits = (value) => value.replace(/\D/g, '');
    const setError = (field, message) => {
        document.getElementById(`${field.id}-error`).textContent = message;
        field.setAttribute('aria-invalid', message ? 'true' : 'false');
    };
    const luhnValid = (number) => {
        let sum = 0;
        let doubleDigit = false;
        for (let i = number.length - 1; i >= 0; i--) {
            let value = Number(number[i]);
            if (doubleDigit && (value *= 2) > 9) value -= 9;
            sum += value;
            doubleDigit = !doubleDigit;
        }
        return sum % 10 === 0;
    };
    const validate = () => {
        const number = digits(fields.number.value);
        const expiry = fields.expiry.value;
        let valid = true;

        const errors = {
            name: fields.name.value.trim().length >= 3 ? '' : 'Ingresa el nombre que figura en la tarjeta.',
            number: number.length >= 13 && number.length <= 19 && luhnValid(number) ? '' : 'Ingresa un número de tarjeta válido.',
            expiry: '',
            cvv: /^\d{3,4}$/.test(fields.cvv.value) ? '' : 'El CVV debe tener 3 o 4 dígitos.',
        };
        const match = expiry.match(/^(\d{2})\/(\d{2})$/);
        if (!match) {
            errors.expiry = 'Usa el formato MM/AA.';
        } else {
            const month = Number(match[1]);
            const year = 2000 + Number(match[2]);
            const today = new Date();
            if (month < 1 || month > 12 || year < today.getFullYear() || (year === today.getFullYear() && month < today.getMonth() + 1)) {
                errors.expiry = 'La tarjeta está vencida o la fecha no es válida.';
            }
        }
        Object.entries(errors).forEach(([key, message]) => {
            setError(fields[key], message);
            if (message) valid = false;
        });
        payButton.disabled = !valid;
        return valid;
    };

    const notifyFieldWhenValid = (field) => {
        const errors = document.getElementById(`${field.id}-error`);
        if (field.value.trim() && errors && !errors.textContent) {
            window.dispatchEvent(new CustomEvent('jeap:checkout-field-valid', { detail: { fieldId: field.id } }));
        }
    };

    fields.number.addEventListener('input', () => {
        fields.number.value = digits(fields.number.value).slice(0, 19).replace(/(.{4})/g, '$1 ').trim();
        validate();
        notifyFieldWhenValid(fields.number);
    });
    fields.expiry.addEventListener('input', () => {
        fields.expiry.value = digits(fields.expiry.value).slice(0, 4).replace(/(\d{2})(\d)/, '$1/$2');
        validate();
        notifyFieldWhenValid(fields.expiry);
    });
    [fields.name, fields.cvv].forEach((field) => field.addEventListener('input', () => {
        validate();
        notifyFieldWhenValid(field);
    }));

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (!validate()) return;
        payButton.disabled = true;
        payButton.textContent = 'Procesando pago...';
        try {
            const response = await fetch('/pago/confirmar', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
            });
            const result = await response.json();
            if (!response.ok || !result.redirect) throw new Error('No se pudo confirmar el pedido.');
            window.location.assign(result.redirect);
        } catch (error) {
            payButton.disabled = false;
            payButton.textContent = payButton.dataset.label || 'Intentar nuevamente';
            setError(fields.number, error.message || 'Ocurrió un error al confirmar el pedido.');
        }
    });
});
