<!DOCTYPE html>
<html lang="sp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modificar Ticket</title>

    <!-- Custom fonts and styles for this template-->
    <!-- Custom fonts for this template-->
    <link href = "vendor/fontawesome-free/css/all.min.css" rel = "stylesheet" type = "text/css">
    <link href = "https://fonts.googleapis.com/css?family = Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel = "stylesheet">

    <!-- Custom styles for this template-->
    <link href = "css/sb-admin-2.min.css" rel = "stylesheet">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <!--Libreria para "SWAL.FIRE"-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        session_start();
        include 'menu.php';
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include 'encabezado.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Modificar Ticket de Servicio</h1>                        
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                    <?php             
                    include 'conn.php';
                    ?>
                    
                    <div class="card shadow mb-2">
                        <div class="card-body">
                            <form action="acciones_ticket.php" method="POST">
                                <div class="row">
                                    <!--MARCA-->
                                    <div class="col-sm-3">
                                        <label for="marca">Marca</label>
                                        <select id="marca" name="marca" class="form-select select-bg">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <!--EQUIPO-->
                                    <div class="col-sm-3">
                                        <label for="equipo">Equipo</label>
                                        <select id="equipo" name="equipo" class="form-select select-bg"></select>
                                        <option value=""></option>
                                    </div>
                                    <!--MODELO-->
                                    <div class="col-sm-3">
                                        <label for="modelo">Modelo</label>
                                        <select id="modelo" name="modelo" class="form-select select-bg"></select>
                                        <option value=""></option>
                                    </div>
                                    <!--No. SERIE-->
                                    <div class="col-sm-3">
                                        <label>No. Serie</label>
                                        <input id="noserie" name="noserie" type="text" class="form-control">
                                     </div>
                                    </div>
                                <br>
                                <div class="row">
                                    <!--INGENIERO ASIGNADO-->
                                    <div class="col-sm-3">
                                        <label>Ingeniero Asignado</label>
                                        <select id="ingeniero" name="ingeniero" class="form-select select-bg">
                                             <option value="">Sin Asignar</option>
                                        </select>
                                    </div>
                                    <!--CLIENTE-->
                                    <div class="col-sm-3">
                                        <label for="cliente">Cliente</label><br>
                                        <select id="cliente" name="cliente" class="form-select">
                                            <option value="">Selecciona...</option>
                                        </select>
                                    </div>
                                    <!--PRIORIDAD-->
                                    <div class="col-sm-3">
                                        <label for="prioridad">Prioridad</label>
                                        <select id="prioridad" name="prioridad" class="form-select" required>
                                            <option value="">Selecciona...</option>
                                            <option value="Baja">Baja</option>
                                            <option value="Media">Media</option>
                                            <option value="Alta">Alta</option>
                                        </select>
                                    </div>
                                    <!--ESTADO-->
                                    <div class="col-sm-3">
                                        <label for="estado">Estado</label>
                                        <select id="estado" name="estado" class="form-select" required>
                                            <option value="">Selecciona...</option>
                                            <option value="Abierto">Abierto</option>
                                            <option value="En Proceso">En Proceso</option>
                                            <option value="Cerrado">Cerrado</option>
                                            <option value="En Espera">En Espera</option>
                                        </select>
                                    </div>
                                </div>
                                    <br>
                                <div class="row">
                                    <!--TIPO-->
                                    <div class="col-sm-3">
                                        <label for="tipo">Tipo</label>
                                        <select id="tipo" name="tipo" class="form-select" required>
                                            <option value="">Selecciona...</option>
                                            <option value="Reparacion">Reparación</option>
                                            <option value="Incidente">Incidente</option>
                                            <option value="Solicitud">Solicitud</option>
                                            <option value="Mantenimiento">Mantenimiento</option>
                                        </select>
                                    </div>
                                    <!--Fecha Inicio-->
                                    <div class="col-sm-3">
                                        <label for="fecha_inicio">Fecha de Inicio</label>
                                        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                                    </div>
                                    <!--OV-->
                                    <div class="col-sm-3">
                                        <label>OV</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" id="ov" name="ov" class="form-control">
                                    </div>
                                    <!--DETALLES DEL SERVICIO-->
                                    <div class="col-sm-3">
                                        <label for="descripcion">Detalles del Servicio</label>
                                        <textarea id="descripcion" name="descripcion" rows="1" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <br>      
                                <div class="row">
                                    <center>
                                           <button type="button" class="btn btn-sm btn-outline-success" onClick="Guardar_Modificaciones_Ticket()">Confirmar</button>
                                     </center>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MESS</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src = "vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src = "vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src = "js/sb-admin-2.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
	
	<!-- Incluir Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Incluir Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
