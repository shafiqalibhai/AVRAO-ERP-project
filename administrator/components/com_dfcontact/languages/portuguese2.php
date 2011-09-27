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
define('DFCONTACT_YES', 'Sim');
define('DFCONTACT_NO', 'N�o');

// Saving
define('DFCONTACT_ERROR', 'Erro');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Saving failed (config file not writable)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Saving failed (could not open config file)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Saving failed (could not write config file)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Altera��es guardadas com sucesso!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Geral');
define('DFCONTACT_DESTINATIONMAIL', 'Email de destino');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email para onde deve ser enviado o email.');
define('DFCONTACT_PAGETITLE', 'Titulo da P�gina');
define('DFCONTACT_PAGETITLE_INFO', 'Ser� mostrada no inicio da pagina.');
define('DFCONTACT_INFOTEXT', 'Texto de Informa��o');
define('DFCONTACT_INFOTEXT_INFO', 'Ser� mostrada logo acima das informa��es do contacto.');
define('DFCONTACT_FORMTEXT', 'Texto do formul�rio');
define('DFCONTACT_FORMTEXT_INFO', 'Ser� mostrado logo acima do formul�rio.');
define('DFCONTACT_BUTTONTEXT', 'Texto do Bot�o');
define('DFCONTACT_BUTTONTEXT_INFO', 'Texto alternativo no but�o do formul�rio.');
define('DFCONTACT_LANGUAGE', 'Linguagem.');
define('DFCONTACT_ADDRESSSTYLE', 'Estilo da morada.');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Formato das moradas.');
define('DFCONTACT_CLICKABLELINKS', 'Links clicaveis.');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Links clicaveis s�o faceis de usar, mas inseguros.');
define('DFCONTACT_HTMLMAILS', 'Emails HTML');
define('DFCONTACT_HTMLMAILS_INFO', 'Emails em formato HTML.');
define('DFCONTACT_ADDSERVERDATA', 'Dados do Servidor');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Adiciona dados sobre o browser, sistema operativo e IP da maquina onde foi feito o pedido (Utilizador n�o se apercebe).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Mostra email ao utilizador:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Depois do email enviado mostra resumo ao utilizador.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Seus Dados');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Itroduza os dados para serem mostrados na pagina de contactos.');
define('DFCONTACT_COMPANY', 'Empresa');
define('DFCONTACT_TITLE', 'Titulo');
define('DFCONTACT_NAME', 'Nome');
define('DFCONTACT_POSITION', 'Posi��o');
define('DFCONTACT_STREET', 'Rua');
define('DFCONTACT_POSTBOX', 'Caixa Postal');
define('DFCONTACT_ZIP', 'C�digo Postal');
define('DFCONTACT_CITY', 'Cidade');
define('DFCONTACT_STATE', 'Distrito');
define('DFCONTACT_COUNTRY', 'Pa�s');
define('DFCONTACT_PHONE', 'Telefone');
define('DFCONTACT_MOBILE', 'Telemovel');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Mensagem');
define('DFCONTACT_CHECKBOX', 'Caixa de verifica��o');
define('DFCONTACT_CHECKBOX_INFO', 'Mostra uma caixa de verifica��o por baixo da mensagem do utilizador. Activando isto o utilizador � obrigado a marc�-la para enviar a mensagem.');
define('DFCONTACT_CHECKBOX_TEXT', 'Texto da Caixa de verifica��o');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Ser� mostrada junto � caixa.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Campos');
define('DFCONTACT_HIDE', 'Esconder');
define('DFCONTACT_SHOW', 'Mostrar');
define('DFCONTACT_OPTIONAL', 'Opcional');
define('DFCONTACT_DUTY', 'Obrigatorio');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Escolha os campos que ser�o mostrados na pagina de contacto e defina os que s�o necessarios para se poder enviar uma mensagem.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Acerca');
define('DFCONTACT_ABOUT_VERSION', 'Vers�o');
define('DFCONTACT_ABOUT_PROGRAM', 'Programa');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact is a contact form component which is extremly easy to configure. It displays contact data and a contact form on the same page. The availible fields in the form can be choosen and set as duty fields. If you have some ideas to extend this component or found some bugs, please contact the author.');
define('DFCONTACT_ABOUT_AUTHOR', 'Autor');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantia');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'This program is released under GNU General Public License (GPL) and is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Preencha os seguintes campos:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Insira um email v�lido!');
define('DFCONTACT_FORM_TITLE_MR', 'Sr.');
define('DFCONTACT_FORM_TITLE_MRS', 'Sra.');
define('DFCONTACT_FORM_SUBMIT', 'Enviar');
define('DFCONTACT_FORM_BACK', 'voltar');
define('DFCONTACT_FORM_DATE_FORMAT', 'd/m/Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Data');
define('DFCONTACT_FORM_SENT_URL', 'URL envio');
define('DFCONTACT_FORM_USERAGENT', 'User agent');
define('DFCONTACT_FORM_HOST', 'Anfitri�o');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Porta');
define('DFCONTACT_FORM_MAIL_TEXT', 'Alguem lhe enviou um email atrav�s do seu site. Isto � o que enviou:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'As linhas seguintes cont�m informa��o que n�o foi enviada pelo utilizador mas foi recolhida pelo servidor.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'Email de contacto');
define('DFCONTACT_FORM_MAIL_ERROR', 'Erro: O email nao foi enviado. Volte a tentar mais tarde.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'O email foi enviado com sucesso.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Os seguintes dados foram preenchidos:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Teste de Turing');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Insira as letras e numeros da imagem no campo seguinte. Se tiver dificuldade em ler algum clique no bot�o ao lado da imagem para muda-la.');
define('DFCONTACT_CAPTCHA_ERROR', 'Teste com c�digo inv�lido!');
define('DFCONTACT_CAPTCHA_INFO', 'Mostra uma imagem com caracteres como parte do formul�rio. O internauta tem que inserir os caracteres no campo separado de modo a provar que � um humano. Isto deve impedir spambots de usar o formul�rio para enviar spam.<br /><b>S� funciona se tiver o componente <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> instalado(Vers�o >= 4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: N�o foi defenido nenhum email de destino, fa�a login na area de administra��o e defina um.');

?>