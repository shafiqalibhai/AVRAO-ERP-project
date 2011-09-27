<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class jAccessController extends JController
{

// Ticket Functions
function managerList($row) {
	$database = & JFactory::getDBO();
	$user =& JFactory::getUser();
	
	$query = "SELECT * FROM #__users WHERE block='0' and gid > '23' ";
	$database->setQuery($query);
	$manager_rows = $database->loadObjectList();
		
	$lists = array();	
 	$m_array = array();
	$m_array[] = JHTML::_('select.option','', 'None');
	foreach ($manager_rows as $m) {
	$m_array[] = JHTML::_('select.option',$m->id, $m->username);
	}
	
 	$lists['managers'] = JHTML::_('select.genericlist', $m_array, 'groupowner', 'class="inputbox"', 'value', 'text', $row->groupowner );
	return $lists;
}

function listGroups ($option, $type) {
	$database =& JFactory::getDBO();
	global $mainframe;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );

	if(JRequest::getVar('filter')!='') {
		$filter = JRequest::getVar('filter');

 	   $words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.groupname) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	} elseif(JRequest::getVar('alpha')!='') {
		$alpha = JRequest::getVar('alpha');

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.groupname) LIKE '$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	}

	switch ( $type ) {

		case 'unpublished':
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jaccessgroups as j WHERE (published = 0  $where)" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

			jimport('joomla.html.pagination');
			$pagination = new JPagination($total, $limitstart, $limit);
	
			$database->setQuery("SELECT * FROM #__jaccessgroups as j WHERE (published = 0  $where)"
			. "\n ORDER BY groupname, id DESC"
			. "\n LIMIT $pagination->limitstart,$pagination->limit");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}
			break;

		case 'all':
		default:
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jaccessgroups as j WHERE (published >= 0 $where)" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

			jimport('joomla.html.pagination');
			$pagination = new JPagination($total, $limitstart, $limit);

			$database->setQuery("SELECT * FROM #__jaccessgroups as j WHERE (published >= 0 $where)"
			. "\n ORDER BY groupname, id DESC"
			. "\n LIMIT $pagination->limitstart,$pagination->limit");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}
		}
	HTML_groups::listGroups($option, $rows, $pagination);
}
function editGroup($option, $uid) {
	$database =& JFactory::getDBO();
	$row = new jaccessgroups($database);
	if($uid){
		$row -> load($uid[0]);
		}

    $musers = array();
    $toAddUsers = array();

    // get selected members
    if ($row->groupmembers) {
        $database->setQuery("SELECT id,name,username "
                . "\n FROM #__users  WHERE gid > '18'"
                . "\n AND id IN (" . $row->groupmembers . ") "
                . "\n ORDER BY name ASC"
            );
        $usersInGroup = $database->loadObjectList();

        if (!$database->getErrorNum()) {
        	
            foreach($usersInGroup as $user) {
                $musers[] = JHTML::_('select.option',$user->id,
                        $user->id . "-" . $user->name . " (" . $user->username . ")"
                        );
            }
        }
    }
	
    // get non selected members
    $query = "SELECT id,name,username FROM #__users WHERE gid > '18' ";
    if ($row->groupmembers) {
        $query .= "\n AND id NOT IN (" . $row->groupmembers . ") " ;
    }
    $query .= "\n ORDER BY name ASC";
    $database->setQuery($query);
    $usersToAdd = $database->loadObjectList();
    foreach($usersToAdd as $user) {
        $toAddUsers[] = JHTML::_('select.option', $user->id,
                        $user->id . "-" . $user->name . " (" . $user->username . ")"
                        );
    }

    $usersList = JHTML::_('select.genericlist', $musers, 'users_selected[]',
        'class="inputbox boxsize" size="20" onDblClick="moveOptions(document.adminForm[\'users_selected[]\'], document.adminForm.users_not_selected)" multiple="multiple"', 'value', 'text', null);
    $toAddUsersList = JHTML::_('select.genericlist', $toAddUsers,
        'users_not_selected', 'class="inputbox boxsize" size="20" onDblClick="moveOptions(document.adminForm.users_not_selected, document.adminForm[\'users_selected[]\'])" multiple="multiple"',
        'value', 'text', null);
		
	$groupOwner = jAccessController::managerList($row);

	HTML_groups::editGroup($option, $row, $usersList, $toAddUsersList, $groupOwner);
}
function saveGroup ($option) {
	$database =& JFactory::getDBO();
	global $mainframe;
//	print_r($_POST); exit();
	
	$row = new jaccessgroups($database);
	$msg = 'Saved Group';
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->jaccounts_quotes = count(JRequest::getVar('jaccounts_quotes', array()));
	$row->jaccounts_invoices = count(JRequest::getVar('jaccounts_invoices', array()));
	$row->jaccounts_services = count(JRequest::getVar('jaccounts_services', array()));
	$row->jcontacts_leads = count(JRequest::getVar('jcontacts_leads', array()));
	$row->jcontacts_contacts = count(JRequest::getVar('jcontacts_contacts', array()));
	$row->jcontacts_accounts = count(JRequest::getVar('jcontacts_accounts', array()));
	$row->jprojects_tasks = count(JRequest::getVar('jprojects_tasks', array()));
	$row->jprojects_projects = count(JRequest::getVar('jprojects_projects', array()));
	$row->jprojects_timer = count(JRequest::getVar('jprojects_timer', array()));
	$row->jsupport_tickets = count(JRequest::getVar('jsupport_tickets', array()));
	$row->jsupport_faqs = count(JRequest::getVar('jsupport_faqs', array()));
	$row->jsupport_categories = count(JRequest::getVar('jsupport_categories', array()));
	

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

    $members = JRequest::getVar('users_selected', array());
    $members_imploded = implode(',', $members);

    $database->setQuery("UPDATE #__jaccessgroups SET groupmembers='" . $members_imploded . "' WHERE id=". (int) $row->id);
    $database->query();
	
	$mainframe->redirect( 'index.php?option=com_jaccess&task=listGroups', $msg );
}
function deleteGroup ($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );

			$msg = "Group(s) deleted";
			$query = "DELETE FROM #__jaccessgroups"
			. "\n WHERE ( $cids )"
			;
	
			$database->setQuery( $query );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}

	}

	$mainframe->redirect( 'index.php?option=com_jaccess&task=listGroups', $msg );
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
	$database = & JFactory::getDBO();
	global $mainframe;
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
	}
	$type 		= JRequest::getVar('type');

	$query = "UPDATE #__j" . $type
	. "\n SET published = " . (int) $state
	. "\n WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	switch ( $state ) {

		case 1:
			$query = "SELECT * FROM #__j". $type
			."\n WHERE ( $cids )"
			;
			$database->setQuery($query);
			$rows = $database->loadObjectList();

			$msg = $total .' Item(s) successfully Published';
			break;

		case 0:
		default:
			$msg = $total .' Item(s) successfully Unpublished';
			break;
	}

	$rtask = JRequest::getVar('returntask');
	if ( $rtask ) {
		$rtask = '&task='. $rtask;
	} else {
		$rtask = '';
	}

	$mainframe->redirect( 'index.php?option='. $option . $rtask .'&mosmsg='. $msg );
}

