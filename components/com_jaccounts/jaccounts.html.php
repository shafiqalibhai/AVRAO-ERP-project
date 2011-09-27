<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_JACCOUNTS {
	
	function listMyQuotes($option, &$rows) {
	$database = & JFactory::getDBO();
	global $jaccounts_path;
	?>
	<div class='contentheading'><?php echo _QUOTES; ?></div>
	<table width="100%" align="center" cellpadding="3" cellspacing="0">
	  <tr>
    	<td width="25" class="sectiontableheader" align='center'><?php echo _STATUS; ?></td>
	    <td class="sectiontableheader" width="75" align='center'><?php echo _QUOTE_ID; ?></td>
    	<td class="sectiontableheader" align="left"><?php echo _QUOTE_NAME; ?></td>
        <td width="120" class="sectiontableheader" align="center"><?php echo _TOTAL; ?></td>
	 </tr>
	<?php
	$k = 0;
		foreach($rows as $row) {
			if($row->quotestage == _ACCEPTED) 
			{ 
				$image = "<img src='".$jaccounts_path."/images/tick.png' />"; 
			} else { 
				$image = "<img src='".$jaccounts_path."/images/publish_x.png' />"; 
			}
?>	
	<tr class='sectiontableentry<?php echo $k; ?>'>
		<td align='center'><?php echo $image; ?></td>
        <td align='center'><?php echo $row->id; ?></td>
		<td><a href="index.php?option=com_jaccounts&task=viewMyQuote&id=<?php echo $row->id; ?>"><?php echo $row->subject; ?></a></td>
		<td align='center'><?php echo $row->total; ?></td>
	</tr>
	<?php
	$k = 1 - $k;
		}
	?>
	  <tr>
	    <td align="center" colspan='4'>&nbsp;</td>
      </tr>
	  <tr>
    	<td align="center" colspan='4' class='listBottom'>
		    <img src='<?php echo $jaccounts_path; ?>/images/tick.png' /> <?php echo _QUOTE_ACCEPTED; ?> | <img src='<?php echo $jaccounts_path; ?>/images/publish_x.png' /> <?php echo _QUOTE_NOT_ACCEPTED; ?>      	</td>
	  </tr>
	</table>
<?php
	} 

	function viewMyQuote($option, &$row, &$services) {
	$database = & JFactory::getDBO();
	global $jaccounts_path, $jfConfig;
	?>
	<div class='contentheading'><?php echo _QUOTES; ?></div>
    <table width="100%" align="center" cellpadding="5">
   	  <tr>
        <td>
        	<div id="jaccountPrep"><?php echo _QUOTE_PREPARED_FOR; ?></div>
	        <div id="jaccountSubject"><? echo $row[0]->subject; ?></div>
		</td>
        <td width="100" align="right"><table width="100%" cellpadding="2" class='idTable'>
          <tr>
            <td class='sectiontableheader' align='center'><?php echo _QUOTE_ID; ?></td>
          </tr>
          <tr>
            <td align="center"><? echo $row[0]->id; ?></td>
          </tr>
        </table></td>
      </tr>
   	</table> <br /><br />
      <table width="100%" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100" align="center" valign="top" class="sectiontableheader"><?php echo _QUANTITY; ?></td>
        <td width='175' align='left' valign="top"  class="sectiontableheader"><?php echo _ITEM; ?></td>
        <td valign="top" align='left' class="sectiontableheader"><?php echo _DESCRIPTION; ?></td>
        <td width="75" align="center" valign="top"  class="sectiontableheader"><?php echo _UNIT; ?></td>
        <td width="75" align="center" valign="top"  class="sectiontableheader"><?php echo _TOTAL; ?></td>
      </tr>
		<?php
		$i = 0;
		foreach($services as $service) {
		$totalcost = $service->listprice * $service->quantity;
		?>
        <tr bordercolor="#000000" class="sectiontableentry<?php echo $i; ?>">
			<td width="100" valign='top' align="center"><?php echo $service->quantity; ?></td>
		  <td align='left' valign='top'><?php echo $service->productname; ?></td>
			<td valign='top'><?php echo $service->comment;
			if($service->product_description != "") { ?>
				<br />
                <div id='trigger' class='slide_trigger'>Show more...</div>
                	<div id='slider_content' class='slide'><?php echo $service->product_description; ?></div>
	<?php } ?>			</td>
			<td width="75" align='center' valign='top'><?php echo number_format($service->listprice, 2)?></td>
		  <td width="75" align='right' valign='top'><?php echo number_format($totalcost, 2); ?></td>	
		</tr>
	<?php $i = 1 - $i;
	}
	?><tr><td colspan='5'>&nbsp;</td></tr>
		<tr id='totalRow'>
        <td colspan='3' id='totalRow'>&nbsp;</td>
        <td width="75" align="right" id='totalRow'><strong><?php echo _NET_TOTAL; ?></strong></td>		
		<td align="right" id='totalRow'><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row[0]->subtotal == "") { echo "0.00"; } else { echo number_format($row[0]->subtotal,2); } ?></td>
   		</tr>
		<tr id='totalRow'>
        <td colspan='3' id='taxRow'>&nbsp;</td>
        <td width="75" align="right" id="taxRow"><strong><?php echo _TAX_RATE; ?></strong></td>				
		<td align="right" id="taxRow"><?php if ($row[0]->total!='' || $row[0]->subtotal != '') { echo number_format(($row[0]->total / $row[0]->subtotal) * 100 - 100,2);} else { echo "0.00"; } ?>%</td>
   		</tr>		
		<tr id='totalRow'>
        <td colspan='3' id='totalRow'></td>
        <td width="75" align="right" id='totalRow'><strong><?php echo _TOTAL; ?></strong></td>			
		<td align="right" id='totalRow'><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row[0]->total == "") { echo "0.00"; } else { echo number_format($row[0]->total,2); } ?></td>
   		</tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td align="center" colspan="2" id='jaccountStatus2'>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td align="center" colspan="2" id='jaccountStatus'>
			<? if ($row[0]->quotestage == _ACCEPTED) 
				{
				$image = "<img src='".$jaccounts_path."/images/tick.png' />"
			?>
           <span class='quoteaccepted'><?php echo $image; ?><?php echo _QUOTE_ACCEPTED; ?></span>
           <?php } elseif($row[0]->quotestage == _DENIED)
		   		{
					$image = "<img src='".$jaccounts_path."/images/publish_x.png' />"
			?>
           <span class='quotedenied'><?php echo $image; ?><?php echo _QUOTE_NOT_ACCEPTED; ?></span>
	   
			<?php }	else { ?>
           <form action="index.php?option=com_jaccounts&task=acceptQuote&id=<? echo $row[0]->id; ?>" method="post">
           		<select name="acceptQuote" onchange="submit()">
                	<option value=""><?php echo _ACCEPT_QUOTE; ?></option>
	                <option value="1" ><?php echo _YES; ?></option>
	                <option value="0"><?php echo _NO; ?></option>
                </select>
       	  </form>
			<? } ?>      	</td>
	  </tr>
