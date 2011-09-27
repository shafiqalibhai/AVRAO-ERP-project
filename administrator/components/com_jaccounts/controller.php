<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class jAccountsController extends JController
{
// Invoice Functions
function managerList($row=null) {
	$database = & JFactory::getDBO();
	$user =& JFactory::getUser();
	$gid = JRequest::getVar('gid');
	if ($gid != '') {
		$query = "SELECT groupmembers from #__jaccessgroups WHERE id = '$gid'";
		$database->setQuery($query);
		$group = $database->loadResult();
		$ids = "u.id = '".str_replace(",","' OR u.id = '",$group)."'";
	
		$query = "SELECT u.id, u.username, u.name FROM #__users AS u WHERE block='0' AND ($ids)  ";
		$database->setQuery($query);
		$manager_rows = $database->loadObjectList();
	
	 	$m_array = array();
		$m_array[] = JHTML::_('select.option','0', 'All');
		foreach ($manager_rows as $m) {
			$m_array[] = JHTML::_('select.option',$m->id, $m->name." [".$m->username."]");
		}
		
	 	$lists['mid'] = JHTML::_('select.genericlist', $m_array, 'mid', 'class="inputbox"', 'value', 'text', "" );
		echo $lists['mid'];
	}
	elseif($row) { 
		
		$query = "SELECT groupmembers from #__jaccessgroups WHERE id = '$row->gid'";
		$database->setQuery($query);
		$group = $database->loadResult();
		$ids = "u.id = '".str_replace(",","' OR u.id = '",$group)."'";
	
		$query = "SELECT u.id, u.username, u.name FROM #__users AS u WHERE block='0' AND ($ids)  ";
		$database->setQuery($query);
		$manager_rows = $database->loadObjectList();
	
	 	$m_array = array();
		$m_array[] = JHTML::_('select.option','0', 'All');
		foreach ($manager_rows as $m) {
			$m_array[] = JHTML::_('select.option',$m->id, $m->name." [".$m->username."]");
		}
		
	 	$lists['mid'] = JHTML::_('select.genericlist', $m_array, 'mid', 'class="inputbox"', 'value', 'text', $row->mid );
		return $lists['mid'];
	}
}

function editInvoice($option, $uid) {
		$database = & JFactory::getDBO();
		global $my, $jfConfig, $connection;
		$row = new invoices($database);
		if($uid){
			$row -> load($uid[0]);
			jAccessHelper::checkAuth($row);
				$query = "SELECT * FROM #__jservicerelation INNER JOIN #__jservices on #__jservicerelation.serviceid = #__jservices.id WHERE invoiceid='$row->id'";
				$database->setQuery($query);
				$appliedservices = $database->loadObjectList();
				
			$lists['mid'] = ($row->gid != '0') ? jAccountsController::managerList($row) : "&nbsp;";
		}
		if ($connection['jContacts']) {
			$query = "SELECT c.id, CONCAT(c.first_name,' ',c.last_name) as name, u.username"
			."\n FROM #__jcontacts AS c"
			."\n LEFT JOIN #__users AS u ON u.id = c.jid"
			."\n WHERE c.id = '$row->contactid'"
			;
		} else {
			$query = "SELECT * FROM #__users WHERE id='$row->contactid'";
		}
		$database->setQuery($query);
		$user = $database->loadRow();
		
		$query = "SELECT name FROM #__jaccounts WHERE id='$row->accountid'";
		$database->setQuery($query);
		$account = $database->loadResult();
		
		$query = "SELECT * FROM #__jservices";
		$database->setQuery($query);
		$services = $database->loadObjectList();
		
		if($uid) { 
			$default_method = $row->paymentmethod;
		} else { 
			$default_method = $jfConfig['payment_gateway'];
		}
		
		$paymentmethods = array();
		$p_array = array();
		$p_array[] = JHTML::_('select.option', '0', 'Offline');
		
		if($jfConfig['paypal_address']!='') {
		$p_array[] = JHTML::_('select.option', '1', 'PayPal');
		}
		if($jfConfig['google_merchant_id']!='') {
		$p_array[] = JHTML::_('select.option', '2', 'Google Checkout');
		}
		if($jfConfig['authorize_API']!='') {
		$p_array[] = JHTML::_('select.option', '3', 'Authorize.net');
		}
		if($jfConfig['2checkout_sid']!='') {
		$p_array[] = JHTML::_('select.option', '4', '2Checkout');
		}

		$paymentmethods['paymentmethods'] = JHTML::_('select.genericlist', $p_array, 'paymentmethod', 'class="inputbox"','value','text', $default_method );
		
	$lists['groups'] = jAccessHelper::managerList($row, 'invoices');

	HTML_invoices::editInvoice($option, $row, $user, $services, $appliedservices, $lists, $paymentmethods);
}
function viewInvoice($option, $uid) {
	global $connection;
		$database = & JFactory::getDBO();
		
		$row = new invoices($database);
		if($uid){
			$row -> load($uid[0]);
			jAccessHelper::checkAuth($row);
			$query = "SELECT * FROM #__jservicerelation INNER JOIN #__jservices on #__jservicerelation.serviceid = #__jservices.id WHERE invoiceid='$row->id'";
			$database->setQuery($query);
			$appliedservices = $database->loadObjectList();
			
			$query = "SELECT groupname from #__jaccessgroups WHERE id = $row->gid";
			$database->setQuery($query);
			$manager = $database->loadResult();

			
			if ($row->mid != '0') {
			$query = "SELECT * FROM #__users WHERE id='$row->mid'";
			$database->setQuery($query);
			$mid = $database->loadRow();
			$mid = ($mid[0]) ? $mid[1]." [".$mid[2]."]" : '';
			} elseif ($row->mid == '0' && $row->gid != '0') {
				$mid = "All";
			} else {
				$mid = "&nbsp;";
			}
		}
	
		if ($connection['jContacts']) {
			$query = "SELECT c.id, CONCAT(c.first_name,' ',c.last_name) as name, u.username"
			."\n FROM #__jcontacts AS c"
			."\n LEFT JOIN #__users AS u ON u.id = c.jid"
			."\n WHERE c.id = '$row->contactid'"
			;
		} else {
			$query = "SELECT * FROM #__users WHERE id='$row->contactid'";
		}

		$database->setQuery($query);
		$user = $database->loadRow();
		
		$user = ($connection['jContacts']) ? "<a href='index.php?option=com_jcontacts&task=viewContact&cid[]=".$user[0]."'>".$user[1]." [".$user[2]."]</a>" : $user[1]." [".$user[2]."]";
		
		$query = "SELECT * FROM #__jservices";
		$database->setQuery($query);
		$services = $database->loadObjectList();	
		
		if($row->paymentmethod==0) { $paymentmethod= "Offline"; } elseif ($row->paymentmethod==1) { $paymentmethod = "PayPal"; } elseif($row->paymentmethod==2) { $paymentmethod = "Google Checkout"; } elseif($row->paymentmethod==3) { $paymentmethod = "Authorize.net"; } elseif($row->paymentmethod==4) { $paymentmethod = "2Checkout"; }

	HTML_invoices::viewInvoice($option, $row, $user, $services, $appliedservices, $manager, $paymentmethod, $mid);
}
function listInvoices ($option, $auth=null) {
	$database = & JFactory::getDBO();
	global $mainframe, $jfConfig, $connection;
	
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );

	if($_REQUEST['filter']!='') {
		$filter = JRequest::getVar('filter');

 	   $words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(u.username) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(j.accountid) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		$where = ($auth == "") ? "WHERE " : "AND ";
	    $where .= '(' . implode( (') OR ('), $wheres ) . ')';
	} elseif($_REQUEST['alpha']!='') {
		$alpha = JRequest::getVar('alpha');
 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		$where = ($auth == "") ? "WHERE " : "AND ";
	    $where .= '(' . implode( (') OR ('), $wheres ) . ')';
	}

	if ($connection['jContacts']) {
		
		# get the total number of records
		$query = "SELECT count(*)"
		."\n FROM #__jinvoices as j"
		."\n LEFT JOIN #__jcontacts as c on c.id = j.contactid"
		."\n LEFT JOIN #__users as u on u.id = c.jid"
		."\n $auth $where";
		$database->setQuery($query);
		$total = $database->loadResult();
		echo $database->getErrorMsg();
	
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);
		
		$query = "SELECT j.id, subject, contactid, invoicestatus, total, validtill, j.gid, j.mid, g.groupname,"
		."\n j.published, u.username, CONCAT(c.first_name,' ', c.last_name) as name, m.username as owner, m.name as ownername FROM #__jinvoices as j"
		."\n LEFT OUTER JOIN #__jcontacts AS c on j.contactid = c.id"
		."\n LEFT OUTER JOIN #__users AS u on c.jid = u.id"
		."\n LEFT OUTER JOIN #__users AS m on j.mid = m.id"
		."\n LEFT OUTER JOIN #__jaccessgroups as g on j.gid = g.id"
		."\n $auth $where"
		."\n ORDER BY j.id, subject DESC"
		. "\n LIMIT $pagination->limitstart,$pagination->limit";
		$database->setQuery($query);
		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
		
		if ($rows) {	
				foreach($rows as $row) {	
						$row->client = "<a href='index.php?option=com_jcontacts&task=viewContact&cid[]=".$row->contactid."'>".$row->name." [".$row->username."]</a>";	
						if ($row->groupname) {
							$row->gid = ($row->mid == '0') ? $row->groupname."&nbsp;:&nbsp;:&nbsp;All" : $row->groupname."&nbsp;:&nbsp;:&nbsp;".$row->ownername." [".$row->owner."]";
						} else {
							$row->gid = "Unassigned";
						}
				}
			}
	} else {
		
		# get the total number of records
		$query = "SELECT count(*)"
		."\n FROM #__jinvoices as j"
		."\n LEFT JOIN #__users as u on u.id = j.contactid"
		."\n $auth $where";
		$database->setQuery($query);
		$total = $database->loadResult();
		echo $database->getErrorMsg();
	
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);
		
		$query = "SELECT j.id, subject, contactid, invoicestatus, total, validtill, j.gid, j.mid, g.groupname,"
		."\n j.published, u.username, u.name, m.username as owner, m.name as ownername FROM #__jinvoices as j"
		."\n LEFT OUTER JOIN #__users AS u on j.contactid = u.id"
		."\n LEFT OUTER JOIN #__users AS m on j.mid = m.id"
		."\n LEFT OUTER JOIN #__jaccessgroups as g on j.gid = g.id"
		."\n $auth $where"
		."\n ORDER BY j.id, subject DESC"
		. "\n LIMIT $pagination->limitstart,$pagination->limit";
		$database->setQuery($query);
		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
		
		if ($rows) {	
			foreach($rows as $row) {	
					$row->client = $row->name." [".$row->username."]</a>";	
					if ($row->groupname) {
						$row->gid = ($row->mid != '0') ? $row->groupname."&nbsp;:&nbsp;:&nbsp;".$row->ownername." [".$row->owner."]" : $row->groupname."&nbsp;:&nbsp;:&nbsp;All";
					} else {
						$row->gid = "Unassigned";
					}	
			}
		}
	}
	
	HTML_invoices::listInvoices($option, $rows, $pagination);
}
function saveInvoice ($option) {
	$database = & JFactory::getDBO();
	global $my, $mainframe, $config;
	$row = new invoices($database);
	$msg = 'Saved Invoice';
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
			$row->id = (int) $row->id;

				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				} else {
					$row->created 	= date( 'Y-m-d H:i:s' );
				}
			$row->mid = ($row->gid == '') ? '0' : $row->mid;		
			$row->validtill = date('Y-m-d H:i:s', strtotime($row->validtill));
			
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if($row->published == 1 && $jfConfig['sendEmail'] == '1') {
	sendEmail('INVOICE',$row->contactid, $row->subject, $row->total);
	}

	$invoiceid = $row->id;
	//Delete current items from servicerelation if editing
	if(isset($_POST['id'])) {
		$deleteid = $_POST['id'];
		$query = "DELETE FROM #__jservicerelation WHERE invoiceid='$deleteid'";
		$database->setQuery($query);
		$database->query();
	}

	$tot_no_prod = $_REQUEST['totalProductCount'];
		
	for($i=1; $i<=$tot_no_prod; $i++)
		{
	        $serv_id = $_REQUEST['serviceid'.$i];
	        $qty = $_REQUEST['quantity'.$i];
	        $listprice = $_REQUEST['listprice'.$i];
			$comment = addslashes($_REQUEST['comment'.$i]);
			
		//if the product is deleted then we should avoid saving the deleted products
		if($_REQUEST["deleted".$i] == 1)
			continue;

			$query = "INSERT INTO #__jservicerelation (invoiceid, serviceid, quantity, listprice, comment) VALUES ($row->id, $serv_id, $qty, $listprice, '$comment')";
			$database->setQuery($query);
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}
		}
			
	$mainframe->redirect( 'index.php?option=com_jaccounts&task=listInvoices', $msg );
}
function deleteInvoice ($option, $cid) {
	global $mainframe;
	
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
		$iids = 'invoiceid=' . implode( ' OR invoiceid=', $cid );
		$query = "DELETE FROM #__jinvoices"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
		
		$query = "DELETE FROM #__jservicerelation"
		. "\n WHERE ( $iids )"
		;
		$database->setQuery( $query);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMSg()."'); window.history.go(-1); </script>\n";
		}
	}
	
	$msg = "Invoice(s) deleted";
	$mainframe->redirect( 'index.php?option=com_jaccounts&task=listInvoices', $msg );
}
// Quote Functions

	function editQuote($option, $uid) {
		global $connection;
		$database = & JFactory::getDBO();
		$row = new quotes($database);
		if($uid){
			$row -> load($uid[0]);
			jAccessHelper::checkAuth($row);
			$query = "SELECT * FROM #__jservicerelation INNER JOIN #__jservices ON #__jservicerelation.serviceid = #__jservices.id WHERE quoteid='$row->id'";
			$database->setQuery($query);
			$appliedservices = $database->loadObjectList();
			
			$lists['mid'] = ($row->gid != '0') ? jAccountsController::managerList($row) : "&nbsp;";
		}
	
		if ($connection['jContacts']) {
			$query = "SELECT c.id, CONCAT(c.first_name,' ',c.last_name) as name, u.username"
			."\n FROM #__jcontacts AS c"
			."\n LEFT JOIN #__users AS u ON u.id = c.jid"
			."\n WHERE c.id = '$row->contactid'"
			;
		} else {
			$query = "SELECT * FROM #__users WHERE id='$row->contactid'";
		}
		$database->setQuery($query);
		$user = $database->loadRow();
		
		$query = "SELECT * FROM #__jservices";
		$database->setQuery($query);
		$services = $database->loadObjectList();	
		
		$lists['groups'] = jAccessHelper::managerList($row, 'quotes');
	HTML_quotes::editQuote($option, $row, $user, $services, $appliedservices, $lists);
	}
	
	function viewQuote($option, $uid) {
		global $connection;
		$database = & JFactory::getDBO();
		$row = new quotes($database);
		if($uid){
			$row -> load($uid[0]);
			jAccessHelper::checkAuth($row);
			$query = "SELECT * FROM #__jservicerelation INNER JOIN #__jservices on #__jservicerelation.serviceid = #__jservices.id WHERE quoteid='$row->id'";
			$database->setQuery($query);
			$appliedservices = $database->loadObjectList();
			
			$query = "SELECT groupname from #__jaccessgroups WHERE id = $row->gid";
			$database->setQuery($query);
			$manager = $database->loadResult();
			
			if ($row->mid != '0') {
			$query = "SELECT * FROM #__users WHERE id='$row->mid'";
			$database->setQuery($query);
			$mid = $database->loadRow();
			$mid = ($mid[0]) ? $mid[1]." [".$mid[2]."]" : '';
			} elseif ($row->mid == '0' && $row->gid != '0') {
				$mid = "All";
			} else {
				$mid = "&nbsp;";
			}
		}
	
		if ($connection['jContacts']) {
			$query = "SELECT c.id, CONCAT(c.first_name,' ',c.last_name) as name, u.username"
			."\n FROM #__jcontacts AS c"
			."\n LEFT JOIN #__users AS u ON u.id = c.jid"
			."\n WHERE c.id = '$row->contactid'"
			;
		} else {
			$query = "SELECT * FROM #__users WHERE id='$row->contactid'";
		}
		$database->setQuery($query);
		$user = $database->loadRow();
		
		$user = ($connection['jContacts']) ? "<a href='index.php?option=com_jcontacts&task=viewContact&cid[]=".$user[0]."'>".$user[1]." [".$user[2]."]</a>" : $user[1]." [".$user[2]."]";
		
		$query = "SELECT * FROM #__jservices";
		$database->setQuery($query);
		$services = $database->loadObjectList();	

	HTML_quotes::viewQuote($option, $row, $user, $services, $appliedservices, $manager, $mid);
	}

