<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class jProjectsController extends JController
{

function publish($id, $option) {
	global $jfConfig;
	$database = & JFactory::getDBO();
	switch ($_REQUEST['type']) {
		case 'projects':
		if ($jfConfig['auto_email'] == '1') {
			foreach ($id as $i) {
				$row = new projects($database);
				$row->load($i);	
				jProjectsController::sendEmail('projects', $row);
			}
		}
		break;

		case 'tasks':
		if ($jfConfig['auto_email'] == '1') {
			foreach ($id as $i) {
				$row = new tasks($database);
				$row->load($i);	
				jProjectsController::sendEmail('tasks', $row);
			}
		}		
		break;
		
		default:
		break;	
	}
	
	jProjectsController::changeContent( $id, 1, $option );	
}
function editProject($option, $uid) {
		$database = & JFactory::getDBO();
		global  $my;
		$row = new projects($database);
		if($uid){
			$row -> load($uid[0]);

			jProjectsHelper::checkAuth('project', $row);

			$query = "SELECT * FROM #__jmilestones WHERE projectid='$row->id' ORDER BY 'startdate' ASC";
			$database->setQuery($query);
			$milestones = $database->loadObjectList();

			$query = "SELECT * FROM #__jdocuments WHERE projectid='$row->id' ORDER BY 'dateadded' ASC";
			$database->setQuery($query);
			$files = $database->loadObjectList();

			$query = "SELECT * FROM #__jtasks WHERE projectid='$row->id' ORDER BY 'startdate' ASC";
			$database->setQuery($query);
			$tasks = $database->loadObjectList();
		}

		$query = "SELECT * FROM #__users WHERE block = '0' AND id='$row->contactid'";
		$database->setQuery($query);
		$user = $database->loadRow();

		$lists = jProjectsHelper::managerList($row);

	HTML_projects::editProject($option, $row, $user, $milestones, $lists, $files, $tasks);
}
function viewProject($option, $uid) {
		$database = & JFactory::getDBO();
		$row = new projects($database);
		if($uid){
			$row -> load($uid[0]);
			
			jProjectsHelper::checkAuth('project', $row);
			
			$query = "SELECT * FROM #__jmilestones WHERE projectid='$row->id' ORDER BY 'startdate' ASC";
			$database->setQuery($query);
			$milestones = $database->loadObjectList();

			$query = "SELECT * FROM #__jdocuments WHERE projectid='$row->id' ORDER BY 'startdate' ASC";
			$database->setQuery($query);
			$files = $database->loadObjectList();

			$query = "SELECT * FROM #__jtasks WHERE projectid='$row->id' ORDER BY 'startdate' ASC";
			$database->setQuery($query);
			$tasks = $database->loadObjectList();
		}

		$query = "SELECT * FROM #__users WHERE id='$row->contactid'";
		$database->setQuery($query);
		$user = $database->loadRow();

		$query = "SELECT * FROM #__users WHERE id='$row->manager'";
		$database->setQuery($query);
		$manager = $database->loadRow();

	HTML_projects::viewProject($option, $row, $user, $milestones, $manager, $files, $tasks);
}
function listProjects ($option, $auth=null) {
	$database = & JFactory::getDBO();
	global  $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );

	if($_REQUEST['filter']!='') {
		$filter = $_REQUEST['filter'];
	    $filter = mosStripslashes(mosStripslashes($filter));
    	$filter = str_replace('%20',' ',$filter);
    	$filter = mosHTML::cleanText($filter);

 	   $words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(u.username) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.accountid) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		if(!$auth) {
			    $where = 'WHERE (' . implode( (') OR ('), $wheres ) . ')';
		} else {
			    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
		}
	} elseif($_REQUEST['alpha']!='') {
		$alpha = $_REQUEST['alpha'];
	    $alpha = mosStripslashes(mosStripslashes($alpha));
    	$alpha = str_replace('%20',' ',$alpha);
    	$alpha = mosHTML::cleanText($alpha);

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		if(!$auth) {
		    $where = 'WHERE (' . implode( (') OR ('), $wheres ) . ')';
		} else {
		    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
		}
	}

	# get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__jprojects as j $auth" );
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

	$query = "SELECT j.id, subject, contactid, startdate, completiondate, manager, "
	."\n published, u.username, u.name, m.username as owner, m.name as ownername FROM #__jprojects as j"
	."\n LEFT OUTER JOIN #__users AS u on j.contactid = u.id LEFT OUTER JOIN #__users AS m on j.manager = m.id"
	."\n $auth $where"
	."\n ORDER BY j.id, subject DESC"
	. "\n LIMIT $pagination->limitstart,$pagination->limit";
	$database->setQuery($query);
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	HTML_projects::listProjects($option, $rows, $pagination);
}
function saveProject ($option) {
	$database = & JFactory::getDBO();
	global  $my, $mainframe, $mosConfig_offset, $jfConfig;
	if ($jfConfig['auto_email'] == '1' && $_POST['id'] != "") {
		jProjectsController::emailCheck('projects', $_POST);
	}
	$row = new projects($database);
	$msg = 'Saved Project';
	$nullDate = $database->getNullDate();
	
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$row->startdate = date("Y-m-d H:i:s", strtotime($row->startdate));
	$row->completiondate = date("Y-m-d H:i:s", strtotime($row->completiondate));
	
	if ($row->id == "" && $row->published == '1' && $jfConfig['auto_email'] == '1') {
		jProjectsController::sendEmail('projects', $row);
	}
			$row->id = (int) $row->id;

				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				}
				
				if ($row->created && strlen(trim( $row->created )) <= 10) {
					$row->created 	.= ' 00:00:00';
				}

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
//	if($row->published == 1 && $jfConfig['sendEmail'] == '1') {
//	sendEmail('INVOICE',$row->contactid, $row->subject, $row->total);
//	}

	$projectid = $row->id;

	$totalMilestones = $_POST['totalMilestones'];
	for($i=1; $i<($totalMilestones+1); $i++)
		{
		if ($_POST["m_deleted".$i] == '1') {
			if ($_POST['m_id'.$i] != "") {
				$id = $_POST['m_id'.$i];
				$query = "DELETE FROM #__jmilestones WHERE id='$id'";
				$database->setQuery($query);
				$database->query();
			}
		}
		elseif ($_POST["m_deleted".$i] == '0') {
			$milestone = new milestones($database);
			if ($_POST['m_id'.$i] != "") {
				$milestone->load($_POST['m_id'.$i]);
			}
			$milestone->projectid = $projectid;
			$milestone->name = $_REQUEST['name'.$i];
			$milestone->completiondate = date("Y-m-d", strtotime($_REQUEST['mcompletiondate'.$i]));;

				if($milestone->completiondate == '') { $milestone->completiondate = $nullDate; }

				if ($milestone->completiondate && strlen(trim($milestone->completiondate )) <= 10) {
					$milestone->completiondate 	.= ' 00:00:00';
				}

			$milestone->startdate = date("Y-m-d", strtotime($_REQUEST['mstartdate'.$i]));

				if($milestone->startdate == '') { $milestone->startdate = $nullDate; }

				if ($milestone->startdate && strlen(trim( $milestone->startdate )) <= 10) {
					$milestone->startdate 	.= ' 00:00:00';
				}

			if($_POST['mcompleted'.$i] != '1') {
				$milestone->completed = '0';
			} else {
		        $milestone->completed = '1';
			}

			$milestone->description = addslashes($_REQUEST['description'.$i]);

			if (!$milestone->store()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				}
			}
		}
	# Task Management
	$totalTasks = $_POST['totalTasks'];
	for ($i=1; $i<=$totalTasks; $i++) {
		$id = $_POST['t_id'.$i];
		$task = new tasks($database);
		$task->load($id);
		$task->stage = $_POST['t_stage'.$i];

		if (!$task->store()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}

		if($_POST['t_deleted'.$i] == '1') {
			$query = "DELETE FROM #__jtasks WHERE id='$id'";
			$database->setQuery($query);
			$database->query();
		}
	}

	//File Management
	$totalFiles = $_REQUEST['totalFiles'];
	for($i=1; $i<=$totalFiles; $i++)
		{
		//if the file is deleted then we should avoid saving the deleted files
		if($_REQUEST["filedeleted".$i] == 1) {
			$id = $_POST['fileID'.$i];
			$f = new documents($database);
			$f->load($id);

			$do = unlink("../components/com_jprojects/documents/".$f->filelocation);
				if($do!="1"){
					echo "<script> alert('There was an error deleting this file.'); window.history.go(-1); </script>\n";
				}
			$query = "DELETE FROM #__jdocuments WHERE id = '$id'";
			$database->setQuery($query);
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}
		}
	}

	$mainframe->redirect( 'index2.php?option=com_jprojects&task=viewProject&cid[]='.$projectid, $msg );
}
function deleteProject ($option, $cid) {
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
		$pids = 'projectid=' . implode( ' OR projectid=', $cid );
		$query = "DELETE FROM #__jprojects"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}

		$query = "DELETE FROM #__jmilestones"
		. "\n WHERE ( $pids )"
		;
		$database->setQuery( $query);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMSg()."'); window.history.go(-1); </script>\n";
		}
	}

	$msg = "Project(s) deleted";
	$mainframe->redirect( 'index2.php?option=com_jprojects&task=listProjects', $msg );
}

