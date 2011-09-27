<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
// Invoice Functions
class HTML_cP {

/* Menu */
	
	function style() {
	global $mainframe;
?>
	<link href="components/com_jaccounts/css/admin_style.css" rel="stylesheet" type="text/css" />
	<script src="components/com_jaccounts/js/admin_jaccounts.js"></script>
	<?php
	}

function startMenu( $task ) {
	$user = & JFactory::getUser();
		HTML_cP::style();
	if(JRequest::getVar('tmpl','')!='component' && jAccessHelper::checkLocation()!=0){ 
	?>
	<table cellpadding="3" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left" valign="top" width="160" height="0">
			<span class='menu_title1'><?php echo _INVOICES; ?></span>
			<?php echo jAccessHelper::createMenuBar('jAccounts'); ?>
			<?php if ($user->gid == '25') { ?>
			<span class='menu_title'><?php echo _CONFIGURATION_MENU; ?></span>
			  <ul class='jForceMenu'><li><a href="index.php?option=com_jaccounts&task=config" class='config'><?php echo _CONFIG_MENU_LINK; ?></a></li>
              <li><a href="index.php?option=com_jaccounts&task=About" class='about'><?php echo _ABOUT_MENU_LINK; ?></a></li></ul>
			<?php } ?>
	  </td>

		<td align="left" valign="top">
		<?php 
	} elseif(jAccessHelper::checkLocation()==0) {
		require_once(JPATH_SITE.'/libraries/joomla/html/toolbar.php');
		?><table width='100%' cellpadding='0' cellspacing='0'><tr><td><?php
		include(JPATH_COMPONENT.DS.'lib'.DS.'menu.jaccounts.php' );
		?></td></tr></table><?php
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
	$database = & JFactory::getDBO();

   $path = JPATH_SITE."/administrator/components/com_jaccounts/jaccounts.cpanel.php";
   if (file_exists( $path )) {
          require $path;
      } else {
          echo '<br />.... help!!';
         mosLoadAdminModules( 'cpanel', 1 );
      }
 }  

function About($option) {
	$database = & JFactory::getDBO();
   $path = JPATH_SITE."/administrator/components/com_jaccounts/jaccounts.about.php";
   if (file_exists( $path )) {
          require $path;
      } else {
        jAccountsController::controlPanel($option);
      }


}

/*Configuration */

   function showConfig( &$jfConfig, &$lists, $option ) {
   	global $config;
?>
<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			
			if(pressbutton=="") {
				submitform( pressbutton);
				return;
			}
			// do field validation
			if (form.cfg_payment_gateway.value == "1" && form.cfg_paypal_address.value==""){
				alert( "Please enter a PayPal Address" );
			} else if (form.cfg_payment_gateway.value == "2" && form.cfg_google_merchant_id.value==""){
				alert( "Please enter a Google Merchant ID" );
			} else if (form.cfg_payment_gateway.value == "3" && form.cfg_authorize_API.value==""){
				alert( "Please enter an Authorize.net API");
			} else if (form.cfg_payment_gateway.value == "4" && form.cfg_2checkout_sid.value==""){
				alert( "Please enter a 2Checkout SID");
			} else {
				submitform( pressbutton );
			}
		}
</script>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class='tableList'>
		<tr class='tableListHeader' >
			<td align="left">jAccounts <?php echo _CONFIGURATION_MANAGER; ?></td>
		</tr>
	</table>
<br />
   <form action="index.php" method="post" name="adminForm">
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
         <td align="left" valign="top"><?php echo _DESCRIPTION_COMPANY_NAME; ?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _COMPANY_ADDRESS; ?></td>
         <td align="left" valign="top"><textarea name="cfg_company_address" cols='28' rows='4'><?php echo htmlspecialchars(stripslashes($jfConfig['company_address'])); ?></textarea></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_COMPANY_ADDRESS; ?></td>
      </tr>
       <tr>
         <td align="left" valign="top"><?php echo _COMPANY_EMAIL; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_company_email" value="<?php echo htmlspecialchars(stripslashes($jfConfig['company_email'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_COMPANY_EMAIL; ?><br /></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _TERMS_AND_CONDITIONS; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_terms" value="<?php echo htmlspecialchars(stripslashes($jfConfig['terms'])); ?>" size="40"/></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_TERMS_CONDITIONS; ?></td>
      </tr>
      <tr>
         <td align="left" valign="top"><?php echo _ENABLE_ACCESS_RESTRICTIONS; ?></td>
         <td align="left" valign="top"><input type="checkbox" name="cfg_access_restrictions" value="1" <?php echo $jfConfig['access_restrictions'] == 1 ? "checked" : "" ?> /></td>
         <td align="left" valign="top"><?php echo _DESCRIPTION_ACCESS_RESTRICTIONS; ?></td>
      </tr>
	  <tr>
	  	 <td align='left' valign='top'><?php echo _CURRENCY; ?></td>
		 <td align='left' valign='top'><?php echo $lists['currency']; ?></td>
		 <td align='left' valign='top'><?php echo _CURRENCY_DESCRIPTION; ?></td>
	  </tr>
	  <tr>
	  	 <td align='left' valign='top'><?php echo _TAX; ?></td>
		 <td align='left' valign='top'><input type="text" name="cfg_tax" value="<?php echo htmlspecialchars(stripslashes($jfConfig['tax'])); ?>" size="10"/></td>
		 <td align='left' valign='top'><?php echo _TAX_DESCRIPTION; ?></td>
	  </tr>
</table><br />
      </div>
</div>
<div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _INVOICING; ?></span></h3>
      <div class="jpane-slider content">
	<table cellpadding="4" cellspacing="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME; ?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTING; ?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION; ?></th>
      </tr>
	<tr>
    	<td align="left" valign="top"><?php echo _AUTO_INVOICING; ?></td>
        <td align="left" valign="top"><?php echo $lists['auto_generate_invoice']; ?></td>
         <td align="left" valign="top"><?php echo _AUTO_INVOICING_DESCRIPTION; ?></td>
    <tr>
         <td align="left" valign="top"><?php echo _INVOICE_FORMAT; ?></td>
         <td align="left" valign="top"><?php echo $lists['invoice_format']; ?></td>
         <td align="left" valign="top"><?php echo _INVOICE_FORMAT_DESCRIPTION; ?></td>
      </tr>
      
</table><br />
</div>
</div>
<div class="panel">
      <h3 class="jpane-toggler title"><span><?php echo _BILLING; ?></span></h3>
      <div class="jpane-slider content">
	<table cellpadding="4" cellspacing="0" width="100%" class="moduleTable">
      <tr class='tableListHeader' >
         <th width="20%" align="left"><?php echo _JNAME; ?></th>
         <th width="20%" align="left"><?php echo _CURRENT_SETTING; ?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION ?></th>
      </tr>
	<tr>
    	<td align="left" valign="top"><?php echo _DEFAULT_GATEWAY; ?></td>
        <td align="left" valign="top"><?php echo $lists['payment_gateway']; ?></td>
         <td align="left" valign="top"><?php echo _DEFAULT_GATEWAY_DESCRIPTION; ?></td>
    <tr>
         <td align="left" valign="top"><?php echo _PAYPAL_ADDRESS; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_paypal_address" value="<?php echo htmlspecialchars(stripslashes($jfConfig['paypal_address'])); ?>" size='40' /></td>
         <td align="left" valign="top"><?php echo _PAYPAL_DESCRIPTION; ?></td>
   	</tr>
     <tr>
         <td align="left" valign="top"><?php echo _GOOGLE_ID; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_google_merchant_id" value="<?php echo htmlspecialchars(stripslashes($jfConfig['google_merchant_id'])); ?>" size='40' /></td>
         <td align="left" valign="top"><?php echo _GOOGLE_DESCRIPTION; ?></td>
   	</tr>
     <tr align="center" valign="middle">
         <td align="left" valign="top"><?php echo _AUTHORIZE_LOGIN; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_authorize_API" value="<?php echo htmlspecialchars(stripslashes($jfConfig['authorize_API'])); ?>" size='40' /></td>
         <td align="left" valign="top"><?php echo _AUTHORIZE_DESCRIPTION; ?></td>
   	</tr>
     <tr align="center" valign="middle">
         <td align="left" valign="top"><?php echo _AUTHORIZE_KEY; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_authorize_API_key" value="<?php echo htmlspecialchars(stripslashes($jfConfig['authorize_API_key'])); ?>" size='40' /></td>
         <td align="left" valign="top"><?php echo _AUTHORIZE_KEYDESCRIPTION; ?></td>
   	</tr>
     <tr align="center" valign="middle">
         <td align="left" valign="top"><?php echo _AUTHORIZE_TESTMODE; ?></td>
         <td align="left" valign="top"><?php echo $lists['authorize_test'];?></td>
         <td align="left" valign="top"><?php echo _AUTHORIZE_TEST_DESCRIPTION; ?></td>
   	</tr>
    
         <tr align="center" valign="middle">
         <td align="left" valign="top"><?php echo _CHECKOUT_SID; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_2checkout_sid" value="<?php echo htmlspecialchars(stripslashes($jfConfig['2checkout_sid'])); ?>" size='40' /></td>
         <td align="left" valign="top"><?php echo _CHECKOUT_DESCRIPTION; ?></td>
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
         <th width="20%" align="left"><?php echo _CURRENT_SETTING; ?></th>
         <th width="60%" align="left"><?php echo _DESCRIPTION ?></th>
      </tr>
 <tr><td colspan="5"><strong><?php echo _JREQUIRED; ?></strong><hr /></td></tr>
          <tr><td colspan='3'></td></tr>
       <tr>
         <td align="left" valign="top"><?php echo _ACCEPTED_QUOTE_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_accepted_quote_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['accepted_quote_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _ACCEPTED_QUOTE_SUBJECT_DESCRIPTION; ?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><?php echo _ACCEPTED_QUOTE; ?></td>
        <td align="left" valign="top"><textarea name="cfg_accepted_quote_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['accepted_quote_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _ACCEPTED_QUOTE_DESCRIPTION; ?><br /><br />%CLIENT_NAME%<br />%COMPANY_NAME%</td>
      </tr>
      <tr><td colspan="5"><strong><?php echo _JOPTIONAL; ?>:</strong><hr /></td></tr>
      <tr>
         <td align="left" valign="top"><?php echo _AUTOMATED_EMAIL; ?></td>
         <td align="left" valign="top"><?php echo $lists['auto_email']; ?></td>
         <td align="left" valign="top"><?php echo _AUTOMATED_EMAIL_DESCRIPTION; ?></td>
    </tr>
      <tr>
         <td align="left" valign="top"><?php echo _NEW_QUOTE_EMAIL_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_quote_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_quote_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_QUOTE_EMAIL_SUBJECT_DESCRIPTION; ?></td>
    </tr>
	<tr>
	   	<td align="left" valign="top"><?php echo _NEW_QUOTE_EMAIL; ?></td>
        <td align="left" valign="top"><textarea name="cfg_new_quote_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_quote_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_QUOTE_EMAIL_SUBJECT; ?><br /><br />Available variables: <br /><br />%CLIENT_NAME%<br />%QUOTE_NAME%<br />%QUOTE_AMOUNT%<br />%COMPANY_NAME%</td>
    </tr>
    <tr><td colspan='3'></td></tr>
       <tr>
         <td align="left" valign="top"><?php echo _NEW_INVOICE_EMAIL_SUBJECT; ?></td>
         <td align="left" valign="top"><input type="text" name="cfg_new_invoice_subject" value="<?php echo htmlspecialchars(stripslashes($jfConfig['new_invoice_subject'])); ?>" size='50' /></td>
         <td align="left" valign="top"><?php echo _NEW_INVOICE_EMAIL_SUBJECT_DESCRIPTION; ?></td>
    </tr>
    <tr>
        <td align="left" valign="top"><?php echo _NEW_INVOICE_EMAIL; ?></td>
        <td align="left" valign="top"><textarea name="cfg_new_invoice_email" cols='35' rows='8'><?php echo htmlspecialchars(stripslashes($jfConfig['new_invoice_email'])); ?></textarea></td>
        <td align="left" valign="top"><?php echo _NEW_INVOICE_EMAIL_DESCRIPTION; ?><br /><br />Available variables: <br /><br />%CLIENT_NAME%<br />%INVOICE_NAME%<br />%INVOICE_AMOUNT%<br />%COMPANY_NAME%</td>
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
   }

function showFilter() {
$option = JRequest::getCmd('option');
$task = JRequest::getCmd('task');
$link = "index.php?option=".$option."&task=".$task;
$link .= $task == 'clientPopup' ? "&tmpl=component" : "";
$alphabet = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$adminlocation = jAccessHelper::checkLocation();
if (!$adminlocation) {
	global $Itemid;
	echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
}
?>
<table width='100%' cellpadding='4' class='editView' border="0" cellspacing="0">
	<tr>
		<td class='headerInvoices' colspan="2" align="left"><?php echo _FILTER; ?></td>
    </tr>
    <tr>
		<td width='260'><?php echo _FILTER; ?>: <input type="text" name="filter" />&nbsp;<input type="submit" name="<?php echo _JSUBMIT; ?>" value="Submit" class='button small' /></td>
    	<td align="left">
        <?php foreach ($alphabet as $a) { ?>
        	<a href="<?php echo $link."&alpha=".$a;?>" class = 'alpha'><?php echo strtoupper($a);?></a>&nbsp;
        <?php } ?>
        <a href="<?php echo $link;?>" class='alpha'><?php echo _SHOW_ALL; ?></a>
        </td>
	</tr>
</table>
<br />
<?php
}

function clientPopup($option, &$rows, $pagination) {
?>
<form action="index.php" method="post" name='adminForm' >
<?php HTML_cP::showFilter(); ?>
<br />
<table width="100%" cellpadding="5" class="moduleTable">
	<thead>
	<tr>
		<td align='center' width="25" class='tableListHeader'><?php echo _JID; ?></td>
    	<td align='left' class='tableListHeader'><?php echo _JNAME; ?></td>
		<td align='left' class='tableListHeader'><?php echo _JUSERNAME; ?></td>
		<td class='tableListHeader'><?php echo _JEMAIL; ?></td>
    </tr>
	</thead>
	<tbody>
	<?php 
	$i = 0;
	if($rows) { 
	foreach ($rows as $row) {
		$name = $row->name;
	echo "<tr class='row".$i."'><td align='center'>".$row->id."</td><td><a href='#' onClick=\"window.parent.jAccountsClient('".$row->id."','".$name."','".$row->username."')\">".$name."</a></td><td align='left' width='125px'>".$row->username."</td><td width='175px' align='left'>".$row->email."</td></tr>";
	$i = 1 - $i;
	} } else { 
	echo "<tr class='row1'><td colspan='3' align='center'>No clients available.</td></tr>";
	}
	?>
</tbody>
<tfoot>
   <tr>
		<td colspan='4' align='center'>
		<?php 
			echo $pagination->getPagesLinks();
		?>
        </td>
	</tr>
</tfoot>
</table>
<input type="hidden" name="option" value="com_jaccounts" />
<input type="hidden" name="task" value="clientPopup" />
<input type="hidden" name="tmpl" value="component" />
<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
</form>

<?php
}
function servicesPopup($option, &$rows, &$pagination) { 
?>
<form action="index.php" method="post" name='adminForm' >
<?php HTML_cP::showFilter(); ?>
<table width="100%" cellpadding="5"  class="moduleTable">
	<thead>
	<tr>
    	<td align='left' class='tableListHeader'><?php echo _SERVICE; ?></td><td align='left' class='tableListHeader'><?php echo _SERVICE_DESCRIPTION; ?></td><td align="left" class='tableListHeader'><?php echo _STANDARD_PRICE; ?></td>
    </tr>
	</thead>
	<tbody>
	<?php 
	$i = 0;
	if($rows) { 
	foreach ($rows as $row) {
		if(strlen($row->product_description) > 20) { 
	$d = strpos($row->product_description, " ", 20);
	$description = substr($row->product_description, 0, $d)."...";
} elseif($row->product_description=="") { 
	$description = "&nbsp;";
} else {
	$description = $row->product_description;
}
	echo "<tr class='row".$i."'><td width='175'><a href='#' onClick=\"window.parent.jAccountsService('".$row->id."','".$row->productname."','".$row->unit_price."')\">".$row->productname."</a></td><td>".$description."&nbsp;</td><td width='100px'>".$row->unit_price."</td></tr>";
	$i = 1 - $i;
	} } else { 
		echo "<tr class='row1'><td colspan='3' align='center'>No services available for use.</td></tr>";
	}
	?>
	</tbody>
<tfoot>
   <tr>
		<td colspan='3' align='center'>
			<?php echo $pagination->getPagesLinks(); ?>
        </td>
	</tr>
</tfoot>
</table>
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="servicesPopup" />
<input type="hidden" name="tmpl" value="component" />
<input type="hidden" name="limitstart" value="<?php echo $limitstart; ?>" />
</form>
<?php
}
}
class HTML_invoices {
function viewInvoice($option, &$row, &$user, &$services, &$appliedservices, &$manager, &$paymentmethod, &$mid) {
	global $jfConfig;
?>
    <form action="index.php" method="post" name="adminForm">
    	 <?php
$adminlocation = jAccessHelper::checkLocation();
if (!$adminlocation) {
	global $Itemid;
	echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
}
?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
	</form> 
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<td class='headerInvoices' align="left" colspan="4"><?php echo _INVOICE_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150px" class='fieldName'><?php echo _INVOICE_NAME; ?>&nbsp;</td>
			<td width="300px"><?php echo $row->subject; ?></td>
			<td width="150px" class='fieldName'><?php echo _VALID_TILL; ?>&nbsp;</td>
            <td><?php echo $row->validtill; ?></td>
		</tr>
		<tr>
			<td class='fieldName'><?php echo _CLIENT; ?>&nbsp;</td>
            <td><?php echo $user; ?></td>
            <td class='fieldName'><?php echo _ACCOUNT; ?>&nbsp;</td>
            <td><?php echo $row->accountid; ?>&nbsp;</td>
	  </tr>
        <tr>
        	<td class='fieldName'><?php echo _INVOICE_STAGE; ?>&nbsp;</td>
            <td>
            	<?php echo $row->invoicestatus; ?>&nbsp;            </td>
            <td class='fieldName'><?php echo _PROJECT; ?>&nbsp;</td>
            <td><?php echo $row->projectid; ?>&nbsp;</td>
        </tr>
		<tr>
			<td class='fieldName'><?php echo _PUBLISHED; ?>&nbsp;</td>
			<td>
				<?php echo $row->published == 1 ? _YES : _NO; ?>            </td>
            <td class='fieldName'><?php echo _MANAGER; ?>&nbsp;</td>
            <td><?php echo $manager ? $manager."&nbsp;:&nbsp;:&nbsp;" : "&nbsp;"; ?><?php echo $mid; ?>&nbsp;</td>
		</tr>
		<tr>
		  <td class='fieldName'><?php echo _PAYMENT_METHOD; ?>:&nbsp;</td>
		  <td><?php echo $paymentmethod; ?></td>
		  <td class='fieldName'>&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _SERVICE_DETAILS; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='serviceTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'></th>
				<th align='left'><?php echo _SERVICE; ?></th>
				<th align='left' width='75'><?php echo _QUANTITY; ?></th>
				<th align='left' width='75'><?php echo _PRICE; ?></th>
				<th align='left' width='75'><?php echo _TOTAL; ?></th>
			</tr>
        <?php if($appliedservices){
			$k = 0;
			foreach($appliedservices as $as) {
		?>
		<tr class='row<?php echo $k; ?>'>
        	<td valign='top'>&nbsp;</td>
	        <td valign='top'>
            	<table border="0" cellpadding="1" cellspacing="0" width="100%">
                	<tr>
                    				<td style="border: none;"><strong><?php echo $as->productname; ?></strong>			                        </td>
	        	  </tr>
	                    		<tr>
    			                	<td style="border: none;" id="setComment<?php echo $j; ?>"><?php echo $as->comment; ?>                			        </td>
			                    </tr>
		        </table>                       	</td>
						<td valign='top'><?php echo $as->quantity;?></td>
            			<td valign='top'><?php echo $as->listprice; ?></td>
						<td valign='bottom' id="productTotal<?php echo $j; ?>" align="right">
							<?php $totalcost = $as->listprice * $as->quantity; 
									printf ("%01.2f", $totalcost); 
							?>                       </td>
		  </tr>
		<?php $k = 1 - $k;
			} 
		}
		?>
	</table>
	    <table class='totalTable' cellpadding='5' width="100%" cellspacing="0">
		<tr valign="top">
        <th colspan='3'></th>
		<th align="right" width="100px">&nbsp;</th></tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _NET_TOTAL; ?></strong></td>
		<td id="subTotal" align="right"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->subtotal == "") { echo "0.00"; } else { echo $row->subtotal; } ?></td>
   		</tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _TAX_RATE; ?></strong></td>
		<td align="right" style="border-bottom:1px solid #000000;"><?php if ($row->total!='' || $row->subtotal != '') { echo round((($row->total / $row->subtotal) * 100 - 100), 2);} else { echo "0.00"; } ?>%</td>
   		</tr>		
		<tr>
        <td colspan='3' align="right"><strong><?php echo _GRAND_TOTAL; ?></strong></td>
		<td id="grandTotalDisplay" align="right"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->total == "") { echo "0.00"; } else { echo $row->total; } ?></td>
   		</tr>
	</table>
        </td></tr>
        </table>
<? 
}

function editInvoice($option, &$row, &$user, &$services, &$appliedservices, &$lists, &$paymentmethods) {
	JRequest::setVar( 'hidemainmenu', 1 );
	
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	
		$js = "
		function jAccountsClient(id, name, username) {
		title = name+\" [\"+username+\"]\";
			document.getElementById('contactid').value = id;
			document.getElementById('contactname').value = title;
		    document.getElementById('client_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}
 		
		function jAccountsService(id,txt,price) {
			var tableName = document.getElementById('serviceTable');
			var prev = tableName.rows.length;
    		var count = eval(prev)-1;
		    document.getElementById(\"serviceid\"+count).value = id;
			document.getElementById(\"service\"+count).value = txt;
			document.getElementById(\"listprice\"+count).value = price;
			document.getElementById(\"quantity\"+count).value= 1;
			document.getElementById(\"quantity\"+count).focus();			
			document.getElementById('sbox-window').close();	
		}
		
		window.addEvent('domready', function() {  myCal = new Calendar({ validtill: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });
		";

	$doc->addScriptDeclaration($js);

	global $my, $jfConfig;

		jimport('joomla.utilities.date');
		JHTML::_('behavior.modal', 'a.modal');
		
		$link = 'index.php?option=com_jaccounts&amp;task=clientPopup&amp;tmpl=component';

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

		if (pressbutton == 'listInvoices') {
			submitform( pressbutton );
			return;
		}

		// do field validation
		if (form.subject.value == ""){
			alert( "Invoice must have a title" );
		} else if (form.contactid.value == ""){
			alert( "You must select a Client." );
		} else if (form.validtill.value == ""){
			alert( "You must set a valid date." );
		} else if (form.gid.value == ""){
			alert( "You must select a managing group." );
		} else {
			submitform( pressbutton );
		}
	}
//-->
</script>
<form action="index.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
<tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _INVOICE_DETAILS; ?></td>
      </tr>
        <tr>
			<td width="150px" class="<?php echo $row->subject ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id='subject_label'><?php echo _INVOICE_NAME; ?></td>
		  <td width="300px" class='fieldValue'><input type="text" name="subject" id="subject" value="<?php echo $row->subject; ?>" size="40"  onchange="checkElement('subject');" /></td>
			<td width="150px" class="<?php echo $row->validtill ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id='validtill_label'><?php echo _VALID_TILL; ?></td>
<td class='fieldValue'><input class="calendar" type="text" name="validtill" id="validtill" onchange="checkElement('validtill');" value="<?php echo $row->validtill; ?>" /></td>
		</tr>
		<tr>
			<td align="right" class="<?php echo $row->contactid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id="client_label"><?php echo _CLIENT; ?></td>
          <td class='fieldValue'>
            <input type='hidden' name='contactid' id='contactid' value='<?php echo $row->contactid;?>' /><input style="background: #ffffff;" type="text" id="contactname" value="<?php echo $user[1]. "[". $user[2]."]"; ?>" disabled="disabled" /><a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jaccounts/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a></td>
            <td align="right" class='fieldName'><?php echo _ACCOUNT; ?></td>
          <td class='fieldValue'><input type='text' name='accountid' id='accountid' value='<?php echo $row->accountid; ?>' /></td>
		</tr>
        <tr>
        	<td class='fieldName'><?php echo _INVOICE_STAGE; ?></td>
          <td class='fieldValue'>
            <select name="invoicestatus">
            	<?php 
                $stages=array(_PENDING,_PAID);
				foreach($stages as $stage) {
				if($row->invoicestatus == $stage) {
					echo "<option value=".$row->invoicestatus." selected>".$row->invoicestatus."</option>";
				} else {
					echo "<option value=".$stage.">".$stage."</option>";
				}
				}
				?>
            </select>            </td>
            <td class='fieldName'><?php echo _PROJECT; ?></td>
          <td class='fieldValue'><input type='text' name='projectid' id='projectid' value='<?php echo $row->projectid;?>' /></td>
        </tr>
		<tr>
			<td class='fieldName'><?php echo _PUBLISHED; ?>:</td>
		  <td class='fieldValue'>
			<?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?></td>
            <td class='fieldName'><?php echo _MANAGER; ?></td>
<td class='fieldValue'><div style="float:left; margin-right:10px;"><?php echo $lists['groups']; ?></div><div id="managerList" style="float:left;"><?php echo $lists['mid']; ?></div>&nbsp;</td>
		</tr>
		<tr>
		  <td class='fieldName'><?php echo _PAYMENT_METHOD; ?>:</td>
		  <td class='fieldValue'><?php echo $paymentmethods['paymentmethods']; ?></td>
		  <td class='fieldName'>&nbsp;</td>
		  <td class='fieldValue'>&nbsp;</td>
	  </tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _SERVICE_DETAILS; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='serviceTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='left'><?php echo _SERVICE; ?></th>
				<th align='left' width='75'><?php echo _QUANTITY; ?></th>
				<th align='left' width='75'><?php echo _PRICE; ?></th>
				<th align='left' width='75'><?php echo _TOTAL; ?></th>
			</tr>
        <?php if($appliedservices){
        	$j = 1;
			$k = 0;
			foreach($appliedservices as $as) {
?>
					<tr id="row<?php echo $j; ?>" class='row<?php echo $k; ?>'>
       				  <td valign='top'><img src="<?php echo JURI::base();?>components/com_jaccounts/images/publish_x.png" border="0" onclick="deleteRow('<?php echo $j; ?>')"><input type="hidden" id="deleted<?php echo $j; ?>" name="deleted<?php echo $j; ?>" value="0"></td>
				        <td valign='top'>
                        	<table border="0" cellpadding="1" cellspacing="0" width="100%">
                               	<tr>
			            	                   	<td style="border: none;"><input id="serviceid<?php echo $j; ?>" name="serviceid<?php echo $j; ?>" type="hidden" value="<?php echo $as->serviceid; ?>" ><input id="service<?php echo $j; ?>" name="service<?php echo $j; ?>" value="<?php echo $as->productname; ?>" readonly="readonly" type="text" style="width: 350px;"><!--<a class="modal" href="<?php echo $serviceLink; ?>" rel="{handler: 'iframe', size: {x: 650, y: 375}}"><img src="components/com_jaccounts/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a>--></td>
           			       	  </tr>
			                                <tr>
            			                    	<td style="border: none;" id="setComment<?php echo $j; ?>"><textarea id="comment" name="comment<?php echo $j; ?>" style="width: 350px; height:40px"><?php echo $as->comment; ?></textarea><br>
            			                    	  [<a href="#" onClick="javascript:getObj('comment<?php echo $j; ?>').value=''";>Clear Comment</a>]                                                </td>
                                         	</tr>
                      </table>                                  	</td>
									<td valign='top'><input id="quantity<?php echo $j; ?>" name="quantity<?php echo $j; ?>" type="text" style="width:50px" onBlur="javascript:settotalnoofrows(); calcTotal('<?php echo $jfConfig['tax']; ?>');" value="<?php echo $as->quantity;?>"/></td>
						            <td valign='top'><input id="listprice<?php echo $j; ?>" name="listprice<?php echo $j; ?>" value="<?php echo $as->listprice; ?>" type="text" style="width:70px" onBlur="javascript:calcTotal();"/></td>
						<td valign='bottom' id="productTotal<?php echo $j; ?>" align="right">
							<?php $totalcost = $as->listprice * $as->quantity; 
									printf ("%01.2f", $totalcost); 
							?>                        </td>
					</tr>
		<?php
		$j++;
		$k = 1 - $k;	
				}
		?>
		<input type="hidden" name="totalProductCount" id="totalProductCount" value="<?php echo $j-1; ?>">
        <?php
		} else {
		?>
		<input type="hidden" name="totalProductCount" id="totalProductCount" value="">
		<? } ?>
    </table><br />&nbsp;
<a class="modal button" href="index.php?option=com_jaccounts&amp;task=servicesPopup&amp;tmpl=component" rel="{handler: 'iframe', size: {x: 700, y: 375}}" onclick="fnAddProductRow();">Add Service</a>
	<br /><br />
	    <table class='totalTable' cellpadding='5' width="100%">
		<tr valign="top">
        <th colspan='4'>&nbsp;</th>
		</tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _NET_TOTAL; ?></strong></td>
		<td id="subTotal" align="right" width="100px"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->subtotal == "") { echo "0.00"; } else { echo $row->subtotal; } ?></td>
   		</tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _TAX_RATE; ?></strong></td>
		<td align="right" style="border-bottom:1px solid #000000;"><?php echo $jfConfig['tax']; ?>%</td>
   		</tr>		
		<tr>
        <td colspan='3' align="right"><strong><?php echo _GRAND_TOTAL; ?></strong></td>
		<td id="grandTotalDisplay" align="right"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->total == "") { echo "0.00"; } else { echo $row->total; } ?></td>
   		</tr>
	</table>
        </td></tr>
        </table>
        </td></tr>
  </table>
   <?php
$adminlocation = jAccessHelper::checkLocation();
if (!$adminlocation) {
	global $Itemid;
	echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
}
?>
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name="subtotal" id="subtotal" value="<?php echo $row->subtotal; ?>">
<input type="hidden" name='currency' id='currency' value="<?php echo $jfConfig['currency']; ?>" >
<input type="hidden" name='taxrate' id='taxrate' value="<?php echo $jfConfig['tax']; ?>" >
<input type="hidden" name="total" id="total" value="<?php echo $row->total; ?>">
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 

<? 
}
function listInvoices ($option, &$rows, $page) {
		global $my, $acl, $config;
		$database = & JFactory::getDBO();
		jimport('joomla.utilities.date');
		$adminlocation = jAccessHelper::checkLocation();

?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteInvoice') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteInvoice');
				}
			} else if (pressbutton =='editInvoice') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editInvoice');
				}
			} else {
				submitform(pressbutton);
			}
		}
		</script>
<form action="index.php" method="post" name="adminForm">
<?php 
	HTML_cP::showFilter();
?>
<table cellpadding="3" cellspacing="0" border="0" width="100%" class="moduleTable">
<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th><th width="50"><?php echo _JID; ?></th>
<th align="left"><?php echo _INVOICE_NAME; ?></th><th width="100"><?php echo _PUBLISHED; ?></th><th width='150' align="left"><?php echo _CLIENT; ?></th><th width='100'><?php echo _INVOICE_STAGE; ?></th><th width="100"><?php echo _TOTAL; ?></th><th width='150' align="left"><?php echo _MANAGER; ?></th><th width='100'><?php echo _VALID_TILL; ?></th>
</tr>
</thead>
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
<td align="left"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','viewInvoice')"><?php echo $row->subject; ?></a></td>
<td align="center">
	    			<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? "unpublish" : "publish";?>')">
					<img src="components/com_jaccounts/images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</a>
</td>
<td align="left"><?php echo $row->client?>&nbsp;</td>
<td align="center"><?php echo $row->invoicestatus; ?>&nbsp;</td>
<td align="center"><?php echo $row->total; ?>&nbsp;</td>
<td align='left'><?php echo $row->gid; ?>&nbsp;</td>
<td align="center"><?php echo JHTML::_('date',  $row->validtill, JText::_('DATE_FORMAT_LC4') ); ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='row1'>
           		<td colspan='9' align="center"><strong><?php echo _NO_INVOICES_AVAILABLE; ?></strong>&nbsp;&nbsp;<a href='index.php?option=com_jaccounts&task=newInvoice'>[<?php echo _CREATE_ONE_NOW; ?>]</a></td>
           </tr>
           <?php } ?>
</tbody>
<tfoot>
   <tr>
		<td colspan='9' align='center'>
		<?php if ($adminlocation) {
			echo $page->getListFooter();
		} else {
			echo $page->getPagesLinks();
		} ?>
        </td>
	</tr>
</tfoot>
</table>

<input type="hidden" name="returntask" value="listInvoices" />
<input type="hidden" name="type" value="invoices" />
<input type="hidden" name="option" value="com_jaccounts" />
<input type="hidden" name="task" value="listInvoices" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="hidemainmenu" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 


<?
}
}
// Quote Functions
class HTML_quotes {

function viewQuote($option, &$row, &$user, &$services, &$appliedservices, &$manager, &$mid) {
	$database = & JFactory::getDBO();
	global $jfConfig;
	$adminlocation = jAccessHelper::checkLocation();
	?>
    <form action="index.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
        <input type="hidden" name='cid[]' value='<?php echo $row->id;?>' />
        <?php
		if (!$adminlocation) {
			global $Itemid;
			echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
		}
		?>
	</form> 
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
<tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _QUOTE_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150px" align="right" class='fieldName'><?php echo _QUOTE_NAME; ?></td>
		  <td width="300px"><?php echo $row->subject; ?></td>
			<td width="150px" align="right" class='fieldName'><?php echo _VALID_TILL; ?></td>
          <td><?php echo $row->validtill; ?></td>
		</tr>
		<tr>
			<td align="right" class='fieldName'><?php echo _CLIENT; ?></td>
          <td><?php echo $user; ?></td>
            <td align="right" class='fieldName'><?php echo _ACCOUNT; ?></td>
          <td><?php echo $row->accountid; ?>&nbsp;</td>
		</tr>
        <tr>
        	<td align="right" class='fieldName'><?php echo _QUOTE_STAGE; ?></td>
      <td>
            	<?php echo $row->quotestage; ?>            </td>
            <td align="right" class='fieldName'><?php echo _PROJECT; ?></td>
          <td><?php echo $row->project; ?>&nbsp;</td>
        </tr>
		<tr>
			<td align="right" class='fieldName'><?php echo _PUBLISHED; ?></td>
	  <td>
				<?php echo $row->published == 1 ?  _YES : _NO; ?>            </td>
            <td align="right" class='fieldName'><?php echo _MANAGER; ?></td>
      <td><?php echo $manager ? $manager."&nbsp;:&nbsp;:&nbsp;" : "&nbsp;"; ?><?php echo $mid; ?>&nbsp;</td>
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _SERVICE_DETAILS; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='serviceTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='left'><?php echo _SERVICE; ?></th>
				<th align='left' width='75'><?php echo _QUANTITY; ?></th>
				<th align='left' width='75'><?php echo _PRICE; ?></th>
				<th align='left' width='75'><?php echo _TOTAL; ?></th>
			</tr>
        <?php if($appliedservices){
			$k = 0;
			foreach($appliedservices as $as) {
		?>
		<tr class='row<?php echo $k; ?>'>
        	<td valign='top'>&nbsp;</td>
	        <td valign='top'>
            	<table border="0" cellpadding="1" cellspacing="0" width="100%">
                	<tr>
                    				<td style="border: none;"><strong><?php echo $as->productname; ?></strong>			                        </td>
	        	  </tr>
	                    		<tr>
    			                	<td style="border: none;" id="setComment<?php echo $j; ?>"><?php echo $as->comment; ?>                			        </td>
			                    </tr>
		        </table>                       	</td>
						<td valign='top'><?php echo $as->quantity;?>&nbsp;</td>
            			<td valign='top'><?php echo $as->listprice; ?>&nbsp;</td>
						<td valign='bottom' id="productTotal<?php echo $j; ?>" align="right">
							<?php $totalcost = $as->listprice * $as->quantity; 
									printf ("%01.2f", $totalcost); 
							?>                       </td>
			</tr>
		<?php $k = 1 - $k;
			} 
		}
		?>
		</table>
	    <table class='totalTable' cellpadding='5' width="100%" cellspacing="0">
		<tr valign="top">
        <th colspan='3'></th>
		<th align="right" width="100px">&nbsp;</th></tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _NET_TOTAL; ?></strong></td>
		<td id="subTotal" align="right"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->subtotal == "") { echo "0.00"; } else { echo $row->subtotal; } ?></td>
   		</tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _TAX_RATE; ?></strong></td>
		<td align="right" style="border-bottom:1px solid #000000;"><?php if ($row->total!='' || $row->subtotal != '') { echo ($row->total / $row->subtotal) * 100 - 100;} else { echo "0.00"; } ?>%</td>
   		</tr>		
		<tr>
        <td colspan='3' align="right"><strong><?php echo _GRAND_TOTAL; ?></strong></td>
		<td id="grandTotalDisplay" align="right"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->total == "") { echo "0.00"; } else { echo $row->total; } ?></td>
   		</tr>
	</table>
        </td></tr>
        </table>

<? 
}

