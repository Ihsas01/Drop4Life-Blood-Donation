<?php
// Start session before anything else
session_start();
// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

include 'includes/function.inc.php';

$error_message = '';

// Check if user is already logged in as admin
if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "admin") {
    header("Location: admin_panel.php");
    exit();
}

// Regenerate session ID for security
if (!isset($_SESSION['admin_login_attempts'])) {
    session_regenerate_id(true);
    $_SESSION['admin_login_attempts'] = 0;
    $_SESSION['admin_last_attempt'] = 0;
}

// Rate limiting for login attempts
$current_time = time();
if ($_SESSION['admin_last_attempt'] > 0 && ($current_time - $_SESSION['admin_last_attempt']) < 30) {
    $error_message = "Too many login attempts. Please wait 30 seconds before trying again.";
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $UName = trim($_POST['username']);
        $passKey = trim($_POST['passkey']);
        $password = trim($_POST['password']);

        // Basic validation
        if (empty($UName) || empty($passKey) || empty($password)) {
            $error_message = "All fields are required. Please fill in all credentials.";
        } elseif (strlen($UName) < 3 || strlen($UName) > 50) {
            $error_message = "Username must be between 3 and 50 characters.";
        } elseif (strlen($passKey) < 3 || strlen($passKey) > 20) {
            $error_message = "Passkey must be between 3 and 20 characters.";
        } elseif (strlen($password) < 3 || strlen($password) > 20) {
            $error_message = "Password must be between 3 and 20 characters.";
        } else {
            // Update login attempts
            $_SESSION['admin_login_attempts']++;
            $_SESSION['admin_last_attempt'] = $current_time;
            
            // Call the admin login function
            $login_result = adminLogin($con, $UName, $password, $passKey);
            
            // If login failed, set error message
            if ($login_result === false) {
                $error_message = "Invalid login credentials. Please check your username, passkey, and password.";
            } else {
                // Reset login attempts on successful login
                $_SESSION['admin_login_attempts'] = 0;
                $_SESSION['admin_last_attempt'] = 0;
            }
        }
    }
}

