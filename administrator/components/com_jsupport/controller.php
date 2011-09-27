<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class jSupportController extends JController
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
	
 	$lists['managers'] = JHTML::_('select.genericlist', $m_array, 'manager', 'class="inputbox"', 'value', 'text', $row->manager );
	return $lists;
}


function editTicket($option, $uid) {
		$database =& JFactory::getDBO();
		$row = new tickets($database);
		if($uid){
			$row -> load($uid[0]);
			$query = "SELECT * FROM #__jsupportcomments WHERE ticketid='$row->id' ORDER BY id ASC";
			$database->setQuery($query);
			$ticketcomments = $database->loadObjectList();
		}
	
		$query = "SELECT * FROM #__users WHERE block = '0' AND id='$row->contactid'";
		$database->setQuery($query);
		$user = $database->loadRow();

		$query = "SELECT * FROM #__jsupportcategories WHERE published='1'";
		$database->setQuery($query);
		$categories = $database->loadObjectList();

		$lists = jSupportController::managerList($row);

	HTML_tickets::editTicket($option, $row, $user, $ticketcomments, $lists, $categories);
}
function viewTicket($option, $uid) {
		$database =& JFactory::getDBO();
		$row = new tickets($database);
		if($uid){
			$row -> load($uid[0]);
			$query = "SELECT * FROM #__jsupportcomments WHERE ticketid='$row->id' ORDER BY id ASC";
			$database->setQuery($query);
			$ticketcomments = $database->loadObjectList();
		}
	
		$query = "SELECT * FROM #__users WHERE id='$row->contactid'";
		$database->setQuery($query);
		$user = $database->loadRow();

		$query = "SELECT * FROM #__users WHERE id='$row->manager'";
		$database->setQuery($query);
		$manager = $database->loadRow();
				
		$query = "SELECT * FROM #__jsupportcategories WHERE id='$row->category'";
		$database->setQuery($query);
		$category = $database->loadRow();
						
	HTML_tickets::viewTicket($option, $row, $user, $ticketcomments, $manager, $category);
}
function listTickets ($option, $type) {
	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	global $mainframe;
	
	
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
	
	if(JRequest::getVar('filter')!='') {
		$filter = JRequest::getVar('filter');

 	   $words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.description) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.solution) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	} elseif(JRequest::getVar('alpha')!='') {
		$alpha = JRequest::getVar('alpha');

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE '$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	}
	
	if($jfConfig['access_restrictions']=='on' && $my->gid != 25) {
		$auth = "( $user->get('id')=j.manager AND converted !='1')";
	} else {
		$auth = "converted !='1'";
	}	

	switch ( $type ) {

		case 'new':
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jtickets as j WHERE $auth ORDER BY created DESC" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

			$query = "SELECT j.id, subject, contactid, status, priority, created, manager, "
			."\n u.username, u.name, m.username as owner, m.name as ownername FROM #__jtickets as j"
			."\n LEFT OUTER JOIN #__users as u on j.contactid = u.id"
			."\n LEFT OUTER JOIN #__users as m on j.manager = m.id"
			."\n WHERE $auth $where ORDER BY created DESC"
			."\n LIMIT $pagination->limitstart,$pagination->limit";
			$database->setQuery($query);

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

			break;

		case 'open':
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jtickets WHERE (status !='Closed' AND $auth)" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

	
			$query = "SELECT j.id, subject, contactid, status, priority, created, manager, "
			."\n u.username, u.name, m.username as owner, m.name as ownername FROM #__jtickets as j"
			."\n LEFT OUTER JOIN #__users as u on j.contactid = u.id"
			."\n LEFT OUTER JOIN #__users as m on j.manager = m.id"
			."\n WHERE (status !='Closed' AND $auth $where) ORDER BY j.id, subject DESC"
			."\n LIMIT $pagination->limitstart,$pagination->limit";
			$database->setQuery($query);

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

			break;
			
		case 'all':
		default:
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jtickets WHERE $auth" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

				$query = "SELECT j.id, subject, contactid, status, priority, created, manager, "
			."\n u.username, u.name, m.username as owner, m.name as ownername FROM #__jtickets as j"
			."\n LEFT OUTER JOIN #__users as u on j.contactid = u.id"
			."\n LEFT OUTER JOIN #__users as m on j.manager = m.id"
			."\n WHERE $auth $where ORDER BY j.id, subject DESC"
			."\n LIMIT $pagination->limitstart,$pagination->limit";
			$database->setQuery($query);

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

			break;
		}

	HTML_tickets::listTickets($option, $rows, $pagination);
}
function saveTicket ($option) {
	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	global $mainframe, $jfConfig;
	$row = new tickets($database);
	$msg = 'Saved Ticket';

	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
			$row->id = (int) $row->id;

				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				} else { 
					$row->created = date('Y-m-d H:i:s' );
				}
			if ($row->created && strlen(trim( $row->created )) <= 10) {
				$row->created 	.= ' 00:00:00';
			}
			
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if($jfConfig['send_email'] == '1') {
		if ($_POST['id'] == '') {
			$status = 'new';
		} elseif($_POST['id'] != '') {
			$status = 'update';
		}
		jSupportController::sendEmail('TICKET',$status,$row->id);
	}

	$ticketid = $row->id;
	if($_REQUEST['comment'.$i] != '') {
	$comment = addslashes($_REQUEST['comment'.$i]);
			
		$query = "INSERT INTO #__jsupportcomments (ticketid, contactid, comment) VALUES ($ticketid, $row->contactid,'$comment')";
			$database->setQuery($query);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}	
	$mainframe->redirect( 'index2.php?option=com_jsupport&task=viewTicket&cid[]='.$row->id, $msg );
}
function deleteTicket ($option, $cid) {
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
		$iids = 'ticketid=' . implode( ' OR ticketid=', $cid );
		$query = "DELETE FROM #__jtickets"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
		
		$query = "DELETE FROM #__jsupportcomments"
		. "\n WHERE ( $iids )"
		;
		$database->setQuery( $query);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMSg()."'); window.history.go(-1); </script>\n";
		}
	}
	
	$msg = "Ticket(s) deleted";
	$mainframe->redirect( 'index2.php?option=com_jsupport', $msg );
}
function convertTicket ($option) {
	$database =& JFactory::getDBO();
	global $mainframe;
	// Save Converted Ticket
	$row = new tickets($database);
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->converted = 1;
	$f['created'] = $row->created;
	$f['subject'] = $row->subject;
	$f['description'] = $row->description;
	$f['category'] = $row->category;
	$f['solution'] = $row->solution;
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	// New FAQ
	$row = new faqs($database);
	if (!$row->bind( $f )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

		$query = "SELECT * FROM #__jsupportcategories WHERE published = '1'";
		$database->setQuery($query);
		$categories = $database->loadObjectList();

	HTML_faqs::editFaq($option, $row, $faqcomments, $categories);
}

// FAQ's Functions

function editFaq($option, $uid) {
		$database =& JFactory::getDBO();
		$row = new faqs($database);
		if($uid){
			$row -> load($uid[0]);
			$query = "SELECT * FROM #__jsupportcomments WHERE faqid='$row->id' ORDER BY id ASC";
			$database->setQuery($query);
			$faqcomments = $database->loadObjectList();
		}

		$query = "SELECT * FROM #__jsupportcategories WHERE published = '1'";
		$database->setQuery($query);
		$categories = $database->loadObjectList();

	HTML_faqs::editFaq($option, $row, $faqcomments, $categories);
	}
	
function viewFaq($option, $uid) {
		$database =& JFactory::getDBO();
		$row = new faqs($database);
		if($uid){
			$row -> load($uid[0]);
			$query = "SELECT * FROM #__jsupportcomments WHERE faqid='$row->id' ORDER BY id ASC";
			$database->setQuery($query);
			$faqcomments = $database->loadObjectList();

			$query = "SELECT * FROM #__jsupportcategories WHERE id='$row->category'";
			$database->setQuery($query);
			$category = $database->loadRow();
		}
	
	HTML_faqs::viewFaq($option, $row, $faqcomments, $category);
}

function listFaqs ($option) {
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
 	      $wheres2[] = "LOWER(j.subject) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.description) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.solution) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'WHERE (' . implode( (') OR ('), $wheres ) . ')';
	} elseif(JRequest::getVar('alpha')!='') {
		$alpha = JRequest::getVar('alpha');

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'WHERE (' . implode( (') OR ('), $wheres ) . ')';
	}

			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jfaqs as j $where" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);

	
			$database->setQuery("SELECT j.id, j.published, j.created, #__jsupportcategories.name, j.subject FROM #__jfaqs as j LEFT JOIN #__jsupportcategories on j.category = #__jsupportcategories.id $where"
			. "\n ORDER BY j.id, j.subject DESC"
			. "\n LIMIT $pagination->limitstart,$pagination->limit");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

	HTML_faqs::listFaqs($option, $rows, $pagination);
}
function saveFaq ($option) {
	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	
	global $mainframe;
	$row = new faqs($database);
	$msg = 'Saved FAQ';

	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
			$row->id = (int) $row->id;

				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				} else {
					$row->created = date( 'Y-m-d H:i:s' );
				}
				
			if ($row->created && strlen(trim( $row->created )) <= 10) {
				$row->created 	.= ' 00:00:00';
			}
			
	if($_REQUEST['comment']!='') {
	$faqid = $row->id;
	$comment = addslashes($_REQUEST['comment']);
	$database->setQuery("SELECT name, email FROM #__users WHERE id = '$user->get('id')'");
	$result = $database->loadRow();
	$creatorname = $result[0];
	$creatoremail = $result[1];
		$query = "INSERT INTO #__jsupportcomments (faqid, creatorname, creatoremail, comment, published) VALUES ($faqid,'$creatorname','$creatoremail','$comment','1')";
			$database->setQuery($query);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}	

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$mainframe->redirect( 'index2.php?option=com_jsupport&task=listFaqs', $msg );
}

