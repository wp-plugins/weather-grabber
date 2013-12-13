<?php 


function outputCurrentDisplay ($widgetArray,$weatherArray) {


$output = '';
/*
$output = '<style type="text/css">
.tg-table-light { border-collapse: collapse; border-spacing: 0; }
.tg-table-light td, .tg-table-light th { background-color: #fff; border: 1px #bbb solid; color: #333; font-family: sans-serif; font-size: 100%; padding: 10px; vertical-align: top; }
.tg-table-light .tg-even td  { background-color: #eee; }
.tg-table-light th  { background-color: #ddd; color: #333; font-size: 110%; font-weight: bold; }
.tg-table-light tr:hover td, .tg-table-light tr.even:hover td  { color: #222; background-color: #FCFBE3; }
.tg-bf { font-weight: bold; } .tg-it { font-style: italic; }
.tg-left { text-align: left; } .tg-right { text-align: right; } .tg-center { text-align: center; }
</style>';*/

$output = $output . '<table class="tg-table-light"><tr ><th colspan="4" class="tg-center">Current Conditions</th></tr><tr><td class="tg-right">Temp:</td><td class="tg-left"><span style="' . $weatherArray['outsideTempCSS'] . '">' . $weatherArray['outsideTemp'] . $weatherArray['tempUnit'] . $weatherArray['TempTrend5min'] . '</span> </td>';

$output = $output . '<td class="tg-right">Barom:</td><td class="tg-left"><span style=""> ' . $weatherArray['barometer'] . $weatherArray['barUnit'] . $weatherArray['baromtrend'] . '</span> </td>
  </tr>';
 $output = $output . '<tr class="tg-even"><td class="tg-right">Hum:</td><td class="tg-left"><span>' . $weatherArray['outsideHumidity'] . $weatherArray['humUnit'] . '</span></td>';

$output = $output . '<td class="tg-right">Dewpt:</td><td class="tg-left"><span style="' . $weatherArray['outsideDewPtCSS'] . '"> ' . $weatherArray['outsideDewPt'] . $weatherArray['tempUnit'] . '</span> </td></tr>';

$output = $output . '<tr><td colspan="4" class="tg-center">Wind</td></tr>';

$output = $output . '<tr class="tg-even"><td colspan="4" class="tg-center" ><span>' . $weatherArray['windDirection'] . ' ' .  $weatherArray['windSpeed'] . ' ' . $weatherArray['windUnit'] . ' gusting to ' . $weatherArray['windGustSpeed'] . ' ' . $weatherArray['windUnit'] . '</span></td></tr>';

if (($weatherArray['windChill'] == 'N/A') || ($weatherArray['outsideTemp'] == $weatherArray['outsideHeatIndex']))
{
$output = $output . '<tr><td class="tg-right">Feels like:</td><td class="tg-left"><span>' . $weatherArray['windChill'] . '</span></td>';
}
elseif ($weatherArray['windChill'] != 'N/A')
{
$output = $output . '<tr><td class="tg-right">Feels:</td><td class="tg-left"><span>' . $weatherArray['windChill'] . $weatherArray['tempUnit'] . '</span></td>';
}
else
{
$output = $output . '<tr><td class="tg-right">Feels:</td><td class="tg-left"><span>' . $weatherArray['outsideHeatIndex'] . $weatherArray['tempUnit'] . '</span></td>';
}

$output = $output . '<td class="tg-right">Rain:</td><td class="tg-left"><span style=""> ' . $weatherArray['dailyRain'] . $weatherArray['rainUnit'] . '</span></td></tr>';

$output = $output . '<tr class="tg-even"><td class="tg-right">UV:</td><td class="tg-left"><span style=""> ' . $weatherArray['UV'] . '</span></td>';

$output = $output . '<td class="tg-right">Solar:</td><td class="tg-left"><span style=""> ' . $weatherArray['solarRad'] . $weatherArray['solarUnit'] . '</span></td></tr>';

$output = $output . '<tr>
    <td colspan="4" class="tg-center"> Last Updated: ' . $weatherArray['stationTime'] . '</td></tr></table>';



	return $output;
	}//END selectorFunction1
	
	/* Now here is the main function that brings everything together from the Admin form and runs it all. */
	
	class wxGrabber_current_conditions_widget extends WP_Widget {

	

static function install() {

	$defaultoptions = Array('webTime'=>'America/New_York','paramFile'=>'phpparameterlist.htm','weatherTime'=>'America/New_York','wviewdbtoggle'=>'no','wviewsensors'=>'0','currentSys'=>'1','timedelay'=>'0','mysqltable'=>'archive','mysqlpass'=>'passwordhere','mysqluser'=>'username','mysqldbname'=>'yourdatabasename','mysqlhost'=>'localhost');
    update_option('wxgrabber_options',$defaultoptions);
    
     }
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
    $title = apply_filters('widget_title', $instance['title']);
	$text = $instance['text'];
	$checkbox = $instance['checkbox'];
	
	//for Ajax
	$useAjax = $instance['useAjax'];
	$showUpdates = $instance['showUpdates'];
	
	
	//The options for the Main widget instance
	
	$weatherperiod = $instance['weatherperiod'];
	$selectorText1 = $instance['selectorText1'];
	$selectorTextCSS1 = $instance['selectorTextCSS1'];
	$selectorFirstValue1 = $instance['selectorFirstValue1'];
	$selectorSecondValue1 = $instance['selectorSecondValue1'];
	$selectorThirdValue1 = $instance['selectorThirdValue1'];
	$selectorText2 = $instance['selectorText2'];
	$selectorTextCSS2 = $instance['selectorTextCSS2'];
	$selectorFirstValue2 = $instance['selectorFirstValue2'];
	$selectorSecondValue2 = $instance['selectorSecondValue2'];
	$selectorThirdValue2 = $instance['selectorThirdValue2'];
	
	 //Now we create the container for the live stuff
    
$widgetArray = Array('selectorText1'=>$selectorText1,'selectorTextCSS1'=>$selectorTextCSS1,'selectorFirstValue1'=>$selectorFirstValue1,'selectorSecondValue1'=>$selectorSecondValue1,'selectorThirdValue1'=>$selectorThirdValue1,'selectorText2'=>$selectorText2,'selectorTextCSS2'=>$selectorTextCSS2,'selectorFirstValue2'=>$selectorFirstValue2,'selectorSecondValue2'=>$selectorSecondValue2,'selectorThirdValue2'=>$selectorThirdValue2,'weatherperiod'=>$weatherperiod);
    
	
	
	//This variable is used by AJAX to update only the live data and not other non-live elements in the widget.
	$widgetIDUpdater = $widgetid . 'update';
	
    echo $before_widget;

	if ($title) {
	echo $before_title . '<strong style="color:red">' . $title .'</strong>' . $after_title;
	}
	
	//Now we'll check if we want to display the Live Updates notification
	if ($showUpdates == 1) {
	echo '<strong>Live Updates';
	//Then we'll change the display be it on or off
	if ($useAjax == 1) { 
    echo ' On';
    }
    else{
   echo ' Off';
    }
    echo '</strong> <br/>';
    }//End ShowUpdates IF
    
    
   
    
    
    echo '<span id="' . $widgetIDUpdater . '">';
	if ($useAjax == 22222221) { 	
	
    ?>
    
    <script type="text/javascript">
SANAjax = function() {
        jQuery(document).ready(function($){
            $.ajax({
                type : "GET",
                url : "index.php",
                data : { wxGrabber_main_values_widget_request      : "update_wxgrabber",
                            wxGrabber_main_values_widget_selectorText1 : "<?php echo $selectorText1; ?>",
                            wxGrabber_main_values_widget_selectorTextCSS1 : "<?php echo $selectorTextCSS1; ?>",
                            wxGrabber_main_values_widget_selectorFirstValue1 : "<?php echo $selectorFirstValue1; ?>",
                            wxGrabber_main_values_widget_selectorSecondValue1 : "<?php echo $selectorSecondValue1; ?>",
                            wxGrabber_main_values_widget_selectorThirdValue1 : "<?php echo $selectorThirdValue1; ?>",
                            wxGrabber_main_values_widget_selectorText2 : "<?php echo $selectorText2; ?>",
                            wxGrabber_main_values_widget_selectorTextCSS2 : "<?php echo $selectorTextCSS2; ?>",
                            wxGrabber_main_values_widget_selectorFirstValue2 : "<?php echo $selectorFirstValue2; ?>",
                            wxGrabber_main_values_widget_selectorSecondValue2 : "<?php echo $selectorSecondValue2; ?>",
                            wxGrabber_main_values_widget_selectorThirdValue2 : "<?php echo $selectorThirdValue2; ?>",
                            wxGrabber_main_values_widget_weatherperiod : "<?php echo $weatherperiod; ?>"},
                success : function(response) {
                    // The server has finished executing PHP and has returned something,
                    // so display it!
                    $("#<?php echo $widgetIDUpdater; ?>").empty().append(response);
                }
            });
        });
        }
        SANAjax();
        setInterval( "SANAjax();", 30000 );
    </script>
<?php

// Otherwise AJAX is not on and we output HTML method
} else {
$weatherArray = weathersetup($widgetArray['weatherperiod']);
$output = outputCurrentDisplay($widgetArray,$weatherArray);
echo $output;
}    
        
//Now we close the container for the live stuff
	
	echo '</span>';
	
	
 echo $after_widget;
    }



