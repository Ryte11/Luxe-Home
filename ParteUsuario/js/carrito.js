
// carrito de compras



let carrito = [];

function agregarAlCarrito(imagenURL, categoria, precio) {
    const usuario = JSON.parse(localStorage.getItem("usuarioActual"));
    if (!usuario) {
        alert("Por favor, inicie sesión para agregar productos al carrito.");
        return;
    }

    const carritoKey = `carrito_${usuario.email}`;
    let carrito = JSON.parse(localStorage.getItem(carritoKey)) || [];

    const index = carrito.findIndex(item => item.categoria === categoria && item.imagen === imagenURL);

    if (index !== -1) {
        carrito.splice(index, 1);
    } else {
        carrito.push({ imagen: imagenURL, categoria, precio });
    }

    localStorage.setItem(carritoKey, JSON.stringify(carrito));
    actualizarCarrito();
}


// Función para cargar el carrito al iniciar la página
function cargarCarrito() {
    const usuario = JSON.parse(localStorage.getItem("usuarioActual"));
    if (usuario) {
        actualizarCarrito();
    }
}

// Añadir este evento para cargar el carrito cuando la página termina de cargar
document.addEventListener('DOMContentLoaded', function() {
    cargarCarrito();
    
    // Resto de tu código DOMContentLoaded existente...
});


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

function actualizarCarrito() {
    const usuario = JSON.parse(localStorage.getItem("usuarioActual"));
    if (!usuario) {
        return;
    }

    const carritoKey = `carrito_${usuario.email}`;
    let carrito = JSON.parse(localStorage.getItem(carritoKey)) || [];

    let carritoItems = document.getElementById("carrito-items");
    let totalPrecio = document.getElementById("total-precio");
    carritoItems.innerHTML = "";
    let total = 0;

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
        total += item.precio;
    });

    totalPrecio.textContent = total;
}
  
function abrirCarrito() {
    let overlay = document.getElementById("over")
    document.getElementById("carrito").style.right = "0";
    overlay.style.display = 'block';
  }

function cerrarCarrito() {
    let overlay = document.getElementById("over")
   document.getElementById("carrito").style.right = "-650px";
   overlay.style.display = 'none';
}
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('over');
  overlay.addEventListener('click', function(event) {
    var formBox = document.getElementById('carrito');
    var isClickedInsideForm = formBox.contains(event.target);
    if (!isClickedInsideForm) {
      cerrarCarrito();
    }
  });
  });




document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.checkbox');
    const likeButton = document.querySelector('.like-button');
  
    let likeCount = 0; 
  
    function spanNum() {
      likeButton.textContent = likeCount;
    }
  
    checkboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        likeCount++; 
      }
  
      checkbox.addEventListener('change', function() {
        if (this.checked) {
          likeCount++; 
        } else {
          likeCount--; 
        }
        spanNum();
      });
    });
    spanNum();
  });
  
// funcion para limpiar el carrito

function limpiar() {
    const usuario = JSON.parse(localStorage.getItem("usuarioActual"));
    if (!usuario) {
        alert("Por favor, inicie sesión para limpiar el carrito.");
        return;
    }

    const carritoKey = `carrito_${usuario.email}`;
    localStorage.removeItem(carritoKey);
    actualizarCarrito();
}


function compra() {
  let carritoItems = document.getElementById("carrito-items");

  if (carritoItems.childElementCount === 0) {
    alert("El carrito está vacío.");
    return false;
  }

  let botonConfirm = confirm("¿Está seguro que desea comprar?");
  if (botonConfirm) {
    window.location.href = "formulario_compra.html";
  } else {
    alert("Está bien, puede seguir explorando nuestro catálogo.");
    return false;
  }
}




  //fin

// mostrar formulario registro



function mostrarFormulario() {
    var overlay = document.getElementById('overlay');
    var formBox = document.getElementById('formBox');
    var usuario = JSON.parse(localStorage.getItem("usuarioActual"));

    if (usuario) {
        mostrarPerfil();
    } else {
        overlay.style.display = 'block';
        formBox.style.display = 'block';
    }
}



// mostrar formulario login

document.addEventListener('DOMContentLoaded', function() {
var overlay = document.getElementById('overlay');
overlay.addEventListener('click', function(event) {
  var formBox = document.getElementById('formBox1');
  var isClickedInsideForm = formBox.contains(event.target);
  if (!isClickedInsideForm) {
    ocultarFormulario();
  }
});
});

