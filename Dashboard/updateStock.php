<?php
session_start();
include('../connection.php');
$table_name=rtrim($_SESSION['email'],"@gmail.com")."_main";

$id=$_GET['id'];
$sql = "select name,rate from ".$table_name." where id = ".$id;
if($rs=$conn->query($sql)){
    $row=$rs->fetch_assoc();
    $name_db=$row['name'];
    $rate_db=$row['rate'];

if(isset($_POST['btn'])){
    $x=0;
    $name=trim($_POST['name']);
    $rate=$_POST['rate'];


    if($name!=$name_db){
        $x++;
        $sql22="update ".$table_name." set name = '".$name ."' where id = ".$id;
        $conn->query($sql22);
    }
    if($rate!=$rate_db){
        $x++;

        $sql22="update ".$table_name." set rate = ".$rate." where id = ".$id;
        $conn->query($sql22);
    }
    if($x>0){
        header("location:viewStock.php");

    }

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awesome Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        div {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div>
        <form action="#" method="post">
            <label for="name">Name: </label>
            <input type="text" id="name" name="name"  value=" <?php echo $name_db; ?>" required><br><br>
            <label for="rate">Rate: </label>
            <input type="number" id="rate" name="rate" value= '<?php echo $rate_db;?>' required>
            <br><br>
            <button name="btn">Submit</button>
        </form>
    </div>
</body>
</html>

</html>