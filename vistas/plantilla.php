<?php
  session_start();
?>

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
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables/css/responsive.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <!-- <link rel="stylesheet" href="vistas/plugins/sweetalert2/dist/sweetalert2.min.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- Css propio -->
  <link rel="stylesheet" href="vistas/dist/css/main.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> -->
</head>
<?php
		date_default_timezone_set('America/Tegucigalpa');
    
    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && $_SESSION["primerIngreso"] == 1){
      echo '<body class="primer-ingreso">';

      echo '<div class="wrapper">';
      // include "modulos/primer-ingreso.php";

      /*=============================================
          CONTENIDO
      =============================================*/

      if(isset($_GET["ruta"])){
        // if($_SESSION['rol'] == 'Administrador' && $_SESSION['rol'] == 'Especial') {

          if($_GET["ruta"] == "primer-ingreso" ||
              $_GET["ruta"] == "salir"){
  
              include "modulos/".$_GET["ruta"].".php";
  
              }else{
  
                include "modulos/primer-ingreso.php";
  
              }
        // }
      }
    }

    else if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
      echo '<body class="hold-transition sidebar-mini sidebar-collapse">';

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

        if($_SESSION['rol'] == 'Administrador'){
          
          if($_GET["ruta"] == "dashboard" ||
            $_GET["ruta"] == "usuarios" ||
            $_GET["ruta"] == "bitacora" ||
            $_GET["ruta"] == "categorias" ||
            // $_GET["ruta"] == "ajustes-cuenta" ||
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
            $_GET["ruta"] == "perfil" ||
            $_GET["ruta"] == "agregar-persona" ||
            $_GET["ruta"] == "salir"){

            include "modulos/".$_GET["ruta"].".php";

            }else{

              include "modulos/404.php";

            }

        } else {

            if($_GET["ruta"] == "dashboard" ||
            $_GET["ruta"] == "salir"){

            include "modulos/".$_GET["ruta"].".php";

            }else{

              include "modulos/404.php";

            }

        }

      } else{

        include "modulos/dashboard.php";

      }

      /*=============================================
          FOOTER
      =============================================*/

      include "modulos/footer.php";

      echo '</div>';

      

    } else{
      
      // echo '<body class="hold-transition login-page sidebar-mini">';

      // include "modulos/login.php";

      if(isset($_GET["ruta"])){

        if($_GET["ruta"] == "recuperar-password" ||
           $_GET["ruta"] == "login"){
          echo '<body class="hold-transition login-page sidebar-mini">';

          include "modulos/".$_GET["ruta"].".php";
          
        } 
        else {

          echo '<body class="hold-transition login-page sidebar-mini">';
          
          include "modulos/login.php";

        }

      } else {
         echo '<body class="hold-transition login-page sidebar-mini">';

        include "modulos/login.php";

      }

    }

    ?>

<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert 2 -->
<!-- <script src="vistas/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script> -->
<!-- InputMask -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/inputmask/jquery.inputmask.bundle.min.js"></script>
<!-- DataTables -->
<script src="vistas/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vistas/dist/js/demo.js"></script>


<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/login.js"></script>
<script src="vistas/js/primer-ingreso.js"></script>
<script src="vistas/js/agregar-persona.js"></script>
 <script src="vistas/js/usuarios-empleados.js"></script>
 <script src="vistas/js/clientes.js"></script>

<!--<script src="vistas/js/validaciones.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/productos.js"></script>

<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/reportes.js"></script> -->


</body>
</html>


