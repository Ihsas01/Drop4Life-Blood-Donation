// Modern Admin Edit JavaScript - LifeLine Blood Donation System

// Fallback showNotification to prevent ReferenceError before DOMContentLoaded
if (typeof window.showNotification !== 'function') {
    window.showNotification = function(message, type = 'info', duration = 3000) {
        alert(message);
    };
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initializeAnimations();
    initializeNotifications();
    initializePasswordValidation();
    initializeFormHandling();
    initializeInteractiveElements();
    initializeAccessibility();
});

// Animation System
function initializeAnimations() {
    // Stagger animation for edit cards
    const editCards = document.querySelectorAll('.edit-card');
    editCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Parallax effect for background particles
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const particles = document.querySelectorAll('.particle');
        
        particles.forEach((particle, index) => {
            const speed = 0.5 + (index * 0.1);
            particle.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Smooth reveal animations for form elements
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.form-group, .info-item').forEach(element => {
        observer.observe(element);
    });
}

// Notification System
function initializeNotifications() {
    const toast = document.getElementById('notificationToast');
    
    // Show notification function
    window.showNotification = function(message, type = 'info', duration = 3000) {
        const toastContent = toast.querySelector('.toast-content');
        const toastIcon = toast.querySelector('.toast-icon');
        const toastMessage = toast.querySelector('.toast-message');
        
        // Set icon based on type
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        
        toastIcon.className = `toast-icon ${icons[type] || icons.info}`;
        toastMessage.textContent = message;
        
        // Set colors based on type
        const colors = {
            success: '#4ade80',
            error: '#f87171',
            warning: '#fbbf24',
            info: '#60a5fa'
        };
        
        toast.style.borderLeftColor = colors[type] || colors.info;
        
        // Show toast
        toast.classList.add('show');
        
        // Auto hide
        setTimeout(() => {
            toast.classList.remove('show');
        }, duration);
    };
}

// Password Validation System
function initializePasswordValidation() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('cPassword');
    const requirements = document.querySelectorAll('.requirement');
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            validatePassword(this.value);
        });
    }
    
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            validateConfirmPassword();
        });
    }
    
    function validatePassword(password) {
        const requirements = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            number: /\d/.test(password),
            special: /[@$!%*?&]/.test(password)
        };
        
        // Update requirement indicators
        Object.keys(requirements).forEach(req => {
            const requirementElement = document.querySelector(`[data-requirement="${req}"]`);
            if (requirementElement) {
                if (requirements[req]) {
                    requirementElement.classList.add('valid');
                    requirementElement.querySelector('i').className = 'fas fa-check-circle';
                } else {
                    requirementElement.classList.remove('valid');
                    requirementElement.querySelector('i').className = 'fas fa-circle';
                }
            }
        });
        
        return Object.values(requirements).every(Boolean);
    }
    
    function validateConfirmPassword() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword && password !== confirmPassword) {
            confirmPasswordInput.style.borderColor = '#f87171';
            showNotification('Passwords do not match', 'error');
        } else {
            confirmPasswordInput.style.borderColor = '';
        }
    }
}

// Form Handling
function initializeFormHandling() {
    // Profile form handling
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<div class="loading"></div>';
            submitBtn.disabled = true;
            
            // Simulate processing time (remove in production)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                showNotification('Profile updated successfully!', 'success');
            }, 1000);
        });
    }
    
    // Password form handling
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('cPassword').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                showNotification('Passwords do not match', 'error');
                return false;
            }
            
            const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                e.preventDefault();
                showNotification('Password does not meet requirements', 'error');
                return false;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<div class="loading"></div>';
            submitBtn.disabled = true;
            
            // Simulate processing time (remove in production)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                showNotification('Password changed successfully!', 'success');
            }, 1000);
        });
    }
}

// Interactive Elements
function initializeInteractiveElements() {
    // Enhanced button interactions
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        // Ripple effect
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Card hover effects
    document.querySelectorAll('.edit-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Input focus effects
    document.querySelectorAll('.input-wrapper input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
}

// Password Toggle Function
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggleBtn = input.parentElement.querySelector('.toggle-password i');
    
    if (input.type === 'password') {
        input.type = 'text';
        toggleBtn.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        toggleBtn.className = 'fas fa-eye';
    }
}

// Delete Confirmation
function confirmDelete() {
    return confirm('Are you absolutely sure you want to delete your profile? This action cannot be undone.');
}

// Form Validation (Legacy function for compatibility)
function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('cPassword').value;
    
    if (password !== confirmPassword) {
        showNotification('Passwords do not match', 'error');
        return false;
    }
    
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordRegex.test(password)) {
        showNotification('Password must contain at least 8 characters including one uppercase letter, one special character, and one digit.', 'error');
        return false;
    }
    
    return true;
}

// Accessibility Features
function initializeAccessibility() {
    // Add ARIA labels and roles
    document.querySelectorAll('.action-btn').forEach(btn => {
        if (!btn.getAttribute('aria-label')) {
            const text = btn.textContent.trim();
            btn.setAttribute('aria-label', text);
        }
    });
    
    // Focus management
    document.querySelectorAll('.edit-card').forEach(card => {
        card.setAttribute('tabindex', '0');
        card.setAttribute('role', 'button');
        
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                // Focus the first input in the card
                const firstInput = this.querySelector('input');
                if (firstInput) {
                    firstInput.focus();
                }
            }
        });
    });
    
    // Skip to content link
    const skipLink = document.createElement('a');
    skipLink.href = '#main-content';
    skipLink.textContent = 'Skip to main content';
    skipLink.className = 'skip-link';
    skipLink.style.cssText = `
        position: absolute;
        top: -40px;
        left: 6px;
        background: var(--primary-color);
        color: white;
        padding: 8px;
        text-decoration: none;
        border-radius: 4px;
        z-index: 10000;
    `;
    
    skipLink.addEventListener('focus', function() {
        this.style.top = '6px';
    });
    
    skipLink.addEventListener('blur', function() {
        this.style.top = '-40px';
    });
    
    document.body.insertBefore(skipLink, document.body.firstChild);
    
    // Add main content ID
    const mainContent = document.querySelector('.edit-dashboard');
    if (mainContent) {
        mainContent.id = 'main-content';
    }
}

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Performance Optimization
const optimizedScrollHandler = throttle(function() {
    // Handle scroll-based animations
}, 16); // ~60fps

window.addEventListener('scroll', optimizedScrollHandler);

// Error Handling
window.addEventListener('error', function(e) {
    console.error('Admin Edit Error:', e.error);
    showNotification('An error occurred. Please refresh the page.', 'error');
});

// Export functions for global use
window.AdminEdit = {
    showNotification,
    togglePassword,
    confirmDelete,
    validateForm,
    debounce,
    throttle
}; 