<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class HTML_JCONTACTS {
	function showFilter() {
?>

<table width='100%' cellpadding='4' class='editView' border="0" cellspacing="0">
  <tr>
    <td class='sectiontableheader' colspan="2" align="left"><?php echo _FILTER;?></td>
  </tr>
  <tr>
    <td width='230px'><?php echo _KEYWORD; ?>
      <input type="text" name="filter" />
      &nbsp;
      <input type="submit" name="Submit" value="<?php echo _JSUBMIT;?>" class='button' /></td>
  </tr>
  <tr>
    <td align="left"><input type='hidden' name='alpha' />
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
      <a href="javascript:alphaFilter('')" class='alpha'><?php echo _SHOW_ALL;?></a> </td>
  </tr>
</table>
<br />
<?php }	
function newLeadForm($option) { ?>
<script language="JavaScript" type="text/javascript">
		<!--
			function checkFields() {
				var form = document.newLeadForm;				
				
				if (form.last_name.value == "") {
					alert("<?php echo _VALIDATE_LAST_NAME;?>");
					return false;
				} else if (form.email.value == "") {
					alert("<?php echo _VALIDATE_EMAIL;?>");
					return false;
				} else {
					form.submit();
				}
			}
		-->
		</script>
<table width="280" cellpadding="0" cellspacing="3" class='contactTable'>
  <tr>
  
  <td class='fieldValue'>
  
  <form onsubmit="return checkFields()" action="index.php?option=com_jcontacts&task=saveLead" method="post" name='newLeadForm' >
  
  <span class='descriptor'><strong><?php echo _LEAD_FORM_HEADER;?><br />
  </strong><br />
  <?php echo _FIRST_NAME;?><br />
  </span>
  <input type="text" class="inputbox" name="first_name" size="40" />
  </td>
  
  </tr>
  
  <tr>
    <td class='fieldValue'><span class='descriptor'><?php echo _LAST_NAME;?><br />
      </span>
      <input type="text" class="inputbox" id='last_name' name="last_name"  size="40" /></td>
  </tr>
  <tr>
    <td class='fieldValue'><span class='descriptor'><?php echo _COMPANY;?><br />
      </span>
      <input type="text" class="inputbox" name="company_name"  size="40" /></td>
  </tr>
  <tr>
    <td class='fieldValue'><span class='descriptor'><?php echo _PHONE; ?><br />
      </span>
      <input type="text" class="inputbox" name="phone" size="40" /></td>
  </tr>
  <tr>
    <td class='fieldValue'><span class='descriptor'><?php echo _JEMAIL;?><br />
      </span>
      <input type="text" class="inputbox" id='email' name="email" size="40" /></td>
  </tr>
  <tr>
    <td class='fieldValue'><span class='descriptor'><?php echo _MESSAGE;?><br />
      </span>
      <textarea cols="42" rows="10" class="inputbox" id='message' name="message"></textarea></td>
  </tr>
  <tr>
    <td class='fieldValue'><input type="submit" name="submit" value="<?php echo _JSUBMIT;?>" class='button' /></td>
  </tr>
</table>
<input type='hidden' name='created' value='<?php echo date('Y-m-d H:i:s');?>'  />
<input type='hidden' name='published' value='1'  />
</form>
<?php	}

function editMyDetails($my, $row, $jrow, &$lists) {
	global $jfConfig;
	$birthday = explode("-",$row->birthdate);
	
	if (!$row->id && $jfConfig['reg_message'] != "") {
		echo "<p>".$jfConfig['reg_message']."</p>";
		echo "<br />";
	}	
?>
<script language="JavaScript" type="text/javascript">
function validateUserForm() {

	var form = document.contactDetails;
	var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

	// do field validation
	if (form.last_name.value == "") {
		alert("<?php echo _VALIDATE_LAST_NAME;?>");
		return false;
	} else if (form.username.value == "") {
		alert("<?php echo _VALIDATE_USERNAME;?>");
		return false;
	} else if (r.exec(form.username.value) || form.username.value.length < 3) {
		alert("<?php echo _VALIDATE_USERNAME_LENGTH;?>");
		return false;
	} else if (form.email.value == "") {
		alert("<?php echo _VALIDATE_EMAIL;?>");
		return false;
	} else if ((form.password.value != "") && (form.password.value != form.verifyPass.value)){
		alert( "<?php echo _VALIDATE_PASSWORD_MATCH;?>" );
		return false;
	} else if (r.exec(form.password.value)) {
		alert( "<?php echo _VALIDATE_PASSWORD_LENGTH;?>" );
		return false;
	} else {
		form.submit();
	}
}
		</script>
<form action="index.php?option=com_jcontacts&task=saveContactDetails" method="post" name="contactDetails" id="contactDetails" onsubmit="return validateUserForm()">
  <div id="content-pane" class="pane-sliders">
    <div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _CONTACT_INFORMATION;?></span></h3>
      <div class="jpane-slider content">
        <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
          <tr>
            <td width="150" class='fieldName'><?php echo _FIRST_NAME;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="first_name" value="<?php echo $row->first_name; ?>" size="40"></td>
            <td width="150" class='fieldName'><?php echo _PHONE; ?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="phone" value="<?php echo $row->phone; ?>" size="40"></td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _LAST_NAME;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="last_name" value="<?php echo $row->last_name; ?>" size="40"></td>
            <td width="150" class='fieldName'><?php echo _HOME_PHONE; ?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="home_phone" value="<?php echo $row->home_phone; ?>" size="40"></td>
          </tr>
          <tr>
            <td class='fieldName'><?php echo _TITLE;?></td>
            <td class='fieldValue'><input class="inputbox" type="text" name="title" value="<?php echo $row->title; ?>" size="40" /></td>
            <td class='fieldName'><?php echo _MOBILE_PHONE; ?></td>
            <td class='fieldValue'><input class="inputbox" type="text" name="mobile_phone" value="<?php echo $row->mobile_phone; ?>" size="40" /></td>
          </tr>
          <tr>
            <td class='fieldName'><?php echo _DEPARTMENT;?></td>
            <td class='fieldValue'><input class="inputbox" type="text" name="department" value="<?php echo $row->department; ?>" size="40" /></td>
            <td width="150" class='fieldName'><?php echo _OTHER_PHONE; ?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="other_phone" value="<?php echo $row->other_phone; ?>" size="40"></td
		>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _BIRTHDATE;?></td>
            <td width="300px" class='fieldValue'><input type="text" name="bday_month" size="2" maxlength="2" value="<?php echo $birthday[1]; ?>"/>
              &nbsp;/&nbsp;
              <input type="text" name="bday_day" size="2" maxlength="2" value="<?php echo $birthday[2]; ?>"/>
              &nbsp;/&nbsp;
              <input type="text" name="bday_year" size="4" maxlength="4" value="<?php echo $birthday[0]; ?>"/>
              &nbsp;(mm/dd/yyyy) </td>
            <td width="150" class='fieldName'><?php echo _FAX;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="fax" value="<?php echo $row->fax; ?>" size="40"></td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _ASSISTANT;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="assistant" value="<?php echo $row->assistant; ?>" size="40" /></td>
            <td width="150" class='fieldName'><?php echo _JEMAIL;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="email" value="<?php echo $row->email; ?>" size="40"></td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _ASSISTANT_PHONE; ?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="asst_phone" value="<?php echo $row->asst_phone; ?>" size="40" /></td>
            <td class='fieldName'><?php echo _EMAIL_OPT_OUT;?></td>
            <td class='fieldValue'><input class="inputbox" type="checkbox" name="email_opt_out" value="1" <?php if ($row->email_opt_out==1) {echo 'checked="checked"';}?> /></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _ADDRESS_INFO;?></span></h3>
      <div class="jpane-slider content">
        <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
          <tr>
            <td width="150" class='fieldName'><?php echo _MAILING_STREET;?></td>
            <td width="300" class='fieldValue'><textarea name="mailing_street" cols="24" id='mstreet'><?php echo $row->mailing_street; ?></textarea></td>
            <td width="150" class='fieldName'><?php echo _OTHER_STREET;?></td>
            <td width="300" class='fieldValue'><textarea name="other_street" cols="24" id='ostreet'><?php echo $row->other_street; ?></textarea></td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _MAILING_CITY;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="mailing_city" value="<?php echo $row->mailing_city; ?>" size="40" id='mcity'></td>
            <td width="150" class='fieldName'><?php echo _OTHER_CITY;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="other_city" value="<?php echo $row->other_city; ?>" size="40" id='ocity'></td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _MAILING_STATE;?></td>
            <td width="300" class='fieldValue'><?php echo $lists['mailing_state']; ?></td>
            <td width="150" class='fieldName'><?php echo _OTHER_STATE;?></td>
            <td width="300" class='fieldValue'><?php echo $lists['other_state']; ?></td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _MAILING_ZIP;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="mailing_zip" value="<?php echo $row->mailing_zip; ?>" size="40" id='mzip'></td>
            <td width="150" class='fieldName'><?php echo _OTHER_ZIP;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="other_zip" value="<?php echo $row->other_zip; ?>" size="40" id='ozip'></td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _MAILING_COUNTRY;?></td>
            <td width="300" class='fieldValue'><?php echo $lists['mailing_country']; ?></td>
            <td width="150" class='fieldName'><?php echo _OTHER_COUNTRY;?></td>
            <td width="300" class='fieldValue'><?php echo $lists['other_country']; ?></td>
          </tr>
          <tr>
            <td height="30" colspan="4" align="center" class='fieldValue' onclick="MailtoOther();">&nbsp;<span class='button' style="cursor:pointer;"><?php echo _COPY_MAILING_ADDRESS;?></span>&nbsp;</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _JOOMLA_INFORMATION;?></span></h3>
      <div class="jpane-slider content">
        <table cellpadding="5" cellspacing="0" class="editView" width="100%">
          <tr>
            <td width="150" class='fieldName'><?php echo _JUSERNAME; ?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="text" name="username" value="<?php echo $jrow->username;?>" size="40" /></td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _NEW_PASSWORD; ?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="password" name="password" value="" size="40" /></td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="150" class='fieldName'><?php echo _VERIFY_PASSWORD;?></td>
            <td width="300" class='fieldValue'><input class="inputbox" type="password" name="verifyPass" size="40" /></td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="name" value="<?php echo $jrow->name;?>" />
        <input type="hidden" name="modified" value="<?php echo date('Y-m-d H:i:s');?>" />
        <input type="hidden" name="jid" value="<?php echo $row->jid;?>" />
		<input type="hidden" name="usertype" value="<?php echo ($row->id) ? $jrow->usertype : "Registered";?>" />
        <input type="hidden" name="gid" value="<?php echo $row->id ? $jrow->gid : '18' ;?>" />
      </div>
    </div>
  </div>
  <br />
  <input type="hidden" name="id" value="<?php echo $row->id;?>" />
  <input type="button" name="cancel" value="Cancel" class='button' onclick="window.location.href='index.php?option=com_jcontacts&task=viewMyDetails&id=<?php echo $row->id;?>'" />
  <input type="submit" name="submit" value="<?php echo _SAVE_DETAILS;?>" class='button' />
</form>
<?php }
function viewMyDetails($my, $row, $jrow) {
	global $jcontacts_path, $mosConfig_frontend_userparams, $jfConfig;
	$date = ($row->birthdate) ? date('m/d/Y', strtotime($row->birthdate)) : '';
?>

<table width="100%">
  <tr>
    <td width="100%" align="right"><a href="index.php?option=com_jcontacts&task=editMyDetails&id=<?php echo $row->id;?>" class="button"><?php echo _EDIT_BUTTON;?></a></td>
  </tr>
</table>
<br />
<div id="content-pane" class="pane-sliders">
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _CONTACT_INFORMATION;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="150" class='fieldName'><?php echo _FIRST_NAME;?></td>
          <td class='fieldValue'><?php echo $row->first_name; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _PHONE; ?></td>
          <td class='fieldValue'><?php echo $row->phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _LAST_NAME;?></td>
          <td class='fieldValue'><?php echo $row->last_name; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _HOME_PHONE;?></td>
          <td class='fieldValue'><?php echo $row->home_phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td class='fieldName'><?php echo _TITLE;?></td>
          <td class='fieldValue'><?php echo $row->title; ?>&nbsp;</td>
          <td class='fieldName'><?php echo _MOBILE_PHONE;?></td>
          <td class='fieldValue'><?php echo $row->mobile_phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td class='fieldName'><?php echo _DEPARTMENT;?></td>
          <td class='fieldValue'><?php echo $row->department; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _OTHER_PHONE;?></td>
          <td class='fieldValue'><?php echo $row->other_phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _BIRTHDATE;?></td>
          <td class='fieldValue'><?php echo $date; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _FAX;?></td>
          <td class='fieldValue'><?php echo $row->fax; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _ASSISTANT;?></td>
          <td class='fieldValue'><?php echo $row->assistant; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _JEMAIL;?></td>
          <td  class='fieldValue'><?php echo $row->email; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _ASSISTANT_PHONE;?></td>
          <td class='fieldValue'><?php echo $row->asst_phone; ?>&nbsp;</td>
          <td class='fieldName'><?php echo _EMAIL_OPT_OUT;?></td>
          <td class='fieldValue'><input type="checkbox" disabled="disabled" name="email_opt_out" value="1" <?php if ($row->email_opt_out==1) {echo 'checked="checked"';}?>></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _ADDRESS_INFO;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="150" class='fieldName' valign="top"><?php echo _MAILING_STREET;?></td>
          <td class='fieldValue'><?php echo $row->mailing_street; ?>&nbsp;</td>
          <td width="150" class='fieldName' valign="top"><?php echo _OTHER_STREET;?></td>
          <td  class='fieldValue'><?php echo $row->other_street; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _MAILING_CITY;?></td>
          <td class='fieldValue'><?php echo $row->mailing_city; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _OTHER_CITY;?></td>
          <td  class='fieldValue'><?php echo $row->other_city; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _MAILING_STATE;?></td>
          <td class='fieldValue'><?php echo $row->mailing_state; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _OTHER_STATE;?></td>
          <td  class='fieldValue'><?php echo $row->other_state; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _MAILING_ZIP;?></td>
          <td class='fieldValue'><?php echo $row->mailing_zip; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _OTHER_ZIP;?></td>
          <td  class='fieldValue'><?php echo $row->other_zip; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _MAILING_COUNTRY;?></td>
          <td class='fieldValue'><?php echo $row->mailing_country; ?>&nbsp;</td>
          <td width="150" class='fieldName'><?php echo _OTHER_COUNTRY;?></td>
          <td  class='fieldValue'><?php echo $row->other_country; ?>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <?php if ($row->jid) { ?>
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _JOOMLA_INFORMATION;?></span></h3>
    <div class="jpane-slider content">
      <table cellpadding="5" cellspacing="0" class="editView" width="100%">
        <tr>
          <td width="150" class='fieldName'><?php echo _JUSERNAME; ?></td>
          <td class='fieldValue'><?php echo $jrow->username;?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _NEW_PASSWORD; ?></td>
          <td class='fieldValue'>************</td>
        </tr>
        <tr>
          <td width="150" class='fieldName'><?php echo _VERIFY_PASSWORD;?></td>
          <td class='fieldValue'>************</td>
        </tr>
      </table>
    </div>
  </div>
  <?php } ?>
</div>
<?php }
function viewContact($option, $row, &$account, &$reports_to, &$manager) {
global $jfConfig, $mosConfig_live_site; ?>
<?php
$date = ($row->birthdate) ? date('m/d/Y', strtotime($row->birthdate)) : '' ;
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
<h2><?php echo _MY_ADDRESS_BOOK;?></h2>
<div class="contentheading"><?php echo _CONTACT_DETAILS;?></div>
<table width="100%" class="backButton">
  <tr>
    <td width="100%" align="right"><a href="index.php?option=com_jcontacts&task=myContacts" class="button"><?php echo _BACK_BUTTON;?></a></td>
  </tr>
</table>
<div id="content-pane" class="pane-sliders">
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _CONTACT_INFORMATION;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="130px" class='fieldName'><?php echo _FIRST_NAME;?></td>
          <td width="150px"><?php echo $row->first_name; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _PHONE; ?></td>
          <td><?php echo $row->phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _LAST_NAME;?></td>
          <td width="150px"><?php echo $row->last_name; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _HOME_PHONE; ?></td>
          <td><?php echo $row->home_phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'>Account</td>
          <td width="150px"><?php echo $account[1]; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _MOBILE_PHONE;?></td>
          <td><?php echo $row->mobile_phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _TITLE;?></td>
          <td width="150px"><?php echo $row->title; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _OTHER_PHONE;?></td>
          <td><?php echo $row->other_phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _DEPARTMENT;?></td>
          <td width="150px"><?php echo $row->department; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _FAX;?></td>
          <td><?php echo $row->fax; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _BIRTHDATE;?></td>
          <td width="150px"><?php echo $date; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _JEMAIL;?></td>
          <td><a href="mailto:<?php echo $row->email;?>"><?php echo $row->email;?></a>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'>Reports to</td>
          <td width="150px"><?php if ($reports_to!='') {echo $reports_to[1].", ".$reports_to[2];} ?>
            &nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _ASSISTANT;?></td>
          <td><?php echo $row->assistant; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'>Lead Source</td>
          <td width="150px"><?php echo $row->lead_source; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _ASSISTANT_PHONE;?></td>
          <td><?php echo $row->asst_phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _EMAIL_OPT_OUT;?></td>
          <td width="150px"><input type="checkbox" disabled="disabled" name="email_opt_out" value="1" <?php if ($row->email_opt_out==1) {echo 'checked="checked"';}?>></td>
          <td width="130px" class='fieldName'>Manager</td>
          <td><?php if ($manager!='') { echo $manager[1]." [".$manager[2]."]"; } ?>
            &nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _ADDRESS_INFO;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="130px" class='fieldName'><?php echo _MAILING_STREET;?></td>
          <td width="150px"><?php echo $row->mailing_street; ?>&nbsp;
            <?php if($google_api && $row->lat && $row->lng) { ?>
            &nbsp;&nbsp;&nbsp;<a href='#' onclick="show('<?php echo $row->lat; ?>','<?php echo $row->lng; ?>')"><img src='components/com_jcontacts/images/map_icon.png' border='0' valign='middle' vspace='0'>&nbsp;Map It!</a>
            <?php } ?></td>
          <td width="130px" class='fieldName'><?php echo _OTHER_STREET;?></td>
          <td><?php echo $row->other_street; ?>&nbsp;
            <?php if($google_api && $row->other_lat && $row->other_lng) { ?>
            &nbsp;&nbsp;&nbsp;<a href='#' onclick="show('<?php echo $row->other_lat; ?>','<?php echo $row->other_lng; ?>')"><img src='components/com_jcontacts/images/map_icon.png' border='0' valign='middle' vspace='0'>&nbsp;Map It!</a>
            <?php } ?></td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _MAILING_CITY;?></td>
          <td width="150px"><?php echo $row->mailing_city; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _OTHER_CITY;?></td>
          <td><?php echo $row->other_city; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _MAILING_STATE;?></td>
          <td width="150px"><?php echo $row->mailing_state; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _OTHER_STATE;?></td>
          <td><?php echo $row->other_state; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _MAILING_ZIP;?></td>
          <td width="150px"><?php echo $row->mailing_zip; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _OTHER_ZIP;?></td>
          <td><?php echo $row->other_zip; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="130px" class='fieldName'><?php echo _MAILING_COUNTRY;?></td>
          <td width="150px"><?php echo $row->mailing_country; ?>&nbsp;</td>
          <td width="130px" class='fieldName'><?php echo _OTHER_COUNTRY;?></td>
          <td><?php echo $row->other_country; ?>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _DESCRIPTION_INFORMATION;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="130px" class='fieldName' valign="top"><?php echo _INTERNAL_NOTES;?></td>
          <td colspan="3"><?php echo $row->notes; ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php }
function listContacts ($option, &$rows, &$pagination) {
	global $jfConfig;
?>
<form action="index.php" method="post" name="adminForm">
  <h2><?php echo _MY_ADDRESS_BOOK;?></h2>
  <div class="contentheading"><?php echo _JCONTACTS;?></div>
  <?php HTML_JCONTACTS::showFilter(); ?>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="tableList gray" style="text-align:left;">
    <tr class='sectiontableheader'>
      <th class="title"><?php echo _CONTACT_NAME_LABEL;?></th>
      <th class="title" width="100"><?php echo _ACCOUNT;?></th>
      <th class='title' width="100"><?php echo _PHONE; ?></th>
      <th class="title" width="100"><?php echo _JEMAIL;?></th>
    </tr>
    <?php
if ($rows) {
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
$name = ($row->last_name && $row->first_name) ? $row->last_name.", ".$row->first_name : $row->last_name;
?>
    <tr class="<?php echo "sectiontableentry$k"; ?>">
      <td><a href="index.php?option=com_jcontacts&task=viewContact&id=<?php echo $row->id;?>"><?php echo $name; ?></a></td>
      <td><a href="index.php?option=com_jcontacts&task=viewAccount&id=<?php echo $row->aid; ?>"><?php echo $row->name; ?>&nbsp</td>
      <td><?php echo $row->phone; ?>&nbsp</td>
      <td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a>&nbsp</td>
      <?php $k = 1 - $k; ?>
    </tr>
    <?php }
} else {
?>
    <tr class="sectiontableentry0">
      <td colspan="6" align="center"><strong><?php echo _NO_CONTACTS_AVAILABLE;?></strong></td>
    </tr>
    <?php } ?>
  </table>
  <table width="100%" cellpadding="4" style="margin: 0;" class="pageNav">
    <tr>
        <td valign="top" align="center">
            <?php echo $pagination->getPagesLinks(); ?>
            <br /><br />
        </td>
    </tr>
    <tr>
        <td valign="top" align="center">
            <?php echo $pagination->getPagesCounter(); ?>
        </td>
    </tr>
  </table>
  <input type="hidden" name="option" value="com_jcontacts" />
  <input type="hidden" name="task" value="myContacts" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'];?>" />
</form>
<? }
function listAccounts ($option, &$rows, &$pagination) {
	global $jfConfig;
?>

<form action="index.php" method="post" name="adminForm">
  <h2><?php echo _MY_ADDRESS_BOOK;?></h2>
  <div class="contentheading"><?php echo _JACCOUNTS;?></div>
  <?php HTML_JCONTACTS::showFilter(); ?>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="tableList gray" style="text-align:left;">
    <tr class='sectiontableheader'>
      <th class="title"><?php echo _ACCOUNT_NAME;?></th>
      <th class="title" width="100"><?php echo _PHONE; ?></th>
      <th class="title" width="100"><?php echo _FAX;?></th>
      <th class="title" width="100"><?php echo _WEBSITE;?></th>
    </tr>
    <?php
if ($rows) {
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
?>
    <tr class="<?php echo "sectiontableentry$k"; ?>">
      <td><a href="index.php?option=com_jcontacts&task=viewAccount&id=<?php echo $row->id;?>"><?php echo $row->name; ?></a>&nbsp;</td>
      <td><?php echo $row->phone; ?>&nbsp;</td>
      <td><?php echo $row->fax;?>&nbsp;</td>
      <td><a href="http://<?php echo $row->website; ?>"><?php echo $row->website; ?></a>&nbsp;</td>
      <?php $k = 1 - $k; ?>
    </tr>
    <?php }
} else {
?>
    <tr class="sectiontableentry0">
      <td colspan="6" align="center"><strong><?php echo _NO_ACCOUNTS_AVAILABLE;?></strong></td>
    </tr>
    <?php } ?>
  </table>
  <table width="100%" cellpadding="4" style="margin: 0;" class="pageNav">
    <tr>
        <td valign="top" align="center">
            <?php echo $pagination->getPagesLinks(); ?>
            <br /><br />
        </td>
    </tr>
    <tr>
        <td valign="top" align="center">
            <?php echo $pagination->getPagesCounter(); ?>
        </td>
    </tr>
  </table>
  <input type="hidden" name="option" value="com_jcontacts" />
  <input type="hidden" name="task" value="myAccounts" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'];?>" />
