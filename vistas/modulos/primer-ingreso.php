<div class="card">
        <div class="form-row">
            <div class="col-md-10"></div>
            <div class="col-md-2 d-flex justify-content-center">
                <a href="salir" class="btn btn-outline-danger pl-4 pr-4 mt-3">Salir</a>
            </div>
        </div>

        <div class="form-row">
            <div class="contenedor1 login-logo col-md-5">
                <img src="vistas/img/plantilla/undraw_Process.svg" alt="">
            </div>

            <div class="contenedor2 card-body col-md-7">
                <div class="titulo">
                    <a href="login"><b>Bienvenid@ a bordo </b><?php echo $_SESSION["usuario"]?> :)</a>
                    <p class="login-box-msg">Por favor, cambia tu contraseña y agrega las preguntas de seguridad!</p>
                </div>

                <form method="post" id="primerIngreso">
                    <?php 
                        $item = 'parametro';
                        $valor = 'ADMIN_PREGUNTAS';
                        $parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
                        // var_dump($parametros);
                        $cantidadPreguntas = $parametros['valor'];
                        
                        for ($i=1; $i <=$cantidadPreguntas ; $i++) { ?>

                        <div class="card-body contenedor-primer-ingreso pregunta<?php echo $i?>">
                    
                            <!-- <div class="form-row"> -->

                                <div class="form-group">
                                    <label for="">Pregunta <?php echo $i?></label>
                                    <select class="form-control" id="selectPreguntas<?php echo $i?>" name="nuevaPregunta[]">
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

                                </div>
                            <!-- </div> -->

                        </div>
                    <?php
                        }            
                    ?>

                    <div class="card-body contenedor-primer-ingreso password-primer-ingreso">
                        <div class="form-group" id="passwordPrimerIngreso">

                            <div class="form-group passwords">
                                <i class="far fa-eye show-nueva-pass primero" action="hide"></i>
                                <i class="far fa-eye show-confir-pass segundo" action="hide"></i>
                                <span class="resultado-password help-block mt-1 float-right"></span>
                            </div>
                        </div>

                        <div class="form-group mt-4" id="guardarPassPrimerIngreso">

                        </div>
                    </div>

                    <?php 
                        $id = $_SESSION["id_usuario"];
                        $usuario = $_SESSION["usuario"];
                        $contraseñaPreguntas = new ControladorUsuarios();
                        $contraseñaPreguntas->ctrNuevaContraseñaPreguntasSeguridad($id, $usuario);
                    ?>
                </form>
                
                <?php
                    $descripcionEvento = " Primer Ingreso";
                    $accion = "Ingreso";

                    $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
                ?>    
            </div>
        </div>
    </div>
