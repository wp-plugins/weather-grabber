<?php
function outputCurrentDisplayFull ($widgetArray,$weatherArray) {
$output = '';

$output = $output . '<table id="fulltable" class="frontwdgttable" ><tr>
    <td colspan="4" class="tg-center"> Last Updated: '. $weatherArray['stationDate'] . ' ' . $weatherArray['stationTime']/* . ' <a href="https://www.google.ca/maps/@' . $weatherArray['stationLatitude'] . ',' . $weatherArray['stationLongitude']. ',12z">map</a></td></tr>'*/;
    
$output = $output . '<tr><td colspan="2" class="tg-center">Temperature<br /><span title="Temperature" style="' . $weatherArray['outsideTempCSS'] . 'font-size: 30pt;">' . $weatherArray['outsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['TempTrend5min'] . '</span><br />Hour Change: ' . $weatherArray['hourchangetemp'] . '  ' . $weatherArray['tempUnit'].'</td>';

$output = $output . '<td colspan="2" class="tg-center">Wind<br /><span title="Wind" style="' . $weatherArray['windSpeedCSS'] . 'font-size:30pt;">' . $weatherArray['windDirection'] . ' ' .  $weatherArray['windSpeed'] . ' ' . $weatherArray['windUnit'] . '</span><br />direction ' . $weatherArray['windDirectionDegrees'] . '&deg; gusting to ' . '<span title="Wind Gust" style="' . $weatherArray['windGustSpeedCSS'] . '">' . $weatherArray['windGustSpeed'] . ' ' . $weatherArray['windUnit'] . ' from '. $weatherArray['windGustDirectionDegrees'] .'&deg;</span></td></tr>';


$output = $output . '<tr class="tg-even"><td colspan="2" class="tg-center">';

/*$output = $output . '<tr><td colspan="4" class="tg-center">Wind</td></tr>';*/
if (($weatherArray['windChill'] == 'N/A') || ($weatherArray['outsideTemp'] == $weatherArray['outsideHeatIndex']))
{
$output = $output . '<span title="Feels Like">No WindChill<br /> or Heat Index </span>';
}
elseif ($weatherArray['windChill'] != 'N/A')
{
$output = $output . '<span title="Feels Like" style="' . $weatherArray['windChillCSS'] . '">' . $weatherArray['windChill'] . $weatherArray['tempUnit'] . '</span>';
}
else
{
$output = $output . '<span title="Feels Like" style="' . $weatherArray['heatIndexCSS'] . '">' . $weatherArray['outsideHeatIndex'] . $weatherArray['tempUnit'] . '</span>';
}

$output = $output . '</td>';

$output = $output . '<td colspan="2" class="tg-center"><span title="Barometer" style="' . $weatherArray['barometerCSS'] . '">Barometer<br />' . $weatherArray['barometer'] . ' ' . $weatherArray['barUnit'] . $weatherArray['baromtrend'] . '</span></td>
  </tr>';
$output = $output . '<tr><td colspan="1" class="tg-center">';
$output = $output . 'Humidity<br /><span title="Humidity">' . $weatherArray['outsideHumidity'] . ' ' . $weatherArray['humUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Air Density<br /><span title="Air Density (for fog)">' . $weatherArray['airDensity'] . ' ' . $weatherArray['airDensityUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Cloud Base<br /><span title="Cumulus Base">' . $weatherArray['cumulusBase'] . ' ' . $weatherArray['cumulusBaseUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Dewpoint<br /><span title="Dewpoint" style="' . $weatherArray['outsideDewPtCSS'] . '"> ' . $weatherArray['outsideDewPt'] . $weatherArray['tempUnit'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="1" class="tg-center"><span title="UV Index" style="' . $weatherArray['UVCSS'] . '">UV Index<br />' . $weatherArray['UV'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Wind Power Density" style="' . $weatherArray['windPowerDensityCSS'] . '">Wind Power<br />' . $weatherArray['windPowerDensity'] . ' ' . $weatherArray['windPowerUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Solar Power" style="' . $weatherArray['solarPotentialCSS'] . '">Solar Potential<br />' . $weatherArray['solarPotential'] . ' ' . $weatherArray['solarUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Solar Radiation" style="' . $weatherArray['solarRadCSS'] . '">Solar Radiation<br />' . $weatherArray['solarRad'] . ' ' . $weatherArray['solarUnit'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="1" class="tg-center">';
$output = $output . 'Rain Rate<br /><span title="Rain" style="' . $weatherArray['rainRateCSS'] . '"> ' . $weatherArray['rainRate'] . ' ' . $weatherArray['rateUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Day\'s Rain" style="' . $weatherArray['dailyRainCSS'] . '">Day\'s Rain<br />' . $weatherArray['dailyRain'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Evapotranspiration" style="' . $weatherArray['ETCSS'] . '">Evapo-Transpiration<br />' . $weatherArray['ET'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Freezing Level">Freezing Level<br />' . $weatherArray['freezingLevel'] . ' ' . $weatherArray['cumulusBaseUnit'] . '</span></td></tr>';


$output = $output . '</table>';

	return $output;
	}

function outputAlmDisplayFull ($widgetArray,$weatherArray) {


$output = '';

$output = $output . '<table id="fulltable" class="frontwdgttable" ><tr>
    <td colspan="4" class="tg-center"> Last Updated: '. $weatherArray['stationDate'] . ' ' . $weatherArray['stationTime']/* . ' <a href="https://www.google.ca/maps/@' . $weatherArray['stationLatitude'] . ',' . $weatherArray['stationLongitude']. ',12z">map</a></td></tr>'*/;
    
$output = $output . '<tr><td colspan="2" class="tg-center">Temperature<br /><span title="Temperature" style="' . $weatherArray['outsideTempCSS'] . 'font-size: 30pt;">' . $weatherArray['outsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['TempTrend5min'] . '</span><br />Hour Change: ' . $weatherArray['hourchangetemp'] . '  ' . $weatherArray['tempUnit'].'</td>';

$output = $output . '<td colspan="2" class="tg-center">Wind<br /><span title="Wind" style="' . $weatherArray['windSpeedCSS'] . 'font-size:30pt;">' . $weatherArray['windDirection'] . ' ' .  $weatherArray['windSpeed'] . ' ' . $weatherArray['windUnit'] . '</span><br />direction ' . $weatherArray['windDirectionDegrees'] . '&deg; gusting to ' . '<span title="Wind Gust" style="' . $weatherArray['windGustSpeedCSS'] . '">' . $weatherArray['windGustSpeed'] . ' ' . $weatherArray['windUnit'] . ' from '. $weatherArray['windGustDirectionDegrees'] .'&deg;</span></td></tr>';


/*$count = 0;
foreach ( $weatherArray as $key => $value ) {
    $output = $output . "<td> " . $key . " <br />" . $value . "</td>";
    $count++;
    if ($count > 3) {
    $count = 0;
    $output = $output . "</tr> ";
    $output = $output . "<tr> ";
    }
}*/

$output = $output . '<tr class="tg-even"><td colspan="2" class="tg-center">';

/*$output = $output . '<tr><td colspan="4" class="tg-center">Wind</td></tr>';*/
if (($weatherArray['windChill'] == 'N/A') || ($weatherArray['outsideTemp'] == $weatherArray['outsideHeatIndex']))
{
$output = $output . '<span title="Feels Like">No WindChill<br /> or Heat Index </span>';
}
elseif ($weatherArray['windChill'] != 'N/A')
{
$output = $output . '<span title="Feels Like" style="' . $weatherArray['windChillCSS'] . '">' . $weatherArray['windChill'] . $weatherArray['tempUnit'] . '</span>';
}
else
{
$output = $output . '<span title="Feels Like" style="' . $weatherArray['heatIndexCSS'] . '">' . $weatherArray['outsideHeatIndex'] . $weatherArray['tempUnit'] . '</span>';
}

$output = $output . '</td>';

$output = $output . '<td colspan="2" class="tg-center"><span title="Barometer" style="' . $weatherArray['barometerCSS'] . '">Barometer<br />' . $weatherArray['barometer'] . ' ' . $weatherArray['barUnit'] . $weatherArray['baromtrend'] . '</span></td>
  </tr>';
$output = $output . '<tr><td colspan="1" class="tg-center">';
$output = $output . 'Humidity<br /><span title="Humidity">' . $weatherArray['outsideHumidity'] . ' ' . $weatherArray['humUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Air Density<br /><span title="Air Density (for fog)">' . $weatherArray['airDensity'] . ' ' . $weatherArray['airDensityUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Cloud Base<br /><span title="Cumulus Base">' . $weatherArray['cumulusBase'] . ' ' . $weatherArray['cumulusBaseUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Dewpoint<br /><span title="Dewpoint" style="' . $weatherArray['outsideDewPtCSS'] . '"> ' . $weatherArray['outsideDewPt'] . $weatherArray['tempUnit'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="1" class="tg-center"><span title="UV Index" style="' . $weatherArray['UVCSS'] . '">UV Index<br />' . $weatherArray['UV'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Wind Power Density" style="' . $weatherArray['windPowerDensityCSS'] . '">Wind Power<br />' . $weatherArray['windPowerDensity'] . ' ' . $weatherArray['windPowerUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Solar Power" style="' . $weatherArray['solarPotentialCSS'] . '">Solar Potential<br />' . $weatherArray['solarPotential'] . ' ' . $weatherArray['solarUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Solar Radiation" style="' . $weatherArray['solarRadCSS'] . '">Solar Radiation<br />' . $weatherArray['solarRad'] . ' ' . $weatherArray['solarUnit'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="1" class="tg-center">';
$output = $output . 'Rain Rate<br /><span title="Rain" style="' . $weatherArray['rainRateCSS'] . '"> ' . $weatherArray['rainRate'] . ' ' . $weatherArray['rateUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Day\'s Rain" style="' . $weatherArray['dailyRainCSS'] . '">Day\'s Rain<br />' . $weatherArray['dailyRain'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Evapotranspiration" style="' . $weatherArray['ETCSS'] . '">Evapo-Transpiration<br />' . $weatherArray['ET'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Freezing Level">Freezing Level<br />' . $weatherArray['freezingLevel'] . ' ' . $weatherArray['cumulusBaseUnit'] . '</span></td></tr>';


$output = $output . '</table>';

	return $output;
}


function short_wx_func ($atts, $widgetArray, $weatherArray) {


      $atts = shortcode_atts( array(
 	      'wx' => '0'
      ), $atts );

if ($atts['wx'] == '0') {
      $error = "You forgot to tell us which value you wanted.  Shortcodes should look like: '[wxgrabber wx='outsideTemp'].  Consult phpparameter list file to see all available values";

return $error; 

}
elseif ($atts['wx'] === 'currentConditions') {
$output = "OK Current Conditions Coming";
$output = outputCurrentDisplayFull($widgetArray,$weatherArray);
return $output; 
}
elseif ($atts['wx'] === 'dailyAlmanac') {
$output = "OK Daily Almanac Coming";
$output = outputAlmDisplayFull($widgetArray,$weatherArray);
return $output; 
}
elseif (!isset($weatherArray[$atts['wx']])) {
$error = "Sorry, that value doesn't exist.  Consult phpparameter list file to see all available parameters";

return $error; 
}
else {
return $weatherArray[$atts['wx']];
}

}

	class wxgrabber_short extends WP_Widget{
	
public function wxgrabber_short() {
parent::WP_Widget(false, $name = 'WXGB - ShortCodes');
// Load jQuery
wp_enqueue_script('jquery');
}



/* This controls what the widget actually does.  Gets stuff for it and displays it on the website.

/** @see WP_Widget::widget */

public function widget($atts, $args, $instance) {


	// these are our widget options
	$title = '';
$widgetArray['weatherperiod'] = 0;	
$weatherArray = weathersetup($widgetArray['weatherperiod']);
$output = short_wx_func($atts, $widgetArray,$weatherArray);
return $output;
}

} //END OF THE MAIN  WIDGET CLASS
?>