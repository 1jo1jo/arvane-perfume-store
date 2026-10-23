<?php
include 'includes/config.php';
include 'includes/header.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM custom_orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="dashboard-container">
    <h2>مرحباً</h2>
    <h3>طلباتي من العطور المخصصة</h3>

    <?php if(mysqli_num_rows($result) == 0): ?>
        <div class="alert">
            لا يوجد طلبات بعد
            <br>
            <a href="custom_perfume.php" style="color:#c77dff;">اصنع عطرك الآن</a>
        </div>
    <?php else: ?>
        <?php while($order = mysqli_fetch_assoc($result)): ?>
        <div class="order-card">
            <h4><?php echo $order['perfume_name']; ?></h4>
            <p><strong>النوتة:</strong> <?php echo $order['note_type']; ?></p>
            <p><strong>القوة:</strong> <?php echo $order['strength']; ?></p>
            <p><strong>الرسالة:</strong> <?php echo !empty($order['message']) ? $order['message'] : 'لا توجد رسالة'; ?></p>
            <p><strong>السعر:</strong> <?php echo $order['price']; ?> ريال</p>
            <p><strong>التاريخ:</strong> <?php echo $order['order_date']; ?></p>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>