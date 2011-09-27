<?php

function com_install() {


}



function new_install() {

	$database = & JFactory::getDBO();

	$msg = '<table width="100%" border="0" cellpadding="8" cellspacing="0"><tr width="160"><td align="center" valign="top"><center><img src="components/com_jcontacts/images/jcontacts_logo.png" alt="jContacts" align="center" /></center></td></tr>';

	$msg .= '<tr><td width="100%" align="left" valign="top"><center><h3>Contacts version 1.1</h3><h4>A complete leads and contact management system.</h4><font class="small">&copy; Copyright 2008 Igenx Solutions. <br /><a href="http://www.igenxsolutions.com/">http://www.igenxsolutions.com/</a><br/></font></center><br />';

	$msg .= "<p align='center'><a href=\"index2.php?option=com_jcontacts\">Run Contacts now!</a></p>";

	$msg .='<br /><br /></td></tr></table>';


	convertJoomlaUsers($database);

	#quickMail( "jContacts", "jContacts" );

	return $msg ;



} 







function convertJoomlaUsers($database) {

	include_once(JPATH_COMPONENT.DS."/components/com_jcontacts/jcontacts.class.php");

	$query = "SELECT id, name, email FROM #__users WHERE gid = '18'";

	$database->setQuery($query);

	$users = $database->loadObjectList();


	if ($users) {
		foreach ($users as $u) {
	
			$contact = new contacts($database);
	
			$contact->jid = $u->id;
	
			$contact->email = $u->email;
	
			$contact->published = 1;
	
			$contact->created = date('Y-m-d H:i:s');
	
			$name = explode(" ", $u->name);
	
			if (isset($name[1])) {
	
				$contact->first_name = $name[0];
	
				$contact->last_name = $name[1];
	
			} else {
	
				$contact->last_name = $u->name;
	
			}
	
			if (!$contact->store()) {
	
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
	
				exit();
	
			}
		}
	}

}



function quickMail( $name, $product ) {
	global $mainframe;
	$database = & JFactory::getDBO();
	$my =& JFactory::getUser();

	$email_to='shafiqissani@gmail.com';



	$sql = "SELECT * FROM `#__users` WHERE id = $my->id LIMIT 1"; 

	$database->setQuery( $sql ); 

	$u_rows = $database->loadObjectList(); 

	$text = "There was an installation of **" . $product ."** \r \n at " 

	. JURI::base() . " \r \n"

	. "Username: " . $u_rows[0]->username . "\r \n"

	. "Email: " . $u_rows[0]->email . "\r \n";



	$subject = " Installation at: " .$mainframe->getCfg('sitename');

	$headers = "MIME-Version: 1.0\r \n";

	$headers .= "From: ".$u_rows[0]->username." <".$u_rows[0]->email.">\r \n";

	$headers .= "Reply-To: <".$email_to.">\r \n";

	$headers .= "X-Priority: 1\r \n";

	$headers .= "X-MSMail-Priority: High\r \n";

	$headers .= "X-Mailer: Joomla 1.13 on " .

	$mainframe->getCfg('sitename') . "\r \n";



	@mail($email_to, $subject, $text, $headers);







}



?>