// Calendar Functions
function thisMonth() {
global $mainframe;
	$m = date("m");
	$y = date("Y");
	$mainframe->redirect('index2.php?option=com_jprojects&task=viewCalendar&month='.$m.'&year='.$y);
}

function today() {
global $mainframe;
	$date = date("Y-m-d");
	$mainframe->redirect('index2.php?option=com_jprojects&task=calendarDayView&date='.$date);
}

function viewCalendar($option, $auth=null) {
	$database = & JFactory::getDBO();

	if ((!isset($_GET['month'])) && (!isset($_GET['year']))) {
		$calendar['month'] = date ("m");
		$calendar['year'] = date ("Y");
	} else {
		$calendar['month'] = $_GET['month'];
		$calendar['year'] = $_GET['year'];
	}

	# Calculate the viewed month
	$calendar['timestamp'] = mktime (0, 0, 0, $calendar['month'], 1, $calendar['year']);
	$calendar['monthname'] = date("F", $calendar['timestamp']);
	$calendar['monthstart'] = date("w", $calendar['timestamp']);
	$calendar['lastday'] = date("d", mktime (0, 0, 0, $calendar['month'] + 1, 0, $calendar['year']));
	$calendar['startdate'] = -$calendar['monthstart'];

	# Figure out how many rows we need.
	$calendar['numrows'] = ceil (((date("t",mktime (0, 0, 0, $calendar['month'] + 1, 0, $calendar['year'])) + $calendar['monthstart']) / 7));

	if ($calendar['month']==1) {
		$prevMonth = 12;
		$prevYear = $calendar['year']-1;
		$nextMonth = $calendar['month']+1;
		$nextYear = $calendar['year'];
	} elseif ($calendar['month']==12) {
		$prevMonth = $calendar['month']-1;
		$prevYear = $calendar['year'];
		$nextMonth = 1;
		$nextYear = $calendar['year']+1;
	} else {
		$prevMonth = $calendar['month']-1;
		$prevYear = $calendar['year'];
		$nextMonth = $calendar['month']+1;
		$nextYear = $calendar['year'];
	}

	$calendar['prevLink'] = "<a href='index2.php?option=com_jprojects&task=viewCalendar&month=".$prevMonth."&year=".$prevYear."'><< Last Month</a>";
	$calendar['nextLink'] = "<a href='index2.php?option=com_jprojects&task=viewCalendar&month=".$nextMonth."&year=".$nextYear."'>Next Month >></a>";

	# Get Tasks
		if (strlen($calendar['month'])==1) {
			$datefilter = "'".$calendar['year']."-0".$calendar['month'];
		} else {
			$datefilter = "'".$calendar['year']."-".$calendar['month'];
		}
		$datefilter.= "' AND j.startdate < '";
		if (strlen($nextMonth)==1) {
			$datefilter.= $nextYear."-0".$nextMonth."'";
		} else {
			$datefilter.= $nextYear."-".$nextMonth."'";
		}
		$where = ($auth!="") ? "AND" : "WHERE";
		$query = "SELECT j.id, j.subject, j.published, j.stage, j.startdate, j.completiondate, j.priority, "
		."\n m.username as owner, p.subject as projectname, a.username as assignedto FROM #__jtasks as j"
		."\n LEFT OUTER JOIN #__users as a on j.assignedto = a.id"
		."\n LEFT OUTER JOIN #__jprojects as p on j.projectid = p.id"
		."\n LEFT OUTER JOIN #__users as m on j.manager = m.id"
		."\n $auth $where j.published = 1 "
		."\n AND (j.startdate > ".$datefilter.")"
		."\n ORDER BY j.id, subject DESC";
		$database->setQuery($query);

		$tasks = $database -> loadObjectList();


	HTML_calendar::viewCalendar($calendar, $tasks);

 }
