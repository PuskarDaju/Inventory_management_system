<?php
include('../connection.php');
$email=$_GET['email'];
$sql="select * from user where email='".$email."'";
    $rs=$conn->query($sql);
    while($row=$rs->fetch_assoc()){
        $name=$row['name'];
        $id=$row['id'];
        $phone=$row['phone'];
        $password=$row['password'];
        $question=$row['question'];
        $answer=$row['answer'];
        $address=$row['address'];
        $store_name=$row['store_name'];

       
        
    }
   $sql2='insert into delete_request (id,name,password,question,answer,phone,email,address,store_name) values('.$id.',"'.$name.'","'.$password.'","'.$question.'","'.$answer.'","'.$phone.'","'.$email.'","'.$address.'","'.$store_name.'")';
   if($conn->query($sql2)){
    $sql3="delete from user where email='".$email."'";
    if($conn->query($sql3)){
        header('location:contentmaker.php');
    }
   }


?>