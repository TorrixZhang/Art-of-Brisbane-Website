<?php

$weather_url = "https://api.openweathermap.org/data/2.5/forecast?q=brisbane&units=metric&appid=efb2e16906c4285feb65f6a6e6a23837";

$data = file_get_contents($weather_url);
$data = json_decode($data, true);

$weatherNow = array_values($data)[3][0];
$tempNow = array_values($weatherNow)[1];


$description = array_values($weatherNow)[2][0];


?>