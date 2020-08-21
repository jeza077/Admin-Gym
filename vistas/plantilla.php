<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador | Gym "La Roca"</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  <!-- Css propio -->
  <link rel="stylesheet" href="vistas/dist/css/main.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body class="hold-transition sidebar-mini">
<?php

    // if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    echo '<div class="wrapper">';

      /*=============================================
            HEADER
      =============================================*/

      include "modulos/header.php";

      /*=============================================
          MENU
      =============================================*/

      include "modulos/menu.php";

      /*=============================================
          CONTENIDO
      =============================================*/

      if(isset($_GET["ruta"])){

        if($_GET["ruta"] == "inicio" ||
          $_GET["ruta"] == "usuarios" ||
          $_GET["ruta"] == "categorias" ||
          $_GET["ruta"] == "empleados" ||
          $_GET["ruta"] == "productos" ||
          $_GET["ruta"] == "clientes" ||
          $_GET["ruta"] == "ventas" ||
          $_GET["ruta"] == "crear-venta" ||
          $_GET["ruta"] == "editar-venta" ||
          $_GET["ruta"] == "reportes" ||
          $_GET["ruta"] == "mensajeria" ||
          $_GET["ruta"] == "proveedores" ||
          $_GET["ruta"] == "auditoria" ||
          $_GET["ruta"] == "configuracion" ||
          $_GET["ruta"] == "agregar-persona" ||
          $_GET["ruta"] == "salir"){

          include "modulos/".$_GET["ruta"].".php";

        }else{

          include "modulos/404.php";

        }

      } else{

        include "modulos/inicio.php";

      }

      /*=============================================
          FOOTER
      =============================================*/

      include "modulos/footer.php";

      echo '</div>';

      

    // } else{

    //   include "modulos/login.php";

    // }

    ?>

<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert 2 -->
<!-- <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script> -->
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vistas/dist/js/demo.js"></script>


<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/login.js"></script>
<script src="vistas/js/agregar-persona.js"></script>
<!-- <script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/validaciones.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/reportes.js"></script> -->


</body>
</html>


