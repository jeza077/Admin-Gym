<?php

date_default_timezone_set("America/Tegucigalpa");

require_once "controladores/plantilla.controlador.php";
require_once "controladores/personas.controlador.php";
require_once "controladores/globales.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/inventario.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/mantenimiento.controlador.php";


require_once "modelos/globales.modelo.php";
require_once "modelos/personas.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/inventario.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();


// $host= $_SERVER["HTTP_HOST"];
// $url= $_SERVER["REQUEST_URI"];
// $urlF = "http://" . $host . $url;
// echo '<script>	
//     Swal.fire({
//         title: "'.$urlF.'",
//         icon: "info",
//         showConfirmButton: true,
//         confirmButtonText: "Cerrar",
//         width: 600
//     });	

// </script>';