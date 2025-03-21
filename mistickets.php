<!DOCTYPE html>
<html lang="sp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content = "IE = edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MESS TICKETS</title>

    <!-- Custom fonts for this template-->
    <link href = "vendor/fontawesome-free/css/all.min.css" rel = "stylesheet" type = "text/css">
    
    <!-- Custom styles for this template-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
    <link href = "css/sb-admin-2.min.css" rel = "stylesheet">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" type="module"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" nomodule></script>

    
</head>

<body id = "page-top">

    <!-- Page Wrapper -->
    <div id = "wrapper">
        <?php
            session_start();
            include 'menu.php';
        ?>
        
        <!-- Content Wrapper -->
        <div id = "content-wrapper" class = "d-flex flex-column">

            <!-- Main Content -->
            <div id = "content">
                
                <?php
                    include 'encabezado.php';
                ?>
                
                <!-- Begin Page Content -->
                <div class = "container-fluid">
                    
                    <!-- Page Heading -->
                    <div class = "d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class = "h3 mb-0 text-gray-800">Mis Tickets</h1>                        
                    </div>
                    <div class = "card shadow mb-2">   
                        <div class = "card-body">
                            <div  class ="col-sm-12">                    
                                    <table id ="misTickets" name ="misTickets" class="display responsive table table-striped table-hover table-sm">
                                        <thead>
                                            <tr class="table-info">
                                                <th>Ticket</th>
                                                <th>Descripcion</th>
                                                <th>Ingeniero</th>
                                                <th>Area</th>
                                                <th>Cliente</th>
                                                <th>Prioridad</th>
                                                <th>Estatus</th>
                                                <th>Tipo</th>
                                                <th>Fecha creacion</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div> 
            </div>
            <footer class = "sticky-footer bg-white">
                <div class = "container my-auto">
                    <div class = "copyright text-center my-auto">
                        <span>Copyright &copy; MESS 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class = "scroll-to-top rounded" href = "#page-top">
        <i class = "fas fa-angle-up"></i>
    </a>
    
    <!-- MODAL REGISTRA TIEMPO -->
    <div id="modalRegitraTiempo" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modalRegitraTiempoTitulo">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Registro de tiempo en ticket de servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <div class="row">
                        <!--Registro Tiempo Trabajo-->
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <label for="usuario">Usuario:</label><br>
                            <input type="text" name="usuario" id="usuario" disabled class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label for="fecha_inicio">Fecha y Hora de Inicio:</label><br>
                            <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" required class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label for="fecha_fin">Fecha y Hora de Fin:</label><br>
                            <input type="datetime-local" name="fecha_fin" id="fecha_fin" required class="form-control" onChange="calculo_horas()">
                        </div>
                    </div>
                    <br><hr><br>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3">
                            <label for="tiempo">Tiempo Trabajado:</label><br>
                            <input type="text" name="tiempo" id="tiempo" required class="form-control">
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <label for="descripcion">Descripción:</label><br>
                            <textarea name="descripcion" id="descripcion" rows="2" cols="50" required class="form-control"></textarea>
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" name="id_ticket" id ="id_ticket"><br>
                            <input type="hidden" name="id_usuario" id="id_usuario">        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-success" onclick="registraTiempo()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MODAL Apobar Ticket -->
    <div id="modalAprobar" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modalAprobar">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Aprobar Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="comentarios">Comentarios:</label><br>
                            <input type="text" name="comentarios" id="comentarios" disabled class="form-control">
                        </div>
                        <div class="col-sm-1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-success" onclick="registraTiempo()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    
    <script src = "vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src = "vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src = "js/sb-admin-2.min.js"></script>    
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
	
    <script type="text/javascript">
        $(document).ready(function(){
            $('#misTickets').DataTable();
            InfoMisTickets()
        });
        
        //Funcion para usar las cookies
        function getCookie(nombre) {
            let cookies = document.cookie.split(';'); // Dividir todas las cookies en un array
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].trim(); // Eliminar espacios en blanco
                if (cookie.startsWith(nombre + '=')) {
                    return cookie.substring(nombre.length + 1); // Devolver el valor de la cookie
                }
            }
            return null;
        }

        //Cargar Tabla
        function InfoMisTickets(){
            let rol = getCookie('rol');
            let area = getCookie('area');
            let noEmpleado = getCookie('noEmpleado');
            
            $.ajax({
                url: 'acciones_nuevo_ticket.php',
                method: 'POST',
                data:{accion : 'cargarInfoTicket', rol, area,noEmpleado},
                dataType: 'json',
                success: function(respuesta) {
                    var registros = respuesta.data;
                   
                    var table = $('#misTickets').DataTable();
                    table.clear().draw();
                    
                        respuesta.forEach(function(Registro) {
                            
                            if (Registro.ESTADO === 'En Proceso') {
                                Botones = 
                                    `<a class="btn btn-sm btn-outline-warning w-auto" href="ver_ticket.php?id=${Registro.IDTICKET}"><i class="fas fa-fw fa-eye"></i></a>`;
                                    
                                if (rol !== 4) {
                                    Botones = 
                                    `<a class="btn btn-sm btn-outline-warning w-auto" href="ver_ticket.php?id=${Registro.IDTICKET}&NO_TICKET=${Registro.NO_TICKET}"><i class="fas fa-fw fa-eye"></i></a>
                                     <button type="button" class="btn btn-sm btn-outline-info" onclick="MostrarModalRegistraTiempo('${Registro.IDTICKET}', '${Registro.USUARIO}', '${Registro.IDUSR}')"><i class = "fas fa-fw fa-clock"></i></button>`;
                                }
                            } else {
                                Botones = 
                                    `<a class="btn btn-sm btn-outline-success w-auto" href="ver_ticket.php?id=${Registro.IDTICKET}"><i class="fas fa-fw fa-eye"></i></a>`;
                            }
                            
                            table.row.add([
                                Registro.NO_TICKET,
                                Registro.DESCRIPCION, 
                                Registro.USUARIO,
                                Registro.CDAREA,
                                Registro.CLIENTE_LARGO,
                                Registro.PRIORIDAD,
                                Registro.ESTADO,
                                Registro.TIPO,
                                Registro.FECHA_CREACION,
                                Botones,
                                
                            ]).draw(false);
                        });  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal("!No se pudo cargar la información!", " ", "warning");
                }
            });
        }
        
        //Funcion para mostrar el modal de tiempo
        function MostrarModalRegistraTiempo(IDTICKET, USUARIO, IDUSR){
            $('#id_ticket').val(IDTICKET);
            $('#usuario').val(USUARIO);
            $('#id_usuario').val(IDUSR);
            $('#modalRegitraTiempo').modal('show');
        }
        
        //Guardar tiempo
        function registraTiempo(IDTICKET, USUARIO, IDUSR){
            
            //OBTENEMOS VALOR SELECT
            var fecha_inicio = $('#fecha_inicio').val();
            var fecha_fin = $('#fecha_fin').val();
            var Tiempo = $('#tiempo').val();
            var descripcion = $('#descripcion').val();
            var noTicket = $('#id_ticket').val();
            var id_usuario = $('#id_usuario').val();
            var accion = "registraTiempo";
            
           $.ajax({
                url: 'acciones_ver_ticket.php',
                method: 'POST',
                dataType: 'json',
                data:{fecha_inicio, fecha_fin, Tiempo, descripcion, noTicket, id_usuario, accion},
                success: function() {
                    swal("Se registro el tiempo","","success");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
        }
        
        // CALCULO DE HORAS
        function calculo_horas() {
            var fecha_Ini = new Date($('#fecha_inicio').val());
            var fecha_Fin = new Date($('#fecha_fin').val());
            var dif = fecha_Fin.getTime() - fecha_Ini.getTime();
            var hrs = dif / 3600000;
            document.getElementById('tiempo').value = hrs.toFixed(2);
        }
        
    </script>
</body>
</html>