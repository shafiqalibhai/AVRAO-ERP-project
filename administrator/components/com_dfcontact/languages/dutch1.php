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
define('DFCONTACT_NO', 'Neen');

// Opslaan
define('DFCONTACT_ERROR', 'Fout');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Niet beveiligd (De config file was niet programmeerbaar)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Niet beveiligd (De config file kon niet geopend worden)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Niet beveiligd (In de config file kon niet geschreven worden)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Gegevens met succes opgeslagen!');

// Tab: Algemeen
define('DFCONTACT_TAB_GENERAL', 'Algemeen');
define('DFCONTACT_DESTINATIONMAIL', 'Bestemming email');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email adres, aan die de formulier gegevens gezonden worden.');
define('DFCONTACT_PAGETITLE', 'Pagina titel');
define('DFCONTACT_PAGETITLE_INFO', 'Pagina titel, die zal getoond worden boven de pagina.');
define('DFCONTACT_INFOTEXT', 'Info tekst');
define('DFCONTACT_INFOTEXT_INFO', 'Info tekst, die zal net boven de contact gegevens worden getoond.');
define('DFCONTACT_FORMTEXT', 'Formulier tekst');
define('DFCONTACT_FORMTEXT_INFO', 'Formulier tekst, die zal net boven het contact formulier worden getoond.');
define('DFCONTACT_BUTTONTEXT', 'Button Tekst');
define('DFCONTACT_BUTTONTEXT_INFO', 'Alternatieve tekst voor de verzend button.');
define('DFCONTACT_LANGUAGE', 'Taal');
define('DFCONTACT_ADDRESSSTYLE', 'Adres stijl');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Lokaal output formaat voor adressen.');
define('DFCONTACT_CLICKABLELINKS', 'Klikbare Links');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Klikbare Links zijn comfortabel, maar vergemakkelijken ook de selectie van het email adres door spammer.');
define('DFCONTACT_HTMLMAILS', 'HTML emails');
define('DFCONTACT_HTMLMAILS_INFO', 'Verzend emails in het HTML formaat.');
define('DFCONTACT_ADDSERVERDATA', 'Voegt server gegevens toe');
define('DFCONTACT_ADDSERVERDATA_INFO', 'De server verzamelt gebruiker gegevens zoals Browser, Operating System en IP en hangt deze aan de email aan (De gebruiker zal dit niet merken).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Vertoon van de gebruikers invoer:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Nadat de e-mail is verzonden, nogmaals vertoning van de ingaven van de gebruiker.');

// Tab: Uw gegevens
define('DFCONTACT_TAB_YOUR_DATA', 'Uw gegevens');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Kies de gegevens die op de contactpagina getoond moeten worden.');
define('DFCONTACT_COMPANY', 'Bedrijf');
define('DFCONTACT_TITLE', 'Titel');
define('DFCONTACT_NAME', 'Naam');
define('DFCONTACT_POSITION', 'Positie');
define('DFCONTACT_STREET', 'Straat');
define('DFCONTACT_POSTBOX', 'Huisnr.');
define('DFCONTACT_ZIP', 'Postcode');
define('DFCONTACT_CITY', 'Gemeente');
define('DFCONTACT_STATE', 'Staat');
define('DFCONTACT_COUNTRY', 'Provincie');
define('DFCONTACT_PHONE', 'Telefoon');
define('DFCONTACT_MOBILE', 'GSM');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Bericht');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Toont de checkbox onderaan het berichten tekstveld. Het plaatsen van dit als verplicht veld zal de gebruiker dwingen om het te controleren.');
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox Tekst');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Tekst zal naast de checkbox worden getoond.');

// Tab: Formulier velden
define('DFCONTACT_TAB_FORM_FIELDS', 'Formulier velden');
define('DFCONTACT_HIDE', 'Verbergen');
define('DFCONTACT_SHOW', 'Tonen');
define('DFCONTACT_OPTIONAL', 'Facultatief');
define('DFCONTACT_DUTY', 'Verplicht');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Kies de velden die in het formulier zullen getoond worden en bepaal welke velden ingevuld moeten worden alvorens te verzenden.');

// Tab: Info
define('DFCONTACT_TAB_ABOUT', 'Info');
define('DFCONTACT_ABOUT_VERSION', 'Versie');
define('DFCONTACT_ABOUT_PROGRAM', 'Program');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact is een zeer gemakkelijk te bewerken formulier component voor Joomla!. Het toont contactgegevens en een contactformulier op dezelfde pagina. De beschikbare velden in het formulier kunnen gekozen worden en ook als verplichte velden gezet worden. Als u sommige inspiraties hebt om deze component uit te breiden of u vond sommige fouten, gelieve de auteur te contacteren.');
define('DFCONTACT_ABOUT_AUTHOR', 'Auteur');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Duitsland<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantie');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Dit programma wordt vrijgegeven onder GNU General Public License (GPL) en wordt verdeeld in de hoop dat het nuttig zal zijn, maar ZONDER ENIGE GARANTIE; mogelijke verliezen of ontgaande winsten door foute functies kunnen bij de auteur NIET geldig worden gemaakt.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Gelieve nog de volgende velden in te vullen:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Gelieve een geldige e-mail adres in te geven!');
define('DFCONTACT_FORM_TITLE_MR', 'M.');
define('DFCONTACT_FORM_TITLE_MRS', 'Mevr.');
define('DFCONTACT_FORM_SUBMIT', 'Versturen');
define('DFCONTACT_FORM_BACK', 'terug');
define('DFCONTACT_FORM_DATE_FORMAT', 'd/m/Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Datum');
define('DFCONTACT_FORM_SENT_URL', 'Formulier URL');
define('DFCONTACT_FORM_USERAGENT', 'Gebruiker agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Iemand heeft u een email over het RAF-formulier op uw website gezonden. Dit is wat hij binnen typte:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'De volgende lijnen bevatten informatie die niet binnen getypt is, maar door de server verzameld is.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Contact email');
define('DFCONTACT_FORM_MAIL_ERROR', 'Fout: De email is niet verzonden. Gelieve het later opnieuw te proberen.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'De email is met succes verzonden.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'De volgende gegevens zijn verstuurd:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Voer de tekens die je in het plaatje ziet in het volgende invulveld. Als je de tekens moeilijk kan lezen Klik dan op "Volgende" om een nieuw plaatje te zien.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha met correcte tekens invullen!');
define('DFCONTACT_CAPTCHA_INFO', 'Toon een plaatje met tekens als onderdeel van het formulier. De gebruiker kan de tekens in een invulveld typen om aan te tonen dat hij een persoon is. Dit is om te voorkomen dat een spambot gebruik maakt van het formulier.<br /><b>Dit zal alleen werken als component <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is geïnstalleerd (Versie >= 4.0).</b>');
 
// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: Er is geen E-mail adres voor ontvanger ingesteld. Log alsjeblieft in op Beheer om dit in te stellen.');

?>