<script type="text/javascript">
    
    $(document).ready(function () {
        muestramarca();
        cargarInge();
        cargarClientes();
    });
    
    //Datos Ticket Original            
    function muestraDatosTicket(id){
        // Obtener la URL actual
        const urlParams = new URLSearchParams(window.location.search);
        
        // Obtener el valor del parámetro 'idT'
        const idT = urlParams.get('id');
        var opcion = "muestraDatosTicket";
            
            $.ajax({
                url: 'funciones_select.php',
                method: 'GET',
                dataType: 'json',
                data:{idT, opcion},
                success: function(data) {
                    var datosTicket = data[0];
                        
                        $('#marca').val(datosTicket.MARCA);
                        
                        muestraequipos(datosTicket.MARCA);
                        
                        $('#equipo').val(datosTicket.ID_EQUIPO);
                        
                        muestramodelo(datosTicket.ID_EQUIPO);
                        
                        $('#modelo').val(datosTicket.MODELO);
                        
                        
                        $('#noserie').val(datosTicket.NO_SERIE);
                        $('#ingeniero').val(datosTicket.ID_INGENIERO);
                        $('#cliente').val(datosTicket.CLIENTE);
                        
                        $('#prioridad').val(datosTicket.PRIORIDAD);
                        $('#estado').val(datosTicket.ESTADO);
                        $('#tipo').val(datosTicket.TIPO);
                        $('#fecha_inicio').val(datosTicket.FECHA_INICIO);
                        $('#ov').val(datosTicket.OV);      
                        $('#descripcion').val(datosTicket.DESCRIPCION);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");    
                }
            });
    }
    
    //Cargar Marca SELECT
    function muestramarca(){
        
        var opcion = "marcas";
        
        $.ajax({
            url: 'funciones_select.php', // La URL del script PHP que obtendra los datos
            method: 'GET',
            dataType: 'json',
            data:{opcion},
            success: function(data2) {
                var select = $('#marca');
                data2.forEach(function(marcas) {
                    
                    //AQUI SE CREA LA CADENA PARA LOS OPTION
                    var option = $('<option></option>').attr('value', marcas.id).text(marcas.descripcion);
                    
                    //AQUI SE VAN CARGANDO LAS OPCIONES DEL SELECT--- ATTR = ATRIBUTOS VALUE Y TEXTO
                    select.append(option);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal.fire("Algo Salio Mal!", "Intenta de Nuevo Marca", "error");
            }
        });
    }
    
    //Cargar Equipos SELECT
    function muestraequipos(marcas){
        
        if(marcas == null || marcas ==''){
            var marca = $('#marca').val();
        }
        else{
            var marca = marcas;
        }
        var opcion = "equipos";
       
        $.ajax({
            url: 'funciones_select.php', // La URL del script PHP que obtendra los datos
            method: 'GET',
            dataType: 'json',
            data:{marca, opcion},
            success: function(data) {
                var select = $('#equipo');
                data.forEach(function(equipos) {
                    
                    //AQUI SE CREA LA CADENA PARA LOS OPTION
                    var option = $('<option></option>').attr('value', equipos.id_equipo).text(equipos.descripcion);
                    
                    //AQUI SE VAN CARGANDO LAS OPCIONES DEL SELECT--- ATTR = ATRIBUTOS VALUE Y TEXTO
                    select.append(option);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal.fire("Algo Salio Mal!", "Intenta de Nuevo Equipos", "error");
            }
        });
    }
             
    //Cargar Modelos SELECT
    function muestramodelo(equipos){
        
        if(equipos == null || equipos ==''){
            var equipo = $('#equipo').val();
        }
        else{
            var equipo = equipos;
        }
        
        var opcion = "modelo";
        
        $.ajax({
            url: 'funciones_select.php', // La URL del script PHP que obtendra los datos
            method: 'GET',
            dataType: 'json',
            data:{equipo, opcion},
            success: function(data2) {
                var select = $('#modelo');
                data2.forEach(function(modelo) {
                    
                    //AQUI SE CREA LA CADENA PARA LOS OPTION
                    var option = $('<option></option>').attr('value', modelo.modelo).text(modelo.modelo);
                    
                    //AQUI SE VAN CARGANDO LAS OPCIONES DEL SELECT--- ATTR = ATRIBUTOS VALUE Y TEXTO
                    select.append(option);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal.fire("Algo Salio Mal!", "Intenta de Nuevo Modelo", "error");
            }
        });
    }
    
    //Cargar Clientes  
    function cargarClientes(){
        accion = "cargarClientes";
        
        $.ajax({
            url: 'acciones_nuevo_ticket.php',
            method: 'POST',
            dataType: 'json', 
            data: {accion},
            success: function(response) {
                var cliente = $('#cliente'); 
               
                response.forEach(function(Registro) {
                        var option = $('<option></option>').attr('value', Registro.IDCLTE).text(Registro.CLIENTE_LARGO);
                        cliente.append(option);
                    }
                )
                muestraDatosTicket();
            },
            error: function(xhr, status, error) {
                swal.fire("Algo Salio Mal!", "Intenta de Nuevo Clientes", "error");
            }
        });
    }
    
    //Cargar Ingenieros  
    function cargarInge(){
        accion = "cargarIngenieros";
        let CDCANAL = getCookie("area");
        
        $.ajax({
            url: 'acciones_nuevo_ticket.php',
            method: 'POST',
            dataType: 'json', 
            data: {accion,CDCANAL},
            success: function(response) {
                var ingeniero = $('#ingeniero'); 
               
                response.forEach(function(Registro) {
                        var option = $('<option> </option>').attr('value', Registro.IDUSR).text(Registro.USRCORTO);
                        ingeniero.append(option);
                    }
                )
            },
            error: function(xhr, status, error) {
                swal.fire("Algo Salio Mal!", "Intenta de Nuevo Ingenieros", "error");
            }
        });
    }
    
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
        
    //???
    function actualizarOpciones() {
        // Añadir nuevas opciones
        $.each(data, function(key, value) {
            $('#mi-select').append('<option value="' + value.id + '">' + value.nombre + '</option>');
        });
    }
    
    //Guardar Cambios del Ticket
    function Guardar_Modificaciones_Ticket(){
        // Obtener la URL actual
        const urlParams = new URLSearchParams(window.location.search);
        
        // Obtener el valor del parámetro 'idT'
        const idT = urlParams.get('id');
        
        var marca = $('#marca').val();
        var equipo = $('#equipo').val();
        var modelo = $('#modelo').val();
        var noserie =$('#noserie').val();
        var ingeniero = $('#ingeniero').val(); 
        var cliente = $('#cliente').val();
        var prioridad = $('#prioridad').val();
        var estado = $('#estado').val();
        var tipo = $('#tipo').val();
        var fecha_inicio = $('#fecha_inicio').val();
        var ov = $('#ov').val();
        var descripcion = $('#descripcion').val();
        
        var accion = "modificar";
        
        $.ajax({
                url:'acciones_nuevo_ticket.php',
                method: 'POST',
                dataType: 'json',
                data:{marca, equipo, modelo, noserie, ingeniero, cliente, prioridad, estado, tipo, fecha_inicio, ov, descripcion, idT, accion},
                success: function() {
                    swal.fire("Se aplicaron los cambios"," ","success");
                    window.location.assign("mistickets.php"); 
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });
    }
    
</script>
</body>
</html>