function listQuotes ($option, $auth = null) {
	$database = & JFactory::getDBO();
	global $mainframe, $config, $connection;
	$adminLocation = jAccessHelper::checkLocation();

	if ($adminLocation) {
		$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
	} else {
		$params = &$mainframe->getParams();
		$limit		= JRequest::getVar('limit', $params->get('display_num'), '', 'int');
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
	}

	if($_REQUEST['filter']!='') {
		$filter = JRequest::getVar('filter');

 	   $words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		$where = ($auth == "") ? "WHERE " : "AND ";
	    $where .= '(' . implode( (') OR ('), $wheres ) . ')';
	} elseif($_REQUEST['alpha']!='') {
		$alpha = JRequest::getVar('alpha');

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.subject) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		$where = ($auth == "") ? "WHERE " : "AND ";
	    $where .= '(' . implode( (') OR ('), $wheres ) . ')';
	}

	if ($connection['jContacts']) {
		# get the total number of records
		$database->setQuery( "SELECT count(*) FROM #__jquotes as j $auth $where" ); 
		$total = $database->loadResult();
		echo $database->getErrorMsg();

		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);

		$database->setQuery("SELECT j.id, subject, j.published, total, validtill, viewed, j.gid, j.mid, g.groupname, contactid,"
		."\n j.quotestage, u.username, CONCAT(c.first_name,' ',c.last_name) as name, m.username as owner, m.name as ownername"
		."\n FROM #__jquotes as j"
		."\n LEFT OUTER JOIN #__jcontacts as c on j.contactid = c.id"
		."\n LEFT OUTER JOIN #__users as u on c.jid = u.id"
		."\n LEFT OUTER JOIN #__users AS m on j.mid = m.id"
		."\n LEFT OUTER JOIN #__jaccessgroups as g on j.gid = g.id"
		."\n $auth $where"
		."\n ORDER BY j.id, subject DESC"
		."\n LIMIT $pagination->limitstart,$pagination->limit");	

		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
		
		if ($rows) {	
				foreach($rows as $row) {	
						$row->client = "<a href='index.php?option=com_jcontacts&task=viewContact&cid[]=".$row->contactid."'>".$row->name." [".$row->username."]</a>";	
						if ($row->groupname) {
							$row->gid = ($row->mid == '0') ? $row->groupname."&nbsp;:&nbsp;:&nbsp;All" : $row->groupname."&nbsp;:&nbsp;:&nbsp;".$row->ownername." [".$row->owner."]";
						} else {
							$row->gid = "Unassigned";
						}
				}
			}
	
	} else {
		# get the total number of records
		$database->setQuery( "SELECT count(*) FROM #__jquotes as j $auth $where" ); 
		$total = $database->loadResult();
		echo $database->getErrorMsg();

		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);

		$database->setQuery("SELECT j.id, contactid, subject, j.published, total, validtill, viewed, j.gid, j.mid, g.groupname, "
		."\n j.quotestage, u.username, u.name, m.username as owner, m.name as ownername FROM #__jquotes as j"
		."\n LEFT OUTER JOIN #__users as u on j.contactid = u.id"
		."\n LEFT OUTER JOIN #__users AS m on j.mid = m.id"
		."\n LEFT OUTER JOIN #__jaccessgroups as g on j.gid = g.id" 
		."\n $auth $where"
		."\n ORDER BY j.id, subject DESC"
		."\n LIMIT $pagination->limitstart,$pagination->limit");	

		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
		
		if ($rows) {	
			foreach($rows as $row) {	
					$row->client = $row->name." [".$row->username."]</a>";	
					if ($row->groupname) {
						$row->gid = ($row->mid != '0') ? $row->groupname."&nbsp;:&nbsp;:&nbsp;".$row->ownername." [".$row->owner."]" : $row->groupname."&nbsp;:&nbsp;:&nbsp;All";
					} else {
						$row->gid = "Unassigned";
					}	
			}
		}
	}


	
	HTML_quotes::listQuotes($option, $rows, $pagination);
	}

	function saveQuote ($option) {
		$database = & JFactory::getDBO();
		global $jfConfig, $my, $mainframe, $config;
		$row = new quotes($database);
		
		$msg = 'Saved Quote';
			if (!$row->bind( $_POST )) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}
		
				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				}
				
				if ($row->created && strlen(trim( $row->created )) <= 10) {
					$row->created 	.= ' 00:00:00';
				}
			$row->mid = ($row->gid == '') ? '0' : $row->mid;
			$row->validtill = date('Y-m-d H:i:s', strtotime($row->validtill));
		
			if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}

	//Email
	if($row->published == 1 && $jfConfig['sendEmail'] == '1') {
	jAccountsController::sendEmail('QUOTE',$row->contactid, $row->subject, $row->total);
	}
		
		$quoteid = $row->id;
		//Delete current items from servicerelation if editing
		if(isset($_POST['id'])) {
			$deleteid = $_POST['id'];
			$query = "DELETE FROM #__jservicerelation WHERE quoteid='$deleteid'";
			$database->setQuery($query);
			$database->query();
		}

		$tot_no_prod = $_REQUEST['totalProductCount'];
		
		for($i=1; $i<=$tot_no_prod; $i++)
		{
	        $serv_id = $_REQUEST['serviceid'.$i];
	        $qty = $_REQUEST['quantity'.$i];
	        $listprice = $_REQUEST['listprice'.$i];
			$comment = addslashes($_REQUEST['comment'.$i]);
			
		//if the product is deleted then we should avoid saving the deleted products
		if($_REQUEST["deleted".$i] == 1)
			continue;

			$query = "INSERT INTO #__jservicerelation (quoteid, serviceid, quantity, listprice, comment) VALUES ($row->id, $serv_id, $qty, $listprice, '$comment')";
			$database->setQuery($query);
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}
			//Invoice addition
		if($_POST['id'] == "" && $jfConfig['auto_invoice'] == 1) {
		
			$listprice_invoice = $listprice / $jfConfig['invoice_format'];
			$total = $_REQUEST['total'] / $jfConfig['invoice_format'];
			$subtotal = $_REQUEST['subtotal'] / $jfConfig['invoice_format'];

			for($j=1; $j<($jfConfig['invoice_format'] + 1); $j++)
				{
				
				if($j == 1) { $subject = $_POST['subject']." Initial Invoice"; } else { $subject = $_POST['subject']." Final Invoice"; }
				
				$invoice = new invoices($database);
				$invoice->subject = $subject;
				$invoice->contactid = JRequest::getVar('contactid');
				$invoice->quoteid = $quoteid;
				$invoice->total = $total;
				$invoice->subtotal = $subtotal;
				$invoice->invoicestatus = "Pending";
				$invoice->published = '0';
				$invoice->validtill = $row->validtill;
				$invoice->mid = $row->mid;
				$invoice->gid = $row->gid;
				
				if (!$invoice->store()) {
					echo "<script> alert('".$invoice->getError()."'); window.history.go(-1); </script>\n";
					exit();
				}

				$servicerelation = new servicerelation($database);
				$servicerelation->invoiceid = $invoice->id;
				$servicerelation->serviceid = $serv_id;
				$servicerelation->quantity = $qty;
				$servicerelation->listprice = $listprice_invoice;
				$servicerelation->comment = $comment;
				
				if (!$servicerelation->store()) {
					echo "<script> alert('".$servicerelation->getError()."'); window.history.go(-1); </script>\n";
					exit();
				}

			}
		}	
		}		
		
	$mainframe->redirect( 'index.php?option=com_jaccounts&task=listQuotes', $msg );
	}
