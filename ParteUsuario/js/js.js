/// FUncion de que se cambie la imagen y el texto
$(document).ready(function() {
  const imagenes = [
      {
          url: 'url(img/Fondo1.jpg)',
          textoCentro: {
              titulo: 'Villa Lujosa Moderna',
              subtitulo: 'Samaná, República Dominicana',
              habitaciones: 'Rooms',
              habitacionesCount: '4',
              baños: 'Bathrooms',
              bañosCount: '6',
              precio: '$265,000',
          },
      },
      {
          url: 'url(img/Fondo4.jpg)',
          textoCentro: {
              titulo: 'Beautiful Punta Cana Villa',
              subtitulo: 'Punta Cana, República Dominicana',
              habitaciones: 'Rooms',
              habitacionesCount: '5',
              baños: 'Bathrooms',
              bañosCount: '4',
              precio: '$180,000',
          },
      },
      {
          url: 'url(img/fondo3.jpg)',
          textoCentro: {
              titulo: 'Villa de lujo frente al mar',
              subtitulo: 'Las Terrenas, República Dominicana',
              habitaciones: 'Rooms',
              habitacionesCount: '6',
              baños: 'Bathrooms',
              bañosCount: '7',
              precio: '$265,000',
          },
      },
     
  ];

  let imagenActual = 0;

  function cambiarImagen() {
      const imagenData = imagenes[imagenActual];
      const { titulo, subtitulo, habitaciones, habitacionesCount, baños, bañosCount, precio } = imagenData.textoCentro;

      $('.contenedor').css('background-image', imagenData.url);
      $('.centro h1').text(titulo);
      $('.centro h3').text(subtitulo);
      $('.room-label').text(habitaciones);
      $('.room-count').text(habitacionesCount);
      $('.baños-label').text(baños);
      $('.baños-count').text(bañosCount);
      $('.precio h1').text(precio);
      $('.centro h1, .centro h3, .room-label, .room-count, .baños-label, .baños-count, .precio h1').css("transition", "2.8s ease-in-out");
  }

  $('.flecha-iz').click(function() {
      imagenActual = (imagenActual - 1 + imagenes.length) % imagenes.length;
      cambiarImagen();
  });

  $('.flecha-de').click(function() {
      imagenActual = (imagenActual + 1) % imagenes.length;
      cambiarImagen();
  });

  setInterval(function() {
      imagenActual = (imagenActual + 1) % imagenes.length;
      cambiarImagen();
  }, 5000);

  cambiarImagen(); 
});


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

document.addEventListener('DOMContentLoaded', function() {
    // Limitar la cantidad de cartas mostradas a 4
    const maxCartas = 8;
    const cartas = document.querySelectorAll('.info-carta');

    cartas.forEach((carta, index) => {
        if (index >= maxCartas) {
            carta.style.display = 'none';
        }
    });
});





///fin menu desplegable


/// filtro por busqueda input
document.addEventListener("keyup", e => {
if (e.target.matches("#buscador")) {
  if (e.key === "Escape") e.target.value = "";

  const filtro = e.target.value.toLowerCase();
  const cartas = document.querySelectorAll(".info-carta");

  cartas.forEach(carta => {
    const titulo = carta.querySelector('.title-des').textContent.toLowerCase();
    
    if (titulo.includes(filtro)) {
      carta.style.display = "flex";
    } else {
      carta.style.display = "none";
    }
  });
}
});



// filtro de selcts

