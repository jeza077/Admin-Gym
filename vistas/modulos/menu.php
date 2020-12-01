  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="vistas/img/plantilla/gym.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-bold"> Gym "La Roca"</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php
                /*
                  $item1 = "usuario";
                  $valor1 = $_SESSION["usuario"];
                  $item2 = "rol";
                  $valor2 = $_SESSION["rol"];

                  $modulos = ControladorUsuarios::ctrMostrarUsuarioModulo($item1, $item2, $valor1, $valor2);

                  $grupo_modulo = array();
                  foreach($modulos as $modulo) {
                    $modulo_padre = $modulo['objeto'];
                    $icono_objeto = $modulo['icono'];
                    $link_objeto = $modulo['link_objeto'];

                    // $objetos = array(
                    //   'link_objeto' => $modulo['link_objeto'],
                    //   'icono_objeto' => $modulo['icono'];
                    // );

                    // $sub_modulos = array(
                    //   'sub_modulo' => $modulo['sub_modulo'],
                    //   'link_sub_modulo' => $modulo['link_sub_modulo']
                    // );
                    
                    $grupo_modulo[$link_objeto][$icono_objeto][] = $modulo_padre;
                  }

                  foreach ($grupo_modulo as $link => $icono_mod) { ?>
                      <li class="nav-item">
                      <a href="<?php echo $link ?>" class="nav-link menu-lateral">
                      
                      <?php foreach ($icono_mod as $icono => $modulo) :?>
                        <i class="nav-icon <?php echo $icono?>"></i>
                        
                          <?php foreach ($modulo as $nombre_mod => $sub_modulos) { ?>
                            <p>
                              <?php echo $sub_modulos?>
                            </p>
                          <?php } ?>

                      <?php endforeach; ?>
                      </a>
                      </li>

                  <?php  }  */?>
                                          
               <?php 

                    // echo "<pre style='color:white;'>";
                    // var_dump($grupo_modulo);
                    // echo "</pre>";
                
                
              ?>


            <?php if($_SESSION['permisos']['Dashboard']['consulta'] == 1){?>
            <li class="nav-item">
              <a href="dashboard" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <?php }?>

            <?php if($_SESSION['permisos']['Usuarios']['consulta'] == 1){?>
            <li class="nav-item">
              <a href="usuarios" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Usuarios
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <?php }?>

            <?php if($_SESSION['permisos']['Clientes']['consulta'] == 1){?>
              <li class="nav-item has-treeview">
                <a href="clientes" class="nav-link menu-lateral">
                  <i class="nav-icon fas fa-user-circle"></i>
                  <p>
                    Clientes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="clientes" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Administrar Clientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pagos-cliente" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pagos Clientes</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php }?>

            <?php if($_SESSION['permisos']['Stock']['consulta'] == 1){?>
            <li class="nav-item has-treeview">
              <a href="stock" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                  Stock
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="productos" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="equipo" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Equipo</p>
                  </a>
                </li>
              </ul>
            </li>

            <?php }?>
            <?php if($_SESSION['permisos']['Ventas']['consulta'] == 1){?>
            <li class="nav-item has-treeview">
              <a href="ventas" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                  Ventas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="administrar-venta" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Administrar Venta</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="crear-venta" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nueva Venta</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="reportes" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de Ventas</p>
                  </a>
                </li>
              </ul>
            </li>
            <?php } ?>
            <?php if($_SESSION['permisos']['Mantenimiento']['consulta'] == 1){?>
            <li class="nav-item">
              <a href="mantenimiento" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-sliders-h"></i>
                <p>
                  Mantenimiento
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <?php } ?>

            <?php if($_SESSION['permisos']['Respaldo y Restauracion']['consulta'] == 1){?>
            <li class="nav-item">
              <a href="respaldoyrestauracion" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-download"></i>
                <p>
                  Respaldo y Restauracion
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <?php } ?>
            <?php if($_SESSION['permisos']['Bitacora']['consulta'] == 1){?>
            <li class="nav-item">
              <a href="bitacora" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-bold"></i>
                <p>
                  Bitacora
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <?php } ?>
        </ul>
      </nav>
    </div>
  </aside>