</table>
<br>
      <table width="100%" align="center" cellpadding="10" cellspacing="0" id="jTerms">
        <tr>
          <td colspan="7" valign="top">
          <a href='<?php echo $jfConfig['terms']; ?>'><?php echo _TERMS_AND_CONDITIONS; ?></a>
		  </td>
	   </tr>
    </table>

<?php }
function listMyInvoices($option, &$rows) {
	$database = & JFactory::getDBO(); 
	global $jaccounts_path;

?>
<div class='contentheading'><?php echo _INVOICES; ?></div>
<table width="100%" align="center" cellpadding="3" cellspacing="0">
  <tr>
  	<td width="25" class="sectiontableheader" align="center"><?php echo _STATUS; ?></td>
 	 <td class="sectiontableheader" width="75" align="center"><?php echo _INVOICE_ID; ?></td>
     <td class="sectiontableheader"><?php echo _INVOICE_NAME; ?></td>
     <td width="120" class="sectiontableheader" align="center"><?php echo _TOTAL; ?></td
  ></tr>
<?
$k = 0;
foreach($rows as $row) {
$invoiceid = $row->id;

if($row->invoicestatus == "Paid") {
$image = "<img src=".$jaccounts_path."/images/tick.png />";
} else {
$image = "<img src=".$jaccounts_path."/images/publish_x.png />";
}
?>
	<tr class='sectiontableentry<?php echo $k; ?>'>					
		<td width='25' align='center'><?php echo $image; ?></td>
		<td align='center'><?php echo $invoiceid; ?></td>
		<td>
    		<a href='index.php?option=com_jaccounts&task=viewMyInvoice&id=<?php echo $invoiceid; ?>'><?php echo $row->subject; ?></a>   		</td>
		<td align="center"><?php echo $row->total; ?></td>
	</tr>
<?php
$k = 1 - $k;
}
?>
	<tr>
	  <td align="center" colspan='4'>&nbsp;</td>
  </tr>
	<tr>
		<td align="center" colspan='4' class="listBottom"><img src='<?php echo $jaccounts_path; ?>/images/tick.png' /> <?php echo _INVOICE_PAID; ?> &nbsp; <img src='<?php echo $jaccounts_path; ?>/images/publish_x.png' /> <?php echo _INVOICE_NOT_PAID; ?>  	</td>
   	</tr>
</table>
<?
} 

