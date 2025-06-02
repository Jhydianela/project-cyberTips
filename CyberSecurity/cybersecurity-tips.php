<?php
session_start();

// Check login status
$isLoggedIn = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';

// Flash messages
$tipSuccess = $_SESSION['tip_success'] ?? null;
unset($_SESSION['tip_success']);

$tipErrors = $_SESSION['tip_errors'] ?? null;
unset($_SESSION['tip_errors']);

// Include PDO database connection
require_once 'db.php';

// Fetch user-submitted tips using PDO
$tips = [];
try {
    $stmt = $pdo->query("SELECT tips.title, tips.description, users.username 
                         FROM tips 
                         JOIN users ON tips.user_id = users.id 
                         ORDER BY tips.id DESC");

    $tips = $stmt->fetchAll();
} catch (PDOException $e) {
    $tipErrors[] = "Failed to load tips: " . $e->getMessage();
}

// Static tips
$staticTips = [
    [
        'title' => 'Protect your passwords',
        'desc' => 'Create strong, unique passwords for each of your accounts by using a mix of uppercase and lowercase letters, numbers, and special characters. Avoid using easily guessed information like birthdays or names. Consider using a reliable password manager, such as LastPass or Bitwarden, to generate and store your passwords securely. Never share your passwords with anyone, and change them regularly to enhance your security.'
    ],
    [
        'title' => 'Beware of phishing scams',
        'desc' => 'Phishing scams often come in the form of emails, texts, or messages that appear to be from legitimate sources, asking for personal or financial information. Always verify the sender’s email address and avoid clicking on suspicious links. Legitimate companies will never ask you to confirm sensitive details via email. Report phishing attempts to your email provider or company security team and delete the messages immediately.'
    ],
    [
        'title' => 'Update your software regularly',
        'desc' => 'Keeping your operating system, applications, and antivirus software updated is critical for protecting your devices from the latest threats. Software updates often include patches for security vulnerabilities that hackers can exploit. Enable automatic updates whenever possible to ensure you are always running the latest versions.'
    ],
    [
        'title' => 'Use two-factor authentication',
        'desc' => 'Two-factor authentication (2FA) provides an additional layer of security by requiring a second form of verification—such as a code sent to your phone or an authentication app—besides your password. Even if your password is compromised, 2FA helps prevent unauthorized access to your accounts.'
    ],
    [
        'title' => 'Secure your devices',
        'desc' => 'Set up strong passwords, PINs, or biometric locks (like fingerprint or facial recognition) on all your devices. Always lock your screen when not in use and enable encryption if available. Install trusted security software to detect and prevent malicious activity, and be cautious of physical access to your devices by unauthorized individuals.'
    ],
    [
        'title' => 'Be careful what you share online',
        'desc' => 'Oversharing on social media can make you a target for cybercriminals. Avoid posting sensitive information such as your full address, phone number, vacation plans, or personal identifiers. Review and adjust your privacy settings on all platforms to limit who can see your content.'
    ],
    [
        'title' => 'Use secure Wi-Fi networks',
        'desc' => 'Avoid connecting to public Wi-Fi networks without using a Virtual Private Network (VPN), as public networks are often unsecured and vulnerable to attacks. Use WPA3 or WPA2-secured home networks with strong passwords. Regularly update your router firmware and change default admin credentials.'
    ],
    [
        'title' => 'Backup your data',
        'desc' => 'Regularly back up important files to an external hard drive or a secure cloud storage service. In the event of a ransomware attack, hardware failure, or accidental deletion, having a backup ensures you can recover your data without paying a ransom or losing critical information.'
    ],
    [
        'title' => 'Be cautious with downloads',
        'desc' => 'Only download software and files from reputable websites or official app stores. Avoid clicking on pop-ups offering downloads or updates. Use antivirus software to scan files for malware and verify the source before installing anything on your device.'
    ],
  
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cybersecurity Tips</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <style>


body {
  font-family: 'Inter', sans-serif;
  margin: 0;
  background: linear-gradient(-45deg, #0d1b2a, #1b263b, #415a77, #0d1b2a);
  background-size: 400% 400%;
  animation: gradientBG 20s ease infinite;
  color: white;
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

.container {
  padding: 40px 20px;
  max-width: 1000px;
  margin: auto;
}

h2 {
  text-align: center;
  margin-top: 40px;
  font-weight: 800;
  font-size: 28px;
  color: #dbe2ef;
}

p {
  text-align: center;
  max-width: 600px;
  margin: 10px auto 30px auto;
  font-size: 16px;
  color: #a8b2d1;
}

.steps-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
  max-width: 1200px;
  margin: 0 auto 60px auto;
  padding: 0 20px;
}

.step-card {
  background-color: #243447;
  border-radius: 12px;
  padding: 25px;
   box-shadow: 0 4px 10px rgba(0, 255, 255, 0.15);
  display: flex;
  flex-direction: column;
}

.step-card.new-tip {
  border: 2px solid #70d6ff;
}

.step-card strong {
  display: block;
  color: #70d6ff;
  font-size: 18px;
  margin-bottom: 10px;
}

.step-card p {
  color: #dbe2ef;
  font-size: 14px;
  margin-bottom: 5px;
  white-space: pre-wrap;
  word-break: break-word;
  overflow-wrap: break-word;
   justify-content: center;
 
}

.step-card small {
  color: #8395a7;
  font-size: 12px;
}

.message {
  max-width: 600px;
  margin: 30px auto;
  padding: 15px;
  border-radius: 8px;
  text-align: center;
  font-weight: 600;
  font-size: 16px;
}

.message.success {
  background-color: #0a3d2b;
  color: #88ffcc;
}

.message.error {
  background-color: #3d0a0a;
  color: #ff9999;
}

#tipFormContainer {
  max-width: 600px;
  margin: 0 auto 80px auto;
  padding: 0 20px;
}

form#tipForm {
  background: #1e2a38;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 0 15px #70d6ff88;
  display: flex;
  flex-direction: column;
}

form#tipForm h3 {
  margin-bottom: 20px;
  font-weight: 800;
  font-size: 20px;
  color: #70d6ff;
}

