<?
defined('_JEXEC') or die('Restricted access');

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

$task = JRequest::getVar('task', '' );

switch ( $task ) {
case 'editProject':
case 'newProject':
menuCLIENTS::PROJECT_MENU();
break;
case 'editTask':
case 'newTask':
menuCLIENTS::TASK_MENU();
break;
case 'listTasks':
menuCLIENTS::DEFAULTTASKS_MENU();
break;
case 'listProjects':
menuCLIENTS::DEFAULTPROJECTS_MENU();
break;
case 'listTimes':
menuCLIENTS::DEFAULTTIMES_MENU();
break;
case 'editTime':
case 'newTime':
menuCLIENTS::TIME_MENU();
break;
case 'listFiles':
menuCLIENTS::DEFAULTFILES_MENU();
break;
case 'editFile':
case 'newFile':
menuCLIENTS::FILE_MENU();
break;
case 'viewFile':
menuCLIENTS::DETAIL_FILE_MENU();
break;
case 'viewTask':
menuCLIENTS::DETAIL_TASK_MENU();
break;
case 'viewProject':
menuCLIENTS::DETAIL_PROJECT_MENU();
break;
case 'viewTime':
menuCLIENTS::DETAIL_TIME_MENU();
break;
case 'viewCalendar':
menuCLIENTS::CALENDAR_MONTH_MENU();
break;
case 'calendarDayView':
menuCLIENTS::CALENDAR_DAY_MENU();
break;
case 'config':
menuCLIENTS::CONFIG_MENU();
break;
default:
menuCLIENTS::DEFAULT_MENU();
break;		
}
?>