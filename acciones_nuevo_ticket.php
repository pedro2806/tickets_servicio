<?php
include 'conn.php';
header('Content-Type: application/json');

$accion = $_POST["accion"] ?? 0;
$opcion=$_POST["opcion"] ?? 0;

$noTicket = $_POST["noTicket"] ?? 0;
$id_area = $POST["id"] ?? 0;
$nombreArea = $_POST["CDAREA"] ?? 0;
$descripcion = $_POST["descripcion"] ?? 0;
$ingeniero = $_POST["ingeniero"] ?? 0;
$fecha_inicio = $_POST["fecha_inicio"] ?? 0;
$fecha_fin = $_POST["fecha_fin"] ?? 0;
$cliente = $_POST["cliente"] ?? 0;
$prioridad = $_POST["prioridad"] ?? 0;
$estado = $_POST["estado"] ?? 0;
$tipo = $_POST["tipo"] ?? 0;
$fecha_registro = date("Y-m-d H:i:s");
$noEmpleado = $_POST["noEmpleado"] ?? 0;
$ID_Ticket = $_POST["idT"] ?? 0;

$equipo =$_POST["equipo"] ?? 0;
$marca =$_POST["marca"] ?? 0; 
$modelo =$_POST["modelo"] ?? 0;
$noserie =$_POST["noserie"] ?? 0;
$areaT =$_POST["area"] ?? 0;
$ov =$_POST["ov"] ?? 0;
$estatuseq =$_POST["estatuseq"] ?? 0;

$ID =$_POST["ID"] ?? 0;
$IDUSR= $_POST["idusr"] ?? 0;
$IDEQ= $_POST["ideq"] ?? 0;

$tiempo_trabajo = $_POST["Tiempo"] ?? 0;

$Nombre = $_POST["Nombre"] ?? 0;  
$Area = $_POST["CDCANAL"] ?? 0;  
$Puesto = $_POST["Puesto"] ?? 0; 
$Correo = $_POST["Correo"] ?? 0;
$Region = $_POST["Region"] ?? 0;
$Estatus = $_POST["Estatus"] ?? 0;
$Contrasena = $_POST["Contrasena"] ?? 0;
$Rol = $_POST["Rol"] ?? 0;
$roll = $_COOKIE['rol'] ?? 0;

$CorreoUs = $_POST["Correo"] ?? 0;
/*----------------------------------------------------------------------------*/

//FUNCION PARA AGREGAR TICKET NUEVO
    
    if ($accion === 'nuevo') {
        
        //Crea id del ticket
        $QUmarcas = "SELECT COUNT(*) + 1 AS cuantos FROM tickets_servicio";
        $res22 = mysqli_query($conn, $QUmarcas);
        $cuantos = 0;
        while ($row22 = mysqli_fetch_array($res22)) {
               $cuantos = $row22["cuantos"];
        }
        $ticket = $noTicket.$cuantos;
        
        // Insertar datos del ticket en la base de datos
        $sql = "INSERT INTO tickets_servicio (DESCRIPCION, INGENIERO, FECHA_INICIO, CLIENTE, PRIORIDAD, ESTADO, TIPO, FECHA_CREACION, EQUIPO, MARCA, MODELO, NO_SERIE, AREA, OV, NO_TICKET)
                VALUES ('$descripcion', $ingeniero, '$fecha_inicio', $cliente, '$prioridad', '$estado', '$tipo', NOW(), '$equipo', '$marca', '$modelo', '$noserie', '$areaT', '$ov', '$ticket')";
        if (!mysqli_query($conn, $sql)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Error al guardar el ticket: ' . mysqli_error($conn)]);
            exit;
        }
        
        $uploadDir = "Archivos/$ticket";
        
        // Crear carpeta si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0700, true);
        }
    
        if (isset($_FILES['archivo'])) {
            foreach ($_FILES['archivo']['name'] as $key => $name) {
                $tmp_name = $_FILES['archivo']['tmp_name'][$key];
                $fichero_subido = "$uploadDir/" . basename($name);
    
                if ($_FILES['archivo']['error'][$key] === UPLOAD_ERR_OK) {
                    if (move_uploaded_file($tmp_name, $fichero_subido)) {
                        $resultados['exitosos'][] = $name;
                    } else {
                        $resultados['errores'][] = "Error al mover el archivo $name.";
                    }
                } else {
                    $resultados['errores'][] = "Error en el archivo $name. Código: " . $_FILES['archivo']['error'][$key];
                }
            }
        }
        
        echo json_encode($ticket);
    }
    
