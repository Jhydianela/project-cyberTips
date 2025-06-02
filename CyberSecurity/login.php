<?php
session_start();

require_once 'db.php'; // ✅ Use PDO connection from db.php

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    try {
        // Prepare and execute query
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "User not found.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      background: linear-gradient(135deg, #2b5876, #4e4376);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
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
      width: 25px;
      height: 25px;
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

    .login-container {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(15px);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.25);
      padding: 40px 30px;
      width: 100%;
      max-width: 400px;
      z-index: 1;
    }

    .login-container h2 {
      color: #fff;
      text-align: center;
      margin-bottom: 25px;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 40px 12px 15px;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.15);
      color: black;
      font-size: 16px;
    }

    .input-group input:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.25);
    }

    .input-group i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(0, 0, 0, 0.6);
    }
    .input-group input::placeholder {
    color: white;
    opacity: 1; /* Ensures full opacity */
  }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      background:  #0e153a;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease, transform 0.2s;
    }

    button:hover {
       background-color: #1e2a57;
      transform: scale(1.03);
    }

    .error-message {
      color: #ffbaba;
      text-align: center;
      margin-bottom: 15px;
    }

.register-link {
  text-align: center;
  margin-top: 15px;
  color: #eee;
  font-size: 14px;
}

.register-link a {
  color: #fff;
  text-decoration: underline;
   font-weight: bold; /* Makes the text bold */
  transition: color 0.3s ease, text-shadow 0.3s ease;
}

.register-link a:hover {
  color:#0e153a; /* Light aqua/cyan for a standout effect */
  text-shadow: #0e153a;
  cursor: pointer;
}


    @media (max-width: 500px) {
      .login-container {
        margin: 0 20px;
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <!-- Circles background -->
  <ul class="circles">
    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>
  </ul>

  <!-- Login Box -->
  <div class="login-container">
    <h2>Login</h2>
    <?php if ($error): ?>
      <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="input-group">
        <input type="text" name="username" placeholder="Username" required>
        <i class="fas fa-user"></i>
      </div>
      <div class="input-group">
        <input type="password" name="password" placeholder="Password" required>
        <i class="fas fa-lock"></i>
      </div>
      <button type="submit">Login</button>
    </form>
    <div class="register-link">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>
</body>
</html>
