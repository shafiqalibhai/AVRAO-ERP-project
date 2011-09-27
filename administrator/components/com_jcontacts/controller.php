<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class jContactsController extends JController {
	

function getLists($row) {
	$database = & JFactory::getDBO();
	global $jfConfig;
	include_once(JPATH_COMPONENT.DS."/lib/lib.php");
	
	# State Lists
	$s_array[] = JHTML::_('select.option','', '');
	while(list($key, $value) = each($state_array)) {
		$s_array[] = JHTML::_('select.option',$key, ucwords(strtolower($value)));
	}
	
	$lists['mailing_state'] = JHTML::_('select.genericlist',$s_array, 'mailing_state', 'class="inputbox"', 'value', 'text', $row->mailing_state );
	$lists['other_state'] = JHTML::_('select.genericlist',$s_array, 'other_state', 'class="inputbox"', 'value', 'text', $row->other_state );
	$lists['billing_state'] = JHTML::_('select.genericlist',$s_array, 'billing_state', 'class="inputbox"', 'value', 'text', $row->billing_state );
	$lists['shipping_state'] = JHTML::_('select.genericlist',$s_array, 'shipping_state', 'class="inputbox"', 'value', 'text', $row->shipping_state );
	
	# Country Lists
	$c_array[] = JHTML::_('select.option','', '');
	$c_array[] = JHTML::_('select.option','US', 'United States');
	while(list($key, $value) = each($country_array)) {
		$c_array[] = JHTML::_('select.option',$key, ucwords(strtolower($value)));
	}
	
	$lists['mailing_country'] = JHTML::_('select.genericlist',$c_array, 'mailing_country', 'class="inputbox"', 'value', 'text', $row->mailing_country );
	$lists['other_country'] = JHTML::_('select.genericlist',$c_array, 'other_country', 'class="inputbox"', 'value', 'text', $row->other_country );
	$lists['billing_country'] = JHTML::_('select.genericlist',$c_array, 'billing_country', 'class="inputbox"', 'value', 'text', $row->billing_country );
	$lists['shipping_country'] = JHTML::_('select.genericlist',$c_array, 'shipping_country', 'class="inputbox"', 'value', 'text', $row->shipping_country );
	
	# Manager List
	$query = "SELECT * FROM #__users WHERE block='0' and gid > '23' ";
	$database->setQuery($query);
	$manager_rows = $database->loadObjectList();
		
	$m_array[] = JHTML::_('select.option','', 'None');
	foreach ($manager_rows as $m) {
	$m_array[] = JHTML::_('select.option',$m->id, $m->username);
	}
	
 	$lists['managers'] = JHTML::_('select.genericlist',$m_array, 'manager_id', 'class="inputbox"', 'value', 'text', $row->manager_id );
	
	# Lead Status List
	$array = explode("\n",$jfConfig['leadStatus']);
	$status_array[] = JHTML::_('select.option','', '');
	foreach ($array as $a) {
		trim($a);
		if ($a != "") {
			$status_array[] = JHTML::_('select.option',$a, $a);
		}
	}
		
	$lists['status'] = JHTML::_('select.genericlist',$status_array, 'status', 'class="inputbox"', 'value', 'text', $row->status );
	
	return $lists;
}function  checkAuth($row) {
	$user = &JFactory::getUser();
	
	global $jfConfig;
	if($jfConfig['access_restrictions']==1 && $user->gid!='25' && $row->manager_id != $user->id) {
		$mainframe->redirect( 'index2.php?option=com_jcontacts', _NOT_AUTH );
	}
}
// Lead Functions
function editLead($option, $id) {
		$database = & JFactory::getDBO();
		$row = new leads($database);
		if($id){
			$row -> load($id);
			 jContactsController::checkAuth($row);
		}
	$lists = jContactsController::getLists($row);
	HTML_leads::editLead($option, $row, $lists);
}
function viewLead($option, $id) {
		$database = & JFactory::getDBO();
		$row = new leads($database);		
		$row ->load($id);
		 jContactsController::checkAuth($row);
		$database->setQuery("SELECT id, name, username FROM #__users WHERE id = $row->manager_id");
		$manager = $database->loadRow();
	
	HTML_leads::viewLead($option, $row, $manager);
}
function listLeads ($option, $l_auth) {
	$database = & JFactory::getDBO();
	global $mainframe;
		
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
	if ($_REQUEST['status'] !='') {
		$where = "AND l.status='$_REQUEST[status]'";
	} 
	if($_REQUEST['filter']!='') {
		$filter = JRequest::getVar('filter');
    	$filter = str_replace('%20',' ',$filter);
    	$words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(l.first_name) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(l.last_name) LIKE '%$word%'";
		  $wheres2[] = "LOWER(l.company_name) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(l.email) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where .= 'AND (' . implode( (') OR ('), $wheres ) . ')';
	} elseif($_REQUEST['alpha']!='') {
		$alpha = JRequest::getVar('alpha');
    	$alpha = str_replace('%20',' ',$alpha);
    	$words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(l.last_name) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where .= 'AND (' . implode( (') OR ('), $wheres ) . ')';
	}
	
	$database->setQuery("SELECT COUNT(*) FROM #__jleads as l WHERE converted='0' ".$l_auth." AND published > '0' $where");
	$total = $database->loadResult();
	
	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );
	
	$query = "SELECT l.*, u.name as jname, u.username"
	."\n FROM #__jleads as l"
	."\n LEFT OUTER JOIN #__users as u"
	."\n ON l.manager_id = u.id"
	."\n WHERE converted='0'"
	."\n AND published > '0'"
	."\n $l_auth"
	."\n $where"
	."\n LIMIT $pageNav->limitstart,$pageNav->limit";
	
	$database->setQuery($query);
	$rows = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	HTML_leads::listLeads($option, $rows, $pageNav);
}
function saveLead ($option) {
	$database = & JFactory::getDBO();
	global $mainframe;
	$row = new leads($database);
	$msg = _LEAD_SAVED;	
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
			
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
			
	$mainframe->redirect( 'index2.php?option=com_jcontacts&task=viewLead&cid[]='.$row->id);
}
function trashLead ($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	if (count( $cid )) {
		JArrayHelper::toInteger( $cid );
		$cids = 'id=' . implode( ' OR id=', $cid );
		$query = "DELETE FROM #__jleads"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}	}
	
	$msg = _LEAD_DELETED;
	$mainframe->redirect( 'index2.php?option=com_jcontacts', $msg );
}function deleteLead ($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	if (count( $cid )) {		
	JArrayHelper::toInteger( $cid );
		$cids = 'id=' . implode( ' OR id=', $cid );
		$query = "UPDATE #__jleads"
		. "\n SET published = '-2'"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery($query);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	
	$msg = _LEAD_DELETED;
	$mainframe->redirect( 'index2.php?option=com_jcontacts', $msg );
}
function convertLead ($option) {
	global $jfConfig;	
	$database = & JFactory::getDBO();
	if (isset($_POST['view']) && $_POST['view']==1) {
		$lead = unserialize(base64_decode($_POST['row']));
		$_POST['id'] = $lead->id;
		$_POST['first_name'] = $lead->first_name;
		$_POST['last_name'] = $lead->last_name;
		$_POST['company_name'] = $lead->company_name;
		$_POST['email'] = $lead->email;
		$_POST['phone'] = $lead->phone;
	}	# Save Lead
	$row = new leads($database);
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
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}	# New Account
	$query = "SELECT id FROM #__jaccounts WHERE name = '$row->company_name' AND published = '1'";
	$database->setQuery($query);
	$id = $database->loadResult();
	
	$account = new accounts($database);
	if ($id) {
		$account->load($id);
	} else {
		$account->name = $row->company_name;
		$account->published = '1';
		$account->created 	= date( 'Y-m-d H:i:s' );
		$account->modified 	= date( 'Y-m-d H:i:s' );
	}
	
	if (!$account->store()) {
		echo "<script> alert('".$account->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}	# New Contact
	$_POST['id']='';
	$row = new contacts($database);
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->account_id = $account->id;
	$database->setQuery("SELECT id, name FROM #__jaccounts WHERE id = $row->account_id");
	$account = $database->loadRow();
	$database->setQuery("SELECT id, last_name, first_name FROM #__jcontacts WHERE id = $row->reports_to");
	$reports_to = $database->loadRow();
	$converted = $lead->id;
	$lists = jContactsController::getLists($row);
		
	HTML_contacts::editContact($option, $row, $account, $reports_to, $jrow, $converted, $lists);}// Contact Functions	
	
	function editContact($option, $id) {
		$database = & JFactory::getDBO();
		$row = new contacts($database);
		if($id){
			$row -> load($id);
			 jContactsController::checkAuth($row);
			 
			if ($row->account_id) {
				$database->setQuery("SELECT id, name FROM #__jaccounts WHERE id = '$row->account_id'");
				$account = $database->loadRow();
			}
			if ($row->reports_to) {
				$database->setQuery("SELECT id, last_name, first_name FROM #__jcontacts WHERE id = '$row->reports_to'");
				$reports_to = $database->loadRow();
			}
			if ($row->manager_id) {
				$database->setQuery("SELECT id, name, username FROM #__users WHERE id = '$row->manager_id'");
				$manager = $database->loadRow();
			}
			
			if ($row->jid) {
			$jrow = new JUser($row->jid);
			$jrow->orig_password = $jrow->password;
		
			$jrow->name = trim( $jrow->name );
			$jrow->email = trim( $jrow->email );
			$jrow->username = trim( $jrow->username );
			}
		}
	$lists = jContactsController::getLists($row);	
	HTML_contacts::editContact($option, $row, $account, $reports_to, $jrow, $converted, $lists);
}
	function viewContact($option, $id) {
		$database = & JFactory::getDBO();
		$row = new contacts($database);
		
		$row -> load($id);
		jContactsController::checkAuth($row);

		if ($row->account_id) {
			$database->setQuery("SELECT id, name FROM #__jaccounts WHERE id = '$row->account_id'");
			$account = $database->loadRow();
		}
		if ($row->reports_to) {
			$database->setQuery("SELECT id, last_name, first_name FROM #__jcontacts WHERE id = '$row->reports_to'");
			$reports_to = $database->loadRow();
		}
		if ($row->manager_id) {
			$database->setQuery("SELECT id, name, username FROM #__users WHERE id = '$row->manager_id'");
			$manager = $database->loadRow();
		}
	
	
		$jrow = new JUser( $row->jid );
		$jrow->orig_password = $jrow->password;
	
		$jrow->name = trim( $jrow->name );
		$jrow->email = trim( $jrow->email );
		$jrow->username = trim( $jrow->username );
	
	
	HTML_contacts::viewContact($option, $row, $jrow, $account, $reports_to, $manager);
	}	
	function listContacts ($option, $c_auth) {
		$database = & JFactory::getDBO();
		global $mainframe;
		
		$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
		
	if($_REQUEST['filter']!='') {
		$filter = JRequest::getVar('filter', '', $_REQUEST);
    	$filter = str_replace('%20',' ',$filter);
    	$words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(c.first_name) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(c.last_name) LIKE '%$word%'";
		  $wheres2[] = "LOWER(a.name) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(c.email) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	} elseif($_REQUEST['alpha']!='') {
		$alpha = JRequest::getVar('alpha', '', $_REQUEST);
    	$alpha = str_replace('%20',' ',$alpha);
    	$words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(c.last_name) LIKE LOWER('$word%')";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	}
		
		$database->setQuery("SELECT COUNT(*) FROM #__jcontacts as c WHERE published > '0' ".$c_auth." $where");
		$total = $database->loadResult();
		
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
		
		$query = "SELECT c.id, c.first_name, c.last_name, a.name, c.created, c.phone, c.email, u.name as jname, u.username"
		."\n FROM #__jcontacts as c"
		."\n LEFT OUTER JOIN #__jaccounts as a"
		."\n ON c.account_id = a.id"
		."\n LEFT OUTER JOIN #__users as u"
		."\n ON c.manager_id = u.id"
		."\n WHERE (c.published > 0"
		."\n $c_auth"
		."\n $where)"
		."\n LIMIT $pageNav->limitstart,$pageNav->limit";
		$database->setQuery($query);
		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}	HTML_contacts::listContacts($option, $rows, $pageNav);
	}	
	function saveContact ($option) {
		$database = & JFactory::getDBO();
		global $jfConfig, $mainframe;
		
		# Set email_opt_out to 0 if it is not checked
		if ($_POST['email_opt_out']!=1) {$_POST['email_opt_out']=0;}
		

			# Send $_POST to save user function
			$user_array = jContactsController::saveJoomlaUser($_POST);			
			# Set jid to be saved with new contact
			$_POST['jid'] = $user_array[1];
/*			
			# Set variables of the new joomla user email function
			$module='joomla_user';
			$name = $_POST['first_name']." ".$_POST['last_name'];
			$params = array($_POST['username'], $user_array[0], $name, $_POST['email']);
			sendEmail($module, $params);	
*/
		
		# If this is a contact being converted from a lead, set #__jleads.converted = 1
		if (isset($_POST['converted']) && $_POST['converted']!='') {
			$id = $_POST['converted'];
			$query = "UPDATE #__jleads"
			. "\n SET converted = '1'"
			. "\n WHERE id = '$id'"
			;
			$database->setQuery( $query );
			$database->query();			
		}
		

		# New contacts object
		$row = new contacts($database);
		$msg = _CONTACT_SAVED;
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
			$row->birthdate = $_POST['bday_year']."-".$_POST['bday_month']."-".$_POST['bday_day'];
		
	# Saves lat and lng values for addresses	
	if ($jfConfig['google_api']!='') {
		$q = $row->mailing_street." ".$row->mailing_city.", ".$row->mailing_state." ".$row->mailing_zip." ".$row->mailing_country;		
		$result = jContactsController::googleGeocode($q);          
		$row->lat = $result["lat"];
        $row->lng = $result["lng"];
	}
	
	if($jfConfig['google_api']!='') {
		$q = $row->other_street." ".$row->other_city.", ".$row->other_state." ".$row->other_zip." ".$row->other_country;		
		$result = jContactsController::googleGeocode($q);
        $row->other_lat = $result["lat"];
        $row->other_lng = $result["lng"];
	}
	
	# End of lat and lng values					
	if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}	

	$mainframe->redirect('index2.php?option=com_jcontacts&task=viewContact&cid[]='.$row->id);
}

	function sendGeoQuery($url,$q,$apikey = '') {
      
        $fullUrl = $url . urlencode($q);
        if($apikey) $fullUrl .= '&key='.$apikey;
        
        	if(ini_get("allow_url_fopen")) {
             $gm=fopen("$fullUrl",'r');
             $tmp=@fread($gm,30000);
             fclose($gm);
        	} else {
             $ch = curl_init();
             $timeout = 20; // set to zero for no timeout
             curl_setopt($ch, CURLOPT_URL, "$fullUrl");
             curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
           	 curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
           	 $tmp= curl_exec($ch);
        	 curl_close($ch);
        	}
        
        	return $tmp;
    
    	}		
	function googleGeocode($q) {
		global $jfConfig;
            $apikey = $jfConfig['google_api'];
            $tmp = jContactsController::sendGeoQuery('http://maps.google.com/maps/geo?output=csv&q=',$q,$apikey);
            
            $tmpcoords = explode(',',$tmp);
            list($status,$accuracy,$lat,$lng) = $tmpcoords;
            $result["lat"] = $lat;
            $result["lng"] = $lng;
            return $result;
    	}	
		
