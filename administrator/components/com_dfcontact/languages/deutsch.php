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
define('DFCONTACT_NO', 'Nein');

// Saving
define('DFCONTACT_ERROR', 'Error');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Nicht gesichert (Auf die Config-Datei konnte nicht zugegriffen werden)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Nicht gesichert (Die Config-Datei konnte nicht ge&ouml;ffnet werden)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Nicht gesichert (In die Config-Datei konnte nicht geschrieben werden)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Einstellungen erfolgreich gesichert!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Allgemein');
define('DFCONTACT_DESTINATIONMAIL', 'Ziel Email');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email-Adresse, an welche die Formular-Eingaben gesendet werden.');
define('DFCONTACT_PAGETITLE', 'Seitentitel');
define('DFCONTACT_PAGETITLE_INFO', 'Titel, der &uuml;ber der Seite angezeigt wird.');
define('DFCONTACT_INFOTEXT', 'Info Text');
define('DFCONTACT_INFOTEXT_INFO', 'Begr&uuml;&szlig;ungstext, der vor den Kontaktdaten angezeigt wird.');
define('DFCONTACT_FORMTEXT', 'Formular Text');
define('DFCONTACT_FORMTEXT_INFO', 'Text, der vor dem Formular angezeigt wird.');
define('DFCONTACT_BUTTONTEXT', 'Button Text');
define('DFCONTACT_BUTTONTEXT_INFO', 'Alternativer text auf dem Absende-Button.');
define('DFCONTACT_LANGUAGE', 'Sprache');
define('DFCONTACT_ADDRESSSTYLE', 'Adress-Stil');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Kulturell angepa&szlig;tes Ausgabeformat f&uuml;r Adressen.');
define('DFCONTACT_CLICKABLELINKS', 'Klickbare Links');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Klickbare Links sind bequem, erleichtern aber auch das Auslesen der Email-Adresse durch Spammer.');
define('DFCONTACT_HTMLMAILS', 'HTML Emails');
define('DFCONTACT_HTMLMAILS_INFO', 'Sendet Emails im HTML-Format.');
define('DFCONTACT_ADDSERVERDATA', 'Server-Daten');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Der Server sammelt Benutzer-Daten wie Browser, Betriebssystem und IP und h&auml;ngt diese an die Email an (der Benutzer erf&auml;hrt davon nichts).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Zusammenfassung');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Nach erfolgreichem Versand der Email bekommt der Nutzer seine Eingaben noch einmal angezeigt.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Ihre Daten');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Geben Sie hier die Kontaktdaten an, die angezeigt werden sollen.');
define('DFCONTACT_COMPANY', 'Firma');
define('DFCONTACT_TITLE', 'Anrede');
define('DFCONTACT_NAME', 'Name');
define('DFCONTACT_POSITION', 'Position');
define('DFCONTACT_STREET', 'Stra&szlig;e');
define('DFCONTACT_POSTBOX', 'Postfach');
define('DFCONTACT_ZIP', 'PLZ');
define('DFCONTACT_CITY', 'Stadt');
define('DFCONTACT_STATE', 'Bundesland');
define('DFCONTACT_COUNTRY', 'Land');
define('DFCONTACT_PHONE', 'Telefon');
define('DFCONTACT_MOBILE', 'Handy');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Nachricht');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Zeigt eine Checkbox direkt unter dem Nachrichtenfeld an. Wenn &quot;Pflichtfeld&quot; aktiviert ist, muss der Benutzer die Checkbox aktivieren.');
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox-Text');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Der neben der Checkbox anzuzeigende Text.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Formular');
define('DFCONTACT_HIDE', 'Verbergen');
define('DFCONTACT_SHOW', 'Anzeigen');
define('DFCONTACT_OPTIONAL', 'Optional');
define('DFCONTACT_DUTY', 'Pflichtfeld');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'W&auml;hlen Sie, welche Felder im Kontaktformular angezeigt werden sollen und bestimmen Sie, welche davon Pflichtfelder sind. Pflichtfelder m&uuml;ssen vom Benutzer auf jeden Fall ausgef&uuml;llt werden.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Info');
define('DFCONTACT_ABOUT_VERSION', 'Version');
define('DFCONTACT_ABOUT_PROGRAM', 'Programm');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact ist eine sehr leicht administrierbare Formular-Komponente f&uuml;r Joomla!. Kontaktdaten und ein Kontaktformular werden dabei auf einer Seite angezeigt. Die angezeigten Formularfelder k&ouml;nnen ausgew&auml;hlt werden, es ist zudem m&ouml;glich beliebige Felder als Pflichtfelder zu definieren. Diese Felder m&uuml;ssen dann vom Benutzer auf jeden Fall ausgef&uuml;llt werden. Falls Sie Anregungen zu diesem Programm haben oder einen Fehler finden konnten, wenden Sie sich Bitte an den Autor.');
define('DFCONTACT_ABOUT_AUTHOR', 'Autor');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Deutschand<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantie');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Dieses Programm wird unter GNU General Public License vertrieben und bietet keine Garantie irgendeiner Art. Eventuelle Verluste oder entgangene Gewinne durch Fehlfunktionen k&ouml;nnen beim Autor NICHT geltend gemacht werden.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', '&Auml;nderungs-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Ben&ouml;tigen Sie &Auml;nderungen an dieser Komponente und wollen diese nicht selbst durchf&uuml;hren? Wir machen Ihnen ein g&uuml;nstiges Angebot, schreiben Sie bitte an <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a>.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Unterst&uuml;tzung');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'Falls Sie die Arbeit an DFContact mit einer Spende unterst&uuml;tzen wollen, k&ouml;nnen Sie dies gerne tun. Klicken Sie dazu auf den nebenstehenden Button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Bitte noch die folgenden Felder ausf&uuml;llen:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Bitte eine g&uuml;ltige Email-Adresse eingeben!');
define('DFCONTACT_FORM_TITLE_MR', 'Herr');
define('DFCONTACT_FORM_TITLE_MRS', 'Frau');
define('DFCONTACT_FORM_SUBMIT', 'Absenden');
define('DFCONTACT_FORM_BACK', 'zur&uuml;ck');
define('DFCONTACT_FORM_DATE_FORMAT', 'd.m.Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Datum');
define('DFCONTACT_FORM_SENT_URL', 'Formular URL');
define('DFCONTACT_FORM_USERAGENT', 'User Agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Jemand hat Ihnen &uuml;ber das Kontaktformular Ihrer Website eine Email gesendet. Die folgenden Daten wurden von ihm eingegeben.');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'Die folgenden Daten wurden vom Server &uuml;ber den Benutzer gesammelt und nicht von ihm pers&ouml;nlich eingegeben.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Email &uuml;ber Kontaktformular');
define('DFCONTACT_FORM_MAIL_ERROR', 'Fehler: Die Email wurde nicht gesendet, bitte versuchen Sie es sp&auml;ter noch einmal.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Email wurde erfolgreich gesendet.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Die folgenden Daten wurden eingegeben:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Bitte geben Sie die Zeichen des untenstehenden Bildes in das darauf folgende Feld ein. Falls Sie die Zeichen schlecht lesen k&ouml;nnen, klicken Sie bitte auf den nebenstehenden Button um ein neues Bild zu laden.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha mit g&uuml;ltigem Code!');
define('DFCONTACT_CAPTCHA_INFO', 'Zeigt ein Bild mit Zeichen unter dem Formular an. Der Benutzer mu&szlig; die Zeichen in ein Feld tippen, um sich als Mensch zu identifizieren. Dies soll den Spamversand durch automatisierte Webbots verhindern.<br /><b>Funktioniert nur, wenn die Komponente <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> vorhanden ist (Version >= 4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'FEHLER: Im Administrationsbereich wurde keine Ziel-Email gesetzt!');

?>