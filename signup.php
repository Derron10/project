<?php
session_start();
include "db_connect.php";

if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $msg = "Email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users(username, email, password) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $msg = "Signup successful! You can now login.";
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #121212; color: #fff; }
.form-control { background-color: #edeef5ff; color: #000; border: 1px solid #333; }
.navbar-dark { background-color: #15140eff; }
.card { background-color: #ed7010ff; border: none; }
a { color: #0dcaf0; text-decoration: none; }
a:hover { text-decoration: underline; }
</style>
</head>
<body>
<nav class="navbar navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">⌚ Watch Store</a>
  </div>
</nav>

<div class="container my-5" style="max-width:450px;">
  <div class="card p-4 shadow">
    <h2 class="mb-4 text-center text-white">Sign Up</h2>
    <?php if(isset($msg)) echo "<div class='alert alert-info'>$msg</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input class="form-control" name="username" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control" type="email" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input class="form-control" type="password" name="password" required>
      </div>
      <button class="btn btn-dark w-100" name="signup">Sign Up</button>
    </form>
    <p class="mt-3 text-center text-white">Already have an account? <a href="login.php">Login</a></p>
  </div>
</div>
</body>
</html>
