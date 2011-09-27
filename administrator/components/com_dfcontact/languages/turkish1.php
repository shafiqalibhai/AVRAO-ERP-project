<?php
/**
* DFContact - A Joomla! contact form component
* @version 1.0.3
* @package DFContact
* @copyright (C) 2005 by Daniel Filzhut
* @license Released under the terms of the GNU General Public License
* Türkçe Çeviri Ahmet USTA info@joomlademo.uni.cc http://www.joomlademo.uni.cc
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
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Kayýt Hatasý (config dosyasý yazýlabilir deðil)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Kayýt Hatasý (config dosyasý bulunamadý)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Kayýt Hatasý (config dosyasýna yazýlamadý)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Ayarlar baþarýyla kaydedildi!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Genel');
define('DFCONTACT_DESTINATIONMAIL', 'Mesajýn gönderileceði email');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Mesaj iletildi.');
define('DFCONTACT_PAGETITLE', 'Sayfa baþlýðý');
define('DFCONTACT_PAGETITLE_INFO', 'Ýlk önce gösterilecek.');
define('DFCONTACT_INFOTEXT', 'Form açýklamasý');
define('DFCONTACT_INFOTEXT_INFO', 'Formunuzun üstünde gösterilecek giriþ yazýsý.');
define('DFCONTACT_FORMTEXT', 'Form alaný');
define('DFCONTACT_FORMTEXT_INFO', 'Formunuzun üstünde gösterielcek mesaj.');
define('DFCONTACT_BUTTONTEXT', 'Buton yazýsý');
define('DFCONTACT_BUTTONTEXT_INFO', 'Butonunuzda ne yazmasný istersiniz?<b/>Örnek:GÖNDER</b/>.');
define('DFCONTACT_LANGUAGE', 'Form Dili');
define('DFCONTACT_ADDRESSSTYLE', 'Adres tipi');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Local output format for addresses.');
define('DFCONTACT_CLICKABLELINKS', 'Clickable links');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Clickable links are comfortable, but also support email-harvesting.');
define('DFCONTACT_HTMLMAILS', 'HTML mail');
define('DFCONTACT_HTMLMAILS_INFO', 'mesajlarýn HTML fromatýnda gönderilmesi.');
define('DFCONTACT_ADDSERVERDATA', 'Bilgiler veritabýna iþlensin mi?');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Mesaj gönderenin browser, iþletim sistemi ve IP adresleri emailinize gelsin mi?.');
define('DFCONTACT_DISPLAYUSERINPUT', 'Display user input:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'After email has been sent, display resumed input to user.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Bilgileriniz');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Ýletiþim Formunda görünmesini istediðiniz bilgilerinizi giriniz.');
define('DFCONTACT_COMPANY', 'Firma/Þirket');
define('DFCONTACT_TITLE', 'Baþlýk');
define('DFCONTACT_NAME', 'Adýnýz');
define('DFCONTACT_POSITION', 'Pozisyon');
define('DFCONTACT_STREET', 'Cadde');
define('DFCONTACT_POSTBOX', 'Posta Kutusu');
define('DFCONTACT_ZIP', 'Posta Kodu');
define('DFCONTACT_CITY', 'Ýlçe');
define('DFCONTACT_STATE', 'Ýl');
define('DFCONTACT_COUNTRY', 'Ülke');
define('DFCONTACT_PHONE', 'Tel');
define('DFCONTACT_MOBILE', 'Cep Tel');
define('DFCONTACT_FAX', 'Faks');
define('DFCONTACT_EMAIL', 'E-mail');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Mesaj alaný');
define('DFCONTACT_CHECKBOX', 'Ýþaret Kutusu');
define('DFCONTACT_CHECKBOX_INFO', 'Displays a checkbox underneath the message textarea. Setting this as duty-field will force the user to check it.');
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox-Text');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Will be displayed next to the checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Form alanlarý');
define('DFCONTACT_HIDE', 'Gizle');
define('DFCONTACT_SHOW', 'Göster');
define('DFCONTACT_OPTIONAL', 'Ýsteðe baðlý');
define('DFCONTACT_DUTY', 'Mecburi');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Formunuzun ziyaretçilere gösterileceði önyüzünde olmasýný istediklerinizi ve doldurulmasý gereken zorunlu alanlarý ayarlayýn.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Hakkýnda');
define('DFCONTACT_ABOUT_VERSION', 'Version');
define('DFCONTACT_ABOUT_PROGRAM', 'Program');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact ayarlarý kolay yapýlabilen kullanýþlý bir iletiþim formudur.Geliþmesine katkýda bulunmak ve fikirlerinizi paylaþmak için lütfen yapýmcýsý ile temas kurun.');
define('DFCONTACT_ABOUT_AUTHOR', 'Author');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a><br>Türkçe Çeviri: <a href="mailto:info@joomlademo.uni.cc?Subject=DFContact Components">Ahmet USTA</a> - Web Sayfasý: <a href="http://www.joomlademo.uni.cc">http://www.joomlademo.uni.cc</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Kullaným Þartlarý');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Bu bileþen GNU General Public License (GPL) ile korumaktadýr.Hiçbir þekilde para ile satýlamaz.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Lütfen boþ alan býrakmamaya özen gösterin:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Geçerli bir e-mail adresi yazýn!');
define('DFCONTACT_FORM_TITLE_MR', 'Bay:');
define('DFCONTACT_FORM_TITLE_MRS', 'Bayan:');
define('DFCONTACT_FORM_SUBMIT', 'Gönder');
define('DFCONTACT_FORM_BACK', 'geri');
define('DFCONTACT_FORM_DATE_FORMAT', 'd/m/Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Tarih');
define('DFCONTACT_FORM_SENT_URL', 'Form URL');
define('DFCONTACT_FORM_USERAGENT', 'User agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Web sayfanýzdan birisi size mesaj yolladý.Mesaj içeriði aþaðýdadýr:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'The following lines contain information which has not been typed in, but collected by the server.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Ýletiþim adresi');
define('DFCONTACT_FORM_MAIL_ERROR', 'Hata:Mesaj iletilemedi.Lütfen tekrar deneyin.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mesajýnýz baþarýyla iletildi.');
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