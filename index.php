<?php
session_start();

if (isset($_SESSION["userID"])) {
    $userType = $_SESSION["userType"];
} else {
    $userType = "guest";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Drop4Life - Blood Donation Management System</title>
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/modern-header-footer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="js/function.js" defer></script>
</head>
<body>
    <!-- Animated Background Particles -->
    <div class="particles-container">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-bg-overlay"></div>
            <div class="hero-bg-pattern"></div>
        </div>
        
        <div class="hero-content">
            <div class="hero-text-container">
                <div class="hero-badge">
                    <i class="fas fa-heartbeat"></i>
                    <span>Save Lives Today</span>
                </div>
                
                <h1 class="hero-title">
                    <span class="title-line">Connecting Blood</span>
                    <span class="title-line highlight">Donors & Hospitals</span>
                    <span class="title-line">Instantly</span>
                </h1>
                
                <p class="hero-description">
                    Join our mission to save lives through efficient blood donation management. 
                    Connect donors with hospitals in real-time and make a difference in emergency situations.
                </p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-target="10000">0</span>
                        <span class="stat-label">Lives Saved</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-target="5000">0</span>
                        <span class="stat-label">Active Donors</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-target="200">0</span>
                        <span class="stat-label">Partner Hospitals</span>
                    </div>
                </div>
                
                <div class="hero-actions">
                    <button class="btn-primary" onclick="appoint('<?php echo $userType; ?>')">
                        <span>Book Appointment</span>
                        <div class="btn-ripple"></div>
                    </button>
                    <button class="btn-secondary" onclick="window.location.href='guide.php'">
                        <span>Learn More</span>
                        <div class="btn-ripple"></div>
                    </button>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="hero-image-container">
                    <img src="images/home.jpg" alt="Blood Donation" class="hero-image">
                    <div class="image-overlay"></div>
                    
                    <!-- Floating Cards -->
                    <div class="floating-card card-1">
                        <i class="fas fa-hospital"></i>
                        <span>200+ Hospitals</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-users"></i>
                        <span>5000+ Donors</span>
                    </div>
                    <div class="floating-card card-3">
                        <i class="fas fa-clock"></i>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Why Choose Drop4Life?</h2>
                <p class="section-subtitle">We provide comprehensive blood donation management solutions</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Instant Matching</h3>
                    <p>Connect donors with hospitals in real-time for emergency blood requirements.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Safe & Secure</h3>
                    <p>Your data is protected with industry-standard security measures and privacy controls.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Easy Access</h3>
                    <p>User-friendly interface accessible from any device, making donation management simple.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Track Progress</h3>
                    <p>Monitor donation history, appointments, and impact statistics in real-time.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Community Support</h3>
                    <p>Join a community of dedicated donors and healthcare professionals.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Round-the-clock customer support to assist you with any questions or concerns.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <div class="mission-content">
                <div class="mission-text">
                    <h2>Our Mission</h2>
                    <p class="mission-quote">
                        "To bridge the gap between blood donors and hospitals, ensuring that every patient in need receives timely access to safe blood products."
                    </p>
                    
                    <div class="mission-stats">
                        <div class="mission-stat">
                            <div class="stat-circle">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div class="stat-info">
                                <h4>50,000+</h4>
                                <p>Units Donated</p>
                            </div>
                        </div>
                        
                        <div class="mission-stat">
                            <div class="stat-circle">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="stat-info">
                                <h4>10,000+</h4>
                                <p>Lives Saved</p>
                            </div>
                        </div>
                        
                        <div class="mission-stat">
                            <div class="stat-circle">
                                <i class="fas fa-hospital"></i>
                            </div>
                            <div class="stat-info">
                                <h4>200+</h4>
                                <p>Partner Hospitals</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mission-visual">
                    <div class="mission-image">
                        <img src="images/home2.jpg" alt="Blood Donation Mission">
                        <div class="image-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">What Our Users Say</h2>
                <p class="section-subtitle">Real stories from donors and healthcare professionals</p>
            </div>
            
            <div class="testimonials-carousel">
                <div class="carousel-container">
                    <div class="carousel-track">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p class="testimonial-text">
                                    "Drop4Life made it incredibly easy to schedule my blood donation. The process was smooth and I felt well-informed throughout."
                                </p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="author-info">
                                        <h4>Sarah Johnson</h4>
                                        <span>Regular Donor</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p class="testimonial-text">
                                    "As a hospital administrator, Drop4Life has revolutionized how we manage blood inventory and connect with donors."
                                </p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div class="author-info">
                                        <h4>Dr. Michael Chen</h4>
                                        <span>Hospital Administrator</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="quote-icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <p class="testimonial-text">
                                    "The real-time matching feature saved a patient's life during an emergency. This system is truly life-changing."
                                </p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <i class="fas fa-user-nurse"></i>
                                    </div>
                                    <div class="author-info">
                                        <h4>Emily Rodriguez</h4>
                                        <span>Emergency Nurse</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="carousel-controls">
                    <button class="carousel-btn prev" onclick="moveCarousel(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-btn next" onclick="moveCarousel(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <div class="carousel-dots">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content text-center">
                <h2>Ready to Make a Difference?</h2>
                <p>Join thousands of donors who are saving lives every day. Your donation can make the difference between life and death for someone in need.</p>
                
                <div class="cta-actions">
                    <button class="btn-primary btn-large" onclick="appoint('<?php echo $userType; ?>')">
                        <span>Start Donating Today</span>
                        <div class="btn-ripple"></div>
                    </button>
                    <button class="btn-outline btn-large" onclick="window.location.href='contactUs.php'">
                        <span>Contact Us</span>
                        <div class="btn-ripple"></div>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
        // Animate statistics on scroll
        function animateStats() {
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-target'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    stat.textContent = Math.floor(current).toLocaleString();
                }, 16);
            });
        }

        // Carousel functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.testimonial-card');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.transform = `translateX(${(i - index) * 100}%)`;
            });
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        function moveCarousel(direction) {
            currentSlideIndex = (currentSlideIndex + direction + slides.length) % slides.length;
            showSlide(currentSlideIndex);
        }

        function currentSlide(index) {
            currentSlideIndex = index - 1;
            showSlide(currentSlideIndex);
        }

        // Auto-advance carousel
        setInterval(() => {
            moveCarousel(1);
        }, 5000);

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    
                    // Animate stats when mission section is visible
                    if (entry.target.classList.contains('mission-section')) {
                        animateStats();
                    }
                }
            });
        }, observerOptions);

        // Observe sections for animation
        document.querySelectorAll('.features-section, .mission-section, .testimonials-section, .cta-section').forEach(section => {
            observer.observe(section);
        });

        // Initialize carousel
        document.addEventListener('DOMContentLoaded', function() {
            showSlide(0);
        });
    </script>
</body>
</html> 