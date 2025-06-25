<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Blood Donation System</title>
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
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
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
            background: linear-gradient(45deg, #0f0c29, #302b63, #24243e, #1a1a2e);
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
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
            50% { transform: translateY(-40px) rotate(180deg); opacity: 1; }
        }

        /* Main Container */
        .privacy-container {
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
            background: linear-gradient(135deg, #fff, #e0e7ff);
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

        /* Privacy Shield */
        .privacy-shield {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 3rem;
            margin-bottom: 3rem;
            text-align: center;
            animation: slideInUp 1s ease-out 0.2s both;
            position: relative;
            overflow: hidden;
        }

        .privacy-shield::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: rotate 10s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .shield-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .shield-title {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .shield-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Privacy Content */
        .privacy-content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 3rem;
            animation: slideInUp 1s ease-out 0.4s both;
        }

        .privacy-sections {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        .privacy-section {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .privacy-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }

        .privacy-section:hover::before {
            left: 100%;
        }

        .privacy-section:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .section-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .section-icon::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: rotate(45deg);
            transition: transform 0.6s ease;
        }

        .privacy-section:hover .section-icon::after {
            transform: rotate(45deg) translate(50%, 50%);
        }

        .section-title {
            color: white;
            font-size: 1.8rem;
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
            margin-top: 1.5rem;
        }

        .section-list li {
            position: relative;
            padding: 1rem 0 1rem 2.5rem;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-list li:last-child {
            border-bottom: none;
        }

        .section-list li:hover {
            color: white;
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding-left: 3rem;
        }

        .section-list li::before {
            content: '🔒';
            position: absolute;
            left: 0;
            top: 1rem;
            font-size: 1.2rem;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .section-list li:hover::before {
            opacity: 1;
            transform: scale(1.2);
        }

        /* Data Flow Visualization */
        .data-flow {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            margin: 3rem 0;
            animation: slideInUp 1s ease-out 0.6s both;
        }

        .flow-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .flow-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .flow-step {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .flow-step:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .flow-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.2rem;
        }

        .flow-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
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
            animation: slideInUp 1s ease-out 0.8s both;
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
            
            .privacy-container {
                padding: 1rem;
            }
            
            .privacy-content {
                padding: 2rem;
            }
            
            .flow-steps {
                grid-template-columns: 1fr;
            }
            
            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .privacy-content {
                padding: 1.5rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>
    
    <!-- Floating Elements -->
    <div class="floating-elements" id="floatingElements"></div>

    <div class="privacy-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">Privacy Policy</h1>
            <p class="hero-subtitle">Your privacy is our priority. Learn how we protect and handle your personal information with the highest standards of security and transparency.</p>
        </div>

        <!-- Privacy Shield -->
        <div class="privacy-shield">
            <div class="shield-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h2 class="shield-title">Your Data is Protected</h2>
            <p class="shield-text">Thank you for using the Drop4Life Blood Donation System. Your privacy is important to us. This Privacy Policy explains how we collect, use, and safeguard your personal information when you use our website.</p>
        </div>

        <!-- Privacy Content -->
        <div class="privacy-content">
            <div class="privacy-sections">
                <div class="privacy-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3 class="section-title">Information We Collect</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li><strong>Personal Information:</strong> When you register on our website, we collect personal information such as your name, contact details, date of birth, blood type, and any other information necessary for the donation process.</li>
                            <li><strong>Health Information:</strong> We may collect health information such as medical history, blood pressure, and any other relevant health data required for ensuring the safety of the donation process.</li>
                            <li><strong>Device Information:</strong> We automatically collect certain information about your device, including your IP address, browser type, and operating system.</li>
                        </ul>
                    </div>
                </div>

                <div class="privacy-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3 class="section-title">How We Use Your Information</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li><strong>To Facilitate Donations:</strong> We use the information you provide to schedule appointments, send reminders, and ensure the safety and suitability of donations.</li>
                            <li><strong>Communication:</strong> We may use your contact information to communicate with you about your donations, updates to our website, and relevant news or events related to blood donation.</li>
                            <li><strong>Improvement of Services:</strong> We use aggregated data to analyze trends, monitor the effectiveness of our services, and make improvements to our website.</li>
                            <li><strong>Legal Compliance:</strong> We may use your information to comply with legal obligations, such as reporting donation records to regulatory authorities.</li>
                        </ul>
                    </div>
                </div>

                <div class="privacy-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="section-title">Data Security</h3>
                    </div>
                    <div class="section-content">
                        <ul class="section-list">
                            <li>We take appropriate measures to protect the security of your personal information. This includes encryption, access controls, and regular security assessments to safeguard against unauthorized access, disclosure, alteration, or destruction of data.</li>
                            <li>All data transmission is encrypted using industry-standard SSL/TLS protocols to ensure your information remains secure during transmission.</li>
                            <li>We regularly update our security measures and conduct thorough audits to maintain the highest level of data protection.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Data Flow Visualization -->
            <div class="data-flow">
                <h3 class="flow-title">How Your Data Flows</h3>
                <div class="flow-steps">
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="flow-text">Registration & Collection</div>
                    </div>
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="flow-text">Encryption & Protection</div>
                    </div>
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="flow-text">Processing & Usage</div>
                    </div>
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="fas fa-eye-slash"></i>
                        </div>
                        <div class="flow-text">Privacy & Control</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h2 class="contact-title">Contact Information</h2>
            <p class="contact-text">For any questions about privacy or your data, contact:</p>
            <p>Name: Ihsas</p>
            <p>Contact Number: 077xxxxxxx</p>
            <p>Email: mohamedihsas001@gmail.com</p>
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

        // Observe privacy sections
        document.querySelectorAll('.privacy-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'all 0.6s ease';
            observer.observe(section);
        });

        // Add hover effects to sections
        document.querySelectorAll('.privacy-section').forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
            });
            
            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add click effects to list items
        document.querySelectorAll('.section-list li').forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'translateX(8px) scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'translateX(8px)';
                }, 200);
            });
        });

        // Animate flow steps on scroll
        const flowObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 200);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.flow-step').forEach(step => {
            step.style.opacity = '0';
            step.style.transform = 'translateY(20px)';
            step.style.transition = 'all 0.5s ease';
            flowObserver.observe(step);
        });

        // Initialize on page load
        window.addEventListener('load', function() {
            createFloatingElements();
            
            // Animate sections on load
            document.querySelectorAll('.privacy-section').forEach((section, index) => {
                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 300);
            });
        });
    </script>

    <?php require 'footer.php'; ?>
</body>
</html>