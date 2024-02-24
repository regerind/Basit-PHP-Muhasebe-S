<?php
include 'admin.php';
include 'database.php';

$totalDollarQuery = "SELECT SUM(odeme_miktari) AS total_dollar FROM cekler WHERE para_birimi = 'dolar'";
$totalEuroQuery = "SELECT SUM(odeme_miktari) AS total_euro FROM cekler WHERE para_birimi = 'euro'";
$totalLiraQuery = "SELECT SUM(odeme_miktari) AS total_lira FROM cekler WHERE para_birimi = 'türk lirası'";

$totalDollarResult = mysqli_query($conn, $totalDollarQuery);
$totalEuroResult = mysqli_query($conn, $totalEuroQuery);
$totalLiraResult = mysqli_query($conn, $totalLiraQuery);

$totalDollar = mysqli_fetch_assoc($totalDollarResult)['total_dollar'];
$totalEuro = mysqli_fetch_assoc($totalEuroResult)['total_euro'];
$totalLira = mysqli_fetch_assoc($totalLiraResult)['total_lira'];


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Genel Görünüm</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
   
</head>


<body>

    <div class="dashboard-container">
        <div class="container">
            <h1>Genel Görünüm</h1>
            <div class="currency-box">
                <div class="currency">
                    <h3>Dolar Toplamı: <?php echo $totalDollar; ?></h3>
                </div>
                <div class="currency">
                    <h3>Euro Toplamı: <?php echo $totalEuro; ?></h3>
                </div>
                <div class="currency">
                    <h3>Türk Lirası Toplamı: <?php echo $totalLira; ?></h3>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
