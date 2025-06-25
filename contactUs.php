<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Get in Touch</title>
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
    .contact-container {
      max-width: 1400px;
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

    .hero-image {
      width: 100%;
      max-width: 800px;
      height: 400px;
      object-fit: cover;
      border-radius: 25px;
      margin-bottom: 2rem;
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
      animation: slideInUp 1s ease-out 0.2s both;
      border: 3px solid rgba(255, 255, 255, 0.2);
      transition: all 0.4s ease;
    }

    .hero-image:hover {
      transform: scale(1.02);
      box-shadow: 0 35px 70px rgba(0,0,0,0.4);
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

    /* Contact Grid */
    .contact-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      margin-bottom: 4rem;
    }

    /* Contact Information Card */
    .contact-info-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      animation: slideInLeft 1s ease-out 0.4s both;
      position: relative;
      overflow: hidden;
    }

    .contact-info-card::before {
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

    .contact-info-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: white;
      margin-bottom: 2rem;
      text-align: center;
    }

    .contact-methods {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .contact-method {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      padding: 1.5rem;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 15px;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .contact-method:hover {
      transform: translateY(-5px);
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.3);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .contact-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: white;
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .contact-details h4 {
      color: white;
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .contact-details p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 1rem;
    }

    .faq-link {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      padding: 1.5rem;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 15px;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.1);
      text-decoration: none;
      color: inherit;
    }

    .faq-link:hover {
      transform: translateY(-5px);
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.3);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* Contact Form Card */
    .contact-form-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      animation: slideInRight 1s ease-out 0.6s both;
      position: relative;
      overflow: hidden;
    }

    .contact-form-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #f093fb, #f5576c, #667eea, #764ba2);
      background-size: 200% 100%;
      animation: shimmer 3s ease-in-out infinite reverse;
    }

    .form-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: white;
      margin-bottom: 1rem;
      text-align: center;
    }

    .form-subtitle {
      color: rgba(255, 255, 255, 0.8);
      text-align: center;
      margin-bottom: 2.5rem;
      font-size: 1.1rem;
    }

    .contact-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .form-group {
      position: relative;
    }

    .form-input {
      width: 100%;
      padding: 1.25rem 1.25rem 1.25rem 3rem;
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

    .form-input:focus {
      outline: none;
      border-color: rgba(255, 255, 255, 0.5);
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .form-textarea {
      min-height: 120px;
      resize: vertical;
      padding-top: 1.25rem;
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

    .form-input:focus + .input-icon {
      color: rgba(255, 255, 255, 0.9);
    }

    .submit-btn {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      padding: 1.25rem 2.5rem;
      border-radius: 15px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
      margin-top: 1rem;
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
      display: none;
    }

    /* Additional Info Section */
    .additional-info {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      text-align: center;
      animation: slideInUp 1s ease-out 0.8s both;
    }

    .info-title {
      font-size: 2rem;
      font-weight: 700;
      color: white;
      margin-bottom: 1.5rem;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    .info-card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      padding: 2rem;
      transition: all 0.3s ease;
    }

    .info-card:hover {
      transform: translateY(-5px);
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.3);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .info-icon {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
      font-size: 1.2rem;
      color: white;
    }

    .info-card h4 {
      color: white;
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .info-card p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.9rem;
      line-height: 1.5;
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

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .contact-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
      }
      
      .hero-title {
        font-size: 2.5rem;
      }
      
      .contact-container {
        padding: 1rem;
      }
      
      .contact-info-card,
      .contact-form-card {
        padding: 2rem;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .contact-method,
      .faq-link {
        flex-direction: column;
        text-align: center;
      }
      
      .contact-icon {
        margin-bottom: 1rem;
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

  <div class="contact-container">
    <!-- Hero Section -->
    <div class="hero-section">
      <img src="images/contact.jpg" alt="Contact Us" class="hero-image" />
      <h1 class="hero-title">Get in Touch</h1>
      <p class="hero-subtitle">We're here to help! Reach out to us for any questions, support, or feedback about our blood donation system.</p>
    </div>

    <!-- Contact Grid -->
    <div class="contact-grid">
      <!-- Contact Information -->
      <div class="contact-info-card">
        <h2 class="contact-info-title">Contact Information</h2>
        <div class="contact-methods">
          <div class="contact-method">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-details">
              <h4>Contact Information</h4>
              <p>Name: Ihsas</p>
              <p>Contact Number: 077xxxxxxx</p>
              <p>Email: mohamedihsas001@gmail.com</p>
            </div>
          </div>
          
          <div class="contact-method">
            <div class="contact-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="contact-details">
              <h4>Call Us</h4>
              <p>+077xxxxxxx</p>
            </div>
          </div>
          
          <a href="faq.php" class="faq-link">
            <div class="contact-icon">
              <i class="fas fa-question-circle"></i>
            </div>
            <div class="contact-details">
              <h4>FAQ Section</h4>
              <p>Find answers to commonly asked questions</p>
            </div>
          </a>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-card">
        <h2 class="form-title">Send us a Message</h2>
        <p class="form-subtitle">Feel free to drop us a line below</p>
        
        <form class="contact-form" id="contactForm">
          <div class="form-group">
            <i class="fas fa-user input-icon"></i>
            <input type="text" class="form-input inputName" placeholder="Your name" required>
          </div>
          
          <div class="form-group">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" class="form-input inputEmail" placeholder="Your email" required>
          </div>
          
          <div class="form-group">
            <i class="fas fa-comment input-icon"></i>
            <textarea class="form-input form-textarea inputMessage" placeholder="Type your message here..." required></textarea>
          </div>
          
          <button type="submit" class="submit-btn" id="submitBtn">
            <span class="btn-text">Send Message</span>
            <span class="btn-loading" style="display: none;">
              <div class="loading"></div>
            </span>
          </button>
        </form>
        
        <div id="successMessage" class="success-message">
          <i class="fas fa-check-circle"></i> Thank you for your message! We'll get back to you soon.
        </div>
      </div>
    </div>

    <!-- Additional Information -->
    <div class="additional-info">
      <h2 class="info-title">Why Choose Us?</h2>
      <div class="info-grid">
        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h4>24/7 Support</h4>
          <p>Round-the-clock assistance for all your blood donation needs</p>
        </div>
        
        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h4>Secure & Safe</h4>
          <p>Your information is protected with the highest security standards</p>
        </div>
        
        <div class="info-card">
          <div class="info-icon">
            <i class="fas fa-heart"></i>
          </div>
          <h4>Save Lives</h4>
          <p>Every contact helps us improve and save more lives through blood donation</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Create floating elements
    function createFloatingElements() {
      const container = document.getElementById('floatingElements');
      const elementCount = 30;
      
      for (let i = 0; i < elementCount; i++) {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.left = Math.random() * 100 + '%';
        element.style.animationDelay = Math.random() * 8 + 's';
        element.style.animationDuration = (Math.random() * 4 + 4) + 's';
        container.appendChild(element);
      }
    }

    // Form submission handling
    document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const submitBtn = document.getElementById('submitBtn');
      const btnText = submitBtn.querySelector('.btn-text');
      const btnLoading = submitBtn.querySelector('.btn-loading');
      
      // Show loading state
      btnText.style.display = 'none';
      btnLoading.style.display = 'inline-block';
      submitBtn.disabled = true;
      
      // Get form data
      const name = document.querySelector('.inputName').value;
      const email = document.querySelector('.inputEmail').value;
      const message = document.querySelector('.inputMessage').value;
      
      // Create email body
      const emailBody = 'Name: ' + name + '\n';
      emailBody += 'Email: ' + email + '\n';
      emailBody += 'Message: ' + message;
      
      // Simulate form processing
      setTimeout(() => {
        // Show success message
        document.getElementById('successMessage').style.display = 'block';
        
        // Reset button
        btnText.style.display = 'inline';
        btnLoading.style.display = 'none';
        submitBtn.disabled = false;
        
        // Reset form
        document.getElementById('contactForm').reset();
        
        // Open email client
        window.location.href = 'mailto:sahlaanmansoor@gmail.com?subject=Contact Form Submission&body=' + encodeURIComponent(emailBody);
        
        // Hide success message after 5 seconds
        setTimeout(() => {
          document.getElementById('successMessage').style.display = 'none';
        }, 5000);
      }, 2000);
    });

    // Add hover effects to contact methods
    document.querySelectorAll('.contact-method, .faq-link').forEach(element => {
      element.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
      });
      
      element.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });

    // Add focus effects to form inputs
    document.querySelectorAll('.form-input').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'translateY(-2px)';
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateY(0)';
      });
    });

    // Intersection Observer for animations
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

    // Observe info cards
    document.querySelectorAll('.info-card').forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(30px)';
      card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(card);
    });

    // Initialize on page load
    window.addEventListener('load', function() {
      createFloatingElements();
    });

    // Add parallax effect to hero image
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const heroImage = document.querySelector('.hero-image');
      if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.05}px)`;
      }
    });
  </script>

  <?php require 'footer.php'; ?>
</body>
</html>