function cambiar_productos() {
    // Obtener referencia al contenedor principal
    let contenedorPrincipal = document.getElementById("catalogo");
    
    // Check if the container exists before proceeding
    if (!contenedorPrincipal) {
        console.log("Contenedor de catálogo no encontrado en esta página");
        return;
    }

    function filtrarPropiedades() {
        let selectOperacion = document.getElementById("select-operacion");
        let selectTipo = document.getElementById("select-tipo");

        // Si no existen los selects, intentamos usar la navegación alternativa
        if (!selectOperacion || !selectTipo) {
            console.log("Usando navegación de menú alternativa");
            filtrarPorMenu();
            return;
        }

        let operacion = selectOperacion.value.toLowerCase();
        let tipo = selectTipo.value.toLowerCase();

        // Mapear los valores del select a los valores de los data-tipos
        const mapeoTipo = {
            'casas': 'casa',
            'villas': 'villa',
            'apartamentos': 'apartamento'
        };

        const mapeoOperacion = {
            'ventas': 'venta',
            'rentas': 'renta'
        };

        // Convertir el valor seleccionado al formato usado en data-tipo
        let tipoFiltrado = mapeoTipo[tipo] || tipo;
        let operacionFiltrada = mapeoOperacion[operacion] || operacion;

        console.log("Filtros convertidos:", { operacion: operacionFiltrada, tipo: tipoFiltrado });

        // Obtener todas las tarjetas de propiedades
        let tarjetas = contenedorPrincipal.querySelectorAll(".info-carta");
        let hayResultados = false;

        // Para cada tarjeta, verificar si cumple con los criterios de filtrado
        tarjetas.forEach(tarjeta => {
            let dataTipo = tarjeta.getAttribute("data-tipo").toLowerCase();
            let [categoria, tarjetaOperacion] = dataTipo.split('-');

            let mostrarPorOperacion = operacion === "todas" || tarjetaOperacion === operacionFiltrada;
            let mostrarPorTipo = tipo === "todos" || categoria === tipoFiltrado;

            if (mostrarPorOperacion && mostrarPorTipo) {
                tarjeta.style.display = "";  // Restaurar valor por defecto
                hayResultados = true;
            } else {
                tarjeta.style.display = "none";
            }
        });

        // Mostrar mensaje si no hay resultados
        let mensajeNoResultados = document.getElementById("mensaje-no-resultados");
        if (mensajeNoResultados) {
            mensajeNoResultados.style.display = hayResultados ? "none" : "block";
        } else {
            // Crear el mensaje si no existe
            mensajeNoResultados = document.createElement('div');
            mensajeNoResultados.id = "mensaje-no-resultados";
            mensajeNoResultados.textContent = "No se encontraron propiedades que coincidan con los criterios seleccionados.";
            mensajeNoResultados.style.display = hayResultados ? "none" : "block";
            contenedorPrincipal.appendChild(mensajeNoResultados);
        }
    }

    // Función alternativa para filtrar por menú items
    function filtrarPorMenu() {
        // Obtener referencias a los elementos del menú
        let item0 = document.getElementById("item-0");
        let item1 = document.getElementById("item-1");
        let item2 = document.getElementById("item-2");
        let item3 = document.getElementById("item-3");
        let item4 = document.getElementById("item-4");
        
        // Verificar si existen los elementos del menú
        if (!item0 && !item1 && !item2 && !item3 && !item4) {
            console.log("Elementos de menú no encontrados");
            return;
        }
        
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
        
        // Función interna para mostrar/ocultar propiedades según el filtro
        function filtrarPorTipo(filtro) {
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
        if (item0) {
            item0.addEventListener("click", function() {
                filtrarPorTipo("casa");
            });
        }
        
        if (item1) {
            item1.addEventListener("click", function() {
                filtrarPorTipo("villa");
            });
        }
        
        if (item2) {
            item2.addEventListener("click", function() {
                filtrarPorTipo("apartamento");
            });
        }
        
        if (item3) {
            item3.addEventListener("click", function() {
                filtrarPorTipo("renta");
            });
        }
        
        if (item4) {
            item4.addEventListener("click", function() {
                filtrarPorTipo("venta");
            });
        }
        
        // Mostrar todas las propiedades al cargar la página
        filtrarPorTipo("todos");
    }

    // Intentar configurar el filtro principal primero
    let selectOperacion = document.getElementById("select-operacion");
    let selectTipo = document.getElementById("select-tipo");

    if (selectOperacion && selectTipo) {
        selectOperacion.addEventListener("change", filtrarPropiedades);
        selectTipo.addEventListener("change", filtrarPropiedades);


    } else {
        // Si no están los selects, usar la navegación alternativa
        filtrarPorMenu();
    }
}

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





// carrito de compras









  
  




