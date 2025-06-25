<?php
include 'header.php';
include 'includes/function.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];
  donorLogin($con, $email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donor Login - Blood Donation System</title>
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
      background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
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
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-30px) rotate(180deg); opacity: 1; }
    }

    /* Main Container */
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      position: relative;
      z-index: 1;
    }

    /* Login Card */
    .login-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      overflow: hidden;
      width: 100%;
      max-width: 1000px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
      animation: slideInUp 1s ease-out;
      position: relative;
    }

    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      animation: shimmer 3s ease-in-out infinite;
      z-index: -1;
    }

    @keyframes shimmer {
      0%, 100% { transform: translateX(-100%); }
      50% { transform: translateX(100%); }
    }

    /* Hero Section */
    .login-hero {
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
      padding: 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('images/picture.jpg') center/cover;
      opacity: 0.3;
      z-index: -1;
    }

    .hero-content {
      position: relative;
      z-index: 1;
    }

    .hero-icon {
      width: 80px;
      height: 80px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 2rem;
      font-size: 2rem;
      color: white;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .hero-title {
      font-size: 2.5rem;
      font-weight: 800;
      color: white;
      margin-bottom: 1rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
      color: rgba(255, 255, 255, 0.9);
      font-size: 1.1rem;
      line-height: 1.6;
      max-width: 300px;
    }

    .hero-stats {
      display: flex;
      gap: 2rem;
      margin-top: 2rem;
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      font-size: 1.5rem;
      font-weight: 700;
      color: white;
      display: block;
    }

    .stat-label {
      font-size: 0.9rem;
      color: rgba(255, 255, 255, 0.8);
    }

    /* Form Section */
    .login-form-section {
      padding: 3rem;
      background: rgba(255, 255, 255, 0.95);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .welcome-title {
      font-size: 2rem;
      font-weight: 700;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
      color: #666;
      font-size: 1rem;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .input-group {
      position: relative;
      margin-bottom: 1rem;
    }

    .input-field {
      width: 100%;
      padding: 1rem 1rem 1rem 3rem;
      border: 2px solid #e1e5e9;
      border-radius: 12px;
      font-size: 1rem;
      background: white;
      transition: all 0.3s ease;
      position: relative;
    }

    .input-field:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      transform: translateY(-2px);
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      z-index: 2;
    }

    .input-field:focus + .input-icon {
      color: #667eea;
    }

    .input-label {
      position: absolute;
      left: 3rem;
      top: 1rem;
      color: #999;
      font-size: 1rem;
      transition: all 0.3s ease;
      pointer-events: none;
      background: white;
      padding: 0 0.5rem;
    }

    .input-field:focus ~ .input-label,
    .input-field:not(:placeholder-shown) ~ .input-label {
      top: -0.5rem;
      left: 1rem;
      font-size: 0.8rem;
      color: #667eea;
      font-weight: 600;
    }

    .password-toggle {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #999;
      cursor: pointer;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }

    .password-toggle:hover {
      color: #667eea;
    }

    .login-btn {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      padding: 1rem 2rem;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      margin-top: 1rem;
    }

    .login-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .login-btn:hover::before {
      left: 100%;
    }

    .login-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
    }

    .login-btn:active {
      transform: translateY(-1px);
    }

    /* Links Section */
    .links-section {
      margin-top: 2rem;
      text-align: center;
    }

    .links {
      margin-bottom: 1rem;
      color: #666;
    }

    .signup-btn {
      background: none;
      border: none;
      color: #667eea;
      font-weight: 600;
      cursor: pointer;
      text-decoration: underline;
      transition: all 0.3s ease;
    }

    .signup-btn:hover {
      color: #764ba2;
      transform: translateY(-1px);
    }

    .alt-login {
      font-size: 0.9rem;
    }

    .alt-login a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .alt-login a:hover {
      color: #764ba2;
      text-decoration: underline;
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
      .login-card {
        grid-template-columns: 1fr;
        max-width: 400px;
      }

      .login-hero {
        padding: 2rem;
      }

      .hero-title {
        font-size: 2rem;
      }

      .hero-stats {
        gap: 1rem;
      }

      .login-form-section {
        padding: 2rem;
      }

      .welcome-title {
        font-size: 1.5rem;
      }
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 1rem;
      }

      .login-hero {
        padding: 1.5rem;
      }

      .login-form-section {
        padding: 1.5rem;
      }

      .hero-stats {
        flex-direction: column;
        gap: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="animated-bg"></div>
  
  <!-- Floating Elements -->
  <div class="floating-elements" id="floatingElements"></div>

  <div class="login-container">
    <div class="login-card">
      <!-- Hero Section -->
      <div class="login-hero">
        <div class="hero-bg"></div>
        <div class="hero-content">
          <div class="hero-icon">
            <i class="fas fa-heart"></i>
          </div>
          <h1 class="hero-title">Welcome Back!</h1>
          <p class="hero-subtitle">Continue your journey of saving lives through blood donation. Your contribution makes a difference.</p>
          <div class="hero-stats">
            <div class="stat-item">
              <span class="stat-number">1000+</span>
              <span class="stat-label">Lives Saved</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">500+</span>
              <span class="stat-label">Donors</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Form Section -->
      <div class="login-form-section">
        <div class="form-header">
          <h2 class="welcome-title">Donor Login</h2>
          <p class="welcome-subtitle">Sign in to access your donor dashboard</p>
        </div>

        <form method="POST" class="login-form" autocomplete="off" id="loginForm">
          <div class="input-group">
            <input type="email" name="email" id="email" class="input-field" placeholder=" " required>
            <i class="fas fa-envelope input-icon"></i>
            <label for="email" class="input-label">Email Address</label>
          </div>

          <div class="input-group">
            <input type="password" name="password" id="password" class="input-field" placeholder=" " required>
            <i class="fas fa-lock input-icon"></i>
            <label for="password" class="input-label">Password</label>
            <button type="button" class="password-toggle" id="passwordToggle">
              <i class="fas fa-eye"></i>
            </button>
          </div>

          <button type="submit" class="login-btn" id="loginBtn">
            <span class="btn-text">Sign In</span>
          </button>
        </form>

        <div class="links-section">
          <div class="links">
            <span>Don't have an account? </span>
            <button class="signup-btn" onclick="window.location='donor_signup.php'">Sign Up</button>
          </div>
          <div class="links alt-login">
            <span>Are you a Hospital Admin? <a href="hospital_login.php">Login Here</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Create floating elements
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

    // Password toggle functionality
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordField = document.getElementById('password');

    passwordToggle.addEventListener('click', function() {
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      
      const icon = this.querySelector('i');
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });

    // Form submission with loading state
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const btnText = loginBtn.querySelector('.btn-text');

    loginForm.addEventListener('submit', function(e) {
      // Add loading state
      loginBtn.classList.add('loading');
      btnText.style.opacity = '0';
      
      // Simulate loading (remove this in production)
      setTimeout(() => {
        loginBtn.classList.remove('loading');
        btnText.style.opacity = '1';
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

    // Initialize on page load
    window.addEventListener('load', function() {
      createFloatingElements();
      
      // Animate form elements on load
      const formElements = document.querySelectorAll('.input-group, .login-btn');
      formElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
          element.style.transition = 'all 0.6s ease';
          element.style.opacity = '1';
          element.style.transform = 'translateY(0)';
        }, index * 200);
      });
    });
  </script>

  <?php require 'footer.php'; ?>
</body>
</html>