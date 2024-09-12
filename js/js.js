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
    var isClickedInsideForm = formBox.contains(event.target);
    if (!isClickedInsideForm) {
      MenuCerrar()();
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
  let cat1 = document.getElementById("catalogo1");
  let cat2 = document.getElementById("catalogo2");
  let cat3 = document.getElementById("catalogo3");
  let cat4 = document.getElementById("catalogo4");
  let cat5 = document.getElementById("catalogo5");
  let cat6 = document.getElementById("catalogo6");
  let cat0 = document.getElementById("catalogo");

  function ocultarTodos() {
      cat1.style.display = "none";
      cat2.style.display = "none";
      cat3.style.display = "none";
      cat4.style.display = "none";
      cat5.style.display = "none";
      cat6.style.display = "none";
      
  }

  function mostrarCatalogo() {
    let selectOperacion = document.getElementById("select-operacion");
    let selectTipo = document.getElementById("select-tipo");

    let operacion = selectOperacion.value.toLowerCase();
    let tipo = selectTipo.value.toLowerCase();

    ocultarTodos(true); 
    if (operacion === "ventas" && tipo === "casas") {
        console.log("Mostrando catálogo 1: Ventas - Casas");
        cat1.style.display = "flex";
        cat0.style.display = "none";
    } else if (operacion === "rentas" && tipo === "casas") {
        console.log("Mostrando catálogo 2: Rentas - Casas");
        cat2.style.display = "flex";
        cat0.style.display = "none";
    } else if (operacion === "ventas" && tipo === "villas") {
        console.log("Mostrando catálogo 3: Ventas - Villas");
        cat3.style.display = "flex";
        cat0.style.display = "none";
    } else if (operacion === "rentas" && tipo === "villas") {
        console.log("Mostrando catálogo 4: Rentas - Villas");
        cat4.style.display = "flex";
        cat0.style.display = "none";
    } else if (operacion === "ventas" && tipo === "apartamentos") {
        console.log("Mostrando catálogo 5: Ventas - Apartamentos");
        cat5.style.display = "flex";
        cat0.style.display = "none";
    } else if (operacion === "rentas" && tipo === "apartamentos") {
        console.log("Mostrando catálogo 6: Rentas - Apartamentos");
        cat6.style.display = "flex";
        cat0.style.display = "none";
    } else {
        console.log("Mostrando catálogo 0: Catálogo principal");
        cat0.style.display = "flex";
    }
}

  let selectOperacion = document.getElementById("select-operacion");
  let selectTipo = document.getElementById("select-tipo");

  selectOperacion.addEventListener("change", mostrarCatalogo);
  selectTipo.addEventListener("change", mostrarCatalogo);

  mostrarCatalogo();
}




// carrito de compras



let carrito = [];

function agregarAlCarrito(imagenURL, nombre, precio) {
  const index = carrito.findIndex(item => item.nombre === nombre && item.imagen === imagenURL);

  if (index !== -1) {
    carrito.splice(index, 1);
  } else {
    carrito.push({ imagen: imagenURL, nombre, precio });
  }
  actualizarCarrito();
}




// Función para eliminar un producto del carrito
function eliminarProducto(id) {
  const index = carrito.findIndex(item => item.id === id);
  
  if (index !== -1) {
   
    carrito.splice(index, 1);
    actualizarCarrito();
  }
}

