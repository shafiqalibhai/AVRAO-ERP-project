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

/**
* Vers�o em Portugu�s Brasileiro por Pedro Padron <padron@aaargh.com.br>
* http://www.pleskbrasil.org/
**/

define('DFCONTACT', 'DFContact');
define('DFCONTACT_YES', 'Sim');
define('DFCONTACT_NO', 'N�o');

// Saving
define('DFCONTACT_ERROR', 'Erro');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Erro ao salver (arquivo de configura��o n�o p�de ser escrito)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Erro ao salvar (n�o foi poss�vel abrir arquivo de configura��o)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Erro ao salvar (n�o foi poss�vel escrever no arquivo de configura��o)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Configura��o salva com sucesso!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Geral');
define('DFCONTACT_DESTINATIONMAIL', 'E-mail de destino');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email para enviar os dados do formul�rio');
define('DFCONTACT_PAGETITLE', 'T�tulo da p�gina');
define('DFCONTACT_PAGETITLE_INFO', 'Ser� exibido acima de todo o conte�do.');
define('DFCONTACT_INFOTEXT', 'Texto de informa��o');
define('DFCONTACT_INFOTEXT_INFO', 'Ser� exibido acima dos dados de contato.');
define('DFCONTACT_FORMTEXT', 'Texto do formul�rio');
define('DFCONTACT_FORMTEXT_INFO', 'Ser� exibido acima do formul�rio de contato.');
define('DFCONTACT_BUTTONTEXT', 'Texto do bot�o');
define('DFCONTACT_BUTTONTEXT_INFO', 'Texto alternativo para o bot�o \'submit\'.');
define('DFCONTACT_LANGUAGE', 'Idioma');
define('DFCONTACT_ADDRESSSTYLE', 'Estilo do endere�o');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Formato local de exibi��o do endere�o.');
define('DFCONTACT_CLICKABLELINKS', 'Links clic�veis');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Links clic�veis s�o confort�veis, mas permitem email-harvesting.');
define('DFCONTACT_HTMLMAILS', 'Emails HTML');
define('DFCONTACT_HTMLMAILS_INFO', 'Envia emails em formato HTML.');
define('DFCONTACT_ADDSERVERDATA', 'Adicionar dados do servidor');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Adiciona informa��es sobre o navegador, sistema operacional e IP do usu�rio (usu�rio n�o ver� esses dados).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Exibir dados inseridos pelo usu�rio:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Depois de enviar o e-mail, dados resumidos ser�o exibidos ao usu�rio.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Seus dados');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Insira os dados a serem exibidos na p�gina de contato.');
define('DFCONTACT_COMPANY', 'Empresa');
define('DFCONTACT_TITLE', 'T�tulo');
define('DFCONTACT_NAME', 'Nome');
define('DFCONTACT_POSITION', 'Posi��o');
define('DFCONTACT_STREET', 'Rua');
define('DFCONTACT_POSTBOX', 'Caixa Postal');
define('DFCONTACT_ZIP', 'CEP');
define('DFCONTACT_CITY', 'Cidade');
define('DFCONTACT_STATE', 'Estado');
define('DFCONTACT_COUNTRY', 'Pa�s');
define('DFCONTACT_PHONE', 'Telefone');
define('DFCONTACT_MOBILE', 'Celular');
define('DFCONTACT_FAX', 'Fax');
define('DFCONTACT_EMAIL', 'Email');
define('DFCONTACT_AIM', 'AIM');
define('DFCONTACT_ICQ', 'ICQ');
define('DFCONTACT_YAHOO', 'Yahoo');
define('DFCONTACT_MSN', 'MSN');
define('DFCONTACT_MESSAGE', 'Mensagem');
define('DFCONTACT_CHECKBOX', 'Checkbox');
define('DFCONTACT_CHECKBOX_INFO', 'Exibe uma checkbox abaixo da mensagem. Deixando-a como obrigat�ria o usu�rio ser� for�ado a marc�-la.');
define('DFCONTACT_CHECKBOX_TEXT', 'Texto da checkbox');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Ser� exibido ao lado da checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Campos');
define('DFCONTACT_HIDE', 'Esconder');
define('DFCONTACT_SHOW', 'Exibir');
define('DFCONTACT_OPTIONAL', 'Opcional');
define('DFCONTACT_DUTY', 'Obrigat�rio');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Escolha os campos que ser�o exibidos no formul�rio de contato e defina quais s�o obrigat�rios.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Sobre');
define('DFCONTACT_ABOUT_VERSION', 'Vers�o');
define('DFCONTACT_ABOUT_PROGRAM', 'Programa');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact � um componente de formul�rio de contato que � extremamente f�cil de configurar. Exibe informa��es de contato e um formul�rio de contato na mesma p�gina. Os campos dispon�veis para o formul�rios podem ser definidos como opcionais ou obrigat�rios. Se voc� tem alguma id�ia para extender esse componente ou encontrou algum bug, por favor contate o autor.');
define('DFCONTACT_ABOUT_AUTHOR', 'Autor');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantia');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Este programa � distribu�do sob a licen�a GNU General Public License (GPL) na esperan�a de que seja �til, mas SEM NENHUMA GARANTIA; inclusive sem a garantia de COMERCIALIZA��O ou de ADEQUA��O A QUALQUER PROP�SITO.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Por favor preencha os seguintes campos:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Por favor insira um endere�o de e-mail v�lido!');
define('DFCONTACT_FORM_TITLE_MR', 'Sr.');
define('DFCONTACT_FORM_TITLE_MRS', 'Sra.');
define('DFCONTACT_FORM_SUBMIT', 'Enviar');
define('DFCONTACT_FORM_BACK', 'voltar');
define('DFCONTACT_FORM_DATE_FORMAT', 'd/m/Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Data');
define('DFCONTACT_FORM_SENT_URL', 'URL do Formul�rio');
define('DFCONTACT_FORM_USERAGENT', 'Navegador');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Porta');
define('DFCONTACT_FORM_MAIL_TEXT', 'Algu�m lhe enviou um e-mail usando o formul�rio em seu website. Abaixo est� o que essa pessou escreveu:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'As seguintes linhas cont�m informa��es que n�o foram digitadas, mas coletadas pelo servidor.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'E-mail de contato');
define('DFCONTACT_FORM_MAIL_ERROR', 'Erro: Mensagem n�o enviada. Por favor tente novamente mais tarde.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mensagem enviada com sucesso.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Os seguintes dados foram enviados:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Teste de Turing');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Insira as letras e numeros da imagem no campo seguinte. Se tiver dificuldade em ler algum clique no bot�o ao lado da imagem para muda-la.');
define('DFCONTACT_CAPTCHA_ERROR', 'Teste com c�digo inv�lido!');
define('DFCONTACT_CAPTCHA_INFO', 'Mostra uma imagem com caracteres como parte do formul�rio. O internauta tem que inserir os caracteres no campo separado de modo a provar que � um humano. Isto deve impedir spambots de usar o formul�rio para enviar spam.<br /><b>S� funciona se tiver o componente <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> instalado(Vers�o >= 4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: N�o foi defenido nenhum email de destino, fa�a login na area de administra��o e defina um.');

?>
