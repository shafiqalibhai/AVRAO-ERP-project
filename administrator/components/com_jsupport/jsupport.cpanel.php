<?php
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	global $jfConfig;

if($jfConfig['access_restrictions']=='on' && $user->get('gid') != 25) {
	$auth = "( $user->get('id')=j.manager AND converted !='1')";
} else {
	$auth = "converted !='1'";
}

//Tickets query
	$database->setQuery("SELECT j.id, subject, contactid, modified,"
	."\n published, u.username, m.username as owner FROM #__jtickets as j"
	."\n LEFT JOIN #__users as u on j.contactid = u.id LEFT JOIN #__users as m on j.manager = m.id WHERE $auth"
	."\n ORDER BY j.created ASC LIMIT 5");
	$latesttickets = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}

//FAQ Query	
	$database->setQuery("SELECT #__jfaqs.id, subject, modified FROM #__jfaqs"
	."\n ORDER BY #__jfaqs.created ASC LIMIT 5");
	$latestfaqs = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
//Comments Query
	$database->setQuery("SELECT id, comment, modified, faqid, ticketid FROM #__jsupportcomments"
	."\n ORDER BY created ASC LIMIT 5");
	$latestcomments = $database-> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}	
		$database->setQuery( "SELECT count(*) FROM #__jsupportcomments" );
		$total = $database->loadResult();
		echo $database->getErrorMsg();

		$database->setQuery( "SELECT count(*) FROM #__jsupportcategories" );
		$totalC = $database->loadResult();
		echo $database->getErrorMsg();

		$database->setQuery( "SELECT count(*) FROM #__jfaqs" );
		$totalF = $database->loadResult();
		echo $database->getErrorMsg();

		$database->setQuery( "SELECT count(*) FROM #__jtickets WHERE converted !='1'" );
		$totalT = $database->loadResult();
		echo $database->getErrorMsg();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width='50%'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
    <th class='headerQuotes'><?php echo $jfConfig['access_restrictions']=='on' && $user->get('gid') != 25 ? "My " : "" ?><?php echo _LATEST_TICKETS; ?></th>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
        	<tr><th width='50' align="center"><?php echo _JID; ?></th>
            <th align="left"><?php echo _JNAME; ?></th>
            <th align='center' width='75'><?php echo _CLIENT; ?></th>
        	<th width="75" align="center"><?php echo _CREATED; ?></th>
        	</tr>
			<?php
			$k = 0;
			foreach($latesttickets as $t) { 
			?>
			<tr class='row<?php echo $k; ?>'>
				<td align="center"><?php echo $t->id; ?></td>
                <td align="left"><a href="index2.php?option=com_jsupport&task=viewTicket&cid[]=<?php echo $t->id; ?>"><?php echo $t->subject; ?></a></td>
                <td align='center'><?php echo $t->username; ?></td>
                <td align="center"><?php echo JHTML::_('date',  $t->modified, JText::_('DATE_FORMAT_LC4') ); ?></td>
          	</tr>
           <?php 
		   $k = 1 - $k;
		   } 
		   		   if(!$latesttickets) {  
		   ?>
           <tr class='row1'>
           		<td colspan='4' align="center"><?php echo _NO_TICKETS_AVAILABLE; ?></td>
           </tr>
           <?php } ?>
        </table>    </td>
  </tr>
           <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jsupport&task=listTickets' class='button'><?php echo _VIEW_ALL; ?></a></td>
         	</tr>
</table></td>
    <td valign="top" width="">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class='headerInvoices'><?php echo _LATEST_FAQS; ?></th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr>
              <th width="50" align="center"><?php echo _JID; ?></th>
              <th align="left"><?php echo _JNAME; ?></th>
              <th width="75" align="center"><?php echo _CREATED; ?></th>
            </tr>
            <?php
			$k = 0;
			foreach($latestfaqs as $f) { 
			?>
            <tr class='row<?php echo $k; ?>'>
              <td align="center"><?php echo $f->id; ?></td>
              <td align="left"><a href="index2.php?option=com_jsupport&task=viewFaq&cid[]=<?php echo $f->id; ?>"><?php echo $f->subject; ?></a></td>
              <td align="center"><?php echo JHTML::_('date',  $f->modified, JText::_('DATE_FORMAT_LC4') ); ?></td>
            </tr>
            <?php 
		   $k = 1 - $k;
		   } 
   		   if(!$latestfaqs) {  
		   ?>
           <tr class='row1'>
           		<td colspan='3' align="center"><?php echo _NO_FAQS_AVAILABLE; ?></td>
           </tr>
           <?php } ?>

        </table></td>
      </tr>
                 <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jsupport&task=listFaqs' class='button'><?php echo _VIEW_ALL; ?></a></td>
         	</tr>      
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class='headerQuotes'><?php echo $jfConfig['access_restrictions']=='on' && $user->get('gid') != 25 ? "My " : "" ?><?php echo _LATEST_COMMENTS; ?></th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr>
              <th width='50' align="center"><?php echo _JID; ?></th>
              <th align="left"><?php echo _JNAME; ?></th>
              <th align='center' width='150'><?php echo _COMMENT_TYPE; ?></th>
              <th width="75" align="center"><?php echo _DATE; ?></th>
            </tr>
            <?php
			$k = 0;
			foreach($latestcomments as $c) { 
			?>
            <tr class='row<?php echo $k; ?>'>
              <td align="center"><?php echo $c->id; ?></td>
              <td align="left"><a href="index2.php?option=com_jsupport&amp;task=viewTicket&amp;cid[]=<?php echo $t->id; ?>"><?php echo substr($c->comment,0,300); ?></a></td>
              <td align='center'><?php echo $c->faqid ? _FAQ : _TICKET ?></td>
              <td align="center"><?php echo JHTML::_('date',  $c->modified, JText::_('DATE_FORMAT_LC4') ); ?></td>
            </tr>
            <?php 
		   $k = 1 - $k;
		   } 
		   		   if(!$latestcomments) {  
		   ?>
            <tr class='row1'>
              <td colspan='4' align="center"><?php echo _NO_COMMENTS_AVAILABLE; ?></td>
            </tr>
            <?php } ?>
        </table></td>
      </tr>
      <tr>
        <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jsupport&amp;task=listTickets' class='button'><?php echo _VIEW_ALL; ?></a></td>
      </tr>
    </table></td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class='headerQuotes'><?php echo $jfConfig['access_restrictions']=='on' && $user->get('gid') != 25 ? "My " : "" ?><?php echo _SPECS; ?></th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr>
              <th align="left"><?php echo _TYPE; ?></th>
              <th align='center' width='75'><?php echo _DETAILS; ?></th>
            </tr>
            <tr class='row0'>
              <td align="left"><?php echo _NUMBER_OF_TICKETS; ?></td>
              <td align='center'><?php echo $totalT; ?></td>
            </tr>
            <tr class='row1'>
              <td align="left"><?php echo _NUMBER_OF_FAQS; ?></td>
              <td align='center'><?php echo $totalF; ?></td>
            </tr>
            <tr class='row0'>
              <td align="left"><?php echo _NUMBER_OF_CATEGORIES; ?></td>
              <td align='center'><?php echo $totalC; ?></td>
            </tr>
            <tr class='row1'>
              <td align="left"><?php echo _NUMBER_OF_COMMENTS; ?></td>
              <td align='center'><?php echo $total; ?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

