<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arvane - عطرك الخاص</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Arvane</h1>
            <p>عطرك الخاص .. بصمتك الفريدة</p>
        </div>
        <ul>
            <li><a href="index.php">الرئيسية</a></li>
            <li><a href="products.php">العطور</a></li>
            <li><a href="custom_perfume.php">الصانع</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="dashboard.php">طلباتي</a></li>
                <li><a href="logout.php">تسجيل خروج</a></li>
            <?php else: ?>
                <li><a href="login.php">تسجيل دخول</a></li>
                <li><a href="register.php">حساب جديد</a></li>
            <?php endif; ?>
        </ul>
    </nav>