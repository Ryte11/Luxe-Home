<?php
include 'PHP/conexion.php';

// Realizar consulta a la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
  die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/products.css">
  <link rel="stylesheet" type="text/css" href="Fuentes/Inter-VariableFont_slnt,wght.ttf" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Products</title>
</head>

<body>

  <header class="header">
    <div class="menu">
      <div class="logo" data-aos="fade-right" data-aos-duration="1400">
        <a href="#">
          <div class="logo_back">
            <img src="img/icons8-casa-26.png" alt="" />
          </div>
          <h1>Luxe Home</h1>
        </a>
      </div>

      <nav class="nav" data-aos="fade-down" data-aos-duration="1400" id="ul">
        <ul class="menu" id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="Productos.php">Products</a></li>
          <li><a href="#seccion1">Destacados</a></li>
          <li><a href="#seccion2">¿Quienes somos?</a></li>
          <li><a href="Contactos.html">Contact US</a></li>
        </ul>
      </nav>

      <div class="iconos" data-aos="fade-left" data-aos-duration="1400">
        <div class="like" onclick="abrirCarrito()">
          <span class="like-button" id="like-button">0</span>
          <button>
            <img src="img/icons8-me-gusta-24.png" alt="" class="icon1" />
          </button>
        </div>
        <div class="profile" onclick="mostrarFormulario()">
          <button>
            <img src="img/icons8-usuario-50.png" alt="" class="icon2" />
          </button>
        </div>

        <button id="abrir" class="abrir-menu" onclick="menuAbrir()">
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-list"
            viewBox="0 0 16 16">
            <path widht="80px" fill-rule="evenodd"
              d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
          </svg>
        </button>


      </div>
    </div>
  </header>

  <!-- menu desplegable -->

  <div class="over" id="over"></div>
    <div id="carrito1" class="carrito1">
      <div class="arriba_text1">
        <img src="img/icons8-x-50.png" alt="" onclick="MenuCerrar()">
      </div>
      <nav class="nav1" data-aos="fade-down" data-aos-duration="1400" id="ul">
        <ul class="menu1" id="menu">
          <li><a href="index.html">Home</a></li>
          <li><a href="Productos.php">Products</a></li>
          <li><a href="#seccion1">Destacados</a></li>
          <li><a href="#seccion2">¿Quienes somos?</a></li>
          <li><a href="Contactos.html">Contact US</a></li>
        </ul>
      </nav>
    </div>
  <!-- Carrito de compras -->
  <div class="over" id="over"></div>
  <div id="carrito" class="carrito">
    <div class="arriba_text">
      <h1>Carrito de Compras</h1>
      <img src="img/icons8-multiply-50.png" alt="" onclick="cerrarCarrito()">
    </div>
    <div class="carrito-items1">
      <div class="carrito_text">
        <h3>Imagen</h3>
        <h3>Nombre</h3>
        <h3>Precio</h3>
        <div></div>
      </div>
      <div class="linea3"></div>
    </div>
    <div id="carrito-items" class="carrito-items">
    </div>
    <div class="botones">
      <div id="total" class="total">Total: $<span id="total-precio">0</span></div>
      <button onclick="compra()">Comprar</button>
      <button onclick="limpiar()">Limpiar Carrito</button>
    </div>
  </div>

  <!-- Form de usuario -->
  <div class="overlay-form" id="overlay"></div>
  <div class="form-box" id="formBox">
    <form class="form" id="form">
      <span class="title">Sign up</span>
      <span class="subtitle">Crea una cuenta gratuita con tu email.</span>
      <div class="form-container">
        <input type="text" class="input1" placeholder="Nombre Completo" id="name" required>
        <input type="email" class="input1" placeholder="Email" id="email" required>
        <input type="password" class="input1" placeholder="Password" id="password" required>
      </div>
      <button type="submit">Sign up</button>
    </form>
    <div class="form-section">
      <p>Ya tienes una cuenta? <button onclick="mostrarFormulario1()">Inicia sesión</button> </p>
    </div>
  </div>

  <div class="form-box" id="formBox1">
    <form class="form" id="form1">
      <span class="title">Log in</span>
      <span class="subtitle">Inicia seccion con tu cuenta.</span>
      <div class="form-container">
        <input type="email" class="input1" placeholder="Email" id="email1">
        <input type="password" class="input1" placeholder="Password" id="password1">
      </div>
      <button type="submit">Log In</button>
    </form>
  </div>

  <!-- Pop-up de perfil de usuario -->
  <div class="overlay-perfil" id="overlayPerfil"></div>
  <div class="form-box" id="perfilBox">
    <div class="form">
      <span class="title">Perfil</span>
      <div class="form-container">
        <img src="img/icons8-usuario-50.png" alt="" id="perfilImagen" />
        <h1 id="perfilNombre">Nombre</h1>
        <p id="perfilEmail">Email</p>
      </div>
      <button onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>
  </div>




  <div class="text_catalogo" data-aos="fade-up" data-aos-duration="1300">
    <h1>Explora nuestro catalogo</h1>
    <div class="linea"></div>
    <p>Explora todos los diferentes tipos de apartamentos para que puedas elegir la mejor opción para ti.
    </p>
  </div>

  <div class="contenedor_catalogo">
    <div class="centro_catalogo">
      <div class="angry-grid">
        <div id="item-0" class="item-imagen" >
          <div class="overlay">
            <div class="texto-img">
              <div class="tittle-img">
                <h1>Houses</h1>
                <div class="arrow-1">
                  <div class="arrow"></div>
                </div>
              </div>
              <p>12 Propiedades</p>
            </div>
          </div>


        </div>
        <div id="item-1" class="item-imagen">
          <div class="overlay1">
            <div class="texto-img">
              <div class="tittle-img">
                <h1>Villas</h1>
                <div class="arrow-1">
                  <div class="arrow"></div>
                </div>
              </div>
              <p>10 Propiedades</p>
            </div>
          </div>

        </div>
        <div id="item-2" class="item-imagen">
          <div class="overlay2">
            <div class="texto-img">
              <div class="tittle-img">
                <h1>Apartamentos</h1>
                <div class="arrow-1">
                  <div class="arrow"></div>
                </div>
              </div>
              <p>8 Propiedades</p>
            </div>
          </div>
        </div>
        <div id="item-3" class="item-imagen" >
          <div class="overlay3">
            <div class="texto-img">
              <div class="tittle-img">
                <h1>Alquileres</h1>
                <div class="arrow-1">
                  <div class="arrow"></div>
                </div>
              </div>
              <p>20 Propiedades</p>
            </div>
          </div>
        </div>
        <div id="item-4" class="item-imagen" >
          <div class="overlay4">
            <div class="texto-img">
              <div class="tittle-img">
                <h1>Ventas</h1>
                <div class="arrow-1">
                  <div class="arrow"></div>
                </div>
              </div>
              <p>6 Propiedades</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- vistas de procuctos -->




  <div class="Textocatalogo" data-aos="fade-up" data-aos-duration="1300" id="seccion1">
    <h1 id="title">Luxury Homes</h1>
    <div class="linea"></div>
  </div>



  <!-- parte dinamica cartas -->

  <div class="catalogo" id="catalogo">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="info-carta" data-tipo="<?= $row['categoria'] ?>-<?= $row['operacion'] ?>">
        <div class="venta1">
          <h3><?= ucfirst($row['operacion']) ?></h3>
        </div>
        <a type="button" class="img-boton" onclick="vermas1()">
          <img src="../Admin/<?= $row['imagen'] ?>" alt="" class="img-carta" />
        </a>
        <div class="contenedor-icons">
          <h3 class="title-des"><?= $row['nombre'] ?></h3>
          <div class="info-icon">
            <img src="img/cama2.png" alt="" />
            <p><?= $row['habitaciones'] ?> Rooms</p>
            <img src="img/Bañera.png" alt="" />
            <p><?= $row['banos'] ?> BathRooms</p>
          </div>
          <div class="info-icon">
            <img src="img/Garage.png" alt="" />
            <p>Garage</p>
            <img src="img/pool.png" alt="" />
            <p>Pool</p>
          </div>
          <div class="price">
            <div>
              <h3>$<?= number_format($row['precio'], 2) ?>/Noche</h3>
            </div>
            <div class="contenedor-icons1">
              <div class="heart-container" title="Like">
                <input type="checkbox" class="checkbox" id="Corazon"
                  onclick="agregarAlCarrito('<?= $row['imagen'] ?>', '<?= $row['categoria'] ?>', <?= $row['precio'] ?>)" />
                <div class="svg-container">
                  <svg viewBox="0 0 24 24" class="svg-outline" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                    </path>
                  </svg>
                  <svg viewBox="0 0 24 24" class="svg-filled" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                    </path>
                  </svg>
                </div>
              </div>
              <div class="eye-icon">
                <img src="img/Ojo.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="mensaje-no-resultados" style="display: none;">
        No se encontraron propiedades que coincidan con los criterios seleccionados.
      </div>
    <?php endwhile; ?>
  </div>
  
 
  <footer>
    <div class="footerContainer">
      <div class="socialIcons">
        <a href=""><i class="fa-brands fa-facebook"></i></a>
        <a href=""><i class="fa-brands fa-instagram"></i></a>
        <a href=""><i class="fa-brands fa-twitter"></i></a>
        <a href=""><i class="fa-brands fa-youtube"></i></a>
      </div>
      <div class="footerNav">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#seccion1">Destacados</a></li>
          <li><a href="#seccion2">Quienes somos</a></li>
          <li><a href="Productos.php">Productos</a></li>
          <li><a href="contactos.php">Contact Us</a></li>
        </ul>
      </div>

    </div>
    <div class="footerBottom">
      <p>Copyright &copy;2024; Diseñado por <span class="designer">Luisangel Ramirez</span></p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/productos.js"></script>
  <script src="js/carrito.js"></script>
</body>

</html>