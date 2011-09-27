<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

$task = JRequest::getVar('task');
switch ( $task ) {
	case 'editInvoice':
	case 'newInvoice':
		INVOICE_MENU();
		break;
	case 'editQuote':
	case 'newQuote':
		QUOTE_MENU();
		break;
	case 'listQuotes':
		DEFAULTQUOTES_MENU();
		break;
	case 'listInvoices':
		DEFAULTINVOICES_MENU();
		break;
	case 'viewQuote':
		DETAIL_QUOTE_MENU();
		break;
	case 'viewInvoice':
		DETAIL_INVOICE_MENU();
		break;
	case 'viewService':
		DETAIL_SERVICE_MENU();
		break;		
	case 'config':
		CONFIG_MENU();
		break;
	case 'editService':
	case 'newService':
		SERVICE_MENU();
		break;
	case 'listServices':
		DEFAULTSERVICES_MENU();
		break;
	default:
		break;		
}

function DEFAULTINVOICES_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	# $bar->appendButton('Standard','back','Back','',false, false);
	$bar->appendButton('Standard','new','New','newInvoice',false, false);
	$bar->appendButton('Standard','edit','Edit','editInvoice',true, false);
	$bar->appendButton('Standard','delete','Delete','deleteInvoice',true, false);
	echo $bar->render();
}
function INVOICE_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	if ( $id ) {
	$bar->appendButton('Standard','cancel','Cancel','listInvoices',false, false);
	} else {
	$bar->appendButton('Standard','cancel','Close','listInvoices',false, false);
	}
	$bar->appendButton('Standard','save','Save','saveInvoice',false, false);
	if( $id) { 
	$bar->appendButton('Standard','convert','Convert','convertInvoice',false, false);
	}
	echo $bar->render();
}

function DEFAULTQUOTES_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	$bar->appendButton('Standard','new','New','newQuote',false, false);
	$bar->appendButton('Standard','edit','Edit','editQuote','', false);
	$bar->appendButton('Standard','delete','Trash','deleteQuote',false, false);
	echo $bar->render();
}
function QUOTE_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	if(!isset($id)) { 
	$bar->appendButton('Standard','cancel','Close','listQuotes',false, false);
	} else {
	$bar->appendButton('Standard','cancel','cancel','listQuotes',false, false);
	}
	$bar->appendButton('Standard','save','Save','saveQuote',false, false);
	echo $bar->render();
}

function CONFIG_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	if ( $id ) {
	$bar->appendButton('Standard','cancel','Cancel','',false, false);
	} else {
	$bar->appendButton('Standard','cancel','Close','',false, false);
	}
	$bar->appendButton('Standard','save','Save','saveConfig',false, false);
	echo $bar->render();
}

function DETAIL_QUOTE_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	$bar->appendButton('Standard','back','Back','listQuotes',false, false);
	$bar->appendButton('Standard','edit','Edit','editQuote',false, false);
	echo $bar->render();
}

function DETAIL_INVOICE_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	$bar->appendButton('Standard','back','Back','listInvoices',false, false);
	$bar->appendButton('Standard','edit','Edit','editInvoice',false, false);
	echo $bar->render();
}

function DETAIL_SERVICE_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	$bar->appendButton('Standard','back','Back','listServices',false, false);
	$bar->appendButton('Standard','edit','Edit','editService',false, false);
	echo $bar->render();
}

function DEFAULTSERVICES_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	$bar->appendButton('Standard','new','New','newService',false, false);
	$bar->appendButton('Standard','edit','Edit','editService','', false);
	$bar->appendButton('Standard','delete','Trash','deleteService',false, false);
	echo $bar->render();
}

function SERVICE_MENU() {
	$bar =& new JToolBar( 'SupportMenu' );
	if(!isset($id)) { 
	$bar->appendButton('Standard','cancel','Close','listServices',false, false);
	} else {
	$bar->appendButton('Standard','cancel','cancel','listServices',false, false);
	}
	$bar->appendButton('Standard','save','Save','saveService',false, false);
	echo $bar->render();

}
?>