function viewMyInvoice($option, &$row, &$services, &$jfConfig, &$payment) {
$database = & JFactory::getDBO(); global $jaccounts_path;
?>
					<table width="100%" height="61" align="center" cellpadding="0" cellspacing="0">
                	  <tr>
          				<td valign="top">
			            	<div id='jaccountPrep'><?php echo _INVOICE_PREPARED_FOR; ?></div>
	            			<div id='jaccountSubject'><? echo $row[0]->subject; ?></div>                        </td>
    			      <td width="100" align="right" valign="top">
				          <table width="100%" cellpadding="2" class='idTable'>
			            <tr><th class='sectiontableheader'><?php echo _INVOICE_ID; ?></th></tr><tr><td align="center"><? echo $row[0]->id; ?></td></tr></table>                      </td>
			        </tr>
                	  <tr>
                	    <td valign="top" height="18">&nbsp;</td>
                	    <td align="right" valign="top">&nbsp;</td>
              	    </tr>
			      </table>
     
<table width="100%" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100" align="center" valign="top" class="sectiontableheader"><?php echo _QUANTITY; ?></td>
        <td width='175' align="left" valign="top"  class="sectiontableheader"><?php echo _ITEM; ?></td>
        <td align="left" valign="top"  class="sectiontableheader"><?php echo _DESCRIPTION; ?></td>
        <td width="75" align="center" valign="top"  class="sectiontableheader"><?php echo _UNIT; ?></td>
        <td width="75" align="center" valign="top"  class="sectiontableheader"><?php echo _TOTAL; ?></td>
      </tr>
		<?php
		$i = 0;
		foreach($services as $service) {
		$totalcost = $service->listprice * $service->quantity;
		?>
        <tr class="sectiontableentry<?php echo $i+1; ?>">
			<td valign='top' align='center'><?php echo $service->quantity; ?></td>
			<td align='left' valign='top'><?php echo $service->productname; ?></td>
			<td valign='top'><?php echo $service->comment;
			if($service->product_description != "") { ?>
				<br />
                <span class="slide_trigger"><?php echo _SHOW_MORE; ?></span>
                <div class='slide'><?php echo $service->product_description; ?></div>
	<?php } ?>			</td>
			<td align='center' valign='top'><?php echo number_format($service->listprice,2); ?></td>
			<td align='right' valign='top'><?php echo number_format($totalcost,2); ?></td>	
		</tr>
	<?php $i = 1 - $i;
	}
	?><tr><td colspan='5'>&nbsp;</td></tr>     
		<tr id='totalRow'>
        <td colspan='3' id='totalRow'>&nbsp;</td>
        <td width="75" align="right" id='totalRow'><strong><?php echo _NET_TOTAL; ?></strong></td>		
		<td align="right" id='totalRow'><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row[0]->subtotal == "") { echo "0.00"; } else { echo number_format($row[0]->subtotal,2); } ?></td>
   		</tr>
		<tr id='totalRow'>
        <td colspan='3' id='taxRow'>&nbsp;</td>
        <td width="75" align="right" id="taxRow"><strong><?php echo _TAX_RATE; ?></strong></td>				
		<td align="right" id="taxRow"><?php if ($row[0]->total!='' || $row[0]->subtotal != '') { echo number_format(($row[0]->total / $row[0]->subtotal) * 100 - 100,2);} else { echo "0.00"; } ?>%</td>
   		</tr>		
		<tr id='totalRow'>
        <td colspan='3' id='totalRow'></td>
        <td width="75" align="right" id='totalRow'><strong><?php echo _TOTAL; ?></strong></td>			
		<td align="right" id='totalRow'><?php echo $jfConfig['currency']; ?>&nbsp;<?php if($row[0]->total == "") { echo "0.00"; } else { echo number_format($row[0]->total,2); } ?></td>
   		</tr>
       <tr>
          <td colspan="5" valign="top" align="right">
          <br />
		  <table width="350" cellpadding="10" class='paymentTable'>
		  	<tr>
				<td align="center">
					<? if($row[0]->invoicestatus == _PAID) 
		  				{ 
							echo "<center><img src='".$jaccounts_path."/images/tick.png' hspace='5' />"._INVOICE_PAID."</center>"; 
						} else { 
						
						echo $payment;
						echo "<br />";
						
						?>
            <strong><?php echo $jfConfig['company_name']; ?></strong><br />
			<?php echo $jfConfig['company_address']; ?> 
       <? } ?>            </td></tr></table>       </td></tr></table>
