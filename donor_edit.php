<?php
require 'includes/dbh.inc.php';
include 'CRUD/edit_donor_process.php';
require 'header.php';

if (isset($_SESSION['edit_success']) && $_SESSION['edit_success']) {
    echo '<div style="background:#d4edda;color:#155724;padding:15px;margin:20px auto 0 auto;border-radius:5px;max-width:600px;text-align:center;font-weight:bold;">Profile updated successfully!</div>';
    unset($_SESSION['edit_success']);
}

$query = "SELECT * FROM donor WHERE Donor_id='" . $_SESSION['userID'] . "'";
$result_donor = mysqli_query($conn, $query);

if (!$result_donor || mysqli_num_rows($result_donor) === 0) {
    echo '<div style="background:#f8d7da;color:#721c24;padding:15px;margin:20px auto 0 auto;border-radius:5px;max-width:600px;text-align:center;font-weight:bold;">Donor details not found.</div>';
    require 'footer.php';
    echo '</html>';
    exit();
}

$row = mysqli_fetch_assoc($result_donor);
$Fname = $row['F_name'];
$Lname = $row['L_name'];
$Email = $row['Email'];
$Phone = $row['Phone_no'];
$Line1 = $row['Line1'];
$city = $row['City'];
$postalCode = $row['Postal_Code'];
$country = $row['Country'];
$Password = $row['D_Password'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/donor_edit.css" />
    <script src="js/modern-ui.js" defer></script>
    <title>Edit Donor Profile</title>
</head>
<body>
    <main class="frame">
        <section class="sec1 reveal-on-scroll">
            <div class="row1">
                <div class="blue">
                    <?php echo '<h2 class="blue">' . htmlspecialchars($_SESSION['username']) . '</h2>'; ?>
                </div>
                <div class="head">
                    <?php echo '<h5 class="head">' . htmlspecialchars($_SESSION['email']) . '</h5>'; ?>
                </div>
            </div>
        </section>
        <section class="reveal-on-scroll">
            <form method="post" style="display:inline;">
                <input type="hidden" name="DonorID" value="<?php echo htmlspecialchars($_SESSION['userID']); ?>">
                <button class="del hero-btn-modern" type="submit" name="delete" onclick="return confirm('Are you Sure ?')" aria-label="Delete Profile">
                    <i class="fa fa-trash"></i> Delete Profile
                </button>
            </form>
        </section>
        <form method="post">
            <section class="sec1 reveal-on-scroll">
                <div class="one">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($Fname); ?>" required>
                </div>
                <div class="one">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($Lname); ?>" required>
                </div>
            </section>
            <section class="sec2 reveal-on-scroll">
                <div class="two">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($Email); ?>" required>
                </div>
                <div class="two">
                    <label for="phone">Phone Number:</label>
                    <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($Phone); ?>" required>
                </div>
            </section>
            <section class="sec3 reveal-on-scroll">
                <div class="three">
                    <label>Address</label>
                </div>
                <div class="three">
                    <label for="line1">Line 1:</label>
                    <input type="text" name="line1" id="line1" value="<?php echo htmlspecialchars($Line1); ?>">
                </div>
                <div class="three">
                    <label for="city">City:</label>
                    <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>">
                </div>
            </section>
            <section class="sec4 reveal-on-scroll">
                <div class="four">
                    <label for="pcode">Postal Code:</label>
                    <input type="text" name="pcode" id="pcode" value="<?php echo htmlspecialchars($postalCode); ?>">
                </div>
                <div class="four">
                    <label for="country">Country:</label>
                    <input type="text" name="country" id="country" value="<?php echo htmlspecialchars($country); ?>">
                </div>
            </section>
            <input type="hidden" name="DonorID" value="<?php echo htmlspecialchars($_SESSION['userID']); ?>">
            <button class="update hero-btn-modern" type="submit" name="update" aria-label="Update Profile">
                <i class="fa fa-save"></i> Update
            </button>
        </form>
        <form method="post" onsubmit="return validateForm()">
            <section class="sec5 reveal-on-scroll">
                <div class="five">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="five">
                    <label for="cPassword">Confirm Password:</label>
                    <input type="password" name="cPassword" id="cPassword">
                </div>
            </section>
            <button class="change hero-btn-modern" type="submit" name="change" aria-label="Change Password">
                <i class="fa fa-key"></i> Change
            </button>
        </form>
    </main>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("cPassword").value;
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert("Password must contain at least 8 characters including one uppercase letter, one special character, and one digit.");
                return false;
            }
            return true;
        }
    </script>
</body>
<?php require 'footer.php'; ?>
</html>