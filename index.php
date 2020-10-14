<?php

date_default_timezone_set("America/Tegucigalpa");

require_once "controladores/plantilla.controlador.php";
require_once "controladores/personas.controlador.php";
require_once "controladores/globales.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/mantenimiento.controlador.php";

require_once "modelos/globales.modelo.php";
require_once "modelos/personas.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();