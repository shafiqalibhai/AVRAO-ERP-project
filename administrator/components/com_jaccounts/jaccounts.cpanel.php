<?php
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );
	$database = & JFactory::getDBO();
	global $jfConfig, $auth, $connection;
	

//Invoices query
	if ($connection['jContacts']) {
		
		$invoicesquery = "SELECT j.id, subject, contactid, invoicestatus, total, validtill, j.gid, j.mid, g.groupname,"
		."\n j.published, u.username, CONCAT(c.first_name,' ', c.last_name) as name, m.username as owner, m.name as ownername FROM #__jinvoices as j"
		."\n LEFT OUTER JOIN #__jcontacts AS c on j.contactid = c.id"
		."\n LEFT OUTER JOIN #__users AS u on c.jid = u.id"
		."\n LEFT OUTER JOIN #__users AS m on j.mid = m.id"
		."\n LEFT OUTER JOIN #__jaccessgroups as g on j.gid = g.id"
		."\n $auth"
		."\n ORDER BY j.created ASC"
		."\n LIMIT 10"
		;
		
		$quotesquery = "SELECT j.id, subject, j.published, total, validtill, viewed, j.gid, j.mid, g.groupname, contactid,"
		."\n j.quotestage, u.username, CONCAT(c.first_name,' ',c.last_name) as name, m.username as owner, m.name as ownername"
		."\n FROM #__jquotes as j"
		."\n LEFT OUTER JOIN #__jcontacts as c on j.contactid = c.id"
		."\n LEFT OUTER JOIN #__users as u on c.jid = u.id"
		."\n LEFT OUTER JOIN #__users AS m on j.mid = m.id"
		."\n LEFT OUTER JOIN #__jaccessgroups as g on j.gid = g.id"
		."\n $auth"
		."\n ORDER BY j.created ASC"
		."\n LIMIT 10"
		;
		
		
	} else {
		$invoicesquery = "SELECT j.id, j.subject, j.contactid, j.invoicestatus, j.validtill,"
		."\n j.published, u.username FROM #__jinvoices as j"
		."\n LEFT JOIN #__users as u on j.contactid = u.id"
		."\n $auth"
		."\n ORDER BY j.created ASC LIMIT 10"
		;
	
		$quotesquery = "SELECT j.id, contactid, subject, published, quotestage, validtill,"
		."\n #__users.username FROM #__jquotes as j"
		."\n LEFT JOIN #__users on j.contactid = #__users.id"
		."\n $auth"
		."\n ORDER BY j.created ASC LIMIT 10"
		;
	
	}
	

	$database->setQuery($invoicesquery);
	$latestinvoices = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}

//Quotes Query	
	$database->setQuery($quotesquery);
	$latestquotes = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
    <th class='headerQuotes'><?php echo $jfConfig['access_restrictions']==1 && $my->gid != 25 ? _MY." " : "" ?><?php echo _LATEST_QUOTES; ?></th>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
        	<tr><th width='50' align="center"><?php echo _JID; ?></th>
            <th align="left"><?php echo _JNAME; ?></th>
            <th width='100' align='center'><?php echo _CLIENT; ?></th>
        	<th width="100" align="center"><?php echo _VALID_TILL; ?></th>
        	</tr>
			<?php
			$k = 0;
			foreach($latestquotes as $q) { 
			?>
			<tr class='row<?php echo $k; ?>'>
				<td align="center"><?php echo $q->id; ?></td>
                <td align="left"><a href="index2.php?option=com_jaccounts&task=viewQuote&cid[]=<?php echo $q->id; ?>"><?php echo $q->subject; ?></a></td>
               <td align='center'><?php echo $q->username; ?></td>
                <td align="center"><?php echo JHTML::_('date',  $row->validtill, JText::_('DATE_FORMAT_LC4') ); ?></td>
          	</tr>
           <?php 
		   $k = 1 - $k;
		   }
		   if(!$latestquotes) {  
		   ?>
           <tr class='row1'>
           		<td colspan='4' align="center"><?php echo _NO_QUOTES_AVAILABLE; ?></td>
           </tr>
           <?php } ?>
        </table>    </td>
  </tr>
           <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jaccounts&task=listQuotes' class='button'><?php echo _VIEW_ALL; ?></a></td>
         	</tr>
</table></td>
    <td valign="top" width="">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class='headerInvoices'><?php echo $jfConfig['access_restrictions']==1 && $my->gid != 25 ? _MY." " : "" ?><?php echo _LATEST_INVOICES; ?></th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr>
              <th width="50" align="center"><?php echo _JID; ?></th>
              <th align="left"><?php echo _JNAME; ?></th>
              <th width='100' align='center'><?php echo _CLIENT; ?></th>
              <th width="100" align="center"><?php echo _VALID_TILL; ?></th>
            </tr>
            <?php
			$k = 0;
			foreach($latestinvoices as $li) { 
			?>
            <tr class='row<?php echo $k; ?>'>
              <td align="center"><?php echo $li->id; ?></td>
              <td align="left"><a href="index2.php?option=com_jaccounts&task=viewInvoice&cid[]=<?php echo $li->id; ?>"><?php echo $li->subject; ?></a></td>
              <td align='center'><?php echo $li->username; ?></td>
              <td align="center"><?php echo JHTML::_('date',  $row->validtill, JText::_('DATE_FORMAT_LC4') ); ?></td>
            </tr>
            <?php 
		   $k = 1 - $k;
		   } 
		   if(!$latestinvoices) {  
		   ?>
           <tr class='row1'>
           		<td colspan='4' align="center"><?php echo _NO_INVOICES_AVAILABLE; ?></td>
           </tr>
           <?php } ?>

        </table></td>
      </tr>
                 <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jaccounts&task=listInvoices' class='button'><?php echo _VIEW_ALL; ?></a></td>
         	</tr>      
    </table></td>
  </tr>
</table>

