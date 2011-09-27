<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class jProjectsController extends JController
{
function addFile($option) { 
	$database = & JFactory::getDBO();
	$user =& JFactory::getUser();

	$pid = JRequest::getVar('pid');
	$p = new projects($database);
	$p->load($pid);
	if ($p->manager != $user->get('id') && $p->contactid != $user->get('id')) {
		JText::_('NOTAUTH'); 
		return;	
	}
	
	$row = new documents($database);
	$row->projectid = $pid;
	$row->dateadded = date("Y-m-d H:i:s");
	$row->author = $user->get('id');


	HTML_JPROJECTS::addFile($option, $row);

}
function saveFile($option) { 
	$database = & JFactory::getDBO();
	$user =& JFactory::getUser();
	global $jfConfig, $mainframe;

	
	$directory = "components/com_jprojects/documents/";
	$file = new documents($database);

		if (!$file->bind( $_POST )) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		if ($file->id == "" && $jfConfig['auto_email'] == '1') {
				jProjectsController::sendEmail($file);
			}
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
				echo "<script>alert('Error: Couldn't store file - Please check directory permissions.');</script>\n";
			}
		} else {

			$file->filelocation = $_POST['filelocation'];
		}
		if (!$file->store()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}	
		echo "<script type='text/javascript'>window.parent.document.getElementById('sbox-window').close(); window.parent.location.reload(true);</script>";


}
function myProjects($option) {
	$database = & JFactory::getDBO();
	$user =& JFactory::getUser();	
	$userid = $user->get('id');
	
	if (isset($_REQUEST['limit'])) { $limit=$_REQUEST['limit']; }
	if (isset($_REQUEST['limitstart'])) { $limitstart=$_REQUEST['limitstart']; }
	
	$where = ($user->get('gid') == '2') ? "AND j.manager = '$userid'" : "AND j.contactid = '$userid'";
	
	$query = "SELECT COUNT(*) FROM #__jprojects as j"
	."\n WHERE published = '1'"
	."\n $where"
	."\n ORDER BY j.id, subject DESC";
	
	$database->setQuery($query);
	$total = $database->loadResult();

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);
	
	$query = "SELECT j.id, j.subject, j.startdate, j.completiondate, "
	."\n u.username, u.name, u.email, m.email as owneremail, m.username as owner, m.name as ownername FROM #__jprojects as j"
	."\n LEFT OUTER JOIN #__users AS u on j.contactid = u.id LEFT OUTER JOIN #__users AS m on j.manager = m.id"
	."\n WHERE published = '1'"
	."\n $where"
	."\n ORDER BY j.id, subject DESC";

	$database->setQuery($query, $pagination->limitstart, $pagination->limit );
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}

	HTML_JPROJECTS::myProjects($option, $rows, $pagination);

}

function viewProject($option, $id) {
$database = & JFactory::getDBO();
$user =& JFactory::getUser();

	$project = new projects($database);
	$project->load($id);

	if (!(($user->get('gid') == '25' && $project->manager == $user->get('id')) || ($user->get('gid') == '18' && $project->contactid == $user->get('id')))) {
	JText::_('NOTAUTH'); 
		return;
	}
	$query = "SELECT * FROM #__jmilestones WHERE projectid='$project->id' ORDER BY 'startdate' ASC";
	$database->setQuery($query);
	$milestones = $database->loadObjectList();

	$query = "SELECT * FROM #__jdocuments WHERE projectid='$project->id' ORDER BY 'startdate' ASC";
	$database->setQuery($query);
	$files = $database->loadObjectList();

	$query = "SELECT * FROM #__jtasks WHERE projectid='$project->id' ORDER BY 'startdate' ASC";
	$database->setQuery($query);
	$tasks = $database->loadObjectList();
	
	$query = "SELECT name, username, email FROM #__users WHERE id='$project->contactid'";
	$database->setQuery($query);
	$user = $database->loadRow();

	$query = "SELECT name, username, email FROM #__users WHERE id='$project->manager'";
	$database->setQuery($query);
	$manager = $database->loadRow();

	HTML_JPROJECTS::viewProject($project, $milestones, $files, $tasks, $user, $manager);
}

