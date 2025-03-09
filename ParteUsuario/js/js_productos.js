
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
  // Obtener referencias a los catálogos y los ítems
  let cat1 = document.getElementById("catalogo1");
  let cat2 = document.getElementById("catalogo2");
  let cat3 = document.getElementById("catalogo3");
  let cat4 = document.getElementById("catalogo4");
  let cat5 = document.getElementById("catalogo5");
  let item0 = document.getElementById("item-0");
  let item1 = document.getElementById("item-1");
  let item2 = document.getElementById("item-2");
  let item3 = document.getElementById("item-3");
  let item4 = document.getElementById("item-4");

  // Función para ocultar todos los catálogos
  function ocultarTodos() {
    cat1.style.display = "none";
    cat2.style.display = "none";
    cat3.style.display = "none";
    cat4.style.display = "none";
    cat5.style.display = "none";
  }

  // Event listeners para cada ítem
  item0.addEventListener("click", function() {
    ocultarTodos();
    cat1.style.display = "flex"; 
    mostrarCatalogo("Homes"); 
  });

  item1.addEventListener("click", function() {
    ocultarTodos(); 
    cat2.style.display = "flex";
    mostrarCatalogo("Villas");
  });

  item2.addEventListener("click", function() {
    ocultarTodos(); 
    cat3.style.display = "flex"; 
    mostrarPropiedades("Apartamentos"); 
  });

  item3.addEventListener("click", function() {
    ocultarTodos(); 
    cat4.style.display = "flex";
    mostrarPropiedades("Alquileres"); 
  });
  item4.addEventListener("click", function() {
    ocultarTodos(); 
    cat5.style.display = "flex"; 
    mostrarPropiedades("Ventas"); 
  });
}


document.addEventListener("DOMContentLoaded", cambiar_productos);

document.addEventListener('DOMContentLoaded', function() {
    var overlayPerfil = document.getElementById('overlayPerfil');
    overlayPerfil.addEventListener('click', function(event) {
        if (event.target === overlayPerfil) {
            ocultarPerfil();
        }
    });
});


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

