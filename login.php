<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbconnect.php';

    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "SELECT * FROM `users` WHERE `user_email`='$email'";
    $result = mysqli_query($con, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_pass'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $email;
            // echo "loggedin";
            // echo "<br>Hello" . $email;
            header("location: /forum/index.php");
        } else {
            echo "Failed to Login...";
        }
    }
}
