<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
// Invoice Functions
class HTML_cP {
	function style() {
	?>
<link href="components/com_jsupport/css/admin_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="components/com_jsupport/js/admin.jsupport.js"></script>
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
				<tr align="left">
				  <th colspan='2' class='tableListHeader'><?php echo _TICKETS; ?></th>
			  </tr>
				<tr><td><img src="components/com_jsupport/images/home.jpg" /></td><td><a href="index2.php?option=com_jsupport"><?php echo _HOME_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jsupport/images/invoices.jpg" /></td><td><a href="index2.php?option=com_jsupport&task=listTickets&type=new"><?php echo _VIEW_NEW_TICKETS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jsupport/images/quotes.jpg" /></td><td><a href="index2.php?option=com_jsupport&task=listTickets&type=open"><?php echo _VIEW_OPEN_TICKETS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jsupport/images/invoices_add.jpg" /></td><td><a href="index2.php?option=com_jsupport&task=listTickets"><?php echo _VIEW_ALL_TICKETS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jsupport/images/quotes_add.jpg" /></td><td><a href="index2.php?option=com_jsupport&task=newTicket"><?php echo _CREATE_TICKET_MENU_LINK; ?></a></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _FAQS_MENU; ?></th>
			  </tr>
				<tr><td><img src="components/com_jsupport/images/pencil.png" /></td><td><a href="index2.php?option=com_jsupport&task=listFaqs"><?php echo _VIEW_FAQS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jsupport/images/pencil_add.png" /></td><td><a href="index2.php?option=com_jsupport&task=newFaq"><?php echo _CREATE_FAQ_MENU_LINK; ?></a></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _COMMENTS_MENU; ?></th>
			  </tr>
				<tr><td><img src="components/com_jsupport/images/comments.png" /></td><td><a href="index2.php?option=com_jsupport&task=listComments"><?php echo _VIEW_ALL_COMMENTS_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jsupport/images/comments_delete.png" /></td><td><a href="index2.php?option=com_jsupport&task=listComments&type=unpublished"><?php echo _VIEW_UNPUBLISHED_COMMENTS_MENU_LINK; ?></a></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _CONFIGURATION_MENU; ?></th>
			  </tr>
                <tr><td><img src="components/com_jsupport/images/config.jpg" /></td><td><a href="index2.php?option=com_jsupport&task=config"><?php echo _CONFIG_MENU_LINK; ?></a></td></tr>
                <tr><td><img src="components/com_jsupport/images/folder.png" /></td><td><a href="index2.php?option=com_jsupport&task=listCategories"><?php echo _CATEGORIES_MENU_LINK; ?></a></td></tr>
                <tr><td><img src="components/com_jsupport/images/about.jpg" /></td><td><a href="index2.php?option=com_jsupport&task=About"><?php echo _ABOUT_MENU_LINK; ?></a></td></tr>
			</table>
	  </td>
		<td align="left" valign="top">
		<?php 
	}
}
	function endMenu() {	?></td>
	  </tr>
	</table>
    <div id="copy"><?php echo _POWERED_BY; ?> <a href="http://www.igenxsolutions.com">Igenx Solutions</a></div>
	<?php
}
/* Menu End */
function controlPanel($option) {
$database =& JFactory::getDBO();
   $path = JPATH_SITE."/administrator/components/com_jsupport/jsupport.cpanel.php";
   if (file_exists( $path )) {
          require $path;
      } else {
          echo '<br />.... help!!';
      }
 }  