function editQuote($option, &$row, &$user, &$services, &$appliedservices, &$lists) {
	JRequest::setVar( 'hidemainmenu', 1 );
	
	$doc 		=& JFactory::getDocument();
	$database	=& JFactory::getDBO();
	
		$js = "
		function jAccountsClient(id, name, username) {
		title = name+\" [\"+username+\"]\";
			document.getElementById('contactid').value = id;
			document.getElementById('contactname').value = title;
		    document.getElementById('client_label').className='fieldNameRequiredActive';
			document.getElementById('sbox-window').close();
		}
 		
		function jAccountsService(id,txt,price) {
			var tableName = document.getElementById('serviceTable');
			var prev = tableName.rows.length;
    		var count = eval(prev)-1;
		    document.getElementById(\"serviceid\"+count).value = id;
			document.getElementById(\"service\"+count).value = txt;
			document.getElementById(\"listprice\"+count).value = price;
			document.getElementById(\"quantity\"+count).value= 1;
			document.getElementById(\"quantity\"+count).focus();			
			document.getElementById('sbox-window').close();	
		}
		
		window.addEvent('domready', function() {  myCal = new Calendar({ validtill: 'm/d/Y' }, { classes: ['dashboard'], direction: 1 }); });
		";

	$doc->addScriptDeclaration($js);

	global $my, $jfConfig;

		jimport('joomla.utilities.date');
		JHTML::_('behavior.modal', 'a.modal');
		
		$link = 'index.php?option=com_jaccounts&amp;task=clientPopup&amp;tmpl=component';

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
	
		if (pressbutton == 'listQuotes') {
			submitform( pressbutton );
			return;
		}
	
		// do field validation
		if (form.subject.value == ""){
			alert( "Quote must have a title" );
		} else if (form.contactid.value == ""){
			alert( "You must select a Client." );
		} else if (form.gid.value == ""){
			alert( "You must select a managing group." );
		} else {
			submitform( pressbutton );
		}
	}
//-->
</script>
<form action="index.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'> 
<tr>
        	<td class='headerQuotes' align="left" colspan="4"><?php echo _QUOTE_DETAILS; ?></td>
        </tr>
        <tr>
			<td width="150px" align="right" class="<?php echo $row->subject ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id='subject_label'><?php echo _QUOTE_NAME; ?></td>
		  <td width="300px" class='fieldValue'><input type="text" name="subject" id="subject" value="<?php echo $row->subject; ?>" size="40" onchange="checkElement('subject');" /></td>
			<td width="150px" align="right" class='fieldName'><?php echo _VALID_TILL; ?></td>
  <td class='fieldValue'><input class="text_area" type="text" name="validtill" id="validtill" size="25" maxlength="19" value="<?php echo $row->validtill; ?>" />
</td>
		</tr>
		<tr>
			<td align="right" class="<?php echo $row->contactid ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id="client_label"><?php echo _CLIENT; ?></td>
          <td class='fieldValue'>
            <input type='hidden' name='contactid' id='contactid' value='<?php echo $row->contactid;?>' /><input type='text' name='contactname' id='contactname' value="<?php echo $row->id ? $user[1]." [".$user[2]."]" : "" ; ?>" readonly="readonly" /><a class="modal" href="<?php echo $link; ?>" rel="{handler: 'iframe', size: {x: 700, y: 375}}"><img src="components/com_jaccounts/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a>  </td>
            <td align="right" class='fieldName'><?php echo _ACCOUNT; ?></td>
          <td class='fieldValue'><input type='text' name='accountid' id='accountid' value='<?php echo $row->accountid; ?>' />&nbsp;</td>
		</tr>
        <tr>
        	<td align="right" class='fieldName'><?php echo _QUOTE_STAGE; ?></td>
          <td class='fieldValue'>
            <select name="quotestage">
            	<?php 
                $stages=array(_PENDING,_ACCEPTED,_DENIED);
				foreach($stages as $stage) {
					if($row->quotestage == $stage) {
						echo "<option value=".$row->quotestage." selected>".$row->quotestage."</option>";
					} else {
						echo "<option value=".$stage.">".$stage."</option>";
					}
				}
				?>
            </select>            </td>
            <td align="right" class='fieldName'><?php echo _PROJECT; ?></td>
          <td class='fieldValue'><input type='text' name='projectid' id='projectid' value='<?php echo $row->projectid;?>' /></td>
        </tr>
		<tr>
			<td align="right" class='fieldName'><?php echo _PUBLISHED; ?>:</td>
		  <td class='fieldValue'><?php echo JHTML::_('select.booleanlist',  'published', '', $row->published ); ?> </td>
            <td align="right" class='fieldName'><?php echo _MANAGER; ?></td>
      <td class='fieldValue'><div style="float:left; margin-right:10px;"><?php echo $lists['groups']; ?></div><div id="managerList" style="float:left;"><?php echo $lists['mid']; ?></div>&nbsp;</td>
		</tr>
        <tr>
          <td colspan='4' align="left">&nbsp;</td>
        </tr>
        <tr><td colspan='4' class='headerQuotes' align="left"><?php echo _SERVICE_DETAILS; ?></td></tr>
        <tr><td colspan='4' style="padding:0px;">
        <table id='serviceTable' class='serviceList' width='100%' cellpadding="0" cellspacing="0">
        	<tr>
    	    	<th width='20' align='left'>&nbsp;</th>
				<th align='left'><?php echo _SERVICE; ?></th>
				<th align='left' width='75'><?php echo _QUANTITY; ?></th>
				<th align='left' width='75'><?php echo _PRICE; ?></th>
				<th align='left' width='75'><?php echo _TOTAL; ?></th>
			</tr>
        <?php if($appliedservices){
        	$j = 1;
			$k = 0;
			foreach($appliedservices as $as) {
?>
					<tr id="row<?php echo $j; ?>" class='row<?php echo $k; ?>'>
       				  <td valign='top'><img src="images/publish_x.png" border="0" onclick="deleteRow('<?php echo $j; ?>')"><input type="hidden" id="deleted<?php echo $j; ?>" name="deleted<?php echo $j; ?>" value="0"></td>
				        <td valign='top'>
                        	<table border="0" cellpadding="1" cellspacing="0" width="100%">
                               	<tr>
			            	                   	<td style="border: none;"><input id="serviceid<?php echo $j; ?>" name="serviceid<?php echo $j; ?>" type="hidden" value="<?php echo $as->serviceid; ?>" ><input id="service<?php echo $j; ?>" name="service<?php echo $j; ?>" value="<?php echo $as->productname; ?>" readonly="readonly" type="text" style="width: 350px;"><!--<a class="modal" href="<?php echo $serviceLink; ?>" rel="{handler: 'iframe', size: {x: 650, y: 375}}"><img src="components/com_jaccounts/images/service_lookup.png" style="cursor: pointer;" align="absmiddle" border='0' /></a>--></td>
           			       	  </tr>
			                                <tr>
            			                    	<td style="border: none;" id="setComment<?php echo $j; ?>"><textarea id="comment" name="comment<?php echo $j; ?>" style="width: 350px; height:40px"><?php echo $as->comment; ?></textarea><br>
            			                    	  [<a href="#" onClick="javascript:getObj('comment<?php echo $j; ?>').value=''";>Clear Comment</a>]                                                </td>
                                         	</tr>
                      </table>                                  	</td>
									<td valign='top'><input id="quantity<?php echo $j; ?>" name="quantity<?php echo $j; ?>" type="text" style="width:50px" onBlur="javascript:settotalnoofrows(); calcTotal();" value="<?php echo $as->quantity;?>"/></td>
						            <td valign='top'><input id="listprice<?php echo $j; ?>" name="listprice<?php echo $j; ?>" value="<?php echo $as->listprice; ?>" type="text" style="width:70px" onBlur="javascript:calcTotal();"/></td>
						<td valign='bottom' id="productTotal<?php echo $j; ?>" align="right">
							<?php $totalcost = $as->listprice * $as->quantity; 
									printf ("%01.2f", $totalcost); 
							?>                        </td>
					</tr>
		<?php
				}
		$j++;
		$k = 1 - $k;	
		?>
		<input type="hidden" name="totalProductCount" id="totalProductCount" value="<?php echo $j-1; ?>">
        <?php
		} else {
		?>
		<input type="hidden" name="totalProductCount" id="totalProductCount" value="">
		<? } ?>
    </table><br />&nbsp;
<a class="modal button" href="index.php?option=com_jaccounts&amp;task=servicesPopup&amp;tmpl=component" rel="{handler: 'iframe', size: {x: 700, y: 375}}" onclick="fnAddProductRow();">Add Service</a>
	<br /><br />
	    <table class='totalTable' cellpadding='5' width="100%">
		<tr valign="top">
        <th colspan='4'>&nbsp;</th>
		</tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _NET_TOTAL; ?></strong></td>
		<td id="subTotal" align="right" width="100px"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->subtotal == "") { echo "0.00"; } else { echo $row->subtotal; } ?></td>
   		</tr>
		<tr>
        <td colspan='3' align="right"><strong><?php echo _TAX_RATE; ?></strong></td>
		<td align="right" style="border-bottom:1px solid #000000;"><?php echo $jfConfig['tax']; ?>%</td>
   		</tr>		
		<tr>
        <td colspan='3' align="right"><strong><?php echo _GRAND_TOTAL; ?></strong></td>
		<td id="grandTotalDisplay" align="right"><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row->total == "") { echo "0.00"; } else { echo $row->total; } ?></td>
   		</tr>
	</table>
        </td></tr>
        </table>
        </td></tr>
  </table>
 <?php
$adminlocation = jAccessHelper::checkLocation();
if (!$adminlocation) {
	global $Itemid;
	echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
}
?>
<input type='hidden' name='created' value='<?php echo $row->created; ?>'  />
<input type="hidden" name='currency' id='currency' value="<?php echo $jfConfig['currency']; ?>" >
<input type="hidden" name="taxrate" id="taxrate" value="<?php echo $jfConfig['tax']; ?>" >
<input type="hidden" name="subtotal" id="subtotal" value="<?php echo $row->subtotal; ?>">
<input type="hidden" name="total" id="total" value="<?php echo $row->total; ?>">
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<? 
}
function listQuotes ($option, &$rows, $page) {
		global $my, $acl, $config;
		$database = & JFactory::getDBO();
		jimport('joomla.utilities.date');
		$adminlocation = jAccessHelper::checkLocation();
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteQuote') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteQuote');
				}
			} else if (pressbutton =='editQuote') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editQuote');
				}
			} else {
				submitform(pressbutton);
			}
		}
		</script>
