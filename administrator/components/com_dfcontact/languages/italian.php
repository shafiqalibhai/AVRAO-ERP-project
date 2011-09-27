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
define('DFCONTACT_YES', 'Si');
define('DFCONTACT_NO', 'No');

// Saving
define('DFCONTACT_ERROR', 'Errore');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Salvataggio fallito (file config non scrivibile)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Salvataggio fallito (non si pu&ograve; aprire il file config)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Salvataggio fallito (non si pu&ograve; scrivere il file config)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Settaggi salvati correttamente!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Generale');
define('DFCONTACT_DESTINATIONMAIL', 'Email destinatario');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email al quale inviare il form.');
define('DFCONTACT_PAGETITLE', 'Titolo della pagina');
define('DFCONTACT_PAGETITLE_INFO', 'Sar&agrave; mostrato sopra il contenuto.');
define('DFCONTACT_INFOTEXT', 'Info text');
define('DFCONTACT_INFOTEXT_INFO', 'Sar&agrave; mostrato sopra i dati del contatto.');
define('DFCONTACT_FORMTEXT', 'Form text');
define('DFCONTACT_FORMTEXT_INFO', 'Sar&agrave; mostrato sotto i dati del contatto.');
define('DFCONTACT_BUTTONTEXT', 'Button Text');
define('DFCONTACT_BUTTONTEXT_INFO', 'Testo alternativo per il bottone Invia.');
define('DFCONTACT_LANGUAGE', 'Lingua');
define('DFCONTACT_ADDRESSSTYLE', 'Forma indirizzo');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Output locale per indirizzi.');
define('DFCONTACT_CLICKABLELINKS', 'Link cliccabili');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Link cliccabili sono pi&ugrave; confortabili, ma supportano anche la raccolta di email.');
define('DFCONTACT_HTMLMAILS', 'HTML mails');
define('DFCONTACT_HTMLMAILS_INFO', 'Invia le email nel formato HTML.');
define('DFCONTACT_ADDSERVERDATA', 'Aggiungi dati del server');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Aggiungi dati sul browser dell\'utente, sul sistema operativo e indirizzo IP per email (l\'utente non vedr&agrave; niente).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Mostra quello che ha inserito l\'utente:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Dopo l\'invio della email, mostra il riassunto all\'utente.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'I tuoi dati');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Inserisci i dati che devono essere mostrati sulla tua pagina contatti.');
define('DFCONTACT_COMPANY', 'Societ&agrave;');
define('DFCONTACT_TITLE', 'Titolo');
define('DFCONTACT_NAME', 'Nome');
define('DFCONTACT_POSITION', 'Posizione');
define('DFCONTACT_STREET', 'Via');
define('DFCONTACT_POSTBOX', 'Casella postale');
define('DFCONTACT_ZIP', 'CAP');
define('DFCONTACT_CITY', 'Citt&agrave;');
define('DFCONTACT_STATE', 'Regione');
define('DFCONTACT_COUNTRY', 'Nazione');
define('DFCONTACT_PHONE', 'Telefono');
define('DFCONTACT_MOBILE', 'Mobile');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Message');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Mostra una checkbox sotto alla textarea. Scegliendo questa come campo obbligatorio forzer&agrave; l\'utente a sceglierla.');
define('DFCONTACT_CHECKBOX_TEXT', 'Testo Checkbox');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Verr&agrave; mostrato a lato della checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Campi del form');
define('DFCONTACT_HIDE', 'Nascondi');
define('DFCONTACT_SHOW', 'Mostra');
define('DFCONTACT_OPTIONAL', 'Opzionale');
define('DFCONTACT_DUTY', 'Obbligatorio');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Scegli i campi da  mostrare nel form di contatto e definisci quale campo deve essere riempito prima dell\'invio.');

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
define('DFCONTACT_FORM_MISSING_FIELDS', 'Riempi i campi seguenti:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Inserisci una email valida!');
define('DFCONTACT_FORM_TITLE_MR', 'Sig.');
define('DFCONTACT_FORM_TITLE_MRS', 'Sig.ra.');
define('DFCONTACT_FORM_SUBMIT', 'Invia');
define('DFCONTACT_FORM_BACK', 'Indietro');
define('DFCONTACT_FORM_DATE_FORMAT', 'd/m/Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Data');
define('DFCONTACT_FORM_SENT_URL', 'Form URL');
define('DFCONTACT_FORM_USERAGENT', 'User agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Porta');
define('DFCONTACT_FORM_MAIL_TEXT', 'Qualcuno ti ha inviato una email riempiendo il form sul tuo sito. Hanno scritto:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'Le informazioni seguenti non sono state scritte, ma raccolte dal server.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Email di contatto');
define('DFCONTACT_FORM_MAIL_ERROR', 'Errore: La email non &eacute; stata inviata. Riprova pi&ugrave; tardi.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Email inviata correttamente.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'I seguenti dati sono stati inviati:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Per favore inserisci i caratteri dell\'immagine nel campo. Se hai difficilt&agrave; a leggerli, clicca il bottone vicino all\'immagine per caricarne un altro.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha con codice valido!');
define('DFCONTACT_CAPTCHA_INFO', 'Mostra un\'immagine con caratteri come parte del formulario. L\'utente deve inserire i caratteri in un campo separato per provare che &eacute; una persona. Questo dovrebbe prevenire che il formulario sia compilato da spambots.<br /><b>Funziona solo se la componente <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> &eacute; installata (Versione >=4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERRORE. Non &eacute; stato inserito nessun destinatario, perfavore effettua il login nella sezione amministrativa e inseriscine uno.');

?>