// Now include header.php (outputs HTML)
include 'header.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Blood Donation System</title>
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
            background: linear-gradient(45deg, #0f0c29, #302b63, #24243e, #1a1a2e);
            background-size: 400% 400%;
            animation: gradientShift 30s ease infinite;
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
            animation: float 15s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
            50% { transform: translateY(-60px) rotate(180deg); opacity: 1; }
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
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 30px;
            overflow: hidden;
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            animation: slideInUp 1.2s ease-out;
            position: relative;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            animation: shimmer 4s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }

        /* Hero Section */
        .login-hero {
            background: linear-gradient(135deg, rgba(15, 12, 41, 0.95), rgba(48, 43, 99, 0.95));
            padding: 3.5rem;
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
            background: url('images/admin.jpg') center/cover;
            opacity: 0.2;
            z-index: -1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2.5rem;
            font-size: 2.5rem;
            color: white;
            backdrop-filter: blur(15px);
            border: 3px solid rgba(255, 255, 255, 0.2);
            animation: pulse 3s ease-in-out infinite;
            position: relative;
        }

        .hero-icon::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
            border-radius: 50%;
            z-index: -1;
            animation: rotate 4s linear infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 900;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            line-height: 1.7;
            max-width: 350px;
            margin-bottom: 2rem;
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 2.5rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            display: block;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 0.5rem;
        }

        /* Form Section */
        .login-form-section {
            padding: 3.5rem;
            background: rgba(255, 255, 255, 0.98);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 0.8rem;
            background: linear-gradient(45deg, #302b63, #24243e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-subtitle {
            color: #666;
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Error Message Styling */
        .error-message {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            font-weight: 500;
            text-align: center;
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
            animation: slideInDown 0.5s ease-out;
            border-left: 4px solid #d63031;
        }

        .error-message i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.8rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-field {
            width: 100%;
            padding: 1.2rem 1.2rem 1.2rem 3.5rem;
            border: 2px solid #e1e5e9;
            border-radius: 15px;
            font-size: 1rem;
            background: white;
            transition: all 0.4s ease;
            position: relative;
            font-weight: 500;
        }

        .input-field:focus {
            outline: none;
            border-color: #302b63;
            box-shadow: 0 0 0 4px rgba(48, 43, 99, 0.1);
            transform: translateY(-3px);
        }

        .input-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1.2rem;
            transition: all 0.4s ease;
            z-index: 2;
        }

        .input-field:focus + .input-icon {
            color: #302b63;
            transform: translateY(-50%) scale(1.1);
        }

        .input-label {
            position: absolute;
            left: 3.5rem;
            top: 1.2rem;
            color: #999;
            font-size: 1rem;
            transition: all 0.4s ease;
            pointer-events: none;
            background: white;
            padding: 0 0.5rem;
            font-weight: 500;
        }

        .input-field:focus ~ .input-label,
        .input-field:not(:placeholder-shown) ~ .input-label {
            top: -0.8rem;
            left: 1.2rem;
            font-size: 0.85rem;
            color: #302b63;
            font-weight: 700;
        }

        .password-toggle {
            position: absolute;
            right: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.4s ease;
            padding: 0.5rem;
            border-radius: 50%;
        }

        .password-toggle:hover {
            color: #302b63;
            background: rgba(48, 43, 99, 0.1);
            transform: translateY(-50%) scale(1.1);
        }

        .login-btn {
            background: linear-gradient(135deg, #302b63, #24243e);
            color: white;
            border: none;
            padding: 1.2rem 2.5rem;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            margin-top: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(48, 43, 99, 0.4);
        }

        .login-btn:active {
            transform: translateY(-2px);
        }

        /* Security Notice */
        .security-notice {
            margin-top: 2rem;
            padding: 1rem;
            background: rgba(48, 43, 99, 0.05);
            border-radius: 10px;
            border-left: 4px solid #302b63;
            text-align: center;
        }

        .security-notice i {
            color: #302b63;
            margin-right: 0.5rem;
        }

        .security-notice span {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
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
            width: 24px;
            height: 24px;
            margin: -12px 0 0 -12px;
            border: 3px solid transparent;
            border-top: 3px solid white;
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
                transform: translateY(60px);
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
                max-width: 450px;
            }

            .login-hero {
                padding: 2.5rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-stats {
                gap: 2rem;
            }

            .login-form-section {
                padding: 2.5rem;
            }

            .welcome-title {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1rem;
            }

            .login-hero {
                padding: 2rem;
            }

            .login-form-section {
                padding: 2rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .hero-icon {
                width: 80px;
                height: 80px;
                font-size: 2rem;
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
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h1 class="hero-title">Admin Portal</h1>
                    <p class="hero-subtitle">Secure access to system administration. Manage blood donations, hospitals, and donors with full control.</p>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Secure</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Access</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">Full</span>
                            <span class="stat-label">Control</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="login-form-section">
                <div class="form-header">
                    <h2 class="welcome-title">Admin Login</h2>
                    <p class="welcome-subtitle">Enter your credentials to access the admin dashboard</p>
                </div>

                <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
                <?php endif; ?>

                <form id="loginForm" class="login-form" method="POST" autocomplete="off">
                    <div class="input-group">
                        <input type="text" name="username" id="username" class="input-field" placeholder=" " required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        <i class="fas fa-user input-icon"></i>
                        <label for="username" class="input-label">Username</label>
                    </div>

                    <div class="input-group">
                        <input type="password" name="passkey" id="passkey" class="input-field" placeholder=" " required>
                        <i class="fas fa-key input-icon"></i>
                        <label for="passkey" class="input-label">Passkey</label>
                        <button type="button" class="password-toggle" id="passkeyToggle">
                            <i class="fas fa-eye"></i>
                        </button>
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
                        <span class="btn-text">Access Admin Panel</span>
                    </button>
                </form>

                <div class="security-notice">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure admin access with encrypted authentication</span>
                </div>
            </div>
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
                element.style.animationDuration = (Math.random() * 5 + 8) + 's';
                container.appendChild(element);
            }
        }

        // Password toggle functionality
        const passkeyToggle = document.getElementById('passkeyToggle');
        const passkeyField = document.getElementById('passkey');
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordField = document.getElementById('password');

        passkeyToggle.addEventListener('click', function() {
            const type = passkeyField.getAttribute('type') === 'password' ? 'text' : 'password';
            passkeyField.setAttribute('type', type);
            
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

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
            
            // Remove loading state after a short delay (form will submit naturally)
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
                this.style.transform = 'translateY(-3px)';
            });
            
            group.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Initialize on page load
        window.addEventListener('load', function() {
            createFloatingElements();
            
            // Animate form elements on load
            const formElements = document.querySelectorAll('.input-group, .login-btn, .security-notice');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(30px)';
                
                setTimeout(() => {
                    element.style.transition = 'all 0.8s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>

    <?php include 'footer.php' ?>
</body>
</html>