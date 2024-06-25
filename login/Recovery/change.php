<?php
session_start();
error_reporting(0);
$pass1=$_POST['Password'];
$pass2=$_POST['conPass'];
$ph=$_SESSION['phone'];

include('../../connection.php');

if(isset($_POST['Change'])){
    if($pass1!=$pass2){
        echo "<h1>Passpwords do not match</h1>";

    }
    else{
      

       $sql="update user set password=md5('$pass1') where phone='$ph'";

       if($conn->query($sql)){
        echo "<h1>password updated sucessfully</h1>";
       }else{
        echo "<p>error while updating please try again after few moments</p>";
}
        
    }
    session_destroy();
}

?>