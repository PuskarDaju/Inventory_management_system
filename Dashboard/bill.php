

<?php

session_start();
include('../connection.php');

if(isset($_POST['save_it'])){
    $total_before_discount=$_POST['total_before_discount'];
    $total=$_POST['total'];
    $c_date = date("Y-m-d");
    $salesTable=rtrim($_SESSION['email'],"@gmail.com")."_sales";
    $tableName = rtrim($_SESSION['email'],"@gmail.com")."_main";
    if($total!=0){
        $sql32="insert into ".$salesTable."(date,name,amount) values('".$c_date."','sales',".$total.");";
    }else{
        $sql32="insert into ".$salesTable."(date,name,amount) values('".$c_date."','sales',".$total_before_discount.");";
    }
  
  
   for($i=0;$i<sizeof($_SESSION['save_id']);$i++){


    $new_sql="UPDATE ".$tableName." SET quantity = ".$_SESSION['save_qty'][$i]." WHERE id = ".$_SESSION['save_id'][$i].";";
    $conn->query($new_sql);

   }
    
   



if($conn->query($sql32)){
    
    echo "
    <script>
    alert('Saved sucessfully!!!');
    
    </script>";
    header("location:billing.php");
}
    
 
}
   
?>

