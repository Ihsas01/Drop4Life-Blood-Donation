<?php
include 'dbh.crud.php';

// Add debugging to see if this file is being loaded
error_log("Edit Admin Process file loaded");

// Test database connection and admin table
$test_query = "SELECT COUNT(*) as count FROM admin";
$test_result = mysqli_query($conn, $test_query);
if ($test_result) {
    $test_row = mysqli_fetch_assoc($test_result);
    error_log("Admin table test - Found " . $test_row['count'] . " admin records");
} else {
    error_log("Admin table test failed: " . mysqli_error($conn));
}

function getAdminID() {
    if (isset($_POST['AdminID']) && !empty($_POST['AdminID'])) {
        return $_POST['AdminID'];
    } elseif (isset($_SESSION['userID'])) {
        return $_SESSION['userID'];
    } else {
        die('No Admin ID found in session or POST.');
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])){
    $AdminID = getAdminID();
    $conn->query("SET FOREIGN_KEY_CHECKS=0");
    $delete_query = "DELETE FROM admin WHERE Admin_id=?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $AdminID);
    if($stmt->execute() === TRUE){
        echo '<script>';
        echo 'alert("Record Deleted Successfully !!");';
        echo 'window.location.href = "./logout.php";';
        echo '</script>';
        exit;
    }else{
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
    $conn->query("SET FOREIGN_KEY_CHECKS=1");
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    error_log("Admin Update POST received - POST data: " . print_r($_POST, true));
    
    $AdminID = getAdminID();
    $Email = $_POST["email"];
    $Phone = intval($_POST["number"]); // Convert to integer since DB field is int(10)
    
    error_log("Admin Update - AdminID: $AdminID, Email: $Email, Phone: $Phone");
    
    $sql = "UPDATE admin SET Email=?, Phone_no=? WHERE Admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $Email, $Phone, $AdminID);
    
    if ($stmt->execute() === TRUE) {
        error_log("Admin Update Success - Record updated successfully");
        // Fetch the latest admin row and update all relevant session variables
        $result = $conn->query("SELECT * FROM admin WHERE Admin_id = '$AdminID'");
        if ($result && $row = $result->fetch_assoc()) {
            $_SESSION['email'] = $row['Email'];
            $_SESSION['phone'] = $row['Phone_no'];
            $_SESSION['username'] = $row['Username'];
        }
        echo '<script>';
        echo 'alert("Record Updated Successfully !!");';
        echo 'window.location.href = "./admin_panel.php";';
        echo '</script>';
        exit;
    } else {
        error_log("Admin Update Error: " . $stmt->error);
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}

function validatePassword($Password)
{
     return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $Password);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {
    $AdminID = getAdminID();
    $Password = $_POST["password"];
    $cPassword = $_POST["cPassword"];
    if (!validatePassword($Password)) {
        die("Password must contain at least 8 characters including one uppercase letter, one special character, and one digit.");
    }
    if ($Password !== $cPassword) {
        die("Passwords do not match.");
    }
    $sql = "UPDATE admin SET A_Password=? WHERE Admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $Password, $AdminID);
    if ($stmt->execute() === TRUE) {  
        echo '<script>';
        echo 'alert("Record Updated Successfully !!");';
        echo 'window.location.href = "./admin_panel.php";';
        echo '</script>';
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}
