<?
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( $mainframe->getPath( 'toolbar_html' ) ); 
$task = JRequest::getVar('task', '' );
switch ( $task ) {
case 'editInvoice':
case 'newInvoice':
menuCLIENTS::INVOICE_MENU();
break;
case 'editQuote':
case 'newQuote':
menuCLIENTS::QUOTE_MENU();
break;
case 'listQuotes':
menuCLIENTS::DEFAULTQUOTES_MENU();
break;
case 'listInvoices':
menuCLIENTS::DEFAULTINVOICES_MENU();
break;
case 'listServices':
menuCLIENTS::DEFAULTSERVICES_MENU();
break;
case 'editService':
case 'newService':
menuCLIENTS::SERVICE_MENU();
break;
case 'viewQuote':
menuCLIENTS::DETAIL_QUOTE_MENU();
break;
case 'viewInvoice':
menuCLIENTS::DETAIL_INVOICE_MENU();
break;
case 'viewService':
menuCLIENTS::DETAIL_SERVICE_MENU();
break;
case 'config':
menuCLIENTS::CONFIG_MENU();
break;
default:
menuCLIENTS::DEFAULT_MENU();
break;		
}
?>