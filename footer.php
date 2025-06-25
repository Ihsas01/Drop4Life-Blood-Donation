<link rel="stylesheet" href="css/modern-header-footer.css" />

<!-- Modern Footer -->
<footer class="modern-footer">
    <!-- Footer Wave Decoration -->
    <div class="footer-wave">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>

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