function outputCurrentDisplayFull ($widgetArray,$weatherArray) {
$output = '';

$output = $output . '<table id="fulltable" class="frontwdgttable" ><tr>
    <td colspan="4" class="tg-center"> Last Updated: ' . $weatherArray['stationTime'] . '</td></tr>';
    
$output = $output . '<tr><td colspan="2" class="tg-center">Temperature<br /><span title="Temperature" style="' . $weatherArray['outsideTempCSS'] . 'font-size: 30pt;">' . $weatherArray['outsideTemp'] . $weatherArray['tempUnit'] . '</span><br />Hour Change: ' . $weatherArray['hourchangetemp'] . '  ' . $weatherArray['tempUnit'] .  '</td>';

$output = $output . '<td colspan="2" class="tg-center">Wind<br /><span title="Wind" style="' . $weatherArray['windSpeedCSS'] . 'font-size:30pt;">' . $weatherArray['windDirection'] . ' ' .  $weatherArray['windSpeed'] . ' ' . $weatherArray['windUnit'] . '</span><br />gusting to ' . '<span title="Wind Gust" style="' . $weatherArray['windGustSpeedCSS'] . '">' . $weatherArray['windGustSpeed'] . ' ' . $weatherArray['windUnit'] . '</span></td></tr>';


$output = $output . '<tr class="tg-even"><td colspan="2" class="tg-center">';

/*$output = $output . '<tr><td colspan="4" class="tg-center">Wind</td></tr>';*/
if (($weatherArray['windChill'] == 'N/A') || ($weatherArray['outsideTemp'] == $weatherArray['outsideHeatIndex']))
{
$output = $output . '<span title="Feels Like"><br />No WindChill or Heat Index </span>';
}
elseif ($weatherArray['windChill'] != 'N/A')
{
$output = $output . '<span title="Feels Like" style="' . $weatherArray['chillCSS'] . '">' . $weatherArray['windChill'] . $weatherArray['tempUnit'] . '</span>';
}
else
{
$output = $output . '<span title="Feels Like" style="' . $weatherArray['heatIndexCSS'] . '">' . $weatherArray['outsideHeatIndex'] . $weatherArray['tempUnit'] . '</span>';
}

$output = $output . '</td>';

$output = $output . '<td colspan="2" class="tg-center"><span title="Barometer" style="' . $weatherArray['barometerCSS'] . '">Barometer<br />' . $weatherArray['barometer'] . ' ' . $weatherArray['barUnit'] . $weatherArray['baromtrend'] . '</span></td>
  </tr>';
$output = $output . '<tr><td colspan="2" class="tg-center">';
$output = $output . 'Humidity<br /><span title="Humidity">' . $weatherArray['outsideHumidity'] . ' ' . $weatherArray['humUnit'] . '</span></td>';

$output = $output . '<td colspan="2" class="tg-center"><span title="UV Index" style="' . $weatherArray['UVCSS'] . '">UV Index<br />UV ' . $weatherArray['UV'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="2" class="tg-center">';
$output = $output . 'Dewpoint<br /><span title="Dewpoint" style="' . $weatherArray['outsideDewPtCSS'] . '"> ' . $weatherArray['outsideDewPt'] . $weatherArray['tempUnit'] . '</span></td>';

$output = $output . '<td colspan="2" class="tg-center"><span title="Solar Radiation" style="' . $weatherArray['solarRadCSS'] . '">Solar Radiation<br />' . $weatherArray['solarRad'] . ' ' . $weatherArray['solarUnit'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="2" class="tg-center">';
$output = $output . 'Rain Rate<br /><span title="Rain" style="' . $weatherArray['rainRateCSS'] . '"> ' . $weatherArray['rainRate'] . ' ' . $weatherArray['rateUnit'] . '</span></td>';
$output = $output . '<td colspan="2" class="tg-center"><span title="Total Rain" style="' . $weatherArray['dailyRainCSS'] . '">Total Rain<br />' . $weatherArray['dailyRain'] . ' ' . $weatherArray['rainUnit'] . '</span></tr>';


$output = $output . '</table>';

	return $output;
	}