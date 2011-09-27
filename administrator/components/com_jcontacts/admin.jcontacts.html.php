<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );// Lead Functions
class HTML_cP {/* Menu */
	
	function style() { 
	?>
		<link href="components/com_jcontacts/css/admin_style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="components/com_jcontacts/js/admin_jcontacts.js"></script>
<?php	 }
function showFilter($task) {
?>
<table width='100%' cellpadding='4' class='editView' border="0" cellspacing="0">
	<tr>
		<td class='headerQuotes' colspan="3" align="left"><?php echo _FILTER; ?></td>
    </tr>
    <tr>
		
		<?php if ($task == 'listLeads') { 
        $lists = jContactsController::getLists('');
		?>
        <td width='350px'>
			<?php echo _FILTER; ?>: <input type="text" name="filter" />&nbsp;
			<?php echo _STATUS;?>:&nbsp;<?php echo $lists['status'];?>&nbsp;
        	<input type="submit" name="<?php echo _JSUBMIT;?>" value="<?php echo _JSUBMIT;?>" class='button small' />
        	</td>
        <?php }  elseif ($task=='accountPopup') { ?>
		<td width='350px'>
			<?php echo _FILTER; ?>: <input type="text" name="filter" />&nbsp;
            <input type="submit" name="<?php echo _JSUBMIT;?>" value="<?php echo _JSUBMIT;?>" class='button small' />&nbsp;
			<?php echo _QUICK_ADD;?> <input type="text" name="quickadd" />
            <input type='submit' name="Add" value="<?php echo _ADD;?>" class="button small" />
         </td></tr><tr>
        <?php }  elseif ($task=='reportsToPopup') { ?>
		<td width='350px'>
			<?php echo _FILTER; ?>: <input type="text" name="filter" />&nbsp;
            <input type="submit" name="<?php echo _JSUBMIT;?>" value="<?php echo _JSUBMIT;?>" class='button small' />&nbsp;
         </td></tr><tr>
		<?php } else { ?> 
        <td width='220px'>
			<?php echo _FILTER; ?>: <input type="text" name="filter" />&nbsp;
            <input type="submit" name="<?php echo _JSUBMIT;?>" value="<?php echo _JSUBMIT;?>" class='button small' />
         </td>
        <?php } ?>
        
    	<td align="left">
        <input type='hidden' name='alpha' />
        <a href="javascript:alphaFilter('A')" class='alpha'>A</a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('B')" class='alpha'>B </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('C')" class='alpha'>C </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('D')" class='alpha'>D </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('E')" class='alpha'>E </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('F')" class='alpha'>F </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('G')" class='alpha'>G </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('H')" class='alpha'>H </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('I')" class='alpha'>I </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('J')" class='alpha'>J</a> &nbsp;|&nbsp;
        <a href="javascript:alphaFilter('K')" class='alpha'>K </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('L')" class='alpha'>L </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('M')" class='alpha'>M </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('N')" class='alpha'>N </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('O')" class='alpha'>O </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('P')" class='alpha'>P </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('Q')" class='alpha'>Q </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('R')" class='alpha'>R </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('S')" class='alpha'>S </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('T')" class='alpha'>T </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('U')" class='alpha'>U </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('V')" class='alpha'>V </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('W')" class='alpha'>W</a> &nbsp;|&nbsp;
        <a href="javascript:alphaFilter('X')" class='alpha'>X </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('Y')" class='alpha'>Y </a>&nbsp;|&nbsp;
        <a href="javascript:alphaFilter('Z')" class='alpha'>Z</a>&nbsp;&nbsp;&nbsp;
        <a href="javascript:alphaFilter('')" class='alpha'><?php echo _SHOW_ALL;?></a>
        </td>
	</tr>
</table>
<br />
<?php
}	function startMenu( $task ) {		HTML_cP::style();
	?>
	<table cellpadding="3" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left" valign="top" width="160" height="0">
			<table cellpadding="4" cellspacing="0" border="0" width="160" height="100%" align="left" class="moduleTable">
				<tr>
				  <td colspan='2' class='tableListHeader'><?php echo _MENU; ?></td>
				</tr>
				<tr><td><img src="components/com_jcontacts/images/home.jpg" /></td><td><a class="menu<?php echo ($task=="") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts"><?php echo _HOME_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jcontacts/images/lead_small.jpg" /></td><td><a class="menu<?php echo ($task=="listLeads") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts&task=listLeads"><?php echo _VIEW_LEADS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jcontacts/images/contact_small.jpg" /></td><td><a class="menu<?php echo ($task=="listContacts") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts&task=listContacts"><?php echo _VIEW_CONTACTS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jcontacts/images/accounts_small.jpg" /></td><td><a class="menu<?php echo ($task=="listAccounts") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts&task=listAccounts"><?php echo _VIEW_ACCOUNTS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jcontacts/images/lead_small_add.jpg" /></td><td><a class="menu<?php echo ($task=="newLead") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts&task=newLead"><?php echo _NEW_LEAD_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jcontacts/images/contact_small_add.jpg" /></td><td><a class="menu<?php echo ($task=="newContact") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts&task=newContact"><?php echo _NEW_CONTACT_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jcontacts/images/accounts_small_add.jpg" /></td><td><a class="menu<?php echo ($task=="newAccount") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts&task=newAccount"><?php echo _NEW_ACCOUNT_MENU_LINK; ?></a></td></tr>				<tr><td colspan='2' class='tableListHeader'><?php echo _CONFIGURATION_MENU; ?></td></tr>
                <tr><td><img src="components/com_jcontacts/images/config.jpg" /></td><td><a class="menu<?php echo ($task=="Configuration") ? "_selected": ""; ?>" href="index2.php?option=com_jcontacts&task=config"><?php echo _CONFIG_MENU_LINK; ?></a></td></tr>
                <tr><td><img src="components/com_jcontacts/images/about.jpg" /></td><td><a class="menu<?php echo ($task=="About") ? "_selected" : ""; ?>" href="index2.php?option=com_jcontacts&task=About"><?php echo _ABOUT_MENU_LINK; ?></a></td></tr>
                <tr><td><img src="components/com_jcontacts/images/page_white_get.png" /></td><td><a class="menu<?php echo ($task=="importWizard") ? "_selected" : ""; ?>" href="index2.php?option=com_jcontacts&task=importWizard"><?php echo _IMPORT_MENU_LINK; ?></a></td></tr>
                <tr><td><img src="components/com_jcontacts/images/page_white_put.png" /></td><td><a class="menu<?php echo ($task=="exportWizard") ? "_selected" : ""; ?>" href="index2.php?option=com_jcontacts&task=exportWizard"><?php echo _EXPORT_MENU_LINK; ?></a></td></tr>
                
			</table>
		</td>
		<td valign="top" align="left">
		<?php 
	}	function endMenu() {	?>
		</td>
		</tr>
	</table>
    <div id="copy"><?php echo _POWERED_BY;?> <a href="http://www.igenxsolutions.com">Igenx Solutions</a></div>
	<?php
	}
/* Menu End */
function controlPanel($option) {
	$database = & JFactory::getDBO();  
	$path = JPATH_COMPONENT.DS."/jcontacts.cpanel.php";
   if (file_exists( $path )) {
          require $path;
      } else {
          echo 'Control Panel file not found.';
      }
 }  
 function About($option) {
	global $database, $mosConfig_absolute_path;
   $path = JPATH_COMPONENT.DS."/jcontacts.about.php";
   if (file_exists( $path )) {
          require $path;
      } else {
        HTML_cP::controlPanel($option);
      }
}
/*Configuration */   
function showConfig( &$jfConfig, &$lists, $option ) {
   	global $mosConfig_live_site;
?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class='tableList'>
		<tr class='tableListHeader' >
			<td align="left"><?php echo _CONFIGURATION_MANAGER;?></td>
		</tr>
	</table>
<br />
<form action="index2.php" method="post" name="adminForm">
<div id="content-pane" class="pane-sliders"><div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _GENERAL;?></span></h3>
	<div class="jpane-slider content">
	 <table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME;?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTING;?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION ?></th>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _COMPANY_NAME;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_company_name" value="<?php echo htmlspecialchars(stripslashes($jfConfig['company_name'])); ?>" size='40'/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_COMPANY_NAME;?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _COMPANY_ADDRESS;?></td>
         <td align="left" valign="top"><textarea name="cfg_company_address" cols='28' rows='4'><?php echo htmlspecialchars(stripslashes($jfConfig['company_address'])); ?></textarea></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_COMPANY_ADDRESS;?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _COMPANY_EMAIL;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_company_email" value="<?php echo htmlspecialchars(stripslashes($jfConfig['company_email'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_COMPANY_EMAIL;?><br /></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _ENABLE_ACCESS_RESTRICTIONS;?></td>
         <td align="left" valign="top"><?php echo $lists['access_restrictions']; ?></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_ACCESS_RESTRICTIONS;?></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _ENABLE_MOOTOOLS;?></td>
         <td align="left" valign="top"><?php echo $lists['mootools']; ?></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_MOOTOOLS;?></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _GOOGLE_API;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_google_api" value="<?php echo $jfConfig['google_api']; ?>" size="40" /></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_GOOGLE_API;?></td>
      </tr>
    <tr>
        <td align="left" valign="top"><?php echo _LEAD_STATUS_OPTIONS;?></td>
        <td align="left" valign="top"><textarea name="cfg_leadStatus" cols='28' rows='4'><?php echo htmlspecialchars(stripslashes($jfConfig['leadStatus'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _LEAD_STATUS_DESCRIPTION;?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_LEAD_REDIRECT_LINK;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_newLeadRedirect" value="<?php echo htmlspecialchars(stripslashes($jfConfig['newLeadRedirect'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_NEW_LEAD_REDIRECT_LINK;?><br /></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_LEAD_MESSAGE;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_newLeadMsg" value="<?php echo htmlspecialchars(stripslashes($jfConfig['newLeadMsg'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_NEW_LEAD_MESSAGE;?><br /></td>
      </tr>
	<tr>
	   	<td align="left" valign="top"><?php echo _REGISTRATION_MESSAGE;?></td>
        <td align="left" valign="top"><textarea name="cfg_reg_message" cols='28' rows='4'><?php echo htmlspecialchars(stripslashes($jfConfig['reg_message'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _REGISTRATION_MESSAGE_DESCRIPTION;?></td>
    </tr>
    </tr>
       <tr>
         <td align="left" valign="top"><?php echo _REGISTRATION_REDIRECT_LINK;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_reg_redirect" value="<?php echo htmlspecialchars(stripslashes($jfConfig['reg_redirect'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_REGISTRATION_REDIRECT_LINK;?><br /></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _POST_REGISTRATION_MESSAGE;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_post_reg_message" value="<?php echo htmlspecialchars(stripslashes($jfConfig['post_reg_message'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_POST_REGISTRATION_MESSAGE;?><br /></td>
      </tr>
   </table><br />
</div>
</div><div class="panel">
	<h3 class="jpane-toggler title"><span><?php echo _JEMAILS;?></span></h3>
	<div class="jpane-slider content">
	<table cellpadding="4" cellspacing="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME;?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTING;?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION ?></th>
      </tr>
 	<tr>
 		<td colspan="5"><strong><?php echo _REQUIRED;?></strong><hr /></td>
	</tr>
      <tr>
         <td align="left" valign="top"><?php echo _AUTOMATED_EMAIL;?></td>
         <td align="left" valign="top"><?php echo $lists['auto_email']; ?></td>
         <td align="left" valign="top"><?php echo _AUTOMATED_EMAIL_DESCRIPTION;?></td>
    </tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_LEAD_EMAIL_SUBJECT;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_lead_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_lead_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_LEAD_EMAIL_SUBJECT_DESCRIPTION;?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><?php echo _NEW_LEAD_EMAIL;?></td>
        <td align="left" valign="top"><textarea name="cfg_new_lead_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_lead_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_LEAD_EMAIL_DESCRIPTION;?></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _DETAIL_REQUEST_EMAIL_SUBJECT;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_contact_update_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['contact_update_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _DETAIL_REQUEST_EMAIL_SUBJECT_DESCRIPTION;?></td>
    </tr>
	<tr>
	   	<td align="left" valign="top"><?php echo _DETAIL_REQUEST_EMAIL;?></td>
        <td align="left" valign="top"><textarea name="cfg_contact_update_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['contact_update_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _DETAIL_REQUEST_EMAIL_DESCRIPTION;?></td>
    </tr>
    <tr><td colspan='3'></td></tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_JOOMLA_USER_EMAIL_SUBJECT;?></td>
         <td align="left" valign="top"><input type="text" name="cfg_joomla_user_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['joomla_user_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_JOOMLA_USER_EMAIL_SUBJECT_DESCRIPTION;?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><?php echo _NEW_JOOMLA_USER_EMAIL;?></td>
        <td align="left" valign="top"><textarea name="cfg_joomla_user_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['joomla_user_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_JOOMLA_USER_EMAIL_DESCRIPTION;?></td>
      </tr>
     
</table>
</div>
</div></div>
   <input type="hidden" name="task" value="" />
   <input type="hidden" name="option" value="<?php echo $option; ?>" />
   <input type="hidden" name="cfg_version" value="<?php echo $jfConfig['version']; ?>" />
   </form>
<?php   }
/* configuration */
}
class HTML_leads {
	function viewLead($option, $row, &$manager) { ?>
<script type="text/javascript">
<!--
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton=='listLeads') {
		submitform(pressbutton);
		return;
	} else if (pressbutton=='convertLead') {
		 if (form.company_name.value== "") {
		 	alert("<?php echo _VALIDATE_COMPANY_CONVERT;?>");
		 } else {
			submitform( pressbutton );
		}
	} else if (pressbutton=='editLead') {
		submitform(pressbutton);
		return;
	}
}
-->
</script>
    <form action="index2.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
        <input type="hidden" name="company_name" value="<?php echo $row->company_name; ?>" />
        <input type="hidden" name='row' value='<?php echo base64_encode(serialize($row));?>' />
        <input type="hidden" name='view' value='1' />
	</form>
<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _LEAD_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _FIRST_NAME;?></td><td><?php echo $row->first_name; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _LAST_NAME;?></td><td><?php echo $row->last_name; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _COMPANY;?></td><td><?php echo $row->company_name; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _PHONE;?></td><td><?php echo $row->phone; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _JEMAIL;?></td><td><a href="mailto:<?php echo $row->email;?>"><?php echo $row->email; ?></a>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MANAGER;?></td><td><?php echo $manager ? $manager[1]." [".$manager[2]."]" : "&nbsp"; ?></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _STATUS;?></td><td><?php echo $row->status; ?>&nbsp;</td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _DESCRIPTION_INFORMATION;?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MESSAGE; ?></td><td><?php echo $row->message; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _INTERNAL_NOTES; ?></td><td><?php echo $row->notes; ?>&nbsp;</td>
		</tr>
</table>
<?php }
function editLead($option, $row, &$lists) {
	JRequest::setVar( 'hidemainmenu', 1 );
	$editor =& JFactory::getEditor();
?>
<script type="text/javascript">
<!--
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton=='listLeads') {
		submitform(pressbutton);
		return;
	} else if (pressbutton=='convertLead') {
		 if (form.company_name.value== "") {
		 	alert("<?php echo _VALIDATE_COMPANY_CONVERT;?>");
		 }
	}	// do field validation
	if (form.last_name.value == ""){
		alert( "<?php echo _VALIDATE_LAST_NAME;?>" );
	} else {
		submitform( pressbutton );
	}
}
-->
</script>
<form action="index2.php" method="post" name="adminForm">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _LEAD_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _FIRST_NAME;?></td>
            <td class='fieldValue'><input type="text" name="first_name" value="<?php echo $row->first_name; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class="<?php echo $row->last_name ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>"
             id='last_name_label'><?php echo _LAST_NAME;?></td>
            <td class='fieldValue'><input type="text" name="last_name" id="last_name" value="<?php echo $row->last_name; ?>" size="40" onChange="checkElement('last_name');"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _COMPANY;?></td>
            <td class='fieldValue'><input type="text" name="company_name" id="company_name" value="<?php echo $row->company_name; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _PHONE;?></td>
            <td class='fieldValue'><input type="text" name="phone" value="<?php echo $row->phone; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _JEMAIL;?></td>
            <td class='fieldValue'><input type="text" name="email" value="<?php echo $row->email; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MANAGER;?></td>
            <td class='fieldValue'><?php echo $lists['managers']; ?></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _STATUS;?></td>
            <td class='fieldValue'><?php echo $lists['status']; ?></td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _DESCRIPTION_INFORMATION;?></td>
        </tr>
        <tr>
            <td colspan="4">
            <?php echo _MESSAGE; ?>
            <br /><?php echo $editor->display( 'message', $row->message, '50%', '350', '55', '20' ) ; ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
            <?php echo _INTERNAL_NOTES; ?>
            <br /><?php
            // parameters : areaname, content, hidden field, width, height, rows, cols
            echo $editor->display( 'notes', $row->notes, '50%', '350', '55', '20' ) ; ?>
            </td>
        </tr>
	</table>
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="published" value="1" />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<? 
}
function listLeads ($option, &$rows, &$pageNav) {
?>
<script type="text/javascript">
<!--
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton=='deleteLead') {
		if (confirm("<?php echo _CONFIRM_DELETE_LEAD;?>")==false) {
			return;
		} else {
			submitform(pressbutton);
		}
	} else {
		submitform( pressbutton );
	}
}
-->
</script>
<form action="index2.php" method="post" name="adminForm">
<?php HTML_cP::showFilter('listLeads'); ?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable" style="text-align:left;">
<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width="50"><?php echo _JID; ?></th>
<th class="title" width=""><?php echo _LEAD_NAME; ?></th>
<th class="title" width="175"><?php echo _COMPANY; ?></th>
<th class='title' width="100"><?php echo _PHONE; ?></th>
<th class="title" width="150"><?php echo _JEMAIL; ?></th>
<th class="title" width="150"><?php echo _MANAGER; ?></th>
<th class="title" width="100"><?php echo _STATUS; ?></th>
</tr>
</thead>
<tbody>
<?php
if ($rows) {
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
$name = ($row->last_name && $row->first_name) ? $row->last_name.", ".$row->first_name : $row->last_name;
?>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?>&nbsp;</td>
<td><a href="#edit" onClick="return listItemTask('cb<?php echo $i;?>','viewLead')"><?php echo $name; ?></a>&nbsp;</td>
<td><?php echo $row->company_name; ?>&nbsp;</td>
<td><?php echo $row->phone; ?>&nbsp;</td>
<td><a href="mailto:<?php echo $row->email; ?>" ><?php echo $row->email; ?></a>&nbsp;</td>
<td><?php echo $row->jname ? $row->jname." [".$row->username."]" : "&nbsp;" ?></td>
<td><?php echo $row->status; ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
} else {
?>
<tr class="row1">
	<td colspan="8" align="center"><strong><?php echo _NO_LEADS_AVAILABLE;?></strong>&nbsp;&nbsp;<a href="index2.php?option=com_jcontacts&task=newLead"><?php echo _CREATE_ONE_NOW; ?></a></td>
</tr>
<?php } ?>
</tbody>
<tfoot>
   <tr>
		<td colspan='8'><?php echo $pageNav->getListFooter(); ?></td>
	</tr>
</tfoot>
</table>
<input type="hidden" name="option" value="com_jcontacts" />
<input type="hidden" name="task" value="listLeads" />
<input type="hidden" name="boxchecked" value="0" />
</form> 
<?
}
}
// Account Functions
class HTML_accounts {
function viewAccount($option, $row, &$manager, &$contacts) { ?>
    <form action="index2.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
	</form>
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _ACCOUNT_INFO; ?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _ACCOUNT_NAME; ?></td><td width="300px"><?php echo $row->name; ?>&nbsp;</td>
            <td width="150px" class='fieldName'><?php echo _RATING; ?></td><td><?php echo $row->rating; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _ACCOUNT_SITE; ?></td><td width="300px"><?php echo $row->site; ?>&nbsp;</td>
            <td width="150px" class='fieldName'><?php echo _PHONE; ?></td><td><?php echo $row->phone; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _PARENT_ACCOUNT;?></td><td width="300px"><?php echo ($row->parent_account_id == 0) ? '' : $row->parent_account_id; ?>&nbsp;</td>
            <td width="150px" class='fieldName'><?php echo _FAX; ?></td><td><?php echo $row->fax; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _TYPE;?></td><td width="300px"><?php echo $row->type; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _INDUSTRY;?></td><td><?php echo $row->industry; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _ANNUAL_REVENUE;?></td><td width="300px"><?php echo $row->annual_revenue; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _SIC_CODE;?></td><td><?php echo $row->sic_code; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MANAGER; ?></td><td width="300px"><?php if ($manager!='') echo $manager[1]." [".$manager[2]."]"; ?>&nbsp;</td>
			<td width="150px" class='fieldName'>&nbsp;</td><td>&nbsp;</td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _ADDRESS_INFO; ?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_STREET; ?></td><td width="300px"><?php echo $row->billing_street; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_STREET; ?></td><td><?php echo $row->shipping_street; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_CITY; ?></td><td width="300px"><?php echo $row->billing_city; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_CITY; ?></td><td><?php echo $row->shipping_city; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_STATE; ?></td><td width="300px"><?php echo $row->billing_state; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_STATE; ?></td><td><?php echo $row->shipping_state; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_ZIP; ?></td><td width="300px"><?php echo $row->billing_zip; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_ZIP; ?></td><td><?php echo $row->shipping_zip; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_COUNTRY; ?></td><td width="300px"><?php echo $row->billing_country; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_COUNTRY; ?></td><td><?php echo $row->shipping_country; ?>&nbsp;</td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _DESCRIPTION_INFORMATION; ?></td>
        </tr>
        <tr>
            <td width="150px" class='fieldName'><?php echo _INTERNAL_NOTES; ?></td><td colspan="3"><?php echo $row->notes; ?>&nbsp;</td>
        </tr>
	</table>
    <br />
    <?php if ($contacts) { ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList' align="left">
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _ASSOCIATED_CONTACTS; ?></td>
        </tr>
        <tr>
        	<th width='50' align="center"><?php echo _JID; ?></th>
            <th class="title" width="250"><?php echo _JNAME; ?></th>
            <th class='title' width="150"><?php echo _PHONE; ?></th>
            <th class="title" width="250"><?php echo _JEMAIL; ?></th>
        </tr>
			<?php
			$k = 0;
			foreach($contacts as $c) { 
			?>
			<tr class='row<?php echo $k; ?>'>
				<td align="center"><?php echo $c->id; ?></td>
                <td align="left"><a href="index2.php?option=com_jcontacts&task=viewContact&cid[]=<?php echo $c->id; ?>"><?php echo $c->last_name; ?>, <?php echo $c->first_name;?></a></td>
                <td><?php echo $c->phone; ?></td>
                <td><a href="mailto:<?php echo $c->email;?>"><?php echo $c->email; ?></a></td>
          	</tr>
           <?php 
		   $k = 1 - $k;
		   } 
		   ?>
    </table>
 
<?php }
}function editAccount($option, $row, &$lists) {
	JRequest::setVar( 'hidemainmenu', 1 );
	$editor =& JFactory::getEditor();
	?>
<script type="text/javascript">
<!--
function submitbutton(pressbutton) {
	
	var form = document.adminForm;	if (pressbutton == 'listAccounts') {
		submitform(pressbutton);
		return;
	}	// do field validation
	if (form.name.value == ""){
		alert("<?php echo _VALIDATE_ACCOUNT;?>");
	} else {
		submitform(pressbutton);
	}
	
}
-->
</script>
<form action="index2.php" method="post" name="adminForm">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _ACCOUNT_INFO; ?></td>
        </tr>
        <tr>
			<td width="150px" class="<?php echo $row->name ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>"
             id='name_label'><?php echo _ACCOUNT_NAME; ?></td>
            <td width="300px" class='fieldValue'><input type="text" name="name" id="name" value="<?php echo $row->name; ?>" size="40" onChange="checkElement('name');"></td>
            <td width="150px" class='fieldName'><?php echo _RATING; ?></td>
            <td class='fieldValue'><input type="text" name="rating" value="<?php echo $row->rating; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _ACCOUNT_SITE; ?></td>
            <td width="300px" class='fieldValue'><input type="text" name="site" value="<?php echo $row->site; ?>" size="40"></td>
            <td width="150px" class='fieldName'><?php echo _PHONE; ?></td>
            <td class='fieldValue'><input type="text" name="phone" value="<?php echo $row->phone; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _PARENT_ACCOUNT;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="parent_account_id" value="<?php echo $row->parent_account_id; ?>" size="40"></td>
            <td width="150px" class='fieldName'><?php echo _FAX; ?></td>
            <td class='fieldValue'><input type="text" name="fax" value="<?php echo $row->fax; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _TYPE;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="type" value="<?php echo $row->type; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _INDUSTRY;?></td>
            <td class='fieldValue'><input type="text" name="industry" value="<?php echo $row->industry; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _ANNUAL_REVENUE;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="annual_revenue" value="<?php echo $row->annual_revenue; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _SIC_CODE;?></td>
            <td class='fieldValue'><input type="text" name="sic_code" value="<?php echo $row->sic_code; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MANAGER; ?></td>
            <td width="300px" class='fieldValue'><?php echo $lists['managers']; ?></td>
			<td width="150px" class='fieldName'>&nbsp;</td>
            <td class='fieldValue'>&nbsp;</td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="3"><?php echo _ADDRESS_INFO; ?></td>
            <td class='headerQuotes' align="left" onClick="MailtoOther('billing')" style="cursor:pointer;"><?php echo _COPY_BILLING_ADDRESS; ?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_STREET; ?></td>
            <td width="300px" class='fieldValue'><textarea name="billing_street" id="mstreet" cols="28"><?php echo $row->billing_street; ?></textarea></td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_STREET; ?></td>
            <td class='fieldValue'><textarea name="shipping_street" id="ostreet" cols="28"><?php echo $row->shipping_street; ?></textarea></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_CITY; ?></td>
            <td width="300px" class='fieldValue'><input type="text" name="billing_city" id="mcity" value="<?php echo $row->billing_city; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_CITY; ?></td>
            <td class='fieldValue'><input type="text" name="shipping_city" id="ocity" value="<?php echo $row->shipping_city; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_STATE; ?></td>
            <td width="300px" class='fieldValue'><?php echo $lists['billing_state']; ?></td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_STATE; ?></td>
            <td class='fieldValue'><?php echo $lists['shipping_state']; ?></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_ZIP; ?></td>
            <td width="300px" class='fieldValue'><input type="text" name="billing_zip" id="mzip" value="<?php echo $row->billing_zip; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_ZIP; ?></td>
            <td class='fieldValue'><input type="text" name="shipping_zip" id="ozip" value="<?php echo $row->shipping_zip; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BILLING_COUNTRY; ?></td>
            <td width="300px" class='fieldValue'><?php echo $lists['billing_country']; ?></td>
			<td width="150px" class='fieldName'><?php echo _SHIPPING_COUNTRY; ?></td>
            <td class='fieldValue'><?php echo $lists['shipping_country']; ?></td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _DESCRIPTION_INFORMATION; ?></td>
        </tr>
        <tr>
            <td colspan="4">
            <?php echo _INTERNAL_NOTES; ?>
            <br /><?php
            // parameters : areaname, content, hidden field, width, height, rows, cols
			echo $editor->display( 'notes', $row->notes, '50%', '350', '55', '20' ) ;?>
            </td>
        </tr>
	</table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="published" value="1" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<?php
}
function listAccounts ($option, &$rows, &$pageNav) { ?>
<script type="text/javascript">
<!--
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton=='deleteAccount') {
		if (confirm("<?php echo _CONFIRM_DELETE_ACCOUNT;?>")==false) {
			return;
		} else {
			submitform(pressbutton);
		}
	} else {
		submitform( pressbutton );
	}
}
-->
</script>
<form action="index2.php" method="post" name="adminForm">
<?php HTML_cP::showFilter('listAccounts'); ?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable" style="text-align:left;">
<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width="50"><?php echo _JID; ?></td>
<th class="title"><?php echo _ACCOUNT_NAME; ?></th>
<th class="title" width="150"><?php echo _PHONE; ?></th>
<th class="title" width="150"><?php echo _FAX; ?></th>
<th class="title" width="175"><?php echo _WEBSITE; ?></th>
<th class="title" width="150"><?php echo _MANAGER; ?></th>
</tr>
</thead>
<tbody>
<?php
if ($rows) {
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
?>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?>&nbsp;</td>
<td><a href="#edit" onClick="return listItemTask('cb<?php echo $i;?>','viewAccount')"><?php echo $row->name; ?></a>&nbsp;</td>
<td><?php echo $row->phone;?>&nbsp;</td>
<td><?php echo $row->fax;?>&nbsp;</td>
<td><a href="http://<?php echo $row->website; ?>"><?php echo $row->website; ?></a>&nbsp;</td>
<td><?php echo $row->jname ? $row->jname." [".$row->username."]" : "&nbsp;" ?></td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
} else {
?>
<tr class="row1">
	<td colspan="6" align="center"><strong>No Accounts Available.</strong>&nbsp;&nbsp;<a href="index2.php?option=com_jcontacts&task=newAccount">[Create one now]</a></td>
</tr>
<?php } ?>
</tbody>
<tfoot>
   <tr>
		<td colspan='8'><?php echo $pageNav->getListFooter(); ?></td>
	</tr>
</tfoot>
</table>
<input type="hidden" name="returntask" value="listAccounts" />
<input type="hidden" name="option" value="com_jcontacts" />
<input type="hidden" name="task" value="listAccounts" />
<input type="hidden" name="boxchecked" value="0" />
</form> 
<?
}
}
class HTML_contacts {
function accountPopup($rows, $pageNav) { 
HTML_cP::style();
?>

<form action="index.php?option=com_jcontacts&amp;task=accountPopup&amp;tmpl=component" method="post" name='adminForm' >
<?php HTML_cP::showFilter('accountPopup'); ?>
<br />
<body bgcolor="white">
<table cellpadding="4" cellspacing="0" width="100%" class="moduleTable">
<thead>
  <tr>
    <td class="tableListHeader"><?php echo _ACCOUNT;?></td>
    <td class="tableListHeader"><?php echo _PHONE;?></td>
    <td class="tableListHeader"><?php echo _WEBSITE;?></td>
  </tr>
 </thead>
 <tbody>
  <?php 

	if ($rows) {
	$i = 0;
		foreach ($rows as $row) {
		echo "<tr class='row".$i."'><td width='35%'><a href='#' onClick=\"javascript:window.parent.displayAccountResults('".$row->id."','".$row->name."')\">".$row->name."</a></td><td>".$row->phone."</td><td>".$row->website."</td></tr>";
		$i = 1 - $i;
		}
	} else {?>
  <tr class='row1'>
    <td colspan="3" align="center"><?php echo _NO_ACCOUNTS_AVAILABLE; ?></td>
  </tr>
  <?php } ?>
</tbody>
<tfoot>
   <tr>
		<td colspan='8'><?php echo $pageNav->getPagesLinks(); ?></td>
	</tr>
</tfoot>
<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
</form>	
<?php
}
function reportsToPopup($rows, $pageNav) { 
HTML_cP::style();
?>
<form action="index.php?option=com_jcontacts&amp;task=reportsToPopup&amp;tmpl=component" method="post" name='adminForm' >
<?php HTML_cP::showFilter('reportsToPopup'); ?>
<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
</form>
<br />

<table cellpadding="4" cellspacing="0" width="100%" class="moduleTable">
	<thead>
	<tr>
    	<td class="tableListHeader"><?php echo _CONTACT;?></td><td class="tableListHeader"><?php echo _ACCOUNT;?></td><td class="tableListHeader"><?php echo _JEMAIL;?></td>
    </tr>
	</thead>
	<tbody>
	<?php 
	if ($rows) {
	$i = 0;
	foreach ($rows as $row) {
	$name = ($row->first_name) ? $row->last_name.", ".$row->first_name : $row->last_name;
	echo "<tr class='row".$i."'><td width='35%'><a href='#' onClick=\"javascript:window.parent.displayReportsToResults('".$row->id."','".$row->last_name.", ".$row->first_name."')\">".$name."</a></td><td>".$row->account."</td><td>".$row->email."</td></tr>";
	$i = 1 - $i;
	}
	} else {?>
    <tr class='row1'>
    	<td colspan="3" align="center"><?php echo _NO_CONTACTS_AVAILABLE;?></td>
    </tr>
    <?php } ?>
</tbody>
<tfoot>
   <tr>
		<td colspan='8'><?php echo $pageNav->getPagesLinks(); ?></td>
	</tr>
</tfoot>
</table>

<?php
}
function listContacts ($option, &$rows, &$pageNav) { ?>
<script type="text/javascript">
<!--
function submitbutton(pressbutton) {
	var form = document.adminForm;
	if (pressbutton=='deleteContact') {
		if (confirm("Are you sure you want to delete this contact?")==false) {
			return;
		} else {
			submitform(pressbutton);
		}
	} else {
		submitform( pressbutton );
	}
}
-->
</script>
<form action="index2.php" method="post" name="adminForm">
<?php HTML_cP::showFilter('listContacts'); ?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable" style="text-align:left;">
<thead>
<tr class='tableListHeader'>
    <th width="20"><input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" /></th>
    <th  width="50"><?php echo _JID;?></th>
    <th class="title"><?php echo _CONTACT_NAME_LABEL; ?></th>
    <th class="title" width="175"><?php echo _COMPANY; ?></th>
    <th class='title' width="150"><?php echo _PHONE; ?></th>
    <th class="title" width="150"><?php echo _JEMAIL; ?></th>
    <th class="title" width="150"><?php echo _MANAGER; ?></th>
</tr>
</thead>
<?php
if ($rows) {
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
$name = ($row->last_name && $row->first_name) ? $row->last_name.", ".$row->first_name : $row->last_name;
?>
<tbody>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?>&nbsp;</td>
<td><a href="#edit" onClick="return listItemTask('cb<?php echo $i;?>','viewContact')"><?php echo $name; ?></a></td>
<td><?php echo $row->name; ?>&nbsp</td>
<td><?php echo $row->phone; ?>&nbsp</td>
<td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a>&nbsp</td>
<td><?php if ($row->jname) {echo $row->jname." [".$row->username."]";} ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
} else {
?>
<tr class="row1">
	<td colspan="7" align="center"><strong><?php echo _NO_CONTACTS_AVAILABLE; ?></strong>&nbsp;&nbsp;<a href="index2.php?option=com_jcontacts&task=newContact"><?php echo _CREATE_ONE_NOW; ?></a></td>
</tr>
<?php } ?>
</tbody>
<tfoot>
   <tr>
		<td colspan='7'><?php echo $pageNav->getListFooter(); ?></td>
	</tr>
</tfoot>
</table>
<input type="hidden" name="option" value="com_jcontacts" />
<input type="hidden" name="task" value="listContacts" />
<input type="hidden" name="boxchecked" value="0" />
</form> 
<?
}
function viewContact($option, $row, &$jrow, &$account, &$reports_to, &$manager) {
global $jfConfig;
$date = ($row->birthday) ? date('m/d/Y', strtotime($row->birthdate)) : '';
$google_api = '';
if($jfConfig['google_api'] != '') { 
$google_api = $jfConfig['google_api'];
?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $google_api ?>" type="text/javascript"></script>
<script type="text/javascript">
function show(a,b)
{
	gbox.gmapShow({
		mapDivId   : 'gmap',
		lat : a,
		lng : b,
		zoom : '8'
	},
	{
		close : function(){ gbox.close(); }
	});
}
window.addEvent('domready', function()
{
	gbox = new Lightbox({
	  overlayOpacity : 0.95,
		duration : 0
	});
});
</script>
<?php } ?>
    <form action="index2.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name="view" value="1" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
	</form>
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _CONTACT_INFORMATION;?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _FIRST_NAME;?></td><td width="300px"><?php echo $row->first_name; ?>&nbsp;</td>
            <td width="150px" class='fieldName'><?php echo _PHONE; ?></td><td><?php echo $row->phone; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _LAST_NAME;?></td><td width="300px"><?php echo $row->last_name; ?>&nbsp;</td>
            <td width="150px" class='fieldName'><?php echo _HOME_PHONE;?></td><td><?php echo $row->home_phone; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _ACCOUNT;?></td><td width="300px"><?php echo $account[1]; ?>&nbsp;</td>
            <td width="150px" class='fieldName'><?php echo _MOBILE_PHONE;?></td><td><?php echo $row->mobile_phone; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _TITLE;?></td><td width="300px"><?php echo $row->title; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _OTHER_PHONE;?></td><td><?php echo $row->other_phone; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _DEPARTMENT;?></td><td width="300px"><?php echo $row->department; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _FAX;?></td><td><?php echo $row->fax; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BIRTHDATE;?></td><td width="300px"><?php echo $date; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _JEMAIL;?></td><td><?php echo $row->email; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _REPORTS_TO;?></td><td width="300px"><?php if ($reports_to!='') {echo $reports_to[1].", ".$reports_to[2];} ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _ASSISTANT;?></td><td><?php echo $row->assistant; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _LEAD_SOURCE;?></td><td width="300px"><?php echo $row->lead_source; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _ASSISTANT_PHONE;?></td><td><?php echo $row->asst_phone; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _EMAIL_OPT_OUT;?></td><td width="300px"><input type="checkbox" disabled="disabled" name="email_opt_out" value="1" <?php if ($row->email_opt_out==1) {echo 'checked="checked"';}?>></td>
            <td width="150px" class='fieldName'><?php echo _MANAGER;?></td><td><?php if ($manager!='') { echo $manager[1]." [".$manager[2]."]"; } ?>&nbsp;</td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _ADDRESS_INFO;?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_STREET;?></td><td width="300px"><?php echo $row->mailing_street; ?>&nbsp;
			<?php if($google_api && $row->lat && $row->lng) { ?>
            &nbsp;&nbsp;&nbsp;<a href='#' onClick="show('<?php echo $row->lat; ?>','<?php echo $row->lng; ?>')"><img src='components/com_jcontacts/images/map_icon.png' border='0' valign='middle' vspace='0'>&nbsp;Map It!</a>
			<?php } ?></td>
			<td width="150px" class='fieldName'><?php echo _OTHER_STREET;?></td><td><?php echo $row->other_street; ?>&nbsp;
			<?php if($google_api && $row->other_lat && $row->other_lng) { ?>
            &nbsp;&nbsp;&nbsp;<a href='#' onClick="show('<?php echo $row->other_lat; ?>','<?php echo $row->other_lng; ?>')"><img src='components/com_jcontacts/images/map_icon.png' border='0' valign='middle' vspace='0'>&nbsp;Map It!</a>
			<?php } ?></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_CITY;?></td><td width="300px"><?php echo $row->mailing_city; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _OTHER_CITY;?></td><td><?php echo $row->other_city; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_STATE;?></td><td width="300px"><?php echo $row->mailing_state; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _OTHER_STATE;?></td><td><?php echo $row->other_state; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_ZIP;?></td><td width="300px"><?php echo $row->mailing_zip; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _OTHER_ZIP;?></td><td><?php echo $row->other_zip; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_COUNTRY;?></td><td width="300px"><?php echo $row->mailing_country; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _OTHER_COUNTRY;?></td><td><?php echo $row->other_country; ?>&nbsp;</td>
		</tr>
        <?php if ($row->jid) {  ?>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _JOOMLA_INFORMATION;?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _JUSERNAME;?></td><td width="300px"><?php echo $jrow->username; ?>&nbsp;</td>
            <td width="150px" class='fieldName'>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _NEW_PASSWORD;?></td><td width="300px">*********</td>
            <td width="150px" class='fieldName'>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _VERIFY_PASSWORD;?></td><td width="300px">*********</td>
            <td width="150px" class='fieldName'>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <?php } ?>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _DESCRIPTION_INFORMATION;?></td>
        </tr>
        <tr>
            <td width="150px" class='fieldName'><?php echo _INTERNAL_NOTES;?></td><td colspan="3"><?php echo $row->notes; ?></td>
        </tr>
	</table>
	<?php }
function editContact($option, &$row, &$account, &$reports_to, &$jrow, &$converted, &$lists) {
	JRequest::setVar( 'hidemainmenu', 1 );
	$editor =& JFactory::getEditor();
	$birthday = explode("-",$row->birthdate);
	JHTML::_('behavior.modal', 'a.modal');
	$link = 'index.php?option=com_jcontacts&amp;task=accountPopup&amp;tmpl=component';
	$link2 = 'index.php?option=com_jcontacts&amp;task=reportsToPopup&amp;tmpl=component';
	$doc 		=& JFactory::getDocument();
	$js = "
	function displayAccountResults(id,name) {
      document.adminForm.getElementById('account_id').value = id;
	  document.adminForm.getElementById('account').value = name;
	  document.adminForm.getElementById('account_id_label').className = 'fieldNameRequiredActive';
      document.getElementById('sbox-window').close();
	}
	function displayReportsToResults(id,name) {
      document.adminForm.getElementById('reports_to').value = id;
	  document.adminForm.getElementById('report').value = name;
      document.getElementById('sbox-window').close();
	}"
	;
	$doc->addScriptDeclaration($js);
	?>
<script type="text/javascript">

function submitbutton(pressbutton) {
	var form = document.adminForm;
	var filter=/^.+@.+\..{2,3}$/;
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");
	if ((pressbutton=='listContacts') || (pressbutton=='requestUpdate')) {
		submitform(pressbutton);
		return;
	}
	
	if (form.last_name.value == "") {
		alert("<?php echo _VALIDATE_LAST_NAME;?>");
		return;
	} else if (form.account_id.value == ""){
		alert( "<?php echo _VALIDATE_ACCOUNT;?>" );
		return;
	} else if (form.username.value == "") {
		alert("<?php echo _VALIDATE_USERNAME;?>");
		return;
	} else if (r.exec(form.username.value) || form.username.value.length < 3) {
		alert("<?php echo _VALIDATE_USERNAME_LENGTH;?>");
		return;
	} else if (filter.test(form.email.value)==false || form.email.value == "") {
		alert("<?php echo _VALIDATE_EMAIL;?>");
		return;
	} else if ((form.password.value != "") && (form.password.value != form.verifyPass.value)){
		alert( "<?php echo _VALIDATE_PASSWORD_MATCH;?>" );
		return;
	} else if (r.exec(form.password.value)) {
		alert( "<?php echo _VALIDATE_PASSWORD_LENGTH;?>" );
		return;
	} else {
		submitform(pressbutton);
	}
	  
	

}
</script>
<form action="index2.php" method="post" name="adminForm">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _CONTACT_INFORMATION;?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _FIRST_NAME;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="first_name" value="<?php echo $row->first_name; ?>" size="40"></td>
            <td width="150px" class='fieldName'><?php echo _PHONE; ?></td>
            <td class='fieldValue'><input type="text" name="phone" value="<?php echo $row->phone; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class="<?php echo $row->last_name ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>"
             id="last_name_label"><?php echo _LAST_NAME;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="last_name" id="last_name" value="<?php echo $row->last_name; ?>" size="40" onChange="checkElement('last_name');"></td>
            <td width="150px" class='fieldName'><?php echo _HOME_PHONE;?></td>
            <td class='fieldValue'><input type="text" name="home_phone" value="<?php echo $row->home_phone; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class="<?php echo $row->account_id ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>"
             id="account_id_label"><?php echo _ACCOUNT;?></td>
            <td width="300px" class='fieldValue'><input type="hidden" name="account_id" value="<?php echo $row->account_id; ?>" id="account_id" onChange="checkElement('account_id');">
            <input type="text" name="account" id="account" readonly="readonly" value="<?php echo $account[1];?>" /><a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jcontacts/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a></td>
            <td width="150px" class='fieldName'><?php echo _MOBILE_PHONE;?></td>
            <td class='fieldValue'><input type="text" name="mobile_phone" value="<?php echo $row->mobile_phone; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _TITLE;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="title" value="<?php echo $row->title; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _OTHER_PHONE;?></td>
            <td class='fieldValue'><input type="text" name="other_phone" value="<?php echo $row->other_phone; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _DEPARTMENT;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="department" value="<?php echo $row->department; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _FAX;?></td>
            <td class='fieldValue'><input type="text" name="fax" value="<?php echo $row->fax; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _BIRTHDATE;?></td>
            <td width="300px" class='fieldValue'>
            <input type="text" name="bday_month" size="2" maxlength="2" value="<?php echo $birthday[1]; ?>"/>&nbsp;/&nbsp;
            <input type="text" name="bday_day" size="2" maxlength="2" value="<?php echo $birthday[2]; ?>"/>&nbsp;/&nbsp;
            <input type="text" name="bday_year" size="4" maxlength="4" value="<?php echo $birthday[0]; ?>"/>&nbsp;(mm/dd/yyyy)
            </td>
			<td width="150px" class="<?php echo $row->email ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id="email_label"><?php echo _JEMAIL;?></td>
            <td class='fieldValue'><input type="text" name="email" id="email" value="<?php echo $row->email; ?>" size="40" onChange="checkEmailField();"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _REPORTS_TO;?></td>
            <td width="300px" class='fieldValue'><input type="hidden" name="reports_to" value="<?php echo $row->reports_to; ?>" id="reports_to">
            <input type="text" name="report" id="report" readonly="readonly" value="<?php echo $reports_to ? $reports_to[1].', '.$reports_to[2] : "&nbsp;";?>" /><a class="modal" href="<?php echo $link2; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jcontacts/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a></td>
			<td width="150px" class='fieldName'><?php echo _ASSISTANT;?></td>
            <td class='fieldValue'><input type="text" name="assistant" value="<?php echo $row->assistant; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _LEAD_SOURCE;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="lead_source" value="<?php echo $row->lead_source; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _ASSISTANT_PHONE;?></td>
            <td class='fieldValue'><input type="text" name="asst_phone" value="<?php echo $row->asst_phone; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _EMAIL_OPT_OUT;?></td>
            <td width="300px" class='fieldValue'><input type="checkbox" name="email_opt_out" value="1" <?php if ($row->email_opt_out==1) {echo 'checked="checked"';}?>></td>
            <td width="150px" class='fieldName'><?php echo _MANAGER;?></td><td><?php echo $lists['managers'];?></td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="3"><?php echo _ADDRESS_INFO;?></td>
            <td class='headerQuotes' align="left" onClick="MailtoOther('shipping')" style="cursor:pointer;"><?php echo _COPY_MAILING_ADDRESS;?></a></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_STREET;?></td>
            <td width="300px" class='fieldValue'><textarea name="mailing_street" id="mstreet" cols="28"><?php echo $row->mailing_street; ?></textarea></td>
			<td width="150px" class='fieldName'><?php echo _OTHER_STREET;?></td>
            <td class='fieldValue'><textarea name="other_street" id="ostreet" cols="28"><?php echo $row->other_street; ?></textarea></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_CITY;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="mailing_city" id="mcity" value="<?php echo $row->mailing_city; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _OTHER_CITY;?></td>
            <td class='fieldValue'><input type="text" name="other_city" id="ocity" value="<?php echo $row->other_city; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_STATE;?></td>
            <td width="300px" class='fieldValue'><?php echo $lists['mailing_state']; ?></td>
			<td width="150px" class='fieldName'><?php echo _OTHER_STATE;?></td>
            <td class='fieldValue'><?php echo $lists['other_state']; ?></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_ZIP;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="mailing_zip" id="mzip" value="<?php echo $row->mailing_zip; ?>" size="40"></td>
			<td width="150px" class='fieldName'><?php echo _OTHER_ZIP;?></td>
            <td class='fieldValue'><input type="text" name="other_zip" id="ozip" value="<?php echo $row->other_zip; ?>" size="40"></td>
		</tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _MAILING_COUNTRY;?></td>
            <td width="300px" class='fieldValue'><?php echo $lists['mailing_country']; ?></td>
			<td width="150px" class='fieldName'><?php echo _OTHER_COUNTRY;?></td>
            <td class='fieldValue'><?php echo $lists['other_country']; ?></td>
		</tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _JOOMLA_INFORMATION;?></td>
        </tr>
        <tr>
			<td width="150px" class="<?php echo $jrow->username ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>"
             id='username_label'><?php echo _JUSERNAME;?></td>
            <td width="300px"><input type="text" name="username" id="username" value="<?php echo $jrow->username; ?>"  size="40" onChange="checkElement('username');"></td>
            <td width="150px" class='fieldName'>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _NEW_PASSWORD;?></td>
            <td width="300px"><input type="password" name="password" id="password" value="" size="40" 
			></td>
            <td width="150px" class='fieldName'>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _VERIFY_PASSWORD;?></td>
            <td width="300px"><input type="password" name="verifyPass" id="verifyPass" value="" size="40"></td>
            <td width="150px" class='fieldName'>&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _DESCRIPTION_INFORMATION;?></td>
        </tr>
        <tr>
            <td colspan="4">
            <?php echo _INTERNAL_NOTES;?>
            <br /><?php
			echo $editor->display( 'notes', $row->notes, '50%', '350', '55', '20' ) ; ?>
            </td>
        </tr>
	</table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="jid" value="<?php echo $row->jid; ?>" />
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type='hidden' name='published' value='1'  />
<input type="hidden" name="converted" value="<?php echo $converted; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> <? }}
?>