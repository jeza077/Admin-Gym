<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="agregar-persona">
            <i class="fas fa-user-plus"></i>
            <span class="hidden-xs">Agregar persona</span>
          </a>
        </li>
        <li class="dropdown nav-item user user-menu" style="margin-right:1em">
          <a href="#"  data-toggle="dropdown">
            <?php
              if($_SESSION["foto"] != ""){
                echo '<img src="'.$_SESSION["foto"].'" class="user-image" alt="User Image">';
              } else {
                echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image" alt="User Image">';
              }
            ?>
            <span class="hidden-xs"><?php echo $_SESSION["nombre"]." ". $_SESSION["apellidos"]?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <?php
                if($_SESSION["foto"] != ""){
                  echo '<img src="'.$_SESSION["foto"].'" class="img-circle" alt="User Image">';
                } else {
                  echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle" alt="User Image">';
                }
              ?>
              <p>
                <?php echo $_SESSION["usuario"] . " - " . $_SESSION["rol"]?>
              </p>
            </li>
            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="float-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="float-right">
                <a href="salir" class="btn btn-default btn-flat">Salir</a>
              </div>
            </li>
          </ul>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->