
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar Usuario          
          </button>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

 <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- <div class="card-header">
          <button class="btn btn-orange float-right">Agregar Usuario</button>
        </div> -->
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped tablas text-center">
            <thead>
              <tr>
                <th width="15px">#</th>
                <th>Nombre</th>
                <th width="100px">Usuario</th>
                <th width="100px">Foto</th>
                <th width="100px">Estado</th>
                <th width="100px">Acciones</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>01</td>
                <td>Jesús Zuniga</td>
                <td>JEZA</td>
                <td>foto.jpg</td>
                <td><button class="btn btn-success btn-md">Activo</button></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning" style="color:white;"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </td>
              </tr>

            <tfoot>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- ==========================================
    modal agregar usuario
    ======================================----->

      <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" method="post" class="formulario" enctype="multipart/form-data">
                <div class="card">
                  <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="">Tipo de documento <?php echo $i?></label>
                        <select class="form-control select2" name="nuevoTipoDocumento">
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
                        <label for="identidad">Identidad</label>
                        <input type="text" class="form-control" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
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

                    <div class="form-group">
                      <label for="inputAddress">Dirección</label>
                      <input type="text" class="form-control" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Sexo</label>
                        <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
                          <option selected="selected">Seleccionar...</option>
                          <option value="M">Masculino</option>
                          <option value="F">Femenino</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Tipo de persona</label>
                        <select class="form-control select2" style="width: 100%;" id="tipoPersona" name="nuevoTipoPersona" required>
                          <option selected="selected">Seleccionar...</option>
                          <option value="empleado">Empleado</option>
                          <option value="cliente">Cliente</option>
                        </select>
                      </div>
                    </div>

                    </div>
                  </div>


          

            

                  <!-- <div class="modal-footer"> -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Guardar</button>
                    <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
                  </div>
                  <?php
                    $tipoPersona = null;
                    $ingresarPersona = new ControladorPersonas();
                    $ingresarPersona->ctrCrearPersona($tipoPersona);
                  ?>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

    


