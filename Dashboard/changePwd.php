<?php
session_start();
include("../connection.php");
$newPassError=$confirmPassError=$passError='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['btn'])){
        $Pwd=trim($_POST['oldPwd']);
        $passCheck='';
        $newPwd=trim($_POST['newPwd']);
        $conPwd=trim($_POST["confirmPwd"]);
        $oldPwd=md5($Pwd);
        
//Validation
        if(strlen($newPwd)<8){
            $newPassError="password must contain 8 character or more";

        }else if(!preg_match("/[a-z]/",$newPwd)&&!preg_match("/[A-Z]/",$newPwd)){
            $newPassError="Password must contain both upper and lower case letters";

        }
        else if(!preg_match("/[0-9]/",$newPwd)){
            $error="String must conatin numbers";
        }
        else if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $newPwd)){
            $error="String must have a special characters";
           }else if($newPwd!=$conPwd){
            $confirmPassError="Passwords do not match";
           }
        
           $sql="select * from user where email ='".$_SESSION['email']."'";
           $result=$conn->query($sql);
           if($result->num_rows>0){
           while($row=$result->fetch_assoc()){
           
           $passCheck=$row['password'];
           }
        }

        if($passCheck!=$oldPwd){
         $passError="incorrect password";
        }
        if($confirmPassError==null && $newPassError==null && $passError==null){
            $sql32="update user set password= md5('".$newPwd."') where email='".$_SESSION['email']."'";
            if($conn->query($sql32)){
                echo "
                <script>
                alert('Changed sucessfully');

                </script>
                ";
            }
        }
        
        
        


    }
}

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
       
       

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        form {
    max-width: 500px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
#btn1,#btn2,#btn3{
        margin-left:-10%;
        background-color: white;
        padding: 5px;
        width: 35px;
       }
    #oldPwd,#newPwd,#confirmPwd{
        width: 100%;
        padding: 5px;
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
    

        input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            /* box-sizing: border-box; */
        }

        button {
            /* margin: 20px auto; */
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
        #oldPwd{
        width: 100%;
       }
       #subbtn{
        padding: 2%;

       }
      



      
    </style>
</head>
<body>
    <script>
        
     
            
            
        function togglePass(inputId) {
            var input = document.getElementById(inputId);
           
            if (input.type === "password") {
                input.type = "text";
               
            } else {
                input.type = "password";
               
            }
        
    
            
        }
    </script>
    
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
     <form action="#" method="post">
        <span style="color:red;">    <?php
            echo $passError;
            ?></span><br>
         <label for="oldPwd">Current Password: </label><br>
        <input type="password" name="oldPwd" id='oldPwd' required>
       <input type="checkbox"  value="bcd" name="xyz" onclick="togglePass('oldPwd')">Show password<br><br>

        <span style="color:red;">
            <?php echo $newPassError; ?>
        </span><br>
        <label for="newPwd">New Password: </label><br>
        <input type="password" name="newPwd" id="newPwd" required>
        <input type="checkbox" name="option1" value="Option 1" onclick="togglePass('newPwd')">Show password
     <br><br>

        <span style="color:red;">
            <?php echo $confirmPassError; ?>
        </span><br>
        <label for="confirmPwd">Confirm Password: </label><br>
        <input type="password" name="confirmPwd" id="confirmPwd" required>
        <input type="checkbox" onclick="togglePass('confirmPwd')">Show password
       <br><br>

       
        <button name="btn" id="subbtn">Submit</button>

     </form>   
   </div>
   </div>
</body>

</html>

