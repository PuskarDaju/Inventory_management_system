<?php
session_start();
$_SESSION['admin_email']='';


header("location:admin_login.php");
?>