<?php
require 'header.php';
require 'includes/dbh.inc.php';

$query = "SELECT *, CONCAT(donor.Salutation, ' ', donor.F_name, ' ', donor.L_name) AS DonorName,
hospital.H_Name
FROM feedback
LEFT JOIN donor ON feedback.F_Donor_id = donor.Donor_id
LEFT JOIN hospital ON feedback.F_Hospital_id=hospital.Hospital_id
 WHERE feedback.Status = 1";
$result = mysqli_query($con, $query);

if (!$result) {
  die('Error: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback - Blood Donation System</title>
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
      animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating Particles */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      pointer-events: none;
    }

    .particle {
      position: absolute;
      width: 4px;
      height: 4px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-20px) rotate(180deg); opacity: 1; }
    }

    /* Main Container */
    .feedback-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
      position: relative;
      z-index: 1;
    }

    /* Hero Section */
    .hero-section {
      text-align: center;
      margin-bottom: 4rem;
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
      font-size: 1.2rem;
      color: rgba(255, 255, 255, 0.9);
      font-weight: 400;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* Feedback Cards Grid */
    .feedback-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 2rem;
      margin-bottom: 4rem;
    }

    .feedback-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 2rem;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
      animation: slideInUp 0.8s ease-out;
    }

    .feedback-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.5s;
    }

    .feedback-card:hover::before {
      left: 100%;
    }

    .feedback-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
      border-color: rgba(255, 255, 255, 0.4);
    }

    .feedback-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }

    .user-avatar {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      font-size: 1.2rem;
      color: white;
      font-weight: 600;
    }

    .user-info h4 {
      color: white;
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .user-info span {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.9rem;
    }

    .feedback-content {
      color: rgba(255, 255, 255, 0.9);
      line-height: 1.6;
      font-style: italic;
      position: relative;
    }

    .feedback-content::before {
      content: '"';
      font-size: 3rem;
      color: rgba(255, 255, 255, 0.3);
      position: absolute;
      top: -1rem;
      left: -0.5rem;
    }

    /* Feedback Form */
    .feedback-form-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      text-align: center;
      animation: slideInUp 1s ease-out 0.2s both;
      position: relative;
      overflow: hidden;
    }

    .feedback-form-container::before {
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
      font-size: 2rem;
      font-weight: 700;
      color: white;
      margin-bottom: 1rem;
    }

    .form-subtitle {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 2rem;
      font-size: 1.1rem;
    }

    .feedback-form {
      max-width: 500px;
      margin: 0 auto;
    }

    .form-group {
      position: relative;
      margin-bottom: 2rem;
    }

    .feedback-input {
      width: 100%;
      padding: 1.5rem 1.5rem 1.5rem 3rem;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 15px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .feedback-input::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .feedback-input:focus {
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

    .feedback-input:focus + .input-icon {
      color: rgba(255, 255, 255, 0.9);
    }

    .submit-btn {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      padding: 1rem 3rem;
      border-radius: 50px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .submit-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }

    .submit-btn:hover::before {
      left: 100%;
    }

    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .submit-btn:active {
      transform: translateY(-1px);
    }

    .submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }

    /* Success Message */
    .success-message {
      background: rgba(76, 175, 80, 0.2);
      border: 1px solid rgba(76, 175, 80, 0.3);
      border-radius: 15px;
      padding: 1rem;
      margin-top: 1rem;
      color: #4caf50;
      font-weight: 500;
      animation: slideInUp 0.5s ease-out;
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
        transform: translateY(50px);
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
      
      .feedback-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      
      .feedback-form-container {
        padding: 2rem 1.5rem;
      }
      
      .feedback-container {
        padding: 1rem;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .feedback-card {
        padding: 1.5rem;
      }
      
      .feedback-input {
        padding: 1.25rem 1.25rem 1.25rem 2.5rem;
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
  
  <!-- Floating Particles -->
  <div class="particles" id="particles"></div>

  <div class="feedback-container">
    <!-- Hero Section -->
    <div class="hero-section">
      <h1 class="hero-title">Share Your Experience</h1>
      <p class="hero-subtitle">Your feedback helps us improve and save more lives. Every voice matters in our mission to create a better blood donation system.</p>
    </div>

    <!-- Feedback Cards -->
    <div class="feedback-grid">
      <?php 
      $feedbacks = [];
      mysqli_data_seek($result, 0);
      while ($row = mysqli_fetch_assoc($result)) {
        $UserName = $row['F_Donor_id'] == null ? $row['H_Name'] : $row['DonorName'];
        $Comment = $row['Comment'];
        $feedbacks[] = ['user' => $UserName, 'comment' => $Comment];
      }
      
      foreach ($feedbacks as $index => $item) { ?>
        <div class="feedback-card" style="animation-delay: <?php echo $index * 0.1; ?>s">
          <div class="feedback-header">
            <div class="user-avatar">
              <?php echo strtoupper(substr($item['user'], 0, 1)); ?>
            </div>
            <div class="user-info">
              <h4><?php echo htmlspecialchars($item['user']); ?></h4>
              <span>Blood Donor</span>
            </div>
          </div>
          <div class="feedback-content">
            <?php echo htmlspecialchars($item['comment']); ?>
          </div>
        </div>
      <?php } ?>
    </div>

    <!-- Feedback Form -->
    <div class="feedback-form-container">
      <h2 class="form-title">Share Your Feedback</h2>
      <p class="form-subtitle">Help us improve our services by sharing your experience</p>
      
      <form class="feedback-form" method="post" id="feedbackForm">
        <div class="form-group">
          <i class="fas fa-comment input-icon"></i>
          <textarea 
            class="feedback-input" 
            name="feedback" 
            placeholder="Tell us about your experience with our blood donation system..."
            rows="4"
            required
          ></textarea>
        </div>
        
        <button type="submit" class="submit-btn" id="submitBtn" <?php if(isset($userType) && ($userType === 'admin' || $userType === 'guest')) echo 'disabled'; ?>>
          <span class="btn-text">Submit Feedback</span>
          <span class="btn-loading" style="display: none;">
            <div class="loading"></div>
          </span>
        </button>
      </form>
      
      <div id="successMessage" class="success-message" style="display: none;">
        <i class="fas fa-check-circle"></i> Thank you for your feedback! Your input helps us improve our services.
      </div>
    </div>
  </div>

  <script>
    // Create floating particles
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 50;
      
      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 6 + 's';
        particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
        particlesContainer.appendChild(particle);
      }
    }

    // Form submission handling
    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const submitBtn = document.getElementById('submitBtn');
      const btnText = submitBtn.querySelector('.btn-text');
      const btnLoading = submitBtn.querySelector('.btn-loading');
      
      // Show loading state
      btnText.style.display = 'none';
      btnLoading.style.display = 'inline-block';
      submitBtn.disabled = true;
      
      // Simulate form submission (replace with actual AJAX call)
      setTimeout(() => {
        // Show success message
        document.getElementById('successMessage').style.display = 'block';
        
        // Reset button
        btnText.style.display = 'inline';
        btnLoading.style.display = 'none';
        submitBtn.disabled = false;
        
        // Reset form
        document.getElementById('feedbackForm').reset();
        
        // Hide success message after 5 seconds
        setTimeout(() => {
          document.getElementById('successMessage').style.display = 'none';
        }, 5000);
      }, 2000);
    });

    // Add hover effects to feedback cards
    document.querySelectorAll('.feedback-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px) scale(1.02)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
      });
    });

    // Initialize particles on page load
    window.addEventListener('load', createParticles);

    // Add scroll animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe all feedback cards
    document.querySelectorAll('.feedback-card').forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(30px)';
      card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(card);
    });
  </script>

  <?php
  if (isset($_SESSION["userID"])) {
    $userType = $_SESSION["userType"];
  }
  ?>

  <?php require 'footer.php'; ?>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["userID"]) && isset($_SESSION["userType"])) {
      $userID = $_SESSION["userID"];
      $userType = $_SESSION["userType"];
      $feedback = $_POST['feedback'];
      
      if ($userType === 'hospital') {
        $sql = "INSERT INTO feedback (F_Hospital_id, Comment) VALUES ('$userID','$feedback')";
      } else {
        $sql = "INSERT INTO feedback (F_Donor_id, Comment) VALUES ('$userID','$feedback')";
      }
      
      if (mysqli_query($con, $sql)) {
        header("location:feedback.php?posted=true");
        exit;
      } else {
        echo "Error: " . mysqli_error($con);
      }
    } else {
      echo "Please log in to submit feedback.";
    }
  }
  
  if (isset($_GET['posted']) && $_GET['posted'] === 'true') {
    echo '<script>
      document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("successMessage").style.display = "block";
        setTimeout(() => {
          document.getElementById("successMessage").style.display = "none";
        }, 5000);
      });
    </script>';
  }
  ?>
</body>
</html>
