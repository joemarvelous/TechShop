<?php
session_start();
include('../db/connection.php');
if (!isset($_SESSION['admin'])) {
  die("Access denied");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $img = $_FILES['image']['name'];
  move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/$img");

  $db->query("INSERT INTO products (name, description, category, specs, price, old_price, discount, image)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [
    $_POST['name'], $_POST['description'], $_POST['category'], $_POST['specs'],
    $_POST['price'], $_POST['old_price'], $_POST['discount'], $img
  ]);

  header("Location: dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Product - TECHSHOP Admin</title>
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
    <h2>Add Product</h2>
  </div>
  <div class="admin-container">
    <form method="POST" enctype="multipart/form-data">
      <input name="name" placeholder="Name" required>
      <textarea name="description" placeholder="Description"></textarea>
      <input name="category" placeholder="Category" required>
      <input name="specs" placeholder="Specs">
      <input name="price" placeholder="Price ($)" required>
      <input name="old_price" placeholder="Old Price ($)">
      <input name="discount" placeholder="Discount %">
      <input type="file" name="image" required>
      <button type="submit">Add</button>
    </form>
    <a href="dashboard.php">← Back to Dashboard</a>
  </div>
</body>
</html>
