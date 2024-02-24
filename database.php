<?php
// veritabanı ayarları
include "config.php";

$db_name = "uyelik_sistemi"; // veritabanı adı

$conn = mysqli_connect($sname, $unmae, $password);

if (!$conn) {
    echo "connection error";
    die();
}

// database var mı diye kontrol et
$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    // eğer database yoksa setup.php ye yönlendir
    header("Location: setup.php");
    exit();
}

// database'i seç
mysqli_select_db($conn, $db_name);
?>
