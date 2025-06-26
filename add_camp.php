<?php
require 'header.php';
include 'CRUD/add_camp_process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blood Camp - Drop4Life</title>
    <link rel="stylesheet" href="css/add_camp.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <div class="header-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h1>Create Blood Camp</h1>
                <p>Organize a life-saving blood donation event</p>
            </div>

            <form method="post" class="camp-form">
                <div class="form-grid">
                    <!-- Camp Details Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> Camp Details</h3>
                        <div class="input-group">
                            <div class="input-field">
                                <label for="name">Camp Name</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-tag"></i>
                                    <input type="text" id="name" name="name" placeholder="Enter camp name" required/>
                                </div>
                            </div>
                            <div class="input-field">
                                <label for="ledby">Led by Dr.</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user-md"></i>
                                    <input type="text" id="ledby" name="ledby" placeholder="Enter doctor's name" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
                        <div class="input-group">
                            <div class="input-field full-width">
                                <label for="line1">Address Line 1</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-home"></i>
                                    <input type="text" id="line1" name="line1" placeholder="Enter street address" required/>
                                </div>
                            </div>
                            <div class="input-field">
                                <label for="city">City</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-city"></i>
                                    <input type="text" id="city" name="city" placeholder="Enter city" required/>
                                </div>
                            </div>
                            <div class="input-field">
                                <label for="postal_code">Postal Code</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-mail-bulk"></i>
                                    <input type="text" id="postal_code" name="postal_code" placeholder="Enter postal code" required/>
                                </div>
                            </div>
                            <div class="input-field">
                                <label for="country">Country</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-globe"></i>
                                    <input type="text" id="country" name="country" placeholder="Enter country" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date & Time Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-calendar-alt"></i> Date & Time</h3>
                        <div class="input-group">
                            <div class="input-field">
                                <label for="date">Date</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-calendar"></i>
                                    <input type="date" id="date" name="date" oninput="validateDate()" required/>
                                </div>
                            </div>
                            <div class="input-field">
                                <label for="time">Time</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-clock"></i>
                                    <input type="text" id="time" name="time" placeholder="HH:MM" required/>
                                </div>
                            </div>
                            <div class="input-field">
                                <label for="meridiem">AM/PM</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-sun"></i>
                                    <select id="meridiem" name="meridiem">
                                        <option value="AM">AM</option>
                                        <option value="PM">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit" class="submit-btn" onclick="return confirm('Please ensure all information is accurate. Most data cannot be edited after submission for security reasons.')">
                        <span class="btn-text">Publish Camp</span>
                        <span class="btn-icon">
                            <i class="fas fa-paper-plane"></i>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/function.js"></script>
    <script>
        // Add smooth animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate form sections on load
            const sections = document.querySelectorAll('.form-section');
            sections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    section.style.transition = 'all 0.6s ease';
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Input focus effects
            const inputs = document.querySelectorAll('.input-wrapper input, .input-wrapper select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });

            // Form validation feedback
            const form = document.querySelector('.camp-form');
            form.addEventListener('submit', function(e) {
                const submitBtn = document.querySelector('.submit-btn');
                submitBtn.classList.add('loading');
                
                setTimeout(() => {
                    submitBtn.classList.remove('loading');
                }, 2000);
            });
        });
    </script>
</body>

<?php
require 'footer.php';
?>
</html>