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
define('DFCONTACT_NO', 'Hayýr');

// Saving
define('DFCONTACT_ERROR', 'Hata');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Kayýt hatasý (config dosyasý yazýlamaz durumda)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Kayýt hatasý (Config dosyasý açýlamýyor)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Kayýt hatasý (Yazýlabilecek bir config dosyasý yok)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Ayarlarýnýz baþarýlý bir þekilde kaydedildi!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Genel');
define('DFCONTACT_DESTINATIONMAIL', 'E-mail');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Mesajýn gideceði mail.');
define('DFCONTACT_PAGETITLE', 'Sayfa Baþlýðý');
define('DFCONTACT_PAGETITLE_INFO', 'Ýletiþime týklandýðýnda görenecek isim.');
define('DFCONTACT_INFOTEXT', 'Info yazýsý');
define('DFCONTACT_INFOTEXT_INFO', 'mail atýlmadan önceki görünecek yazý.');
define('DFCONTACT_FORMTEXT', 'Form Yazýsý');
define('DFCONTACT_FORMTEXT_INFO', 'Will be displayed right above the contact form.');
define('DFCONTACT_BUTTONTEXT', 'Buton yazýsý');
define('DFCONTACT_BUTTONTEXT_INFO', 'Gönderme butonuna deðiþik biþey yazmak istiyorsanýz buraya yazýn.');
define('DFCONTACT_LANGUAGE', 'lisan');
define('DFCONTACT_ADDRESSSTYLE', 'Adres stili');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Local output format for addresses.');
define('DFCONTACT_CLICKABLELINKS', 'Týklanabilir linkler');
define('DFCONTACT_CLICKABLELINKS_INFO', 'mesajýnýza yazýlan linklerin týklanabilir olmasýný saðlar.');
define('DFCONTACT_HTMLMAILS', 'HTML mail');
define('DFCONTACT_HTMLMAILS_INFO', 'Mailin html formatýnda olmasýný saðlar bu seçenek evet seçilirse mesaj kýsmýnda html kodlarýnýda kabul edecektir..');
define('DFCONTACT_ADDSERVERDATA', 'Server bilgilerini gönder');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Adds data about the user\'s browser, operating system and IP to your email (User will not recognize this).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Display user input:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'After email has been sent, display resumed input to user.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Senin Bilgilerin');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Burdaki alanlara gerekli bilgileri girerseniz kontak sayfasýnda görünecektir..');
define('DFCONTACT_COMPANY', 'Þirket adý');
define('DFCONTACT_TITLE', 'Baþlýk');
define('DFCONTACT_NAME', 'isim');
define('DFCONTACT_POSITION', 'Pozisyon');
define('DFCONTACT_STREET', 'Sokak');
define('DFCONTACT_POSTBOX', 'No:');
define('DFCONTACT_ZIP', 'PostaKodu');
define('DFCONTACT_CITY', 'Þehir');
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
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox-Yazýsý');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Will be displayed next to the checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Form alanlarý');
define('DFCONTACT_HIDE', 'Gizle');
define('DFCONTACT_SHOW', 'Göster');
define('DFCONTACT_OPTIONAL', 'Opsiyonel');
define('DFCONTACT_DUTY', 'Þart');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Choose the fields that are displayed in the contact form and define which fields have to be filled out before sending.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Hakkýnda');
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
define('DFCONTACT_FORM_MISSING_FIELDS', '* olan yerlerin doldurulmasý mecburidir:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Geçersiz bir Mail adresi yazdýnýz!');
define('DFCONTACT_FORM_TITLE_MR', 'Bay.');
define('DFCONTACT_FORM_TITLE_MRS', 'Bayan.');
define('DFCONTACT_FORM_SUBMIT', 'Gönder');
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
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Ýletiþimden Mailiniz var');
define('DFCONTACT_FORM_MAIL_ERROR', 'Hata: Üzgünüz mailiniz gönderilemedi. Lütfen sonra bir daha deneyin.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mailiniz baþarýyla gönderildi en yakýn zamanda sizinle irtibata geçilecektir .');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Mesajýnýza ait bilgiler buraya iletildi:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Güvenlik Kodu');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Lütfen resimdeki karakterleri kutuya yaz?n. E?er resimi okumakda zorlan?yorsan?z , resmin yan?ndaki ?ekle t?klay?n, yeni resim yüklenecektir.');
define('DFCONTACT_CAPTCHA_ERROR', 'Güvenlik kodunu yanl?? girdiniz!');
define('DFCONTACT_CAPTCHA_INFO', 'Display an image with characters as part of the form. The user has to enter the characters into a separate field to proove he is human. This should prevent spambots using the form.<br /><b>Works only if the component <a 
href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> is installed (Version >= 4.0).</b>');
 
// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: Formun gönderilece?i adres ayarlanmam??, lütfen admin olarak  giri? yap?n ve yönetim panelinden DFcontact ayarlar?ndan geçerli bir mail adresi yaz?n!');

?>