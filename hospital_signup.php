<?php
include 'header.php';
include 'CRUD/hospital_signup_process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Signup - Blood Donation System</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #667eea 100%);
      min-height: 100vh;
      overflow-x: hidden;
      color: #333;
      position: relative;
    }

    /* Animated Background */
    .animated-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -2;
      background: linear-gradient(45deg, #1e3c72, #2a5298, #667eea, #764ba2);
      background-size: 400% 400%;
      animation: gradientShift 25s ease infinite;
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
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 10s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-40px) rotate(180deg); opacity: 1; }
    }

    /* Main Container */
    .signup-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      position: relative;
      z-index: 1;
    }

    /* Signup Card */
    .signup-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 28px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
      max-width: 800px;
      width: 100%;
      padding: 3rem 2.5rem;
      animation: slideInUp 1s ease-out;
      position: relative;
      overflow: hidden;
    }

    .signup-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.08), transparent);
      animation: shimmer 4s ease-in-out infinite;
      z-index: -1;
    }

    @keyframes shimmer {
      0%, 100% { transform: translateX(-100%); }
      50% { transform: translateX(100%); }
    }

    /* Header Section */
    .signup-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .signup-title {
      font-size: 2.8rem;
      font-weight: 800;
      background: linear-gradient(135deg, #fff, #e0e7ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .signup-subtitle {
      color: rgba(255, 255, 255, 0.9);
      font-size: 1.1rem;
      font-weight: 400;
      max-width: 500px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .hospital-icon {
      width: 80px;
      height: 80px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      font-size: 2rem;
      color: white;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.3);
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    /* Form Styles */
    .signup-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .input-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }

    .input-group {
      position: relative;
      margin-bottom: 0.5rem;
    }

    .input-field {
      width: 100%;
      padding: 1rem 1rem 1rem 3rem;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 15px;
      font-size: 1rem;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      backdrop-filter: blur(10px);
    }

    .input-field::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .input-field:focus {
      outline: none;
      border-color: rgba(255, 255, 255, 0.8);
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.7);
      font-size: 1.1rem;
      transition: all 0.3s ease;
      z-index: 2;
    }

    .input-field:focus + .input-icon {
      color: rgba(255, 255, 255, 1);
      transform: translateY(-50%) scale(1.1);
    }

    .input-label {
      position: absolute;
      left: 3rem;
      top: 1rem;
      color: rgba(255, 255, 255, 0.7);
      font-size: 1rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      pointer-events: none;
      background: transparent;
      padding: 0 0.5rem;
    }

    .input-field:focus ~ .input-label,
    .input-field:not(:placeholder-shown) ~ .input-label {
      top: -0.5rem;
      left: 1rem;
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 1);
      font-weight: 600;
      background: rgba(30, 60, 114, 0.9);
      border-radius: 8px;
      padding: 0.2rem 0.5rem;
    }

    /* Password Toggle */
    .password-toggle {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: rgba(255, 255, 255, 0.7);
      cursor: pointer;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      padding: 0.5rem;
      border-radius: 50%;
    }

    .password-toggle:hover {
      color: rgba(255, 255, 255, 1);
      background: rgba(255, 255, 255, 0.1);
      transform: translateY(-50%) scale(1.1);
    }

    /* Checkbox Group */
    .checkbox-group {
      margin: 1rem 0 0.5rem 0;
      display: flex;
      align-items: center;
      padding: 1rem;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
    }

    .checkbox-group:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.2);
    }

    .checkbox-label {
      color: rgba(255, 255, 255, 0.9);
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
    }

    .checkbox-label input[type="checkbox"] {
      accent-color: #667eea;
      margin-right: 0.5rem;
      transform: scale(1.2);
      cursor: pointer;
    }

    .checkbox-label a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .checkbox-label a:hover {
      color: #764ba2;
      text-decoration: underline;
    }

    /* Form Actions */
    .form-actions {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
      margin-top: 2rem;
    }

    .btn {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      padding: 1rem 2rem;
      border-radius: 15px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
      min-width: 120px;
    }

    .btn.reset-btn {
      background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
    }

    .btn:active {
      transform: translateY(-1px);
    }

    /* Loading State */
    .loading {
      position: relative;
      pointer-events: none;
    }

    .loading::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 20px;
      height: 20px;
      margin: -10px 0 0 -10px;
      border: 2px solid transparent;
      border-top: 2px solid white;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Animations */
    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .signup-card {
        padding: 2rem 1.5rem;
        margin: 1rem;
      }

      .signup-title {
        font-size: 2rem;
      }

      .input-row {
        grid-template-columns: 1fr;
        gap: 1rem;
      }

      .form-actions {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }

    @media (max-width: 480px) {
      .signup-container {
        padding: 1rem;
      }

      .signup-card {
        padding: 1.5rem 1rem;
      }

      .signup-title {
        font-size: 1.8rem;
      }

      .hospital-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="animated-bg"></div>
  
  <!-- Floating Elements -->
  <div class="floating-elements" id="floatingElements"></div>

  <div class="signup-container">
    <div class="signup-card">
      <!-- Header Section -->
      <div class="signup-header">
        <div class="hospital-icon">
          <i class="fas fa-hospital"></i>
        </div>
        <h1 class="signup-title">Hospital Registration</h1>
        <p class="signup-subtitle">Join our network of healthcare providers and help save lives through blood donation management.</p>
      </div>

      <!-- Form Section -->
      <form class="signup-form" method="post" action="CRUD/hospital_signup_process.php" autocomplete="off" onsubmit="return validateForm()">
        <div class="input-group">
          <input class="input-field" id="name" type="text" name="name" required placeholder=" ">
          <i class="fas fa-hospital input-icon"></i>
          <label for="name" class="input-label">Hospital Name</label>
        </div>

        <div class="input-row">
          <div class="input-group">
            <input class="input-field" id="tel_no" type="tel" name="tel_no" maxlength="10" required placeholder=" ">
            <i class="fas fa-phone input-icon"></i>
            <label for="tel_no" class="input-label">Telephone Number</label>
          </div>
          <div class="input-group">
            <input class="input-field" id="email" type="email" name="email" required placeholder=" ">
            <i class="fas fa-envelope input-icon"></i>
            <label for="email" class="input-label">Email</label>
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <input class="input-field" id="line1" type="text" name="line1" required placeholder=" ">
            <i class="fas fa-map-marker-alt input-icon"></i>
            <label for="line1" class="input-label">Address Line 1</label>
          </div>
          <div class="input-group">
            <input class="input-field" id="city" type="text" name="city" required placeholder=" ">
            <i class="fas fa-city input-icon"></i>
            <label for="city" class="input-label">City</label>
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <input class="input-field" id="postal_code" type="text" name="postal_code" required placeholder=" ">
            <i class="fas fa-mail-bulk input-icon"></i>
            <label for="postal_code" class="input-label">Postal Code</label>
          </div>
          <div class="input-group">
            <input class="input-field" id="country" type="text" name="country" required placeholder=" ">
            <i class="fas fa-flag input-icon"></i>
            <label for="country" class="input-label">Country</label>
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <input class="input-field" id="password" type="password" name="password" required placeholder=" ">
            <i class="fas fa-lock input-icon"></i>
            <label for="password" class="input-label">Password</label>
            <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <div class="input-group">
            <input class="input-field" id="cPassword" type="password" name="cPassword" required placeholder=" ">
            <i class="fas fa-lock input-icon"></i>
            <label for="cPassword" class="input-label">Confirm Password</label>
            <button type="button" class="password-toggle" onclick="togglePassword('cPassword', this)">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        </div>

        <div class="checkbox-group">
          <label class="checkbox-label">
            <input type="checkbox" name="terms" id="terms" required>
            I agree to the Drop4Life <a href="terms.php">Terms</a> & <a href="privacy.php">Privacy Policy</a>
          </label>
        </div>

        <div class="form-actions">
          <button type="reset" class="btn reset-btn">Reset</button>
          <button type="submit" class="btn submit-btn">Register Hospital</button>
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
        element.style.top = Math.random() * 100 + '%';
        element.style.width = (Math.random() * 10 + 5) + 'px';
        element.style.height = element.style.width;
        element.style.animationDelay = Math.random() * 10 + 's';
        element.style.animationDuration = (Math.random() * 5 + 5) + 's';
        container.appendChild(element);
      }
    }

    // Password toggle functionality
    function togglePassword(id, btn) {
      const field = document.getElementById(id);
      const icon = btn.querySelector('i');
      
      if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        field.type = 'password';
        icon.classList.add('fa-eye');
        icon.classList.remove('fa-eye-slash');
      }
    }

    // Form submission with loading state
    const form = document.querySelector('.signup-form');
    const submitBtn = document.querySelector('.submit-btn');

    form.addEventListener('submit', function(e) {
      // Add loading state
      submitBtn.classList.add('loading');
      submitBtn.textContent = '';
      
      // Simulate loading (remove this in production)
      setTimeout(() => {
        submitBtn.classList.remove('loading');
        submitBtn.textContent = 'Register Hospital';
      }, 2000);
    });

    // Input focus effects
    document.querySelectorAll('.input-field').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentNode.classList.add('focused');
      });
      
      input.addEventListener('blur', function() {
        if (!this.value) {
          this.parentNode.classList.remove('focused');
        }
      });
      
      // Check if input has value on page load
      if (input.value) {
        input.parentNode.classList.add('focused');
      }
    });

    // Add hover effects to form elements
    document.querySelectorAll('.input-group').forEach(group => {
      group.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
      });
      
      group.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });

    // Animate form elements on load
    window.addEventListener('load', function() {
      createFloatingElements();
      
      const formElements = document.querySelectorAll('.input-row, .checkbox-group, .form-actions');
      formElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
          element.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
          element.style.opacity = '1';
          element.style.transform = 'translateY(0)';
        }, index * 200);
      });
    });

    // Password validation
    function validateForm() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("cPassword").value;
      
      if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }
      
      var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert("Password must contain at least 8 characters including one uppercase letter, one special character, and one digit.");
        return false;
      }
      
      var termsCheckbox = document.getElementById("terms");
      if (!termsCheckbox.checked) {
        alert("Please agree to the Terms & Privacy Policy.");
        return false;
      }
      
      return true;
    }
  </script>

  <?php include 'footer.php'; ?>
</body>
</html>