function calendarDayView($option, $auth=null) {
$database = & JFactory::getDBO();

	$date = date("Y-m-d",strtotime($_GET['date']));
	$calendar['prevDate'] = date("Y-m-d", strtotime("-1 day",strtotime($date)));
	$calendar['nextDate'] = date("Y-m-d", strtotime("+1 day",strtotime($date)));

	$calendar['prevLink'] = "<a href='index2.php?option=com_jprojects&task=calendarDayView&date=".$calendar['prevDate']."'><< Previous Day</a>";
	$calendar['nextLink'] = "<a href='index2.php?option=com_jprojects&task=calendarDayView&date=".$calendar['nextDate']."'>Next Day >></a>";
	$calendar['date'] = $date;

	$database->setQuery("SELECT j.id, j.subject, j.published, j.stage, j.startdate, j.completiondate, j.priority, "
	."\n m.username as owner, p.subject as projectname, a.username as assignedto FROM #__jtasks as j"
	."\n LEFT OUTER JOIN #__users as a on j.assignedto = a.id"
	."\n LEFT OUTER JOIN #__jprojects as p on j.projectid = p.id"
	."\n LEFT OUTER JOIN #__users as m on j.manager = m.id"
	."\n $auth WHERE j.published = 1 "
	."\n AND j.startdate >= '$date' AND j.startdate < '$calendar[nextDate]'"
	."\n ORDER BY j.id, subject DESC");

	$tasks = $database -> loadObjectList();

	HTML_calendar::viewCalendarDay($option, $calendar, $tasks);
}
// Task Functions