function deleteContact ($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	if (!is_array( $cid ) || count( $cid ) < 1) {
	echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
	exit;
		}
	if (count( $cid )) {
		
		JArrayHelper::toInteger( $cid );
		$cids = 'id=' . implode( ' OR id=', $cid );
		$query = "UPDATE #__jcontacts"
		. "\n SET published = '-2'"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
		# Delete Joomla User
		$query = "SELECT jid FROM #__jcontacts"
		. "\n WHERE ( $cids )"
		;
		$database->setQuery($query);
		$jusers = $database->loadObjectList();
		foreach ($jusers as $j) {
			jContactsController::deleteJoomlaUser($j->jid);
		}
		
	}
	$msg = _CONTACT_DELETED;
	$mainframe->redirect( 'index2.php?option=com_jcontacts&task=listContacts', $msg );
}
function trashContact ($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	if (!is_array( $cid ) || count( $cid ) < 1) {
	echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
	exit;
		}
	if (count( $cid )) {
	JArrayHelper::toInteger( $cid );
	$cids = 'id=' . implode( ' OR id=', $cid );
	$query = "DELETE FROM #__jcontacts"
	. "\n WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
	echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	}
	$msg = _CONTACT_DELETED;
	$mainframe->redirect( 'index2.php?option=com_jcontacts&task=listContacts', $msg );
}function requestUpdate($option) {
	global $database;
	if (isset($_POST['view']) && $_POST['view']==1) {
		$id = $_POST['cid'][0];
	} else {
		$id = $_POST['id'];
	}
		
	$query = "SELECT id, first_name, last_name, email"
	."\n FROM #__jcontacts"
	."\n WHERE id = ".$id
	;
	$database->setQuery($query);
	$c = $database->loadObjectList();
	$name = $c[0]->first_name." ".$c[0]->last_name;
	$email=$c[0]->email;
	$link=JURI::base()."/index.php?option=com_jcontacts&task=viewMyDetails";	
	$myname = "jContact User";
	$module = "contact_update";
	$params = array($name, $email, $link, $myname);	sendEmail($module, $params);
	$link= "index2.php?option=com_jcontacts&task=editContact&cid[]=".$id;
	$mainframe->redirect($link, _CONTACT_NOTIFIED);
}
// Account Functions	
function editAccount($option, $id) {
		$database = & JFactory::getDBO();
		$row = new accounts($database);
		if($id){
			$row -> load($id);	
			 jContactsController::checkAuth($row);
		}
	$lists = jContactsController::getLists($row);
	HTML_accounts::editAccount($option, $row, $lists);
	}
	
	function viewAccount($option, $id) {
		$database = & JFactory::getDBO();
		$row = new accounts($database);
		
		$row -> load($id);
		jContactsController::checkAuth($row);
		
		if ($row->manager_id) {
			$database->setQuery("SELECT id, name, username FROM #__users WHERE id = $row->manager_id");
			$manager = $database->loadRow();
		}
		
		$query="SELECT *"
		."\n FROM #__jcontacts as c"
		."\n WHERE account_id = '$row->id'"
		."\n $c_auth"
		;
		$database->setQuery($query);
		$contacts=$database->loadObjectList();		
	HTML_accounts::viewAccount($option, $row, $manager, $contacts);
	}
	
	function listAccounts ($option, $a_auth) {
		$database = & JFactory::getDBO();
		global $mainframe;
		
		$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 10 );
		$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 ) );
		
	if($_REQUEST['filter']!='') {
		$filter = JRequest::getVar('filter', '', $_REQUEST);
    	$filter = str_replace('%20',' ',$filter);
    	$words = explode( ' ', $filter );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(a.name) LIKE '%$word%'";
   		  $wheres2[] = "LOWER(a.account_number) LIKE '%$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	} elseif($_REQUEST['alpha']!='') {
		$alpha = JRequest::getVar('alpha', '', $_REQUEST);
    	$alpha = str_replace('%20',' ',$alpha);
    	$words = explode( ' ', $alpha );
   		 $wheres = array();
	   	 foreach ($words as $word) {
    	  $wheres2 = array();
 	      $wheres2[] = "LOWER(a.name) LIKE '$word%'";
   		  $wheres[] = implode( ' OR ', $wheres2 );
    	}
	    $where = 'AND (' . implode( (') OR ('), $wheres ) . ')';
	}
		
		$database->setQuery("SELECT COUNT(*) FROM #__jaccounts as a WHERE published > '0' ".$a_auth." $where");
		$total = $database->loadResult();
		
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );
	
		$query="SELECT a.*, u.name as jname, u.username"
		."\n FROM #__jaccounts as a"
		."\n LEFT OUTER JOIN #__users as u"
		."\n ON a.manager_id = u.id"
		."\n WHERE published > '0'"
		."\n $a_auth"
		."\n $where"
		."\n LIMIT $pageNav->limitstart,$pageNav->limit";
		$database->setQuery($query);
		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		} 
		
	HTML_accounts::listAccounts($option, $rows, $pageNav);
	}	
	function saveAccount ($option) {
		$database = & JFactory::getDBO();
		global $mainframe, $jfConfig;
		
		$row = new accounts($database);
		$msg = _ACCOUNT_SAVED;
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
			
			if (!$row->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit();
			}	
		
	$mainframe->redirect( 'index2.php?option=com_jcontacts&task=viewAccount&cid[]='.$row->id);
}
function deleteAccount ($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	if (count( $cid )) {
	JArrayHelper::toInteger( $cid );
	$accountids = "c.account_id='" . implode( "' OR c.account_id='", $cid )."'";
	$query = "SELECT DISTINCT a.name"
	."\n FROM #__jcontacts as c"
	."\n LEFT JOIN #__jaccounts AS a ON a.id = c.account_id"
	."\n WHERE ($accountids)"
	."\n AND c.published = '1'"
	;
	$database->setQuery($query);
	$accounts = $database->loadResultArray();

	if ($accounts) {
		$a = implode(", ",$accounts);
		echo "<script>alert('Please delete all contacts from account(s): ".$a."'); window.history.go(-1);</script>\n";
		exit;
	}
	
	$cids = 'id=' . implode( ' OR id=', $cid );
	$query = "UPDATE #__jaccounts"
	. "\n SET published = '-2'"
	. "\n WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
	echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	}
	$msg = _ACCOUNT_DELETED;
	$mainframe->redirect( 'index2.php?option=com_jcontacts&task=listAccounts', $msg );
}
function trashAccount ($option, $cid) {
	$database = & JFactory::getDBO();
	global $mainframe;
	if (!is_array( $cid ) || count( $cid ) < 1) {
	echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
	exit;
	}
	if (count( $cid )) {
	JArrayHelper::toInteger( $cid );
	$cids = 'id=' . implode( ' OR id=', $cid );
	$query = "DELETE FROM #__jaccounts"
	. "\n WHERE ( $cids )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
	echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	}
	$msg = _ACCOUNT_DELETED;
	$mainframe->redirect( 'index2.php?option=com_jcontacts&task=listAccounts', $msg );
}
//Home Page
function controlPanel ($option) {	HTML_cP::controlPanel($option);
}//About Page
function About($option) {
	HTML_cP::About($option);
}// Configuration 
function showConfig( $option ) {	
global $jfConfig, $mainframe;	
$configfile = JPATH_COMPONENT.DS."/jcontacts.config.php";
	@chmod ($configfile, 0766);	if (!is_callable(array("JFile","write")) || ($mainframe->getCfg('ftp_enable') != 1)) {
		$permission = is_writable($configfile);
		if (!$permission) {
			echo "<center><h1><font color=red>Warning...</font></h1><BR>";
			echo "<B>Your config file: $configfile <font color=red>is not writable</font></b><BR>";
			echo "<B>You need to chmod this to 766 in order for the config to be updated</B></center><BR><BR>";
		}
	}
	
	
	$yesno = array();
	$yesno[] = JHTML::_('select.option','1','Yes');
	$yesno[] = JHTML::_('select.option','0','No');
	
	$lists['auto_email'] = JHTML::_('select.genericlist',$yesno, 'cfg_auto_email', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['auto_email'] );
	$lists['auto_joomla_user'] = JHTML::_('select.genericlist',$yesno, 'cfg_auto_joomla_user', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['auto_joomla_user']);
	$lists['access_restrictions'] = JHTML::_('select.genericlist',$yesno, 'cfg_access_restrictions', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['access_restrictions'] );
	$lists['mootools'] = JHTML::_('select.genericlist',$yesno, 'cfg_mootools', 'class="inputbox" size="1"', 'value', 'text', $jfConfig['mootools'] );
	
	HTML_cP::showConfig( $jfConfig, $lists, $option );
}
function saveConfig ( $option ) {
global $mainframe;
$configfile = JPATH_COMPONENT.DS."/jcontacts.config.php";
	
   //Add code to check if config file is writeable.
   if (!is_callable(array("JFile","write")) && !is_writable($configfile)) {
      @chmod ($configfile, 0766);
      if (!is_writable($configfile)) {
         $mainframe->redirect("index2.php?option=$option", _CONFIG_FILE_NOT_WRITEABLE );
      }
   }   $txt = "<?php\n";
   if (!isset($_POST['access_restrictions'])) { $_POST['access_restrictions']=0;}
   if (!isset($_POST['mootools'])) { $_POST['mootools']=0;}
   foreach ($_POST as $k=>$v) {
   	  if (is_array($v)) $v = implode("|*|", $v);
      if (strpos( $k, 'cfg_' ) === 0) {
         if (!get_magic_quotes_gpc()) {
            $v = addslashes( $v );
         }
		 $txt .= "\$jfConfig['".substr( $k, 4 )."']='$v';\n";
      }
   }
   $txt .= "?>";   if (is_callable(array("JFile","write"))) {
		$result = JFile::write( $configfile, $txt );
   } else {
		$result = false;
		if ($fp = fopen( $configfile, "w")) {
			$result = fwrite($fp, $txt, strlen($txt));
			fclose ($fp);
		}
   }
   if ($result != false) {
      $mainframe->redirect( "index2.php?option=$option&task=showconfig", _CONFIG_FILE_SAVED );
   } else {
      $mainframe->redirect( "index2.php?option=$option", _CONFIG_FILE_ERROR );
   }
}
function sendEmail($module, $params) {
global $database, $jfConfig;
$user = &JFactory::getUser();
switch ($module) {	case 'contact_update':
	$variables = array("%CONTACT_NAME%","%JCONTACT_USER%","%COMPANY_NAME%","%LINK%");
	$values = array($params[0],$params[3],$jfConfig['company_name'], $params[2]);
	$to = $params[1];
	break;	case 'joomla_user':
	$variables = array("%USERNAME%","%PASSWORD%","%CONTACT_NAME%","%JCONTACT_USER%","%COMPANY_NAME%","%LINK%","%SITE_NAME%");
	$link = JURI::base();
	$values = array($params[0],$params[1],$params[2],$user->name,$jfConfig['company_name'], $link, JURI::base());
	$to = $params[3];
	break;
}				$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".$jfConfig['company_name']. "&lt;".$jfConfig['company_email']."&gt;\r\n";
		$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";
			
		$module_subject = strtolower($module.'_subject');
		$module_email = strtolower($module.'_email');
		$emailsubject = str_replace($variables,$values,$jfConfig[$module_subject]);
		$contents = nl2br(str_replace($variables,$values,$jfConfig[$module_email]));
		
		mail($to,$emailsubject,$contents,$headers);
		}



