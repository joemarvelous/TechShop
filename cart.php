<?php
session_start();

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if (isset($_POST['add'])) {
  $_SESSION['cart'][] = [
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'price' => floatval($_POST['price']),
    'image' => $_POST['image']
  ];
}

if (isset($_GET['remove'])) {
  unset($_SESSION['cart'][$_GET['remove']]);
  $_SESSION['cart'] = array_values($_SESSION['cart']);
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - TECHSHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <header>
        <div class="logo">TECHSHOP</div>
        <nav>
            <a href="index.php">Continue Shopping</a>
            <a href="checkout.php" class="checkout-btn">Checkout</a>
        </nav>
    </header>

    <div class="cart-container">
        <h2 class="page-title">Shopping Cart</h2>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <p>Your cart is empty</p>
                <a href="index.php" class="btn btn-primary">Start Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $i => $item): ?>
                        <tr>
                            <td>
                                <div class="cart-product">
                                    <img src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                    <div class="cart-product-info">
                                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="price">
                                    <?php
                                    $price = number_format($item['price'], 2);
                                    list($whole, $decimal) = explode('.', $price);
                                    echo "<span class='price-whole'>\${$whole}</span>";
                                    echo "<span class='price-decimal'>.{$decimal}</span>";
                                    ?>
                                </div>
                            </td>
                            <td>
                                <a href="?remove=<?= $i ?>" class="remove-btn">Remove</a>
                            </td>
                        </tr>
                        <?php $total += $item['price']; endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span class="price">
                        <?php
                        $totalFormatted = number_format($total, 2);
                        list($whole, $decimal) = explode('.', $totalFormatted);
                        echo "<span class='price-whole'>\${$whole}</span>";
                        echo "<span class='price-decimal'>.{$decimal}</span>";
                        ?>
                    </span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span class="price">
                        <?php
                        echo "<span class='price-whole'>\${$whole}</span>";
                        echo "<span class='price-decimal'>.{$decimal}</span>";
                        ?>
                    </span>
                </div>
                <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
