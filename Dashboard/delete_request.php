<?php

session_start();
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-left: 6px solid #ff4d4d;
        }
        h1 {
            color: #ff4d4d;
            font-size: 24px;
        }
        ul {
            list-style-type: square;
            margin: 20px 0;
            padding-left: 20px;
        }
        .warning {
            color: #ff4d4d;
            font-weight: bold;
        }
        .checkbox-label {
            display: block;
            margin: 20px 0;
            font-weight: bold;
        }
        button {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Deletion Confirmation</h1>
        <p><span class="warning">Warning:</span> Deleting your account is a <strong>permanent action</strong> and <strong>cannot be undone</strong>. This means that all your data, including your personal information, preferences, and any content or services associated with your account, will be permanently removed from our system.</p>

        <p>Before you proceed, please ensure that:</p>
        <ul>
            <li>You have saved any important information or content you may need in the future.</li>
            <li>You understand that any active subscriptions or services associated with your account will be canceled.</li>
            <li>If you have any issues or concerns, please contact our support team for assistance.</li>
        </ul>

        <p class="warning">Are you sure you want to delete your account? If so, please check the box below and click the confirmation button.</p>

        <form action="#" method="POST">
            <label class="checkbox-label">
                <input type="checkbox" value="yes" name="checkMe"> I understand the consequences and wish to proceed.
            </label>
            <button name="btn">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
error_reporting(0);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['btn'])) {
        $isMarked = $_POST['checkMe'];

        if ($isMarked == 'yes') {
            $sql = "select * from user where email='" . $_SESSION['email'] . "'";
            $rs = $conn->query($sql);
            while ($row = $rs->fetch_assoc()) {
                $name = $row['name'];
                $id = $row['id'];
                $phone = $row['phone'];
                $password = $row['password'];
                $question = $row['question'];
                $answer = $row['answer'];
                $address = $row['address'];
                $store_name = $row['store_name'];
            }
            $sql2 = 'insert into delete_request (id, name, password, question, answer, phone, email, address, store_name) values(' . $id . ',"' . $name . '","' . $password . '","' . $question . '","' . $answer . '","' . $phone . '","' . $_SESSION["email"] . '","' . $address . '","' . $store_name . '")';
            if ($conn->query($sql2)) {
                $sql3 = "delete from user where id=" . $id;

                if ($conn->query($sql3)) {
                    header("location:../index.html");
                }
            }

        } else {
            echo "<script>alert('Please check the checkbox to proceed further.');</script>";
        }
    }
}
?>
