<?php

function com_install() {

	return new_install();

}

function new_install() {

	$database = & JFactory::getDBO();

	$database->setQuery("INSERT INTO `#__menu` (`id`, `menutype`, `name`, `link`, `type`, `published`, `parent`, `componentid`, `sublevel`, `ordering`, `checked_out`, `checked_out_time`, `pollid`, `browserNav`, `access`, `utaccess`, `params`) VALUES ('', 'usermenu', 'My Projects', 'index.php?option=com_jprojects&task=myProjects', 'url', 1, 0, 0, 0, 11, 0, '0000-00-00 00:00:00', 0, 0, 1, 0, 'menu_image=-1')");

	$database->query();



	//quickMail( "jprojects", "jProjects" );

	//return $msg ;

} 



function quickMail( $name, $product ) {


//	global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_lang, $my;


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