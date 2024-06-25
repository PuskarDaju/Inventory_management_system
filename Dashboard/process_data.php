<?php
session_start();

include ("../connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script> 
        function calcReturn(){
            var cusSum=document.getElementById("customerAmount").value;
            
            var billAmount=document.getElementById("total_before_discount").value;
            var discount=document.getElementById('discount').value;
            var artB=document.getElementById('customerAmount');

            if(discount<0){
                discount=0;
                document.getElementById('discount').style.background='red';
            }else if(discount==null){
                discount=0;
            }
            var actualPayableAmt=billAmount-discount;

            var actualAmt=cusSum-actualPayableAmt;
             document.getElementById("total").value=actualPayableAmt;
            

            if(actualPayableAmt>cusSum){
            
                document.getElementById('customerAmount').style.color='red';
               
            }else{
                document.getElementById('discount').style.color='black';
                document.getElementById('customerAmount').style.color='black';
                document.getElementById("returnToCustomer").value=actualAmt;
               
            }
            console.log(billAmount);
            console.log(discount);
            console.log(cusSum);
            console.log(actualAmt);
            console.log(artB);
            
            
        }
       
        function printBtn(){
            var a =document.getElementById('billCont').innerHTML;
            window.print(a);
           event.preventDefault();
        }
  
      
    </script>
    <style>
         

#printable { display: none; }

@media print
{
    #non-printable { display: none; }
    #printable { display: block; }
}

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
 
/* label {
    font-weight: bold;
} */
a {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #0056b3;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
    .main_container {
            display: flex;
            height: 100vh;
        }

        .left_container {
            width: 10%;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .left_container ul {
            list-style-type: none;
            padding: 0;
        }

        .left_container li {
            margin-bottom: 10px;
        }

        .center_container {
            width: 80%;
            /* padding: 20px; */
        }
               
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
           
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        .dropbtn {
            margin: 10px 5px;
            padding: 10px 15px;
            
            color: white;
            background-color: #0056b3;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        /* form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            height: 50%;
        } */

        /* label {
            display: block;
            margin-bottom: 5px;
        } */

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"],input[type='number'] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            margin-top: 10px;
            margin-left: 135px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        

        #numRows {
            border: none;
            outline: none;
            color: white;
        }

        #click_count23 {
            
        color: #f8f9fa;
        }
        input#numRows, textarea{
            background-color:white;
            color: white;
        }


      
    </style>
</head>
<body>
    
   <div class="main_container">
    <div class="left_container" id="non-printable">
        <ul>
            <li><a style="text-decoration: none;" href="dash.php">Dashboard</a></li><br>
            
            <li><div class="dropdown">
    <button class="dropbtn">Stock</button>
    <div class="dropdown-content">
        <a href="addStock.php">Add Stocks</a>
        <a href="remStock.php">Remove Stock</a>
        <a href="viewStock.php">View</a>
        
    </div>
</div></li><br>
            <li><a style="text-decoration: none;" href="sales.php">Sales</a></li><br>
            <li><div class="dropdown">
    <button class="dropbtn">Setting</button>
    <div class="dropdown-content">
    <a href="profile.php">Profile</a>
        <a href="changepwd.php">Change password</a>
        <a href="chat.php">Report Problem</a>
        <a href="delete_request.php">Delete Your Account</a>
        
    </div>
</div></li><br>
            
            <li><a style="text-decoration: none;" href="logout.php"> logout</a></li>

        </ul>
    </div>
    <div class="center_container">
    <form action="bill.php" method="post" id="newform">
     
    <?php
