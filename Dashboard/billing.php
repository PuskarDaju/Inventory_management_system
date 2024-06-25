<?php
include("../connection.php");
session_start();

   

$_SESSION['message']="hello";
//echo "<h1>welcome ".$_SESSION['email']."</h1>";
$tableName = rtrim($_SESSION['email'],"@gmail.com")."_main";
$nameList=array();
$sql="select *from ".$tableName;

$result=$conn->query($sql);

while($row=$result->fetch_assoc()){
    array_push($nameList, $row['name']);
    
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
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
        /* form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            height: 50%;
        } */

        /* label {
            display: block;
            margin-bottom: 5px;
        } */

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"],input[type='number'] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
        margin-top: 10px;
            margin-left:135px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #numRows {
            border: none;
            outline: none;
            color: white;
        }

        #click_count23 {
            
        color: #f8f9fa;
        }
        input#numRows, textarea{
            background-color:white;
            color: white;
        }


      
    </style>
<script>
    $(document).ready(function()
    {
        $('#calculate').click(function()
    {
         $.ajax({
          url:'index.php',
          method:'post',
          data : $('#myform').serialize(),
          success:function()
         {
         } 

    });
    });
    });
</script>
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
    <form action="process_data.php" method="post" id="myform">
    <table border="1">  
    <datalist id="helloWorld">
<?php
   for($i=0;$i<sizeof($nameList);$i++){
 echo  "<option>".$nameList[$i]."</option>";
}
?>
   </datalist>
            <tr>
                <th>Items</th>
                <th>Name</th>
                <th>Quantity</th>
            </tr>           
        <tbody id="myTableBody">
   

            <tr>
            <td><input type="text" id="i1"  name="i1" value="1" readonly></td>              
   <td>             
   <input type="text" id="n1" list="helloWorld" name="n1" >
</td>
        <td> <input type="number" id="q1" name="q1"></td>
        </tr>;
         
        
        </tbody>
       
        
    </table>
    <input type="text" id="numRows" name="numRows" value="1"><br>
    
    <button name="calculate" type="submit" id="calculate" onclick="saveDefault()">Calculate</button>
    </form>
    <button  id="myButton" name ="btn" onclick="addRow()">Add Row</button>
    
    <p><span id='click_count23'></span></p>
    <script>
        var button=document.getElementById("myButton");
        var clickme=document.getElementById("click_count23").value;

        var a=2;
        button.addEventListener('click', function(){
            a++;
            console.log("Button clicked. New click count: " +a);
            clickme.textContent=a;

        });

        function addRow() {
            var tableBody = document.getElementById("myTableBody");
            var newRow = tableBody.insertRow();            
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);           
            var cell4 = newRow.insertCell(2);

            cell1.innerHTML = "<input type='text' "+ "id='i"+a+"' name='i"+a+"' readonly>";
            cell2.innerHTML = "<input type='text' list='helloWorld'"+ "id='n"+a+"'name='n"+a+"'>" +"<?php
            echo "<datalist id='helloWorld'>";

   for($i=0;$i<sizeof($nameList);$i++){   
 echo  "<option>".$nameList[$i]."</option>";
}

echo "</datalist>"
?>";
           
            cell4.innerHTML="<input type='number'"+ "id='q"+a+"'name='q"+a+"'>";
            
            var itemName="i"+a;
            console.log(itemName);
            // Function to write content to text field
 function writeToTextField() {

    // Get the text field element
    var neWRow="i"+a;
    var textField2=document.getElementById("numRows");
    var textField = document.getElementById(neWRow);

    // Check if the text field exists
    if (textField) {
        // Set the value of the text field
       
        textField.value = a;
        textField2.value=a;
        
    } else {
        console.error("Text field not found.");
    }
}
        writeToTextField(); 
        }       
   </script>  
   </div>
   </div>
</body>

</html>
