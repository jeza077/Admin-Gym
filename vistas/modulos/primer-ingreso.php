<div class="card">
        <div class="form-row">

            <div class="contenedor1 login-logo col-md-5">
                <!-- <a href="login"><b>Bienvenid@ a bordo</b><?php echo $_SESSION["usuario"]?> :)</a>
                <p class="login-box-msg">Por favor, cambie su contraseña y agregue las preguntas de seguridad!</p> -->
                <img src="vistas/img/plantilla/undraw_Process.svg" alt="">
            </div>

            <div class="contenedor2 card-body col-md-7">
                <div>
                    <a href="login"><b>Bienvenid@ a bordo </b><?php echo $_SESSION["usuario"]?> :)</a>
                    <p class="login-box-msg">Por favor, cambie su contraseña y agregue las preguntas de seguridad!</p>
                </div>

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
                                <input type="text" class="form-control" onKeyUp="this.value=this.value.toLowerCase();" name="respuestaPregunta[]" placeholder="Ingrese respuesta">
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

                    <div class="card-body contenedor-primer-ingreso password-primer-ingreso">
                        <div class="form-group" id="passwordPrimerIngreso">
                            <!-- <div class="form-group">
                                <label class='mt-2'>Nueva contraseña</label>
                                <input type='password' class='form-control nueva-password' placeholder='Nueva contraseña' name='editarPassword' required>
                            </div> -->
                            <div class="form-group passwords">
                                <!-- <label class='mt-2'>Confirmar contraseña</label>
                                <input type='password' class='form-control confirmar-password' placeholder='Confirmar contraseña'> -->
                                <i class="far fa-eye show-nueva-pass primero" action="hide"></i>
                                <i class="far fa-eye show-confir-pass segundo" action="hide"></i>
                                <span class="resultado-password help-block mt-1 float-right"></span>
                            </div>
                        </div>

                        <div class="form-group mt-4" id="guardarPassPrimerIngreso">
                            <!-- <a href="salir" class="btn btn-danger salir float-left">Salir</a>
                            <button type="submit" class="btn btn-primary float-right" id="btnPrimerIngreso">Guardar</button> -->
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
