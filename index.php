<?php
session_start();

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    $item = [
        'name' => $_POST['name'],
        'price' => $_POST['price']
    ];
    $_SESSION['cart'][] = $item;
}

// Count cart items
$cart_count = count($_SESSION['cart']);
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<title>Watch Store</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
/* Dark Blue Theme */
body { background-color: #0a192f; color: #ccd6f6; font-family: 'Poppins', sans-serif; }
.navbar-dark { background-color: #020c1b; border-bottom: 2px solid #64ffda; }
.card { background-color: #112240; border: none; box-shadow: 0 0 15px rgba(100,255,218,0.2); transition: transform 0.2s; }
.card:hover { transform: scale(1.03); }
.card-title { color: #64ffda; margin-top: 10px; }
.btn-primary { background-color: #64ffda; border: none; color: #0a192f; font-weight: bold; }
.btn-primary:hover { background-color: #52e0c4; color: #000; transform: scale(1.05); transition: 0.2s; }
h2, h4 { color: #64ffda; }
.badge { background-color: #64ffda; color: #0a192f; }
.card-img-top, .card img { width: 200px; height: 200px; object-fit: cover; margin: 0 auto; border-radius: 10px; display: block; }
footer { background-color: #020c1b; color: #64ffda; text-align: center; padding: 20px 0; margin-top: 60px; border-top: 2px solid #64ffda; }
footer a { color: #64ffda; text-decoration: none; margin: 0 10px; }
footer a:hover { text-decoration: underline; }
</style>
</head>
<body>

<!-- Navbar -->

<nav class="navbar navbar-dark">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand fw-bold" href="index.php">⌚ Watch Store</a>
    <div class="d-flex align-items-center">
      <a href="cart.php" class="btn btn-outline-light me-3">
        🛒 Cart <span class="badge rounded-pill"><?php echo $cart_count; ?></span>
      </a>
      <?php if(isset($_SESSION['user'])): ?>
        <span class="text-light me-3">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-outline-light btn-sm me-2">Login</a>
        <a href="signup.php" class="btn btn-success btn-sm">Sign Up</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Main Content -->

<div class="container my-5">
  <h2 class="text-center mb-4">Our Watches</h2>
  <div class="row g-4">


<!-- Digital Watches -->
<h4 class="text-info mb-3">Digital Watches</h4>
<?php
$digital = [
  ["Digital Pulse", 199, "images/digital1.jpg"],
  ["Neo Digital", 249, "images/digital2.jpg"],
  ["Chrono LED", 299, "images/digital3.jpg"]
];
foreach ($digital as $watch): ?>
  <div class="col-md-4">
    <div class="card p-3 text-center">
      <img src="<?php echo $watch[2]; ?>" alt="Digital Watch" class="card-img-top">
      <h5 class="card-title"><?php echo $watch[0]; ?></h5>
      <p class="fw-bold" style="color: white;">$<?php echo $watch[1]; ?></p>
      <form method="POST">
        <input type="hidden" name="name" value="<?php echo $watch[0]; ?>">
        <input type="hidden" name="price" value="<?php echo $watch[1]; ?>">
        <button name="add_to_cart" class="btn btn-primary">Add to Cart</button>
      </form>
    </div>
  </div>
<?php endforeach; ?>

<!-- Hybrid Watches -->
<h4 class="text-info mt-5 mb-3">Hybrid Watches</h4>
<?php
$hybrid = [
  ["Hybrid One", 349, "images/hybrid1.jpg"],
  ["TechSync", 379, "images/hybrid2.jpg"],
  ["Motion Hybrid", 420, "images/hybrid3.jpg"]
];
foreach ($hybrid as $watch): ?>
  <div class="col-md-4">
    <div class="card p-3 text-center">
      <img src="<?php echo $watch[2]; ?>" alt="Hybrid Watch" class="card-img-top">
      <h5 class="card-title"><?php echo $watch[0]; ?></h5>
      <p class="fw-bold" style="color: white;">$<?php echo $watch[1]; ?></p>
      <form method="POST">
        <input type="hidden" name="name" value="<?php echo $watch[0]; ?>">
        <input type="hidden" name="price" value="<?php echo $watch[1]; ?>">
        <button name="add_to_cart" class="btn btn-primary">Add to Cart</button>
      </form>
    </div>
  </div>
<?php endforeach; ?>

<!-- Chronograph Watches -->
<h4 class="text-info mt-5 mb-3">Chronograph Watches</h4>
<?php
$chrono = [
  ["ChronoMaster", 499, "images/Chronograph1.jpg"],
  ["Precision Pro", 550, "images/Chronograph2.jpg"],
  ["SpeedTime", 600, "images/Chronograph3.jpg"]
];
foreach ($chrono as $watch): ?>
  <div class="col-md-4">
    <div class="card p-3 text-center">
      <img src="<?php echo $watch[2]; ?>" alt="Chronograph Watch" class="card-img-top">
      <h5 class="card-title"><?php echo $watch[0]; ?></h5>
      <p class="fw-bold" style="color: white;">$<?php echo $watch[1]; ?></p>
      <form method="POST">
        <input type="hidden" name="name" value="<?php echo $watch[0]; ?>">
        <input type="hidden" name="price" value="<?php echo $watch[1]; ?>">
        <button name="add_to_cart" class="btn btn-primary">Add to Cart</button>
      </form>
    </div>
  </div>
<?php endforeach; ?>


  </div>
</div>

<!-- Footer -->

<footer>
  <p>© 2025 Watch Store | Designed by Derron 💙 </p>
  <div>
    <a href="index.php">Home</a> |
    <a href="cart.php">Cart</a> |
    <a href="login.php">Login</a> |
    <a href="signup.php">Sign Up</a>
  </div>
</footer>

</body>
</html>
