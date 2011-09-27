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
define('DFCONTACT_YES', 'Ja');
define('DFCONTACT_NO', 'Nee');

// Saving
define('DFCONTACT_ERROR', 'Fout');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Opslaan niet gelukt (configuratiebestand is niet beschrijfbaar)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Opslaan niet gelukt (configuratiebestand is niet leesbaar)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Opslaan niet gelukt (configuratiebestand is niet beschrijfbaar)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Opslaan gelukt!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Algemeen');
define('DFCONTACT_DESTINATIONMAIL', 'Bestemming email');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email waar de informatie naartoe gestuurd wordt.');
define('DFCONTACT_PAGETITLE', 'Pagina titel');
define('DFCONTACT_PAGETITLE_INFO', 'Wordt boven de inhoud getoond.');
define('DFCONTACT_INFOTEXT', 'Informatie tekst');
define('DFCONTACT_INFOTEXT_INFO', 'Wordt getoond boven het contact formulier.');
define('DFCONTACT_FORMTEXT', 'Formulier tekst');
define('DFCONTACT_FORMTEXT_INFO', 'Wordt direct boven het formulier getoond.');
define('DFCONTACT_BUTTONTEXT', 'Knop tekst');
define('DFCONTACT_BUTTONTEXT_INFO', 'Alternatieve tekst op verzend knop.');
define('DFCONTACT_LANGUAGE', 'Taal');
define('DFCONTACT_ADDRESSSTYLE', 'Adres type');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Lokale output formaat voor adressen.');
define('DFCONTACT_CLICKABLELINKS', 'Klikbare links');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Klikbare links zijn comfortable, maar ondersteunen ook email-harvesting.');
define('DFCONTACT_HTMLMAILS', 'HTML mails');
define('DFCONTACT_HTMLMAILS_INFO', 'Verstuur email in HTML formaat.');
define('DFCONTACT_ADDSERVERDATA', 'Voeg server informatie toe');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Voegt informatie toe over de gebruiker\'s browser, besturingssysteem en IP adres in de verstuurde email (zonder kennisgevind aan de gebruiker).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Toon gebruiker input:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Nadat de email is verstuurd, toon overzicht van de gebruikers data.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Uw data');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Vul hier de data in welke boven het formulier getoond zal worden.');
define('DFCONTACT_COMPANY', 'Bedrijf');
define('DFCONTACT_TITLE', 'Titel');
define('DFCONTACT_NAME', 'Naam');
define('DFCONTACT_POSITION', 'Positie');
define('DFCONTACT_STREET', 'Straat');
define('DFCONTACT_POSTBOX', 'Postbus');
define('DFCONTACT_ZIP', 'Postcode');
define('DFCONTACT_CITY', 'Plaats');
define('DFCONTACT_STATE', 'Provincie');
define('DFCONTACT_COUNTRY', 'Land');
define('DFCONTACT_PHONE', 'Telefoon');
define('DFCONTACT_MOBILE', 'Mobiel');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Bericht');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Toont een checkbox onder het bericht-veld. Wanneer dit als verplicht veld wordt ingesteld, moet de gebruiker het aanvinken.');
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox tekst');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Wordt naast de checkbox getoond.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Formulier');
define('DFCONTACT_HIDE', 'Verberg');
define('DFCONTACT_SHOW', 'Vertoon');
define('DFCONTACT_OPTIONAL', 'Optioneel');
define('DFCONTACT_DUTY', 'Verplicht');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Kies de velden die worden weergegeven in het formulier en geef aan of deze verplicht of optioneel zijn.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Over');
define('DFCONTACT_ABOUT_VERSION', 'Versie');
define('DFCONTACT_ABOUT_PROGRAM', 'Programma');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact is een contactformulier component dat extreem makkelijk aan te passen is. Het vertoont contact-informatie en contact-formulier op dezelfde pagina. De beschikbare velden kunnen optioneel of verplicht worden gesteld. Indien u nieuwe ideëen heeft voor dit component, of bugs gevonden heeft, neem dan contact op met de auteur.');
define('DFCONTACT_ABOUT_AUTHOR', 'Auteur');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantie');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'This program is released under GNU General Public License (GPL) and is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'De volgende velden dienen ingevuld te worden:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Vul een geldig email adres in!');
define('DFCONTACT_FORM_TITLE_MR', 'Mr.');
define('DFCONTACT_FORM_TITLE_MRS', 'Mw.');
define('DFCONTACT_FORM_SUBMIT', 'Verzenden');
define('DFCONTACT_FORM_BACK', 'terug');
define('DFCONTACT_FORM_DATE_FORMAT', 'd-m-YY H:i:s');
define('DFCONTACT_FORM_DATE', 'Datum');
define('DFCONTACT_FORM_SENT_URL', 'Formulier URL');
define('DFCONTACT_FORM_USERAGENT', 'Browser');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Iemand heeft vanaf uw website een bericht verzonden. Dit is wat ingevuld is:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'De volgende regels bevatten informatie die niet ingevuld is, maar door de server verzameld is.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Contact email');
define('DFCONTACT_FORM_MAIL_ERROR', 'Fout: De email is niet verzonden. Probeer later a.u.b. opnieuw.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Email is succesvol verzonden.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'De volgende informatie is verzonden:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Voer de tekens die je in het plaatje ziet in het volgende invulveld. Als je de tekens moeilijk kan lezen Klik dan op "Volgende" om een nieuw plaatje te zien.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha met correcte tekens invullen!');
define('DFCONTACT_CAPTCHA_INFO', 'Toon een plaatje met tekens als onderdeel van het formulier. De gebruiker kan de tekens in een invulveld typen om aan te tonen dat hij een persoon is. Dit is om te voorkomen dat een spambot gebruik maakt van het formulier.<br /><b>Dit zal alleen werken als component <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is geïnstalleerd (Versie >= 4.0).</b>');
 
// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: Er is geen E-mail adres voor ontvanger ingesteld. Log alsjeblieft in op Beheer om dit in te stellen.');

?>