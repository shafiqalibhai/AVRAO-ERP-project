<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

global $acl, $mainframe, $option, $config, $jfConfig, $auth;

if($config->debug) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}

require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( JApplicationHelper::getPath( 'class' ) );
require_once( JPATH_COMPONENT.DS.'controller.php' );
include_once(JPATH_SITE."/administrator/components/com_jsupport/jsupport.config.php" );
include_once(JPATH_SITE."/administrator/components/com_jsupport/languages/english.php" );

if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
	$auth = "WHERE ( $my->id=j.manager)";
}

$controller = new jSupportController();

$task = JRequest::getCmd('task');

	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	JArrayHelper::toInteger($cid, array(0));
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );

$type = JRequest::getVar('type');

global $jfConfig;
	
switch($task) {

	// Tickets
	case 'newTicket' :
		$id='';
		HTML_cP::startMenu( $task );
		jSupportController::editTicket($option, $id);
		break;

	case 'editTicket' :
		HTML_cP::startMenu( $task );
		jSupportController::editTicket($option, $cid);
		break;
		
	case 'viewTicket' :
		HTML_cP::startMenu( $task );
		jSupportController::viewTicket($option, $cid);
		break;

	case 'saveTicket' :
		HTML_cP::startMenu( $task );
		jSupportController::saveTicket($option);
		break;

	case 'deleteTicket' :
		HTML_cP::startMenu( $task );
		jSupportController::deleteTicket($option, $id);
		break;

	case 'listTickets' :
		HTML_cP::startMenu( $task );
		jSupportController::listTickets($option, $type);
		break;
	
	case 'convertTicket':
		HTML_cP::startMenu( $task );
		jSupportController::convertTicket($option);
		break;

	// FAQ's
	case 'newFaq' :
		HTML_cP::startMenu( $task );
		$id='';
		jSupportController::editFaq($option, $id);
		break;

	case 'editFaq' :
		HTML_cP::startMenu( $task );
		jSupportController::editFaq($option, $cid);
		break;

	case 'viewFaq' :
		HTML_cP::startMenu( $task );
		jSupportController::viewFaq($option, $cid);
		break;
		
	case 'saveFaq' :
		HTML_cP::startMenu( $task );
		jSupportController::saveFaq($option, $id);
		break;

	case 'deleteFaq' :
		HTML_cP::startMenu( $task );
		jSupportController::deleteFaq($option, $id);
		break;

	case 'listFaqs' :
		HTML_cP::startMenu( $task );
		jSupportController::listFaqs ($option, $id);
		break;

	//Comments
	case 'newComment' :
		$id='';
		HTML_cP::startMenu( $task );
		jSupportController::editComment($option, $id);
		break;

	case 'editComment' :
		HTML_cP::startMenu( $task );
		jSupportController::editComment($option, $cid);
		break;

	case 'saveComment' :
		HTML_cP::startMenu( $task );
		jSupportController::saveComment($option);
		break;

	case 'deleteComment' :
		HTML_cP::startMenu( $task );
		jSupportController::deleteComment($option, $id);
		break;

	case 'listComments' :
		HTML_cP::startMenu( $task );
		jSupportController::listComments($option, $type);
		break;


	//Publishing
	case 'publish':
		jSupportController::changeContent( $id, 1, $option );
		break;

	case 'unpublish':
		jSupportController::changeContent( $id, 0, $option );
		break;
		
	//About
	case 'About':
		HTML_cP::startMenu( $task );
		jSupportController::About($option);
		break;
		
	case 'config':
		HTML_cP::startMenu( $task );
		jSupportController::showConfig($option);
		break;
	
	case 'saveConfig':
		jSupportController::saveConfig($option);
		break;

	// Categories
	case 'newCategory' :
		$id='';
		HTML_cP::startMenu( $task );
		jSupportController::editCategory($option, $id);
		break;

	case 'editCategory' :
		HTML_cP::startMenu( $task );
		jSupportController::editCategory($option, $cid);
		break;

	case 'saveCategory' :
		jSupportController::saveCategory($option);
		break;

	case 'deleteCategory' :
		HTML_cP::startMenu( $task );
		jSupportController::deleteCategory($option, $id);
		break;

	case 'listCategories' :
		HTML_cP::startMenu( $task );
		jSupportController::listCategories($option, $type);
		break;

	// Default
	default:
		HTML_cP::startMenu( $task );
		jSupportController::controlPanel ($option);
		break;

	//Popups
	case 'clientPopup':
		HTML_cP::startMenu($task);
		jSupportController::clientPopup($option);
		break;
		
}

HTML_cP::endMenu();

?>