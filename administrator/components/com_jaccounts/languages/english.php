<?php

//Menu Items
define("_MENU","Menu");
define("_HOME_MENU_LINK","Home");
define("_VIEW_INVOICES_MENU_LINK","View Invoices");
define("_VIEW_QUOTES_MENU_LINK","View Quotes");
define("_NEW_INVOICE_MENU_LINK","Create Invoice");
define("_NEW_QUOTE_MENU_LINK","Create Quote");
define("_SERVICES_MENU","Services");
define("_MANAGE_SERVICES_MENU_LINK","Manage Services");
define("_ADD_SERVICE_MENU_LINK","Add Service");
define("_CONFIGURATION_MENU","Configuration");
define("_CONFIG_MENU_LINK","Settings");
define("_ABOUT_MENU_LINK","About");

//Control Panel
define("_LATEST_INVOICES","Latest Invoices");
define("_NO_INVOICES_AVAILABLE","No Invoices Available");
define("_LATEST_QUOTES","Latest Quotes");
define("_NO_QUOTES_AVAILABLE","No Quotes Available");
define("_LATEST_SERVICES","Latest Services");
define("_STANDARD_PRICE","Standard Price");
define("_NO_SERVICES_AVAILABLE","No Services Available");
define("_VIEW_ALL","View All");

//Miscellaneous
define("_POWERED_BY","Powered By");
define("_MY","My");
define("_JID","ID");
define("_JNAME","Name");
define("_CLIENT","Client");
define("_ACCOUNT","Account");
define("_VALID_TILL","Valid Till");
define("_FILTER","Filter");
define("_JSUBMIT","Submit");
define("_SHOW_ALL","Show All");
define("_MANAGER","Manager");
define("_PUBLISHED","Published");
define("_UNPUBLISHED","Unpublished");
define("_DISPLAY","Display");
define("_CREATE_ONE_NOW","Create one now");
define("_SEARCH_TITLE","Search");
define("_JUSERNAME","Username");
define("_JEMAIL","Email");
define("_YES","Yes");
define("_NO","No");
define("_TAX_RATE", "Tax Rate");
define("_GRAND_TOTAL", "Grand Total");
define("_TAX", "Tax");

//Configuration
define("_CONFIGURATION_MANAGER","Configuration Manager");
define("_GENERAL","General");
define("_CURRENT_SETTING","Current Setting");
define("_DESCRIPTION", "Description");
define("_COMPANY_NAME","Company Name");
define("_DESCRIPTION_COMPANY_NAME","The name you want used on quotes and invoices.");
define("_COMPANY_ADDRESS","Company Address");
define("_DESCRIPTION_COMPANY_ADDRESS","The address you want used on quotes and invoices.");
define("_COMPANY_EMAIL", "Company Email");
define("_DESCRIPTION_COMPANY_EMAIL","The email address used for quote and invoice notifications and general correspondence.");
define("_TERMS_AND_CONDITIONS","Terms and Conditions");
define("_DESCRIPTION_TERMS_CONDITIONS","A link to the content item that defines your Terms and Conditions");
define("_ENABLE_ACCESS_RESTRICTIONS","Enable Access Restrictions");
define("_DESCRIPTION_ACCESS_RESTRICTIONS","Administrators only see quotes/invoices assigned to them.  (Super Administrators see all.)");
define("_CURRENCY","Currency");
define("_TAX_DESCRIPTION","Tax to be used on Quotes/Invoices. [Percent]");
define("_CURRENCY_DESCRIPTION","The currency to be used throughout the site.");
define("_INVOICING","Invoicing");
define("_AUTO_INVOICING","Automatic Invoice Generation");
define("_AUTO_INVOICING_DESCRIPTION","Automatically create invoices (unpublished) upon quote save.");
define("_INVOICE_FORMAT","Invoice Format");
define("_INVOICE_FORMAT_DESCRIPTION","(Only if using Automatic Invoice Generation)<br />How many payments do you want each quote split into? (e.g. 2 = Initial/Final)");
define("_BILLING","Billing");
define("_DEFAULT_GATEWAY","Default Payment Gateway");
define("_DEFAULT_GATEWAY_DESCRIPTION","Default method of payment to be used for billing.");
define("_PAYPAL_ADDRESS","PayPal Email Address");
define("_PAYPAL_DESCRIPTION","Enter the PayPal email address you want payments sent to.");
define("_GOOGLE_ID","Google Checkout Merchant ID");
define("_GOOGLE_DESCRIPTION","Enter the Google Merchant ID ");
define("_AUTHORIZE_LOGIN","Authorize.net Login");
define("_AUTHORIZE_DESCRIPTION","Enter the Authorize.net Login (API)");
define("_AUTHORIZE_KEY","Authorize.net Key");
define("_AUTHORIZE_KEYDESCRIPTION","Enter the Authorize.net Key");
define("_AUTHORIZE_TESTMODE","Authorize.net Test Mode");
define("_AUTHORIZE_TEST_DESCRIPTION","Select 'No' to go live with Authorize.net");
define("_CHECKOUT_SID","2Checkout SID");
define("_CHECKOUT_DESCRIPTION","Enter the 2Checkout SID");
define("_EMAILS","Emails");
define("_JREQUIRED","Required:");
define("_ACCEPTED_QUOTE_SUBJECT","Accepted Quote Email Subject");
define("_ACCEPTED_QUOTE_SUBJECT_DESCRIPTION","Subject of the Accepted Quote email defined below.");
define("_ACCEPTED_QUOTE","Accepted Quote Email");
define("_ACCEPTED_QUOTE_DESCRIPTION","Email that will be sent to clients upon accepting a quote.<br /><br />Available variables: ");
define("_JOPTIONAL","Optional");
define("_AUTOMATED_EMAIL","Automated Email Notifications");
define("_AUTOMATED_EMAIL_DESCRIPTION","Send email upon Quote/Invoice publishing.");
define("_NEW_QUOTE_EMAIL_SUBJECT","New Quote Email Subject");
define("_NEW_QUOTE_EMAIL_SUBJECT_DESCRIPTION","Subject of the Quote email defined below.");
define("_NEW_QUOTE_EMAIL","New Quote Email");
define("_NEW_QUOTE_EMAIL_DESCRIPTION","Email that will be sent to clients upon publishing of quote.");
define("_NEW_INVOICE_EMAIL_SUBJECT","New Invoice Email Subject");
define("_NEW_INVOICE_EMAIL_SUBJECT_DESCRIPTION","Subject of the Invoice email defined below.");
define("_NEW_INVOICE_EMAIL","New Invoice Email");
define("_NEW_INVOICE_EMAIL_DESCRIPTION","Email that will be sent to clients upon publishing of invoice.");


