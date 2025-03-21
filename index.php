<!DOCTYPE html>
<html lang = "sp">

<head>

    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1, shrink-to-fit = no">
    <meta name = "description" content = "">
    <meta name = "author" content = "">

    <title>MESS - Tickets de Servicio</title>

    <!-- Custom fonts for this template-->

    

    <!-- Custom styles for this template-->
    <link href = "css/sb-admin-2.min.css" rel = "stylesheet">

</head>

<body class = "bg-gradient-primary">

    <div class = "container">

        <!-- Outer Row -->
        <div class = "row justify-content-center">

            <div class = "col-xl-10 col-lg-12 col-md-9">

                <div class = "card o-hidden border-0 shadow-lg my-5">
                    <div class = "card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class = "row">
                            <div class = "col-sm-6 d-none d-sm-block bg-login-image">
                                <br>
                                <center>
                                    <b>
                                        MESS<br>
                                        Tickets de Servicio
                                    </b>
                                </center>
                            </div>
                            <div class = "col-lg-6">
                                <div class = "p-5">
                                    <div class = "text-center">
                                        <h1 class = "h4 text-gray-900 mb-4">Bienvenido</h1>
                                    </div>
                                    <br>
                                    <form class = "user" method = "POST">
                                        <div class = "form-group">
                                            <input type = "text" class = "form-control form-control-user" id = "InputEmail" name = "InputEmail" aria-describedby = "emailHelp" placeholder = "Usuario">
                                            <span>@mess.com.mx</span>
                                        </div>
                                        <div class = "form-group">
                                            <input type = "password" class = "form-control form-control-user" id = "InputPassword" name = "InputPassword" placeholder = "Contrase&ntilde;a">
                                        </div>
                                        <div class = "form-group">
                                            <div class = "custom-control custom-checkbox small">
                                                <input type = "checkbox" class = "custom-control-input" id = "customCheck">
                                                <label class = "custom-control-label" for = "customCheck">Recordar usuario y contrase&ntilde;a</label>
                                            </div>
                                        </div>
                                        <center>
                                            <input class = "btn btn-primary" type = "submit" name = "btningresar" value = "   Acceder   "/>                                       
                                        </center>
                                        <br>
                                        <hr>
                                    </form>                      

                                        <div class = "text-center">
                                            <a class = "small" href = "forgot-password">Olvide mi contrase&ntilde;a</a>
                                        </div>                                        
                                        <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    
        session_start();
        if(isset($_SESSION['nombredelusuario']))
        {
            header('location: inicio');
        }

        if(isset($_POST['btningresar']))
        {        
            include 'conn.php';
            
            $usuario = $_POST['InputEmail'];
            $pass = $_POST['InputPassword'];
            
            //Solo toma la primera parte del texto hasta el "@"
            $usuario = explode('@', $usuario)[0];
            
            $QUsuarios  =  "SELECT  * FROM usuarios WHERE CORREOUSR  =  '".$usuario."@mess.com.mx' and PASSWORD  =  '".$pass."'";
            //$QUsuarios  =  "SELECT  * FROM usuarios WHERE CORREOUSR  =  '".$usuario."' and PASSWORD  =  '".$pass."'";
            $res2 =  mysqli_query( $conn, $QUsuarios ) or die (mysqli_error($conn));
            $nr = mysqli_num_rows($res2);
            
            While ($row2 = mysqli_fetch_array($res2)){
                $nombreEmpleado = utf8_encode($row2["USUARIO"]);
                $noEmpleado = utf8_encode($row2["IDUSR"]);
                $region = utf8_encode($row2["REG_OT"]);
                $area = utf8_encode($row2["CDCANAL"]);
                $rol = utf8_encode($row2["ROL"]);
            }
    
            if($nr == 1)
            {   
                //Define el tiempo de expiracion (3 minutos)
                $expiryTime = date('D, d M Y H:i:s \G\M\T', time() + 172800000);
                echo '
                <script>
                document.cookie = "nombredelusuario=' . $nombreEmpleado . '; expires=' . $expiryTime . '; SameSite=Lax;"
                //LocalStorage almacena la cookie 
                localStorage.setItem("nombredelusuario", new Date(Date.now() + 18000000).getTime())
                </script>';
                
                echo '<script>document.cookie = "region='.$region.';expires=" + new Date(Date.now() + 99900000).toUTCString() + ";SameSite=Lax;";</script>';
                echo '<script>document.cookie = "noEmpleado='.$noEmpleado.';expires=" + new Date(Date.now() + 99900000).toUTCString() + ";SameSite=Lax;";</script>';
                echo '<script>document.cookie = "area='.$area.';expires=" + new Date(Date.now() + 99900000).toUTCString() + ";SameSite=Lax;";</script>';
                echo '<script>document.cookie = "rol='.$rol.';expires=" + new Date(Date.now() + 99900000).toUTCString() + ";SameSite=Lax;";</script>';
                echo '<script>window.location.assign("inicio")</script>';
                
            }
            else if ($nr  ==  0)
            {
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script>swal("Usuario o contraseña incorrectos! ", "Vuelve a intentar!", "error");</script>';
                
            }
            
        }
    ?>
    
</body>
<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src = "vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript
    <script src = "vendor/jquery-easing/jquery.easing.min.js"></script>    -->
    <!-- Custom scripts for all pages-->    
    
</html>
<?php

?>