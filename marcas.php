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
        <div id = "content-wrapper" class = "d-flex flex-column">
            <div id = "content">
                <?php
                    include 'encabezado.php';
                ?>
                <div class = "container-fluid">
                    <div class = "d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class = "h3 mb-0 text-gray-800">Agregar Marca</h1>                        
                    </div>
                    <div class = "card shadow mb-2">
                        <div class = "card-body">
                            <div class = "row">
                                <div class = "col-sm-.4">
                                        <Strong>
                                        <label for="marca">Marca:</label><br>
                                        </Strong>
                                </div> 
                                <div class = "col-sm-2">
                                    <input type="text" id="marca" name="marca" required class="form-control"> 
                                </div>
                                <div class = "col-sm-2">
                                    <button type="button" class="btn btn-outline-success" onClick="AgregarMarca()">Confirmar</button>
                                </div>
                            </div>
                            <hr><br>
                            <!--TABLAS-->
                            <div class = "row">
                                <!--TABLA MARCAS ACTIVAS-->
                                <div class = "col-sm-6">
                                    <h3 class = "h3 mb-0 text-gray-800">Marcas Activas  </h3>
                                    <br>
                                    <table id="MarcasActivas" name="MarcasActivas" class ="table table-sm table-striped">
                                        <thead>
                                            <tr class="table-info">
                                                <th>ID</th>
                                                <th>Marca</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <!--TABLA MARCAS INNACTIVAS-->
                                <div class = "col-sm-6">
                                    <h3 class = "h3 mb-0 text-gray-800">Marcas Inactivas </h3>
                                    <br>
                                    <table id="MarcasInactivas" name="MarcasInactivas" class ="table table-sm table-striped">
                                        <thead>
                                            <tr class="table-warning">
                                                <th>ID</th>
                                                <th>Marca</th>
                                                <th> </th>
                                                
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
                        <span>Copyright &copy; MESS</span>
                    </div>
                </div>
            </footer>
            </div>
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
            TablaMarcasAct();
            TablaMarcasInna();
        });
        
        //Agregar Marca
        function AgregarMarca(){
            
            var Nombre_Marca = $('#marca').val();
            var accion = "RegistroMarca";
            
            $.ajax({
                url: 'acciones_ticket.php',
                method: 'POST',
                dataType: 'json',
                data:{Nombre_Marca, accion},
                success: function() {
                    Swal.fire({
                      title: "Confirmado",
                      text: "Marca Agregada",
                      icon: "success",
                      timer: 3000,  // 3 segundos
                      timerProgressBar: true,  // Muestra una barra de progreso
                      willClose: () => {} //Ejecuta alguna funcion despues de cerrar la alerta 
                    });
                TablaMarcasAct();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
        }
        
        //Cargar Tabla Marcas Activas
        function TablaMarcasAct(){
                      
            var accion = "LlenaTablaAct";
            
            $.ajax({
                url: 'acciones_ticket.php',
                method: 'POST',
                data:{accion},
                dataType: 'json',
                success: function(respuesta) {
                    var registros = respuesta.data;
                   
                    var table = $('#MarcasActivas').DataTable();
                    table.clear().draw();
                    
                        respuesta.forEach(function(Registro) {
                            
                            Botones = 
                                `<button type="button" class="btn btn-outline-danger" onclick="Baja_estatus_marca('${Registro.Id_Marca}')">
                                    <i class = "fas fa-fw fa-trash"></i>
                                </button>`;
                            
                            table.row.add([
                                Registro.Id_Marca,
                                Registro.Nombre_Marca,
                                Botones,
                            ]).draw(false);
                        });  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal("!No se pudo cargar la información!", " ", "warning");
                }
            });
        }
        
        //Cargar Tabla Marcas Innactivas
        function TablaMarcasInna(){
                      
            var accion = "LlenaTablaInnac";
            
            $.ajax({
                url: 'acciones_ticket.php',
                method: 'POST',
                data:{accion},
                dataType: 'json',
                success: function(respuesta) {
                    var registros = respuesta.data;
                   
                    var table = $('#MarcasInactivas').DataTable();
                    table.clear().draw();
                    
                        respuesta.forEach(function(Registro) {
                            
                            Botones = 
                                `<button type="button" class="btn btn-outline-warning" onclick="Alta_estatus_marca('${Registro.Id_Marca}')">
                                    <i class = "fas fa-fw fa-pen"></i>
                                </button>`;

                            table.row.add([
                                Registro.Id_Marca,
                                Registro.Nombre_Marca,
                                Botones,
                            ]).draw(false);
                        });  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal("!No se pudo cargar la información!", " ", "warning");
                }
            });
        }
        
        //Baja Marca
        function Baja_estatus_marca(Id_Marca){
            
            var accion = "Baja_estatus_marca";
            
            $.ajax({
                url: 'acciones_ticket.php',
                method: 'POST',
                dataType: 'json',
                data:{Id_Marca, accion},
                success: function() {
                    Swal.fire({
                      title: "Se aplicaron los cambios",
                      text: "Marca modificada",
                      icon: "success",
                      timer: 3000,  // 3 segundos
                      timerProgressBar: true,  // Muestra una barra de progreso
                      willClose: () => {} //Ejecuta alguna funcion despues de cerrar la alerta 
                    });
                TablaMarcasAct();
                TablaMarcasInna();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
        }
        
        //ALta Marca
        function Alta_estatus_marca(Id_Marca){
            
            var accion = "Alta_estatus_marca";
            
            $.ajax({
                url: 'acciones_ticket.php',
                method: 'POST',
                dataType: 'json',
                data:{Id_Marca, accion},
                success: function() {
                    Swal.fire({
                      title: "Se aplicaron los cambios",
                      text: "Marca modificada",
                      icon: "success",
                      timer: 3000,  // 3 segundos
                      timerProgressBar: true,  // Muestra una barra de progreso
                      willClose: () => {} //Ejecuta alguna funcion despues de cerrar la alerta 
                    });
                TablaMarcasAct();
                TablaMarcasInna();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
        }
    
    </script>
</body>
</html>