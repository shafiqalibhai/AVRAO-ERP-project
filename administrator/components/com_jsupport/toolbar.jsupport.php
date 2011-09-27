<?
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( $mainframe->getPath( 'toolbar_html' ) ); 
$task = JRequest::getVar('task');
switch ( $task ) {
case 'editTicket':
case 'newTicket':
menuCLIENTS::TICKET_MENU();
break;
case 'convertTicket':
case 'editFaq':
case 'newFaq':
menuCLIENTS::FAQ_MENU();
break;
case 'listFaqs':
menuCLIENTS::DEFAULTFAQS_MENU();
break;
case 'listTickets':
menuCLIENTS::DEFAULTTICKETS_MENU();
break;
case 'viewFaq':
menuCLIENTS::DETAIL_FAQ_MENU();
break;
case 'viewTicket':
menuCLIENTS::DETAIL_TICKET_MENU();
break;
case 'config':
menuCLIENTS::CONFIG_MENU();
break;
case 'editCategory':
case 'newCategory':
menuCLIENTS::CATEGORY_MENU();
break;
case 'listCategories':
menuCLIENTS::DEFAULTCATEGORIES_MENU();
break;
case 'editComment':
case 'newComment':
menuCLIENTS::COMMENT_MENU();
break;
case 'listComments':
menuCLIENTS::DEFAULTCOMMENTS_MENU();
break;
default:
menuCLIENTS::DEFAULT_MENU();
break;		
}
?>