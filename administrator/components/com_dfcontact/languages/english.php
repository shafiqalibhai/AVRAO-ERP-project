<?php
/**
* DFContact - A Joomla! contact form component
* @version 1.0.3
* @package DFContact
* @copyright (C) 2005 by Daniel Filzhut
* @license Released under the terms of the GNU General Public License
**/

/**
* To add another language:
* - copy this file
* - replace it's name with the name of the new language and extension ".php"
* - change all language constants to your language
* - put the file into the folder with the language files
* - the new language is availible in the admin-area automatically
**/

define('DFCONTACT', 'DFContact');
define('DFCONTACT_YES', 'Yes');
define('DFCONTACT_NO', 'No');

// Saving
define('DFCONTACT_ERROR', 'Error');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Saving failed (config file not writable)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Saving failed (could not open config file)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Saving failed (could not write config file)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Settings successfully saved!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'General');
define('DFCONTACT_DESTINATIONMAIL', 'Destination email');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email to send form data to.');
define('DFCONTACT_PAGETITLE', 'Page title');
define('DFCONTACT_PAGETITLE_INFO', 'Will be displayed above all content.');
define('DFCONTACT_INFOTEXT', 'Info text');
define('DFCONTACT_INFOTEXT_INFO', 'Will be displayed right above the contact data.');
define('DFCONTACT_FORMTEXT', 'Form text');
define('DFCONTACT_FORMTEXT_INFO', 'Will be displayed right above the contact form.');
define('DFCONTACT_BUTTONTEXT', 'Button Text');
define('DFCONTACT_BUTTONTEXT_INFO', 'Alternative text on the submit button.');
define('DFCONTACT_LANGUAGE', 'Language');
define('DFCONTACT_ADDRESSSTYLE', 'Address style');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Local output format for addresses.');
define('DFCONTACT_CLICKABLELINKS', 'Clickable links');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Clickable links are comfortable, but also support email-harvesting.');
define('DFCONTACT_HTMLMAILS', 'HTML mails');
define('DFCONTACT_HTMLMAILS_INFO', 'Send emails in HTML format.');
define('DFCONTACT_ADDSERVERDATA', 'Add server data');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Adds data about the user\'s browser, operating system and IP to your email (User will not recognize this).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Display user input:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'After email has been sent, display resumed input to user.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Your data');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Enter the data to be displayed on the contact page.');
define('DFCONTACT_COMPANY', 'Company');
define('DFCONTACT_TITLE', 'Title');
define('DFCONTACT_NAME', 'Name');
define('DFCONTACT_POSITION', 'Position');
define('DFCONTACT_STREET', 'Street');
define('DFCONTACT_POSTBOX', 'Postbox');
define('DFCONTACT_ZIP', 'ZIP');
define('DFCONTACT_CITY', 'City');
define('DFCONTACT_STATE', 'State');
define('DFCONTACT_COUNTRY', 'Country');
define('DFCONTACT_PHONE', 'Phone');
define('DFCONTACT_MOBILE', 'Mobile');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Message');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Displays a checkbox underneath the message textarea. Setting this as duty-field will force the user to check it.');
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox-Text');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Will be displayed next to the checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Form fields');
define('DFCONTACT_HIDE', 'Hide');
define('DFCONTACT_SHOW', 'Show');
define('DFCONTACT_OPTIONAL', 'Optional');
define('DFCONTACT_DUTY', 'Duty');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Choose the fields that are displayed in the contact form and define which fields have to be filled out before sending.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'About');
define('DFCONTACT_ABOUT_VERSION', 'Version');
define('DFCONTACT_ABOUT_PROGRAM', 'Program');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact is a contact form component which is extremly easy to configure. It displays contact data and a contact form on the same page. The availible fields in the form can be choosen and set as duty fields. If you have some ideas to extend this component or found some bugs, please contact the author.');
define('DFCONTACT_ABOUT_AUTHOR', 'Author');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Warranty');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'This program is released under GNU General Public License (GPL) and is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Please fill out the following fields:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Please enter a valid email-adress!');
define('DFCONTACT_FORM_TITLE_MR', 'Mr.');
define('DFCONTACT_FORM_TITLE_MRS', 'Mrs.');
define('DFCONTACT_FORM_SUBMIT', 'Submit');
define('DFCONTACT_FORM_BACK', 'back');
define('DFCONTACT_FORM_DATE_FORMAT', 'Y/m/d H:i:s');
define('DFCONTACT_FORM_DATE', 'Date');
define('DFCONTACT_FORM_SENT_URL', 'Form URL');
define('DFCONTACT_FORM_USERAGENT', 'User agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Somebody sent you an email using the form on your website. This is what he typed in:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'The following lines contain information which has not been typed in, but collected by the server.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Contact email');
define('DFCONTACT_FORM_MAIL_ERROR', 'Error: Mail has not been sent. Please try again later.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mail has been successfully sent.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'The following data has been submitted:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Please enter the chars from the picture into the following field. If you find it difficult to read, click the button next to the image to load another one.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha with valid code!');
define('DFCONTACT_CAPTCHA_INFO', 'Display an image with characters as part of the form. The user has to enter the characters into a separate field to proove he is human. This should prevent spambots using the form.<br /><b>Works only if the component <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is installed (Version >= 4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: No destination email has been set, please login to the administration area and set one.');

?>