function deleteFaq ($option, $cid) {
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
	$cids = 'id=' . implode( ' OR id=', $cid );
	$qids = 'faqid=' . implode( ' OR faqid=', $cid );
	$query = "DELETE FROM #__jfaqs"
	. "\n WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
	echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	
	$query = "DELETE FROM #__jsupportcomments"
	. "\n WHERE ( $qids )"
	;
	$database->setQuery( $query);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMSg()."'); window.history.go(-1); </script>\n";
	}
	}
	$msg = "FAQ(s) deleted";
	$mainframe->redirect( 'index2.php?option=com_jsupport&task=listFaqs', $msg );
}
function listCategories ($option) {
	$database =& JFactory::getDBO();
	global $mainframe;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );

			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jsupportcategories" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

			jimport('joomla.html.pagination');
			$pagination = new JPagination($total, $limitstart, $limit);

			$database->setQuery("SELECT * FROM #__jsupportcategories"
			. "\n ORDER BY name, id DESC"
			. "\n LIMIT $pagination->limitstart,$pagination->limit");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}
	HTML_cp::listCategories($option, $rows, $pagination);
}
function editCategory($option, $uid) {
	$database =& JFactory::getDBO();
	$row = new supportcategories($database);
	if($uid){
		$row -> load($uid[0]);
		}
	HTML_cp::editCategory($option, $row);
}
function saveCategory ($option) {
	$database =& JFactory::getDBO();
	global $mainframe;
	$row = new supportcategories($database);
	$msg = 'Saved Category';
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$mainframe->redirect( 'index2.php?option=com_jsupport&task=listCategories', $msg );
}
function deleteCategory ($option, $cid) {
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );

			$msg = "Category(s) deleted";
			$query = "DELETE FROM #__jsupportcategories"
			. "\n WHERE ( $cids )"
			;
	
			$database->setQuery( $query );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}

	}

	$mainframe->redirect( 'index2.php?option=com_jsupport&task=listCategories', $msg );
}

