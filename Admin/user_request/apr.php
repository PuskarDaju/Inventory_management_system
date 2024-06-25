<?php
session_start();
include("../../connection.php");

// // Check if ID parameter is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])) {


$id=$_GET['id'];

//     // SQL statement to delete the row with the specified ID
    $sql = "SELECT *  FROM user_request WHERE id = $id";

    // Execute the SQL statement
    if ($conn->query($sql)==true) {
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();

        $name=$row['name'];
        $password=$row['password'];
        $email=trim($row['email']);
        
        $phone=$row['phone'];

        if(!empty($name)&&!empty($password)&&!empty($email)){

        $sql22="insert into user(name,password,phone,email) values ('$name', '$password','$phone','$email')";

        if($conn->query($sql22)){
            $sql32 = "DELETE FROM user_request WHERE id = $id";
            if($conn->query($sql32)){
                $table_name=rtrim($email,'@gmail.com');
                        $main_table=$table_name."_main";
                        $sales_table=$table_name."_sales";
                
                        $sql1 = "CREATE TABLE ".$main_table."(
                            id INT PRIMARY KEY AUTO_INCREMENT,
                            name VARCHAR(50) ,
                            quantity INT,
                            rate INT
                        );";
                        
                
                        $sql2 ="CREATE TABLE ".$sales_table."(
                            id INT PRIMARY KEY AUTO_INCREMENT,
                            date DATE,
                            name VARCHAR(255) NOT NULL,
                            amount INT 
                        );";
                
                
                
                        if($conn->query($sql1)){
                
                            if($conn->query($sql2)){
                                
                              $_SESSION['msg_to_admin']="inserted Sucessfully";

                                header("location:../index.php");
                
                            }
                            
                        }
                        
                
                
                
                    }else{
                        echo "registration failed";
                    }
                 }
            }else {
        echo "Error deleting record: " . $conn->error;
    
} 
}
}

// Close connection
$conn->close();
?>