function editTask($option, $uid) {
		$database = & JFactory::getDBO();
		$row = new tasks($database);
		if($uid){
			$row -> load($uid[0]);
			
			jProjectsHelper::checkAuth('task', $row);

			$query = "SELECT subject FROM #__jprojects WHERE id='$row->projectid'";
			$database->setQuery($query);
			$project = $database->loadResult();
		}

		$managers = jProjectsHelper::managerList($row);
		$stages = jProjectsHelper::taskStage($row);
		$assignedto = jProjectsHelper::assignedTo($row);
		$priority = jProjectsHelper::taskPriority($row);
		$start_time = jProjectsHelper::timeList($row->startdate, 'start');
		$due_time = jProjectsHelper::timeList($row->completiondate, 'due');
		
		$pop = JRequest::getVar('tmpl');

	HTML_tasks::editTask($option, $row, $managers, $stages, $assignedto, $priority, $project, $start_time, $due_time, $pop);
}

function viewTask($option, $uid) {
		$database = & JFactory::getDBO();
		$row = new tasks($database);
		if($uid){
			$row -> load($uid[0]);

			jProjectsHelper::checkAuth('task', $row);

			$query = "SELECT * FROM #__users WHERE id='$row->manager'";
			$database->setQuery($query);
			$manager = $database->loadRow();

			$query = "SELECT * FROM #__users WHERE id='$row->assignedto'";
			$database->setQuery($query);
			$assignedto = $database->loadRow();

			$query = "SELECT subject FROM #__jprojects WHERE id='$row->projectid'";
			$database->setQuery($query);
			$project = $database->loadResult();
			
			$pop = JRequest::getVar('tmpl');
		}


	HTML_tasks::viewTask($option, $row, $manager, $assignedto, $project, $pop);
}

function listTasks ($option, $auth = null) {
	$database = & JFactory::getDBO();
	global $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );

	if($_REQUEST['filter']!='') {
		$filter = $_REQUEST['filter'];
	    $filter = mosStripslashes(mosStripslashes($filter));
    	$filter = str_replace('%20',' ',$filter);
    	$filter = mosHTML::cleanText($filter);

 	   $words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.accountid) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		if(!$auth) {
		    $where = 'WHERE (' . implode( (') OR ('), $wheres ) . ')';
		} else {
		    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
		}
	} elseif($_REQUEST['alpha']!='') {
		$alpha = $_REQUEST['alpha'];
	    $alpha = mosStripslashes(mosStripslashes($alpha));
    	$alpha = str_replace('%20',' ',$alpha);
    	$alpha = mosHTML::cleanText($alpha);

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		if(!$auth) {
		    $where = 'WHERE (' . implode( (') OR ('), $wheres ) . ')';
		} else {
		    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
		}
	}

	# get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__jtasks as j $auth" );
	$total = $database->loadResult();
	echo $database->getErrorMsg();


	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

		$database->setQuery("SELECT j.id, j.subject, j.published, j.stage, j.startdate, j.completiondate, j.priority, "
		."\n m.username as owner, p.subject as projectname, a.username as assignedto FROM #__jtasks as j"
		."\n LEFT OUTER JOIN #__users as a on j.assignedto = a.id"
		."\n LEFT OUTER JOIN #__jprojects as p on j.projectid = p.id"
		."\n LEFT OUTER JOIN #__users as m on j.manager = m.id"
		."\n $auth $where"
		."\n ORDER BY j.id, subject DESC"
		."\n LIMIT $pagination->limitstart,$pagination->limit");

		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}

	HTML_tasks::listTasks($option, $rows, $pagination);
	}

