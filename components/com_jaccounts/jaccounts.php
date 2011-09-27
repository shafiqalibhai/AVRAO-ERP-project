<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$user =& JFactory::getUser();

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
	
global $jfConfig, $jaccounts_path;
$tmpl = JRequest::getVar('tmpl');
$jaccounts_path = 'components/com_jaccounts';
JHTML::_('behavior.mootools');
$document =& JFactory::getDocument();

require_once( JPATH_COMPONENT.DS.'controller.php' );
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'jaccounts.config.php');
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS."languages/english.php" );

if($user->get('gid') > 18) {

	if (file_exists(JPATH_ADMINISTRATOR.DS."components".DS."com_jaccess".DS."helper.php")) {
		include_once(JPATH_ADMINISTRATOR.DS."components".DS."com_jaccess".DS."helper.php");
	}


	include_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'controller.php');
	include_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jaccounts.html.php');
	$document->addScript('administrator'.DS.$jaccounts_path.DS.'js'.DS.'admin_jaccounts.js');
	$document->addStyleSheet('administrator'.DS.$jaccounts_path.DS.'css'.DS.'admin_style.css');
	$employee=true;
	
	if($jfConfig['access_restrictions']==1 && $user->get('gid')!='25') {
		$userid = $user->get('id');
		$auth = "WHERE ('$userid'=j.manager)";
	}	

	global $connection;
	$connection = jAccessHelper::checkConnections();
	
	jAccessHelper::checkAccess();

}

$document->addScript('components/com_jaccounts/js/jaccounts.js');
$document->addStyleSheet('components/com_jaccounts/css/style.css');

if($employee) {
	if ($tmpl != 'component') { HTML_cP::startMenu($task); }
	switch($task) {	
		//Employee Tasks
		
		// Invoices
		case 'newInvoice' :
			$id='';
			jAccountsController::editInvoice($option, $id);
			break;
	
		case 'editInvoice' :
			jAccountsController::editInvoice($option, $cid);
			break;
			
		case 'viewInvoice' :
			jAccountsController::viewInvoice($option, $cid);
			break;
	
		case 'saveInvoice' :
			jAccountsController::saveInvoice($option);
			break;
	
		case 'deleteInvoice' :
			jAccountsController::deleteInvoice($option, $id);
			break;
	
		case 'listInvoices' :
			jAccountsController::listInvoices ($option, $auth);
			break;
	
		// Quotes
		case 'newQuote' :
			$id='';
			jAccountsController::editQuote($option, $id);
			break;
	
		case 'editQuote' :
			jAccountsController::editQuote($option, $cid);
			break;
	
		case 'viewQuote' :
			jAccountsController::viewQuote($option, $cid);
			break;
			
		case 'saveQuote' :
			jAccountsController::saveQuote($option, $id);
			break;
	
		case 'deleteQuote' :
			jAccountsController::deleteQuote($option, $id);
			break;
	
		case 'listQuotes' :
			jAccountsController::listQuotes ($option, $auth);
			break;
	
		// Services
		case 'newService' :
			$id='';
			jAccountsController::editService($option, $id);
			break;
	
		case 'editService' :
			jAccountsController::editService($option, $cid);
			break;
	
		case 'viewService' :
			jAccountsController::viewService($option, $cid);
			break;
			
		case 'saveService' :
			jAccountsController::saveService($option, $id);
			break;
	
		case 'deleteService' :
			jAccountsController::deleteService($option);
			break;
	
		case 'listServices' :
			jAccountsController::listServices($option);
			break;
	
		//Publishing
		case 'publish':
			jAccountsController::changeContent( $id, 1, $option );
			break;
	
		case 'unpublish':
			jAccountsController::changeContent( $id, 0, $option );
			break;
			
		case 'managerList':
			jAccountsController::managerList();
			break;
		
		//Popups
		case 'clientPopup':
			jAccountsController::clientPopup($option);
			break;
			
		case 'servicesPopup':
			jAccountsController::servicesPopup($option);
			break;
		
		case 'employeeHome':
		default:
			jAccountsClientController::employeeHomePage($option);
			break;
	}
	
} else {
	
	switch($task) {
		//User Tasks
		case 'listMyQuotes':
		jAccountsClientController::listMyQuotes($option);
		break;
		
		case 'viewMyQuote':
		jAccountsClientController::viewMyQuote($option, $jid);
		break;
		
		case 'acceptMyQuote':
		jAccountsClientController::viewMyQuote($option, $jid);
		break;
		
		case 'listMyInvoices':
		jAccountsClientController::listMyInvoices($option);
		break;
		
		case 'viewMyInvoice':
		jAccountsClientController::viewMyInvoice($option, $jid);
		break;
		
		case 'authorizeNetForm':
		jAccountsClientController::authorizeNetForm();
		break;
		
		case 'processAuthorizeNet':
		jAccountsClientController::processAuthorizeNet();
		break;
		
		case 'home':
		default:
		jAccountsClientController::homePage($option);
		break;
	}
}
if ($tmpl != 'component') { HTML_JACCOUNTS::endPage(); }
//Quote Functions
?>