//Invoice Items
define("_INVOICE_DETAILS","Invoice Details");
define("_INVOICE_NAME","Invoice Name");
define("_INVOICE_STAGE","Invoice Stage");
define("_PROJECT","Project");
define("_STATUS","Status");
define("_PAYMENT_METHOD","Payment Method");
define("_NET_TOTAL","Net Total");
define("_PENDING","Pending");
define("_PAID","Paid");
define("_INVOICES","Invoices");
define("_INVOICE_ID","Invoice ID");
define("_INVOICE_PAID","Invoice Paid");
define("_INVOICE_NOT_PAID","Invoice Not Paid");
define("_INVOICE_PREPARED_FOR","Invoice Prepared for");
define("_SHOW_MORE","Show More");
define("_PAYMENT_SIGNIFIES_ACCEPTANCE","Payment signifies acceptance of Terms and Conditions");
define("_MAIL_PAYMENT","Please mail payment to the address below.");

//Quote Items
define("_QUOTE_DETAILS","Quote Details");
define("_QUOTE_NAME","Quote Name");
define("_QUOTE_STAGE","Quote Stage");
define("_PENDING","Pending");
define("_ACCEPTED","Accepted");
define("_DENIED","Denied");
define("_VIEWED","Viewed");
define("_QUOTES","Quotes");
define("_QUOTE_ID","Quote ID");
define("_QUOTE_ACCEPTED","Quote Accepted");
define("_QUOTE_NOT_ACCEPTED","Quote Not Accepted");
define("_QUOTE_PREPARED_FOR","Quote Prepared For");
define("_ACCEPT_QUOTE","Accept Quote");

//Service Details
define("_SERVICE_DETAILS","Service Details");
define("_SERVICE","Service");
define("_QUANTITY","Quantity");
define("_PRICE","Price");
define("_UNIT","Unit");
define("_TOTAL","Total");
define("_ADD_SERVICE","Add Service");
define("_SERVICE_NAME","Service Name");
define("_SERVICE_DESCRIPTION","Service Description");
define("_STANDARD_PRICE","Standard Price");
define("_DESCRIPTION","Description");
define("_ITEM","Item");

//Toolbar
define("_BACK_BUTTON","Back");
define("_DELETE_BUTTON","Delete");
define("_NEW_BUTTON","New");
define("_EDIT_BUTTON","Edit");
define("_CANCEL_BUTTON","Cancel");
define("_CLOSE_BUTTON","Close");
define("_SAVE_BUTTON","Save");


?>
