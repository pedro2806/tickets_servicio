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
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
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
                <?php
                    include 'encabezado.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Row -->
                        <div class="card shadow mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">                    
                                        <table id="TablaUs" name="TablaUs" class="display responsive table table-striped table-hover table-sm">
                                            <thead>
                                                <tr class="table-info">
                                                    <th>ID</th>
                                                    <th>Usuario</th>
                                                    <th>Area</th>
                                                    <th>Puesto</th>
                                                    <th>Correo</th>
                                                    <th>Region</th>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MESS 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <!-- MODAL Modificar Usuario -->
    <div id="modalModificarUsuario" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" id="modalModificarUsuarioTitulo">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modificar Informacion Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <div class="row">
                        <!--Modifcar Info Us-->
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <label for="usuario">Usuario:</label><br>
                            <input type="text" name="usuario" id="usuario" required class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label for="area">Área:</label><br>
                            <input type="text" name="area" id="area" required class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label for="puesto">Puesto:</label><br>
                            <input type="text" name="puesto" id="puesto" required class="form-control">
                        </div>
                        
                    </div>
                    <br><hr>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3">
                            <label for="correo">Correo:</label><br>
                            <input type="text" name="correo" id="correo" required class="form-control">
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <label for="region">Región:</label><br>
                            <input type="text" name="region" id="region" required class="form-control">
                        </div>
                        <div class="col-sm-1">
                            <input type="hidden" name="id_usuario" id="id_usuario">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-success" onclick="ModificarInfoUs()">Confirmar</button>
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
    <script>
        $(document).ready(function() {
            LlenaTablaUs();
        });
        
        // Llenar TablaUs
        function LlenaTablaUs() {
            var accion = 'LlenaTablaUs';
        
            $.ajax({
                url: 'acciones_usuario.php',
                method: 'POST',
                data: { accion },
                dataType: 'json',
                success: function (respuesta) {
        
                    // Inicializa la tabla y limpia cualquier dato existente
                    table = $('#TablaUs').DataTable();
                    table.clear();
        
                    // Agregar registros a la tabla
                    respuesta.forEach(function (registro) {
                        botones = `
                            <button type="button" class="btn btn-outline-info" onClick="mostrarModal('${registro.id}','${registro.usuario}','${registro.cdcanal}','${registro.puestousr}','${registro.correousr}','${registro.regusr}')">
                                <i class="fas fa-fw fa-pen"></i>
                            </button>`;
        
                        table.row.add([
                            registro.id,
                            registro.usuario,
                            registro.cdcanal,
                            registro.puestousr,
                            registro.correousr,
                            registro.regusr,
                            botones,
                        ]).draw(false);
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error en la solicitud:", errorThrown);
                    Swal.fire("�0�3No se pudo cargar la informaci��n!", "Tabla Usuarios.", "warning");
                },
            });
        }
        
        //Mostrar Modal 
        function mostrarModal(id, usuario, cdcanal, puestousr, correousr, regusr){
            $('#id_usuario').val(id);
            $('#usuario').val(usuario);
            $('#area').val(cdcanal);
            $('#puesto').val(puestousr);
            $('#correo').val(correousr);
            $('#region').val(regusr);
            $('#modalModificarUsuario').modal('show');
        }
        
        //Modificar Informacion Usuario
        function ModificarInfoUs(id, usuario, cdcanal, puestousr, correousr, regusr){
            var Id = $('#id_usuario').val();
            var Nombre = $('#usuario').val();
            var Area = $('#area').val();
            var Puesto = $('#puesto').val();
            var Correo = $('#correo').val();
            var Region = $('#region').val();
            var accion = "CambioInfoUs";
            
            $.ajax({
                url: 'acciones_usuario.php',
                method: 'POST',
                dataType: 'json',
                data:{Id, Nombre, Area, Puesto, Correo, Region, accion},
                success: function() {
                    Swal.fire({
                      title: "Se aplicaron los cambios",
                      text: "Usuario modificado",
                      icon: "success",
                      timer: 3000,  // 3 segundos
                      timerProgressBar: true,  // Muestra una barra de progreso
                      willClose: () => {} //Ejecuta alguna funcion despues de cerrar la alerta 
                    });
                LlenaTablaUs();
                $('#modalModificarUsuario').modal('hide');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("Algo Salio Mal!", "Intenta de Nuevo", "error");
                }
            });  
        }
    </script>    

</body>
</html>