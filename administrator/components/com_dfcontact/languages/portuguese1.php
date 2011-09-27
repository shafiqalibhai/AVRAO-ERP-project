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
* Versão em Português Brasileiro por Pedro Padron <padron@aaargh.com.br>
* http://www.pleskbrasil.org/
**/

define('DFCONTACT', 'DFContact');
define('DFCONTACT_YES', 'Sim');
define('DFCONTACT_NO', 'Não');

// Saving
define('DFCONTACT_ERROR', 'Erro');
define('DFCONTACT_CONFIG_ERROR_FILE_CHMOD', 'Erro ao salver (arquivo de configuração não pôde ser escrito)!');
define('DFCONTACT_CONFIG_ERROR_FILE_OPEN', 'Erro ao salvar (não foi possí­vel abrir arquivo de configuração)!');
define('DFCONTACT_CONFIG_ERROR_FILE_WRITE', 'Erro ao salvar (não foi possí­vel escrever no arquivo de configuração)!');
define('DFCONTACT_CONFIG_SUCCESS', 'Configuração salva com sucesso!');

// Tab: General
define('DFCONTACT_TAB_GENERAL', 'Geral');
define('DFCONTACT_DESTINATIONMAIL', 'E-mail de destino');
define('DFCONTACT_DESTINATIONMAIL_INFO', 'Email para enviar os dados do formulário');
define('DFCONTACT_PAGETITLE', 'Título da página');
define('DFCONTACT_PAGETITLE_INFO', 'Será exibido acima de todo o conteúdo.');
define('DFCONTACT_INFOTEXT', 'Texto de informação');
define('DFCONTACT_INFOTEXT_INFO', 'Será exibido acima dos dados de contato.');
define('DFCONTACT_FORMTEXT', 'Texto do formulário');
define('DFCONTACT_FORMTEXT_INFO', 'Será exibido acima do formulário de contato.');
define('DFCONTACT_BUTTONTEXT', 'Texto do botão');
define('DFCONTACT_BUTTONTEXT_INFO', 'Texto alternativo para o botão \'submit\'.');
define('DFCONTACT_LANGUAGE', 'Idioma');
define('DFCONTACT_ADDRESSSTYLE', 'Estilo do endereço');
define('DFCONTACT_ADDRESSSTYLE_INFO', 'Formato local de exibição do endereço.');
define('DFCONTACT_CLICKABLELINKS', 'Links clicáveis');
define('DFCONTACT_CLICKABLELINKS_INFO', 'Links clicáveis são confortáveis, mas permitem email-harvesting.');
define('DFCONTACT_HTMLMAILS', 'Emails HTML');
define('DFCONTACT_HTMLMAILS_INFO', 'Envia emails em formato HTML.');
define('DFCONTACT_ADDSERVERDATA', 'Adicionar dados do servidor');
define('DFCONTACT_ADDSERVERDATA_INFO', 'Adiciona informações sobre o navegador, sistema operacional e IP do usuário (usuário não verá esses dados).');
define('DFCONTACT_DISPLAYUSERINPUT', 'Exibir dados inseridos pelo usuário:');
define('DFCONTACT_DISPLAYUSERINPUT_INFO', 'Depois de enviar o e-mail, dados resumidos serão exibidos ao usuário.');

// Tab: Your data
define('DFCONTACT_TAB_YOUR_DATA', 'Seus dados');
define('DFCONTACT_TAB_YOUR_DATA_INFO', 'Insira os dados a serem exibidos na página de contato.');
define('DFCONTACT_COMPANY', 'Empresa');
define('DFCONTACT_TITLE', 'Título');
define('DFCONTACT_NAME', 'Nome');
define('DFCONTACT_POSITION', 'Posição');
define('DFCONTACT_STREET', 'Rua');
define('DFCONTACT_POSTBOX', 'Caixa Postal');
define('DFCONTACT_ZIP', 'CEP');
define('DFCONTACT_CITY', 'Cidade');
define('DFCONTACT_STATE', 'Estado');
define('DFCONTACT_COUNTRY', 'País');
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
define('DFCONTACT_CHECKBOX_INFO', 'Exibe uma checkbox abaixo da mensagem. Deixando-a como obrigatória o usuário será forçado a marcá-la.');
define('DFCONTACT_CHECKBOX_TEXT', 'Texto da checkbox');
define('DFCONTACT_CHECKBOX_TEXT_INFO', 'Será exibido ao lado da checkbox.');

// Tab: Form data
define('DFCONTACT_TAB_FORM_FIELDS', 'Campos');
define('DFCONTACT_HIDE', 'Esconder');
define('DFCONTACT_SHOW', 'Exibir');
define('DFCONTACT_OPTIONAL', 'Opcional');
define('DFCONTACT_DUTY', 'Obrigatório');
define('DFCONTACT_TAB_FORM_FIELDS_INFO', 'Escolha os campos que serão exibidos no formulário de contato e defina quais são obrigatórios.');

