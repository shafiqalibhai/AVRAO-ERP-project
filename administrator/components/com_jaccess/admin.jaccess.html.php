<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_cP {
	function style() {
	?>
<link href="components/com_jaccess/css/admin_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="components/com_jaccess/js/admin.jaccess.js"></script>
	<?php
	}
	function startMenu( $task ) {
	$user = & JFactory::getUser();
		HTML_cP::style();;
	if(JRequest::getVar('tmpl','')!='component'){ 
	?>
	<table cellpadding="3" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left" valign="top" width="160" height="0">
			<table cellpadding="4" cellspacing="0" border="0" width="160" height="100%" align="left" class="moduleTable">
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _GROUPS_MENU; ?></th>
			  </tr>
				<tr><td><img src="components/com_jaccess/images/group.png" /></td><td><a href="index2.php?option=com_jaccess&task=listGroups"><?php echo _VIEW_ALL_GROUPS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jaccess/images/group.png" /></td><td><a href="index2.php?option=com_jaccess&task=newGroup"><?php echo _CREATE_NEW_GROUP; ?></a></td></tr>
			</table>
	  </td>
		<td align="left" valign="top">
		<?php 
	}
}
	function endMenu() {	?></td>
	  </tr>
	</table>
	<?php
}

function showFilter() {
?>
<table width='100%' cellpadding='4' class='moduleTable' border="0" cellspacing="0">
	<tr class='tableList'>
		<td class='tableListHeader' colspan="2" align="left"><?php echo _FILTER; ?></td>
    </tr>
    <tr>
		<td width='220'><?php echo _FILTER; ?>: <input type="text" name="filter" /><input type="submit" name="Submit" value="Submit" class='button small' /></td>
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
        <a href="javascript:alphaFilter('')" class='alpha'>Show All</a>
        </td>
	</tr>
</table>
<br />
<?php
}
}
class HTML_groups {
	
function listGroups ($option, &$rows, &$pageNav) {
	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	
	global $acl;
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deletecomment') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteGroup');
				}
			} else if (pressbutton =='editGroup') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editGroup');
				}
			} else {
				submitform(pressbutton);
			}
		}
		</script>
<form action="index2.php" method="post" name="adminForm">
<?php
		HTML_cP::showFilter();
?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort">
	<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width="50" align="center" class="table-sortable:numeric table-sortable"><?php echo _JID; ?></th>
<th align="left" class="table-sortable:default table-sortable"><?php echo _GROUPNAME; ?></th>
<th width='100' align="center"><?php echo _PUBLISHED; ?></th>
</tr></thead>
<tbody>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
if ($row->published == '1' ) {
			// Published
				$img = 'publish_g.png';
				$alt = _PUBLISHED;
			} else {
			// Unpublished
				$img = 'publish_x.png';
				$alt = _UNPUBLISHED;
			}
?>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?></td>
<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editGroup')"><?php echo $row->groupname; ?></a></td>
<td align="center">
	    			<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? "unpublish" : "publish";?>')">
					<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</a>
</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
?></tbody>
<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
</table>
<input type="hidden" name="returntask" value="listGroups" />
<input type="hidden" name="type" value="accessgroups" />
<input type="hidden" name="option" value="com_jaccess" />
<input type="hidden" name="task" value="listGroups" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?
}
function editGroup($option, &$row, $usersList, $toAddUsersList, &$groupOwner) {
   $database =& JFactory::getDBO();
   $editor =& JFactory::getEditor();
?>
<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'listGroups') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.name.value == ""){
				alert( "Group must have a naem" );
			} else {
				allSelected(document.adminForm['users_selected[]']);				
				submitform( pressbutton );
			}
		}
function checkElement(field) {
	var form = document.adminForm;
	if (form.getElementById(field).value == "") {
	document.getElementById(field+"_label").style.backgroundImage='url("components/com_jaccess/images/required_field.png")';
	} else {
	document.getElementById(field+"_label").style.backgroundImage='url("components/com_jaccess/images/required_field_2.png")';
	}
}

