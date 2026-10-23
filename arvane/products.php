<?php
session_start();
include 'includes/config.php';
include 'includes/header.php';
?>

<main>
    <div class="container">
        <h2>جميع عطورنا</h2>
        <div class="products-grid">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM products");
            if(mysqli_num_rows($result) > 0):
                while($row = mysqli_fetch_assoc($result)):
            ?>
            <div class="product-card">
                <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p class="price"><?php echo $row['price']; ?> ريال</p>
                <p><?php echo $row['description']; ?></p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn-add">🛒 أضف إلى السلة</button>
                </form>
            </div>
            <?php 
                endwhile;
            else:
                echo "<p>لا توجد منتجات حالياً. أضف منتجاتك من phpMyAdmin</p>";
            endif;
            ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>