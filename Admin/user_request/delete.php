<?php
include("../../connection.php");

// // Check if ID parameter is set and not empty
// if(isset($_GET['id']) && !empty($_GET['id'])) {
//     // Escape the ID parameter to prevent SQL injection
//     $id = $conn->real_escape_string($_GET['id']);

$id=$_GET['id'];

//     // SQL statement to delete the row with the specified ID
    $sql = "DELETE FROM user_request WHERE id = $id";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Record with ID". $id ."deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    
} 
// else {
//     echo "Invalid ID";
// }

// Close connection
$conn->close();
?>
