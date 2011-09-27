<?php
/**
* DFContact - A Joomla! contact form component
* @version 1.0.3
* @package DFContact
* @copyright (C) 2005 by Daniel Filzhut
* @license Released under the terms of the GNU General Public License
* T�rk�e �eviri Ahmet USTA info@joomlademo.uni.cc http://www.joomlademo.uni.cc
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
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Kay�t Hatas� (config dosyas� yaz�labilir de�il)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Kay�t Hatas� (config dosyas� bulunamad�)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Kay�t Hatas� (config dosyas�na yaz�lamad�)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Ayarlar ba�ar�yla kaydedildi!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Genel');
define('DFCONTACT_DESTINATIONMAIL', 'Mesaj�n g�nderilece�i email');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Mesaj iletildi.');
define('DFCONTACT_PAGETITLE', 'Sayfa ba�l���');
define('DFCONTACT_PAGETITLE_INFO', '�lk �nce g�sterilecek.');
define('DFCONTACT_INFOTEXT', 'Form a��klamas�');
define('DFCONTACT_INFOTEXT_INFO', 'Formunuzun �st�nde g�sterilecek giri� yaz�s�.');
define('DFCONTACT_FORMTEXT', 'Form alan�');
define('DFCONTACT_FORMTEXT_INFO', 'Formunuzun �st�nde g�sterielcek mesaj.');
define('DFCONTACT_BUTTONTEXT', 'Buton yaz�s�');
define('DFCONTACT_BUTTONTEXT_INFO', 'Butonunuzda ne yazmasn� istersiniz?<b/>�rnek:G�NDER</b/>.');
define('DFCONTACT_LANGUAGE', 'Form Dili');
define('DFCONTACT_ADDRESSSTYLE', 'Adres tipi');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Local output format for addresses.');
define('DFCONTACT_CLICKABLELINKS', 'Clickable links');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Clickable links are comfortable, but also support email-harvesting.');
define('DFCONTACT_HTMLMAILS', 'HTML mail');
define('DFCONTACT_HTMLMAILS_INFO', 'mesajlar�n HTML fromat�nda g�nderilmesi.');
define('DFCONTACT_ADDSERVERDATA', 'Bilgiler veritab�na i�lensin mi?');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Mesaj g�nderenin browser, i�letim sistemi ve IP adresleri emailinize gelsin mi?.');
define('DFCONTACT_DISPLAYUSERINPUT', 'Display user input:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'After email has been sent, display resumed input to user.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Bilgileriniz');
define('DFCONTACT_TAB_YOUR_DATA_INFO', '�leti�im Formunda g�r�nmesini istedi�iniz bilgilerinizi giriniz.');
define('DFCONTACT_COMPANY', 'Firma/�irket');
define('DFCONTACT_TITLE', 'Ba�l�k');
define('DFCONTACT_NAME', 'Ad�n�z');
define('DFCONTACT_POSITION', 'Pozisyon');
define('DFCONTACT_STREET', 'Cadde');
define('DFCONTACT_POSTBOX', 'Posta Kutusu');
define('DFCONTACT_ZIP', 'Posta Kodu');
define('DFCONTACT_CITY', '�l�e');
define('DFCONTACT_STATE', '�l');
define('DFCONTACT_COUNTRY', '�lke');
define('DFCONTACT_PHONE', 'Tel');
define('DFCONTACT_MOBILE', 'Cep Tel');
define('DFCONTACT_FAX', 'Faks');
define('DFCONTACT_EMAIL', 'E-mail');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Mesaj alan�');
define('DFCONTACT_CHECKBOX', '��aret Kutusu');
define('DFCONTACT_CHECKBOX_INFO', 'Displays a checkbox underneath the message textarea. Setting this as duty-field will force the user to check it.');
define('DFCONTACT_CHECKBOX_TEXT', 'Checkbox-Text');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Will be displayed next to the checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Form alanlar�');
define('DFCONTACT_HIDE', 'Gizle');
define('DFCONTACT_SHOW', 'G�ster');
define('DFCONTACT_OPTIONAL', '�ste�e ba�l�');
define('DFCONTACT_DUTY', 'Mecburi');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Formunuzun ziyaret�ilere g�sterilece�i �ny�z�nde olmas�n� istediklerinizi ve doldurulmas� gereken zorunlu alanlar� ayarlay�n.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Hakk�nda');
define('DFCONTACT_ABOUT_VERSION', 'Version');
define('DFCONTACT_ABOUT_PROGRAM', 'Program');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact ayarlar� kolay yap�labilen kullan��l� bir ileti�im formudur.Geli�mesine katk�da bulunmak ve fikirlerinizi payla�mak i�in l�tfen yap�mc�s� ile temas kurun.');
define('DFCONTACT_ABOUT_AUTHOR', 'Author');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a><br>T�rk�e �eviri: <a href="mailto:info@joomlademo.uni.cc?Subject=DFContact Components">Ahmet USTA</a> - Web Sayfas�: <a href="http://www.joomlademo.uni.cc">http://www.joomlademo.uni.cc</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Kullan�m �artlar�');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Bu bile�en GNU General Public License (GPL) ile korumaktad�r.Hi�bir �ekilde para ile sat�lamaz.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'L�tfen bo� alan b�rakmamaya �zen g�sterin:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Ge�erli bir e-mail adresi yaz�n!');
define('DFCONTACT_FORM_TITLE_MR', 'Bay:');
define('DFCONTACT_FORM_TITLE_MRS', 'Bayan:');
define('DFCONTACT_FORM_SUBMIT', 'G�nder');
define('DFCONTACT_FORM_BACK', 'geri');
define('DFCONTACT_FORM_DATE_FORMAT', 'd/m/Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Tarih');
define('DFCONTACT_FORM_SENT_URL', 'Form URL');
define('DFCONTACT_FORM_USERAGENT', 'User agent');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Port');
define('DFCONTACT_FORM_MAIL_TEXT', 'Web sayfan�zdan birisi size mesaj yollad�.Mesaj i�eri�i a�a��dad�r:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'The following lines contain information which has not been typed in, but collected by the server.');
define('DFCONTACT_FORM_MAIL_SUBJECT', '�leti�im adresi');
define('DFCONTACT_FORM_MAIL_ERROR', 'Hata:Mesaj iletilemedi.L�tfen tekrar deneyin.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mesaj�n�z ba�ar�yla iletildi.');
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