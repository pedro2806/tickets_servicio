<!DOCTYPE html>
<html lang="sp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modificar Equipo</title>

    <!-- Custom fonts and styles for this template-->
    <!-- Custom fonts for this template-->
    <link href = "vendor/fontawesome-free/css/all.min.css" rel = "stylesheet" type = "text/css">
    <link href = "https://fonts.googleapis.com/css?family = Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel = "stylesheet">

    <!-- Custom styles for this template-->
    <link href = "css/sb-admin-2.min.css" rel = "stylesheet">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--Libreria para "SWAL.FIRE"-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include 'conn.php';
        session_start();
        include 'menu.php';
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'encabezado.php'; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Modificar Equipo</h1>                        
                    </div>
                    <div class="card shadow mb-2">
                        <div class="card-body">
                            <div class="row">
                                <!--MARCA-->
                                <div class="col-sm-3">
                                        <label for="Marca">Marca:</label>
                                        <select id="Marca" name="Marca" class="form-select" required>
                                            <option value="">Selecciona...</option>
                                        </select>
                                    </div>
                                <!--EQUIPO-->
                                <div class="col-sm-4">
                                    <label for="Equipo">Equipo:</label>
                                    <select id="Equipo" name="Equipo" class="form-select" required>
                                        <option value=" ">Selecciona...</option>
                                    </select>
                                </div>
                                <!--MODELO-->
                                <div class="col-sm-3">
                                    <label for="Modelo">Modelo:</label>
                                    <input type="text" class="form-control" id="Modelo" name="Modelo">
                                </div>
                                <!--ESTATUS-->
                                <div class="col-sm-2">
                                    <label for="Estatus">Estatus:</label>
                                    <select id="Estatus" name="Estatus" class="form-select" required>
                                        <option value=" ">Selecciona...</option>
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select>
                                </div>
                            </div>
                        </div>   
                        <br>      
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <!--BOTON-->
                            <center>
                                <button type="button" class="btn btn-sm btn-outline-success" onClick= "ActualizarInfo()">Confirmar</button>
                            </center>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MESS</span>
                    </div>
                </div>
            </footer>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    </div>
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
            muestramarca();
        });
         
        //Cargar Informacion 
        function InfoEquipo(){
    
            const urlParams = new URLSearchParams(window.location.search);
            const idEq = urlParams.get('ideq');
            var accion = "InfoEquipo";
                
                $.ajax({
                    url: 'acciones_ticket.php',
                    method: 'POST',
                    dataType: 'json',
                    data:{idEq, accion},
                    success: function(data) {
                        var Registros = data[0];
                        
                        $('#Marca').val(Registros.Id_Marca);
                        
                        muestraequipos(Registros.Id_Marca, Registros.Id_Equipo);
                        
                        $('#Modelo').val(Registros.Modelo);
                        
                        $('#Estatus').val(Registros.Estatus);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire("Algo Salio Mal!", "Informacion del Equipo", "error");    
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
                    var select = $('#Marca');
                    data2.forEach(function(marcas) {
                        
                        //AQUI SE CREA LA CADENA PARA LOS OPTION
                        var option = $('<option></option>').attr('value', marcas.id).text(marcas.descripcion);
                        
                        //AQUI SE VAN CARGANDO LAS OPCIONES DEL SELECT--- ATTR = ATRIBUTOS VALUE Y TEXTO
                        select.append(option);
                    });
                    InfoEquipo();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo Marca", "error");
                }
            });
        }
        
        //Cargar Equipos SELECT
        function muestraequipos(Id_Marca, Id_Equipo){
            
            if(Id_Marca == null || Id_Marca ==''){
                var marca = $('#Marca').val();
            }
            else{
                var marca = Id_Marca;
            }
            var opcion = "equipos";
           
            $.ajax({
                url: 'funciones_select.php', // La URL del script PHP que obtendra los datos
                method: 'GET',
                dataType: 'json',
                data:{marca, opcion},
                success: function(data) {
                    var select = $('#Equipo');
                    data.forEach(function(equipos) {
                        
                        var option = $('<option></option>').attr('value', equipos.id_equipo).text(equipos.descripcion+'-'+equipos.modelo);
                        
                        select.append(option);
                    });
                    $('#Equipo').val(Id_Equipo);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo Equipos", "error");
                }
            });
        }
        
        //Guardar Cambios
        function ActualizarInfo(){
            
            const urlParametros = new URLSearchParams(window.location.search);
            const id = urlParametros.get('ideq');
            
            var Id_Equipo = id;
            var Id_Marca = $("#Marca").val();
            var descripcion = $('#Equipo').val();
            var Modelo = $("#Modelo").val();
            var Estatus = $("#Estatus").val();
            
            var accion = "ModificarEq";
            
                $.ajax({
                    url: 'acciones_ticket.php', // La URL del script PHP que obtendra los datos
                    method: 'POST',
                    data:{Id_Equipo, Id_Marca, descripcion, Estatus,  Modelo, accion},
                    success: function() {
                        swal.fire("Se actualizo el equipo","","success");
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                    }
                });
        }
        
        //???
        function actualizarOpciones() {
            // Añadir nuevas opciones
            $.each(data, function(key, value) {
                $('#mi-select').append('<option value="' + value.id + '">' + value.nombre + '</option>');
            });
        }  
    </script>
</body>
</html>