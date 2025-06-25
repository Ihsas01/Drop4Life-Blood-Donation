<?php
require 'header.php';
require 'includes/dbh.inc.php';

$query = "SELECT *, CONCAT(line1, ', ', city, ', ', postal_Code, ', ', country) AS H_Address FROM hospital WHERE hospital.Status=1";
$result = mysqli_query($con, $query);

if (!$result) {
  die('Error: ' . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Locations - Find Blood Donation Centers</title>
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
      width: 8px;
      height: 8px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      animation: float 10s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
      50% { transform: translateY(-40px) rotate(180deg); opacity: 1; }
    }

    /* Main Container */
    .locations-container {
      max-width: 1400px;
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

    .hero-image {
      width: 100%;
      max-width: 800px;
      height: 400px;
      object-fit: cover;
      border-radius: 25px;
      margin-bottom: 2rem;
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
      animation: slideInUp 1s ease-out 0.2s both;
      border: 3px solid rgba(255, 255, 255, 0.2);
      transition: all 0.4s ease;
    }

    .hero-image:hover {
      transform: scale(1.02);
      box-shadow: 0 35px 70px rgba(0,0,0,0.4);
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

    /* Search and Filter Section */
    .search-section {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 2rem;
      margin-bottom: 3rem;
      animation: slideInUp 1s ease-out 0.4s both;
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

    .filter-btn {
      padding: 1rem 2rem;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      border-radius: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .filter-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    /* Hospital Cards Grid */
    .hospitals-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 2rem;
      margin-bottom: 3rem;
    }

    .hospital-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 2.5rem;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
      animation: slideInUp 0.8s ease-out;
      cursor: pointer;
    }

    .hospital-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.5s;
    }

    .hospital-card:hover::before {
      left: 100%;
    }

    .hospital-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
      border-color: rgba(255, 255, 255, 0.4);
    }

    .hospital-header {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .hospital-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1.5rem;
      font-size: 1.5rem;
      color: white;
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .hospital-name {
      font-size: 1.5rem;
      font-weight: 700;
      color: white;
      margin-bottom: 0.5rem;
    }

    .hospital-status {
      color: #4caf50;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .hospital-details {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .detail-item {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      color: rgba(255, 255, 255, 0.9);
      line-height: 1.5;
    }

    .detail-icon {
      width: 20px;
      color: rgba(255, 255, 255, 0.7);
      margin-top: 0.2rem;
      flex-shrink: 0;
    }

    .detail-text {
      flex: 1;
    }

    /* Action Buttons */
    .hospital-actions {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
      padding-top: 1.5rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .action-btn {
      flex: 1;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .action-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .btn-primary:hover {
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    /* Map Section */
    .map-section {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 25px;
      padding: 3rem;
      margin-top: 3rem;
      animation: slideInUp 1s ease-out 0.6s both;
    }

    .map-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: white;
      text-align: center;
      margin-bottom: 2rem;
    }

    .map-placeholder {
      width: 100%;
      height: 400px;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(255, 255, 255, 0.8);
      font-size: 1.2rem;
      border: 2px dashed rgba(255, 255, 255, 0.3);
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
      
      .hospitals-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      
      .search-container {
        flex-direction: column;
      }
      
      .search-input {
        min-width: 100%;
      }
      
      .locations-container {
        padding: 1rem;
      }
      
      .hospital-card {
        padding: 2rem;
      }
    }

    @media (max-width: 480px) {
      .hero-title {
        font-size: 2rem;
      }
      
      .hospital-header {
        flex-direction: column;
        text-align: center;
      }
      
      .hospital-icon {
        margin-right: 0;
        margin-bottom: 1rem;
      }
      
      .hospital-actions {
        flex-direction: column;
      }
    }

    /* Loading Animation */
    .loading {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid rgba(255,255,255,.3);
      border-radius: 50%;
      border-top-color: #fff;
      animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* No Results */
    .no-results {
      text-align: center;
      padding: 3rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 1.2rem;
    }
  </style>
</head>
<body>
  <div class="animated-bg"></div>
  
  <!-- Floating Elements -->
  <div class="floating-elements" id="floatingElements"></div>

  <div class="locations-container">
    <!-- Hero Section -->
    <div class="hero-section">
      <img src="images/locations1.jpg" alt="Hospital Locations Map" class="hero-image" />
      <h1 class="hero-title">Find Blood Donation Centers</h1>
      <p class="hero-subtitle">Locate the nearest blood donation centers and hospitals in your area. Connect with healthcare facilities that are ready to help save lives.</p>
    </div>

    <!-- Search Section -->
    <div class="search-section">
      <div class="search-container">
        <input type="text" class="search-input" id="searchInput" placeholder="Search hospitals by name, city, or address..." />
        <button class="filter-btn" id="filterBtn">
          <i class="fas fa-filter"></i>
          Filter
        </button>
      </div>
    </div>

    <!-- Hospitals Grid -->
    <div class="hospitals-grid" id="hospitalsGrid">
      <?php
      $hospitals = [];
      mysqli_data_seek($result, 0);
      while ($row = mysqli_fetch_assoc($result)) {
        $hospitals[] = $row;
      }
      
      foreach ($hospitals as $index => $row) {
        $HospitalName = $row['H_Name'];
        $HospitalNo = $row['Tel_no'];
        $Email = $row['Email'];
        $Address = $row['H_Address'];
      ?>
        <div class="hospital-card" data-name="<?php echo strtolower($HospitalName); ?>" data-address="<?php echo strtolower($Address); ?>" style="animation-delay: <?php echo $index * 0.1; ?>s">
          <div class="hospital-header">
            <div class="hospital-icon">
              <i class="fas fa-hospital"></i>
            </div>
            <div>
              <h3 class="hospital-name"><?php echo htmlspecialchars($HospitalName); ?></h3>
              <div class="hospital-status">
                <i class="fas fa-circle"></i> Open for Donations
              </div>
            </div>
          </div>
          
          <div class="hospital-details">
            <div class="detail-item">
              <i class="fas fa-map-marker-alt detail-icon"></i>
              <div class="detail-text"><?php echo htmlspecialchars($Address); ?></div>
            </div>
            <div class="detail-item">
              <i class="fas fa-phone detail-icon"></i>
              <div class="detail-text"><?php echo htmlspecialchars($HospitalNo); ?></div>
            </div>
            <div class="detail-item">
              <i class="fas fa-envelope detail-icon"></i>
              <div class="detail-text"><?php echo htmlspecialchars($Email); ?></div>
            </div>
          </div>
          
          <div class="hospital-actions">
            <a href="tel:<?php echo $HospitalNo; ?>" class="action-btn btn-primary">
              <i class="fas fa-phone"></i>
              Call Now
            </a>
            <a href="mailto:<?php echo $Email; ?>" class="action-btn btn-secondary">
              <i class="fas fa-envelope"></i>
              Email
            </a>
          </div>
        </div>
      <?php } ?>
    </div>

    <!-- Map Section -->
    <div class="map-section">
      <h2 class="map-title">Interactive Map</h2>
      <div class="map-placeholder">
        <div>
          <i class="fas fa-map" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
          Interactive map coming soon!<br>
          <small>View all donation centers on an interactive map</small>
        </div>
      </div>
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
        element.style.animationDelay = Math.random() * 10 + 's';
        element.style.animationDuration = (Math.random() * 5 + 5) + 's';
        container.appendChild(element);
      }
    }

    // Search functionality
    function filterHospitals() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const hospitalCards = document.querySelectorAll('.hospital-card');
      let visibleCount = 0;

      hospitalCards.forEach(card => {
        const name = card.dataset.name;
        const address = card.dataset.address;
        
        if (name.includes(searchTerm) || address.includes(searchTerm)) {
          card.style.display = 'block';
          card.style.animation = 'slideInUp 0.5s ease-out';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      // Show no results message if needed
      const noResults = document.getElementById('noResults');
      if (visibleCount === 0) {
        if (!noResults) {
          const message = document.createElement('div');
          message.id = 'noResults';
          message.className = 'no-results';
          message.innerHTML = '<i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>No hospitals found matching your search.';
          document.getElementById('hospitalsGrid').appendChild(message);
        }
      } else if (noResults) {
        noResults.remove();
      }
    }

    // Add search event listeners
    document.getElementById('searchInput').addEventListener('input', filterHospitals);
    document.getElementById('filterBtn').addEventListener('click', filterHospitals);

    // Intersection Observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe hospital cards
    document.querySelectorAll('.hospital-card').forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(30px)';
      card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(card);
    });

    // Add click effects to hospital cards
    document.querySelectorAll('.hospital-card').forEach(card => {
      card.addEventListener('click', function() {
        this.style.transform = 'scale(0.98)';
        setTimeout(() => {
          this.style.transform = '';
        }, 150);
      });
    });

    // Initialize on page load
    window.addEventListener('load', function() {
      createFloatingElements();
    });

    // Add parallax effect to hero image
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const heroImage = document.querySelector('.hero-image');
      if (heroImage) {
        heroImage.style.transform = `translateY(${scrolled * 0.05}px)`;
      }
    });
  </script>

  <?php require 'footer.php'; ?>
</body>
</html>