function actualizarCarrito() {
  let carritoItems = document.getElementById("carrito-items");
  let totalPrecio = document.getElementById("total-precio");
  carritoItems.innerHTML = "";
  let total = 0;
  
  carrito.forEach(item => {
    let itemElement = document.createElement("div");
    itemElement.classList.add("producto-carrito");

    let imageElement = document.createElement("img");
    imageElement.src = item.imagen;
    imageElement.alt = item.nombre;
    imageElement.classList.add("imagen-carrito");

    let nameElement = document.createElement("p");
    nameElement.textContent = item.nombre;
    nameElement.classList.add("nombre-carrito");

    let priceElement = document.createElement("p");
    priceElement.textContent = `$${item.precio}`;
    priceElement.classList.add("precio-carrito");

    let deleteButton = document.createElement("button");
      deleteButton.textContent = "X";
      deleteButton.classList.add("eliminar-producto");

      deleteButton.addEventListener("click", function() {
          let productId = this.dataset.id;
          eliminarProducto(productId);
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
    let carrito = document.getElementById("carrito-items");
    let total = document.getElementById("total-precio");
    let corazon = document.getElementById("like-button");

    if (carrito.children.length === 0) {
        alert("El carrito está vacío");
    }
    while (carrito.firstChild) {
        carrito.removeChild(carrito.firstChild);
    }
    total.textContent = "0"
    corazon.textContent ="0"
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

overlay.style.display = 'block';
formBox.style.display = 'block';
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
  
  formBox1.style.display = 'block';
  overlay.style.display = 'block';
  formBox.style.display = 'none';
}

function ocultarFormulario() {
  var overlay = document.getElementById('overlay');
  var formBox = document.getElementById('formBox');
  var formBox1 = document.getElementById('formBox1');

  formBox1.style.display = 'none'
  overlay.style.display = 'none';
  formBox.style.display = 'none';
}




//validacion de registro
const form = document.getElementById("form")
function validacion(event) {
event.preventDefault();


const nombre = document.getElementById("name");
const email = document.getElementById("email");
const pasword = document.getElementById("password")

if (
  nombre.value === "" &&
  pasword.value === "" &&
  email.value === ""
  
) {
  alert("Todos los campos están vacíos");
  return false;
} else if (nombre.value.length < 6) {
  alert("El nombre no es válido tiene muy pocos caracteres");
  return false;
} else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value)) {
  alert("El email no es válido");
  return false;
}else if (pasword.value.length < 6) {
  alert("La contraseña tiene muy pocos caracteres");
  return false;
} else {
  alert('FORMULARIO ENVIADO') 
  ocultarFormulario();
  form.submit();
  nombre.value = "";
  email.value = "";
  pasword.value = "";
 
 
}
}


// validacion login
const form1 =document.getElementById("form1")
function validacion1(event) {
  event.preventDefault();
  
  const email = document.getElementById("email1");
  const pasword = document.getElementById("password1")
  
  if (
    pasword.value === "" &&
    email.value === ""
    
  ) {
    alert("Todos los campos están vacíos");
    return false;
  } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value)) {
    alert("El email no es válido");
    return false;
  }else if (pasword.value.length < 6) {
    alert("La contraseña tiene muy pocos caracteres");
    return false;
  } else {
    alert('FORMULARIO ENVIADO') 
    ocultarFormulario();
    form1.submit();
    email.value = "";
    pasword.value = "";
   
  }
  }



/// ver mas productos

/// ver mas 1

document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas2();
    }
  });
  });
  
  function vermas1() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas2() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }



  // ver mas 2
  document.addEventListener('DOMContentLoaded', function() {
    var overlay = document.getElementById('overlay');
    overlay.addEventListener('click', function(event) {
      var vermas = document.getElementById('ver_mas1');
      var isClickedInsideForm = vermas.contains(event.target);
      if (!isClickedInsideForm) {
        vermas4();
      }
    });
    });
    
    function vermas3() {
      var overlay = document.getElementById('overlay');
      var vermas = document.getElementById('ver_mas1');
      
      overlay.style.display = 'block';
      vermas.style.display = 'flex';
    }
    
    function vermas4() {
      var overlay = document.getElementById('overlay');
      var vermas = document.getElementById('ver_mas1');
    
      overlay.style.display = 'none';
      vermas.style.display = 'none';
    }


// ver mas 3
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas2');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas6();
    }
  });
  });
  
  function vermas5() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas2');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas6() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas2');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }


  // ver mas 3
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas3');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas8();
    }
  });
  });
  
  function vermas7() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas3');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas8() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas3');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }


   // ver mas 4
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas4');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas10();
    }
  });
  });
  
  function vermas9() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas4');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas10() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas4');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }



// ver mas 4
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas5');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas12();
    }
  });
  });
  
  function vermas11() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas5');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas12() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas5');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }


  // ver mas 5
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas6');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas14();
    }
  });
  });
  
  function vermas13() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas6');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas14() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas6');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }

  // ver mas 6
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas7');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas16();
    }
  });
  });
  
  function vermas15() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas7');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas16() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas7');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }


  // ver mas 7
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas8');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas18();
    }
  });
  });
  
  function vermas17() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas8');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas18() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas8');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }


  // ver mas 8
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas9');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas20();
    }
  });
  });
  
  function vermas19() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas9');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas20() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas9');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }


  // ver mas 9
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas10');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas22();
    }
  });
  });
  
  function vermas21() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas10');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas22() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas10');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }



   // ver mas 10
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('overlay');
  overlay.addEventListener('click', function(event) {
    var vermas = document.getElementById('ver_mas11');
    var isClickedInsideForm = vermas.contains(event.target);
    if (!isClickedInsideForm) {
      vermas24();
    }
  });
  });
  
  function vermas23() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas11');
    
    overlay.style.display = 'block';
    vermas.style.display = 'flex';
  }
  
  function vermas24() {
    var overlay = document.getElementById('overlay');
    var vermas = document.getElementById('ver_mas11');
  
    overlay.style.display = 'none';
    vermas.style.display = 'none';
  }









  
  // carrusel ver mas funcion

  const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const carousel = document.querySelector('.carrusel');

let index = 0;

nextBtn.addEventListener('click', () => {
    index = (index + 1) % carousel.children.length;
    let displacement = -100 * index;
    carousel.style.transform = 'translateX(' + displacement + '%)';
});

prevBtn.addEventListener('click', () => {
    index = (index - 1 + carousel.children.length) % carousel.children.length;
    let displacement = -100 * index;
    carousel.style.transform = 'translateX(' + displacement + '%)';
});

  
  




