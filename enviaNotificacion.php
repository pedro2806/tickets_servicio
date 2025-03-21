<?php
include 'conn.php';
header('Content-Type: text/html; charset=UTF-8');
header('Access-Control-Allow-Origin: *');

    $deAsunto="Ticket de Servicio";
    $area = $_POST['area'];
    $noTicket = $_POST['noTicket'];
    
    $sql_area= "SELECT CDAREA FROM `areas` WHERE id = $area;";
    $resul_area = $conn->query($sql_area);
    
    while ($row2 = $resul_area->fetch_assoc()) {
        $Nombre_Area = $row2["CDAREA"];
    }
    
    require_once("PHPMailer-master/src/PHPMailer.php");
    require_once("PHPMailer-master/src/SMTP.php");
    

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    $mail->IsSMTP();
	
    $mail->SMTPDebug = 2; // PONER EN 0 SI NO QUIERES QUE SALGA EL LOG EN LA PANTALLA
                          //PONER EN 2 PARA DEPURACION DETALLADA
    //$mail->Debugoutput = 'html';                        //PARA VER DEBUG
    
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // o 587
    $mail->IsHTML(true);
    
    $mail->Username = "mess.metrologia@gmail.com";//////////////////////////////////PONER CUENTA GMAIL
    $mail->Password = "hglidvwsxcbbefhe";////CONTRASENIA DE APLICACION GENERADA DESDE CONSOLA DE GOOGLE
    
    $mail->SetFrom("mess.metrologia@gmail.com", "Ticket de Servicio");
    $mail->Subject = $deAsunto;
    $mail->Body = ' 
<html>
<head>
    <center> 
        <img width="20%" id="m_-3753487164271908945_x0000_i1025" src="https://ci3.googleusercontent.com/meips/ADKq_NYhiEFf6y5tnTB6DV4jkCEV3F4MDI6GDAz7jhLWu8wtauTkJix3jEqXvqswlE7bA9rBxpj0SL4eiGqW3lkadmRuXo_ybfuCvVViaW5-NW1xaDjlB9Hca0Ajq7F2F_7-6w=s0-d-e1-ft#

        https://messbook.com.mx/intranet/wp-content/uploads/2021/04/logo_nuevo.png

        " class="CToWUd a6T" data-bit="iit" tabindex="0">

        <br><hr>
    </center>
    
    <meta charset="UTF-8">
    <style>
        .header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
        }
    </style>
</head>
<body>
    <div class="header">
        Aviso de Nuevo Ticket
    </div>
        
    <center>
    <h1>
         '.$_POST['mensaje'].'
    </h1>
    <h1>
        '.$_POST['noTicket'].'<br><br>
        Correspondiente al &aacute;rea:
        '.$Nombre_Area.'
    </h1>
    </center> <br><br><br><br>
    
    <center>
    <p>Este es un mensaje autom&aacute;tico, por favor no responda a este correo.</p>
    </center>
</body>
</html>';

    //Envío de correo
  
    if (isset($_POST['correos']) && isset($_POST['mensaje'])) {
        $correos = $_POST['correos']; 
        $Arraycorreos  = explode (",", $correos);
        $mensaje = $_POST['mensaje'];
        
        error_log("Correos recibidos: " . print_r($correos, true));
        error_log("Mensaje recibido: '$mensaje'");

        foreach ($Arraycorreos as $correo) {
            
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress(trim($correo));
            } else {
                error_log("Correo inv&aacute;realido: '$correo'");
            }
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Faltan datos"]);
    }
        
        if(!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else{
         ?>
            <div style="color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
            ">
            Mensaje Enviado
            </div>
        <?php
          header("location: https://messbook.com.mx/mistickets");
        }
?>