<?php
include 'conn.php';
header('Content-Type: application/json');

$accion = $_POST["accion"];

$noTicket = $_POST["noTicket"];
$id_area = $POST["id"];
$nombreArea = $_POST["CDAREA"];
$descripcion = $_POST["descripcion"];
$ingeniero = $_POST["ingeniero"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$cliente = $_POST["cliente"];
$prioridad = $_POST["prioridad"];
$estado = $_POST["estado"];
$tipo = $_POST["tipo"];
$fecha_registro = date("Y-m-d H:i:s");
$noEmpleado = $_POST["noEmpleado"];

$idTiempo = $_POST["idTiempo"];

$equipo =$_POST["equipo"];
$marca =$_POST["marca"];
$modelo =$_POST["modelo"];
$serie =$_POST["noserie"];
$areaT =$_POST["area"];
$ov =$_POST["ov"];
$estatuseq =$_POST["estatuseq"];

$ID =$_POST["ID"];
//$IDUSR= $_POST["idusr"];
$IDUSR= $_POST["IDUSR"];
$IDEQ= $_POST["ideq"];

$tiempo_trabajo = $_POST["Tiempo"];

$Nombre = $_POST["Nombre"];  
$Area = $_POST["CDCANAL"];  
$Puesto = $_POST["Puesto"]; 
$Correo = $_POST["Correo"];
$Region = $_POST["Region"];
$Estatus = $_POST["Estatus"];
$Contrasena = $_POST["Contrasena"];
$Rol = $_POST["Rol"];
$rol = isset($_COOKIE['rol']);

$CorreoUs = $_POST["Correo"];
/*----------------------------------------------------------------------------*/
// Obtener los detalles del ticket
    if($accion == 'InfoTicket'){
        
        $query_ticket ="SELECT  u.IDUSR, ts.id, m.descripcion AS MARCA, eq.descripcion AS EQUIPO, ts.MODELO, ts.DESCRIPCION, ts.FECHA_INICIO, ts.FECHA_FIN, ts.CLIENTE, ts.PRIORIDAD, 
                        ts.ESTADO, ts.TIPO, ts.FECHA_CREACION, ts.ULTIMA_ACTUALIZACION, ts.NO_SERIE, u.USRCORTO AS INGENIERO, c.CLIENTE_LARGO AS NOMBRE_CLIENTE, ts.NO_TICKET 
                        FROM tickets_servicio ts
                        LEFT JOIN usuarios u ON ts.INGENIERO = u.IDUSR
                        INNER JOIN clientes c ON c.IDCLTE = ts.CLIENTE
                        INNER JOIN marcas m ON ts.MARCA = m.id_marca
                        INNER JOIN equipos eq ON ts.EQUIPO = eq.id_equipo
                        WHERE ts.id = '$noTicket'";
                        
        $result_ticket = mysqli_query($conn, $query_ticket) or die(mysqli_error($conn));

        $registros = array();
        while ($row = mysqli_fetch_array($result_ticket)) {
            $registros[] = array(
                'DESCRIPCION' => utf8_encode($row["DESCRIPCION"]),
                'NOMBRE_CLIENTE' => utf8_encode($row["NOMBRE_CLIENTE"]),
                'PRIORIDAD' => utf8_encode($row["PRIORIDAD"]),
                'ESTADO' => utf8_encode($row["ESTADO"]),
                'TIPO' => utf8_encode($row["TIPO"]),
                'INGENIERO' => utf8_encode($row["INGENIERO"]),
                'IDUSR' => utf8_encode($row["IDUSR"]),
                'NO_TICKET' => utf8_encode($row["NO_TICKET"])
            );
        }
        echo json_encode($registros);
    }
    
// Obtener los detalles del equipo
    if($accion == 'InfoEquipo'){
        
        $query_Equipo ="SELECT  u.IDUSR, ts.id, m.descripcion AS MARCA, eq.descripcion AS EQUIPO, ts.MODELO, ts.DESCRIPCION, ts.FECHA_INICIO, ts.FECHA_FIN, ts.CLIENTE, ts.PRIORIDAD, ts.ESTADO, ts.TIPO, ts.FECHA_CREACION, ts.ULTIMA_ACTUALIZACION, ts.NO_SERIE, u.USRCORTO AS INGENIERO, c.CLIENTE_LARGO AS NOMBRE_CLIENTE, ts.NO_TICKET 
                        FROM tickets_servicio ts
                        LEFT JOIN usuarios u ON ts.INGENIERO = u.IDUSR
                        INNER JOIN clientes c ON c.IDCLTE = ts.CLIENTE
                        INNER JOIN marcas m ON ts.MARCA = m.id_marca
                        INNER JOIN equipos eq ON ts.EQUIPO = eq.id_equipo
                        WHERE ts.id = '$noTicket'";
                        
        $result_Equipo = mysqli_query($conn, $query_Equipo) or die(mysqli_error($conn));
        
        $registros = array();
        while ($row = mysqli_fetch_array($result_Equipo)) {
            $registros[] = array(
                'MARCA' => utf8_encode($row["MARCA"]),
                'EQUIPO' => utf8_encode($row["EQUIPO"]),
                'MODELO' => utf8_encode($row["MODELO"]),
                'NO_SERIE' => utf8_encode($row["NO_SERIE"]),
            );
        }
        echo json_encode($registros);
    }

//FUNCION PARA CALCULAR HRS DE TRABAJO
    if ($accion == 'calculo_horas') {
        $hr = 1000 * 60 * 60; // Milisegundos en una hora
        $fecha_ini =($fecha_inicio);
        $fecha_f =($fecha_fin);
        $dif = $fecha_f - $fecha_ini;
        return $dif / 3600; // Convertir de segundos a horas
    }

//Registrar tiempo
    if ($accion == 'registraTiempo'){
        
        $sql = "INSERT INTO tiempo_ticket (fecha_inicio, fecha_fin, tiempo, descripcion, id_ticket, id_usuario)
                VALUES ('$fecha_inicio', '$fecha_fin', '$tiempo_trabajo', '$descripcion', '$noTicket', '$IDUSR')";
                
        if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Tiempo registrado correctamente']);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al registrar el tiempo: ' . mysqli_error($conn)
            ]);
        }
    }
    