// Tab: About
define('DFCONTACT_TAB_ABOUT', 'Sobre');
define('DFCONTACT_ABOUT_VERSION', 'Versão');
define('DFCONTACT_ABOUT_PROGRAM', 'Programa');
define('DFCONTACT_ABOUT_PROGRAM_INFO', 'DFContact é um componente de formulário de contato que é extremamente fácil de configurar. Exibe informações de contato e um formulário de contato na mesma página. Os campos disponíveis para o formulários podem ser definidos como opcionais ou obrigatórios. Se você tem alguma idéia para extender esse componente ou encontrou algum bug, por favor contate o autor.');
define('DFCONTACT_ABOUT_AUTHOR', 'Autor');
define('DFCONTACT_ABOUT_AUTHOR_INFO', 'Daniel Filzhut, Filzhut.de, Germany<br /><a href="mailto:joomla@filzhut.de">joomla@filzhut.de</a><br /><a href="http://software.filzhut.de" target="_blank">http://software.filzhut.de</a>/<a href="http://www.filzhut.de" target="_blank">http://www.filzhut.de</a>');
define('DFCONTACT_ABOUT_WARRANTY', 'Garantia');
define('DFCONTACT_ABOUT_WARRANTY_INFO', 'Este programa é distribuído sob a licença GNU General Public License (GPL) na esperança de que seja útil, mas SEM NENHUMA GARANTIA; inclusive sem a garantia de COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO.');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE', 'Modification-Service');
define('DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO', 'Do you need modifications on this component and have no idea how to do this? Please contact <a href="mailto:joomla@filzhut.de?Subject=DFContact Official Modification Service">joomla@filzhut.de</a> to receive an offer at a fair rate.');
define('DFCONTACT_ABOUT_SUPPORT_US', 'Support us');
define('DFCONTACT_ABOUT_SUPPORT_US_INFO', 'If you would like to support our work, please feel free to do so by clicking the paypal-button.');

// Frontend
define('DFCONTACT_FORM_MISSING_FIELDS', 'Por favor preencha os seguintes campos:');
define('DFCONTACT_FORM_ENTER_VALID_MAIL', 'Por favor insira um endereço de e-mail válido!');
define('DFCONTACT_FORM_TITLE_MR', 'Sr.');
define('DFCONTACT_FORM_TITLE_MRS', 'Sra.');
define('DFCONTACT_FORM_SUBMIT', 'Enviar');
define('DFCONTACT_FORM_BACK', 'voltar');
define('DFCONTACT_FORM_DATE_FORMAT', 'd/m/Y H:i:s');
define('DFCONTACT_FORM_DATE', 'Data');
define('DFCONTACT_FORM_SENT_URL', 'URL do Formulário');
define('DFCONTACT_FORM_USERAGENT', 'Navegador');
define('DFCONTACT_FORM_HOST', 'Host');
define('DFCONTACT_FORM_IP', 'IP');
define('DFCONTACT_FORM_PORT', 'Porta');
define('DFCONTACT_FORM_MAIL_TEXT', 'Alguém lhe enviou um e-mail usando o formulário em seu website. Abaixo está o que essa pessou escreveu:');
define('DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS', 'As seguintes linhas contém informações que não foram digitadas, mas coletadas pelo servidor.');
define('DFCONTACT_FORM_MAIL_SUBJECT', 'E-mail de contato');
define('DFCONTACT_FORM_MAIL_ERROR', 'Erro: Mensagem não enviada. Por favor tente novamente mais tarde.');
define('DFCONTACT_FORM_MAIL_SUCCESS', 'Mensagem enviada com sucesso.');
define('DFCONTACT_FORM_MAIL_SUBMITTED_VARS', 'Os seguintes dados foram enviados:');

// Captcha
define('DFCONTACT_CAPTCHA', 'Teste de Turing');
define('DFCONTACT_CAPTCHA_FORM_INFO', 'Insira as letras e numeros da imagem no campo seguinte. Se tiver dificuldade em ler algum clique no botão ao lado da imagem para muda-la.');
define('DFCONTACT_CAPTCHA_ERROR', 'Teste com código inválido!');
define('DFCONTACT_CAPTCHA_INFO', 'Mostra uma imagem com caracteres como parte do formulário. O internauta tem que inserir os caracteres no campo separado de modo a provar que é um humano. Isto deve impedir spambots de usar o formulário para enviar spam.<br /><b>Só funciona se tiver o componente <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,1211/Itemid,35/" target="_blank">com_securityimages</a> instalado(Versão >= 4.0).</b>');

// Destination-Mail-Notice
define('DFCAPTCHA_FORM_NO_DESTINATION_MAIL', 'ERROR: Não foi defenido nenhum email de destino, faça login na area de administração e defina um.');

?>
