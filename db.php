<?php 

$conn = mysqli_connect("localhost","root","","ticket-booking");
// $conn = mysqli_connect("localhost","23RBCA744","KWAFHV","23rbca744");

if($conn->connect_error){
    echo "<h2>Connected Successfully<\h2>";
}
?>