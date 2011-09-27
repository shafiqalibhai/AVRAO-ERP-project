<?php
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
$database = & JFactory::getDBO();
global $jfConfig, $my;
	
include_once(JPATH_COMPONENT.DS."/jcontacts.config.php" );
if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
	$c_auth = "AND ( c.manager_id=$my->id)";
	$a_auth = "AND ( a.manager_id=$my->id)";
	$l_auth = "AND ( l.manager_id=$my->id)";
}//Accounts query
	$database->setQuery("SELECT a.id, a.name, a.created"
	."\n FROM #__jaccounts as a"
	."\n WHERE published > 0"
	."\n $a_auth"
	."\n ORDER BY created ASC LIMIT 5");
	$latestaccounts = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}//Contacts Query	
	$database->setQuery("SELECT c.id, c.first_name, c.last_name, a.name, c.created"
	."\n FROM #__jcontacts as c"
	."\n LEFT OUTER JOIN #__jaccounts as a"
	."\n ON c.account_id = a.id"
	."\n WHERE c.published > 0"
	."\n $c_auth"
	."\n ORDER BY c.created ASC LIMIT 5");
	$latestcontacts = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}//Leads Query
	$database->setQuery("SELECT l.id, l.first_name, l.last_name, l.created"
	."\n FROM #__jleads as l"
	."\n WHERE published > 0"
	."\n AND converted = '0'"
	."\n $l_auth"
	."\n ORDER BY created ASC LIMIT 5");
	$latestleads = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
    <td class='cpanelHeader'><?php echo _LATEST_CONTACTS; ?></td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
        	<tr><th width='50' align="center"><?php echo _JID; ?></th>
            <th align="left"><?php echo _JNAME; ?></th>
        	<th width="150" align="center"><?php echo _CREATED; ?></th>
        	</tr>
			<?php
			if ($latestcontacts) {
			$k = 0;
			foreach($latestcontacts as $c) { 
			$date = 	JHTML::_('date', $c->created, '%x' );
			$name = ($c->last_name && $c->first_name) ? $c->last_name.", ".$c->first_name : $c->last_name;
			?>
			<tr class='row<?php echo $k; ?>'>
				<td align="center"><?php echo $c->id; ?></td>
                <td align="left"><a href="index2.php?option=com_jcontacts&task=viewContact&cid[]=<?php echo $c->id;?>"><?php echo $name;?></a></td>
                <td align="center"><?php echo $date; ?></td>
          	</tr>
           <?php 
		   $k = 1 - $k;
		   }
		   } else { ?>
           	<tr class='row1'>
            	<td colspan="3" align="center"><?php echo _NO_CONTACTS_AVAILABLE; ?></td>
            </tr> 
		   <?php } ?>
        </table>    </td>
  </tr>
           <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jcontacts&task=listContacts' class='button'><?php echo _VIEW_ALL_BUTTON; ?></a></td>
         	</tr>
</table></td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class='cpanelHeader'><?php echo _LATEST_ACCOUNTS; ?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr><th width='50' align="center"><?php echo _JID; ?></th>
            <th align="left"><?php echo _JNAME; ?></th>
        	<th width="150" align="center"><?php echo _CREATED; ?></th>
        	</tr>
            <?php
			if ($latestaccounts) {
			$k = 0;
			foreach($latestaccounts as $la) { 
			$date = 	JHTML::_('date', $la->created, '%x' );
			?>
            <tr class='row<?php echo $k; ?>'>
              <td align="center"><?php echo $la->id; ?></td>
              <td align="left"><a href="index2.php?option=com_jcontacts&task=viewAccount&cid[]=<?php echo $la->id;?>"><?php echo $la->name; ?></a></td>
              <td align="center"><?php echo $date; ?></td>
            </tr>
            <?php 
		   $k = 1 - $k;
		   } 
			} else { ?>
           	<tr class='row1'>
            	<td colspan="3" align="center"><?php echo _NO_ACCOUNTS_AVAILABLE; ?></td>
            </tr> 
		   <?php } ?>
		   
        </table></td>
      </tr>
                 <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jcontacts&task=listAccounts' class='button'><?php echo _VIEW_ALL_BUTTON; ?></a></td>
         	</tr>      
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class='cpanelHeader'><?php echo _LATEST_LEADS; ?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr><th width='50' align="center"><?php echo _JID; ?></th>
            <th align="left"><?php echo _JNAME; ?></th>
        	<th width="150" align="center"><?php echo _CREATED; ?></th>
        	</tr>
            <?php
			if ($latestleads) {
			$k = 0;
			foreach($latestleads as $l) { 
			$date = 	JHTML::_('date', $l->created, '%x' );
			$name = ($l->last_name && $l->first_name) ? $l->last_name.", ".$l->first_name : $l->last_name;			?>
            <tr class='row<?php echo $k; ?>'>
              <td align="center"><?php echo $l->id; ?></td>
              <td align="left"><a href="index2.php?option=com_jcontacts&task=viewLead&cid[]=<?php echo $l->id; ?>"><?php echo $name;?></a></td>
              <td align="center"><?php echo $date; ?></td>
            </tr>
            <?php 
		   $k = 1 - $k;
		   } 
		   } else { ?>
           	<tr class='row1'>
            	<td colspan="3" align="center"><?php echo _NO_LEADS_AVAILABLE; ?></td>
            </tr> 
		   <?php } ?>
        </table></td>
      </tr>
                <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jcontacts&task=listLeads' class='button'><?php echo _VIEW_ALL_BUTTON; ?></a></td>
         	</tr>
    </table></td>
  </tr>
</table>