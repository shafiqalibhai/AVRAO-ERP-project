<?php
/*** Taskhopper 1.1 is released under the GNU General Public License** 
Please report any violations to abuse@taskhopper.com* 
For more info* http://www.gnu.org/licenses/gpl-violation.html* 
@package Taskhopper 1.1* @copyright (C) 2006 APIN.COM and IBCNet* 
@url http://www.taskhopper.com/*
@author Task Master <office@ibcnet.biz>**/ 

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if ($mosConfig_lang=='') {
	$mosConfig_lang='english';
}
include_once("".$mosConfig_absolute_path."/components/com_thopper/language/$mosConfig_lang.php");

$content="";
global $mosConfig_lifetime,$mosConfig_live_site,$option;

$isAdmin = false;
if(($my->usertype=='Super Administrator') || ($my->usertype=='Administrator')){
  $isAdmin = true;
  echo _YOU_ARE_ADMIN;
}
else {$isAdmin = false;
}

$my_search_options = _getTHCookie( "thsearch" );
$extra_sql="";
if ( isset($my_search_options)) {
	
    $search_data = explode( "|", $my_search_options );
    $my_id = $search_data[0];
    $str = $search_data[1];
    $typ = $search_data[2];
    $urg = $search_data[3];
    $usr = $search_data[4];
    $prj = $search_data[5];
    $sts = $search_data[6];
  
		  if($prj) {
		   	$extra_sql .= "and t.project_id=$prj ";
		  }
		  if($usr){
		  	$extra_sql .= "and t.customer_id=$usr ";
		  }
		  if($sts){
		  	if ( $sts == "open" ) {
	    		$extra_sql.= "AND status_id < '100'";
		   	}elseif ( is_numeric( $sts ) ) {
	    		$extra_sql .= "AND status_id = '$sts'";
		  	}
		  }
		  if($urg){
		  	$extra_sql .= "and t.urgency_id=$urg ";
		  }
		  if($typ){
		  	$extra_sql .= "and t.item_type_id=$typ ";
		  }
		  if($str){
		  	$extra_sql .= "AND (summary LIKE '%$str%' OR detailed_desc LIKE '%$str%')";
		  }
  }

