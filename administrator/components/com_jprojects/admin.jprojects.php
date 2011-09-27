<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
global $acl, $mainframe, $option, $config, $jfConfig, $auth, $my;

if($config->debug) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );
require_once( JPATH_COMPONENT.DS.'controller.php' );
include_once( JPATH_COMPONENT.DS.'helper.php' );
include_once(JPATH_SITE."/administrator/components/com_jprojects/jprojects.config.php" );
include_once(JPATH_SITE."/administrator/components/com_jprojects/languages/english.php" );

$task = JRequest::getCmd('task');

	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	JArrayHelper::toInteger($cid, array(0));
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );


if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
	$auth = "WHERE (j.manager='$my->id')";
	$f_auth = "WHERE ($my->id=author)";
} else {
	$auth = '';
	$f_auth='';	
}

$controller = new jProjectsController();

switch($task) {

	// Projects
	case 'newProject' :
		$id='';
		HTML_cP::startMenu($task);
		jProjectsController::editProject($option, $id);
		HTML_cP::endMenu();
		break;

	case 'editProject' :
		HTML_cP::startMenu($task);
		jProjectsController::editProject($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'viewProject' :
		HTML_cP::startMenu($task);
		jProjectsController::viewProject($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'saveProject' :
		HTML_cP::startMenu($task);
		jProjectsController::saveProject($option);
		HTML_cP::endMenu();
		break;

	case 'deleteProject' :
		HTML_cP::startMenu($task);
		jProjectsController::deleteProject($option, $id);
		HTML_cP::endMenu();
		break;

	case 'listProjects' :
		HTML_cP::startMenu($task);
		jProjectsController::listProjects ($option, $auth);
		HTML_cP::endMenu();
		break;

	// Calendar
	case 'viewCalendar':
		HTML_cP::startMenu($task);
		jProjectsController::viewCalendar ($option);
		HTML_cP::endMenu();
		break;

	case 'calendarDayView':
		HTML_cP::startMenu($task);
		jProjectsController::calendarDayView($option);
		HTML_cP::endMenu();
		break;

	case 'thisMonth':
		jProjectsController::thisMonth();
		break;

	case 'today':
		jProjectsController::today();
		break;

	// Tasks
	case 'newTask' :
		$id='';
		
		if(JRequest::getVar('tmpl','')!='component'){ 
			HTML_cP::startMenu($task);
		} else { 
			HTML_cP::startPopup();
		}
		
		jProjectsController::editTask($option, $id);
		HTML_cP::endMenu();
		break;

	case 'editTask' :
		HTML_cP::startMenu($task);
		jProjectsController::editTask($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'viewTask' :
		HTML_cP::startMenu($task);
		jProjectsController::viewTask($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'saveTask' :
		HTML_cP::startMenu($task);
		jProjectsController::saveTask($option, $id);
		HTML_cP::endMenu();
		break;

	case 'deleteTask' :
		HTML_cP::startMenu($task);
		jProjectsController::deleteTask($option, $id);
		HTML_cP::endMenu();
		break;

	case 'listTasks' :
		HTML_cP::startMenu($task);
		jProjectsController::listTasks ($option, $auth);
		HTML_cP::endMenu();
		break;

	case 'remoteTask' :
		HTML_cP::startMenu($task);
		jProjectsController::remoteTask($option);
		HTML_cP::endMenu();
		break;

	// Time tracking
	case 'newTime' :
		HTML_cP::startMenu($task);
		$id='';
		jProjectsController::editTime($option, $id);
		HTML_cP::endMenu();
		break;

	case 'editTime' :
		HTML_cP::startMenu($task);
		jProjectsController::editTime($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'viewTime' :
		HTML_cP::startMenu($task);
		jProjectsController::viewTime($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'saveTime' :
		HTML_cP::startMenu($task);
		jProjectsController::saveTime($option, $id);
		HTML_cP::endMenu();
		break;

	case 'deleteTime' :
		HTML_cP::startMenu($task);
		jProjectsController::deleteTime($option, $id);
		HTML_cP::endMenu();
		break;

	case 'listTimes' :
		HTML_cP::startMenu($task);
		jProjectsController::listTimes($option);
		HTML_cP::endMenu();
		break;

	//File Management
	case 'newFile' :
		HTML_cP::startMenu($task);
		$id='';
		jProjectsController::editFile($option, $id);
		HTML_cP::endMenu();
		break;

	case 'editFile' :
		HTML_cP::startMenu($task);
		jProjectsController::editFile($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'viewFile' :
		HTML_cP::startMenu($task);
		jProjectsController::viewFile($option, $cid);
		HTML_cP::endMenu();
		break;

	case 'saveFile' :
		HTML_cP::startMenu($task);
		jProjectsController::saveFile($option, $id);
		HTML_cP::endMenu();
		break;

	case 'deleteFile' :
		HTML_cP::startMenu($task);
		jProjectsController::deleteFile($option, $id);
		HTML_cP::endMenu();
		break;

	case 'listFiles' :
		HTML_cP::startMenu($task);
		jProjectsController::listFiles($option, $f_auth);
		HTML_cP::endMenu();
		break;

	//Publishing
	case 'publish':
		jProjectsController::publish( $id, $option );
		break;

	case 'unpublish':
		jProjectsController::changeContent( $id, 0, $option );
		break;

	//About
	case 'About':
		HTML_cP::startMenu($task);
		jProjectsController::About($option);
		HTML_cP::endMenu();
		break;

	case 'config':
		HTML_cP::startMenu($task);
		jProjectsController::showConfig($option);
		HTML_cP::endMenu();
		break;

	case 'saveConfig':
		jProjectsController::saveConfig($option);
		HTML_cP::endMenu();
		break;

	default:
		HTML_cP::startMenu($task);
		jProjectsController::controlPanel ($option);
		HTML_cP::endMenu();
		break;
		
	//Popups
	case 'clientPopup':
		HTML_cP::startMenu($task);
		jProjectsHelper::clientPopup($option);
		break;
	
	case 'projectPopup':
		HTML_cP::startMenu($task);
		jProjectsHelper::projectPopup($option);
		break;

	case 'milestonePopup':
		HTML_cP::startMenu($task);
		jProjectsHelper::milestonePopup($option, $cid);
		break;

	case 'timelinePopup':
		HTML_cP::startMenu($task);
		jProjectsHelper::timelinePopup($option, $cid);
		break;		

	case 'taskPopup':
		HTML_cP::startMenu($task);
		jProjectsHelper::taskPopup($option, $cid);
		break;
	case 'startTimer':
		HTML_cP::startMenu($task);
		jProjectsHelper::startTimer($option);
		break;
}
