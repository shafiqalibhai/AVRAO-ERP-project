<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');

class jAccountsClientController extends JController
{
function listMyQuotes($option) {
	$database = & JFactory::getDBO();
	$user =& JFactory::getUser();

	$username = $user->username;
	$email = $user->email;
	$id = $user->id;

	$sql = "SELECT * FROM `#__jquotes` WHERE `contactid` = '$id' AND published = '1'";
	$database->setQuery( $sql);
	$rows = $database->loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}

	HTML_JACCOUNTS::listMyQuotes($option, $rows);

}

function viewMyQuote($option, $id) {
$database = & JFactory::getDBO();
$user =& JFactory::getUser();
global $mainframe;


	$sql = "UPDATE #__jquotes SET viewed='1' WHERE `id` = '$id'";
	$database->setQuery($sql);
	$database->query();
	
if($_REQUEST['acceptQuote'] == '1') {

	$sql = "UPDATE #__jquotes SET quotestage='Accepted' WHERE `id` = '$id'";
	$database->setQuery($sql);
	$database->query();

	$sql = "UPDATE #__jinvoices SET published = '1' WHERE `quoteid` = '$id'";
	$database->setQuery($sql);
	$database->query();
	
	$status = 'accepted';
	jAccountsClientController::sendEmail('quote',$my->id, $status );

} elseif($_REQUEST['acceptQuote'] == '0') {

$sql = "UPDATE #__jquotes SET quotestage='Denied' WHERE `id` = '$id'";
$database->setQuery($sql);
$database->query();

}

$sql = "SELECT * FROM `#__jquotes` WHERE `id` = '$id' AND `contactid` = '$user->id' LIMIT 1 ";
$database->setQuery( $sql);
$row = $database->loadObjectList();

if(!$row) { $mainframe->redirect("index.php", 'Quote not available.'); }

$sql = "SELECT #__jservicerelation.id, serviceid, quantity, listprice, comment, productname, product_description " .
		"FROM #__jservicerelation LEFT JOIN #__jservices ON #__jservicerelation.serviceid = #__jservices.id " . 
		"WHERE `quoteid` = '$id'";

$database->setQuery( $sql);
$services = $database->loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}

	HTML_JACCOUNTS::viewMyQuote($option, $row, $services);
}

//Invoice Functions

function listMyInvoices($option) {
$database = & JFactory::getDBO();
$user =& JFactory::getUser();

$sql = "SELECT * FROM `#__jinvoices` WHERE `contactid` = $user->id AND published ='1'";
$database->setQuery( $sql);
$rows = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}

HTML_JACCOUNTS::listMyInvoices($option, $rows);
}

function viewMyInvoice($option, $id) {
$database = & JFactory::getDBO();
global $jfConfig;

$user =& JFactory::getUser();

$sql = "SELECT * FROM `#__jinvoices` WHERE `id` = $id AND `contactid` = $user->id LIMIT 1";
$database->setQuery( $sql);
$row = $database->loadObjectList();

if(!$row) { mosRedirect("index.php", 'Invoice not available.'); }

$sql = "SELECT #__jservicerelation.id, serviceid, quantity, listprice, comment, productname, product_description " .
		"FROM #__jservicerelation LEFT JOIN #__jservices ON #__jservicerelation.serviceid = #__jservices.id " . 
		"WHERE `invoiceid` = '$id'";

$database->setQuery( $sql);
$services = $database->loadObjectList();

		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
$paymentType = $row[0]->paymentmethod;

switch ($paymentType) {
	
	case '0':
	$payment = _MAIL_PAYMENT;
	break;
	
	case '1':
	default:
	$payment = jAccountsClientController::paypalForm($jfConfig, $row);
	break;
	
	case '4':
	$payment = jAccountsClientController::twoCheckout($jfConfig, $row);
	break;
	
	case '3':
	$payment = jAccountsClientController::authorize($jfConfig, $row);
	break;
	
	case '2':
	$payment = jAccountsClientController::googleCheckout($jfConfig, $row);
	break;
	
}	
	HTML_JACCOUNTS::viewMyInvoice($option, $row, $services, $jfConfig, $payment);
}

function homePage($option) {

	HTML_JACCOUNTS::homePage();
}

function employeeHomePage($option) {

	HTML_JACCOUNTS::employeeHomePage();
}

