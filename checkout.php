<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['place_order'])) {
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];

    $userQuery = $conn->query("SELECT id FROM users WHERE username='{$_SESSION['user']}'");
    $user = $userQuery->fetch_assoc();
    $user_id = $user['id'];

    $sql = "INSERT INTO orders (user_id, full_name, address, pincode, city)
            VALUES ('$user_id', '$full_name', '$address', '$pincode', '$city')";
    
    if ($conn->query($sql)) {
        // success message + redirect after 3 seconds
        $msg = "<div class='alert alert-success text-center'>
                    Order placed successfully! Redirecting to home page...
                </div>
                <script>
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 3000);
                </script>";
    } else {
        $msg = "<div class='alert alert-danger text-center'>Error placing order: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Royal Blue Modern Theme */
body { background-color: #1967deff; color: #ccd6f6; font-family: 'Poppins', sans-serif; }
.form-control { background-color: #cebae7ff; color: #ccd6f6; border: 1px solid #64ffda; }
.form-control:focus { border-color: #64ffda; box-shadow: 0 0 5px rgba(100,255,218,0.5); }
.card { background-color: #8074eeff; border: none; box-shadow: 0 0 25px rgba(100,255,218,0.3); }
.btn-success { background-color: #64ffda; color: #0a192f; border: none; font-weight: bold; }
.btn-success:hover { background-color: #52e0c4; color: #000; transform: scale(1.05); transition: 0.2s; }
.navbar-dark { background-color: #020c1b; border-bottom: 2px solid #64ffda; }
h2 { color: #64ffda; text-align: center; margin-bottom: 25px; }
</style>
</head>
<body>
    
<nav class="navbar navbar-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">⌚ Watch Store</a>
  </div>
</nav>

<div class="container my-5" style="max-width:600px;">
  <div class="card p-4 rounded-4">
    <h2>Checkout</h2>
    <?php if(isset($msg)) echo $msg; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control" rows="3" placeholder="Enter your address" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Pincode</label>
        <input type="text" name="pincode" class="form-control" placeholder="Enter your pincode" required>
      </div>
      <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control" placeholder="Enter your city" required>
      </div>
      <button type="submit" name="place_order" class="btn btn-success w-100">Place Order</button>
    </form>
  </div>
</div>

</body>
</html>
