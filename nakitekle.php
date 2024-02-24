<?php
session_start();

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}
include "database.php";


if (isset($_POST["nakit_baslik"]) && isset($_POST["nakit_aciklama"]) && isset($_POST["nakit_gelen_tutar"]) && isset($_POST["nakit_cikan_tutar"]) && isset($_POST["nakit_zaman"])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nakit_baslik = validate($_POST["nakit_baslik"]);
    $nakit_aciklama = validate($_POST["nakit_aciklama"]);
    $nakit_gelen_tutar = validate($_POST["nakit_gelen_tutar"]);
    $nakit_cikan_tutar = validate($_POST["nakit_cikan_tutar"]);
    $nakit_zaman = validate($_POST["nakit_zaman"]);

    if (empty($nakit_baslik) || empty($nakit_aciklama) || !is_numeric($nakit_gelen_tutar) || !is_numeric($nakit_cikan_tutar) || empty($nakit_zaman)) {
        header("Location: nakitliste.php?error=bos_alanlar");
        exit();
    
    
    } else {
        $insert_query = "INSERT INTO nakit(nakit_baslik, nakit_aciklama, nakit_gelen_tutar, nakit_cikan_tutar, nakit_zaman) 
                        VALUES ('$nakit_baslik', '$nakit_aciklama', '$nakit_gelen_tutar', '$nakit_cikan_tutar', '$nakit_zaman')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            header("Location: nakitliste.php?success=nakit_added");
            exit();
        } else {
            header("Location: nakitliste.php?error=nakit_not_added");
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
    <title>Yeni Nakit Ekle</title>
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h3>Yeni Nakit Ekle</h3>
        <?php if (isset($_GET["success"]) && !empty($_GET["success"])) { ?>
            <div class="success"><?php echo $_GET["success"]; ?></div>
        <?php } ?>
        <?php if (isset($_GET["error"]) && !empty($_GET["error"])) { ?>
            <div class="error"><?php echo $_GET["error"]; ?></div>
        <?php } ?>
        <label for="nakit_baslik">Başlık</label>
        <input type="text" name="nakit_baslik" placeholder="Başlık" required>
        <label for="nakit_aciklama">Açıklama</label>
        <input type="text" name="nakit_aciklama" placeholder="Açıklama" required>
        <label for="nakit_gelen_tutar">Gelen Tutar</label>
        <input type="text" name="nakit_gelen_tutar" placeholder="Gelen Tutar" required>
        <label for="nakit_cikan_tutar">Çıkan Tutar</label>
        <input type="text" name="nakit_cikan_tutar" placeholder="Çıkan Tutar" required>
        <label for="nakit_zaman">Zaman</label>
        <input type="date" name="nakit_zaman" placeholder="Zaman" required>
        <button>Nakit Ekle</button>
    </form>
</body>

</html>
