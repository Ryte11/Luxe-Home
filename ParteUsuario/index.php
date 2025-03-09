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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="Fuentes/Inter-VariableFont_slnt,wght.ttf" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <title>Home</title>
</head>

<body>
  <div class="contenedor">
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

    <!-- Menu desplegable  -->
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

    <div class="back-drop">
      <div class="contenedor-venta">
        <div class="venta">
          <button class="flecha-iz" data-aos="fade-right" data-aos-duration="1000">
            <img src="img/Flecha.png" alt="" />
          </button>
          <div class="centro" data-aos="fade-up" data-aos-duration="1300">
            <div class="contenido-venta">
              <div class="texto-1">
                <h1>villa Lujosa Moderna</h1>
                <h3>Samaná, República Dominicana</h3>
              </div>
            </div>
            <div class="Descripcion">
              <div class="details">
                <div class="Descripcion1">
                  <div class="cama">
                    <img src="img/Cama.png" alt="" />
                  </div>
                  <div>
                    <h1 class="room-label"></h1>
                    <h3 class="room-count"></h3>
                  </div>
                </div>
                <div class="Descripcion1">
                  <div class="cama">
                    <img src="img/Baño.png" alt="" />
                  </div>
                  <div>
                    <h1 class="baños-label"></h1>
                    <h3 class="baños-count"></h3>
                  </div>
                </div>
              </div>
              <div class="precio">
                <div class="precio-1">
                  <h2>For Sale</h2>
                  <h1></h1>
                </div>
              </div>
            </div>
          </div>
          <button class="flecha-de" data-aos="fade-left" data-aos-duration="1000">
            <img src="img/Flecha.png" alt="" />
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="busqueda">
    <div class="selects">
      <div class="Selecciona" data-aos="fade-right" data-aos-duration="1500">
        <div class="select1">
          <select name="" id="select-operacion">
            <option value="ventas">ventas</option>
            <option value="rentas">rentas</option>
          </select>
          <div class="arrow"></div>
        </div>

        <div class="select1">
          <select name="" id="select-tipo">
            <option value="casas">casas</option>
            <option value="villas">villas</option>
            <option value="apartamentos">apartamentos</option>
          </select>
          <div class="arrow"></div>
        </div>
      </div>
      <div class="buscador_Des">
        <input class="input1" type="search" placeholder="Search" id="buscador" data-aos="fade-left"
          data-aos-duration="1500" />
        <div class="group" data-aos="fade-left" data-aos-duration="1500" onclick="cambiar_productos()">

          <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
            <g>
              <path
                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
              </path>
            </g>
          </svg>
          <button class="input" type="button" onclick="cambiar_productos()">buscar</button>

        </div>
      </div>
    </div>
  </div>
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
  <div class="overlay" id="overlay"></div>
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
  <div class="overlay" id="overlayPerfil"></div>
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



  <!-- vistas de procuctos -->



  <!-- catalogo de destacados -->


  <div class="Textocatalogo" data-aos="fade-up" data-aos-duration="1300" id="seccion1">
    <h1>Propiedades Destacadas</h1>
    <div class="linea"></div>
  </div>

  <!-- Catalogo 3 Ventas villas-->

  <div class="catalogo" id="catalogo3">
    <div class="cat1">
      <h1>No hay Villas a la venta!</h1>
    </div>
    <div class="boton-vermas" data-aos="fade-up" data-aos-duration="800">
      <a href="Productos.html">
        <button>Ver más Productos</button>
      </a>
    </div>
  </div>





  <!-- interactivo generacion -->

 <div class="catalogo" id="catalogo">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="info-carta" data-tipo="<?= $row['categoria'] ?>-<?= $row['operacion'] ?>">
        <div class="venta1">
          <h3><?= ucfirst($row['operacion']) ?></h3>
        </div>
        <a type="button" class="img-boton" onclick="vermas1()">
          <img src="<?= $row['imagen'] ?>" alt="" class="img-carta" />
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


  <div class="boton-vermas">
    <a href="Productos.php">
      <button>Ver más</button>
    </a>
  </div>
  </div>
  <div class="quienes_somos" id="seccion2">
    <h1>Why Choose Us</h1>
    <div class="linea1"></div>
  </div>

  <div class="Qn_contenedor">

    <div class="qn_1">
      <div class="texto_img">
        <img src="img/Gama_propiedades.png" alt="">
        <div class="text1_qn">
          <h1>AMPLIA GAMA DE PROPIEDADES</h1>
          <p>Con una sólida selección de propiedades populares disponibles, así como propiedades líderes de expertos.
          </p>
        </div>
      </div>
      <div class="texto2_img">
        <img src="img/Finanzacion.png" alt="">
        <div class="text1_qn">
          <h1>FINANCIACIÓN FÁCIL</h1>
          <p>Nuestro departamento de finanzas sin problemas puede encontrar soluciones financieras para ahorrarle
            dinero.</p>
        </div>
      </div>
    </div>



  </div>



  <div class="Qn_contenedor">

    <div class="qn_1">
      <div class="texto_img">
        <img src="img/icons8-confianza-50 (1).png" alt="">
        <div class="text1_qn">
          <h1>CONFIANZA POR MILES</h1>
          <p>Nuevas ofertas diarias y las mejores opiniones, entre nuestros usuarios y clientes.</p>
        </div>
      </div>
      <div class="texto2_img">
        <img src="img/Transparencia.png" alt="">
        <div class="text1_qn">
          <h1>TRANSPARENCIA</h1>
          <p>Usted y su Vendedor siempre ven la misma información y recibirán toda la información importante
            directamente en su oficina de correos.</p>
        </div>
      </div>
    </div>



  </div>

  <div class="Qn_contenedor">

    <div class="qn_1">
      <div class="texto_img">
        <img src="img/Ubicacion.png" alt="">
        <div class="text1_qn">
          <h1>Cerca de Ti</h1>
          <p>Tienes acceso para buscar en cualquier lugar, cerca de cualquier vecindario, escuela o área que desees.
          </p>
        </div>
      </div>
      <div class="texto2_img">
        <img src="img/Estrella.png" alt="">
        <div class="text1_qn">
          <h1>Puedes escoger</h1>
          <p>Puedes escoger, si deseas rentar, comprar o una villa para un fin de semana. Esto te lo permitimos y con el
            presupuesto que tengas disponible, siempre habra una propiedad.</p>
        </div>
      </div>
    </div>
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
          <li><a href="Productos.html">Productos</a></li>
          <li><a href="">Contact Us</a></li>
        </ul>
      </div>

    </div>
    <div class="footerBottom">
      <p>Copyright &copy;2024; Diseñado por <span class="designer">Luisangel Ramirez</span></p>
    </div>
  </footer>


  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/js.js"></script>
</body>

</html>