function mostrarFormulario1() {
    var overlay = document.getElementById('overlay');
    var formBox = document.getElementById('formBox');
    var formBox1 = document.getElementById('formBox1');
    var usuario = JSON.parse(localStorage.getItem("usuarioActual"));

    if (usuario) {
        mostrarPerfil();
    } else {
        formBox1.style.display = 'block';
        overlay.style.display = 'block';
        formBox.style.display = 'none';
    }
}

function ocultarFormulario() {
  var overlay = document.getElementById('overlay');
  var formBox = document.getElementById('formBox');
  var formBox1 = document.getElementById('formBox1');

  formBox1.style.display = 'none'
  overlay.style.display = 'none';
  formBox.style.display = 'none';
}




document.getElementById("form").addEventListener("submit", async function(event) {
    event.preventDefault();

    const nombre = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (nombre === "" || email === "" || password === "") {
        alert("Todos los campos son obligatorios.");
        return;
    }

    if (nombre.length < 6) {
        alert("El nombre debe tener al menos 6 caracteres.");
        return;
    }

    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)) {
        alert("El email no es válido.");
        return;
    }

    if (password.length < 6) {
        alert("La contraseña debe tener al menos 6 caracteres.");
        return;
    }

    try {
        let response = await fetch("PHP/registro.php", {
            method: "POST",
            body: new URLSearchParams({ name: nombre, email: email, password: password }),
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        });

        let result = await response.text();
        alert(result);
    } catch (error) {
        alert("Error al registrar usuario.");
    }
});

document.getElementById("form1").addEventListener("submit", async function(event) {
    event.preventDefault();

    const email = document.getElementById("email1").value.trim();
    const password = document.getElementById("password1").value.trim();

    if (email === "" || password === "") {
        alert("Todos los campos son obligatorios.");
        return;
    }

    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email)) {
        alert("El email no es válido.");
        return;
    }

    if (password.length < 6) {
        alert("La contraseña debe tener al menos 6 caracteres.");
        return;
    }

    try {
        let response = await fetch("PHP/login.php", {
            method: "POST",
            body: new URLSearchParams({ email: email, password: password }),
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        let result = await response.json(); // Esperamos un JSON del servidor

        console.log(result); // Log para depuración

        if (result.success) {
            // Guardar datos del usuario en localStorage
            localStorage.setItem("usuarioActual", JSON.stringify(result.usuario));

            // Actualizar UI del perfil
            mostrarPerfil();

            // Cargar carrito del usuario
            actualizarCarrito();

            alert("Inicio de sesión exitoso");
            ocultarFormulario();
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error("Error al iniciar sesión:", error);
        alert("Error al iniciar sesión.");
    }
});


// Cargar perfil al cargar la página

function mostrarPerfil() {
    var overlayPerfil = document.getElementById('overlayPerfil');
    var perfilBox = document.getElementById('perfilBox');
    var usuario = JSON.parse(localStorage.getItem("usuarioActual"));


    if (usuario) {
        document.getElementById('perfilNombre').textContent = usuario.nombre;
        document.getElementById('perfilEmail').textContent = usuario.email;
        document.getElementById('perfilImagen').src = `https://i.pravatar.cc/50?u=${usuario.email}`;

        overlayPerfil.style.display = 'block';
        perfilBox.style.display = 'block';
      
        // Cargar carrito del usuario
        const carritoKey = `carrito_${usuario.email}`;
        let carrito = JSON.parse(localStorage.getItem(carritoKey)) || [];
        localStorage.setItem(carritoKey, JSON.stringify(carrito));
        actualizarCarrito();
    }
}

function ocultarPerfil() {
    var overlayPerfil = document.getElementById('overlayPerfil');
    var perfilBox = document.getElementById('perfilBox');

    overlayPerfil.style.display = 'none';
    perfilBox.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    var overlayPerfil = document.getElementById('overlayPerfil');
    overlayPerfil.addEventListener('click', function(event) {
        var perfilBox = document.getElementById('perfilBox');
        var isClickedInsideForm = perfilBox.contains(event.target);
        if (!isClickedInsideForm) {
            ocultarPerfil();
        }
    });
});


// cerrar sesion
function cerrarSesion() {
    
    localStorage.removeItem("usuarioActual");
    location.reload();
}
