<?php
session_start();
include('../db/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password']; // removed hash for plain text

  $result = $db->query("SELECT * FROM admins WHERE username = ? AND password = ?", [$username, $password]);

  if ($result->num_rows > 0) {
    $_SESSION['admin'] = $username;
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Invalid credentials.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login - TECHSHOP</title>
  <style>
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f8; margin: 0; }
    .login-container { max-width: 400px; margin: 80px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); padding: 30px; }
    h2 { text-align: center; margin-top: 0; }
    form { display: flex; flex-direction: column; }
    input { margin-bottom: 16px; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-size: 15px; }
    button { background: #1976d2; color: #fff; border: none; padding: 10px 0; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; }
    button:hover { background: #125ea7; }
    .error { color: #e53935; text-align: center; margin-bottom: 14px; }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>
    <form method="POST">
      <input name="username" placeholder="Username" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
