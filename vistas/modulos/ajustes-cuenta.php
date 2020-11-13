<?php
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
?>
<div class="card-body">
    <form role="form" method="post" class="formulario" enctype="multipart/form-data">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <a class="nav-link active" id="editarPersona" data-toggle="tab" href="#personas" role="tab" aria-controls="personas" aria-selected="true">Datos personales</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="editarUsuario" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false">Datos Usuario</a>
        </li>
        </ul>

        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="personas" role="tabpanel" aria-labelledby="editarPersona">
        <div class="container-fluid mt-4">
        <div class="form-row">
        <div class="form-group col-md-3">
        <label for="">Tipo de documento <?php echo $i?></label>
        <select class="form-control select2 tipoDocumento" name="editarTipoDocumento">
        <option value="" id="editarTipoDocumento"></option>
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
        <input type="text" class="form-control numeroDocumento" name="editarNumeroDocumento" value="" required>
        </div>
        <div class="form-group col-md-3">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control nombre mayus" name="editarNombre" value="" required>
        </div>
        <div class="form-group col-md-3">
        <label for="apellido">Apellido</label>
        <input type="text" class="form-control apellidos mayus" name="editarApellido" value="" required>
        </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-4">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control email" id="inputEmail" name="editarEmail" value="" required>
        </div>
        <div class="form-group col-md-4">
        <label>Teléfono</label>
        <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="editarTelefono" value="ono" required>
        </div>
        <div class="form-group col-md-4">
        <label>Fecha de nacimiento</label>
        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="editarFechaNacimiento" value="" required>
        </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-9">
        <label for="direccion">Dirección</label>
        <input type="text" class="form-control mayus" id="direccion" name="editarDireccion" value="" required>
        </div>

        <div class="form-group col-md-3">
        <label>Sexo</label>
        <select class="form-control select2" name="editarSexo" style="width: 100%;" required>
        <option value="" id="editarSexo"></option>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
        </select>
        </div>
        <input type="hidden" class="idPersona" value="" name="idPersona">
        </div>
        </div>
        </div>

        <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="editarUsuario">
        <div class="container-fluid mt-4">

        <div class="form-row">
        <div class="form-group col-md-3">
        <label for="">Usuario</label>
        <input type="text" class="form-control nuevoUsuario" name="editarUsuario" value="" readonly>
        </div>
        <div class="form-group col-md-3">
        <label>Rol</label>
        <select class="form-control select2" style="width: 100%;" name="editarRol">
        <option value="" id="editarRol"></option>
        <?php 
        $tabla = "tbl_roles";
        $item = null;
        $valor = null;

        $roles = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

        foreach ($roles as $key => $value) {
        if($value["rol"] == 'Default'){
        echo '<option value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
        } else {
        echo '<option value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
        }
        }
        ?>
        </select>
        </div>

        <div class="form-group col-md-3">
        <label for="inputPass">Contraseña Generada</label>
        <input type="text" class="form-control passwordGenerado" id="inputPass" name="editarPassword">
        <input type="hidden" class="form-control" id="passwordActual" name="passwordActual">
        </div>
        <div class="col-md-3">
        <a href="javascript:void(0);"  class="btn btn-block btn-orange generarPassword" style="margin-top:2em">Generar contraseña</a>
        </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputFoto">Foto</label>
        <div class="input-group">
        <img class="img-thumbnail previsualizar mr-2" src="" alt="imagen-del-usuario" width="100px">
        <div class="custom-file">
        <input type="file" class="custom-file-input nuevaFoto" id="inputFoto" name="editarFoto">
        <label class="custom-file-label" for="inputFoto">Escoger foto</label>
        <input type="hidden" name="fotoActual" id="fotoActual">
        </div>
        </div>
        <p class="p-foto help-block ml-4">Peso máximo de la foto 2 MB</p>
        </div>
        <!-- <div class="form-group col-md-3">
        <input type="text" value="Desactivado" style="color:red;" readonly>
        </div> -->

        <!-- <div class="form-group col-md-3">
        <?php 
        $itemParam = 'parametro';
        $valorParam = 'ADMIN_DIAS_VIGENCIA';
        $parametros = ControladorUsuarios::ctrMostrarParametros($itemParam, $valorParam);

        $vigenciaUsuario = $parametros['valor'];

        date_default_timezone_set("America/Tegucigalpa");
        $fechaVencimiento = date("Y-m-d", strtotime('+'.$vigenciaUsuario.' days'));
        ?>
        <label>Fecha de vencimiento</label>
        <input type="text" class="form-control" value="<?php echo $fechaVencimiento?>" disabled>
        </div> -->
        </div>
        </div>

        <!-- <div class="modal-footer"> -->
        <div class="form-group mt-2 float-right">
        <button type="" class="btn btn-primary">Guardar cambios</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        </div>

        <?php
        $tipoPersona = 'usuarios';
        $pantalla = 'usuarios';
        $ingresarPersona = new ControladorPersonas();
        $ingresarPersona->ctrEditarPersona($tipoPersona, $pantalla);
        ?>
        </div>
        </div>

    </form>
</div>