</form>
<? }
function viewAccount($option, $row, &$manager, &$contacts) {global $jcontacts_path, $jfConfig; ?>

<h2><?php echo _MY_ADDRESS_BOOK;?></h2>
<div class="contentheading"><?php echo _ACCOUNT_DETAILS;?></div>
<table width="100%" class="backButton">
  <tr>
    <td width="100%" align="right"><a href="index.php?option=com_jcontacts&task=myAccounts" class="button"><?php echo _BACK_BUTTON;?></a></td>
  </tr>
</table>
<div id="content-pane" class="pane-sliders">
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _ACCOUNT_INFO;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="150px" class='fieldName'><?php echo _ACCOUNT_NAME; ?></td>
          <td width="150px"><?php echo $row->name; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _RATING; ?></td>
          <td><?php echo $row->rating; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _ACCOUNT_SITE; ?></td>
          <td width="150px"><?php echo $row->site; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _PHONE; ?></td>
          <td><?php echo $row->phone; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _PARENT_ACCOUNT;?></td>
          <td width="150px"><?php echo $row->parent_account_id; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _FAX;?></td>
          <td><?php echo $row->fax; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _TYPE;?></td>
          <td width="150px"><?php echo $row->type; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _INDUSTRY;?></td>
          <td><?php echo $row->industry; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _ANNUAL_REVENUE;?></td>
          <td width="150px"><?php echo $row->annual_revenue; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _SIC_CODE;?></td>
          <td><?php echo $row->sic_code; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _MANAGER; ?></td>
          <td width="150px"><?php if ($manager!='') echo $manager[1]." [".$manager[2]."]"; ?>
            &nbsp;</td>
          <td width="150px" class='fieldName'>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _ADDRESS_INFO;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="150px" class='fieldName'><?php echo _BILLING_STREET; ?></td>
          <td width="150px"><?php echo $row->billing_street; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _SHIPPING_STREET; ?></td>
          <td><?php echo $row->shipping_street; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _BILLING_CITY; ?></td>
          <td width="150px"><?php echo $row->billing_city; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _SHIPPING_CITY; ?></td>
          <td><?php echo $row->shipping_city; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _BILLING_STATE; ?></td>
          <td width="150px"><?php echo $row->billing_state; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _SHIPPING_STATE; ?></td>
          <td><?php echo $row->shipping_state; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _BILLING_ZIP; ?></td>
          <td width="150px"><?php echo $row->billing_zip; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _SHIPPING_ZIP; ?></td>
          <td><?php echo $row->shipping_zip; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="150px" class='fieldName'><?php echo _BILLING_COUNTRY; ?></td>
          <td width="150px"><?php echo $row->billing_country; ?>&nbsp;</td>
          <td width="150px" class='fieldName'><?php echo _SHIPPING_COUNTRY; ?></td>
          <td><?php echo $row->shipping_country; ?>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _DESCRIPTION_INFORMATION;?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
          <td width="150px" class='fieldName' valign="top"><?php echo _INTERNAL_NOTES;?></td>
          <td colspan="3"><?php echo $row->notes; ?>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <?php if ($contacts) { ?>
  <div class="panel">
    <h3 class="jpane-toggler title"><span><?php echo _ASSOCIATED_CONTACTS; ?></span></h3>
    <div class="jpane-slider content">
      <table width="100%" border="0" cellspacing="0" cellpadding="5" class='tableList' align="left">
        <tr>
          <th width='50' align="center"><?php echo _JID; ?></th>
          <th class="title" width="250"><?php echo _JNAME; ?></th>
          <th class='title' width="150"><?php echo _PHONE; ?></th>
          <th class="title" width="250"><?php echo _JEMAIL;?></th>
        </tr>
        <?php			
		$k = 0;			
		foreach($contacts as $c) {			?>
        <tr class='row<?php echo $k; ?>'>
          <td align="center"><?php echo $c->id; ?></td>
          <td align="left"><a href="index.php?option=com_jcontacts&task=viewContact&id=<?php echo $c->id; ?>"><?php echo $c->last_name; ?>, <?php echo $c->first_name;?></a></td>
          <td><?php echo $c->phone; ?></td>
          <td><a href="mailto:<?php echo $c->email;?>"><?php echo $c->email; ?></a></td>
        </tr>
        <?php		   $k = 1 - $k;		   }		   ?>
      </table>
    </div>
  </div>
  <?php } ?>
</div>
<?php }} //End class?>
