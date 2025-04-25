<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-info">
            <div class="footer-logo">TECHSHOP</div>
            <p class="footer-description">Your trusted source for tech products</p>
        </div>
        <div class="footer-links">
            <nav>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact</a>
                <a href="privacy.php">Privacy Policy</a>
                <a href="terms.php">Terms & Conditions</a>
            </nav>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> TECHSHOP. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
<a href="cart.php" class="cart-icon" title="<?= isset($lang) && $lang === 'kh' ? 'មើលកន្ត្រក' : 'View Cart' ?>">
    🛒
    <?php if (!empty($_SESSION['cart'])): ?>
        <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
    <?php endif; ?>
</a>
<?php endif; ?>

</body>
</html>