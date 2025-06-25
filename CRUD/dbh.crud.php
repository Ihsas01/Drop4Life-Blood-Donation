<?php
$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'blood_donation';

$conn = mysqli_connect($serverName,$userName,$password,$dbName);

if (!$conn) {
    die("Not connected").mysqli_connect_error();
}
?>