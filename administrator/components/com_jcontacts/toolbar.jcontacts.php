<?
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
require_once( $mainframe->getPath( 'toolbar_html' ) ); 
$task = JRequest::getVar('task', '' );


switch ( $task ) {
case 'editLead':
case 'newLead':
menuCONTACTS::LEAD_MENU();
break;

case 'viewLead':
menuCONTACTS::LEAD_DETAIL_MENU();
break;

case 'editAccount':
case 'newAccount':
menuCONTACTS::ACCOUNT_MENU();
break;

case 'viewAccount':
menuCONTACTS::ACCOUNT_DETAIL_MENU();
break;

case 'listAccounts':
menuCONTACTS::DEFAULTACCOUNTS_MENU();
break;

case 'listLeads':
menuCONTACTS::DEFAULTLEADS_MENU();
break;

case 'listContacts':
menuCONTACTS::DEFAULTCONTACTS_MENU();
break;

case 'convertLead':
case 'editContact':
case 'newContact':
menuCONTACTS::CONTACTS_MENU();
break;

case 'viewContact':
menuCONTACTS::CONTACT_DETAIL_MENU();
break;
case 'config':
menuCONTACTS::CONFIG_MENU();
break;
default:
menuCONTACTS::DEFAULT_MENU();
break;		
}
?>











