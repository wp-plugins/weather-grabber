<?php
/*
Plugin Name: Weather-Grabber
Plugin URI: http://www.alberniweather.ca/developer
Author: Chris Alemany
Version: 0.9.9.1
Author URI: http://www.alberniweather.ca/developer

Description: This plugin connects files generated by the WView weather server software (or other software using the supported format and naming conventions) and displays the weather data in wordpress using widgets.

Requirements for pre-1.0 release:
- Latest WView weather server software (http://www.wviewweather.com)

INSTALL:

1: Install the plugin in Wordpress.

2: Install the included phpparameter.htx (found in the wxgrabber plugin directory) in WView and set to generate and upload to your root web folder

2b: If you are not running wview you can still use this plugin by having your weather software create a delimited text file similar to phpparameter.htx.  Name and value pairs can be omitted but names (before the semi-colon) MUST remain the same.

3: Setup the Weather Grabber plugin in the "Settings" area of Wordpress

4: Add and setup a Widget under Appearance

5: You're done!


*/
/*  Copyright 2014  Chris Alemany  (email : chrisale@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**/

/** FIRST DEFINE A CONSTANT FOR PATHS AND SUCH **/
define( 'WXGRABBER_PATH', plugin_dir_path(__FILE__) );

/* Now bring in WeatherArray creation function */
require WXGRABBER_PATH . 'adminoptions.php';
require WXGRABBER_PATH . 'weatherarray.php';

/********************************************************
 Main Function that runs the backend
********************************************************/
	
function wxgb_style() {

wp_register_style( 'wxgb_css', plugins_url( 'weather-grabber/include/css/wxgb.css', array(), '1.0', 'screen' ));
wp_enqueue_style( 'wxgb_css' );
}

function mainwxgbfunc ($widgetArray) {


$weatherArray = weathersetup($widgetArray['weatherperiod']);
$output = '<div id="wxgbwidget1"><table style="background-color: rgba(20%,20%,20%,0.1);"><tr style="">';
$output =  $output. selectorFunction1($widgetArray,$weatherArray);
$output = $output . '<tr/></table></div>';
return $output;

}	
/********************************************************
 Widget Classes and Functions
********************************************************/



include('include/php/cstwdgt.php');

include('include/php/ccwdgt.php');

include('include/php/almwdgt.php');

include('include/php/generalshortcodes.php');

/********************************************************
 AJAX Functions
********************************************************/

function wxGrabber_main_values_widget_request_handler() {
    // Check that all parameters have been passed
   
    if ((isset($_GET['wxGrabber_main_values_widget_request']) && ($_GET['wxGrabber_main_values_widget_request'] == 'update_wxgrabber')) && 
      isset($_GET['wxGrabber_main_values_widget_selectorText1']) &&
      isset($_GET['wxGrabber_main_values_widget_selectorTextCSS1']) && 		
      isset($_GET['wxGrabber_main_values_widget_selectorFirstValue1']) && 
      isset($_GET['wxGrabber_main_values_widget_selectorSecondValue1']) &&
      isset($_GET['wxGrabber_main_values_widget_selectorThirdValue1']) &&
      isset($_GET['wxGrabber_main_values_widget_selectorText2']) &&
      isset($_GET['wxGrabber_main_values_widget_selectorTextCSS2']) &&
      isset($_GET['wxGrabber_main_values_widget_selectorFirstValue2']) &&
      isset($_GET['wxGrabber_main_values_widget_selectorSecondValue2']) &&
      isset($_GET['wxGrabber_main_values_widget_selectorThirdValue2']) &&
      isset($_GET['wxGrabber_main_values_widget_weatherperiod']))      
{ 
		$widgetArray = Array('selectorText1' => strip_tags($_GET['wxGrabber_main_values_widget_selectorText1']),'selectorTextCSS1' => 
strip_tags($_GET['wxGrabber_main_values_widget_selectorTextCSS1']),'selectorFirstValue1' => 
strip_tags($_GET['wxGrabber_main_values_widget_selectorFirstValue1']),'selectorSecondValue1' => 
strip_tags($_GET['wxGrabber_main_values_widget_selectorSecondValue1']),'selectorThirdValue1' =>
strip_tags($_GET['wxGrabber_main_values_widget_selectorThirdValue1']),'selectorText2' =>
strip_tags($_GET['wxGrabber_main_values_widget_selectorText2']),'selectorTextCSS2' =>
strip_tags($_GET['wxGrabber_main_values_widget_selectorTextCSS2']),'selectorFirstValue2' =>
strip_tags($_GET['wxGrabber_main_values_widget_selectorFirstValue2']),'selectorSecondValue2' =>
strip_tags($_GET['wxGrabber_main_values_widget_selectorSecondValue2']),'selectorThirdValue2' =>
strip_tags($_GET['wxGrabber_main_values_widget_selectorThirdValue2']),
'weatherperiod' => strip_tags($_GET['wxGrabber_main_values_widget_weatherperiod']));
        // Output the response from your call and exit
        echo mainwxgbfunc($widgetArray);
        exit();
    } elseif (isset($_GET['wxGrabber_main_values_widget_request']) && ($_GET['wxGrabber_main_values_widget_request'] == 'some_action')) {
        // Otherwise display an error and exit the call
        
        echo "Error: Unable to display request.";
        exit();
    }
    	else { 
    	//echo 'Error Happening - All Parameters not Passed Live Updates Will not Work';
    	}
}


