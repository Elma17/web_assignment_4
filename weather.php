<?php
include 'connection.php';

$apiKey = 'c947f7e32fdb1f61a1a672b088503b30';
$lat = '23.7104';
$lon = '90.4074';
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey";

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

if ($data) {
    echo '<div class="weather">';
    $city = $data['name'];
    $date = date('Y-m-d', $data['dt']);
    $time = date('H:i:s', $data['dt']);
    $temperatureKelvin = $data['main']['temp'];
    $temperatureCelsius = $temperatureKelvin - 273.15;
    $description = $data['weather'][0]['description'];

    // Insert data into database
    $sql = "INSERT INTO weather_data (city,date, time, temperature, description) 
            VALUES ('$city','$date', '$time', '$temperature', '$description')";
    if (mysqli_query($connection, $sql)) {
        echo "Weather data inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    echo "
        <div class='weather-item'>
            <p>Date: $date</p>
            <p>Time: $time</p>
            <p>Temperature: $temperature °C</p>
            <p>Description: $description</p>
        </div>
    ";
    
    echo '</div>';
} else {
    echo '<p>Unable to retrieve weather data.</p>';
}

mysqli_close($connection);
?>