function About($option) {
	$database =& JFactory::getDBO();
   $path = JPATH_SITE."/administrator/components/com_jsupport/jsupport.about.php";
   if (file_exists( $path )) {
          require $path;
      } else {
        jSupportController::controlPanel($option);
      }

}
/*Configuration */
   function showConfig( &$jfConfig, &$lists, $option) {
?>
<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class='tableList'>
		<tr class='tableListHeader' >
			<td align="left">jSupport <?php echo _CONFIGURATION_MANAGER; ?></td>
		</tr>
	</table>
<br />
<div id="content-pane" class="pane-sliders">
<div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _GENERAL; ?></span></h3>
      <div class="jpane-slider content">
      	 <table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME; ?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTING; ?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION ?></th>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _COMPANY_NAME; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_company_name" value="<?php echo htmlspecialchars(stripslashes($jfConfig['company_name'])); ?>" size='40'/></td>
         <td align="left" valign="top"><?php echo _COMPANY_NAME_DESCRIPTION; ?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _COMPANY_EMAIL; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_company_email" value="<?php echo htmlspecialchars(stripslashes($jfConfig['company_email'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _COMPANY_EMAIL_DESCRIPTION; ?><br /></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _ENABLE_ACCESS_RESTRICTIONS; ?></td>
         <td align="left" valign="top"><input type="checkbox" name="cfg_access_restrictions" <?php echo $jfConfig['access_restrictions'] == 'on' ? "checked" : "" ?> /></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_ACCESS_RESTRICTIONS; ?></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _ENABLE_CAPTCHA; ?></td>
         <td align="left" valign="top"><input type="checkbox" name="cfg_captcha" <?php echo $jfConfig['captcha'] == 'on' ? "checked" : "" ?> /></td>
         <td align="left" valign="top"><?php echo _ENABLE_CAPTCHA_DESCRIPTION; ?></td>
      </tr>
   </table>
      </div>
</div>
<div class="panel">
      <h3 class="jpane-toggler title" id="cpanel-panel"><span><?php echo _EMAILS; ?></span></h3>
      <div class="jpane-slider content">
      
      	<table cellpadding="4" cellspacing="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME; ?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTING; ?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION ?></th>
      </tr>
      <tr>
      	<td align="left" valign="top"><?php echo _SEND_EMAIL; ?></td>
        <td align="left" valign="top"><?php echo $lists['send_email']; ?></td>
        <td align="left" valign="top"><?php echo _SEND_EMAIL_DESCRIPTION; ?></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _NEW_TICKET_EMAIL_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_ticket_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_ticket_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_TICKET_EMAIL_SUBJECT_DESCRIPTION; ?></td>
    </tr>
	<tr>
	   	<td align="left" valign="top"><?php echo _NEW_TICKET_EMAIL; ?></td>
        <td align="left" valign="top"><textarea name="cfg_new_ticket_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_ticket_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_TICKET_EMAIL_DESCRIPTION; ?><br /><br />Available variables: <br /><br />%CLIENT_NAME%<br />%TICKET_NAME%<br />%TICKET_DESCRIPTION%<br />%TICKET_PRIORITY%<br />%COMPANY_NAME%</td>
    </tr>
    <tr><td colspan='3'></td></tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_TICKET_COMMENT_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_ticketcomment_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_ticketcomment_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_TICKET_COMMENT_SUBJECT_DESCRIPTION; ?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><?php echo _NEW_TICKET_COMMENT_EMAIL; ?></td>
        <td align="left" valign="top"><textarea name="cfg_new_ticketcomment_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_ticketcomment_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_TICKET_COMMENT_EMAIL_DESCRIPTION; ?><br /><br />Available variables: <br /><br />%CLIENT_NAME%<br />%TICKETCOMMENT_NAME%<br />%TICKETCOMMENT_DESCRIPTION%<br />%COMPANY_NAME%</td>
      </tr>

</table>

      </div>
</div>
</div>
   <input type="hidden" name="task" value="" />
   <input type="hidden" name="option" value="<?php echo $option; ?>" />
   <input type="hidden" name="cfg_version" value="<?php echo $jfConfig['version']; ?>" />
   </form>
<?php
		// flush();
		// ob_flush(); ?>
<?php
/* configuration */
}
function listCategories ($option, &$rows, &$pageNav) {
$database =& JFactory::getDBO();
$user = & JFactory::getUser();
		global $acl;
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteCategory') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteCategory');
				}
			} else if (pressbutton =='editCategory') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editCategory');
				}
			} else {
				submitform(pressbutton);
			}
		}
		</script>
<form action="index2.php" method="post" name="adminForm">
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort:1">
	<thead>
	<tr class='tableListHeader'>
		<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
		<th width="50" align="center" class="table-sortable:numeric table-sortable"><?php echo _JID; ?></th>
		<th align="left" class="table-sortable:default table-sortable" width='200'><?php echo _CATEGORY_NAME; ?></th>
		<th align="left" class="table-sortable:default table-sortable"><?php echo _CATEGORY_DESCRIPTION; ?></th>
		<th width='100' align="center"><?php echo _PUBLISHED; ?></th>
