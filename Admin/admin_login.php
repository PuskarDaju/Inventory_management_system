<?php
error_reporting(0);
session_start();
$error_msg='';
include("../connection.php");
if(isset($_POST['btn'])){
    $email =trim($_POST['admin_email']);
    $pass =trim($_POST['admin_pass']);
    $c=0;
}
$sql="select * from admin";
$rs=$conn->query($sql);
while($row=$rs->fetch_assoc()){
    if($row['email']==$email && $row['password']==md5($pass)){
        $_SESSION['admin_email']=$email;
        $_SESSION['admin_name']=$row['user'];
        header("location:index.php");
        $c++;
        break;
    }
}
if(!empty($_SESSION['admin_email']) && $c==0){
    $error_msg="invalid user name or password";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 360px;
            padding: 40px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type='text'], input[type='password'],input[type='email']{
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }

        .link-container a {
            color: #007bff;
            text-decoration: none;
        }

        .link-container a:hover {
            text-decoration: underline;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
        function showPass() {
            var x = document.getElementById("admin_pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>
<body>
    <form action=" " method="post">
        <h2>Login(ADMIN)</h2>
        <span>

        <?php
echo $error_msg;
$c=0;

?>

        </span>
        <label for="admin_email">Email</label>
        <input type="email" name="admin_email" id="admin_email" required>
        
        <label for="password">Password</label>
        <input type="password" name="admin_pass" id="admin_pass" required>
        
        <input type="checkbox" onclick="showPass()"> Show password

<br><br>
        <button type="submit" name="btn" id="btn">Login</button>
        
    
    </form>
</body>
</html>


