<?php 

//Modifico 24/03/2025 Sebas
$conn = new mysqli("localhost", "mess_tickets", "tickets*2024", "mess_tickets_servicio");

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
    
}
//echo "Conexión exitosa";

/*//Tickets 18/02/2025 Sebas

$conn = mysqli_connect("localhost", "mess_tickets","tickets*2024", "mess_tickets_servicio");

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
        
    }else{
      echo "Connected successfully";
    }*/
?>