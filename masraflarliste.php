<!DOCTYPE html>
<html lang="en">

<?php
include 'admin.php';
include 'database.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masraflar Listesi</title>
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
        $masrafId = $_GET['id'];
        $deleteQuery = "DELETE FROM masraflar WHERE masraf_id = $masrafId";

        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("Masraf with ID ' . $masrafId . ' deleted successfully.");</script>';
        } else {
            echo '<script>alert("Error deleting masraf: ' . mysqli_error($conn) . '");</script>';
        }
    }

    $result = mysqli_query($conn, "SELECT masraf_id, masraf_baslik, masraf_aciklama, masraf_tutar, masraf_zaman, masraf_kategori FROM masraflar");

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    echo '<h1>Masraflar Listesi</h1>'; 

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>
                <th>ID</th>
                <th>Başlık</th>
                <th>Açıklama</th>
                <th>Tutar</th>
                <th>Zaman</th>
                <th>Kategori</th>
                <th>Sil</th> <!-- New column for the Delete button -->
                <th>Düzenle</th> <!-- New column for the Edit button -->
            </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['masraf_id'] . '</td>';
            echo '<td>' . $row['masraf_baslik'] . '</td>';
            echo '<td>' . $row['masraf_aciklama'] . '</td>';
            echo '<td>' . $row['masraf_tutar'] . '</td>';
            echo '<td>' . $row['masraf_zaman'] . '</td>';
            echo '<td>' . $row['masraf_kategori'] . '</td>';
            echo '<td><a href="?action=delete&id=' . $row['masraf_id'] . '" onclick="return confirm(\'Are you sure you want to delete this masraf?\')">Sil</a></td>'; // Delete link
            echo '<td><a class="edit" href="masrafduzenle.php?id=' . $row['masraf_id'] . '">Duzenle</a></td>'; 
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