function paypalForm($jfConfig, $row) { 
$p =        "<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">
            <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
            <input type=\"hidden\" name=\"business\" value=".$jfConfig['paypal_address'].">
            <input type=\"hidden\" name=\"item_name\" value='".$row[0]->subject."'>
            <input type=\"hidden\" name=\"item_number\" value=".$row[0]->id.">
            <input type=\"hidden\" name=\"amount\" value=".$row[0]->total.">
            <input type=\"hidden\" name=\"no_note\" value=\"1\">
            <input type=\"hidden\" name=\"currency_code\" value=\"USD\">
            <input type=\"hidden\" name=\"rm\" value=\"2\">
            <input name=\"return\" type=\"hidden\" id=\"return\" value=\"index.php?option=com_jaccounts&task=viewInvoice&id=".$row[0]->id."&success=1\" />
            <input name=\"cancel_return\" type=\"hidden\" id=\"cancel_return\" value=\"index.php?option=com_jaccounts&task=viewInvoice&id=".$row[0]->id."&success=0\" />
            <input type=\"hidden\" name=\"lc\" value=\"US\">
            <input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF\">
            <input type=\"image\" src=\"https://www.paypal.com/en_US/i/btn/x-click-but6.gif\" border=\"0\" name=\"submit\" alt=\"\">
</form>";
    return $p;
}

function twoCheckout($jfConfig, $row) { 
$p =   "<form action=�https://www.2checkout.com/2co/buyer/purchase� method=�post�>
			<input type=�hidden� name=�id_type� value=�1'>
			<input type=�hidden� name=�c_prod� value=".$row[0]->id.">
			<input type=�hidden� name=�c_name� value='".$row[0]->subject."'>
			<input type=�hidden� name=�c_price� value=".$row[0]->total.">
			<input type=�hidden� name=�c_tangible� value=�N'>
			<input type=�hidden� name=�sid� value=".$jfConfig['2checkout_id'].">
			<input type=�submit� value='Pay with 2Checkout.com' class='button'>
		</form>
			";
    return $p;
}


function googleCheckout($jfConfig, $row) {
$p = 	  "<form method=\"POST\" action=\"https://checkout.google.com/cws/v2/Merchant/".$jfConfig['google_merchant_id']."/checkoutForm\" accept-charset=\"utf-8\">
		  <input type=\"hidden\" name=\"item_name_1\" value='".$row[0]->subject."'/>
		  <input type=\"hidden\" name=\"item_price_1\" value=".$row[0]->total."/>
		  <input name=\"item_currency_1\" value=\"USD\" type=\"hidden\"/>
		  <input type=\"hidden\" name=\"_charset_\"/>
 		 <input type=\"image\" name=\"Google Checkout\" alt=\"Fast checkout through Google\" src=\"http://checkout.google.com/buttons/checkout.gif?merchant_id=".$jfConfig['google_merchant_id']."&w=180&h=46&style=white&variant=text&loc=en_US\" height=\"46\" width=\"180\"/>
		</form>";
return $p;
}
function authorize($jfConfig, $row) {
//$lists['months'] = JHTML::_('select.genericlist','exp_m', 'class="inputbox"', '');
	$year = date('Y');
	for ($i=0; $i<10; $i++) {
		$y = $year + $i;
		$years[] = JHTML::_('select.option', $y, $y);
	}
	$lists['years'] = JHTML::_('select.genericlist', $years, 'exp_y', 'class="inputbox"', 'value', 'text', '' );
$p = '	 
<form action="index.php" method="post">
        	<table align="center">
				<tr>
                	<td>Payment Type:</td><td>
					<img src="components/com_jaccounts/images/visa.gif" width="37" height="23" style="border:1px solid #00368c;"/>&nbsp;
					<img src="components/com_jaccounts/images/mc.gif" width="37" height="23" style="border:1px solid #00368c;"/>&nbsp;
					<img src="components/com_jaccounts/images/disc.gif" width="36" height="23" style="border:1px solid #00368c;" />&nbsp;
					<img src="components/com_jaccounts/images/amex.gif" width="37" height="23" style="border:1px solid #00368c;"  />
					</td>
                </tr>
            	<tr>
                	<td>Card Number:</td><td><input type="text" name="cc_number" class="inputbox" size="30" /></td>
                </tr>
                <tr>
                	<td>CID:</td><td><input type="text" name="cc_cid" class="inputbox" size="30" /></td>
                </tr>
                <tr>
                	<td>Expiration Date:</td><td>'.$lists["months"].' '.$lists["years"].'</td>
                </tr>
                <tr>
                	<td colspan="2"><hr /></td>
                </tr>
            	<tr>
                	<td>Address:</td><td><input type="text" name="address" class="inputbox" size="30" /></td>
                </tr>
                <tr>
                	<td>City:</td><td><input type="text" name="city" class="inputbox" size="30" /></td>
                </tr>
                <tr>
                	<td>State:</td><td><input type="text" name="state" class="inputbox" size="30" /></td>
                </tr>
                <tr>
                	<td>Zip:</td><td><input type="text" name="zip" class="inputbox" size="30" /></td>
                </tr>
        		<tr>
                	<td>Country:</td><td><input type="text" name="country" class="inputbox" size="30" /></td>
                </tr>
                <tr>
                	<td>Phone:</td><td><input type="text" name="phone" class="inputbox" size="30" /></td>
                </tr>
                <tr>
                	<td>&nbsp;</td><td>&nbsp;</td>
                </tr>
				<tr>
                	<td colspan="2" align="center"><input type="submit" name="submit" class="button" value="Submit Payment" /></td>
                </tr>
            </table>
        <input type="hidden" name="invoice_id" value="'.$row[0]->id.'" />
        <input type="hidden" name="amount" value="'.$row[0]->total.'" />
        <input type="hidden" name="option" value="com_jaccounts" />
        <input type="hidden" name="task" value="processAuthorizeNet" />
        </form>';
return $p;
}

