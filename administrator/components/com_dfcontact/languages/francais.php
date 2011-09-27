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
define('DFCONTACT_YES', 'oui');
define('DFCONTACT_NO', 'non');

// Saving
define('DFCONTACT_ERROR', 'D&eacute;faut');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Non affirm&eacute; (pas possible d&rsquo;utiliser le fichier de configuration)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Non affirm&eacute; (pas possible d&rsquo;ouvrir le fichier de configuration)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Non affirm&eacute; (pas possible d&rsquo;&eacute;crire dans le fichier de configuration)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Configurations affirm&eacute;es avec succ&egrave;s!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'G&eacute;n&eacute;ral');
define('DFCONTACT_DESTINATIONMAIL', 'But &eacute;mail');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Adresse d&rsquo;&eacute;mail &agrave; laquelle les donn&eacute;es du formulaire sont envoy&eacute;es.');
define('DFCONTACT_PAGETITLE', 'Titre de la page');
define('DFCONTACT_PAGETITLE_INFO', 'Titre indiqu&eacute; en haut de la page.');
define('DFCONTACT_INFOTEXT', 'Info texte');
define('DFCONTACT_INFOTEXT_INFO', 'Texte de salutation qui est affich&eacute; devant les donn&eacute;es de contact.');
define('DFCONTACT_FORMTEXT', 'Formulaire de texte');
define('DFCONTACT_FORMTEXT_INFO', 'Texte qui est affich&eacute; devant le formulaire.');
define('DFCONTACT_BUTTONTEXT', 'Bouton de commande de texte');
define('DFCONTACT_BUTTONTEXT_INFO', 'Texte alternatif sur le bouton de commande.');
define('DFCONTACT_LANGUAGE', 'Langue');
define('DFCONTACT_ADDRESSSTYLE', 'Style d&rsquo;adresse');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Format d&rsquo;adresse culturellement adapt&eacute;');
define('DFCONTACT_CLICKABLELINKS', 'Liens cliquables');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Des liens cliquables sont confortables, mais ils favorisent aussi la lecture des &eacute;mails par des pourriels.');
define('DFCONTACT_HTMLMAILS', '&Eacute;mail HTML');
define('DFCONTACT_HTMLMAILS_INFO', 'Envoyez des &eacute;mails dans le format HTML.');
define('DFCONTACT_ADDSERVERDATA', 'Donn&eacute;es du serveur');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Le serveur collectionne des donn&eacute;es de l&rsquo;utilisateurs comme les donn&eacute;es suivantes: browser/navigateur, system d&rsquo;exploitation et IP et il les attache &agrave; l&rsquo;&eacute;mail (sans que l&rsquo;utilisateur s&rsquo;en aper&ccedil;oive).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Sommaire');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Apr&egrave;s que l&rsquo;utilisateur a envoy&eacute; l&rsquo;&eacute;mail avec succ&egrave;s, on lui montre ses entr&eacute;es encore une fois.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Vos donn&eacute;es');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Entrez ici vos donn&eacute;es de contact qui sont cens&eacute;es d&rsquo;&ecirc;tre montr&eacute;es.');
define('DFCONTACT_COMPANY', 'Entreprise');
define('DFCONTACT_TITLE', 'Titre');
define('DFCONTACT_NAME', 'Nome');
define('DFCONTACT_POSITION', 'Position');
define('DFCONTACT_STREET', 'Rue');
define('DFCONTACT_POSTBOX', 'Bo&icirc;te postale');
define('DFCONTACT_ZIP', 'Code postal');
define('DFCONTACT_CITY', 'Ville');
define('DFCONTACT_STATE', 'D&eacute;partement');
define('DFCONTACT_COUNTRY', 'Pays');
define('DFCONTACT_PHONE', 'T&eacute;l&eacute;phone');
define('DFCONTACT_MOBILE', 'T&eacute;l&eacute;phone portable');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', '&Eacute;mail');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Message');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Montre une checkbox dir&egrave;ctement en dessous du champ de massage. Quand les champs obligatoires sont activ&eacute;s, l&rsquo;utilisateur doit activier la checkbox.');
define('DFCONTACT_CHECKBOX_TEXT', 'Texte de la checkbox');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Le texte qui est indiqu&eacute; &agrave; c&ocirc;t&eacute; de la checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Formulaire');
define('DFCONTACT_HIDE', 'Cacher');
define('DFCONTACT_SHOW', 'Montrer');
define('DFCONTACT_OPTIONAL', 'Optionel');
define('DFCONTACT_DUTY', 'Obligatoire');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Choississez quels champs doivent &ecirc;tre montr&eacute;s dans le formulaire de contact et indiquez quels champs doivent &ecirc;tres obligatoires. Des champs obligatoires doivent n&eacute;cessairement &ecirc;tres remplis par l&rsquo;utilisateur.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Information');
define('DFCONTACT_ABOUT_VERSION', 'Version');
define('DFCONTACT_ABOUT_PROGRAM', 'Programme');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact est un composant de formulaire qui peu &ecirc;tre facilement administr&eacute; pour Joomla!. Les donn&eacute;es et le formulaire de contact sont montr&eacute;s sur une seule page. Les champs de formulaire indiqu&eacute;s peuvent &ecirc;tre choisis. En outre, il est possible de d&eacute;finir n&rsquo;importe quel champ comme champ obligatoire. Ces champs doivent absolument &ecirc;tre remplis par l&rsquo;utilisateur. Si vous avez des suggestions concernant ce programme ou si vous avez trouvez une erreur, veuillez vous adresser &agrave; l&rsquo;auteur.');
define('DFCONTACT_ABOUT_AUTHOR', 'Auteur');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Allemagne<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantie');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Ce programme est distribu&eacute; sous GNU General Public License et n&rsquo;offre aucune garantie. Des pertes ou des profits &eacute;chapp&eacute;s &eacute;voqu&eacute;s par des functions d&eacute;f&eacute;ctueuses ne peuvent PAS invoqu&eacute;s contre l&rsquo;auteur.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'S.v.p., remplissez encore les champs suivants:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Indiquez une adresse d&rsquo;&eacute;mail valable!');
define('DFCONTACT_FORM_TITLE_MR', 'Monsieur');
define('DFCONTACT_FORM_TITLE_MRS', 'Madame');
define('DFCONTACT_FORM_SUBMIT', 'Envoyer');
define('DFCONTACT_FORM_BACK', 'Retour');
define('DFCONTACT_FORM_DATE_FORMAT', 'd.m.Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Date');
define('DFCONTACT_FORM_SENT_URL', 'Formulaire URL');
define('DFCONTACT_FORM_USERAGENT', 'User Agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Quelqu&rsquo;un vous a envoy&eacute; un &eacute;mail par le formulaire de contact de votre site web. Les donn&eacute;es suivantes ont &eacute;t&eacute; indiqu&eacute;es.');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'Les donn&eacute;es suivantes sur l&rsquo;utilisateur ont &eacute;t&eacute;s collectionn&eacute;es par le serveur et n&rsquo;ont pas &eacute;t&eacute; personnellement indiqu&eacute;es par l&rsquo;utilisateur.');
define('DFCONTACT_FORM_MAIL_SUBJECT', '&Eacute;mails par formulaire de contact');
define('DFCONTACT_FORM_MAIL_ERROR', 'D&eacute;faut: L&rsquo;&eacute;mail n&rsquo;a pas &eacute;t&eacute; envoy&eacute;. R&eacute;essayez plus tard, s.v.p..');
define('DFCONTACT_FORM_MAIL_SUCCESS', '&Eacute;mail envoy&eacute;.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Les donn&eacute;es suivantes ont &eacute;t&eacute;s indiqu&eacute;es:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Voulez, s.v.p., inscrire les signes que vous voyez dans l\'image en-dessous dans le champ suivant. Si vous ne pouvez pas lire les signes, appuyer sur le bouton &agrave; c&ocirc;t&eacute; pour charger un autre image.');
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha avec code valable!');
define('DFCONTACT_CAPTCHA_INFO', 'Montre l\'image avec signes en-dessous du formulaire. L\'utilisateur doit taper les signes dans un champ pour s\'identifier comme &ecirc;tre humain. Ceci a pour but d\'&eacute;viter les envoies des emails "spam" par les webbots automatiques.<br /><b>Requires <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a>(Version >= 4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERREUR: Dans la section d\'administration, il n\'y a pas d\'adresse &eacute;mail du destinateur!');

?>

