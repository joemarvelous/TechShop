<?php
session_start();
include('../db/connection.php');
if (!isset($_SESSION['admin'])) {
  die("Access denied");
  exit;
}

$products = $db->query("SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - TECHSHOP</title>
  <style>
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f8; margin: 0; }
    .admin-header { background: #222; color: #fff; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
    .admin-header h2 { margin: 0; }
    .admin-header a { color: #fff; margin-left: 20px; text-decoration: none; font-weight: bold; }
    .admin-header a:hover { text-decoration: underline; }
    .admin-container { max-width: 1100px; margin: 30px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); padding: 30px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 12px 10px; border-bottom: 1px solid #eee; text-align: left; }
    th { background: #f8f8f8; }
    tr:hover { background: #f1f7ff; }
    img { border-radius: 6px; }
    .actions a { margin-right: 10px; color: #1976d2; text-decoration: none; }
    .actions a:hover { text-decoration: underline; }
    .add-btn { background: #1976d2; color: #fff; padding: 8px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; }
    .add-btn:hover { background: #125ea7; }
    .logout-btn { background: #e53935; color: #fff; padding: 8px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; }
    .logout-btn:hover { background: #b71c1c; }
  </style>
</head>
<body>
  <div class="admin-header">
    <h2>TECHSHOP Admin Dashboard</h2>
    <div>
      <a href="add_product.php" class="add-btn">+ Add Product</a>
      <a href="logout.php" class="logout-btn">Logout</a>
    </div>
  </div>
  <div class="admin-container">
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
      <?php while ($row = $products->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td>$<?= $row['price'] ?></td>
        <td><img src="../uploads/<?= htmlspecialchars($row['image']) ?>" width="80"></td>
        <td class="actions">
          <a href="edit_product.php?id=<?= $row['id'] ?>">Edit</a>
          <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" style="color:#e53935;">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