if ( !isset( $my->id ) || $my->id == 0 ) {
  $content .= "<ul>\n";
    $path = sefRelToAbs("index.php?option=com_thopper&task=new_item");    
    $content .= "<li><a href=\"$path\">"._ADD_NEW."</a></li>";
}else{
    if($isAdmin){
	  $query1 = "SELECT count(item_id) as my_tickets FROM #__th_item t
			   WHERE customer_id='".$my->id."' and t.status_id<'100' $extra_sql and t.project_id!='0'";
	}
    else{
	$query1 = "SELECT count(item_id) as my_tickets FROM #__th_item t,#__th_project_options pp
			   WHERE customer_id='".$my->id."' and t.status_id<'100' $extra_sql
			   and pp.project_id = t.project_id and pp.view='1' and pp.user_id='".$my->id."'";
	}
	
	$database->setQuery($query1);
	$my_ticket_array = $database->loadResult();

    if($isAdmin){
      $query2 = "SELECT count(t.item_id) FROM #__th_item t,#__th_project mp
		WHERE t.status_id<'100' and t.project_id=mp.project_id  $extra_sql";
      }else{
	$query2 = "SELECT count(t.item_id) FROM #__th_item t,
	#__th_project mp, #__th_project_options po
	WHERE t.project_id=mp.project_id 
	and t.project_id=po.project_id 
	and po.user_id='$my->id' and po.view='1' and
	t.status_id<'100' $extra_sql";
	}

	$database->setQuery($query2);
	$all_ticket_array = $database->loadResult();

    if($isAdmin){
      $query3 = "SELECT count(item_id) FROM #__th_item t
	WHERE item_creator_id = '".$my->id."' and status_id<'100' and t.project_id!='0'  $extra_sql";
    }else{
	$query3 = "SELECT count(item_id) FROM #__th_item t,#__th_project_options pp
	WHERE item_creator_id = '".$my->id."' and status_id<'100' and pp.project_id = t.project_id and 
	pp.view='1' and pp.user_id='".$my->id."' $extra_sql";
	}
	$database->setQuery($query3);
	$all_own_array = $database->loadResult();

    $today_date = date("Y-m-d");
    
	if($isAdmin){
	  $query4 = "SELECT count(t.item_id)
				FROM #__th_item t
				WHERE status_id < '100' and t.project_id!='0'
				AND updated = '$today_date' $extra_sql";
	  }else{
	$query4 = "SELECT count(t.item_id)
				FROM #__th_item t, #__th_project mp, #__th_project_options po
				WHERE t.project_id=mp.project_id 
				and t.project_id=po.project_id 
				and po.user_id='$my->id' and po.view='1'and status_id < '100'
				AND updated = '$today_date' $extra_sql";
		}
		
	$database->setQuery($query4);
	$updated_today = $database->loadResult();
	
	if($isAdmin){
		
	  $query_closed = "SELECT count(t.item_id)
				FROM #__th_item t
				WHERE status_id = '101'
				AND FROM_UNIXTIME(date_closed,'%Y-%m-%d') = '$today_date' and t.project_id!='0' $extra_sql";
	  }else{
	  $query_closed = "SELECT count(t.item_id)
				FROM #__th_item t, #__th_project mp, #__th_project_options po
				WHERE t.project_id=mp.project_id 
				and t.project_id=po.project_id 
				and po.user_id='$my->id' and po.view='1'and status_id = '101'
				AND FROM_UNIXTIME(date_closed,'%Y-%m-%d') = '$today_date' $extra_sql";
		}
//echo $query_closed;
	$database->setQuery($query_closed);
	$closed_today = $database->loadResult();
	
	if($isAdmin){
	  $query5 = "SELECT count(tl.task_id)
			   FROM #__th_time_log tl,#__th_item t
			   WHERE tl.task_id=t.item_id and status_id < '100' 
               and tl.status='1' and t.project_id!='0' $extra_sql";
	  }else{
	$query5 = "SELECT count(tl.task_id)
			   FROM #__th_time_log tl,#__th_item t, #__th_project_options po
			   WHERE tl.task_id=t.item_id and t.project_id = po.project_id
               and po.user_id='$my->id' and po.view='1'and status_id < '100' 
               and tl.status='1' $extra_sql";
    }
              // echo $query5;
	$database->setQuery($query5);
	$open_timers = $database->loadResult();

	
	if($isAdmin){
	  $query6 = "SELECT count(t.item_id)
			  FROM #__th_item t
              WHERE t.customer_id='0' and status_id < '100' and t.project_id !='0' $extra_sql";
	  }else{
	$query6 = "SELECT count(t.item_id)
			  FROM #__th_item t, #__th_project_options po
              WHERE t.customer_id='0' and status_id < '100' and t.project_id = po.project_id
              and po.user_id='$my->id' and po.view='1' $extra_sql";
    }

	$database->setQuery($query6);
	$unassigned = $database->loadResult();

	//done menu items
	if($isAdmin){
      $query3 = "SELECT count(item_id) FROM #__th_item t
	WHERE status_id='99' and t.project_id!='0' $extra_sql";

    }else{
	$query3 = "SELECT count(t.item_id) FROM #__th_item t,
		#__th_project mp, #__th_project_options po
		WHERE t.project_id=mp.project_id 
		and t.project_id=po.project_id 
		and po.user_id='$my->id' and po.view='1' and
		t.status_id='99' $extra_sql";
	}
	$database->setQuery($query3);
	$done_array = $database->loadResult();

	//unread items
	if($isAdmin){
		$query7 = "SELECT count(t.item_id)
	FROM #__th_item t where t.item_id not in 
	(select item_id from #__th_user_read ur where ur.item_id=t.item_id and ur.user_id='$my->id') 
	and t.status_id<'100' $extra_sql";
	}else{
	$query7 = "SELECT count(t.item_id)
	FROM #__th_project_options pp,#__th_item t where t.item_id not in 
	(select item_id from #__th_user_read ur where ur.item_id=t.item_id and ur.user_id='$my->id') 
	and pp.project_id = t.project_id and pp.view='1' and pp.user_id='".$my->id."' and t.status_id<'100' $extra_sql";
	}
	//echo $query7;
	$database->setQuery($query7);
	$unread_by_me = $database->loadResult();
	
    $content .= "<ul>\n";
    $path=sefRelToAbs('index.php?option=com_thopper&task=new_item');
    $content .= "<li><a href='".$path."'>"._ADD_NEW."</a></li>";
if($all_ticket_array >0){
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&opn=all')."\">"._ALL_OPEN."</a>(<strong>".$all_ticket_array."</strong>)</li>";
 }
if($my_ticket_array > 0){
	$content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&active=asg&asg='.$my->id)."\">"._ASSIGNED_TO_ME."</a>(<strong>".$my_ticket_array."</strong>)</li>";
 }
if($all_own_array>0){
	$content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&active=own&own='.$my->id)."\">"._OWNED_BY_ME."</a>(<strong>".$all_own_array."</strong>)</li>";
 }
if($updated_today>0){
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&upd='.$today_date)."\">"._CHANGED_TODAY."</a>(<strong>".$updated_today."</strong>)</li>";
  }

if($closed_today>0){
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&cls='.$today_date)."\">"._CLOSED_TODAY."</a>(<strong>".$closed_today."</strong>)</li>";
  }  

 if($done_array>0){
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&sts=99')."\">"._DONE."</a>(<strong>".$done_array."</strong>)</li>";
  }
   
if($open_timers >0){
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&ot='.$my->id)."\">"._TIMERS_OPEN."</a>(<strong>".$open_timers."</strong>)</li>";
  }

if($unread_by_me>0){
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&ur='.$my->id)."\">"._UNREAD_BY_ME."</a>(<strong>".$unread_by_me."</strong>)</li>";
  }  
  
if($unassigned>0){
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&ua='.$my->id)."\">"._UNASSIGNED."</a>(<strong>".$unassigned."</strong>)</li>";
  }
   
    $content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&task=report')."\">"._MY_TIMELOG."</a></li>";
  
    $queryX = "SELECT count(u.id) as contact_name FROM #__th_company c LEFT JOIN #__users u ON (c.contact_id=u.id and u.id='$my->id') ";  
    $database->setQuery($queryX);
	$company_user = $database->loadResult();
	if($company_user>0)
    	$content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&task=company_report')."\">"._COMPANY_REPORT."</a></li>";
    
    	$content .= "<li><a href=\"".sefRelToAbs('index.php?option=com_thopper&task=options')."\">"._OPTIONS."</a></li>";
    	$content .= "</ul>\n";


	if ($content == "") {

		echo _NOT_FOUND_ITEMS."\n";

	}
}

function _getTHCookie( $key )
    {
        global $HTTP_COOKIE_VARS;
        global $_COOKIE;

        if ( isset( $HTTP_COOKIE_VARS ) )
            $_COOKIE = $HTTP_COOKIE_VARS;

        if ( isset( $HTTP_COOKIE_VARS[$key] ) && !isset( $_COOKIE[$key] ) ) {
            return $HTTP_COOKIE_VARS[$key];
        } else if ( isset( $_COOKIE[$key] ) && !isset( $HTTP_COOKIE_VARS[$key] ) ) {
            return $_COOKIE[$key];
        } else if ( isset( $_COOKIE[$key] ) && isset( $HTTP_COOKIE_VARS[$key] ) ) {
            return $_COOKIE[$key];
        }
        return false;
    }
?>

