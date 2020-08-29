  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="vistas/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> Gym "La Roca"</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
            if($_SESSION["foto"] != ""){
              echo '<img src="'.$_SESSION["foto"].'" class="img-circle elevation-2" alt="User Image">';
            } else {
              echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle elevation-2" alt="User Image">';
            }
          ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["nombre"] . " " . $_SESSION["apellidos"] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php
                
                  $item1 = "usuario";
                  $valor1 = $_SESSION["usuario"];
                  $item2 = "rol";
                  $valor2 = $_SESSION["rol"];

                  $modulos = ControladorUsuarios::ctrMostrarUsuarioModulo($item1, $item2, $valor1, $valor2);

                  var_dump($modulos);

                  $modulos_rol = array();                  
                  foreach($modulos as $modulo) {?>
       

                    <li class="nav-item">
                      <a href="<?php echo $modulo['link_modulo'] ?>" class="nav-link">
                        <i class="nav-icon fas <?php echo $modulo['icono'] ?>"></i>
                        <p>
                          <?php echo $modulo['nombre_modulo'] ?>
                        </p>
                      </a>
                    </li>
  
                  <?php }
              ?>
        </ul>
      </nav>
    </div>
  </aside>