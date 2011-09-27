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
define('DFCONTACT_ERROR', 'Error');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Imposible guardar (no se tiene el permiso de escritura para el archivo config)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Imposible guardar (no se pudo abrir el archivo config)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Imposible guardar (no se puede escribir el archivo config)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Configuraci�n guardada con �xito!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'General');
define('DFCONTACT_DESTINATIONMAIL', 'E-mail destinatario');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'E-mail donde se enviar� el contenido del formulario.');
define('DFCONTACT_PAGETITLE', 'T�tulo de p�gina');
define('DFCONTACT_PAGETITLE_INFO', 'Se mostrar� justo antes de todo el contenido.');
define('DFCONTACT_INFOTEXT', 'Texto informativo');
define('DFCONTACT_INFOTEXT_INFO', 'Se mostrar� justo debajo del t�tulo.');
define('DFCONTACT_FORMTEXT', 'Texto del formulario');
define('DFCONTACT_FORMTEXT_INFO', 'Se mostrar� justo antes del formulario.');
define('DFCONTACT_BUTTONTEXT', 'Texto del bot�n');
define('DFCONTACT_BUTTONTEXT_INFO', 'Texto alternativo para el bot�n Enviar.');
define('DFCONTACT_LANGUAGE', 'Idioma');
define('DFCONTACT_ADDRESSSTYLE', 'Estilo de Direcci�n');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Formato de salida local para direcciones.');
define('DFCONTACT_CLICKABLELINKS', 'Links donde se puede hacer click');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Links donde se puede hacer click son c�modos, pero soporta recolecci�n de e-mails.');
define('DFCONTACT_HTMLMAILS', 'mails HTML');
define('DFCONTACT_HTMLMAILS_INFO', 'Enviar e-mails en formato HTML.');
define('DFCONTACT_ADDSERVERDATA', 'Agregar datos del servidor');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Agregar datos sobre el explorador del usuario, sistema operativo e IP a tu e-mail (el usuario no reconocr� esto).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Mostrar input del usuario');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Luego que el e-mail sea enviado, mostrar un resumen al usuario.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Tu informaci�n');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Ingresa la informaci�n a ser mostrada en la p�gina de cont�cto.');
define('DFCONTACT_COMPANY', 'Compa�ia');
define('DFCONTACT_TITLE', 'T�tulo');
define('DFCONTACT_NAME', 'Nombre');
define('DFCONTACT_POSITION', 'Posici�n');
define('DFCONTACT_STREET', 'Calle/Avenida');
define('DFCONTACT_POSTBOX', 'Casilla Postal');
define('DFCONTACT_ZIP', 'C�digo Postal');
define('DFCONTACT_CITY', 'Ciudad');
define('DFCONTACT_STATE', 'Estado');
define('DFCONTACT_COUNTRY', 'Pa�s');
define('DFCONTACT_PHONE', 'Tel�fono');
define('DFCONTACT_MOBILE', 'Celular');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Mensaje');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Mostrar un campo checkbox debajo del �rea del mensaje. Establecer este campo como obligatorio, har� impresindible que el usuario lo marque para poder enviar el formulario.');
define('DFCONTACT_CHECKBOX_TEXT', 'Texto del campo checkbox');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Se mostrar� al lado del checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Campos de formulario');
define('DFCONTACT_HIDE', 'Ocultar');
define('DFCONTACT_SHOW', 'Mostrar');
define('DFCONTACT_OPTIONAL', 'Opcional');
define('DFCONTACT_DUTY', 'Obligatorio');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Elige los campos que deben ser mostrados en el formulario de cont�cto y define que campos deben ser llenados antes de enviarlo.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Sobre');
define('DFCONTACT_ABOUT_VERSION', 'Versi�n');
define('DFCONTACT_ABOUT_PROGRAM', 'Programa');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact es un componente extremadamente f�cil de configurar. Muestra la informaci�n de contacto y un formulario de cont�cto en la misma p�gina. Los campos disponibles pueden ser seleccionados como obligatorios. Si tienes algunas ideas de como mejorar este componente, o has encontrado algun error, por favor comun�cate con el autor.');
define('DFCONTACT_ABOUT_AUTHOR', 'Autor');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Alemania<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garant�as');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Este programa es ofrecido bajo la licenica GNU General Public License (GPL) y es distribuido con el deseo de que sea ut�l, pero SIN NINGUNA GARANT�A; menos aun la t�cita garant�a de COMERCIALIDAD o que FUNCIONAR� PARA ALG�N PROP�SITO EN PARTICULAR.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Por favor complete los siguientes campos:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Por favor, ingrese una direcci�n de correo e-mail v�lida!');
define('DFCONTACT_FORM_TITLE_MR', 'Sr.');
define('DFCONTACT_FORM_TITLE_MRS', 'Sra.');
define('DFCONTACT_FORM_SUBMIT', 'Enviar');
define('DFCONTACT_FORM_BACK', 'atras');
define('DFCONTACT_FORM_DATE_FORMAT', 'A/m/d H:i:s');
define('DFCONTACT_FORM_DATE', 'Fecha');
define('DFCONTACT_FORM_SENT_URL', 'URL del formulario');
define('DFCONTACT_FORM_USERAGENT', 'Agente usuario');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Puerto');
define('DFCONTACT_FORM_MAIL_TEXT', 'Alguien te ha enviado un e-mail utilizando el formulario de tu web. Estos son los datos que ingres�:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'Las siguientes l�neas contienen informaci�n que no han sido tipeadas, sino recolectadas autom�ticamente por el servidor.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'E-mail de cont�cto');
define('DFCONTACT_FORM_MAIL_ERROR', 'Error: No se ha enviado el e-mail. Por favor, intente nuevamente m�s tarde.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'El mail ha sido enviado con �xito.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Se ha enviado la siguiente informacion:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Captcha');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Por favor introduce los caracteres de la figura en el siguiente campo. Si no llegas a entenderlo, haz click en el bot�n al lado de la imagen para mostrar una diferente.'); 
define('DFCONTACT_CAPTCHA_ERROR', 'Captcha con c�digo v�lido!');
define('DFCONTACT_CAPTCHA_INFO', 'Muestra una imagen con caracteres como parte del formulario. El usuario tiene que ingresar los caracteres en un campo aparte para demostrar que es un humano. Esto debe impedir a spambots del uso del formulario.<br /><b>Funciona �nicamente si el componente <a href=" http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> est� instalado (Version >= 4.0).</b>');
 
// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: No se ha definido un email destino, por favor ingresa al �rea administrativa y establece uno.');

?>