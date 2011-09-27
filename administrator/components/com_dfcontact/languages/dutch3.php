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
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Opslaan mislukt (configuratiebestand niet schrijfbaar)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Opslaan mislukt (kon configuratiebestand niet openen)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Opslaan mislukt (kon niet naar configuratiebestand schrijven)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Instellingen succesvol opgeslagen!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Algemeen');
define('DFCONTACT_DESTINATIONMAIL', 'Emailadres bestemming');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Emailadres om formulierdata naar toe te zenden.');
define('DFCONTACT_PAGETITLE', 'Pagina titel');
define('DFCONTACT_PAGETITLE_INFO', 'Wordt boven alle inhoud weergegeven.');
define('DFCONTACT_INFOTEXT', 'Info tektt');
define('DFCONTACT_INFOTEXT_INFO', 'Wordt direct boven de contactinformatie weergegeven.');
define('DFCONTACT_FORMTEXT', 'Formulier tekst');
define('DFCONTACT_FORMTEXT_INFO', 'Wordt direct boven het contactformulier weergegeven.');
define('DFCONTACT_BUTTONTEXT', 'Button tekst');
define('DFCONTACT_BUTTONTEXT_INFO', 'Alternatieve tekst op de verzend knop.');
define('DFCONTACT_LANGUAGE', 'Taal');
define('DFCONTACT_ADDRESSSTYLE', 'Adres stijl');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Lokaal formaat voor adressen.');
define('DFCONTACT_CLICKABLELINKS', 'Clickable links');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Clickable links zijn handig, maar verschaffen mogelijkheden tot email-harvesting.');
define('DFCONTACT_HTMLMAILS', 'HTML mails');
define('DFCONTACT_HTMLMAILS_INFO', 'Zend emails in HTML formaat.');
define('DFCONTACT_ADDSERVERDATA', 'Voeg serverdata toe');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Voeg data over de browser, besturingssysteem en het IP adres van de gebruiker naar uw e-mail (Gebruiker merkt hier niets van).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Geef gebruikers input weer');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Nadat de e-mail verzonden is, geef een samenvatting van de informatie weer.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Uw informatie');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Geef de informatie die wordt weergegeven op de contact pagina.');
define('DFCONTACT_COMPANY', 'Bedrijf');
define('DFCONTACT_TITLE', 'Titel');
define('DFCONTACT_NAME', 'Naam');
define('DFCONTACT_POSITION', 'Functie');
define('DFCONTACT_STREET', 'Straat');
define('DFCONTACT_POSTBOX', 'Postbus');
define('DFCONTACT_ZIP', 'Postcode');
define('DFCONTACT_CITY', 'Plaats');
define('DFCONTACT_STATE', 'Staat');
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
define('DFCONTACT_CHECKBOX', 'Aankruisvakje');
define('DFCONTACT_CHECKBOX_INFO', 'Geef een aankruisvakje weer over het berichtinvoerveld. Door dit als verplicht veld in te stellen, moet de gebruiker het aankruisen voor het bericht verstuurd kan worden.');
define('DFCONTACT_CHECKBOX_TEXT', 'Tekst aankruisvakje');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Wordt naast het aankruisvakje weergegeven.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Formulier velden');
define('DFCONTACT_HIDE', 'Verberg');
define('DFCONTACT_SHOW', 'Geef weer');
define('DFCONTACT_OPTIONAL', 'Optioneel');
define('DFCONTACT_DUTY', 'Verplicht');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Kies de velden die worden weergegeven in het contact formulier en geef aan welke velden moeten worden ingevuld voor een bericht verzonden kan worden.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Over');
define('DFCONTACT_ABOUT_VERSION', 'Versie');
define('DFCONTACT_ABOUT_PROGRAM', 'Programma');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact is een contact formulier component dat extreem makkelijk te configureren is. Het geeft de contactinformatie en een contactformulier op dezelfde pagina weer. De beschikbare velden in het formulier kunnen worden gekozen en ingesteld worden als verplichte invoervelden. Als je idee&eacute;n hebt hoe dit component uit te breiden of je hebt een fout gevonden, neem dan contact op met de auteur.');
define('DFCONTACT_ABOUT_AUTHOR', 'Auteur');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantie');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Dit programma is uitgegeven onder de GNU General Public License (GPL) en is gedistribueerd in de hoop dat het bruikbaar is, maar ZONDER ENIGE GARANTIE; zelfs zonder the impliciete garantie van VERKOOPBAARHEID of het VOLDOEN AAN SPECIFIEKE DOELEN.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Vul de volgende velden in:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Geef een geldig e-mailadres!');
define('DFCONTACT_FORM_TITLE_MR', 'Men.');
define('DFCONTACT_FORM_TITLE_MRS', 'Mevr.');
define('DFCONTACT_FORM_SUBMIT', 'Verstuur');
define('DFCONTACT_FORM_BACK', 'terug');
define('DFCONTACT_FORM_DATE_FORMAT', 'Y/m/d H:i:s');
define('DFCONTACT_FORM_DATE', 'Datum');
define('DFCONTACT_FORM_SENT_URL', 'Formulier URL');
define('DFCONTACT_FORM_USERAGENT', 'Browser');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Poort');
define('DFCONTACT_FORM_MAIL_TEXT', 'Iemand heeft u een mail gestuurd via het formulier op uw website. Dit bericht is verstuurd:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'De volgende informatie is niet ingetypt, maar verzameld door de server.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Contact email');
define('DFCONTACT_FORM_MAIL_ERROR', 'Fout: Er is geen mail verstuurd. Probeer het later nog eens.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mail is succesvol verstuurd.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'De volgende informatie is verstuurd:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Voer de tekens die je in het plaatje ziet in het volgende invulveld. Als je de tekens moeilijk kan lezen Klik dan op "Volgende" om een nieuw plaatje te zien.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha met correcte tekens invullen!');
define('DFCONTACT_CAPTCHA_INFO', 'Toon een plaatje met tekens als onderdeel van het formulier. De gebruiker kan de tekens in een invulveld typen om aan te tonen dat hij een persoon is. Dit is om te voorkomen dat een spambot gebruik maakt van het formulier.<br /><b>Dit zal alleen werken als component <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is geïnstalleerd (Versie >= 4.0).</b>');
 
// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: Er is geen E-mail adres voor ontvanger ingesteld. Log alsjeblieft in op Beheer om dit in te stellen.');

?>