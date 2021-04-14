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
                  Inicio
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
                <a href="#" class="nav-link menu-lateral">
                  <i class="nav-icon fas fa-user-circle"></i>
                  <p>
                    Clientes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if($_SESSION['permisos']['Administrar Clientes']['consulta'] == 1){?>
                    <li class="nav-item">
                      <a href="clientes" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Administrar clientes</p>
                      </a>
                    </li>
                  <?php }?>
                  <?php if($_SESSION['permisos']['Clientes Inscripciones']['consulta'] == 1){?>
                    <li class="nav-item">
                      <a href="clientes-inscripciones" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Clientes inscripciones</p>
                      </a>
                    </li>
                  <?php }?>
                  <?php if($_SESSION['permisos']['Clientes Inscripciones Historico']['consulta'] == 1){?>
                    <li class="nav-item">
                      <a href="clientes-inscripciones-historico" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Clientes inscripciones histórico</p>
                      </a>
                    </li>
                  <?php }?>
                  <?php if($_SESSION['permisos']['Clientes Pagos Historico']['consulta'] == 1){?>
                    <li class="nav-item">
                      <a href="clientes-pagos-historico" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Clientes pagos histórico</p>
                      </a>
                    </li>
                  <?php }?>
                </ul>
              </li>
            <?php }?>

            <?php if($_SESSION['permisos']['Stock']['consulta'] == 1){?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                  Stock
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if($_SESSION['permisos']['Compras']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="compras" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Compras</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Inventario']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="inventario" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inventario</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Productos']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="productos" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Productos</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Equipo']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="equipo" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Equipo</p>
                    </a>
                  </li>
                <?php }?>
              </ul>
            </li>

            <?php }?>
            <?php if($_SESSION['permisos']['Ventas']['consulta'] == 1){?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                  Ventas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if($_SESSION['permisos']['Administrar Ventas']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="administrar-ventas" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Administrar venta</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Nueva Venta']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="crear-venta" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Nueva venta</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Reporte de Ventas']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="reportes" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Reporte de ventas</p>
                    </a>
                  </li>
                <?php }?>
              </ul>
            </li>
            <?php } ?>

            <?php if($_SESSION['permisos']['Mantenimiento']['consulta'] == 1){?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-sliders-h"></i>
                <p>
                  Mantenimiento
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <?php if($_SESSION['permisos']['Roles']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="rol" class="nav-link">
                      <i class="fas fa-th-list nav-icon"></i>
                      <p>Roles</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Administracion de Permisos']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="permisos-rol" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Permisos rol</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Parametros']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="parametro" class="nav-link">
                      <i class="fab fa-product-hunt nav-icon"></i>
                      <p>Parámetros</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Inscripciones']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="inscripcion" class="nav-link">
                      <i class="fas fa-wallet nav-icon"></i>
                      <p>Inscripciones</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Matricula']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="matricula" class="nav-link">
                      <i class="fas fa-money-bill-alt nav-icon"></i>
                      <p>Mátriculas</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Descuentos']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="descuento" class="nav-link">
                      <i class="fas fa-cash-register nav-icon"></i>
                      <p>Descuentos</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Documentos']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="documentos" class="nav-link">
                      <i class="fas fa-cash-register nav-icon"></i>
                      <p>Documentos</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Proveedores']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="proveedores" class="nav-link">
                      <i class="fas fa-cash-register nav-icon"></i>
                      <p>Proveedores</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Preguntas de seguridad']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="preguntas-seguridad" class="nav-link">
                      <i class="fas fa-cash-register nav-icon"></i>
                      <p>Preguntas de seguridad</p>
                    </a>
                  </li>
                <?php }?>
                <?php if($_SESSION['permisos']['Objetos']['consulta'] == 1){?>
                  <li class="nav-item">
                    <a href="objetos" class="nav-link">
                      <i class="fas fa-cash-register nav-icon"></i>
                      <p>Objetos</p>
                    </a>
                  </li>
                <?php }?>
              </ul>
              
            </li>
            <?php } ?>

            
            <?php if($_SESSION['permisos']['Bitacora']['consulta'] == 1){?>
            <li class="nav-item">
              <a href="bitacora" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-bold"></i>
                <p>
                  Bitácora
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>

            <?php } ?>
           
            <?php if($_SESSION['permisos']['Respaldo y Restauración']['consulta'] == 1){?>
            <li class="nav-item">
              <a href="respaldo-restauracion" class="nav-link menu-lateral">
                <i class="nav-icon fas fa-download"></i>
                <p>
                  Respaldo y restauración
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>

            <?php } ?>
            
           
           
        </ul>
      </nav>
    </div>
  </aside>