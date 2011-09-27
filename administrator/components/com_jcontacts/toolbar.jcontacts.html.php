<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
class menuCONTACTS{
function DEFAULT_MENU () {
}
function DEFAULTACCOUNTS_MENU() {
JToolBarHelper::custom('','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('newAccount','new.png','new.png',_NEW_BUTTON, false);
JToolBarHelper::custom('editAccount','edit.png','edit.png',_EDIT_BUTTON, false);
JToolBarHelper::custom('deleteAccount','trash.png','trash.png',_DELETE_BUTTON, false);
}
function ACCOUNT_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listAccounts','cancel.png','cancel.png',_CANCEL_BUTTON, false);
} else {
JToolBarHelper::custom('listAccounts','cancel.png','cancel.png',_CLOSE_BUTTON, false);
}
JToolBarHelper::custom('saveAccount','save.png','save.png',_SAVE_BUTTON, false);
}
function ACCOUNT_DETAIL_MENU() {
JToolBarHelper::custom('listAccounts','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('editAccount','edit.png','edit.png',_EDIT_BUTTON, false);
}
function DEFAULTLEADS_MENU() {
JToolBarHelper::custom('','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('newLead','new.png','new.png',_NEW_BUTTON, false);
JToolBarHelper::custom('editLead','edit.png','edit.png',_EDIT_BUTTON, false);
JToolBarHelper::custom('deleteLead','trash.png','trash.png',_DELETE_BUTTON, false);
}

function LEAD_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listLeads','cancel.png','cancel.png',_CANCEL_BUTTON, false);
} else {
JToolBarHelper::custom('listLeads','cancel.png','cancel.png',_CLOSE_BUTTON, false);
}
JToolBarHelper::custom('saveLead','save.png','save.png',_SAVE_BUTTON, false);
JToolBarHelper::custom('convertLead','convert_lead.png','convert_lead.png',_CONVERT_BUTTON, false);
}

function LEAD_DETAIL_MENU() {
JToolBarHelper::custom('listLeads','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('editLead','edit.png','edit.png',_EDIT_BUTTON, false);
JToolBarHelper::custom('convertLead','convert_lead.png','convert_lead.png',_CONVERT_BUTTON, false);
}

function DEFAULTCONTACTS_MENU() {
JToolBarHelper::custom('','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('newContact','new.png','new.png',_NEW_BUTTON, false);
JToolBarHelper::custom('editContact','edit.png','edit.png',_EDIT_BUTTON, false);
JToolBarHelper::custom('deleteContact','trash.png','trash.png',_DELETE_BUTTON, false);
}

function CONTACTS_MENU() {
JToolBarHelper::custom('requestUpdate','refresh.png','refresh.png',_REQUEST_BUTTON, false);
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listContacts','cancel.png','cancel.png',_CANCEL_BUTTON, false);
} else {
JToolBarHelper::custom('listContacts','cancel.png','cancel.png',_CLOSE_BUTTON, false);
}
JToolBarHelper::custom('saveContact','save.png','save.png',_SAVE_BUTTON, false);
}
function CONTACT_DETAIL_MENU() {
JToolBarHelper::custom('requestUpdate','refresh.png','refresh.png',_REQUEST_BUTTON, false);
JToolBarHelper::custom('listContacts','back.png','back.png',_BACK_BUTTON, false);
JToolBarHelper::custom('editContact','edit.png','edit.png',_EDIT_BUTTON, false);
}
function CONFIG_MENU() {
JToolBarHelper::custom('cancel','cancel.png','cancel.png',_CLOSE_BUTTON, false);
JToolBarHelper::save('saveConfig');

}
}

?>