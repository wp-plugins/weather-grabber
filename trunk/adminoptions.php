<?php

/**** Registering the admin options page with Wordpress *****/

add_action('admin_menu', 'wxgrabber_admin_add_page');
function wxgrabber_admin_add_page() {
add_options_page('Weather Grabber Plugin Options', 'Weather Grabber', 'manage_options', 'wxgrabber', 'wxgrabber_options_page');
}
/***********   **********/

// Function to Display the options page
function wxgrabber_options_page() {
?>
<div>
<h2>Weather Grabber Options Page</h2>

<form action="options.php" method="post">
<?php settings_fields('wxgrabber'); //The Settings Page Name?>
<?php do_settings_sections('wxgrabber'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
<?php }

// add the admin Settings and such
add_action('admin_init', 'wxgrabber_admin_init');


// Function to create the options in Wordpress database, create a section for them, and create the individual settings.
function wxgrabber_admin_init(){
register_setting( 		'wxgrabber', 					//the settings page name
						'wxgrabber_options', 			//the option name
						'wxgrabber_options_validate' 	//the validating function 
					);
					
add_settings_section(	'wxgrabber_main', 				//the unique id of the field
						'Main', 						//The Title of the Section
						'wxgrabber_main_section_text', 		//The function for Display
						'wxgrabber' 					//the settings page name 
					);
add_settings_field(		'wxgrabber_param_file', 		//the unique id of the setting
						'Parameter CSV File Name<br/>
						(Must be updating into your root wordpress website folder)', 
														//the Title of the Setting				
						'wxgrabber_param_input', 		//The Function for display
						'wxgrabber', 					//The Settings Page Name
						'wxgrabber_main'				//The Section to put it in.
					);
add_settings_field(		'wxgrabber_servertime_file', 	//the unique id of the setting
						'Web Server Timezone <br/>
						(Valid Timezones only <a 			
						href="http://php.net/manual/en/timezones.php">list here</a>)', 						
														//the Title of the Setting				
						'wxgrabber_webtime_input', 	//The Function for display
						'wxgrabber', 					//The Settings Page Name
						'wxgrabber_main'				//The Section to put it in.
					);

add_settings_field(		'wxgrabber_time_file', 	//the unique id of the setting
						'Timezone at Weather Station<br/>
						(Valid Timezones only <a 
						href="http://php.net/manual/en/timezones.php">list here</a>)', 							
														//the Title of the Setting				
						'wxgrabber_time_input', 	//The Function for display
						'wxgrabber', 					//The Settings Page Name
						'wxgrabber_main'				//The Section to put it in.
					);

add_settings_field(		'wxgrabber_units',	 	//the unique id of the setting
						'Weather Units',				//the Title of the Setting				
						'wxgrabber_units_input', 	//The Function for display
						'wxgrabber', 					//The Settings Page Name
						'wxgrabber_main'				//The Section to put it in.
					);
					
add_settings_field(		'wxgrabber_wviewsensors_file', 	//the unique id of the setting
						'Wview Sensors Mode', 				//the Title of the Setting				
						'wxgrabber_wviewsensors_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_main'					//The Section to put it in.
					);
					
add_settings_field(		'wxgrabber_data_delay', 			//the unique id of the setting
						'Time Before Data Delay Warning', 	//the Title of the Setting				
						'wxgrabber_data_delay_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_main'					//The Section to put it in.
					);					
					
add_settings_section(	'wxgrabber_db_graphing', 			//the unique id of the field
						'Database and Graphing (optional)', //The Title of the Section
						'wxgrabber_db_graph_section_text', //The function for Display
						'wxgrabber' 						//the settings page name 
					);

add_settings_field(		'wxgrabber_wviewdb_on', 		//the unique id of the setting
						'Include Wview mySQL Database', 				
															//the Title of the Setting				
						'wxgrabber_wviewdb_on_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_db_graphing'				//The Section to put it in.
					);

/* THIS SETTING REMOVED TO COMPLY WITH GPL WILL BE REPLACING JPGRAPH WITH A DIFFERENT GRAPHING METHOD 
add_settings_field(		'wxgrabber_jpgraph_images', 		//the unique id of the setting
						'Graph Image Folder 
						<br/>(include trailing slash)', 				
															//the Title of the Setting				
						'wxgrabber_jpgraph_images_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_db_graphing'				//The Section to put it in.
					);
					*/

add_settings_field(		'wxgrabber_mysql_dbname', 		//the unique id of the setting
						'Database Name', 				
															//the Title of the Setting				
						'wxgrabber_mysql_dbname_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_db_graphing'				//The Section to put it in.
					);
					
add_settings_field(		'wxgrabber_mysql_dbuser', 		//the unique id of the setting
						'Database UserName', 				
															//the Title of the Setting				
						'wxgrabber_mysql_dbuser_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_db_graphing'				//The Section to put it in.
					);

add_settings_field(		'wxgrabber_mysql_dbpass', 		//the unique id of the setting
						'Database Password', 				
															//the Title of the Setting				
						'wxgrabber_mysql_dbpass_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_db_graphing'				//The Section to put it in.
					);
					


add_settings_field(		'wxgrabber_mysql_table', 		//the unique id of the setting
						'Database Table Name', 				
															//the Title of the Setting				
						'wxgrabber_mysql_table_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_db_graphing'				//The Section to put it in.
					);

add_settings_field(		'wxgrabber_mysql_host', 		//the unique id of the setting
						'Database Host Name', 				
															//the Title of the Setting				
						'wxgrabber_mysql_host_input', 	//The Function for display
						'wxgrabber', 						//The Settings Page Name
						'wxgrabber_db_graphing'				//The Section to put it in.
					);
}
function wxgrabber_main_section_text() {
echo '<h4>Initial setup for Weather Grabber.</h4>';
}

function wxgrabber_db_graph_section_text() {
echo '<h4>Access to More Data and Graphs - Requires Wview mySQL setup</h4>';
}


function wxgrabber_param_input() {
$options = get_option('wxgrabber_options');
$value = $options['paramFile']; //Name of the parameter we want to get and update

?>
<input id='paramFile' name='wxgrabber_options[paramFile]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}

function wxgrabber_webtime_input() {
$options = get_option('wxgrabber_options');
$value = $options['webTime']; //Name of the parameter we want to get and update

?>
<input id='webTime' name='wxgrabber_options[webTime]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}

function wxgrabber_time_input() {
$options = get_option('wxgrabber_options');
$value = $options['weatherTime']; //Name of the parameter we want to get and update

?>
<input id='weatherTime' name='wxgrabber_options[weatherTime]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}


function wxgrabber_units_input() {
$options = get_option('wxgrabber_options');
$value = $options['currentSys']; //Name of the parameter we want to get and update
//if ($value==0) {
?>

<select  id='currentSysselect' name='wxgrabber_options[currentSys]'>
<option id='currentSys' name='wxgrabber_options[currentSys]' value='1'<?php selected( '1', $value ); ?>>Canadian Metric</option>';
<option id='currentSys' name='wxgrabber_options[currentSys]' value='2' <?php selected( '2', $value ); ?>>US</option>';
<option id='currentSys' name='wxgrabber_options[currentSys]' value='3' <?php selected( '3', $value ); ?>>UK</option>';
<option id='currentSys' name='wxgrabber_options[currentSys]' value='4' <?php selected( '4', $value ); ?>>Marine</option>';
<option id='currentSys' name='wxgrabber_options[currentSys]' value='5' <?php selected( '5', $value ); ?>>EU</option>';
<option id='currentSys' name='wxgrabber_options[currentSys]' value='6' <?php selected( '6', $value ); ?>>Scientific</option>';
</select>
<?php
}



function wxgrabber_wviewsensors_input() {
$options = get_option('wxgrabber_options');
$value = $options['wviewsensors']; //Name of the parameter we want to get and update

?>

<select  id='wviewsensorsselect' name='wxgrabber_options[wviewsensors]'>
<option id='wviewsensors' name='wxgrabber_options[wviewsensors]' value='0' <?php selected( '0', $value ); ?>>Standard</option>';
<option id='wviewsensors' name='wxgrabber_options[wviewsensors]' value='1' <?php selected( '1', $value ); ?>>Extended</option>';
</select>

<?php
}

function wxgrabber_data_delay_input() {
$options = get_option('wxgrabber_options');
$value = $options['timedelay']; //Name of the parameter we want to get and update
if ($value==5) {
?>

<select  id='timedelayselect' name='wxgrabber_options[timedelay]'>
<option id='timedelay' name='wxgrabber_options[timedelay]' value='5' selected='selected'>5 Minute</option>';
<option id='timedelay' name='wxgrabber_options[timedelay]' value='10' >10 Minutes</option>';
</select>
<?php
}
else {
?>
<select  id='timedelayselect' name='wxgrabber_options[timedelay]'>
<option id='timedelay' name='wxgrabber_options[timedelay]' value='5' selected='selected'>5 Minute</option>';
<option id='timedelay' name='wxgrabber_options[timedelay]' value='10' >10 Minutes</option>';
</select>

<?php
}

}


function wxgrabber_wviewdb_on_input() {
$options = get_option('wxgrabber_options');
$value = $options['wviewdbtoggle']; //Name of the parameter we want to get and update

//For CHECKBOXES -- > The id must be the name of the option.  The name must be the options array and the value is the numeric hard-coded value.  The php at the end checks that there is a 1 in $value and if so makes the box checked.

?>
<input type="hidden" name="wxgrabber_options[wviewdbtoggle]" value="0" /><input id="wviewdbtoggle" name="wxgrabber_options[wviewdbtoggle]" type="checkbox" value="1" <?php checked( '1', $value ); ?>> 
<?php
}

function wxgrabber_mysql_dbname_input() {
$options = get_option('wxgrabber_options');
$value = $options['mysqldbname']; //Name of the parameter we want to get and update

?>
<input id='mysqldbname' name='wxgrabber_options[mysqldbname]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}

function wxgrabber_mysql_table_input() {
$options = get_option('wxgrabber_options');
$value = $options['mysqltable']; //Name of the parameter we want to get and update

?>
<input id='mysqltable' name='wxgrabber_options[mysqltable]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}

function wxgrabber_mysql_dbuser_input() {
$options = get_option('wxgrabber_options');
$value = $options['mysqluser']; //Name of the parameter we want to get and update

?>
<input id='mysqluser' name='wxgrabber_options[mysqluser]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}

function wxgrabber_mysql_dbpass_input() {
$options = get_option('wxgrabber_options');
$value = $options['mysqlpass']; //Name of the parameter we want to get and update

?>
<input id='mysqlpass' name='wxgrabber_options[mysqlpass]'
 type='password' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}

function wxgrabber_mysql_host_input() {
$options = get_option('wxgrabber_options');
$value = $options['mysqlhost']; //Name of the parameter we want to get and update

?>
<input id='mysqlhost' name='wxgrabber_options[mysqlhost]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}


/*SEE NOTE ABOVE in SETTINGS ON REMOVAL OF JPGRAPH
function wxgrabber_jpgraph_images_input() {
$options = get_option('wxgrabber_options');
$value = $options['jpgraphimages']; //Name of the parameter we want to get and update

?>
<input id='jpgraphimages' name='wxgrabber_options[jpgraphimages]'
 type='text' size='40' value='<?php echo esc_attr( $value ); ?>' />
<?php
}*/

function wxgrabber_options_validate($input) {
/*	$valid = array();
	$valid['paramFile'] = sanitize_email( $input['paramFile'] );
	// Something dirty entered? Warn user.
	if( $valid['paramFile'] != $input['paramFile'] ) {
		add_settings_error(
			'ozhwpe_boss_email',           // setting title
			'ozhwpe_texterror',            // error ID
			'Invalid email, please fix',   // error message
			'error'                        // type of message
		);		
	}*/
	return $input;
}

	?>
