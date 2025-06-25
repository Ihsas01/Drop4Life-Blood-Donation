<?php
include 'header.php';
include 'CRUD/guest_appointment_process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Blood Donation Appointment</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      overflow-x: hidden;
      color: #333;
    }

    /* Animated Background */
    .animated-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #f5576c);
      background-size: 400% 400%;
      animation: gradientShift 20s ease infinite;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating Elements */
    .floating-elements {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      pointer-events: none;
    }

    .floating-element {
      position: absolute;
      width: 6px;
      height: 6px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-30px) rotate(180deg); opacity: 1; }
    }

    /* Main Container */
    .appointment-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
      position: relative;
      z-index: 1;
    }

    /* Hero Section */
    .hero-section {
      text-align: center;
      margin-bottom: 3rem;
      animation: slideInDown 1s ease-out;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, #fff, #f0f0f0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      text-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .hero-subtitle {
      font-size: 1.3rem;
      color: rgba(255, 255, 255, 0.9);
      font-weight: 400;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* Form Container */
    .form-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      animation: slideInUp 1s ease-out 0.2s both;
      position: relative;
      overflow: hidden;
    }

    .form-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
      background-size: 200% 100%;
      animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }

    .form-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: white;
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-subtitle {
      color: rgba(255, 255, 255, 0.8);
      text-align: center;
      margin-bottom: 3rem;
      font-size: 1.1rem;
    }

    /* Form Grid */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .form-section {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    /* Form Groups */
    .form-group {
      position: relative;
      opacity: 0;
      transform: translateY(30px);
      animation: slideInUp 0.6s ease-out forwards;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }
    .form-group:nth-child(6) { animation-delay: 0.6s; }
    .form-group:nth-child(7) { animation-delay: 0.7s; }
    .form-group:nth-child(8) { animation-delay: 0.8s; }
    .form-group:nth-child(9) { animation-delay: 0.9s; }
    .form-group:nth-child(10) { animation-delay: 1.0s; }
    .form-group:nth-child(11) { animation-delay: 1.1s; }
    .form-group:nth-child(12) { animation-delay: 1.2s; }
    .form-group:nth-child(13) { animation-delay: 1.3s; }
    .form-group:nth-child(14) { animation-delay: 1.4s; }

    .form-label {
      display: block;
      color: white;
      font-weight: 600;
      margin-bottom: 0.5rem;
      font-size: 0.95rem;
    }

    .form-input,
    .form-select {
      width: 100%;
      padding: 1rem 1rem 1rem 3rem;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 15px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .form-input::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .form-input:focus,
    .form-select:focus {
      outline: none;
      border-color: rgba(255, 255, 255, 0.5);
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.6);
      font-size: 1.2rem;
      transition: color 0.3s ease;
    }

    .form-input:focus + .input-icon,
    .form-select:focus + .input-icon {
      color: rgba(255, 255, 255, 0.9);
    }

    /* Radio Buttons */
    .radio-group {
      display: flex;
      gap: 2rem;
      margin-top: 0.5rem;
    }

    .radio-option {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: rgba(255, 255, 255, 0.9);
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .radio-option:hover {
      color: white;
    }

    .radio-option input[type="radio"] {
      width: 18px;
      height: 18px;
      accent-color: #667eea;
    }

    /* Date and Time Section */
    .datetime-section {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
      .datetime-section {
        grid-template-columns: 1fr;
      }
    }

    /* Info Message */
    .info-message {
      background: rgba(59, 130, 246, 0.2);
      border: 1px solid rgba(59, 130, 246, 0.3);
      border-radius: 15px;
      padding: 1rem;
      margin-bottom: 2rem;
      color: #3b82f6;
      font-size: 0.9rem;
      line-height: 1.5;
    }

    /* Form Actions */
    .form-actions {
      display: flex;
      gap: 1rem;
      justify-content: center;
      margin-top: 2rem;
    }

    .btn {
      padding: 1rem 2.5rem;
      border: none;
      border-radius: 15px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-secondary:hover {
      transform: translateY(-3px);
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* Feedback Message */
    .feedback-message {
      padding: 1rem;
      border-radius: 15px;
      margin-bottom: 1.5rem;
      font-weight: 500;
      text-align: center;
      animation: slideInUp 0.5s ease-out;
      display: none;
    }

    .feedback-success {
      background: rgba(76, 175, 80, 0.2);
      border: 1px solid rgba(76, 175, 80, 0.3);
      color: #4caf50;
    }

    .feedback-error {
      background: rgba(244, 67, 54, 0.2);
      border: 1px solid rgba(244, 67, 54, 0.3);
      color: #f44336;
    }

    /* Progress Indicator */
    .progress-indicator {
      display: flex;
      justify-content: center;
      margin-bottom: 2rem;
    }

    .progress-step {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(255, 255, 255, 0.6);
      font-weight: 600;
      margin: 0 0.5rem;
      transition: all 0.3s ease;
    }

    .progress-step.active {
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-color: rgba(255, 255, 255, 0.5);
      color: white;
      transform: scale(1.1);
    }

    /* Animations */
    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .form-container {
        padding: 2rem;
      }
      
      .form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      
      .appointment-container {
        padding: 1rem;
      }
      
      .form-actions {
        flex-direction: column;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .form-title {
        font-size: 2rem;
      }
      
      .radio-group {
        flex-direction: column;
        gap: 1rem;
      }
    }

    /* Loading Animation */
    .loading {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid rgba(255,255,255,.3);
      border-radius: 50%;
      border-top-color: #fff;
      animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="animated-bg"></div>
  
  <!-- Floating Elements -->
  <div class="floating-elements" id="floatingElements"></div>

  <div class="appointment-container">
    <!-- Hero Section -->
    <div class="hero-section">
      <h1 class="hero-title">Book Your Blood Donation</h1>
      <p class="hero-subtitle">Schedule your appointment to save lives. Every donation makes a difference in someone's life.</p>
    </div>

    <!-- Form Container -->
    <div class="form-container">
      <h2 class="form-title">Guest Appointment Form</h2>
      <p class="form-subtitle">Please fill in your details to schedule your blood donation appointment</p>

      <!-- Progress Indicator -->
      <div class="progress-indicator">
        <div class="progress-step active">1</div>
        <div class="progress-step">2</div>
        <div class="progress-step">3</div>
        <div class="progress-step">4</div>
      </div>

      <!-- Feedback Message -->
      <div id="form-feedback" class="feedback-message"></div>

      <form id="guest-appointment" method="post" action="CRUD/guest_appointment_process.php" autocomplete="off">
        <div class="form-grid">
          <!-- Personal Information Section -->
          <div class="form-section">
            <div class="form-group">
              <label class="form-label" for="people">Salutation</label>
              <i class="fas fa-user input-icon"></i>
              <select id="people" name="people" class="form-select" required>
                <option value="MR">MR.</option>
                <option value="MS">MS.</option>
                <option value="MRS">MRS.</option>
                <option value="MISS">MISS.</option>
                <option value="DR">DR.</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label" for="firstName">First Name</label>
              <i class="fas fa-user input-icon"></i>
              <input type="text" id="firstName" name="firstName" class="form-input" placeholder="Enter your first name" required />
            </div>

            <div class="form-group">
              <label class="form-label" for="lastName">Last Name</label>
              <i class="fas fa-user input-icon"></i>
              <input type="text" id="lastName" name="lastName" class="form-input" placeholder="Enter your last name" required />
            </div>

            <div class="form-group">
              <label class="form-label" for="Nic">NIC Number</label>
              <i class="fas fa-id-card input-icon"></i>
              <input type="text" id="Nic" name="Nic" class="form-input" placeholder="Enter your NIC number" required />
            </div>

            <div class="form-group">
              <label class="form-label" for="dob">Date of Birth</label>
              <i class="fas fa-calendar input-icon"></i>
              <input type="date" id="dob" name="dob" class="form-input" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" onchange="verifyAgeOnChange()" required />
            </div>
          </div>

          <!-- Medical Information Section -->
          <div class="form-section">
            <div class="form-group">
              <label class="form-label" for="bloodgroup">Blood Group</label>
              <i class="fas fa-tint input-icon"></i>
              <select name="bloodgroup" class="form-select" required>
                <option value="">Select blood group</option>
                <option value="A+">A+</option>
                <option value="O+">O+</option>
                <option value="B+">B+</option>
                <option value="AB+">AB+</option>
                <option value="A-">A-</option>
                <option value="O-">O-</option>
                <option value="B-">B-</option>
                <option value="AB-">AB-</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Gender</label>
              <div class="radio-group">
                <label class="radio-option">
                  <input type="radio" name="gender" value="Male" required />
                  <i class="fas fa-mars"></i> Male
                </label>
                <label class="radio-option">
                  <input type="radio" name="gender" value="Female" required />
                  <i class="fas fa-venus"></i> Female
                </label>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="Email">Email Address</label>
              <i class="fas fa-envelope input-icon"></i>
              <input type="email" id="email" name="Email" class="form-input" placeholder="Enter your email address" required />
            </div>

            <?php
            $hospitalQuery = "SELECT H_Name FROM hospital";
            $hospitalResult = mysqli_query($conn, $hospitalQuery);
            if ($hospitalResult) {
              echo '<div class="form-group">
                <label class="form-label" for="hname">Hospital</label>
                <i class="fas fa-hospital input-icon"></i>
                <select name="hname" class="form-select" required>
                  <option value="">Select hospital</option>';
              while ($row = mysqli_fetch_assoc($hospitalResult)) {
                echo '<option value="' . $row['H_Name'] . '">' . $row['H_Name'] . '</option>';
              }
              echo '</select>
              </div>';
            } else {
              echo "<div class='feedback-message feedback-error'>Error: " . mysqli_error($conn) . "</div>";
            }
            mysqli_close($conn);
            ?>
          </div>
        </div>

        <!-- Appointment Details -->
        <div class="form-group">
          <label class="form-label">Appointment Date & Time</label>
          <div class="datetime-section">
            <div>
              <i class="fas fa-calendar-day input-icon"></i>
              <input type="date" name="date" id="date" class="form-input" oninput="validateDate()" required />
            </div>
            <div>
              <i class="fas fa-clock input-icon"></i>
              <input type="text" id="time" name="time" class="form-input" placeholder="HH:MM" required />
            </div>
            <div>
              <i class="fas fa-sun input-icon"></i>
              <select id="meridiem" name="meridiem" class="form-select">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Donation History -->
        <div class="info-message">
          <i class="fas fa-info-circle"></i>
          Healthy individuals should be able to donate once every 120 days.
        </div>

        <div class="form-group">
          <label class="form-label" for="how-long">Days Since Last Donation</label>
          <i class="fas fa-history input-icon"></i>
          <input type="text" id="how-long" name="how-long" class="form-input" placeholder="Enter number of days" onmouseleave="validateAppointment()" required />
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
          <button type="reset" class="btn btn-secondary">
            <i class="fas fa-undo"></i> Reset Form
          </button>
          <button type="submit" name="submit" class="btn btn-primary" id="submitBtn">
            <span class="btn-text">
              <i class="fas fa-calendar-check"></i> Book Appointment
            </span>
            <span class="btn-loading" style="display: none;">
              <div class="loading"></div>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Create floating elements
    function createFloatingElements() {
      const container = document.getElementById('floatingElements');
      const elementCount = 25;
      
      for (let i = 0; i < elementCount; i++) {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.left = Math.random() * 100 + '%';
        element.style.animationDelay = Math.random() * 8 + 's';
        element.style.animationDuration = (Math.random() * 4 + 4) + 's';
        container.appendChild(element);
      }
    }

    // Form validation and feedback
    const form = document.getElementById('guest-appointment');
    const feedback = document.getElementById('form-feedback');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
      if (!form.checkValidity()) {
        e.preventDefault();
        showFeedback('Please fill all required fields correctly.', 'error');
      } else {
        showFeedback('Submitting your appointment...', 'success');
        
        // Show loading state
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';
        submitBtn.disabled = true;
        
        // Confirm submission
        if (!confirm('Ensure that all the provided data is accurate.')) {
          e.preventDefault();
          btnText.style.display = 'inline';
          btnLoading.style.display = 'none';
          submitBtn.disabled = false;
          hideFeedback();
        }
      }
    });

    form.addEventListener('reset', function() {
      hideFeedback();
    });

    function showFeedback(message, type) {
      feedback.textContent = message;
      feedback.className = `feedback-message feedback-${type}`;
      feedback.style.display = 'block';
    }

    function hideFeedback() {
      feedback.style.display = 'none';
    }

    // Add focus effects to form inputs
    document.querySelectorAll('.form-input, .form-select').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'translateY(-2px)';
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateY(0)';
      });
    });

    // Progress indicator
    function updateProgress() {
      const filledFields = document.querySelectorAll('.form-input:valid, .form-select:valid').length;
      const totalFields = document.querySelectorAll('.form-input, .form-select').length;
      const progress = Math.min(Math.floor((filledFields / totalFields) * 4), 4);
      
      document.querySelectorAll('.progress-step').forEach((step, index) => {
        if (index < progress) {
          step.classList.add('active');
        } else {
          step.classList.remove('active');
        }
      });
    }

    // Update progress on input change
    document.querySelectorAll('.form-input, .form-select').forEach(input => {
      input.addEventListener('input', updateProgress);
      input.addEventListener('change', updateProgress);
    });

    // Initialize on page load
    window.addEventListener('load', function() {
      createFloatingElements();
      updateProgress();
    });

    // Add hover effects to radio options
    document.querySelectorAll('.radio-option').forEach(option => {
      option.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
      });
      
      option.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
      });
    });
  </script>

  <?php include 'footer.php'; ?>
</body>
</html>