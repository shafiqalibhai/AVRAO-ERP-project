<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class menuCLIENTS{

function DEFAULT_MENU() {
/*


JToolBarHelper::addNew('newInvoice', 'New Invoice');

JToolBarHelper::publish('listInvoices', 'List Invoices');

JToolBarHelper::addNew('newQuote', 'New Quote');

JToolBarHelper::publish('listQuotes', 'List Quotes');

*/
}

function DEFAULTTICKETS_MENU() {


JToolBarHelper::custom('','back.png','back.png','Back', false);

JToolBarHelper::custom('newTicket','new.png','new.png','New', false);

JToolBarHelper::custom('editTicket','edit.png','edit.png','Edit', false);

JToolBarHelper::custom('deleteTicket','trash.png','trash.png','Delete', false);


}
function TICKET_MENU() {


if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listTickets','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listTickets','cancel.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveTicket','save.png','save.png','Save', false);

if( $id) { 
JToolBarHelper::custom('convertTicket','save.png','save.png','Convert', false);

}

}

function DEFAULTFAQS_MENU() {


JToolBarHelper::custom('','back.png','back.png','Back', false);

JToolBarHelper::custom('newFaq','new.png','new.png','New', false);

JToolBarHelper::custom('editFaq','edit.png','edit.png','Edit', false);

JToolBarHelper::custom('deleteFaq','trash.png','trash.png','Delete', false);


}

function FAQ_MENU() {


if(!isset($id)) { 
JToolBarHelper::custom('listFaqs','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listFaqs','cancel.png','cancel.png','Close', false);
}

JToolBarHelper::custom('saveFaq','save.png','save.png','Save', false);

}

function CONFIG_MENU() {


if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('','cancel.png','cancel.png','Close', false);
}

JToolBarHelper::custom('saveConfig','save.png','save.png','Save', false);


}

function DETAIL_FAQ_MENU() {


JToolBarHelper::custom('listFaqs','back.png','back.png','Back', false);

JToolBarHelper::custom('editFaq','edit.png','edit.png','Edit', false);


}

function DETAIL_TICKET_MENU() {


JToolBarHelper::custom('listTickets','back.png','back.png','Back', false);

JToolBarHelper::custom('editTicket','edit.png','edit.png','Edit', false);

JToolBarHelper::custom('convertTicket','save.png','save.png','Convert', false);


}
function DEFAULTCATEGORIES_MENU() {


JToolBarHelper::custom('','back.png','back.png','Back', false);

JToolBarHelper::custom('newCategory','new.png','new.png','New', false);

JToolBarHelper::custom('editCategory','edit.png','edit.png','Edit', false);

JToolBarHelper::custom('deleteCategory','trash.png','trash.png','Delete', false);


}
function CATEGORY_MENU() {


if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listCategories','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listCategories','cancel.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveCategory','save.png','save.png','Save', false);


}
function DEFAULTCOMMENTS_MENU() {


JToolBarHelper::custom('','back.png','back.png','Back', false);

JToolBarHelper::custom('newComment','new.png','new.png','New', false);

JToolBarHelper::custom('editComment','edit.png','edit.png','Edit', false);

JToolBarHelper::custom('deleteComment','trash.png','trash.png','Delete', false);


}
function COMMENT_MENU() {


if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listComments','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listComments','cancel.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveComment','save.png','save.png','Save', false);


}

}
?>