function listComments ($option, $type) {
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
 	      $wheres2[] = "LOWER(j.comment) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.creatorname) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.creatoremail) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	} elseif(JRequest::getVar('alpha')!='') {
		$alpha = JRequest::getVar('alpha');

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.comment) LIKE '$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	}

	switch ( $type ) {

		case 'unpublished':
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jsupportcomments as j WHERE (published = 0  AND ticketid='0' $where)" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

			jimport('joomla.html.pagination');
			$pagination = new JPagination($total, $limitstart, $limit);
	
			$database->setQuery("SELECT * FROM #__jsupportcomments as j WHERE (published = 0  AND ticketid='0' $where)"
			. "\n ORDER BY comment, id DESC"
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
			$database->setQuery( "SELECT count(*) FROM #__jsupportcomments as j WHERE (published >= 0 and ticketid='0' $where)" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();

			jimport('joomla.html.pagination');
			$pagination = new JPagination($total, $limitstart, $limit);

			$database->setQuery("SELECT * FROM #__jsupportcomments as j WHERE (published >= 0 and ticketid='0' $where)"
			. "\n ORDER BY comment, id DESC"
			. "\n LIMIT $pagination->limitstart,$pagination->limit");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}
		}
	HTML_faqs::listComments($option, $rows, $pagination);
}
function editComment($option, $uid) {
	$database =& JFactory::getDBO();
	$row = new supportcomments($database);
	if($uid){
		$row -> load($uid[0]);
		}
	HTML_faqs::editComment($option, $row);
}
function saveComment ($option) {
	$database =& JFactory::getDBO();
	$row = new supportcomments($database);
	$msg = 'Saved Comment';
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$mainframe->redirect( 'index2.php?option=com_jsupport&task=listComments', $msg );
}
function deleteComment ($option, $cid) {
	$database =& JFactory::getDBO();
	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	if (count( $cid )) {
		mosArrayToInts( $cid );
		$cids = 'id=' . implode( ' OR id=', $cid );

			$msg = "Comment(s) deleted";
			$query = "DELETE FROM #__jsupportcomments"
			. "\n WHERE ( $cids )"
			;
	
			$database->setQuery( $query );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}

	}

	$mainframe->redirect( 'index2.php?option=com_jsupport&task=listComments', $msg );
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
	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	global $task;
	if (count( $cid ) < 1) {
		$action = $state == 1 ? 'publish' : ($state == -1 ? 'archive' : 'unpublish');
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	mosArrayToInts( $cid );
	$total = count ( $cid );
	$cids = 'id=' . implode( ' OR id=', $cid );

	$type 		= strval( mosGetParam( $_POST, 'type', '' ) );

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

	$rtask = strval( mosGetParam( $_POST, 'returntask', '' ) );
	if ( $rtask ) {
		$rtask = '&task='. $rtask;
	} else {
		$rtask = '';
	}

	$mainframe->redirect( 'index2.php?option='. $option . $rtask .'&mosmsg='. $msg );
}

// Configuration 

function showConfig( $option ) {

	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	global $acl, $jfConfig, $mainframe;

	$configfile = JPATH_SITE."/administrator/components/com_jsupport/jsupport.config.php";
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
	
	$lists['send_email'] = JHTML::_('select.genericlist',$yesno, 'cfg_send_email', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['send_email'] );

	HTML_cP::showConfig( $jfConfig, $lists, $option );
}
function saveConfig ( $option ) {
	
	global $mainframe;

	$configfile = JPATH_SITE."/administrator/components/com_jsupport/jsupport.config.php";
	
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
      $mainframe->redirect( "index2.php?option=com_jsupport", "Configuration file saved" );
   } else {
      $mainframe->redirect( "index2.php?option=$option", "FATAL ERROR: File could not be opened." );
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