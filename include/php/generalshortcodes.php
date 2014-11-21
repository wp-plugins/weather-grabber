<?php
function outputCurrentDisplayFull ($widgetArray,$weatherArray) {
$output = '';

$output = $output . '<table id="fulltable" class="frontwdgttable" ><tr>';
    
$output = $output . '<th colspan="4" class="tg-center"> Current Conditions</th>';

$output = $output . '</tr>';
$output = $output . '<tr>';

$output = $output . '<td colspan="4" class="tg-center"> Last Updated: '. $weatherArray['stationDate'] . ' ' . $weatherArray['stationTime'];
$output = $output . '</td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="2" class="tg-center">';
$output = $output . 'Lat/Long: ' . $weatherArray['stationLatitude'] . ' ' .  $weatherArray['stationLongitude'] . '</td>';
$output = $output . '<td colspan="2" class="tg-center">';
$output = $output . 'Station Elevation: ' . $weatherArray['stationElevation'] . '</td>';

$output = $output . '<tr><td colspan="2" class="tg-center" style="' . $weatherArray['outsideTempCSS'] . '">Temperature<br /><span title="Temperature" style="'. 'font-size: 30pt;">' . $weatherArray['outsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['TempTrend5min'] . '</span><br />Hour Change: ' . $weatherArray['hourchangetemp'] . '  ' . $weatherArray['tempUnit'].' <br/> 5min Ave WindChill: ' . $weatherArray['intervalAvgWindChill'] . $weatherArray['tempUnit'].
'</td>';

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['windSpeedCSS'] .'">Wind<br /><span title="Wind" style="' . 'font-size:30pt;">' . $weatherArray['windDirection'] . ' ' .  $weatherArray['windSpeed'] . ' ' . $weatherArray['windUnit'] . '</span><br />direction ' . $weatherArray['windDirectionDegrees'] . '&deg; gusting to ' . '<span title="Wind Gust" style="' . $weatherArray['windGustSpeedCSS'] . '">' . $weatherArray['windGustSpeed'] . ' ' . $weatherArray['windUnit'] . ' from '. $weatherArray['windGustDirectionDegrees'] .'&deg;<br/> 5min Average Wind: ' . $weatherArray['intervalAvgWindSpeed'] . ' ' . $weatherArray['windUnit'] . '</span></td></tr>';


$output = $output . '<tr class="tg-even"><td colspan="2" class="tg-center">';


$output = $output . '<span title="Beaufort Scale Wind Force Value" style="' . '">Wind Force (Beaufort Scale)<br/>' . $weatherArray['windBeaufortScale']  . '</span>';


$output = $output . '</td>';

$output = $output . '<td colspan="2" class="tg-center"><span title="Beauford Scale Wind Force Average" style="' . '">Average Wind Force<br />' . $weatherArray['intervalAvgBeaufortScale'] . '</span></td>
  </tr>';
  
  
$output = $output . '<tr class="tg-even">';

/*$output = $output . '<tr><td colspan="4" class="tg-center">Wind</td></tr>';*/
if (($weatherArray['windChill'] == 'N/A') || ($weatherArray['outsideTemp'] == $weatherArray['outsideHeatIndex']))
{
$output = $output . '<td colspan="2" class="tg-center"><span title="Feels Like">No WindChill<br /> or Heat Index </span>';
}
elseif ($weatherArray['windChill'] != 'N/A' || $weatherArray['windChill'] != 'NA')
{
$output = $output . '<td colspan="2" class="tg-center"><span title="Feels Like - Wind Chill" >Wind Chill<br/>' . $weatherArray['windChill'] . $weatherArray['tempUnit'] . '</span>';
}
else
{
$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['heatIndexCSS'] . '"><span title="Feels Like - Heat Index">Heat Index' . $weatherArray['outsideHeatIndex'] . $weatherArray['tempUnit'] . '</span>';
}

$output = $output . '</td>';

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['barometerCSS'] . '"><span title="Barometer" >Barometer<br />' . $weatherArray['barometer'] . ' ' . $weatherArray['barUnit'] . ' ' . $weatherArray['baromtrend'] . '</span></td>
  </tr>';





$output = $output . '<tr><td colspan="1" class="tg-center">';
$output = $output . 'Humidity<br /><span title="Humidity">' . $weatherArray['outsideHumidity'] . ' ' . $weatherArray['humUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Air Density<br /><span title="Air Density (for fog)">' . $weatherArray['airDensity'] . ' ' . $weatherArray['airDensityUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center">';
$output = $output . 'Cloud Base<br /><span title="Cumulus Base">' . $weatherArray['cumulusBase'] . ' ' . $weatherArray['cumulusBaseUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['outsideDewPtCSS'] . '">';
$output = $output . 'Dewpoint<br /><span title="Dewpoint" > ' . $weatherArray['outsideDewPt'] . $weatherArray['tempUnit'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="1" class="tg-center" style="' . $weatherArray['UVCSS'] . '"><span title="UV Index" >UV Index<br />' . $weatherArray['UV'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['windPowerDensityCSS'] . '"><span title="Wind Power Density" >Wind Power<br />' . $weatherArray['windPowerDensity'] . ' ' . $weatherArray['windPowerUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['solarPotentialCSS'] . '"><span title="Solar Power" >Solar Potential<br />' . $weatherArray['solarPotential'] . ' ' . $weatherArray['solarUnit'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['solarRadCSS'] . '"><span title="Solar Radiation" >Solar Radiation<br />' . $weatherArray['solarRad'] . ' ' . $weatherArray['solarUnit'] . '</span></td></tr>';

$output = $output . '<tr><td colspan="1" class="tg-center" style="' . $weatherArray['rainRateCSS'] . '">';
$output = $output . 'Rain Rate<br /><span title="Rain" > ' . $weatherArray['rainRate'] . ' ' . $weatherArray['rateUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['dailyRainCSS'] . '"><span title="Day\'s Rain" >Day\'s Rain<br />' . $weatherArray['dailyRain'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['ETCSS'] . '"><span title="Evapotranspiration" >Evapo-Transpiration<br />' . $weatherArray['ET'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Freezing Level">Freezing Level<br />' . $weatherArray['freezingLevel'] . ' ' . $weatherArray['cumulusBaseUnit'] . '</span></td></tr>';
$output = $output . '<tr>';

$output = $output . '<td colspan="4" class="tg-center">';
$output = $output . '<span title="Software"> Uptime: ' . $weatherArray['wviewUpTime'] . '</span></td>';

$output = $output . '</tr>';



$output = $output . '</table>';

	return $output;
	}

function outputAlmDisplayFull ($widgetArray,$weatherArray) {

$output = '';
$output = $output . '<table id="fulltable" class="frontwdgttable" ><tr>';
    
$output = $output . '<th colspan="4" class="tg-center">24 Hour Almanac</th>';

$output = $output . '</tr>';
$output = $output . '<tr>';

$output = $output . '<td colspan="4" class="tg-center"> Last Updated: '. $weatherArray['stationDate'] . ' ' . $weatherArray['stationTime']/* . ' <a href="https://www.google.ca/maps/@' . $weatherArray['stationLatitude'] . ',' . $weatherArray['stationLongitude']. ',12z">map</a></td></tr>'*/;    

/*$count = 0;
foreach ( $weatherArray as $key => $value ) {
	echo '<br/>';
	echo $key;
	echo ": ";
	echo $weatherArray[$key];
}*/
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center"><span >Day Characteristics</span></th>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Sunrise Time" >Sunrise<br />' . $weatherArray['sunriseTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Sunset Time" >Sunset<br />' . $weatherArray['sunsetTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Length of Day" >Day Length<br />' . $weatherArray['dayLength'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Moonrise Time" >Moon Phase<br />' . $weatherArray['moonPhase'] . '</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="2" class="tg-center"><span title="Civil" >Civil (City)</span></th>';
$output = $output . '<th colspan="2" class="tg-center"><span title="Civil" >Astronomical </span></th>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Civil Sunrise Time" >Sunrise<br />' . $weatherArray['civilriseTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Civil Sunset Time" >Sunset<br />' . $weatherArray['civilsetTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Astronomical Sunrise" >Sunrise<br />' . $weatherArray['astroriseTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Astronomical Sunset" >Sunset<br />' . $weatherArray['astrosetTime'] . '</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center"><span title="Midday" >Midday (Sun at Highest Point) Time: '. $weatherArray['middayTime'] . '</span></th>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">&nbsp;</th>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">Day\'s Highs and Lows</th>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['hiOutsideTempCSS'] .'"><span title="Day High Temp"  >High Temp<br />' . $weatherArray['hiOutsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['hiOutsideTempTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['hiDewpointCSS'] .'"><span title="High Dew"  >High Dewpoint<br />' . $weatherArray['hiDewpoint'] . $weatherArray['tempUnit'] . $weatherArray['hiDewpointTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['hiBarometerCSS'] .'"><span title="High Barometer"  >High Barometer<br />' . $weatherArray['hiBarometer'] . $weatherArray['barUnit'] . $weatherArray['hiBarometerTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['hiWindSpeedCSS'] . '"><span title="High Wind Speed" >High Wind<br />' . $weatherArray['hiWindSpeed'] . ' ' . $weatherArray['windUnit'] . ' from ' . $weatherArray['dayhighwinddir'] . ' ' . $weatherArray['hiWindSpeedTime'] . '</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['lowOutsideTempCSS'] .'"><span title="Day Low Temp" >Low Temp<br />' . $weatherArray['lowOutsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['lowOutsideTempTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['lowDewpointCSS'] .'"><span title="Low Dew" >Low Dewpoint<br />' . $weatherArray['lowDewpoint'] . $weatherArray['tempUnit'] . $weatherArray['lowDewpointTime'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['lowBarometerCSS'] .'"><span title="Low Barometer" >Low Barometer<br />' . $weatherArray['lowBarometer'] . $weatherArray['barUnit'] . $weatherArray['lowBarometerTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"style="' . $weatherArray['hiRainRateCSS'] . '"><span title="High Rain Rate" >High Rain Rate<br />' . $weatherArray['hiRainRate'] . $weatherArray['rateUnit'] . $weatherArray['hiRainRateTime'] . '</span></td>';

$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="' .'"><span title="High Humidity" >High Humid<br />' . $weatherArray['hiHumidity'] . $weatherArray['humUnit'] . $weatherArray['hiHumTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['hiRadiationCSS'] .'"><span title="High Solar Radiation"  >High Solar Rad<br />' . $weatherArray['hiRadiation'] . $weatherArray['solarUnit'] . $weatherArray['hiRadiationTime'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['hiUVCSS'] .'"><span title="High UV Index" >High UV Index<br />' . $weatherArray['hiUV']  . $weatherArray['hiUVTime'] . '</span></td>';

$output = $output . '<td colspan="1" class="tg-center"style="' . $weatherArray['hiHeatindexCSS'] . '"><span title="High Heat Index" >High Heat Index<br />' . $weatherArray['hiHeatindex'] . $weatherArray['tempUnit'] . $weatherArray['hiHeatindexTime'] . '</span></td>';

$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"style="' .'"><span title="Low Humidity" >Low Humid<br />' . $weatherArray['lowHumidity'] . $weatherArray['humUnit'] . $weatherArray['lowHumTime'] . '</span></td>';

$output = $output . '<td colspan="2" class="tg-center"style="' .'">&nbsp;</td>';

$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['lowWindchillCSS'] . '"><span title="Low Wind Chill" >Low Windchill<br />' . $weatherArray['lowWindchill'] . $weatherArray['tempUnit'] . $weatherArray['lowWindchillTime'] . '</span></td>';

$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">&nbsp;</th>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">Past Hour Averages and Trends</th>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="' .'"><span title="Hour Average Temperature"  >Temperature<br />' . $weatherArray['houravgtemp'] . $weatherArray['tempUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['houravgbaromCSS'] .'"><span title="Barometer" >Barometer<br />' . $weatherArray['houravgbarom'] . $weatherArray['barUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' .'"><span title="Hour Average Dewpoint"  >Dewpoint<br />' . $weatherArray['houravgdewpt'] . $weatherArray['tempUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . '"><span title="Hour Average Wind Speed" >Wind Speed<br />' . $weatherArray['houravgwind'] . $weatherArray['windUnit'] .  '</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="'  . '"><span title="Hour Temperature Change" >Change<br />' . $weatherArray['hourchangetemp'] . $weatherArray['tempUnit'] .  '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"style="' . '"><span title="Hour Barometer Change" >Change<br />' . $weatherArray['hourchangebarom'] . $weatherArray['barUnit'] .  '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="'  . '"><span title="Hour Change Dewpoint" >Change<br />' . $weatherArray['hourchangedewpt'] . $weatherArray['tempUnit'] .  '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"style="' . '"><span title="Hour Wind Change" >Change<br />' . $weatherArray['hourchangewind'] . $weatherArray['windUnit'] .  '</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"style="' .  '"><span title="Hour Average Humidity" >Humidity<br />' . $weatherArray['houravghumid'] . $weatherArray['humUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['hourrainCSS'] . '"><span title="Rain in Past Hour" >Past Hour Rain<br />' . $weatherArray['hourrain'] . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' .'"><span title="Hour Change Wind Direction"  >Wind Dir Chg<br />' . $weatherArray['hourchangewinddir'] . '&deg;</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="'. '"><span title="Hour Dominant Wind Direction" >Dominant Wind Dir<br />' . $weatherArray['hourdomwinddir'] . '&deg;</span></td>';
$output = $output . '</tr>';


$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="' . '"><span title="Hour Change Humidity" >Change<br />' . $weatherArray['hourchangehumid'] . $weatherArray['humUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center">&nbsp;</td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Ten Minute Wind Speed" >Ten Minute Wind Speed<br />' . $weatherArray['tenMinuteAvgWindSpeed'] . ' ' . $weatherArray['windUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"style="' . $weatherArray['hourwindrunCSS'] . '"><span title="Hour Wind Run" >Hour Wind Run<br />' . $weatherArray['hourwindrun'] . '</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">&nbsp;</th>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">Current Day Averages and Trends</th>';
$output = $output . '</tr>';


$output = $output . '<tr>';

$output = $output . '<td colspan="1" class="tg-center" style="'  .'"><span title="Day Average Temp" >Temperature<br />' . $weatherArray['dayavgtemp'] . $weatherArray['tempUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="'  . '"><span title="Day Average Dewpoint" >Dewpoint<br />' . $weatherArray['dayavgdewpt'] . $weatherArray['tempUnit'] .  '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"style="' . '"><span title="Day Average Barometer" >Barometer<br />' . $weatherArray['dayavgbarom'] . $weatherArray['barUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="'  . '"><span title="Day Average Wind Speed" >Wind Speed<br />' . $weatherArray['dayavgwind'] . $weatherArray['windUnit'] .  '</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="'  .'"><span title="Day Change of Temperature"  >Change<br />' . $weatherArray['daychangetemp'] . $weatherArray['tempUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="'  .'"><span title="Day Change of Dewpoint"  >Change<br />' . $weatherArray['daychangedewpt'] . $weatherArray['tempUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="'  .'"><span title="Day Change of Barometer" >Change<br />' . $weatherArray['daychangebarom'] . $weatherArray['barUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="'  .'"><span title="Day Change of Wind" >Change<br />' . $weatherArray['daychangewind'] . $weatherArray['windUnit'] . '</span></td>';
$output = $output . '</tr>';


$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center" style="'  .'"><span title="Day Average Humidity " >Humidity<br />' . $weatherArray['dayavghumid'] . $weatherArray['tempUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Storm Rain" >Storm Rain<br />' . $weatherArray['stormRain'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center" style="' . $weatherArray['daywindrunCSS'] .'"><span title="Day Wind Run"  >Wind Run<br />' . $weatherArray['daywindrun'] . '&deg;</span></td>';
$output = $output . '<td colspan="1" class="tg-center"style="' . '"><span title="Day Dominant Wind Direction" >Dominant Wind Dir<br />' . $weatherArray['daydomwinddir'] . '&deg;</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"style="' . '"><span title="Day Change Humidity" >Change<br />' . $weatherArray['daychangehumid'] . $weatherArray['humUnit'] . '</span></td>';

$output = $output . '<td colspan="2" class="tg-center">&nbsp;</td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Day Change Wind Direction" >Change<br />' . $weatherArray['daychangewinddir'] .  '&deg;</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">&nbsp;</th>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<th colspan="4" class="tg-center">Other Data</th>';
$output = $output . '</tr>';


$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Inside House Temp" >Inside Temp<br />' . $weatherArray['insideTemp'] . $weatherArray['tempUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Inside Humidity" >Inside Humid<br />' . $weatherArray['insideHumidity'] . $weatherArray['humUnit'] .'</span></td>';

$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Station Pressure" >Station Pressure<br />' . $weatherArray['stationPressure'] . $weatherArray['barUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Altimeter" >Altimeter<br />' . $weatherArray['altimeter'] .'m</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Rainy Season Total Rain" >Total Rain for Rainy Season (since ' . $weatherArray['rainSeasonStart'] . ')<br />' . $weatherArray['totalRain'] . ' ' . $weatherArray['rainUnit'] .'</span></td>';
$output = $output . '</tr>';

$output = $output . '<tr>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Station Receive Signal Percentage" >Station Receiving Signal<br />' . $weatherArray['rxCheckPercent'] . $weatherArray['humUnit'] . '</span></td>';
$output = $output . '<td colspan="1" class="tg-center"><span title="Transmit Battery Status" >Transmitter Battery Status<br />' . $weatherArray['txBatteryStatus'] .'</span></td>';

$output = $output . '<td colspan="1" class="tg-center"><span title="Console Battery Voltage" >Console<br/>Battery<br />' . $weatherArray['consBatteryVoltage'] . 'V </td>';
$output = $output . '</tr>';



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