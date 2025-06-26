<link rel="stylesheet" href="css/modern-header-footer.css" />

<!-- Modern Footer -->
<footer class="modern-footer">
    <!-- Removed footer wave SVG section -->
    <div class="footer-container">
        <!-- Main Footer Content -->
        <div class="footer-main">
            <!-- Brand Section -->
            <div class="footer-brand-section">
                <div class="footer-brand">
                    <div class="brand-logo">
                        <img src="images/logo.png" alt="Drop4Life Logo" class="footer-logo">
                        <div class="logo-glow-effect"></div>
                    </div>
                    <h3 class="brand-name">Drop4Life</h3>
                    <p class="brand-description">
                        Connecting blood donors with hospitals urgently in need. Your donation can save lives. 
                        Join us today and make a difference in the lives of those in need of critical care.
                    </p>
                    <div class="brand-stats">
                        <div class="stat-item">
                            <span class="stat-number" data-target="10000">0</span>
                            <span class="stat-label">Lives Saved</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number" data-target="5000">0</span>
                            <span class="stat-label">Donors</span>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Links -->
                <div class="footer-social">
                    <h4 class="social-title">Follow Us</h4>
                    <div class="social-links">
                        <a href="#" class="social-link facebook" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link twitter" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link instagram" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link linkedin" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links Section -->
            <div class="footer-links-section">
                <div class="footer-links-group">
                    <h4 class="links-title">Quick Links</h4>
                    <ul class="footer-links-list">
                        <li><a href="index.php" class="footer-link"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="guide.php" class="footer-link"><i class="fas fa-book-open"></i> Guide</a></li>
                        <li><a href="locations.php" class="footer-link"><i class="fas fa-map-marker-alt"></i> Locations</a></li>
                        <li><a href="faq.php" class="footer-link"><i class="fas fa-question-circle"></i> FAQ</a></li>
                    </ul>
                </div>

                <div class="footer-links-group">
                    <h4 class="links-title">Support</h4>
                    <ul class="footer-links-list">
                        <li><a href="contactUs.php" class="footer-link"><i class="fas fa-envelope"></i> Contact Us</a></li>
                        <li><a href="feedback.php" class="footer-link"><i class="fas fa-comments"></i> Feedback</a></li>
                        <li><a href="terms.php" class="footer-link"><i class="fas fa-file-contract"></i> Terms</a></li>
                        <li><a href="privacy.php" class="footer-link"><i class="fas fa-shield-alt"></i> Privacy</a></li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter Section -->
            <div class="footer-newsletter-section">
                <h4 class="newsletter-title">Stay Updated</h4>
                <p class="newsletter-description">Subscribe for updates on blood donation campaigns.</p>
                
                <form class="newsletter-form" onsubmit="event.preventDefault(); handleNewsletterSubmit();">
                    <div class="newsletter-input-group">
                        <input type="email" id="newsletter-email" class="newsletter-input" placeholder="Enter your email" required />
                        <button type="submit" class="newsletter-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Section -->
            <div class="footer-contact">
                <h4>Contact</h4>
                <p>Name: Ihsas</p>
                <p>Contact Number: 077xxxxxxx</p>
                <p>Email: mohamedihsas001@gmail.com</p>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="copyright">
                <p>&copy; 2024 Drop4Life Blood Donation System. All rights reserved.</p>
                <p class="team-credit">Developed with ❤️ by MET_WD_02 Team</p>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>
</footer>

<script>
function handleNewsletterSubmit() {
    const email = document.getElementById('newsletter-email').value;
    if (email) {
        alert('Thank you for subscribing!');
        document.getElementById('newsletter-email').value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const backToTopBtn = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });
    
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
</script>

</footer>
</body>
</html>