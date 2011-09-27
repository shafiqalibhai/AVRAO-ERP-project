<?php
defined('_JEXEC') or die();
global $mainframe;
class JCONTACTS_import {
function importWizard($step) {
	switch($step) {
		case 'showForm':
		JCONTACTS_import::importForm();
		break;		
		
		case 'uploadFile':
		JCONTACTS_import::uploadFile();
		break;
		
		case 'confirmImport':
		JCONTACTS_import::confirmImport();
		break;
		
		case 'importData':
		JCONTACTS_import::importData();
		break;		
		
		case 'getLists':
		JCONTACTS_import::getLists(0);
		break;		
		
		default:
		JCONTACTS_import::importForm();
		break;	
	}}

function importForm() { ?>
<script type="text/javascript">
<!--
	function validateUpload() {
		if (document.adminForm.importFile.value=="") {
			alert("Please select a file to import.");
			return false;
		} else {
			return true;
		}
	}
-->
</script>
	<form action="index2.php" method="post" name="adminForm" enctype='multipart/form-data' onsubmit="return validateUpload();">
	<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerQuotes' align="center" colspan="4"><?php echo _IMPORT_WIZARD;?></td>
        </tr>
        <tr>
        	<td width="150px" class='fieldName'><?php echo _IMPORT_TYPE;?></td>
            <td>
            <select name="importType">
            <option value="account_fields"><?php echo _JACCOUNTS;?></option>
            <option value="contact_fields"><?php echo _JCONTACTS;?></option>
            <option value="lead_fields"><?php echo _JLEADS;?></option>
            </select>
            </td>
        </tr>
    	<tr>
        	<td width="150px" class='fieldName'><?php echo _IMPORT_FILE;?></td><td><input type="file" name="importFile" id="importFile" accept="text/csv"></td>
        </tr>
        <tr>
        	<td width="150px" class='fieldName'><?php echo _DELIMITING_CHARACTER;?></td><td><select name="delimiter"><option value=","><?php echo _COMMA;?></option><option value="tab"><?php echo _TAB;?></option></select></td>
        </tr>
    </table>
    <br />
    <input type="submit" name="submit" value="<?php echo _NEXT;?>">
    <input type="hidden" name="option" value="com_jcontacts">
    <input type="hidden" name="task" value="importWizard">
    <input type="hidden" name="step" value="uploadFile">
    </form><?php }
function uploadFile() {
	global $mainframe;
	
	$filename = strtolower($_FILES['importFile']['name']) ;
	$exts = split("[/\\.]", $filename) ;
	$n = count($exts)-1;
	$ext = $exts[$n]; 
	$filetypes = array('csv', 'txt');
	
	foreach ($filetypes as $t) {
		if ($ext==$t) {
			$valid=true;
		}
		if ($valid) {
			break;
		}
	}
	
	if ($valid==true) {
		if (!is_dir(JPATH_COMPONENT.DS."tmp")) {
			mkdir(JPATH_COMPONENT.DS."tmp", 0777);
		}
		$target_path = JPATH_COMPONENT.DS."tmp/";
		$target_path = $target_path . basename($filename); 

		if(move_uploaded_file($_FILES['importFile']['tmp_name'], $target_path)) {
			$file = $target_path;
			$type = $_POST['importType'];
			$delimiter = stripslashes($_POST['delimiter']);
	
			$fd = fopen($file, "r");
			
			while(!feof($fd)) {
				if ($delimiter=='tab') {
					$lines[] = fgetcsv($fd, '1000', "\t");
				} else { 
					$lines[] = fgetcsv($fd, '1000', $delimiter);
				}
			}
			fclose($fd);
			
			$fields = $lines[0];
	
			JCONTACTS_import::selectFields($fields, $type, $delimiter, $target_path);
			
		} else {
			$mainframe->redirect('index2.php?option=com_jcontacts&task=importWizard', _FILE_UPLOAD_ERROR);
		}
	} else {
		$mainframe->redirect('index2.php?option=com_jcontacts&task=importWizard', _FILE_TYPE_ERROR);
	}	
}
function selectFields($fields, $type, $delimiter, $target_path) {	
$t=explode("_",$type);
$f=array_pop(explode("/",$target_path));
?>
		
		<form action="index2.php" method="post" name="adminForm">
		<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
			<tr>
				<td class='headerQuotes' align="center" colspan="4"><?php echo _IMPORT_WIZARD;?></td>
			</tr>
            <tr>
                <td class='fieldName'><?php echo _CUSTOM_FIELD_MATCHING;?></td><td class="bold"><?php echo _CUSTOM_FIELD_MATCHING_DESCRIPTION;?></td>
            </tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _IMPORT_TYPE;?></td><td><?php echo ucwords($t[0]);?></td>
            </tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _IMPORT_FILE;?></td><td><?php echo $f;?></td>
            </tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _DELIMITING_CHARACTER;?></td><td><?php echo $delimiter=="tab" ? _TAB : _COMMA;?></td>
            </tr>
		<?php for($i=0; $i<count($fields); $i++) {
			$lists = JCONTACTS_import::getLists();
			echo "<tr>";
			echo "<td width='150px' class='fieldName'>".$fields[$i]."</td><td>".$lists[$type]."</td>";
			echo "<input type='hidden' name='fields[]' value='".$fields[$i]."'>";
			echo "</tr>";
		} ?>
		</table>
		<br />
        <input type="button" name="back" value="<?php echo _BACK_BUTTON;?>" onclick="history.back()">
		<input type="submit" name="submit" value="<?php echo _NEXT;?>">
		<input type="hidden" name="option" value="com_jcontacts">
		<input type="hidden" name="task" value="importWizard">
		<input type="hidden" name="step" value="confirmImport">
        <input type="hidden" name="type" value="<?php echo ucwords($t[0]);?>">
        <input type="hidden" name="file" value="<?php echo $f;?>">
        <input type="hidden" name="del" value="<?php echo $delimiter=="tab" ? _TAB : _COMMA;?>">
		<input type="hidden" name="delimiter" value="<?php echo $delimiter; ?>">
		<input type="hidden" name="importType" value="<?php echo $type; ?>">
		<input type="hidden" name="filePath" value="<?php echo $target_path; ?>">
		</form>
		
<?php  }
function confirmImport() {
	include("lib/lib.php");
	switch ($_POST['importType']) {
		case 'contact_fields':
		$array = $contact_fields;
		break;
		
		case 'account_fields':
		$array = $account_fields;
		break;
		
		case 'lead_fields':
		$array = $lead_fields;
		break;
	
	}	
?>
		
		<form action="index2.php" method="post" name="adminForm">
		<table width="100%" cellpadding="5" cellspacing='0' class='editView'>
			<tr>
				<td class='headerQuotes' align="center" colspan="4"><?php echo _IMPORT_WIZARD;?></td>
			</tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _VERIFY_DETAILS;?></td><td class="bold"><?php echo _VERIFY_DETAILS_DESCRIPTION;?></td>
            </tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _IMPORT_TYPE;?></td><td><?php echo $_POST['type'];?></td>
            </tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _IMPORT_FILE;?></td><td><?php echo $_POST['file'];?></td>
            </tr>
            <tr>
            	<td width="150" class="fieldName"><?php echo _DELIMITING_CHARACTER;?></td><td><?php echo $_POST['del'];?></td>
            </tr>
		<?php for($i=0; $i<count($_POST['fields']); $i++) {
			$key = $_POST['field_value'][$i];
			$value = $array[$key] ? $array[$key] : '<span style="font-style:italic;">No field selected.</span>';
			echo "<tr>";
			echo "<td width='150px' class='fieldName'>".$_POST['fields'][$i].":</td><td>".$value."</td>";
			echo "<input type='hidden' name='fields[]' value='".$_POST['fields'][$i]."'>";
			echo "<input type='hidden' name='field_value[]' value='".$_POST['field_value'][$i]."'>";
			echo "</tr>";
		} ?>
		</table>
		<br />
		<input type="button" name="back" value="<?php echo _BACK_BUTTON;?>" onclick="history.back()">
        <input type="submit" name="submit" value="<?php echo _IMPORT_DATA;?>">
		<input type="hidden" name="option" value="com_jcontacts">
		<input type="hidden" name="task" value="importWizard">
		<input type="hidden" name="step" value="importData">
		<input type="hidden" name="delimiter" value="<?php echo $_POST['delimiter']; ?>">
		<input type="hidden" name="importType" value="<?php echo $_POST['importType']; ?>">
		<input type="hidden" name="filePath" value="<?php echo $_POST['filePath']; ?>">
		</form>
		
<?php  }function importData() {
	$database = & JFactory::getDBO();
	global $mainframe;	
	switch ($_POST['importType']) {
		case 'contact_fields':
		$class = 'contacts';
		break;
		
		case 'account_fields':
		$class = 'accounts';
		break;
		
		case 'lead_fields':
		$class = 'leads';
		break;
	
	}
	$file = $_POST['filePath'];
	$delimiter = stripslashes($_POST['delimiter']);
	
	$fd = fopen($file, "r");
	
	while(!feof($fd)) {
		if ($delimiter == "tab") {
			$lines[] = fgetcsv($fd, '1000', "\t");
		} else { 
			$lines[] = fgetcsv($fd, '1000', $delimiter);
		}
	}	for ($i=1; $i<count($lines)-1; $i++) {
		$row = new $class($database);
		for ($k=0; $k<count($lines[$i]); $k++) {
			if ($_POST['field_value'][$k]) {
				$row->$_POST['field_value'][$k] = $lines[$i][$k];
			}
		}
		$row->published = 1;
		$row->created = date('Y-m-d H:i:s');
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}  
	}
	unlink($file);
	rmdir(JPATH_COMPONENT.DS."tmp");
	$mainframe->redirect ('index2.php?option=com_jcontacts', _IMPORT_SUCCESSFUL);
}
function getLists() {	
	include("lib/lib.php");
	$c_array[] = JHTML::_('select.option','', '');
	while(list($key, $value) = each($contact_fields)) {
		$c_array[] = JHTML::_('select.option',$key, $value);
	}	
	$lists['contact_fields'] = JHTML::_('select.genericlist',$c_array, 'field_value[]', 'class="inputbox"', 'value', 'text', '' );
	
	$a_array[] = JHTML::_('select.option','', '');
	while(list($key, $value) = each($account_fields)) {
		$a_array[] = JHTML::_('select.option',$key, $value);
	}	
	$lists['account_fields'] = JHTML::_('select.genericlist',$a_array, 'field_value[]', 'class="inputbox"', 'value', 'text', '' );
	
	$l_array[] = JHTML::_('select.option','', '');
	while(list($key, $value) = each($lead_fields)) {
		$l_array[] = JHTML::_('select.option',$key, $value);
	}	
	$lists['lead_fields'] = JHTML::_('select.genericlist',$l_array, 'field_value[]', 'class="inputbox"', 'value', 'text', '');
	
	return $lists;
	
}#End HTML_import
}
?>