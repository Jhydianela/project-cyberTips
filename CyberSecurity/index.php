<?php
session_start();

// Check login status
$isLoggedIn = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cybal - Cyber Security</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>


body {
  font-family: 'Inter', sans-serif;
  margin: 0;
  background: linear-gradient(-45deg, #0d1b2a, #1b263b, #415a77, #0d1b2a);
  background-size: 400% 400%;
  animation: gradientBG 20s ease infinite;
  color: #e0e0e0;
  min-height: 100vh;
  overflow-x: hidden;
}


header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background-color: #111320;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.logo {
  font-weight: 800;
  font-size: 22px;
  color: #edf2f4;
}

nav a {
  color: #dbe2ef;
  margin: 0 10px;
  font-weight: 600;
  text-decoration: none;
  font-size: 15px;
}

nav a:hover {
  color: #70d6ff;
}

.cta-btn {
  background-color: #70d6ff;
  padding: 10px 20px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 14px;
  color: #0f0f0f;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.cta-btn:hover {
  background-color: #4ac1e0;
}

/* Enhanced button styles */
button,
.view-all-btn,
.job-detail,
.job-detail1 {
  padding: 10px 22px;
  border-radius: 6px;
  font-weight: 600;
  font-size: 15px;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 255, 255, 0.15);
}

button:hover,
.view-all-btn:hover,
.job-detail:hover,
.job-detail1:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 15px rgba(0, 255, 255, 0.25);
}



.hero {
  padding: 180px 40px;
  background: url('bg6.jpg') no-repeat center center;
  background-size: cover;
  text-align: center;
}

.hero h1 {
  font-size: 40px;
  max-width: 600px;
  margin: 0 auto 20px;
  color: #e0e0e0;
  text-align: left; /* Title not centered */
  margin-left: 0;
}

.buttons {
  margin-top: 20px;
  margin-right: 55%;
}
.buttons button {
  margin: 0 10px;
}
.discover {
  background: #00bcd4;
  color: #fff;
}
.video-tour {
  background: #7c4dff;
  color: #fff;
}

.stats {
  padding: 80px 40px;
  text-align: center;
  background: #121826;
}

.stats h1 {
  color: #e0e0e0;
   font-family: 'Inter', sans-serif;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 1.5rem;
  margin-bottom: 20px;
  text-shadow: 1.5px 1.5px 4px rgba(0,0,0,0.5);
}

.stats h1 .highlight {
  font-size: 1.3em;
  color: #00bcd4;
  border-bottom: 3px solid #00bcd4;
  padding-bottom: 3px;
  transition: color 0.3s ease, border-color 0.3s ease;
  cursor: default;
}

.stats h1 .highlight:hover {
  color: #008ba3;
  border-color: #008ba3;
}



.box-container {
  display: flex;
  justify-content: center;
  gap: 30px;
  flex-wrap: wrap;
  margin-top: 50px;
}

.box {
  background-color: #1a1e30;
  color: #c9d1d9;
  padding: 25px;
  width: 280px;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0, 255, 255, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.box:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 25px rgba(0, 255, 255, 0.1);
}
.box h3 {
    color: #70d6ff;
}
.box p {
  color: #dbe2ef;
}

.job-section {
  color: white;
  padding: 60px 40px;
  border-radius: 20px;
}

.job-header h2 {
   color: #70d6ff;
  margin-top: 40px;
  font-weight: 800;
  font-size: 28px;

  
}
.job-header .subtext {
  color: #dbe2ef;
  padding-bottom:23px;
}

.view-all-btn {
  background-color: #00acc1;
  color: white;
}

.job-cards {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  justify-content: center;
}

.job-card {
  background: #1e2338;
  color: #c2d1f0;
  border-radius: 8px;
  padding: 10px;
  width: 18%;
  box-shadow: 0 2px 6px rgba(0, 255, 255, 0.08);
}
.job-card:hover {
  transform: translateY(-3px);
}
.job-card img {
  border-radius: 6px;
}
.job-card h3 {
  font-size: 18px;
}
.job-card p {
  color: #9ca3af;
}



.job-detail1 {
   background-color: #00acc1;
  color: white;

   text-decoration: none;
}
.job-detail1:hover {
  background-color: #7e8ca1;
}

.job-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}
.job-image img {
  max-width: 35%;
  border-radius: 10px;
}

#topics {
  background: linear-gradient(rgba(10, 14, 35, 0.85), rgba(20, 28, 56, 0.95)),
              url('bg.jpg') no-repeat center center;
  background-size: cover;
  padding: 60px 40px;
  color: white;
}

