// chatbot.js
document.addEventListener("DOMContentLoaded", () => {
    const btnChatbotPrincipal=document.getElementById("button_chatbot");
    const btnChatbotAlternative = document.getElementById("btn-chatbot");
    const chatbotWindow = document.getElementById("chatbot-window");
    const closeChatbot = document.getElementById("close-chatbot");
    const messagesContainer = document.getElementById("chatbot-messages");

    const faqs = [
        {
            question: "¿Cuáles son los métodos de pago aceptados?",
            answer: "Aceptamos tarjetas de crédito, débito, y pagos a través de PayPal y transferencia bancaria."
        },
        {
            question: "¿Cuánto tarda en llegar mi pedido?",
            answer: "El tiempo estimado de entrega es de 3 a 5 días hábiles para Lima, y de 5 a 7 días hábiles para provincias."
        },
        {
            question: "¿Cuál es la política de devoluciones?",
            answer: "Tienes hasta 15 días desde que recibes el producto para solicitar una devolución, siempre y cuando el producto esté en su empaque original."
        },
        {
            question: "¿Tienen tiendas físicas?",
            answer: "Sí, contamos con tiendas físicas. Puedes ver la ubicación exacta en nuestra sección 'Nuestras tiendas'."
        }
    ];

    if (btnChatbotAlternative && btnChatbotPrincipal) {
        [btnChatbotPrincipal, btnChatbotAlternative].forEach(boton => {
    
        boton.addEventListener("click", () => {
            chatbotWindow.classList.remove("chatbot-hidden");
            // Si el chat está vacío, lo iniciamos
            if (messagesContainer.innerHTML.trim() === "") {
                iniciarChatbot();
            }
        });
    
        });
            

        
        
    }

    if (closeChatbot) {
        closeChatbot.addEventListener("click", () => {
            chatbotWindow.classList.add("chatbot-hidden");
        });
    }

    function addMessage(text, sender) {
        const msgDiv = document.createElement("div");
        msgDiv.classList.add("chat-msg", sender);
        msgDiv.textContent = text;
        messagesContainer.appendChild(msgDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function showFaqOptions() {
        const optionsContainer = document.createElement("div");
        optionsContainer.classList.add("faq-options");

        faqs.forEach((faq) => {
            const btn = document.createElement("button");
            btn.classList.add("faq-btn");
            btn.textContent = faq.question;
            btn.addEventListener("click", () => {
                optionsContainer.remove(); // Quitamos las opciones temporalmente
                addMessage(faq.question, "user");
                
                setTimeout(() => {
                    addMessage(faq.answer, "bot");
                    setTimeout(() => {
                        showFaqOptions(); // Mostramos nuevamente las opciones
                    }, 800);
                }, 600);
            });
            optionsContainer.appendChild(btn);
        });

        const tutorialButton = document.createElement("button");
        tutorialButton.classList.add("faq-btn", "tutorial-option");
        tutorialButton.textContent = "Guíame para realizar un pedido";
        tutorialButton.addEventListener("click", () => {
            chatbotWindow.classList.add("chatbot-hidden");
            window.dispatchEvent(new CustomEvent("jeap:start-order-tutorial"));
        });
        optionsContainer.appendChild(tutorialButton);

        messagesContainer.appendChild(optionsContainer);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function iniciarChatbot() {
        addMessage("¡Hola! Bienvenido a Jeap. ¿En qué puedo ayudarte hoy? Por favor, selecciona una de las siguientes opciones:", "bot");
        setTimeout(() => {
            showFaqOptions();
        }, 500);
    }
});
