<?php
defined('_JEXEC') or die('Restricted access');

class menuCLIENTS{

function DEFAULT_MENU() {
/*
JToolBarHelper::addNew('newInvoice', 'New Invoice');
JToolBarHelper::publish('listInvoices', 'List Invoices');
JToolBarHelper::addNew('newQuote', 'New Quote');
JToolBarHelper::publish('listQuotes', 'List Quotes');
*/
}

function DEFAULTPROJECTS_MENU() {
JToolBarHelper::custom('','back.png','back.png','Back', false);
JToolBarHelper::custom('newProject','new.png','new.png','New', false);
JToolBarHelper::custom('editProject','edit.png','edit.png','Edit', false);
JToolBarHelper::custom('deleteProject','trash.png','trash.png','Delete', false);
}
function PROJECT_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listProjects','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listProjects','cancel.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveProject','save.png','save.png','Save', false);
}

function DEFAULTTASKS_MENU() {
JToolBarHelper::custom('','back.png','back.png','Back', false);
JToolBarHelper::custom('newTask','new.png','new.png','New', false);
JToolBarHelper::custom('editTask','edit.png','edit.png','Edit', false);
JToolBarHelper::custom('deleteTask','trash.png','trash.png','Delete', false);
}

function TASK_MENU() {
if(!isset($id)) { 
JToolBarHelper::custom('listTasks','back.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listTasks','back.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveTask','save.png','save.png','Save', false);
}

function DEFAULTTIMES_MENU() {
JToolBarHelper::custom('newTime','new.png','new.png','New', false);
JToolBarHelper::custom('editTime','edit.png','edit.png','Edit', false);
JToolBarHelper::custom('deleteTime','trash.png','trash.png','Delete', false);
}

function TIME_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listTimes','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listTimes','cancel.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveTime','save.png','save.png','Save', false);
}

function DEFAULTFILES_MENU() {
JToolBarHelper::custom('newFile','new.png','new.png','New', false);
JToolBarHelper::custom('editFile','edit.png','edit.png','Edit', false);
JToolBarHelper::custom('deleteFile','trash.png','trash.png','Delete', false);
}

function FILE_MENU() {
if ( $id ) {
// for existing content items the button is renamed `close`
JToolBarHelper::custom('listFiles','cancel.png','cancel.png','Cancel', false);
} else {
JToolBarHelper::custom('listFiles','cancel.png','cancel.png','Close', false);
}
JToolBarHelper::custom('saveFile','save.png','save.png','Save', false);
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

function DETAIL_TASK_MENU() {
JToolBarHelper::custom('startTimer','time_tracker.png','time_tracker.png','Start Timer', false);
JToolBarHelper::custom('listTasks','back.png','back.png','Back', false);
JToolBarHelper::custom('editTask','edit.png','edit.png','Edit', false);
}

function DETAIL_PROJECT_MENU() {
JToolBarHelper::custom('listProjects','back.png','back.png','Back', false);
JToolBarHelper::custom('editProject','edit.png','edit.png','Edit', false);
}

function DETAIL_TIME_MENU() {
JToolBarHelper::custom('listTimes','back.png','back.png','Back', false);
JToolBarHelper::custom('editTime','edit.png','edit.png','Edit', false);
}

function DETAIL_FILE_MENU() {
JToolBarHelper::custom('listFiles','back.png','back.png','Back', false);
JToolBarHelper::custom('editFile','edit.png','edit.png','Edit', false);
}
function CALENDAR_MONTH_MENU() {
JToolBarHelper::back();
JToolBarHelper::custom('thisMonth','edit.png','edit.png','This Month', false);

}

function CALENDAR_DAY_MENU() {
JToolBarHelper::back();
JToolBarHelper::custom('today','edit.png','edit.png','Today', false);
}

}
?>