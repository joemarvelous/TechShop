<!DOCTYPE html>
<html lang="<?= isset($lang) ? $lang : 'en' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - TECHSHOP' : 'TECHSHOP' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <?php if (in_array(basename($_SERVER['PHP_SELF']), ['cart.php', 'checkout.php'])): ?>
        <link rel="stylesheet" href="css/cart.css">
    <?php else: ?>
        <link rel="stylesheet" href="css/index.css">
    <?php endif; ?>
</head>
<body>
<header class="main-header">
    <div class="header-content">
        <div class="header-left">
            <a href="index.php" class="logo">
                <span class="logo-text">TECH</span>
                <span class="logo-highlight">SHOP</span>
            </a>
            <form class="search-form" action="search.php" method="GET">
                <input type="search" name="q" placeholder="<?= isset($lang) && $lang === 'kh' ? 'ស្វែងរក...' : 'Search...' ?>" class="search-input">
                <button type="submit" class="search-button">🔍</button>
            </form>
        </div>

        <nav class="main-nav">
            <a href="index.php" class="nav-link">
                <span class="nav-icon">🏠</span>
                <?= isset($lang) && $lang === 'kh' ? 'ទំព័រដើម' : 'Home' ?>
            </a>
            <a href="cart.php" class="nav-link cart-link">
                <span class="nav-icon">🛒</span>
                <?= isset($lang) && $lang === 'kh' ? 'កន្ត្រក' : 'Cart' ?>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <span class="nav-cart-count"><?= count($_SESSION['cart']) ?></span>
                <?php endif; ?>
            </a>
            <?php if (isset($lang)): ?>
            <a href="?lang=<?= $lang === 'kh' ? 'en' : 'kh' ?>" class="nav-link lang-switch">
                <span class="nav-icon"><?= $lang === 'kh' ? '🇺🇸' : '🇰🇭' ?></span>
                <?= $lang === 'kh' ? 'English' : 'ខ្មែរ' ?>
            </a>
            <?php endif; ?>
        </nav>
    </div>
</header>