/********************************************************
Registering Wordpress Actions
********************************************************/

///// THE WIDGET ACTINOS	

	add_action('widgets_init', create_function('', 'return register_widget("wxGrabber_main_values_widget");'));
	
	add_action('widgets_init', create_function('', 'return register_widget("wxGrabber_current_conditions_widget");'));
	
	add_action('widgets_init', create_function('', 'return register_widget("wxGrabber_almanac_widget");'));
	
	register_activation_hook( __FILE__, array('wxGrabber_main_values_widget', 'install') );
	add_action('init', 'wxGrabber_main_values_widget_request_handler');
	
	add_shortcode( 'wxgrabber', array( 'wxgrabber_short', 'widget' ) );



//// NOW THE ADMIN HOOKS AND FUNCTIONS
	
function no_param_file(){
	$options = get_option('wxgrabber_options');
	$wviewparamslist = $options['paramFile'];
	$wviewparamslist = (ABSPATH . $wviewparamslist);
	if (!file_exists($wviewparamslist)){
    echo '<div class="error">
       <p>No Parameter file has been found for Weather-Grabber.  You or your weather server must upload phpparameter.htm to your root webfolder or make sure it is set in <a href="http://www.alberniweather.ca/developer/wp-admin/options-general.php?page=wxgrabber">Settings</a>.</p>  <p>There is a sample phpparameter.htx file in the plugin directory ready for WView or to show you the convention to create your own file. </p>
    </div>';
    }
}

function no_forecast_file(){
	$options = get_option('wxgrabber_options');
	$wviewparamslist = $options['wxgrabberforecastFile'];
	$wviewparamslistfull = (ABSPATH . $wviewparamslist);
	if (!file_exists($wviewparamslistfull) && $wviewparamslist != "" && $wviewparamslist != "NA"){
    echo '<div class="error">
       <p>No Forecast file has been found for Weather-Grabber.  You or your weather server must upload a text file that includes forecast data to your root webfolder or make sure it is set in <a href="http://www.alberniweather.ca/developer/wp-admin/options-general.php?page=wxgrabber">Settings</a>.</p>  <p>There is a sample forecast file in the plugin directory. If you have no forecast file simply leave the option blank or put NA</p>
    </div>';
    }
}

add_action('admin_notices', 'no_param_file');
add_action('admin_notices', 'no_forecast_file');

add_action( 'wp_enqueue_scripts', 'wxgb_style');  

### Function: Add Quick Tag For Poll In TinyMCE >= WordPress 2.5
/*add_action('init', 'wxgrabber_tinymce_addbuttons');
function wxgrabber_tinymce_addbuttons() {
	if(!current_user_can('edit_posts') && ! current_user_can('edit_pages')) {
		return;
	}
	if(get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "wxgrabber_tinymce_addplugin");
		add_filter('mce_buttons', 'wxgrabber_tinymce_registerbutton');
	}
}
function wxgrabber_tinymce_registerbutton($buttons) {
	array_push($buttons, 'separator', 'wxgrabber');
	return $buttons;
}
function wxgrabber_tinymce_addplugin($plugin_array) {
	if(WP_DEBUG) {
		$plugin_array['wxgrabber'] = plugins_url('wp-polls/tinymce/plugins/wxgrabber/plugin.js');
	} else {
		$plugin_array['wxgrabber'] = plugins_url('wp-polls/tinymce/plugins/wxgrabber/plugin.min.js');
	}
	return $plugin_array;
}
*/

	
	?>
