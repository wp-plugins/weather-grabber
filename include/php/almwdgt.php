<?php 

function outputAlmDisplay ($widgetArray,$weatherArray) {


$output = '';


$output = $output . '<table id="almtable" class="frontwdgttable" >
<tr ><th colspan="4" class="tg-center">Day Almanac</th></tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['dailyRainCSS'] . '"><span title="Day Rain Total" ><strong>Day\'s Rain</strong><br/>' . $weatherArray['dailyRain'] . ' ' . $weatherArray['rainUnit'] . '</span> </td>';
$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['stormRainCSS'] . '"><span title="Rain Storm Total" ><strong>Rain Storm</strong><br/>' . $weatherArray['stormRain'] . ' ' . $weatherArray['rainUnit'] . '</span> </td>';



$output = $output . '</tr>';
$output = $output . '<tr class="tg-even">';
$output = $output . '<td colspan="2" class="tg-center"><span title="Civil Rise"><strong>Civil Rise</strong><br/>' . $weatherArray['civilriseTime'] . '</span> </td>';
$output = $output . '<td colspan="2" class="tg-center"><span title="Moon Phase"><strong>Moon Phase</strong><br/>' . $weatherArray['moonPhase'] . '</span> </td>';



$output = $output . '</tr>';
$output = $output . '<tr>';
if ($weatherArray['wviewdbtoggle'] == 1) {

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['RainPeriodSumCSS'] . '"><span title="24 hour Rain Amount" ><strong>24hr Rain</strong><br/>' . $weatherArray['SQLData']['RainPeriodSum'] . ' ' . $weatherArray['rainUnit'] . '</span></td>';

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['dailyETCSS'] . '"><span title="Day Evapo-Transpiration Total" ><strong>Day ET</strong><br/> -' . $weatherArray['dailyET'] . ' ' . $weatherArray['rainUnit'] . '</span> </td>';
$output = $output . '</tr>';

}	
$output = $output . '<tr>';
$output = $output . '<td colspan="2" class="tg-center"><span title="Civil Set"><strong>Civil Set</strong><br/>' . $weatherArray['civilsetTime'] . '</span> </td>';

$output = $output . '<td colspan="2" class="tg-center"><span title="Hours of Light Dawn to Dusk"><strong>Hours of Light</strong><br/>' . $weatherArray['dawnToDuskTime'] . ' Hours</span> </td>';

$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['hiOutsideTempCSS'] . '"><span title="Day High Temp" ><strong>Day High</strong><br/>' . $weatherArray['hiOutsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['hiOutsideTempTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['lowOutsideTempCSS'] . '"><span title="Day Low Temp" ><strong>Day Low</strong><br/>' . $weatherArray['lowOutsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['lowOutsideTempTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['hiRainRateCSS'] . '"><span title="Day High Rain Rate" ><strong>Day High Rain Rate</strong><br/>' . $weatherArray['hiRainRate'] . $weatherArray['rateUnit'] . $weatherArray['hiRainRateTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['hiBarometerCSS'] . '"><span title="Day High Barometer" ><strong>Day High Barometer</strong><br/>' . ' ' . $weatherArray['hiBarometer'] . ' ' . $weatherArray['barUnit'] . $weatherArray['hiBarometerTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['lowBarometerCSS'] . '"><span title="Day Low Barometer" ><strong>Day Low Barometer</strong><br/>' . $weatherArray['lowBarometer'] . ' ' . $weatherArray['barUnit'] . $weatherArray['lowBarometerTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['lowWindchillCSS'] . '"><span title="Day Low Windchill" ><strong>Day Low Windchill</strong><br/>' . $weatherArray['lowWindchill'] . $weatherArray['tempUnit'] . $weatherArray['lowWindchillTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['hiHeatindexCSS'] . '"><span title="Day High Heat Index" ><strong>Day High Heat Index</strong><br/>' . $weatherArray['hiHeatindex'] . $weatherArray['tempUnit'] . $weatherArray['hiHeatindexTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['hiWindSpeedCSS'] . '"><span title="Day High Wind " ><strong>Day High Wind Gust</strong><br/>' . $weatherArray['dayhighwinddir'] . $weatherArray['hiWindSpeed'] . $weatherArray['windUnit'] . $weatherArray['hiWindSpeedTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['hiRadiationCSS'] . '"><span title="Day High Solar Radiation" ><strong>Day High Solar Radiation</strong><br/>' . $weatherArray['hiRadiation'] . $weatherArray['solarUnit'] . $weatherArray['hiRadiationTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center" style="' . $weatherArray['hiUVCSS'] . '"><span title="Day High UV Index" ><strong>Day High UV Index</strong><br/>' . $weatherArray['hiUV'] . $weatherArray['hiUVTime'] . '</span></td>';
$output = $output . '</tr>';
$output = $output . '<tr>';
$output = $output . '<td colspan="4" class="tg-center"> </td>';
$output = $output . '</tr>';
$output = $output . '</table>';
	return $output;
	}//END selectorFunction1
	
	/* Now here is the main function that brings everything together from the Admin form and runs it all. */
	
	class wxGrabber_almanac_widget extends WP_Widget {

public function wxGrabber_almanac_widget() {
parent::WP_Widget(false, $name = 'WXGB - Almanac Front Page');
// Load jQuery
wp_enqueue_script('jquery');
}


/* This controls what the widget actually does.  Gets stuff for it and displays it on the website.

/** @see WP_Widget::widget */

public function widget($args, $instance) {
extract( $args ); //This gets arguments and grabs the options that are set in the admin panel for the widget in Wordpress

	// Get the div id of the widget
	$widgetid = $args['widget_id'];


	// these are our widget options
    $title = '';
   
$widgetArray['weatherperiod'] = 0;
$weatherArray = weathersetup($widgetArray['weatherperiod']);
$output = outputAlmDisplay($widgetArray,$weatherArray);
echo $before_widget.$output.$after_widget;	

}

 /** @see WP_Widget::form */
 
function form($instance) {	
$widgetArray = FALSE;
$weatherperiod=0; // Getting only 24hr values;
$weatherArray = weathersetup($weatherperiod);

$beforedisplay = '<div style="background-color: white; padding: 5px 7px 5px 10%;">';
$output = outputAlmDisplay($widgetArray,$weatherArray);
$afterdisplay =  '</div>';

echo $beforedisplay.$output.$afterdisplay;
}

} //END OF THE MAIN  WIDGET CLASS
?>