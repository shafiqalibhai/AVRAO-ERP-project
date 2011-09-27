<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_JSUPPORT {

function listTickets ($option, &$rows) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();
?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable">
<tr class='sectiontableheader'>
<th width="50" align="center"><?php echo _JID; ?></th>
<th align="left"><?php echo _TICKET_NAME; ?></th><th width="100" align="center"><?php echo _PRIORITY; ?></th>
<th width='100' align="center"><?php echo _STATUS; ?></th>
<th width="100" align="center"><?php echo _CREATED; ?></th>
</tr>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
?>
<tr class="<?php echo "row$k"; ?>">
<td align="center"><?php echo $row->id; ?></td>
<td align="left"><a href="index.php?option=com_jsupport&amp;task=viewTicket&cid[]=<?php echo $row->id; ?>" ><?php echo $row->subject; ?></a></td>
<td align="center"><?php echo $row->priority; ?></td>
<td align="center"><?php echo $row->status; ?></td>
<td align="center"><?php echo JHTML::_('date',  $row->created, JText::_('DATE_FORMAT_LC4') ); ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
?>
</table>
<?
}
function viewTicket($option, &$row, &$ticketcomments, &$manager, &$category) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();
?>

			<div id='menu' style="text-align: center;"><a href='index.php?option=com_jsupport&amp;task=editTicket&amp;cid[]=<?php echo $row->id; ?>'><?php echo _EDIT_TICKET; ?></a> | <a href='index.php?option=com_jsupport&amp;task=listTickets'><?php echo _BACK_TO_LIST; ?></a></div>
		</tr>
	</table>
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
      <tr>
        <th class='sectiontableheader' align="left" colspan="2"><?php echo _TICKET_DETAILS; ?></th>
      </tr>
      <tr>
        <td width="100px" class='fieldName' id='subject2'><?php echo _TICKET_NAME; ?></td>
        <td width="300px" class='fieldValue'><?php echo $row->subject; ?></td>
      </tr>
      <tr>
        <td width="100px" class='fieldName'><?php echo _CATEGORY; ?></td>
        <td class='fieldValue'><?php echo $category[1]; ?> </td>
      </tr>
      <tr>
        <td width="100px" class='fieldName'><?php echo _STATUS; ?></td>
        <td class='fieldValue'><?php echo $row->stage; ?>        </td>
      </tr>
      <tr>
        <td width="100px" class='fieldName' id='priority'><?php echo _PRIORITY; ?></td>
        <td class='fieldValue'><?php echo $row->priority; ?></td>
      </tr>
      <tr>
        <td colspan='2' align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan='2' class='sectiontableheader' align="left"><?php echo _PROBLEM; ?></td>
      </tr>
      <tr>
        <td colspan='2' style="padding:10px;"><?php echo $row->description; ?></td>
      </tr>
      <tr>
        <td colspan='2' class='sectiontableheader' align="left"><?php echo _SOLUTION; ?></td>
      </tr>
      <tr>
        <td colspan='2' style="padding:10px;"><?php echo $row->solution; ?></td>
      </tr>
      <tr>
		<td colspan='2' class='sectiontableheader' align="left"><?php echo _COMMENTS; ?></td>
		</tr>
        <?php 
		if($ticketcomments){
			$k = 0;
			foreach($ticketcomments as $tc) {
		?>
		<tr class='row<?php echo $k; ?>'>
                	<td colspan="2" style="padding: 10px;"><?php echo $tc->comment; ?></td>
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
function editTicket($option, &$row, &$ticketcomments, &$managers, &$categories) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();
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

			if (pressbutton == 'listTickets') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (form.subject.value == ""){
				alert( "Ticket must have a title" );
			} else if (form.priority.value == ""){
				alert( "You must select a Priority." );
			} else {
				submitform( pressbutton );
			}
		}
function checkElement(fieldLabel) {
document.getElementById(fieldLabel).style.backgroundImage='url("administrator/components/com_jsupport/images/required_field_2.png")';
}
//-->
</script>
			<div id='menu' style="text-align: center;"><a href="javascript:submitbutton('saveTicket');"><?php echo _SAVE_TICKET; ?></a> | 
		
			<?php echo ($row->id) ?  "<a href='index.php?option=com_jsupport&task=viewTicket&cid[]=".$row->id."'>" : "<a href='index.php?option=com_jsupport&task=listTickets'>"; ?>Cancel</a></div>
<form action="index2.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
<tr>
        	<th class='sectiontableheader' align="left" colspan="2"><?php echo _EDIT_TICKET_DETAILS; ?></th>
      </tr>
        <tr>
			<td width="150px" class='fieldNameRequired' id='subject'><?php echo _TICKET_NAME; ?></td>
		  <td width="300px" class='fieldValue'><input type="text" name="subject" value="<?php echo $row->subject; ?>" size="40"  onchange="checkElement('subject');" /></td>
        </tr>
		<tr>
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
          <td width="150px" class='fieldNameRequired' id='priority'><?php echo _PRIORITY; ?></td>
		  <td class='fieldValue'><select name="priority" onchange="checkElement('priority');"><option value=''></option>
            	<?php 
                $priority=array(_LOW,_MEDIUM,_HIGH,_URGENT);
				foreach($priority as $p) {
				if($row->priority == $p) {
					echo "<option value=".$row->priority." selected>".$row->priority."</option>";
				} else {
					echo "<option value=".$p.">".$p."</option>";
				}
				}
				?>
            </select></td>
        </tr>
		<tr>
		  <td width="150px" class='fieldName'><?php echo _STATUS; ?></td>
          <td class='fieldValue'>
            <select name="status">
            	<?php 
                $stages=array(_OPEN,_PENDING,_CLOSED);
				foreach($stages as $stage) {
				if($row->status == $stage) {
					echo "<option value=".$row->status." selected>".$row->status."</option>";
				} else {
					echo "<option value=".$stage.">".$stage."</option>";
				}
				}
				?>
            </select>            </td>
		</tr>
        <tr>
          <td colspan='2' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='2' class='sectiontableheader' align="left"><?php echo _PROBLEM; ?></td></tr>
        <tr>
          <td colspan='2'><?php echo $editor->display( 'description',$row->description, '50%', '200', '55', '20' ) ; ?></td>
        </tr>
        <tr><td colspan='2' class='sectiontableheader' align="left"><?php echo _SOLUTION; ?></td></tr>
        <tr>
          <td colspan='2'><?php echo $row->solution; ?></td>
        </tr>
       	<tr>
		  <td colspan='2' class='sectiontableheader' align="left"><?php echo _COMMENTS; ?></td>
		</tr>
        <?php 
		$j = 0;
		if($ticketcomments){
			$k = 0;
			foreach($ticketcomments as $tc) {
		?>
		<tr class='row<?php echo $k; ?>'>
       	  <td colspan="2"><?php echo $tc->comment; ?></td>
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
        <td colspan='2' class='sectiontableheader' align="left"><?php echo _ADD_COMMENT; ?></td>
        </tr>
	  <tr>
        <td colspan='2' align="left"><?php echo $editor->display( 'comment','', '50%', '200', '55', '20' ) ; ?></td>
		  </tr>
  </table>
<input type='hidden' name='contactid' id='contactid' value='<?php echo $row->contactid;?>'/>
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 

<?php 
}
function listFaqs($option, &$latest, &$popular, &$categories) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();
?>
<form name='adminForm' action="index.php" method="post">
<?php echo _SEARCH_FAQS; ?>: <input type='text' class='input' maxlength="40" name='keyword' />
<input type='hidden' name='option' value='com_jsupport' />
<input type='hidden' name='task' value='searchFaq' />
<input type='submit' class='button' name='submit' value='Search' />
</form><br /><br />
<table><tr><td>
<div class='contentheading latest'><?php echo _LATEST_FAQS; ?></div>
<ul class='latestFaqs'>
<?php
for($i=0; $i < count( $latest ); $i++) {
$l = $latest[$i];
?>
<li class='faq'><a href="index.php?option=com_jsupport&amp;task=viewFaq&amp;cid[]=<?php echo $l->id; ?>"><?php echo $l->subject; ?></a></li>
<?php } ?>
</ul>
</td><td width='50%'>
<div class='contentheading latest'><?php echo _MOST_POPULAR_FAQS; ?></div>
<ul class='mostPopularFaqs'>
<?php
for($i=0; $i < count( $popular ); $i++) {
$pop = $popular[$i];
?>
<li class='faq'><a href='index.php?option=com_jsupport&amp;task=viewFaq&amp;cid[]=<?php echo $pop->id; ?>'><?php echo $pop->subject; ?></li>
<?php } ?>
</ul></td></tr><tr><td colspan='2'>
<div class='contentheading'><?php echo _CATEGORIES; ?></div>
<?php
$numCats = count($categories);
$i = 0;
echo "<table width='100%' cellpadding='5' cellspacing='5'>";
echo "<tr>";
foreach($categories as $cat) { 
	if($i%3==0 && $i!=0) { 
	echo "</tr><tr>";
	}
	echo "<td class='cat'>";
	if($cat->total != 0) { 
		echo "<a href='index.php?option=com_jsupport&task=listFaqCategory&cid[]=".$cat->id."'>".$cat->name."</a> (".$cat->total.")</td>";
	} else { 
		echo $cat->name." (".$cat->total.")</td>";
	}	
	$i++;
}
echo "</tr>";
echo "</table>";
?>
</td></tr></table>
<?php
}
function listFaqCategory($option, &$rows) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();
?>
<div class='contentheading cat'><?php echo $rows[0]->name; ?></div><br />
<?php
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
if ($row->solution) {
	if(strlen($row->solution)>100) { 
		$d = strpos($row->solution, " ", 100);
	} else { 
		$d = strlen($row->solution);
	}
		$solution = substr($row->solution, 0, $d)."...";
} else { $solution = ''; }
?>
<div class='faq'><div id='trigger' class='slide_trigger'><div class='large'><?php echo $row->subject; ?></div></div></div>
	<div id='slider_content' class='slide'><div class='faqdetails'><strong>Q:</strong> <?php echo $row->description; ?><br /><strong>A:</strong> <?php echo $solution; ?> <a href="index.php?option=com_jsupport&task=viewFaq&cid[]=<?php echo $row->id; ?>&Itemid=<?php echo $jSupportItemid; ?>"><?php echo _VIEW_MORE; ?>...</a></div></div>

<?php 
} 

}
function viewFaq($option, &$row, &$category, &$related, &$faqcomments, &$voted) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();

