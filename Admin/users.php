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
        .messenger {
            display: flex;
            max-width: 1200px;
            width: 100%;
            height: 80vh;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .emailList {
            width: 20%;
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            overflow-y: auto;
        }

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
            text-decoration: underline;
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
                    <li> <a href="index.php">Dashboard</a></li>
                  
                    <li><a href="chat.php">Messages</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div id="big_container">
            <form action="#" method="post">
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            include('../connection.php');

            $sql = "SELECT name, email FROM user";
            $rs = $conn->query($sql);
            while ($row = $rs->fetch_assoc()) {
                $email = $row['email'];
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td><a href='block_user.php?email=" . $email . "'>Block</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>

            </div>
        </div>
    </div>
</body>
</html>

