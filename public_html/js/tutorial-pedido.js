(() => {
    const storageKey = 'jeap-order-tutorial';
    const body = document.body;
    let overlay;
    let tooltip;
    let focusedTarget;
    let retryTimer;
    let actionTarget;
    let actionHandler;

    const getState = () => {
        try { return JSON.parse(sessionStorage.getItem(storageKey) || 'null'); } catch { return null; }
    };
    const setState = (step) => sessionStorage.setItem(storageKey, JSON.stringify({ active: true, step }));
    const clearState = () => sessionStorage.removeItem(storageKey);
    const page = () => body.dataset.tutorialPage || '';

    const cleanUpVisuals = () => {
        clearTimeout(retryTimer);
        if (actionTarget && actionHandler) actionTarget.removeEventListener('click', actionHandler);
        overlay?.remove();
        tooltip?.remove();
        focusedTarget?.classList.remove('tutorial-focus');
        overlay = tooltip = focusedTarget = actionTarget = actionHandler = null;
    };

    const cancel = () => { cleanUpVisuals(); clearState(); };
    const finish = () => { cleanUpVisuals(); clearState(); };
    const overlaps = (first, second) => first.left < second.right && first.right > second.left && first.top < second.bottom && first.bottom > second.top;

    const positionTooltip = () => {
        if (!tooltip || !focusedTarget) return;
        const targetRect = focusedTarget.getBoundingClientRect();
        const width = tooltip.offsetWidth;
        const height = tooltip.offsetHeight;
        const gap = 22;
        const candidates = [
            { left: targetRect.right + gap, top: targetRect.top + (targetRect.height - height) / 2 },
            { left: targetRect.left - width - gap, top: targetRect.top + (targetRect.height - height) / 2 },
            { left: targetRect.left + (targetRect.width - width) / 2, top: targetRect.bottom + gap },
            { left: targetRect.left + (targetRect.width - width) / 2, top: targetRect.top - height - gap },
        ].map((candidate) => ({
            left: Math.round(candidate.left),
            top: Math.round(candidate.top),
            right: Math.round(candidate.left + width),
            bottom: Math.round(candidate.top + height),
        }));
        const blockers = [...document.querySelectorAll('.order-summary, .payment-card, #container_detalles_pagar, .carrito-flotante')]
            .filter((element) => !element.contains(focusedTarget))
            .map((element) => element.getBoundingClientRect());
        const position = candidates.find((candidate) => candidate.left >= 16 && candidate.top >= 16
            && candidate.right <= window.innerWidth - 16 && candidate.bottom <= window.innerHeight - 16
            && !blockers.some((blocker) => overlaps(candidate, blocker)))
            || candidates.find((candidate) => candidate.left >= 16 && candidate.top >= 16
                && candidate.right <= window.innerWidth - 16 && candidate.bottom <= window.innerHeight - 16)
            || { left: 16, top: window.innerHeight - height - 16 };
        tooltip.style.left = `${Math.max(16, Math.min(position.left, window.innerWidth - width - 16))}px`;
        tooltip.style.top = `${Math.max(16, Math.min(position.top, window.innerHeight - height - 16))}px`;
    };

    const positionShades = () => {
        if (!overlay || !focusedTarget) return;
        const rect = focusedTarget.getBoundingClientRect();
        const padding = 14;
        const hole = {
            left: Math.max(0, rect.left - padding),
            top: Math.max(0, rect.top - padding),
            right: Math.min(window.innerWidth, rect.right + padding),
            bottom: Math.min(window.innerHeight, rect.bottom + padding),
        };
        const setPanel = (name, left, top, width, height) => {
            const panel = overlay.querySelector(`[data-panel="${name}"]`);
            Object.assign(panel.style, { left: `${left}px`, top: `${top}px`, width: `${Math.max(0, width)}px`, height: `${Math.max(0, height)}px` });
        };
        setPanel('top', 0, 0, window.innerWidth, hole.top);
        setPanel('bottom', 0, hole.bottom, window.innerWidth, window.innerHeight - hole.bottom);
        setPanel('left', 0, hole.top, hole.left, hole.bottom - hole.top);
        setPanel('right', hole.right, hole.top, window.innerWidth - hole.right, hole.bottom - hole.top);
    };

    const show = (selector, title, description, options = {}) => {
        cleanUpVisuals();
        const target = document.querySelector(selector);
        if (!target) {
            retryTimer = setTimeout(() => show(selector, title, description, options), 150);
            return;
        }
        focusedTarget = target;
        target.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
        overlay = document.createElement('div');
        overlay.id = 'tutorial-order-overlay';
        overlay.innerHTML = ['top', 'bottom', 'left', 'right'].map((name) => `<div class="tutorial-shade" data-panel="${name}"></div>`).join('');
        document.body.appendChild(overlay);
        target.classList.add('tutorial-focus');

        tooltip = document.createElement('aside');
        tooltip.id = 'tutorial-order-tooltip';
        tooltip.setAttribute('role', 'dialog');
        tooltip.setAttribute('aria-live', 'polite');
        tooltip.innerHTML = `<h2>${title}</h2><p>${description}</p><div class="tutorial-tooltip-actions"><button type="button" class="${options.finish ? 'tutorial-finish' : 'tutorial-cancel'}">${options.finish ? 'Finalizar tutorial' : 'Cancelar tutorial'}</button></div>`;
        document.body.appendChild(tooltip);
        tooltip.querySelector('button').addEventListener('click', options.finish ? finish : cancel);
        requestAnimationFrame(() => { positionShades(); positionTooltip(); });
        setTimeout(() => { positionShades(); positionTooltip(); }, 300);

        if (options.onAction) {
            actionTarget = target;
            actionHandler = () => options.onAction();
            target.addEventListener('click', actionHandler, { once: true });
        }
    };

    const render = () => {
        const state = getState();
        if (!state?.active) return;

        if (page() === 'login') {
            show('#Container_Button button', 'Inicia sesión para continuar', 'Ingresa con tu cuenta y presiona “Iniciar sesión”. Al volver a la tienda, retomaremos la guía.');
            return;
        }
        if (page() === 'home' && body.dataset.authenticated !== 'true') {
            show('#button_iniciar_sesion', 'Primero, inicia sesión', 'Necesitas una cuenta para guardar productos en tu carrito.', { onAction: () => setState('await-login') });
            return;
        }
        if (page() === 'home' && body.dataset.authenticated === 'true' && ['start', 'await-login', 'add-product'].includes(state.step)) {
            setState('add-product');
            show('.btn-agregar-carrito', 'Agrega un producto', 'Este botón añade el primer producto visible a tu carrito. Presiónalo una vez para continuar.');
            return;
        }
        if (state.step === 'cart' && page() === 'home') {
            show('#boton-pagar', 'Revisa tu carrito', 'Aquí puedes ver los productos agregados. Presiona “Ir a pagar” para revisar el pedido.', { onAction: () => setState('review') });
            return;
        }
        if (state.step === 'review' && page() === 'review') {
            show('#btn-continuar', 'Continúa al pago', 'El resumen muestra el total de tu pedido. Presiona este botón para ingresar los datos de pago.', { onAction: () => setState('payment-name') });
            return;
        }
        if (page() === 'payment') {
            if (['cart', 'review'].includes(state.step)) setState('payment-name');
            const currentState = getState();
            const steps = {
                'payment-name': ['#card-name', 'Nombre en la tarjeta', 'Escribe el nombre del titular tal como aparece en la tarjeta.'],
                'payment-number': ['#card-number', 'Número de tarjeta', 'Ingresa entre 13 y 19 dígitos. El sitio comprobará el formato mediante la validación de Luhn.'],
                'payment-expiry': ['#card-expiry', 'Fecha de vencimiento', 'Usa el formato MM/AA y una fecha futura, por ejemplo 12/30.'],
                'payment-cvv': ['#card-cvv', 'Código de seguridad', 'Ingresa los 3 o 4 dígitos del CVV. Este dato no se almacena.'],
                'payment-ready': ['#pay-button', 'Pedido listo para confirmar', 'Completaste todos los datos. Finaliza el tutorial; después podrás presionar “Pagar” cuando quieras.', { finish: true }],
            };
            const current = steps[currentState.step];
            if (current) show(...current);
        }
    };

    const advancePaymentField = (fieldId) => {
        const state = getState();
        const next = { 'payment-name': ['card-name', 'payment-number'], 'payment-number': ['card-number', 'payment-expiry'], 'payment-expiry': ['card-expiry', 'payment-cvv'], 'payment-cvv': ['card-cvv', 'payment-ready'] };
        if (state?.active && next[state.step]?.[0] === fieldId) { setState(next[state.step][1]); render(); }
    };

    window.addEventListener('jeap:start-order-tutorial', () => { setState('start'); render(); });
    window.addEventListener('jeap:cart-item-added', () => { const state = getState(); if (state?.active && state.step === 'add-product') { setState('cart'); setTimeout(render, 250); } });
    window.addEventListener('jeap:checkout-field-valid', (event) => advancePaymentField(event.detail?.fieldId));
    document.addEventListener('input', (event) => {
        if (!event.target.matches('#card-name, #card-number, #card-expiry, #card-cvv')) return;
        setTimeout(() => { if (event.target.getAttribute('aria-invalid') === 'false') advancePaymentField(event.target.id); }, 0);
    });
    window.addEventListener('resize', () => { positionShades(); positionTooltip(); });
    window.addEventListener('scroll', () => { positionShades(); positionTooltip(); }, true);
    document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && getState()?.active) cancel(); });
    document.addEventListener('DOMContentLoaded', render);
    if (document.readyState !== 'loading') render();
})();
