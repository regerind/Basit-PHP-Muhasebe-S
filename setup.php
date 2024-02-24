<?php
include "config.php";


 $databaseHost = $sname;
 $databaseUser = $unmae;
 $databasePassword = $password; 

 $connSetup = mysqli_connect($databaseHost, $databaseUser, $databasePassword);

 if (!$connSetup) {
     echo '<div class="error">Error connecting to MySQL: ' . mysqli_connect_error() . '</div>';
     exit();
 }

 $dbNameSetup = "uyelik_sistemi";

 $checkDbQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbNameSetup'";
 $checkDbResult = mysqli_query($connSetup, $checkDbQuery);

 if (!$checkDbResult) {
     echo '<div class="error">Error checking database existence: ' . mysqli_error($connSetup) . '</div>';
     exit();
 }

 if (mysqli_num_rows($checkDbResult) > 0) {
     mysqli_close($connSetup);
     header("Location: login.php");
     exit();
 }


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["setup"])) {
   
    $createDbQuery = "CREATE DATABASE $dbNameSetup";
    $createDbResult = mysqli_query($connSetup, $createDbQuery);

    if (!$createDbResult) {
        echo '<div class="error">Error creating database: ' . mysqli_error($connSetup) . '</div>';
        exit();
    }

    $sqlFilePath = "uyelik_sistemi.sql"; 

    $sqlFileContent = file_get_contents($sqlFilePath);

    $connSetup = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $dbNameSetup);

    if (!$connSetup) {
        echo '<div class="error">Error connecting to the new database: ' . mysqli_connect_error() . '</div>';
        exit();
    }

    mysqli_set_charset($connSetup, 'utf8mb4'); 

    if (mysqli_multi_query($connSetup, $sqlFileContent)) {
        do {
            if ($result = mysqli_store_result($connSetup)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($connSetup));

        echo '<script>alert("Kurulum başarılı, Hoşgeldin!");</script>';

        mysqli_close($connSetup);

        echo '<script>window.location.href = "login.php";</script>';
        exit();
    } else {
        echo '<div class="error">Error setting up the database: ' . mysqli_error($connSetup) . '</div>';
    }

    mysqli_close($connSetup);
}
?>


<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çek Finans Yönetim Uygulamasına Hoşgeldin</title>
    <link rel="stylesheet" type="text/css" href="./css/setup.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/login.css">

</head>

<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h3>Çek Finans Yönetim Uygulamasına Hoşgeldin</h3>
        <?php if (isset($output) && !empty($output)) {
            echo $output;
        } ?>
        <button type="submit" name="setup">Kurulumu Tamamla</button>
    </form>
</body>

</html>
