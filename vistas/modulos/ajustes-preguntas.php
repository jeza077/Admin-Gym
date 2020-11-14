<?php
require_once "../../controladores/personas.controlador.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
?>
<div class="container-fluid ajustes-preguntas">
    <div class="card-header mt-2">
        <h3>Preguntas de seguridad</h3>
    </div>

    <div class="card-body contenedor2">
        <form method="post" id="primerIngreso">
            <?php 
                $item = 'parametro';
                $valor = 'ADMIN_PREGUNTAS';
                $parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
                // var_dump($parametros['valor']);
                $cantidadPreguntas = $parametros['valor'];
                
                for ($i=1; $i <=$cantidadPreguntas ; $i++) { ?>

                <div class="card-body contenedor-primer-ingreso pregunta<?php echo $i?>">
            
                    <!-- <div class="form-row"> -->

                        <div class="form-group">
                            <label for="">Pregunta <?php echo $i?></label>
                            <select class="form-control select2" name="nuevaPregunta[]">
                                <option selected="selected">Seleccionar...</option>
                                <?php 
                                    $tabla = "tbl_preguntas";
                                    $item = null;
                                    $valor = null;

                                    $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                                    foreach ($preguntas as $key => $value) { ?>
                                        <option value="<?php echo $value['id_preguntas']?>"><?php echo $value['pregunta']?></option>        
                                    <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="" for="">Respuesta <?php echo $i?></label>
                            <input type="text" class="form-control mayus respuesta<?php echo $i?>" name="respuestaPregunta[]" placeholder="Ingrese respuesta">
                        </div>

                        <div class="form-group mt-4" id="pregunta<?php echo $i?>">
                            <!-- <a href="salir" class="btn btn-danger salir float-left">Salir</a>
                            <a href="javascript:void(0);" class="btn btn-primary salir float-right" onclick="togglePregunta<?php echo $i+1?>();">Siguiente</a> -->
                        </div>
                    <!-- </div> -->

                </div>
            <?php
                }            
            ?>
        </form>
    </div>
    <!-- <div class="card-body">
        <form role="form" method="post" class="formulario" enctype="multipart/form-data">

                <div class="form-group final mt-4 float-right">
                    <button type="" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger salirPerfil" data-dismiss="modal">Salir</button>
                </div>
            
                <?php
                    $tipoPersona = 'usuarios';
                    $pantalla = 'usuarios';
                    $ingresarPersona = new ControladorPersonas();
                    $ingresarPersona->ctrCrearPersona($tipoPersona, $pantalla);
                ?>

        </form>
    </div> -->
</div>