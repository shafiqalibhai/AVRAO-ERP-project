<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe;

require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$id = JRequest::getVar('cid', array(0) );
	if (!is_array( $id )) {
	$id = array(0);
	}

$jid = JRequest::getVar('id', array(0) );
	if(!is_array($id)) {
	$jid = array(0);
	}
	
global $jfConfig;

require_once( JPATH_COMPONENT.DS.'controller.php' );
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'jsupport.config.php');
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS."languages/english.php" );

JHTML::_('behavior.mootools');
$document =& JFactory::getDocument();
$document->addScript('components/com_jsupport/js/jsupport.js');
$document->addStyleSheet('components/com_jsupport/css/style.css');

switch($task) {

//Ticket
	case 'listTickets':
	jSupportController::listTickets($option);
	break;
	
	case 'viewTicket':
	jSupportController::viewTicket($option, $id);
	break;
	
	case 'newTicket':
	$id = '';
	jSupportController::editTicket($option, $id);
	break;
	
	case 'editTicket':
	jSupportController::editTicket($option, $id);
	break;
	
	case 'saveTicket':
	jSupportController::saveTicket($option);
	break;
	
//FAQ	
	case 'listFaqCategory':
	jSupportController::listFaqCategory($option, $id);
	break;
	
	case 'viewFaq':
	jSupportController::viewFaq($option, $id);
	break;
	
	case 'editFaq':
	jSupportController::editFaq($option, $id);
	break;	
	
	case 'searchFaq':
	jSupportController::searchFaq($option);
	break;
	
	case 'addComment':
	jSupportController::addComment($option);
	break;
	
	case 'listFaqs':
	default:
	jSupportController::listFaqs($option);
	break;

}

HTML_JSUPPORT::endPage();

?>

