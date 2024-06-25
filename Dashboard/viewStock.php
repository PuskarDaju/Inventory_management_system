<?php

session_start();
        include("../connection.php");
        $table = rtrim($_SESSION['email'], "@gmail.com");
        $table_name = $table."_main";
?>
<!DOCTYPE html>
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
    <table border="1">
        <tr>
            <th>Items</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Action</th>
        </tr>
        <?php
        

        $sql = "SELECT * FROM " .$table_name;
        $rs = $conn->query($sql);
        if ($rs->num_rows > 0) {
            $c = 1;
            $totalQuantity = 0;
            $totalPrice = 0;
            while ($row = $rs->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $c . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['rate'] . "</td>";
                 echo "<td><a href='updateStock.php?id=".$row['id']."'>update</a></td>";
                echo "</tr>";
                $c++;
                $totalQuantity += $row["quantity"];
                $totalPrice += $row['quantity'] * $row['rate'];
            }
        }
        ?>
        <tfoot>
            <tr>
                <td>Total</td>
                <td></td>
                <td><?php echo $totalQuantity; ?></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    
   </div>
   </div>
</body>

</html>
