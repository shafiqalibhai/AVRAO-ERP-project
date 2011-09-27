<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
global $acl, $mainframe, $option, $jfConfig, $auth, $my, $connection;

if($config->debug) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}


require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( JApplicationHelper::getPath( 'class' ) );
require_once( JPATH_COMPONENT.DS.'controller.php' );
include_once(JPATH_ADMINISTRATOR.DS."components".DS."com_jaccounts".DS."jaccounts.config.php" );
include_once(JPATH_ADMINISTRATOR.DS."components".DS."com_jaccounts".DS."languages".DS."english.php" );

if (file_exists(JPATH_ADMINISTRATOR.DS."components".DS."com_jaccess".DS."helper.php")) {
	include_once(JPATH_ADMINISTRATOR.DS."components".DS."com_jaccess".DS."helper.php" );
} else {
	$mainframe->redirect('index.php', 'Please install jAccess before running jAccounts.');
}

jAccessHelper::checkAccess();
$user = JFactory::getUser();
if($jfConfig['access_restrictions']==1 && $user->gid!='25') {
	$groups = jAccessHelper::getGroups();
		if(is_array($groups)) {
		$auth = "WHERE ( (".$user->get('id')."=j.mid OR (j.gid=".implode(' OR j.gid=', $groups).") AND j.mid=0))";
		} elseif($groups) {
		$auth = "WHERE ( (".$user->get('id')."=j.mid OR j.gid=".$groups." AND j.mid=0))";
		} else {
		$auth = "WHERE ( (".$user->get('id')."=j.mid))";
		}
}
$connection = jAccessHelper::checkConnections();
$controller = new jAccountsController();

$task = JRequest::getCmd('task');

	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	JArrayHelper::toInteger($cid, array(0));
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );

switch($task) {

	case 'element':
		$controller->execute( $task );
		$controller->redirect();
		break;

	// Invoices
	case 'newInvoice' :
		HTML_cP::startMenu( $task );
		$id='';
		jAccountsController::editInvoice($option, $id);
		HTML_cP::endMenu();
		break;

	case 'editInvoice' :
		HTML_cP::startMenu( $task );	
		jAccountsController::editInvoice($option, $cid);
		HTML_cP::endMenu();
		break;
		
	case 'viewInvoice' :
		HTML_cP::startMenu( $task );
		jAccountsController::viewInvoice($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'saveInvoice' :
		HTML_cP::startMenu( $task );
		jAccountsController::saveInvoice($option);
		HTML_cP::endMenu();
		break;

	case 'deleteInvoice' :
		HTML_cP::startMenu( $task );
		jAccountsController::deleteInvoice($option, $id);
		HTML_cP::endMenu();
		break;

	case 'listInvoices' :
		HTML_cP::startMenu( $task );
		jAccountsController::listInvoices ($option, $auth);
		HTML_cP::endMenu();
		break;

	// Quotes
	case 'newQuote' :
		$id='';
		HTML_cP::startMenu( $task );
		jAccountsController::editQuote($option, $id);
		HTML_cP::endMenu();
		break;

	case 'editQuote' :
		HTML_cP::startMenu( $task );
		jAccountsController::editQuote($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'viewQuote' :
		HTML_cP::startMenu( $task );
		jAccountsController::viewQuote($option, $cid);
		HTML_cP::endMenu();
		break;
		
	case 'saveQuote' :
		HTML_cP::startMenu( $task );
		jAccountsController::saveQuote($option, $id);
		HTML_cP::endMenu();
		break;

	case 'deleteQuote' :
		HTML_cP::startMenu( $task );
		jAccountsController::deleteQuote($option, $id);
		HTML_cP::endMenu();
		break;

	case 'listQuotes' :
		HTML_cP::startMenu( $task );
		jAccountsController::listQuotes ($option, $auth);
		HTML_cP::endMenu();
		break;

	// Services
	case 'newService' :
		$id='';
		HTML_cP::startMenu( $task );
		jAccountsController::editService($option, $id);
		HTML_cP::endMenu();
		break;

	case 'editService' :
		HTML_cP::startMenu( $task );
		jAccountsController::editService($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'viewService' :
		HTML_cP::startMenu( $task );
		jAccountsController::viewService($option, $cid);
		HTML_cP::endMenu();
		break;
		
	case 'saveService' :
		HTML_cP::startMenu( $task );
		jAccountsController::saveService($option, $id);
		HTML_cP::endMenu();
		break;

	case 'deleteService' :
		HTML_cP::startMenu( $task );
		jAccountsController::deleteService($option);
		HTML_cP::endMenu();
		break;

	case 'listServices' :
		HTML_cP::startMenu( $task );
		jAccountsController::listServices($option);
		HTML_cP::endMenu();
		break;

	//Publishing
	case 'publish':
		HTML_cP::startMenu( $task );
		jAccountsController::changeContent( $id, 1, $option );
		HTML_cP::endMenu();
		break;

	case 'unpublish':
		HTML_cP::startMenu( $task );
		jAccountsController::changeContent( $id, 0, $option );
		HTML_cP::endMenu();
		break;
		
	//About
	case 'About':
		HTML_cP::startMenu( $task );
		jAccountsController::About($option);
		HTML_cP::endMenu();
		break;
		
	case 'config':
		HTML_cP::startMenu( $task );
		jAccountsController::showConfig($option);
		HTML_cP::endMenu();
		break;
	
	case 'saveConfig':
		HTML_cP::startMenu( $task );
		jAccountsController::saveConfig($option);
		HTML_cP::endMenu();
		break;
		
	case 'managerList':
		jAccountsController::managerList();
		break;
		
	// Default
	default:
		HTML_cP::startMenu( $task );
		jAccountsController::controlPanel ($option);
		HTML_cP::endMenu();
		break;
		
	//Popups
	case 'clientPopup':
		HTML_cP::startMenu( $task );
		jAccountsController::clientPopup($option);
		break;
		
	case 'servicesPopup':
		HTML_cP::startMenu( $task );
		jAccountsController::servicesPopup($option);
		break;
}
?>