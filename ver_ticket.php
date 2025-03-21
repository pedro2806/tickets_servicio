<!DOCTYPE html>
<?php
include 'conn.php';

// Obtener el ID del ticket desde el método POST
$id_ticket = $_GET['id'];
?>
<html lang = "sp">
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1, shrink-to-fit = no">
    <meta name = "description" content = "">
    <meta name = "author" content = "">

    <title>MESS TICKETS</title>

    <!-- Custom fonts for this template-->
    <link href = "vendor/fontawesome-free/css/all.min.css" rel = "stylesheet" type = "text/css">
    <link href = "https://fonts.googleapis.com/css?family = Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel = "stylesheet">

    <!-- Custom styles for this template-->
    <link href = "css/sb-admin-2.min.css" rel = "stylesheet">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Incluir Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <!--Libreria para "SWAL.FIRE"-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
                    </div>
                    
                    <div class = "row">
                        <!-- Content Row -->
                        <div class = "card shadow mb-2">
                            <div class = "card-body">
                                <div class = "row">
                                    <!--TABLA Detalles del Ticket-->
                                    <div  class ="col-sm-5">
                                        <h2>Detalle del Ticket</h2>
                                        <br>
                                            
                                        <table id="TablaTicket" class="display responsive nowrap table table-striped table-hover table-sm">    
                                            <tbody>
                                                <tr>
                                                    <th>No. Ticket</th>
                                                    <th id="NoTicket" class="fs-4 text-primary fw-bold"></th>
                                                </tr>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <td id="descripcion"></td>
                                                </tr>
                                                <tr>
                                                    <th>Cliente</th>
                                                    <td id="cliente"></td>
                                                </tr>
                                                <tr>
                                                    <th>Prioridad</th>
                                                    <td id="prioridad"></td>
                                                </tr>
                                                <tr>
                                                    <th>Estado</th>
                                                    <td id="estado"></td>
                                                </tr>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <td id="tipo"></td>
                                                </tr>
                                                <tr>
                                                    <th>Ingeniero</th>
                                                    <td id="ingeniero"></td>
                                                </tr>    
                                            </tbody>     
                                        </table>
                                    </div>
                                    <!--TABLA Detalles del Equipo-->
                                    <div  class ="col-sm-4">
                                        <h2>Datos del equipo</h2>
                                        <br>
                                        <table id="TablaEquipo" class="display responsive nowrap table table-striped table-hover table-sm">
                                                <tr>
                                                    <th>Marca</th>
                                                    <td id="marca"></td>
                                                </tr>
                                                <tr>
                                                    <th>Equipo</th>
                                                    <td id="equipo"></td>
                                                </tr>
                                                <tr>
                                                    <th>Modelo</th>
                                                    <td id="modelo"></td>
                                                </tr>
                                                <tr>
                                                    <th>No. Serie </th>
                                                    <td id="noSerie"></td>
                                                </tr>  
                                        </table>
                                    </div>
                                    <!--TABLA Archivos-->
                                    <div  class ="col-sm-3">
                                        <h2>Archivos</h2>
                                        <br>
                                        <table  class="display responsive nowrap table table-striped table-hover table-sm">
                                            <tr>
                                                <td>
                                                    <?php
                                                     //CARGAR ARCHIVOS PARA MOSTRAR (DESDE EL SERVIDOR)
                                                        $tickets = $_GET['NO_TICKET']; 
                                                        $uploadDir = "Archivos/$tickets";
                                                        
                                                        if (is_dir($uploadDir)) {
                                                            $files = scandir($uploadDir);
                                                            // Filtrar los archivos que no sean '.' o '..'
                                                            $files = array_diff($files, array('.', '..'));
                                                        } else {
                                                            $files = array();
                                                        }
                                                    if (!empty($files)): ?>
                                                        <div class="file-gallery">
                                                            <?php foreach ($files as $file): ?>
                                                                <?php
                                                                $fileExt = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = "$uploadDir/$file";
                                                                
                                                                // Mostrar imágenes con miniatura
                                                                if (in_array($fileExt, ['jpg', 'jpeg', 'png'])): ?>
                                                                    <div class="file-item">
                                                                        <a href="<?php echo htmlspecialchars($fileUrl); ?>" target="_blank">
                                                                            Ver imagen: <?php echo htmlspecialchars($file); ?>
                                                                        </a>
                                                                    </div>
                                                                    
                                                                <?php // Mostrar archivos PDF
                                                                elseif ($fileExt == 'pdf'): ?>
                                                                    <div class="file-item">
                                                                        <a href="<?php echo htmlspecialchars($fileUrl); ?>" target="_blank">
                                                                            Ver PDF: <?php echo htmlspecialchars($file); ?>
                                                                        </a>
                                                                    </div>
                                                                    
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <p>No se encontraron archivos para este ticket.</p>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-sm-12">
                                        <br>
                                        <!--Botones con d-flex para ponerlos HORIZONTALMENTE -->
                                        <div class="d-flex justify-content-around align-items-center flex-wrap gap-2">
                                            <!-- Botón Cerrar Ticket -->
                                            <div id="CerrarTicket">
                                                <button type="button" id="btnCerrar" name="btnCerrar" class="btn btn-sm btn-outline-danger" onclick="CerrarTicket('${noTicket}')">
                                                    <ion-icon name="close-outline" class="fa fa-times"></ion-icon> Cerrar Ticket
                                                </button>
                                            </div>
                                            <!-- Botón Poner en Espera -->
                                            <div id="EsperaTicket">
                                                <button type="button" id="btnEspera" name="btnEspera" class="btn btn-sm btn-outline-warning" onclick="EsperaTicket('${noTicket}')">
                                                    <i class="fa fa-cogs" aria-hidden="true"></i> Poner en Espera
                                                </button>
                                            </div>
                                            <!-- Botón Reabrir Ticket -->
                                            <div id="ReabrirTicket">
                                                <button type="button" id="btnReabrir" name="btnReabrir" class="btn btn-sm btn-outline-success" onclick="ReabrirTicket('${noTicket}')">
                                                    <i class="fa fa-cogs" aria-hidden="true"></i> Reabrir Ticket
                                                </button>
                                            </div>
                                            <!-- Botón Registrar Tiempo -->
                                            <div id="TiempoTicket">
                                                <button type="button" id="btnTiempo" name="btnTiempo" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ModalRegistroTiempo">
                                                    <i class="fas fa-fw fa-clock"></i> Registrar Tiempo
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <!--TABLA TIEMPO-->
                                    <h2>Registros de Tiempo del Ticket</h2>
                                    <table class="table table-striped" name="tablaTiempo" id="tablaTiempo">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Fecha de Inicio</th>
                                            <th>Fecha de Fin</th>
                                            <th>Tiempo Trabajado</th>
                                            <th>Descripción</th>
                                            <th>Eliminar Registro</th>
                                        </tr>
                                    </thead>    
                                    <tbody>
                                        
                                    </tbody>
                                    </table>
                                    <br><br>
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
    </div>
    <a class = "scroll-to-top rounded" href = "#page-top">
        <i class = "fas fa-angle-up"></i>
    </a>
    
    <!-- MODAL TIEMPO-->
    <div class="modal fade" id="ModalRegistroTiempo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalRegistroTiempoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalRegistroTiempoLabel">Registro de tiempo en ticket de servicio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">   
            <!-- Formulario -->
            <form id="RegistraTiempo">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <label for="usuario">Usuario:</label><br>
                        <input type="text" name="usuario" id="usuario" required disabled class="form-control">
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
                        <label for="descripcionT">Descripción:</label><br>
                        <textarea name="descripcionT" id="descripcionT" rows="2" cols="50" required class="form-control"></textarea>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" name="id_ticket" id ="id_ticket" value="<?php echo $id_ticket; ?>"><br>
                        <input type="hidden" name="IDUSR" id ="IDUSR"><br>
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" name="submit" class="btn btn-outline-success" onclick="registraTiempo()">Confirmar</button>
          </div>
        </div>
      </div>
    </div>

