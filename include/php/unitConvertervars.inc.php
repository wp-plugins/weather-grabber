<?php
/************ USER DEFINEABLE FUNCTIONS ************
CAREFUL what you do here, but it should be fairly self explanatory, strings are editable if you like Mostly, you'll only want to edit the first grouping of variables immediately following this message.
******************/





/************ END USER DEFINEABLE FUNCTIONS ************/



/** the "weather period" variable affects the data that is fetched from the database.  By Default (0), only 24hr data is fetched.  24hr data is *always* fetched regardless of query in order to maintain accuracy of up-to-the-minute reports.  These built-in fetches supply all data for time period, for all variables.  Since "Custom" can be any length of time, there is a hard limit of 1 query for one variable per client request on the database query (LIMIT 1).

Other possibilities are listed here:

$weatherperiod == 0 : 24hr data only, all variables
$weatherperiod == 1 : Weekly, 7 day, data + 24hr, all variables
$weatherperiod == 2 : Monthly, 30 day data + 24hr, all variables
$weatherperiod == 3 : Yearly, 265 day data + 24hr, all variables
$weatherperiod == 4 : Custom, Any period, ONE VARIABLE.

/***
First we need to define Units we want to be able to use.. each type of unit is inserted into its own array.  To add a Unit for any of the generic values simply stick it on the end of the list and increment the number then you can reference it in the case statements below.
****/

function unitSystemfunc($weatherArray) {

	$weatherArray['Units']['TempUnits'] = Array('&deg; C','&deg; F','K');
	
	$weatherArray['Units']['RainUnits'] = Array('mm','cm','in');
	
	$weatherArray['Units']['RainRateUnits'] = Array('mm/hr','cm/hr','in/hr');
	
	$weatherArray['Units']['WindUnits'] = Array('m/s','km/h','mph','ft/s','knots');
	
	$weatherArray['Units']['DistanceUnits'] = Array('m','miles','in','ft','nm','');

	$weatherArray['Units']['BaromUnits'] = Array('kPa','hPa','mb','in');

	$weatherArray['Units']['HumidUnits'] = Array('%');

	$weatherArray['Units']['AirDensityUnit'] = Array('kg/m<sup>3</sup>','lbs/ft<sup>3</sup>');
	
	$weatherArray['Units']['SolarUnit'] = Array('W/m<sup>2</sup>','W/in<sup>2</sup>');
	
	$weatherArray['Units']['WindPowerUnit'] = Array('W/m<sup>-2</sup>','W/in<sup>-2</sup>');
	
	$weatherArray['Units']['UnitsSystem'] = Array('Canada Metric','Global Metric','Nautical','US Imperial','UK Metric');
	
	
	

	$wviewSQLdailydata = array("OutTemp","HiOutTemp","LowOutTemp","InTemp","Barometer","OutHumid","InHumid","Rain","HiRainRate","Rain24HourlySum","Rain24HourlyTime","RainPeriodSum","WindSpeed","HiWindSpeed","WindDir","HiWindDir","Dewpoint","WindChill","HeatIndex","RecordTime");
	
	$weatherArray['SQLData'] = $wviewSQLdailydata;
	$weatherArray['SQLDataWeekly'] = $wviewSQLdailydata;
	
	$weatherArray['subArrayHolder'] = Array('NA');

return $weatherArray;
}

	
	

function dateSelector($useDate=0, $startYear, $isEnd)
{ 	
	// if date invalid or not supplied, use current time 
	
	$monthName = array(1=> "Jan",  "Feb",  "Mar", 
         "Apr",  "May",  "Jun",  "Jul",  "Aug", 
          "Sep",  "Oct",  "Nov",  "Dec"); 
          
	if($useDate == 0) {
		$useDate = Time();
	}	
	
	if($isEnd == 1) {
		$isEnd = 'END';
	}
	
	else {
	$isEnd = '';
	}
	
	// make month selector 
	//echo "<select name=\"month" . $isEnd . "\">";
	for($currentMonth = 1; $currentMonth <= 12; $currentMonth++)
	{
	//echo "<option value='";
	
	$hold = $currentMonth; //STORE THE ORIGINAL NUMBER
	if ($currentMonth < 10) { // NEED TO ADD LEADING ZEROS FOR MYSQL	
	$currentMonth = '0' . $currentMonth; //CREATE THE NEW STRING
	}
	
	//echo $currentMonth;
	
	
	//echo "'";
	$currentMonth = $hold;
	//echo ">" . $monthName[$currentMonth] . "</option>";
	}
	//echo "<option value='--' selected='selected' >--</option></select>/ ";
	
	// make day selector 
	//echo "<select name=\"day" . $isEnd . "\">\n";
	for($currentDay=1; $currentDay <= 31; $currentDay++)
	{
	$hold = $currentDay; //STORE THE ORIGINAL NUMBER
	if ($currentDay < 10) { // NEED TO ADD LEADING ZEROS FOR MYSQL	
	$currentDay = '0' . $currentDay; //CREATE THE NEW STRING
	}
	
	//echo "<option value=\"$currentDay\"";
	//echo ">$currentDay</option>";
	$currentDay = $hold;
	}
	//echo "<option value='--' selected='selected' >--</option></select> / ";
	
	// make year selector 
	//echo "<select name=\"year" . $isEnd . "\">\n";
	$currentYear = date('Y');
	for($startYear = $startYear; $startYear <= $currentYear;$startYear++) 
	{
		//echo "<option value=\"$startYear\"";
		//echo ">$startYear</option>";
	}

	//echo "<option value='--' selected='selected' >--</option></select>  @ ";
	
	// make hour selector 
	//echo "<select name=\"hour" . $isEnd . "\">\n";
	for($currentHour=0; $currentHour <= 23; $currentHour++)
	{
		$hold = $currentHour; //STORE THE ORIGINAL NUMBER
		if ($currentHour < 10) { // NEED TO ADD LEADING ZEROS FOR MYSQL	
			$currentHour = '0' . $currentHour; //CREATE THE NEW STRING
		}
		//echo "<option value=\"$currentHour\"";
		//echo ">$currentHour</option>";
		$currentHour = $hold;
	}
	
	//echo "<option value='--' selected='selected' >--</option></select>:";
	
	// make minute selector 
	//echo "<select name=\"minute" . $isEnd . "\">\n";
	for($currentMinute=0; $currentMinute <= 55; $currentMinute++)
	{
		if ($currentMinute % 5 == 0) {
			$hold = $currentMinute; //STORE THE ORIGINAL NUMBER
			if ($currentMinute < 10) { // NEED TO ADD LEADING ZEROS FOR MYSQL	
				$currentMinute = '0' . $currentMinute; //CREATE THE NEW STRING
			}
			//echo "<option value=\"$currentMinute\"";
			//echo ">$currentMinute</option>";
			$currentMinute = $hold;
		}
		
	}
	//echo "<option value='' selected='selected' >--</option></select> ";

} // END OF FUNCTION	

?>