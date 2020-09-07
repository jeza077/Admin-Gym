  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="vistas/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-bold"> Gym "La Roca"</span>
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

                  $grupo_modulo = array();
                  foreach($modulos as $modulo) {
                    $modulo_padre = $modulo['nombre_modulo'];
                    $icono_modulo = $modulo['icono'];
                    $link_modulo = $modulo['link_modulo'];

                    $sub_modulos = array(
                      'sub_modulo' => $modulo['sub_modulo'],
                      'link_sub_modulo' => $modulo['link_sub_modulo']
                    );
                    
                    $grupo_modulo[$link_modulo][$icono_modulo][$modulo_padre][] = $sub_modulos;
           
                  }

                  foreach ($grupo_modulo as $link => $icono_mod) { 
                    if($link !== "#") { ?>
                      <li class="nav-item">
                      <a href="<?php echo $link ?>" class="nav-link menu-lateral">
                      
                      <?php foreach ($icono_mod as $icono => $modulo) :?>
                        <i class="nav-icon <?php echo $icono?>"></i>
                        
                          <?php foreach ($modulo as $nombre_mod => $sub_modulos) { ?>
                            <p>
                              <?php echo $nombre_mod?>
                            </p>
                          <?php } ?>

                      <?php endforeach; ?>
                      </a>
                      </li>

                  <?php  } else { ?>

                    <li class="nav-item has-treeview">

                      <!-- var_dump($link); -->
                      <a href="<?php echo $link ?>" class="nav-link menu-lateral">
                        
                        <?php foreach ($icono_mod as $icono => $modulo) :?>
                          <i class="nav-icon <?php echo $icono?>"></i>
                          
                            <?php foreach ($modulo as $nombre_mod => $sub_modulos) { ?>
                              <p>
                                <?php echo $nombre_mod?>
                                <i class="fas fa-angle-left right"></i>
                              </p>
                            <?php } ?>

                        <?php endforeach; ?>

                      </a>
                      <ul class="nav nav-treeview">
                        <?php foreach ($sub_modulos as $sub_mod) : ?>
                          
                          <li class="nav-item">
                            <a href="<?php echo $sub_mod['link_sub_modulo']?>" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p><?php echo $sub_mod['sub_modulo']?></p>
                            </a>
                          </li>
                          
                        <?php endforeach; ?>
                      </ul>

                    </li>
                  <?php  }  ?>
                                          
               <?php }

                    // echo "<pre style='color:white;'>";
                    // var_dump($grupo_modulo);
                    // echo "</pre>";
                
                
              ?>
        </ul>
      </nav>
    </div>
  </aside>