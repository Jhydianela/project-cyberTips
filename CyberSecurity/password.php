<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? $_SESSION['user'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Phishing Attacks</title>
  <style>
:root {
  --primary-gradient: linear-gradient(135deg,rgb(82, 91, 131), #1a1e30);
  --accent-gradient: linear-gradient(135deg, #1a1e30, #9f00ff);
   --background-color: #1a1e30;
  --text-color: #e0e0e8;
  --accent-color:color:rgb(10, 130, 177);
  --secondary-text-colo: #1a1e30;
  --border-color: #2f2c4f;
}

body {
  font-family: 'Segoe UI', sans-serif;
  margin: 0;
  padding: 0;
  background: var(--background-color);
  color: var(--text-color);
  scroll-behavior: smooth;
}

header {
  background: var(--primary-gradient);
  color: var(--text-color);
  padding: 15px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  z-index: 1000;
  text-shadow: none;
}

.logo {
  font-weight: 900;
  font-size: 26px;
  letter-spacing: 2px;
  text-shadow: none;
}

nav a {
  color: var(--text-color);
  margin: 0 12px;
  text-decoration: none;
  font-weight: 700;
  transition: color 0.4s ease;
}

nav a:hover {
  color: var(--accent-color);
  text-shadow: none;
}

.container {
  max-width: 1200px;
  margin: auto;
  padding: 40px 25px;
  align-items: center; /* center content horizontally */
  text-align: center; /* center text inside container */
}

.phone-image {
  margin: 30px 0;
}

.phone-image img {
  max-width: 100%;
  height: auto;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.4);
  max-width: 400px; /* Optional: limit image width */
}

h1, h2 {
  color: var(--accent-color);
  font-weight: 700;
}

.subtitle {
  color: var(--secondary-text-color);
  text-align: justify;
  margin-bottom: 2em;
  font-size: 18px;
  line-height: 1.5;
  text-shadow: none;
}

.section {
  margin-top: 40px;
  opacity: 0;
  transform: translateY(60px);
  transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);
}

.section.show {
  opacity: 1;
  transform: translateY(0);
}

.feature-grid, .card-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 24px;
  margin-top: 25px;
}

.feature-item, .tip-box, .card {
  background: #1e1c33;
  padding: 26px;
  border-radius: 20px;
  cursor: default;
  user-select: none;
  box-shadow: none;
  border: 1px solid var(--border-color);
  transition: transform 0.35s ease;
}

.feature-item:hover, .tip-box:hover, .card:hover {
  transform: translateY(-8px);
}

.feature-item h4, .card h3 {
  margin: 12px 0;
  color: var(--accent-color);
  font-weight: 700;
}

.tip-list, .chat-list {
  list-style: none;
  padding: 0;
}

.tip-list li, .chat-list li {
  padding: 12px 0;
  border-bottom: 1px solid #2f2c4f;
  font-size: 15px;
  color: var(--secondary-text-color);
  text-shadow: none;
}

.chat-list li strong {
  color: var(--accent-color);
  margin-right: 10px;
  text-shadow: none;
}

.icon-circle {
  width: 54px;
  height: 54px;
  background: var(--accent-gradient);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin: 0 auto 14px;
  box-shadow: none;
}

.back-link {
  display: inline-block;
  margin: 22px 0;
  padding: 12px 28px;
  color: white;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 700;
  box-shadow: none;
  transition: background 0.35s ease;
}


#backToTopBtn {
  position: fixed;
  bottom: 32px;
  right: 32px;
  background: var(--primary-gradient);
  color: white;
  border: none;
  border-radius: 50%;
  width: 56px;
  height: 56px;
  font-size: 28px;
  display: none;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  box-shadow: none;
  transition: transform 0.25s ease;
  z-index: 9999;
  text-shadow: none;
}

#backToTopBtn:hover {
  transform: scale(1.15);
}

#backToTopBtn.clicked {
  background: var(--accent-gradient);
}


  </style>
</head>
<body>

<header>
  

</header>

<a href="index.php#topic" class="back-link">← Back to Topic</a>
<div class="container">
  <h1 class="section">Password Threats</h1>
  <p class="subtitle section">
    Password threats involve cyberattacks that try to guess, steal, or crack your passwords to gain access to personal or sensitive accounts. Common types include brute force attacks, phishing for login credentials, and password reuse across different sites.
  </p>

  <div class="phone-image">
    <img src="password.png" alt="Password Threats Image">
  </div>

  <div class="section">
    <h2>How Password Attacks Work</h2>
    <div class="feature-grid">
      <div class="feature-item">
        <h4>1. Brute-force Attacks</h4>
        <p>Attackers try many password combinations until they succeed.</p>
      </div>
      <div class="feature-item">
        <h4>2. Phishing for Passwords</h4>
        <p>Tricking users into revealing their login credentials.</p>
      </div>
      <div class="feature-item">
        <h4>3. Keylogging</h4>
        <p>Malware records what you type to steal your password.</p>
      </div>
      <div class="feature-item">
        <h4>4. Password Reuse</h4>
        <p>Using the same password on many accounts makes them all vulnerable.</p>
      </div>
    </div>
  </div>

  <div class="section">
    <h2>Stay Safe from Password Threats</h2>
    <div class="feature-grid">
      <div class="tip-box">
        <h4>Basic Tips</h4>
        <ul class="tip-list">
          <li>🔐 Use strong and unique passwords</li>
          <li>📱 Enable two-factor authentication (2FA)</li>
          <li>🧠 Avoid saving passwords in browsers</li>
          <li>📥 Use a trusted password manager</li>
        </ul>
      </div>
      <div class="tip-box">
        <h4>Protection Checklist</h4>
        <ul class="chat-list">
          <li><strong>✅</strong> Change your passwords regularly</li>
          <li><strong>✅</strong> Never share your passwords</li>
          <li><strong>✅</strong> Use complex passwords with letters, numbers, and symbols</li>
          <li><strong>✅</strong> Don't use the same password on multiple sites</li>
          <li><strong>✅</strong> Be alert for login attempt alerts</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="section">
    <h2>Signs to Watch Out For</h2>
    <div class="card-list">
      <div class="card">
        <div class="icon-circle">🔓</div>
        <h3>Unauthorized Access</h3>
        <p>Someone logs in to your account without permission.</p>
      </div>
      <div class="card">
        <div class="icon-circle">📨</div>
        <h3>Reset Emails</h3>
        <p>You receive password reset emails you didn’t request.</p>
      </div>
      <div class="card">
        <div class="icon-circle">📉</div>
        <h3>Account Changes</h3>
        <p>Personal or security settings change without your input.</p>
      </div>
      <div class="card">
        <div class="icon-circle">🚨</div>
        <h3>Login Alerts</h3>
        <p>Alerts from unknown devices or locations trying to log in.</p>
      </div>
    </div>
  </div>
</div>


<!-- Back to Top Button -->
<button id="backToTopBtn" onclick="scrollToTop()">↑</button>

<script>
  // Animate sections on scroll
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('show');
        observer.unobserve(entry.target); // Animate once
      }
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('.section').forEach(section => {
    observer.observe(section);
  });

  // Back to Top button logic
  const backToTopBtn = document.getElementById("backToTopBtn");
  window.onscroll = () => {
    backToTopBtn.style.display = window.scrollY > 100 ? "flex" : "none";
  };

  function scrollToTop() {
    backToTopBtn.classList.add("clicked");
    setTimeout(() => backToTopBtn.classList.remove("clicked"), 300);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>


</body>
</html>
