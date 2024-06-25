<?php

session_start();

include("../../connection.php");

$num =$_POST['phone'];
$name=$_POST['username'];
$c=0;
if(isset($_POST['recovery'])){
$sql='select * from user';

$result = $conn->query($sql);

while($row=$result->fetch_assoc()){
    if($name==$row['name']){
        if($num==$row['phone']){
            $c++;
            $_SESSION['question']=$row['question'];
            $_SESSION['answer']=$row['answer'];
            $_SESSION['phone']=$row['phone'];
            break;
        }
    }
}
if($c==0){
    echo "No Match found";
}else{
   header("location:recovery.php");
}
}
?>