<?php
include("../../connection.php");
$email=$_GET['email'];
echo $email;

$main_table=rtrim($email,"@gmail.com")."_main";
$sales_table=rtrim($email,"@gmail.com")."_sales";

$sql1="drop table ".$main_table;
$sql2="drop table ".$sales_table;

$sql3="delete from reports where sender='".$email."' || reciever='".$email."'";
$sql4="delete from delete_request where email ='".$email."'";
if($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3) && $conn->query($sql4)){
    header("location:../index.php");
}




?>