global $jfConfig;

$keywords = explode(",",$row->keywords);
?>
<div class='contentheading'><?php echo $row->subject; ?></div>
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
      <tr>
        <td colspan='2' class='sectiontableheader' align="left"><?php echo _QUESTION; ?></td>
      </tr>
      <tr>
        <td colspan='2' style="padding:10px;"><?php echo $row->description; ?></td>
      </tr>
      <tr>
        <td colspan='2' class='sectiontableheader' align="left"><?php echo _SOLUTION; ?></td>
      </tr>
      <tr>
        <td colspan='2' style="padding:10px;"><?php echo $row->solution; ?></td>
      </tr>
	  <tr>
        <th class='sectiontableheader' align="left" colspan="2"><?php echo _FAQ_DETAILS; ?></th>
      </tr>
      <tr>
        <td width="100px" class='fieldName'><?php echo _CATEGORY; ?></td>
        <td class='fieldValue'><?php echo $category[1]; ?> </td>
      </tr>
      <tr>
        <td width="100px" class='fieldName'><?php echo _KEYWORDS; ?></td>
        <td class='fieldValue'>
		<?php if($row->keywords !='') { 
		foreach($keywords as $keyword) { ?>
		<?php if($keyword != end($keywords)) { ?>
		<a href='index.php?option=com_jsupport&amp;task=searchFaq&amp;keyword=<?php echo trim($keyword); ?>'><?php echo $keyword; ?></a>,&nbsp;
		<?php } else { ?>
		<a href='index.php?option=com_jsupport&amp;task=searchFaq&amp;keyword=<?php echo trim($keyword); ?>'><?php echo $keyword; ?></a>
		<?php } ?>
		<?php }
		} ?>
		</td>
      </tr>	  
      <tr>
        <td width="100px" class='fieldName'><?php echo _HELPFUL; ?>?</td>
        <td class='fieldValue'><?php if($voted) { echo 'Thank you for voting.'; } else { ?><a href='index.php?option=com_jsupport&amp;task=viewFaq&amp;cid[]=<?php echo $row->id; ?>&amp;helpful=yes'>Yes</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='index.php?option=com_jsupport&amp;task=viewFaq&amp;cid[]=<?php echo $row->id; ?>&amp;helpful=no'>No</a><?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class='light'>Score: <?php echo $row->score; ?></span></td>
      </tr>
	  <tr>
        <td width="100px" class='fieldName'><?php echo _VIEWS; ?></td>
        <td class='fieldValue'><?php echo $row->hits; ?></td>
	  </tr>
        <?php if($related != '') { ?>
		<tr>
			<td width="100px" class='fieldName' valign='top'><?php echo _RELATED_ARTICLES; ?></td>
			<td class='fieldValue' valign='top'>
            	<ul class='mainlevel'>
        <?php foreach($related as $r) {
				if($r->id != $row->id) { 
					echo "<li><a href='index.php?option=com_jsupport&amp;task=viewFaq&amp;cid[]=".$r->id."'>".$r->subject."</a></li>";
				}
			}
		?></ul>
        </td></tr>
       <?php } ?>
 	  <tr><td colspan='2'>&nbsp;</td></tr>
      <tr>
        <th class='sectiontableheader' align="left" colspan="2"><?php echo _COMMENTS; ?></th>
      </tr>
      <?php
if($faqcomments !='') {  
$k = 0;
for($i=0; $i < count( $faqcomments ); $i++) {
$faqcomment = $faqcomments[$i];
?>
<tr class="<?php echo "row$k"; ?>">
<td align="left" class='fieldName'><?php echo $faqcomment->creatorname; ?></td>
<td align="left" class='fieldValue'><?php echo $faqcomment->comment; ?></td>
<?php $k = 1 - $k; ?>
</tr>
<?php }  
	} else {
		?>
<tr class='row0'>
	<td colspan='2'><?php echo _NO_COMMENTS_POSTED; ?></td>
</tr>
        <?php
		} 
		?>
</table>
	   <div id='trigger' class='slide_trigger'><?php echo _ADD_YOUR_COMMENT; ?></div>
        <div id='slider_content' class='slide'>
        <form name='adminForm' action='index.php' method='post'>
        <table width='100%' cellpadding='4' cellspacing="0"><tr><td><?php echo _JNAME; ?>: </td><td><input type='text' name='creatorname' class='inputbox' /></td></tr>
        <tr><td><?php echo _JEMAIL; ?>: </td><td><input type="text" name='creatoremail' class='inputbox' /></td></tr>
        <tr><td><?php echo _COMMENT; ?>:</td><td><textarea cols="30" rows="4" class='inputbox' name='comment'></textarea></td></tr>
        <?php if($jfConfig['captcha'] =='on') { ?>
        <tr><td valign="top"><?php echo _SECURITY_CODE; ?>:<br /><img src="components/com_jsupport/lib/CaptchaSecurityImage.php?width=100&height=35&characters=5" alt="captcha" /> </td><td valign="top">
<input id="security_code" name="security_code" type="text" class='inputbox' /></td></tr>
		<?php } ?>
        <tr><td>&nbsp;</td><td><input type='submit' name="submit" value='<?php echo _JSUBMIT; ?>' /></td></tr>
        </table>
        <input type='hidden' name='option' value='com_jsupport' />
        <input type='hidden' name='task' value='addComment' />
        <input type='hidden' name='faqid' value='<?php echo $row->id; ?>' />
        </form>
        </div>
        
    <? 
}
function searchFaq($option, &$items, &$q, &$phrase) {
$user = & JFactory::getUser();
$database = & JFactory::getDBO();
?>
<?php echo $q == "" ? "<div class='contentheading'>Search FAQ's</div><br />" : "<div class='contentheading'>Search Results for: <em>".$q."</em> </div><br />"; ?>
<form name='adminForm' action="index.php" method="post">
<?php echo _SEARCH_KEYWORD; ?>: <input type='text' class='input' maxlength="40" name='keyword' value='<?php echo $q; ?>' />
<input type='hidden' name='option' value='com_jsupport' />
<input type='hidden' name='task' value='searchFaq' />
<input type='submit' class='button' name='submit' value='Search' />
<br /><br />
<input name="phrase" id="searchphraseany" value="any" <?php echo $phrase=='any' ? "checked=checked " : "" ?>type="radio">
	<label for="searchphraseany"><?php echo _ANY_WORD; ?></label>
	<input name="phrase" id="searchphraseall" value="all" <?php echo $phrase=='all' ? "checked=checked " : "" ?>type="radio">
	<label for="searchphraseall"><?php echo _ALL_WORDS; ?></label>
	<input name="phrase" id="searchphraseexact" value="exact" <?php echo $phrase=='exact' ? "checked=checked " : "" ?>type="radio">
	<label for="searchphraseexact"><?php echo _EXACT_PHRASE; ?></label>
<br /><br />
<?php echo _JORDERING; ?>: <select name="ordering" class="inputbox">
	<option value="newest" selected="selected"><?php echo _NEWEST_FIRST; ?></option>
	<option value="oldest"><?php echo _OLDEST_FIRST; ?></option>
	<option value="popular"><?php echo _MOST_POPULAR; ?></option>
	<option value="alpha"><?php echo _ALPHABETICAL; ?></option>
</select>
</form>
<br /><br />
<?php
if($items) {
	echo "Total ". count($items)." results found.";
	$num = 1;
	foreach($items as $item) {
?>	
<div class='searchresults'>
	<div class='searchresulttitle'><span class='searchnum'><?php echo $num; ?>. </span><a href="index.php?option=com_jsupport&amp;task=viewFaq&amp;cid[]=<?php echo $item->id; ?>"><?php echo $item->subject; ?></a>&nbsp;&nbsp;<small>[<?php echo $item->keywords; ?>]</small></div>
	<div class='searchresult'><strong>Q:</strong>&nbsp;<?php echo $item->description; ?>...<br /><strong>A:&nbsp;</strong><?php echo $item->solution; ?>...</div>
</div>
<?php 
		$num++;
	}
} else {
	echo _TOTAL_NO_RESULTS;
	echo "<div class='searchresults'><div class='searchresult'>"._NO_RESULTS_MATCHED."</div></div>";
} 
}
	function endPage() {	?>
    <br /><br />
    <div id="copy" style="text-align:center;">Powered By <a href="http://www.igenxsolutions.com">Igenx Solutions</a></div>
	<?php
	}

} //End class
?>