<?php
// roaa

session_start();
include 'includes/config.php';
include 'includes/functions.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $perfume_name = sanitize_input($_POST['perfume_name']);
    $note_type = sanitize_input($_POST['note_type']);
    $strength = sanitize_input($_POST['strength']);
    $message = sanitize_input($_POST['message']);
    $user_id = $_SESSION['user_id'];
    
    $price = calculatePrice($note_type, $strength);
    
    $sql = "INSERT INTO custom_orders (user_id, perfume_name, note_type, strength, message, price) 
            VALUES ('$user_id', '$perfume_name', '$note_type', '$strength', '$message', '$price')";
    
    if(mysqli_query($conn, $sql)) {
        ?>
        <div class="order-summary">
            <h2>✅ تم استلام طلبك بنجاح!</h2>
            <h3>📋 ملخص عطرك الخاص</h3>
            <p><strong>🌹 اسم العطر:</strong> <?php echo $perfume_name; ?></p>
            <p><strong>🌸 النوتة:</strong> <?php echo $note_type; ?></p>
            <p><strong> القوة:</strong> <?php echo $strength; ?></p>
            <p><strong> الرسالة:</strong> <?php echo $message ? $message : 'لا توجد'; ?></p>
            <p><strong>💰 السعر الإجمالي:</strong> <?php echo $price; ?> ريال</p>
            <div style="margin-top: 20px;">
                <a href="custom_perfume.php" class="btn"> تصميم عطر آخر</a>
                <a href="dashboard.php" class="btn">📋 طلباتي</a>
            </div>
        </div>
        <?php
    } else {
        echo "<div class='alert'>❌ حدث خطأ: " . mysqli_error($conn) . "</div>";
    }
} else {
    header('Location: custom_perfume.php');
}
?>

<style>
.order-summary {
    background: white;
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.order-summary a {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 10px;
}
.order-summary a:hover {
    background: #764ba2;
}
</style>