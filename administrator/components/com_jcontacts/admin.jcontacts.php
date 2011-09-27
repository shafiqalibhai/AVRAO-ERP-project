<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
global $acl, $mainframe, $option, $config, $jfConfig, $auth, $my;

if($config->debug) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}

require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( JApplicationHelper::getPath( 'class' ) );
require_once( JPATH_COMPONENT.DS.'controller.php' );
include_once(JPATH_COMPONENT.DS."/jcontacts.config.php" );
include_once(JPATH_COMPONENT.DS."/languages/english.php" );
include_once(JPATH_COMPONENT.DS."/jcontacts.import.php" );
include_once(JPATH_COMPONENT.DS."/jcontacts.export.php" );

$my =& JFactory::getUser();

if (file_exists(JPATH_SITE."/administrator/components/com_jaccess/helper.php")) {
	include_once(JPATH_SITE."/administrator/components/com_jaccess/helper.php" );
	jAccessHelper::checkAccess();
}

$controller = new jContactsController();

$task = JRequest::getCmd('task');

	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	JArrayHelper::toInteger($cid, array(0));
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );


global $jfConfig;

if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
	$c_auth = "AND ( c.manager_id=$my->id)";
	$a_auth = "AND ( a.manager_id=$my->id)";
	$l_auth = "AND ( l.manager_id=$my->id)";
}
if (!isset($_REQUEST['tmpl'])) {
	HTML_cP::startMenu($task);
}
	
switch($task) {

	case 'element':
		$controller->execute( $task );
		$controller->redirect();
		break;
		
	// Leads
	case 'newLead' :
		$id='';
		jContactsController::editLead($option, $id);
		break;
		
	case 'editLead' :
		jContactsController::editLead($option, $id);
		break;
		
	case 'viewLead' :
		jContactsController::viewLead($option, $id);
		break;
		
	case 'saveLead' :
		jContactsController::saveLead($option);
		break;	
		
	case 'deleteLead' :
		jContactsController::deleteLead($option, $cid);
		break;	
		
	case 'listLeads' :
		jContactsController::listLeads ($option, $l_auth);
		break;
		
	case 'convertLead' :
		jContactsController::convertLead ($option);
		break;	// Accounts
	case 'newAccount' :
		$id='';
		jContactsController::editAccount($option, $id);
		break;	
		
	case 'editAccount' :
		jContactsController::editAccount($option, $id);
		break;	
		
	case 'viewAccount' :
		jContactsController::viewAccount($option, $id);
		break;	
		
	case 'saveAccount' :
		jContactsController::saveAccount($option, $id);
		break;	
		
	case 'deleteAccount' :
		jContactsController::deleteAccount($option, $cid);
		break;	
		
	case 'listAccounts' :
		jContactsController::listAccounts ($option, $a_auth);
		break;
		
	// Contacts
	case 'newContact' :
		$id='';
		jContactsController::editContact($option, $id);
		break;	
		
	case 'editContact' :
		jContactsController::editContact($option, $id);
		break;
		
	case 'viewContact' :
		jContactsController::viewContact($option, $id);
		break;	
		
	case 'saveContact' :
		jContactsController::saveContact($option, $id);
		break;
		
	case 'deleteContact' :
		jContactsController::deleteContact($option, $cid);
		break;
		
	case 'listContacts' :
		jContactsController::listContacts ($option, $c_auth);
		break;
		
	case 'requestUpdate' :
		jContactsController::requestUpdate ($option);
		break;	
	
	//Publishing
	case 'publish':
		jContactsController::changeContent( $id, 1, $option );
		break;	
		
	case 'unpublish':
		jContactsController::changeContent( $id, 0, $option );
		break;
		
	//About
	case 'About':
		jContactsController::About($option);
		break;
		
	case 'config':
		jContactsController::showConfig($option);
		break;
	
	case 'saveConfig':
		jContactsController::saveConfig($option);
		break;	
		
	case 'importWizard':
		JCONTACTS_import::importWizard($_REQUEST['step']); 
		break;	
		
	case 'exportWizard':
		JCONTACTS_export::exportWizard($_REQUEST['step']); 
		break;
		
	case 'accountPopup':
		jContactsController::accountPopup(); 
		break;
		
	case 'reportsToPopup':
		jContactsController::reportsToPopup(); 
		break;
		
	case 'test':
		jContactsController::test(); 
		break;
		
	case 'deletetest':
		jContactsController::deletetest(); 
		break;
		
	// Default
	default:
		jContactsController::controlPanel ($option);
		break;
		
}
HTML_cP::endMenu();