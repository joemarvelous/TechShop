<?php
session_start();
include('db/connection.php');

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'en';

$category = $_GET['category'] ?? null;
$sql = "SELECT * FROM products";
$params = [];

if ($category) {
  $sql .= " WHERE category = ?";
  $params[] = $category;
}

$sql .= " ORDER BY created_at DESC";
$result = $db->query($sql, $params);
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECHSHOP</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="logo">TECHSHOP</div>
    <nav>
        <a href="index.php"><?= $lang === 'kh' ? 'ទំព័រដើម' : 'Home' ?></a>
        <a href="cart.php"><?= $lang === 'kh' ? 'កន្ត្រក' : 'Cart' ?></a>
        <a href="?lang=<?= $lang === 'kh' ? 'en' : 'kh' ?>" class="lang-switch">
            <?= $lang === 'kh' ? 'English' : 'ខ្មែរ' ?>
        </a>
    </nav>
</header>

<div class="container">
    <aside class="sidebar">
        <h3 class="category-title"><?= $lang === 'kh' ? 'ប្រភេទ' : 'Categories' ?></h3>
        <nav class="category-nav">
            <a href="index.php" class="category-link <?= !$category ? 'active' : '' ?>">
                <?= $lang === 'kh' ? 'ទាំងអស់' : 'All' ?>
            </a>
            <?php
            $categories = [
                'Laptops' => ['kh' => 'កុំព្យូទ័រយួរដៃ', 'en' => 'Laptops'],
                'CPU' => ['kh' => 'CPU', 'en' => 'CPU'],
                'GPU' => ['kh' => 'GPU', 'en' => 'GPU'],
                'RAM' => ['kh' => 'RAM', 'en' => 'RAM'],
                'Accessories' => ['kh' => 'គ្រឿងបន្លាស់', 'en' => 'Accessories'],
                'Monitors' => ['kh' => 'ម៉ូនីទ័រ', 'en' => 'Monitors'],
                'Storage' => ['kh' => 'ឧបករណ៍ផ្ទុក', 'en' => 'Storage'],
                'Power Supply' => ['kh' => 'ផៅវ័រសផ្លាយ', 'en' => 'Power Supply'],
                'Cooling' => ['kh' => 'ប្រព័ន្ធត្រជាក់', 'en' => 'Cooling'],
                'Motherboards' => ['kh' => 'ម៉ាធើបត', 'en' => 'Motherboards'],
                'Peripherals' => ['kh' => 'គ្រឿងបន្ថែម', 'en' => 'Peripherals'],
                'Bundles' => ['kh' => 'កញ្ចប់ពិសេស', 'en' => 'Bundles'],
                'Networking' => ['kh' => 'បណ្តាញ', 'en' => 'Networking']
            ];
            
            foreach ($categories as $cat => $names): ?>
                <a href="?category=<?= urlencode($cat) ?>" 
                   class="category-link <?= $category === $cat ? 'active' : '' ?>">
                    <?= $names[$lang] ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </aside>

    <main class="main">
        <h2 class="section-title">
            <?= $category ? ($categories[$category][$lang] ?? $category) : ($lang === 'kh' ? 'ផលិតផលថ្មីៗ' : 'Latest Products') ?>
        </h2>
        
        <div class="products">
            <?php while($row = $result->fetch_assoc()): ?>
                <article class="product">
                    <a href="product.php?id=<?= htmlspecialchars($row['id']) ?>" class="product-image">
                        <?php
                        $imgPath = 'uploads/' . htmlspecialchars($row['image']);
                        if (!empty($row['image']) && file_exists($imgPath)) {
                            echo '<img src="' . $imgPath . '" alt="' . htmlspecialchars($row['name']) . '">';
                        } else {
                            echo '<img src="https://via.placeholder.com/300x300?text=No+Image" alt="No image">';
                        }
                        ?>
                    </a>
                    <div class="product-details">
                        <h3>
                            <a href="product.php?id=<?= htmlspecialchars($row['id']) ?>">
                                <?= $lang === 'kh' ? htmlspecialchars($row['name_kh']) : htmlspecialchars($row['name']) ?>
                            </a>
                        </h3>
                        <p class="specs"><?= htmlspecialchars($row['specs']) ?></p>
                        <div class="price-container">
                            <span class="price">
                                <?php
                                $price = number_format($row['price'], 2);
                                list($whole, $decimal) = explode('.', $price);
                                echo "<span class='price-whole'>\${$whole}</span>";
                                echo "<span class='price-decimal'>.{$decimal}</span>";
                                ?>
                            </span>
                            <?php if ($row['old_price'] > $row['price']): ?>
                                <span class="old-price">$<?= number_format($row['old_price'], 2) ?></span>
                                <?php if ($row['discount'] > 0): ?>
                                    <span class="discount-badge">-<?= htmlspecialchars($row['discount']) ?>%</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <form method="POST" action="cart.php" class="add-to-cart">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                            <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
                            <input type="hidden" name="price" value="<?= htmlspecialchars($row['price']) ?>">
                            <input type="hidden" name="image" value="<?= htmlspecialchars($row['image']) ?>">
                            <button type="submit" name="add" class="button"><?= $lang === 'kh' ? 'បន្ថែមទៅកន្ត្រក' : 'Add to Cart' ?></button>
                        </form>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </main>
</div>

<a href="cart.php" class="cart-icon" title="<?= $lang === 'kh' ? 'មើលកន្ត្រក' : 'View Cart' ?>">
    🛒
    <?php if (!empty($_SESSION['cart'])): ?>
        <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
    <?php endif; ?>
</a>

</body>
</html>
