<?php
include 'dbh.inc.php';


function donorLogin($con, $email, $password)
{
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM donor WHERE Email=? AND D_Password=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["userType"] = "donor";
        $_SESSION["userID"] = $row["Donor_id"];
        $_SESSION["username"] = $row["Salutation"] . " " . $row["F_name"] . " " . $row["L_name"];
        $_SESSION["email"] = $row["Email"];
        $stmt->close();
        header("Location: donor_panel.php");
        exit();
    } else {
        $stmt->close();
        return false;
    }
}


function hospitalLogin($con, $email, $password)
{
    global $hospital_login_error;
    
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM hospital WHERE Email=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row['H_Password'] === $password) {
            if ($row['Status'] == 1) {
                $_SESSION["userType"] = "hospital";
                $_SESSION["userID"] = $row["Hospital_id"];
                $_SESSION["username"] = $row["H_Name"];
                $_SESSION["email"] = $row["Email"];
                $stmt->close();
                
                // Debug: Check if session was set
                if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "hospital") {
                    header("Location: hospital_panel.php");
                    exit();
                } else {
                    $hospital_login_error = "Session creation failed";
                    return false;
                }
            } else {
                $hospital_login_error = "Your account is not approved yet. Please wait for admin approval.";
                $stmt->close();
                return false;
            }
        } else {
            $hospital_login_error = "Invalid Login Credentials";
            $stmt->close();
            return false;
        }
    } else {
        $hospital_login_error = "Invalid Login Credentials";
        $stmt->close();
        return false;
    }
}



function adminLogin($con, $UName, $password, $passKey)
{
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM admin WHERE Username=? AND Passkey=? AND A_Password=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sss", $UName, $passKey, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["userType"] = "admin";
        $_SESSION["userID"] = $row["Admin_id"];
        $_SESSION["username"] = $row["Username"];
        $_SESSION["email"] = $row["Email"];
        $stmt->close();
        header("Location: admin_panel.php");
        exit();
    } else {
        $stmt->close();
        return false;
    }
}
