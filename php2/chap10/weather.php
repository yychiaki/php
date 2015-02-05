<?php
$zip = 98052;

$weather_page = file_get_contents('http://www.srh.noaa.gov/zipcity.php?inputstring=' .$zip);
$weather_page = strstr($weather_page,
	'<div class="div-full" id="point_forecast_icons">');
$end_page = strpos($weather_page,
'<div class="two-third-first point-forecast-7-day">');

$weather_page = substr($weather_page, 0, $end_page);
print $weather_page;

