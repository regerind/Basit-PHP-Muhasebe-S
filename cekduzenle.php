<?php
session_start();
include "database.php";

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $cek_id = $_GET['id'];
    $query = "SELECT * FROM cekler WHERE id = '$cek_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $cek_data = mysqli_fetch_assoc($result);
} else {
    header("Location: cekliste.php");
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

    $update_cek_numarasi = validate($_POST["update_cek_numarasi"]);
    $update_banka_bilgisi = validate($_POST["update_banka_bilgisi"]);
    $update_cek_tarihi = validate($_POST["update_cek_tarihi"]);
    $update_cek_durumu = validate($_POST["update_cek_durumu"]);
    $update_alici_bilgisi = validate($_POST["update_alici_bilgisi"]);
    $update_odeme_miktari = validate($_POST["update_odeme_miktari"]); 
    $update_para_birimi = validate($_POST["update_para_birimi"]);
    $update_referans_numarasi = validate($_POST["update_referans_numarasi"]);

    if (empty($update_cek_numarasi) || empty($update_banka_bilgisi) || empty($update_cek_tarihi) || empty($update_cek_durumu) || empty($update_alici_bilgisi) || empty($update_odeme_miktari) || empty($update_para_birimi) || empty($update_referans_numarasi)) {
        $error = "bos_alanlar";
    } else {
        $update_query = "UPDATE cekler SET 
                        cek_numarasi = '$update_cek_numarasi', 
                        banka_bilgisi = '$update_banka_bilgisi', 
                        cek_tarihi = '$update_cek_tarihi', 
                        cek_durumu = '$update_cek_durumu', 
                        alici_bilgisi = '$update_alici_bilgisi', 
                        odeme_miktari = '$update_odeme_miktari', 
                        para_birimi = '$update_para_birimi', 
                        referans_numarasi = '$update_referans_numarasi' 
                        WHERE id = '$cek_id'";
        
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            header("Location: cekliste.php");
            exit();
        } else {
            $error = "hata";
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
    <title>Çek Düzenle</title>
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.07);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        select::-ms-expand {
            display: none;
        }

        select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.6);
        }

        select option {
            background-color: #1E1E1E;
            color: white;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $cek_id; ?>" method="POST">
        <h3>Çeki Güncelle</h3>
        <?php if (isset($error) && !empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <label for="update_cek_numarasi">Çek Numarası</label>
        <input type="text" name="update_cek_numarasi" placeholder="Çek Numarası"
            value="<?php echo $cek_data['cek_numarasi']; ?>" required>
        <label for="update_banka_bilgisi">Banka Bilgisi</label>
        <input type="text" name="update_banka_bilgisi" placeholder="Banka Bilgisi"
            value="<?php echo $cek_data['banka_bilgisi']; ?>" required>
        <label for="update_cek_tarihi">Çek Tarihi</label>
        <input type="date" name="update_cek_tarihi" placeholder="Çek Tarihi"
            value="<?php echo $cek_data['cek_tarihi']; ?>" required>
           

        <label for="update_alici_bilgisi">Alıcı Bilgisi</label>
        <input type="text" name="update_alici_bilgisi" placeholder="Alıcı Bilgisi"
            value="<?php echo $cek_data['alici_bilgisi']; ?>" required>
        <label for="update_odeme_miktari">Ödeme Miktari</label>
        <input type="text" name="update_odeme_miktari" placeholder="Ödeme Miktarı"
            value="<?php echo $cek_data['odeme_miktari']; ?>" required>

            <label for="update_referans_numarasi">Referans Numarası</label>
        <input type="text" name="update_referans_numarasi" placeholder="Referans Numarası"
            value="<?php echo $cek_data['referans_numarasi']; ?>" required>

            <label for="update_para_birimi">Para Birimi</label>
            <select name="update_para_birimi" required>
                <option value="Euro" <?php echo ($cek_data['para_birimi'] === 'Euro') ? 'selected' : ''; ?>>Euro</option>
                <option value="Dolar" <?php echo ($cek_data['para_birimi'] === 'Dolar') ? 'selected' : ''; ?>>Dolar</option>
                <option value="Türk Lirası" <?php echo ($cek_data['para_birimi'] === 'Türk Lirası') ? 'selected' : ''; ?>>Türk Lirası</option>
            </select>

            <label for="update_cek_durumu">Çek Durumu</label>
            <select name="update_cek_durumu" required>
                <option value="Bekliyor" style="background-color: yellow; color: black;"
                    <?php echo ($cek_data['cek_durumu'] === 'Bekliyor') ? 'selected' : ''; ?>>Bekliyor</option>
                <option value="Başarılı" style="background-color: green; color: white;"
                    <?php echo ($cek_data['cek_durumu'] === 'Başarılı') ? 'selected' : ''; ?>>Başarılı</option>
                <option value="Karşılıksız" style="background-color: red; color: white;"
                    <?php echo ($cek_data['cek_durumu'] === 'Karşılıksız') ? 'selected' : ''; ?>>Karşılıksız</option>
            </select>


            
       
        <button>Güncelle</button>
    </form>
</body>

</html>
