<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

global $acl, $mainframe, $option, $config, $auth;

if($config->debug) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}
$user = JFactory::getUser();
if ($user->gid != '25') {
	$mainframe->redirect('index.php', _NOT_AUTH);	
}
require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( JApplicationHelper::getPath( 'class' ) );
require_once( JPATH_COMPONENT.DS.'controller.php' );
include_once(JPATH_SITE."/administrator/components/com_jaccess/languages/english.php" );

$controller = new jAccessController();

$task = JRequest::getCmd('task');

	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	JArrayHelper::toInteger($cid, array(0));
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );

$type = JRequest::getVar('type');
	
switch($task) {

	//Groups
	case 'newGroup' :
		$id='';
		HTML_cP::startMenu( $task );
		jAccessController::editGroup($option, $id);
		break;

	case 'editGroup' :
		HTML_cP::startMenu( $task );
		jAccessController::editGroup($option, $cid);
		break;

	case 'saveGroup' :
		HTML_cP::startMenu( $task );
		jAccessController::saveGroup($option);
		break;

	case 'deleteGroup' :
		HTML_cP::startMenu( $task );
		jAccessController::deleteGroup($option, $id);
		break;

	case 'listGroups' :
	default:
		HTML_cP::startMenu( $task );
		jAccessController::listGroups($option, $type);
		break;


	//Publishing
	case 'publish':
		jAccessController::changeContent( $id, 1, $option );
		break;

	case 'unpublish':
		jAccessController::changeContent( $id, 0, $option );
		break;

}

HTML_cP::endMenu();

?>