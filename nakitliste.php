<!DOCTYPE html>
<html lang="en">

<?php
include 'admin.php';
include 'database.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nakit Listesi</title>
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
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $nakitId = $_GET['id'];
        $deleteQuery = "DELETE FROM nakit WHERE nakit_id = $nakitId";

        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("Nakit with ID ' . $nakitId . ' deleted successfully.");</script>';
        } else {
            echo '<script>alert("Error deleting nakit: ' . mysqli_error($conn) . '");</script>';
        }
    }

    $result = mysqli_query($conn, "SELECT nakit_id, nakit_baslik, nakit_aciklama, nakit_gelen_tutar, nakit_cikan_tutar, nakit_zaman FROM nakit");

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    echo '<h1>Nakit Listesi</h1>'; 

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>
                <th>ID</th>
                <th>Başlık</th>
                <th>Açıklama</th>
                <th>Gelen Tutar</th>
                <th>Çıkan Tutar</th>
                <th>Zaman</th>
                <th>Sil</th> <!-- New column for the Delete button -->
                <th>Düzenle</th> <!-- New column for the Edit button -->
            </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['nakit_id'] . '</td>';
            echo '<td>' . $row['nakit_baslik'] . '</td>';
            echo '<td>' . $row['nakit_aciklama'] . '</td>';
            echo '<td>' . $row['nakit_gelen_tutar'] . '</td>';
            echo '<td>' . $row['nakit_cikan_tutar'] . '</td>';
            echo '<td>' . $row['nakit_zaman'] . '</td>';
            echo '<td><a href="?action=delete&id=' . $row['nakit_id'] . '" onclick="return confirm(\'Are you sure you want to delete this nakit?\')">Sil</a></td>'; // Delete link
            echo '<td><a class="edit" href="nakitduzenle.php?id=' . $row['nakit_id'] . '">Duzenle</a></td>'; 
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No data found.';
    }

    mysqli_close($conn);
    ?>

</body>

</html>
