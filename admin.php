
<!-- admin.php -->
<?php
session_start();

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

include "database.php";
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="./css/admin.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/admin_dashboard.css">

</head>

<body>
    <nav>
    <div class="navbar">
        <a href="index.php" class="ana-sayfa">ANA SAYFA</a>
        <div class="dropdown">
            <button class="dropbtn">Kullanıcılar 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="kullaniciliste.php">Kullanıcı Listesi</a>
                
            </div>
        </div> 

        <div class="dropdown">
            <button class="dropbtn">Masraflar 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="masraflarliste.php">Masraf Listesi</a>
                <a href="masrafekle.php">Masraf Ekle</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Nakit 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="nakitliste.php">Nakit Listesi</a>
                <a href="nakitekle.php">Nakit Ekle</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Çekler 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="cekliste.php">Çek Listesi</a>
                <a href="cekekle.php">Çek Ekle</a>
            </div>
        </div>

        <div class="dropdownSplit">
            <button class="dropbtn"><?php echo $_SESSION["username"]; ?> 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="reset-password.php">Şifre değiştir</a>
                <a href="logout.php">Güvenli Çıkış</a>
            </div>
        </div>
    </div>
    </nav>
</body>




</html>
