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




//validacion de formularios
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



// validacion contactos
const formContact = document.getElementById('formContact');

function validacionContact(event) {
  event.preventDefault();

  const nombre = document.getElementById("nombre");
  const email = document.getElementById("correo");
  const numero = document.getElementById("telefono");
  const mensaje = document.getElementById("mensaje");
  const primerosNums = numero.value.substring(0, 3);

  if (
    nombre.value === "" ||
    email.value === "" ||
    numero.value === "" 
  ) {
    alert("Todos los campos deben ser completados.");
    return false;
  } else if (nombre.value.length < 6) {
    alert("El nombre no es válido.");
    return false;
  } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value)) {
    alert("El email no es válido.");
    return false;
  } else if (numero.value.length !== 10) { 
    alert("El número debe contener exactamente 10 dígitos.");
    return false;
  } else if (primerosNums !== "849" && primerosNums !== "809" && primerosNums !== "829") {
    alert("El número ingresado es incorrecto, debe contener 829, 849 o 809.");
    return false;
  } else if (mensaje.value.length < 20) {
    alert("Este mensaje esta muy poco detallado.");
    return false;
  } else {
    alert('FORMULARIO ENVIADO')
    
    setTimeout(function() {
      formContact.submit();
    }, 1000);
  }
}




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
