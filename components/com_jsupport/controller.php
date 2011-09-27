<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class jSupportController extends JController
{

//Ticket Functions
function listTickets($option) {
	$user = & JFactory::getUser();
	$database = & JFactory::getDBO();
	
	$userid = $user->get('id');


	switch ( $type ) {

		case 'new':
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jtickets WHERE converted !='1' AND contactid = '$userid' ORDER BY created DESC" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();
	
			$database->setQuery("SELECT #__jtickets.id, subject, contactid, status, priority, created, "
			."\n #__users.username FROM #__jtickets"
			."\n LEFT JOIN #__users on #__jtickets.contactid = #__users.id WHERE #__jtickets.converted !='1' AND contactid='$userid' ORDER BY created DESC");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

			break;

		case 'open':
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jtickets WHERE status !='Closed' AND converted !='1' AND contactid='$userid'" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();
	
			$database->setQuery("SELECT #__jtickets.id, subject, contactid, status, priority, created, "
			."\n #__users.username FROM #__jtickets"
			."\n LEFT JOIN #__users on #__jtickets.contactid = #__users.id WHERE status!='Closed' AND converted !='1' AND contactid='$userid' ORDER BY #__jtickets.id, subject DESC");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

			break;
			
		case 'all':
		default:
			# get the total number of records
			$database->setQuery( "SELECT count(*) FROM #__jtickets WHERE converted!='1' and contactid='$userid'" );
			$total = $database->loadResult();
			echo $database->getErrorMsg();
	
			$database->setQuery("SELECT #__jtickets.id, subject, contactid, status, priority, created, "
			."\n #__users.username FROM #__jtickets"
			."\n LEFT JOIN #__users on #__jtickets.contactid = #__users.id WHERE #__jtickets.converted!='1' AND contactid='$userid' ORDER BY #__jtickets.id, subject DESC");

			$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

			break;
		}

	HTML_JSUPPORT::listTickets($option, $rows);
}

function editTicket($option, $uid) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

		$row = new tickets($database);
		if($uid){
			$row -> load($uid[0]);

			if($row->contactid != $user->get('id')) { 
				JText::_('NOTAUTH'); 
				return;	
			}

			$query = "SELECT * FROM #__jsupportcomments WHERE ticketid='$row->id' ORDER BY id ASC";
			$database->setQuery($query);
			$ticketcomments = $database->loadObjectList();
		}
		$query = "SELECT * FROM #__jsupportcategories WHERE published='1'";
		$database->setQuery($query);
		$categories = $database->loadObjectList();

	HTML_JSUPPORT::editTicket($option, $row, $ticketcomments, $managers, $categories);
}
function viewTicket($option, $uid) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

		$row = new tickets($database);
		if($uid){
			$row -> load($uid[0]);

			if($row->contactid != $user->get('id')) { 
				JText::_('NOTAUTH'); 
				return;	
			}

			$query = "SELECT * FROM #__jsupportcomments WHERE ticketid='$row->id' ORDER BY id ASC";
			$database->setQuery($query);
			$ticketcomments = $database->loadObjectList();
		}

		$query = "SELECT * FROM #__users WHERE id='$row->manager'";
		$database->setQuery($query);
		$manager = $database->loadRow();
				
		$query = "SELECT * FROM #__jsupportcategories WHERE id='$row->category'";
		$database->setQuery($query);
		$category = $database->loadRow();
						
	HTML_JSUPPORT::viewTicket($option, $row, $ticketcomments, $manager, $category);
}
function saveTicket ($option) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

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
					$row->created = date ('Y-m-d H:i:s' );
				}
				
			if ($row->created && strlen(trim( $row->created )) <= 10) {
				$row->created 	.= ' 00:00:00';
			}
		
			if($row->contactid=="") { 
				$row->contactid = $user->get('id');
			}

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if($jfConfig['send_email'] == '1') {
		jSupportController::sendEmail('TICKET',$row->id);
	}
	$ticketid = $row->id;
	$comment = addslashes($_REQUEST['comment'.$i]);
	
	if($comment != '') {			
		$query = "INSERT INTO #__jsupportcomments (ticketid, contactid, comment) VALUES ($ticketid, $row->contactid,'$comment')";
			$database->setQuery($query);
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}	
	$mainframe->redirect( 'index.php?option=com_jsupport&task=listTickets', $msg );
}
//FAQ Functions