if(isset($_POST['calculate'])){
    $n=$_POST["numRows"];
    //echo "<h1>Welcome".$_SESSION['email']."<br>";
    $tableName = rtrim($_SESSION['email'],"@gmail.com")."_main";
    //echo $tableName."</h1>";
echo "<div id='billCont'>";
$sql3000 ="select store_name,address from user where email = '".$_SESSION['email']."'";
$puskar=$conn->query($sql3000);
$anmol=$puskar->fetch_assoc();
echo "<h3><b><center>".$anmol['store_name']."</center></b></h3>";
echo "<p><b> <center>".$anmol['address']."</center></b></p>";
    echo "<center><table border=1 id='billTable'>";
    echo "<tr>
    <thead>
    <th> Name</th>
    
    <th>Quantity</th>
    <th>Rate</th>
    <th>Amount</th>
    </thead>
    ";
    echo "<tr>";

   $namedetails=array();
   $qtydetails=array();

   $_SESSION['save_id']=array();
   $_SESSION['save_qty']=array();
    $_SESSION['total']=0;
    for($i=1;$i<=$n;$i++){
        $cnt=0;
        $tname="n".$i;
        $name =$_POST[$tname];
      


        $tqty="q".$i;
        $qty=$_POST[$tqty];

        $sql = "SELECT * FROM ".$tableName;
        $result = $conn->query($sql);

       
        while($row = $result->fetch_assoc()){
            
            if($row['name']==$name){
               
                $cnt++;
                $rate= $row['rate'];
                $old_qty=$row['quantity'];
                $new_qty=$old_qty - $qty;
                $id=$row['id'];
                $_SESSION['names_to_store'][]=$name;
                $_SESSION['rate_to_store'][]=$rate;
                $_SESSION['quantity_to_store'][]=$qty;

                break;
            }
        }
        if($cnt==0){
            $error_msg=$name." is not found on database so ignoring it";

        }else{
    if($name!=null&&$qty!=null && $new_qty>0){
        echo "<tr>
        <td>".$name."</td>";

        echo "<td>".$qty."</td>";

        echo "<td>";
        echo $rate."</td>";

        
        array_push($_SESSION['save_id'],$id);
        
        
        array_push($_SESSION['save_qty'],$new_qty);
    

        // $new_sql="UPDATE ".$tableName." SET quantity = ".$new_qty." WHERE id = ".$id.";";
        // $conn->query($new_sql);
        
        $amount=$qty * $rate;
        echo "<td>".$amount." </td>";
        echo "</tr>";

        $_SESSION['total']= $_SESSION['total'] + $amount;
    }else{
        $error_msg='Ignoring the invalid information';
    }
}

}




echo "<tfoot>
       <tr>
        <td colspan='3'>Total(Before discount)</td>
        <td><input type='number' name='total_before_discount' id='total_before_discount'value=".$_SESSION['total']." readonly ></td>
        
    </tr>
    <tr>
        <td colspan='3'>Discount</td>
        <td><input type='text' id='discount' ></td>
    </tr>
       <tr>
        <td colspan='3'>Total(After Discount)</td>
        <td><input type='number' name='total' id='total' value=0 readonly ></td>
        
    </tr>
 
    <tr>
    <td colspan='3'> Amount paid</td>
    <td><input type='number' name='customerAmount' id='customerAmount'  style='color:black' ></td>
    </tr>
    <tr>
    <td colspan='3'> Return</td>
    <td><input type='number' name='retrunToCustomer' id='returnToCustomer' readonly>
    </tr>
    </tfoot>";
    echo "</center></table>";
    echo "</div>";
}
$_SESSION['message']="sentFromBill.php";
$c_date = date("Y-m-d");


?>
<script>
    var abc=document.getElementById('saveit');
    console.log(abc);
</script>

    <div id="non-printable">
<button name="save_it" id="saveit">Save</button>
</div>
    </form>
    <div id="non-printable">
    <button id="changeCalc" onclick="calcReturn()">Calculate</button>
    <button id="'btn" onclick="printBtn()">Print</button>

    <br><br>
    <span style="color:red"><center>
          <?php
if(!empty($error_msg)){
    echo $error_msg;
    $error_msg='';
}

?>
          </span></center>
          </div>
      
    
   </div>
   </div>
 
</body>

</html>







