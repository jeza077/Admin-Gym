<?php
require_once "../../controladores/personas.controlador.php";
require_once "../../modelos/personas.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
?>
<div class="container-fluid ajustes-cuenta">
    <div class="card-header mt-2">
        <h3>Datos generales</h3>
    </div>
    <div class="card-body">
        <form role="form" method="post" class="formulario">
            
            <div class="container-fluid mt-4">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="">Tipo de documento <?php echo $i?></label>
                        <select class="form-control select2 tipoDocumento" name="editarTipoDocumento">
                            <option value="" id="editarTipoDocumento"></option>
                            <?php 
                                $tabla = "tbl_documento";
                                $item = 'estado';
                                $valor = 1;
                                $all = true;
  
                                $documento = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

                                foreach ($documento as $key => $value) { ?>
                                    <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                                <?php 
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="identidad">Numero de documento</label>
                        <input type="text" class="form-control numeroDocumento" name="editarNumeroDocumento" value="" placeholder="Ingrese Identidad">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control nombre mayus" name="editarNombre" value="" placeholder="Ingrese Nombre">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="apellido">Apellidos</label>
                        <input type="text" class="form-control apellidos mayus" name="editarApellido" value="" placeholder="Ingrese Apellidos">
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control email" id="inputEmail4" name="editarEmail" value="" placeholder="Ingrese Email">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="editarTelefono" value="" placeholder="Ingrese Telefono">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fecha de nacimiento</label>
                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="editarFechaNacimiento" value="" placeholder="Ingrese Fecha de Nacimiento">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputAddress">Dirección</label>
                        <input type="text" class="form-control mayus" id="inputAddress" name="editarDireccion" value="" placeholder="Col. Alameda, calle #2...">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Sexo</label>
                        <select class="form-control select2" name="editarSexo" style="width: 100%;">
                        <option value="" id="editarSexo"></option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        </select>
                    </div>
                    <input type="hidden" class="idPersona" value="" name="idPersona">
                </div>
            </div>
            
            <!-- <div class="modal-footer"> -->
            <div class="form-group final mt-4 float-right">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <button type="button" class="btn btn-danger salirPerfil" data-dismiss="modal">Salir</button>
            </div>
        
        </form>
    </div>
</div>