/** @see WP_Widget::update */

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['text'] = strip_tags($new_instance['text']);
	$instance['checkbox'] = strip_tags($new_instance['checkbox']);
	$instance['textarea'] = strip_tags($new_instance['textarea']);
	
	$instance['showUpdates'] = strip_tags($new_instance['showUpdates']);
	$instance['useAjax'] = strip_tags($new_instance['useAjax']);
	
	$instance['weatherperiod'] = strip_tags($new_instance['weatherperiod']);
	
	$instance['selectorText1'] = strip_tags($new_instance['selectorText1']);
	$instance['selectorTextCSS1'] = strip_tags($new_instance['selectorTextCSS1']);
	$instance['selectorFirstValue1'] = strip_tags($new_instance['selectorFirstValue1']);
    $instance['selectorSecondValue1'] = strip_tags($new_instance['selectorSecondValue1']);
    $instance['selectorThirdValue1'] = strip_tags($new_instance['selectorThirdValue1']);
    
    $instance['selectorText2'] = strip_tags($new_instance['selectorText2']);
    $instance['selectorTextCSS2'] = strip_tags($new_instance['selectorTextCSS2']);
	$instance['selectorFirstValue2'] = strip_tags($new_instance['selectorFirstValue2']);
    $instance['selectorSecondValue2'] = strip_tags($new_instance['selectorSecondValue2']);
    $instance['selectorThirdValue2'] = strip_tags($new_instance['selectorThirdValue2']);
    return $instance;
    }
    





 /** @see WP_Widget::form */
 
