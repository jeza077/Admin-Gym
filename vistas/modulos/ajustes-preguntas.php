<?php
require_once "../../controladores/personas.controlador.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
?>
<div class="container-fluid ajustes-preguntas">
    <div class="card-header mt-2">
        <h3>Preguntas de seguridad</h3>
    </div>

    <div class="card-body">
        <form method="post" id="primerIngreso">
            <?php 
                $item = 'parametro';
                $valor = 'ADMIN_PREGUNTAS';
                $parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
                // var_dump($parametros['valor']);
                $cantidadPreguntas = $parametros['valor'];
                
                for ($i=0; $i < $cantidadPreguntas ; $i++) { ?>

                <div class="card-body">
            
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="">Pregunta <?php echo ($i+1)?></label>
                            <select class="form-control select2" name="editarPregunta[]">
                                <option value="" class="preguntaUsuario<?php echo $i?>"></option>
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
                        
                        <div class="form-group col-md-6">
                            <label class="" for="">Respuesta <?php echo ($i+1)?></label>
                            <input type="text" class="form-control mayus respuestaPregunta<?php echo $i?>" value="" name="editarRespuestaPregunta[]" placeholder="Ingrese respuesta">
                        </div>

                    </div>

                </div>
            <?php
                }            
            ?>
             <div class="form-row float-right mr-4">
                <div class="form-group" id="pregunta<?php echo $i?>">
                    <button type="" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger salirPerfil" data-dismiss="modal">Salir</button>
                </div>
            </div>
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