<br>
      <table width="100%" align="center" cellpadding="10" cellspacing="0" id="jTerms">
        <tr>
          <td colspan="7" valign="top">
          <a href='<?php echo $jfConfig['terms']; ?>'><?php echo _PAYMENT_SIGNIFIES_ACCEPTANCE; ?></a>
		  </td>
	   </tr>
    </table>

<?
	} //End Function
	
function homePage() {
	$database = & JFactory::getDBO(); global $jaccounts_path;
	?>
    <table width="100%" cellpadding="20">
		<tr>
    		<td><div align="center"><a href="index.php?option=com_jaccounts&task=listMyQuotes"><?php echo _QUOTES; ?></a></div></td>
			<td><div align="center"><a href="index.php?option=com_jaccounts&task=listMyInvoices"><?php echo _INVOICES; ?></a></div></td>
		</tr>
	</table>
    
    <?php	
	} //End Function

function employeeHomePage() {
	$database = & JFactory::getDBO(); global $jaccounts_path;
	$user =& JFactory::getUser();
	$jAccess = jAccessHelper::haveAccess(); 
	$link = 'index.php?option=com_jaccounts&task=';
	?>
    <table width="100%" cellpadding="20">
		<tr>
			<td class='componentheading'></td>
		</tr>
		<tr>
			<td align='center'><?php 
				if($jAccess['jAccounts']['Quotes']>2) {
				echo "<div class='jAccountsHomeIcon'><a href='".$link."newQuote'><img src='components/com_jaccounts/images/newquote_large.png' border='0' hspace='5' vspace='5' />&nbsp;New Quote</a></div>";	
				}
				if($jAccess['jAccounts']['Quotes']>1) {
				echo "<div class='jAccountsHomeIcon'><a href='".$link."listQuotes'><img src='components/com_jaccounts/images/listquotes_large.png' border='0' hspace='5' vspace='5' />&nbsp;List Quotes</a></div>";						
				}
				if($jAccess['jAccounts']['Invoices']>2) {
				echo "<div class='jAccountsHomeIcon'><a href='".$link."newInvoice'><img src='components/com_jaccounts/images/newinvoice_large.png' border='0' hspace='5' vspace='5' />&nbsp;New Invoice</a></div>";	
				}
				if($jAccess['jAccounts']['Invoices']>1) {
				echo "<div class='jAccountsHomeIcon'><a href='".$link."listInvoices'><img src='components/com_jaccounts/images/listinvoices_large.png' border='0' hspace='5' vspace='5' />&nbsp;List Invoices</a></div>";						
				}
				if($jAccess['jAccounts']['Services']>2) {
				echo "<div class='jAccountsHomeIcon'><a href='".$link."newService'><img src='components/com_jaccounts/images/newservice_large.png' border='0' hspace='5' vspace='5' />&nbsp;New Service</a></div>";	
				}
				if($jAccess['jAccounts']['Services']>1) {
				echo "<div class='jAccountsHomeIcon'><a href='".$link."listServices'><img src='components/com_jaccounts/images/listservices_large.png' border='0' hspace='5' vspace='5' />&nbsp;List Services</a></div>";						
				}
			?></td>
		</tr>
	</table>
    
    <?php	
	} //End Function

	function endPage() {	?>
    <br /><br />
	<?php
	}

} //End class
?>