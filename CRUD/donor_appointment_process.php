<?php
include 'dbh.crud.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $HospitalName = $_POST["hname"];
    $Date = $_POST["date"];
    $Time = $_POST["time"];
    $Meridiem = $_POST["meridiem"];
    $D_ID = $_SESSION["userID"];

    $stmt2 = $conn->query("SELECT Hospital_id FROM hospital WHERE H_Name = '$HospitalName'");
    if ($stmt2) {
        $row = $stmt2->fetch_assoc();
        $H_id = $row["Hospital_id"];


        $sql = "INSERT INTO appointment (A_Donor_id, A_Date, A_Time, A_Meridiem, A_Hospital_id) VALUES ('$D_ID', '$Date', '$Time', '$Meridiem', '$H_id')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['appointment_success'] = true;
            header("Location: ./donor_panel.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Hospital not found.";
    }

    $conn->close();
}
