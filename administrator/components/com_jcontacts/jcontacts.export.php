<?php
defined('_JEXEC') or die();
global $mainframe;
class JCONTACTS_export {
function exportWizard($step) {
	switch($step) {
		case 'showForm':
		JCONTACTS_export::exportForm();
		break;		
		
		case 'selectFields':
		JCONTACTS_export::selectFields();
		break;
		
		case 'nameFields':
		JCONTACTS_export::nameFields();
		break;
		
		case 'confirmExport':
		JCONTACTS_export::confirmExport();
		break;
		
		case 'exportData':
		JCONTACTS_export::exportData();
		break;		default:
		JCONTACTS_export::exportForm();
		break;	
	}
}

function exportForm() { ?>
<script type="text/javascript">
<!--
	function validateFileName() {
		if (document.adminForm.fileName.value=="") {
			alert("Please enter a file name.");
			return false;
		} else {
			return true;
		}
	}
-->
</script>
	<form action="index2.php" method="post" name="adminForm" onsubmit="return validateFileName();">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="center" colspan="4"><?php echo _EXPORT_WIZARD;?></td>
        </tr>
        <tr>
        	<td width="150px" class='fieldName'><?php echo _EXPORT_TYPE;?></td>
            <td>
            <select name="exportType">
            <option value="account_fields"><?php echo _JACCOUNTS;?></option>
            <option value="contact_fields"><?php echo _JCONTACTS;?></option>
            <option value="lead_fields"><?php echo _JLEADS;?></option>
            </select>
            </td>
        </tr>
    	<tr>
        	<td width="150px" class='fieldName'><?php echo _EXPORT_FILE_NAME;?></td><td><input type="text" name="fileName">.csv</td>
        </tr>
    </table>
    <br />
    <input type="submit" name="submit" value="<?php echo _NEXT;?>">
    <input type="hidden" name="option" value="com_jcontacts">
    <input type="hidden" name="task" value="exportWizard">
    <input type="hidden" name="step" value="selectFields">
    </form><?php }
function selectFields() {
include ('lib/lib.php'); 
	switch ($_POST['exportType']) {
		case 'contact_fields':
		$array = $contact_fields;
		$type = 'Contacts';
		break;
		
		case 'account_fields':
		$array = $account_fields;
		$type = 'Accounts';
		break;
		
		case 'lead_fields':
		$array = $lead_fields;
		$type = 'Leads';
		break;
	
	}
?>		
		<form action="index2.php" method="post" name="adminForm" onsubmit="selectAllOptions('field2');">
		<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
			<tr>
				<td class='headerQuotes' align="center" colspan="4"><?php echo _EXPORT_WIZARD;?></td>
			</tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _FIELD_SELECT;?></td><td class="bold"><?php echo _FIELD_SELECT_DESCRIPTION;?></td>
            </tr>
			<tr>
            	<td width="150" class="fieldName"><?php echo _EXPORT_TYPE;?></td><td><?php echo $type; ?></td>
            </tr>
			<tr>
            	<td width="150" class="fieldName"><?php echo _EXPORT_FILE_NAME;?></td><td><?php echo $_POST['fileName']; ?>.csv</td>
            </tr>
       </table>
       <table width="470" cellpadding="5" cellspacing='0' class='editView'>
			<tr>
                	<td><select id="field1" size="15" multiple style="width: 200px;">
					<?php 
						foreach ($array as $key=>$value) {
					?>
	   					<option value="<?php echo $key; ?>"><?php echo $value;?></option>
					<?php
						}
					?></select>
		       		</td>
                    <td width="50" align="center">
       
                    <input type="button" value="&gt;&gt;"
                             onclick="moveOptions(this.form.field1, this.form.field2);" /><br />
                    <input type="button" value="&lt;&lt;"
                             onclick="moveOptions(this.form.field2, this.form.field1);" />
					</td>
                    <td>
                    <select name="fields[]" id="field2" size="15" multiple style="width: 200px;">
                    </select></td>
        	</tr>
		</table>
		<br />
        <input type="button" name="back" value="<?php echo _BACK_BUTTON;?>" onclick="history.back()">
		<input type="submit" name="submit" value="<?php echo _NEXT;?>">
		<input type="hidden" name="option" value="com_jcontacts">
		<input type="hidden" name="task" value="exportWizard">
		<input type="hidden" name="step" value="nameFields">
		<input type="hidden" name="exportType" value="<?php echo $_POST['exportType']; ?>">
		<input type="hidden" name="fileName" value="<?php echo $_POST['fileName']; ?>.csv">
		</form>
		
<?php  }
function nameFields() { 
$fields = $_POST['fields'];
$count = count($fields);
$i=0;
	include("lib/lib.php");
	switch ($_POST['exportType']) {
		case 'contact_fields':
		$array = $contact_fields;
		$type = 'Contacts';
		break;
		
		case 'account_fields':
		$array = $account_fields;
		$type = 'Accounts';
		break;
		
		case 'lead_fields':
		$array = $lead_fields;
		$type = 'Leads';
		break;
	
	}	
?>
		<form action="index2.php" method="post" name="adminForm" onsubmit="selectAllOptions('field2');">
		<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
			<tr>
				<td class='headerQuotes' align="center" colspan="4"><?php echo _EXPORT_WIZARD;?></td>
			</tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _FIELD_NAME;?></td><td class="bold"><?php echo _FIELD_NAME_DESCRIPTION;?></td>
            </tr>
			<tr>
            	<td width="150" class="fieldName"><?php echo _EXPORT_TYPE;?></td><td><?php echo $type; ?></td>
            </tr>
			<tr>
            	<td width="150" class="fieldName"><?php echo _EXPORT_FILE_NAME;?></td><td><?php echo $_POST['fileName']; ?></td>
            </tr>
            <?php foreach ($fields as $field) { 
				echo "<tr>";
				echo "<td width='150' class='fieldName'>".$array[$field]."</td>";
				echo "<td><input type='text' name='fieldNames[]' id='fieldName_".$i."' /></td>";
				echo "</tr>";
				echo "<input type='hidden' name='fields[]' value='".$field."'>";
				$i++;
			} ?>
            
       </table>		<br />
        <input type="button" name="back" value="<?php echo _BACK_BUTTON;?>" onclick="history.back()">
		<input type="submit" name="submit" value="<?php echo _NEXT;?>">
		<input type="hidden" name="option" value="com_jcontacts">
		<input type="hidden" name="task" value="exportWizard">
		<input type="hidden" name="step" value="confirmExport">
		<input type="hidden" name="exportType" value="<?php echo $_POST['exportType']; ?>">
		<input type="hidden" name="fileName" value="<?php echo $_POST['fileName']; ?>">
		</form><?php 
}
function confirmExport() {
$fields = $_POST['fields'];
$fieldNames = $_POST['fieldNames'];
$count = count($fields);
$i=0;
	include("lib/lib.php");
	switch ($_POST['exportType']) {
		case 'contact_fields':
		$array = $contact_fields;
		$type = 'Contacts';
		break;
		
		case 'account_fields':
		$array = $account_fields;
		$type = 'Accounts';
		break;
		
		case 'lead_fields':
		$array = $lead_fields;
		$type = 'Leads';
		break;
	
	}	
?>
		<form action="index2.php" method="post" name="adminForm">
		<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
			<tr>
				<td class='headerQuotes' align="center" colspan="4"><?php echo _EXPORT_WIZARD;?></td>
			</tr>
			<tr>
            	<td width="150" class="fieldName"><?php echo _VERIFY_DETAILS;?></td><td class="bold"><?php echo _EXPORT_VERIFY_DETAILS_DESCRIPTION;?></td>
            </tr>
			<tr>
            	<td width="150" class="fieldName"><?php echo _EXPORT_TYPE;?></td><td><?php echo $type; ?></td>
            </tr>
			<tr>
            	<td width="150" class="fieldName"><?php echo _EXPORT_FILE_NAME;?></td><td><?php echo $_POST['fileName']; ?></td>
            </tr>
            <?php foreach ($fields as $field) { 
				$value = $fieldNames[$i] ? $fieldNames[$i] : "<span style='font-style:italic;'>Field name not specified.</span>";
				echo "<tr>";
				echo "<td width='150' class='fieldName'>".$array[$field]."</td>";
				echo "<td>".$value."</td>";
				echo "</tr>";
				echo "<input type='hidden' name='fields[]' value='".$field."'>";
				echo "<input type='hidden' name='fieldNames[]' value='".$fieldNames[$i]."'>";
				$i++;
			} ?>
            
       </table>		<br />
        <input type="button" name="back" value="<?php echo _BACK_BUTTON;?>" onclick="history.back()">
		<input type="submit" name="submit" value="<?php echo _EXPORT_DATA;?>">
		<input type="hidden" name="option" value="com_jcontacts">
		<input type="hidden" name="task" value="exportWizard">
		<input type="hidden" name="step" value="exportData">
		<input type="hidden" name="exportType" value="<?php echo $_POST['exportType']; ?>">
		<input type="hidden" name="fileName" value="<?php echo $_POST['fileName']; ?>">
		</form>
<?php
}function exportData() {
	$database = & JFactory::getDBO();
	global $mainframe;
	switch ($_POST['exportType']) {
		case 'contact_fields':
		$table = '#__jcontacts';
		break;
		
		case 'account_fields':
		$table = '#__jaccounts';
		break;		
		
		case 'lead_fields':
		$table = '#__jleads';
		break;	
	}	
	$fields = implode(", ", $_POST['fields']);	
	if($jfConfig['access_restrictions']==1 && $my->gid!='25') {
		$c_auth = "AND manager_id='$my->id'";
	} else { 
	$c_auth = ''; 
	}	
	$query = "SELECT ".$fields." FROM ".$table." WHERE published='1' ".$c_auth;
	$database->setQuery($query);
	$rows = $database->loadRowList();	$records[] = $_POST['fieldNames'];	for($i=0; $i<count($rows); $i++) {
		$records[] = $rows[$i];
	}	if (!is_dir(JPATH_COMPONENT.DS."tmp")) {
		mkdir(JPATH_COMPONENT.DS."tmp", 0755);
	}
	
	$file = JPATH_COMPONENT.DS."tmp/".$_POST['fileName'];
	$fd = fopen($file, "w");	
	foreach ($records as $record) {
		$line = implode(",", $record);
		fwrite($fd, $line."\n");
	}	
	fclose($fd);
	$live_site = $mainframe->getSiteURL();
	
	$mainframe->redirect($live_site."administrator/components/com_jcontacts/lib/download.php?fileName=".$_POST['fileName']);
}#End HTML_export
}
?>