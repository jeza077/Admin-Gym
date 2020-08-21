
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registrar Personas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Registra personas</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        
        <div class="card-body contenedor agregarPersona">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="identidad">Identidad</label>
              <input type="text" class="form-control" name="nuevaIdentidad" placeholder="Ingrese Identidad">
            </div>
            <div class="form-group col-md-4">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese Nombre">
            </div>
            <div class="form-group col-md-4">
              <label for="apellido">Apellido</label>
              <input type="text" class="form-control" name="nuevoApellido" placeholder="Ingrese Apellidos">
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Email</label>
              <input type="email" class="form-control" id="inputEmail4" name="nuevoEmail" placeholder="Ingrese Email">
            </div>
            <div class="form-group col-md-4">
              <label>Teléfono</label>
              <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Telefono">
            </div>
            <div class="form-group col-md-4">
              <label>Fecha de nacimiento</label>
                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="nuevaFechaNacimiento" placeholder="Ingrese Fecha de Nacimiento">
            </div>
          </div>

          <div class="form-group">
            <label for="inputAddress">Dirección</label>
            <input type="text" class="form-control" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2...">
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Sexo</label>
              <select class="form-control select2" name="nuevoSexo" style="width: 100%;">
                <option selected="selected">Seleccionar...</option>
                <option>Masculino</option>
                <option>Femenino</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputFile">Foto</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="nuevaFoto">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label>Tipo de persona</label>
              <select class="form-control select2" style="width: 100%;" id="tipo-persona" name="nuevoTipoPersona">
                <option selected="selected">Seleccionar...</option>
                <option value="Empleado">Empleado</option>
                <option value="Cliente">Cliente</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <!-- <a href="#" class="float-right" onclick="toggelUser();">Siguiente</a> -->
            <button type="submit" onclick="toggleUser();" class="btn btn-primary float-right">Siguiente</button>
          </div>
        </div>

        <div class="card-body contenedor agregarEmpleado">
          <div class="form-row empleados">
            <div class="form-group col-md-12">
              <label for="">Usuario</label>
              <input type="text" class="form-control" id="" name="nuevoUsuario">
            </div>
            <div class="form-group col-md-12">
              <label for="inputPassword4">Password</label>
              <input type="password" class="form-control" id="inputPassword4" name="nuevoPassword">
            </div>
            <div class="form-group col-md-12">
              <label>Rol</label>
              <select class="form-control select2" style="width: 100%;" id="tipo-persona" name="nuevoRol">
                <option selected="selected">Seleccionar...</option>
                <option value="Admin">Admin</option>
                <option value="Especial">Especial</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <!-- <a href="#" class="float-left" onclick="toggelUser();">Atras</a> -->
            <button type="submit" class="btn btn-primary float-risght">Guardar</button>
            <button type="submit" onclick="toggleUser();" class="btn btn-danger float-right mr-2">Atras</button>
          </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