//Invoice Functions

function myTasks($option) {
$database = & JFactory::getDBO();
$user =& JFactory::getUser();
global $mainframe;

	if (isset($_REQUEST['limit'])) { $limit=$_REQUEST['limit']; }
	if (isset($_REQUEST['limitstart'])) { $limitstart=$_REQUEST['limitstart']; }	$params = new stdClass();
	
$where = ($user->get('gid') == '25') ? "AND (t.manager = '$user->get('id')' OR t.assignedto = '$user->get('id')')" : "AND (t.contactid = '$user->get('id')' OR t.assignedto = '$user->get('id')')";

$query = "SELECT COUNT(*)"
	."\n FROM #__jtasks as t "
	."\n LEFT JOIN #__jprojects as p on t.projectid = p.id"
	."\n WHERE t.published ='1'"
	."\n ".$where
	."\n ORDER BY t.completiondate DESC";

$database->setQuery($query);
$total = $database->loadResult();

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

$query = "SELECT t.id, t.subject, t.startdate, t.completiondate, t.stage, p.id as pid, p.subject as projectname, p.contactid as pcontact, p.manager as pmanager"
	."\n FROM #__jtasks as t "
	."\n LEFT JOIN #__jprojects as p on t.projectid = p.id"
	."\n WHERE t.published ='1'"
	."\n ".$where
	."\n ORDER BY t.completiondate DESC";
	
$database->setQuery($query, $pagination->limitstart, $pagination->limit);
$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}

HTML_JPROJECTS::myTasks($option, $rows, $pagination);
}

function viewTask($option, $id) {
$database = & JFactory::getDBO();
$user = & JFactory::getUser();

	$task = new tasks($database);
	$task->load($id);
	
	$query = "SELECT name, username, email FROM #__users WHERE id='$task->contactid'";
	$database->setQuery($query);
	$username = $database->loadRow();

	$query = "SELECT name, username, email FROM #__users WHERE id='$task->manager'";
	$database->setQuery($query);
	$manager = $database->loadRow();
	
	$query = "SELECT name, username, email FROM #__users WHERE id='$task->assignedto'";
	$database->setQuery($query);
	$assignedto = $database->loadRow();
	
	$query = "SELECT id, subject, contactid, manager FROM #__jprojects WHERE id='$task->projectid'";
	$database->setQuery($query);
	$project = $database->loadObjectList();
	
	if (!(($user->get('gid') == '25' && $task->manager == $user->get('id')) || ($user->get('id')==$task->assignedto))) {
		if ($project[0]->contactid != $user->get('id') && $project[0]->manager != $user->get('id')) {
			mosNotAuth();
			return;
		}
	}
	
	HTML_JPROJECTS::viewTask($option, $task, $user, $manager, $project[0], $assignedto);
}

function homePage($option) {


	HTML_JPROJECTS::homePage();
}


function sendEmail($row) {
	$database = & JFactory::getDBO();
	global $jfConfig;
	
	$link = "index.php?option=com_jprojects&task=myProjects";
	
		$query = "SELECT u.name, u.email"
		."\n FROM #__users as u, #__jprojects as p"
		."\n WHERE (u.id = p.contactid OR u.id = p.manager)"
		."\n AND p.id = '$row->projectid'";
		$database->setQuery($query);
		$names = $database->loadObjectList();
		
		$query = "SELECT subject FROM #__jprojects WHERE id = '$row->projectid'";
		$database->setQuery($query);
		$project = $database->loadResult();

		foreach ($names as $name) {
			$variables = array("%CLIENT_NAME%","%PROJECT_NAME%", "%DOCUMENT_NAME%","%LINK%","%COMPANY_NAME%");
			$values = array($name->name,$project,$row->filename,$link, $jfConfig['company_name']);	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
			$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";
	
			$to = $name->email;

			$emailsubject = str_replace($variables,$values,$jfConfig['new_document_subject']);
			$contents = nl2br(str_replace($variables,$values,$jfConfig['new_document_email']));

			mail($to,$emailsubject,$contents,$headers);

		}	

}
}
?>