function listFaqs ($option) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

			$query = "SELECT #__jfaqs.id, #__jfaqs.subject FROM #__jfaqs WHERE #__jfaqs.published = 1"
			. "\n ORDER BY #__jfaqs.created DESC LIMIT 5";
			
			$database->setQuery($query);
			$latest = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

			$database->setQuery("SELECT #__jfaqs.id, #__jfaqs.subject FROM #__jfaqs"
			. "\n ORDER BY #__jfaqs.hits DESC LIMIT 5");

			$popular = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}
			$database->setQuery("SELECT * FROM #__jsupportcategories");
			$categories = $database->loadObjectList();
			
			foreach($categories as $cat) { 
				$database->setQuery("SELECT COUNT(*) FROM #__jfaqs WHERE #__jfaqs.category = '$cat->id'");
				$cat->total = $database->loadResult();
			}
	HTML_JSUPPORT::listFaqs($option, $latest, $popular, $categories);
}
function listFaqCategory ($option, $catid) {

$database = & JFactory::getDBO();
		
		$query = "SELECT #__jfaqs.id, #__jfaqs.score, #__jfaqs.description, #__jfaqs.category, #__jfaqs.solution, #__jfaqs.hits, #__jsupportcategories.name, #__jfaqs.subject FROM #__jfaqs INNER JOIN #__jsupportcategories on #__jfaqs.category = #__jsupportcategories.id WHERE #__jfaqs.category = $catid[0]"
			. "\n ORDER BY #__jsupportcategories.name, #__jfaqs.id, #__jfaqs.subject DESC";
		$database->setQuery($query);
		$rows = $database -> loadObjectList();
				if ($database -> getErrorNum()) {
					echo $database -> stderr();
					return false;
				}

	HTML_JSUPPORT::listFaqCategory($option, $rows);
}
function viewFaq($option, $uid) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

global $jfConfig, $mainframe;

		$row = new faqs($database);

		if($uid){
			$row -> load($uid[0]);

		$cookiename = 'jSupportFAQ'.$row->id;
		$hasCookie = 	JArrayHelper::getValue($_COOKIE,$cookiename,'');

		  if (!$hasCookie){
			$obj = new faqs($database);
			$obj->hit( $row->id );
			setcookie($cookiename, $row->id);
		  }

		$cookiename = 'jSupportFAQVote'.$row->id;
		$hasCookie = JArrayHelper::getValue($_COOKIE,$cookiename,'');
			if(isset($_REQUEST['helpful'])) {
				if(!$hasCookie) {
					if($_REQUEST['helpful'] =='yes')	{
						$query = "UPDATE #__jfaqs SET score = score+1 WHERE id='$row->id'";
						$database->setQuery($query);
						$database->query();
					}
					elseif($_REQUEST['helpful'] =='no') {
						$query = "UPDATE #__jfaqs SET score = score-1 WHERE id='$row->id'";
						$database->setQuery($query);
						$database->query();
					}
				$voted = setcookie($cookiename, $row->id);
				}				
			} 				
		if($hasCookie) { $voted = $hasCookie; }
		
		$row -> load($uid[0]);

		if($row->keywords != '') {
			$keywords = explode(',',$row->keywords);
			foreach ($keywords as $word) {
			  $word = trim($word);
		      $wheres2 = array();
		      $wheres2[] = "LOWER(a.keywords) LIKE '%$word%'";
		      $wheres[] = implode( ' OR ', $wheres2 );
		    }
		    $where = '(' . implode( (') OR ('), $wheres ) . ')';			

			$query = "SELECT * from #__jfaqs as a"
			  . "\n WHERE ( $where )"
			  . "\n AND a.published='1'"
  			;
			$database->setQuery($query);
			$related = $database->loadObjectList();
		}

			$query = "SELECT * FROM #__jsupportcomments WHERE faqid='$row->id' AND published=1 ORDER BY id ASC";
			$database->setQuery($query);
			$faqcomments = $database->loadObjectList();

	}

		$query = "SELECT * FROM #__jsupportcategories WHERE id='$row->category'";
		$database->setQuery($query);
		$category = $database->loadRow();

	HTML_JSUPPORT::viewFaq($option, $row, $category, $related, $faqcomments, $voted);
}

function searchFaq($option) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

global $jfConfig, $mainframe;

    $q = JRequest::getvar('keyword');

	$ordering = JRequest::getVar('ordering');
	
	$phrase = JRequest::getVar('phrase');
	
  $wheres = array();

if($q!='') { 

  switch ($phrase) {
    case 'exact':
    $wheres2 = array();
    $wheres2[] = "LOWER(a.subject) LIKE '%$q%'";
    $wheres2[] = "LOWER(a.description) LIKE '%$q%'";
    $wheres2[] = "LOWER(a.solution) LIKE '%$q%'";
    $wheres2[] = "LOWER(a.keywords) LIKE '%$q%'";
    $where = '(' . implode( ') OR (', $wheres2 ) . ')';
    break;
	
    case 'all':
    case 'any':
    default: 

    $words = explode( ' ', $q );
    $wheres = array();
    foreach ($words as $word) {
      $wheres2 = array();
      $wheres2[] = "LOWER(a.subject) LIKE '%$word%'";
      $wheres2[] = "LOWER(a.description) LIKE '%$word%'";
      $wheres2[] = "LOWER(a.solution) LIKE '%$word%'";
      $wheres2[] = "LOWER(a.keywords) LIKE '%$word%'";
      $wheres[] = implode( ' OR ', $wheres2 );
    }
    $where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
    break;
  }
}
  $morder = '';
  switch ($ordering) {
    case 'newest':
    default: 
    $order = 'a.created DESC';
  break;
    case 'oldest':
    $order = 'a.created ASC';
    break;
    case 'popular':
    $order = 'a.hits DESC';
    break;
    case 'alpha':
    $order = 'a.subject ASC';
    break;
  }