function processAuthorizeNet() { 
$database = & JFactory::getDBO();
global $jfConfig, $mainframe;

require_once(JPATH_SITE.'/components/com_jaccounts/lib/authorizenet.class.php');

    $authorize_net_testing = $jfConfig['authorize_test']; # Set this to false to go live, true to just run test transactions.

    $a = new authorizenet_class;
    $a->add_field('x_tran_key',  $jfConfig['authorize_API_key']);
    $a->add_field('x_login',     $jfConfig['authorize_API']);
    
      # boiler plate
    $a->add_field('x_version', '3.1');
    $a->add_field('x_type', 'AUTH_CAPTURE');
    $a->add_field('x_test_request', $authorize_net_testing);    // Just a test transaction
    $a->add_field('x_relay_response', 'FALSE');
    $a->add_field('x_delim_data', 'TRUE');
    $a->add_field('x_delim_char', '|');     
    $a->add_field('x_encap_char', '');

      
    $a->add_field('x_address', $_POST['address']);
    $a->add_field('x_city', $_POST['city']);
    $a->add_field('x_state', $_POST['state']);
    $a->add_field('x_zip', $_POST['zip']);
    $a->add_field('x_country', $_POST['country']);
    $a->add_field('x_phone', $_POST['phone']);
  
    $a->add_field('x_method', 'CC');
    $a->add_field('x_card_num', preg_replace('/[^\d]/','',$_POST['cc_number']));
    $a->add_field('x_card_code', $_POST['cc_cid']);
    $a->add_field('x_exp_date', sprintf('%02d%02d', $_POST['exp_m'], $_POST['exp_y']));      
    $a->add_field('x_amount', $_POST['amount']);
    $a->add_field('x_merchant_email', $jfConfig['company_email']);
    
    
    switch ($a->process()) {
    case 1: # Success!
		$row = new invoices($database);
		$row->load($_POST['invoice_id']);
		$row->invoicestatus='Paid';
		if (!$row->store()) {
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		$msg = "Your Payment Has Been Received";
        $mainframe->redirect('index.php?option=com_jaccounts&task=viewInvoice&id='.$_POST['invoice_id'], $msg); 
        break;
    case 2:  // Declined
       $msg =  "<b>Payment Declined:</b>&nbsp; ";
       $msg .=  $a->get_response_reason_text();
       $mainframe->redirect('index.php?option=com_jaccounts&task=viewInvoice&id='.$_POST['invoice_id'], $msg); 
       #echo "<br><br>Details of the transaction are shown below...<br><br>";
       break;
    case 3:  // Error
       $msg =  "<b>Error with Transaction:</b>&nbsp; ";
       $msg .=  $a->get_response_reason_text();
       $mainframe->redirect('index.php?option=com_jaccounts&task=viewInvoice&id='.$_POST['invoice_id'], $msg); 
       #echo "<br><br>Details of the transaction are shown below...<br><br>";
       break;
    }
    #$a->dump_fields();      // outputs all the fields that we set
    #$a->dump_response();    // outputs the response from the payment gateway

}
function sendEmail($module,$userid,&$status ) {
	$database = & JFactory::getDBO();
	global $jfConfig;
	//Email Client

		$sql = "SELECT name, email FROM #__users WHERE id = '$userid'";
		$database->setQuery($sql);
		$name = $database->loadRow();		
		
		$module = strtoupper($module);
		$variables = array("%CLIENT_NAME%","%COMPANY_NAME%");
		$values = array($name[0],$jfConfig['company_name']);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: ".$jfConfig['company_name']. "<".$jfConfig['company_email'].">\r\n";
		$headers .= 'Bcc: ' .$jfConfig['company_email']. "\r\n";

		$to = $name[1];
			
		$module_subject = strtolower($status.'_'.$module.'_subject');
		$module_email = strtolower($status.'_'.$module.'_email');
		$emailsubject = str_replace($variables,$values,$jfConfig[$module_subject]);
		$contents = nl2br(str_replace($variables,$values,$jfConfig[$module_email]));
		
		mail($to,$emailsubject,$contents,$headers);

}
}
?>