<?php
require 'header.php';
require 'CRUD/hospital_manage_appoint.php';
require 'CRUD/hospital_manage_camp.php';
require 'CRUD/hospital_manage_Requests.php';
require 'includes/function.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Panel</title>
  <link rel="stylesheet" href="css/hospital_panel.css" />
  <script src="js/modern-ui.js" defer></script>
</head>

<body>
  <main class="hospital-panel-frame">
    <section class="hospital-panel-header reveal-on-scroll">
      <div class="hospital-panel-user">
        <?php echo "<h2 class='hospital-panel-title'>Welcome Back, {$_SESSION['username']}</h2>"; ?>
        <span class="hospital-panel-email"><?php echo $_SESSION['email']; ?></span>
      </div>
      <div class="hospital-panel-actions">
        <button class="hero-btn-modern edit-profile-btn" onclick="document.location='hospital_edit.php'">Edit Profile</button>
        <button class="hero-btn-modern add-camp-btn" onclick="document.location='add_camp.php'">Add a Camp</button>
        <button class="hero-btn-modern logout-btn" onclick="document.location='logout.php'">Log Out</button>
      </div>
    </section>
    <section class="hospital-panel-content">
      <div class="hospital-panel-cards">
        <!-- Appointments Card -->
        <div class="hospital-panel-card reveal-on-scroll">
          <div class="hospital-panel-card-header">
            <h3>Manage Appointments</h3>
            <div class="hospital-panel-card-links">
              <span class="badge-new">New</span>
              <a href="hospital_appointment_history.php" class="history-link">History</a>
            </div>
          </div>
          <div class="hospital-panel-card-body appointments-list">
            <?php if (!empty($appointments_error)): ?>
              <div class="error-message"><?php echo htmlspecialchars($appointments_error); ?></div>
            <?php endif; ?>
            <?php if (isset($result_appointments) && mysqli_num_rows($result_appointments) === 0): ?>
              <div class="empty-message">No appointments found.</div>
            <?php endif; ?>
            <?php if (isset($result_appointments)) while ($row = mysqli_fetch_assoc($result_appointments)) {
              $AppointmentID = $row['Appointment_id'];
              $AppointmentDate = $row['A_Date'];
              $AppointmentTime = $row['ATM'];
              $AGuestID = $row['A_Guest_id'];
              if ($row['A_Guest_id'] == null) {
                $UserName = $row['DonorName'];
                $UserNIC = $row['DonorNIC'];
                $UserBloodgroup = $row['DonorBloodgroup'];
                $UserEmail = $row['DonorEmail'];
              } else {
                $UserName = $row['GuestName'];
                $UserNIC = $row['GuestNIC'];
                $UserBloodgroup = $row['GuestBloodgroup'];
                $UserEmail = $row['GuestEmail'];
              }
            ?>
            <div class="appointment-card card-glass reveal-on-scroll">
              <div class="appointment-info">
                <span class="appointment-id">#<?php echo $AppointmentID ?></span>
                <span class="appointment-user"><?php echo $UserName ?></span>
                <span class="appointment-bloodgroup badge-bloodgroup"><?php echo $UserBloodgroup ?></span>
                <span class="appointment-nic"><?php echo $UserNIC ?></span>
                <span class="appointment-date"><?php echo $AppointmentDate ?></span>
                <span class="appointment-time"><?php echo $AppointmentTime ?></span>
                <span class="appointment-email"><?php echo $UserEmail ?></span>
              </div>
              <form method="post" class="appointment-actions">
                <input type="hidden" name="AppointmentID" value="<?php echo $AppointmentID ?>">
                <button class="hero-btn-modern approve-btn" name="Approved" type="submit">Approve</button>
                <button class="hero-btn-modern decline-btn" name="Declined" type="submit" onclick="return confirm('Are You Sure ?')">Decline</button>
              </form>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- Camps Card -->
        <div class="hospital-panel-card reveal-on-scroll">
          <div class="hospital-panel-card-header">
            <h3>Manage Camps</h3>
            <span class="badge-live">Live</span>
          </div>
          <div class="hospital-panel-card-body camps-list">
            <?php if (!empty($camps_error)): ?>
              <div class="error-message"><?php echo htmlspecialchars($camps_error); ?></div>
            <?php endif; ?>
            <?php if (isset($result_camp) && mysqli_num_rows($result_camp) === 0): ?>
              <div class="empty-message">No camps found.</div>
            <?php endif; ?>
            <?php if (isset($result_camp)) while ($row = mysqli_fetch_assoc($result_camp)) {
              $CampID = $row['Camp_id'];
              $CampName = $row['C_Name'];
              $LedBy = $row['Led_By'];
              $Address = $row['Address'];
              $Date = $row['C_Date'];
              $Time = $row['ATM'];
            ?>
            <div class="camp-card card-glass reveal-on-scroll">
              <div class="camp-info">
                <span class="camp-id">#<?php echo $CampID ?></span>
                <span class="camp-name"><?php echo $CampName ?></span>
                <span class="camp-leader"><?php echo $LedBy ?></span>
                <span class="camp-address"><?php echo $Address ?></span>
                <span class="camp-date"><?php echo $Date ?></span>
                <span class="camp-time"><?php echo $Time ?></span>
              </div>
              <div class="camp-actions">
                <button class="hero-btn-modern edit-btn" onclick="document.location='edit_camp.php?Camp_id=<?php echo $CampID ?>'">Edit</button>
                <form method="post" class="inline-form">
                  <input type="hidden" name="Camp_id" value="<?php echo $CampID ?>">
                  <button type="submit" class="hero-btn-modern cancel-btn" name="Cancel" onclick="return confirm('Are You Sure ?')">Cancel</button>
                </form>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- Requests Card -->
        <div class="hospital-panel-card reveal-on-scroll">
          <div class="hospital-panel-card-header">
            <h3>Manage Requests</h3>
            <span class="badge-live">Live</span>
          </div>
          <div class="hospital-panel-card-body requests-list">
            <?php if (!empty($requests_error)): ?>
              <div class="error-message"><?php echo htmlspecialchars($requests_error); ?></div>
            <?php endif; ?>
            <?php if (isset($result_requests) && mysqli_num_rows($result_requests) === 0): ?>
              <div class="empty-message">No requests found.</div>
            <?php endif; ?>
            <?php if (isset($result_requests)) while ($row = mysqli_fetch_assoc($result_requests)) {
              $EB_id = $row['EB_id'];
              $BG = $row['Blood_Group'];
            ?>
            <div class="request-card card-glass reveal-on-scroll">
              <div class="request-info">
                <span class="request-id">#<?php echo $EB_id ?></span>
                <span class="request-bloodgroup badge-bloodgroup"><?php echo $BG ?></span>
              </div>
              <form method="post" class="request-actions">
                <input type="hidden" name="EB_id" value="<?php echo $EB_id ?>">
                <button type="submit" class="hero-btn-modern cancel-btn" name="Caancel" onclick="return confirm('Are You Sure ?')">Cancel</button>
              </form>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- Emergency Request Card -->
        <div class="hospital-panel-card reveal-on-scroll">
          <div class="hospital-panel-card-header">
            <h3>Emergency Request</h3>
          </div>
          <div class="hospital-panel-card-body emergency-request-form">
            <form method="POST">
              <label for="bloodgroup">Blood Group:</label>
              <select name="bloodgroup" class="bg-select">
                <option value="A+">A+</option>
                <option value="O+">O+</option>
                <option value="B+">B+</option>
                <option value="AB+">AB+</option>
                <option value="A-">A-</option>
                <option value="O-">O-</option>
                <option value="B-">B-</option>
                <option value="AB-">AB-</option>
              </select>
              <button type="submit" class="hero-btn-modern post-btn" name="Post">Post</button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php
  require 'footer.php';
  ?>
  <style>
    .empty-message {
      color: #888;
      text-align: center;
      padding: 2rem 0;
      font-size: 1.1rem;
    }
    .error-message {
      color: #b30000;
      background: #ffe0e0;
      border: 1px solid #ffb3b3;
      text-align: center;
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 8px;
      font-weight: 600;
    }
  </style>
</body>

</html>