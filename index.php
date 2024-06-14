<?php
// Inklusi file WeatherApp
include 'WeatherApp.php';

// URL dari file JSON
$apiUrl = "https://mgm.ub.ac.id/weather.json";

// Inisialisasi objek WeatherApp dengan URL API
$weatherApp = new WeatherApp($apiUrl);

// Ambil data cuaca
$dataCuaca = $weatherApp->getCuaca();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cuaca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .info {
            margin-bottom: 20px;
        }

        .info strong {
            display: block;
            margin-bottom: 5px;
        }

        .weather-icon {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Informasi Cuaca</h1>
        <?php if ($dataCuaca) : ?>
            <div class="info">
                <strong>Koordinat:</strong>
                Longitude = <?= $dataCuaca['coord']['lon'] ?>, Latitude = <?= $dataCuaca['coord']['lat'] ?>
            </div>
            <div class="info">
                <strong>Cuaca:</strong>
                <?= $dataCuaca['weather']['main'] ?> (<?= $dataCuaca['weather']['description'] ?>)
                <img src="<?= $dataCuaca['weather']['icon'] ?>" alt="Weather Icon" class="weather-icon">
            </div>
            <div class="info">
                <strong>Temperatur:</strong>
                <?= $dataCuaca['temp'] ?>°C, Feels like: <?= $dataCuaca['feels_like'] ?>°C
            </div>
            <div class="info">
                <strong>Sunrise:</strong>
                <?= $dataCuaca['sys']['sunrise'] ?>
            </div>
            <div class="info">
                <strong>Sunset:</strong>
                <?= $dataCuaca['sys']['sunset'] ?>
            </div>
        <?php else : ?>
            <p>Error: Tidak bisa mengambil data cuaca.</p>
        <?php endif; ?>
    </div>
</body>

</html>