<form action="index.php" method="post" name="adminForm">
<?php 
	HTML_cP::showFilter();
?>
<table cellpadding="3" cellspacing="0" border="0" width="100%" class="moduleTable">
<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th><th width='50'><?php echo _JID; ?></th>
<th align="left"><?php echo _QUOTE_NAME; ?></th><th width="100"><?php echo _PUBLISHED; ?></th><th width='150' align="left"><?php echo _CLIENT; ?></th><th width="100"><?php echo _STATUS; ?></th><th width='50'><?php echo _VIEWED; ?></th><th width="100"><?php echo _TOTAL; ?></th><th width='150' align="left"><?php echo _MANAGER; ?></th><th width='100' align="center"><?php echo _VALID_TILL; ?></th>
</tr>
</thead>
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
<td><a href="#view" onclick="return listItemTask('cb<?php echo $i;?>','viewQuote')"><?php echo $row->subject; ?></a></td>
<td align="center">	
    				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $row->published ? "unpublish" : "publish";?>')">
					<img src="components/com_jaccounts/images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
					</a>
</td>
<td align="left"><?php echo $row->client; ?>&nbsp;</td>
<td align="center"><?php echo $row->quotestage; ?>&nbsp;</td>
<td align="center"><?php echo $row->viewed==1 ? "Yes" : "No" ; ?>&nbsp;</td>
<td align="center"><?php echo $row->total; ?>&nbsp;</td>
<td align='left'><?php echo $row->gid ?>&nbsp;</td>
<td align="center"><?php echo JHTML::_('date',  $row->validtill, JText::_('DATE_FORMAT_LC4') ); ?>&nbsp;</td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
		   if(!$rows) {  
		   ?>
           <tr class='row1'>
           		<td colspan='10' align="center"><strong><?php echo _NO_QUOTES_AVAILABLE; ?></strong>&nbsp;&nbsp;<a href='index.php?option=com_jaccounts&task=newQuote'>[<?php echo _CREATE_ONE_NOW; ?>]</a></td>
           </tr>
           <?php } ?>
