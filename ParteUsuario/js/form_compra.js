document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');
    const messageContainer = document.getElementById('message-container');

    // Cargar el carrito al iniciar la página
    cargarCarrito();

    // Form validation
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Reset error messages
        clearErrorMessages();

        // Form fields
        const nombre = document.getElementById("name");
        const email = document.getElementById("email");
        const direccion = document.getElementById("direccion");
        const num = document.getElementById("num");
        const codigo = document.getElementById("codigo");
        const metodoPago = document.getElementById("metodo_pago");
        const totalField = document.getElementById("total");

        // Validation flags
        let isValid = true;

        // Name validation
        if (nombre.value.trim() === "") {
            showError("name-error", "El campo nombre está vacío");
            isValid = false;
        } else if (nombre.value.length < 6) {
            showError("name-error", "El nombre debe tener al menos 6 caracteres");
            isValid = false;
        }

        // Email validation
        if (email.value.trim() === "") {
            showError("email-error", "El campo email está vacío");
            isValid = false;
        } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value)) {
            showError("email-error", "El email no es válido");
            isValid = false;
        }

        // Address validation
        if (direccion.value.trim() === "") {
            showError("direccion-error", "El campo dirección está vacío");
            isValid = false;
        }

        // Phone validation
        if (num.value.trim() === "") {
            showError("num-error", "El campo número telefónico está vacío");
            isValid = false;
        } else if (num.value.length < 10) {
            showError("num-error", "El número telefónico debe tener al menos 10 dígitos");
            isValid = false;
        }

        // Postal code validation
        if (codigo.value.trim() === "") {
            showError("codigo-error", "El campo código postal está vacío");
            isValid = false;
        }

        // Payment method validation
        if (metodoPago.value === "") {
            showError("metodo_pago-error", "Seleccione un método de pago");
            isValid = false;
        }

        // Set total value
        const total = document.getElementById('total-precio').textContent.replace('$', '');
        totalField.value = total;

        // Submit if everything is valid
        if (isValid) {
            showMessage("¡Procesando su compra...", true);
            form.submit();
        } else {
            showMessage("Por favor corrija los errores antes de enviar", false);
        }
    });

    // Función para cargar el carrito al iniciar la página
    function cargarCarrito() {
        const usuario = JSON.parse(localStorage.getItem("usuarioActual"));
        if (usuario) {
            actualizarCarrito();
        } else {
            showMessage("Por favor, inicie sesión para completar la compra.", false);
        }
    }

    // Función para actualizar el carrito
    function actualizarCarrito() {
        const usuario = JSON.parse(localStorage.getItem("usuarioActual"));
        if (!usuario) {
            return;
        }

        const carritoKey = `carrito_${usuario.email}`;
        let carrito = JSON.parse(localStorage.getItem(carritoKey)) || [];

        let carritoItems = document.getElementById("carrito-items");
        let subtotalPrecio = document.getElementById("subtotal-precio");
        let impuestosPrecio = document.getElementById("impuestos-precio");
        let totalPrecio = document.getElementById("total-precio");

        carritoItems.innerHTML = "";
        let subtotal = 0;

        if (carrito.length === 0) {
            carritoItems.innerHTML = "<p style='text-align: center;'>No hay productos en el carrito</p>";
            subtotalPrecio.textContent = "$0";
            impuestosPrecio.textContent = "$0";
            totalPrecio.textContent = "$0";
            return;
        }

        carrito.forEach(item => {
            let itemElement = document.createElement("div");
            itemElement.classList.add("producto-carrito");

            let imageElement = document.createElement("img");
            imageElement.src = item.imagen;
            imageElement.alt = item.categoria;
            imageElement.classList.add("imagen-carrito");

            let nameElement = document.createElement("p");
            nameElement.textContent = item.categoria;
            nameElement.classList.add("nombre-carrito");

            let priceElement = document.createElement("p");
            priceElement.textContent = `$${item.precio}`;
            priceElement.classList.add("precio-carrito");

            let deleteButton = document.createElement("button");
            deleteButton.textContent = "X";
            deleteButton.classList.add("eliminar-producto");

            deleteButton.addEventListener("click", function() {
                eliminarProducto(item.categoria, item.imagen);
            });

            itemElement.appendChild(imageElement);
            itemElement.appendChild(nameElement);
            itemElement.appendChild(priceElement);
            itemElement.appendChild(deleteButton);

            carritoItems.appendChild(itemElement);
            subtotal += item.precio;
        });

        // Calcular impuestos (ejemplo: 16% IVA)
        const impuestos = subtotal * 0.16;
        const total = subtotal + impuestos;

        // Actualizar precios
        subtotalPrecio.textContent = `$${subtotal.toFixed(2)}`;
        impuestosPrecio.textContent = `$${impuestos.toFixed(2)}`;
        totalPrecio.textContent = `$${total.toFixed(2)}`;
    }

    // Función para eliminar un producto del carrito
    function eliminarProducto(categoria, imagenURL) {
        const usuario = JSON.parse(localStorage.getItem("usuarioActual"));
        if (!usuario) {
            alert("Por favor, inicie sesión para eliminar productos del carrito.");
            return;
        }

        const carritoKey = `carrito_${usuario.email}`;
        let carrito = JSON.parse(localStorage.getItem(carritoKey)) || [];

        const index = carrito.findIndex(item => item.categoria === categoria && item.imagen === imagenURL);

        if (index !== -1) {
            carrito.splice(index, 1);
            localStorage.setItem(carritoKey, JSON.stringify(carrito));
            actualizarCarrito();
        }
    }

    // Helper functions
    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        errorElement.textContent = message;
    }

    function clearErrorMessages() {
        const errorElements = document.querySelectorAll('.error-msg');
        errorElements.forEach(element => {
            element.textContent = "";
        });

        messageContainer.textContent = "";
        messageContainer.className = "message-container";
    }

    function showMessage(message, isSuccess) {
        messageContainer.textContent = message;
        messageContainer.className = isSuccess 
            ? "message-container success-message" 
            : "message-container error-message";
    }
});