function deleteQuote ($option, $cid) {
	global $mainframe;
	
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
	$cids = 'id=' . implode( ' OR id=', $cid );
	$qids = 'quoteid=' . implode( ' OR quoteid=', $cid );
	$query = "DELETE FROM #__jquotes"
	. "\n WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
	echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	
	$query = "DELETE FROM #__jservicerelation"
	. "\n WHERE ( $qids )"
	;
	$database->setQuery( $query);
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMSg()."'); window.history.go(-1); </script>\n";
	}
	}
	$msg = "Quote(s) deleted";
	$mainframe->redirect( 'index.php?option=com_jaccounts&task=listQuotes', $msg );
}
function listServices ($option) {
	global $mainframe;
	$database = & JFactory::getDBO();
	$adminLocation = jAccessHelper::checkLocation();

	if ($adminLocation) {
		$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
	} else {
		$params = &$mainframe->getParams();
		$limit		= JRequest::getVar('limit', $params->get('display_num'), '', 'int');
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
	}
	
		if($_REQUEST['filter']!='') {
		$filter = JRequest::getVar('filter');

 	   $words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.productname) LIKE '%$word%'";
		  $wheres2[] = "LOWER(j.product_description) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		$where = ($auth == "") ? "WHERE " : "AND ";
	    $where .= '(' . implode( (') OR ('), $wheres ) . ')';
	} elseif($_REQUEST['alpha']!='') {
		$alpha = JRequest::getVar('alpha');

 	   $words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(j.productname) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
		$where = ($auth == "") ? "WHERE " : "AND ";
	    $where .= '(' . implode( (') OR ('), $wheres ) . ')';
	}
	
	$database->setQuery("SELECT COUNT(*) FROM #__jservices as j $where");
	
	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);
	
	$query = "SELECT * FROM #__jservices as j $where";
	$database->setQuery($query, $limitstart, $limit);
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	HTML_services::listServices($option, $rows, $pagination);
}
function editService($option, $uid) {
	$database = & JFactory::getDBO();
	$row = new services($database);
	if($uid){
		$row -> load($uid[0]);
		}
	HTML_services::editService($option, $row);
}
function viewService($option, $uid) {
	$database = & JFactory::getDBO();
	$row = new services($database);
	if($uid){
			$row -> load($uid[0]);
		}
	HTML_services::viewService($option, $row);
}
function saveService ($option) {
	global $mainframe;
	$database = & JFactory::getDBO();
	$row = new services($database);
	$msg = 'Saved Service';
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$mainframe->redirect('index.php?option=com_jaccounts&task=listServices', $msg );
}
function deleteService ($option) {
	global $mainframe;
	
	$database = & JFactory::getDBO();
	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

		if (count($cid) < 1) {
			$msg =  JText::_('Select an item to delete');
			$mainframe->redirect('index.php?option='.$option, $msg, 'error');
		}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
		$sids = 'serviceid=' . implode( ' OR serviceid=', $cid );
		
		$query = "SELECT * FROM #__jservicerelation"
		."\n WHERE ( $sids )"
		;
		$database->setQuery($query);
		if(!$result = $database->loadResult()) {

			$msg = JText::sprintf('Service(s) Deleted', count($cid));
			$query = "DELETE FROM #__jservices"
			. "\n WHERE ( $cids )"
			;
	
			$database->setQuery( $query );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}

		} else {

			echo "<script> alert('Cannot delete services applied to quotes/invoices'); window.history.go(-1); </script>\n";
			exit();			
	
		}
	}

	$mainframe->redirect( 'index.php?option=com_jaccounts&task=listServices', $msg );
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
	global $my, $task, $mainframe;

	$cid	  = JRequest::getVar( 'cid', array(), 'post', 'array' );

	if (count( $cid ) < 1) {
		$action = $state == 1 ? 'publish' : ($state == -1 ? 'archive' : 'unpublish');
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	if (count( $cid )) {
		$cids = 'id=' . implode( ' OR id=', $cid );
	}
	$type = strval( JRequest::getVar('type') );

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

			foreach ($rows as $row) {
				$utype = strtoupper(substr( $type, 0, -1 ));
				jAccountsController::sendEmail($utype,$row->contactid,$row->subject,$row->total);
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

	$mainframe->redirect( 'index.php?option='. $option . $rtask .'&mosmsg='. $msg );
}

// Configuration 

function showConfig( $option ) {
	$database = & JFactory::getDBO();
	global $acl, $jfConfig, $my,$mainframe;

	$configfile = JPATH_SITE."/administrator/components/com_jaccounts/jaccounts.config.php";
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
	
	$truefalse = array();
	$truefalse[] = JHTML::_('select.option','true','Yes');
	$truefalse[] = JHTML::_('select.option','false','No');
	
	$paymentgateways = array();
	$paymentgateways[] = JHTML::_('select.option', '0','Offline');
	$paymentgateways[] = JHTML::_('select.option', '1','PayPal');
	$paymentgateways[] = JHTML::_('select.option', '2','GoogleCheckout');
	$paymentgateways[] = JHTML::_('select.option', '3','Authorize.net');
	$paymentgateways[] = JHTML::_('select.option', '4','2Checkout');
	
	$currency = array();
	$currency[]=JHTML::_('select.option', '$','$');
	$currency[]=JHTML::_('select.option', '&euro;','&euro;');
	$currency[]=JHTML::_('select.option', '&pound;','&pound;');
	$currency[]=JHTML::_('select.option', '&yen;','&yen;');
	
	$lists['payment_gateway'] = JHTML::_('select.genericlist', $paymentgateways, 'cfg_payment_gateway', 'class="inputbox size="1"', 'value', 'text', $jfConfig['payment_gateway'] );
	
	$lists['auto_email'] = JHTML::_('select.genericlist', $yesno, 'cfg_auto_email', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['auto_email'] );
	$lists['authorize_test'] = JHTML::_('select.genericlist', $truefalse, 'cfg_authorize_test', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['authorize_test'] );

	$lists['auto_generate_invoice'] = JHTML::_('select.genericlist', $yesno, 'cfg_auto_invoice', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['auto_invoice'] );
	
	$lists['invoice_format'] = JHTML::_('select.genericlist',  $invoiceformats, 'cfg_invoice_format', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['invoice_format'] );
	
	$lists['currency'] = JHTML::_('select.genericlist', $currency, 'cfg_currency','class=inputbox size="1"', 'value', 'text', $jfConfig['currency']);
		
	HTML_cP::showConfig( $jfConfig, $lists, $option );
}
function saveConfig ( $option ) {
	global $mainframe;

	$configfile = JPATH_SITE."/administrator/components/com_jaccounts/jaccounts.config.php";
	
	$_POST['cfg_access_restrictions'] = $_POST['cfg_access_restrictions']=='1' ? $_POST['cfg_access_restrictions'] : '0';
	
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
      $mainframe->redirect( "index.php?option=$option&task=showconfig", "Configuration file saved" );
   } else {
      $mainframe->redirect( "index.php?option=$option", "FATAL ERROR: File could not be opened." );
   }
}
function sendEmail($module,$userid,$subject,$total ) {

	$database = & JFactory::getDBO();
	global $jfConfig;
	//Email Client
		$sql = "SELECT name, email FROM #__users WHERE id = '$userid'";
		$database->setQuery($sql);
		$name = $database->loadRow();		
		
	
		$variables = array("%CLIENT_NAME%","%".$module."_NAME%","%".$module."_AMOUNT%","%COMPANY_NAME%");
		$values = array($name[0],$subject,$total,$jfConfig['company_name']);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
		$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";

		$to = $name[1];
			
		$module_subject = strtolower('new_'.$module.'_subject');
		$module_email = strtolower('new_'.$module.'_email');
		$emailsubject = str_replace($variables,$values,$jfConfig[$module_subject]);
		$contents = nl2br(str_replace($variables,$values,$jfConfig[$module_email]));
		
		mail($to,$emailsubject,$contents,$headers);
}

