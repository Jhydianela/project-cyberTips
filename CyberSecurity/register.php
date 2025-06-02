<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: cybersecurity-tips.php");
    exit;
}

require_once 'db.php'; // Connect using PDO

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    // Limit registrations per IP to 3 per day
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM login_logs WHERE ip_address = ? AND DATE(created_at) = CURDATE()");
        $stmt->execute([$userIP]);
        $countToday = $stmt->fetchColumn();

        if ($countToday >= 3) {
            $error = "You have reached the maximum of 3 registrations allowed from your IP today.";
        }

        if (empty($error)) {
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                $error = "Please fill in all fields.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } elseif ($password !== $confirm_password) {
                $error = "Passwords do not match.";
            } else {
                // Check if username or email exists
                $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
                $stmt->execute([$username, $email]);
                if ($stmt->fetch()) {
                    $error = "Username or Email already taken.";
                }
            }
        }

        if (empty($error)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);
            $newUserId = $pdo->lastInsertId();

            // Log registration IP
            $stmt = $pdo->prepare("INSERT INTO login_logs (ip_address) VALUES (?)");
            $stmt->execute([$userIP]);

            // Set session
            $_SESSION['user_id'] = $newUserId;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            header("Location: cybersecurity-tips.php");
            exit();
        }
    } catch (PDOException $e) {
        $error = "Registration failed: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
            background: linear-gradient(135deg, #2b5876, #4e4376);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    @keyframes slideUp {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(1.05); }
      to { opacity: 1; transform: scale(1); }
    }

    .container-box {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(15px);
      border-radius: 15px;
      padding: 40px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      animation: slideUp 1s ease forwards;
      opacity: 0;
      z-index: 1;
    }

    h3 {
      text-align: center;
      color: #fff;
      margin-bottom: 25px;
      font-size: 26px;
      font-weight: 600;
      animation: fadeIn 0.8s ease forwards;
    }

    .input-field {
      width: 100%;
      padding: 12px 15px;
      margin: 12px 0;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      font-size: 15px;
      transition: background 0.3s ease, transform 0.2s ease;
      animation: slideUp 0.6s ease forwards;
    }

    .input-field::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .input-field:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.25);
      transform: scale(1.02);
    }

    .form-btn {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      background-color: #0e153a;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
      animation: slideUp 0.8s ease forwards;
    }

    .form-btn:hover {
      background-color: #1e2a57;
      transform: scale(1.05);
    }

    p {
      color: #ddd;
      margin-top: 15px;
      text-align: center;
      font-size: 14px;
    }

    a {
      color: #ffffff;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    a:hover {
      color:rgb(50, 51, 62);
      text-decoration: underline;
    }

    ul.circles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    ul.circles li {
      position: absolute;
      display: block;
      list-style: none;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 50%;
      animation: float 25s linear infinite;
      bottom: -150px;
    }

    ul.circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
    ul.circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
    ul.circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
    ul.circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
    ul.circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
    ul.circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
    ul.circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
    ul.circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
    ul.circles li:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-delay: 2s; animation-duration: 35s; }
    ul.circles li:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s; animation-duration: 11s; }

    @keyframes float {
      0% { transform: translateY(0) rotate(0deg); opacity: 0; }
      50% { opacity: 0.5; }
      100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
    }
 
    .message {
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: bold;
        border: 1px solid transparent;
        background-color: #f8d7da; /* light red for error */
        color: #721c24;            /* dark red text for error */
    }

    .message.success {
        background-color: #d4edda; /* light green for success */
        color: #155724;            /* dark green text for success */
    }
</style>

  </style>
</head>

<body>
    <ul class="circles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
</ul>

    <div class="container-box">
        <div class="register-container">
            <form action="register.php" method="POST">
                <h3>Register Now</h3>

                  <?php if (isset($_GET['message']) && $_GET['message'] === 'logout_success'): ?>
                  <p class="message success" id="flashMessage">You have successfully logged out.</p>
                  <?php endif; ?>


                <?php if (!empty($error)): ?>
                    <p class="message"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>


                <input type="text" name="username" class="input-field" required placeholder="Enter your name" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" />
                <input type="email" name="email" class="input-field" required placeholder="Enter your email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
                <input type="password" name="password" class="input-field" required placeholder="Enter your password" />
                <input type="password" name="confirm_password" class="input-field" required placeholder="Confirm your password" />
                <input type="submit" name="submit" value="Register Now" class="form-btn" />
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const message = document.getElementById('flashMessage');
        if (message) {
            setTimeout(() => {
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 500); // remove after fade-out
            }, 3000); // show for 3 seconds
        }
    });
</script>

