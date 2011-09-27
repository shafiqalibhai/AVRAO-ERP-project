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
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Kunde inte spara (konfigureringsfil ej skrivbar)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Kunde inte spara (kunde ej öppna konfigureringsfil)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Kunde inte spara (kunde ej skriva till konfigureringsfil)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Inställningar sparade!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'General');
define('DFCONTACT_DESTINATIONMAIL', 'Destinationsadress');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'E-postadress att skicka data till.');
define('DFCONTACT_PAGETITLE', 'Sidtitel');
define('DFCONTACT_PAGETITLE_INFO', 'Visas ovanför innehållet');
define('DFCONTACT_INFOTEXT', 'Infotext');
define('DFCONTACT_INFOTEXT_INFO', 'Visas direkt ovanför kontaktinformation.');
define('DFCONTACT_FORMTEXT', 'Formulärtext');
define('DFCONTACT_FORMTEXT_INFO', 'Visas strax ovanför kontaktformuläret.');
define('DFCONTACT_BUTTONTEXT', 'Text på knappen');
define('DFCONTACT_BUTTONTEXT_INFO', 'Alternativ text för skickaknappen.');
define('DFCONTACT_LANGUAGE', 'Språk');
define('DFCONTACT_ADDRESSSTYLE', 'Adresstil');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Lokalt format på adressen.');
define('DFCONTACT_CLICKABLELINKS', 'Klickbara länkar');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Klickbara länkar är praktiskt, men möjligör också e-postadressinsamling.');
define('DFCONTACT_HTMLMAILS', 'HTML-formaterade brev');
define('DFCONTACT_HTMLMAILS_INFO', 'Skicka e-post i HTML-format.');
define('DFCONTACT_ADDSERVERDATA', 'Lägg till serverdata');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Sparar data om besökarens webbläsare, operativsystem och IP-adress till e-postmeddelandet.');
define('DFCONTACT_DISPLAYUSERINPUT', 'Visa användardata:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Efter att meddelandet har skickats, visa inmatad information för besökaren.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Din information');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Mata in den information som blir synlig på kontaktsidan.');
define('DFCONTACT_COMPANY', 'FÖretag');
define('DFCONTACT_TITLE', 'Titel');
define('DFCONTACT_NAME', 'Namn');
define('DFCONTACT_POSITION', 'Position');
define('DFCONTACT_STREET', 'Gata');
define('DFCONTACT_POSTBOX', 'Postbox');
define('DFCONTACT_ZIP', 'Postnr');
define('DFCONTACT_CITY', 'Postort');
define('DFCONTACT_STATE', 'Landskap');
define('DFCONTACT_COUNTRY', 'Land');
define('DFCONTACT_PHONE', 'Telefon');
define('DFCONTACT_MOBILE', 'Mobil');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'E-post');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Meddelande');
define('DFCONTACT_CHECKBOX', 'Kryssruta');
define('DFCONTACT_CHECKBOX_INFO', 'Kryssrutan visas under meddelanderutan. Genom att göra den obligatorisk, tvingar man användaren att kryssa i den.');
define('DFCONTACT_CHECKBOX_TEXT', 'Text för kryssrytan');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Text som visas bredvid kryssrutan.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Formulärfält');
define('DFCONTACT_HIDE', 'Göm');
define('DFCONTACT_SHOW', 'Visa');
define('DFCONTACT_OPTIONAL', 'Frivillig');
define('DFCONTACT_DUTY', 'Obligatorisk');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Välj de fält som ska visas på kontaktsidan och definiera de fält som är obligatoriska.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Om');
define('DFCONTACT_ABOUT_VERSION', 'Version');
define('DFCONTACT_ABOUT_PROGRAM', 'Program');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact är en kontaktformulärskomponent som är lätt att konfigurera. Den visar kontaktinformation och meddelanderuta på samma sida. De valbara fälten kan sättas som obligatoriska. Om du har några idéer om hur vi kan förbättra denna komponent, eller hittade buggar, var god kontakta tillverkaren.');
define('DFCONTACT_ABOUT_AUTHOR', 'Tillverkare');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garanti');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Detta program är släppt under GNU General Public License (GPL) och distribueras med hopp om att det ska komma till nytta, men UTAN NÅGON GARANTI; utan minsta garanti om SÄLJBARHET eller ANVÄNDBAR FÖR ETT SPECIFIKT SYFTE.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Var god fyll i följande fält:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Var god, uppge fungerande e-postadress!');
define('DFCONTACT_FORM_TITLE_MR', 'Herr.');
define('DFCONTACT_FORM_TITLE_MRS', 'Fru/fröken.');
define('DFCONTACT_FORM_SUBMIT', 'Skicka');
define('DFCONTACT_FORM_BACK', 'Tillbaka');
define('DFCONTACT_FORM_DATE_FORMAT', 'Y-m-d H:i:s');
define('DFCONTACT_FORM_DATE', 'Datum');
define('DFCONTACT_FORM_SENT_URL', 'URL');
define('DFCONTACT_FORM_USERAGENT', 'User agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Någon skickade det här meddelandet från kontaktformuläret på din hemsida. Meddelande följer:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'Följande information om besökaren samlades in:');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Kontaktadress');
define('DFCONTACT_FORM_MAIL_ERROR', 'Error: Meddelandet skickades inte. Försök igen.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Meddelandet har skickats.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Följande information skickades:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Please enter the chars from the picture into the following field. If you find it difficult to read, click the button next to the image to load another one.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha with valid code!');
define('DFCONTACT_CAPTCHA_INFO', 'Display an image with characters as part of the form. The user has to enter the characters into a separate field to proove he is human. This should prevent spambots using the form.<br /><b>Works only if the component <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is installed (Version >= 4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: No destination email has been set, please login to the administration area and set one.');


?>