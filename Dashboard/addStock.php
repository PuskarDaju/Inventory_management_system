<?php

session_start();
$a=0;
include("../connection.php");
$rateError=$qtyError='';
if($_SERVER['REQUEST_METHOD']=='POST'){

if(isset($_POST['insert'])){

    
    $name=trim($_POST['name']);
   
    $rate=$_POST['rate'];
    $qty=$_POST['qty'];

    
    $table=rtrim($_SESSION['email'],"@gmail.com");
    $table_name=$table."_main";
//validation
    if($rate!=null &&$qty!=null ){
    if($rate<=0){
        $rateError="Rate cannot be Negative or Zero";
    }
    if($qty<=0){
        $qtyError="Quantity cannot be Negetive or zero";
    }
}
    
 
if(empty($qtyError) && empty($rateError)){
      
    $sql = "select * from ".$table_name;


    $result = $conn->query($sql);

     while($row = $result->fetch_assoc()){
        if($row['name']==$name && $row['rate']==$rate){
            
               
                $id=$row['id'];
                $newQty=$row['quantity'];
                $newQty=$newQty+$qty;
                $a++;

                
               
            }
        }
    
    if($a>0){
        $sql="update ".$table_name." set quantity =".$newQty." where id = ".$id;

    }if($a==0){

    $sql= "insert into ".$table_name." (name,rate,quantity) values('$name',$rate,$qty)";
    }
    if($conn->query($sql)){
   echo "
   <script>

   alert('Inserted Sucessfully');
   </script>
   
   ";


    }else{
        echo "error";
    }
}
}
}
    ?>

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

/* Styles for the form labels */
label {
    font-weight: bold;
}

/* Styles for the form input fields */
input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Styles for the submit button */
button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
}

/* Hover styles for the submit button */
button:hover {
    background-color: #0056b3;
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
     <label for="input">Name (brand):</label>
     <input type="text" name="name" required><br><br>

     <span><p style="color:red;"></p><?php echo $qtyError;  ?></p></span>
     <label for="input">Qantity:</label>
     <input type="number" name="qty" required><br><br>

     <span><p style="color:red;"></p><?php echo $rateError; ?></p></span>
     <label for="input">Rate:</label>
     <input type="number" name="rate" required><br><br>   

     <button name ="insert" id ="insert">Submit</button>
     
    </form>




   </div>
   </div>
</body>

</html>
