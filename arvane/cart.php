<?php
session_start();
include 'includes/config.php';
include 'includes/header.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT products.*, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id='$user_id'");
?>

<main>
    <div class="container">
        <h2>سلة التسوق</h2>
        <?php if(mysqli_num_rows($result) > 0): ?>
        <table class="cart-table">
            <tr>
                <th>المنتج</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>الإجمالي</th>
                <th></th>
            </tr>
            <?php 
            $total = 0;
            while($row = mysqli_fetch_assoc($result)): 
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?> ريال</td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $subtotal; ?> ريال</td>
                <td><a href="remove_from_cart.php?id=<?php echo $row['id']; ?>">❌ حذف</a></td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3"><strong>المجموع الكلي</strong></td>
                <td colspan="2"><strong><?php echo $total; ?> ريال</strong></td>
            </tr>
        </table>
        <a href="checkout.php" class="btn-checkout">إتمام الشراء</a>
        <?php else: ?>
        <p>سلة التسوق فارغة</p>
        <?php endif; ?>
        <a href="products.php">← العودة إلى العطور</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>