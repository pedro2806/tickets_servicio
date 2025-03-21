<?php 
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html lang = "sp">
<head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1, shrink-to-fit = no">
    <meta name = "description" content = "">
    <meta name = "author" content = "">

    <title>MESS TICKETS</title>
    
    <!-- FontAwesome -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Estilos personalizados para el template (sb-admin-2) -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Bootstrap (versión 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Estilos DataTables -->
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Select2 (estilos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <!-- Bootstrap (JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
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
                        <h1 class = "h3 mb-0 text-gray-800">Ticket de Servicio</h1>
                    </div>
                    <div class = "row">
                        <div class = "card shadow mb-2">
                            <form action="acciones_ticket\acciones_nuevo_ticket.php" method="POST"> <!--enctype="multipart/form-data"-->                      
                                <div class = "card-head"><br>
                                    <div class ="row">
                                        <div class = "col-sm-4">
                                            <span class="text-primary">
                                                <h3>No. Ticket: <strong id="idTicket"></strong><strong id="idTicket2"><?php $date = new DateTime();$year = $date->format("y"); echo $year; ?></strong><strong id="idTicket3">-X</strong></h3>
                                                <input id="noTicket" name="noTicket" type ="hidden" class="form-control">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-gray">
                                  <hr>
                                </div>
                                <div class = "card-body">
                                    <div class = "row">
                                        <input id="accion" name="accion" type ="hidden" value="nuevo" readonly>
                                        <!--Area-->
                                        <div class = "col-sm-3">
                                            <label>Area</label>
                                            <select id="area" name="area" class="form-select" onChange ="createTicket()" required>
                                                <option value="">Selecciona...</option>
                                            </select>
                                        </div>
                                        <!--Ingenieros-->
                                        <div class = "col-sm-3">
                                                <label for="ingeniero">Ingeniero</label>
                                                <select id="ingeniero" name="ingeniero" class="form-select">
                                                    <option value="0">Sin Asignar</option>
                                                </select>
                                            </div>
                                        <!--Prioridad-->
                                        <div class = "col-sm-3">
                                            <label for="prioridad">Prioridad</label>
                                            <select id="prioridad" name="prioridad" class="form-select" required>
                                                <option value="">Selecciona...</option>
                                                <option value="Baja">Baja</option>
                                                <option value="Media">Media</option>
                                                <option value="Alta">Alta </option>
                                            </select>
                                        </div>
                                        <!--Estado-->
                                        <div class = "col-sm-3">
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
                                    <div class = "row">
                                        <!--Tipo-->
                                        <div class = "col-sm-3">
                                            <label for="tipo">Tipo</label>
                                            <select id="tipo" name="tipo" class="form-select" required>
                                                <option value="">Selecciona...</option>
                                                <option value="Reparacion">Reparación</option>
                                                <option value="Incidente">Incidente</option>
                                                <option value="Solicitud">Solicitud</option>
                                                <option value="Mantenimiento">Mantenimiento</option>
                                            </select>
                                        </div>
                                        <!--Marca-->
                                        <div class = "col-sm-3">
                                            <label>Marca</label>
                                            <select id="marca" name="marca" class="form-select select-bg" style="height: 75%" onChange ="muestraequipos()">
                                                <option value="">Selecciona...</option>
                                            </select>
                                        </div>
                                        <!--Equipo-->
                                        <div class = "col-sm-3">
                                            <label>Equipo</label>
                                            <select id="equipo" name="equipo" class="form-select select-bg" onChange ="muestramodelo()">
                                                <option value="">Selecciona...</option>
                                            </select>
                                        </div>
                                        <!--Modelo-->
                                        <div class = "col-sm-3">
                                            <label>Modelo</label>
                                            <select id="modelo" name="modelo" class="form-select select-bg">
                                                <option value="">Selecciona...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class = "row">
                                        <!--No. Serie-->
                                        <div class = "col-sm-3">
                                            <label>No. Serie</label>
                                            <input id="noserie" name="noserie" type ="text" class="form-control" required>
                                        </div>
                                        <!--Cliente-->
                                        <div class = "col-sm-3">
                                            <label for="cliente">Cliente</label><br>
                                            <select id="cliente" name="cliente" class="form-select form-select-bg" required>
                                                <option value="">Selecciona...</option>
                                            </select>
                                        </div>
                                        <!--Fecha de Inicio-->
                                        <div class = "col-sm-3">
                                            <label>Fecha de Inicio</label>
                                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                                        </div>
                                        <!--OV-->
                                        <div class = "col-sm-2">
                                            <label>OV</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" id="enableTextbox" onclick="toggleTextbox()" class="form-check-input">
                                            <input type="text" id="ov" name="ov" disabled class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div class = "row">
                                        <!--Descripcion-->
                                        <div class = "col-sm-6">
                                            <label>Detalles del Servicio</label>
                                            <textarea id="descripcion" name="descripcion" rows="3" class="form-control" required></textarea>
                                        </div>
                                        <!--Subir Archivos-->
                                        <div class="col-sm-6">
                                            <label>Subir Archivo (s)</label>
                                            <div id="fileContainer">
                                                <input type="file" id = "archivo[]" name="archivo[]" accept=".pdf,.jpg,.jpeg,.png" class="form-control" >
                                            </div>
                                            <button type="button" id="addFileBtn" class="btn btn-secondary btn-sm mt-2">Agrega otro archivo</button>
                                        </div>
                                        <!--SCRIPT para subir archivos-->
                                        <script type="text/javascript">
                                        document.addEventListener('DOMContentLoaded', function () {
                                            let fileCount = 1; // Contador inicial
                                            const maxFiles = 3; // Máximo número de archivos permitidos
                                        
                                            // Función para agregar un nuevo campo de archivo
                                            function addFileField() {
                                                if (fileCount >= maxFiles) return;
                                        
                                                fileCount++;
                                                const input = document.createElement('input');
                                                input.type = 'file';
                                                input.name = 'archivo[]';
                                                input.accept = '.pdf,.jpg,.jpeg,.png';
                                                input.className = 'form-control mt-2';
                                        
                                                document.getElementById('fileContainer').appendChild(input);
                                        
                                                // Ocultar el botón si se ha alcanzado el máximo permitido
                                                if (fileCount >= maxFiles) {
                                                    document.getElementById('addFileBtn').style.display = 'none';
                                                }
                                            }
                                        
                                            // Manejo del evento click para agregar archivos
                                            document.getElementById('addFileBtn').addEventListener('click', function () {
                                                addFileField();
                                            });
                                        });
                                        </script>
                                    </div>
                                    <br><hr><br>
                                    <div class = "row">
                                        <div class = "col-sm-4"></div>
                                        <!--Boton "Crear Ticket"-->
                                        <div class = "col-sm-4">
                                            <center>
                                                <button type="button" class="btn btn-sm btn-outline-success" onClick="CrearTk()">Crear Ticket</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br><br><br><br>
            </div>
            <footer class = "sticky-footer bg-white">
                <div class = "container my-auto">
                    <div class = "copyright text-center my-auto">
                        <span>Copyright &copy; MESS</span>
                    </div>
                </div>
            </footer>
        </div> 
    </div>
    <a class = "scroll-to-top rounded" href = "#page-top">
        <i class = "fas fa-angle-up"></i>
    </a>
</body>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
    
    <!-- DataTables Buttons -->
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery Easing -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
    <!-- sb-admin-2 -->
    <script src="js/sb-admin-2.min.js"></script>
    
    <script type="text/javascript">
    
        $(document).ready(function () {
            muestramarca();
            evaluaRol();
            cargarArea();
            cargarInge();
            cargarClientes();
            
            $('#marca').select2({
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style'
            });
            
            $('#equipo').select2({
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style'
            });
            $('#ingeniero').select2({
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style'
            });
            $('#cliente').select2({
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style'
            });
            $('#area').select2({
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style'
            });

        });
        
        //Crear Ticket y Subir Archivos con FORMDATA
        function CrearTk() {
            // Crear un objeto FormData
            var formData = new FormData();
        
            // Agregar los datos del formulario
            formData.append('accion', 'nuevo');
            formData.append('noTicket', $('#noTicket').val());
            formData.append('descripcion', $('#descripcion').val());
            formData.append('ov', $('#ov').val());
            formData.append('fecha_inicio', $('#fecha_inicio').val());
            formData.append('cliente', $('#cliente').val());
            formData.append('noserie', $('#noserie').val());
            formData.append('modelo', $('#modelo').val());
            formData.append('equipo', $('#equipo').val());
            formData.append('marca', $('#marca').val());
            formData.append('tipo', $('#tipo').val());
            formData.append('estado', $('#estado').val());
            formData.append('prioridad', $('#prioridad').val());
            formData.append('ingeniero', $('#ingeniero').val());
            formData.append('area', $('#area').val());
            
            // Agregar archivos al FormData
            const inputs = document.querySelectorAll('input[name="archivo[]"]');
            inputs.forEach(input => {
                if (input.files.length > 0) {
                    formData.append('archivo[]', input.files[0]);
                }
            });
            
            noTicket = '';
            $.ajax({
                url: 'acciones_nuevo_ticket.php',
                method: 'POST',
                data: formData,
                processData: false, // No procesar los datos como cadenas
                contentType: false, // Permitir que el navegador configure el Content-Type
                success: function(response) {
                    noTicket = response;
                    
                    if (response.exitosos) {
                        Swal.fire({
                          title: "Ticket Creado!",
                          text: "Archivos subidos correctamente",
                          icon: "success"
                        });
                    }
                    if (response.errores && response.errores.length > 0) {
                        Swal.fire({
                          title: "Error subiendo los archivos.",
                          text: " ",
                          icon: "warning"
                        });
                    }
                    //window.location.assign("mistickets.php");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo.",
                        icon: "error"
                    });
                }
            });
            
            var opcion = "Enviar_Correo";
            //noTicket = $('#noTicket').val();
            ingeniero = $('#ingeniero').val();
            area = $('#area').val();
            $.ajax({
                url: 'acciones_nuevo_ticket.php',
                method: 'POST',
                dataType: 'json',
                data: {area, ingeniero, noTicket, opcion},
                success: function(response) {
                    Swal.fire({
                        title: "Correo Enviado!",
                        text: " ",
                        icon: "success"
                    });
                    //window.location.assign("mistickets.php");
                    
                            var datosCorreo = response[0];
                            
                            $.ajax({
                                url: "enviaNotificacion.php", 
                                method: "POST",
                                data: {
                                    correos: datosCorreo.correos,
                                    mensaje: datosCorreo.mensaje,
                                    noTicket: noTicket,
                                    area: datosCorreo.areaT,
                                },
                                success: function(enviarcorreo){
                                    Swal.fire({
                                        title: "Correo Enviado!",
                                        text: " ",
                                        icon: "success"
                                    });
                                    //window.location.assign("mistickets")
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    Swal.fire({
                                        title: "¡Algo Salio Mal!",
                                        text: "Intenta de Nuevo Enviar Correo.",
                                        icon: "error"
                                    });
                                }
                            });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Enviar Correo.",
                        icon: "error"
                    });
                }
            });
        }
        
        //Cargar Areas  
        function cargarArea(){
            accion = "cargarArea";
            
            $.ajax({
                url: 'acciones_nuevo_ticket.php',
                method: 'POST',
                dataType: 'json', 
                data: {accion},
                success: function(response) {
                    var area = $('#area'); 
                   
                    response.forEach(function(Registro) {
                            var option = $('<option></option>').attr('value', Registro.id_area).text(Registro.CDAREA);
                            area.append(option);
                        }
                    )
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Área.",
                        icon: "error"
                    });
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
                            var option = $('<option></option>').attr('value', Registro.IDUSR).text(Registro.USRCORTO);
                            ingeniero.append(option);
                        }
                    )
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Ingeniero.",
                        icon: "error"
                    });
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
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Clientes.",
                        icon: "error"
                    });
                }
            });
        }
        
        //MARCA
        function muestramarca(){
            var opcion = "marcas";
                $.ajax({
                    url: 'funciones_select.php', 
                    method: 'GET',
                    dataType: 'json',
                    data:{opcion},
                    success: function(data) {
                        var select = $('#marca');
                        data.forEach(function(marcas) {
                            
                            //AQUI SE CREA LA CADENA PARA LOS OPTION
                            var option = $('<option></option>').attr('value', marcas.id).text(marcas.descripcion);
                            
                            //AQUI SE VAN CARGANDO LAS OPCIONES DEL SELECT--- ATTR = ATRIBUTOS VALUE Y TEXTO
                            select.append(option);
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Marca.",
                        icon: "error"
                    });
                    }
                });
        }
        
        //EQUIPOS
        function muestraequipos(){
            //OBTENEMOS VALOR SELECT
            var marca = $('#marca').val();
            var opcion = "equipos";
           
                $.ajax({
                    url: 'funciones_select.php', // La URL del script PHP que obtendran los datos
                    method: 'GET',
                    dataType: 'json',
                    data:{marca, opcion},
                    success: function(data) {
                        var select = $('#equipo');
                        data.forEach(function(equipos) {
                            
                            //AQUI SE CREA LA CADENA PARA LOS OPTION
                            var option = $('<option></option>').attr('value', equipos.id_equipo).text(equipos.descripcion+'-'+equipos.modelo);
                            
                            //AQUI SE VAN CARGANDO LAS OPCIONES DEL SELECT--- ATTR = ATRIBUTOS VALUE Y TEXTO
                            select.append(option);
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Equipo.",
                        icon: "error"
                    });
                    }
                });
        }
        
        //MODELO 
        /*function muestramodelo(){
            //OBTENEMOS VALOR SELECT
            var equipo = $('#equipo option:selected').text();
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
                        Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Modelo.",
                        icon: "error"
                    });
                    }
                });     
        }*/
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
                    Swal.fire({
                        title: "¡Algo Salio Mal!",
                        text: "Intenta de Nuevo Modelo.",
                        icon: "error"
                    });
                }
            });
        }
        
        //ROL
        function evaluaRol(){
            let rol = getCookie("rol");
            if(rol == '4'){
                $('#ingeniero').prop('disabled', true);
            }
        }
        
        //COOKIES
        function getCookie(name) {
            let cookieArr = document.cookie.split(";");

            for(let i = 0; i < cookieArr.length; i++) {
                let cookiePair = cookieArr[i].split("=");

                if(name == cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }

            return null;
        }
        
        //Activa la casilla de "OV"
        function toggleTextbox() {
            var checkbox = document.getElementById("enableTextbox");
            var textbox = document.getElementById("ov");
            textbox.disabled = !checkbox.checked;
        }
        
        //Crear ID del Ticket
        function createTicket(){
            area=$('#area option:selected').text();       
            $('#idTicket').text('T-'+area);
            $('#noTicket').val($('#idTicket').text()+$('#idTicket2').text()+'-'); 
        }
        
    </script>
</body>
</html>