<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnect.php';

    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    //Check whether User Exists...
    $sqlExist = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
    $result = mysqli_query($con, $sqlExist);
    $numRows = mysqli_num_rows($result);

    if ($numRows > 0) {
        echo "Users alredy Exists...Please Login to Continue...";
    } else {
        if ($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
        } else {
            echo "Passwords do not Match...";
        }
    }
}
