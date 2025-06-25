<?php
include 'header.php';
include 'CRUD/donor_appointment_process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment - Drop4Life</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(120deg, #f8fafc 0%, #e0e7ff 100%);
      min-height: 100vh;
      margin: 0;
      font-family: 'Poppins', Arial, sans-serif;
      overflow-x: hidden;
    }
    .modern-appointment-panel {
      max-width: 520px;
      margin: 48px auto 32px auto;
      background: rgba(255,255,255,0.97);
      border-radius: 32px;
      box-shadow: 0 8px 40px 0 rgba(31,38,135,0.13);
      padding: 40px 32px 32px 32px;
      position: relative;
      overflow: hidden;
      animation: fadeInPanel 1.2s cubic-bezier(.4,0,.2,1);
    }
    @keyframes fadeInPanel {
      from { opacity: 0; transform: translateY(60px) scale(0.98); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .modern-title {
      font-size: 2.1rem;
      font-weight: 800;
      color: #3b2f63;
      letter-spacing: 1px;
      margin-bottom: 18px;
      text-align: center;
      background: linear-gradient(90deg, #3b2f63 0%, #5f72bd 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .modern-form {
      display: flex;
      flex-direction: column;
      gap: 22px;
      margin-top: 18px;
    }
    .modern-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .modern-label {
      font-weight: 600;
      color: #5f72bd;
      font-size: 1.08rem;
      margin-bottom: 2px;
    }
    .modern-input, .modern-select {
      padding: 12px 16px;
      border-radius: 18px;
      border: 1.5px solid #e0e7ff;
      font-size: 1.08rem;
      background: rgba(255,255,255,0.85);
      transition: border 0.3s, box-shadow 0.3s;
      outline: none;
      box-shadow: 0 2px 8px 0 rgba(95,93,226,0.04);
    }
    .modern-input:focus, .modern-select:focus {
      border: 1.5px solid #5f72bd;
      box-shadow: 0 4px 16px 0 rgba(95,93,226,0.10);
    }
    .modern-select {
      cursor: pointer;
    }
    .modern-btn-row {
      display: flex;
      gap: 16px;
      justify-content: flex-end;
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
    .modern-select option {
      color: #3b2f63;
    }
    .modern-note {
      font-size: 0.98rem;
      color: #888;
      margin-top: 8px;
      text-align: center;
    }
    @media (max-width: 600px) {
      .modern-appointment-panel { padding: 16px 2vw 24px 2vw; }
      .modern-title { font-size: 1.2rem; }
      .modern-btn { padding: 10px 16px; font-size: 1rem; }
    }
  </style>
  <script>
    // Animate form fields on load
    document.addEventListener('DOMContentLoaded', function() {
      const fields = document.querySelectorAll('.modern-group');
      fields.forEach((field, i) => {
        field.style.opacity = 0;
        field.style.transform = 'translateY(30px)';
        setTimeout(() => {
          field.style.transition = 'all 0.7s cubic-bezier(.4,0,.2,1)';
          field.style.opacity = 1;
          field.style.transform = 'translateY(0)';
        }, 120 * i);
      });
    });
  </script>
</head>
<body>
  <main>
    <div class="modern-appointment-panel">
      <div class="modern-title"><i class="fas fa-calendar-plus"></i> Book a Blood Donation Appointment</div>
      <form id="doner-appointment" method="post" class="modern-form">
        <div class="modern-group">
          <label class="modern-label" for="how-long">How long since the last donation (Days):</label>
          <input class="modern-input" type="number" min="0" id="how-long" name="how-long" required />
        </div>
        <div class="modern-group">
          <label class="modern-label" for="hname">Hospital:</label>
          <select class="modern-select" name="hname" id="hname" required>
            <option value="" disabled selected>Select Hospital</option>
            <?php
            $hospitalQuery = "SELECT H_Name FROM hospital";
            $hospitalResult = mysqli_query($conn, $hospitalQuery);
            if ($hospitalResult) {
              while ($row = mysqli_fetch_assoc($hospitalResult)) {
                echo '<option value="' . htmlspecialchars($row['H_Name']) . '">' . htmlspecialchars($row['H_Name']) . '</option>';
              }
            }
            ?>
          </select>
        </div>
        <div class="modern-group">
          <label class="modern-label" for="date">Date:</label>
          <input class="modern-input" type="date" id="date" name="date" required>
        </div>
        <div class="modern-group" style="display: flex; gap: 12px;">
          <div style="flex:2;">
            <label class="modern-label" for="time">Time:</label>
            <input class="modern-input" type="time" id="time" name="time" required>
          </div>
          <div style="flex:1;">
            <label class="modern-label" for="meridiem">Meridiem:</label>
            <select class="modern-select" id="meridiem" name="meridiem" required>
              <option value="AM">AM</option>
              <option value="PM">PM</option>
            </select>
          </div>
        </div>
        <div class="modern-btn-row">
          <button class="modern-btn" type="reset"><i class="fas fa-undo"></i> Reset</button>
          <button class="modern-btn" type="submit" onclick="return confirm('Ensure that all the provided data is accurate. Due to security reasons, editing cannot be Done.')"><i class="fas fa-check"></i> Book Appointment</button>
        </div>
        <div class="modern-note"><i class="fas fa-info-circle"></i> Please double-check your details before submitting. Appointments cannot be edited after booking.</div>
      </form>
    </div>
  </main>
</body>
<?php include 'footer.php'; ?>
</html>