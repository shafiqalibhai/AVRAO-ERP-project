<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class jAccessHelper
{
	function getGroups() { 

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
	$groups = $database->loadResultArray();
	
	if(!$groups) {
		$pass = false;
		$msg = "NO AUTH";
		$mainframe->redirect("index2.php",$msg);
	}
	
	return $groups;
}
# Prevent unauthorized direct access
function checkAuth($row) {
	global $jfConfig, $mainframe;
	$option         = JRequest::getCmd('option');
	$user =& JFactory::getUser();

	$groups = jAccessHelper::getGroups();

	if($jfConfig['access_restrictions']==1 && $user->gid!='25') {
		if (!in_array($row->gid, $groups)) {	
			$mainframe->redirect( 'index.php?option='.$option, _NOT_AUTH );
		} elseif ($row->mid!='0' && $row->mid != $user->id) {
			$mainframe->redirect( 'index.php?option='.$option, _NOT_AUTH );
		}
	}
}
# Prevent authorized tasks
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

function haveAccess() { 

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
		return $jAccess;
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
			$jAccounts=array('Quotes'=>max($jAccountsQuotes),'Invoices'=>max($jAccountsInvoices),'Services'=>max($jAccountsServices));	
			$jContacts=array('Leads'=>max($jContactsLeads),'Contacts'=>max($jContactsContacts),'Accounts'=>max($jContactsAccounts));	
			$jProjects=array('Tasks'=>max($jProjectsTasks),'Projects'=>max($jProjectsProjects),'Timer'=>max($jProjectsTimer));	
			$jSupport=array('Tickets'=>max($jSupportTickets),'Faqs'=>max($jSupportFaqs),'Categories'=>max($jSupportCategories));	
			
			if($user->gid=='25') {
			$jAccounts=array('Quotes'=>'3','Invoices'=>'3','Services'=>'3');	
			$jContacts=array('Leads'=>'3','Contacts'=>'3','Accounts'=>'3');	
			$jProjects=array('Tasks'=>'3','Projects'=>'3','Timer'=>'3');	
			$jSupport=array('Tickets'=>'3','Faqs'=>'3','Categories'=>'3');	
			}		
			
		$jAccess=array('jAccounts'=>$jAccounts,'jContacts'=>$jContacts,'jProjects'=>$jProjects,'jSupport'=>$jSupport);
		return $jAccess;						
}

function checkConnections() {
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

function checkLocation() {
	if(strpos($_SERVER['SCRIPT_NAME'], 'administrator')===false) {
			$adminLocation = 0;
		} else {
			$adminLocation = 1;
	}
	
return $adminLocation;
}

function managerList($row, $type) {
	$task           = JRequest::getCmd('task');
	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );
	$option         = JRequest::getCmd('option');
	$database       = JFactory::getDBO();
	$user           = JFactory::getUser();
	global $mainframe;
		
	if ($user->gid == '25') {
		$query = "SELECT id, groupname FROM #__jaccessgroups WHERE published='1' AND ".substr(strtolower($option),4)."_".$type." > 1";
	} else {
		$query = "SELECT id, groupname FROM #__jaccessgroups WHERE (groupmembers REGEXP '(^|[^0-9])0*$user->id([^0-9]|$)' AND published='1' AND ".substr(strtolower($option),4)."_".$type." > 1)";	
	}
	$database->setQuery($query);
	$manager_rows = $database->loadObjectList();

 	$m_array = array();
	$m_array[] = JHTML::_('select.option','', '-- Select Group --');
	foreach ($manager_rows as $m) {
	$m_array[] = JHTML::_('select.option',$m->id, $m->groupname);
	}
	
 	$lists['groups'] = JHTML::_('select.genericlist', $m_array, 'gid', 'class="inputbox" id="gid" onchange="getManagerList();"', 'value', 'text', $row->gid );
	return $lists['groups'];	
}	

function createMenuBar($component) {
	$task           = JRequest::getCmd('task');
	$cid			= JRequest::getVar( 'cid', array(0), '', 'array' );
	$id				= JRequest::getVar( 'id', $cid[0], '', 'int' );
	$option         = JRequest::getCmd('option');
	$database       = JFactory::getDBO();
	$user           = JFactory::getUser();
	$userid        = intval($user->get('id'));
	$adminlocation = jAccessHelper::checkLocation();
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
	if ($user->gid == '25') {
		$jAccounts=array('3','3','3');	
		$jContacts=array('3','3','3');	
		$jProjects=array('3','3','3');	
		$jSupport=array('3','3','3');	
	}									
			
		if($jAccounts!='0' && ($component=='jAccounts' || $component=='jForce')) {
			$jAccountsBar.="<ul class='jForceMenu'>";
			if ($adminlocation) {
				$jAccountsBar.="<li><a href='index.php?option=com_jaccounts' class='jaccounts_title'>Home</a></li>";
			}
			$jAccountsBar .= jAccessHelper::_getChildren('jaccounts', $jAccounts);
			}
		if($jContacts!='0'&& ($component=='jContacts' || $component=='jForce')) {
			$jContactsBar.="<ul class='jForceMenu'>";
			if ($adminlocation) {
				$jContactsBar.="<li><a href='index.php?option=com_jcontacts' class='jcontacts_title'>Home</a></li>";
			}
			$jContactsBar .= jAccessHelper::_getChildren('jcontacts', $jContacts);
			}
		if($jProjects!='0'&& ($component=='jProjects' || $component=='jForce')) {
			$jProjectsBar.="<ul class='jForceMenu'>";
			if ($adminlocation) {
				$jProjectsBar.="<li><a href='index.php?option=com_jprojects' class='jprojects_title'>Home</a></li>";
			}
			$jProjectsBar .= jAccessHelper::_getChildren('jprojects', $jProjects);
			}
		if($jSupport!='0'&& ($component=='jSupport' || $component=='jForce')) {
			$jSupportBar.="<ul class='jForceMenu'>";
			if ($adminlocation) {
				$jSupportBar.="<li><a href='index.php?option=com_jsupport' class='jsupport_title'>Home</a></li>";
			}
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
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=listInvoices' class='listinvoices'>"._VIEW_INVOICES_MENU_LINK."</a></li>";
			}
			if($type[0] > 0) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=listQuotes' class='listquotes'>"._VIEW_QUOTES_MENU_LINK."</a></li>";
			}
			if($type[1] > 1) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=newInvoice' class='newinvoice'>"._NEW_INVOICE_MENU_LINK."</a></li>";
			}
			if($type[0] > 1) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=newQuote' class='newquote'>"._NEW_QUOTE_MENU_LINK."</a></li>";
			}
			if($type[2] > 0) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=listServices' class='manageservices'>"._MANAGE_SERVICES_MENU_LINK."</a></li>";
			}
			if($type[2] > 1) {
				$subNav.="<li><a href='index.php?option=com_jaccounts&task=newService' class='addservice'>"._ADD_SERVICE_MENU_LINK."</a></li>";
			}			
			break;
			case 'jcontacts':
			if($type[0] > 0) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=listLeads' class='listleads'>"._VIEW_LEADS_MENU_LINK."</a></li>";
			}
			if($type[0] > 1) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=newLead' class='newlead'>"._NEW_LEAD_MENU_LINK."</a></li>";
			}
			if($type[1] > 1) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=newContact' class='newcontact'>"._NEW_CONTACT_MENU_LINK."</a></li>";
			}
			if($type[1] > 0) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=listContacts' class='listcontacts'>"._VIEW_CONTACTS_MENU_LINK."</a></li>";
			}
			if($type[2] > 1) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=newAccount' class='newaccount'>"._NEW_ACCOUNT_MENU_LINK."</a></li>";
			}
			if($type[2] > 0) {
				$subNav.="<li><a href='index.php?option=com_jcontacts&task=listAccounts' class='listaccounts'>"._VIEW_ACCOUNTS_MENU_LINK."</a></li>";
			}
			break;															
			case 'jprojects':
			if($type[0] > 0) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=listTasks' class='listtasks'>"._VIEW_TASKS_MENU_LINK."</a></li>";
			}
			if($type[0] > 1) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=newTask' class='newtask'>"._NEW_TASK_MENU_LINK."</a></li>";
			}
			if($type[1] > 1) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=newProject' class='newproject'>"._NEW_PROJECT_MENU_LINK."</a></li>";
			}
			if($type[1] > 0) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=listProjects' class='projects'>"._VIEW_PROJECTS_MENU_LINK."</a></li>";
			}
			if($type[2] > 1) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=newTime'>"._NEW_TIME_MENU_LINK."</a></li>";
			}
			if($type[2] > 0) {
				$subNav.="<li><a href='index.php?option=com_jprojects&task=listTimes'>"._VIEW_TIMES_MENU_LINK."</a></li>";
			}
			break;															
			case 'jsupport':
			if($type[0] > 0) {		
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
