<?php
/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

		$database = & JFactory::getDBO();
		global $jfConfig, $auth, $my;

//Projects query
	$database->setQuery("SELECT j.id, j.subject, j.contactid, j.startdate,"
	."\n j.published, u.username"
	."\n FROM #__jprojects as j"
	."\n LEFT JOIN #__users as u on j.contactid = u.id"
	."\n $auth"
	."\n ORDER BY j.created ASC LIMIT 5");
	$latestprojects = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}

//Tasks Query	
	$database->setQuery("SELECT j.id,  j.subject, j.published, j.startdate, p.subject as projectname"
	."\n FROM #__jtasks as j"
	."\n LEFT JOIN #__jprojects as p on p.id = j.projectid"
	."\n $auth"
	."\n ORDER BY j.created ASC LIMIT 5");
	$latesttasks = $database -> loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}

//Milestones Query
	$database->setQuery("SELECT m.id, m.projectid, m.name, m.startdate, m.completiondate, j.subject"
	."\n FROM #__jmilestones as m"
	."\n LEFT JOIN #__jprojects as j on j.id = m.projectid"
	."\n $auth"
	."\n ORDER BY m.completiondate ASC LIMIT 5");
	$upcomingMilestones = $database -> loadObjectList();
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
    <th class='headerQuotes'><?php echo $jfConfig['access_restrictions']==1 && $my->gid != 25 ? "My " : "" ?>Latest Tasks</th>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
        	<tr><th width='50' align="center">ID</th>
            <th align="left">Name</th>
            <th width='100' align='center'>Project</th>
        	<th width="100" align="center">Start Date</th>
        	</tr>
			<?php
			$k = 0;
			foreach($latesttasks as $lt) { 
			$date = JHTML::_('date',  $lt->startdate, JText::_('DATE_FORMAT_LC4'));
			?>
			<tr class='row<?php echo $k; ?>'>
				<td align="center"><?php echo $lt->id; ?></td>
                <td align="left"><a href="index2.php?option=com_jprojects&task=viewTask&cid[]=<?php echo $lt->id; ?>"><?php echo $lt->subject; ?></a></td>
               <td align='center'><?php echo $lt->projectname; ?></td>
                <td align="center"><?php echo $date; ?></td>
          	</tr>
           <?php 
		   $k = 1 - $k;
		   }
		   if(!$latesttasks) {  
		   ?>
           <tr class='row1'>
           		<td colspan='4' align="center">No Tasks Available</td>
           </tr>
           <?php } ?>
        </table>    </td>
  </tr>
           <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jprojects&task=listTasks' class='button'>View All</a></td>
         	</tr>
</table></td>
    <td valign="top" width="">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class='headerInvoices'><?php echo $jfConfig['access_restrictions']==1 && $my->gid != 25 ? "My " : "" ?>Latest Projects</th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr>
              <th width="50" align="center">ID</th>
              <th align="left">Name</th>
              <th width='100' align='center'>Client</th>
              <th width="100" align="center">Start Date</th>
            </tr>
            <?php
			$k = 0;
			foreach($latestprojects as $lp) { 
			$date = JHTML::_('date',  $lp->startdate, JText::_('DATE_FORMAT_LC4'));			
			?>
            <tr class='row<?php echo $k; ?>'>
              <td align="center"><?php echo $lp->id; ?></td>
              <td align="left"><a href="index2.php?option=com_jprojects&task=viewProject&cid[]=<?php echo $lp->id; ?>"><?php echo $lp->subject; ?></a></td>
              <td align='center'><?php echo $lp->username; ?></td>
              <td align="center"><?php echo $date; ?></td>
            </tr>
            <?php 
		   $k = 1 - $k;
		   } 
		   if(!$latestprojects) {  
		   ?>
           <tr class='row1'>
           		<td colspan='4' align="center">No Projects Available</td>
           </tr>
           <?php } ?>

        </table></td>
      </tr>
                 <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;"><a href='index2.php?option=com_jprojects&task=listProjects' class='button'>View All</a></td>
         	</tr>      
    </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th class='headerServices'>Upcoming Milestones</th>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList'>
            <tr>
              <th width="50" align="center">ID</th>
              <th align="left">Name</th>
              <th align="left">Project</th>
              <th width="150" align="center">End Date</th>
            </tr>
            <?php
			$k = 0;
			foreach($upcomingMilestones as $m) { 
			$date = JHTML::_('date',  $m->completion, JText::_('DATE_FORMAT_LC4'));
			?>
            <tr class='row<?php echo $k; ?>'>
              <td align="center"><?php echo $m->id; ?></td>
              <td align="left"><?php echo $m->name; ?></td>
              <td align="left"><a href="index2.php?option=com_jprojects&task=viewProject&cid[]=<?php echo $m->projectid; ?>"><?php echo $m->subject; ?></a></td>
              <td align="center"><?php echo $date; ?></td>
            </tr>
            <?php 
		   $k = 1 - $k;
		   } 
		   if(!$upcomingMilestones) {  
		   ?>
           <tr class='row1'>
           		<td colspan='4' align="center">No Milestones Available</td>
           </tr>
           <?php } ?>
        </table></td>
      </tr>
                <tr>
	           <td align="right" style="padding: 7px 0px 7px 7px;">&nbsp;</td>
         	</tr>
    </table></td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>

