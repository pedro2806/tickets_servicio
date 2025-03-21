<?php
include 'conn.php';

$opcion = $_GET["opcion"] ?? 0;
$marca = $_GET["marca"] ?? 0;
$equipo = $_GET["equipo"] ?? 0;
$idTicket = $_GET["idT"] ?? 0;

/******************************************************************************/
    
//MARCAS
    if($opcion == "marcas"){
        
        $QUmarcas = "SELECT * FROM marcas ORDER BY id_marca"; #GROUP BY descripcion
        $res2 = $conn->query($QUmarcas);
        
        // Crear un array para almacenar los resultados
        $marcas = array();
        
        while ($row2 = $res2->fetch_assoc()) {
            $marcas[] = array(
                'id' => $row2["id_marca"],
                'descripcion' => $row2["descripcion"]
            );
        }
        echo json_encode($marcas);
    }

//EQUIPOS
    if($opcion == "equipos"){
    
        $QUequipos = "SELECT * FROM equipos WHERE id_marca = '$marca' GROUP BY id_equipo, descripcion";
        $res2 = $conn->query($QUequipos);
        
        // Crear un array para almacenar los resultados
        $equipos = array();
        
        while ($row2 = $res2->fetch_assoc()) {
            $equipos[] = array(
                'id_equipo' => $row2["id_equipo"],
                'descripcion' => $row2["descripcion"],
                'modelo' => $row2["modelo"]
            );
        }
        echo json_encode($equipos);
    }

//MODELOS
    if($opcion == "modelo"){
        
        $QUmodelo = "SELECT * FROM equipos where id_equipo = '$equipo' GROUP BY descripcion";
       
        $res2 = $conn->query($QUmodelo);
        
        // Crear un array para almacenar los resultados
        $modelo = array();
        while ($row2 = $res2->fetch_assoc()) {
            $modelo[] = array(
                'modelo' => $row2["modelo"]
            );
        }
        echo json_encode($modelo);
    }

//TABLA EQUIPOS
    if($opcion == "llenarTablaEquipos"){
        
        $QUequipos = "SELECT eq.id_equipo, eq.id_marca, m.descripcion AS MARCA, eq.modelo, eq.descripcion
                      FROM equipos eq
                      INNER JOIN marcas m ON m.id_marca = eq.id_marca";
                      
        $res2 = $conn->query($QUequipos);
        
        // Crear un arreglo para almacenar los resultados
        $equipos = array();
        
        while ($row2 = $res2->fetch_assoc()) {
            $equipos[] = array(
                'id_equipo' => $row2["id_equipo"],
                'descripcion' => $row2["descripcion"],
                'marca' => $row2["MARCA"],
                'modelo' => $row2["modelo"]
            );
        }
        echo json_encode($equipos);
    }

//DATOS TICKET
    if($opcion == "muestraDatosTicket"){
        $QTicket =  "SELECT TS.*, U.usuario
                     FROM tickets_servicio TS
                     LEFT JOIN usuarios U ON U.IDUSR = TS.INGENIERO
                     WHERE TS.ID = $idTicket";
        
        $res2 = $conn->query($QTicket);
        $datosTicket = array();
        
        while ($row2 = $res2->fetch_assoc()) {
            $datosTicket[] = array(
                'MARCA' => $row2["MARCA"],
                'ID_EQUIPO' => $row2["EQUIPO"],
                'MODELO' => $row2["MODELO"],
                'NO_SERIE' => $row2["NO_SERIE"],
                'INGENIERO' => $row2["usuario"],
                'ID_INGENIERO' => $row2["INGENIERO"],
                'CLIENTE' => $row2["CLIENTE"],
                'PRIORIDAD' => $row2["PRIORIDAD"],
                'ESTADO' => $row2["ESTADO"],
                'TIPO' => $row2["TIPO"],
                'FECHA_INICIO' => $row2["FECHA_INICIO"],
                'OV' => $row2["OV"],
                'DESCRIPCION' => $row2["DESCRIPCION"],
                'ID' => $row2["ID"],
            );
        }
        echo json_encode($datosTicket);
    }
    
?>