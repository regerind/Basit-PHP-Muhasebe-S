<?php
session_start();
include "database.php";

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $masraf_id = $_GET['id'];
    $query = "SELECT * FROM masraflar WHERE masraf_id = '$masraf_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $masraf_data = mysqli_fetch_assoc($result);
} else {
    header("Location: masraflarliste.php");
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
    $update_tutar = validate($_POST["update_tutar"]);
    $update_zaman = validate($_POST["update_zaman"]);
    $update_kategori = validate($_POST["update_kategori"]);

    if (empty($update_baslik) || empty($update_aciklama) || empty($update_tutar) || empty($update_zaman) || empty($update_kategori)) {
        $error = "empty_fields";
    } else {
        $update_query = "UPDATE masraflar SET masraf_baslik = '$update_baslik', masraf_aciklama = '$update_aciklama', masraf_tutar = '$update_tutar', masraf_zaman = '$update_zaman', masraf_kategori = '$update_kategori' WHERE masraf_id = '$masraf_id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            header("Location: masraflarliste.php");
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
    <title>Masraf Düzenle</title>
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $masraf_id; ?>" method="POST">
        <h3>Masrafı Güncelle</h3>
        <?php if (isset($error) && !empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <label for="update_baslik">Başlık</label>
        <input type="text" name="update_baslik" placeholder="Başlık" value="<?php echo $masraf_data['masraf_baslik']; ?>" required>
        <label for="update_aciklama">Açıklama</label>
        <input type="text" name="update_aciklama" placeholder="Açıklama" value="<?php echo $masraf_data['masraf_aciklama']; ?>" required>
        <label for="update_tutar">Tutar</label>
        <input type="text" name="update_tutar" placeholder="Tutar" value="<?php echo $masraf_data['masraf_tutar']; ?>" required>
        <label for="update_zaman">Zaman</label>
        <input type="date" name="update_zaman" placeholder="Zaman" value="<?php echo $masraf_data['masraf_zaman']; ?>" required>
        <label for="update_kategori">Kategori</label>
        <input type="text" name="update_kategori" placeholder="Kategori" value="<?php echo $masraf_data['masraf_kategori']; ?>" required>
        <button>Güncelle</button>
    </form>
</body>

</html>
