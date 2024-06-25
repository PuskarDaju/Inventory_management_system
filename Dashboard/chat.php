<?php
error_reporting(0);
session_start();
include("../connection.php");


$currentEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
    <style>
        #top_bar{
            background-color: white;
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
        .messenger{
            margin-top:10px;
            margin-left: 10px;
        display: flex;
            max-width: 1200px;
            width: 100%;
            height: 80%;
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
            background-color: mintcream;
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
            margin-left:25%;
            background-color: #DCF8C6;
            align-self: flex-end;
        }

        .message_received {
            margin-right: 25%;
            background-color: #EAEAEA;
        }

        .chat-input {
            padding-left: 25%;
            padding-top: 10px;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
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
    
  
    <div class="messenger">
        <div class="chat-box">
        <div id='top_bar'>
                <center> <h3>Admin</h3></center>
               </div>
            <div id="chat-log" class="chat-log">
               
                <?php
                // Fetch messages based on currentEmail
                if(!empty($currentEmail)){
                    $sql = "SELECT * FROM reports WHERE (sender = '$currentEmail' AND reciever = 'admin') OR (sender = 'admin' AND reciever = '$currentEmail')";
                    $rs = $conn->query($sql);
                    
                    if($rs->num_rows > 0){
                        while($row = $rs->fetch_assoc()){
                            $messageClass = ($row['sender'] == $currentEmail) ? 'message_sent' : 'message_received';
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
</body>

</html>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
if(isset($_POST['btn'])){
    // Sanitize and validate user input
    $msg = trim($_POST['problem']);
    
    if(!empty($msg)){
        $c_date = date("Y-m-d");
        $sql33 = "INSERT INTO reports (chats, sender, reciever, time) VALUES ('$msg', '$currentEmail', 'admin', '$c_date')";
        $msg='';
       
        
        if($conn->query($sql33)){
            echo "<script> 
          
          
            window.location.reload();
        
            </script>";
            header("location:contentMaker.php");
           
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