</tbody>
<tfoot>
   <tr>
		<td colspan='10' align='center'>
		<?php if ($adminlocation) {
			echo $page->getListFooter();
		} else {
			echo $page->getPagesLinks();
		} ?>
        </td>
	</tr>
</tfoot>
</table>

<input type="hidden" name="type" value="quotes" />
<input type="hidden" name="returntask" value="listQuotes" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="listQuotes" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?
}
}
class HTML_services {

function listServices ($option, &$rows, &$pagination) {
	$adminlocation = jAccessHelper::checkLocation();
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'deleteService') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to delete');
				} else if ( confirm('Are you sure you want to delete the selected items? \nThis will permanently delete the items.')) {
					submitform('deleteService');
				}
			} else if (pressbutton =='editService') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('Please make a selection from the list to edit');
				} else {
					submitform('editService');
				}				
			} else {
				submitform(pressbutton);
			}
		}
		</script>
<form action="index.php" method="post" name="adminForm">
<?php 
	HTML_cP::showFilter();
?>
<table cellpadding="4" cellspacing="0" border="0" width="100%" class="moduleTable">
<thead>
<tr class='tableListHeader'>
<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
<th class="title" align="left"><?php echo _SERVICE_NAME; ?></th><th class='title' align="left"><?php echo _SERVICE_DESCRIPTION; ?></th><th class='title' width="150" align="left"><?php echo _STANDARD_PRICE; ?></th>
</tr>
</thead>
<tbody>
<?php
$k = 0;
for($i=0; $i < count( $rows ); $i++) {
$row = $rows[$i];
if ($row->product_description) {
	if(strlen($row->product_description)>60) { 
		$d = strpos($row->product_description, " ", 60);
	} else { 
		$d = strlen($row->product_description);
	}
		$description = substr($row->product_description, 0, $d)."...";
} else { $description = ''; }
?>
<tr class="<?php echo "row$k"; ?>">
<td valign="top"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
<td valign="top"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','viewService')"><?php echo $row->productname; ?></a></td>
<td valign="top"><?php echo $description; ?>&nbsp;</td><td><?php echo $jfConfig['currency']; ?>&nbsp;<?php echo $row->unit_price; ?></td>
<?php $k = 1 - $k; ?>
</tr>
<?php } 
?>
</tbody>
<tfoot>
   <tr>
		<td colspan='10' align='center'>
		<?php if ($adminlocation) {
			echo $pagination->getListFooter();
		} else {
			echo $pagination->getPagesLinks();
		} ?>
        </td>
	</tr>
