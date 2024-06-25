<?php
session_start();

include("../connection.php");


$_SESSION['msg']=' ';


$mSQL="select * from user where email='".$_SESSION['email']."'";
$rs=$conn->query($mSQL);
if($rs->num_rows>0){
    while($row=$rs->fetch_assoc()){
        $valName=$row['name'];
        $valPhone=$row['phone'];
        $valQuestion=$row['question'];
        $valAnswer=$row['answer'];
        $valAddress=$row['address'];
        $valStoreName=$row['store_name'];
    }
}


$name=$question=$answer='';
$phone='';
$name_err=$phone_err=null;
if(isset($_POST['btn'])){
    //validation
   
    if(empty($_POST['name'])){
        $name_err="Name is Required";

    }else if(!preg_match("/^[a-zA-Z]+$/",$_POST['name'])){
        $name_err="Name should contain only letters.";
    }else{
    $name=trim($_POST['name']);
    $name_err=null;
    }

if(empty($_POST["phoneNum"])){
   $phone_err='Enter phone number'; 
// }else if(strlen(trim($_POST['phone']))!=10){
//     $phone_err="Please enter a valid phone number";
//     $phone_len=strlen($phone);
// }

}else{
    $phone=trim($_POST['phoneNum']);
}
$question=trim($_POST['question']);
$answer=trim($_POST['answer']);
$address=trim($_POST['address']);
$store_name=trim($_POST['store_name']);
}
if(isset($_POST['btn'])){
if($name_err==null ){
    $sql = 'update user set name="'.$name.'" where email="'.$_SESSION["email"].'"';
    $conn->query($sql);
}


if(empty($phone_err)){
    
        
       
        $sql2='update user set phone="'.$phone.'" where email="'.$_SESSION["email"].'"';

        $conn->query($sql2);
        
            $_SESSION['msg']='updated';     
        

    }
    if(!empty($question) && !empty($answer)){
        $sql32="update user set question='".$question."' where email = '".$_SESSION['email']."'";
        $sql33="update user set answer= '".$answer."' where email='".$_SESSION['email']."'";

        if($conn->query($sql32) && $conn->query($sql33)){
            $_SESSION['msg']="updated";
        }
    }
    if(!empty($address)){
        $sql="update user set address='".$address."' where email = '".$_SESSION['email']."'";
        $conn->query($sql);
    }
    if(!empty($store_name)){
        $sql="update user set store_name='".$store_name."' where email = '".$_SESSION['email']."'";
        $conn->query($sql);
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
label {
    font-weight: bold;
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
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],input[type='number'] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
    <form action="#" method="post">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" value='<?php echo $valName;?>'>
          <?php
        echo "<p style='color:green;'>".$name_err."</p></span>";
        
        ?><br><br>
        <label for="address">Address: </label>
        <input type="text" id="address" name="address" value="<?php echo $valAddress;?>">
        
          <br><br>
          <label for="store_name">Store Name: </label>
        <input type="text" id="store_name" name="store_name"
        value="<?php echo $valStoreName; ?>"> 
          <br><br>
        <label for="phoneNum">Phone: </label>
        <input type="tel" name="phoneNum" id="phoneNum" value='<?php echo $valPhone; ?>'><br><br>
        <span><?php
        echo "<p style='color:green;'>".$phone_err."</p></span>";
        
        ?></span>
        <label for="question">Security Question: </label>
        <input type="text" name="question" id="question" value="  <?php 
         echo $valQuestion; 
         ?>"><br><br>
        <label for="answer">Answer: </label>
        <input type="text" name="answer" id="answer" value="  <?php 
         echo $valAnswer; 
         ?>">
        <button name="btn" id="btn">Submit</button>
    </form>
    
   </div>
   </div>
</body>

</html>
