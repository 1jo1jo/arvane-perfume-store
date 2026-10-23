<?php
include 'includes/config.php';
include 'includes/header.php';

$sql = "SELECT * FROM products LIMIT 6";
$result = mysqli_query($conn, $sql);
?>

<div class="hero">
    <div class="hero-content">
        <h1>Arvane</h1>
        <p>عطرك الخاص ... بصمتك الفريدة</p>
        <a href="custom_perfume.php" class="btn">اصنع عطرك الآن</a>
    </div>
</div>

<div class="products-section">
    <h2>عطورنا الجاهزة</h2>
    <div class="products-grid">
        <?php while($product = mysqli_fetch_assoc($result)): ?>
        <div class="product-card">
            <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <p class="price"><?php echo $product['price']; ?> ريال</p>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>