const form = document.getElementById('form');

function validacion(event) {
  event.preventDefault();

  const nombre = document.getElementById("name");
  const email = document.getElementById("email");
  const cedula = document.getElementById("cedula");
  const direccion = document.getElementById("direccion");
  const num = document.getElementById("num");
  const codigo = document.getElementById("codigo");
  const cuenta = document.getElementById("cuenta");
  const metodo_pago = document.getElementById("metodo_pago");
  const casa = document.getElementById("tipo_casa");

  if (
    nombre.value === "" &&
    cedula.value === "" &&
    direccion.value === "" &&
    num.value === "" &&
    codigo.value === "" &&
    cuenta.value === "" &&
    metodo_pago.selectedIndex === 0 &&
    casa.selectedIndex === 0
  ) {
    alert("Todos los campos están vacíos");
    return false;
  } else if (nombre.value.length < 6) {
    alert("El nombre no es válido");
    return false;
  } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value)) {
    alert("El email no es válido");
    return false;
  } else if (cedula.value.length !== 11) {
    alert("La cedula necesita tener 11 Caracteres ");
    return false;
  } else if (cedula.value === "") {
    alert("El campo cedula esta vacio ");
    return false;
  } else if (direccion.value === "") {
    alert("El campo direccion esta vacio");
    return false;
  } else if (num.value === "") {
    alert("El campo direccion esta vacio");
    return false;
  } else if (codigo.value === "") {
    alert("El campo Codigo Postal esta vacio");
    return false;
  } else if (cuenta.value === "") {
    alert("El campo numero de cuenta esta vacio");
    return false;
  } else if (metodo_pago.selectedIndex === 0) {
    alert("El campo Metodo de pago esta vacio");
    return false;
  } else if (casa.selectedIndex === 0) {
    alert("El campo Tipo de casa esta vacio");
    return false;
  } else {
    alert('FORMULARIO ENVIADO')
    form.submit();
  }
}
