<?php
// THIS FILE IS MAINLY USED FOR SETTING UP THE WEATHERARRAY AND GETTING AND SETTING OUR INITIAL VARIABLES THROUGHOUT THE WEB APPLICATION.  INCLUDE FILES AND FUNCTIONS DO MOST OF THE DIRTY WORK.

function weathersetup($weatherperiod) {

if (0 <= $weatherperiod && $weatherperiod <= 4){
$weatherperiod = $weatherperiod;
}
else {
$weatherperiod = 0;
}
$websiteFolder = $_SERVER['DOCUMENT_ROOT'];
$options = get_option('wxgrabber_options');
$weatherArray['wordpressFolder'] = WXGRABBER_PATH;


//$jpgraphImages = $options['jpgraphimages']; //Where to put JPGraph Images Old Support for JPGraph Library removed. 
$wviewparamslist = $options['paramFile']; 	//Location of PHP Parameter File from WP Options
$wviewparamslist = (ABSPATH . $wviewparamslist);
$webServerTime = $options['webTime']; //Web Server Timezone from WP Options
$timeOffsetSymbol = $options['weatherTime']; //Wview Weather Station Timezone from WP Options

//Now Database Options (Which are optional so may or may not have anything to use.
$wviewdbtoggle = $options['wviewdbtoggle']; // Is the DB Being used or not.
$weatherArray['wviewdbtoggle'] = $wviewdbtoggle;
$userdbTableName = $options['mysqltable']; //Wview mySQL Table Name
$weatherArray['dbtableName'] = $userdbTableName; //This sets the name of the database table you are using
$mysqlpass = $options['mysqlpass'];
$mysqluser = $options['mysqluser'];
$mysqldbname = $options['mysqldbname'];
$mysqlhost = $options['mysqlhost'];

$sensors = $options['wviewsensors']; //What Sensors are you using?

$currentSys = $options['currentSys'];



// NOW WE GET THE FIRST DATA ---- THIS IS FROM THE PARAMETER FILE GENERATED BY WVIEW

/*** Grabbing 1 Minute Data from file ****/
// CHECKING THE FILE EXISTS FIRST SO WE DON'T WASTE OUR TIME!

if (file_exists($wviewparamslist)) {

$weatherdatalist = fopen($wviewparamslist, "r");
$weatherdatainitial = fgetcsv($weatherdatalist, 100000, ";");
$i = 0;

foreach($weatherdatainitial as $val) {
	
	if($i % 2) {
$weatherArray[$previousval] = $val;
//echo $previousval;
//echo $weatherArray[$previousval];
		//echo $val;
		//echo ';';
		}
	else {
	$previousval = $val;
	//echo $val;
	//echo'->';
	}
$i++;
}

date_default_timezone_set($webServerTime);
$filemodtime = date("U", filemtime($wviewparamslist)); //Get File modification time to check with current time in seconds since EPOCH
$currenttime = date("U"); // Sets the current time for comparison to uploaded file to catch delays in seconds since EPOCH.
$timedif = round((($currenttime - $filemodtime) / 60)); // The difference in minutes
$timeZoneServer = new DateTimeZone($webServerTime);
$timeZoneServerNow = new DateTime("now", $timeZoneServer);
$timeZoneLocal = new DateTimeZone($timeOffsetSymbol);
$timeZoneLocalNow = new DateTime("now", $timeZoneLocal);
$timeOffsetServerNum = $timeZoneServerNow->getOffset();
$timeOffsetServerNum = $timeOffsetServerNum / 3600;
$timeOffsetNum = $timeZoneLocalNow->getOffset();
$timeOffsetNum = $timeOffsetNum / 3600;

// Get Difference in Offets between Server and Weather
$timeServerOffsetNum = abs($timeOffsetNum) - abs($timeOffsetServerNum); 

// Now get the Plus or Minus value of the weather station offset....
if ($timeOffsetNum >= 0){
$timeOffsetSign = '+';
}
else {
$timeOffsetSign = '-';
}

//$timeServerOffsetNum = 3; //Hours Difference from your Server

//Now we're checking to make sure nothing is delayed...
$weatherArray['timedif'] = $timedif;
$timedelay = $options['timedelay'];
if ($weatherArray['timedif'] > $timedelay) {
$weatherArray['delayed'] = TRUE;
}
else {
$weatherArray['delayed'] = FALSE;
}




// NOW THAT WE HAVE DATA WE CAN START DOING STUFF.  LETS GET ALL THE FILES

require($weatherArray['wordpressFolder'] . 'include/php/includefiles.inc.php');
 




// Now populate the array with the SQL table rows:


$weatherArray['archiveTableArray'] = array('dateTime' => 'dateTime' ,'usUnits' => 'usUnits','arcInt' => 'arcInt','barometer' => 'barometer','pressure' => 'pressure','altimeter'=>'altimeter','inTemp' => 'inTemp','outTemp' => 'outTemp','inHumidity'=>'inHumidity','outHumidity'=>'outHumidity','windSpeed'=>'windSpeed','windDir'=>'windDir','windGust'=>'windGust','windGustDir'=>'windGustDir','rainRate'=>'rainRate','rain'=>'rain','dewpoint'=>'dewpoint','windchill'=>'windchill','heatindex'=>'heatindex','ET'=>'ET','radiation'=>'radiation','UV'=>'UV','extraTemp1'=>'extraTemp1','extraTemp2'=>'extraTemp2','extraTemp3'=>'extraTemp3','soilTemp1'=>'soilTemp1','soilTemp2'=>'soilTemp2','soilTemp3'=>'soilTemp3','soilTemp4'=>'soilTemp4','leafTemp1'=>'leafTemp1','leafTemp2'=>'leafTemp2','extraHumid1'=>'extraHumid1','extraHumid2'=>'extraHumid2','soilMoist1'=>'soilMoist1','soilMoist2'=>'soilMoist2','soilMoist3'=>'soilMoist3','soilMoist4'=>'soilMoist4','leafWet1'=>'leafWet1','leafWet2'=>'leafWet2','rxCheckPercent'=>'rxCheckPercent','txBatteryStatus'=>'txBatteryStatus','consBatteryVoltage'=>'consBatteryVoltage','hail'=>'hail','hailRate'=>'hailRate','heatingTemp'=>'heatingTemp','heatingVoltage'=>'heatingVoltage','supplyVoltage'=>'supplyVoltage','referenceVoltage'=>'referenceVoltage','windBatteryStatus'=>'windBatteryStatus','rainBatteryStatus'=>'rainBatteryStatus','outTempBatteryStatus'=>'outTempBatteryStatus','inTempBatteryStatus'=>'inTempBatteryStatus','tableoutTemp'=>'outTemp','tablebaromPressure'=>'baromPressure','tabledewpoint'=>'dewPoint','tableET'=>'ET','tableheatIndex'=>'heatIndex','tableinHumidity'=>'inHumidity','tableinTemp'=>'inTemp','tableoutHumidity'=>'outHumidity','tablerain'=>'rain','tablerainRate'=>'rainRate','tablesolarRadiation'=>'solarRadiation','tableUV'=>'UV','tablewindchill'=>'windChill','tablewindDir'=>'windDir','tablewindGust'=>'windGust','tablewindSpeed'=>'windSpeed', 'timeHigh'=>'timeHigh', 'timeLow'=>'timeLow');

//Now we'll stick everything in the array... eventually we're going to make more than one array so that we can be a little smarter about this.

//Now lets set up the SQL and Units variables:

$weatherArray = unitSystemfunc($weatherArray);

$weatherArray['timeOffsetSymbol'] = $timeOffsetSymbol;
$weatherArray['sensors'] = $sensors;
$weatherArray['timeOffsetSymbol'] = $timeOffsetSymbol;
if ($timeOffsetSign == '+') {
$weatherArray['mySQLDateMod'] = 'DATE_ADD';
}

else {
$weatherArray['mySQLDateMod'] = 'DATE_SUB';
}
$weatherArray['timeOffsetSign'] = $timeOffsetSign;
$weatherArray['timeOffsetNum'] = $timeOffsetNum;
$weatherArray['timeServerOffsetNum'] = $timeServerOffsetNum;
$weatherArray['timeOffsetUnixNum'] = 3600 * $weatherArray['timeOffsetNum'];
$weatherArray['timeServerOffsetUnixNum'] = 3600 * $weatherArray['timeServerOffsetNum'];
$weatherArray['offset'] = $weatherArray['timeOffsetSign'] . $weatherArray['timeOffsetNum'];
$weatherArray['UnixOffset'] = $timeOffsetSign . $weatherArray['timeOffsetUnixNum'];
$weatherArray['filemodtime'] = $filemodtime;
$weatherArray['currenttime'] = $currenttime;

//Now We'll check what time period we will be running.  Default is 24hr values but there are also weekly, monthly, yearly and Custom
$weatherArray['weatherperiod'] = $weatherperiod;
$weatherArray['almanacPeriod'] = $weatherArray['weatherperiod'];


date_default_timezone_set($timeOffsetSymbol);

$weatherArray['db'] = new wxg_mysqli($mysqlhost, $mysqluser, $mysqlpass, $mysqldbname);

if ($weatherArray['sensors'] == 0){ //Checking for Standard (0) vs. Extended (1) sensors/mode...
	if ($wviewdbtoggle == 1) { // DATABASE OPTION IS CHECKED?
	
	$weatherArray = dbstandardrun($weatherArray); //LOTS TO DO dbrun.inc.php
	$weatherArray['db']->close();
	
	}//END DATABASE CHECK
}// END SENSORS 0 IF

else { 
		if ($wviewdbtoggle == 1) { 
		$weatherArray = dbextendedrun($weatherArray); //LOTS TO DO HERE in dbrun.inc.php
		$weatherArray['db']->close();
		}
		//$weatherArray = dayTempChillHeat($weatherArray);
		
		
}// END OF SENSORS 1

/**************************** END OF DATABASE QUERY SECTION *******************/ 


		switch ($currentSys) {
		
		 
		/**First We'll set the units we want for the System selected Canadian Metric is first, this does not affect "default" which is set in the header.  For each system, we make the necessary entries in the Array for the Units... then we do any conversions we need to do. **/
		
		case '1': //Canadian Metric Units (Default)
		// First do the Units 
			
			$weatherArray['tempUnit'] = $weatherArray['Units']['TempUnits'][0];
			$weatherArray['humUnit'] = $weatherArray['Units']['HumidUnits'][0];
			$weatherArray['rainUnit'] = $weatherArray['Units']['RainUnits'][0];
			$weatherArray['rateUnit'] = $weatherArray['Units']['RainRateUnits'][0];
			$weatherArray['windUnit'] = $weatherArray['Units']['WindUnits'][1];
			$weatherArray['cumulusBaseUnit'] = $weatherArray['Units']['DistanceUnits'][0];
			$weatherArray['barUnit'] = $weatherArray['Units']['BaromUnits'][0];
			$weatherArray['airDensityUnit'] = $weatherArray['Units']['AirDensityUnit'][0];
			$weatherArray['solarUnit'] = $weatherArray['Units']['SolarUnit'][0];
			$weatherArray['windPowerUnit'] = $weatherArray['Units']['WindPowerUnit'][0];
			$weatherArray['windRunUnit'] = $weatherArray['Units']['DistanceUnits'][5];
			$weatherArray['Sys'] = $weatherArray['Units']['UnitsSystem'][0]; 
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calcSolarPotential($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			$weatherArray = setcssalert($weatherArray);
			
		
			//Now Starting to Convert values...
		
			//Barometer Conversions
			$weatherArray = convertdataBaromtokPa($weatherArray, 1);
			
			//CumulusBase Conversion - And Calculation for Non-Working in WView 3.3
			$weatherArray = cumulusBase($weatherArray);
			
			$weatherArray = convertdataftttometer($weatherArray);
			
			//Check Chill/Heat
			$weatherArray = hidechillheat($weatherArray);
			
			//Change Times
			

			$weatherArray = OFFSETtimes($weatherArray);
			
			
			break;	
			
		case '2': //Defining US Imperial System Units

			$weatherArray = setcssalert($weatherArray);
			
			$weatherArray['tempUnit'] = $weatherArray['Units']['TempUnits'][1];
			$weatherArray['humUnit'] = $weatherArray['Units']['HumidUnits'][0];
			$weatherArray['rainUnit'] = $weatherArray['Units']['RainUnits'][2];
			$weatherArray['rateUnit'] = $weatherArray['Units']['RainRateUnits'][2];
			$weatherArray['windUnit'] = $weatherArray['Units']['WindUnits'][2];
			$weatherArray['cumulusBaseUnit'] = $weatherArray['Units']['DistanceUnits'][3];
			$weatherArray['barUnit'] = $weatherArray['Units']['BaromUnits'][3];
			$weatherArray['airDensityUnit'] = $weatherArray['Units']['AirDensityUnit'][1];
			$weatherArray['solarUnit'] = $weatherArray['Units']['SolarUnit'][1];
			$weatherArray['windPowerUnit'] = $weatherArray['Units']['WindPowerUnit'][1];
			$weatherArray['windRunUnit'] = $weatherArray['Units']['DistanceUnits'][1];
			$weatherArray['Sys'] = $weatherArray['Units']['UnitsSystem'][3];
		
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calcSolarPotential($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			$weatherArray = setcssalert($weatherArray);
			
		
			//Now Starting to Convert values...
			
			//Cloud Base Conversion Must come before any temp or dew conversions because it is calculated independant of wview data due to bug in wview 3.3
			$weatherArray = cumulusBase($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			//Temperature/Dew/Chill/Heat Conversions
			$weatherArray = convertdataCtoF($weatherArray);
			
			//Barometer Conversions
			$weatherArray = convertdataBaromtoInch($weatherArray, 1);
			
			//Rain Conversions
			$weatherArray = convertdataMMtoInch($weatherArray);
			
			//Wind Conversions
			$weatherArray = convertdatakphtomph($weatherArray);
			
			//WindRun Conversions
			$weatherArray = convertdatakmttomiles($weatherArray);
			
			//Air Density Conversion
			$weatherArray = convertdatakgtolbs($weatherArray);
			
			//CloudBase Meters conversion
			$weatherArray = convertdatameterttoft($weatherArray);
			
			//Watts per Meter to Inch
			$weatherArray = convertdatawattMetertoft($weatherArray);
			
			//Check Chill/Heat
			$weatherArray = hidechillheat($weatherArray);
			
			//Change Times
			$weatherArray = OFFSETtimes($weatherArray);		
			
		
		break;
		
		case '3': //Defining UK Metric System Units
			
			$weatherArray = setcssalert($weatherArray);
			
			$weatherArray['tempUnit'] = $weatherArray['Units']['TempUnits'][0];
			$weatherArray['humUnit'] = $weatherArray['Units']['HumidUnits'][0];
			$weatherArray['rainUnit'] = $weatherArray['Units']['RainUnits'][0];
			$weatherArray['rateUnit'] = $weatherArray['Units']['RainRateUnits'][0];
			$weatherArray['windUnit'] = $weatherArray['Units']['WindUnits'][2];
			$weatherArray['cumulusBaseUnit'] = $weatherArray['Units']['DistanceUnits'][3];
			$weatherArray['barUnit'] = $weatherArray['Units']['BaromUnits'][2];
			$weatherArray['airDensityUnit'] = $weatherArray['Units']['AirDensityUnit'][1];
			$weatherArray['solarUnit'] = $weatherArray['Units']['SolarUnit'][0];
			$weatherArray['windPowerUnit'] = $weatherArray['Units']['WindPowerUnit'][0];
			$weatherArray['windRunUnit'] = $weatherArray['Units']['DistanceUnits'][1];
			$weatherArray['Sys'] = $weatherArray['Units']['UnitsSystem'][4]; 
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calcSolarPotential($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			$weatherArray = setcssalert($weatherArray);
			
			//Cloud Base Conversion Must come before any temp or dew conversions
			$weatherArray = cumulusBase($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Now Starting to Convert values...
			//Wind Conversions
			$weatherArray = convertdatakphtomph($weatherArray);
			
			//Air Density Conversion
			$weatherArray = convertdatakgtolbs($weatherArray);
			
			//WindRun Conversions
			$weatherArray = convertdatakmttomiles($weatherArray);
			
			$weatherArray = convertdataBaromtokPa($weatherArray, 0); //Don't actually need any conversion... but will run it through anyway to strip out the automatic barometer trend.
			
			//CloudBase Meters conversion
			$weatherArray = convertdatameterttoft($weatherArray);
			
			//Check Chill/Heat
			$weatherArray = hidechillheat($weatherArray);
			
			//Change Times
			$weatherArray = OFFSETtimes($weatherArray);
			
		break;
						
		case '4': //Defining Nautical System Units
			
			$weatherArray = setcssalert($weatherArray);
			
			$weatherArray['tempUnit'] = $weatherArray['Units']['TempUnits'][0];
			$weatherArray['humUnit'] = $weatherArray['Units']['HumidUnits'][0];
			$weatherArray['rainUnit'] = $weatherArray['Units']['RainUnits'][0];
			$weatherArray['rateUnit'] = $weatherArray['Units']['RainRateUnits'][0];
			$weatherArray['windUnit'] = $weatherArray['Units']['WindUnits'][4];
			$weatherArray['cumulusBaseUnit'] = $weatherArray['Units']['DistanceUnits'][3];
			$weatherArray['barUnit'] = $weatherArray['Units']['BaromUnits'][2];
			$weatherArray['airDensityUnit'] = $weatherArray['Units']['AirDensityUnit'][1];
			$weatherArray['solarUnit'] = $weatherArray['Units']['SolarUnit'][0];
			$weatherArray['windPowerUnit'] = $weatherArray['Units']['WindPowerUnit'][0];
			$weatherArray['windRunUnit'] = $weatherArray['Units']['DistanceUnits'][4];
			$weatherArray['Sys'] = $weatherArray['Units']['UnitsSystem'][2]; 
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calcSolarPotential($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			$weatherArray = setcssalert($weatherArray);
			
			//Cloud Base Conversion Must come before any temp or dew conversions because it is calculated independant of wview data due to bug in wview 3.3
			$weatherArray = cumulusBase($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Wind Conversions
			$weatherArray = convertdatakphtoknot($weatherArray);
			
			//Air Density Conversion
			$weatherArray = convertdatakgtolbs($weatherArray);
			
			//WindRun Conversions
			$weatherArray = convertdatakmttonautmiles($weatherArray);
			
			//Barometer Conversion
			$weatherArray = convertdataBaromtokPa($weatherArray, 0); //Don't actually need any conversion... but will run it through anyway to strip out the automatic barometer trend.
			
			//CloudBase Meters conversion
			$weatherArray = convertdatameterttoft($weatherArray);
			
			//Check Chill/Heat
			$weatherArray = hidechillheat($weatherArray);
			
			//Change Times
			$weatherArray = OFFSETtimes($weatherArray);
			
			break;
			
		case '5': //Defining European Metric System Units
			
			$weatherArray = setcssalert($weatherArray);
			
			$weatherArray['tempUnit'] = $weatherArray['Units']['TempUnits'][0];;
			$weatherArray['humUnit'] = $weatherArray['Units']['HumidUnits'][0];
			$weatherArray['rainUnit'] = $weatherArray['Units']['RainUnits'][0];
			$weatherArray['rateUnit'] = $weatherArray['Units']['RainRateUnits'][0];
			$weatherArray['windUnit'] = $weatherArray['Units']['WindUnits'][1];
			$weatherArray['cumulusBaseUnit'] = $weatherArray['Units']['DistanceUnits'][0];
			$weatherArray['windRunUnit'] = $weatherArray['Units']['DistanceUnits'][5];
			$weatherArray['barUnit'] = $weatherArray['Units']['BaromUnits'][1];
			$weatherArray['airDensityUnit'] = $weatherArray['Units']['AirDensityUnit'][0];
			$weatherArray['solarUnit'] = $weatherArray['Units']['SolarUnit'][0];
			$weatherArray['windPowerUnit'] = $weatherArray['Units']['WindPowerUnit'][0];
			$weatherArray['Sys'] = $weatherArray['Units']['UnitsSystem'][1]; 
			
			
			//Solar Power Density Calculations
			$weatherArray = calcSolarPotential($weatherArray);
			
			$weatherArray = setcssalert($weatherArray);
			//Cloud Base Conversion
			$weatherArray = cumulusBase($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			$weatherArray = convertdataftttometer($weatherArray);
			
			$weatherArray = convertdataBaromtokPa($weatherArray, 0); //Don't actually need any conversion... but will run it through anyway to strip out the automatic barometer trend.
			
			//Check Chill/Heat
			$weatherArray = hidechillheat($weatherArray);
			
			
			//Change Times
			$weatherArray = OFFSETtimes($weatherArray);
			
		break;
		
		case '6': //Defining Scientific Metric System Units
			
			$weatherArray = setcssalert($weatherArray);
			
			$weatherArray['tempUnit'] = $weatherArray['Units']['TempUnits'][0];;
			$weatherArray['humUnit'] = $weatherArray['Units']['HumidUnits'][0];
			$weatherArray['rainUnit'] = $weatherArray['Units']['RainUnits'][0];
			$weatherArray['rateUnit'] = $weatherArray['Units']['RainRateUnits'][0];
			$weatherArray['windUnit'] = $weatherArray['Units']['WindUnits'][0];
			$weatherArray['cumulusBaseUnit'] = $weatherArray['Units']['DistanceUnits'][0];
			$weatherArray['windRunUnit'] = $weatherArray['Units']['DistanceUnits'][5];
			$weatherArray['barUnit'] = $weatherArray['Units']['BaromUnits'][1];
			$weatherArray['airDensityUnit'] = $weatherArray['Units']['AirDensityUnit'][0];
			$weatherArray['solarUnit'] = $weatherArray['Units']['SolarUnit'][0];
			$weatherArray['windPowerUnit'] = $weatherArray['Units']['WindPowerUnit'][0];
			$weatherArray['Sys'] = $weatherArray['Units']['UnitsSystem'][1]; 
		
		//Cloud Base Conversion Must come before any temp or dew conversions because it is calculated independant of wview data due to bug in wview 3.3
			$weatherArray = cumulusBase($weatherArray);
			
		//Calculate Freezing Level first before any temp conversions
			$weatherArray = calculateFreezingLevel($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calculateWindPowerDensity($weatherArray);
			
			//Wind Power Density Calculations
			$weatherArray = calcSolarPotential($weatherArray);
			
			$weatherArray = setcssalert($weatherArray);
		//Wind Conversions
			$weatherArray = convertdatakphtomps($weatherArray);
			
			$weatherArray = convertdataBaromtokPa($weatherArray, 0); //Don't actually need any conversion... but will run it through anyway to strip out the automatic barometer trend.
			
		//Cloud Base and Meter to Foot Conversion
			$weatherArray = convertdataftttometer($weatherArray);
			
			//Check Chill/Heat
			$weatherArray = hidechillheat($weatherArray);
			
			//Change Times
			$weatherArray = OFFSETtimes($weatherArray);
			
		break;
		
		}
}

//} //END OF USER DATABASE CHECKBOX OPTION
return $weatherArray;
} //END Weathersetup function

?>