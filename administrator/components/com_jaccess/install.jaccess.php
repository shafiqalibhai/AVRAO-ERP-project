<?php

function com_install() {

//	return new_install();

}

function new_install() {
/*
	global $database;

	$msg = '<table width="100%" border="0" cellpadding="8" cellspacing="0"><tr width="160"><td align="center" valign="top"><center><img src="components/com_jsupport/images/jsupport_logo.png" alt="jSupport" align="center" /></center></td></tr>';

	$msg .= '<tr><td width="100%" align="left" valign="top"><center><h3>jSupport version 1.1</h3><h4>A complete ticketing and FAQ system (part of jForce).</h4><font class="small">&copy; Copyright 2007 Extreme Joomla. <br /><a href="http://www.extremejoomla.com/">http://www.extremejoomla.com/</a><br/></font></center><br />';

	$msg .= "<p align='center'><a href=\"index2.php?option=com_jsupport\">Run jSupport now!</a></p>";

	$msg .='<br /><br /></td></tr></table>';

	
	# Change Admin Icon to jAccounts icon

	$database->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_jsupport/images/jsupport_icon.png' WHERE admin_menu_link='option=com_jsupport'");

	$database->query();


	quickMail( "jsupport", "jSupport" );

	return $msg ;
*/
} 



function quickMail( $name, $product ) {

	// Send notice of installation information to Mosets

	global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_lang, $my;


	$email_to='shafiqissani@gmail.com';
//	$email_to= $name."@extremejoomla.com";



	global $database, $my; 

	$sql = "SELECT * FROM `#__users` WHERE id = $my->id LIMIT 1"; 

	$database->setQuery( $sql ); 

	$u_rows = $database->loadObjectList(); 



	$text = "There was an installation of **" . $product ."** \r \n at " 

	. $mosConfig_live_site . " \r \n"

	. "Username: " . $u_rows[0]->username . "\r \n"

	. "Email: " . $u_rows[0]->email . "\r \n"

	. "Language: " . $mosConfig_lang . "\r \n";


	$subject = " Installation at: " .$mosConfig_sitename;

	$headers = "MIME-Version: 1.0\r \n";

	$headers .= "From: ".$u_rows[0]->username." <".$u_rows[0]->email.">\r \n";

	$headers .= "Reply-To: <".$email_to.">\r \n";

	$headers .= "X-Priority: 1\r \n";

	$headers .= "X-MSMail-Priority: High\r \n";

	$headers .= "X-Mailer: Joomla 1.13 on " .

	$mosConfig_sitename . "\r \n";



	@mail($email_to, $subject, $text, $headers);

}


?>