//ENVIO DE CORREO
    
    if ($opcion ==='Enviar_Correo'){
        
        //ENVIAR CORREO
        if (!empty($ingeniero)) {
            $C1 = '';
            $M1 = "Tienes un nuevo ticket asignado: $ticket";
                
            $sql = "SELECT GROUP_CONCAT(CORREOUSR) AS Correo 
                    FROM usuarios us
                    INNER JOIN areas a ON us.CDCANAL = a.CDAREA
                    WHERE 
                    (us.ROL IN (2,5) AND a.id = '$areaT')
                    OR
                    (us.ROL = 3 AND us.IDUSR = '$ingeniero')";
                    
                    $res2 = $conn->query($sql);
                    
                    if (!$res2) {
                        error_log("Error en la consulta SQL: " . mysqli_error($conn));
                        die("Error en la consulta SQL. Revisa los logs para más detalles.");
                    }

                    while ($row2 = mysqli_fetch_array($res2)) {
                        $C1 = $row2["Correo"];
                    }
        }else{
             
            $C1 = '';
            $M1 = "El ticket $ticket no tiene un ingeniero asignado.";
            
            $sql2 = "SELECT GROUP_CONCAT(CORREOUSR) AS Correo 
                    FROM usuarios us
                    INNER JOIN areas a ON us.CDCANAL = a.CDAREA
                    WHERE 
                    (us.ROL IN (2,5) AND a.id = '$areaT')";
                    
                    $res2 = $conn->query($sql2);
                    
                    if (!$res2) {
                        error_log("Error en la consulta SQL: " . mysqli_error($conn));
                        die("Error en la consulta SQL. Revisa los logs para más detalles.");
                    }

                    while ($row2 = mysqli_fetch_array($res2)) {
                        $C1 = $row2["Correo"];
                    }
                    
        }
        
        $registros = [];
        
            $registros [] = array(
                'correos' => $C1,
                'mensaje' => $M1,
                'areaT' => $areaT,
            );
            echo json_encode($registros);
    }
    
