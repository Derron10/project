<?php
session_start();

/**
 * Normalize the cart stored in session into a product => [price, quantity] map.
 * This handles two storage styles:
 *  - $_SESSION['cart'][] = ['name'=>..., 'price'=>...] (multiple entries for duplicates)
 *  - $_SESSION['cart'][id] = ['name'=>..., 'price'=>..., 'quantity'=>N]
 */
function normalize_cart($raw) {
    $norm = [];
    if (empty($raw) || !is_array($raw)) return $norm;

    foreach ($raw as $key => $item) {
        // ensure item has name and price
        if (!isset($item['name']) || !isset($item['price'])) continue;

        $name = $item['name'];
        $price = floatval($item['price']);

        // if quantity exists (structured cart), use it
        if (isset($item['quantity'])) {
            if (!isset($norm[$name])) {
                $norm[$name] = ['price' => $price, 'quantity' => intval($item['quantity'])];
            } else {
                $norm[$name]['quantity'] += intval($item['quantity']);
            }
        } else {
            // otherwise, each entry counts as 1 (aggregate duplicates)
            if (!isset($norm[$name])) {
                $norm[$name] = ['price' => $price, 'quantity' => 1];
            } else {
                $norm[$name]['quantity'] += 1;
            }
        }
    }
    return $norm;
}

// Ensure cart exists
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

// Handle remove (by product name)
if (isset($_GET['remove'])) {
    $removeName = $_GET['remove'];

    // Filter session cart: remove any items whose name matches $removeName
    $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function($item) use ($removeName) {
        // if structured item with 'name'
        if (isset($item['name'])) {
            return $item['name'] !== $removeName;
        }
        return true;
    }));
    // redirect to avoid repeated remove on refresh
    header("Location: cart.php");
    exit();
}

$normalized = normalize_cart($_SESSION['cart']);
$cart_empty = empty($normalized);

// Compute grand total
$grand_total = 0.0;
foreach ($normalized as $p) {
    $grand_total += $p['price'] * $p['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Your Cart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #0a192f; color: #ccd6f6; font-family: Arial, sans-serif; }
.navbar-dark { background-color: #020c1b; border-bottom: 2px solid #64ffda; }
.card { background-color: #112240; border: none; }
.table th, .table td { vertical-align: middle; }
.btn-continue { background-color: transparent; border: 1px solid #64ffda; color: #64ffda; }
.shop-now-btn {
    background-color: #64ffda;
    border: none;
    color: #0a192f;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: transform .15s ease;
}
.shop-now-btn:hover { transform: scale(1.03); }
</style>
</head>
<body>
<nav class="navbar navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">⌚ Watch Store</a>
  </div>
</nav>

<div class="container my-5">
    <div class="card p-4">
        <h2 class="mb-4">Your Cart</h2>

        <?php if ($cart_empty): ?>
            <div class="text-center py-5">
                <h4 class="mb-3">Your cart is empty</h4>
                <a href="index.php" class="shop-now-btn">🛒 Shop Now</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-borderless text-light">
                    <thead>
                        <tr class="text-muted">
                            <th>Item</th>
                            <th style="width:120px">Price</th>
                            <th style="width:100px">Quantity</th>
                            <th style="width:120px">Total</th>
                            <th style="width:120px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($normalized as $name => $item): 
                            $total = $item['price'] * $item['quantity'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($name); ?></td>
                                <td>₹<?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo intval($item['quantity']); ?></td>
                                <td>₹<?php echo number_format($total, 2); ?></td>
                                <td>
                                    <a href="cart.php?remove=<?php echo urlencode($name); ?>" class="btn btn-sm btn-danger">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="index.php" class="btn btn-continue">← Continue Shopping</a>
                <div>
                    <h5 class="d-inline me-4">Total: <strong>₹<?php echo number_format($grand_total, 2); ?></strong></h5>
                    <a href="checkout.php" class="btn btn-success">Checkout</a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
</body>
</html>
