document.addEventListener("DOMContentLoaded", () => {
    console.log("carrito.js version 20260522b loaded");
    const overlay = document.getElementById("overlay");
    const cartTrigger = document.getElementById("btn-Carrito");
    const cartTriggerBox = document.getElementById("Box_Button_carrito");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || "";

    const routes = {
        panel: "/carrito/panel",
        add: "/carrito/agregar",
        remove: "/carrito/eliminar",
        update: "/carrito/actualizar",
    };

    function getOrCreateDrawer() {
        let drawer = document.getElementById("carrito");

        if (drawer) {
            return drawer;
        }

        drawer = document.createElement("div");
        drawer.id = "carrito";
        drawer.className = "carrito-flotante";
        drawer.innerHTML = [
            '<div class="Container_ordenar1">',
            '  <div id="container_superior">',
            '    <h3 id="title_carrito">Mi carrito</h3>',
            '    <div id="contenedor_boton_cerrar"><button id="cerrar-carrito" type="button">Cerrar</button></div>',
            '  </div>',
            '  <div id="contenedor-productos-carrito"></div>',
            '</div>',
            '<div class="Container_ordenar2">',
            '  <div id="total-carrito"><span>Total: </span><span id="valor-total-carrito">S/ 0.00</span></div>',
            '  <div id="contenedor_boton_pagar"><button id="boton-pagar" type="button">Ir a pagar</button></div>',
            '</div>',
        ].join("");

        document.body.appendChild(drawer);

        document.getElementById("cerrar-carrito").addEventListener("click", closeCart);
        document.getElementById("boton-pagar").addEventListener("click", () => {
            window.location.href = "/pagar";
        });

        return drawer;
    }

    function openCart() {
        if (!overlay) {
            return;
        }

        const drawer = getOrCreateDrawer();
        overlay.style.display = "flex";
        drawer.classList.add("activo");
        refreshCartPanel();
        window.dispatchEvent(new CustomEvent("jeap:cart-opened"));
    }

    function closeCart() {
        const drawer = document.getElementById("carrito");

        if (drawer) {
            drawer.classList.remove("activo");
        }

        if (overlay) {
            overlay.style.display = "none";
        }
    }

    function postForm(url, data) {
        const body = new URLSearchParams(data).toString();

        return fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "X-CSRF-TOKEN": csrfToken,
                "X-Requested-With": "XMLHttpRequest",
            },
            body,
        });
    }

    function shouldRedirectToLogin(response) {
        if (!response) {
            return false;
        }

        if (response.status === 401 || response.status === 403 || response.status === 419) {
            return true;
        }

        return response.redirected && response.url.includes("/login");
    }

    function refreshCartPanel() {
        fetch(routes.panel, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then((res) => {
                if (shouldRedirectToLogin(res)) {
                    window.location.href = "/login";
                    return null;
                }

                return res.text();
            })
            .then((html) => {
                if (html === null) {
                    return;
                }

                const container = document.getElementById("contenedor-productos-carrito");

                if (!container) {
                    return;
                }

                container.innerHTML = html;
                updateTotal();
            });
    }

    function updateTotal() {
        const totalSpan = document.getElementById("valor-total-carrito");

        if (!totalSpan) {
            return;
        }

        const products = document.querySelectorAll("#contenedor-productos-carrito .item-carrito");
        let total = 0;

        products.forEach((item) => {
            const price = Number(item.querySelector(".precio-producto")?.dataset.precio || 0);
            const qty = Number(item.querySelector(".cantidad-producto")?.value || 0);
            total += price * qty;
        });

        totalSpan.textContent = "S/ " + total.toFixed(2);
    }

    const openCartFromHeader = (event) => {
        event.preventDefault();
        event.stopPropagation();
        openCart();
    };

    if (cartTrigger) {
        cartTrigger.addEventListener("click", openCartFromHeader);
    }

    if (cartTriggerBox) {
        cartTriggerBox.addEventListener("click", openCartFromHeader);
    }

    if (overlay) {
        overlay.addEventListener("click", closeCart);
    }

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeCart();
        }
    });

    document.addEventListener("click", (event) => {
        const addButton = event.target.closest(".btn-agregar-carrito");
        if (addButton) {
            event.preventDefault();
            event.stopPropagation();
            const productId = addButton.dataset.id;
            if (!productId) {
                return;
            }

            postForm(routes.add, { producto_id: productId })
                .then((res) => {
                    if (shouldRedirectToLogin(res)) {
                        window.location.href = "/login";
                        return;
                    }

                    if (!res.ok) {
                        console.error("Error al agregar al carrito", res.status);
                        return;
                    }

                    openCart();
                    window.dispatchEvent(new CustomEvent("jeap:cart-item-added"));
                });
            return;
        }

        const removeButton = event.target.closest(".btn-eliminar-producto");
        if (removeButton) {
            event.preventDefault();
            event.stopPropagation();
            const productId = removeButton.dataset.id;
            if (!productId) {
                return;
            }

            postForm(routes.remove, { producto_id: productId })
                .then((res) => {
                    if (shouldRedirectToLogin(res)) {
                        window.location.href = "/login";
                        return;
                    }

                    refreshCartPanel();
                });
        }
    });

    document.addEventListener("input", (event) => {
        const qtyInput = event.target.closest(".cantidad-producto");
        if (!qtyInput) {
            return;
        }

        const productId = qtyInput.dataset.id;
        const quantity = Math.max(1, Number(qtyInput.value || 1));

        qtyInput.value = String(quantity);

        if (!productId) {
            return;
        }

        postForm(routes.update, { producto_id: productId, cantidad: quantity })
            .then((res) => {
                if (shouldRedirectToLogin(res)) {
                    window.location.href = "/login";
                    return;
                }

                updateTotal();
            });
    });
});
