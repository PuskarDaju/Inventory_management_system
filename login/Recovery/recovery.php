
<?php
session_start();
error_reporting(0);
$ans=$_POST["ans"];


include("../../connection.php");

if(isset($_POST['recover'])){
    if($ans==$_SESSION['answer']){
        header("location:changePw.html");

   
}else{
    echo "Answer is wrong";

}
}


?>

<html>
    <head>
        <title>Recover Form</title>
        <style>
            #recForm{
                margin-top: 20px;
                padding: 15px;
                border: 1px solid black;
                margin-left: 25%;
                width: max-content;
                
            }
            label{
                font-size: medium;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
               
            }
            fieldset{
                margin-left: 20px;
                width:450px;
            }
        </style>
    </head>

<body>
<fieldset>
    <legend>Security Question</legend>
<form action="recovery.php" method="post" id="recForm">
    <label for="input"><b> <?php 
    
    echo $_SESSION['question'];
    ?>
    ?
    </b>

    <br>
    <input type="text" name="ans" id="ans">

    <br><br>

    <button name='recover'> Submit</button>

</form>
</fieldset>
</html>

