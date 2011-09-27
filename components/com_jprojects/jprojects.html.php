<?php
defined('_JEXEC') or die('Restricted access');

class HTML_JPROJECTS {
	
function myProjects($option, &$rows, &$pageNav) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

$label = ($user->get('gid')=="25") ? _CLIENT : _MANAGER;

?>
<div class="contentheading"><?php echo _MY_PROJECTS; ?></div>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable" style="text-align:left;">
<tr class='sectiontableheader'>
	<th class="title" width="25" align="center"><?php echo _JID; ?></th>
    <th class="title"><?php echo _JNAME; ?></th>
    <th class="title" width="125" align="center"><?php echo _START_DATE; ?></th>
    <th class='title' width="125" align="center"><?php echo _END_DATE; ?></th>
    <th class="title" width="150"><?php echo $label;?></th>
</tr>
<?php
$k = 0;
$j=1;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
if ($user->get('gid')=="25") {
	$name = ($row->name) ? $row->name." [".$row->username."]" : '';
	$email = $row->email;
} else {
	$name = ($row->ownername) ? $row->ownername." [".$row->owner."]" : '' ;
	$email = $row->owneremail;
}
$startdate = ($row->startdate) ? date("m/d/Y", strtotime($row->startdate)) : '';
$completiondate = ($row->completiondate) ? date("m/d/Y", strtotime($row->completiondate)) : '';
?>
<tr class="<?php echo "sectiontableentry$j"; ?>"">
<td align="center"><?php echo $row->id; ?></td>
<td align="left"><a href="index.php?option=com_jprojects&task=viewProject&id=<?php echo $row->id;?>"><?php echo $row->subject; ?></a></td>
<td align="center"><?php echo $startdate; ?>&nbsp;</td>
<td align="center"><?php echo $completiondate; ?>&nbsp;</td>
<td align='left'><?php echo "<a href='mailto:".$email."'>".$name."</a>"; ?>&nbsp;</td>
<?php 
$k = 1 - $k;
$j = $k + 1; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='row1'>
           		<td colspan='8' align="center"><strong>No Projects Available</strong></td>
           </tr>
           <?php } ?>
</table>
<table width="100%" cellpadding="4" style="margin: 0;" class="pageNav">
	<tr>
				<td align="center" colspan="5" style="border:none;">
				<?php
				$order = '';
				if ( $lists['order_value'] ) {
					$order = '&amp;order='. $lists['order_value'];
				}
				$filter = '';
				if ( $lists['filter'] ) {
					$filter = '&amp;filter='. $lists['filter'];
				}				$link = 'index.php?option=com_jprojects&amp;task=myProjects';
				#echo $pageNav->writePagesLinks( $link );
				?>
				</td>
			</tr>
    <tr>
        <td colspan="5" align="center" style="border:none;">
        <?php #echo $pageNav->writePagesCounter(); ?>
        </td>
	</tr>
</table>
<?php	} 