function saveTask ($option) {
	$database = & JFactory::getDBO();
	global  $jfConfig, $my, $mainframe, $mosConfig_offset;
		
		if ($jfConfig['auto_email'] == '1' && $_POST['id'] != "") {
			jProjectsController::emailCheck('tasks', $_POST);
		}
		$row = new tasks($database);

		$msg = 'Saved Task';
			if (!$row->bind( $_POST )) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}
			
			if ($row->id == "" && $row->published == '1' && $jfConfig['auto_email'] == '1') {
				jProjectsController::sendEmail('tasks', $row);
			}
				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				}
				if ($row->created && strlen(trim( $row->created )) <= 10) {
					$row->created 	.= ' 00:00:00';
				}
				$row->startdate = date("Y-m-d H:i:s", strtotime($row->startdate." ".$_POST['start_h'].":".$_POST['start_min']." ".$_POST['start_mer']));
				$row->completiondate = date("Y-m-d H:i:s", strtotime($row->completiondate." ".$_POST['due_h'].":".$_POST['due_min']." ".$_POST['due_mer']));

			if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

	if(JRequest::getVar('popedit')!=='') { 
			$taskid = JRequest::getVar('popedit');
			} else { 
				$taskid = '';
			}		
	
	if(JRequest::getVar('calendar')) {
		echo "<script>window.parent.jProjectsTask();</script>";
		exit();
	}
	if(JRequest::getVar('tmpl') == 'component') {
			$count = JRequest::getVar('totalTasks');
			$lists = jProjectsHelper::taskStageProjects($count, $row);
			$lists['stages'] = str_replace("\r", "", $lists['stages']);
			$lists['stages'] = str_replace("\n", "", $lists['stages']);
			echo $count;
			echo "<br /><br />";
			print_r($_POST);
			exit();
		echo "<script>window.parent.jProjectsTask('".$taskid."','".$row->subject."','".$row->description."','".$row->startdate."','".$row->completiondate."','".$lists["stages"]."');</script>";
	} else { 
		$mainframe->redirect( 'index2.php?option=com_jprojects&task=viewTask&cid[]='.$row->id, $msg );
	}		
}

function deleteTask ($option, $cid) {
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
		$query = "DELETE FROM #__jtasks"
		. "\n WHERE ( $cids )";
		$database->setQuery( $query );

		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}

	$msg = "Task(s) deleted";
	$mainframe->redirect( 'index2.php?option=com_jprojects&task=listTasks', $msg );
}


######Experimental#######
/*
function remoteTask($option) {
$database = & JFactory::getDBO();
global  $jfConfig, $my, $mosConfig_absolute_path;
require_once(JPATH_SITE."/administrator/components/com_jprojects/jprojects_mail.class.inc" );

	$pop3 = new POP3;

	// Connect to mail server
	$do = $pop3->connect ('mail.wsdclients.com');
	if ($do == false) {
    	die($pop3->error);
	}

	// Login to your inbox
	$do = $pop3->login ('tasks@wsdclients.com', 'clients');

	if ($do == false) {
    	die($pop3->error);
	}

	// Get office status
	$status = $pop3->get_office_status();

	if ($status == false) {
    	die($pop3->error);
	}

	$count = $status['count_mails'];
	if ($count == '0') {
	return false;
	}

	for ($i = 1; $i <= $count; $i++) {
    	$email = $pop3->get_mail($i);

	    if ($email == false) {
    	    echo $pop3->error;
        	continue;
	    }

    	$email = parse_email ($email);
		$email['subject'] = $email['headers']['Subject'];
		$email['assignedto'] = 62;
		$name = trim($email['client']);

		$database->setQuery( "SELECT id FROM #__users WHERE email='$name'" );
		$email['contactid'] = $database->loadResult();

		//Save Task to Database
		$row = new tasks($database);

			if (!$row->bind( $email )) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

			if ($row->id) {
				$row->modified 	= date( 'Y-m-d H:i:s' );
			}

			if ($row->created && strlen(trim( $row->created )) <= 10) {
				$row->created 	.= ' 00:00:00';
			}

			$row->created = $row->created ? mosFormatDate( $row->created, '%Y-%m-%d %H:%M:%S') : date( 'Y-m-d H:i:s' );

			if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

    // Remove from mail server
	    $do = $pop3->delete_mail ($i);
	    if ($do == false) {
	        echo $pop3->error;
	    }
	}
	$pop3->close();
}
*/
######End of Experimental#######

