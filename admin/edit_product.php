<?php
session_start();
include('../db/connection.php');
if (!isset($_SESSION['admin'])) {
  die("Access denied");
  exit;
}

$id = $_GET['id'];
$product = $db->query("SELECT * FROM products WHERE id = ?", [$id])->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $db->query("UPDATE products SET name=?, description=?, category=?, specs=?, price=?, old_price=?, discount=? WHERE id=?",
    [$_POST['name'], $_POST['description'], $_POST['category'], $_POST['specs'],
     $_POST['price'], $_POST['old_price'], $_POST['discount'], $id]);

  header("Location: dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Product - TECHSHOP Admin</title>
  <style>
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f8; margin: 0; }
    .admin-header { background: #222; color: #fff; padding: 20px 40px; }
    .admin-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); padding: 30px; }
    h2 { margin-top: 0; }
    form { display: flex; flex-direction: column; }
    input, textarea { margin-bottom: 14px; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-size: 15px; }
    textarea { resize: vertical; }
    button { background: #1976d2; color: #fff; border: none; padding: 10px 0; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; }
    button:hover { background: #125ea7; }
    a { color: #1976d2; text-decoration: none; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="admin-header">
    <h2>Edit Product</h2>
  </div>
  <div class="admin-container">
    <form method="POST">
      <input name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
      <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>
      <input name="category" value="<?= htmlspecialchars($product['category']) ?>" required>
      <input name="specs" value="<?= htmlspecialchars($product['specs']) ?>">
      <input name="price" value="<?= htmlspecialchars($product['price']) ?>" placeholder="Price ($)" required>
      <input name="old_price" value="<?= htmlspecialchars($product['old_price']) ?>" placeholder="Old Price ($)">
      <input name="discount" value="<?= htmlspecialchars($product['discount']) ?>">
      <button type="submit">Update</button>
    </form>
    <a href="dashboard.php">← Back to Dashboard</a>
  </div>
</body>
</html>
