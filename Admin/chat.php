<?php
error_reporting(0);
include("../connection.php");
$currentEmail = isset($_GET['newEmail']) ? trim($_GET['newEmail']) : '';
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

        .chat-box {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-log {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .message_sent, .message_received {
            max-width: 70%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .message_sent {
            margin-left: auto;
            background-color: #DCF8C6;
        }

        .message_received {
            margin-right: auto;
            background-color: #EAEAEA;
        }

        .chat-input {
            display: flex;
            padding: 10px;
            background-color: #f0f0f0;
        }

        .chat-input input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .chat-input button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .chat-input button:hover {
            background-color: #45a049;
        }

        .chatEmail {
            background-color: white;
            border: 1px solid black;
            margin-top: 10px;
            padding: 10px;
            text-decoration: none;
        }

        .chatEmail:hover {
            background-color: grey;
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
        a{
            text-decoration: none;
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
                    <li><a href="index.php">Dashboard</a></li>
                    
                    <li><a href="chat.php">Messages</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div id="big_container">
                <div class="messenger">
                    <div class="emailList">
                        <?php
                        // Fetch distinct senders from database
                        $sql = "SELECT DISTINCT sender FROM reports WHERE reciever = 'admin'";
                        $rs = $conn->query($sql);
                        
                        if($rs->num_rows > 0){
                            while($row = $rs->fetch_assoc()){
                                $email = $row['sender'];

                                $sql21="select * from user where email='".$email."';";
                                $ses=$conn->query($sql21);
                                $email_counter;
                                while($dow=$ses->fetch_assoc()){
                                    
                                    $userName=$dow['name'];
                                    
                                    
                                }

                                $activeClass = ($email == $currentEmail) ? 'active' : '';
                                
                                echo "<div class='chatEmail $activeClass'>";
                                echo "<a href='chat.php?newEmail=$email'>".$userName."</a>";
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>
                    <div class="chat-box">
                        <div id="chat-log" class="chat-log">
                            <?php
                            // Fetch messages based on currentEmail
                            if(!empty($currentEmail)){
                                $sql = "SELECT * FROM reports WHERE (sender = '$currentEmail' AND reciever = 'admin') OR (sender = 'admin' AND reciever = '$currentEmail')";
                                $rs = $conn->query($sql);
                                
                                if($rs->num_rows > 0){
                                    while($row = $rs->fetch_assoc()){
                                        $messageClass = ($row['sender'] == $currentEmail) ? 'message_received' : 'message_sent';
                                        echo "<div class='$messageClass'>" . htmlspecialchars($row['chats']) . "</div>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="chat-input">
                            <form action="#" method="post">
                                <input type="text" placeholder="Type your message..." name="problem" id="problem">
                                <button type="submit" name="btn">Send</button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    // Scroll chat log to bottom
                    var chatLog = document.getElementById("chat-log");
                    chatLog.scrollTop = chatLog.scrollHeight;
                </script>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['btn'])){
        // Sanitize and validate user input
        $msg = trim($_POST['problem']);
        
        if(!empty($msg)){
            $c_date = date("Y-m-d");
            $sql33 = "INSERT INTO reports (chats, reciever, sender, time) VALUES ('$msg', '$currentEmail', 'admin', '$c_date')";
            $msg = '';
           
            if($conn->query($sql33)){
                echo "<script> 
                window.location.reload();
                </script>";
                exit;
            } else {
                echo "Cannot send this message";
            }
        } else {
            echo "Message cannot be empty";
        }
    }
}
?>