function clientPopup($option) { 

	$database	=& JFactory::getDBO();
	global $mainframe, $connection;
	$adminLocation = jAccessHelper::checkLocation();

	$limit = 9;
	if ($adminLocation) {
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
	} else {
		$params = &$mainframe->getParams();
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
	}

	
if ($connection['jContacts']) {

	if ($_REQUEST['filter']!='' || isset($_REQUEST['Submit'])) {
		unset($_REQUEST['alpha']);
		$keyword = $_REQUEST['filter'];
		$wheres = array();
		$wheres2[] 	= "LOWER(c.first_name) LIKE LOWER('%$keyword%')";
		$wheres2[] 	= "LOWER(c.last_name) LIKE LOWER('%$keyword%')";
		$wheres2[] 	= "LOWER(c.email) LIKE LOWER('%$keyword%')";
		$where 		= 'AND (' . implode( ') OR (', $wheres2 ) . ')';
	
	} elseif($_REQUEST['alpha']!='') {
		$keyword = $_REQUEST['alpha'];
		$where 	= "AND LOWER(c.last_name) LIKE LOWER('$keyword%')";
	
		
	}
		$query = "SELECT COUNT(*) FROM #__jcontacts AS c WHERE c.published = '1' $where";
		$database->setQuery($query);
		$total = $database->loadResult();
	
		if ( $total <= $limit ) {
			$limitstart = 0;
		}
	
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);
	
		$query = "SELECT c.id, CONCAT(c.last_name,', ',c.first_name) as name, c.email, u.username FROM #__jcontacts as c"
		."\n LEFT JOIN #__users AS u ON u.id = c.jid"
		."\n WHERE c.published = '1'"
		."\n $where"
		."\n ORDER BY c.last_name"
		;

		$database->setQuery($query, $pagination->limitstart, $pagination->limit);
		$rows = $database->loadObjectList();
} else {
	
	if ($_REQUEST['filter']!='' || isset($_REQUEST['Submit'])) {
		unset($_REQUEST['alpha']);
		$keyword = $_REQUEST['filter'];
		$wheres = array();
		$wheres2[] 	= "LOWER(name) LIKE LOWER('%$keyword%')";
		$wheres2[] 	= "LOWER(username) LIKE LOWER('%$keyword%')";
		$wheres2[] 	= "LOWER(email) LIKE LOWER('%$keyword%')";
		$where 		= 'AND (' . implode( ') OR (', $wheres2 ) . ')';
	
	} elseif($_REQUEST['alpha']!='') {
		$keyword = $_REQUEST['alpha'];
		$where 	= "AND LOWER(name) LIKE LOWER('$keyword%')";
	
		
	}
		$query = "SELECT COUNT(*) FROM #__users WHERE block='0' AND gid = '18' $where";
		$database->setQuery($query);
		$total = $database->loadResult();
	
		if ( $total <= $limit ) {
			$limitstart = 0;
		}
	
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);
	
		$query = "SELECT * FROM #__users WHERE block='0' AND gid = '18' $where ORDER BY name";
		$database->setQuery($query, $pagination->limitstart, $pagination->limit);
		$rows = $database->loadObjectList();
}
	
	HTML_cP::clientPopup($option, $rows, $pagination);

 }