$query = "SELECT * from #__jfaqs as a"
  . "\n WHERE ( $where )"
  . "\n AND a.published='1'"
  . "\n ORDER BY $order"
  ;
  $database->setQuery($query);
  $items = $database->LoadObjectList();

  if ($phrase == 'exact') {
    $searchwords = array($q);
    $needle = $q;
  } else { 
    $searchwords = explode(' ', $q);
    $needle = $searchwords[0];
  }
  
  $count=0;
  if (count($items)){
    foreach ($items as $item){

      $item->description = jSupportController::jForcePrepareSearchContent( $item->description, 200, $needle );
      $item->solution = jSupportController::jForcePrepareSearchContent( $item->solution, 200, $needle );
      $item->keywords = jSupportController::jForcePrepareSearchContent( $item->keywords, 200, $needle );
      foreach ($searchwords as $hlword) {
        $item->description = eregi_replace( $hlword, "<span class=\"highlight\">\\0</span>", $item->description);
        $item->solution = eregi_replace( $hlword, "<span class=\"highlight\">\\0</span>", $item->solution);		
        $item->keywords = eregi_replace( $hlword, "<span class=\"highlight\">\\0</span>", $item->keywords);		
      }
      $count++;
  }
}
HTML_JSUPPORT::searchFaq($option, $items, $q, $phrase);
}

function addComment($option) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

global $jfConfig, $mainframe;

	$row = new supportcomments($database);
	$msg = 'Saved Comment';
	if($jfConfig['captcha'] == 'on') { 
		session_start();
		if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) {
      // Insert you code for processing the form here, e.g emailing the submission, entering it into a database. 
		if (!$row->bind( $_POST )) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
			$row->id = (int) $row->id;

				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				} else {
					$row->created = date ('Y-m-d H:i:s');
				}
				
			if ($row->created && strlen(trim( $row->created )) <= 10) {
				$row->created 	.= ' 00:00:00';
			}
			
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	      unset($_SESSION['security_code']);
   } else {
   $msg = "Security image did not match.";
   $id = JRequest::getVar('faqid');
   $link = "index.php?option=com_jsupport&amp;task=viewFaq&amp;cid[]=".$id;
	$mainframe->redirect($link, $msg);
   }
} else { 
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
			$row->id = (int) $row->id;

				if ($row->id) {
					$row->modified 	= date( 'Y-m-d H:i:s' );
				} else {
					$row->created = date ('Y-m-d H:i:s');
				}
			if ($row->created && strlen(trim( $row->created )) <= 10) {
				$row->created 	.= ' 00:00:00';
			}
			
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
}
	$mainframe->redirect( 'index.php?option=com_jsupport&amp;task=listFaqs', $msg );
}	
function homePage($option) {

	HTML_JACCOUNTS::homePage();
}

function sendEmail($module,$id) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

global $jfConfig, $mainframe;
	//Email Client

		$row = new tickets($database);
		$row->load($id);
		
		$sql = "SELECT name, email FROM #__users WHERE id = '$row->contactid'";
		$database->setQuery($sql);
		$name = $database->loadRow();		
		
		$module = strtoupper($module);
		$variables = array("%CLIENT_NAME%","%COMPANY_NAME%", "%TICKET_NAME%","%TICKET_PRIORITY%", "%TICKET_DESCRIPTION%");
		$values = array($name[0],$jfConfig['company_name'], $row->subject, $row->priority, $row->description);

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

function jForcePrepareSearchContent( $text, $length=200, $searchword ) {
      // strips tags won't remove the actual jscript
      $text = preg_replace( "'<script[^>]*>.*?</script>'si", "", $text );
      $text = preg_replace( '/{.+?}/', '', $text);
  
      //$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2', $text );
  
      // replace line breaking tags with whitespace
      $text = preg_replace( "'<(br[^/>]*?/|hr[^/>]*?/|/(div|h[1-6]|li|p|td))>'si", ' ', $text );
  
      $text = jSupportController::jForceSmartSubstr( strip_tags( $text ), $length, $searchword );
  
      return $text;
  }
  
  function jForceSmartSubstr($text, $length=200, $searchword) {
    $wordpos = strpos(strtolower($text), strtolower($searchword));
    $halfside = intval($wordpos - $length/2 - strlen($searchword));
    if ($wordpos && $halfside > 0) {
      return '...' . substr($text, $halfside, $length) . '...';
    } else {
      return substr( $text, 0, $length);
    }
  }
}
?>