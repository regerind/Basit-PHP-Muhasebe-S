<!DOCTYPE html>
<html lang="en">

<?php
include 'admin.php';
include 'database.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Listesi</title>
    <link rel="stylesheet" type="text/css" href="css/kullaniciliste.css">
    <style>
        h1 {
            text-align: left;
            font-size: 36px;
            margin-bottom: 20px;
            color: #FFFFF; 
        }
    </style>
</head>

<body>
<?php
    // Çek silme işlemi
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $cekId = $_GET['id'];
        $deleteQuery = "DELETE FROM cekler WHERE id = $cekId";

        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("Cek with ID ' . $cekId . ' başarıyla silindi.");</script>';
        } else {
            echo '<script>alert("hata: ' . mysqli_error($conn) . '");</script>';
        }
    }

    // Databseden veri çekme
    $result = mysqli_query($conn, "SELECT id, cek_numarasi, banka_bilgisi, cek_tarihi, cek_durumu, alici_bilgisi, odeme_miktari, para_birimi, referans_numarasi FROM cekler");

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    echo '<h1>Cek Listesi</h1>'; 

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>
                <th>ID</th>
                <th>Cek Numarası</th>
                <th>Banka Bilgisi</th>
                <th>Cek Tarihi</th>
                <th>Cek Durumu</th>
                <th>Alici Bilgisi</th>
                <th>Odeme Miktarı</th>
                <th>Para Birimi</th>
                <th>Referans Numarası</th>
                <th>Sil</th> 
                <th>Düzenle</th> 
            </tr>';

        // veriyi her satıra yazdırma
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['cek_durumu'] === 'Bekliyor') {
                $textColor = 'yellow';
            } elseif ($row['cek_durumu'] === 'Başarılı') {
                $textColor = 'green';
            } else {
                $textColor = ''; 
            }
            $backgroundColor = '';
            switch ($row['cek_durumu']) {
                case 'Karşılıksız':
                    $backgroundColor = 'red';
                    break;
                default:
                    $backgroundColor = '';
            }

            echo '<tr style="background-color: ' . $backgroundColor . ';">';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['cek_numarasi'] . '</td>';
            echo '<td>' . $row['banka_bilgisi'] . '</td>';
            echo '<td>' . $row['cek_tarihi'] . '</td>';
            echo '<td style="color: ' . $textColor . ';">' . $row['cek_durumu'] . '</td>';

            echo '<td>' . $row['alici_bilgisi'] . '</td>';
            echo '<td>' . $row['odeme_miktari'] . '</td>';
            echo '<td>' . $row['para_birimi'] . '</td>';
            echo '<td>' . $row['referans_numarasi'] . '</td>';
            echo '<td><a href="?action=delete&id=' . $row['id'] . '" onclick="return confirm(\'ceki silmek istediğinizden emin misiniz?\')">Sil</a></td>'; // silme linki
            echo '<td><a class="edit" href="cekduzenle.php?id=' . $row['id'] . '">Duzenle</a></td>'; 
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'veri bulunamadı.';
    }

    // Database bağlantısını kapat.
    mysqli_close($conn);
    ?>
</body>

</html>