//Llenar Tabla Tiempos
    if ($accion == 'LlenarTablaTiempo'){
        
        $sql = "SELECT tt.id, tt.fecha_inicio, tt.fecha_fin, tt.tiempo, tt.descripcion, u.USRCORTO AS usuario
        FROM tiempo_ticket tt
        JOIN usuarios u ON tt.id_usuario = u.IDUSR
        WHERE tt.id_ticket = '$noTicket'";
        
        $res2 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
        // Crear un array para almacenar los resultados
        $registros = array();
        while ($row2 = mysqli_fetch_array($res2)) {
            $registros[] = array(
                'id' => utf8_encode($row2["id"]),
                'fecha_inicio' => utf8_encode($row2["fecha_inicio"]),
                'fecha_fin' => utf8_encode($row2["fecha_fin"]),
                'tiempo' => utf8_encode($row2["tiempo"]),
                'descripcion' => utf8_encode($row2["descripcion"]),
                'usuario' => utf8_encode($row2["usuario"])
            );
        }
        echo json_encode($registros);
    }

//FUNCION PARA MODIFICAR TICKET
    if($accion == 'modificar'){

        $sql = "UPDATE tickets_servicio SET DESCRIPCION='$descripcion', INGENIERO=$ingeniero, FECHA_INICIO='$fecha_inicio', FECHA_FIN='$fecha_fin', CLIENTE=$cliente, PRIORIDAD='$prioridad', ESTADO='$estado', TIPO='$tipo', ULTIMA_ACTUALIZACION='$fecha_registro', EQUIPO=$equipo, MARCA=$marca, MODELO='$modelo', NO_SERIE='$serie', AREA='$areaT', OV='$ov' WHERE ID='$ID'";
               
        if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Cambios registrados correctamente']);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al registrar los cambios.' . mysqli_error($conn)
            ]);
        }
    }

//Cambiar ESTADO  Ticket
    if($accion == 'cambiar_estado'){
    
        $sql = "UPDATE tickets_servicio SET estado= 'En Espera' WHERE ID =$noTicket";
        
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                   
        echo json_encode($result);
    }

//Reabrir Ticket
    if($accion == 'reabrir_ticket'){
    
        $sql = "UPDATE tickets_servicio SET estado = 'En Proceso' WHERE ID =$noTicket";
        
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    
        echo json_encode($result);    
    }

//Finalizar Ticket
    if($accion == 'cerrar_ticket'){
    
        $sql = "UPDATE tickets_servicio SET estado= 'Cerrado'  WHERE ID =$noTicket";
        
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
        echo json_encode($result);
    }

//Eliminar Registro de Tiempo
    if($accion == 'EliminarTiempo'){
        
        $sql= "DELETE FROM tiempo_ticket WHERE id = '$idTiempo'";
        
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Registro eliminado']);
        } else {
            echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
        }
    }

?>