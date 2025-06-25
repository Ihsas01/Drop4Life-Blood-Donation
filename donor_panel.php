<?php
session_start();
if (!isset($_SESSION['userID']) || empty($_SESSION['userID']) || !isset($_SESSION['userType']) || $_SESSION['userType'] !== 'donor') {
    header('Location: donor_login.php');
    exit();
}
require 'header.php';
require 'includes/function.inc.php';
require 'includes/dbh.inc.php';
require 'CRUD/donor_manage_Appoint.php';

// Fetch donor info (if needed for display)
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Fetch appointment history
$sql = "SELECT *, hospital.H_Name, CONCAT(A_Time, ' ', A_meridiem) AS ATM FROM appointment LEFT JOIN hospital ON appointment.A_Hospital_id = hospital.Hospital_id WHERE A_Donor_id = " . $_SESSION['userID'];
$result = $con->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donor Panel</title>
  <link rel="stylesheet" href="css/donor_panel.css" />
  <script src="js/modern-ui.js" defer></script>
  <style>
    .panel-buttons { margin-bottom: 24px; }
    .panel-buttons button { margin-right: 12px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    .frame { background-color: azure; border-radius: 10px; width: 96%; margin: 32px auto; padding: 24px; }
    .row1 { margin-bottom: 18px; }
    .title { font-size: 2rem; font-weight: bold; }
    .head { font-size: 1.1rem; color: #333; }
  </style>
</head>
<body>
  <main class="frame">
    <section class="sec1">
      <div class="row1">
        <h2 class="title">Welcome Back, <?php echo htmlspecialchars($username); ?></h2>
        <div><h5 class="head"><?php echo htmlspecialchars($email); ?></h5></div>
        <div class="but1">
          <button class="editB hero-btn-modern" onclick="window.location='donor_edit.php'">Edit Profile</button>
        </div>
        <div class="but1">
          <button class="hero-btn-modern" onclick="window.location='donor_appointment.php'">Add Appointment</button>
        </div>
        <div class="but3">
          <button class="logout hero-btn-modern" onclick="window.location='logout.php'">Log Out</button>
        </div>
      </div>
    </section>
    <section class="sec2">
      <div class="container">
        <h4>Appointment History</h4>
        <div class="hyperL">
          <label>New</label>
          <a href="donor_appointment_history.php">History</a>
        </div>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $AppointmentID = $row['Appointment_id'];
            $AppointmentDate = $row['A_Date'];
            $AppointmentTime = $row['ATM'];
            $HospitalName = $row['H_Name'];
        ?>
            <div class="temp reveal-on-scroll visible">
              <div class="info">
                <label>Appointment #<?php echo htmlspecialchars($AppointmentID); ?></label>
                <hr>
                <label>Hospital: <?php echo htmlspecialchars($HospitalName); ?></label>
                <label>Date: <?php echo htmlspecialchars($AppointmentDate); ?></label>
                <label>Time: <?php echo htmlspecialchars($AppointmentTime); ?></label>
              </div>
              <form method="post">
                <input type="hidden" name="AppointmentID" value="<?php echo htmlspecialchars($AppointmentID); ?>">
                <button class="Cancelled hero-btn-modern" name="Cancel" type="submit" onclick="return confirm('Are You Sure ?')" aria-label="Cancel Appointment">
                  <i class="fa fa-times-circle"></i> Cancel
                </button>
              </form>
            </div>
        <?php
          }
        } else {
          echo '<div class="empty-message">No appointments found.</div>';
        }
        ?>
      </div>
    </section>
  </main>
</body>
<?php require 'footer.php'; ?>
</html> 