<?php
session_start();

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
include "database.php";


if (isset($_POST["masraf_baslik"]) && isset($_POST["masraf_aciklama"]) && isset($_POST["masraf_tutar"]) && isset($_POST["masraf_zaman"]) && isset($_POST["masraf_kategori"])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $masraf_baslik = validate($_POST["masraf_baslik"]);
    $masraf_aciklama = validate($_POST["masraf_aciklama"]);
    $masraf_tutar = validate($_POST["masraf_tutar"]);
    $masraf_zaman = validate($_POST["masraf_zaman"]);
    $masraf_kategori = validate($_POST["masraf_kategori"]);

    if (empty($masraf_baslik) || empty($masraf_aciklama) || empty($masraf_tutar) || empty($masraf_zaman) || empty($masraf_kategori)) {
        header("Location: masraflarliste.php?error=empty_fields");
        exit();
    } else {
        $insert_query = "INSERT INTO masraflar(masraf_baslik, masraf_aciklama, masraf_tutar, masraf_zaman, masraf_kategori) 
                        VALUES ('$masraf_baslik', '$masraf_aciklama', '$masraf_tutar', '$masraf_zaman', '$masraf_kategori')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            header("Location: masraflarliste.php?success=masraf_added");
            exit();
        } else {
            header("Location: masraflarliste.php?error=masraf_not_added");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Masraf Ekle</title>
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <form action="" method="POST">
        <h3>Yeni Masraf Ekle</h3>
        <?php if (isset($_GET["success"]) && !empty($_GET["success"])) { ?>
            <div class="success"><?php echo $_GET["success"]; ?></div>
        <?php } ?>
        <?php if (isset($_GET["error"]) && !empty($_GET["error"])) { ?>
            <div class="error"><?php echo $_GET["error"]; ?></div>
        <?php } ?>
        <label for="masraf_baslik">Başlık</label>
        <input type="text" name="masraf_baslik" placeholder="Başlık" required>
        <label for="masraf_aciklama">Açıklama</label>
        <input type="text" name="masraf_aciklama" placeholder="Açıklama" required>
        <label for="masraf_tutar">Tutar</label>
        <input type="text" name="masraf_tutar" placeholder="Tutar" required>
        <label for="masraf_zaman">Zaman</label>
        <input type="date" name="masraf_zaman" placeholder="Zaman" required>
        <label for="masraf_kategori">Kategori</label>
        <input type="text" name="masraf_kategori" placeholder="Kategori" required>
        <button>Masraf Ekle</button>
    </form>
</body>

</html>
