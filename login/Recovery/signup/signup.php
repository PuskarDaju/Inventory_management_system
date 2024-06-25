<?php

$passError=$emailError="";
$c=0;

if(isset($_POST['btn'])){
    $email=trim($_POST['email']);
$name = trim($_POST['username']);
$pass=trim($_POST['password']);
$pass1=trim($_POST['con_password']);
    if(!empty($email)&&!empty($name)&&!empty($pass)){
if($pass!=$pass1){
    echo "Passwords donot match!!!!!!!";

    echo "<a href = 'signup.html'>Go back</a>";
}
else{

include("../../../connection.php");

$sql = "select * from user";

$result = $conn->query($sql);
 while ($row=$result->fetch_assoc()){
    if($email == $row['email']){
        $c++;
    }
 }

 $sql2="select * from user_request";
 $result2=$conn->query($sql2);
 if($result2->num_rows>0){
    while($row2=$result2->fetch_assoc()){
        if($row2['email'] == $email){
            $c++;
        }
    }
 }


 if($c>0){
    echo "This Email  is already in use!!!!!!!!";
    echo "<a href = 'signup.html'>Go back</a>";

} else{
    if(strlen($pass)<8){
        $newPassError="password must contain 8 character or more";

    }else if(!preg_match("/[a-z]/",$pass)&&!preg_match("/[A-Z]/",$pass)){
        $newPassError="Password must contain both upper and lower case letters";

    }
    else if(!preg_match("/[0-9]/",$pass)){
        $error="String must conatin numbers";
    }
    else if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$pass)){
        $error="String must have a special characters";
       }
    

    $sql="insert into user_request (name,password,email) values ('$name', md5('$pass'),'$email')";
    if($conn->query($sql)){
        echo " request sent please wait for admins response....";
    }

}
}
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup Page</title>
<!-- handling form resubmission problem -->
<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 500px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .error {
        color: red;
        margin-top: 5px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Signup</h2>
    <form id="signupForm" action="signup.php" method="post">
        <span name="emailError"></span><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <span name="passError"></span><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="con_password" required>
        <span id="passwordError" class="error"></span><br>

        <button type="submit" name="btn">Signup</button>
    </form>
</div>

<script>
    //password checking
    const signupForm = document.getElementById('signupForm');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirmPassword');
    const passwordError = document.getElementById('passwordError');

    signupForm.addEventListener('submit', function(event) {
        if (passwordField.value !== confirmPasswordField.value) {
            event.preventDefault(); // Prevent form submission
            passwordError.textContent = "Password and Confirm Password do not match";
        }
    });
</script>

</body>
</html>