//-->
			// moves elements from one select box to another one
			function moveOptions(from,to) {
			  // Move them over
			  for (var i=0; i<from.options.length; i++) {
				var o = from.options[i];
				if (o.selected) {
				  to.options[to.options.length] = new Option( o.text, o.value, false, false);
				}
			  }
			  // Delete them from original
			  for (var i=(from.options.length-1); i>=0; i--) {
				var o = from.options[i];
				if (o.selected) {
				  from.options[i] = null;
				}
			  }
			  from.selectedIndex = -1;
			  to.selectedIndex = -1;
			}

			function allSelected(element) {

			   for (var i=0; i<element.options.length; i++) {
					var o = element.options[i];
					o.selected = true;

				}
			 }
		</script>
    <form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerServices' align="left" colspan="4"><?php echo _GROUP_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150" class='<?php echo $row->groupname ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='groupname_label'><?php echo _GROUP_NAME; ?></td><td><input type="text_area" size="35" name="groupname" id="groupname" value="<?php echo $row->groupname; ?>" onchange="checkElement('groupname');"></td>
		</tr>
		<!--
        <tr>
			<td width="150" class='<?php echo $row->groupowner ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='groupowner_label'><?php echo _GROUP_OWNER; ?></td><td><?php echo $groupOwner['managers']; ?></td>
		</tr>
		-->
		<tr>
          <td width="150px" class='fieldName' id='status'><?php echo _PUBLISHED; ?></td>
		  <td class='fieldValue'><?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>  </td>
        </tr>
        <tr>
        	<td valign="top" class='fieldName'><?php echo _MEMBERS; ?></td><td><table cellpadding='0' cellspacing='0'>
				<tr>
					<td width="40%" style="border: 0px;">
                      <center><strong><?php echo _USERS_AVAILABLE;?></strong></center>
                    </td>
					<td width="20%" style="border: 0px;">&nbsp;</td>
					<td width="40%" style="border: 0px;"><center><strong><?php echo _MEMBERS_IN_GROUP;?></strong></center></td>
				</tr>
				<tr>
					<td width="40%" style="border: 0px;"><?php echo $toAddUsersList;?></td>
					<td width="20%" style="border: 0px; text-align:center;">
						<input style="width: 50px" type="button" name="Button" value="&gt;" onClick="moveOptions(document.adminForm.users_not_selected, document.adminForm['users_selected[]'])" />
						<br /><br />
						<input style="width: 50px" type="button" name="Button" value="&lt;" onClick="moveOptions(document.adminForm['users_selected[]'],document.adminForm.users_not_selected)" />
						<br />
						<br />
					</td>
					<td width="40%" style="border: 0px;"><?php echo $usersList;?></td>
				</tr>
			</table></td>
        </tr>								
    </table>
	<table width="100%" cellpadding="5" cellspacing='0' class='accessView'>
        <tr>
        	<td class='headerQuotes' align="left"><?php echo _ACCESS_INFORMATION; ?></td>
        </tr>
		<tr><td>
		<span class='subHeader'>jAccounts</span>
			<table width="100%" border="0" cellspacing="0" cellpadding="5" class='adminlist'>
				<thead>
			        <tr>
			            <th class='fieldName2' width='150'>Area</th>
			            <th class='fieldName2' width="150">View</th>
			            <th class='fieldName2' width="150">Edit</th>
        			    <th class='fieldName2' width="150">Delete</th>			
						<th>&nbsp;</th>
     			   </tr>
				</thead>
					<tr>
				      <td align="center">Quotes</td>
    		       	  <td align="center" id='jaccounts11'><input type='checkbox' name='jaccounts_quotes[]' id='jaccounts1a' <?php echo $row->jaccounts_quotes > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jaccounts12'><input type='checkbox' name='jaccounts_quotes[]' id='jaccounts1b' <?php echo $row->jaccounts_quotes > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jaccounts13'><input type='checkbox' name='jaccounts_quotes[]' id='jaccounts1c' <?php echo $row->jaccounts_quotes > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">Invoices</td>
    		       	  <td align="center" id='jaccounts21'><input type='checkbox' name='jaccounts_invoices[]' id='jaccounts2a' <?php echo $row->jaccounts_invoices > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jaccounts22'><input type='checkbox' name='jaccounts_invoices[]' id='jaccounts2b' <?php echo $row->jaccounts_invoices > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jaccounts23'><input type='checkbox' name='jaccounts_invoices[]' id='jaccounts2c' <?php echo $row->jaccounts_invoices > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">Services</td>
    		       	  <td align="center" id='jaccounts31'><input type='checkbox' name='jaccounts_services[]' id='jaccounts3a' <?php echo $row->jaccounts_services > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jaccounts32'><input type='checkbox' name='jaccounts_services[]' id='jaccounts3b' <?php echo $row->jaccounts_services > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jaccounts33'><input type='checkbox' name='jaccounts_services[]' id='jaccounts3c' <?php echo $row->jaccounts_services > 2 ? "checked=true" : "" ?> ></td>
					  <td>&nbsp;</td>
					</tr>
			    </table>
				<br />
		<span class='subHeader'>jContacts</span>
			<table width="100%" border="0" cellspacing="0" cellpadding="5" class='adminlist'>
				<thead>
			        <tr>
			            <th class='fieldName2' width='150'>Area</th>
			            <th class='fieldName2' width="150">View</th>
			            <th class='fieldName2' width="150">Edit</th>
        			    <th class='fieldName2' width="150">Delete</th>			
						<th>&nbsp;</th>
     			   </tr>
				</thead>
					<tr>
				      <td align="center">Leads</td>
    		       	  <td align="center" id='jcontacts11'><input type='checkbox' name='jcontacts_leads[]' id='jcontacts1a' <?php echo $row->jcontacts_leads > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jcontacts12'><input type='checkbox' name='jcontacts_leads[]' id='jcontacts1b' <?php echo $row->jcontacts_leads > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jcontacts13'><input type='checkbox' name='jcontacts_leads[]' id='jcontacts1c' <?php echo $row->jcontacts_leads > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">Contacts</td>
    		       	  <td align="center" id='jcontacts21'><input type='checkbox' name='jcontacts_contacts[]' id='jcontacts2a' <?php echo $row->jcontacts_contacts > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jcontacts22'><input type='checkbox' name='jcontacts_contacts[]' id='jcontacts2b' <?php echo $row->jcontacts_contacts > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jcontacts23'><input type='checkbox' name='jcontacts_contacts[]' id='jcontacts2c' <?php echo $row->jcontacts_contacts > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">Accounts</td>
    		       	  <td align="center" id='jcontacts31'><input type='checkbox' name='jcontacts_accounts[]' id='jcontacts3a' <?php echo $row->jcontacts_accounts > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jcontacts32'><input type='checkbox' name='jcontacts_accounts[]' id='jcontacts3b' <?php echo $row->jcontacts_accounts > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jcontacts33'><input type='checkbox' name='jcontacts_accounts[]' id='jcontacts3c' <?php echo $row->jcontacts_accounts > 2 ? "checked=true" : "" ?> ></td>
					  <td>&nbsp;</td>
					</tr>
			    </table>
				<br />
		<span class='subHeader'>jProjects</span>
			<table width="100%" border="0" cellspacing="0" cellpadding="5" class='adminlist'>
				<thead>
			        <tr>
			            <th class='fieldName2' width='150'>Area</th>
			            <th class='fieldName2' width="150">View</th>
			            <th class='fieldName2' width="150">Edit</th>
        			    <th class='fieldName2' width="150">Delete</th>			
						<th>&nbsp;</th>
     			   </tr>
				</thead>
					<tr>
				      <td align="center">Tasks</td>
    		       	  <td align="center" id='jprojects11'><input type='checkbox' name='jprojects_tasks[]' id='jprojects1a' <?php echo $row->jprojects_tasks > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jprojects12'><input type='checkbox' name='jprojects_tasks[]' id='jprojects1b' <?php echo $row->jprojects_tasks > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jprojects13'><input type='checkbox' name='jprojects_tasks[]' id='jprojects1c' <?php echo $row->jprojects_tasks > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">Projects</td>
    		       	  <td align="center" id='jprojects21'><input type='checkbox' name='jprojects_projects[]' id='jprojects2a' <?php echo $row->jprojects_projects > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jprojects22'><input type='checkbox' name='jprojects_projects[]' id='jprojects2b' <?php echo $row->jprojects_projects > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jprojects23'><input type='checkbox' name='jprojects_projects[]' id='jprojects2c' <?php echo $row->jprojects_projects > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">Timer</td>
    		       	  <td align="center" id='jprojects31'><input type='checkbox' name='jprojects_timer[]' id='jprojects3a' <?php echo $row->jprojects_timer > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jprojects32'><input type='checkbox' name='jprojects_timer[]' id='jprojects3b' <?php echo $row->jprojects_timer > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jprojects33'><input type='checkbox' name='jprojects_timer[]' id='jprojects3c' <?php echo $row->jprojects_timer > 2 ? "checked=true" : "" ?> ></td>
					  <td>&nbsp;</td>
					</tr>
			    </table>
				<br />							
		<span class='subHeader'>jSupport</span>
			<table width="100%" border="0" cellspacing="0" cellpadding="5" class='adminlist'>
				<thead>
			        <tr>
			            <th class='fieldName2' width='150'>Area</th>
			            <th class='fieldName2' width="150">View</th>
			            <th class='fieldName2' width="150">Edit</th>
        			    <th class='fieldName2' width="150">Delete</th>			
						<th>&nbsp;</th>
     			   </tr>
				</thead>
					<tr>
				      <td align="center">Tickets</td>
    		       	  <td align="center" id='jsupport11'><input type='checkbox' name='jsupport_tickets[]' id='jsupport1a' <?php echo $row->jsupport_tickets > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jsupport12'><input type='checkbox' name='jsupport_tickets[]' id='jsupport1b' <?php echo $row->jsupport_tickets > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jsupport13'><input type='checkbox' name='jsupport_tickets[]' id='jsupport1c' <?php echo $row->jsupport_tickets > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">FAQ's</td>
    		       	  <td align="center" id='jsupport21'><input type='checkbox' name='jsupport_faqs[]' id='jsupport2a' <?php echo $row->jsupport_faqs > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jsupport22'><input type='checkbox' name='jsupport_faqs[]' id='jsupport2b' <?php echo $row->jsupport_faqs > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jsupport23'><input type='checkbox' name='jsupport_faqs[]' id='jsupport2c' <?php echo $row->jsupport_faqs > 2 ? "checked=true" : "" ?> /></td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
				      <td align="center">Categories</td>
    		       	  <td align="center" id='jsupport31'><input type='checkbox' name='jsupport_categories[]' id='jsupport3a' <?php echo $row->jsupport_categories > 0 ? "checked=true" : "" ?> /></td>
  	        	   	  <td align='center' id='jsupport32'><input type='checkbox' name='jsupport_categories[]' id='jsupport3b' <?php echo $row->jsupport_categories > 1 ? "checked=true" : "" ?> /></td>
            		  <td align='center' id='jsupport33'><input type='checkbox' name='jsupport_categories[]' id='jsupport3c' <?php echo $row->jsupport_categories > 2 ? "checked=true" : "" ?> ></td>
					  <td>&nbsp;</td>
					</tr>
			    </table>
				<br />					
			</td>
		</tr>
	</table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="listGroups" />
</form> 
<? 
}
}
?>