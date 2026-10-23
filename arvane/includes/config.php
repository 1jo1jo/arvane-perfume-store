<?php
$host = 'fdb1031.biz.nf';
$user = '4757702_arvane';
$password = 'Az0544681090';
$database = '4757702_arvane';

$conn = mysqli_connect("fdb1031.biz.nf", "4757702_arvane", "Az0544681090", "4757702_arvane");

if (!$conn) {
    die('connected is not ok ' . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>