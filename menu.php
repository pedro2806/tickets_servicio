<?php
    session_start();
    include 'conn.php';
    if($_COOKIE['nombredelusuario'] == ''){
        echo '<script>window.location.assign("index")</script>';
    }
?>
<!-- Sidebar -->
<ul class = "navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id = "accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class = "sidebar-brand d-flex align-items-center justify-content-center" href = "inicio">
        <div class = "sidebar-brand-icon rotate-n-1">
            <img class = "sidebar-card-illustration mb-2" src = "img/MESS_07_CuboMess_2.png" width = "80">
        </div>
    </a>

    <!-- Divider -->
    <hr class = "sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class = "nav-item active">
        <a class = "nav-link" href = "inicio">
            <i class = "fas fa-fw fa-home"></i>
            <span>Inicio</span></a>
    </li>
    
    <!-- Divider -->
    <hr class = "sidebar-divider">
    
    <!-- Heading -->
    <div class = "sidebar-heading">
        Opciones
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    
    <?php
        if ($_COOKIE['rol']== 1 || $_COOKIE['rol']==2 || $_COOKIE['rol'] == 3 || $_COOKIE['rol'] == 4) {
    ?>
            <!----------------MENU 1------------------->
            <li class = "nav-item">
                <a class = "nav-link collapsed" href = "#" data-toggle = "collapse" data-target = "#collapseTwo" aria-expanded = "true" aria-controls = "collapseTwo">
                    <i class = "fas fa-fw fa-cog"></i>
                    <span>Tickets</span>
                </a>
                <div id = "collapseTwo" class = "collapse" aria-labelledby = "headingTwo" data-parent = "#accordionSidebar">
                    <div class = "bg-white py-1 collapse-inner rounded">
                        <a class = "collapse-item" href = "ticket">Ticket Nuevo</a>
                        <?php
                            if ($_COOKIE['rol'] <> 4) {
                        ?>
                        <a class = "collapse-item" href = "mistickets">Mis tickets</a>
                        <?php
                            }
                        ?>
                        <?php
                            if ($_COOKIE['rol']==2 || $_COOKIE['rol']==5 || $_COOKIE['rol'] <> 3) {
                        ?>
                        <a class = "collapse-item" href = "ticketSinAsignar">Tickets sin asignar</a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </li>
            <!---------------------------------->
    <?php
        }
    ?>
    
    <?php
        if ($_COOKIE['rol']==1 || $_COOKIE['rol'] == 2) {
    ?>
            <!------------MENU 2---------------------->
            <li class = "nav-item">
                <a class = "nav-link collapsed" href = "" data-toggle = "collapse" data-target = "#collapseThree" aria-expanded = "true" aria-controls = "collapseThree">
                    <i class = "fas fa-fw fa-user"></i> <span>Ingenieros</span>
                </a>
                <div id = "collapseThree" class = "collapse" aria-labelledby = "headingTwo" data-parent = "#accordionSidebar">
                    <div class = "bg-white py-1 collapse-inner rounded">
                        <a class = "collapse-item" href = "admin_usuarios">Admin. Ingeneros</a>
                    </div>
                </div>
            </li>
            <!----------------------------------->
    <?php
        }
    ?>
    
    <?php
        if ($_COOKIE['rol'] == 1) {
    ?>
            <!--------------MENU 3--------------------->
            <li class = "nav-item">
                <a class = "nav-link collapsed" href = "" data-toggle = "collapse" data-target = "#collapseUtilities"
                    aria-expanded = "true" aria-controls = "collapseUtilities">
                    <i class = "fas fa-fw fa-wrench"></i>
                    <span>Administracion</span>
                </a>
                <div id = "collapseUtilities" class = "collapse" aria-labelledby = "headingUtilities"
                    data-parent = "#accordionSidebar">
                    <div class = "bg-white py-2 collapse-inner rounded">
                        <a class = "collapse-item" href = "usuarios">Usuarios</a>
                        <a class = "collapse-item" href = "marcas">Marcas</a>
                        <a class = "collapse-item" href = "equipo">Equipos</a>            
                    </div>
                </div>
            </li>
            <!----------------------------------->
    <?php
        }
    ?>
    
    <!-- Modal HTML -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tiempo de sesion a punto de terminar.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>En unos momentos tendras que iniciar sesion de nuevo.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--SCRIPTS PARA FUNCIONES-->
    
    <script>
        // Funcion para mostrar el modal
        function showModal() {
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                keyboard: false
            });
            myModal.show();
        }
        
        // Verifica el tiempo restante y muestra el modal si es necesario
        function checkCookieExpiry() {
            var cookieExpiry = localStorage.getItem('nombredelusuario');
            if (cookieExpiry) {
                var currentTime = new Date().getTime();
                var expiryTime = parseInt(cookieExpiry, 1000);
                var timeLeft = expiryTime - currentTime;
                var oneMinuteInMillis = 60 * 1000;

                if (timeLeft <= oneMinuteInMillis) {
                    showModal();
                } else {
                    // Verifica nuevamente en 10 segundos si queda 1 minuto o menos
                    setTimeout(checkCookieExpiry, 5000);
                }
            } else {
                console.log('No se ha encontrado la fecha de expiración de la cookie.');
            }
        }

        // Inicia la verificacion cuando se carga la pagina
        document.addEventListener('DOMContentLoaded', checkCookieExpiry);
    </script>    
        
        
        <!-- Divider -->
        <hr class = "sidebar-divider d-none d-md-block">
        <li class = "nav-item">
        <a class = "nav-link" href = "" data-toggle = "modal" data-target = "#logoutModalN">
            <i class = "fas fa-sign-out-alt "></i>
            <span>Salir</span>
        </a>
    </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <div class = "text-center d-none d-md-inline">
            <button class = "rounded-circle border-0" id = "sidebarToggle"></button>
        </div>
</ul>
<!-- End of Sidebar -->