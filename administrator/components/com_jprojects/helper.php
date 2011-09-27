<?php

class jProjectsHelper { 

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
function projectPopup($option) { 
	$database	=& JFactory::getDBO();
	global $mainframe, $jfConfig;

if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
	$auth = " AND (manager = '$my->id')";
} else {
	$auth= '';
}


	$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart	= $mainframe->getUserStateFromRequest($context.'limitstart', 'limitstart', 0, 'int');
	$limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );


if (isset($_REQUEST['keyword'])) {
	$keyword = $_REQUEST['keyword'];
	$wheres = array();
	$wheres2[] 	= "LOWER(subject) LIKE LOWER('%$keyword%')";
	$wheres2[] 	= "LOWER(description) LIKE LOWER('%$keyword%')";
	$where 		= ' AND (' . implode( ') OR (', $wheres2 ) . ')';



} elseif(isset($_REQUEST['alpha'])) {
	$keyword = $_REQUEST['alpha'];
	$where 	= " AND LOWER(subject) LIKE LOWER('$keyword%')";

} else {
	$where = '';
}
	$query = "SELECT COUNT(*) FROM #__jprojects WHERE published = '1'".$where.$auth;

	$database->setQuery($query);
	$total = $database->loadResult();
	
	if ( $total <= $limit ) {
		$limitstart = 0;
	}

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

	$query = "SELECT * FROM #__jprojects WHERE published = '1'".$where.$auth;
	$database->setQuery($query, $pagination->limitstart, $pagination->limit);
	$rows  = $database->loadObjectList();
	HTML_cP::projectPopup($option, $rows);

 }

function taskPopup($option) { 
	$database	=& JFactory::getDBO();
	global $mainframe, $jfConfig;

if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
	$auth = " AND (manager = '$my->id')";
} else {
	$auth= '';
}


	$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart	= $mainframe->getUserStateFromRequest($context.'limitstart', 'limitstart', 0, 'int');
	$limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );


if (isset($_REQUEST['keyword'])) {
	$keyword = $_REQUEST['keyword'];
	$wheres = array();
	$wheres2[] 	= "LOWER(subject) LIKE LOWER('%$keyword%')";
	$wheres2[] 	= "LOWER(description) LIKE LOWER('%$keyword%')";
	$where 		= ' AND (' . implode( ') OR (', $wheres2 ) . ')';



} elseif(isset($_REQUEST['alpha'])) {
	$keyword = $_REQUEST['alpha'];
	$where 	= " AND LOWER(subject) LIKE LOWER('$keyword%')";

} else {
	$where = '';
}
	$query = "SELECT COUNT(*) FROM #__jprojects WHERE published = '1'".$where.$auth;

	$database->setQuery($query);
	$total = $database->loadResult();
	
	if ( $total <= $limit ) {
		$limitstart = 0;
	}

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

	$query = "SELECT * FROM #__jtasks WHERE published = '1'".$where.$auth;
	$database->setQuery($query, $pagination->limitstart, $pagination->limit);
	$rows  = $database->loadObjectList();
	HTML_cP::taskPopup($option, $rows);

 }
 
function milestonePopup($option, $uid) {
	$database	=& JFactory::getDBO();
	global $mainframe;

		$row = new milestones($database);
		if($uid){
			$row -> load($uid[0]);
		}
	HTML_cP::milestonePopup($option, $row);
}

function timelinePopup($option, $uid) {
	$database	=& JFactory::getDBO();
	global $mainframe;

		$row = new projects($database);
		if($uid){
			$row -> load($uid[0]);
		}
		
		$query = "SELECT t.id, t.subject, t.startdate, t.completiondate FROM #__jtasks as t WHERE t.projectid='$row->id' ORDER BY 'startdate' ASC";
		$database->setQuery($query);
		$tasks = $database->loadObjectList();
		
		$query = "SELECT * FROM #__jmilestones WHERE projectid='$row->id' ORDER BY 'startdate' ASC";
		$database->setQuery($query);
		$milestones = $database->loadObjectList();
		
		$database->setQuery( "SELECT count(*) FROM #__jtasks WHERE projectid='$row->id'" );
		$totalTasks = $database->loadResult();
		
		$database->setQuery( "SELECT count(*) FROM #__jtasks WHERE projectid='$row->id' AND stage='Completed'" );
		$totalCTasks = $database->loadResult();
		
		$database->setQuery( "SELECT count(*) FROM #__jmilestones WHERE projectid='$row->id'" );
		$totalMilestones = $database->loadResult();

		$database->setQuery( "SELECT count(*) FROM #__jmilestones WHERE projectid='$row->id' AND completed=1" );
		$totalCMilestones = $database->loadResult();
				
	HTML_cP::timelinePopup($option, $row, $tasks, $milestones, $totalTasks, $totalMilestones, $totalCTasks, $totalCMilestones);
}


function checkAuth($type, $row) {
	global $jfConfig, $my;
	if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
		switch ($type) {
			case 'project':
			if ($row->manager != $my->id) { mosRedirect( 'index2.php?option=com_jprojects', _NOT_AUTH ); }
			break;
			
			case 'task':
			if ($row->manager != $my->id) { mosRedirect( 'index2.php?option=com_jprojects', _NOT_AUTH ); }
			break;	
			
			case 'time':
			if ($my->gid != '25') { mosRedirect( 'index2.php?option=com_jprojects', _NOT_AUTH ); }
			break;
			
			case 'file':
			if ($row->author != $my->id) { mosRedirect( 'index2.php?option=com_jprojects', _NOT_AUTH ); }
			break;
			
		}
	}
}
function managerList($row) {
	$database = & JFactory::getDBO(); global $my;
	
	$query = "SELECT * FROM #__users WHERE block='0' and gid > '23' ";
	$database->setQuery($query);
	$manager_rows = $database->loadObjectList();
		
	$lists = array();	
 	$m_array = array();
	$m_array[] = JHTML::_('select.option','', 'None');
	foreach ($manager_rows as $m) {
	$m_array[] = JHTML::_('select.option',$m->id, $m->username);
	}
	
 	$lists['managers'] = JHTML::_('select.genericlist', $m_array, 'manager', 'class="inputbox"', 'value', 'text', $row->manager );
	return $lists;
}

