<?php
require 'header.php';
include 'CRUD/donor_signup_process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donor Signup</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
      min-height: 100vh;
      overflow-x: hidden;
      color: #333;
      position: relative;
    }
    .animated-bg {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;
      background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #f5576c);
      background-size: 400% 400%; animation: gradientShift 20s ease infinite;
    }
    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .floating-elements {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none;
    }
    .floating-element {
      position: absolute; background: rgba(255,255,255,0.1); border-radius: 50%; animation: float 8s ease-in-out infinite;
    }
    @keyframes float {
      0%,100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-30px) rotate(180deg); opacity: 1; }
    }
    .signup-container {
      min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; position: relative; z-index: 1;
    }
    .signup-card {
      background: rgba(255,255,255,0.12); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2);
      border-radius: 28px; box-shadow: 0 25px 50px rgba(0,0,0,0.18); max-width: 700px; width: 100%; padding: 3rem 2.5rem;
      animation: slideInUp 1s ease-out; position: relative;
    }
    .signup-card::before {
      content: '';
      position: absolute; top: 0; left: 0; right: 0; bottom: 0;
      background: linear-gradient(45deg, transparent, rgba(255,255,255,0.08), transparent);
      animation: shimmer 3s ease-in-out infinite; z-index: -1;
    }
    @keyframes shimmer {
      0%,100% { transform: translateX(-100%); }
      50% { transform: translateX(100%); }
    }
    .signup-title {
      text-align: center; font-size: 2.5rem; font-weight: 800; color: #fff;
      margin-bottom: 2rem; letter-spacing: 1px; text-shadow: 0 2px 10px rgba(0,0,0,0.18);
      background: linear-gradient(90deg, #fff, #f093fb 80%);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .signup-form {
      display: flex; flex-direction: column; gap: 1.5rem;
    }
    .input-row {
      display: flex; gap: 1.5rem;
    }
    @media (max-width: 700px) { .input-row { flex-direction: column; gap: 0.5rem; } .signup-card { padding: 2rem 0.5rem; } }
    .input-group, .radio-group, .checkbox-group {
      position: relative; flex: 1; display: flex; flex-direction: column; margin-bottom: 0.5rem;
    }
    .input-group input, .input-group select {
      width: 100%; padding: 1rem 1rem 1rem 3rem; border: 2px solid #e1e5e9; border-radius: 12px;
      font-size: 1rem; background: white; transition: all 0.3s ease; position: relative;
    }
    .input-group input:focus, .input-group select:focus {
      outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); transform: translateY(-2px);
    }
    .input-group label {
      position: absolute; left: 3rem; top: 1rem; color: #999; font-size: 1rem; transition: all 0.3s ease;
      pointer-events: none; background: white; padding: 0 0.5rem;
    }
    .input-group input:focus ~ label,
    .input-group input:not(:placeholder-shown) ~ label,
    .input-group select:focus ~ label,
    .input-group select:not([value=""]) ~ label {
      top: -0.5rem; left: 1rem; font-size: 0.8rem; color: #667eea; font-weight: 600;
    }
    .input-group .input-icon {
      position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #999; font-size: 1.1rem; z-index: 2;
    }
    .input-group input:focus + .input-icon, .input-group select:focus + .input-icon {
      color: #667eea;
    }
    .radio-group {
      display: flex; flex-direction: column; justify-content: center; gap: 0.5rem; margin-top: 0.5rem;
    }
    .radio-label { font-weight: 600; color: #667eea; margin-bottom: 0.5rem; }
    .radio-group label { position: static; left: unset; top: unset; color: #333; font-size: 1rem; background: none; padding: 0; }
    .radio-group input[type="radio"] {
      accent-color: #667eea; margin-right: 0.5rem; transform: scale(1.2);
    }
    .checkbox-group {
      margin: 1rem 0 0.5rem 0; display: flex; align-items: center;
    }
    .checkbox-label {
      color: #666; font-size: 1rem; display: flex; align-items: center; gap: 0.5rem;
    }
    .checkbox-label input[type="checkbox"] {
      accent-color: #667eea; margin-right: 0.5rem; transform: scale(1.2);
    }
    .form-actions {
      display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1rem;
    }
    .btn {
      background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; padding: 1rem 2rem;
      border-radius: 12px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; position: relative; overflow: hidden;
    }
    .btn.reset-btn {
      background: linear-gradient(135deg, #f093fb, #f5576c); color: #fff;
    }
    .btn:hover {
      transform: translateY(-3px); box-shadow: 0 15px 30px rgba(102,126,234,0.2);
    }
    .btn:active { transform: translateY(-1px); }
    .btn::before {
      content: '';
      position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s ease;
    }
    .btn:hover::before { left: 100%; }
    .input-group input[type="password"] ~ .password-toggle {
      position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #999; cursor: pointer; font-size: 1.1rem; transition: all 0.3s ease;
    }
    .input-group input[type="password"] ~ .password-toggle:hover { color: #667eea; }
    @keyframes slideInUp {
      from { opacity: 0; transform: translateY(50px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 480px) {
      .signup-container { padding: 1rem; }
      .signup-card { padding: 1rem 0.2rem; }
      .signup-title { font-size: 1.5rem; }
    }
  </style>
</head>
<body>
  <div class="animated-bg"></div>
  <div class="floating-elements" id="floatingElements"></div>
  <div class="signup-container">
    <div class="signup-card">
      <h1 class="signup-title">Create New Account</h1>
      <form id="create-new-account" class="signup-form" method="post" action="CRUD/donor_signup_process.php" autocomplete="off" onsubmit="return validateForm()">
        <div class="input-row">
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-user-tag"></i></span>
            <select id="salutation" name="sal" required>
              <option value="" disabled selected>Select</option>
              <option value="MR">Mr.</option>
              <option value="MS">Ms.</option>
              <option value="MRS">Mrs.</option>
            </select>
            <label for="salutation">Salutation</label>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-user"></i></span>
            <input type="text" id="firstName" name="fname" required placeholder=" ">
            <label for="firstName">First Name</label>
          </div>
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-user"></i></span>
            <input type="text" id="lastName" name="lname" required placeholder=" ">
            <label for="lastName">Last Name</label>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-id-card"></i></span>
            <input type="text" id="nic" name="nic" required placeholder=" ">
            <label for="nic">NIC</label>
          </div>
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
            <input type="date" id="dob" name="dob" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" required placeholder=" ">
            <label for="dob">Date of Birth</label>
          </div>
        </div>
        <div class="input-row">
          <div class="radio-group">
            <span class="radio-label">Gender</span>
            <label><input type="radio" name="gender" value="MALE" required> Male</label>
            <label><input type="radio" name="gender" value="FEMALE"> Female</label>
          </div>
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-phone"></i></span>
            <input type="tel" id="phoneNumber" name="phone" placeholder="+9477xxxxxxxx" required>
            <label for="phoneNumber">Phone Number</label>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-tint"></i></span>
            <select id="bloodGroup" name="blood-group" required>
              <option value="" disabled selected>Select</option>
              <option value="A+">A+</option>
              <option value="O+">O+</option>
              <option value="B+">B+</option>
              <option value="AB+">AB+</option>
              <option value="A-">A-</option>
              <option value="O-">O-</option>
              <option value="B-">B-</option>
              <option value="AB-">AB-</option>
            </select>
            <label for="bloodGroup">Blood Group</label>
          </div>
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-envelope"></i></span>
            <input type="email" id="email" name="email" required placeholder=" ">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
            <input type="text" id="addressLine1" name="line1" required placeholder=" ">
            <label for="addressLine1">Address Line 1</label>
          </div>
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-city"></i></span>
            <input type="text" id="city" name="city" required placeholder=" ">
            <label for="city">City</label>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-mail-bulk"></i></span>
            <input type="text" id="postalCode" name="postal_code" required placeholder=" ">
            <label for="postalCode">Postal Code</label>
          </div>
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-flag"></i></span>
            <input type="text" id="country" name="country" required placeholder=" ">
            <label for="country">Country</label>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-lock"></i></span>
            <input type="password" id="password" name="password" required placeholder=" ">
            <label for="password">Password</label>
            <button type="button" class="password-toggle" onclick="togglePassword('password', this)"><i class="fas fa-eye"></i></button>
          </div>
          <div class="input-group">
            <span class="input-icon"><i class="fas fa-lock"></i></span>
            <input type="password" id="confirmPassword" name="cPassword" required placeholder=" ">
            <label for="confirmPassword">Confirm Password</label>
            <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword', this)"><i class="fas fa-eye"></i></button>
          </div>
        </div>
        <div class="checkbox-group">
          <label class="checkbox-label">
            <input type="checkbox" id="terms" name="terms" required>
            I agree to the Drop4Life <a href="terms.php">Terms</a> & <a href="privacy.php">Privacy policy</a>
          </label>
        </div>
        <div class="form-actions">
          <button type="reset" class="btn reset-btn">Reset</button>
          <button type="submit" class="btn submit-btn">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    // Floating elements
    function createFloatingElements() {
      const container = document.getElementById('floatingElements');
      const elementCount = 20;
      for (let i = 0; i < elementCount; i++) {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.left = Math.random() * 100 + '%';
        element.style.top = Math.random() * 100 + '%';
        element.style.width = (Math.random() * 8 + 4) + 'px';
        element.style.height = element.style.width;
        element.style.animationDelay = Math.random() * 8 + 's';
        element.style.animationDuration = (Math.random() * 4 + 4) + 's';
        container.appendChild(element);
      }
    }
    // Password toggle
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
    // Floating label animation for input and select (not radio/checkbox)
    document.querySelectorAll('.input-group input, .input-group select').forEach(input => {
      if (input.type === 'radio' || input.type === 'checkbox') return;
      input.addEventListener('focus', function() {
        this.parentNode.classList.add('focused');
      });
      input.addEventListener('blur', function() {
        if (!this.value) this.parentNode.classList.remove('focused');
      });
      if (input.tagName === 'SELECT') {
        input.addEventListener('change', function() {
          if (this.value) this.parentNode.classList.add('focused');
          else this.parentNode.classList.remove('focused');
        });
        if (input.value) input.parentNode.classList.add('focused');
      } else {
        if (input.value) input.parentNode.classList.add('focused');
      }
    });
    // Animate form elements on load
    window.addEventListener('load', function() {
      createFloatingElements();
      const formElements = document.querySelectorAll('.input-row, .checkbox-group, .form-actions');
      formElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        setTimeout(() => {
          element.style.transition = 'all 0.6s cubic-bezier(0.4,0,0.2,1)';
          element.style.opacity = '1';
          element.style.transform = 'translateY(0)';
        }, index * 180);
      });
    });
    // Password validation
    function validateForm() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
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
  <?php require 'footer.php'; ?>
</body>
</html>