form#tipForm input[type="text"],
form#tipForm textarea {
  background-color: #2b3a4c;
  border: none;
  border-radius: 8px;
  padding: 10px 15px;
  margin-bottom: 15px;
  color: white;
  font-size: 14px;
  resize: vertical;
}

form#tipForm button {
  background-color: #70d6ff;
  border: none;
  padding: 12px 0;
  font-weight: 700;
  font-size: 16px;
  color: #0f0f0f;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

form#tipForm button:hover {
  background-color: #4ac1e0;
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


<h2>Cybersecurity Tips</h2>
<p>Your actions online can impact you and your family. Stay safe by following these tips.</p>

<?php if ($tipSuccess): ?>
  <div id="tip-success" class="message success"><?=htmlspecialchars($tipSuccess)?></div>
<?php endif; ?>

<?php if ($tipErrors): ?>
  <div id="tip-errors" class="message error">
    <ul>
      <?php foreach ($tipErrors as $error): ?>
        <li><?=htmlspecialchars($error)?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>


<div class="steps-container">
  <?php foreach ($staticTips as $tip): ?>
    <div class="step-card">
      <strong><?=htmlspecialchars($tip['title'])?></strong>
      <p><?=htmlspecialchars($tip['desc'])?></p>
    </div>
  <?php endforeach; ?>

  <?php foreach ($tips as $tip): ?>
    <div class="step-card new-tip">
      <strong><?=htmlspecialchars($tip['title'])?></strong>
      <p><?=nl2br(htmlspecialchars($tip['description']))?></p>
      <small>— Posted by <?=htmlspecialchars($tip['username'])?></small>
    </div>
  <?php endforeach; ?>
</div>

<?php if ($isLoggedIn): ?>
<div id="tipFormContainer">
  <form id="tipForm" method="POST" action="submit_tip.php">
    <h3>Submit Your Cybersecurity Tip</h3>
    <input type="text" name="title" placeholder="Tip title" required minlength="5" maxlength="100" />
    <textarea name="description" placeholder="Tip description" required minlength="10" maxlength="600"></textarea>
    <button type="submit">Submit Tip</button>
  </form>
</div>
<?php else: ?>
  <div style="display: flex; justify-content: center; margin-top: 20px; margin-bottom: 40px;">

    <button id="showLoginPrompt" style="
      padding: 10px 20px;
      background-color:  #70d6ff;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    " onmouseover="this.style.backgroundColor='#e043b5'" onmouseout="this.style.backgroundColor=' #70d6ff'">
      ADD TIPS
    </button>
  </div>

  <div id="loginPrompt" style="
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background-color: #1e1e2f;
    border: 1px solid #333;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    display: none;
  ">
    <p style="color: #ccc; font-size: 16px; margin-bottom: 15px;">
      Please <a href="register.php" style="color:  #70d6ff; text-decoration: none;">Login</a> to submit your cybersecurity tips.
    </p>
    <a href="register.php" style="
      display: inline-block;
      padding: 10px 20px;
      background-color: #70d6ff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s;
    " onmouseover="this.style.backgroundColor='#e043b5'" onmouseout="this.style.backgroundColor=' #70d6ff'">
      Login
    </a>
  </div>

    
<?php endif; ?>


</body>
</html>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const successBox = document.getElementById('tip-success');
    const errorBox = document.getElementById('tip-errors');

    [successBox, errorBox].forEach(box => {
      if (box) {
        setTimeout(() => {
          box.style.transition = 'opacity 0.5s ease';
          box.style.opacity = '0';
          setTimeout(() => box.style.display = 'none', 500);
        }, 3000); // Show for 3 seconds
      }
    });

    // Show login prompt on button click
    const showLoginPromptBtn = document.getElementById("showLoginPrompt");
    const loginPrompt = document.getElementById("loginPrompt");
    if (showLoginPromptBtn && loginPrompt) {
      showLoginPromptBtn.addEventListener("click", function () {
        loginPrompt.style.display = "block";
        showLoginPromptBtn.style.display = "none";
      });
    }
  });
</script>