function saveJoomlaUser($post) {
	global $mainframe;
	$db			= & JFactory::getDBO();
	$params['id'] = $post['jid'];
	$params['name'] = ($post['first_name']) ? $post['first_name']." ".$post['last_name'] : $post['last_name'];
	$params['username'] = $post['username'];
	$params['email'] = $post['email'];
	$params['gid'] = '18';
	$params['usertype'] = 'Registered';
	$params['password'] = $post['password'];
	$params['password2'] = $post['verifyPass'];	
	$user = new JUser($params['id']);
	if (!$user->bind($params))
		{
			$mainframe->enqueueMessage(JText::_('CANNOT SAVE THE USER INFORMATION'), 'message');
			$mainframe->enqueueMessage($user->getError(), 'error');
			return false;
		}
	if(!$user->save()) {
		echo "Save failed";
		echo "<br />";
	}
	$jid = $user->id;
	$pwd = $user->password_clear;
	return array($pwd, $jid);
	
}
function deleteJoomlaUser($id) {
	global $mainframe;
	$db	= & JFactory::getDBO();
	$user = new JUser($id);
	$user->delete();
	return;
}
function accountPopup() {
	global $mainframe;
	$database = & JFactory::getDBO();
	
	$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart	= $mainframe->getUserStateFromRequest($context.'limitstart', 'limitstart', 0, 'int');
	$limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );
	
