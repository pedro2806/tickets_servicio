<?php
include 'conn.php';
header('Content-Type: application/json');
$accion = $_POST["accion"];

$id = $_POST["Id"];
$usuario = $_POST["Nombre"];
$cdcanal = $_POST["Area"];
$puestousr = $_POST["Puesto"];
$correousr = $_POST["Correo"];
$regusr = $_POST["Region"];

/*----------------------------------------------------------------------------*/

//Llena Tabla Usuarios

    if ($accion == 'LlenaTablaUs'){
        
        $sql_Tabla_Usuarios = "SELECT IDUSR AS ID, USUARIO AS Nombre, CDCANAL AS Area, PUESTOUSR AS Puesto, CORREOUSR AS Correo, REGUSR AS Region FROM `usuarios`";
        
        $res_Tabla_Usuarios = mysqli_query($conn, $sql_Tabla_Usuarios) or die(mysqli_error($conn));
        
        $registros = [];
        while ($row2 = mysqli_fetch_array($res_Tabla_Usuarios)){
            $registros [] = array(
                
                'id' => utf8_encode($row2["ID"]),
                'usuario' => utf8_encode($row2["Nombre"]),
                'cdcanal' => utf8_encode($row2["Area"]),
                'puestousr' => utf8_encode($row2["Puesto"]),
                'correousr' => utf8_encode($row2["Correo"]),
                'regusr' => utf8_encode($row2["Region"])
            );
        }
        
        echo json_encode($registros);
    }
    
//Modificar Informacion Usuario

    if($accion == 'CambioInfoUs'){
        
        $sqlModInUs = "UPDATE usuarios SET USUARIO='$usuario', CDCANAL='$cdcanal', PUESTOUSR='$puestousr', CORREOUSR='$correousr', REGUSR='$regusr' 
                       WHERE IDUSR='$id'";
        
        if (mysqli_query($conn, $sqlModInUs)) {
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
?>