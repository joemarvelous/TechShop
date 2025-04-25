<?php
session_start();
include('db/connection.php');

$id = $_GET['id'] ?? null;
if (!$id) {
  header("Location: index.php");
  exit;
}

$product = $db->query("SELECT * FROM products WHERE id = ?", [$id])->fetch_assoc();
if (!$product) {
  echo "<h2>Product not found.</h2>";
  exit;
}

$lang = $_SESSION['lang'] ?? 'en';
?>
<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($lang === 'kh' ? $product['name_kh'] : $product['name']) ?> - TECHSHOP</title>
  <link rel="stylesheet" href="css/index.css">
  <style>
    body {
      background: #f5f7fa;
      font-family: 'Segoe UI', 'Nokora', Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .detail-container {
      max-width: 1000px;
      margin: 50px auto;
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(60,72,88,0.10);
      display: flex;
      gap: 48px;
      padding: 40px 36px;
      align-items: flex-start;
    }
    .detail-img {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .detail-img img {
      width: 320px;
      max-width: 100%;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.07);
      background: #f8f8f8;
      padding: 10px;
    }
    .detail-info {
      flex: 2;
      display: flex;
      flex-direction: column;
      gap: 18px;
    }
    .detail-info h2 {
      margin: 0 0 10px 0;
      font-size: 2rem;
      font-weight: 700;
      color: #222;
      letter-spacing: 0.5px;
    }
    .detail-specs {
      color: #444;
      font-size: 1.05rem;
      background: #f7f9fa;
      border-radius: 8px;
      padding: 12px 16px;
      margin: 0 0 10px 0;
      line-height: 1.6;
    }
    .price {
      font-size: 1.6rem;
      color: #e53935;
      font-weight: bold;
      margin-right: 10px;
    }
    .old {
      font-size: 1.1rem;
      color: #888;
      text-decoration: line-through;
      margin-left: 10px;
    }
    .discount {
      color: #388e3c;
      font-weight: bold;
      margin-left: 10px;
      font-size: 1.1rem;
    }
    .back-link {
      display: inline-block;
      margin: 30px 0 0 40px;
      color: #1976d2;
      text-decoration: none;
      font-size: 1.1rem;
      font-weight: 500;
      transition: color 0.2s;
    }
    .back-link:hover {
      color: #0d47a1;
      text-decoration: underline;
    }
    .detail-form {
      margin-top: 18px;
    }
    .detail-form button {
      background: #1976d2;
      color: #fff;
      border: none;
      padding: 12px 28px;
      border-radius: 8px;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.2s;
      box-shadow: 0 2px 8px rgba(25,118,210,0.08);
    }
    .detail-form button:hover {
      background: #125ea7;
    }
    .detail-info h4 {
      margin: 18px 0 6px 0;
      color: #1976d2;
      font-size: 1.1rem;
      font-weight: 600;
    }
    .detail-info .desc {
      color: #444;
      font-size: 1.05rem;
      background: #f7f9fa;
      border-radius: 8px;
      padding: 12px 16px;
      line-height: 1.6;
    }
    @media (max-width: 900px) {
      .detail-container {
        flex-direction: column;
        gap: 24px;
        padding: 20px 8px;
      }
      .back-link {
        margin-left: 10px;
      }
    }
  </style>
</head>
<body>
  <a href="index.php" class="back-link">&larr; <?= $lang === 'kh' ? 'ត្រឡប់ក្រោយ' : 'Back to Shop' ?></a>
  <div class="detail-container">
    <div class="detail-img">
      <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="detail-info">
      <h2><?= htmlspecialchars($lang === 'kh' ? $product['name_kh'] : $product['name']) ?></h2>
      <div class="detail-specs"><?= nl2br(htmlspecialchars($product['specs'])) ?></div>
      <div>
        <span class="price">$<?= number_format($product['price'], 2) ?></span>
        <?php if ($product['old_price'] > 0): ?>
          <span class="old">$<?= number_format($product['old_price'], 2) ?></span>
        <?php endif; ?>
        <?php if ($product['discount'] > 0): ?>
          <span class="discount">-<?= htmlspecialchars($product['discount']) ?>%</span>
        <?php endif; ?>
      </div>
      <div class="detail-form">
        <form method="POST" action="cart.php">
          <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
          <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
          <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']) ?>">
          <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
          <button type="submit" name="add"><?= $lang === 'kh' ? 'បន្ថែមទៅកន្ត្រក' : 'Add to Cart' ?></button>
        </form>
      </div>
      <?php if (!empty($product['description'])): ?>
        <h4><?= $lang === 'kh' ? 'ពិពណ៌នា' : 'Description' ?></h4>
        <div class="desc"><?= nl2br(htmlspecialchars($product['description'])) ?></div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
