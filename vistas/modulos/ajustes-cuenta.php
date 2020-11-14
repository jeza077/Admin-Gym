<?php
require_once "../../controladores/personas.controlador.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
?>
<div class="container-fluid ajustes-cuenta">
    <div class="card-header mt-2">
        <h3>Datos generales</h3>
    </div>
    <div class="card-body">
        <form role="form" method="post" class="formulario" enctype="multipart/form-data">
            
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="datosPersona">
                    <div class="container-fluid mt-4">
                        <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="">Tipo de documento <?php echo $i?></label>
                            <select class="form-control select2 tipoDocumento" name="nuevoTipoDocumento">
                                <option selected="selected">Seleccionar...</option>
                                <?php 
                                    $tabla = "tbl_documento";
                                    $item = null;
                                    $valor = null;

                                    $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                                    foreach ($preguntas as $key => $value) { ?>
                                        <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                                    <?php 
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="identidad">Numero de documento</label>
                            <input type="text" class="form-control numeroDocumento" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control nombre mayus" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control apellidos mayus" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
                        </div>
                        </div>
            
                        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control email" id="inputEmail4" name="nuevoEmail" placeholder="Ingrese Email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Telefono" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fecha de nacimiento</label>
                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="nuevaFechaNacimiento" placeholder="Ingrese Fecha de Nacimiento" required>
                        </div>
                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-9">
                            <label for="inputAddress">Dirección</label>
                            <input type="text" class="form-control mayus" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label>Sexo</label>
                            <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
                            <option selected="selected">Seleccionar...</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            </select>
                        </div>
                    
                        </div>
                    </div>
                </div>
            
                <!-- <div class="modal-footer"> -->
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

            </div>

        </form>
    </div>
</div>