</body>
    
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src = "vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src = "vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src = "js/sb-admin-2.min.js"></script>    
    
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <!-- Incluir Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>

    <script type="text/javascript">
    
        $(document).ready(function () {
            TablaTiempo();
            TablaTickets();
            TablaEquipo();
        });
        
        //Llenar tabla Tickets 
        function TablaTickets(){
            
            var accion = "InfoTicket";
            var noTicket = $('#id_ticket').val();
                    
            $.ajax({
                url: 'acciones_ver_ticket.php', 
                method: 'POST',
                dataType: 'json', 
                data:{accion, noTicket},
                success: function(response) { 
                    var ticket = response[0]; // Obtiene directamente el primer elemento del array de respuesta
                    
                    $("#TiempoTicket").hide();
                    $("#CerrarTicket").hide();
                    $("#ReabrirTicket").hide();
                    $("#EsperaTicket").hide();
                
                    if (ticket.ESTADO === 'Abierto') {
                        $("#TiempoTicket").show();
                        $("#CerrarTicket").show();
                        $("#EsperaTicket").show();
                    }
                    if (ticket.ESTADO === 'Cerrado') {
                         $("#ReabrirTicket").show();;
                    }
                    if (ticket.ESTADO === 'En Espera') {
                        $("#ReabrirTicket").show();
                    }
                    if (ticket.ESTADO === 'En Proceso') {
                        $("#CerrarTicket").show();
                        $("#TiempoTicket").show();
                    }
                    
                    // Llena la tabla de forma NO DINAMICA
                    $('#NoTicket').text(ticket.NO_TICKET);
                    $('#descripcion').text(ticket.DESCRIPCION);
                    $('#cliente').text(ticket.NOMBRE_CLIENTE);
                    $('#prioridad').text(ticket.PRIORIDAD);
                    $('#estado').text(ticket.ESTADO);
                    $('#tipo').text(ticket.TIPO);
                    $('#ingeniero').text(ticket.INGENIERO);
                    $('#usuario').val(ticket.INGENIERO);
                    $('#IDUSR').val(ticket.IDUSR);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error al obtener la informacion del ticket.", textStatus, errorThrown);
                }
            });
        }
        
        //Llenar tabla Tickets 
        function TablaEquipo(){
            
            var accion = "InfoEquipo";
            var noTicket = $('#id_ticket').val();  
            
            $.ajax({
                url: 'acciones_ver_ticket.php', 
                method: 'POST',
                dataType: 'json', 
                data:{accion, noTicket},
                success: function(response) { 
                    var ticket = response[0]; // Obtiene directamente el primer elemento del array de respuesta

                    // Llena la tabla de forma NO DINAMICA 
                    $('#marca').text(ticket.MARCA);
                    $('#equipo').text(ticket.EQUIPO);
                    $('#modelo').text(ticket.MODELO);
                    $('#noSerie').text(ticket.NO_SERIE);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error al obtener la informacion del equipo.", textStatus, errorThrown);
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
        
        //Guardar tiempo
        function registraTiempo(){
            
            //OBTENEMOS VALOR SELECT
            var fecha_inicio = $('#fecha_inicio').val();
            var fecha_fin = $('#fecha_fin').val();
            var Tiempo = $('#tiempo').val();
            var descripcion = $('#descripcionT').val();
            var noTicket = $('#id_ticket').val();
            var IDUSR = $('#IDUSR').val();
            var accion = "registraTiempo";
            
           $.ajax({
                url: 'acciones_ver_ticket.php', // La URL del script PHP que obtendra los datos
                method: 'POST',
                async: false,
                data:{fecha_inicio, fecha_fin, Tiempo, descripcion, noTicket, IDUSR, accion},
                success: function() {
                    $('#RegistraTiempo')[0].reset(); 
                    Swal.fire({
                      title: "Confirmado",
                      text: "Tiempo Registrado",
                      icon: "success",
                      timer: 3000,  // 3 segundos
                      timerProgressBar: true,  // Muestra una barra de progreso
                      willClose: () => {} //Ejecuta alguna funcion despues de cerrar la alerta 
                    });
                    TablaTiempo();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
        }
        
        //Llenar Tabla Tiempo
        function TablaTiempo(){
            
            //Tabla Registro Tiempo
            var accion = "LlenarTablaTiempo";
            var noTicket = $('#id_ticket').val();
                    
            $.ajax({
                url: 'acciones_ver_ticket.php', // La URL del script PHP que obtendrá los datos
                method: 'POST',
                dataType: 'json', //TIPO DE DATO JSON
                data:{accion, noTicket}, //Los parametros que se envian
                success: function(registrosDeTiempo) {
                    
                    var table = $('#tablaTiempo').DataTable();
                    
                    table.clear().draw();
                    
                    registrosDeTiempo.forEach(function(Registro) { //EL valor que se recibe
                        table.row.add([
                        Registro.id, 
                        Registro.usuario,
                        Registro.fecha_inicio,
                        Registro.fecha_fin,
                        Registro.tiempo,
                        Registro.descripcion,
                        '<button class="btn btn-sm btn-outline-danger" onclick="EliminarT('+Registro.id+')"><i class="fas fa-fw fa-trash" aria-hidden="true"></i> </button>'
                        ]).draw(false);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error al obtener los equipos:", textStatus, errorThrown);
                }
            });
        }
        
        //Reabrir Ticket
        function ReabrirTicket(){
            var noTicket = $('#id_ticket').val();
            var accion = "reabrir_ticket";
            $.ajax({
                url: 'acciones_ver_ticket.php',
                method: 'POST',
                dataType: 'json',
                data: {accion, noTicket },
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    TablaTickets();
                },
                error: function (xhr, status, error) {
                    swal("Error al cambiar la informacion del ticket.");
                }
            });    
        }
        
        //CerrarTicket
        function CerrarTicket(){
            var noTicket = $('#id_ticket').val();
            var accion = "cerrar_ticket";
            $.ajax({
                url: 'acciones_ver_ticket.php',
                method: 'POST',
                dataType: 'json',
                data: {accion, noTicket },
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    TablaTickets();
                },
                error: function (xhr, status, error) {
                    
                    swal("Error al cambiar la informacion del ticket.");
                }
            });    
        }
        
        //EsperaTickett
        function EsperaTicket(){
            var noTicket = $('#id_ticket').val();
            var accion = "cambiar_estado";
            $.ajax({
                url: 'acciones_ver_ticket.php',
                method: 'POST',
                dataType: 'json',
                data: {accion, noTicket },
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    TablaTickets();
                },
                error: function (xhr, status, error) {
                    swal("Error al cambiar la informacion del ticket.");
                }
            });    
        }
        
        //Funcion para eliminar registro tiempo
        function EliminarT(idTiempo) {
            //Se Obtiene el id del registro tiempo por medio del boton eliminar, por eso "idTiempo" esta ahí
            var accion = "EliminarTiempo";
            $.ajax({
                url: 'acciones_ver_ticket.php',
                method: 'POST',
                dataType: 'json',
                data: {accion, idTiempo },
                success: function (response) {
                    console.log("Respuesta del servidor:", response.message);
                    TablaTiempo(); 
                },
                error: function (xhr, status, error) {
                    swal("Error al eliminar el registro.");
                }
            });
        }
        
    </script>
</body>
</html>