<?php
session_start();
require 'dbh.crud.php';

// Check if user is logged in as hospital
if (!isset($_SESSION["userType"]) || $_SESSION["userType"] != "hospital") {
    header("Location: ../hospital_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointment_id'];
    $action = $_POST['action'];
    
    if ($action == "approve") {
        $query = "UPDATE appointment SET Status = 1 WHERE Appointment_id = ? AND A_Hospital_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $appointment_id, $_SESSION['userID']);
        $result = $stmt->execute();
        
        if ($result) {
            echo '<script>alert("Appointment Approved Successfully!"); window.location.href = "../hospital_panel.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href = "../hospital_panel.php";</script>';
        }
        $stmt->close();
    } else if ($action == "reject") {
        $query = "UPDATE appointment SET Status = 0 WHERE Appointment_id = ? AND A_Hospital_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $appointment_id, $_SESSION['userID']);
        $result = $stmt->execute();
        
        if ($result) {
            echo '<script>alert("Appointment Rejected Successfully!"); window.location.href = "../hospital_panel.php";</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href = "../hospital_panel.php";</script>';
        }
        $stmt->close();
    }
}

// Legacy code for backward compatibility
if (isset($_POST["Approved"])) {
    $AppointmentID = $_POST['AppointmentID'];
    $query = "UPDATE appointment SET appointment.Status='1' WHERE Appointment_id=$AppointmentID";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<script>alert("Appointment Approved Successfully!")</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else if (isset($_POST["Declined"])) {
    $AppointmentID = $_POST['AppointmentID'];
    $query = "UPDATE appointment SET appointment.Status='0' WHERE Appointment_id=$AppointmentID";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<script>alert("Appointment is Cancelled!")</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$hospital_id = isset($_SESSION['userID']) ? (int)$_SESSION['userID'] : 0;
$query = "SELECT appointment.Appointment_id, 
                 appointment.A_Date, 
                 CONCAT(appointment.A_Time, ' ', appointment.A_meridiem) AS ATM, 
                 appointment.A_Guest_id,
                 appointment.A_Hospital_id,
                 appointment.Status,
                 CONCAT(donor.Salutation, ' ', donor.F_name, ' ', donor.L_name) AS DonorName, 
                 donor.NIC AS DonorNIC, 
                 donor.Blood_Group AS DonorBloodgroup,  
                 donor.Email AS DonorEmail,
                 CONCAT(guest.Salutation, ' ', guest.F_name, ' ', guest.L_name) AS GuestName, 
                 guest.NIC AS GuestNIC, 
                 guest.Blood_Group AS GuestBloodgroup,  
                 guest.Email AS GuestEmail
          FROM appointment
          LEFT JOIN donor ON appointment.A_Donor_id = donor.Donor_id
          LEFT JOIN guest ON appointment.A_Guest_id = guest.Guest_id
          WHERE A_Hospital_id=$hospital_id AND appointment.Status is NULL";
$appointments_error = '';
$result_appointments = mysqli_query($conn, $query);
if (!$result_appointments) {
    $appointments_error = 'Appointments Error: ' . mysqli_error($conn);
}
?>
