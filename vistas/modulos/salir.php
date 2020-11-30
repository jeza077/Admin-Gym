<?php
 $descripcionEvento = " Salio del sistema";
 $accion = "salir";
 $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
session_destroy();

echo '<script>
        window.location = "login";
    </script>';
    