//Time Functions
function listTimes ($option) {
	$database = & JFactory::getDBO();
	global $mainframe;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
	
			$database->setQuery( "SELECT count(*) FROM #__jtimetracker as j $auth" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();
			
	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);
	
	$query = "SELECT j.id, j.user, j.starttime, j.completiontime, p.subject as projectname, t.subject as taskname, u.name as name, u.username as username FROM #__jtimetracker as j"
	."\n LEFT OUTER JOIN #__users as u on j.user = u.id"
	."\n LEFT OUTER JOIN #__jprojects as p on j.projectid = p.id"
	."\n LEFT OUTER JOIN #__jtasks as t on j.taskid = t.id"
	. "\n LIMIT $pagination->limitstart,$pagination->limit";
	
	$database->setQuery($query);
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	HTML_times::listTimes($option, $rows, $pagination);
}
function editTime($option, $uid) {
	$database = & JFactory::getDBO();

	$row = new timetracker($database);
	if($uid){
		$row -> load($uid[0]);
		jProjectsHelper::checkAuth('time', $row);
		$query = "SELECT subject FROM #__jprojects WHERE id='$row->projectid'";
		$database->setQuery($query);
		$project = $database->loadResult();

		$query = "SELECT subject FROM #__jtasks WHERE id='$row->taskid'";
		$database->setQuery($query);
		$task = $database->loadResult();
		
		$query = "SELECT name FROM #__users WHERE id = '$row->user'";
		$database->setQuery($query);
		$user = $database->loadResult();
	}
	$starttime = jProjectsHelper::timeList($row->starttime, 'start');
	$endtime = jProjectsHelper::timeList($row->completiontime, 'end');

	HTML_times::editTime($option, $row, $project, $task, $user, $starttime, $endtime);
}
function viewTime($option, $uid) {
	$database = & JFactory::getDBO();
	$row = new timetracker($database);
	if($uid){
		$row -> load($uid[0]);
		jProjectsHelper::checkAuth('time', $row);
		$query = "SELECT subject FROM #__jprojects WHERE id='$row->projectid'";
		$database->setQuery($query);
		$project = $database->loadResult();

		$query = "SELECT subject FROM #__jtasks WHERE id='$row->taskid'";
		$database->setQuery($query);
		$task = $database->loadResult();
		
		$query = "SELECT name FROM #__users WHERE id = '$row->user'";
		$database->setQuery($query);
		$user = $database->loadResult();

	}

	HTML_times::viewTime($option, $row, $project, $task, $user);
}
function saveTime($option) {
	global $mainframe;
	$database = & JFactory::getDBO();
	$row = new timetracker($database);
	$msg = 'Saved Time';
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$row->starttime = date("Y-m-d H:i:s", strtotime($row->starttime." ".$_POST['start_h'].":".$_POST['start_min']." ".$_POST['start_mer']));
	$row->completiontime = date("Y-m-d H:i:s", strtotime($row->completiontime." ".$_POST['end_h'].":".$_POST['end_min']." ".$_POST['end_mer']));
	
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
if(JRequest::getVar('tmpl')=='component') { 
	echo "<script>window.close();</script>";
} else {
	$mainframe->redirect( 'index2.php?option=com_jprojects&task=listTimes', $msg );
}
}

function deleteTime($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
			$msg = "Time(s) deleted";
			$query = "DELETE FROM #__jtimetracker"
			. "\n WHERE ( $cids )"
			;

			$database->setQuery( $query );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}
	}

	$mainframe->redirect( 'index2.php?option=com_jprojects&task=listTimes', $msg );
}
//File Functions
function listFiles ($option, $f_auth) {
	$database = & JFactory::getDBO();
	global $mainframe;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
				
			$database->setQuery( "SELECT count(*) FROM #__jdocuments as j $auth" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();
			
	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);
			
	$query = "SELECT j.id, j.filename, j.filelocation, j.description, j.dateadded, p.subject as projectname, u.name as name FROM #__jdocuments as j"
	."\n LEFT OUTER JOIN #__users as u on j.author = u.id"
	."\n LEFT OUTER JOIN #__jprojects as p on j.projectid = p.id"
	."\n LIMIT $pagination->limitstart,$pagination->limit"
	."\n $f_auth";

	$database->setQuery($query);
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	HTML_files::listFiles($option, $rows, $pagination);
}
function editFile($option, $uid) {
	$database = & JFactory::getDBO();
	$row = new documents($database);
	if($uid){
		$row -> load($uid[0]);
		jProjectsHelper::checkAuth('file', $row);
		$query = "SELECT subject FROM #__jprojects WHERE id='$row->projectid'";
		$database->setQuery($query);
		$project = $database->loadResult();
		
		$pop = JRequest::getVar('tmpl');		
	}

	HTML_files::editFile($option, $row, $project, $pop);
}

