<?php
include("../../connection.php");
$email=$_GET['email'];

$main_table=rtrim($email,"@gmail.com")."_main";
$sales_table=rtrim($email,"@gmail.com")."_sales";

$sql1="select * from delete_request where email='".$email."'";
$rs=$conn->query($sql1);
$row=$rs->fetch_assoc();
$name=$row['name'];
$id=$row['id'];

$phone=$row['phone'];
$question=$row['question'];
$answer=$row['answer'];
$password=$row['password'];
$address=$row['address'];
$store_name=$row['store_name'];

$sql="insert into user (id,name,password,email,question,answer,address,store_name) values (".$id.",'".$name."','".
$password."','".$email."','".$question."','".$answer."','".$address."','".$store_name."')";

if($conn->query($sql)){
   $sql2="delete from delete_request where email='".$email."'";
   if($conn->query($sql2)){
    header("location:../index.php");
   }
}
$conn->close();
?>