// funciones lado user en todos los apartaados

// menu desplegable
function menuAbrir() {
  let overlay = document.getElementById("over")
  document.getElementById("carrito1").style.right = "0";
  overlay.style.display = 'block';
}

function MenuCerrar() {
  let overlay = document.getElementById("over")
 document.getElementById("carrito1").style.right = "-350px";
 overlay.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    var overlay = document.getElementById('over');
    overlay.addEventListener('click', function(event) {
        var formBox = document.getElementById('carrito1');
        if (formBox) {
           var isClickedInsideForm = formBox.contains(event.target);
        if (!isClickedInsideForm) {
            MenuCerrar();
        }
        }
    });
});


// Corregir el código del overlay
document.addEventListener('DOMContentLoaded', function() {
    // Check if the element exists before adding event listener
    var overlay = document.getElementById('over');
    if (overlay) {
        overlay.addEventListener('click', function(event) {
            var formBox = document.getElementById('carrito1');
            if (formBox) {
                var isClickedInsideForm = formBox.contains(event.target);
                if (!isClickedInsideForm) {
                    MenuCerrar();
                }
            }
        });
    }

    // Ejecutar la función de cambiar productos si estamos en una página que lo necesita
    if (document.getElementById("catalogo")) {
        cambiar_productos();
    }
});

// Fix the DOMContentLoaded event for overlay perfil
document.addEventListener('DOMContentLoaded', function() {
    var overlayPerfil = document.getElementById('overlayPerfil');
    if (overlayPerfil) {
        overlayPerfil.addEventListener('click', function(event) {
            var perfilBox = document.getElementById('perfilBox');
            if (perfilBox) {
                var isClickedInsideForm = perfilBox.contains(event.target);
                if (!isClickedInsideForm) {
                    ocultarPerfil();
                }
            }
        });
    }
});



// funciones lado user productos
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

// CAMBIAR productos


// cambiar el titulo del catalogo

function cambiarTitulo(titulo) {
  document.getElementById("title").innerText = titulo;
}

function mostrarCatalogo(titulo) {
  cambiarTitulo("Luxury " + titulo);
}

function mostrarPropiedades(titulo) {
  cambiarTitulo("Luxury " + titulo);
}


function cambiar_productos() {
  // Obtener referencias a los elementos del menú
  let item0 = document.getElementById("item-0");
  let item1 = document.getElementById("item-1");
  let item2 = document.getElementById("item-2");
  let item3 = document.getElementById("item-3");
  let item4 = document.getElementById("item-4");
  
  // Obtener todas las tarjetas de propiedades
  let propiedades = document.querySelectorAll('.info-carta');
  
  // Mensaje de no resultados
  let mensajeNoResultados = document.getElementById("mensaje-no-resultados");
  
  // Si no existe, lo creamos
  if (!mensajeNoResultados) {
    mensajeNoResultados = document.createElement('div');
    mensajeNoResultados.id = "mensaje-no-resultados";
    mensajeNoResultados.textContent = "No se encontraron propiedades que coincidan con los criterios seleccionados.";
    mensajeNoResultados.style.display = "none";
    
    // Añadir después del catálogo
    const catalogo = document.querySelector('.catalogo') || document.body;
    catalogo.appendChild(mensajeNoResultados);
  }
  
  // Función para mostrar/ocultar propiedades según el filtro
  function filtrarPropiedades(filtro) {
    let propiedadesVisibles = 0;
    
    console.log("Filtrando por:", filtro);
    console.log("Total propiedades:", propiedades.length);
    
    // Recorrer todas las propiedades
    propiedades.forEach(propiedad => {
      let tipo = propiedad.getAttribute('data-tipo') || "";
      
      console.log("Propiedad:", propiedad);
      console.log("Tipo:", tipo);
      
      // Si el tipo coincide con el filtro o el filtro es "todos", mostrar la propiedad
      if (filtro === "todos" || (tipo && tipo.includes(filtro))) {
        propiedad.style.display = "flex";
        propiedadesVisibles++;
      } else {
        propiedad.style.display = "none";
      }
    });
    
    console.log("Propiedades visibles:", propiedadesVisibles);
    
    // Mostrar mensaje si no hay resultados
    if (propiedadesVisibles === 0) {
      mensajeNoResultados.style.display = "flex";
    } else {
      mensajeNoResultados.style.display = "none";
    }
    
    return propiedadesVisibles;
  }
  
  // Event listeners para cada ítem del menú
  item0.addEventListener("click", function() {
    filtrarPropiedades("casa");
  });
  
  item1.addEventListener("click", function() {
    filtrarPropiedades("villa");
  });
  
  item2.addEventListener("click", function() {
    filtrarPropiedades("apartamento");
  });
  
  item3.addEventListener("click", function() {
    filtrarPropiedades("renta");
  });
  
  item4.addEventListener("click", function() {
    filtrarPropiedades("venta");
  });
  
  // Mostrar todas las propiedades al cargar la página
  filtrarPropiedades("casa");
}
document.addEventListener("DOMContentLoaded", function() {
    cambiar_productos();
});


// Mantener el código del overlay de perfil
document.addEventListener('DOMContentLoaded', function() {
  var overlayPerfil = document.getElementById('overlayPerfil');
  if (overlayPerfil) {
    overlayPerfil.addEventListener('click', function(event) {
      if (event.target === overlayPerfil) {
        ocultarPerfil();
      }
    });
  }
});

// Función ocultarPerfil que estaba faltando en tu código original
function ocultarPerfil() {
  var overlayPerfil = document.getElementById('overlayPerfil');
  if (overlayPerfil) {
    overlayPerfil.style.display = "none";
  }
}


document.addEventListener('DOMContentLoaded', function() {
    var overlayPerfil = document.getElementById('overlayPerfil');
    overlayPerfil.addEventListener('click', function(event) {
        if (event.target === overlayPerfil) {
            ocultarPerfil();
        }
    });
});



// cambiar productos