function viewFile($option, $uid) {
	$database = & JFactory::getDBO();
	$row = new documents($database);
	if($uid){
		$row -> load($uid[0]);
		jProjectsHelper::checkAuth('file', $row);
		$query = "SELECT subject FROM #__jprojects WHERE id='$row->projectid'";
		$database->setQuery($query);
		$project = $database->loadResult();

	}

	HTML_files::viewFile($option, $row, $project);
}
function saveFile($option) {
	$database = & JFactory::getDBO();
	global $mainframe;
	
	jProjectsController::emailCheck('documents', $_POST);
	$directory = "../components/com_jprojects/documents/";
	$file = new documents($database);

		if (!$file->bind( $_POST )) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		if ($file->id == "" && $jfConfig['auto_email'] == '1') {
				sendEmail('documents', $file);
			}
		$file->dateadded = ($file->id) ? $file->dateadded : date("Y-m-d H:i:s");

		if($_POST['filelocation']=="" || $_FILES['filelocation']!="") {
			$new_filename = $_FILES['filelocation'.$i]['name'];
			$new_filename = str_replace(' ', '_', $new_filename);
			$fn = explode('.', $new_filename);
			$c = count($fn);
			$fn[$c-2].="_".time();
			$new_filename = implode('.', $fn);		
			
			if (!is_dir($directory))
			{
				mkdir($directory);
			}
			
			if (!is_dir($directory.$file->projectid))
			{
				mkdir($directory.$file->projectid);
			}

			if(move_uploaded_file($_FILES['filelocation']['tmp_name'],$directory.$file->projectid.'/'.$new_filename)) {
				$file->filelocation = $new_filename;
			} else {
				echo "<script> alert('Error: Couldn't store file - Please check directory permissions.');</script>\n";
			}
		} else {

			$file->filelocation = $_POST['filelocation'];
		}


		if (!$file->store()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
		
		if(JRequest::getVar('popedit')!=='') { 
			$fileid = JRequest::getVar('popedit');
			} else { 
				$fileid = '';
			}		
	if(JRequest::getVar('tmpl') == 'component') {
		echo "<script>window.parent.jProjectsFile('".$fileid."','".$file->filename."','".$file->filelocation."','".$file->dateadded."','".$file->description."');</script>";
	} else { 
		$mainframe->redirect( 'index2.php?option=com_jprojects&task=viewFile&cid[]='.$file->id, $msg );
	}		
}

function deleteFile($option, $cid) {
	$database = & JFactory::getDBO();
	$directory = "../components/com_jprojects/documents/";

	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		foreach ($cid as $id) {
			
		$f = new documents($database);
		$f->load($id);
		$do = unlink($directory."/".$f->projectid."/".$f->filelocation);
			if($do!="1"){
				echo "<script> alert('There was an error deleting this file.'); window.history.go(-1); </script>\n";
			}

		}
		$cids = 'id=' . implode( ' OR id=', $cid );
		$msg = "File(s) deleted";
		$query = "DELETE FROM #__jdocuments"
		. "\n WHERE ( $cids )"
		;

		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	$mainframe->redirect( 'index2.php?option=com_jprojects&task=listFiles', $msg );
}

//Home Page
function controlPanel ($option) {

	HTML_cP::controlPanel($option);
}

//About Page
function About($option) {
	HTML_cP::About($option);
}

/**
* Changes the state of one or more items
*/
function changeContent( $cid=null, $state=0, $option) {
	global $mainframe;
	
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
	$total = count ( $cid );
	$cids = 'id=' . implode( ' OR id=', $cid );

	$type 		= strval( JRequest::getVar('type', '' ) );

	$query = "UPDATE #__j" . $type
	. "\n SET published = " . (int) $state
	. "\n WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}
}
	switch ( $state ) {

		case 1:
			$query = "SELECT * FROM #__j". $type
			."\n WHERE ( $cids )"
			;
			$database->setQuery($query);
			$rows = $database->loadObjectList();

			foreach ($rows as $row) {
				$utype = strtoupper(substr( $type, 0, -1 ));
				jProjectsController::sendEmail($utype,$row->contactid,$row->subject,$row->total);
			}

			$msg = $total .' Item(s) successfully Published';
			break;

		case 0:
		default:
			$msg = $total .' Item(s) successfully Unpublished';
			break;
	}

	$rtask = strval( JRequest::getVar('returntask', '' ) );
	if ( $rtask ) {
		$rtask = '&task='. $rtask;
	} else {
		$rtask = '';
	}

	$mainframe->redirect( 'index2.php?option='. $option . $rtask .'&mosmsg='. $msg );
}

// Configuration