//FUNCION PARA VER MIS TICKETS

    if($accion == 'cargarInfoTicket'){
        if ($roll == 2 || $roll == 5){
            $sqlInfoTickets =  "SELECT U.IDUSR, T.ID AS IDTICKET, T.*, C.CLIENTE_LARGO, IF(ISNULL(U.USUARIO), 'SIN ASIGNAR', U.USUARIO) AS USUARIO, A.CDAREA, DATE(T.FECHA_CREACION) AS FECHA_CREACION
                            FROM tickets_servicio T
                            INNER JOIN clientes C ON T.CLIENTE = C.IDCLTE
                            LEFT JOIN usuarios U ON T.INGENIERO = U.IDUSR
                            LEFT JOIN areas A ON T.AREA = A.id
                            WHERE A.CDAREA = '$areaT'";
                                    
        }
        if ($roll == 3){
            $sqlInfoTickets =  "SELECT U.IDUSR, T.ID AS IDTICKET, T.*, C.CLIENTE_LARGO, IF(ISNULL(U.USUARIO), 'SIN ASIGNAR', U.USUARIO) AS USUARIO, A.CDAREA, DATE(T.FECHA_CREACION) AS FECHA_CREACION
                            FROM tickets_servicio T
                            INNER JOIN clientes C ON T.CLIENTE = C.IDCLTE
                            LEFT JOIN usuarios U ON T.INGENIERO = U.IDUSR
                            LEFT JOIN areas A ON T.AREA = A.id
                            WHERE T.INGENIERO = $noEmpleado";
        }
        if ($roll == 1 || $roll == 4){
            $sqlInfoTickets =  "SELECT U.IDUSR, T.ID AS IDTICKET, T.*, C.CLIENTE_LARGO, IF(ISNULL(U.USUARIO), 'SIN ASIGNAR', U.USUARIO) AS USUARIO, A.CDAREA, DATE(T.FECHA_CREACION) AS FECHA_CREACION
                            FROM tickets_servicio T
                            INNER JOIN clientes C ON T.CLIENTE = C.IDCLTE
                            LEFT JOIN usuarios U ON T.INGENIERO = U.IDUSR
                            LEFT JOIN areas A ON T.AREA = A.id
                            WHERE   ($roll = 1)OR
                                    ($roll IN (2,5) AND A.CDAREA = '$areaT') OR
                                    ($roll = 3 AND T.INGENIERO = $noEmpleado)";
        }
        
        $resInfoTicket = $conn->query($sqlInfoTickets);                            
        
        $nr = mysqli_num_rows($resInfoTicket);
        
        // Crear un array para almacenar los resultados
        $registros = [];
        while ($row = $resInfoTicket->fetch_assoc()) {
            $registros [] = array(
                'IDUSR' => $row["IDUSR"],
                'DESCRIPCION' => $row["DESCRIPCION"],
                'USUARIO' => $row["USUARIO"],
                'FECHA_INICIO' => $row["FECHA_INICIO"],
                'FECHA_FIN' => $row["FECHA_FIN"],
                'CLIENTE_LARGO' => $row["CLIENTE_LARGO"],
                'PRIORIDAD' => $row["PRIORIDAD"],
                'ESTADO' => $row["ESTADO"],
                'TIPO' => $row["TIPO"],
                'FECHA_CREACION' => $row["FECHA_CREACION"],
                'IDTICKET' => $row["IDTICKET"],
                'NO_TICKET' => $row["NO_TICKET"],
                'CDAREA' => $row["CDAREA"]
                );
        }
        echo json_encode($registros);
    }
    
//FUNCION PARA VER MIS TICKETS SIN ASIGNAR

    if($accion == 'cargarInfoTicketSinAsignar'){

        $sqlInfoTickets =  "SELECT U.IDUSR, T.ID AS IDTICKET, T.*, C.CLIENTE_LARGO, IF(ISNULL(U.USUARIO), 'SIN ASIGNAR', U.USUARIO) AS USUARIO, A.CDAREA, DATE(T.FECHA_CREACION) AS FECHA_CREACION
                            FROM tickets_servicio T
                            INNER JOIN clientes C ON T.CLIENTE = C.IDCLTE
                            LEFT JOIN usuarios U ON T.INGENIERO = U.IDUSR
                            LEFT JOIN areas A ON T.AREA = A.id
                            WHERE   T.INGENIERO = 0 AND ($roll IN (1,2,5) AND A.CDAREA = '$areaT')";
        
        $resInfoTicket = $conn->query($sqlInfoTickets);
        
        // Crear un array para almacenar los resultados
        $registros = [];
        while ($row = $resInfoTicket->fetch_assoc()) {
            $registros [] = array(
                'IDUSR' => $row["IDUSR"],
                'DESCRIPCION' => $row["DESCRIPCION"],
                'USUARIO' => $row["USUARIO"],
                'FECHA_INICIO' => $row["FECHA_INICIO"],
                'FECHA_FIN' => $row["FECHA_FIN"],
                'CLIENTE_LARGO' => $row["CLIENTE_LARGO"],
                'PRIORIDAD' => $row["PRIORIDAD"],
                'ESTADO' => $row["ESTADO"],
                'TIPO' => $row["TIPO"],
                'FECHA_CREACION' => $row["FECHA_CREACION"],
                'IDTICKET' => $row["IDTICKET"],
                'NO_TICKET' => $row["NO_TICKET"],
                'CDAREA' => $row["CDAREA"]
                );
        }
        echo json_encode($registros);
    }

