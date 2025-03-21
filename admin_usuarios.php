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
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CDN -->
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
                    <div class = "container-fluid">
                        <!-- Page Heading -->
                        <div class = "d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class = "h3 mb-0 text-gray-800">Agregar Área al Usuario</h1>                        
                        </div>
                        <div class = "row">
                            <div class = "card shadow mb-2">  
                            <div class = "card-body">
                                <div class = "row">
                                    <!--USUARIO-->
                                    <div class = "col-sm-4">
                                        <label for="usuario">Usuario:</label>
                                        <select name="usuario" id="usuario" class="form-select select-bg" required>
                                            <option value="">Selecciona...</option>
                                        </select>
                                    </div>
                                    <!--AREA-->
                                    <div class = "col-sm-3">
                                        <label for="area">Área:</label>
                                        <select name="area" id="area" class="form-select select-bg" required>
                                            <option value="">Selecciona...</option>
                                        </select>
                                    </div>
                                    <br>
                                    <!--BOTON-->
                                    <div class="col-sm-2 d-flex align-items-center mt-4"> <!--class="col-sm-2 d-flex align-items-center mt-2" PARA ALINEAR EL BOTON-->
                                            <button type="button" class="btn btn-sm btn-outline-success" onClick="AsignarArea()">Confirmar</button>
                                    </div>
                                </div>
                                <br><hr><br>
                                <div class = "row">
                                    <div class = "col-sm-1"></div>
                                    <div class = "col-sm-10">
                                        <h3 class = "h3 mb-0 text-gray-800">Registros de Usuario Área</h3>
                                        <table id="TablaAreaUs" class ="display responsive nowrap table table-striped table-hover table-sm">
                                            <thead>
                                                <tr class="table-info">
                                                    <th>ID</th>
                                                    <th>Usuario</th>
                                                    <th>Área</th>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <!-- Bootstrap core JavaScript-->
    <script src = "vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src = "vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src = "js/sb-admin-2.min.js"></script>    
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
	
    <script type="text/javascript">
    
        $(document).ready(function () {
            cargarInge();
            cargarArea();
            LlenaTablaUs();
        });
        
        //Enviar Formulario Area Usuario
        function AsignarArea(){
            
            var id_usuario = $('#usuario').val();
            var id_area = $('#area').val();
            var accion = "AgregaArea";
            
            $.ajax({
                url: 'acciones_admin_usuarios.php',
                method: 'POST',
                dataType: 'json',
                data:{id_usuario, id_area, accion},
                success: function() {
                    swal.fire("Se asigno el área","","success");
                    LlenaTablaUs();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
    
        }
        
        //Tabla Usuarios
        function LlenaTablaUs(){
            var accion = "LlenaTablaUsArea";
            
            $.ajax({
                url: 'acciones_admin_usuarios.php',
                method: 'POST',
                data:{accion},
                dataType: 'json',
                success: function(respuesta) {
                    var table = $('#TablaAreaUs').DataTable();
                    table.clear().draw();
                    
                    respuesta.forEach(function (Registro) {
                        Botones = 
                        `<a class='btn btn-sm btn-outline-danger' onclick="eliminarRegUsArea('${Registro.id}', '${Registro.usuario}', '${Registro.area}')"><i class='fas fa-fw fa-trash'></i></a>`;
                        
                        table.row.add([
                            Registro.id,
                            Registro.usuario,
                            Registro.area,
                            Botones
                        ]).draw(false);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire("¡No se pudo cargar la informacion!", "Tabla Área Ususarios.", "warning");
                }
            });
        }
        
        //Eliminar Registro Area Usuario
        function eliminarRegUsArea(id, usuario, area){
            
            var accion = "eliminarRegUsArea";
            
            $.ajax({
                url: 'acciones_admin_usuarios.php',
                method: 'POST',
                dataType: 'json',
                data:{id, usuario, area, accion},
                success: function() {
                    swal.fire("Se elimino el área"," ","success");
                    LlenaTablaUs();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
        }
        
        //Cargar Ingenieros  
        function cargarInge(){
            
            accion = "cargarIngenieros";
            let CDCANAL = getCookie("area");
            $.ajax({
                url: 'acciones_admin_usuarios.php',
                method: 'POST',
                dataType: 'json', 
                data: {accion,CDCANAL},
                success: function(response) {

                    var usuario = $('#usuario'); 
                   
                    response.forEach(function(Registro) {
                            var option = $('<option></option>').attr('value', Registro.IDUSR).text(Registro.USRCORTO);
                            usuario.append(option);
                        }
                    )
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los ingenieros:', error);
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
                    console.error('Error al cargar las áreas:', error);
                }
            });
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
    
    </script>
</body>
</html>