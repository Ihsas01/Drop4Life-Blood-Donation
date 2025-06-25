<?php
require 'header.php';

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'donor') {
    header('Location: donor_login.php');
    exit();
}

require 'CRUD/donor_manage_Appoint.php';
require 'includes/function.inc.php';

// Ensure donor session variables are set
if (isset($_SESSION['userType']) && $_SESSION['userType'] === 'donor') {
    if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
        require_once 'includes/dbh.inc.php';
        $donorId = $_SESSION['userID'];
        $result = mysqli_query($con, "SELECT Salutation, F_name, L_name, Email FROM donor WHERE Donor_id='$donorId'");
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $row['Salutation'] . ' ' . $row['F_name'] . ' ' . $row['L_name'];
            $_SESSION['email'] = $row['Email'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/donor_panel.css" />
  <script src="js/modern-ui.js" defer></script>
  <title>Donor Panel</title>
</head>

<body>
  <main class="frame">
    <section class="sec1">
      <div class="row1">
        <?php
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Donor';
        echo '<h2 class="title">Welcome Back, ' . htmlspecialchars($username) . '</h2>';
        ?>
        <div>
          <?php 
          $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
          echo '<h5 class="head">' . htmlspecialchars($email) . '</h5>'; 
          ?>
        </div>
        <div class="but1">
          <button class="editB hero-btn-modern" onclick="document.location='donor_edit.php'" aria-label="Edit Profile">
            <i class="fa fa-user-edit"></i> Edit Profile
          </button>
        </div>
        <div class="but3">
          <button class="logout hero-btn-modern" name="logout" onclick="document.location='logout.php'" aria-label="Log Out">
            <i class="fa fa-sign-out-alt"></i> Log Out
          </button>
        </div>
      </div>
    </section>
    <section class="sec2">
      <div class="container">
        <h4>Manage Appointments</h4>
        <div class="hyperL">
          <label>New</label>
          <a href="donor_appointment_history.php">History</a>
        </div>
        <?php
        while ($row = mysqli_fetch_assoc($result_appointments)) {
          $AppointmentID = $row['Appointment_id'];
          $AppointmentDate = $row['A_Date'];
          $AppointmentTime = $row['ATM'];
          $HospitalName = $row['HospitalName'];
        ?>
          <div class="temp reveal-on-scroll">
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
        ?>
      </div>
    </section>
  </main>
</body>

</html>
<?php
require 'footer.php';
?>