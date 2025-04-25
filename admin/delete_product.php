<?php
session_start();
include('../db/connection.php');
if (!isset($_SESSION['admin'])) {
  die("Access denied");
  exit;
}

$db->query("DELETE FROM products WHERE id = ?", [$_GET['id']]);
header("Location: dashboard.php");
exit;
