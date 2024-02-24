<?php
session_start();

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

include "database.php";


if (isset($_POST["cek_numarasi"]) && isset($_POST["banka_bilgisi"]) && isset($_POST["cek_tarihi"]) && isset($_POST["cek_durumu"]) && isset($_POST["alici_bilgisi"]) && isset($_POST["odeme_miktari"]) && isset($_POST["para_birimi"]) && isset($_POST["referans_numarasi"])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $cek_numarasi = validate($_POST["cek_numarasi"]);
    $banka_bilgisi = validate($_POST["banka_bilgisi"]);
    $cek_tarihi = validate($_POST["cek_tarihi"]);
    $cek_durumu = validate($_POST["cek_durumu"]);
    $alici_bilgisi = validate($_POST["alici_bilgisi"]);
    $odeme_miktari = validate($_POST["odeme_miktari"]);
    $para_birimi = validate($_POST["para_birimi"]);
    $referans_numarasi = validate($_POST["referans_numarasi"]);

    if (empty($cek_numarasi) || empty($banka_bilgisi) || empty($cek_tarihi) || empty($cek_durumu) || empty($alici_bilgisi) || empty($odeme_miktari) || empty($para_birimi) || empty($referans_numarasi)) {
        header("Location: cekliste.php?error=bosalanlar");
        exit();
    } else {
        $insert_query = "INSERT INTO cekler(cek_numarasi, banka_bilgisi, cek_tarihi, cek_durumu, alici_bilgisi, odeme_miktari, para_birimi, referans_numarasi) 
                        VALUES ('$cek_numarasi', '$banka_bilgisi', '$cek_tarihi', '$cek_durumu', '$alici_bilgisi', '$odeme_miktari', '$para_birimi', '$referans_numarasi')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            header("Location: cekliste.php?success=cek_eklendi");
            exit();
        } else {
            header("Location: cekliste.php?error=cek_not_eklenmedi");
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
    <title>Yeni Çek Ekle</title>
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

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.07);
            cursor: pointer;
        }

        
        select#cek_durumu {
            background-color: rgba(255, 255, 255, 0.07);
            color: white;
        }

        select#cek_durumu option[value="bekliyor"] {
            background-color: yellow;
            color: black;
        }

        select#cek_durumu option[value="başarılı"] {
            background-color: green;
            color: white;
        }

        select#cek_durumu option[value="karşılıksız"] {
            background-color: red;
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h3>Yeni Çek Ekle</h3>
        <?php if (isset($_GET["success"]) && !empty($_GET["success"])) { ?>
        <div class="success"><?php echo $_GET["success"]; ?></div>
        <?php } ?>
        <?php if (isset($_GET["error"]) && !empty($_GET["error"])) { ?>
        <div class="error"><?php echo $_GET["error"]; ?></div>
        <?php } ?>
        <label for="cek_numarasi">Çek Numarası</label>
        <input type="text" name="cek_numarasi" placeholder="Çek Numarası" required>
        <label for="banka_bilgisi">Banka Bilgisi</label>
        <input type="text" name="banka_bilgisi" placeholder="Banka Bilgisi" required>
        <label for="cek_tarihi">Çek Tarihi</label>
        <input type="date" name="cek_tarihi" required>

        <label for="referans_numarasi">Referans Numarası</label>
        <input type="text" name="referans_numarasi" placeholder="Referans Numarası" required>
        
        
        <label for="alici_bilgisi">Alıcı Bilgisi</label>
        <input type="text" name="alici_bilgisi" placeholder="Alıcı Bilgisi" required>
        <label for="odeme_miktari">Ödeme miktari</label>
        <input type="text" name="odeme_miktari" placeholder="Ödeme miktari" required>
        <label for="para_birimi">Para Birimi</label>
        <select name="para_birimi" required>
            <option value="Euro">Euro</option>
            <option value="Dolar">Dolar</option>
            <option value="Türk Lirası">Türk Lirası</option>
        </select>
        <label for="cek_durumu">Çek Durumu</label>
        <select id="cek_durumu" name="cek_durumu" required>
            <option value="Bekliyor">Bekliyor</option>
            <option value="Başarılı">Başarılı</option>
            <option value="Karşılıksız">Karşılıksız</option>
        </select>

        <button>Çek Ekle</button>

        
    </form>
</body>

</html>
