<?php
session_start();

// Test database connection
$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'blood_donation';

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<h2>Database Connection Test</h2>";
echo "<p>Database connection: SUCCESS</p>";

// Test admin table
$test_query = "SELECT COUNT(*) as count FROM admin";
$test_result = mysqli_query($conn, $test_query);
if ($test_result) {
    $test_row = mysqli_fetch_assoc($test_result);
    echo "<p>Admin table: Found " . $test_row['count'] . " records</p>";
} else {
    echo "<p>Admin table error: " . mysqli_error($conn) . "</p>";
}

// Test session
echo "<h2>Session Test</h2>";
echo "<p>Session userID: " . (isset($_SESSION['userID']) ? $_SESSION['userID'] : 'NOT SET') . "</p>";
echo "<p>Session userType: " . (isset($_SESSION['userType']) ? $_SESSION['userType'] : 'NOT SET') . "</p>";

// Test form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['test_update'])) {
    echo "<h2>Form Submission Test</h2>";
    echo "<p>POST data received:</p>";
    echo "<pre>" . print_r($_POST, true) . "</pre>";
    
    // Test the update query
    $AdminID = $_POST['AdminID'];
    $Email = $_POST['email'];
    $Phone = intval($_POST['number']);
    
    $sql = "UPDATE admin SET Email=?, Phone_no=? WHERE Admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $Email, $Phone, $AdminID);
    
    if ($stmt->execute() === TRUE) {
        echo "<p style='color: green;'>UPDATE SUCCESSFUL!</p>";
        echo "<p>Rows affected: " . $stmt->affected_rows . "</p>";
    } else {
        echo "<p style='color: red;'>UPDATE FAILED: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Show test form
echo "<h2>Test Form</h2>";
echo "<form method='post'>";
echo "<p>Email: <input type='email' name='email' value='test@example.com' required></p>";
echo "<p>Phone: <input type='tel' name='number' value='1234567890' required></p>";
echo "<p>AdminID: <input type='text' name='AdminID' value='1' required></p>";
echo "<p><button type='submit' name='test_update'>Test Update</button></p>";
echo "</form>";

mysqli_close($conn);
?> 