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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(120deg, #f8fafc 0%, #e0e7ff 100%);
      min-height: 100vh;
      margin: 0;
      font-family: 'Poppins', Arial, sans-serif;
      overflow-x: hidden;
    }
    .modern-panel {
      max-width: 900px;
      margin: 48px auto 32px auto;
      background: rgba(255,255,255,0.95);
      border-radius: 32px;
      box-shadow: 0 8px 40px 0 rgba(31,38,135,0.13);
      padding: 40px 32px 48px 32px;
      position: relative;
      overflow: hidden;
      animation: fadeInPanel 1.2s cubic-bezier(.4,0,.2,1);
    }
    @keyframes fadeInPanel {
      from { opacity: 0; transform: translateY(60px) scale(0.98); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .modern-header-row {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 8px;
      margin-bottom: 32px;
    }
    .modern-title {
      font-size: 2.3rem;
      font-weight: 800;
      color: #3b2f63;
      letter-spacing: 1px;
      margin-bottom: 2px;
      text-shadow: 0 2px 12px rgba(59,47,99,0.08);
      background: linear-gradient(90deg, #3b2f63 0%, #5f72bd 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .modern-email {
      font-size: 1.1rem;
      color: #5f72bd;
      margin-bottom: 8px;
      font-weight: 500;
    }
    .modern-actions {
      display: flex;
      gap: 18px;
      margin-top: 10px;
    }
    .modern-btn {
      padding: 12px 32px;
      font-size: 1.1rem;
      font-weight: 600;
      border: none;
      border-radius: 32px;
      background: linear-gradient(90deg, #5f72bd 0%, #9f5de2 100%);
      color: #fff;
      cursor: pointer;
      box-shadow: 0 4px 16px rgba(95,93,226,0.13);
      transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
      position: relative;
      overflow: hidden;
      outline: none;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .modern-btn i {
      font-size: 1.2em;
    }
    .modern-btn:hover, .modern-btn:focus {
      background: linear-gradient(90deg, #9f5de2 0%, #5f72bd 100%);
      transform: scale(1.06) translateY(-2px);
      box-shadow: 0 8px 32px rgba(95,93,226,0.18);
    }
    .modern-section-title {
      font-size: 1.5rem;
      color: #3b2f63;
      font-weight: 700;
      margin-bottom: 18px;
      margin-top: 32px;
      letter-spacing: 0.5px;
    }
    .modern-table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(255,255,255,0.98);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(95,93,226,0.08);
      margin-bottom: 18px;
      animation: fadeInUp 1.1s cubic-bezier(.4,0,.2,1);
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .modern-table th, .modern-table td {
      padding: 14px 16px;
      text-align: left;
      border-bottom: 1px solid #e0e7ff;
      font-size: 1.08rem;
    }
    .modern-table th {
      background: linear-gradient(90deg, #e0e7ff 0%, #f8fafc 100%);
      color: #3b2f63;
      font-weight: 700;
      letter-spacing: 0.5px;
      border-top: none;
    }
    .modern-table tr:last-child td {
      border-bottom: none;
    }
    .modern-table tr {
      transition: background 0.2s;
    }
    .modern-table tr:hover {
      background: #f3f0fa;
    }
    .modern-cancel-btn {
      padding: 8px 22px;
      font-size: 1rem;
      font-weight: 600;
      border: none;
      border-radius: 24px;
      background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
      color: #fff;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(255,88,88,0.13);
      transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
      outline: none;
    }
    .modern-cancel-btn:hover, .modern-cancel-btn:focus {
      background: linear-gradient(90deg, #f09819 0%, #ff5858 100%);
      transform: scale(1.05) translateY(-1px);
      box-shadow: 0 6px 24px rgba(255,88,88,0.18);
    }
    .modern-empty {
      text-align: center;
      color: #aaa;
      font-size: 1.1rem;
      margin: 32px 0 16px 0;
      letter-spacing: 0.5px;
    }
    @media (max-width: 700px) {
      .modern-panel { padding: 18px 4vw 32px 4vw; }
      .modern-header-row { gap: 4px; }
      .modern-title { font-size: 1.4rem; }
      .modern-section-title { font-size: 1.1rem; }
      .modern-table th, .modern-table td { padding: 10px 6px; font-size: 0.98rem; }
      .modern-actions { flex-direction: column; gap: 10px; }
    }
  </style>
  <script>
    // Animate table rows on scroll
    document.addEventListener('DOMContentLoaded', function() {
      const rows = document.querySelectorAll('.modern-table tbody tr');
      rows.forEach((row, i) => {
        row.style.opacity = 0;
        row.style.transform = 'translateY(30px)';
        setTimeout(() => {
          row.style.transition = 'all 0.7s cubic-bezier(.4,0,.2,1)';
          row.style.opacity = 1;
          row.style.transform = 'translateY(0)';
        }, 120 * i);
      });
    });
  </script>
</head>
<body>
  <main class="modern-panel">
    <div class="modern-header-row">
      <div class="modern-title"><i class="fas fa-user-circle"></i> Welcome Back, <?php echo htmlspecialchars($username); ?></div>
      <div class="modern-email"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($email); ?></div>
      <div class="modern-actions">
        <button class="modern-btn" onclick="window.location='donor_edit.php'"><i class="fas fa-user-edit"></i> Edit Profile</button>
        <button class="modern-btn" onclick="window.location='donor_appointment.php'"><i class="fas fa-calendar-plus"></i> Add Appointment</button>
        <button class="modern-btn" onclick="window.location='logout.php'"><i class="fas fa-sign-out-alt"></i> Log Out</button>
      </div>
    </div>
    <div class="modern-section-title"><i class="fas fa-history"></i> Appointment History</div>
    <table class="modern-table">
      <thead>
        <tr>
          <th>Appointment ID</th>
          <th>Date</th>
          <th>Time</th>
          <th>Hospital Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $AppointmentID = $row['Appointment_id'];
          $AppointmentDate = $row['A_Date'];
          $AppointmentTime = $row['ATM'];
          $HospitalName = $row['H_Name'];
          $Status = $row['Status'] ? 'Booked' : 'Cancelled';
          echo '<tr>';
          echo '<td>' . htmlspecialchars($AppointmentID) . '</td>';
          echo '<td>' . htmlspecialchars($AppointmentDate) . '</td>';
          echo '<td>' . htmlspecialchars($AppointmentTime) . '</td>';
          echo '<td>' . htmlspecialchars($HospitalName) . '</td>';
          echo '<td>' . $Status . '</td>';
          echo '<td>';
          if ($Status === 'Booked') {
            echo '<form method="post" style="display:inline;">';
            echo '<input type="hidden" name="AppointmentID" value="' . htmlspecialchars($AppointmentID) . '">';
            echo '<button class="modern-cancel-btn" name="Cancel" type="submit" onclick="return confirm(\'Are You Sure ?\')" aria-label="Cancel Appointment">';
            echo '<i class="fa fa-times-circle"></i> Cancel';
            echo '</button>';
            echo '</form>';
          } else {
            echo '<span style="color:#aaa;">-</span>';
          }
          echo '</td>';
          echo '</tr>';
        }
      } else {
        echo '<tr><td colspan="6" class="modern-empty">No appointments found.</td></tr>';
      }
      ?>
      </tbody>
    </table>
  </main>
</body>
<?php require 'footer.php'; ?>
</html> 