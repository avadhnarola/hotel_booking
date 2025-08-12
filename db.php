<?php 

$conn = mysqli_connect("localhost","root","","hotel-booking");
// $conn = mysqli_connect("localhost","23RBCA744","KWAFHV","23rbca744");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>