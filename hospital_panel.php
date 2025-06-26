<?php
session_start();
if (!isset($_SESSION["userType"]) || $_SESSION["userType"] != "hospital") {
    header("Location: hospital_login.php");
    exit();
}

include 'includes/dbh.inc.php';

// Get hospital information
$hospital_id = $_SESSION["userID"];
$query = "SELECT * FROM hospital WHERE Hospital_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $hospital_id);
$stmt->execute();
$result = $stmt->get_result();
$hospital = $result->fetch_assoc();

// Get appointments for this hospital
$appointment_query = "SELECT a.*, 
                     COALESCE(d.Salutation, '') as Donor_Salutation,
                     COALESCE(d.F_name, '') as Donor_Fname,
                     COALESCE(d.L_name, '') as Donor_Lname,
                     COALESCE(d.Blood_Group, '') as Donor_BloodGroup,
                     COALESCE(d.Phone_no, '') as Donor_Phone,
                     COALESCE(g.F_name, '') as Guest_Fname,
                     COALESCE(g.L_name, '') as Guest_Lname,
                     COALESCE(g.Blood_Group, '') as Guest_BloodGroup,
                     COALESCE(g.Email, '') as Guest_Email
                     FROM appointment a 
                     LEFT JOIN donor d ON a.A_Donor_id = d.Donor_id 
                     LEFT JOIN guest g ON a.A_Guest_id = g.Guest_id 
                     WHERE a.A_Hospital_id = ? 
                     ORDER BY a.A_Date DESC, a.A_Time DESC";
$stmt = $con->prepare($appointment_query);
$stmt->bind_param("i", $hospital_id);
$stmt->execute();
$appointments = $stmt->get_result();

// Get camps for this hospital
$camp_query = "SELECT * FROM camp WHERE C_Hospital_id = ? ORDER BY C_Date DESC";
$stmt = $con->prepare($camp_query);
$stmt->bind_param("i", $hospital_id);
$stmt->execute();
$camps = $stmt->get_result();

include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Panel - Blood Donation System</title>
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
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .welcome-text {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hospital-info {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .nav-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 15px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .nav-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        }

        .nav-btn.logout {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }

        .content-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .appointment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .appointment-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #667eea;
            transition: transform 0.3s ease;
        }

        .appointment-card:hover {
            transform: translateY(-5px);
        }

        .appointment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .appointment-id {
            background: #667eea;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .appointment-status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #ffd93d;
            color: #333;
        }

        .status-approved {
            background: #6bcf7f;
            color: white;
        }

        .appointment-details {
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
        }

        .detail-value {
            color: #333;
        }

        .appointment-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .approve-btn {
            background: #6bcf7f;
            color: white;
        }

        .approve-btn:hover {
            background: #5bbf6f;
        }

        .reject-btn {
            background: #ff6b6b;
            color: white;
        }

        .reject-btn:hover {
            background: #ee5a52;
        }

        .no-appointments {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 2rem;
        }

        .camp-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .camp-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #764ba2;
        }

        .camp-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 0.5rem;
        }

        .camp-details {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .camp-location {
            color: #333;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .nav-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .appointment-grid {
                grid-template-columns: 1fr;
            }
            
            .welcome-text {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
            <p class="hospital-info">Hospital Management Panel</p>
            
            <!-- Navigation Buttons -->
            <div class="nav-buttons">
                <a href="hospital_edit.php" class="nav-btn">
                    <i class="fas fa-user-edit"></i>
                    Edit Profile
                </a>
                <a href="add_camp.php" class="nav-btn">
                    <i class="fas fa-plus-circle"></i>
                    Add Camp
                </a>
                <a href="logout.php" class="nav-btn logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- Manage Appointments Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-calendar-check"></i>
                Manage Appointments
            </h2>
            
            <?php if ($appointments->num_rows > 0): ?>
                <div class="appointment-grid">
                    <?php while ($appointment = $appointments->fetch_assoc()): ?>
                        <div class="appointment-card">
                            <div class="appointment-header">
                                <span class="appointment-id">#<?php echo $appointment['Appointment_id']; ?></span>
                                <span class="appointment-status <?php echo $appointment['Status'] ? 'status-approved' : 'status-pending'; ?>">
                                    <?php echo $appointment['Status'] ? 'Approved' : 'Pending'; ?>
                                </span>
                            </div>
                            
                            <div class="appointment-details">
                                <?php if ($appointment['A_Donor_id']): ?>
                                    <div class="detail-row">
                                        <span class="detail-label">Donor:</span>
                                        <span class="detail-value">
                                            <?php echo htmlspecialchars($appointment['Donor_Salutation'] . ' ' . $appointment['Donor_Fname'] . ' ' . $appointment['Donor_Lname']); ?>
                                        </span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Blood Group:</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($appointment['Donor_BloodGroup']); ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Phone:</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($appointment['Donor_Phone']); ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="detail-row">
                                        <span class="detail-label">Guest:</span>
                                        <span class="detail-value">
                                            <?php echo htmlspecialchars($appointment['Guest_Fname'] . ' ' . $appointment['Guest_Lname']); ?>
                                        </span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Blood Group:</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($appointment['Guest_BloodGroup']); ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Email:</span>
                                        <span class="detail-value"><?php echo htmlspecialchars($appointment['Guest_Email']); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="detail-row">
                                    <span class="detail-label">Date:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($appointment['A_Date']); ?></span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Time:</span>
                                    <span class="detail-value"><?php echo htmlspecialchars($appointment['A_Time'] . ' ' . $appointment['A_Meridiem']); ?></span>
                                </div>
                            </div>
                            
                            <?php if (!$appointment['Status']): ?>
                                <div class="appointment-actions">
                                    <form method="post" action="CRUD/hospital_manage_appoint.php" style="display: inline;">
                                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['Appointment_id']; ?>">
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="action-btn approve-btn">Approve</button>
                                    </form>
                                    <form method="post" action="CRUD/hospital_manage_appoint.php" style="display: inline;">
                                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['Appointment_id']; ?>">
                                        <input type="hidden" name="action" value="reject">
                                        <button type="submit" class="action-btn reject-btn">Reject</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="no-appointments">
                    <i class="fas fa-calendar-times" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <p>No appointments found for your hospital.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- History Section -->
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-history"></i>
                Blood Camps History
            </h2>
            
            <?php if ($camps->num_rows > 0): ?>
                <div class="camp-grid">
                    <?php while ($camp = $camps->fetch_assoc()): ?>
                        <div class="camp-card">
                            <div class="camp-name"><?php echo htmlspecialchars($camp['C_Name']); ?></div>
                            <div class="camp-details">
                                <strong>Date:</strong> <?php echo htmlspecialchars($camp['C_Date']); ?><br>
                                <strong>Time:</strong> <?php echo htmlspecialchars($camp['C_Time'] . ' ' . $camp['C_Meridiem']); ?><br>
                                <strong>Led by:</strong> <?php echo htmlspecialchars($camp['Led_By']); ?>
                            </div>
                            <div class="camp-location">
                                <?php echo htmlspecialchars($camp['Line1'] . ', ' . $camp['City'] . ', ' . $camp['Country']); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="no-appointments">
                    <i class="fas fa-calendar-times" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <p>No blood camps found for your hospital.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Add confirmation for logout
        document.querySelector('.logout').addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to logout?')) {
                e.preventDefault();
            }
        });

        // Add confirmation for appointment actions
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const action = this.textContent.toLowerCase();
                if (!confirm(`Are you sure you want to ${action} this appointment?`)) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>

<?php include 'footer.php'; ?> 