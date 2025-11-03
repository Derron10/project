<?php
session_start();
include "db_connect.php";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $res = $conn->prepare("SELECT * FROM users WHERE email=?");
    $res->bind_param("s", $email);
    $res->execute();
    $result = $res->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['username'];
            header("Location: index.php");
            exit;
        } else {
            $msg = "Invalid password!";
        }
    } else {
        $msg = "No account found. Please sign up first.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #121212; color: #fff; }
.form-control { background-color: #f6efefff; color: #000; border: 1px solid #333; }
.navbar-dark { background-color: #000; }
.card { background-color: #832fddff; border: none; }
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
    <h2 class="mb-4 text-center text-white">Login</h2>
    <?php if(isset($msg)) echo "<div class='alert alert-danger'>$msg</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control" type="email" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input class="form-control" type="password" name="password" required>
      </div>
      <button class="btn btn-dark w-100" name="login">Login</button>
    </form>
    <p class="mt-3 text-center text-white">Don't have an account? <a href="signup.php">Sign Up</a></p>
  </div>
</div>
</body>
</html>
