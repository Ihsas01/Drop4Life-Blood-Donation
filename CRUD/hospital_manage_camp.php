<?php
require 'dbh.crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Cancel'])) {

    $CampIDToDelete = $_POST['Camp_id'];

    
    $sqlDeleteCamp = "DELETE FROM camp WHERE Camp_id = $CampIDToDelete";
    if (mysqli_query($conn, $sqlDeleteCamp)) {
        echo '<script>alert("Record Deleted Successfully !!")</script>';
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

$hospital_id = isset($_SESSION['userID']) ? (int)$_SESSION['userID'] : 0;
$query = "SELECT camp.Camp_id,
camp.C_Name,
camp.C_Date,
CONCAT(camp.C_Time,' ',camp.C_meridiem) AS ATM,   
camp.Led_By,
CONCAT(camp.Line1,', ',camp.City,', ',camp.Postal_Code,', ',camp.Country) AS Address,
camp.C_Hospital_id FROM camp WHERE C_Hospital_id=$hospital_id";
$camps_error = '';
$result_camp = mysqli_query($conn, $query);
if (!$result_camp) {
    $camps_error = 'Camps Error: ' . mysqli_error($conn);
}
