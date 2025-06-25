<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - Frequently Asked Questions</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      overflow-x: hidden;
      color: #333;
    }

    /* Animated Background */
    .animated-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #f5576c);
      background-size: 400% 400%;
      animation: gradientShift 20s ease infinite;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating Elements */
    .floating-elements {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      pointer-events: none;
    }

    .floating-element {
      position: absolute;
      width: 6px;
      height: 6px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-30px) rotate(180deg); opacity: 1; }
    }

    /* Main Container */
    .faq-container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 2rem;
      position: relative;
      z-index: 1;
    }

    /* Hero Section */
    .hero-section {
      text-align: center;
      margin-bottom: 4rem;
      animation: slideInDown 1s ease-out;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, #fff, #f0f0f0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      text-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .hero-subtitle {
      font-size: 1.3rem;
      color: rgba(255, 255, 255, 0.9);
      font-weight: 400;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* Search Section */
    .search-section {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 2rem;
      margin-bottom: 3rem;
      animation: slideInUp 1s ease-out 0.2s both;
    }

    .search-container {
      display: flex;
      gap: 1rem;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
    }

    .search-input {
      flex: 1;
      min-width: 300px;
      padding: 1rem 1.5rem;
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 15px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .search-input::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .search-input:focus {
      outline: none;
      border-color: rgba(255, 255, 255, 0.5);
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .search-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.6);
      font-size: 1.2rem;
    }

    .search-wrapper {
      position: relative;
      flex: 1;
      min-width: 300px;
    }

    .search-input {
      padding-left: 3rem;
    }

    /* FAQ Categories */
    .faq-categories {
      display: flex;
      gap: 1rem;
      margin-bottom: 3rem;
      flex-wrap: wrap;
      justify-content: center;
    }

    .category-btn {
      padding: 0.75rem 1.5rem;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      color: rgba(255, 255, 255, 0.8);
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .category-btn:hover,
    .category-btn.active {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* FAQ List */
    .faq-list {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .faq-item {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      animation: slideInUp 0.8s ease-out;
      opacity: 0;
      transform: translateY(30px);
    }

    .faq-item.show {
      opacity: 1;
      transform: translateY(0);
    }

    .faq-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0,0,0,0.2);
      border-color: rgba(255, 255, 255, 0.4);
    }

    .faq-item.active {
      border-color: rgba(102, 126, 234, 0.5);
      box-shadow: 0 20px 50px rgba(102, 126, 234, 0.2);
    }

    .accordion-btn {
      width: 100%;
      padding: 2rem;
      background: none;
      border: none;
      color: white;
      font-size: 1.1rem;
      font-weight: 600;
      text-align: left;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.3s ease;
      position: relative;
    }

    .accordion-btn:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    .accordion-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, #667eea, #764ba2);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .faq-item.active .accordion-btn::before {
      transform: scaleX(1);
    }

    .accordion-icon {
      width: 24px;
      height: 24px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      flex-shrink: 0;
      margin-left: 1rem;
    }

    .faq-item.active .accordion-icon {
      transform: rotate(180deg);
      background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .accordion-icon i {
      color: white;
      font-size: 0.8rem;
      transition: all 0.3s ease;
    }

    .accordion-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      background: rgba(255, 255, 255, 0.05);
    }

    .accordion-panel {
      padding: 0 2rem 2rem 2rem;
      color: rgba(255, 255, 255, 0.9);
      line-height: 1.6;
      font-size: 1rem;
    }

    /* No Results */
    .no-results {
      text-align: center;
      padding: 3rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 1.2rem;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      backdrop-filter: blur(20px);
    }

    /* Contact Section */
    .contact-section {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      margin-top: 4rem;
      text-align: center;
      animation: slideInUp 1s ease-out 0.4s both;
    }

    .contact-title {
      font-size: 2rem;
      font-weight: 700;
      color: white;
      margin-bottom: 1rem;
    }

    .contact-text {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 2rem;
      font-size: 1.1rem;
    }

    .contact-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 1rem 2rem;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      text-decoration: none;
      border-radius: 15px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .contact-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    /* Animations */
    @keyframes slideInDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .faq-container {
        padding: 1rem;
      }
      
      .search-container {
        flex-direction: column;
      }
      
      .search-wrapper {
        min-width: 100%;
      }
      
      .faq-categories {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 0.5rem;
      }
      
      .category-btn {
        white-space: nowrap;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .accordion-btn {
        padding: 1.5rem;
        font-size: 1rem;
      }
      
      .accordion-panel {
        padding: 0 1.5rem 1.5rem 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="animated-bg"></div>
  
  <!-- Floating Elements -->
  <div class="floating-elements" id="floatingElements"></div>

  <div class="faq-container">
    <!-- Hero Section -->
    <div class="hero-section">
      <h1 class="hero-title">Frequently Asked Questions</h1>
      <p class="hero-subtitle">Find answers to common questions about blood donation. Can't find what you're looking for? Contact us for personalized assistance.</p>
    </div>

    <!-- Search Section -->
    <div class="search-section">
      <div class="search-container">
        <div class="search-wrapper">
          <i class="fas fa-search search-icon"></i>
          <input type="text" class="search-input" id="searchInput" placeholder="Search for questions..." />
        </div>
      </div>
    </div>

    <!-- FAQ Categories -->
    <div class="faq-categories">
      <button class="category-btn active" data-category="all">All Questions</button>
      <button class="category-btn" data-category="eligibility">Eligibility</button>
      <button class="category-btn" data-category="safety">Safety</button>
      <button class="category-btn" data-category="process">Process</button>
      <button class="category-btn" data-category="medical">Medical</button>
    </div>

    <!-- FAQ List -->
    <div class="faq-list" id="faqList">
      <div class="faq-item" data-category="eligibility" data-search="who can donate blood eligibility requirements age weight">
        <button class="accordion-btn" aria-expanded="false">
          <span>Who can donate blood?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>Individuals who are generally healthy, weigh at least 110 pounds, and are 17 years of age or older (16 with parental consent in some regions) can usually donate blood. Specific eligibility criteria may vary by country or donation center, so it's best to check with your local blood donation organization.</p>
          </div>
        </div>
      </div>

      <div class="faq-item" data-category="process" data-search="how often can donate frequency interval weeks">
        <button class="accordion-btn" aria-expanded="false">
          <span>How often can I donate blood?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>The rules of your neighbourhood blood donation facility and your health state usually determine how frequently you donate blood. Donors of whole blood can typically give every eight to twelve weeks. For some donation types, like double red cell or platelet donations, the interval could change.</p>
          </div>
        </div>
      </div>

      <div class="faq-item" data-category="safety" data-search="is it safe to donate blood safety procedures">
        <button class="accordion-btn" aria-expanded="false">
          <span>Is it safe to donate blood?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>Yes, for the majority of healthy people, giving blood is safe. Blood donation facilities follow stringent procedures to guarantee the security of both donors and receivers. To ascertain your eligibility before donating, a health test will be performed. Trained personnel will supervise the donation procedure to reduce any potential hazards.</p>
          </div>
        </div>
      </div>

      <div class="faq-item" data-category="process" data-search="does blood donation hurt pain discomfort">
        <button class="accordion-btn" aria-expanded="false">
          <span>Does blood donation hurt?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>Although there is a chance that some individuals will feel a slight pinch or slight discomfort when the needle is inserted, most blood donation procedures are painless. You can experience small side effects like bruising or dizziness after donation, but these are often transient.</p>
          </div>
        </div>
      </div>

      <div class="faq-item" data-category="medical" data-search="medical condition medication donate">
        <button class="accordion-btn" aria-expanded="false">
          <span>Can I donate blood if I have a medical condition or take medication?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>The use of some drugs or medical conditions may limit your ability to donate blood. During the pre-donation screening procedure, it is imperative that you provide any pertinent information on your medical history and current medications. The personnel will evaluate your eligibility in light of this data as well as any applicable policies.</p>
          </div>
        </div>
      </div>

      <div class="faq-item" data-category="process" data-search="how will donated blood be used purpose">
        <button class="accordion-btn" aria-expanded="false">
          <span>How will my donated blood be used?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>Donated blood can be used for various medical purposes, including surgeries, treatments for medical conditions, and emergencies such as accidents or trauma. Blood donation centers work closely with hospitals and healthcare providers to ensure that donated blood is allocated where it's needed most.</p>
          </div>
        </div>
      </div>

      <div class="faq-item" data-category="process" data-search="what to expect before during after donation">
        <button class="accordion-btn" aria-expanded="false">
          <span>What should I expect before, during, and after donation?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>Before donation, you'll complete a health questionnaire and have a mini-physical. During donation, you'll be seated comfortably while blood is collected (usually 8-10 minutes). After donation, you'll rest briefly and receive refreshments. The entire process takes about an hour, and you should avoid strenuous activity for the rest of the day.</p>
          </div>
        </div>
      </div>

      <div class="faq-item" data-category="eligibility" data-search="blood type requirements different types">
        <button class="accordion-btn" aria-expanded="false">
          <span>Are there specific blood type requirements?</span>
          <div class="accordion-icon">
            <i class="fas fa-chevron-down"></i>
          </div>
        </button>
        <div class="accordion-content">
          <div class="accordion-panel">
            <p>All blood types are needed! While some blood types are more common than others, every type is valuable. O-negative blood is considered the universal donor type and is often in high demand for emergencies. Your blood type will be determined during your first donation.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- No Results Message -->
    <div class="no-results" id="noResults" style="display: none;">
      <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
      <h3>No questions found</h3>
      <p>Try adjusting your search terms or browse all questions above.</p>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
      <h2 class="contact-title">Still Have Questions?</h2>
      <p class="contact-text">Can't find the answer you're looking for? Our support team is here to help you with any specific questions about blood donation.</p>
      <a href="contactUs.php" class="contact-btn">
        <i class="fas fa-envelope"></i>
        Contact Us
      </a>
    </div>
  </div>

  <script>
    // Create floating elements
    function createFloatingElements() {
      const container = document.getElementById('floatingElements');
      const elementCount = 25;
      
      for (let i = 0; i < elementCount; i++) {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.left = Math.random() * 100 + '%';
        element.style.animationDelay = Math.random() * 8 + 's';
        element.style.animationDuration = (Math.random() * 4 + 4) + 's';
        container.appendChild(element);
      }
    }

    // FAQ Accordion functionality
    document.querySelectorAll('.accordion-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const faqItem = this.parentElement;
        const content = this.nextElementSibling;
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        
        // Close all other items
        document.querySelectorAll('.faq-item').forEach(item => {
          if (item !== faqItem) {
            item.classList.remove('active');
            const otherBtn = item.querySelector('.accordion-btn');
            const otherContent = item.querySelector('.accordion-content');
            otherBtn.setAttribute('aria-expanded', 'false');
            otherContent.style.maxHeight = null;
          }
        });
        
        // Toggle current item
        if (isExpanded) {
          faqItem.classList.remove('active');
          this.setAttribute('aria-expanded', 'false');
          content.style.maxHeight = null;
        } else {
          faqItem.classList.add('active');
          this.setAttribute('aria-expanded', 'true');
          content.style.maxHeight = content.scrollHeight + 'px';
        }
      });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      let visibleCount = 0;

      faqItems.forEach(item => {
        const searchData = item.dataset.search.toLowerCase();
        const questionText = item.querySelector('.accordion-btn span').textContent.toLowerCase();
        const answerText = item.querySelector('.accordion-panel p').textContent.toLowerCase();
        
        if (searchData.includes(searchTerm) || questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
          item.style.display = 'block';
          item.classList.add('show');
          visibleCount++;
        } else {
          item.style.display = 'none';
          item.classList.remove('show');
        }
      });

      // Show/hide no results message
      if (visibleCount === 0 && searchTerm.length > 0) {
        noResults.style.display = 'block';
      } else {
        noResults.style.display = 'none';
      }
    });

    // Category filtering
    document.querySelectorAll('.category-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const category = this.dataset.category;
        
        // Update active button
        document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Filter items
        faqItems.forEach(item => {
          if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            item.classList.add('show');
          } else {
            item.style.display = 'none';
            item.classList.remove('show');
          }
        });
        
        // Clear search
        searchInput.value = '';
        noResults.style.display = 'none';
      });
    });

    // Animate FAQ items on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, observerOptions);

    // Observe FAQ items
    faqItems.forEach(item => {
      observer.observe(item);
    });

    // Add hover effects to category buttons
    document.querySelectorAll('.category-btn').forEach(btn => {
      btn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
      });
      
      btn.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });

    // Initialize on page load
    window.addEventListener('load', function() {
      createFloatingElements();
      
      // Show first few FAQ items immediately
      faqItems.forEach((item, index) => {
        if (index < 3) {
          setTimeout(() => {
            item.classList.add('show');
          }, index * 200);
        }
      });
    });
  </script>

  <?php require 'footer.php'; ?>
</body>
</html>