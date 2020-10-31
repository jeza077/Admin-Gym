<?php
error_reporting(E_ALL & ~E_NOTICE);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Controladorinventario {
        static public function mdlMostrarinventario($tabla, $item, $valor){
        $tabla1 = "tbl_inventario";
        $tabla2 = $tabla;

        $respuesta = Modeloinventario::mdlMostrarinventario($tabla1, $tabla2, $item, $valor);

        return $respuesta;
         }
}