<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
global $mainframe, $jfConfig;
require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$my =& JFactory::getUser();
if($user->guest) { 
	JText::_('NOTAUTH'); 
	return;
} 
	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	JArrayHelper::toInteger($cid, array(0));
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );
	
$jid = JRequest::getVar('id', array(0) );
	if(!is_array($id)) {
	$jid = array(0);
}
JHTML::_('behavior.mootools');
$document =& JFactory::getDocument();

$jcontacts_path = JPATH_COMPONENT.DS."components/com_jcontacts";

require_once(JPATH_COMPONENT.DS.'controller.php' );
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS."jcontacts.config.php" );
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS."languages/english.php" );

$a_auth = '';
$c_auth = '';

if ($my->gid != 2) {
	$a_auth = "AND a.manager_id = '$my->id'";
	$c_auth = "AND c.manager_id = '$my->id'";
}
$document->addScript('components/com_jcontacts/js/jcontacts.js');
?>

<link href="components/com_jcontacts/css/style.css" rel="stylesheet" type="text/css" />
<?php

switch($task) {

	case 'myContacts':
	jContactsClientController::getContacts($option, $c_auth);
	break;
	
	case 'myAccounts':
	jContactsClientController::getAccounts($option, $a_auth);
	break;
	
	case 'viewContact':
	jContactsClientController::viewContact($option);
	break;
	
	case 'viewAccount':
	jContactsClientController::viewAccount($option);
	break;
	
	case 'saveLead':
	jContactsClientController::saveLead($option);
	break;
	
	case 'register':
	jContactsClientController::registrationForm($option);
	break;
	
	case 'viewMyDetails':
	case 'editMyDetails':
	jContactsClientController::editMyDetails($task, $option, $my);
	break;

	
	case 'saveContactDetails':
	jContactsClientController::saveContactDetails($option, $my);
	break;
	
	case 'newLead':
	default:
	jContactsClientController::newLead($option);
	break;
	
}

?>