<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Donation Guide - Your Complete Guide</title>
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
      background: rgba(255, 255, 255, 0.4);
      border-radius: 50%;
      animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-30px) rotate(180deg); opacity: 1; }
    }

    /* Main Container */
    .guide-container {
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

    .hero-image {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      margin-bottom: 2rem;
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
      animation: pulse 3s ease-in-out infinite;
      border: 4px solid rgba(255, 255, 255, 0.3);
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
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

    /* Timeline Container */
    .timeline-container {
      position: relative;
      margin: 4rem 0;
    }

    .timeline-line {
      position: absolute;
      left: 50%;
      top: 0;
      bottom: 0;
      width: 4px;
      background: linear-gradient(180deg, #667eea, #764ba2);
      transform: translateX(-50%);
      border-radius: 2px;
    }

    /* Timeline Steps */
    .timeline-step {
      position: relative;
      margin-bottom: 4rem;
      opacity: 0;
      transform: translateY(50px);
      animation: slideInUp 0.8s ease-out forwards;
    }

    .timeline-step:nth-child(even) {
      animation-delay: 0.2s;
    }

    .timeline-step:nth-child(odd) {
      animation-delay: 0.4s;
    }

    .timeline-content {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 2.5rem;
      position: relative;
      width: 45%;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .timeline-step:nth-child(odd) .timeline-content {
      margin-left: 0;
      margin-right: auto;
    }

    .timeline-step:nth-child(even) .timeline-content {
      margin-left: auto;
      margin-right: 0;
    }

    .timeline-content:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
      border-color: rgba(255, 255, 255, 0.4);
    }

    .timeline-content::before {
      content: '';
      position: absolute;
      top: 50%;
      width: 20px;
      height: 20px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 50%;
      transform: translateY(-50%);
      box-shadow: 0 0 20px rgba(102, 126, 234, 0.5);
    }

    .timeline-step:nth-child(odd) .timeline-content::before {
      right: -60px;
    }

    .timeline-step:nth-child(even) .timeline-content::before {
      left: -60px;
    }

    .step-number {
      position: absolute;
      top: -15px;
      left: 20px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1.1rem;
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .step-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: white;
      margin-bottom: 1rem;
      margin-left: 60px;
    }

    .step-description {
      color: rgba(255, 255, 255, 0.9);
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    .step-list {
      list-style: none;
      padding: 0;
    }

    .step-list li {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 0.75rem;
      padding-left: 1.5rem;
      position: relative;
      line-height: 1.5;
    }

    .step-list li::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: #4caf50;
      font-weight: bold;
      font-size: 1.1rem;
    }

    /* Process Steps */
    .process-section {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      margin: 4rem 0;
      animation: slideInUp 1s ease-out 0.6s both;
    }

    .process-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: white;
      text-align: center;
      margin-bottom: 2rem;
    }

    .process-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
    }

    .process-card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      padding: 2rem;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .process-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.5s;
    }

    .process-card:hover::before {
      left: 100%;
    }

    .process-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.2);
      border-color: rgba(255, 255, 255, 0.3);
    }

    .process-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
      color: white;
    }

    .process-card h4 {
      color: white;
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .process-card p {
      color: rgba(255, 255, 255, 0.8);
      line-height: 1.6;
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
      .timeline-line {
        left: 20px;
      }

      .timeline-content {
        width: calc(100% - 60px);
        margin-left: 60px !important;
        margin-right: 0 !important;
      }

      .timeline-step:nth-child(odd) .timeline-content::before,
      .timeline-step:nth-child(even) .timeline-content::before {
        left: -50px;
        right: auto;
      }

      .hero-title {
        font-size: 2.5rem;
      }

      .process-grid {
        grid-template-columns: 1fr;
      }

      .guide-container {
        padding: 1rem;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 2rem;
      }

      .timeline-content {
        padding: 1.5rem;
      }

      .process-section {
        padding: 2rem 1.5rem;
      }
    }

    /* Interactive Elements */
    .interactive-element {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .interactive-element:hover {
      transform: scale(1.05);
    }

    /* Progress Indicator */
    .progress-indicator {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: rgba(255, 255, 255, 0.1);
      z-index: 1000;
    }

    .progress-bar {
      height: 100%;
      background: linear-gradient(90deg, #667eea, #764ba2);
      width: 0%;
      transition: width 0.3s ease;
    }
  </style>
</head>
<body>
  <div class="animated-bg"></div>
  
  <!-- Floating Elements -->
  <div class="floating-elements" id="floatingElements"></div>

  <!-- Progress Indicator -->
  <div class="progress-indicator">
    <div class="progress-bar" id="progressBar"></div>
  </div>

  <div class="guide-container">
    <!-- Hero Section -->
    <div class="hero-section">
      <img src="images/guidelol.png" alt="Blood Donation Guide" class="hero-image interactive-element" />
      <h1 class="hero-title">The Donation Process</h1>
      <p class="hero-subtitle">Giving blood is simple and it saves lives. When you give blood, it is collected so it can be used to treat someone else. Follow this comprehensive guide to understand the complete process.</p>
    </div>

    <!-- Timeline Section -->
    <div class="timeline-container">
      <div class="timeline-line"></div>
      
      <!-- Step 1: Before Donation -->
      <div class="timeline-step">
        <div class="timeline-content">
          <div class="step-number">1</div>
          <h2 class="step-title">Before You Give Blood</h2>
          <p class="step-description">Prepare yourself for a successful blood donation experience by following these essential steps.</p>
          <ul class="step-list">
            <li>Check you are able to give blood</li>
            <li>Sign up online through our platform</li>
            <li>Log in to your account and book an appointment</li>
            <li>Follow the preparation recommendations</li>
            <li>Notify us at least 3 days in advance if you need to cancel</li>
          </ul>
        </div>
      </div>

      <!-- Step 2: During Donation -->
      <div class="timeline-step">
        <div class="timeline-content">
          <div class="step-number">2</div>
          <h2 class="step-title">During Your Donation</h2>
          <p class="step-description">The donation process takes about an hour and involves several important steps to ensure your safety and comfort.</p>
          <ul class="step-list">
            <li>Welcome and preparation phase</li>
            <li>Health screening and identity verification</li>
            <li>Iron level testing (haemoglobin check)</li>
            <li>Blood collection process (5-10 minutes)</li>
            <li>Post-donation care and monitoring</li>
          </ul>
        </div>
      </div>

      <!-- Step 3: After Donation -->
      <div class="timeline-step">
        <div class="timeline-content">
          <div class="step-number">3</div>
          <h2 class="step-title">After Your Donation</h2>
          <p class="step-description">Take care of yourself after donation to ensure a quick recovery and maintain your well-being.</p>
          <ul class="step-list">
            <li>Rest for at least 15 minutes</li>
            <li>Stay hydrated and eat a light snack</li>
            <li>Avoid strenuous activities for 24 hours</li>
            <li>Keep the bandage on for several hours</li>
            <li>Contact us if you experience any issues</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Detailed Process Section -->
    <div class="process-section">
      <h2 class="process-title">Detailed Donation Process</h2>
      <div class="process-grid">
        <div class="process-card">
          <div class="process-icon">
            <i class="fas fa-user-check"></i>
          </div>
          <h4>Welcome & Preparation</h4>
          <p>Bring your completed donation safety check form. Read our donor consent booklet and drink 500ml of fluid to help with your well-being during donation.</p>
        </div>

        <div class="process-card">
          <div class="process-icon">
            <i class="fas fa-stethoscope"></i>
          </div>
          <h4>Health Screening</h4>
          <p>We ensure it's safe for you to donate and that your blood is safe for patients. We verify your identity and test your iron levels.</p>
        </div>

        <div class="process-card">
          <div class="process-icon">
            <i class="fas fa-heartbeat"></i>
          </div>
          <h4>Blood Collection</h4>
          <p>A needle is inserted to collect 470ml of blood. The process takes 5-10 minutes. You should feel no discomfort - if you do, tell staff immediately.</p>
        </div>

        <div class="process-card">
          <div class="process-icon">
            <i class="fas fa-band-aid"></i>
          </div>
          <h4>Post-Donation Care</h4>
          <p>The needle is removed and a sterile dressing applied. Rest in our recovery area and enjoy refreshments before leaving.</p>
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

    // Progress bar functionality
    function updateProgressBar() {
      const scrollTop = window.pageYOffset;
      const docHeight = document.body.offsetHeight - window.innerHeight;
      const scrollPercent = (scrollTop / docHeight) * 100;
      document.getElementById('progressBar').style.width = scrollPercent + '%';
    }

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

    // Observe timeline steps
    document.querySelectorAll('.timeline-step').forEach(step => {
      observer.observe(step);
    });

    // Observe process cards
    document.querySelectorAll('.process-card').forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(30px)';
      card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(card);
    });

    // Add hover effects to interactive elements
    document.querySelectorAll('.interactive-element').forEach(element => {
      element.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
      });
      
      element.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
      });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Initialize on page load
    window.addEventListener('load', function() {
      createFloatingElements();
      updateProgressBar();
    });

    // Update progress bar on scroll
    window.addEventListener('scroll', updateProgressBar);

    // Add parallax effect to hero image
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const heroImage = document.querySelector('.hero-image');
      if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.1}px)`;
      }
    });
  </script>

  <?php include 'footer.php'; ?>
</body>
</html>