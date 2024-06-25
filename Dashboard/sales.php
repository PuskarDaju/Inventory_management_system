<?php
session_start();
include("../connection.php");

if (!isset($_SESSION['email'])) {
    die("User not logged in!");
}


$table_name = rtrim($_SESSION['email'], "@gmail.com")."_sales";
$today=date('d');
$day = date('Y-m-d');
$year = date('Y');
$month = date('m');

// Today's transactions and sales
$todayTransactionsQuery = "SELECT COUNT(amount) AS count, SUM(amount) AS total FROM $table_name WHERE date = '$day'";
$todayTransactionsResult = $conn->query($todayTransactionsQuery);
$todayData = $todayTransactionsResult->fetch_assoc();

// This month's transactions and sales
$monthTransactionsQuery = "SELECT COUNT(amount) AS count, SUM(amount) AS total FROM $table_name WHERE YEAR(date) = '$year' AND MONTH(date) = '$month'";
$monthTransactionsResult = $conn->query($monthTransactionsQuery);
$monthData = $monthTransactionsResult->fetch_assoc();

// This year's transactions and sales
$yearTransactionsQuery = "SELECT COUNT(amount) AS count, SUM(amount) AS total FROM $table_name WHERE YEAR(date) = '$year'";
$yearTransactionsResult = $conn->query($yearTransactionsQuery);
$yearData = $yearTransactionsResult->fetch_assoc();
$error_msg="nothing";
if(isset($_POST['btn'])){
    $error_msg='';
    $search_transaction=0;
  
    $search_year=trim($_POST['year']);
    $search_month=($_POST['month']);
    $search_day=($_POST['day']);
    if(!empty($search_day)||!empty($search_month)||!empty($search_year)){
        $search_total=0;
        if(empty($search_year)){
            

            $search_year=date('y');
            if(empty($search_month)){
                
                $search_month=date('m');
                $sql="select count(amount) as amount from ".$table_name." where year(date)='".$year."'and month(date)='".$month."' and day(date) = '".$search_day."'";
                $sql2="select amount from ".$table_name." where year(date)='".$year."'and month(date)='".$month."' and day(date) = '".$search_day."'";
         
               
            }else if(empty($search_day)){
                $sql="select count(amount) as amount from ".$table_name." where year(date)='".$year."'and month(date)='".$search_month."'";
           
              
                $sql2="select amount from ".$table_name." where year(date)='".$year."'and month(date)='".$search_month."'";
               
               
            }else{
                $sql="select count(amount) as amount from ".$table_name." where month(date)='".$search_month."' and day(date) = '".$search_day."'";


               
                $sql2="select amount from ".$table_name." where month(date)='".$search_month."' and day(date) = '".$search_day."'";
                
            }

        }else{
            if(empty($search_month)){
                $sql="select count(amount) as amount from ".$table_name." where year(date) = '".$search_year."'";
                $sql2="select amount from ".$table_name." where year(date) = ".$search_year;

            }else {
                if(empty($search_day)){
                    $sql="select count(amount) as amount from ".$table_name." where year(date) = '".$search_year."' and month(date) = '".$search_month."'";
                    $sql2="select amount from ".$table_name." where year(date) = '".$search_year."' and month(date) = '".$search_month."'";

                }else{
                    $sql="select count(amount) as amount from ".$table_name." where (year(date)=$year and month(date)='$search_month' and day(date)='$search_day');";
                    $sql2="select amount from ".$table_name." where (year(date) = '".$search_year."' and month(date) = '".$search_month."' and day(date) = '".$search_day."');";
                }
            }
        }
        $rs=$conn->query($sql);
        if($rs->num_rows>0){
        $row=$rs->fetch_assoc();
        $search_transaction=$row['amount'];
        }
        $rs2=$conn->query($sql2);
                if($rs2->num_rows>0){
                    while($sow=$rs2->fetch_assoc()){

                        $search_total+=$sow['amount'];
                    }
                }


    }else{
        $error_msg='Enter valid date';
    }

}


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
        .container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    font-size: 2.5em;
    letter-spacing: 1px;
}

.sales-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    background: #f9f9f9;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.sales-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.sales-card h3 {
    margin-top: 0;
    color: #555;
    font-size: 1.8em;
}

.sales-card p {
    margin: 10px 0;
    font-size: 1.2em;
    color: #777;
}

.sales-card p span {
    font-weight: bold;
    color: #333;
}

.sales-card.today {
    border-left: 6px solid #4caf50;
}

.sales-card.month {
    border-left: 6px solid #ff9800;
}

.sales-card.year {
    border-left: 6px solid #2196f3;
}

.searchSales {
    margin-top: 30px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.searchSales h3 {
    margin-top: 0;
    color: #333;
    font-size: 1.8em;
    text-align: center;
}

.searchSales form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.searchSales label {
    margin-top: 10px;
    font-size: 1.1em;
    color: #555;
}

.searchSales input {
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    width: 100%;
    max-width: 300px;
    font-size: 1em;
}

.searchSales button {
    margin-top: 20px;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    background: #4caf50;
    color: #fff;
    font-size: 1.1em;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.searchSales button:hover {
    background: #45a049;
}

.searched_data {
    margin-top: 20px;
    padding: 20px;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.searched_data h3 {
    margin-top: 0;
    color: #333;
    font-size: 1.5em;
    text-align: center;
}

@media (max-width: 768px) {
    .container {
        width: 95%;
    }

    .sales-card, .searchSales, .searched_data {
        padding: 15px;
    }

    .sales-card h3, .searchSales h3, .searched_data h3 {
        font-size: 1.4em;
    }

    .sales-card p {
        font-size: 1em;
    }

    .searchSales label, .searchSales input, .searchSales button {
        font-size: 0.9em;
    }
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
    <div class="container">
        <h1>Sales Dashboard</h1>
        <div class="sales-card today">
            <h3>Today</h3>
            <p>No of Transactions: <span><?php echo $todayData['count']; ?></span></p>
            <p>Sales: <span><?php echo $todayData['total']; ?></span></p>
        </div>
        <div class="sales-card month">
            <h3>This Month</h3>
            <p>No of Transactions: <span><?php echo $monthData['count']; ?></span></p>
            <p>Sales: <span><?php echo $monthData['total']; ?></span></p>
        </div>
        <div class="sales-card year">
            <h3>This Year</h3>
            <p>No of Transactions: <span><?php echo $yearData['count']; ?></span></p>
            <p>Sales: <span><?php echo $yearData['total']; ?></span></p>
        </div>
        <?php
if(empty($error_msg)){
echo "<div class='sales-card year'>";

echo "<h3>Search Details</h3><br>";
echo "<p> No of Transactions:";
echo "<span> ". $search_transaction."</span><br></p>";

echo "<br>";
echo "<p>Sales: <span>";
echo $search_total."</span></p>";

echo "</div>";
}


?>
    </div>
        
        
    
    <div class="searchSales">
    <form action="#" method="post">
        <h3>search </h3>
        <label for="year">Year</label>
            <input type="number"  name="year" id="year" placeholder="2024">

            <label for="month">Month</label>
            <input type="number"  name="month" id="month" placeholder="2024">
            <label for="day">day</label>
            <input type="number"  name="day" id="day" placeholder="2024">
            <button type="submit" name="btn" id="btn">Submit</button>
        
    </form>
    </div>
      
    </div>
   </div>
</body>

</html>

