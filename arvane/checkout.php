<?php
session_start();
include 'includes/config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// جلب منتجات السلة
$cart_items = mysqli_query($conn, "SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id='$user_id'");

// حساب المجموع
$total = 0;
while($item = mysqli_fetch_assoc($cart_items)) {
    $total += $item['price'] * $item['quantity'];
}

// حفظ الطلب في جدول orders
$order_query = "INSERT INTO orders (user_id, total_price, status) VALUES ('$user_id', '$total', 'جديد')";
mysqli_query($conn, $order_query);
$order_id = mysqli_insert_id($conn);

// حفظ تفاصيل الطلب
$cart_items = mysqli_query($conn, "SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id='$user_id'");
while($item = mysqli_fetch_assoc($cart_items)) {
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')");
}

// تفريغ السلة
mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تم إتمام الشراء - Arvane</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav style="background:#2d1b4e; padding:20px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1 style="color:#c77dff; margin:0;">Arvane</h1>
        <p style="color:#ccc; margin:0;">عطرك الخاص .. بصمتك الفريدة</p>
    </div>
    <ul style="list-style:none; display:flex; gap:20px; margin:0;">
        <li><a href="index.php" style="color:white;">الرئيسية</a></li>
        <li><a href="products.php" style="color:white;">العطور</a></li>
        <li><a href="custom_perfume.php" style="color:white;">الصانع</a></li>
        <li><a href="logout.php" style="color:white;">تسجيل خروج</a></li>
    </ul>
</nav>

<main>
    <div style="max-width:500px; margin:50px auto; padding:30px; background:white; border-radius:10px; text-align:center;">
        <h2 style="color:#2d1b4e;">✅ تم إتمام الشراء بنجاح!</h2>
        <p>شكراً لتسوقك معنا</p>
        <p>رقم طلبك: <strong><?php echo $order_id; ?></strong></p>
        <p>المجموع: <strong><?php echo $total; ?> ريال</strong></p>
        <a href="index.php" style="background:#c77dff; color:#2d1b4e; padding:10px 20px; text-decoration:none; border-radius:25px; display:inline-block; margin-top:20px;">العودة للرئيسية</a>
    </div>
</main>

<footer style="background:#2d1b4e; color:#ccc; text-align:center; padding:20px; margin-top:50px;">
    <p>© 2026 Arvane - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>