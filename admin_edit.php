<?php
include 'CRUD/edit_admin_process.php';
require 'header.php';

$query = "SELECT *
     FROM admin 
     WHERE Admin_id='$_SESSION[userID]'";
$result_admin = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result_admin);
$Email = $row['Email'];
$Phone = $row['Phone_no'];
$Password = $row['A_Password'];

if (!$result_admin) {
    die('Error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Drop4Life Admin</title>
    <link rel="stylesheet" href="css/admin_edit.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Animated Background -->
    <div class="edit-bg">
        <div class="bg-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <main class="edit-dashboard">
        <!-- Header Section -->
        <section class="edit-header">
            <div class="header-content">
                <div class="back-section">
                    <a href="admin_panel.php" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Dashboard</span>
                    </a>
                </div>
                
                <div class="profile-section">
                    <div class="profile-avatar">
                        <div class="avatar-ring"></div>
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="profile-info">
                        <h1 class="profile-title">Edit Profile</h1>
                        <p class="profile-subtitle">Update your account information</p>
                        <div class="profile-status">
                            <span class="status-dot"></span>
                            <span class="status-text">Administrator</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="edit-content">
            <div class="content-grid">
                <!-- Profile Information Card -->
                <div class="edit-card profile-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-user-edit"></i>
                            <h2>Profile Information</h2>
                        </div>
                        <div class="card-subtitle">
                            Update your personal details
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="current-info">
                            <div class="info-item">
                                <i class="fas fa-user"></i>
                                <div class="info-content">
                                    <label>Username</label>
                                    <span><?php echo $_SESSION['username']; ?></span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <div class="info-content">
                                    <label>Current Email</label>
                                    <span><?php echo $_SESSION['email']; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <form method="post" class="edit-form" id="profileForm">
                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" name="email" id="email" value="<?php echo $Email; ?>" required>
                                    <div class="input-focus-border"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">
                                    <i class="fas fa-phone"></i>
                                    Phone Number
                                </label>
                                <div class="input-wrapper">
                                    <input type="tel" name="number" id="phone" value="<?php echo $Phone; ?>" required>
                                    <div class="input-focus-border"></div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="AdminID" value="<?php echo $_SESSION['userID'] ?>">
                            
                            <div class="form-actions">
                                <button type="submit" name="update" class="action-btn update-btn">
                                    <i class="fas fa-save"></i>
                                    <span>Update Profile</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Change Card -->
                <div class="edit-card password-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-lock"></i>
                            <h2>Change Password</h2>
                        </div>
                        <div class="card-subtitle">
                            Update your account password
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="password-requirements">
                            <h4>Password Requirements</h4>
                            <ul class="requirements-list">
                                <li class="requirement" data-requirement="length">
                                    <i class="fas fa-circle"></i>
                                    <span>At least 8 characters</span>
                                </li>
                                <li class="requirement" data-requirement="uppercase">
                                    <i class="fas fa-circle"></i>
                                    <span>One uppercase letter</span>
                                </li>
                                <li class="requirement" data-requirement="number">
                                    <i class="fas fa-circle"></i>
                                    <span>One number</span>
                                </li>
                                <li class="requirement" data-requirement="special">
                                    <i class="fas fa-circle"></i>
                                    <span>One special character</span>
                                </li>
                            </ul>
                        </div>
                        
                        <form method="post" class="edit-form" id="passwordForm" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="password">
                                    <i class="fas fa-key"></i>
                                    New Password
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" name="password" id="password" required>
                                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="input-focus-border"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="cPassword">
                                    <i class="fas fa-key"></i>
                                    Confirm Password
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" name="cPassword" id="cPassword" required>
                                    <button type="button" class="toggle-password" onclick="togglePassword('cPassword')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="input-focus-border"></div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" name="change" class="action-btn change-btn">
                                    <i class="fas fa-key"></i>
                                    <span>Change Password</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Danger Zone Card -->
                <div class="edit-card danger-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            <h2>Danger Zone</h2>
                        </div>
                        <div class="card-subtitle">
                            Irreversible actions
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="danger-warning">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                        
                        <form method="post" class="danger-form">
                            <input type="hidden" name="AdminID" value="<?php echo $_SESSION['userID'] ?>">
                            <button type="submit" name="delete" class="action-btn delete-btn" onclick="return confirmDelete()">
                                <i class="fas fa-trash-alt"></i>
                                <span>Delete Profile</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Notification Toast -->
    <div class="notification-toast" id="notificationToast">
        <div class="toast-content">
            <i class="toast-icon"></i>
            <span class="toast-message"></span>
        </div>
        <div class="toast-progress"></div>
    </div>

    <script src="js/admin-edit.js"></script>
</body>
</html>

<?php require 'footer.php'; ?>