</tr></thead><tbody>
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
<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editCategory')"><?php echo $row->name; ?></a></td>
<td align="left"><?php echo substr($row->description,0,120); ?></td>
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
<input type="hidden" name="returntask" value="listCategories" />
<input type="hidden" name="type" value="supportcategories" />
<input type="hidden" name="option" value="com_jsupport" />
<input type="hidden" name="task" value="listCategories" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?
}
function editCategory($option, &$row) {
   $database =& JFactory::getDBO();
   $editor =& JFactory::getEditor();   
?>
<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'listCategories') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.name.value == ""){
				alert( "Category must have a title" );
			} else {
				submitform( pressbutton );
			}
		}
//-->
</script>
    <form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<th class='headerServices' align="left" colspan="4"><?php echo _CATEGORY_DETAILS; ?></th>
        </tr>

        <tr>
        <tr>
			<td width="150" class='<?php echo $row->name ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='name_label'><?php echo _CATEGORY_NAME; ?></td><td><input type="text_area" size="35" name="name" id="name" value="<?php echo $row->name; ?>" onchange="checkElement('name');"></td>
		</tr>
		<tr>
          <td width="150px" class='fieldName' id='status'><?php echo _PUBLISHED; ?></td>
		  <td class='fieldValue'><?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>  </td>
        </tr>
        <tr>
        	<td valign="top" class='fieldName'></td><?php echo _DESCRIPTION; ?></td><td><?php echo $editor->display( 'description', $row->description, '50%', '350', '55', '20' ) ; ?></td>
        </tr>
    </table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<? 
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
function clientPopup($option, &$rows) {
?>
<form action="index2.php" method="post" name='adminForm' >
<?php HTML_cP::showFilter(); ?>
<br />
<table width="100%" cellpadding="5" class="tableList">
	<tr>
    	<td align='left' class='tableListHeader'><?php echo _JNAME; ?></td><td align='left' class='tableListHeader'><?php echo _JUSERNAME; ?></td><td class='tableListHeader'><?php echo _JEMAIL; ?></td>
    </tr>
	<?php 
	$i = 0;
	if($rows) { 
	foreach ($rows as $row) {
		$name = $row->name;
	echo "<tr class='row".$i."'><td><a href='#' onClick=\"window.parent.jSupportClient('".$row->id."','".$name."','".$row->username."')\">".$name."</a></td><td align='center' width='100px'>".$row->name."</td><td width='150px' align='center'>".$row->email."</td></tr>";
	$i = 1 - $i;
	} } else { 
	echo "<tr class='row1'><td colspan='3' align='center'>No clients available.</td></tr>";
	}
	?>
</table>
<table width="100%" cellpadding="4" style="margin: 0;">
	<tr>
				<td align="center" colspan="5" style="border:none;">
				</td>
			</tr>
    <tr>
        <td colspan="5" align="center" style="border:none;">
        </td>
	</tr>
</table>
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="clientPopup" />
<input type="hidden" name="tmpl" value="component" />
<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
</form>
<?php
}
}
class HTML_tickets {
function viewTicket($option, &$row, &$username, &$ticketcomments, &$manager, &$category) {
	$client = ($username[1]) ? $username[1]." [".$username[2]."]" : '';
	$accountid = ($row->accountid != 'NULL') ? $row->accountid : '';
	$manager = ($manager[0]) ? $manager[1]." [".$manager[2]."]" : '';
?>
    <form action="index2.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
		<input type='hidden' name='subject' value='<?php echo $row->subject; ?>'  />
		<input type='hidden' name='description' value='<?php echo $row->description; ?>'  />
		<input type='hidden' name='solution' value='<?php echo $row->solution; ?>'  />				
		<input type='hidden' name='category' value='<?php echo $row->category; ?>'  />
		<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
		<input type='hidden' name='id' value='<?php echo $row->id; ?>'  />	
	</form> 
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
      <tr>
        <th class='tableListHeader' align="left" colspan="4"><?php echo _TICKET_DETAILS; ?></th>
      </tr>
      <tr>
        <td width="150px" class='fieldName' id='subject2'><?php echo _TICKET_NAME; ?></td>
        <td width="300px" class='fieldValue'><?php echo $row->subject; ?></td>
        <td width="150" class='fieldName'><?php echo _CATEGORY; ?></td>
        <td class='fieldValue'><?php echo $category[1]; ?> </td>		
      </tr>
      <tr>
        <td class='fieldName' id='client2'><?php echo _CLIENT; ?></td>
        <td class='fieldValue'><?php echo $client; ?></td>
        <td width="150" class='fieldName'><?php echo _ACCOUNT; ?></td>
        <td class='fieldValue'><?php echo $accountid; ?></td>
      </tr>
      <tr>
        <td class='fieldName' id='priority'><?php echo _PRIORITY; ?></td>
        <td class='fieldValue'><?php echo $row->priority; ?></td>	  
        <td width="150" class='fieldName'><?php echo _MANAGER; ?></td>
        <td class='fieldValue'><?php echo $manager; ?> </td>
      </tr>
      <tr>
        <td class='fieldName'><?php echo _STATUS; ?></td>
        <td class='fieldValue'><?php echo $row->status; ?></td>
        <td width="150" class='fieldName'>&nbsp;</td>
        <td class='fieldValue'>&nbsp;</td>
      </tr>
      <tr>
        <td colspan='4' align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan='4' class='tableListHeader' align="left"><?php echo _PROBLEM; ?></td>
      </tr>
      <tr>
        <td colspan='4' style="padding:10px;"><?php echo $row->description; ?></td>
      </tr>
      <tr>
        <td colspan='4' class='tableListHeader' align="left"><?php echo _SOLUTION; ?></td>
      </tr>
      <tr>
        <td colspan='4' style="padding:10px;"><?php echo $row->solution; ?></td>
      </tr>
      <tr>
		<td colspan='4' class='tableListHeader' align="left"><?php echo _COMMENTS; ?></td>
		</tr>
        <?php 
		if($ticketcomments){
			$k = 0;
			foreach($ticketcomments as $tc) {
		?>
		<tr class='row<?php echo $k; ?>'>
                	<td colspan="4" style="padding: 10px;"><?php echo $tc->comment; ?></td>
		</tr>
		<?php
		$k = 1 - $k;
      	}
		?>
        <?php
		} else {
		?>
        <tr><td colspan='4'><?php echo _NO_COMMENTS_POSTED; ?></td></tr>
        <?php
		} 
		?>
    </table>
    <? 
}
function editTicket($option, &$row, &$username, &$ticketcomments, &$lists, &$categories) {
	JRequest::setVar( 'hidemainmenu', 1 );
	
	$doc 		=& JFactory::getDocument();
	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
	$editor =& JFactory::getEditor();
		
		$js = "
		function jSupportClient(id, name, username) {
		title = name+\" [\"+username+\"]\";
			document.getElementById('contactid').value = id;
			document.getElementById('contactname').value = title;
		    document.getElementById('client_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}
		";
	$doc->addScriptDeclaration($js);
	global $jfConfig;
		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal');
		
		$link = 'index.php?option=com_jsupport&amp;task=clientPopup&amp;tmpl=component';	
		$nullDate = $database->getNullDate();
		$now	= new JDate();
		if ( $row->created != $nullDate ) {
			$create_date 	= JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC2'));
		}
		$mod_date = null;
		if ( $row->modified != $nullDate ) {
			$mod_date 		= JHTML::_('date',  $row->modified, JText::_('DATE_FORMAT_LC2'));
		}
	?>
<script type="text/javascript">
<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'listTickets') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.subject.value == ""){
				alert( "Ticket must have a title" );
			} else if (form.contactid.value == ""){
				alert( "You must select a Client." );
			} else if (form.priority.value == ""){
				alert( "You must select a Priority." );
			} else {
				submitform( pressbutton );
			}
		}
function checkElement(field) {
	var form = document.adminForm;
	if (form.getElementById(field).value == "") {
	document.getElementById(field+"_label").style.backgroundImage='url("components/com_jsupport/images/required_field.png")';
	} else {
	document.getElementById(field+"_label").style.backgroundImage='url("components/com_jsupport/images/required_field_2.png")';
	}
}
//-->
</script>
<form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
<tr>
        	<th class='tableListHeader' align="left" colspan="4"><?php echo _EDIT_TICKET_DETAILS; ?></th>
      </tr>
        <tr>
			<td width="150px" class='<?php echo $row->subject ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='subject_label'><?php echo _TICKET_NAME; ?></td>
		  <td width="300px" class='fieldValue'><input type="text" name="subject" id='subject' value="<?php echo $row->subject; ?>" size="40"  onchange="checkElement('subject');" /></td>
			<td width="150" class='fieldName'><?php echo _CATEGORY; ?></td>
            <td class='fieldValue'><select name="category">
                <?php 
				foreach($categories as $cat) {
					if($row->category == $cat->id) {
						echo "<option value=".$row->category." selected>".$cat->name."</option>";
					} else {
						echo "<option value=".$cat->id.">".$cat->name."</option>";
					}
				}
				?>
            </select>
            </td>			
        </tr>
		<tr>
			<td class='<?php echo $row->contactid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='client_label'><?php echo _CLIENT; ?></td>
          <td class='fieldValue'>
            <input type='hidden' name='contactid' id='contactid' value='<?php echo $row->contactid;?>' onchange="checkElement('contactid');"/><input type='text' name='contactname' id='contactname' value="<?php echo $row->id ? $username[1]." [".$username[2]."]" : "" ; ?>" readonly="readonly"  /><a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jprojects/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a></td>
            <td width="150" class='fieldName'><?php echo _ACCOUNT; ?></td>
			<td class='fieldValue'><input type='text' name="accountid" value="<?php echo $row->accountid; ?>" /></td>
		</tr>
        <tr>
          <td class='<?php echo $row->priority ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='priority_label'><?php echo _PRIORITY; ?></td>
		  <td class='fieldValue'><select name="priority" id="priority" onchange="checkElement('priority');"><option value=''></option>
            	<?php 
                $priority=array(_LOW,_MEDIUM, _HIGH, _URGENT);
				foreach($priority as $p) {
				if($row->priority == $p) {
					echo "<option value=".$row->priority." selected>".$row->priority."</option>";
				} else {
					echo "<option value=".$p.">".$p."</option>";
				}
				}
				?>
            </select></td>
        	
