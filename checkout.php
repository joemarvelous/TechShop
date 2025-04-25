<?php
session_start();
include('db/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $phone = htmlspecialchars($_POST['phone']);
  $address = htmlspecialchars($_POST['address']);
  $items = json_encode($_SESSION['cart']);
  $total = array_sum(array_map(function($item) { return floatval($item['price']); }, $_SESSION['cart']));

  $db->query("INSERT INTO orders (name, phone, address, items, total) VALUES (?, ?, ?, ?, ?)",
             [$name, $phone, $address, $items, $total]);

  unset($_SESSION['cart']);
  $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - TECHSHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <header>
        <div class="logo">TECHSHOP</div>
        <nav>
            <a href="cart.php">Back to Cart</a>
        </nav>
    </header>

    <div class="cart-container">
        <h2 class="page-title">Checkout</h2>
        
        <?php if (isset($success)): ?>
            <div class="success-message">
                <h3>✅ Order placed successfully!</h3>
                <p>Thank you for your purchase.</p>
                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="checkout-container">
                <div class="checkout-form">
                    <form method="POST">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Delivery Address</label>
                            <textarea id="address" name="address" class="form-input" rows="4" required></textarea>
                        </div>

                        <div class="cart-summary">
                            <div class="summary-row">
                                <span>Total Items:</span>
                                <span><?= count($_SESSION['cart']) ?></span>
                            </div>
                            <div class="summary-row total">
                                <span>Total Amount:</span>
                                <span class="price">
                                    <?php
                                    $total = array_sum(array_map(function($item) { 
                                        return floatval($item['price']); 
                                    }, $_SESSION['cart']));
                                    $totalFormatted = number_format($total, 2);
                                    list($whole, $decimal) = explode('.', $totalFormatted);
                                    echo "<span class='price-whole'>\${$whole}</span>";
                                    echo "<span class='price-decimal'>.{$decimal}</span>";
                                    ?>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
