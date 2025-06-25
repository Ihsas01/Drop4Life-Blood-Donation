<?php
require 'header.php';
include 'CRUD/add_admin_process.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Account</title>
    <link rel="stylesheet" href="css/add_admin.css?v=2">
    <link rel="stylesheet" href="css/modern-header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="js/function.js" defer></script>
</head>

<body>
    <main>
        <section class="modern-admin-form-section">
            <form id="create-new-account" class="modern-admin-form animate__animated animate__fadeInUp" method="post" action="CRUD/add_admin_process.php" onsubmit="return validateForm()">
                <h1 class="form-title"><i class="fas fa-user-shield"></i> Create New Admin Account</h1>
                <div class="form-row">
                    <div class="form-group">
                        <label for="UserName"><i class="fas fa-user"></i> Username</label>
                        <input class="input-field" type="text" id="UserName" name="Uname" placeholder="Enter username" required autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nic"><i class="fas fa-id-card"></i> NIC</label>
                        <input class="input-field" type="text" id="nic" name="nic" placeholder="Enter NIC" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="dob"><i class="fas fa-calendar-alt"></i> Date of Birth</label>
                        <input class="input-field" type="date" id="dob" name="dob" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" onchange="verifyAgeOnChange()" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-venus-mars"></i> Gender</label>
                        <div class="gender-options">
                            <input type="radio" id="gender-male" name="gender" value="MALE" required>
                            <label for="gender-male" class="gender-label"><i class="fas fa-mars"></i> Male</label>
                            <input type="radio" id="gender-female" name="gender" value="FEMALE">
                            <label for="gender-female" class="gender-label"><i class="fas fa-venus"></i> Female</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber"><i class="fas fa-phone"></i> Phone Number</label>
                        <input class="input-field" type="text" id="phoneNumber" name="phone" maxlength="10" placeholder="Enter phone number" required autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input class="input-field" type="email" id="email" name="email" placeholder="Enter email" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="passkey"><i class="fas fa-key"></i> Passkey</label>
                        <input class="input-field" type="text" id="passkey" name="passkey" placeholder="Enter passkey" required autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                        <input class="input-field" type="password" id="password" name="password" placeholder="Enter password" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm Password</label>
                        <input class="input-field" type="password" id="confirmPassword" name="cPassword" placeholder="Confirm password" required autocomplete="off">
                    </div>
                </div>
                <div class="form-row form-terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" class="terms-label">I agree to the Drop4Life <a href="terms.php" target="_blank">Terms</a> & <a href="privacy.php" target="_blank">Privacy Policy</a></label>
                </div>
                <div class="form-row form-actions">
                    <button type="reset" class="btn-reset"><i class="fas fa-undo"></i> Reset</button>
                    <button type="submit" class="btn-submit" onclick="return confirm('Ensure that all the provided data is accurate. Due to security reasons, editing most of the data is restricted.')"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </form>
        </section>
    </main>
    <script>
    function validateForm() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
      }
      var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      if (!passwordRegex.test(password)) {
        alert("Password must contain at least 8 characters including one uppercase letter, one special character, and one digit.");
        return false;
      }
      var termsCheckbox = document.getElementById("terms");
      if (!termsCheckbox.checked) {
        alert("Please agree to the Terms & Privacy Policy.");
        return false;
      }
      return true;
    }
    </script>
</body>
</html>

<?php
require 'footer.php';
?>