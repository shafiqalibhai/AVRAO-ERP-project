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
define('DFCONTACT_YES', 'Evet');
define('DFCONTACT_NO', 'Hay�r');

// Saving
define('DFCONTACT_ERROR', 'Hata');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Kay�t hatas� (config dosyas� yaz�lamaz durumda)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Kay�t hatas� (Config dosyas� a��lam�yor)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Kay�t hatas� (Yaz�labilecek bir config dosyas� yok)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Ayarlar�n�z ba�ar�l� bir �ekilde kaydedildi!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Genel');
define('DFCONTACT_DESTINATIONMAIL', 'E-mail');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Mesaj�n gidece�i mail.');
define('DFCONTACT_PAGETITLE', 'Sayfa Ba�l���');
define('DFCONTACT_PAGETITLE_INFO', '�leti�ime t�kland���nda g�renecek isim.');
define('DFCONTACT_INFOTEXT', 'Info yaz�s�');
define('DFCONTACT_INFOTEXT_INFO', 'mail at�lmadan �nceki g�r�necek yaz�.');
define('DFCONTACT_FORMTEXT', 'Form Yaz�s�');
define('DFCONTACT_FORMTEXT_INFO', 'Will be displayed right above the contact form.');
define('DFCONTACT_BUTTONTEXT', 'Buton yaz�s�');
define('DFCONTACT_BUTTONTEXT_INFO', 'G�nderme butonuna de�i�ik bi�ey yazmak istiyorsan�z buraya yaz�n.');
define('DFCONTACT_LANGUAGE', 'lisan');
define('DFCONTACT_ADDRESSSTYLE', 'Adres stili');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Local output format for addresses.');
define('DFCONTACT_CLICKABLELINKS', 'T�klanabilir linkler');
define('DFCONTACT_CLICKABLELINKS_INFO', 'mesaj�n�za yaz�lan linklerin t�klanabilir olmas�n� sa�lar.');
define('DFCONTACT_HTMLMAILS', 'HTML mail');
define('DFCONTACT_HTMLMAILS_INFO', 'Mailin html format�nda olmas�n� sa�lar bu se�enek evet se�ilirse mesaj k�sm�nda html kodlar�n�da kabul edecektir..');
define('DFCONTACT_ADDSERVERDATA', 'Server bilgilerini g�nder');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Adds data about the user\'s browser, operating system and IP to your email (User will not recognize this).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Display user input:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'After email has been sent, display resumed input to user.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Senin Bilgilerin');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Burdaki alanlara gerekli bilgileri girerseniz kontak sayfas�nda g�r�necektir..');
define('DFCONTACT_COMPANY', '�irket ad�');
define('DFCONTACT_TITLE', 'Ba�l�k');
define('DFCONTACT_NAME', 'isim');
define('DFCONTACT_POSITION', 'Pozisyon');
define('DFCONTACT_STREET', 'Sokak');
define('DFCONTACT_POSTBOX', 'No:');
define('DFCONTACT_ZIP', 'PostaKodu');
define('DFCONTACT_CITY', '�ehir');
define('DFCONTACT_STATE', 'State');
define('DFCONTACT_COUNTRY', 'Country');
define('DFCONTACT_PHONE', 'Telefon');
define('DFCONTACT_MOBILE', 'GSM');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Mesaj');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Displays a checkbox underneath the message textarea. Setting this as duty-field will force the user to check it.');
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox-Yaz�s�');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Will be displayed next to the checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Form alanlar�');
define('DFCONTACT_HIDE', 'Gizle');
define('DFCONTACT_SHOW', 'G�ster');
define('DFCONTACT_OPTIONAL', 'Opsiyonel');
define('DFCONTACT_DUTY', '�art');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Choose the fields that are displayed in the contact form and define which fields have to be filled out before sending.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Hakk�nda');
define('DFCONTACT_ABOUT_VERSION', 'Versiyon');
define('DFCONTACT_ABOUT_PROGRAM', 'Program');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact is a contact form component which is extremly easy to configure. It displays contact data and a contact form on the same page. The availible fields in the form can be choosen and set as duty fields. If you have some ideas to extend this component or found some bugs, please contact the author.');
define('DFCONTACT_ABOUT_AUTHOR', 'Yazar');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Warranty');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'This program is released under GNU General Public License (GPL) and is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', '* olan yerlerin doldurulmas� mecburidir:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Ge�ersiz bir Mail adresi yazd�n�z!');
define('DFCONTACT_FORM_TITLE_MR', 'Bay.');
define('DFCONTACT_FORM_TITLE_MRS', 'Bayan.');
define('DFCONTACT_FORM_SUBMIT', 'G�nder');
define('DFCONTACT_FORM_BACK', 'geri');
define('DFCONTACT_FORM_DATE_FORMAT', 'Y/m/d H:i:s');
define('DFCONTACT_FORM_DATE', 'Tarih');
define('DFCONTACT_FORM_SENT_URL', 'Form URL');
define('DFCONTACT_FORM_USERAGENT', 'User agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Somebody sent you an email using the form on your website. This is what he typed in:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'The following lines contain information which has not been typed in, but collected by the server.');
define('DFCONTACT_FORM_MAIL_SUBJECT', '�leti�imden Mailiniz var');
define('DFCONTACT_FORM_MAIL_ERROR', 'Hata: �zg�n�z mailiniz g�nderilemedi. L�tfen sonra bir daha deneyin.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mailiniz ba�ar�yla g�nderildi en yak�n zamanda sizinle irtibata ge�ilecektir .');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Mesaj�n�za ait bilgiler buraya iletildi:');

// Captcha
define('DFCONTACT_CAPTCHA', 'G�venlik Kodu');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'L�tfen resimdeki karakterleri kutuya yaz?n. E?er resimi okumakda zorlan?yorsan?z , resmin yan?ndaki ?ekle t?klay?n, yeni resim y�klenecektir.');
define('DFCONTACT_CAPTCHA_ERROR', 'G�venlik kodunu yanl?? girdiniz!');
define('DFCONTACT_CAPTCHA_INFO', 'Display an image with characters as part of the form. The user has to enter the characters into a separate field to proove he is human. This should prevent spambots using the form.<br /><b>Works only if the component <a 
href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is installed (Version >= 4.0).</b>');
 
// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: Formun g�nderilece?i adres ayarlanmam??, l�tfen admin olarak  giri? yap?n ve y�netim panelinden DFcontact ayarlar?ndan ge�erli bir mail adresi yaz?n!');

?>