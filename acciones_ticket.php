<?php
include 'conn.php';

$accion = $_POST["accion"];

$Id_Equipo= $_POST["Id_Equipo"];
$Nombre_Equipo =$_POST["Nombre_Equipo"];

$Id_Marca =$_POST["Id_Marca"];
$Nombre_Marca = $_POST["Nombre_Marca"];

$Modelo =$_POST["Modelo"];
$idEq = $_POST["idEq"];

$descripcion = $_POST["descripcion"];
$Estatus = $_POST["Estatus"];
/*----------------------------------------------------------------------------*/
//Nueva Marca

    if($accion == 'RegistroMarca'){
        
        $sql_Nueva_Marca = "INSERT INTO marcas (id_marca, descripcion, estatus)
                            VALUES (' ', '$Nombre_Marca', 1)";
               
        $result_Nueva_Marca = mysqli_query($conn, $sql_Nueva_Marca);
        
        echo json_encode($result_Nueva_Marca);
    }
    
//Llena Tabla Marcas Activas

    if($accion == 'LlenaTablaAct'){
        
        $query_marcas_act = "SELECT id_marca, descripcion  FROM marcas WHERE estatus = 1 ORDER BY descripcion";
        
        $result_marcas_act = mysqli_query($conn, $query_marcas_act);
        
        $registros = [];
        while ($row = mysqli_fetch_array($result_marcas_act)) {
            $registros [] = array(
                'Id_Marca' => utf8_encode($row["id_marca"]),
                'Nombre_Marca' => utf8_encode($row["descripcion"]),
                );
        }
        echo json_encode($registros);
    }

//Llena Tabla Marcas Innactivas

    if ($accion == 'LlenaTablaInnac'){
        
        $query_marcas_inna = "SELECT id_marca, descripcion  FROM marcas WHERE estatus = 0 ORDER BY descripcion";
        
        $result_marcas_inna = mysqli_query($conn, $query_marcas_inna);
        
        $registros = [];
        while ($row = mysqli_fetch_array($result_marcas_inna)) {
            $registros [] = array(
                'Id_Marca' => utf8_encode($row["id_marca"]),
                'Nombre_Marca' => utf8_encode($row["descripcion"]),
                );
        }
        echo json_encode($registros);
    }
    
//FUNCION PARA CAMBIAR EL ESTATUS DE MARCAS A BAJA

    if($accion == 'Baja_estatus_marca'){
    
        $sql_baja_marca = "UPDATE marcas SET estatus= 0 WHERE id_marca=$Id_Marca";
                   
        $result_baja_marca = mysqli_query($conn, $sql_baja_marca);
        
        echo json_encode($result_baja_marca);
    }

//FUNCION PARA CAMBIAR EL ESTATUS DE MARCAS A ALTA

    if($accion == 'Alta_estatus_marca'){
    
        $sql_alta_marca = "UPDATE marcas SET estatus= 1 WHERE id_marca=$Id_Marca";
               
        $result_alta_marca = mysqli_query($conn, $sql_alta_marca);
        
        echo json_encode($result_alta_marca);
    }

//FUNCION PARA AGREGAR EQUIPO NUEVO

    if($accion == 'NuevoEquipo'){
        
        $sql_Equipo_Nuevo = "INSERT INTO equipos(descripcion, id_marca, modelo, estatus) 
                             VALUES ('$Nombre_Equipo', $Id_Marca, '$Modelo', 1)";
    
        $result_Equipo_Nuevo = mysqli_query($conn, $sql_Equipo_Nuevo);
        
        echo json_encode($result_Equipo_Nuevo);
    }
    
//Cargar Info Equipos
    if ($accion == 'InfoEquipo'){
        
        $sqlInfoEq = "SELECT * FROM equipos WHERE id_equipo = '$idEq'";
        
        $result_InfoEq = mysqli_query($conn, $sqlInfoEq);
        
        $registros = [];
        while ($row = mysqli_fetch_array($result_InfoEq)) {
            $registros [] = array(
                'Id_Equipo' => utf8_encode($row["id_equipo"]),
                'Equipo' => utf8_encode($row["descripcion"]),
                'Id_Marca' => utf8_encode($row["id_marca"]),
                'Modelo' => utf8_encode($row["modelo"]),
                'Estatus' => utf8_encode($row["estatus"]),
                );
        }
        echo json_encode($registros);
    }
                    
//Modificar Info de Equipos

    if ($accion == 'ModificarEq'){
        
    $sql_Guardar_Cambios = "UPDATE equipos SET descripcion = '$descripcion', id_marca = '$Id_Marca', modelo = '$Modelo', Estatus = '$Estatus'
                            WHERE id_equipo = '$Id_Equipo'";

    $result_Guardar_Cambios = mysqli_query($conn, $sql_Guardar_Cambios);
        
    echo json_encode($result_Guardar_Cambios);
}

?>