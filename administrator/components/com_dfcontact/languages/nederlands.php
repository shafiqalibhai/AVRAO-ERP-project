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

/**

* - this is the Dutch (NL) language file

**/


define('DFCONTACT', 'DFContact');

define('DFCONTACT_YES', 'Ja');

define('DFCONTACT_NO', 'Nee');



// Saving

define('DFCONTACT_ERROR', 'Error');

define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Opslaan mislukt (configuratiebestand niet schrijfbaar)!');

define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Opslaan mislukt (kon configuratiebestand niet openen)!');

define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Opslaan mislukt (configuratiebestand niet schrijfbaar)!');

define('DFCONTACT_CONFIG_SUCCESS', 'Instellingen met succes opgeslagen!');



// Tab: General

define('DFCONTACT_TAB_GENERAL', 'General');

define('DFCONTACT_DESTINATIONMAIL', 'E-mail adres geadresseerde');

define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email to send form data to.');

define('DFCONTACT_PAGETITLE', 'Paginatitel');

define('DFCONTACT_PAGETITLE_INFO', 'Wordt weergegeven boven andere inhoud.');

define('DFCONTACT_INFOTEXT', 'Info text');

define('DFCONTACT_INFOTEXT_INFO', 'Wordt weergegeven boven contactgegevens.');

define('DFCONTACT_FORMTEXT', 'Form text');

define('DFCONTACT_FORMTEXT_INFO', 'Wordt weergegeven boven contactformulier.');

define('DFCONTACT_BUTTONTEXT', 'Button Text');

define('DFCONTACT_BUTTONTEXT_INFO', 'Alternatieve tekst op verzendknop.');

define('DFCONTACT_LANGUAGE', 'Taal');

define('DFCONTACT_ADDRESSSTYLE', 'Adres stijl');

define('DFCONTACT_ADDRESSSTYLE_INFO', 'Lokale instellingen voor weergave adresgegevens.');

define('DFCONTACT_CLICKABLELINKS', 'Klikbare links');

define('DFCONTACT_CLICKABLELINKS_INFO', 'Klikbare links zijn makkelijk, maar ook onveilig voor spammers die zgn. \'mail address harvester\'s gebruiken.');

define('DFCONTACT_HTMLMAILS', 'HTML E-mail');

define('DFCONTACT_HTMLMAILS_INFO', 'Verstuur E-mail in HTML formaat.');

define('DFCONTACT_ADDSERVERDATA', 'Voeg servergegevens toe.');

define('DFCONTACT_ADDSERVERDATA_INFO', 'Voegt gegevens toe van de gebruiker\'s browser, besturingssysteem en IP adres aan je E-mail (Gebruiker merkt hier niets van).');

define('DFCONTACT_DISPLAYUSERINPUT', 'Toon gebruikersinvoer:');

define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Nadat E-mail verzonden is, toon verzonden informatie aan gebruiker.');



// Tab: Your data

define('DFCONTACT_TAB_YOUR_DATA', 'Je gegevens');

define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Voeg de data in die op de Contact pagina weergegeven moet worden.');

define('DFCONTACT_COMPANY', 'Bedrijf');

define('DFCONTACT_TITLE', 'Titel');

define('DFCONTACT_NAME', 'Naam');

define('DFCONTACT_POSITION', 'Positie');

define('DFCONTACT_STREET', 'Straat');

define('DFCONTACT_POSTBOX', 'Postbus');

define('DFCONTACT_ZIP', 'Postcode');

define('DFCONTACT_CITY', 'Woonplaats');

define('DFCONTACT_STATE', 'Provincie');

define('DFCONTACT_COUNTRY', 'Land');

define('DFCONTACT_PHONE', 'Telefoon');

define('DFCONTACT_MOBILE', 'Mobiel');

define('DFCONTACT_FAX', 'Fax');

define('DFCONTACT_EMAIL', 'E-mail adres');

define('DFCONTACT_AIM', 'AIM');

define('DFCONTACT_ICQ', 'ICQ');

define('DFCONTACT_YAHOO', 'Yahoo');

define('DFCONTACT_MSN', 'MSN');

define('DFCONTACT_MESSAGE', 'Bericht');

define('DFCONTACT_CHECKBOX', 'Keuze optie');