function viewProject($project, $milestones, $files, $tasks, $username, $manager) {
	$database =& JFactory::getDBO();
	JHTML::_('behavior.modal', 'a.modal');
		
	$client = $username[0] ? "<a href='mailto:".$username[2]."'>".$username[0]."[".$username[1]."]</a>" : '';
	$man = $manager[0] ? "<a href='mailto:".$manager[2]."'>".$manager[0]."[".$manager[1]."]</a>" : '';
	$startdate = ($project->startdate) ? date("F d, Y", strtotime($project->startdate)) : '';
	$completiondate = ($project->completiondate) ? date("F d, Y", strtotime($project->completiondate)) : '';
	?> 
	<div class='contentheading'><?php echo _MY_PROJECTS; ?></div>
 <table width="100%" class="backButton">
	<tr>
    	<td width="100%" align="right"><a href="javascript:history.back();" class="button"><?php echo _BACK; ?></a></td>
    </tr>
</table>
<div id="content-pane" class="pane-sliders">

<div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _PROJECT_INFORMATION; ?></span></h3>
	<div class="jpane-slider content">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
			<td width="130px" class='fieldName'><?php echo _JNAME; ?></td><td width="150px"><?php echo $project->subject; ?>&nbsp;</td>
            <td width="130px" class='fieldName'><?php echo _START_DATE; ?></td><td><?php echo $startdate; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="130px" class='fieldName'><?php echo _CLIENT; ?></td><td width="150px"><?php echo $client; ?>&nbsp;</td>
            <td width="130px" class='fieldName'><?php echo _END_DATE; ?></td><td><?php echo $completiondate; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="130px" class='fieldName'><?php echo _ACCOUNT; ?></td><td width="150px"><?php echo $project->accountid; ?>&nbsp;</td>
            <td width="130px" class='fieldName'><?php echo _MANAGER; ?></td><td><?php echo $man; ?>&nbsp;</td>
		</tr>
        <tr>
			<td width="130px" class='fieldName' valign="top"><?php echo _DESCRIPTION; ?></td><td colspan="3" valign="top"><?php echo $project->description; ?>&nbsp;</td>
		</tr>

      </table>
</div>
</div>
<?php if ($milestones) { ?>
<div class="panel">
	<h3 class="jpane-toggler title"><span><?php echo _MILESTONES; ?></span></h3>
	<div class="jpane-slider content">
	<table width="100%" cellpadding="5" cellspacing='0' class='tableView'>
		<tr class="sectiontableheader">
			<th width="100"><?php echo _JNAME; ?></th>
			<th>Description</th>
			<th width="75" align="center"><?php echo _START_DATE; ?></th>
			<th width="75" align="center"><?php echo _END_DATE; ?></th>
			<th width="65" align="center"><?php echo _COMPLETED; ?></th>
		</tr>
		<?php 
		$k = 0;
		$j=1;
		foreach ($milestones as $m) { 
		$startdate = ($m->startdate) ? date("m/d/Y", strtotime($m->startdate)) : '';
		$completiondate = ($m->completiondate) ? date("m/d/Y", strtotime($m->completiondate)) : '';
		$image = ($m->completed=='1') ? "<img src='components/com_jprojects/images/tick.png' height='16' width='16'>" : "<img src='components/com_jprojects/images/publish_x.png' height='16' width='16'>"
		?>
		<tr class="sectiontableentry<?php echo $j;?>">
			<td class="bold"><?php echo $m->name;?>&nbsp;</td>
			<td><?php echo $m->description;?>&nbsp;</td>
			<td align="center"><?php echo $startdate;?>&nbsp;</td>
			<td align="center"><?php echo $completiondate;?>&nbsp;</td>
			<td align="center"><?php echo $image;?>&nbsp;</td>
		</tr>			
		<?php 
		$k=1-$k;
		$j=$k+1;
		} ?>
     </table>
</div>
</div>
<?php } 
if ($tasks) {
?>
<div class="panel">
	<h3 class="jpane-toggler title"><span><?php echo _TASKS; ?></span></h3>
	<div class="jpane-slider content">
	<table width="100%" cellpadding="5" cellspacing='0' class='tableView'>
		<tr class="sectiontableheader">
			<th width="135"><?php echo _JNAME; ?></th>
			<th><?php echo _DESCRIPTION; ?></th>
			<th width="65" align="center"><?php echo _START_DATE; ?></th>
			<th width="105" align="center"><?php echo _END_DATE; ?></th>
			<th align="center" width="75"><?php echo _STAGE; ?></th>
		</tr>
		<?php
		$k = 0;
		$j=1;
		foreach ($tasks as $t) { 
		$startdate = ($m->startdate) ? date("m/d/Y", strtotime($m->startdate)) : '';
		$completiondate = ($m->completiondate) ? date("m/d/Y", strtotime($m->completiondate)) : '';
		?>
		<tr class="sectiontableentry<?php echo $j;?>">
			<td><?php echo "<a href='index.php?option=com_jprojects&task=viewTask&id=".$t->id."'>".$t->subject."</a>";?>&nbsp;</td>
			<td><?php echo $t->description;?>&nbsp;</td>
			<td align="center"><?php echo $startdate;?>&nbsp;</td>
			<td align="center"><?php echo $completiondate;?>&nbsp;</td>
			<td><?php echo $t->stage;?>&nbsp;</td>
		</tr>		
		<?php
		$k=1-$k;
		$j=$k+1;
		 } ?>
	</table>
</div>
</div>
<?php if ($files) { ?>
<div class="panel">
	<h3 class="jpane-toggler title"><span><?php echo _FILES; ?></span></h3>
	<div class="jpane-slider content">
	<table width="100%" cellpadding="5" cellspacing='0' class='tableView'>
		<tr class="sectiontableheader">
			<th width="150"><?php echo _JNAME; ?></th>
			<th><?php echo _DESCRIPTION; ?></th>
			<th width="85" align="center"><?php echo _DATE_ADDED; ?></th>
		</tr>
		<?php 
		$k = 0;
		$j=1;
		foreach ($files as $f) { 
		$dateadded = ($f->dateadded) ? date("m/d/Y", strtotime($f->dateadded)) : '';
		$path = "components/com_jprojects/documents/".$project->id."/".$f->filelocation;
		?>
		<tr class="sectiontableentry<?php echo $j;?>">
			<td><?php echo "<a href='".$path."' target='_blank'>".$f->filename."</a>";?>&nbsp;</td>
			<td><?php echo $f->description;?>&nbsp;</td>
			<td align="center"><?php echo $dateadded;?>&nbsp;</td>
		</tr>			
		<?php 
		$k=1-$k;
		$j=$k+1;
		} ?>
     </table>
	 <br />&nbsp;
	<?php
     $link 	= 'index.php?option=com_jprojects&task=addFile&tmpl=component&pid='.$project->id;			
	?>
	 <a class='modal' href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}">+ <?php echo _ADD_FILE; ?></a>
	<br /><br />
</div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php }

function myTasks($option, &$rows, &$pageNav) {
$database = & JFactory::getDBO();
$user = & JFactory::geUser();

?>
<div class="contentheading"><?php echo _MY_TASKS; ?></div>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable" style="text-align:left;">
<tr class='sectiontableheader'>
	<th class="title" width="25" align="center"><?php echo _JID; ?></th>
    <th class="title"><?php echo _JNAME; ?></th>
	<th class="title"><?php echo _PROJECT; ?></th>
    <th class="title" width="80" align="center"><?php echo _START_DATE; ?></th>
    <th class='title' width="80" align="center"><?php echo _DUE_DATE; ?></th>
    <th class="title" width="75" align="center"><?php echo _STAGE; ?></th>
</tr>
<?php
$k = 0;
$j=1;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
$startdate = ($row->startdate) ? date("m/d/Y", strtotime($row->startdate)) : '';
$completiondate = ($row->completiondate) ? date("m/d/Y", strtotime($row->completiondate)) : '';

if ($user->get('gid') == '25' && $row->pmanager == $my->id) {
	$project = "<a href='index.php?option=com_jprojects&task=viewProject&id=".$row->pid."'>".$row->projectname."</a>";	
} elseif ($user->get('gid') == '18' && $row->pcontact == $my->id) {
	$project = "<a href='index.php?option=com_jprojects&task=viewProject&id=".$row->pid."'>".$row->projectname."</a>";
} else {
	$project = $row->projectname;	
}
?>
<tr class="<?php echo "sectiontableentry$j"; ?>"">
<td align="center"><?php echo $row->id; ?></td>
<td align="left"><a href="index.php?option=com_jprojects&task=viewTask&id=<?php echo $row->id;?>"><?php echo $row->subject; ?></a></td>
<td><?php echo $project; ?>&nbsp;</td>
<td align="center"><?php echo $startdate; ?>&nbsp;</td>
<td align="center"><?php echo $completiondate; ?>&nbsp;</td>
<td align='left'><?php echo $row->stage; ?>&nbsp;</td>
<?php 
$k = 1 - $k;
$j = $k + 1; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='sectiontableentry1'>
           		<td colspan='8' align="center"><strong><?php echo _NO_TASKS_AVAILABLE; ?></strong></td>
           </tr>
           <?php } ?>
</table>
<table width="100%" cellpadding="4" style="margin: 0;" class="pageNav">
	<tr>
				<td align="center" colspan="5" style="border:none;">
				<?php
				$order = '';
				if ( $lists['order_value'] ) {
					$order = '&amp;order='. $lists['order_value'];
				}
				$filter = '';
				if ( $lists['filter'] ) {
					$filter = '&amp;filter='. $lists['filter'];
				}				$link = 'index.php?option=com_jprojects&amp;task=myTasks';
				#echo $pageNav->writePagesLinks( $link );
				?>
				</td>
			</tr>
    <tr>
        <td colspan="5" align="center" style="border:none;">
        <?php #echo $pageNav->writePagesCounter(); ?>
        </td>
	</tr>
</table>
<?
} 