//FUNCION PARA MODIFICAR TICKET

    if($accion == 'modificar'){

        $sql = "UPDATE tickets_servicio 
                SET MARCA='$marca', EQUIPO='$equipo', MODELO='$modelo', NO_SERIE='$noserie', INGENIERO='$ingeniero', CLIENTE='$cliente', PRIORIDAD='$prioridad', ESTADO='$estado',
                    TIPO='$tipo', FECHA_INICIO='$fecha_inicio', OV='$ov', DESCRIPCION='$descripcion'     
                WHERE ID='$ID_Ticket'";
        
        if ($conn->query($sql)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn), "query" => $sql]);
        }
    }

//Cambiar ESTADO  Ticket

    if($accion == 'cambiar_estado'){
    
    $sql = "UPDATE tickets_servicio SET estado= 'En Espera' WHERE ID =$noTicket";
               
        if ($conn->query($sql)) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>swal("¡Tu solicitud fue procesada con éxito!", " ", "success");</script>';
            echo '<script>window.location.assign("ver_ticket.php?id='.$noTicket.'")</script>';
        } else {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>swal("¡Tu solicitud fue procesada con éxito!", " ", "success");</script>';
            echo '<script>window.location.assign("ver_ticket.php?id='.$noTicket.'")</script>';
        }
}

//Reabrir Ticket

    if($accion == 'reabrir_ticket'){
    
    $sql = "UPDATE tickets_servicio SET estado = 'En Proceso' WHERE ID =$noTicket";
               
        if ($conn->query($sql)) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>swal("¡Tu solicitud fue procesada con éxito!", " ", "success");</script>';
            echo '<script>window.location.assign("ver_ticket.php?id='.$noTicket.'")</script>';
        } else {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>swal("¡Tu solicitud fue procesada con éxito!", " ", "success");</script>';
            echo '<script>window.location.assign("ver_ticket.php?id='.$noTicket.'")</script>';
        }
}

//Finalizar Ticket

    if($accion == 'cerrar_ticket'){
    
    $sql = "UPDATE tickets_servicio SET estado= 'Cerrado'  WHERE ID =$noTicket";
               
        if ($conn->query($sql)) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>swal("¡Tu solicitud fue procesada con éxito!", " ", "success");</script>';
            echo '<script>window.location.assign("ver_ticket.php?id='.$noTicket.'")</script>';
        } else {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>swal("¡Tu solicitud fue procesada con éxito!", " ", "success");</script>';
            echo '<script>window.location.assign("ver_ticket.php?id='.$noTicket.'")</script>';
        }
}

//Obtener areas para SELECT
    
    if($accion == 'cargarArea'){
        
        $sqlareas = "SELECT id, CDAREA FROM areas ORDER BY AREA";
        $result_areas = $conn->query($sqlareas);
        
        $registros = []; 
        while ($row = $result_areas->fetch_assoc()) {
             $registros [] = array(
                'id_area' => $row["id"],
                'CDAREA' => $row["CDAREA"],
            );
        }
        echo json_encode($registros);
    }
    
//Obtener ingenieros para SELECT

    if($accion == 'cargarIngenieros'){
        
        $sqlIngenieros =  "SELECT * FROM usuarios WHERE STUSR = 1 AND CDCANAL = '$Area' ORDER BY usuario"; 
        $resIngenieros = $conn->query($sqlIngenieros);
        
        // Crear un array para almacenar los resultados
        $registros = []; 
        while ($rowIngenieros = $resIngenieros->fetch_assoc()) {
            $registros [] = array(
                
                'IDUSR' => $rowIngenieros["IDUSR"],
                'USRCORTO' => $rowIngenieros["USRCORTO"],
            );
        }
        echo json_encode($registros);
    }
    
//Obtener clientes para SELECT

    if($accion == 'cargarClientes'){
        
        $sqlClientes =  "SELECT IDCLTE,CLIENTE_LARGO FROM clientes";
        
        $resClientes = $conn->query($sqlClientes);
        
        $registros = []; 
        while ($rowClientes = $resClientes->fetch_assoc()){
            $registros [] = array(
                
                'IDCLTE' => $rowClientes["IDCLTE"],
                'CLIENTE_LARGO' => $rowClientes["CLIENTE_LARGO"],
            );
        }
        echo json_encode($registros);
    }
    
?>