<?php
session_start();
include 'includes/config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $perfume_name = $_POST['perfume_name'];
    $note = $_POST['note'];
    $strength = $_POST['strength'];
    $message = $_POST['message'];
    
    // حساب السعر على حسب الاختيارات
    $price = 100; // سعر أساسي
    
    if($note == "زهور") $price += 50;
    elseif($note == "خشب") $price += 80;
    elseif($note == "فواكه") $price += 60;
    elseif($note == "مسك") $price += 100;
    
    if($strength == "قوي") $price += 70;
    elseif($strength == "متوسط") $price += 40;
    
    // حفظ الطلب في قاعدة البيانات (إذا عندك جدول custom_orders)
    $user_id = $_SESSION['user_id'];
    $query = "INSERT INTO custom_orders (user_id, perfume_name, note_type, strength, message, price) 
              VALUES ('$user_id', '$perfume_name', '$note', '$strength', '$message', '$price')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم استلام طلبك - Arvane</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav style="background:#2d1b4e; padding:20px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1 style="color:#c77dff; margin:0;">Arvane</h1>
        <p style="color:#ccc; margin:0;">عطرك الخاص .. بصمتك الفريدة</p>
    </div>
    <ul style="list-style:none; display:flex; gap:20px; margin:0;">
        <li><a href="index.php" style="color:white; text-decoration:none;">الرئيسية</a></li>
        <li><a href="products.php" style="color:white; text-decoration:none;">العطور</a></li>
        <li><a href="custom_perfume.php" style="color:white; text-decoration:none;">الصانع</a></li>
        <li><a href="logout.php" style="color:white; text-decoration:none;">تسجيل خروج</a></li>
    </ul>
</nav>

<main>
    <div class="custom-perfume-container" style="text-align:center;">
        <h2>✅ تم استلام طلبك بنجاح!</h2>
        <p>شكراً لك <strong><?php echo $_SESSION['username'] ?? ''; ?></strong></p>
        <div style="background:#f3eef8; padding:20px; border-radius:10px; margin:20px 0; text-align:right;">
            <p><strong>اسم العطر:</strong> <?php echo $perfume_name; ?></p>
            <p><strong>النوتة العطرية:</strong> <?php echo $note; ?></p>
            <p><strong>قوة العطر:</strong> <?php echo $strength; ?></p>
            <p><strong>رسالتك:</strong> <?php echo !empty($message) ? $message : "لا توجد رسالة"; ?></p>
            <p><strong>السعر الإجمالي:</strong> <?php echo $price; ?> ريال</p>
        </div>
        <a href="index.php" class="btn">العودة للرئيسية</a>
    </div>
</main>

<footer style="background:#2d1b4e; color:#ccc; text-align:center; padding:20px; margin-top:50px;">
    <p>© 2026 Arvane - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>