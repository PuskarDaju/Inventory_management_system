<?php
error_reporting(0);
session_start();
$_SESSION['msg_to_admin'];
if(empty($_SESSION['admin_email'])){
    header("location:admin_login.php");
}
include("../connection.php");
if($_SESSION['msg_to_admin']=="inserted Sucessfully"){
    echo "
    <script>
    alert('inserted');
    </script>
    ";
    $_SESSION['msg_to_admin']='';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System (Admin)</title>
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href)
        }
    </script>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #main_div {
            background-color: #f4f4f4;
            padding: 20px;
        }

        #top {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        #container {
            display: flex;
            gap: 20px;
        }

        #left_container {
            width: 20%;
            background-color: #007bff;
            color: #fff;
             padding: 20px; 
            border-radius: 8px;
        }

        #left_container ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #left_container li {
            margin-bottom: 15px;
        }

        #left_container a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        #left_container a:hover {
            text-decoration: underline;
        }

        #big_container {
            width: 75%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }

        .box {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .box h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
            color: red;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td a {
            color: red;
            text-decoration: none;
        }

        td a:hover {
            text-decoration:wavy;
        }

        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #007bff;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;
            position: relative;
            text-align: center;
            color: #fff;
        }

        .circle h4 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div id="main_div">
        <div id="top">
            <h1>Inventory Management System (Admin)</h1>
        </div> 
        
        <div id="container">
            <div id="left_container">
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                 <li><a href="chat.php">Messages</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div id="big_container">
                <div class="box">
                    <h2>Signup Requests</h2>
                    <?php
                    echo "<table>";
                    echo "<tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>";

                    $sql = "select * from user_request;";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        $id = $row['id'];
                        echo "<tr>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>   <a href='user_request/apr.php?id=".$id."'>Approve</a>  |  <a href='user_request/delete.php?id=".$id."'>Delete</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>
                
                <div class="box">
                    <h2>Delete Requests</h2>
                    <?php
                    echo "<table>";
                    echo "<tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>";

                    $sql = "select * from delete_request;";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        $email = $row['email'];
                        echo "<tr>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>  <a href='delete_request/apr.php?email=".$email."'>Approve</a> | <a href='delete_request/cancel.php?email=".$email."'>Cancel</a> </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>

                <div class="circle">
                    <p>Total Stores:</p>
                    <?php
                    $sql = "select * from user;";
                    $rs = $conn->query($sql);
                    $c = 0;

                    while($rs->fetch_assoc()){
                        $c++;
                    }

                    echo "<h4>".$c."</h4>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
