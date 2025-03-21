<?php 
//Tickets 18/02/2025 Sebas

$conn = mysqli_connect("localhost", "mess_tickets","tickets*2024", "mess_tickets_servicio");

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
        
    }else{
    //echo "Connected successfully";
    }

/*                                    //USUARIO               CONTRASENIA         BD tickets*2024
$conn = mysqli_connect("localhost", "mess_tickets", "tickets*2024", "mess_tickets_servicio");

    
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }else{
     echo "Connected successfully";
    }
*/
?>