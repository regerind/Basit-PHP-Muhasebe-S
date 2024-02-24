<!DOCTYPE html>
<html lang="en">

<?php
include 'admin.php';
include 'database.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kullanici Listesi</title>
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
        $userId = $_GET['id'];
        $deleteQuery = "DELETE FROM users WHERE id = $userId";

        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("User with ID ' . $userId . ' deleted successfully.");</script>';
        } else {
            echo '<script>alert("Error deleting user: ' . mysqli_error($conn) . '");</script>';
        }
    }

    
    $result = mysqli_query($conn, "SELECT * FROM users");

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    echo '<h1>Kullanıcı Listesi</h1>'; 


    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>
	        	<th>ID</th>
	        	<th>Username</th>
	        	<th>Email</th>
	        	<th>Password</th>
	        	<th>Verified</th>
	        	<th>Sil</th> <!-- New column for the Delete button -->
	        	<th>Düzenle</th> <!-- New column for the Edit button -->
        	</tr>';

       
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['password'] . '</td>';
            echo '<td>' . $row['verified'] . '</td>';
            echo '<td><a href="?action=delete&id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\')">Sil</a></td>'; // Delete link
            echo '<td><a class="edit" href="kullaniciduzenle.php?id=' . $row['id'] . '">Duzenle</a></td>'; // Edit link
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
