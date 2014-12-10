<?php 
function short_wx_func ($atts, $widgetArray, $weatherArray) {


      $atts = shortcode_atts( array(
 	      'wx' => '0'
      ), $atts );

if ($atts['wx'] == '0') {
      $error = "You forgot to tell us which value you wanted.  Shortcodes should look like: '[wxgrabber wx='outsideTemp'].  Consult phpparameter list file to see all available values";

return $error; 

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
	
$weatherArray = weathersetup($widgetArray['weatherperiod']);
$output = short_wx_func($atts, $widgetArray,$weatherArray);
return $output;
}

} //END OF THE MAIN  WIDGET CLASS
?>