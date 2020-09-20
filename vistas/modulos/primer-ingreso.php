
    <div class="card">
        <div class="login-logo">
        <a href="login"><b>Bienvenid@ </b><?php echo $_SESSION["usuario"]?>!</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Por favor, cambie su contraseña y agregue las preguntas de seguridad!</p>
            <form method="post" id="primerIngreso">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class='mt-2'>Nueva contraseña</label>
                        <input type='password' class='form-control nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class='mt-2'>Confirmar contraseña</label>
                        <input type='password' class='form-control confirmar-password' placeholder='Confirmar contraseña'>
                    <!-- <i class="far fa-eye show-pass primero" action="hide"></i>
                    <i class="far fa-eye show-pass segundo" action="hide"></i> -->
                        <span class="resultado-password help-block mt-2 float-right"></span>
                    </div>
                </div>

                <div class="form-row">
                    <?php 
                        for ($i=1; $i <=3 ; $i++) { ?>
                        <div class="form-group col-md-4">
                        <label for="inputPassword4">Pregunta <?php echo $i?></label>
                        <select class="form-control select2" name="nuevaPregunta[]">
                        <option selected="selected">Seleccionar...</option>
                        <?php 
                                $tabla = "preguntas";
                                $item = null;
                                $valor = null;

                                $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                                foreach ($preguntas as $key => $value) { ?>
                                    <option value="<?php echo $value['id']?>"><?php echo $value['pregunta']?></option>        
                                <?php 
                                }
                            ?>
                        </select>
                        </div>
                    <?php
                        }            
                    ?>
                </div>

                <div class="form row">
                    <div class="form-group col-md-4">
                    <label for="inputPassword4">Respuesta 1</label>
                    <input type="text" class="form-control" onKeyUp="this.value=this.value.toLowerCase();" name="respuestaPregunta[]">
                    </div>
                    <div class="form-group col-md-4">
                    <label for="inputPassword4">Respuesta 2</label>
                    <input type="text" class="form-control" onKeyUp="this.value=this.value.toLowerCase();" name="respuestaPregunta[]">
                    </div>
                    <div class="form-group col-md-4">
                    <label for="inputPassword4">Respuesta 3</label>
                    <input type="text" class="form-control" onKeyUp="this.value=this.value.toLowerCase();" name="respuestaPregunta[]">
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <a href="salir" class="btn btn-danger float-left">Salir</a>
                    <button type="submit" class="btn btn-primary float-right" id="btnPrimerIngreso">Guardar</button>
                </div>

                <?php 
                    $id = $_SESSION["id_usuario"];
                    $contraseñaPreguntas = new ControladorUsuarios();
                    $contraseñaPreguntas->ctrNuevaContraseñaPreguntasSeguridad($id);
                ?>
            </form>
        </div>
    </div>
