<?php
require 'header.php';
include 'CRUD/dbh.crud.php';

if (!isset($_SESSION['userID']) || $_SESSION['userType'] !== 'hospital') {
    header('Location: hospital_login.php');
    exit();
}

$hospitalId = $_SESSION['userID'];
$query = "SELECT * FROM hospital WHERE Hospital_id='$hospitalId'";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) === 0) {
    die('Hospital not found.');
}
$row = mysqli_fetch_assoc($result);

$hospitalName = htmlspecialchars($row['H_Name']);
$email = htmlspecialchars($row['Email']);
$phone = htmlspecialchars($row['Tel_no']);
$address = htmlspecialchars($row['Line1']);
$city = htmlspecialchars($row['City']);
$postalCode = htmlspecialchars($row['Postal_Code']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hospital Profile</title>
    <link rel="stylesheet" href="css/hospital_edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f6f7fb; font-family: 'Inter', sans-serif; }
        .edit-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 32px 28px; }
        .edit-title { font-size: 2rem; font-weight: 700; margin-bottom: 24px; text-align: center; color: #333; }
        .edit-form label { font-weight: 600; margin-bottom: 6px; display: block; color: #222; }
        .edit-form input[type="text"], .edit-form input[type="tel"], .edit-form input[type="password"] { width: 100%; padding: 10px 12px; margin-bottom: 18px; border: 1.5px solid #d1d5db; border-radius: 6px; font-size: 1rem; }
        .edit-form input[type="text"]:focus, .edit-form input[type="tel"]:focus, .edit-form input[type="password"]:focus { border-color: #333; outline: none; }
        .edit-actions { display: flex; justify-content: space-between; align-items: center; margin-top: 18px; }
        .update { background: #333; color: #fff; border: none; border-radius: 6px; padding: 10px 28px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .update:hover { background: #222; }
        .del { background: #b91c1c; color: #fff; border: none; border-radius: 6px; padding: 10px 24px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .del:hover { background: #7f1d1d; }
        .form-group { margin-bottom: 18px; }
        .message { margin-bottom: 18px; padding: 10px 16px; border-radius: 6px; font-weight: 500; }
        .message.success { background: #d1fae5; color: #065f46; }
        .message.error { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="edit-container">
        <div class="edit-title"><i class="fas fa-hospital"></i> Edit Hospital Profile</div>
        <?php include 'CRUD/edit_hospital_process.php'; ?>
        <form class="edit-form" method="post" autocomplete="off">
            <div class="form-group">
                <label for="hospitalName">Hospital Name</label>
                <input type="text" id="hospitalName" name="hospitalName" value="<?php echo $hospitalName; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="number" maxlength="10" value="<?php echo $phone; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo $city; ?>" required>
            </div>
            <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" id="postalCode" name="postalCode" value="<?php echo $postalCode; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">New Password <span style="font-weight:400; color:#888;">(leave blank to keep current)</span></label>
                <input type="password" id="password" name="password" placeholder="Enter new password">
            </div>
            <div class="edit-actions">
                <button type="submit" name="update" class="update">Update</button>
                <button type="submit" name="delete" class="del" onclick="return confirm('Are you sure you want to delete your hospital profile? This cannot be undone.');">Delete</button>
            </div>
        </form>
    </div>
</body>
</html> 