if(isset($_REQUEST['quickadd']) && $_REQUEST['quickadd']!="") { 
	$accountname = JRequest::getVar('quickadd', '', $_REQUEST);
   	$accountname = str_replace('%20',' ',$accountname);
	$account = new accounts($database);
	$account->name = $accountname;
	$account->published = 1;
	$account->created 	= date( 'Y-m-d H:i:s' );
	$account->modified 	= date( 'Y-m-d H:i:s' );
	if (!$account->store()) {
		echo "<script> alert('".$account->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$where = "AND a.name = '".$accountname."'";

} elseif ($_REQUEST['filter']!="") {
	$filter = JRequest::getVar('filter', '', $_REQUEST);
    $filter = str_replace('%20',' ',$filter);
	$wheres = array();
	
	$wheres2[] 	= "LOWER(a.name) LIKE LOWER('%$filter%')";
	$wheres2[] 	= "LOWER(a.phone) LIKE LOWER('%$filter%')";
	$wheres2[] 	= "LOWER(a.website) LIKE LOWER('%$filter%')";
	$where 		= 'AND (' . implode( ') OR (', $wheres2 ) . ')';

} elseif($_REQUEST['alpha']!="") {

	$keyword = JRequest::getVar('alpha', '', $_REQUEST);
	$where 	= "AND LOWER(a.name) LIKE LOWER('$keyword%')";
}	else {
	$where = '';
}

	$query = "SELECT COUNT(*)"
	."\n FROM #__jaccounts as a"
	."\n WHERE (a.published > 0"
	."\n $where)"
	;

	$database->setQuery($query);
	$total = $database->loadResult();

	if ( $total <= $limit ) {
		$limitstart = 0;
	}
	$limit = 3;
	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );
	$query = "SELECT a.id, a.name, a.phone, a.website"
	."\n FROM #__jaccounts as a"
	."\n WHERE (a.published > 0"
	."\n $where)"
	;
	$database->setQuery($query, $limitstart, $limit);
	$rows  = $database->loadObjectList();

	HTML_contacts::accountPopup($rows, $pageNav);

}
function reportsToPopup() {
global $mainframe;
$database = & JFactory::getDBO();
	
	$limit		= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	$limitstart	= $mainframe->getUserStateFromRequest($context.'limitstart', 'limitstart', 0, 'int');
	$limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );
