<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class jAccessClientHelper
{
	function checkAccess() { 

	$task           = JRequest::getCmd('task');
	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );
	$option         = JRequest::getCmd('option');
	$database       = JFactory::getDBO();
	$user           = JFactory::getUser();
	$userid         = intval($user->get('id'));

	global $mainframe;
	$pass = false;
	
	$query = "SELECT * FROM #__jaccessgroups WHERE (groupmembers REGEXP '(^|[^0-9])0*$userid([^0-9]|$)' AND published='1')";
	$database->setQuery($query);
	$groups = $database->loadObjectList();
	
	if(!$groups) {
		$pass = false;
		$msg = "NO AUTH";
		$mainframe->redirect("index2.php",$msg);
	}

		$group1=array('list','view');
		$group2=array('edit', 'publish', 'unpublish', 'save', 'new');
		
		$possible = array_merge($group1,$group2);
		
		foreach($possible as $p) {
			if(strstr($task,$p)) {
				$short = $p;
			}	
		}
		if(!$short) { return; }
		if($user->get('gid')=='25') { $isSuper=true; }

		foreach($groups as $g) {
			$jAccountsQuotes[]=$g->jaccounts_quotes;
			$jAccountsInvoices[]=$g->jaccounts_invoices;
			$jAccountsServices[]=$g->jaccounts_services;

			$jContactsLeads[]=$g->jcontacts_leads;
			$jContactsContacts[]=$g->jcontacts_contacts;
			$jContactsAccounts[]=$g->jcontacts_accounts;

			$jProjectsTasks[]=$g->jprojects_tasks;
			$jProjectsProjects[]=$g->jprojects_projects;
			$jProjectsTimer[]=$g->jprojects_timer;

			$jSupportTickets[]=$g->jsupport_tickets;
			$jSupportFaqs[]=$g->jsupport_faqs;
			$jSupportCategories[]=$g->jsupport_categories;									
	}	
			$jAccounts=array(max($jAccountsQuotes),max($jAccountsInvoices),max($jAccountsServices));	
			$jContacts=array(max($jContactsLeads),max($jContactsContacts),max($jContactsAccounts));	
			$jProjects=array(max($jProjectsTasks),max($jProjectsProjects),max($jProjectsTimer));	
			$jSupport=array(max($jSupportTickets),max($jSupportFaqs),max($jSupportCategories));										

			switch($option) {

				case 'com_jaccounts':
					$result = jAccessHelper::jAccountsAccess($jAccounts, $task, $short, $group1, $group2);
					break;
				case 'com_jcontacts':
					$result = jAccessHelper::jContactsAccess($jContacts, $task, $short, $group1, $group2);
					break;
				case 'com_jprojects':
					$result = jAccessHelper::jProjectsAccess($jProjects, $task, $short, $group1, $group2);
					break;
				case 'com_jsupport':
					$result = jAccessHelper::jSupportAccess($jSupport, $task, $short, $group1, $group2);
					break;
			} 
		if($result != true && !$isSuper) { 
			$msg = _NOT_AUTH;
			$mainframe->redirect('index.php?option='.$option,$msg);
		}		
}
function checkConnections() {
	$task           = JRequest::getCmd('task');
	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );
	$option         = JRequest::getCmd('option');
	$database       = JFactory::getDBO();
	$user           = JFactory::getUser();
	global $mainframe;
	
   $jAccountsPath = JPATH_SITE."/administrator/components/com_jaccounts";
   if (file_exists( $jAccountsPath )) {
		$connection['jAccounts']=true;
      }

   $jContactsPath = JPATH_SITE."/administrator/components/com_jcontacts";
   if (file_exists( $jContactsPath )) {
		$connection['jContacts']=true;
      }

   $jProjectsPath = JPATH_SITE."/administrator/components/com_jprojects";
   if (file_exists( $jProjectsPath )) {
		$connection['jProjects']=true;
      }

   $jSupportPath = JPATH_SITE."/administrator/components/com_jsupport";
   if (file_exists( $jSupportPath )) {
		$connection['jSupport']=true;
      }
return $connection;
}

