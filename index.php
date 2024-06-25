<?php

session_start();
$c=0;

    if(isset($_POST['login'])){
    $c=0;
    include("connection.php");
    $user=trim($_POST['username']);

    $test_password=trim($_POST['password']);   

    $password=md5($test_password);
    $sql = "select * from user";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        if($row['email']==$user){
            if($row['password']==$password){
                $_SESSION['email']=$row['email'];
                $_SESSION['user']=$row['name'];
                $_SESSION['address']=$row['address'];
                $_SESSION['store_name']=$row['store_name'];
                $c++;
            }
        }
    }if($c==0){
      
        echo " Username or Password donot match";

    }else{     
        header("location:dashboard/dash.php");
    }
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

        input[type="email"], input[type="password"],input[type='text'] {
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
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>
<body>
    <form action="#" method="post">
        <h2>Login</h2>
        <label for="username">Email</label>
        <input type="email" name="username" id="username" required>
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        
        <input type="checkbox" onclick="showPass()"> Show password

<br><br>
        <button type="submit" name="login" id="login">Login</button>
        
        <div class="link-container">
            <a href="login/Recovery/fpass.html">Forgot password?</a>
            <br><br>
            <a href="login/Recovery/signup/signup.php">Don't have an account?</a>
        </div>
    </form>
</body>
</html>