// Configuration 

function showConfig( $option ) {

	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	global $acl, $jfConfig, $mainframe;

	$configfile = JPATH_SITE."/administrator/components/com_jaccess/jaccess.config.php";
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
	
	$yesno = array();
	$yesno[] = JHTML::_('select.option','1','Yes');
	$yesno[] = JHTML::_('select.option','0','No');
	
	$lists['send_email'] = JHTML::_('select.genericlist',$yesno, 'cfg_send_email', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['send_email'] );

	HTML_cP::showConfig( $jfConfig, $lists, $option );
}
function saveConfig ( $option ) {
	
	global $mainframe;

	$configfile = JPATH_SITE."/administrator/components/com_jaccess/jaccess.config.php";
	
   //Add code to check if config file is writeable.
   if (!is_callable(array("JFile","write")) && !is_writable($configfile)) {
      @chmod ($configfile, 0766);
      if (!is_writable($configfile)) {
         $mainframe->redirect("index.php?option=$option", "FATAL ERROR: Config File Not writeable" );
      }
   }

   $txt = "<?php\n";
   foreach ($_POST as $k=>$v) {
   	  if (is_array($v)) $v = implode("|*|", $v);
      if (strpos( $k, 'cfg_' ) === 0) {
         if (!get_magic_quotes_gpc()) {
            $v = addslashes( $v );
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
      $mainframe->redirect( "index.php?option=com_jaccess", "Configuration file saved" );
   } else {
      $mainframe->redirect( "index.php?option=$option", "FATAL ERROR: File could not be opened." );
   }
}
function sendEmail($module, $status, $id ) {

	$database =& JFactory::getDBO();
	global $jfConfig;
	//Email Client
	
		$row = new tickets($database);
		$row->load($id);
	
		$sql = "SELECT name, email FROM #__users WHERE id = '$row->contactid'";
		$database->setQuery($sql);
		$name = $database->loadRow();		
		
	
		$variables = array("%CLIENT_NAME%","%".$module."_NAME%","%".$module."_DESCRIPTION%","%COMPANY_NAME%", "%TICKET_PRIORITY%");
		$values = array($name[0],$row->subject,$row->description,$jfConfig['company_name'], $row->priority);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
		$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";

		$to = $name[1];
			
		$module_subject = strtolower($status.'_'.$module.'_subject');
		$module_email = strtolower($status.'_'.$module.'_email');
		$emailsubject = str_replace($variables,$values,$jfConfig[$module_subject]);
		$contents = nl2br(str_replace($variables,$values,$jfConfig[$module_email]));
		
		mail($to,$emailsubject,$contents,$headers);

}
function clientPopup($option) { 

	$database	=& JFactory::getDBO();
	global $mainframe;

	$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart	= $mainframe->getUserStateFromRequest($context.'limitstart', 'limitstart', 0, 'int');
	$limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );


if ($_REQUEST['keyword']!='' || isset($_REQUEST['Submit'])) {
	unset($_REQUEST['alpha']);
	$keyword = $_REQUEST['keyword'];
	$wheres = array();
	$wheres2[] 	= "LOWER(name) LIKE LOWER('%$keyword%')";
	$wheres2[] 	= "LOWER(username) LIKE LOWER('%$keyword%')";
	$wheres2[] 	= "LOWER(email) LIKE LOWER('%$keyword%')";
	$where 		= '(' . implode( ') OR (', $wheres2 ) . ')';

} elseif($_REQUEST['alpha']!='') {
	$keyword = $_REQUEST['alpha'];
	$where 	= "LOWER(name) LIKE LOWER('$keyword%')";

	
} else {
	$where = '1=1';
}
	$query = "SELECT COUNT(*) FROM #__users WHERE ($where) AND block='0'";
	$database->setQuery($query);
	$total = $database->loadResult();

	if ( $total <= $limit ) {
		$limitstart = 0;
	}

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

	$query = "SELECT * FROM #__users WHERE ($where) AND block='0'";
	$database->setQuery($query, $pagination->limitstart, $pagination->limit);
	$rows = $database->loadObjectList();
	
	HTML_cP::clientPopup($option, $rows);

 }

}
?>