function managerList($row, $type) {
	$task           = JRequest::getCmd('task');
	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );
	$option         = JRequest::getCmd('option');
	$database       = JFactory::getDBO();
	$user           = JFactory::getUser();
	global $mainframe;
		
	$query = "SELECT id, groupname FROM #__jaccessgroups WHERE published='1' AND ".substr(strtolower($option),4)."_".$type." > 1";
	$database->setQuery($query);
	$manager_rows = $database->loadObjectList();

 	$m_array = array();
	$m_array[] = JHTML::_('select.option','', 'None');
	foreach ($manager_rows as $m) {
	$m_array[] = JHTML::_('select.option',$m->id, $m->groupname);
	}
	
 	$lists['managers'] = JHTML::_('select.genericlist', $m_array, 'manager', 'class="inputbox" id="manager" onchange="getManagerList();"', 'value', 'text', $row->manager );
	return $lists['managers'];	
}	

function createMenuBar($component) {
	$task           = JRequest::getCmd('task');
	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );
	$option         = JRequest::getCmd('option');
	$database       = JFactory::getDBO();
	$user           = JFactory::getUser();
	$userid        = intval($user->get('id'));
	global $mainframe;
	$pass = false;
	
	$query = "SELECT * FROM #__jaccessgroups WHERE (groupmembers REGEXP '(^|[^0-9])0*$userid([^0-9]|$)' AND published='1')";
	$database->setQuery($query);
	$groups = $database->loadObjectList();
	
	if(!$groups) {
		$pass = false;
		$msg = "NO AUTH";
		$mainframe->redirect("index2.php",$msg);
	}
	foreach($groups as $g) {
			$jAccountsQuotes[]=$g->jaccounts_quotes;
			$jAccountsInvoices[]=$g->jaccounts_invoices;
			$jAccountsServices[]=$g->jaccounts_services;

			$jContactsLeads[]=$g->jcontacts_leads;
			$jContactsContacts[]=$g->jcontacts_contacts;
			$jContactsAccounts[]=$g->jcontacts_accounts;

			$jProjectsTasks[]=$g->jprojects_tasks;
			$jProjectsProjects[]=$g->jprojects_projects;
			$jProjectsTimer[]=$g->jprojects_timer;

			$jSupportTickets[]=$g->jsupport_tickets;
			$jSupportFaqs[]=$g->jsupport_faqs;
			$jSupportCategories[]=$g->jsupport_categories;									
	}	
			$jAccounts=array(max($jAccountsQuotes),max($jAccountsInvoices),max($jAccountsServices));	
			$jContacts=array(max($jContactsLeads),max($jContactsContacts),max($jContactsAccounts));	
			$jProjects=array(max($jProjectsTasks),max($jProjectsProjects),max($jProjectsTimer));	
			$jSupport=array(max($jSupportTickets),max($jSupportFaqs),max($jSupportCategories));										
			
		if($jAccounts!='0' && ($component=='jAccounts' || $component=='jForce')) {
			$jAccountsBar.="<ul class='jForceMenu'><li><a href='index.php?option=com_jaccounts'>jAccounts</a></li>";
			$jAccountsBar .= jAccessHelper::_getChildren('jaccounts', $jAccounts);
			}
		if($jContacts!='0'&& ($component=='jContacts' || $component=='jForce')) {
			$jContactsBar.="<ul class='jForceMenu'><li><a href='index.php?option=com_jcontacts'>jContacts</a></li>";
			$jContactsBar .= jAccessHelper::_getChildren('jcontacts', $jContacts);
			}
		if($jProjects!='0'&& ($component=='jProjects' || $component=='jForce')) {
			$jProjectsBar.="<ul class='jForceMenu'><li><a href='index.php?option=com_jprojects'>jProjects</a></li>";
			$jProjectsBar .= jAccessHelper::_getChildren('jprojects', $jProjects);
			}
		if($jSupport!='0'&& ($component=='jSupport' || $component=='jForce')) {
			$jSupportBar.="<ul class='jForceMenu'><li><a href='index.php?option=com_jsupport' class='jsupport_title'>jSupport</a></li>";
			$jSupportBar .= jAccessHelper::_getChildren('jsupport', $jSupport);
			}			
			
			$jAccountsBar .="</ul>";
			$jContactsBar .="</ul>";
			$jProjectsBar .="</ul>";
			$jSupportBar  .="</ul>";	
	echo $jAccountsBar.$jContactsBar.$jProjectsBar.$jSupportBar;
}

