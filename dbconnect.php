<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "idiscuss";

$con = mysqli_connect($servername, $username, $password, $dbName);

if ($con) {
    // echo "Connection Successful";
} else {
    die("Connection not Established due to " . mysqli_connect_error());
}
