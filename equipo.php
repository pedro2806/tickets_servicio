<!DOCTYPE html>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Libreria para "SWAL.FIRE"-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body id = "page-top">

    <div id = "wrapper">
        <?php
            session_start();
            include 'menu.php';
        ?>
        <!-- Content Wrapper -->
        <div id = "content-wrapper" class = "d-flex flex-column">
            <div id = "content">
                <?php
                    include 'conn.php';
                    include 'encabezado.php';
                ?>
                <!-- Begin Page Content -->
                <div class = "container-fluid">
                    <!-- Page Heading -->
                    <div class = "d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class = "h3 mb-0 text-gray-800">Agregar Equipos</h1>                        
                    </div>
                    <div class = "card shadow mb-2">
                        <div class = "card-body">
                            <!--CAMPOS Equipo Nuevo-->
                            <div class = "row">
                                <!--MARCA-->
                                <div class = "col-sm-2">
                                    <strong><label for="marca">Marca:</label></strong>
                                    <select id="marca" name="marca" class="form-select select-bg" onChange ="muestraequipos()">
                                        <option value="0">Selecciona...</option>   
                                    </select>
                                </div>
                                <!--EQUIPO-->
                                <div class = "col-sm-2">
                                    <strong><label for="marca">Equipo:</label></strong>
                                    <select id="equipo" name="equipo" class="form-select select-bg">
                                        <option value="0">Selecciona...</option>
                                    </select>
                                </div>
                                <!--MODELO-->
                                <div class = "col-sm-2">
                                    <strong><label for="marca">Modelo:</label></strong>
                                    <input type="text" id="modelo" name="modelo" class="form-control" required> 
                                </div>
                                <div class = "col-sm-2 d-flex align-items-center mt-4">
                                    <button type="button" class="btn btn-sm btn-outline-success" onClick="EquipoNuevo()">Confirmar</button>
                                </div>
                            </div>
                            <br><hr><br>
                            <!--TABLA-->
                            <div class = "row">
                                <div class = "col-sm-1"></div>
                                <!--Tabla de Equipos Registrados-->
                                <div class = "col-sm-10">
                                    <h3 class = "h3 mb-0 text-gray-800">Equipos registrados</h3>
                                    <br>
                                    <table class="table table-sm table-striped" name="tablaEquipos" id="tablaEquipos">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Marca</th>
                                                <th>Equipo</th>
                                                <th>Modelo</th>
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
    
    
    <script type="text/javascript">
    
        $(document).ready(function () {
            LlenarTablaEquipos();
            muestramarca();
        });
        
        //Llenar Tabla Equipos
        function LlenarTablaEquipos(){
            var opcion = "llenarTablaEquipos";
                
            $.ajax({
                url: 'funciones_select.php', // La URL del script PHP que obtendrá los datos
                method: 'GET',
                dataType: 'json', //TIPO DE DATO JSON
                data:{opcion}, //Los parametros que se envian
                success: function(data) {
                    
                    var table = $('#tablaEquipos').DataTable();
                    
                    
                    data.forEach(function(equipos) {
                        table.row.add([
                            equipos.marca,
                            equipos.descripcion, 
                            equipos.modelo,
                            boton = `<button type="button" onclick ="ModificarEq('${equipos.id_equipo}')" class ="btn btn-outline-warning">
                                        <i class="fas fa-fw fa-pen"></i>
                                     </button>`
                            ]).draw(false);  
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Error al obtener los equipos.", "error");  
                }
            });
        }
        
        //Equipo Nuevo
        function EquipoNuevo(){
            
            var Id_Marca = $('#marca').val();
            var Nombre_Equipo = $('#equipo').val();
            var Modelo = $('#modelo').val();
            var accion = "NuevoEquipo";
            
            $.ajax({
                url: 'acciones_ticket.php',
                method: 'POST',
                dataType: 'json',
                data:{Id_Marca, Nombre_Equipo, Modelo, accion},
                success: function() {
                    Swal.fire({
                      title: "Confirmado",
                      text: "Modelo Agregado",
                      icon: "success",
                      timer: 3000,  // 3 segundos
                      timerProgressBar: true,  // Muestra una barra de progreso
                      willClose: () => {} //Ejecuta alguna funcion despues de cerrar la alerta 
                    });
                LlenarTablaEquipos();
                },
                    error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });
        }
        
        //Modificar Equipos
        function ModificarEq(idEquipo){
            //Redireccionar a modifica_equipos, mandar idEquipo
            window.location.replace("modificar_equipo.php?ideq="+idEquipo);
        }
        
        //Cargar MARCAS
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
                        //sweealert
                        swal("Algo Salio Mal!", "Intenta de Nuevo", "error");
                        
                    }
                });
        }
        
        //Cargar EQUIPOS
        function muestraequipos(){
            
            var marca = $('#marca').val();
            var opcion = "equipos";
           
            $.ajax({
                url: 'funciones_select.php', // La URL del script PHP que obtendra los datos
                method: 'GET',
                dataType: 'json',
                async: false,
                data:{marca, opcion},
                success: function(data) {
                    var select = $('#equipo');
                    data.forEach(function(equipos) {
                        
                        var option = $('<option></option>').attr('value', equipos.descripcion).text(equipos.descripcion+'-'+equipos.modelo);
                        select.append(option);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Error al cargar los equipos.", "error");   
                }
            });
        }
        
    </script>
</body>
</html>