<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_cP {

/* Menu */
	
	function style() {
	?>
<link href="components/com_jprojects/css/admin_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="components/com_jprojects/js/admin.jprojects.js"></script>
	<?php
	}

	function startMenu( $task ) {
	$user = & JFactory::getUser();
		HTML_cP::style();
	if(JRequest::getVar('tmpl','')!='component'){ 
	?>
	<table cellpadding="3" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left" valign="top" width="160" height="0">
			<table cellpadding="4" cellspacing="0" border="0" width="160" height="100%" align="left" class="moduleTable">
				<tr align="left">
				  <th colspan='2' class='tableListHeader'><?php echo _MENU; ?></th>
			  </tr>
				<tr><td><img src="components/com_jprojects/images/home.jpg" /></td><td><a class="menu<?php echo ($task=="") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects"><?php echo _HOME_MENU_LINK; ?></a></td></tr>
				<tr><td><img src="components/com_jprojects/images/database.png" /></td><td><a class="menu<?php echo ($task=="listProjects") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=listProjects"><?php echo _VIEW_PROJECTS; ?></a></td></tr>
				<tr><td><img src="components/com_jprojects/images/date.png" /></td><td><a class="menu<?php echo ($task=="listTasks") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=listTasks"><?php echo _VIEW_TASKS; ?></a></td></tr>
				<tr><td><img src="components/com_jprojects/images/database_add.png" /></td><td><a class="menu<?php echo ($task=="newProject") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=newProject"><?php echo _CREATE_PROJECT; ?></a></td></tr>
				<tr><td><img src="components/com_jprojects/images/date_add.png" /></td><td><a class="menu<?php echo ($task=="newTask") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=newTask"><?php echo _CREATE_TASK; ?></a></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _DOCUMENTS; ?></th>
			  </tr>
				<tr><td><img src="components/com_jprojects/images/folder.png" /></td><td><a class="menu<?php echo ($task=="listDocuments") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=listFiles"><?php echo _VIEW_FILES; ?></a></td></tr>
				<tr><td><img src="components/com_jprojects/images/folder_add.png" /></td><td><a class="menu<?php echo ($task=="newDocument") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=newFile"><?php echo _ADD_FILE; ?></a></td></tr>
				<?php if($user->get('gid')>=25) { ?>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _TIME_TRACKER; ?></th>
			  </tr>
				<tr><td><img src="components/com_jprojects/images/time.png" /></td><td><a class="menu<?php echo ($task=="listDocuments") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=listTimes"><?php echo _MANAGE_TIMES; ?></a></td></tr>
				<tr><td><img src="components/com_jprojects/images/time_add.png" /></td><td><a class="menu<?php echo ($task=="newDocument") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=newTime"><?php echo _ADD_TIME; ?></a></td></tr>
				<?php } ?>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _CALENDAR; ?></th>
			  </tr>
				<tr><td><img src="components/com_jprojects/images/calendar_view_day.png" /></td><td><a class="menu<?php echo ($task=="viewCalendar") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=viewCalendar"><?php echo _VIEW_CALENDAR; ?></a></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr align="left"><th colspan='2' class='tableListHeader'><?php echo _CONFIGURATION; ?></th>
		    </tr>
			<?php if ($user->get('gid') == '25') { ?>
                <tr><td><img src="components/com_jprojects/images/config.jpg" /></td><td><a class="menu<?php echo ($task=="Configuration") ? "_selected": ""; ?>" href="index2.php?option=com_jprojects&task=config"><?php echo _SETTINGS; ?></a></td></tr>
			<?php } ?>
                <tr><td><img src="components/com_jprojects/images/about.jpg" /></td><td><a class="menu<?php echo ($task=="About") ? "_selected" : ""; ?>" href="index2.php?option=com_jprojects&task=About"><?php echo _ABOUT; ?></a></td></tr>
                
			</table>
	  </td>
		<td align="left" valign="top">
		<?php 
		}
	}

	function endMenu() {	?></td>
	  </tr>
	</table>
    <div id="copy"><?php echo _POWERED_BY; ?><a href="http://www.igenxsolutions.com"> Igenx Solutions</a></div>
	<?php
	}
/* Menu End */
function controlPanel($option) {
	$database = & JFactory::getDBO();

   $path = JPATH_SITE."/administrator/components/com_jprojects/jprojects.cpanel.php";
   if (file_exists( $path )) {
          require $path;
      } else {
          echo '<br />.... help!!';
         mosLoadAdminModules( 'cpanel', 1 );
      }
 }  

function About($option) {
	$database = & JFactory::getDBO();
   $path = JPATH_SITE."/administrator/components/com_jprojects/jprojects.about.php";
   if (file_exists( $path )) {
          require $path;
      } else {
        controlPanel($option);
      }


}

/*Configuration */

   function showConfig( &$jfConfig, &$lists, $option ) {
   	global $mosConfig_gzip;
?>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class='tableList'>
		<tr class='tableListHeader' >
			<td align="left">jProjects <?php echo _CONFIGURATION_MANAGER; ?></td>
		</tr>
	</table>
<br />
   <form action="index2.php" method="post" name="adminForm">
<div id="content-pane" class="pane-sliders">
<div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _GENERAL; ?></span></h3>
      <div class="jpane-slider content">
	 <table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME; ?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTING; ?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION; ?></th>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _COMPANY_NAME; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_company_name" value="<?php echo htmlspecialchars(stripslashes($jfConfig['company_name'])); ?>" size='40'/></td>
         <td align="left" valign="top"><?php echo _COMPANY_NAME_DESCRIPTION; ?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _COMPANY_ADDRESS; ?></td>
         <td align="left" valign="top"><textarea name="cfg_company_address" cols='28' rows='4'><?php echo htmlspecialchars(stripslashes($jfConfig['company_address'])); ?></textarea></td>
         <td align="left" valign="top"><?php echo _COMPANY_ADDRESS_DESCRIPTION; ?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _COMPANY_EMAIL; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_company_email" value="<?php echo htmlspecialchars(stripslashes($jfConfig['company_email'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _COMPANY_EMAIL_DESCRIPTION; ?><br /></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _ENABLE_ACCESS_RESTRICTIONS; ?></td>
         <td align="left" valign="top"><input type="checkbox" name="cfg_access_restrictions" value="1" <?php echo $jfConfig['access_restrictions'] == 1 ? "checked" : "" ?> /></td>
         <td align="left" valign="top"><?php echo _ENABLE_ACCESS_RESTRICTIONS_DESCRIPTION; ?></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _CALENDAR_DAY_VIEW; ?></td>
         <td align="left" valign="top"><?php echo $lists['calendar_day']; ?></td>
         <td align="left" valign="top"><?php echo _CALENDAR_DAY_VIEW_DESCRIPTION; ?></td>
      </tr>
   </table><br />
      </div>
</div>

<div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _EMAILS; ?></span></h3>
      <div class="jpane-slider content">
	<table cellpadding="4" cellspacing="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME; ?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTINGS; ?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION; ?></th>
      </tr>
	<tr>
         <td align="left" valign="top"><?php echo _AUTOMATED_EMAIL_NOTIFICATIONS; ?></td>
         <td align="left" valign="top"><?php echo $lists['auto_email']; ?></td>
         <td align="left" valign="top"><?php echo _AUTOMATED_EMAIL_DESCRIPTION; ?></td>
    </tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_PROJECT_EMAIL_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_project_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_project_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_PROJECT_EMAIL_SUBJECT_DESCRIPTION; ?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><?php echo _NEW_PROJECT_EMAIL; ?></td>
        <td align="left" valign="top"><textarea name="cfg_new_project_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_project_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_PROJECT_EMAIL_SUBJECT; ?><br /><br />Available variables: <br /><br />%CLIENT_NAME%<br />%PROJECT_NAME%<br />%LINK%<br />%COMPANY_NAME%</td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _NEW_TASK_EMAIL_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_task_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_task_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_TASK_EMAIL_SUBJECT_DESCRIPTION; ?></td>
    </tr>
	<tr>
	   	<td align="left" valign="top"><?php echo _NEW_TASK_EMAIL; ?></td>
        <td align="left" valign="top"><textarea name="cfg_new_task_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_task_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_TASK_EMAIL_DESCRIPTION; ?><br /><br />Available variables: <br /><br />%CLIENT_NAME%<br />%PROJECT_NAME%<br />%TASK_NAME%<br />%LINK%<br />%COMPANY_NAME%</td>
    </tr>
    <tr><td colspan='3'></td></tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_DOCUMENT_EMAIL_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_document_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_document_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_DOCUMENT_EMAIL_SUBJECT_DESCRIPTION; ?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><?php echo _NEW_DOCUMENT_EMAIL; ?></td>
        <td align="left" valign="top"><textarea name="cfg_new_document_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_document_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_DOCUMENT_EMAIL_DESCRIPTION; ?><br /><br />Available variables: <br /><br />%CLIENT_NAME%<br />%PROJECT_NAME%<br />%DOCUMENT_NAME%<br />%LINK%<br />%COMPANY_NAME%</td>
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

   }

function showFilter() {
?>
<table width='100%' cellpadding='4' class='editView' border="0" cellspacing="0">
	<tr>
		<td class='headerInvoices' colspan="2" align="left"><?php echo _FILTER; ?></td>
    </tr>
    <tr>
		<td width='210'><?php echo _FILTER; ?>: <input type="text" name="filter" />&nbsp;<input type="submit" name="<?php echo _JSUBMIT; ?>" value="Submit" class='button small' /></td>
    	<td align="left">
        <input type='hidden' name='alpha' value = "" />
        <a href="javascript:alphaFilter('A')" class='alpha'>A</a>&nbsp;
        <a href="javascript:alphaFilter('B')" class='alpha'>B </a>&nbsp;
        <a href="javascript:alphaFilter('C')" class='alpha'>C </a>&nbsp;
        <a href="javascript:alphaFilter('D')" class='alpha'>D </a>&nbsp;
        <a href="javascript:alphaFilter('E')" class='alpha'>E </a>&nbsp;
        <a href="javascript:alphaFilter('F')" class='alpha'>F </a>&nbsp;
        <a href="javascript:alphaFilter('G')" class='alpha'>G </a>&nbsp;
        <a href="javascript:alphaFilter('H')" class='alpha'>H </a>&nbsp;
        <a href="javascript:alphaFilter('I')" class='alpha'>I </a>&nbsp;
        <a href="javascript:alphaFilter('J')" class='alpha'>J</a> &nbsp;
        <a href="javascript:alphaFilter('K')" class='alpha'>K </a>&nbsp;
        <a href="javascript:alphaFilter('L')" class='alpha'>L </a>&nbsp;
        <a href="javascript:alphaFilter('M')" class='alpha'>M </a>&nbsp;
        <a href="javascript:alphaFilter('N')" class='alpha'>N </a>&nbsp;
        <a href="javascript:alphaFilter('O')" class='alpha'>O </a>&nbsp;
        <a href="javascript:alphaFilter('P')" class='alpha'>P </a>&nbsp;
        <a href="javascript:alphaFilter('Q')" class='alpha'>Q </a>&nbsp;
        <a href="javascript:alphaFilter('R')" class='alpha'>R </a>&nbsp;
        <a href="javascript:alphaFilter('S')" class='alpha'>S </a>&nbsp;
        <a href="javascript:alphaFilter('T')" class='alpha'>T </a>&nbsp;
        <a href="javascript:alphaFilter('U')" class='alpha'>U </a>&nbsp;
        <a href="javascript:alphaFilter('V')" class='alpha'>V </a>&nbsp;
        <a href="javascript:alphaFilter('W')" class='alpha'>W</a> &nbsp;
        <a href="javascript:alphaFilter('X')" class='alpha'>X </a>&nbsp;
        <a href="javascript:alphaFilter('Y')" class='alpha'>Y </a>&nbsp;
        <a href="javascript:alphaFilter('Z')" class='alpha'>Z</a>&nbsp;
        <a href="javascript:alphaFilter('')" class='alpha'><?php echo _SHOW_ALL; ?></a>
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
	echo "<tr class='row".$i."'><td><a href='#' onClick=\"window.parent.jProjectsClient('".$row->id."','".$name."','".$row->username."')\">".$name."</a></td><td align='center' width='100px'>".$row->name."</td><td width='150px' align='center'>".$row->email."</td></tr>";
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
function projectPopup($option, &$rows) {
?>
<form action="index2.php" method="post" name='adminForm' >
<?php HTML_cP::showFilter(); ?>
<br />
<table width="100%" cellpadding="5" class="tableList">
	<tr>
    	<td align='left' class='tableListHeader'><?php echo _JNAME; ?></td><td align='left' class='tableListHeader'><?php echo _DESCRIPTION; ?></td>
    </tr>
	<?php 
	$i = 0;
	if($rows) {
	foreach ($rows as $row) {
	if ($row->description) {
	if(strlen($row->description)>60) { 
		$d = strpos($row->description, " ", 60);
	} else { 
		$d = strlen($row->description);
	}
		$description = substr($row->description, 0, $d)."...";
	} else { $description = ''; }
	echo "<tr class='row".$i."'><td width='35%'><a href='#' onClick=\"window.parent.jProjectsProject('".$row->id."','".$row->subject."')\">".$row->subject."</a></td><td>".$description."</td></tr>";
	$i = 1 - $i;
	} } else { 
	echo "<tr class='row1'><td colspan='3' align='center'>". _NO_PROJECTS_AVAILABLE ."</td></tr>";
	}
	?>
</table><table width="100%" cellpadding="4" style="margin: 0;">
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
<input type="hidden" name="tmpl" value="component" />
<input type="hidden" name="task" value="projectPopup" />
<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
</form>

<?php
}

function taskPopup($option, &$rows) {
?>
<form action="index2.php" method="post" name='adminForm' >
<?php HTML_cP::showFilter(); ?>
<br />
<table width="100%" cellpadding="5" class="tableList">
	<tr>
    	<td align='left' class='tableListHeader'><?php echo _JNAME; ?></td><td align='left' class='tableListHeader'><?php echo _DESCRIPTION; ?></td>
    </tr>
	<?php 
	$i = 0;
	if($rows) {
	foreach ($rows as $row) {
	if ($row->description) {
	if(strlen($row->description)>60) { 
		$d = strpos($row->description, " ", 60);
	} else { 
		$d = strlen($row->description);
	}
		$description = substr($row->description, 0, $d)."...";
	} else { $description = ''; }
	echo "<tr class='row".$i."'><td width='35%'><a href='#' onClick=\"window.parent.jProjectsTask('".$row->id."','".$row->subject."')\">".$row->subject."</a></td><td>".$description."</td></tr>";
	$i = 1 - $i;
	} } else { 
	echo "<tr class='row1'><td colspan='3' align='center'>". _NO_TASKS_AVAILABLE ."</td></tr>";
	}
	?>
</table><table width="100%" cellpadding="4" style="margin: 0;">
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
<input type="hidden" name="tmpl" value="component" />
<input type="hidden" name="task" value="projectPopup" />
<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
</form>

<?php
}

function milestonePopup($option, &$row) {
 	$editor =& JFactory::getEditor();
	$startdate = date("Y-m-d", strtotime($ms->startdate));
	$completiondate = date("Y-m-d", strtotime($ms->completiondate));
?>
<script type="text/javascript">
		window.addEvent('domready', function() {  myCal = new Calendar({ startdate: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });
		window.addEvent('domready', function() {  myCal2 = new Calendar({ completiondate: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });

function cancel() {
	window.parent.document.getElementById('sbox-window').close();
}

function displayResults(row_id) {
	if(row_id=='') {
  	fnAddMilestone();
			<?php
				echo $editor->save( 'description' );
			?>
	var row_id = window.parent.document.getElementById('milestonesTable').rows.length;
       row_id = eval(row_id)-1;
	} 
	var form = document.adminForm;
	var totalMilestones = window.parent.document.getElementById("totalMilestones").value;
	  window.parent.document.getElementById("totalMilestones").value = eval(totalMilestones)+1;	
	  window.parent.document.getElementById("nameView"+row_id).innerHTML = "<strong>"+form.name.value+"<input type='hidden' name='name"+row_id+"' id='name"+row_id+"' value='"+form.name.value+"'>";	  
	  window.parent.document.getElementById("descriptionView"+row_id).innerHTML = form.description.value+"<input type='hidden' name='description"+row_id+"' id='description"+row_id+"' value='"+form.description.value+"'>";
	 window.parent.document.getElementById("mstartdateView"+row_id).innerHTML = "<center>"+form.startdate.value+"</center><input type='hidden' name='mstartdate"+row_id+"' id='mstartdate"+row_id+"' value='"+form.startdate.value+"'>";	  
	  window.parent.document.getElementById("mcompletiondateView"+row_id).innerHTML = "<center>"+form.completiondate.value+"</center><input type='hidden' name='mcompletiondate"+row_id+"' id='mcompletiondate"+row_id+"' value='"+form.completiondate.value+"'>";
	  var checked = document.getElementById("completed").checked;	  	  
	  if (checked == true) {
	  	window.parent.document.getElementById("mcompleted"+row_id).checked = true;
	  } else {
	  	window.parent.document.getElementById("mcompleted"+row_id).checked = false;
	  }
      window.parent.document.getElementById('sbox-window').close();
}
</script>
<table class="toolbar" width="100%"><tr><td width='100%'>&nbsp;</td>
<td class="button" id="toolbar-cancel" align='right'>
<a href="#" onclick="cancel();" class="toolbar">
<span class="icon-32-cancel" title="Close"></span><?php echo _CLOSE; ?></a></td>
<td class="button" id="toolbar-save" align='right'>
<a href="#" onclick="return validateMilestone('<?php echo $row->id; ?>');" class="toolbar">
<span class="icon-32-save" title="Save">
</span><?php echo _SAVE; ?></a></td></tr></table>
	<form name='adminForm' method='post'>
<table width="100%" cellpadding="5"  class="tableList">
	<tr>
		<td colspan='2' class='headerQuotes' align='left'><?php echo _MILESTONE_DETAILS; ?></td>
	</tr>
	<tr>
		<td id="name_label" class='fieldNameRequired'><?php echo _JNAME; ?></td>
		<td class='fieldValue'><input type='text' name='name' id='name' width="150" value="<?php echo $row->name; ?>" onchange="popupCheck('name');"></td>
	</tr>
	<tr>
		<td id="startdate_label" class='fieldNameRequired'><?php echo _START_DATE; ?></td>
		<td class='fieldValue'><input class="calendar" type="text" name="startdate" id="startdate" onchange="checkElement('startdate');" value="<?php echo $startdate; ?>" />
		</td>
	</tr>
	<tr>
		<td id="completiondate_label" class='fieldNameRequired'><?php echo _END_DATE; ?></td>
		<td class='fieldValue'><input class="calendar" type="text" name="completiondate" id="completiondate" onchange="checkElement('completiondate');" value="<?php echo $completiondate; ?>" />
		</td>
	</tr>
	<tr>
		<td class='fieldName'><?php echo _COMPLETED; ?></td>
		<td class='fieldValue'><input type='checkbox' name='completed' id='completed' value='1'></td>
	</tr>
	<tr>
		<td class='fieldName' valign='top'><?php echo _DESCRIPTION; ?></td>
		<td class='fieldValue'><?php echo $editor->display( 'description', $row->description, '40%', '200', '55', '20' ) ; ?></td>
	</tr>
</table>
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form>
<?php
}

function timelinePopup($option, &$row, &$tasks, &$milestones, &$totalTasks, &$totalMilestones, &$totalCTasks, &$totalCMilestones) {
###FOR FUTURE USE###
/*
$milestonesPercentComplete = round(($totalCMilestones/$totalMilestones)*100,2);
$tasksPercentComplete = round(($totalCTasks/$totalTasks)*100,2);
$taskTableCellWidth = round(100/$totalTasks,2);
?>
Project <?php echo _JID; ?>: <?php echo $row->id; ?><br /><br />
<?php echo _COMPLETED; ?> Tasks: <?php echo $totalCTasks ?><br />
Total Tasks: <?php echo $totalTasks; ?><br />
Percent Complete: <?php echo $tasksPercentComplete; ?>%<br />
<br />
<?php echo _COMPLETED; ?> Milestones: <?php echo $totalCMilestones; ?><br />
Total Milestones: <?php echo $totalMilestones; ?><br />
Percent Complete: <?php echo $milestonesPercentComplete; ?>%<br /><br /> 
<table width='100%' cellpadding="0" cellspacing="0">
	<tr>
	<?php foreach ($tasks as $t) { ?>
		<td width="<?php echo $taskTableCellWidth; ?>"><?php echo $t->stage == '<?php echo _COMPLETED; ?>' ? "images/tick.png" : "images/publish_x.png"; ?><br /><?php echo $t->id; ?></td>
	<?php } ?>
	</tr>
</table>
<?php */
}


/* configuration */
}

class HTML_projects {
function viewProject($option, &$row, &$username, &$milestones, &$manager, &$files, &$tasks) {
	global $mainframe;
	$startdate = ($row->startdate) ? date("F d, Y", strtotime($row->startdate)) : '';
	$completiondate = ($row->completiondate) ? date("F d, Y", strtotime($row->completiondate)) : '';

	
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	$editor =& JFactory::getEditor();
	$user =& JFactory::getUser();	
	
		$js = "
		function jProjectsTimeline() {
			document.getElementById('sbox-window').close();
		}
		";

	$doc->addScriptDeclaration($js);

	global $jfConfig;

		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal');
		
		$link = 'index.php?option=com_jprojects&amp;task=timelinePopup&amp;tmpl=component&amp;cid[]='.$row->id;	
	
?>
    <form action="index2.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
	</form> 
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _PROJECT_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _PROJECT_NAME; ?></td>
			<td width="300px"><?php echo $row->subject; ?>&nbsp;</td>
			<td width="150px" class='fieldName'><?php echo _START_DATE; ?></td>
            <td><?php echo $startdate; ?></td>
		</tr>
		<tr>
			<td class='fieldName'><?php echo _CLIENT; ?></td>
            <td>
            <?php echo ($username) ? $username[1]." [".$username[2]."]" : '&nbsp;' ; ?>            </td>
            <td class='fieldName'><?php echo _END_DATE; ?>&nbsp;</td>
            <td><?php echo $completiondate; ?>&nbsp;</td>
	  </tr>
        <tr>
        	<td class='fieldName'><?php echo _ACCOUNT; ?>:</td>
            <td>
            	<?php echo $row->accountid; ?>&nbsp;            </td>
            <td class='fieldName'><?php echo _MANAGER; ?></td>
            <td><?php echo ($manager) ? $manager[1]." [".$manager[2]."]" : ''; ?>&nbsp;</td>
      </tr>
		<tr>
			<td class='fieldName'><?php echo _PUBLISHED; ?>:</td>
			<td>
				<?php echo $row->published == 1 ? 'Yes' : 'No'; ?>            </td>
            <td class='fieldName'>&nbsp;</td>
            <td>&nbsp;</td>
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr>
         <td colspan='4' align='left' class='headerQuotes'><?php echo _PROJECT_DESCRIPTION; ?></td>
         </tr>
         <tr>
         <td class='fieldName'><?php echo _DESCRIPTION; ?></td>
         <td colspan="3" class='fieldValue'><?php echo $row->description; ?>&nbsp;</td>
         </tr>
        <?php if($milestones){ ?>
         <tr>
         <td colspan='4'>&nbsp;</td>
         </tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _MILESTONES; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='serviceTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='250'><?php echo _JNAME; ?></th>
				<th align='left'><?php echo _DESCRIPTION; ?></th>
                <th align='center'><?php echo _START_DATE; ?></th>
				<th align='center' width='100'><?php echo _COMPLETION_DATE; ?></th>
				<th align='center' width='75'><?php echo _COMPLETED; ?></th>
			</tr>
            <?php
			$k = 0;
			foreach($milestones as $ms) {
			$startdate = ($ms->startdate) ? date("F d, Y", strtotime($ms->startdate)) : '';
			$completiondate = ($ms->completiondate) ? date("F d, Y", strtotime($ms->completiondate)) : '';
			$image = ($ms->completed == '1') ? "<img src='images/tick.png' border='0'>" : "<img src='images/publish_x.png' border='0'>";
		?>
		<tr class='row<?php echo $k; ?>'>
        	<td valign='top'>&nbsp;</td>
	        <td valign='top' width="250px"><strong><?php echo $ms->name; ?></strong></td>
            <td valign='top'><?php echo $ms->description; ?>&nbsp;</td>
            <td valign='top' align="center" width="150"><?php echo $startdate; ?>&nbsp;</td>
						<td valign='top' width="150" align="center"><?php echo $completiondate;?>&nbsp;</td>
            			<td valign='top' align="center" width="75"><?php echo $image; ?></td>
		  </tr>
		<?php $k = 1 - $k;
			} 
		?>
        </table>
        </td></tr>
		<?php 		} ?>
        <?php if($tasks){ ?>
		<tr><td colspan='4'>&nbsp;</td></tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _TASKS; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='tasksTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='250'><?php echo _JNAME; ?></th>
				<th align='left'><?php echo _DESCRIPTION; ?></th>
                <th align='center' width='150'><?php echo _START_DATE; ?></th>
				<th align='center' width='150'><?php echo _COMPLETION_DATE; ?></th>
				<th align='center' width='100'><?php echo _STAGE; ?></th>
			</tr>
		<?php
			$k = 0;
			foreach($tasks as $t) {
			$startdate = ($t->startdate) ? date("F d, Y g:i A", strtotime($t->startdate)) : '';
			$completiondate = ($t->completiondate) ? date("F d, Y g:i A", strtotime($t->completiondate)) : '';
			
		?>
		<tr class='row<?php echo $k; ?>'>
        	<td valign='top'>&nbsp;</td>
	        <td valign='top' width="250px"><a href='index.php?option=com_jprojects&amp;task=viewTask&amp;cid[]=<?php echo $t->id; ?>'><?php echo $t->subject; ?></a></td>
            <td valign='top'><?php echo $t->description; ?>&nbsp;</td>
            <td valign='top' align="center" width="150"><?php echo $startdate; ?>&nbsp;</td>
						<td valign='top' align='center' width="150"><?php echo $completiondate;?>&nbsp;</td>
            			<td valign='top' align="center"><?php echo $t->stage;?></td>
		  </tr>
		<?php $k = 1 - $k;
			} 
		?>
        </table>
        </td></tr>
		<?php 		}
			 if($files){ ?>
        <tr><td colspan='4'>&nbsp;</td></tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _FILES; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='tasksTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th width='250'><?php echo _FILE_NAME; ?></th>
				<th align='left'>File <?php echo _DESCRIPTION; ?></th>
				<th align='left' width='250'><?php echo _FILE_LOCATION; ?></th>
				<th align='center' width='150'><?php echo _DATE_ADDED; ?></th>
			</tr>
		<?php
			$k = 0;
			foreach($files as $f) {
		?>
		<tr class='row<?php echo $k; ?>'>
        	<td valign='top'>&nbsp;</td>
	        <td valign='top' width="250px"><a href='<?php echo $mainframe->getSiteURL()."components/com_jprojects/documents".DS.$row->id.DS.$f->filelocation; ?>' target='_blank'><?php echo $f->filename; ?></a></td>
            <td valign='top'><?php echo substr($f->description, 0, 200); ?>&nbsp;</td>
			<td valign='top'><?php echo $f->filelocation; ?>&nbsp;</td>
            <td valign='top' align="center" width="150"><?php echo $f->dateadded; ?>&nbsp;</td>
		  </tr>
		<?php $k = 1 - $k;
			} 
		?>
        </table>
        </td></tr>
		<?php 		}
		?>
    </table>
<? 
}

function editProject($option, &$row, &$username, &$milestones, &$lists, &$files, &$tasks) {
	JRequest::setVar( 'hidemainmenu', 1 );
	
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	$editor =& JFactory::getEditor();
	$user =& JFactory::getUser();	
		
		$js = "
		function jProjectsClient(id, name, username) {
		title = name+\" [\"+username+\"]\";
			document.getElementById('contactid').value = id;
			document.getElementById('contactname').value = title;
		    document.getElementById('client_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}
		
		function jProjectsTask(id, name, description, startdate, completiondate, completed ) {
		if(id=='') { 
		fnAddTask();
			var tableName = window.document.getElementById('tasksTable');
			var prev = tableName.rows.length;
    		var count = eval(prev)-1;
		} else { 
			count = id;
		}
			document.getElementById('tasknameView'+count).innerHTML = '<strong>'+name+'</strong>';
			document.getElementById('taskdescriptionView'+count).innerHTML = description;
			document.getElementById('taskstartdateView'+count).innerHTML = '<center>'+startdate+'</center>';
			document.getElementById('taskcompletiondateView'+count).innerHTML = '<center>'+completiondate+'</center>';						
			document.getElementById('taskcompletedView'+count).innerHTML = completed;
			document.getElementById('editLink'+count).innerHTML = '<center>--</center>';				
			document.getElementById('sbox-window').close();
		}		
		
		function jProjectsFile(id, name, location, dateadded, description ) {
		if(id=='') { 
		fnAddFile();
			var tableName = window.document.getElementById('filesTable');
			var prev = tableName.rows.length;
    		var count = eval(prev)-1;
		} else { 
			count = id;
		}
			document.getElementById('filenameView'+count).innerHTML = '<strong>'+name+'</strong>';
			document.getElementById('fileLocationView'+count).innerHTML = location;
			document.getElementById('fileDescriptionView'+count).innerHTML = description;
			if(id=='') {
			document.getElementById('fdateAdded'+count).innerHTML = '<center>'+dateadded+'</center>';				
			document.getElementById('fEdit'+count).innerHTML = '<center>--</center>';
			}
			//document.getElementById('fEdit'+count).innerHTML = '<center>--</center>';				
			document.getElementById('sbox-window').close();
		}		
		
		window.addEvent('domready', function() {  myCal = new Calendar({ startdate: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });
		window.addEvent('domready', function() {  myCal2 = new Calendar({ completiondate: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });		
		";

	$doc->addScriptDeclaration($js);

	global $jfConfig;

		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal');
		
		$link = 'index.php?option=com_jprojects&amp;task=clientPopup&amp;tmpl=component';	
		$milestoneLink = 'index.php?option=com_jprojects&amp;task=milestonePopup&amp;tmpl=component';	
		$taskLink = 'index.php?option=com_jprojects&amp;task=editTask&amp;tmpl=component&amp;projectid='.$row->id.'&amp;projectname='.$row->subject;		
		$fileLink = 'index.php?option=com_jprojects&amp;task=editFile&amp;tmpl=component&amp;projectid='.$row->id.'&amp;projectname='.$row->subject;				

		$nullDate 		= $database->getNullDate();
		$create_date 	= null;

		if ( $row->created != $nullDate ) {
			$create_date 	= JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC2'));
		}
		$mod_date = null;
		if ( $row->modified != $nullDate ) {
			$mod_date 		= JHTML::_('date',  $row->modified, JText::_('DATE_FORMAT_LC2'));
		}

		$startdate = $row->startdate ? date("Y/m/d", strtotime($row->startdate)) : '';
		$completiondate = $row->completiondate ? date("Y/m/d", strtotime($row->completiondate)) : '';
	?>
<script type="text/javascript">
<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if (pressbutton == 'listProjects') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			<?php echo $editor->getContent( 'product_description' ); ?>
			if (form.subject.value == ""){
				alert( "Project must have a title" );
			} else if (form.contactid.value == ""){
				alert( "You must select a Client." );
			} else if (form.startdate.value == ""){
				alert( "You must set a valid start date." );
			} else if (form.completiondate.value == ""){
				alert( "You must set a valid end date." );
			} else {
			<?php
				echo $editor->save( 'product_description' );
			?>
				submitform( pressbutton );
			}
		}
		
//-->
</script>
<form action="index2.php" method="post" name="adminForm" id='adminForm' enctype="multipart/form-data">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
<tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _PROJECT_DETAILS; ?></td>
      </tr>
        <tr>
			<td width="150px" class='<?php echo $row->subject ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='subject_label'><?php echo _PROJECT_NAME; ?></td>
		 	<td width="300px" class='fieldValue'><input type="text" name="subject" id="subject" value="<?php echo $row->subject; ?>" size="40"  onchange="checkElement('subject');"  /></td>
			<td width="150px" class='<?php echo $row->startdate ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='startdate_label'><?php echo _START_DATE; ?></td>
			<td class='fieldValue'><input class="calendar" type="text" name="startdate" id="startdate" onchange="checkElement('startdate');" value="<?php echo $startdate; ?>" />
			</td>
		</tr>
		<tr>
			<td class='<?php echo $row->contactid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='client_label'><?php echo _CLIENT; ?></td>
          	<td class='fieldValue'>
            	<input type='hidden' name='contactid' id='contactid' value='<?php echo $row->contactid;?>' onchange="checkElement('client');"/>
				<input type='text' name='contactname' id='contactname' value="<?php echo $row->id ? $username[1]." [".$username[2]."]" : "" ; ?>" readonly="readonly"  /><a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jprojects/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a>
			</td>
            <td class='<?php echo $row->completiondate ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='completiondate_label'><?php echo _END_DATE; ?></td>
          	<td class='fieldValue'><input class="calendar" type="text" name="completiondate" id="completiondate" onchange="checkElement('completiondate');" value="<?php echo $completiondate; ?>" />
			</td>
		</tr>
        <tr>
        	<td class='fieldName'><?php echo _ACCOUNT; ?></td>
          	<td class='fieldValue'><input type='text' name="accountid" value="<?php echo $row->accountid; ?>" /></td>
            <td class='fieldName'><?php echo _MANAGER; ?></td>
          	<td class='fieldValue'><?php echo $lists['managers']; ?></td>
        </tr>
		<tr>
			<td class='fieldName'><?php echo _PUBLISHED; ?>:</td>
		  	<td class='fieldValue'>
				<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?> </td>
            <td class='fieldName'>&nbsp;</td>
<td class='fieldValue'>&nbsp;</td>
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr>
          <td colspan='4' align="left" class='headerQuotes'><?php echo _PROJECT_DESCRIPTION; ?></td>
        </tr>
        <tr>
          <td class='fieldName' valign='top'><?php echo _DESCRIPTION; ?></td>
          <td colspan='3' align="left" class='fieldValue'><?php echo $editor->display( 'description', $row->description, '50%', '350', '55', '20' ) ; ?></td>
        </tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _MILESTONES; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='milestonesTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='left' width='250'><?php echo _JNAME; ?></th>
				<th align='left'><?php echo _DESCRIPTION; ?></th>
                <th align='center' width='150'><?php echo _START_DATE; ?></th>
				<th align='center' width='150'><?php echo _COMPLETION_DATE; ?></th>
				<th align='center' width='75'><?php echo _COMPLETED; ?></th>
				<th align='center' width='75'><?php echo _EDIT; ?></th>
			</tr>
        <?php if($milestones){
        	$j = 1;
			$k = 0;
			foreach($milestones as $ms) {
				$startdate = date("Y-m-d", strtotime($ms->startdate));
				$completiondate = date("Y-m-d", strtotime($ms->completiondate));
			?>
            <tr id="mrow<?php echo $j; ?>" class='row<?php echo $k; ?>'>
       				 <td valign='top'>
	       				  <img src="images/publish_x.png" border="0" onclick="deleteRow('<?php echo $j; ?>')">
						  <input type="hidden" id="m_deleted<?php echo $j; ?>" name="m_deleted<?php echo $j; ?>" value="0">
						  <input type="hidden" id="m_id<?php echo $j; ?>" name="m_id<?php echo $j; ?>" value="<?php echo $ms->id;?>">
					 </td>
				     <td valign='top' id='nameView<?php echo $j; ?>'>
                        	<strong><?php echo $ms->name; ?></strong>
							<input id="name<?php echo $j; ?>" name="name<?php echo $j; ?>" value="<?php echo $ms->name; ?>" type="hidden">
					 </td>
					 <td valign='top' id='descriptionView<?php echo $j; ?>'>
					    <?php echo $ms->description; ?>
						<input type='hidden' id="description<?php echo $j; ?>" name="description<?php echo $j; ?>" value="<?php echo $ms->description; ?>">
					</td>
					<td valign='top' align="center" id='mstartdateView<?php echo $j; ?>'>
					   	<?php echo $startdate; ?>
					   	<input type="hidden" name="mstartdate<?php echo $j; ?>" id="mstartdate<?php echo $j; ?>" value="<?php echo $startdate; ?>"/>
					</td>
                    <td valign='top' align='center' id='mcompletiondateView<?php echo $j; ?>'>
                       	<?php echo $completiondate; ?>
                       	<input type="hidden" name="mcompletiondate<?php echo $j; ?>" id="mcompletiondate<?php echo $j; ?>" value="<?php echo $completiondate; ?>"/>
					</td>
					<td valign='top' align="center" id='mcompletedView<?php echo $j; ?>'>	
						<input type='checkbox' id="mcompleted<?php echo $j; ?>" name="mcompleted<?php echo $j; ?>" value="1" <?php echo $ms->completed =='1' ? "checked" : "" ?>/>
					</td>
					<td valign='top' align='center'>
						<a class="modal" href="<?php echo $milestoneLink; ?>&cid[]=<?php echo $j; ?>" rel="{handler: 'iframe', size: {x: 740, y: 425}}">Edit</a>
					</td>
			</tr>
		<?php
		$j++;
		$k = 1 - $k;	
				}
		?>
		<input type="hidden" name="totalMilestones" id="totalMilestones" value="<?php echo $j-1; ?>">
        <?php
		} else {
		?> <input type="hidden" name="totalMilestones" id="totalMilestones" value="0">
		<?php
		}
		?>
		<?php if (!$row->id) { ?>
		<tr class="row1">
			<td colspan="7" style="font-weight:bold;" align="center">
				<?php echo _SAVE_BEFORE_ADDING_MILESTONES; ?>		
			</td>
		</tr>
		<?php } ?>
    </table>
        <br />&nbsp;
	<?php if ($row->id) { ?><a class="modal button" href="<?php echo $milestoneLink; ?>" rel="{handler: 'iframe', size: {x: 740, y: 425}}"><?php echo _ADD_MILESTONE; ?></a><br /><br /><?php } ?>
	
    </td></tr>
      <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _TASKS; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='tasksTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='left' width='250'><?php echo _JNAME; ?></th>
				<th align='left'><?php echo _DESCRIPTION; ?></th>
                <th align='center' width='150'><?php echo _START_DATE; ?></th>
				<th align='center' width='150'><?php echo _COMPLETION_DATE; ?></th>
				<th align='left' width='75'><?php echo _STAGE; ?></th>
				<th align='center' width='75'><?php echo _EDIT; ?></th>
			</tr>
        <?php if($tasks){
        	$j = 1;
			$k = 0;
			foreach($tasks as $t) {
			$lists = jProjectsHelper::taskStageProjects($j, $t);
			?>
            <tr id="trow<?php echo $j; ?>" class='row<?php echo $k; ?>'>
                <td valign='top'><img src="images/publish_x.png" border="0" onclick="deleteRowTask('<?php echo $j; ?>')"></td>
                <td valign='top' id='tasknameView<?php echo $j; ?>'><strong><?php echo $t->subject; ?></strong></td>
                <td valign='top' id='taskdescriptionView<?php echo $j; ?>'><?php echo $t->description; ?></td>
                <td valign='top' align="center" id='taskstartdateView<?php echo $j; ?>'><?php echo $t->startdate; ?></td>
                <td valign='top' align='center' id='taskcompletiondateView<?php echo $j; ?>'><?php echo $t->completiondate; ?></td>
                <td valign='top' align="center" id='taskcompletedView<?php echo $j; ?>'><?php echo $lists['stages'];?></td>
                <td valign='top' align='center' id='editLink<?php echo $j; ?>'><a class="modal" href="<?php echo $taskLink; ?>&cid[]=<?php echo $t->id; ?>&popedit=<?php echo $j; ?>" rel="{handler: 'iframe', size: {x: 780, y: 600}}">Edit</a></td>
			</tr>
                    <input type="hidden" id="t_deleted<?php echo $j; ?>" name="t_deleted<?php echo $j; ?>" value="0">
                    <input type="hidden" id="t_id<?php echo $j; ?>" name="t_id<?php echo $j; ?>" value="<?php echo $t->id; ?>">
		<?php
			$j++;
			$k = 1 - $k;	
				}
		?>
		<input type="hidden" name="totalTasks" id="totalTasks" value="<?php echo $j-1; ?>">
        <?php
		} else {
		?> <input type="hidden" name="totalTasks" id="totalTasks" value="0">
		<?php
		}
		?>
		<?php if (!$row->id) { ?>
		<tr class="row1">
			<td colspan="7" style="font-weight:bold;" align="center">
				<?php echo _SAVE_BEFORE_ADDING_TASKS; ?>	
			</td>
		</tr>
		<?php } ?>
    </table>
        <br />&nbsp;
	<?php if ($row->id) { ?><a class="modal button" href="<?php echo $taskLink; ?>" rel="{handler: 'iframe', size: {x: 780, y: 600}}"><?php echo _ADD_TASK; ?></a><br /><br /><?php } ?>
	
    </td></tr>
        <tr><td colspan="4">&nbsp;</td></tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _FILES; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='filesTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='left' width='250'><?php echo _FILE_NAME; ?></th>
				<th align='left'><?php echo _FILE_DESCRIPTION; ?></th>
				<th align='left' width=''><?php echo _FILE; ?></th>                
				<th align='center' width="150"><?php echo _DATE_ADDED; ?></th>
				<th align='center' width="75"><?php echo _EDIT; ?></th>
			</tr>
        <?php if($files){
        	$j = 1;
			$k = 0;
			foreach($files as $f) {
			?>
            <tr id="frow<?php echo $j; ?>" class='row<?php echo $k; ?>'>
       				  <td valign='top'><img src="images/publish_x.png" border="0" onclick="deleteRowFile('<?php echo $j; ?>')">
					  <input type="hidden" id="filedeleted<?php echo $j; ?>" name="filedeleted<?php echo $j; ?>" value="0">
					  <input type="hidden" id="fileID<?php echo $j; ?>" name="fileID<?php echo $j; ?>" value="<?php echo $f->id;?>">
					  </td>
				        <td valign='top' id='filenameView<?php echo $j; ?>'>
                        	<strong><?php echo $f->filename; ?></strong>
                        </td>
						<td valign='top' id='fileDescriptionView<?php echo $j; ?>'>
							<?php echo substr($f->description,0,200); ?>
						</td>
						</td>
				        <td valign='top' id='fileLocationView<?php echo $j; ?>'>
                        	<?php echo $f->filelocation; ?>
                        </td>                        		
            			<td valign='top' align="center" id='fdateAdded<?php echo $j; ?>'>
						   	<?php echo $f->dateadded; ?>
						</td>
						<td valign='top' align="center" id ='fEdit<?php echo $j;?>'>
							<a class="modal" href="<?php echo $fileLink; ?>&cid[]=<?php echo $f->id; ?>&popedit=<?php echo $j; ?>" rel="{handler: 'iframe', size: {x: 780, y: 425}}">Edit</a>
						</td>
					</tr>
                    <input type="hidden" name="f_id<?php echo $j; ?>" id="f_id<?php echo $j; ?>" value="<?php echo $f->id; ?>"/>
		<?php
		$j++;
		$k = 1 - $k;	
				}
		?>
		<input type="hidden" name="totalFiles" id="totalFiles" value="<?php echo $j-1; ?>">
        <?php
		} else {
		?>
         <input type="hidden" name="totalFiles" id="totalFiles" value="0">
		<?php
		}
		?>
		<?php if (!$row->id) { ?>
		<tr class="row1">
			<td colspan="6" style="font-weight:bold;" align="center">
				<?php echo _SAVE_BEFORE_ADDING_FILES; ?>		
			</td>
		</tr>
		<?php } ?>
    </table>
        <br />&nbsp;
		<?php if ($row->id) { ?><a class="modal button" href="<?php echo $fileLink; ?>" rel="{handler: 'iframe', size: {x: 780, y: 425}}">Add File</a><br /><br /><?php } ?>
	
    </td></tr>
  </table>
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />

</form> 

<? 
}
function listProjects ($option, &$rows, $pageNav) {
		global $acl, $mosConfig_offset;
		$database = & JFactory::getDBO();
		$user = &JFactory::getUser();
		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteProject') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteProject');
				}
			} else if (pressbutton =='editProject') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editProject');
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
<table cellpadding="3" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort:2">
	<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width="50" class="table-sortable:default table-sortable"><?php echo _JID; ?></th>
<th align="left" class="table-sortable:numeric table-sortable"><?php echo _PROJECT_NAME; ?></th>
<th width="100"><?php echo _PUBLISHED; ?></th>
<th width='150' align="left" class="table-sortable:default table-sortable"><?php echo _CLIENT; ?></th>
<th width='100' class="table-sortable:numeric table-sortable"><?php echo _START_DATE; ?></th>
<th width="100" class="table-sortable:numeric table-sortable"><?php echo _END_DATE; ?></th>
<th width='150' align="left" class="table-sortable:default table-sortable"><?php echo _MANAGER; ?></th>
</tr>
</thead>
<tbody>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
if ($row->published == '1' ) {
			// <?php echo _PUBLISHED;
				$img = 'publish_g.png';
				$alt = _PUBLISHED;
			} else {
			// <?php echo _UNPUBLISHED;s
				$img = 'publish_x.png';
				$alt = _UNPUBLISHED;
			}
$startdate = JHTML::_('date',  $row->startdate, JText::_('DATE_FORMAT_LC4'));
$enddate = JHTML::_('date',  $row->completiondate, JText::_('DATE_FORMAT_LC4'));
?>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?></td>
<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','viewProject')"><?php echo $row->subject; ?></a></td>
<td align="center">
	    			<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? "unpublish" : "publish";?>')">
					<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</a>
</td>
<td align="left"><?php echo ($row->name) ? $row->name." [".$row->username."] " : ''; ?>&nbsp;</td>
<td align="center"><?php echo $startdate; ?>&nbsp;</td>
<td align="center"><?php echo $enddate; ?>&nbsp;</td>
<td align='left'><?php echo ($row->ownername) ? $row->ownername." [".$row->owner."] " : '' ; ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='row1'>
           		<td colspan='8' align="center"><strong>No Projects Available</strong>&nbsp;&nbsp;<a href='index2.php?option=com_jprojects&task=newProject'><?php echo _CREATE_ONE_NOW; ?></a></td>
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

<input type="hidden" name="returntask" value="listProjects" />
<input type="hidden" name="type" value="projects" />
<input type="hidden" name="option" value="com_jprojects" />
<input type="hidden" name="task" value="listProjects" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 


<?
}
}

class HTML_calendar {
function viewCalendar($calendar, $tasks) {
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	
		$js = "
		function jProjectsTask() {
			window.location.reload(true);
			document.getElementById('sbox-window').close();
		}
		";

	$doc->addScriptDeclaration($js);

		JHTML::_('behavior.modal', 'a.modal');
		$editLink = 'index.php?option=com_jprojects&amp;task=editTask&amp;tmpl=component&amp;calendar=1';
		$viewLink = 'index.php?option=com_jprojects&amp;task=viewTask&amp;tmpl=component&amp;calendar=1';			

?>
<form action="index2.php" name="adminForm" method="post">
<input type="hidden" name="option" value="com_jprojects" />
<input type="hidden" name="task" value="" />
</form>
	<table class="calendarTable" cellpadding="3" cellspacing="0">
		<tr class="tableListHeader">
            <td><?php echo $calendar['prevLink']; ?></td>
            <td colspan="5">
                <?php echo $calendar['monthname'] . " " .  $calendar['year']; ?>
            </td>
            <td><?php echo $calendar['nextLink']; ?></td>
		</tr>
		<tr>
            <td class="calendarHeaders"><?php echo _SUNDAY; ?></td>
            <td class="calendarHeaders"><?php echo _MONDAY; ?></td>
            <td class="calendarHeaders"><?php echo _TUESDAY; ?></td>
            <td class="calendarHeaders"><?php echo _WEDNESDAY; ?></td>
            <td class="calendarHeaders"><?php echo _THURSDAY; ?></td>
            <td class="calendarHeaders"><?php echo _FRIDAY; ?></td>
            <td class="calendarHeaders"><?php echo _SATURDAY; ?></td>
		</tr>
		<?php
			//Let's make an appropriate number of rows...
		for ($k = 1; $k <= $calendar['numrows']; $k++){
			echo "<tr height='100'>";
			//Use 7 columns (for 7 days)...
				for ($i = 0; $i < 7; $i++){
					$calendar['startdate']++;
					$count = 0;
					if (($calendar['startdate'] <= 0) || ($calendar['startdate'] > $calendar['lastday'])){
						//If we have a blank day in the calendar.
						?><td class="blankCell">&nbsp;</td><?php
					} else {
										
						if ($calendar['startdate'] == date("j") && $calendar['month'] == date("n") && $calendar['year'] == date("Y")){
						$date = $calendar['year']."-".$calendar['month']."-".date("j");
							?><td class="todayCell" valign="top">
							<table width='100%' border="0">
	                            <tr><td style="border:0px;">
<a href="index2.php?option=com_jprojects&task=calendarDayView&date=<?php echo $date;?>"><?php echo date ("j"); ?></a>
                                </td><td align="right" width='10' style="border: 0px;"><a class="modal" href="<?php echo $editLink; ?>&amp;startdate=<?php echo $date; ?>" rel="{handler: 'iframe', size: {x: 760, y: 600}}">[+]</a></td></tr>
							<?php 
							if ($tasks) {
							foreach($tasks as $t) { 
											if (date("j", strtotime($t->startdate)) == $calendar['startdate']) {
												echo "<tr><td style='border: 0px;' colspan='2'><a class='modal' href='".$viewLink."&amp;cid[]=".$t->id."' rel=\"{handler: 'iframe', size: {x: 760, y: 600}}\">".$t->subject."</a></td></tr>"; 
											}
										} 
									} ?>
                              </table>
							<?php } else {
							$date = $calendar['year']."-".$calendar['month']."-".$calendar['startdate'];
							?><td class="dateCell" valign="top">
								<table width='100%' border="0">
                                	<tr><td style='border: 0px;'>
<a href="index2.php?option=com_jprojects&task=calendarDayView&date=<?php echo $date;?>"><?php echo $calendar['startdate']; ?></a>
</td><td align="right" width='10' style="border: 0px;">			<a class="modal" href="<?php echo $editLink; ?>&amp;startdate=<?php echo $date; ?>" rel="{handler: 'iframe', size: {x: 760, y: 600}}">[+]</a></td></tr>
										<?php if ($tasks) { 
											foreach($tasks as $t) { 
											if (date("j", strtotime($t->startdate)) == $calendar['startdate'] && $count < 3) {
												echo "<tr><td style='border: 0px;' colspan='2'><a class='modal' href='".$viewLink."&amp;cid[]=".$t->id."' rel=\"{handler: 'iframe', size: {x: 760, y: 600}}\">".$t->subject."</a></td></tr>"; 	
												echo "</td></tr>"; 
												$count++;
											}
										} 
										}
                                		if ($count==3) { ?>
<tr><td align="right" style="border: 0px;"><a href="index2.php?option=com_jprojects&task=calendarDayView&date=<?php echo $calendar['year'];?>-<?php echo $calendar['month'];?>-<?php echo $calendar['startdate'];?>">Show All...</a></td></tr>
										<?php } ?>
                               </table>
                              </td><?php
						}
					}
				}
			echo "</tr>";
		} ?>				
	</table>
<?php }


function viewCalendarDay($option, $calendar, $tasks) { 
global $jfConfig;
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	
		$js = "
		function jProjectsTask() {
			window.location.reload(true);
			document.getElementById('sbox-window').close();
		}
		
		function toggleQuickadd(i) {
			var div = document.getElementById(\"quickadd\"+i);
			if (div.style.display == \"none\") {
				div.style.display = \"block\";
			} else {
				div.style.display = \"none\";
			}
		}
		";

	$doc->addScriptDeclaration($js);

		JHTML::_('behavior.modal', 'a.modal');
		$editLink = 'index.php?option=com_jprojects&amp;task=editTask&amp;tmpl=component&amp;calendar=1';
		$viewLink = 'index.php?option=com_jprojects&amp;task=viewTask&amp;tmpl=component&amp;calendar=1';			

?>
<form action="index2.php" name="adminForm" method="post">
<input type="hidden" name="option" value="com_jprojects" />
<input type="hidden" name="task" value="" />
</form>
	<table class="calendarDayTable" cellpadding="3" cellspacing="0">
		<tr class="tableListHeader">
        	<td width="100"><?php echo $calendar['prevLink']; ?></td>
			<td><?php echo date("l | F j, Y",strtotime($calendar['date'])); ?></td>
        	<td width="100"><?php echo $calendar['nextLink']; ?></td>
		</tr>
<?php
	$k = 0;
	$html = array();
	for($i=0; $i<24; $i++) { 
		if ($jfConfig['calendar_day']==0 && ($i < 8 || $i > 17)) {  
			continue;
		}
		$datetime = date("Y-m-d H:i:s", strtotime($calendar['date']." ".$i.":00"));
    	$time = ($i > 12) ? ($i-12) : $i;
		$meridian = ($i > 11) ? ":00 PM" : ":00 AM";
		$class = ($i < 8 || $i > 17) ? "gray" : "row".$k." large";
		foreach ($tasks as $task) {
		$t = date("G",strtotime($task->startdate));
			if ($t == $i) {
				$html[$i][] = "<table class='eventDay' onclick=\"editTask('$task->id', '0')\"><tr><td>";
				$html[$i][] = date("g:i A", strtotime($task->startdate));
				$html[$i][] = "</td></tr><tr><td><a class='modal' href='".$viewLink."&amp;cid[]=".$task->id."' rel=\"{handler: 'iframe', size: {x: 760, y: 600}}\">";
				$html[$i][] = $task->subject;
				$html[$i][] = "</a></td></tr></table>";
			}
		}	
	?>
		<tr class='<?php echo $class; ?>' onmouseover="toggleQuickadd('<?php echo $i;?>');" onmouseout="toggleQuickadd('<?php echo $i;?>');">
			<td class='hours' align="center">
				<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
					<tr>
						<td height="25" align="center" valign="bottom"><?php echo ($time==0) ? "12".$meridian : $time.$meridian; ?></td>
                    </tr>
                    <tr>
                        <td align="center" height="15" valign="bottom"><span id="quickadd<?php echo $i;?>" style="display:none;"><a class="modal" href="<?php echo $editLink; ?>&amp;startdate=<?php echo $datetime; ?>" rel="{handler: 'iframe', size: {x: 760, y: 600}}">Add New</a></span></td>
                    </tr>
                </table>           
            <td class='hours' colspan="2">
			<?php 
			if (array_key_exists($i, $html)) {
				foreach ($html[$i] as $h) {
					echo $h;
				}
			} else {
				echo "&nbsp;";
			}
			?>
            </td>
		</tr>
<?php
		$k = 1-$k;
		
	}

?>
	</table>
<?php }
# End Calendar Class	
}


// Task Functions
class HTML_tasks {

function viewTask($option, &$row, &$manager, &$assignedto, &$project, &$pop) {
	$database = & JFactory::getDBO();
	$user = & JFactory::getUser();
	$assigned = $assignedto[1] ? $assignedto[1]." [".$assignedto[2]."]" : '';
	$man = $manager[1] ? $manager[1]." [".$manager[2]."]" : '';
	$startdate = $row->startdate ? date("Y-m-d g:i A", strtotime($row->startdate)) : '';
	$completiondate = $row->completiondate ? date("Y-m-d g:i A", strtotime($row->completiondate)) : ''; 
	?>
<script type='text/javascript'>
function submitbutton(pressbutton) {
	if (pressbutton == 'listTasks') {
	<?php if($pop) { ?>window.parent.document.getElementById('sbox-window').close();<?php } ?>
		submitform( pressbutton );
		return;
	}
			if (pressbutton == 'startTimer') {
				startTimer('<?php echo $row->id; ?>','<?php echo $row->projectid; ?>');
				return;
			} else {
				submitform(pressbutton);
			}
		}
</script>

<form action="index2.php" method="post" name="adminForm">
<?php if($pop) { ?>
<table class="toolbar" width="100%"><tr><td width='100%'>&nbsp;</td>
<td class="button" id="toolbar-cancel" align='right'>
<a href="#" onclick="javascript: submitbutton('listTasks')" class="toolbar">
<span class="icon-32-cancel" title="Close"></span><?php echo _CLOSE; ?></a></td>
<td class="button" id="toolbar-edit" align='right'>
<a href="#" onclick="javascript: submitbutton('editTask')" class="toolbar">
<span class="icon-32-edit" title="Edit">
</span><?php echo _EDIT; ?></a></td></tr></table>
<?php } ?>
        <input type='hidden' name='projectid' value='<?php echo $row->projectid; ?>'  />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
<?php if($pop) { ?>
<input type='hidden' name='popedit' value='<?php echo JRequest::getVar('popedit'); ?>'  />
<input type='hidden' name='tmpl' value='component' />
<?php } ?>
</form> 
	</form> 

    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
		<tr>
        	<td class='headerQuotes' align="left" colspan="4">Task Details</td>
        </tr>
        <tr>
			<td width="150px" align="right" class='fieldName'><?php echo _TASK_NAME; ?></td>
		  	<td width="300px"><?php echo $row->subject; ?></td>
			<td width="150px" align="right" class='fieldName'><?php echo _ASSIGNED_TO; ?></td>
         	<td><?php echo $assigned; ?>&nbsp;</td>
		</tr>
        <tr>
    	    <td align="right" class='fieldName'><?php echo _TASK_STAGE; ?></td>
		    <td><?php echo $row->stage; ?></td>	 
			<td align="right" class='fieldName'>Project</td>
          	<td><?php echo $project; ?>&nbsp;</td>                 	
        </tr>
		<tr>
	        <td align="right" class='fieldName'><?php echo _PRIORITY; ?></td>
        	<td><?php echo $row->priority; ?>&nbsp;</td>    
			<td align="right" class='fieldName'><?php echo _MANAGER; ?></td>
      		<td><?php echo $man; ?>&nbsp;</td> 
		<tr>
        <tr>
    	    <td align="right" class='fieldName'><?php echo _START_DATE; ?></td>
		    <td><?php echo $startdate; ?></td>
			<td align="right" class='fieldName'><?php echo _PUBLISHED; ?>:</td>
		    <td><?php echo $row->published == 1 ? 'Yes' : 'No'; ?></td>	        
		<tr>
			<td align="right" class='fieldName'><?php echo _DUE_DATE; ?></td>
        	<td><?php echo $completiondate; ?>&nbsp;</td>    			
            <td class='fieldName'>&nbsp;</td>
            <td class='fieldValue'>&nbsp;</td>
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='4' class='headerQuotes' align="left">Task <?php echo _DESCRIPTION; ?></td></tr>
        <tr>
        	<td class='fieldName'><?php echo _DESCRIPTION; ?></td>
        	<td colspan='3' class='fieldValue'><?php echo $row->description; ?></td>
        </tr>
  </table>

<? 
}

function editTask($option, &$row, &$managers, &$stages, &$assignedto, &$priority, &$project, &$start_time, &$due_time, &$pop) {
	JRequest::setVar( 'hidemainmenu', 1 );
	$projectName = JRequest::getVar('projectname');
	$projectId = JRequest::getVar('projectid');
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	$editor =& JFactory::getEditor();	
	$user =& JFactory::getUser();
	
		$js = "
		function jProjectsProject(id, name) {
			document.getElementById('projectid').value = id;
			document.getElementById('projectname').value = name;
		    document.getElementById('project_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}

		window.addEvent('domready', function() {  myCal = new Calendar({ startdate: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });
		window.addEvent('domready', function() {  myCal2 = new Calendar({ completiondate: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });		
		";

	$doc->addScriptDeclaration($js);

	global $jfConfig;

		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal');
		
		$link = 'index.php?option=com_jprojects&amp;task=projectPopup&amp;tmpl=component';	

	
	if($_REQUEST['startdate']!= '') { $row->startdate=$_REQUEST['startdate']; }
		$nullDate 		= $database->getNullDate();
		$create_date 	= null;

		if ( $row->created != $nullDate ) {
			$create_date 	= JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC2'));
		}
		$mod_date = null;
		if ( $row->modified != $nullDate ) {
			$mod_date 		= JHTML::_('date',  $row->modified, JText::_('DATE_FORMAT_LC2'));
		}

	$complete_date = ($row->completiondate) ? date("Y-m-d", strtotime($row->completiondate)) : '';
	$start_date = ($row->startdate) ? date("Y-m-d", strtotime($row->startdate)) : '';
	?>
<script type="text/javascript">
<!--
function submitbutton(pressbutton) {
	var form = document.adminForm;

	if (pressbutton == 'listTasks') {
	<?php if($pop) { ?>window.parent.document.getElementById('sbox-window').close();<?php } ?>
		submitform( pressbutton );
		return;
	}

	// do field validation
	if (form.subject.value == "") {
		alert("Task must have a title.");
	} else if (form.projectid.value == "" || form.projectid.value == '0'){
		alert( "Task must be assigned to a project." );
	} else {
		submitform( pressbutton );
	}
}

//-->
</script>
<form action="index2.php" method="post" name="adminForm">
<?php if($pop) { ?>
<table class="toolbar" width="100%"><tr><td width='100%'>&nbsp;</td>
<td class="button" id="toolbar-cancel" align='right'>
<a href="#" onclick="javascript: submitbutton('listTasks')" class="toolbar">
<span class="icon-32-cancel" title="Close"></span><?php echo _CLOSE; ?></a></td>
<td class="button" id="toolbar-save" align='right'>
<a href="#" onclick="javascript: submitbutton('saveTask')" class="toolbar">
<span class="icon-32-save" title="Save">
</span><?php echo _SAVE; ?></a></td></tr></table>
<?php } ?>
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
<tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _TASK_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150px" align="right" class='<?php echo $row->subject ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id='subject_label'><?php echo _TASK_NAME; ?></td>
		    <td width="300px" class='fieldValue'><input type="text" name="subject" id="subject" value="<?php echo $row->subject; ?>" size="40" onchange="checkElement('subject');" /></td>
			<td width="150px" align='right' class='fieldName'><?php echo _ASSIGNED_TO; ?></td>
            <td><?php echo $assignedto['assignedto']; ?>&nbsp;</td>
		</tr>
        <tr>
	        <td align="right" class='fieldName'><?php echo _TASK_STAGE; ?></td>
            <td class='fieldValue'><?php echo $stages['stages']; ?>&nbsp; </td>        
			<?php if($projectName && $projectId) { ?>
            <td align="right" class='fieldNameRequiredActive' id="project_label"><?php echo _PROJECT; ?></td>
            <td class='fieldValue'>
			<input type='hidden' name='projectid' value='<?php echo $projectId; ?>'>
			<input type='text' name='projectname' value='<?php echo $projectName; ?>' readonly='readonly' />
			<?php } else {  ?>
            <td align="right" class='<?php echo $row->projectid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="project_label">Project</td>
            <td class='fieldValue'>
			<input type='hidden' name='projectid' id='projectid' value='<?php echo $row->projectid;?>' />
			<input type='text' name='projectname' id='projectname' value="<?php echo $row->id ? $project : "" ; ?>" readonly="readonly" />
			<a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jprojects/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a>
			<?php } ?>
			</td>
        </tr>
		<tr>
	        <td align="right" class='fieldName'><?php echo _PRIORITY; ?></td>
            <td class='fieldValue'><?php echo $priority['priority']; ?>&nbsp; </td>            
            <td align="right" class='fieldName'><?php echo _MANAGER; ?></td>
            <td class='fieldValue'><?php echo $managers['managers']; ?>&nbsp;</td>
		<tr>
    	    <td width="150px" align="right" class='fieldName'><?php echo _START_DATE; ?></td>
  			<td class='fieldValue' valign="middle"><?php echo $start_time;?>&nbsp;<input class="calendar" type="text" name="startdate" id="startdate" onchange="checkElement('startdate');" value="<?php echo $start_date; ?>" /></td>
			<td align="right" class='fieldName'><?php echo _PUBLISHED; ?></td>
		    <td class='fieldValue'>
			<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?></td>
		<tr>
	        <td width="150px" align="right" class='fieldName'><?php echo _DUE_DATE; ?></td>
  			<td class='fieldValue' valign="middle"><?php echo $due_time; ?>&nbsp;<input class="calendar" type="text" name="completiondate" id="completiondate" onchange="checkElement('completiondate');" value="<?php echo $complete_date; ?>" /></td>
            <td class='fieldName'>&nbsp;</td>
            <td>&nbsp;</td>
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr align='left'><td colspan='4' class='headerQuotes'>Task <?php echo _DESCRIPTION; ?></td></tr>
        <tr>
        	<td class='fieldName' valign="top"><?php echo _DESCRIPTION; ?></td>
            <td colspan='3'><?php echo $editor->display( 'description', $row->description, '100%', '245', '55', '20' ) ; ?></td>
        </tr>
  </table>
        
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
<?php if($pop) { ?>
<input type='hidden' name='popedit' value='<?php echo JRequest::getVar('popedit'); ?>'  />
<input type='hidden' name='tmpl' value='component' />
<?php } ?>
</form> 
<? 
}
function listTasks ($option, &$rows, $pageNav) {
		global $acl, $mosConfig_offset;
		$database = & JFactory::getDBO();
		$user =& JFactory::getUser();
		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal');
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteTask') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteTask');
				}
			} else if (pressbutton =='editTask') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editTask');
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
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort:2">
	<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width='50' class="table-sortable:numeric table-sortable"><?php echo _JID; ?></th>
<th align="left" class="table-sortable:default table-sortable"><?php echo _TASK_NAME; ?></th>
<th width="100"><?php echo _PUBLISHED; ?></th>
<th width='100' align="left" class="table-sortable:default table-sortable">Project</th>
<th width="100"><?php echo _STAGE; ?></th><th width="100"><?php echo _PRIORITY; ?></th>
<th width='75' align="center" class="table-sortable:numeric table-sortable"><?php echo _START_DATE; ?></th>
<th width='75' align="center" class="table-sortable:numeric table-sortable"><?php echo _DUE_DATE; ?></th>
<th width='100' align='center' class="table-sortable:default table-sortable"><?php echo _ASSIGNED_TO; ?></th>
</tr>
</thead>
<tbody>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];

if ($row->published == '1' ) {
			// <?php echo _PUBLISHED; 
				$img = 'publish_g.png';
				$alt = _PUBLISHED;
			} else {
			// <?php echo _UNPUBLISHED; 
				$img = 'publish_x.png';
				$alt = _UNPUBLISHED;
			}

			$startdate = JHTML::_('date',  $row->startdate, JText::_('DATE_FORMAT_LC4'));
			$completiondate = JHTML::_('date',  $row->completiondate, JText::_('DATE_FORMAT_LC4'));			
?>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?></td>
<td><a href="#view" onclick="return listItemTask('cb<?php echo $i;?>','viewTask')"><?php echo $row->subject; ?></a></td>
<td align="center">	
    				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? "unpublish" : "publish";?>')">
					<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</a>
</td>
<td><?php echo $row->projectname; ?></td>
<td align="center"><?php echo $row->stage; ?></td>
<td align="center"><?php echo $row->priority; ?></td>
<td align='center'><?php echo $startdate; ?></td>
<td align="center"><?php echo $completiondate; ?></td>
<td align='center'><?php echo $row->assignedto; ?></td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='row1'>
           		<td colspan='10' align="center"><strong>No Tasks Available</strong>&nbsp;&nbsp;<a href='index2.php?option=com_jprojects&task=newTask'><?php echo _CREATE_ONE_NOW; ?></a></td>
           </tr>
           <?php } ?>
  </tbody>
<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
</table>

<input type="hidden" name="type" value="tasks" />
<input type="hidden" name="returntask" value="listTasks" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="listTasks" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?
}
}
class HTML_times {

function listTimes ($option, &$rows, &$pageNav) {
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteTime') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteTime');
				}
			} else if (pressbutton =='editTime') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editTime');
				}				
			} else {
				submitform(pressbutton);
			}
		}
		</script>
<form action="index2.php" method="post" name="adminForm">
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort:2">
	<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th class="title" align="left" class="table-sortable:default table-sortable" width='250'><?php echo _JUSER; ?></th>
<th class='title' align="left" class="table-sortable:default table-sortable"><?php echo _PROJECT; ?></th>
<th class='title' align="left" class="table-sortable:default table-sortable"><?php echo _TASK; ?></th>
<th class='title' align="left" class="table-sortable:numeric table-sortable" width='150'><?php echo _START_TIME; ?></th>
<th class='title' align="left" class="table-sortable:numeric table-sortable" width='150'><?php echo _END_TIME; ?></th>
</tr>
</thead>
<tbody>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
$starttime = ($row->starttime) ? date("g:i A | F d, Y", strtotime($row->starttime)) : '';
$completiontime = ($row->completiontime) ? date("g:i A | F d, Y", strtotime($row->completiontime)) : '';
?>
<tr class="<?php echo "row$k"; ?>">
<td valign="top"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
<td valign="top"><a href="#view" onclick="return listItemTask('cb<?php echo $i;?>','viewTime')"><?php echo $row->name." [".$row->username."]"; ?></a></td>
<td valign="top"><?php echo $row->projectname; ?></td><td><?php echo $row->taskname; ?></td><td><?php echo $starttime; ?></td><td><?php echo $completiontime; ?></td>
<?php $k = 1 - $k; ?>
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

<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
<?
}
function editTime($option, &$row, &$project, &$task, $username, $starttime, $endtime) {
	JRequest::setVar( 'hidemainmenu', 1 );
	
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	$editor =& JFactory::getEditor();	
	$user =& JFactory::getUser();
	
		$js = "
		function jProjectsProject(id, name) {
			document.getElementById('projectid').value = id;
			document.getElementById('projectname').value = name;
		    document.getElementById('project_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}

		function jProjectsClient(id, name, username) {
			title = name+\" [\"+username+\"]\";
			document.getElementById('contactid').value = id;
			document.getElementById('contactname').value = title;
		    document.getElementById('client_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}
		
		function jProjectsTask(id, name) {
			document.getElementById('taskid').value = id;
			document.getElementById('taskname').value = name;
		    document.getElementById('task_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}				
		window.addEvent('domready', function() {  myCal = new Calendar({ starttime: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });
		window.addEvent('domready', function() {  myCal2 = new Calendar({ completiontime: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });		
		";

	$doc->addScriptDeclaration($js);

	global $jfConfig;

		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal');
		
		$projectLink = 'index.php?option=com_jprojects&amp;task=projectPopup&amp;tmpl=component';
		$clientLink = 'index.php?option=com_jprojects&amp;task=clientPopup&amp;tmpl=component';			
		$taskLink = 'index.php?option=com_jprojects&amp;task=taskPopup&amp;tmpl=component';

		$nullDate 		= $database->getNullDate();
		$create_date 	= null;

		if ( $row->created != $nullDate ) {
			$create_date 	= JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC2'));
		}
		$mod_date = null;
		if ( $row->modified != $nullDate ) {
			$mod_date 		= JHTML::_('date',  $row->modified, JText::_('DATE_FORMAT_LC2'));
		}

	
		$end_time = ($row->completiontime) ? date("Y-m-d", strtotime($row->completiontime)) : '';
		$start_time = ($row->starttime) ? date("Y-m-d", strtotime($row->starttime)) : '';

?>
<script type="text/javascript">
<!--

		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if (pressbutton == 'listTimes') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (form.user.value == ""){
				alert( "Please specify a user." );
			} else if (form.projectid.value == ""){
				alert( "Please specify a project." );
			} else if (form.taskid.value == ""){
				alert( "Please specify a task." );
			} else {
				submitform( pressbutton );
			}
		}

//-->
</script>
    <form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4">Time Details</td>
        </tr>
        <tr>
			<td width="150" class='<?php echo $row->user ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="client_label">User</td>
			<td class='fieldValue'>
				<input type='hidden' name='user' id='contactid' value='<?php echo $row->user;?>' />
				<input type='text' name='contactname' id='contactname' value="<?php echo $username; ?>" readonly="readonly" />
				<a class="modal" href="<?php echo $clientLink; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jprojects/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a></td>
		</tr>
        <tr>
			<td align="right" class='<?php echo $row->projectid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="project_label">Project</td>
            <td class='fieldValue'><input type='hidden' name='projectid' id='projectid' value='<?php echo $row->projectid;?>' /><input type='text' name='projectname' id='projectname' value="<?php echo $row->id ? $project : "" ; ?>" readonly="readonly" /><a class="modal" href="<?php echo $projectLink; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jprojects/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a></td>
		</tr>
        <tr>
			<td align="right" class='<?php echo $row->taskid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="task_label">Task</td>
            <td class='fieldValue'><input type='hidden' name='taskid' id='taskid' value='<?php echo $row->taskid;?>' /><input type='text' name='taskname' id='taskname' value="<?php echo $row->id ? $task : "" ; ?>" readonly="readonly" /><a class="modal" href="<?php echo $taskLink; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jprojects/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a></td>
		</tr>	
        <tr>
    	    <td width="150px" align="right" class='fieldName'><?php echo _START_TIME; ?></td>
  			<td class='fieldValue'>
  				<?php echo $starttime; ?>&nbsp;
				<input class="calendar" type="text" name="starttime" id="starttime" onchange="checkElement('starttime');" value="<?php echo $start_time; ?>" />
			</td>
		<tr>
	        <td width="150px" align="right" class='fieldName'><?php echo _END_TIME; ?></td>
  			<td class='fieldValue'>
  				<?php echo $endtime; ?>&nbsp;
				<input class="calendar" type="text" name="completiontime" id="completiontime" onchange="checkElement('completiontime');" value="<?php echo $end_time; ?>" />
			</td>
		</tr>
    </table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<? 
}
function viewTime($option, &$row, &$project, &$task, &$user) {
   global $database;
   $starttime = ($row->starttime) ? date("g:i A | F d, Y", strtotime($row->starttime)) : '';
   $completiontime = ($row->completiontime) ? date("g:i A | F d, Y", strtotime($row->completiontime)) : '';
?>
    <form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<th class='headerQuotes' align="left" colspan="4"><?php echo _TIME_DETAILS; ?></th>
        </tr>
        <tr>
			<td width="150" class='fieldName'><?php echo _USER; ?></td>
			<td class='fieldValue'><?php echo $user; ?></td>
		</tr>
        <tr>
        	<td class='fieldName'><?php echo _PROJECT; ?></td>
			<td class='fieldValue'><?php echo $project; ?></td>
        </tr>
        <tr>
        	<td class='fieldName'><?php echo _TASK; ?></td>
			<td class='fieldValue'><?php echo $task; ?></td>
        </tr>
        <tr>
        	<td class='fieldName'><?php echo _START_TIME; ?></td>
			<td class='fieldValue'><?php echo $starttime; ?></td>
        </tr>
        <tr>
        	<td class='fieldName'><?php echo _END_TIME; ?></td>
			<td class='fieldValue'><?php echo $completiontime; ?></td>
        </tr>
    </table>
   <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form>
<? 
}

}
class HTML_files {

function listFiles ($option, &$rows, &$pageNav) {
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteFile') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteFile');
				}
			} else if (pressbutton =='editFile') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editFile');
				}				
			} else {
				submitform(pressbutton);
			}
		}
		</script>
<form action="index2.php" method="post" name="adminForm">
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable table-autosort:2">
	<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th width='50' align='center' class="table-sortable:numeric table-sortable"><?php echo _JID; ?></th>
<th align="left" width='200' class="table-sortable:default table-sortable"><?php echo _FILE_NAME; ?></th>
<th align='left' class="table-sortable:default table-sortable"><?php echo _FILE_DESCRIPTION; ?></th>
<th align="left" class="table-sortable:default table-sortable"><?php echo _FILE; ?></th>
<th align='left' class="table-sortable:default table-sortable"><?php echo _PROJECT; ?></th>
<th align="center" width='150' class="table-sortable:numeric table-sortable"><?php echo _DATE_ADDED; ?></th>
</tr>
</thead>
<tbody>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
$date = date("m/d/Y", strtotime($row->dateadded));
?>
<tr class="<?php echo "row$k"; ?>">
<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
<td align="center"><?php echo $row->id; ?></td>
<td><a href="#view" onclick="return listItemTask('cb<?php echo $i;?>','viewFile')"><?php echo $row->filename; ?></a></td>
<td><?php echo substr($row->description,0,200); ?></td>
<td><?php echo $row->filelocation; ?></td>
<td><?php echo $row->projectname; ?></td>
<td align="center"><?php echo $date; ?></td>
<?php $k = 1 - $k; ?>
</tr>
<?php } ?>
</tbody>
<tfoot>
			<tr>
				<td colspan="7">
					<?php echo $pageNav->getListFooter(); ?>
				</td>
			</tr>
			</tfoot>
</table>

<input type="hidden" name="returntask" value="listFiles" />
<input type="hidden" name="type" value="files" />
<input type="hidden" name="option" value="com_jprojects" />
<input type="hidden" name="task" value="listFiles" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form>
<?
}
function editFile($option, &$row, &$project, &$pop) {
	$doc 	  =& JFactory::getDocument();
	$database =& JFactory::getDBO();
	$user     =& JFactory::getUser();
	$editor   =& JFactory::getEditor();
	$projectName = JRequest::getVar('projectname');
	$projectId = JRequest::getVar('projectid');
	
		jimport('joomla.utilities.date');
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal');
		
		$js = "
		function jProjectsProject(id, name) {
			document.getElementById('projectid').value = id;
			document.getElementById('projectname').value = name;
		    document.getElementById('project_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}
		";

	$doc->addScriptDeclaration($js);

	
		$nullDate 		= $database->getNullDate();
		$create_date 	= null;
		$link = 'index.php?option=com_jprojects&amp;task=projectPopup&amp;tmpl=component';

?>
<script type="text/javascript">
<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if (pressbutton == 'listFiles') {
	<?php if($pop) { ?>window.parent.document.getElementById('sbox-window').close();<?php } ?>
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (form.name.value == ""){
				alert( "File must have a name" );
			} else if (form.projectid.value == ""){
				alert( "You must specify a project." );
			} else {
				submitform( pressbutton );
			}
		}

//-->
</script>
    <form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">
 <?php if($pop) { ?>
<table class="toolbar" width="100%"><tr><td width='100%'>&nbsp;</td>
<td class="button" id="toolbar-cancel" align='right'>
<a href="#" onclick="javascript: submitbutton('listFiles')" class="toolbar">
<span class="icon-32-cancel" title="Close"></span><?php echo _CLOSE; ?></a></td>
<td class="button" id="toolbar-save" align='right'>
<a href="#" onclick="javascript: submitbutton('saveFile')" class="toolbar">
<span class="icon-32-save" title="Save">
</span><?php echo _SAVE; ?></a></td></tr></table>
<?php } ?>
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _FILE_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150" class='<?php echo $row->filename ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="filename_label"><?php echo _FILE_NAME; ?></td>
			<td><input type="text_area" size="35" name="filename" value="<?php echo $row->filename; ?>" onchange="checkElement('filename');"></td>
		</tr>
        <tr>
            <?php if ($row->projectid) { ?>
				<td align="right" class='<?php echo $row->projectid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="project_label"><?php echo _PROJECT; ?></td>
            	<td class='fieldValue'>
			<?php
            	echo $project;
				echo "<input type='hidden' name='projectid' id='projectid' value='".$row->projectid."' >";
			} else { ?>	
			<?php if($projectName && $projectId) { ?>
           		<td align="right" class='fieldNameRequiredActive' id="project_label"><?php echo _PROJECT; ?></td>
           		<td class='fieldValue'>
				<input type='hidden' name='projectid' value='<?php echo $projectId; ?>'>
				<input type='text' name='projectname' value='<?php echo $projectName; ?>' readonly='readonly' />
			<?php } else {  ?>
            	<td align="right" class='<?php echo $row->projectid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="project_label"><?php echo _PROJECT; ?></td>
            	<td class='fieldValue'>
				<input type='hidden' name='projectid' id='projectid' value='<?php echo $row->projectid;?>' />
				<input type='text' name='projectname' id='projectname' value="<?php echo $row->id ? $project : "" ; ?>" readonly="readonly" />
				<a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jprojects/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a>
			<?php } ?>
			<?php } ?>
		</tr>
        <tr>
			<td align="right" class='<?php echo $row->filelocation ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>' id="filelocation_label"><?php echo _FILE; ?></td>
            <td class='fieldValue'>
            <?php if($row->filelocation) { 
				echo $row->filelocation;
				echo "<input type='hidden' name='filelocation' id='filelocation' value='".$row->filelocation."' >";
			} else {?>
				<input type='file' name='filelocation' id='filelocation' value="<?php echo $row->filelocation; ?>" onchange="checkElement('filelocation');"/>
			<?php } ?>
			</td>
		</tr>
        <tr>
          <td class='fieldName' valign='top'><?php echo _DESCRIPTION; ?></td>
          <td colspan='3' align="left" class='fieldValue'><?php echo $editor->display( 'description', $row->description, '50%', '200', '55', '20' ) ; ?></td>
        </tr>	
    </table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
<?php if($pop) { ?>
<input type='hidden' name='popedit' value='<?php echo JRequest::getVar('popedit'); ?>'  />
<input type='hidden' name='tmpl' value='component' />
<?php } ?>
</form> 
<? 
}
function viewFile($option, &$row, &$project) {
   $database = & JFactory::getDBO();
   $date = date("m/d/Y", strtotime($row->dateadded));
?>
    <form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<th class='headerQuotes' align="left" colspan="4"><?php echo _FILE_DETAILS; ?></th>
        </tr>
        <tr>
			<td width="150" class='fieldName'><?php echo _JNAME; ?></td>
			<td class='fieldValue'><?php echo $row->filename; ?></td>
		</tr>
        <tr>
        	<td class='fieldName'><?php echo _PROJECT; ?></td>
			<td class='fieldValue'><?php echo $project; ?></td>
        </tr>
        <tr>
        	<td class='fieldName'><?php echo _FILE; ?></td>
			<td class='fieldValue'><?php echo $row->filelocation ?></td>
        </tr>
        <tr>
        	<td class='fieldName'><?php echo _DATE_ADDED; ?></td>
			<td class='fieldValue'><?php echo $date; ?></td>
        </tr>
        <tr>
        	<td class='fieldName'><?php echo _DESCRIPTION; ?></td>
        	<td colspan='3' class='fieldValue'><?php echo $row->description; ?></td>
        </tr>
    </table>
   <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form>
<?php 
}

}
?>