            <td width="150" class='fieldName'><?php echo _MANAGER; ?></td>
            <td class='fieldValue'><?php echo $lists['managers']; ?>
          </td>
        </tr>
		<tr>
		  <td class='fieldName'><?php echo _STATUS; ?></td>
          <td class='fieldValue'>
            <select name="status">
            	<?php 
                $stages=array(_OPEN,_PENDING, _CLOSED);
				foreach($stages as $stage) {
				if($row->status == $stage) {
					echo "<option value=".$row->status." selected>".$row->status."</option>";
				} else {
					echo "<option value=".$stage.">".$stage."</option>";
				}
				}
				?>
            </select>            </td>
			<td width="150" class='fieldName'>&nbsp;</td>
<td class='fieldValue'>&nbsp;</td>
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='4' class='tableListHeader' align="left"><?php echo _PROBLEM; ?></td></tr>
        <tr>
          <td colspan='4'><?php echo $editor->display( 'description', $row->description, '50%', '200', '55', '20' ) ; ?></td>
        </tr>
        <tr><td colspan='4' class='tableListHeader' align="left"><?php echo _SOLUTION; ?></td></tr>
        <tr>
          <td colspan='4'><?php echo $editor->display( 'solution', $row->solution, '50%', '200', '55', '20' ) ; ?></td>
        </tr>
       	<tr>
		  <td colspan='4' class='tableListHeader' align="left"><?php echo _COMMENTS; ?></td>
		</tr>
        <?php 
		$j = 0;
		if($ticketcomments){
			$k = 0;
			foreach($ticketcomments as $tc) {
		?>
		<tr class='row<?php echo $k; ?>'>
       	  <td colspan="4"><?php echo $tc->comment; ?></td>
		</tr>
		<?php
		$k = 1 - $k;
      	}
		$j++;
		?>
        <?php
		} else {
		?>
        <tr><td colspan='4'><?php echo _NO_COMMENTS_POSTED; ?></td></tr>
        <?php
		} 
		?>
        <tr>
        <td colspan='4' class='tableListHeader' align="left"><?php echo _ADD_COMMENT; ?></td>
        </tr>
	  <tr>
        <td colspan='4' align="left"><?php echo $editor->display( 'comment','', '50%', '200', '55', '20' ) ; ?></td>
		  </tr>
  </table>
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<? 
}
function listTickets ($option, &$rows, $pageNav) {
$database =& JFactory::getDBO();
$user =& JFactory::getUser();
global $acl;
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteTicket') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteTicket');
				}
			} else if (pressbutton =='editTicket') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editTicket');
				}
			} else {
				submitform(pressbutton);
			}
		}