function showConfig( $option ) {
	$database = & JFactory::getDBO();
	global $acl, $jfConfig, $my,$mainframe;

	$configfile = JPATH_SITE."/administrator/components/com_jprojects/jprojects.config.php";
	@chmod ($configfile, 0766);

	if (!is_callable(array("JFile","write")) || ($mainframe->getCfg('ftp_enable') != 1)) {
		$permission = is_writable($configfile);
		if (!$permission) {
			echo "<center><h1><font color=red>Warning...</font></h1><BR>";
			echo "<B>Your config file: $configfile <font color=red>is not writable</font></b><BR>";
			echo "<B>You need to chmod this to 766 in order for the config to be updated</B></center><BR><BR>";
		}
	}

	$lists = array();

	$invoiceformats = array();
	$invoiceformats[] = JHTML::_('select.option','1','1');
	$invoiceformats[] = JHTML::_('select.option','2','2');
	$invoiceformats[] = JHTML::_('select.option','3','3');
	$invoiceformats[] = JHTML::_('select.option','4','4');

	$yesno = array();
	$yesno[] = JHTML::_('select.option','1','Yes');
	$yesno[] = JHTML::_('select.option','0','No');

	$day[] = JHTML::_('select.option','0','Business Hours');
	$day[] = JHTML::_('select.option','1','24 Hours');

	$lists['auto_email'] = JHTML::_('select.genericlist',$yesno, 'cfg_auto_email', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['auto_email'] );

	$lists['calendar_day'] = JHTML::_('select.genericlist',$day, 'cfg_calendar_day', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['calendar_day'] );

	HTML_cP::showConfig( $jfConfig, $lists, $option);
}
function saveConfig ( $option ) {
global $mainframe;
$_POST['cfg_access_restrictions'] = (!isset($_POST['cfg_access_restrictions'])) ? '0' : $_POST['cfg_access_restrictions'];

	$configfile = JPATH_SITE."/administrator/components/com_jprojects/jprojects.config.php";

   //Add code to check if config file is writeable.
   if (!is_callable(array("JFile","write")) && !is_writable($configfile)) {
      @chmod ($configfile, 0766);
      if (!is_writable($configfile)) {
         $mainframe->redirect("index2.php?option=$option", "FATAL ERROR: Config File Not writeable" );
      }
   }

   $txt = "<?php\n";
   foreach ($_POST as $k=>$v) {
   	  if (is_array($v)) $v = implode("|*|", $v);
      if (strpos( $k, 'cfg_' ) === 0) {
         if (!get_magic_quotes_gpc()) {
            $v = addslashes($v);
         }
		 $txt .= "\$jfConfig['".substr( $k, 4 )."']='$v';\n";
      }
   }
   $txt .= "?>";

   if (is_callable(array("JFile","write"))) {
		$result = JFile::write( $configfile, $txt );
   } else {
		$result = false;
		if ($fp = fopen( $configfile, "w")) {
			$result = fwrite($fp, $txt, strlen($txt));
			fclose ($fp);
		}
   }
   if ($result != false) {
      $mainframe->redirect( "index2.php?option=$option&task=showconfig", "Configuration file saved" );
   } else {
      $mainframe->redirect( "index2.php?option=$option", "FATAL ERROR: File could not be opened." );
   }
}
function emailCheck ($type, $post) {
	$database = & JFactory::getDBO();
	$row = new $type($database);
	if ($_POST['id'] !="") {
		$id = $_POST['id'];
		$row->load($id);
		if ($row->published == '0' && $post['published'] == '1') {
			sendEmail($type, $row);
		}
	}
}
function sendEmail($type,$row) {
	$database = & JFactory::getDBO();
global  $jfConfig, $mosConfig_live_site;
	
	$link = $mosConfig_live_site."/index.php?option=com_jprojects&task=myProjects";
	
	switch($type) {
		case 'projects':
		$query = "SELECT name, email FROM #__users WHERE id = '$row->contactid' OR id = '$row->manager'";
		$database->setQuery($query);
		$names = $database->loadObjectList();
		
		foreach ($names as $name) {
			$variables = array("%CLIENT_NAME%","%PROJECT_NAME%", "%LINK%","%COMPANY_NAME%");
			$values = array($name->name,$row->subject,$link,$jfConfig['company_name']);	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
			$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";
	
			$to = $name->email;

			$emailsubject = str_replace($variables,$values,$jfConfig['new_project_subject']);
			$contents = nl2br(str_replace($variables,$values,$jfConfig['new_project_email']));

			mail($to,$emailsubject,$contents,$headers);
		}
		break;	
		
		case 'tasks':
		$query = "SELECT name, email FROM #__users WHERE id = '$row->manager' OR id = '$row->assignedto'";
		$database->setQuery($query);
		$names = $database->loadObjectList();
		$query = "SELECT subject FROM #__jprojects WHERE id = '$row->projectid'";
		$database->setQuery($query);
		$project = $database->loadResult();	
		
		foreach ($names as $name) {
			$variables = array("%CLIENT_NAME%","%PROJECT_NAME%","%TASK_NAME%","%LINK%","%COMPANY_NAME%");
			$values = array($name->name,$project,$row->subject,$link, $jfConfig['company_name']);	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
			$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";
	
			$to = $name->email;

			$emailsubject = str_replace($variables,$values,$jfConfig['new_task_subject']);
			$contents = nl2br(str_replace($variables,$values,$jfConfig['new_task_email']));

			mail($to,$emailsubject,$contents,$headers);		
		}
		break;

		case 'documents':
		$query = "SELECT u.name, u.email"
		."\n FROM #__users as u, #__jprojects as p"
		."\n WHERE (u.id = p.contactid OR u.id = p.manager)"
		."\n AND p.id = '$row[projectid]'";
		$database->setQuery($query);
		$names = $database->loadObjectList();
		
		$query = "SELECT subject FROM #__jprojects WHERE id = '$row[projectid]'";
		$database->setQuery($query);
		$project = $database->loadResult();

		foreach ($names as $name) {
			$variables = array("%CLIENT_NAME%","%PROJECT_NAME%", "%DOCUMENT_NAME%","%LINK%","%COMPANY_NAME%");
			$values = array($name->name,$project,$row['filename'],$link, $jfConfig['company_name']);	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
			$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";
	
			$to = $name->email;

			$emailsubject = str_replace($variables,$values,$jfConfig['new_document_subject']);
			$contents = nl2br(str_replace($variables,$values,$jfConfig['new_document_email']));

			mail($to,$emailsubject,$contents,$headers);
		}	
		break;
	}
}
}