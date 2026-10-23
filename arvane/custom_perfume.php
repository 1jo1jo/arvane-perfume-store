<?php
include 'includes/header.php';
?>

<main>
    <div class="custom-perfume-container">
        <h2>اصنعي عطرك الخاص</h2>
        
        <form method="POST" action="calculate.php">
            <div class="form-group">
                <label>اسم عطرك</label>
                <input type="text" name="perfume_name" placeholder="مثال: عطر الروح">
            </div>

            <div class="form-group">
                <label>النوتة العطرية</label>
                <select name="note">
                    <option>زهور</option>
                    <option>خشب</option>
                    <option>فواكه</option>
                    <option>مسك</option>
                </select>
            </div>

            <div class="form-group">
                <label>قوة العطر</label>
                <select name="strength">
                    <option>خفيف</option>
                    <option>متوسط</option>
                    <option>قوي</option>
                </select>
            </div>

            <div class="form-group">
                <label>رسالة على الزجاجة (اختياري)</label>
                <textarea name="message" rows="3" placeholder="اكتب رسالتك الخاصة"></textarea>
            </div>

            <button type="submit" class="btn">احسب السعر واطلب</button>
        </form>
    </div>
</main>

<?php
include 'includes/footer.php';
?>