if ($_REQUEST['filter']) {
	$filter = JRequest::getVar('filter', '', $_REQUEST);
    $filter = str_replace('%20',' ',$filter);
	$wheres2[] 	= "LOWER(c.first_name) LIKE LOWER('%$filter%')";
	$wheres2[] 	= "LOWER(c.last_name) LIKE LOWER('%$filter%')";
	$wheres2[] 	= "LOWER(c.email) LIKE LOWER('%$filter%')";
	$wheres2[] 	= "LOWER(a.name) LIKE LOWER('%$filter%')";
	$where 		= 'AND (' . implode( ') OR (', $wheres2 ) . ')';

} elseif($_REQUEST['alpha']) {
	$keyword = JRequest::getVar('alpha', '', $_REQUEST);
	$where 	= "AND LOWER(c.last_name) LIKE LOWER('$keyword%')";
}	else {
	$where = '';
}

	$query = "SELECT COUNT(*)"
		."\n FROM #__jcontacts as c"
		."\n WHERE (c.published > 0"
		."\n $where)"
		;
	$database->setQuery($query);
	$total = $database->loadResult();

	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit );
	
	$query = "SELECT c.id, c.first_name, c.last_name, a.name as account, c.email"
		."\n FROM #__jcontacts as c"
		."\n LEFT OUTER JOIN #__jaccounts as a"
		."\n ON c.account_id = a.id"
		."\n WHERE (c.published > 0"
		."\n $where)"
		;

	$database->setQuery($query, $limitstart, $limit);
	$rows  = $database->loadObjectList();
	HTML_contacts::reportsToPopup($rows, $pageNav);
}
}