footer {
  background: #0a0c1b;
  color: #888;
  padding: 20px;
  text-align: center;
}

#backToTopBtn {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 99;
  font-size: 16px;
   background-color: #8be9fd;
  color: #0a0a0a;
  border: none;
  outline: none;
  padding: 10px 16px;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  display: none;
}
#backToTopBtn:hover {
  background-color: #5ee4e4;
}

.clicked {
  animation: clickEffect 0.3s ease;
}
@keyframes clickEffect {
  0% {
    transform: scale(1);
    box-shadow: 0 0 0 rgba(139, 233, 253, 0.7);
  }
  50% {
    transform: scale(1.1);
    box-shadow: 0 0 15px rgba(139, 233, 253, 0.9);
  }
  100% {
    transform: scale(1);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  }
}



  </style>
</head>
<body>
<header>
  <div class="logo">Cybal</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="index.php#topic">Topic</a>
    <a href="cybersecurity-tips.php">Cybersecurity Tips</a>
  </nav>
  <?php if ($isLoggedIn): ?>
    <a href="logout.php" class="cta-btn">Logout (<?= htmlspecialchars($username) ?>)</a>
  <?php else: ?>
    <a href="register.php" class="cta-btn">Login</a>
  <?php endif; ?>
</header>

  <section id="home" class="hero">
    <h1>Here's the best tips to secure yourself in any threats</h1>
  
  </section>

  <section id="topic" class="stats">
     <h1>Topics about <span class="highlight">Cybersecurity</span></h1>
  
    
    <div class="box-container">
      <div class="box">
        <h3>phishing-attacks </h3>
        <p> A type of cyber scam where attackers try to trick people into giving away sensitive information.</p>
        <a href="phishing-details.php">
          <button style="padding: 8px 16px; margin-top: 10px;">Read More</button>
        </a>
      </div>
      <div class="box">
        <h3>malware-infections</h3>
        <p> It’s any software designed to harm your computer, steal your data, or take control of your system without you knowing.</p>
        <a href="Malware.php">
          <button style="padding: 8px 16px; margin-top: 10px;">Read More</button>
        </a>
      </div>
      <div class="box">
        <h3>attack-targets</h3>
        <p>The people, systems, or organizations that cybercriminals choose to go after.</p>
        <a href="attack-targets.php">
          <button style="padding: 8px 16px; margin-top: 10px;">Read More</button>
        </a>
      </div>
    <div class="box">
      <h3> Password Thefts</h3>
      <p>  This is a major security threat, as stolen passwords can lead to identity theft, financial loss, or unauthorized access to sensitive data.</p>
      <a href="password.php">
        <button style="padding: 8px 16px; margin-top: 10px;">Read More</button>
      </a>
   
    </div>
    <div class="box">
      <h3>Network Tapping</h3>
      <p> The goal of network tapping is to capture sensitive information such as passwords, emails, credit card details, and other private communications without the user's knowledge</p>
      <a href="network.php">
        <button style="padding: 8px 16px; margin-top: 10px;">Read More</button>
      </a>
    </div>
    <div class="box">
      <h3>Encryption Cracking</h3>
      <p>The process of trying to break or bypass encryption — the method used to protect sensitive data by converting it into a code that only authorized users can read. </p>
      <a href="encryption.php">
        <button style="padding: 8px 16px; margin-top: 10px;">Read More</button>
      </a>
    </div>
  </div>
    
  </section>
  
  
  <section id="cybersecurity-tips" class="job-section">
    <div class="job-container">
      <div class="job-header">
        <h2> Cybersecurity Tips</h2>
        <p class="subtext">
          Learn what you should be doing to protect yourself with cybersecurity best practices.
        </p>
        <a href="cybersecurity-tips.php" class="job-detail1">View</a>
      </div>
      <div class="job-image">
        <img src="12.png" alt="Cybersecurity Tips" />
      </div>
    </div>
  </section>
<button onclick="scrollToTop()" id="backToTopBtn" title="Go to top">↑ Top</button>

</body>
</html>
<script>
  window.onscroll = function() {
    document.getElementById("backToTopBtn").style.display = 
      window.scrollY > 100 ? "block" : "none";
  };

  function scrollToTop() {
    const btn = document.getElementById("backToTopBtn");
    
    // Add highlight effect class
    btn.classList.add("clicked");
    
    // Remove the class after animation finishes
    setTimeout(() => btn.classList.remove("clicked"), 300);
    
    // Smooth scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