-->
		</script>
<form action="index2.php" method="post" name="adminForm">
<?php
		HTML_cP::showFilter();
?>
<table cellpadding="3" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort:1">
<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width="50" align="center" class="table-sortable:numeric table-sortable"><?php echo _JID; ?></th>
<th align="left" class="table-sortable:default table-sortable"><?php echo _TICKET_NAME; ?></th>
<th width="100" align="center" class="table-sortable:default table-sortable"><?php echo _PRIORITY; ?></th>
<th width='150' align="left" class="table-sortable:default table-sortable"><?php echo _CLIENT; ?></th>
<th width='100' align="center" class="table-sortable:default table-sortable"><?php echo _STATUS; ?></th>
<th width='150' align='left' class="table-sortable:default table-sortable"><?php echo _MANAGER; ?></th>
<th width="100" align="center" class="table-sortable:numeric table-sortable"><?php echo _CREATED; ?></th>
</tr>
</thead>
<tbody>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
$client = ($row->name) ? $row->name." [".$row->username."]" : '';
$manager = ($row->ownername) ? $row->ownername." [".$row->owner."]" : '';
?>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?></td>
<td align="left"><a href="#view" onclick="return listItemTask('cb<?php echo $i;?>','viewTicket')"><?php echo $row->subject; ?></a></td>
<td align="center"><?php echo $row->priority; ?>&nbsp;</td>
<td align="left"><?php echo $client; ?>&nbsp;</td>
<td align="center"><?php echo $row->status; ?>&nbsp;</td>
<td align='left'><?php echo $manager; ?>&nbsp;</td>
<td align="center"><?php echo JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC4') ); ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='row1'>
           		<td colspan='8' align="center"><strong><?php echo _NO_TICKETS_AVAILABLE; ?></strong>&nbsp;&nbsp;<a href='index2.php?option=com_jsupport&task=newTicket'>[<?php echo _CREATE_ONE_NOW; ?>]</a></td>
           </tr>
           <?php } ?>
	</tbody>