function viewTask($option, $task, $username, $manager, $project, $assignedto) {
$database = & JFactory::getDBO();
$user = & JFactory::getUser();
	#$client = $user[0] ? "<a href='mailto:".$user[2]."'>".$user[0]."[".$user[1]."]</a>" : '';
	$man = $manager[0] ? "<a href='mailto:".$manager[2]."'>".$manager[0]."[".$manager[1]."]</a>" : '';
	$assigned = $assignedto[0] ? "<a href='mailto:".$assignedto[2]."'>".$assignedto[0]."[".$assignedto[1]."]</a>" : '';
	$startdate = ($task->startdate) ? date("F d, Y", strtotime($task->startdate)) : '';
	$completiondate = ($task->completiondate) ? date("F d, Y", strtotime($task->completiondate)) : '';

if ($user->get('gid') == '25' && $project->manager == $my->id) {
	$project = "<a href='index.php?option=com_jprojects&task=viewProject&id=".$project->id."'>".$project->subject."</a>";	
} elseif ($user->get('gid') == '18' && $project->contactid == $my->id) {
	$project = "<a href='index.php?option=com_jprojects&task=viewProject&id=".$project->id."'>".$project->subject."</a>";
} else {
	$project = $project->subject;	
}
	?>
	<div class='contentheading'><?php echo _MY_PROJECTS; ?></div>
 <table width="100%" class="backButton">
	<tr>
    	<td width="100%" align="right"><a href="javascript:history.back();" class="button"><?php echo _BACK; ?></a></td>
    </tr>
</table>
<div id="content-pane" class="pane-sliders">

<div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _TASK_INFORMATION; ?></span></h3>
	<div class="jpane-slider content">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
			<td width="130px" class='fieldName'><?php echo _JNAME; ?></td><td width="150px"><?php echo $task->subject; ?>&nbsp;</td>
            <td width="130px" class='fieldName'><?php echo _ASSIGNED_TO; ?></td><td><?php echo $assigned; ?>&nbsp;</td>
		</tr>
<!--   <tr>
			<td width="130px" class='fieldName'>Client</td><td width="150px"><?php echo $client; ?>&nbsp;</td>
			<td width="130px" class='fieldName'>Account</td><td width="150px"><?php echo $task->accountid; ?>&nbsp;</td>
		</tr> -->
        <tr>
			<td width="130px" class='fieldName'><?php echo _STAGE; ?></td><td width="150px"><?php echo $task->stage; ?>&nbsp;</td>
			<td width="130px" class='fieldName'><?php echo _PROJECT; ?></td><td width="150px"><?php echo $project; ?>&nbsp;</td>
            
		</tr>
		<tr>
			<td width="130px" class='fieldName'><?php echo _PRIORITY; ?></td><td><?php echo $task->priority; ?>&nbsp;</td>
			<td width="130px" class='fieldName'><?php echo _MANAGER; ?></td><td><?php echo $man; ?>&nbsp;</td>
		</tr>
		<tr>
			<td width="130px" class='fieldName'><?php echo _START_DATE; ?></td><td><?php echo $startdate; ?>&nbsp;</td>
			<td width="130px" class='fieldName'><?php echo _END_DATE; ?></td><td><?php echo $completiondate; ?>&nbsp;</td>
		</tr>
      </table>
</div>
</div>
<div class="panel">
	<h3 class="jpane-toggler title"><span><?php echo _DESCRIPTION; ?></span></h3>
	<div class="jpane-slider content">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
		<tr>
			<td width="130px" class='fieldName' valign="top"><?php echo _DESCRIPTION; ?></td><td colspan="3" valign="top"><?php echo $task->description; ?>&nbsp;</td>
		</tr>
     </table>
</div>
</div>



</div>
<?php  

	} //End Function
	
