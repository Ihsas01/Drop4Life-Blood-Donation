<?php
include 'dbh.crud.php';

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
    $AdminID = getAdminID();
    $Email = $_POST["email"];
    $Phone = $_POST["number"];
    $sql = "UPDATE admin SET Email=?, Phone_no=? WHERE Admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $Email, $Phone, $AdminID);
    if ($stmt->execute() === TRUE) {
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