<tfoot>
			<tr>
				<td colspan="8">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
</table>
<input type="hidden" name="returntask" value="listTickets" />
<input type="hidden" name="type" value="tickets" />
<input type="hidden" name="option" value="com_jsupport" />
<input type="hidden" name="task" value="listTickets" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?
}
}
// Quote Functions
class HTML_faqs {
function viewFaq($option, &$row, &$faqcomments, &$category) {
?>
    <form action="index2.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
	</form> 
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
      <tr>
        <th class='tableListHeader' align="left" colspan="2"><?php echo _FAQ_DETAILS; ?></th>
      </tr>
      <tr>
        <td width="150px" class='fieldName' id='subject2'><?php echo _FAQ_NAME; ?></td>
        <td class='fieldValue'><?php echo $row->subject; ?></td>
      </tr>
      <tr>
        <td width="150" class='fieldName'><?php echo _CATEGORY; ?></td>
        <td class='fieldValue'><?php echo $category[1]; ?> </td>
      </tr>
      	<td width="150px" class="fieldName"><?php echo _KEYWORDS; ?></td>
        <td class="fieldValue"><?php echo $row->keywords; ?></td>
      <tr>
      <tr>
        <td width='150px' class='fieldName' id='client2'><?php echo _STATUS; ?></td>
        <td class='fieldValue'><?php echo $row->published = 1 ? "Published" : "Unpublished" ; ?></td>
	  </tr>
        <td colspan='2' align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan='2' class='tableListHeader' align="left"><?php echo _QUESTION; ?></td>
      </tr>
      <tr>
        <td colspan='2' style="padding:10px;"><?php echo $row->description; ?></td>
      </tr>
      <tr>
        <td colspan='2' class='tableListHeader' align="left"><?php echo _ANSWER; ?></td>
      </tr>
      <tr>
        <td colspan='2' style="padding:10px;"><?php echo $row->solution; ?></td>
      </tr>
      <tr>
		<td colspan='2' class='tableListHeader' align="left"><?php echo _COMMENTS; ?></td>
		</tr>
        <?php 
		if($faqcomments){
			$k = 0;
			foreach($faqcomments as $fc) {
		?>
		<tr class='row<?php echo $k; ?>'>
                	<td colspan="2" style="padding: 10px;"><?php echo $fc->comment; ?></td>
		</tr>
		<?php
		$k = 1 - $k;	
      	}
		?>
        <?php
		} else {
		?>
        <tr><td colspan='2'><?php echo _NO_COMMENTS_POSTED; ?></td></tr>
        <?php
		} 
		?>
    </table>
    <? 
}
function editFaq($option, &$row, &$faqcomments, &$categories) {
		$database =& JFactory::getDBO();
		$editor =& JFactory::getEditor();
		
		$nullDate 		= $database->getNullDate();
		$create_date 	= null;
		if ( $row->created != $nullDate ) {
			$create_date 	= JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC2'));
		}
		$mod_date = null;
		if ( $row->modified != $nullDate ) {
			$mod_date 		= JHTML::_('date',  $row->modified, JText::_('DATE_FORMAT_LC2'));
		}
		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
	?>
<script type="text/javascript">
<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'listFaqs') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.subject.value == ""){
				alert( "FAQ must have a title" );
			} else if(form.category.value =="") {
				alert("FAQ must have a category assigned.");
			} else {
				submitform( pressbutton );
			}
		}
