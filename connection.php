<?php
$conn= new mysqli("localhost","root","","store");
if($conn->connect_error){
    die ("Cant establish connection".$conn->connect_error);
}
?>