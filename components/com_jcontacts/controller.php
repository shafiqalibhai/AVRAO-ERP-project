<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class jContactsClientController extends JController {

function getLists($row) {
	include_once("administrator/components/com_jcontacts/lib/lib.php" );
	
	# State Lists
	$s_array[] = JHTML::_('select.option','', '');
	while(list($key, $value) = each($state_array)) {
		$s_array[] = JHTML::_('select.option',$key, ucwords(strtolower($value)));
	}
	
	$lists['mailing_state'] = JHTML::_('select.genericlist', $s_array, 'mailing_state', 'class="inputbox" id="mstate"', 'value', 'text', $row->mailing_state );
	$lists['other_state'] = JHTML::_('select.genericlist', $s_array, 'other_state', 'class="inputbox" id="ostate"', 'value', 'text', $row->other_state );
	$lists['billing_state'] = JHTML::_('select.genericlist', $s_array, 'billing_state', 'class="inputbox" id="mstate"', 'value', 'text', $row->billing_state );
	$lists['shipping_state'] = JHTML::_('select.genericlist', $s_array, 'shipping_state', 'class="inputbox" id="ostate"', 'value', 'text', $row->shipping_state );
	
	# Country Lists
	$c_array[] = JHTML::_('select.option','', '');
	$c_array[] = JHTML::_('select.option','US', 'United States');
	while(list($key, $value) = each($country_array)) {
		$c_array[] = JHTML::_('select.option',$key, ucwords(strtolower($value)));
	}
	
	$lists['mailing_country'] = JHTML::_('select.genericlist', $c_array, 'mailing_country', 'class="inputbox" id="mcountry"', 'value', 'text', $row->mailing_country );
	$lists['other_country'] = JHTML::_('select.genericlist', $c_array, 'other_country', 'class="inputbox" id="ocountry"', 'value', 'text', $row->other_country );
	$lists['billing_country'] = JHTML::_('select.genericlist', $c_array, 'billing_country', 'class="inputbox" id="mcountry"', 'value', 'text', $row->billing_country );
	$lists['shipping_country'] = JHTML::_('select.genericlist', $c_array, 'shipping_country', 'class="inputbox" id="ocountry"', 'value', 'text', $row->shipping_country );
	return $lists;
}

function checkAuth($type, $row=null) {
	global $jfConfig, $mainframe;
	$my =& JFactory::getUser();
	
	switch ($type) {
	
		case 'access':
		if(!isset($my->id) || $my->id=='0') {
			$mainframe->redirect( 'index.php?option=com_jcontacts', _NOT_AUTH );
		}
		if($jfConfig['access_restrictions']==1 && $my->gid!='2' && $row->manager_id != $my->id) {
			$mainframe->redirect( 'index.php?option=com_jcontacts', _NOT_AUTH );
		}
		break;
		
		case 'login':
		if(!isset($my->id) || $my->id=='0') {
			$mainframe->redirect( 'index.php?option=com_jcontacts', _NOT_AUTH );
		}
		break;
	}
}

function newLead($option) {

	HTML_JCONTACTS::newLeadForm($option);

}

function saveLead($option) {
	global $mainframe, $jfConfig;
	$database = & JFactory::getDBO();

	$row = new leads($database);
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$name = $row->first_name." ".$row->last_name;
	$link=JURI::root()."/administrator/index2.php?option=com_jcontacts&task=viewContact&cid[]=".$row->id;
	$params = array($name, $row->company_name, $row->phone, $row->email, $row->message, $link);
	$module = "new_lead";
	
	jContactsClientController::sendEmail($module, $params);
	if ($jfConfig['newLeadRedirect']!='') {
		$mainframe->redirect($jfConfig['newLeadRedirect'], $jfConfig['newLeadMsg']);
	} else {
		$msg = "Thank you for your interest.  Someone will contact you shortly.";
		$mainframe->redirect('index.php?option=com_jcontacts', $msg);
	}
}

function editMyDetails($task, $option, $my) {
	global $mainframe;
	if ($my->gid != '18') {
		$mainframe->redirect('index.php?option=com_user&view=user&task=edit');
	}
	$database = & JFactory::getDBO();
	jContactsClientController::checkAuth('login');
	
	$query = "SELECT id FROM #__jcontacts WHERE jid='$my->id'";
	$database->setQuery($query);
	$uid = $database->loadResult();
	$row = new contacts($database);
	$row -> load($uid);	
	
	$jrow = new JUser($row->jid);	
	$jrow->orig_password = $jrow->password;	$jrow->name = trim( $jrow->name );
	$jrow->email = trim( $jrow->email );
	$jrow->username = trim( $jrow->username );	
	
	
	if ($task=='editMyDetails') {
		$lists = jContactsClientController::getLists($row);
		HTML_JCONTACTS::editMyDetails($my, $row, $jrow, $lists);
	} else {
		HTML_JCONTACTS::viewMyDetails($my, $row, $jrow);
	}
}
function saveContactDetails($option, $my) {
	global $mainframe, $jfConfig;
	$database = & JFactory::getDBO();
	$row = new contacts($database);
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (!$row->id) {
		$msg = $jfConfig['post_reg_message'];
		$link = $jfConfig['reg_redirect'];
		$row->published = '1';
	} else {
		$msg = "Thank you for updating your details.";
		$link = 'index.php?option=com_jcontacts&task=viewMyDetails&id='.$row->id;
	}
	
	$row->birthdate = $_POST['bday_year']."-".$_POST['bday_month']."-".$_POST['bday_day'];
	
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	jContactsClientController::saveJoomlaUser($_POST, $row->id);

	$mainframe->redirect($link, $msg);
}
function saveJoomlaUser($post, $id) {
	global $mainframe;
	$db	= & JFactory::getDBO();
	$params['id'] = $post['jid'];
	$params['name'] = ($post['first_name']) ? $post['first_name']." ".$post['last_name'] : $post['last_name'];
	$params['username'] = $post['username'];
	$params['email'] = $post['email'];
	$params['gid'] = $post['gid'];
	$params['usertype'] = $post['usertype'];
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
	$db->setQuery("UPDATE #__jcontacts SET jid = '$user->id' WHERE id = '$id'");
	$db->query();
}
function registrationForm($option) {
	$lists = jContactsClientController::getLists('');
	HTML_JCONTACTS::editMyDetails($my=NULL, $row=NULL, $jrow=NULL, $lists);
}
function sendEmail($module, $params) {
global $my, $mosConfig_live_site, $jfConfig;
$database = & JFactory::getDBO();
switch ($module) {
	case 'new_lead':
	$variables = array("%LEAD_NAME%","%COMPANY%","%PHONE%","%EMAIL%","%MESSAGE%","%LINK%");
	$values = array($params[0], $params[1], $params[2], $params[3], $params[4], $params[5]);
	$to = $jfConfig['company_email'];
	break;
}				$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
		$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";
			
		$module_subject = strtolower($module.'_subject');
		$module_email = strtolower($module.'_email');
		$emailsubject = str_replace($variables,$values,$jfConfig[$module_subject]);
		$contents = nl2br(str_replace($variables,$values,$jfConfig[$module_email]));
		
		mail($to,$emailsubject,$contents,$headers);}
		
function getContacts($option, $c_auth) {
		$database = & JFactory::getDBO();
		$my =& JFactory::getUser();
		global $mainframe;
		
		jContactsClientController::checkAuth('login');

		// Get the page/component configuration
		$params = &$mainframe->getParams();
		$limit		= JRequest::getVar('limit', $params->get('display_num'), '', 'int');
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
		
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
		
		$query = "SELECT COUNT(*)"
		."\n FROM #__jcontacts AS c"
		."\n LEFT OUTER JOIN #__jaccounts as a"
		."\n ON c.account_id = a.id"
		."\n LEFT OUTER JOIN #__users as u"
		."\n ON c.manager_id = u.id"
		."\n WHERE c.published > '0'"
		."\n $c_auth"
		."\n $where"
		;
		$database->setQuery($query);
		$total = $database->loadResult();
		
		if ( $total <= $limit ) {
			$limitstart = 0;
		}

		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);

		$query = "SELECT c.id, c.first_name, c.last_name, a.id as aid, a.name, c.created, c.phone, c.email, u.name as jname, u.username"
		."\n FROM #__jcontacts as c"
		."\n LEFT OUTER JOIN #__jaccounts as a"
		."\n ON c.account_id = a.id"
		."\n LEFT OUTER JOIN #__users as u"
		."\n ON c.manager_id = u.id"
		."\n WHERE (c.published > 0 "
		.$c_auth
		."\n $where)";
		
		$database->setQuery($query, $limitstart, $limit);
		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
	
	HTML_JCONTACTS::listContacts($option, $rows, $pagination);
}
function viewContact($option) {
	$database = & JFactory::getDBO();
	$my =& JFactory::getUser();
	
	$uid=$_REQUEST['id'];	
	$row = new contacts($database);
	$row -> load($uid);
	
	jContactsClientController::checkAuth('access',$row);
	$database->setQuery("SELECT id, name FROM #__jaccounts WHERE id = $row->account_id");
	$account = $database->loadRow();
	$database->setQuery("SELECT id, last_name, first_name FROM #__jcontacts WHERE id = $row->reports_to");
	$reports_to = $database->loadRow();
	$database->setQuery("SELECT id, name, username FROM #__users WHERE id = $row->manager_id");
	$manager = $database->loadRow();	

	
	HTML_JCONTACTS::viewContact($option, $row, $account, $reports_to, $manager);
}
function viewAccount($option) {
		$database = & JFactory::getDBO();
		$my =& JFactory::getUser();
		$id = $_REQUEST['id'];
		$row = new accounts($database);
		
		$row -> load($id);
		jContactsClientController::checkAuth('access', $row);
		$database->setQuery("SELECT id, name, username FROM #__users WHERE id = $row->manager_id");
		$manager = $database->loadRow();
		
		$query="SELECT *"
		."\n FROM #__jcontacts as c"
		."\n WHERE account_id = '$row->id'"
		."\n AND c.published > '0'"
		.$c_auth
		;
		$database->setQuery($query);
		$contacts=$database->loadObjectList();		
	HTML_JCONTACTS::viewAccount($option, $row, $manager, $contacts);
	}
function getAccounts($option, $a_auth) {
		global $mainframe;
		$database = & JFactory::getDBO();
		$my =& JFactory::getUser();
		
		jContactsClientController::checkAuth('login');
		
		// Get the page/component configuration
		$params = &$mainframe->getParams();
		$limit		= JRequest::getVar('limit', $params->get('display_num'), '', 'int');
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');

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

		$query = "SELECT COUNT(*)"
		."\n FROM #__jaccounts as a"
		."\n LEFT OUTER JOIN #__users as u"
		."\n ON a.manager_id = u.id"
		."\n WHERE published > '0'"
		.$a_auth
		."\n $where"
		;
		$database->setQuery($query);
		$total = $database->loadResult();
		
		if ( $total <= $limit ) {
			$limitstart = 0;
		}

		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);
	
		$query="SELECT a.*, u.name as jname, u.username"
		."\n FROM #__jaccounts as a"
		."\n LEFT OUTER JOIN #__users as u"
		."\n ON a.manager_id = u.id"
		."\n WHERE published > '0'"
		.$a_auth
		."\n $where"
		;

		$database->setQuery($query, $limitstart, $limit);
		$rows = $database -> loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
	
	HTML_JCONTACTS::listAccounts($option, $rows, $pagination);
}
}