//-->
</script>
<form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
<tr>
        	<th class='tableListHeader' align="left" colspan="2"><?php echo _EDIT_FAQ_DETAILS; ?></th>
      </tr>
        <tr>
			<td width="150px" class='<?php echo $row->subject ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='subject_label'><?php echo _FAQ_NAME; ?></td>
		  <td class='fieldValue'><input type="text" id="subject" name="subject" value="<?php echo $row->subject; ?>" size="80"  onchange="checkElement('subject');" /></td>
        </tr>
        <tr>
            <td width="150px" class='fieldName'><?php echo _CATEGORY; ?></td>
            <td class='fieldValue'><select name="category" id='category' name='category'>
                <?php 
				foreach($categories as $cat) {
					if($row->category == $cat->id) {
						echo "<option value=".$row->category." selected>".$cat->name."</option>";
					} else {
						echo "<option value=".$cat->id.">".$cat->name."</option>";
					}
				}
				?>
            </select>
            </td>
		</tr>
        <tr>
        	<td width="150px" class="fieldName"><?php echo _KEYWORDS; ?></td>
            <td class="fieldValue"><input type="text" name="keywords" value="<?php echo $row->keywords; ?>" size="40" /> &nbsp;[Separated by commas]</td>
        <tr>
        <tr>
          <td width="150px" class='fieldName' id='status'><?php echo _PUBLISHED; ?></td>
		  <td class='fieldValue'><?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>  </td>
        </tr>
          <td colspan='2' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='2' class='tableListHeader' align="left"><?php echo _QUESTION; ?></td></tr>
        <tr>
          <td colspan='2'><?php echo $editor->display( 'description',$row->description, '50%', '200', '55', '20' ) ; ?></td>
        </tr>
        <tr><td colspan='2' class='tableListHeader' align="left"><?php echo _ANSWER; ?></td></tr>
        <tr>
          <td colspan='2'><?php echo $editor->display( 'solution',$row->solution, '50%', '200', '55', '20' ) ; ?></td>
        </tr>
       	<tr>
		  <td colspan='2' class='tableListHeader' align="left"><?php echo _COMMENTS; ?></td>
		</tr>
        <?php 
		$j = 0;
		if($faqcomments){
			$k = 0;
			foreach($faqcomments as $fc) {
		?>
		<tr class='row<?php echo $k; ?>'>
       	  <td colspan="2"><?php echo $fc->comment; ?></td>
		</tr>
		<?php
      	}
		$j++;
		$k = 1 - $k;	
		?>
        <?php
		} else {
		?>
        <tr><td colspan='2'><?php echo _NO_COMMENTS_POSTED; ?></td></tr>
        <?php
		} 
		?>
        <tr>
        <td colspan='2' class='tableListHeader' align="left"><?php echo _ADD_COMMENT; ?></td>
        </tr>
	  <tr>
        <td colspan='2' align="left"><?php echo $editor->display( 'comment','', '50%', '200', '55', '20' ) ; ?></td>
		  </tr>
  </table>
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<? 
}
function listFaqs ($option, &$rows, $pageNav) {
	$database =& JFactory::getDBO();
	$user =& JFactory::getUser();
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteFaq') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteFaq');
				}
			} else if (pressbutton =='editFaq') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editFaq');
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
<table cellpadding="3" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort:1">
	<thead></thead
><tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width="50" align="center" class="table-sortable:numeric table-sortable"><?php echo _JID; ?></th>
<th align="left" class="table-sortable:default table-sortable"><?php echo _FAQ_NAME; ?></th>
<th width='100' align="center"><?php echo _PUBLISHED; ?></th>
<th align="center" class="table-sortable:default table-sortable"><?php echo _CATEGORY; ?></th>
<th width="100" align="center" class="table-sortable:numeric table-sortable"><?php echo _CREATED; ?></th>
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
<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','viewFaq')"><?php echo $row->subject; ?></a></td>
<td align="center">
	    			<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? "unpublish" : "publish";?>')">
					<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</a>
</td>
<td align='center'><?php echo $row->name; ?>&nbsp;</td>
<td align="center"><?php echo JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC4') ); ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='row1'>
           		<td colspan='8' align="center"><strong><?php echo _NO_FAQS_AVAILABLE; ?></strong>&nbsp;&nbsp;<a href='index2.php?option=com_jsupport&task=newFaq'>[<?php echo _CREATE_ONE_NOW; ?>]</a></td>
           </tr>
           <?php } ?>
   </tbody>
<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
</table>
<input type="hidden" name="returntask" value="listFaqs" />
<input type="hidden" name="type" value="faqs" />
<input type="hidden" name="option" value="com_jsupport" />
<input type="hidden" name="task" value="listFaqs" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?php
}
function listComments ($option, &$rows, &$pageNav) {
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
					submitform('deleteComment');
				}
			} else if (pressbutton =='editComment') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editComment');
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
<th align="left" class="table-sortable:default table-sortable"><?php echo _COMMENT; ?></th>
<th width='100' align="center"><?php echo _PUBLISHED; ?></th>
<th width='200' align='left' class="table-sortable:default table-sortable"><?php echo _OWNER_NAME; ?></th>
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
<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editComment')"><?php echo $row->comment; ?></a></td>
<td align="center">
	    			<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? "unpublish" : "publish";?>')">
					<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</a>
</td><td align='left'><?php echo $row->creatorname; ?>&nbsp;</td>
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
<input type="hidden" name="returntask" value="listComments" />
<input type="hidden" name="type" value="supportcomments" />
<input type="hidden" name="option" value="com_jsupport" />
<input type="hidden" name="task" value="listComments" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?
}
function editComment($option, &$row) {
   $database =& JFactory::getDBO();
   $editor =& JFactory::getEditor();
?>
<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'listComments') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.creatorname.value == ""){
				alert( "Comment must have an owner" );
			} else {
				submitform( pressbutton );
			}
		}
function checkElement(field) {
	var form = document.adminForm;
	if (form.getElementById(field).value == "") {
	document.getElementById(field+"_label").style.backgroundImage='url("components/com_jsupport/images/required_field.png")';
	} else {
	document.getElementById(field+"_label").style.backgroundImage='url("components/com_jsupport/images/required_field_2.png")';
	}
}
//-->
</script>
    <form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerServices' align="left" colspan="4"><?php echo _COMMENT_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150" class='<?php echo $row->creatorname ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='creator_label'><?php echo _COMMENT_CREATOR_NAME; ?></td><td><input type="text_area" size="35" name="creatorname" id="creator" value="<?php echo $row->creatorname; ?>" onchange="checkElement('creator');"></td>
		</tr>
        <tr>
			<td width="150" class='<?php echo $row->creatoremail ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='creatoremail_label'><?php echo _COMMENT_CREATOR_EMAIL; ?></td><td><input type="text_area" size="35" name="creatoremail" id="creatoremail" value="<?php echo $row->creatoremail; ?>" onchange="checkElement('creatoremail');"></td>
		</tr>
		<tr>
          <td width="150px" class='fieldName' id='status'><?php echo _PUBLISHED; ?></td>
		  <td class='fieldValue'><?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?>  </td>
        </tr>
        <tr>
        	<td valign="top" class='fieldName'><?php echo _COMMENT; ?></td><td><?php echo $editor->display( 'comment',$row->comment, '50%', '200', '55', '20' ) ; ?></td>
        </tr>
    </table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="listComments" />
</form> 
<? 
}
}
?>