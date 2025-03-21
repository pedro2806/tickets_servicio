<?php
include 'conn.php';
header('Content-Type: application/json');

$accion = $_POST["accion"];

$CDCANAL = $_POST["areaUs"];
$id_usuario = $_POST["id_usuario"];
$id_area = $_POST["id_area"];

$delete_id = $_POST['id'];
$usuario = $_POST['usuario'];
$area = $_POST['area'];

/*----------------------------------------------------------------------------*/

//Agregar Area a Usuario

    if($accion == 'AgregaArea'){
        
        $sql_AgregaArea = " INSERT INTO usuario_area (id, user_id, area_id)
                            VALUES (' ', '$id_usuario', '$id_area')";
                            
        $result = mysqli_query($conn, $sql_AgregaArea);
        
        echo json_encode($result);
    }
    
//Obtener ingenieros para SELECT

    if($accion == 'cargarIngenieros'){
        
        $sqlIngenieros =  "SELECT * FROM usuarios WHERE STUSR = 1 ORDER BY usuario"; 
        $resIngenieros =  mysqli_query( $conn, $sqlIngenieros) or die (mysqli_error($conn));
        
        // Crear un array para almacenar los resultados
        $registros = [];
        while ($rowIngenieros = mysqli_fetch_array($resIngenieros)) {
            $registros [] = array(
                
                'IDUSR' => utf8_encode($rowIngenieros["IDUSR"]),
                'USRCORTO' => utf8_encode($rowIngenieros["USRCORTO"]),
            );
        }
        echo json_encode($registros);
    }
    
// Mostrar la tabla con los registros de usuario_area
    
    if($accion =='LlenaTablaUsArea'){
        
        $query_registros = "SELECT ua.id, u.USRCORTO AS usuario, a.AREA AS area
                            FROM usuario_area ua
                            JOIN usuarios u ON ua.user_id = u.IDUSR
                            JOIN areas a ON ua.area_id = a.id ";
                            
        $result_registros = mysqli_query($conn, $query_registros);
        
        // Crear un array para almacenar los resultados
        $registros = [];
        while ($row = mysqli_fetch_array($result_registros)) {
            $registros [] = array(
                'id' => utf8_encode($row["id"]),
                'usuario' => utf8_encode($row["usuario"]),
                'area' => utf8_encode($row["area"])
                );
        }
        
        echo json_encode($registros);
    }    
    
//Eliminar Area de Usuario

    if($accion == 'eliminarRegUsArea'){
        
        $sql_delete = "DELETE FROM usuario_area WHERE id = $delete_id";
        
        $result = mysqli_query($conn, $sql_delete);
        
        echo json_encode($result);
    }

?>