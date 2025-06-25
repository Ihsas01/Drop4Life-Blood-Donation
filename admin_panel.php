<?php
require 'header.php';
require 'CRUD/admin_manage_hospital.php';
require 'CRUD/admin_manage_feedback.php';
require 'includes/function.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Drop4Life</title>
    <link rel="stylesheet" href="css/admin_panel.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Animated Background -->
    <div class="admin-bg">
        <div class="bg-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>

    <main class="admin-dashboard">
        <!-- Header Section -->
        <section class="dashboard-header">
            <div class="header-content">
                <div class="welcome-section">
                    <div class="admin-avatar">
                        <div class="avatar-ring"></div>
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="welcome-text">
                        <h1 class="welcome-title">Welcome back, <span class="admin-name"><?php echo $_SESSION['username']; ?></span></h1>
                        <p class="admin-email"><?php echo $_SESSION['email']; ?></p>
                        <p class="admin-phone">Phone: <?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?></p>
                        <div class="admin-status">
                            <span class="status-dot"></span>
                            <span class="status-text">Administrator</span>
                        </div>
                    </div>
                </div>
                
                <div class="header-actions">
                    <button class="action-btn edit-profile-btn" onclick="document.location='admin_edit.php'">
                        <i class="fas fa-user-edit"></i>
                        <span>Edit Profile</span>
                    </button>
                    <button class="action-btn add-admin-btn" onclick="document.location='add_admin.php'">
                        <i class="fas fa-user-plus"></i>
                        <span>Add Admin</span>
                    </button>
                    <button class="action-btn logout-btn" onclick="document.location='logout.php'">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Log Out</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Dashboard Stats -->
        <section class="dashboard-stats">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number"><?php echo mysqli_num_rows($result_hospitals); ?></h3>
                        <p class="stat-label">Pending Hospitals</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: 75%"></div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number"><?php echo mysqli_num_rows($result_feedbacks); ?></h3>
                        <p class="stat-label">Pending Feedbacks</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: 60%"></div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">24</h3>
                        <p class="stat-label">Total Admins</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: 90%"></div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number"><?php echo date('H:i'); ?></h3>
                        <p class="stat-label">Current Time</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar" style="width: 45%"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="dashboard-content">
            <div class="content-grid">
                <!-- Hospital Management -->
                <div class="content-card hospital-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-hospital-alt"></i>
                            <h2>Hospital Management</h2>
                        </div>
                        <div class="card-actions">
                            <span class="status-badge new">New</span>
                            <a href="admin_history.php" class="history-link">
                                <i class="fas fa-history"></i>
                                History
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="items-container">
                            <?php
                            while ($row = mysqli_fetch_assoc($result_hospitals)) {
                                $HospitalID = $row['Hospital_id'];
                                $Name = $row['H_Name'];
                                $Address = $row['Adds'];
                                $Phone = $row['Tel_no'];
                                $Email = $row['Email'];
                            ?>
                                <div class="item-card hospital-item">
                                    <div class="item-header">
                                        <div class="item-id">
                                            <i class="fas fa-hospital"></i>
                                            <span>Hospital #<?php echo $HospitalID; ?></span>
                                        </div>
                                        <div class="item-status pending">
                                            <span class="status-dot"></span>
                                            <span>Pending</span>
                                        </div>
                                    </div>
                                    
                                    <div class="item-details">
                                        <div class="detail-row">
                                            <i class="fas fa-building"></i>
                                            <span class="detail-label">Name:</span>
                                            <span class="detail-value"><?php echo $Name; ?></span>
                                        </div>
                                        <div class="detail-row">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span class="detail-label">Address:</span>
                                            <span class="detail-value"><?php echo $Address; ?></span>
                                        </div>
                                        <div class="detail-row">
                                            <i class="fas fa-phone"></i>
                                            <span class="detail-label">Phone:</span>
                                            <span class="detail-value"><?php echo $Phone; ?></span>
                                        </div>
                                        <div class="detail-row">
                                            <i class="fas fa-envelope"></i>
                                            <span class="detail-label">Email:</span>
                                            <span class="detail-value"><?php echo $Email; ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="item-actions">
                                        <form method="post" class="action-form">
                                            <input type="hidden" name="HospitalID" value="<?php echo $HospitalID; ?>">
                                            <button class="action-btn approve-btn" name="Approved" type="submit">
                                                <i class="fas fa-check"></i>
                                                <span>Approve</span>
                                            </button>
                                            <button class="action-btn decline-btn" name="Declined" type="submit" onclick="return confirm('Are you sure you want to decline this hospital?')">
                                                <i class="fas fa-times"></i>
                                                <span>Decline</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Feedback Management -->
                <div class="content-card feedback-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-comments-alt"></i>
                            <h2>Feedback Management</h2>
                        </div>
                        <div class="card-actions">
                            <span class="status-badge new">New</span>
                            <a href="admin_history.php" class="history-link">
                                <i class="fas fa-history"></i>
                                History
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="items-container">
                            <?php
                            while ($row = mysqli_fetch_assoc($result_feedbacks)) {
                                $FeedbackID = $row['Feedback_id'];
                                $Comment = $row['Comment'];
                                $DonerID = $row['F_Donor_id'];

                                if ($row['F_Donor_id'] == null) {
                                    $UserName = $row['H_Name'];
                                } else {
                                    $UserName = $row['DonorName'];
                                }
                            ?>
                                <div class="item-card feedback-item">
                                    <div class="item-header">
                                        <div class="item-id">
                                            <i class="fas fa-comment"></i>
                                            <span>Feedback #<?php echo $FeedbackID; ?></span>
                                        </div>
                                        <div class="item-status pending">
                                            <span class="status-dot"></span>
                                            <span>Pending</span>
                                        </div>
                                    </div>
                                    
                                    <div class="item-details">
                                        <div class="detail-row">
                                            <i class="fas fa-user"></i>
                                            <span class="detail-label">From:</span>
                                            <span class="detail-value"><?php echo $UserName; ?></span>
                                        </div>
                                        <div class="detail-row comment-row">
                                            <i class="fas fa-quote-left"></i>
                                            <span class="detail-label">Comment:</span>
                                            <span class="detail-value comment-text"><?php echo $Comment; ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="item-actions">
                                        <form method="post" class="action-form">
                                            <input type="hidden" name="FeedbackID" value="<?php echo $FeedbackID; ?>">
                                            <button class="action-btn approve-btn" name="Approved" type="submit" onclick="return confirm('Are you sure you want to approve this feedback?')">
                                                <i class="fas fa-check"></i>
                                                <span>Approve</span>
                                            </button>
                                            <button class="action-btn decline-btn" name="Declined" type="submit" onclick="return confirm('Are you sure you want to decline this feedback?')">
                                                <i class="fas fa-times"></i>
                                                <span>Decline</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
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

    <script src="js/admin-panel.js"></script>
</body>
</html>

<?php require 'footer.php'; ?>