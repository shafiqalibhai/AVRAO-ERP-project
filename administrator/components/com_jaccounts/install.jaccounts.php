<?php

function com_install() {

	return new_install();

}

function new_install() {
	$database = & JFactory::getDBO();

	$msg = '<table width="100%" border="0" cellpadding="8" cellspacing="0"><tr width="160"><td align="center" valign="top"><center><img src="components/com_jaccounts/images/jaccounts_logo.png" alt="jAccounts" align="center" /></center></td></tr>';

	$msg .= '<tr><td width="100%" align="left" valign="top"><center><h3>Accounts version 1.2</h3><h4>A complete quoting and invoicing system.</h4><font class="small">&copy; Copyright 2008 Igenx Solutions <br /><a href="http://www.igenxsolutions.com/">http://www.igemxsolutions.com/</a><br/></font></center><br />';

	$msg .= "<p align='center'><a href=\"index2.php?option=com_jAccounts\">Run Accounts now!</a></p>";

	$msg .='<br /><br /></td></tr></table>';

	
	# Change Admin Icon to jAccounts icon

	//quickMail( "jaccounts", "jAccounts" );

	return $msg ;

} 



function quickMail( $name, $product ) {

	// Send notice of installation information to Mosets

	global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_lang, $my;



	$email_to= "shafiqissani@gmail.com";



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