<?php 
function outputCurrentDisplay ($widgetArray,$weatherArray) {


$output = '';


$output = $output . '<table id="cctable" class="frontwdgttable" >
<tr ><th colspan="4" class="tg-center">Current Conditions</th></tr>
<tr><td colspan="2" class="tg-center" style="' . $weatherArray['outsideTempCSS'] . '"><strong>Temperature</strong><br/><span title="Temperature">' . $weatherArray['outsideTemp'] . $weatherArray['tempUnit'] . ' change ' . $weatherArray['hourchangetemp'] . '  ' . $weatherArray['tempUnit'] . '/hr</span> </td>';

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['barometerCSS'] . '"><strong>Barometer</strong><br/><span title="Barometer" >' . $weatherArray['barometer'] . ' ' . $weatherArray['barUnit'] . $weatherArray['baromtrend'] . '</span> </td>
  </tr>';


/*$output = $output . '<tr><td colspan="4" class="tg-center">Wind</td></tr>';*/

$output = $output . '<tr class="tg-even"><td colspan="4" class="tg-center" style="' . $weatherArray['windSpeedCSS'] . '"><strong>Wind</strong><br/><span title="Wind">' . $weatherArray['windDirection'] . ' ' .  $weatherArray['windSpeed'] . ' ' . $weatherArray['windUnit'] . '</span> gusting <span title="WindGust" style="' . $weatherArray['windGustSpeedCSS'] . '">' . $weatherArray['windGustSpeed'] . ' ' . $weatherArray['windUnit'] . '</span></td></tr>';

$output = $output . '<tr class="tg-even"><td colspan="2" class="tg-center"><strong>Humidity</strong><br/><span title="Humidity">' . $weatherArray['outsideHumidity'] . ' ' . $weatherArray['humUnit'] . '</span></td>';

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['rainRateCSS'] . '"><strong>Rain Rate</strong><br/><span title="Rain" >' . $weatherArray['rainRate'] . ' ' . $weatherArray['rateUnit'] . '</span></td></tr>';

if (($weatherArray['windChill'] == 'N/A') || ($weatherArray['outsideTemp'] == $weatherArray['outsideHeatIndex']))
{
$output = $output . '<tr><td colspan="2" class="tg-center" style="' . $weatherArray['windChillCSS'] . '"><strong>Feels Like</strong><br/><span title="Feels Like">' . $weatherArray['windChill'] . '</span></td>';
}
elseif ($weatherArray['windChill'] != 'N/A')
{
$output = $output . '<tr><td colspan="2" class="tg-center" style="' . $weatherArray['windChillCSS'] . '"><strong>Feels Like</strong><br/><span title="Feels Like" >' . $weatherArray['windChill'] . $weatherArray['tempUnit'] . '</span></td>';
}
else
{
$output = $output . '<tr><td colspan="2" class="tg-center"><strong>Feels Like</strong><br/><span title="Feels Like" style="' . $weatherArray['heatIndexCSS'] . '">' . $weatherArray['outsideHeatIndex'] . $weatherArray['tempUnit'] . '</span></td>';
}

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['outsideDewPtCSS'] . '"><strong>Dewpoint</strong><br/><span title="Dewpoint">' . $weatherArray['outsideDewPt'] . $weatherArray['tempUnit'] . '</span> </td></tr>';

$output = $output . '<tr class="tg-even"><td colspan="2" class="tg-center" style="' . $weatherArray['UVCSS'] . '"><span title="UV Index"><strong>UV</strong><br/>' . $weatherArray['UV'] . '</span></td>';

$output = $output . '<td colspan="2" class="tg-center" style="' . $weatherArray['solarRadCSS'] . '"><span title="Solar Radiation" ><strong>Solar</strong><br/>' . $weatherArray['solarRad'] . ' ' . $weatherArray['solarUnit'] . '</span></td></tr>';

$output = $output . '<tr>
    <td colspan="4" class="tg-center"> Last Updated: ' . $weatherArray['stationTime'] . '</td></tr></table>';



	return $output;
	}
	
	/* Now here is the main function that brings everything together from the Admin form and runs it all. */
	
	class wxGrabber_current_conditions_widget extends WP_Widget {

/*constructor - This creates the widget.  You can create as many of these as you want by copying the function and changing the name to suit the new widget you create. */

public function wxGrabber_current_conditions_widget() {
parent::WP_Widget(false, $name = 'WXGB - Current Conditions');
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
	//This variable is used by AJAX to update only the live data and not other non-live elements in the widget.
	$widgetIDUpdater = $widgetid . 'update';
	
$widgetArray['weatherperiod'] = 0;	
$weatherArray = weathersetup($widgetArray['weatherperiod']);
$output = outputCurrentDisplay($widgetArray,$weatherArray);
echo $before_widget.$output.$after_widget;	

}

 /** @see WP_Widget::form Creates the Widget in the Admin screen with display.**/
 
public function form($instance) {	
$widgetArray = FALSE;
$weatherperiod=0; // Getting only 24hr values;
$weatherArray = weathersetup($weatherperiod);

$beforedisplay = '<div style="background-color: white; padding: 5px 7px 5px 10%;">';
$output = outputCurrentDisplay($widgetArray,$weatherArray);
$afterdisplay =  '</div>';

echo $beforedisplay.$output.$afterdisplay;
}

} //END OF THE MAIN  WIDGET CLASS
?>