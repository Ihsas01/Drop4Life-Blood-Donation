<?php
include 'dbh.crud.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])){
    $HospitalID = $_SESSION['userID'];

    $update_query="UPDATE appointment SET Status = 0 WHERE A_Hospital_id='$HospitalID' AND Status is NULL";
    $delete_query1="DELETE FROM camp WHERE C_Hospital_id='$HospitalID'";
    $delete_query2="DELETE FROM emergency_blood WHERE EB_Hospital_id='$HospitalID'";

if($conn->query($update_query)===TRUE && $conn->query($delete_query1)===TRUE && $conn->query($delete_query2)===TRUE){

    $delete_query = "DELETE FROM hospital WHERE Hospital_id='$HospitalID'";
    $conn->query("SET FOREIGN_KEY_CHECKS=0");
    if($conn->query($delete_query)===TRUE){
        echo '<script>';
        echo 'alert("Record Deleted Successfully !!");';
        echo 'window.location.href = "./logout.php";';
        echo '</script>';
    }else{
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
}else{
    echo "Error: " . $conn->error;
}
    $conn->query("SET FOREIGN_KEY_CHECKS=1");
    $conn->close();
   
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $HospitalID = $_SESSION['userID'];
    $Email = $_POST["email"];
    $Phone = $_POST["number"];


    $sql = "UPDATE hospital SET Email='$Email', Tel_no='$Phone' WHERE Hospital_id = $HospitalID  ";

    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo 'alert("Record Updated Successfully !!");';
        echo 'window.location.href = "../hospital_panel.php";';
        echo '</script>';
    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function validatePassword($Password)
{
      return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $Password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {


    $HospitalID = $_SESSION['userID'];
    $Password = $_POST["password"];
    $cPassword = $_POST["cPassword"];

    if (!validatePassword($Password)) {
        die("Password must contain at least 8 characters including one uppercase letter, one special character, and one digit.");
    }

    if ($Password !== $cPassword) {
        die("Passwords do not match.");
    }

    $sql = "UPDATE hospital SET H_Password='$Password' WHERE Hospital_id='$HospitalID'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>';
        echo 'alert("Record Updated Successfully !!");';
        echo 'window.location.href = "../hospital_panel.php";';
        echo '</script>';
    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