</tfoot>
</table>
 <?php
$adminlocation = jAccessHelper::checkLocation();
if (!$adminlocation) {
	global $Itemid;
	echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
}
?>
<input type="hidden" name="type" value="quotes" />
<input type="hidden" name="returntask" value="listServices" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="listServices" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
</form> 
<?
}
function editService($option, &$row) {
   global $jfConfig;
   
	$editor =& JFactory::getEditor();
?>
<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if (pressbutton == 'listServices') {
				submitform( pressbutton );
				return;
			}
			<?php echo $editor->getContent( 'product_description' ); ?>
			// do field validation
			if (form.productname.value == ""){
				alert( "Service must have a title" );
			} else if (form.unit_price.value == ""){
				alert( "You must specify a price." );
			} else {
			<?php
				echo $editor->save( 'product_description' );
			?>
				submitform( pressbutton );
			}
		}

//-->
</script>
    <form action="index.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<th class='headerServices' align="left" colspan="4"><?php echo _SERVICE_DETAILS; ?></th>
        </tr>
        <tr>
			<td width="150" class="<?php echo $row->productname ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id="productname_label"><?php echo _SERVICE_NAME; ?></td>
            <td><input type="text_area" size="35" name="productname" id="productname" onchange="checkElement('productname');" value="<?php echo $row->productname; ?>"></td>
		</tr>
        <tr>
        	<td class="<?php echo $row->unit_price ? 'fieldNameRequiredActive' : 'fieldNameRequired';?>" id="unit_price_label"><?php echo _STANDARD_PRICE; ?></td>
            <td><?php echo $jfConfig['currency']; ?><input type="text" name="unit_price" id="unit_price"size="10" onchange="checkElement('unit_price');" value="<?php echo $row->unit_price; ?>" /></td>
        </tr>
        <tr>
        	<td valign="top" class='fieldName'><?php echo _SERVICE_DESCRIPTION; ?></td><td><?php echo $editor->display( 'product_description', $row->product_description, '50%', '350', '55', '20' ) ; ?></td>
        </tr>
    </table>
