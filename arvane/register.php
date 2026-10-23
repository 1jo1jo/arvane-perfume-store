<?php
session_start();
include 'includes/config.php';

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0) {
        $error = "البريد الإلكتروني مسجل مسبقاً";
    } else {
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if(mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "حدث خطأ، حاول مرة أخرى";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حساب جديد - Arvane</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>حساب جديد</h2>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="اسم المستخدم" required>
                <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                <input type="password" name="password" placeholder="كلمة المرور" required>
                <button type="submit" name="submit">تسجيل</button>
            </form>
            <p>لديك حساب؟ <a href="login.php">تسجيل دخول</a></p>
        </div>
    </div>
</body>
</html>