function taskStage($row) {
$database = & JFactory::getDBO();
global $my;
		
	$lists = array();	
 	$t_array = array();
	$t_array[] = JHTML::_('select.option', 'Not Started','Not Started');
	$t_array[] = JHTML::_('select.option', 'In Progress','In Progress');
	$t_array[] = JHTML::_('select.option', 'Completed','Completed');
	$t_array[] = JHTML::_('select.option', 'Pending Input','Pending Input');	
	$t_array[] = JHTML::_('select.option', 'Deferred','Deferred');
	$t_array[] = JHTML::_('select.option', 'Planned','Planned');	
	
 	$lists['stages'] = JHTML::_('select.genericlist',$t_array, 'stage', 'class="inputbox"', 'value', 'text', $row->stage );
	return $lists;
}
function taskStageProjects($i, $row) {
$database = & JFactory::getDBO();
global $my;
		
	$lists = array();	
 	$t_array = array();
	$t_array[] = JHTML::_('select.option', 'Not Started','Not Started');
	$t_array[] = JHTML::_('select.option', 'In Progress','In Progress');
	$t_array[] = JHTML::_('select.option', 'Completed','Completed');
	$t_array[] = JHTML::_('select.option', 'Pending Input','Pending Input');	
	$t_array[] = JHTML::_('select.option', 'Deferred','Deferred');
	$t_array[] = JHTML::_('select.option', 'Planned','Planned');	
	
 	$lists['stages'] = JHTML::_('select.genericlist',$t_array, 't_stage'.$i, 'class="inputbox"', 'value', 'text', $row->stage );
	return $lists;
}

function taskPriority($row) {
$database = & JFactory::getDBO();
global $my;
		
	$lists = array();	
 	$p_array = array();
	$p_array[] = JHTML::_('select.option', 'Low','Low');
	$p_array[] = JHTML::_('select.option', 'Medium','Medium');
	$p_array[] = JHTML::_('select.option', 'High','High');
	$p_array[] = JHTML::_('select.option', 'Urgent','Urgent');	

 	$lists['priority'] = JHTML::_('select.genericlist',$p_array, 'priority', 'class="inputbox"', 'value', 'text', $row->priority );
	return $lists;
}

function assignedTo($row) {
$database = & JFactory::getDBO();
global $my;
	
	$query = "SELECT * FROM #__users WHERE block='0' and gid > '18' ";
	$database->setQuery($query);
	$assigned = $database->loadObjectList();	

	$lists = array();	
 	$a_array = array();
	$a_array[] = JHTML::_('select.option', '','None');

	foreach ($assigned as $a) {
		$a_array[] = JHTML::_('select.option', $a->id, $a->username);
	}

 	$lists['assignedto'] = JHTML::_('select.genericlist',$a_array, 'assignedto', 'class="inputbox"', 'value', 'text', $row->assignedto );
	return $lists;
}

function timeList($time, $label) {
	
	$timestamp = ($time != "") ? strtotime($time) : strtotime("8:00 AM");
	
	for ($i=1; $i<13; $i++) {
		$hours[] = JHTML::_('select.option', $i,$i);
	}
	$hour = JHTML::_('select.genericlist',$hours, $label.'_h', 'class="inputbox"', 'value', 'text', date("g", $timestamp));
	
	$min[] = JHTML::_('select.option', '00',':00');
	$min[] = JHTML::_('select.option', '15',':15');
	$min[] = JHTML::_('select.option', '30',':30');
	$min[] = JHTML::_('select.option', '45',':45');
	
	$minute = JHTML::_('select.genericlist',$min, $label.'_min', 'class="inputbox"', 'value', 'text', date("i", $timestamp));
	
	$mer[] = JHTML::_('select.option', 'AM','AM');
	$mer[] = JHTML::_('select.option', 'PM','PM');
	
	$meridiem = JHTML::_('select.genericlist',$mer, $label.'_mer', 'class="inputbox"', 'value', 'text', date("A", $timestamp));
	
	$time_select = $hour.$minute.$meridiem;
	return($time_select);

}

function startTimer($option) {
$user =& JFactory::getUser();
?>
<form name='adminForm' id='adminForm' action='index2.php' method='post'>
<input type='hidden' name='option' value='com_jprojects' />
<input type='hidden' name='task' value='saveTime' />
<input type='hidden' id='starttime' name='starttime' value=''/>
<input type='hidden' id='completiontime' name='completiontime' value=''/>
<input type='hidden' name='taskid' value='<?php echo $_REQUEST['taskid']; ?>' />
<input type='hidden' name='projectid' value='<?php echo $_REQUEST['projectid']; ?>' />
<input type='hidden' name='user' value='<?php echo $user->get('id') ?>' />
<input type='hidden' name='tmpl' value='component' />
<table width="100%" cellpadding="5" class="tablelist">
	<tr>
		<td class='tableListHeader'>Time Tracker</td>
    </tr>
	<tr>	
		<td width='150px' id='time' align='center' class='timer'>&nbsp;</td>
	</tr>
	<tr>
		<td align='center'>
		<input type='submit' name='Stop' value='Stop'></td>
	</tr>
</table>
</form>
<script type='text/javascript'>start_countup();</script>
<?php 
}

}
?>