<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class menuCLIENTS{

function DEFAULT_MENU() {
/*
JToolBarHelper::startTable();
JToolBarHelper::spacer();
JToolBarHelper::addNew('newInvoice', 'New Invoice');
JToolBarHelper::spacer();
JToolBarHelper::publish('listInvoices', 'List Invoices');
JToolBarHelper::spacer();
JToolBarHelper::addNew('newQuote', 'New Quote');
JToolBarHelper::spacer();
JToolBarHelper::publish('listQuotes', 'List Quotes');
JToolBarHelper::endTable();
*/
}

function DEFAULTINVOICES_MENU() {
JToolBarHelper::custom('','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('newInvoice','new.png','new.png',_NEW_BUTTON, false);
JToolBarHelper::custom('editInvoice','edit.png','edit.png',_EDIT_BUTTON, false);
JToolBarHelper::custom('deleteInvoice','trash.png','trash.png',_DELETE_BUTTON, false);
}
function INVOICE_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listInvoices','cancel.png','cancel.png',_CANCEL_BUTTON, false);
} else {
JToolBarHelper::custom('listInvoices','cancel.png','cancel.png',_CLOSE_BUTTON, false);
}
JToolBarHelper::custom('saveInvoice','save.png','save.png',_SAVE_BUTTON, false);
}

function DEFAULTQUOTES_MENU() {
JToolBarHelper::custom('','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('newQuote','new.png','new.png',_NEW_BUTTON, false);
JToolBarHelper::custom('editQuote','edit.png','edit.png',_EDIT_BUTTON, false);
JToolBarHelper::custom('deleteQuote','trash.png','trash.png',_DELETE_BUTTON, false);
}

function QUOTE_MENU() {
if(!isset($id)) { 
JToolBarHelper::custom('listQuotes','back.png','cancel.png',_CANCEL_BUTTON, false);
} else {
JToolBarHelper::custom('listQuotes','back.png','cancel.png',_CLOSE_BUTTON, false);
}
JToolBarHelper::custom('saveQuote','save.png','save.png',_SAVE_BUTTON, false);
}

function DEFAULTSERVICES_MENU() {
JToolBarHelper::custom('newService','new.png','new.png',_NEW_BUTTON, false);
JToolBarHelper::custom('editService','edit.png','edit.png',_EDIT_BUTTON, false);
JToolBarHelper::custom('deleteService','trash.png','trash.png',_DELETE_BUTTON, false);
}

function SERVICE_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listServices','cancel.png','cancel.png',_CANCEL_BUTTON, false);
} else {
JToolBarHelper::custom('listServices','cancel.png','cancel.png',_CLOSE_BUTTON, false);
}
JToolBarHelper::custom('saveService','save.png','save.png',_SAVE_BUTTON, false);
}

function CONFIG_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('','cancel.png','cancel.png',_CANCEL_BUTTON, false);
} else {
JToolBarHelper::custom('','cancel.png','cancel.png',_CLOSE_BUTTON, false);
}
JToolBarHelper::custom('saveConfig','save.png','save.png',_SAVE_BUTTON, false);

}

function DETAIL_QUOTE_MENU() {
JToolBarHelper::custom('listQuotes','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('editQuote','edit.png','edit.png',_EDIT_BUTTON, false);
}

function DETAIL_INVOICE_MENU() {
JToolBarHelper::custom('listInvoices','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('editInvoice','edit.png','edit.png',_EDIT_BUTTON, false);
}

function DETAIL_SERVICE_MENU() {
JToolBarHelper::custom('listServices','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('editService','edit.png','edit.png',_EDIT_BUTTON, false);
}

}
?>