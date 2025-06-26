<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['userID']) || !isset($_SESSION['userType']) || $_SESSION['userType'] !== 'admin') {
    echo "<h2>Access Denied!</h2>";
    echo "<p>You must be logged in as an admin to access this page.</p>";
    echo "<p><a href='admin_login.php'>Login as Admin</a></p>";
    exit;
}

// Database connection
$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'blood_donation';

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $AdminID = $_POST['AdminID'];
    $Email = $_POST['email'];
    $Phone = intval($_POST['number']);
    
    echo "<h3>Form Submitted!</h3>";
    echo "<p>AdminID: $AdminID</p>";
    echo "<p>Email: $Email</p>";
    echo "<p>Phone: $Phone</p>";
    
    $sql = "UPDATE admin SET Email=?, Phone_no=? WHERE Admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $Email, $Phone, $AdminID);
    
    if ($stmt->execute() === TRUE) {
        echo "<p style='color: green; font-weight: bold;'>UPDATE SUCCESSFUL!</p>";
        echo "<p>Rows affected: " . $stmt->affected_rows . "</p>";
        
        // Update session variables
        $_SESSION['email'] = $Email;
        $_SESSION['phone'] = $Phone;
    } else {
        echo "<p style='color: red; font-weight: bold;'>UPDATE FAILED: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Get current admin data
$query = "SELECT * FROM admin WHERE Admin_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['userID']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Admin not found');
}

$Email = $row['Email'];
$Phone = $row['Phone_no'];
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Admin Edit</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin: 10px 0; }
        label { display: block; margin-bottom: 5px; }
        input { padding: 5px; width: 300px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Simple Admin Edit Test</h1>
    
    <p><strong>Current Session:</strong></p>
    <p>UserID: <?php echo $_SESSION['userID']; ?></p>
    <p>UserType: <?php echo $_SESSION['userType']; ?></p>
    <p>Username: <?php echo $_SESSION['username']; ?></p>
    
    <h2>Edit Profile</h2>
    <form method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($Email); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="number">Phone Number:</label>
            <input type="tel" name="number" id="number" value="<?php echo htmlspecialchars($Phone); ?>" required>
        </div>
        
        <input type="hidden" name="AdminID" value="<?php echo $_SESSION['userID']; ?>">
        
        <div class="form-group">
            <button type="submit" name="update">Update Profile</button>
        </div>
    </form>
    
    <p><a href="admin_edit.php">Back to Original Admin Edit Page</a></p>
    <p><a href="admin_panel.php">Back to Admin Panel</a></p>
</body>
</html>

<?php mysqli_close($conn); ?> 