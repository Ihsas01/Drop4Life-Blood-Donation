<?php
session_start();

if (isset($_SESSION["userID"])) {
    $userType = $_SESSION["userType"];
    // Refresh admin session variables from DB if admin
    if ($userType === 'admin') {
        include_once __DIR__ . '/CRUD/dbh.crud.php';
        $adminId = $_SESSION['userID'];
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE Admin_id = '$adminId'");
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $_SESSION['username'] = $row['Username'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['phone'] = $row['Phone_no'];
        }
    }
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
    <div class="header-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <header class="modern-header">
        <nav class="modern-navbar" aria-label="Main Navigation">
            <div class="nav-container">
                <!-- Logo Section -->
                <div class="nav-brand">
                    <a href="index.php" class="logo-wrapper">
                        <div class="logo-container">
                            <img class="logo-image" src="images/logo.png" alt="Drop4Life Logo" />
                            <div class="logo-glow"></div>
                        </div>
                        <span class="logo-text">Drop4Life</span>
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="nav-menu">
                    <div class="hamburger">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </div>
                </button>

                <!-- Navigation Menu -->
                <div class="nav-menu-container">
                    <ul class="nav-menu" id="nav-menu">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link" data-text="Home">
                                <i class="nav-icon fas fa-home"></i>
                                <span class="nav-text">Home</span>
                                <div class="nav-link-underline"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="feedback.php" class="nav-link" data-text="Feedback">
                                <i class="nav-icon fas fa-comments"></i>
                                <span class="nav-text">Feedback</span>
                                <div class="nav-link-underline"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="guide.php" class="nav-link" data-text="Guide">
                                <i class="nav-icon fas fa-book-open"></i>
                                <span class="nav-text">Guide</span>
                                <div class="nav-link-underline"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="locations.php" class="nav-link" data-text="Locations">
                                <i class="nav-icon fas fa-map-marker-alt"></i>
                                <span class="nav-text">Locations</span>
                                <div class="nav-link-underline"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contactUs.php" class="nav-link" data-text="Contact">
                                <i class="nav-icon fas fa-envelope"></i>
                                <span class="nav-text">Contact Us</span>
                                <div class="nav-link-underline"></div>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="nav-actions">
                    <?php if ($userType !== 'hospital'): ?>
                    <button class="appointment-btn" onclick="appoint('<?php echo $userType; ?>')">
                        <div class="btn-content">
                            <i class="btn-icon fas fa-calendar-plus"></i>
                            <span class="btn-text">Appointment</span>
                        </div>
                        <div class="btn-ripple"></div>
                    </button>
                    <?php endif; ?>
                    <div class="user-dropdown">
                        <button class="user-trigger" aria-haspopup="true" aria-expanded="false">
                            <div class="user-avatar">
                                <img class="user-image" src="images/user.png" alt="User Profile" />
                                <div class="user-status"></div>
                            </div>
                            <i class="dropdown-arrow fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-header">
                                <img class="dropdown-avatar" src="images/user.png" alt="User" />
                                <div class="dropdown-user-info">
                                    <span class="dropdown-name">Welcome</span>
                                    <?php if (isset($_SESSION['username']) && $userType !== 'guest'): ?>
                                        <span class="dropdown-user-realname"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                    <?php endif; ?>
                                    <span class="dropdown-role"><?php echo ucfirst($userType); ?></span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="dropdown-list">
                                <li class="dropdown-item">
                                    <a href="#" onclick="panel('<?php echo $userType; ?>')" class="dropdown-link">
                                        <i class="dropdown-icon fas fa-user"></i>
                                        <span>Profile/Panel</span>
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="logout.php" class="dropdown-link">
                                        <i class="dropdown-icon fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modern Navigation Toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu-container');
        const hamburger = document.querySelector('.hamburger');
        
        navToggle.addEventListener('click', function() {
            const expanded = navToggle.getAttribute('aria-expanded') === 'true';
            navToggle.setAttribute('aria-expanded', !expanded);
            navMenu.classList.toggle('active');
            hamburger.classList.toggle('active');
            document.body.classList.toggle('nav-open');
        });

        // User Dropdown
        const userTrigger = document.querySelector('.user-trigger');
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const dropdownArrow = document.querySelector('.dropdown-arrow');
        
        userTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            const expanded = userTrigger.getAttribute('aria-expanded') === 'true';
            userTrigger.setAttribute('aria-expanded', !expanded);
            dropdownMenu.classList.toggle('show');
            dropdownArrow.classList.toggle('rotate');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.user-dropdown')) {
                userTrigger.setAttribute('aria-expanded', 'false');
                dropdownMenu.classList.remove('show');
                dropdownArrow.classList.remove('rotate');
            }
        });

        // Navbar scroll effect
        const header = document.querySelector('.modern-header');
        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll <= 0) {
                header.classList.remove('scroll-up');
                header.classList.remove('scroll-down');
                return;
            }
            
            if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
                header.classList.remove('scroll-up');
                header.classList.add('scroll-down');
            } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
                header.classList.remove('scroll-down');
                header.classList.add('scroll-up');
            }
            
            lastScroll = currentScroll;
        });

        // Active link highlighting
        const navLinks = document.querySelectorAll('.nav-link');
        const currentPath = window.location.pathname;
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath.split('/').pop()) {
                link.classList.add('active');
            }
        });

        // Smooth hover effects for nav links
        navLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.querySelector('.nav-link-underline').style.width = '100%';
            });
            
            link.addEventListener('mouseleave', function() {
                this.querySelector('.nav-link-underline').style.width = '0%';
            });
        });

        // Appointment button ripple effect
        const appointmentBtn = document.querySelector('.appointment-btn');
        if (appointmentBtn) {
            appointmentBtn.addEventListener('click', function(e) {
                const ripple = this.querySelector('.btn-ripple');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('active');
                
                setTimeout(() => {
                    ripple.classList.remove('active');
                }, 600);
            });
        }
    });
    </script>
</body>
</html>