define('DFCONTACT_CHECKBOX_INFO', 'Laat een keuze optie zien onder het bericht veld. Door dit als verplicht in te stellen wordt de gebruiker gedwongen om dit aan te vinken.');

define('DFCONTACT_CHECKBOX_TEXT', 'Tekst bij keuze optie.');

define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Wordt weergegeven naast de keuze optie.');



// Tab: Form data

define('DFCONTACT_TAB_FORM_FIELDS', 'Invulvelden');

define('DFCONTACT_HIDE', 'Verbergen');

define('DFCONTACT_SHOW', 'Tonen');

define('DFCONTACT_OPTIONAL', 'Optioneel');

define('DFCONTACT_DUTY', 'Verplicht');

define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Kies de velden die getoond moeten worden in het contactformulier en geef aan welke velden verplicht ingevuld moetne worden om het formulier te versturen.');



// Tab: About

define('DFCONTACT_TAB_ABOUT', 'Over');

define('DFCONTACT_ABOUT_VERSION', 'Versie');

define('DFCONTACT_ABOUT_PROGRAM', 'Programma');

define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact is een contactfomulier dat erg makkelijk te configureren is. Het laat contactgegevens zien en adresgegevens op &eacute;&eacute;n pagina. De beschikbare velden kunnen worden gekozen als verplichte velden. Als iemand een idee heeft om dit component uit te breiden of een bug heeft gevonden, neem contact op met de maker.');

define('DFCONTACT_ABOUT_AUTHOR', 'Maker');

define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');

define('DFCONTACT_ABOUT_WARRANTY', 'Garantie');

define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Dit programma is vrijgegeven onder de GNU General Public License (GPL) en wordt verspreid in de verwachting dat het behulpzaam is, maar ZONDER ENIGE GARANTIE, zonder zelfs maar de suggestie te wekken dat er garantie, rechten of waarde ontleend kunnen worden voor geschiktheid voor een bepaald doel.');

define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');

define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');

define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');

define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');



// Frontend

define('DFCONTACT_FORM_MISSING_FIELDS', 'Vul de volgende gegevens in alstublieft:');

define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Vul een geldig E-mail adres in!');

define('DFCONTACT_FORM_TITLE_MR', 'de heer');

define('DFCONTACT_FORM_TITLE_MRS', 'mevrouw');

define('DFCONTACT_FORM_SUBMIT', 'Verzenden');

define('DFCONTACT_FORM_BACK', 'terug');

define('DFCONTACT_FORM_DATE_FORMAT', 'H:i:s - m-d-Y');

define('DFCONTACT_FORM_DATE', 'Datum');

define('DFCONTACT_FORM_SENT_URL', 'Pagina na verzending');

define('DFCONTACT_FORM_USERAGENT', 'User agent');

define('DFCONTACT_FORM_HOST', 'Host');

define('DFCONTACT_FORM_IP', 'IP adres');

define('DFCONTACT_FORM_PORT', 'Port');

define('DFCONTACT_FORM_MAIL_TEXT', 'Iemand verzond een E-mail aan jou via het formulier op je website. De inhoud is als volgt:');

define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'De volgende regels bevatten informatie die niet door de gebruiker is ingevoerd maar is opgevraagd via de server.');

define('DFCONTACT_FORM_MAIL_SUBJECT', 'Contact E-mail adres');

define('DFCONTACT_FORM_MAIL_ERROR', 'Error: Gegevens werden niet verzonden. Probeer het later nog eens.');

define('DFCONTACT_FORM_MAIL_SUCCESS', 'Gegevens met succes verzonden.');

define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'De volgende gegevens werden verzonden:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Voer de tekens die je in het plaatje ziet in het volgende invulveld. Als je de tekens moeilijk kan lezen Klik dan op "Volgende" om een nieuw plaatje te zien.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha met correcte tekens invullen!');
define('DFCONTACT_CAPTCHA_INFO', 'Toon een plaatje met tekens als onderdeel van het formulier. De gebruiker kan de tekens in een invulveld typen om aan te tonen dat hij een persoon is. Dit is om te voorkomen dat een spambot gebruik maakt van het formulier.<br /><b>Dit zal alleen werken als component <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is geïnstalleerd (Versie >= 4.0).</b>');
 
// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: Er is geen E-mail adres voor ontvanger ingesteld. Log alsjeblieft in op Beheer om dit in te stellen.');

?>