function homePage() {
	?>
    <table width="100%" cellpadding="20"><tr><td><div align="center" style="text-align: center;"><a href="index.php?option=com_jprojects&task=myProjects">My Projects</a></div></td></tr></table>
    
    <?php	
	} 

function addFile($option, $row) { ?>
<form action="index.php" method="post" name="adminForm" id="adminForm" onsubmit="return validateFile();" enctype="multipart/form-data">
 <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
		<tr class="sectiontableheader">
        	<td align="left" colspan="4"><?php echo _FILE_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="100" align="right" class='fieldNameRequired' id='filename_label'><?php echo _JNAME; ?></td>
		    <td width="100" class='fieldValue'><input type="text" name="filename" id="filename" value="" size="35" onchange="popupCheck('filename');" /></td>
			
		</tr>
		<tr>
			<td align="right" class='fieldNameRequired' id="filelocation_label"><?php echo _FILE_LOCATION; ?></td>
            <td class='fieldValue'>
            	<input type='file' id='filelocation' name='filelocation' onchange="popupCheck('filelocation');" />
			</td>
            
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr align='left' class="sectiontableheader"><td colspan='4'><?php echo _FILE_DESCRIPTION; ?></td></tr>
        <tr>
        	<td class='fieldName' valign="top"><?php echo _DESCRIPTION; ?></td>
            <td colspan='2'><textarea name="description" rows="6" cols="35"></textarea></td>
        </tr>
  </table>

<input type='hidden' name='projectid' value='<?php echo $row->projectid; ?>'  />        
<input type='hidden' name='dateadded' value='<?php echo $row->dateadded; ?>'  />
<input type='hidden' name='author' value='<?php echo $row->author; ?>'  />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="task" value="saveFile" />
<input type="hidden" name="option" value="com_jprojects" />
<br />
<center><input type='button' name='Cancel' value="Cancel"class='button' onclick="cancel()">&nbsp;&nbsp;<input type='submit' name='submit' value="Submit" class='button'></center>
</form>	
<?php
}

function endPage() {	?>
    <br /><br />
    <div id="copy" style='text-align:center;'><?php echo _POWERED_BY; ?> <a href="http://www.igenxsolutions.com">Igenx Solutions</a></div>
	<?php
	}
} //End class
?>