function _getChildren($parent, $type) {
		$subNav .="<ul class='jForceSubMenu'>";
		switch($parent) {
			case 'jaccounts':
			if($type[1] > 0) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=listInvoices'>"._VIEW_INVOICES_MENU_LINK."</a></li>";
			}
			if($type[0] > 0) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=listQuotes'>"._VIEW_QUOTES_MENU_LINK."</a></li>";
			}
			if($type[1] > 1) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=newInvoice'>"._NEW_INVOICE_MENU_LINK."</a></li>";
			}
			if($type[0] > 1) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=newQuote'>"._NEW_QUOTE_MENU_LINK."</a></li>";
			}
			if($type[2] > 0) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=listServices'>"._MANAGE_SERVICES_MENU_LINK."</a></li>";
			}
			if($type[2] > 1) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=newService'>"._ADD_SERVICE_MENU_LINK."</a></li>";
			}			
			break;
			case 'jcontacts':
			if($type[0] > 0) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=listLeads'>"._VIEW_LEADS_MENU_LINK."</a></li>";
			}
			if($type[0] > 1) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=newLead'>"._NEW_LEAD_MENU_LINK."</a></li>";
			}
			if($type[1] > 1) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=newContact'>"._NEW_CONTACT_MENU_LINK."</a></li>";
			}
			if($type[1] > 0) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=listContacts'>"._VIEW_CONTACTS_MENU_LINK."</a></li>";
			}
			if($type[2] > 1) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=newAccount'>"._NEW_ACCOUNT_MENU_LINK."</a></li>";
			}
			if($type[2] > 0) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=listAccounts'>"._VIEW_ACCOUNTS_MENU_LINK."</a></li>";
			}
			break;															
			case 'jprojects':
			if($type[0] > 0) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=listTasks'>"._VIEW_LEADS_MENU_LINK."</a></li>";
			}
			if($type[0] > 1) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=newTask' class='newtask'>"._NEW_LEAD_MENU_LINK."</a></li>";
			}
			if($type[1] > 1) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=newProject' class='newproject'>"._NEW_CONTACT_MENU_LINK."</a></li>";
			}
			if($type[1] > 0) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=listProjects' class='projects'>"._VIEW_CONTACTS_MENU_LINK."</a></li>";
			}
			if($type[2] > 1) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=newTime'>"._NEW_ACCOUNT_MENU_LINK."</a></li>";
			}
			if($type[2] > 0) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=listTimes'>"._VIEW_ACCOUNTS_MENU_LINK."</a></li>";
			}
			break;															
			case 'jsupport':
			if($type[0] > 0) {		
				$subNav.="<li><a href='index.php?option=com_jsupport&task=listTickets&type=new' class='tickets'>"._VIEW_NEW_TICKETS_MENU_LINK."</a></li>";
				$subNav.="<li><a href='index.php?option=com_jsupport&task=listTickets&type=open' class='tickets'>"._VIEW_OPEN_TICKETS_MENU_LINK."</a></li>";			
				$subNav.="<li><a href='index.php?option=com_jsupport&task=listTickets' class='tickets'>"._VIEW_ALL_TICKETS_MENU_LINK."</a></li>";				
			}
			if($type[0] > 1) {
				$subNav.="<li><a href='index.php?option=com_jsupport&task=newTicket' class='newticket'>"._CREATE_TICKET_MENU_LINK."</a></li>";
			}
			if($type[1] > 0) {
				$subNav.="<li class='menu_title'>"._FAQS_MENU."</li>";				
				$subNav.="<li><a href='index.php?option=com_jsupport&task=listFaqs' class='faqs'>"._VIEW_FAQS_MENU_LINK."</a></li>";
			}
			if($type[1] > 1) {
				$subNav.="<li><a href='index.php?option=com_jsupport&task=newFaq' class='newfaq'>"._CREATE_FAQ_MENU_LINK."</a></li>";
				
				$subNav.="<li class='menu_title'>"._COMMENTS_MENU."</li>";								
				$subNav.="<li><a href='index.php?option=com_jsupport&task=listComments' class='comments'>"._VIEW_ALL_COMMENTS_MENU_LINK."</a></li>";
				
				$subNav.="<li><a href='index.php?option=com_jsupport&task=listComments&type=unpublished' class='unpub_comments'>"._VIEW_UNPUBLISHED_COMMENTS_MENU_LINK."</a></li>";				
			
			}		
			if($type[2] > 0) {
				$subNav.="<li class='menu_title'>"._CATEGORIES_MENU_LINK."</li>";			
				$subNav.="<li><a href='index.php?option=com_jsupport&task=listCategories' class='categories'>"._CATEGORIES_MENU_LINK."</a></li>";
			} 
			if($type[2] > 1) {
				$subNav.="<li><a href='index.php?option=com_jsupport&task=newCategory' class='newcategory'>"._NEW_CATEGORY_MENU_LINK."</a></li>";
			}
			break;																					
		}
		$subNav .="</ul>";
		return $subNav;		
}

