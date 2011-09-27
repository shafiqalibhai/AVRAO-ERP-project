<?php

// no direct access
	defined( '_JEXEC' ) or die( 'Restricted access' );
	
	
	
	
	
// Get the location parameter that was set in the Module Manager
	$letter1 = $params->get('content1', 0);
// Set a formatted date string
	//$myDateTime = date("l, F dS, Y");
// Output the greeting
	//echo '<input name="name" type="text" value="name" size="10" maxlength="50" />';
	include ("form1.html");
	
	echo '';
	
?>