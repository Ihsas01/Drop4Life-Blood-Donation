<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - Blood Donation System</title>
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
            line-height: 1.6;
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
        .terms-container {
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
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fff, #f0f8ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Progress Indicator */
        .progress-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            animation: slideInUp 1s ease-out 0.2s both;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .progress-title {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .progress-percentage {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 10px;
            width: 0%;
            transition: width 0.5s ease;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Terms Content */
        .terms-content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 3rem;
            animation: slideInUp 1s ease-out 0.4s both;
        }

        .terms-intro {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            margin-bottom: 3rem;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border-left: 4px solid #667eea;
        }

        .terms-sections {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .terms-section {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
        }

        .terms-section:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .section-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .section-content {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            line-height: 1.7;
        }

        .section-list {
            list-style: none;
            margin-top: 1rem;
        }

        .section-list li {
            position: relative;
            padding: 0.75rem 0 0.75rem 2rem;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .section-list li:hover {
            color: white;
            transform: translateX(5px);
        }

        .section-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 0.75rem;
            color: #667eea;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* Table of Contents */
        .toc-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            animation: slideInUp 1s ease-out 0.3s both;
        }

        .toc-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .toc-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .toc-item {
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .toc-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Contact Section */
        .contact-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 3rem;
            margin-top: 4rem;
            text-align: center;
            animation: slideInUp 1s ease-out 0.5s both;
        }

        .contact-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        .contact-text {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            border-radius: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
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
            
            .terms-container {
                padding: 1rem;
            }
            
            .terms-content {
                padding: 2rem;
            }
            
            .toc-list {
                grid-template-columns: 1fr;
            }
            
            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .terms-content {
                padding: 1.5rem;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>
    
    <!-- Floating Elements -->
    <div class="floating-elements" id="floatingElements"></div>

    <div class="terms-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">Terms and Conditions</h1>
            <p class="hero-subtitle">Please read these terms and conditions carefully before using our Blood Donation System. By accessing our services, you agree to be bound by these terms.</p>
        </div>

        <!-- Progress Indicator -->
        <div class="progress-container">
            <div class="progress-header">
                <span class="progress-title">Reading Progress</span>
                <span class="progress-percentage" id="progressPercentage">0%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>
        </div>

        <!-- Table of Contents -->
        <div class="toc-container">
            <h2 class="toc-title">
                <i class="fas fa-list"></i>
                Table of Contents
            </h2>
            <div class="toc-list">
                <a href="#eligibility" class="toc-item">Eligibility Requirements</a>
                <a href="#registration" class="toc-item">Registration Process</a>
                <a href="#responsibilities" class="toc-item">Donor Responsibilities</a>
                <a href="#process" class="toc-item">Donation Process</a>
                <a href="#confidentiality" class="toc-item">Confidentiality</a>
                <a href="#liability" class="toc-item">Limitation of Liability</a>
                <a href="#changes" class="toc-item">Changes to Terms</a>
                <a href="#governing" class="toc-item">Governing Law</a>
            </div>
        </div>

        <!-- Terms Content -->
        <div class="terms-content">
            <div class="terms-intro">
                <strong>Welcome to the Blood Donation System</strong> provided by Our. These terms and conditions govern your use of our website and services. By accessing or using our website and services, you agree to be bound by these terms and conditions. If you disagree with any part of these terms and conditions, please do not use our website or services.
            </div>

            <div class="terms-sections">
                <div class="terms-section" id="eligibility">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3 class="section-title">Eligibility</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>You must be at least 18 years old to register as a blood donor on our platform.</li>
                            <li>By registering as a donor, you confirm that you meet all eligibility criteria for blood donation as per the guidelines provided by relevant health authorities.</li>
                        </ul>
                    </div>
                </div>

                <div class="terms-section" id="registration">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="section-title">Registration</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>You agree to provide accurate and complete information during the registration process.</li>
                            <li>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</li>
                        </ul>
                    </div>
                </div>

                <div class="terms-section" id="responsibilities">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="section-title">Donor Responsibilities</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>As a donor, you agree to undergo necessary health screenings and assessments prior to blood donation.</li>
                            <li>You agree to follow all instructions provided by our medical staff during the donation process.</li>
                            <li>You understand that donating blood involves certain risks, and you voluntarily assume these risks.</li>
                        </ul>
                    </div>
                </div>

                <div class="terms-section" id="process">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h3 class="section-title">Donation Process</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>We reserve the right to refuse blood donations from any individual at our discretion.</li>
                            <li>We may contact you to schedule donation appointments based on the need for blood products and your eligibility status.</li>
                        </ul>
                    </div>
                </div>

                <div class="terms-section" id="confidentiality">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="section-title">Confidentiality</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>We are committed to protecting your privacy and confidentiality. We will not disclose your personal information to third parties without your consent, except as required by law.</li>
                            <li>By using our website and services, you consent to the collection, use, and disclosure of your personal information in accordance with our Privacy Policy.</li>
                        </ul>
                    </div>
                </div>

                <div class="terms-section" id="liability">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <h3 class="section-title">Limitation of Liability</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>We shall not be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in connection with your use of our website or services.</li>
                            <li>We do not guarantee the availability, accuracy, or reliability of our website or services.</li>
                        </ul>
                    </div>
                </div>

                <div class="terms-section" id="changes">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h3 class="section-title">Changes to Terms and Conditions</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>We reserve the right to modify or update these terms and conditions at any time without prior notice.</li>
                            <li>Your continued use of our website and services after any such changes constitutes acceptance of the modified terms and conditions.</li>
                        </ul>
                    </div>
                </div>

                <div class="terms-section" id="governing">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h3 class="section-title">Governing Law</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>These terms and conditions shall be governed by and construed in accordance with the laws of Sri Lanka, without regard to its conflict of law provisions.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h2 class="contact-title">Contact Information</h2>
            <p class="contact-text">For any questions or concerns about these terms, contact:</p>
            <p>Name: Ihsas</p>
            <p>Contact Number: 077xxxxxxx</p>
            <p>Email: mohamedihsas001@gmail.com</p>
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

        // Progress tracking
        function updateProgress() {
            const sections = document.querySelectorAll('.terms-section');
            const totalSections = sections.length;
            let visibleSections = 0;

            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                const windowHeight = window.innerHeight;
                
                if (rect.top < windowHeight * 0.8 && rect.bottom > windowHeight * 0.2) {
                    visibleSections++;
                }
            });

            const progress = Math.round((visibleSections / totalSections) * 100);
            const progressFill = document.getElementById('progressFill');
            const progressPercentage = document.getElementById('progressPercentage');
            
            progressFill.style.width = progress + '%';
            progressPercentage.textContent = progress + '%';
        }

        // Smooth scrolling for table of contents
        document.querySelectorAll('.toc-item').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
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

        // Observe terms sections
        document.querySelectorAll('.terms-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'all 0.6s ease';
            observer.observe(section);
        });

        // Add hover effects to sections
        document.querySelectorAll('.terms-section').forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Update progress on scroll
        window.addEventListener('scroll', updateProgress);

        // Initialize on page load
        window.addEventListener('load', function() {
            createFloatingElements();
            updateProgress();
            
            // Animate sections on load
            document.querySelectorAll('.terms-section').forEach((section, index) => {
                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>

    <?php require 'footer.php'; ?>
</body>
</html>