<?php
		$adminlocation = jAccessHelper::checkLocation();

		if (!$adminlocation) {
			global $Itemid;
			echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
		}
?>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form> 
<? 
}
function viewService($option, &$row) {
?>
    <form action="index.php" method="post" name="adminForm">
    <table width="100%" cellpadding="5" cellspacing='0' class='editView'>
        <tr>
        	<th class='headerServices' align="left" colspan="4"><?php echo _SERVICE_DETAILS; ?></th>
        </tr>
        <tr>
			<td width="150" class='fieldName'><?php echo _SERVICE_NAME; ?></td><td class='fieldValue'><?php echo $row->productname; ?></td>
		</tr>
        <tr>
        	<td class='fieldName'><?php echo _STANDARD_PRICE; ?></td><td class='fieldValue'>$<?php echo $row->unit_price; ?></td>
        </tr>
        <tr>
        	<td valign="top" class='fieldName'><?php echo _SERVICE_DESCRIPTION; ?></td><td class='fieldValue'><?php echo $row->product_description; ?></td>
        </tr>
    </table>
<?php
		$adminlocation = jAccessHelper::checkLocation();

		if (!$adminlocation) {
			global $Itemid;
			echo "<input type='hidden' name='Itemid' value='".$Itemid."'>";
		}
		?>
   <input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form>
<?php
}
}
?>