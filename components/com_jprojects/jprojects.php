<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe;

require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$user =& JFactory::getUser();

if($user->guest) { 
	JText::_('NOTAUTH'); 
	return;
}

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
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'jprojects.config.php');
include_once(JPATH_COMPONENT_ADMINISTRATOR.DS."languages/english.php" );

JHTML::_('behavior.mootools');
$document =& JFactory::getDocument();
$document->addScript('components/com_jprojects/js/jprojects.js');
$document->addStyleSheet('components/com_jprojects/css/style.css');

switch($task) {
	case 'myProjects':
	jProjectsController::myProjects($option);
	break;
	
	case 'viewProject':
	jProjectsController::viewProject($option, $jid);
	break;
	
	case 'viewTask':
	jProjectsController::viewTask($option, $jid);
	break;
	
	case "addFile":
	jProjectsController::addFile($option);
	break;
	
	case "saveFile":
	jProjectsController::saveFile($option);
	break;
	
	case 'home':
	default:
	jProjectsController::homePage($option);
	break;
	
}
HTML_JPROJECTS::endPage();
?>