function jAccountsAccess($jAccounts, $task, $short, $group1, $group2) {
	global $mainframe, $option;
	$pass = false;
	
		$type = array("Quote","Invoice","Service");
			foreach($type as $t) {
				if(strstr($task,$t)) {
					$chosen = $t;
				}				
			}
			switch($chosen) {
					case "Quote":
						if($jAccounts[0] == 3) {
							$pass = true;
							}
						elseif($jAccounts[0] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jAccounts[0] == 2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
							}
					break;
					case "Invoice":
						if($jAccounts[1] == 3) {
							$pass = true;
						}
						elseif($jAccounts[1] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jAccounts[1] ==2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
					break;						
					case "Service":
						if($jAccounts[2] == 3) {
							$pass = true;
						}
						elseif($jAccounts[2] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jAccounts[2] == 2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
			}
	return $pass;
}

function jContactsAccess($jContacts, $task, $short, $group1, $group2) {
	global $mainframe, $option;
	$pass = false;
			
		$type = array("Lead","Contact","Account");
			foreach($type as $t) {
				if(strstr($task,$t)) {
					$chosen = $t;
				}				
			}
			
			switch($chosen) {
					case "Lead":
						if($jContacts[0] == 3) {
							$pass = true;
							}
						elseif($jContacts[0] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jContacts[0] == 2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
							}
					break;
					case "Contact":
						if($jContacts[1] == 3) {
							$pass = true;
						}
						elseif($jContacts[1] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jContacts[1] ==2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
					break;						
					case "Account":
						if($jContacts[2] == 3) {
							$pass = true;
						}
						elseif($jContacts[2] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jContacts[2] ==2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
			}

	return $pass;
}

function jProjectsAccess($jProjects, $task, $short, $group1, $group2) {
	global $mainframe, $option;
	$pass = false;

		$type = array("Task","Project","Timer");
			foreach($type as $t) {
				if(strstr($task,$t)) {
					$chosen = $t;
				}				
			}
			
			switch($chosen) {
					case "Task":
						if($jProjects[0] == 3) {
							$pass = true;
							}
						elseif($jProjects[0] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jProjects[0] == 2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
							}
					break;
					case "Project":
						if($jProjects[1] == 3) {
							$pass = true;
						}
						elseif($jProjects[1] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jProjects[1] ==2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
					break;						
					case "Timer":
						if($jProjects[2] == 3) {
							$pass = true;
						}
						elseif($jProjects[2] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jProjects[2] ==2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
					break;
			}
	
	return $pass;	
}

function jSupportAccess($jSupport, $task, $short, $group1, $group2) {
	global $mainframe, $option;
	$pass = false;
	
		$type = array("Ticket","Faq","Categor");
			foreach($type as $t) {
				if(strstr($task,$t)) {
					$chosen = $t;
				}				
			}

			switch($chosen) {
					case "Ticket":
						if($jSupport[0] == 3) {
							$pass = true;
							}
						elseif($jSupport[0] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jSupport[0] == 2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
							}
					break;
					case "Faq":
						if($jSupport[1] == 3) {
							$pass = true;
						}
						elseif($jSupport[1] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jSupport[1] ==2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
					break;						
					case "Categor":
						if($jSupport[2] == 3) {
							$pass = true;
						}
						elseif($jSupport[2] == 1 && (in_array($short,$group1))) {
							$pass = true;
						}
						elseif($jSupport[2] == 2 && (in_array($short,array_merge($group1,$group2)))) {
							$pass = true;
						}
			}
			
	return $pass;
}


}
?>