function form($instance) {	

$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
$text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
$checkbox = isset( $instance['checkbox'] ) ? esc_attr( $instance['checkbox'] ) : '';
$textarea = isset( $instance['textarea'] ) ? esc_attr( $instance['textarea'] ) : '';
$weatherperiod = isset( $instance['weatherperiod'] ) ? esc_attr( $instance['weatherperiod'] ) : '';
$showUpdates = isset( $instance['showUpdates'] ) ? esc_attr( $instance['showUpdates'] ) : '';
$useAjax = isset( $instance['useAjax'] ) ? esc_attr( $instance['useAjax'] ) : '';
$selectorText1 = isset( $instance['selectorText1'] ) ? esc_attr( $instance['selectorText1'] ) : '';
$selectorTextCSS1 = isset( $instance['selectorTextCSS1'] ) ? esc_attr( $instance['selectorTextCSS1'] ) : '';
$selectorFirstValue1 = isset( $instance['selectorFirstValue1'] ) ? esc_attr( $instance['selectorFirstValue1'] ) : '';
$selectorSecondValue1 = isset( $instance['selectorSecondValue1'] ) ? esc_attr( $instance['selectorSecondValue1'] ) : '';
$selectorThirdValue1 = isset( $instance['selectorThirdValue1'] ) ? esc_attr( $instance['selectorThirdValue1'] ) : '';

$selectorText2 = isset( $instance['selectorText2'] ) ? esc_attr( $instance['selectorText2'] ) : '';
$selectorTextCSS2 = isset( $instance['selectorTextCSS2'] ) ? esc_attr( $instance['selectorTextCSS2'] ) : '';
$selectorFirstValue2 = isset( $instance['selectorFirstValue2'] ) ? esc_attr( $instance['selectorFirstValue2'] ) : '';
$selectorSecondValue2 = isset( $instance['selectorSecondValue2'] ) ? esc_attr( $instance['selectorSecondValue2'] ) : '';
$selectorThirdValue2 = isset( $instance['selectorThirdValue2'] ) ? esc_attr( $instance['selectorThirdValue2'] ) : '';

$widgetArray = Array('selectorText1'=>$selectorText1,'selectorTextCSS1'=>$selectorTextCSS1,'selectorFirstValue1'=>$selectorFirstValue1,'selectorSecondValue1'=>$selectorSecondValue1,'selectorThirdValue1'=>$selectorThirdValue1,'selectorText2'=>$selectorText2,'selectorTextCSS2'=>$selectorTextCSS2,'selectorFirstValue2'=>$selectorFirstValue2,'selectorSecondValue2'=>$selectorSecondValue2,'selectorThirdValue2'=>$selectorThirdValue2,'weatherperiod'=>$weatherperiod);

/** Call the Weather setup function to do the work for admin and sort it alphabetically **/
$weatherperiod=0; // Getting only 24hr values;
$weatherArray = weathersetup($weatherperiod);
ksort($weatherArray); //Sort the Array Alphabetically




?>








<div style=" background-color: white; padding: 5px 7px 5px 10%;">
    <?php
    $output = outputCurrentDisplay($widgetArray,$weatherArray);
    echo $output;
    ?>
    </div>


<!--

<ul>
<li>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label> - (Blank for None)
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</li>    
<li>Live Updating: <input id="<?php echo $this->get_field_id('useAjax'); ?>" name="<?php echo $this->get_field_name('useAjax'); ?>" type="checkbox" value="1" <?php checked( '1', $useAjax ); ?>></li>

<li>Show Update Status: <input id="<?php echo $this->get_field_id('showUpdates'); ?>" name="<?php echo $this->get_field_name('showUpdates'); ?>" type="checkbox" value="1" <?php checked( '1', $showUpdates ); ?></li>
</ul>

-->
<!--	<p>
      	<input id="<?php echo $this->get_field_id('showUpdates'); ?>" name="<?php echo $this->get_field_name('showUpdates'); ?>" type="checkbox" value="1" <?php checked( '1', $showUpdates ); ?>
    	<label for="<?php echo $this->get_field_id('showUpdates'); ?>"><?php _e('This is a checkbox'); ?></label>
    </p>

	<p>
    	<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Enter custom value shortcodes here(future):'); ?></label>
    	<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
    </p>
-->

<!--
	<p>
	<label for="<?php echo $this->get_field_id('weatherperiod'); ?>"><?php _e('Data Period'); ?></label>
		<select name="<?php echo $this->get_field_name('weatherperiod'); ?>" id="<?php echo $this->get_field_id('weatherperiod'); ?>">
			<?php
			
			echo '<option value="none" id="none"', $weatherperiod == 'none' ? ' selected="selected"' : '', '>Choose Time Frame</option>';
			
			$options = Array(0=>'24hr',1=>'Weekly',2=>'Monthly',3=>'Yearly');
			foreach ($options as $value => $name) {
				echo '<option value="' . $value . '" id="' . $value . '"', $weatherperiod == $value ? ' selected="selected"' : '', '>', $name, '</option>';
				
			}
						
?>
		</select>
		</p>
		
	<p><strong title="Up to three weather variables can be set for each widget.  Mix and match weather values and units to build your desired output.  <br/>(eg. outsideTemp+tempUnit or windirection+wind+windunit)">First Weather Widget:</strong><br/>
	<label for="<?php echo $this->get_field_id('selectorText1'); ?>"><?php _e('Descriptor:'); ?></label>
      	<input size="10" id="<?php echo $this->get_field_id('selectorText1'); ?>" name="<?php echo $this->get_field_name('selectorText1'); ?>" type="text" value="<?php echo $selectorText1; ?>" /> <br/><label for="<?php echo $this->get_field_id('selectorTextCSS1'); ?>"><?php _e('Color:'); ?></label>
      	<input size="14" id="<?php echo $this->get_field_id('selectorTextCSS1'); ?>" name="<?php echo $this->get_field_name('selectorTextCSS1'); ?>" type="text" value="<?php echo $selectorTextCSS1; ?>" />
		</p>
	
		<p>
		<label for="<?php echo $this->get_field_id('selectorFirstValue1'); ?>"><?php _e(''); ?></label>
		<select name="<?php echo $this->get_field_name('selectorFirstValue1'); ?>" id="<?php echo $this->get_field_id('selectorFirstValue1'); ?>">
			<?php
			$options = $weatherArray;
			//First the default option:
			echo '<option value="none" id="none"', $selectorFirstValue1 == 'none' ? ' selected="selected"' : '', '>	none</option>';
	
			foreach ($options as $value => $name) {
				echo '<option value="' . $value . '" id="' . $value . '"', $selectorFirstValue1 == $value ? ' selected="selected"' : '', '>', $value, '</option>';
			}
			?>
		</select>
		
		<label for="<?php echo $this->get_field_id('selectorSecondValue1'); ?>"><?php _e(''); ?></label>
		<select name="<?php echo $this->get_field_name('selectorSecondValue1'); ?>" id="<?php echo $this->get_field_id('selectorSecondValue1'); ?>">
			<?php
			$options = $weatherArray;
			//First the default option:
			echo '<option value="none" id="none"', $selectorSecondValue1 == 'none' ? ' selected="selected"' : '', '>	none</option>';
	
			foreach ($options as $value => $name) {
				echo '<option value="' . $value . '" id="' . $value . '"', $selectorSecondValue1 == $value ? ' selected="selected"' : '', '>', $value, '</option>';
			}
			
			?>
		</select>
		<label for="<?php echo $this->get_field_id('selectorThirdValue1'); ?>"><?php _e(''); ?></label>
		<select name="<?php echo $this->get_field_name('selectorThirdValue1'); ?>" id="<?php echo $this->get_field_id('selectorThirdValue1'); ?>">
			<?php
			$options = $weatherArray;
			//First the default option:
			echo '<option value="none" id="none"', $selectorThirdValue1 == 'none' ? ' selected="selected"' : '', '>	none</option>';
	
			foreach ($options as $value => $name) {
				echo '<option value="' . $value . '" id="' . $value . '"', $selectorThirdValue1 == $value ? ' selected="selected"' : '', '>', $value, '</option>';
			}
			
			?>
		</select>
		
		
	</p>
	
	<p><strong title="Up to three weather variables can be set for each widget.  Mix and match weather values and units to build your desired output.  <br/>(eg. outsideTemp+tempUnit or windirection+wind+windunit)">Second Weather Widget (Optional):</strong><br/>
	<label for="<?php echo $this->get_field_id('selectorText2'); ?>"><?php _e('Descriptor:'); ?></label>
      	<input size="10" id="<?php echo $this->get_field_id('selectorText2'); ?>" name="<?php echo $this->get_field_name('selectorText2'); ?>" type="text" value="<?php echo $selectorText2; ?>" /> <br/><label for="<?php echo $this->get_field_id('selectorTextCSS2'); ?>"><?php _e('Color:'); ?></label>
      	<input size="14" id="<?php echo $this->get_field_id('selectorTextCSS2'); ?>" name="<?php echo $this->get_field_name('selectorTextCSS2'); ?>" type="text" value="<?php echo $selectorTextCSS2; ?>" />
		</p>
		<p>

		<label for="<?php echo $this->get_field_id('selectorFirstValue2'); ?>"><?php _e(''); ?></label>
		<select name="<?php echo $this->get_field_name('selectorFirstValue2'); ?>" id="<?php echo $this->get_field_id('selectorFirstValue2'); ?>">
			<?php
			$options = $weatherArray;
			//First the default option:
			echo '<option value="none" id="none"', $selectorFirstValue1 == 'none' ? ' selected="selected"' : '', '>	none</option>';
	
			foreach ($options as $value => $name) {
				echo '<option value="' . $value . '" id="' . $value . '"', $selectorFirstValue2 == $value ? ' selected="selected"' : '', '>', $value, '</option>';
			}
			?>
		</select>
		
		<label for="<?php echo $this->get_field_id('selectorSecondValue2'); ?>"><?php _e(''); ?></label>
		<select name="<?php echo $this->get_field_name('selectorSecondValue2'); ?>" id="<?php echo $this->get_field_id('selectorSecondValue2'); ?>">
			<?php
			$options = $weatherArray;
			//First the default option:
			echo '<option value="none" id="none"', $selectorSecondValue2 == 'none' ? ' selected="selected"' : '', '>	none</option>';
	
			foreach ($options as $value => $name) {
				echo '<option value="' . $value . '" id="' . $value . '"', $selectorSecondValue2 == $value ? ' selected="selected"' : '', '>', $value, '</option>';
			}
			
			?>
		</select>
		<label for="<?php echo $this->get_field_id('selectorThirdValue2'); ?>"><?php _e(''); ?></label>
		<select name="<?php echo $this->get_field_name('selectorThirdValue2'); ?>" id="<?php echo $this->get_field_id('selectorThirdValue2'); ?>">
			<?php
			$options = $weatherArray;
			//First the default option:
			echo '<option value="none" id="none"', $selectorThirdValue2 == 'none' ? ' selected="selected"' : '', '>	none</option>';
	
			foreach ($options as $value => $name) {
				echo '<option value="' . $value . '" id="' . $value . '"', $selectorThirdValue2 == $value ? ' selected="selected"' : '', '>', $value, '</option>';
			}
			
			?>
		</select>
		
	
	</p>
-->	
    <?php
}

} //END OF THE MAIN  WIDGET CLASS
?>