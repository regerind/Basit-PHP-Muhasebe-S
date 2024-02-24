<?php
session_start();
include "database.php";

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $nakit_id = $_GET['id'];
    $query = "SELECT * FROM nakit WHERE nakit_id = '$nakit_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $nakit_data = mysqli_fetch_assoc($result);
} else {
    header("Location: nakitliste.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $update_baslik = validate($_POST["update_baslik"]);
    $update_aciklama = validate($_POST["update_aciklama"]);
    $update_gelen_tutar = validate($_POST["update_gelen_tutar"]);
    $update_cikan_tutar = validate($_POST["update_cikan_tutar"]);
    $update_zaman = validate($_POST["update_zaman"]);

    if (empty($update_baslik) || empty($update_aciklama) || empty($update_zaman)) {
        $error = "empty_fields";
    } else {
        $update_query = "UPDATE nakit SET nakit_baslik = '$update_baslik', nakit_aciklama = '$update_aciklama', nakit_gelen_tutar = '$update_gelen_tutar', nakit_cikan_tutar = '$update_cikan_tutar', nakit_zaman = '$update_zaman' WHERE nakit_id = '$nakit_id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            header("Location: nakitliste.php");
            exit();
        } else {
            $error = "update_failed";
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
    <title>Nakit Düzenle</title>
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $nakit_id; ?>" method="POST">
        <h3>Nakitı Güncelle</h3>
        <?php if (isset($error) && !empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <label for="update_baslik">Başlık</label>
        <input type="text" name="update_baslik" placeholder="Başlık" value="<?php echo $nakit_data['nakit_baslik']; ?>" required>
        <label for="update_aciklama">Açıklama</label>
        <input type="text" name="update_aciklama" placeholder="Açıklama" value="<?php echo $nakit_data['nakit_aciklama']; ?>" required>
        <label for="update_gelen_tutar">Gelen Tutar</label>
        <input type="text" name="update_gelen_tutar" placeholder="Gelen Tutar" value="<?php echo $nakit_data['nakit_gelen_tutar']; ?>" required>
        <label for="update_cikan_tutar">Çıkan Tutar</label>
        <input type="text" name="update_cikan_tutar" placeholder="Çıkan Tutar" value="<?php echo $nakit_data['nakit_cikan_tutar']; ?>" required>
        <label for="update_zaman">Zaman</label>
        <input type="date" name="update_zaman" placeholder="Zaman" value="<?php echo $nakit_data['nakit_zaman']; ?>" required>
        <button>Güncelle</button>
    </form>
</body>

</html>
