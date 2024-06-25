<?php
session_start();
error_reporting(0);

include("../connection.php");

if($_SESSION['message']=="sentFromBill.php"){
    echo '<script>
    alert("saved sucessfully");
    
    </script>';
    $_SESSION['message']="hello";
}

// echo $_SESSION['email'];
// $tableName = trim($_SESSION['email'],"@gmail.com")."_sales";
// echo "<br>";
// echo $tableName;
?>

<html>

<head>
    <title>Dashboard</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            border-collapse: collapse;
            width: 80%;
           margin-left: auto;
           margin-right: auto;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8d7da;
            color: #721c24;
            border-bottom: 2px solid #f5c6cb;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr.low-stock td {
            background-color: #fff3cd;
            color: #856404;
        }
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
        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            width: 80%;
        }

        .main_container {
            padding: 5px;
            gap: 20px;
            display: flex;
            
        }

        .left_container {
            padding-top:4% ;
            width: fit-content;
            background-color: #f4f4f4;
            padding-right: 3%;
            padding-right: 2%;
        }

        .left_container ul {
            list-style-type: none;
            padding: 1%;
        }

        .left_container li {
            margin-bottom: 10px;
        }

        .center_container {
            
          
            
            width: 80%;
            padding: 20px;
        }

        .G_top {
            background-color: #e0e0e0;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .G_top h2 {
            margin-top: 0;
        }

        .G_top p {
            margin-bottom: 0;
        }

        .G_top a {
            text-decoration: none;
            color: blue;
        }

        .G_top a:hover {
            text-decoration: underline;
        }

        .G-mid1,
        .G-mid2 {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .G-mid1 div,
        .G-mid2 div {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            flex: 1;
            margin-right: 10px;
        }

        .G-mid1 div:last-child,
        .G-mid2 div:last-child {
            margin-right: 0;
        }

        
        .G_bottom {
            text-align: center;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .G_top a{
            margin-left: 90%;
            text-align: right;
           text-decoration: none;
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
        #billing{
            color: white;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    
   <div class="main_container">
    <div class="left_container">
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
        <a href="profile.php" id="profile">Profile</a>
        <a href="changepwd.php">Change password</a>
        <a href="chat.php">Report Problem</a>
        <a href="delete_request.php">Delete Your Account</a>
        
        
        
    </div>
</div></li><br>
            
            <li><a style="text-decoration: none;" href="logout.php"> logout</a></li>
    


        </ul>
    </div>
    <div class="center_container">
        <div class="G_top">
           <center> <h2><?php
           if(!empty($_SESSION['store_name'])){
            echo "<b><h3>";
            echo $_SESSION['store_name'];
            echo "</h3></b><br>";
            echo "<p><b>".$_SESSION['address']."</b></p>";
           }
           else{
            echo "<h4 id='notCPt'>Complete your profile</h4>";
           }
           
           ?></h2></center><br>
           <script>
        var x=document.getElementById('notCPt').innerText;
        
        if(x!=null){
            var y=document.getElementById('profile');
            console.log(y);
            document.getElementById('profile').style.color='red';
        }
    </script>
          
            <a href="billing.php" id="billing">Billing system</a>
        </div>
        <div class="G-mid1">
            <div class="Tsales">Total sales: 
           <?php


$tableName = rtrim($_SESSION['email'],"@gmail.com")."_sales";
$amt=0;
$sql="select * from ".$tableName;

$result=$conn->query($sql);
while($row=$result->fetch_assoc()){
    $amt+=$row['amount'];
}
echo "<br><h3>".$amt."</h3>";


?>
            </div>
            <div class="N_items"><p>No. of items: 
            <?php


$tableName = rtrim($_SESSION['email'],"@gmail.com")."_main";
$c=0;
$sql="select * from ".$tableName;

$result=$conn->query($sql);
while($row=$result->fetch_assoc()){
    $c++;
}
echo "<br><h3>".$c."</h3>";


?>
            </p></div>
            <div class="inventory"><p>total inventory value:
        
            <?php


$tableName = rtrim($_SESSION['email'],"@gmail.com")."_main";
$totalamt=0;
$sql="select * from ".$tableName;

$result=$conn->query($sql);
while($row=$result->fetch_assoc()){
    $totalamt+=$row['quantity'] * $row['rate'];
}
echo "<br><h3>".$totalamt."</h3>";




?>
        </p></div>



        </div>

        <div class="G-mid2">
            <div class="sales_today"> <p>Todays Sales:

            <?php

            $tDate=date("Y-m-d");
            $tableName = rtrim($_SESSION['email'],"@gmail.com")."_sales";
           
$todayamt=0;
$sql="select * from ".$tableName;

$result=$conn->query($sql);
while($row=$result->fetch_assoc()){
   
    if($tDate==$row['date']){
        $todayamt+=$row['amount'];
        

    }
   
}
echo "<br><h3>".$todayamt."</h3>";
      
?>

            
            </p></div>
            <div class="sales_month"><p>Monthly sales: <br>
            <b><h3>
<?php
$m_date=date('m');
$y_date=date('Y');
$table_name=rtrim($_SESSION['email'],'@gmail.com')."_sales";
$total_value=0;

$sql="select amount from ".$table_name." where year(date)='".$y_date."' and month(date)='".$m_date."'";
 $rs=$conn->query($sql);

 if($rs->num_rows>0){
    while($row=$rs->fetch_assoc()){
        $total_value+=$row['amount'];
    }

 }

echo $total_value;

?>
</b></h3>


            </p></div>

        </div>
        <div class="G_bottom">
            <h1>Stock alert table</h1>
            <table border="1">
              
                <?php
            
                $table_name=rtrim($_SESSION['email'],'@gmail.com');
     
                $main_table=$table_name."_main";
                $sql="select * from ".$main_table;

                $rs=$conn->query($sql);
                $c=0;
                if($rs->num_rows>0){
                    while($row=$rs->fetch_assoc()){
                        if($row['quantity']<10){
                            $c=1;
                            break;
                        }
                    }

                  
                }else{
                    echo "No items on the list";
                    exit;
                }
                if($c>0){
                    $count=1;
                $cs=$conn->query($sql);
                if($cs->num_rows>0){
                    
                        
                       
                            echo "<tr>
                            <th> S.No</th>
                            <th>Name</th>
                            <th>Quantity</th>
      
                            
                            ";
                            echo "</tr>";
                            while($sow=$cs->fetch_assoc()){
                                if($sow['quantity']<10){
                                    echo "<tr>";
                                    echo "<td>".$count."</td>";
                                    echo "<td>".$sow['name']."</td>";
                                    echo "<td>".$sow['quantity']."</td>";
                                    
                                    echo "</tr>";
                                    $count++;
                                }
                            }
                    }
                } else{
                    echo "We have enough stock of everything";
                }
                ?>
            </table>
        </div>
    </div>
   </div>
</body>

</html>