function servicesPopup($option) { 
	$database	=& JFactory::getDBO();
	global $mainframe;

	$adminLocation = jAccessHelper::checkLocation();

	$limit = 8;
	if ($adminLocation) {
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
	} else {
		$params = &$mainframe->getParams();
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
	}

if ($_REQUEST['filter']!='' || isset($_REQUEST['Submit'])) {
	unset($_REQUEST['alpha']);
	$keyword = $_REQUEST['filter'];
	$wheres = array();
	$wheres2[] 	= "LOWER(productname) LIKE LOWER('%$keyword%')";
	$wheres2[] 	= "LOWER(product_description) LIKE LOWER('%$keyword%')";
	$where 		= '(' . implode( ') OR (', $wheres2 ) . ')';

} elseif($_REQUEST['alpha']!='') {

	$keyword = $_REQUEST['alpha'];
	$where 	= "LOWER(productname) LIKE LOWER('$keyword%')";

} else {

	$where = '1=1';
}

	$query = "SELECT COUNT(*) FROM #__jservices WHERE ($where)";
	$database->setQuery($query);
	$total = $database->loadResult();

	if ( $total <= $limit ) {
		$limitstart = 0;
	}
		
	$query = "SELECT * FROM #__jservices WHERE ($where)";
	$database->setQuery($query, $limitstart, $limit);
	$rows = $database->loadObjectList();
	
	jimport('joomla.html.pagination');
	$pagination = new JPagination($total, $limitstart, $limit);


	HTML_cp::servicesPopup($option, $rows, $pagination);
}

}
?>