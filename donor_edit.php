<?php
session_start();
if (!isset($_SESSION['userID']) || empty($_SESSION['userID']) || !isset($_SESSION['userType']) || $_SESSION['userType'] !== 'donor') {
    header('Location: donor_login.php');
    exit();
}

require 'header.php';
require 'includes/function.inc.php';
require 'includes/dbh.inc.php';

// Fetch donor data
$donorID = $_SESSION['userID'];
$sql = "SELECT * FROM donor WHERE Donor_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $donorID);
$stmt->execute();
$result = $stmt->get_result();
$donor = $result->fetch_assoc();

// Check for success message
$success_message = '';
if (isset($_SESSION['edit_success']) && $_SESSION['edit_success']) {
    $success_message = 'Profile updated successfully!';
    unset($_SESSION['edit_success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Donor</title>
    <link rel="stylesheet" href="css/donor_edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .success-message {
            background: linear-gradient(90deg, #4CAF50 0%, #45a049 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            animation: slideInDown 0.5s ease-out;
        }
        
        @keyframes slideInDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background: linear-gradient(90deg, #5f72bd 0%, #9f5de2 100%);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(95, 114, 189, 0.3);
        }
        
        .delete-confirm {
            background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
        }
        
        .delete-confirm:hover {
            background: linear-gradient(90deg, #f09819 0%, #ff5858 100%);
        }
    </style>
</head>
<body>
    <a href="donor_panel.php" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Panel
    </a>
    
    <div class="frame">
        <div class="row1">
            <div class="blue">
                <i class="fas fa-user-edit"></i> Edit Profile
            </div>
            <div class="head">
                Update your personal information and account details
            </div>
        </div>
        
        <?php if ($success_message): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <hr>
        
        <div class="form-part">
            <!-- Personal Information Form -->
            <form method="POST" action="CRUD/edit_donor_process.php">
                <div class="sec1 reveal-on-scroll">
                    <div class="one">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($donor['F_name']); ?>" required>
                    </div>
                    <div class="two">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($donor['L_name']); ?>" required>
                    </div>
                </div>
                
                <div class="sec2 reveal-on-scroll">
                    <div class="one">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($donor['Email']); ?>" required>
                    </div>
                    <div class="two">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($donor['Phone_no']); ?>" required>
                    </div>
                </div>
                
                <div class="sec3 reveal-on-scroll">
                    <div class="one">
                        <label for="line1">Address Line</label>
                        <input type="text" id="line1" name="line1" value="<?php echo htmlspecialchars($donor['Line1']); ?>" required>
                    </div>
                    <div class="two">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($donor['City']); ?>" required>
                    </div>
                </div>
                
                <div class="sec4 reveal-on-scroll">
                    <div class="one">
                        <label for="pcode">Postal Code</label>
                        <input type="text" id="pcode" name="pcode" value="<?php echo htmlspecialchars($donor['Postal_Code']); ?>" required>
                    </div>
                    <div class="two">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($donor['Country']); ?>" required>
                    </div>
                </div>
                
                <div class="sec5 reveal-on-scroll">
                    <button type="submit" name="update" class="update">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                </div>
            </form>
            
            <hr>
            
            <!-- Password Change Form -->
            <form method="POST" action="CRUD/edit_donor_process.php">
                <div class="sec1 reveal-on-scroll">
                    <div class="one">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter new password" required>
                    </div>
                    <div class="two">
                        <label for="cPassword">Confirm Password</label>
                        <input type="password" id="cPassword" name="cPassword" placeholder="Confirm new password" required>
                    </div>
                </div>
                
                <div class="sec5 reveal-on-scroll">
                    <button type="submit" name="change" class="change">
                        <i class="fas fa-key"></i> Change Password
                    </button>
                </div>
            </form>
            
            <hr>
            
            <!-- Delete Account Form -->
            <form method="POST" action="CRUD/edit_donor_process.php" onsubmit="return confirmDelete()">
                <div class="sec5 reveal-on-scroll">
                    <button type="submit" name="delete" class="del delete-confirm">
                        <i class="fas fa-trash-alt"></i> Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Reveal animations on scroll
        function revealOnScroll() {
            const elements = document.querySelectorAll('.reveal-on-scroll');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        }
        
        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
        
        // Ripple effect for buttons
        function createRipple(event) {
            const button = event.currentTarget;
            const ripple = document.createElement('span');
            const rect = button.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            button.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        }
        
        document.querySelectorAll('.update, .change, .del').forEach(button => {
            button.addEventListener('click', createRipple);
        });
        
        // Delete confirmation
        function confirmDelete() {
            return confirm('Are you sure you want to delete your account? This action cannot be undone and will remove all your data including appointments.');
        }
        
        // Password validation
        document.getElementById('cPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>

<?php require 'footer.php'; ?> 