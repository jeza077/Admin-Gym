<?php

    //** ALERTA POR FECHA DE VENCIMIENTO DE USUARIO */
    $tabla = "tbl_usuarios";
    $item = "id_usuario";
    $valor = $_SESSION["id_usuario"];

    $usuario = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);

    $fechaUsuario = $usuario['fecha_vencimiento'];
    $fechaHoy = date('Y-m-d');
    $date1 = new DateTime($fechaHoy);
    $date2 = new DateTime($fechaUsuario);
    $diff = $date1->diff($date2);

    if($diff->days <= 7){

        $titulo = "Tu usuario vencera en $diff->days dias!";
        $texto = "Cambia tu contraseña para resetear la fecha de vencimiento.";
        $icono = "warning";
        //$modulo = "dashboard";
        // $alerta = ControladorGlobales::ctrAlertas($titulo, $texto, $icono);
        // return;
    }

    //** ALERTA POR FECHA DE VENCIMIENTO DE INSCRIPCIÓN DE CLIENTES */
    // $tabla = "tbl_clientes";
    // $item1 = 'tipo_cliente';
    // $valor1 = 'Gimnasio';
    // $item2 = 'estado';
    // $valor2 = 1;
    // $max = null;
    // $clientes = ControladorClientes::ctrMostrarClientesInscripcionPagos($tabla, $item1, $valor1, $item2, $valor2, $max);

    // echo $fechaHoy;
    
    // if($fechaHoy == $clientes[3]['fecha_proximo_pago']){
    // //     echo 'iguales';
    // // } else {
    // //     echo 'no son iguales';
    // // }
    
    $item = 'fecha_proximo_pago';
    $fechaActual = new DateTime();
    $fechaActual->add(new DateInterval("P7D"));
    $fechaActualMas = $fechaActual->format("Y-m-d");

    // echo $fechaActual;

    $clientes = ModeloClientes::mdlInscripcionVencimiento($item, $fechaHoy, $fechaActualMas);
    
    // echo "<pre>";
    // var_dump($clientes);
    // echo "</pre>";

    // $val = false;
    // foreach ($clientes as $key => $value) {
    //     $val = $val || ($fechaHoy == $value['fecha_proximo_pago']);
    // }

    // var_dump($val);

    // if($clientes){

    //     $tituloCliente = "Clientes con inscripción vencida!";
    //     $textoCliente = "";
    //     $iconoCliente = "warning";
    //     //$modulo = "dashboard";
    //     $alertaCliente = ControladorGlobales::ctrAlertaCliente($tituloCliente, $textoCliente, $iconoCliente);
    // }

?>