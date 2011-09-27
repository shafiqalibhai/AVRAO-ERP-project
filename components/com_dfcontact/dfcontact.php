<?php
/**
* DFContact - A Joomla! contact form component
* @version 1.0.3
* @package DFContact
* @copyright (C) 2005 by Daniel Filzhut
* @license Released under the terms of the GNU General Public License
**/

# Don't allow direct linking
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

# Load variables
require( $mosConfig_absolute_path . "/administrator/components/com_dfcontact/config.dfcontact.php" );

# Load active language
include( $mosConfig_absolute_path . "/administrator/components/com_dfcontact/languages/" . ( !empty( $dfcontact["language"] ) ? $dfcontact["language"] : "english" ) . ".php" );

# Display title
echo ( !empty( $dfcontact["pageTitle"] ) ? "<div class=\"componentheading\">" . $dfcontact["pageTitle"] . "</div>\n" : "" );

# Start content
echo "<div class=\"contentpane\">\n";

# Check existance of destination mail
if ( empty( $dfcontact["destinationMail"] ) ) {
	echo "<p>" . DFCAPTCHA_FORM_NO_DESTINATION_MAIL . "</p>\n";
}
# Start sending process if there is data
else if ( !empty( $_REQUEST["submit"] ) ) {

	// create backlink
	$backlink = "<form action=\"\" method=\"post\">\n";

	$dfcontact["field"] = ( !empty( $dfcontact["field"] ) && is_array( $dfcontact["field"] ) ? $dfcontact["field"] : array() );
	reset( $dfcontact["field"] );
	while ( list( $key, $value ) = each( $dfcontact["field"] ) ) {
		if ( empty( $value["display"] ) ) {
			continue;
		}
		$backlink .= "<input type=\"hidden\" name=\"" . htmlentities( stripslashes( $key ) ) . "\" value=\"" . ( !empty( $_REQUEST[$key] ) ? htmlentities( stripslashes( $_REQUEST[$key] ) ) : "" ) . "\" />\n";
	}
	$backlink .= "<input type=\"hidden\" name=\"checkbox\" value=\"" . ( !empty( $_REQUEST["checkbox"] ) ? htmlentities( stripslashes( $_REQUEST["checkbox"] ) ) : "" ) . "\" />\n";
	$backlink .= "<input type=\"hidden\" name=\"message\" value=\"" . ( !empty( $_REQUEST["message"] ) ? htmlentities( stripslashes( $_REQUEST["message"] ) ) : "" ). "\" />\n";
	$backlink .= "<input type=\"hidden\" name=\"submit\" value=\"\" />\n";
	$backlink .= "<input type=\"submit\" value=\"<< " . DFCONTACT_FORM_BACK . "\" class=\"button\" />\n";
	$backlink .= "</form>\n";

	# check for neccessary vars
	$missingFields = "";
	$dfcontact["field"] = ( !empty( $dfcontact["field"] ) && is_array( $dfcontact["field"] ) ? $dfcontact["field"] : array() );
	reset( $dfcontact["field"] );
	while ( list( $key, $value ) = each ( $dfcontact["field"] )) {
		if ( !empty( $value["display"] ) && !empty( $value["duty"] ) && empty( $_REQUEST[$key] ) ) {
			$missingFields .= "<li>" . constant( "DFCONTACT_" . strtoupper( $key ) ) . "</li>\n";
		}
	}

	# captcha
	if ($dfcontact['captcha'] && file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php')) {
		include($mosConfig_absolute_path . '/administrator/components/com_securityimages/client.php');
		$securityimage_refid		= mosGetParam( $_POST, 'securityimage_dfcontact_refid', '' );
		$securityimage_try			= mosGetParam( $_POST, 'securityimage_dfcontact_try', '' );
		$securityimage_reload		= mosGetParam( $_POST, 'securityimage_dfcontact_reload', '' );         
		include_once ($mosConfig_absolute_path . '/administrator/components/com_securityimages/server.php');
		if (!checkSecurityImage($securityimage_refid, $securityimage_try, $securityimage_reload)) {
			$missingFields .= "<li>" . DFCONTACT_CAPTCHA_ERROR . "</li>\n";			
		}
	}

	if ( $missingFields ) {
		echo "<p>" . DFCONTACT_FORM_MISSING_FIELDS . "</p>\n";
		echo "<ul>\n$missingFields</ul>\n";
		echo $backlink;
	} elseif ( !empty( $_REQUEST["email"] ) && !dfcontact_validMail( $_REQUEST["email"] ) ) {
		echo "<p>" . DFCONTACT_FORM_ENTER_VALID_MAIL . "</p>\n";
		echo $backlink;
	} else {

		# create html with user vars
		$sentVars = "<table border=\"0\">";
		$dfcontact["field"] = ( !empty( $dfcontact["field"] ) && is_array( $dfcontact["field"] ) ? $dfcontact["field"] : array() );
		reset( $dfcontact["field"] );
		while( list( $key, $value ) = each( $dfcontact["field"] )) {
			if ( empty( $value["display"] ) || ( empty( $_REQUEST[$key] ) && $key != "checkbox" ) ) {
				continue;
			}
			$sentVars .= "<tr>";
			$sentVars .= "<th valign=\"top\" align=\"left\">" . constant( "DFCONTACT_" . strtoupper( $key ) ) . ":</th>\n";
			$sentVars .= "<td valign=\"top\">" . nl2br( htmlentities( stripslashes( $key == "checkbox" ? ( !empty( $_REQUEST[$key] ) && $_REQUEST[$key] ? DFCONTACT_YES : DFCONTACT_NO ) : ( !empty( $_REQUEST[$key]) ? $_REQUEST[$key] : "" ) ) ) ) . "</td>\n";
			$sentVars .= "</tr>\n";
		}
		$sentVars .= "</table>";

		# create html with server vars
		$serverVars = array(
			DFCONTACT_FORM_DATE 		=> date( DFCONTACT_FORM_DATE_FORMAT ),
			DFCONTACT_FORM_SENT_URL 	=>  "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'],
			DFCONTACT_FORM_USERAGENT	=> $_SERVER['HTTP_USER_AGENT'],
			DFCONTACT_FORM_HOST		=> ($_SERVER['REMOTE_NAME'] ? $_SERVER['REMOTE_NAME'] : @gethostbyaddr( $_SERVER['REMOTE_ADDR'] )),
			DFCONTACT_FORM_IP 		=> $_SERVER['REMOTE_ADDR'],
			DFCONTACT_FORM_PORT		=> $_SERVER['REMOTE_PORT'],
		);
		$sentVarsHidden = "<table border=\"0\">";
		reset( $serverVars );
		while( list( $key, $value ) = each( $serverVars ) ) {
			$sentVarsHidden .= "<tr>";
			$sentVarsHidden .= "<th valign=\"top\" align=\"left\">" . ucfirst( nl2br( htmlentities( stripslashes( $key ) ) ) ) . ":</th>\n";
			$sentVarsHidden .= "<td valign=\"top\">" . nl2br( htmlentities( stripslashes( $value ) ) ) . "</td>\n";
			$sentVarsHidden .= "</tr>\n";
		}
		$sentVarsHidden .= "</table>";

		# create email
		$html .= "<p>" . DFCONTACT_FORM_MAIL_TEXT . "</p>\n\n";
		$html .= "$sentVars\n";

		if ( !empty( $dfcontact["addServerData"] ) ) {
			$html .= "<p style=\"margin-top:2em;\">" . DFCONTACT_FORM_MAIL_TEXT_SERVER_VARS . "</p>\n\n";
			$html .= "$sentVarsHidden\n";
		}

		$name = preg_replace("/[\r\n\t\f]/", "", ( !empty( $_REQUEST["name"] ) ? $_REQUEST["name"] : "" ) );
		$email = preg_replace("/[\r\n\t\f]/", "", ( !empty( $_REQUEST["email"] ) ? $_REQUEST["email"] : "" ) );

		$header = "";
		$header .= "From: " . ($name && $email ? "$name <$email>" : ( $email ? $email : $name ) ) . "\n";

		$boundary = "dfcboundary=-7373197542-2312-323";
		$header .= "MIME-Version: 1.0\n";
		$header .= ( !empty( $dfcontact["htmlMails"] ) ? "Content-Type: multipart/alternative; boundary=\"$boundary\"\n" : "Content-Type: text/plain\n");

		if ( !empty( $dfcontact["htmlMails"] ) ) {
			$body = "";
			$body .= "This is a multi-part message in MIME format.\n";
			$body .= "\n--" . $boundary . "\n";
			$body .= "Content-Type: text/plain\n";
			$body .= "\n";
			$body .= ( function_exists( "html_entity_decode") ? html_entity_decode( strip_tags( $html ) ) : strip_tags( $html ) );
			$body .= "\n--" . $boundary . "\n";
			$body .= "Content-Type: text/html\n";
			$body .= "\n";
			$body .= "<html>\n<style type=\"text/css\">\nbody,td,th,p{font-family:verdana;font-size:12px;}\n</style>\n<body>";
			$body .= $html;
			$body .= "</body>\n</html>";
			$body .= "\n--" . $boundary . "--\n";
		} else {
			$body = strip_tags( $html );
		}

		$to = ( !empty( $dfcontact["destinationMail"] ) ? $dfcontact["destinationMail"] : "" );
		$subject = ( function_exists( "html_entity_decode") ? html_entity_decode( DFCONTACT_FORM_MAIL_SUBJECT ) : DFCONTACT_FORM_MAIL_SUBJECT ) . " (" . preg_replace("/[\r\n\t\f]/", "", $_SERVER['SERVER_NAME']) . ")";

		# Try to send email and display result
		if ( !@mail( $to, $subject, $body, $header ) ) {
			echo "<p>" . DFCONTACT_FORM_MAIL_ERROR . "</p>\n";
			echo $backlink;
		} else {
			echo "<p>" . DFCONTACT_FORM_MAIL_SUCCESS .  "</p>\n";
			if ( !empty( $dfcontact["displayUserInput"] ) ) {
				echo "<p>" . DFCONTACT_FORM_MAIL_SUBMITTED_VARS . "</p>\n";
				echo $sentVars;
			}
		}
	}
} else {


	// info text
	echo ( !empty( $dfcontact["infoText"] ) ? "<p>" . $dfcontact["infoText"] . "</p>" : "" );

	echo "<p style=\"margin-left:7em;\">\n";

	// basic address data
	echo ( !empty( $dfcontact["field"]["title"]["value"] ) ? $dfcontact["field"]["title"]["value"] . " " : "" );
	echo ( !empty( $dfcontact["field"]["name"]["value"] ) ? $dfcontact["field"]["name"]["value"] . "<br />" : "" );
	echo ( !empty( $dfcontact["field"]["position"]["value"] ) ? $dfcontact["field"]["position"]["value"] . "<br />" : "" );
	echo ( !empty( $dfcontact["field"]["company"]["value"] ) ? $dfcontact["field"]["company"]["value"] . "<br />" : "" );
	echo ( !empty( $dfcontact["field"]["street"]["value"] ) ? $dfcontact["field"]["street"]["value"] . "<br />" : "" );
	echo ( !empty( $dfcontact["field"]["postbox"]["value"] ) ? $dfcontact["field"]["postbox"]["value"] . "<br />" : "" );


	// international differences
	switch ( $dfcontact["addressStyle"] ) {

		case "us":
			echo ( !empty( $dfcontact["field"]["city"]["value"] ) ? $dfcontact["field"]["city"]["value"] : "");
			echo ( !empty( $dfcontact["field"]["city"]["value"] ) && !empty( $dfcontact["field"]["state"]["value"] ) ? ", " : "");
			echo ( !empty( $dfcontact["field"]["state"]["value"] ) ? $dfcontact["field"]["state"]["value"] : "" );
			echo ( !empty( $dfcontact["field"]["zip"]["value"] ) && ( !empty( $dfcontact["field"]["city"]["value"] ) ||  !empty( $dfcontact["field"]["state"]["value"] ) ) ? " " : "");
			echo ( !empty( $dfcontact["field"]["zip"]["value"] ) ? $dfcontact["field"]["zip"]["value"] : "");
			echo ( !empty( $dfcontact["field"]["city"]["value"] ) || !empty( $dfcontact["field"]["state"]["value"] ) || !empty( $dfcontact["field"]["zip"]["value"] ) ? "<br />" : "");
			echo ( !empty( $dfcontact["field"]["country"]["value"] ) ? $dfcontact["field"]["country"]["value"] . "<br />" : "");
		break;

		case "uk":
			echo ( !empty( $dfcontact["field"]["city"]["value"] ) ? $dfcontact["field"]["city"]["value"] . "<br />" : "");
			echo ( !empty( $dfcontact["field"]["state"]["value"] ) ? $dfcontact["field"]["state"]["value"] . "<br />" : "");
			echo ( !empty( $dfcontact["field"]["zip"]["value"] ) ? $dfcontact["field"]["zip"]["value"] . "<br />" : "");
			echo ( !empty( $dfcontact["field"]["country"]["value"] ) ? $dfcontact["field"]["country"]["value"] . "<br />" : "");
		break;

		default:
			echo ( !empty( $dfcontact["field"]["zip"]["value"] ) ? $dfcontact["field"]["zip"]["value"] : "");
			echo ( !empty( $dfcontact["field"]["zip"]["value"] ) && !empty( $dfcontact["field"]["city"]["value"] ) ? " " : "");
			echo ( !empty( $dfcontact["field"]["city"]["value"] ) ? $dfcontact["field"]["city"]["value"] : "");
			echo ( !empty( $dfcontact["field"]["zip"]["value"] ) || !empty( $dfcontact["field"]["city"]["value"] ) ? "<br />" : "");
			echo ( !empty( $dfcontact["field"]["state"]["value"] ) ? $dfcontact["field"]["state"]["value"] : "");
			echo ( !empty( $dfcontact["field"]["state"]["value"] ) && !empty( $dfcontact["field"]["country"]["value"] ) ? ", " : "");
			echo ( !empty( $dfcontact["field"]["country"]["value"] ) ? $dfcontact["field"]["country"]["value"] : "");
			echo ( !empty( $dfcontact["field"]["state"]["value"] ) || !empty( $dfcontact["field"]["country"]["value"] ) ? "<br />" : "");
		break;

	}

	echo "</p>\n";

	// phone & mail
	if ( !empty( $dfcontact["field"]["phone"]["value"] ) || !empty( $dfcontact["field"]["mobile"]["value"] ) || !empty( $dfcontact["field"]["fax"]["value"] ) || !empty( $dfcontact["field"]["email"]["value"] ) ) {

		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
		echo "<colgroup>\n";
		echo "<col style=\"width:7em;\" />\n";
		echo "<col />\n";
		echo "</colgroup>\n";

		if ( !empty( $dfcontact["field"]["phone"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_PHONE . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . $dfcontact["field"]["phone"]["value"] . "</td>\n";
			echo "</tr>\n";
		}

		if ( !empty( $dfcontact["field"]["mobile"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_MOBILE . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . $dfcontact["field"]["mobile"]["value"] . "</td>\n";
			echo "</tr>\n";
		}

		if ( !empty( $dfcontact["field"]["fax"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_FAX . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . $dfcontact["field"]["fax"]["value"] . "</td>\n";
			echo "</tr>\n";
		}

		if ( !empty( $dfcontact["field"]["email"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_EMAIL . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . ( !empty( $dfcontact["links"] ) ?  "<a href=\"mailto:" . $dfcontact["field"]["email"]["value"] . "\">" . dfcontact_asciiEncodeString( $dfcontact["field"]["email"]["value"] ) . "</a>" : dfcontact_asciiEncodeString( $dfcontact["field"]["email"]["value"] ) ) . "</td>\n";
			echo "</tr>\n";
		}

		echo "</table>\n";

	}


	// messenger
	if ( !empty( $dfcontact["field"]["aim"]["value"] ) || !empty( $dfcontact["field"]["icq"]["value"] ) || !empty( $dfcontact["field"]["yahoo"]["value"] )  || !empty( $dfcontact["field"]["msn"]["email"] ) ) {

		echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
		echo "<colgroup>\n";
		echo "<col style=\"width:7em;\" />";
		echo "<col />";
		echo "</colgroup>\n";

		if ( !empty( $dfcontact["field"]["icq"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_ICQ . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . ( !empty( $dfcontact["links"] ) ? "<a href=\"http://web.icq.com/whitepages/message_me?uin=" . $dfcontact["field"]["icq"]["value"] . "&action=message\">" . dfcontact_asciiEncodeString( $dfcontact["field"]["icq"]["value"] ) . "</a>" : dfcontact_asciiEncodeString( $dfcontact["field"]["icq"]["value"] ) ) . "</td>\n";
			echo "</tr>\n";
		}

		if ( !empty( $dfcontact["field"]["aim"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_AIM . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . ( !empty( $dfcontact["links"] ) ? "<a href=\"aim:goim?screenname=" . $dfcontact["field"]["aim"]["value"] . "&message\">" . dfcontact_asciiEncodeString( $dfcontact["field"]["aim"]["value"] ) . "</a>" : dfcontact_asciiEncodeString( $dfcontact["field"]["aim"]["value"] ) ) . "</td>\n";
			echo "</tr>\n";
		}

		if ( !empty( $dfcontact["field"]["yahoo"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_YAHOO . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . dfcontact_asciiEncodeString( $dfcontact["field"]["yahoo"]["value"] ) . "</td>\n";
			echo "</tr>\n";
		}

		if ( !empty( $dfcontact["field"]["msn"]["value"] ) ) {
			echo "<tr>\n";
			echo "<th valign=\"top\" align=\"left\">" . DFCONTACT_MSN . ": </th>\n";
			echo "<td valign=\"top\" align=\"left\">" . dfcontact_asciiEncodeString( $dfcontact["field"]["msn"]["value"] ) . "</td>\n";
			echo "</tr>\n";
		}

		echo "</table>\n";

	}

	echo "<div style=\"height:2em;\"></div>\n";



	// form text
	echo ( !empty( $dfcontact["formText"] ) ? "<p style=\"margin-top:1em;\">" . $dfcontact["formText"] . "</p>" : "" );

	// javascript to check input
	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	#echo "<![CDATA[\n";
	echo "function dfcontact_checkForm() {\n";
	echo "  var missingFields = '';\n";
	echo "  var firstObject = '';\n";
	$dfcontact["field"] = ( !empty( $dfcontact["field"] ) && is_array( $dfcontact["field"] ) ? $dfcontact["field"] : array() );
	reset( $dfcontact["field"] );
	while ( list( $key, $value ) = each ( $dfcontact["field"] )) {
		if ( !empty( $value["display"] ) && !empty( $value["duty"] ) ) {
			echo "  if ( ( document.dfContactForm.$key.type == 'text' && document.dfContactForm.$key.value == \"\" ) || ( document.dfContactForm.$key.type == 'textarea' && document.dfContactForm.$key.value == \"\" ) || ( document.dfContactForm.$key.type == 'checkbox' && !document.dfContactForm.$key.checked ) ) {\n";
			echo "    missingFields += '- " . ( function_exists( "html_entity_decode") ? str_replace( "+", " ", urlencode( html_entity_decode( constant( "DFCONTACT_" . strtoupper( $key ) ) ) ) ) : constant( "DFCONTACT_" . strtoupper( $key ) ) ) . "\\n';\n";
			echo "    if ( firstObject == \"\" ) {\n";
			echo "      firstObject = document.dfContactForm.$key;\n";
			echo "    }\n";
			echo "  }\n";
		}
	}
	
	// Captcha
	if ($dfcontact['captcha'] && file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php')) {
		echo "  if ( document.dfContactForm.securityimage_dfcontact_try && document.dfContactForm.securityimage_dfcontact_try.value == \"\") {\n";
		echo "    missingFields += '- " . ( function_exists( "html_entity_decode") ? str_replace( "+", " ", urlencode( html_entity_decode( DFCONTACT_CAPTCHA ) ) ) : DFCONTACT_CAPTCHA ) . "\\n';\n";
		echo "    if ( firstObject == \"\" ) {\n";
		echo "      firstObject = document.dfContactForm.securityimage_dfcontact_try;\n";
		echo "    }\n";
		echo "  }\n";
	}
	
	echo "  if ( missingFields ) {\n";
	echo "    alert( unescape( '" . ( function_exists( "html_entity_decode") ? str_replace( "+", " ", urlencode( html_entity_decode( DFCONTACT_FORM_MISSING_FIELDS ) ) ) : DFCONTACT_FORM_MISSING_FIELDS ) . "\\n' + missingFields ) );\n";
	echo "    firstObject.focus();\n";
	echo "    return false;\n";
	echo "  } else {\n";
	if ( !empty( $dfcontact["field"]["email"]["display"] ) ) {
		echo "    if ( document.dfContactForm.email.value && !validMail( document.dfContactForm.email.value ) ) {\n";
		echo "      alert( unescape( '" . ( function_exists( "html_entity_decode") ? str_replace( "+", " ", urlencode( html_entity_decode( DFCONTACT_FORM_ENTER_VALID_MAIL ) ) ) : DFCONTACT_FORM_ENTER_VALID_MAIL ) . "' ) );\n";
		echo "      document.dfContactForm.email.focus();\n";
		echo "      return false;\n";
		echo "    } else {\n";
		echo "      return true;\n";
		echo "    }\n";
	} else {
		echo "    return true;\n";
	}
	echo "  }\n";
	echo "}\n";
	echo "function validMail(s) {\n";
	echo "  var a = false;\n";
	echo "  var res = false;\n";
	echo "  if ( typeof( RegExp ) == 'function') {\n";
	echo "    var b = new RegExp( 'abc' );\n";
	echo "    if ( b.test( 'abc' ) == true ) {\n";
	echo "      a = true;\n";
	echo "    }\n";
	echo "  }\n";
	echo "  if ( a == true ) {\n";
	echo "    reg = new RegExp( '^([a-zA-Z0-9\\-\\.\\_]+)' +\n";
	echo "                   '(\\@)([a-zA-Z0-9\\-\\.ÄäÜüÖö]{2,255})' +\n";
	echo "                   '(\\.)([a-zA-Z]{2,6})$' );\n";
	echo "    res = ( reg.test( s ) );\n";
	echo "  } else {\n";
	echo "    res = ( s.search( '@' ) >= 1 &&\n";
	echo "    s.lastIndexOf( '.' ) > s.search( '@' ) &&\n";
	echo "    s.lastIndexOf( '.' ) >= s.length - 5 )\n";
	echo "  }\n";
	echo "  return( res );\n";
	echo "}\n";
	#echo "]]>\n";
	echo "//-->\n";
	echo "</script>\n";


	// contact form
	echo "<form action=\"\" method=\"post\" onsubmit=\"return dfcontact_checkForm();\" id=\"dfContactForm\" name=\"dfContactForm\">\n";
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
	echo "<colgroup>\n";
	echo "<col style=\"width:7em;\" />\n";
	echo "<col />\n";
	echo "</colgroup>\n";

	// basic fields
	if ( !empty( $dfcontact["field"]["title"]["display"] ) ) {
		echo "<tr>\n";
		echo "<td>" . DFCONTACT_TITLE . ":</td>\n";
		echo "<td><select name=\"title\"><option" . ( !empty( $_REQUEST["title"] ) && $_REQUEST["title"] == DFCONTACT_FORM_TITLE_MR ? " selected=\"selected\"" : "" ) . ">" . DFCONTACT_FORM_TITLE_MR . "</option><option" . ( !empty( $_REQUEST["title"] ) && $_REQUEST["title"] == DFCONTACT_FORM_TITLE_MRS ? " selected=\"selected\"" : "" ) . ">" . DFCONTACT_FORM_TITLE_MRS . "</option></select></td>\n";
		echo "</tr>\n";
	}
	$fields = array(
		"name",
		"position",
		"company",
		"street",
		"postbox",
	);
	echo dfcontact_inputRows( $fields );

	// internation differences
	switch ( $dfcontact["addressStyle"] ) {
	
		case "us":
			$fields = array(
				"city",
				"state",
				"zip",
				"country",
			);
			echo dfcontact_inputRows( $fields );
		break;

		case "uk":
			$fields = array(
				"city",
				"state",
				"zip",
				"country",
			);
			echo dfcontact_inputRows( $fields );
		break;

		default:
			if ( !empty( $dfcontact["field"]["zip"]["display"] ) && !empty( $dfcontact["field"]["city"]["display"] ) ) {
				echo "<tr>\n";
				echo "<td>" . DFCONTACT_ZIP . "/" . DFCONTACT_CITY . ":</td>\n";
				echo "<td><input type=\"text\" class=\"inputbox\" style=\"width:3em;\" name=\"zip\" value=\"" . ( !empty( $_REQUEST["zip"] ) ? htmlentities( stripslashes( $_REQUEST["zip"] ) ) : "")  . "\" /><input type=\"text\" class=\"inputbox\" style=\"width:11.6em;\" name=\"city\" value=\"" . ( !empty( $_REQUEST["city"] ) ? htmlentities( stripslashes( $_REQUEST["city"] ) ) : "" ) . "\" />" . ( !empty( $dfcontact["field"]["zip"]["duty"] ) || !empty( $dfcontact["field"]["city"]["duty"] ) ? "*" : "") . "</td>\n";
				echo "</tr>\n";
			} else {
				$fields = array(
					"zip",
					"city",
				);
				echo dfcontact_inputRows( $fields );
			}
			$fields = array(
				"country",
				"state",
			);
			echo dfcontact_inputRows( $fields );
		break;

	}
	echo "<tr>\n";
	echo "<td style=\"height:1em;\"></td>\n";
	echo "</tr>\n";

	// phone & mail
	$fields = array(
		"phone",
		"mobile",
		"fax",
		"email",
	);
	echo dfcontact_inputRows( $fields );
	echo "<tr>\n";
	echo "<td style=\"height:1em;\"></td>\n";
	echo "</tr>\n";

	// messenger
	$fields = array(
		"icq",
		"aim",
		"yahoo",
		"msn",
	);
	echo dfcontact_inputRows( $fields );
	echo "<tr>\n";
	echo "<td style=\"height:1em;\"></td>\n";
	echo "</tr>\n";

	// message
	if ( !empty( $dfcontact["field"]["message"]["display"] ) ) {
		echo "<tr>\n";
		echo "<td colspan=\"2\" valign=\"top\"><textarea name=\"message\" class=\"inputbox\" cols=\"40\" rows=\"5\">" . ( !empty( $_REQUEST["message"] ) ? htmlentities( stripslashes( $_REQUEST["message"] ) ) : "" ) . "</textarea>" . ( !empty( $dfcontact["field"]["message"]["duty"] ) ? "*" : "") . "</td>\n";
		echo "</tr>\n";
	}

	// checkbox
	if ( !empty( $dfcontact["field"]["checkbox"]["display"] ) ) {
		echo "<tr>\n";
		echo "<td colspan=\"2\"><input type=\"checkbox\" name=\"checkbox\"" . ( !empty( $_REQUEST["checkbox"] ) ? " checked=\"checked\"" : "" ) . " /> " . ( !empty( $dfcontact["field"]["checkbox"]["text"] ) ? $dfcontact["field"]["checkbox"]["text"] : "" ) . ( !empty( $dfcontact["field"]["checkbox"]["duty"] ) ? " *" : "") . "</td>\n";
		echo "</tr>\n";
	}

	// Captcha
	if ($dfcontact['captcha'] && file_exists($mosConfig_absolute_path.'/administrator/components/com_securityimages/client.php')) {
		include($mosConfig_absolute_path . '/administrator/components/com_securityimages/client.php');
		$packageName = 'securityimage_dfcontact';
		echo "<tr>\n";
		echo "<td style=\"height:1em;\"></td>\n";
		echo "</tr>\n";
	 	echo "<tr>\n";
	 	echo "<td valign=\"top\">" . DFCONTACT_CAPTCHA . ":</td>\n";
	 	echo "<td valign=\"top\"><p>" . DFCONTACT_CAPTCHA_FORM_INFO . "</p><br />" . insertSecurityImage($packageName) . "<br/>" . getSecurityImageField($packageName) . "</td>\n";
	 	echo "</tr>\n";
	}

	// submit button & form end
	echo "<tr>\n";
	echo "<td colspan=\"2\" style=\"" . ( !empty( $dfcontact["field"]["message"]["display"] ) || !empty( $dfcontact["field"]["checkbox"]["display"] ) ? "padding-top:2em;" : "") . "text-align:center;\"><input type=\"submit\" value=\"" . ( !empty( $dfcontact["buttonText"] ) ? $dfcontact["buttonText"] : DFCONTACT_FORM_SUBMIT ) . "\" class=\"button\" /></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "<input type=\"hidden\" name=\"submit\" value=\"true\" />\n";
	echo "</form>\n";

}


# End content
echo "\n</div>\n";









/**
 * Returns input rows.
 *
 * @static
 * @access	public
 * @param	array	$array
 * @return	string
 * @date	14:16 13.10.2005
 * @version	1.0
 * @status	Complete
 */
function dfcontact_inputRows( $array ) {

	global $dfcontact;

	$result = "";

	for ( $i = 0; $i < sizeof( $array ); $i++ ) {
		if ( empty( $dfcontact["field"][$array[$i]]["display"] ) ) {
			continue;
		}
		$result .= "<tr>\n";
		$result .= "<td>" . constant( "DFCONTACT_" . strtoupper( $array[$i] ) ) . ":</td>\n";
		$result .= "<td><input type=\"text\" class=\"inputbox\" style=\"width:15em;\" name=\"" . $array[$i] . "\" value=\"" . ( !empty( $_REQUEST[$array[$i]] ) ? htmlentities( stripslashes( $_REQUEST[$array[$i]] ) ) : "" ) . "\" />" . ( !empty( $dfcontact["field"][$array[$i]]["duty"] ) ? "*" : "") . "</td>\n";
		$result .= "</tr>\n";
	}

	return $result;
}



/**
 * Encodes a string into it's asci-entities.
 *
 * @static
 * @access	public
 * @param	string	$string
 * @return	string
 * @date	13:42 13.10.2005
 * @version	1.0
 * @status	Complete
 */
function dfcontact_asciiEncodeString( $string ) {

	$result = "";

	for ( $i = 0; $i < strlen( $string ); $i++ ) {
		$result .= "&#" . ord( $string[$i] ) . ";";
	}

	return $result;
}



/**
 * Returns whether an email-adress or
 * a list of comma-separated email-adresses
 * is valid and has a valid tld (optional).
 *
 * @static
 * @access	public
 * @param	string	$eMail		eMail
 * @param	boolean $checkTLD 	Check TLD-Validity?
 * @return	boolean
 * @date	16:20 01.07.2005
 * @version	1.0
 * @status	Complete
 */
function dfcontact_validMail($eMail, $checkTLD = false) {

	# list taken from: http://data.iana.org/TLD/tlds-alpha-by-domain.txt
	# Version 1.2, Last Updated 2005-04-29
	$tlds = array("AC", "AD", "AE", "AERO", "AF", "AG", "AI", "AL", "AM", "AN", "AO", "AQ", "AR", "ARPA", "AS", "AT", "AU", "AW", "AZ", "BA", "BB", "BD", "BE", "BF", "BG", "BH", "BI", "BIZ", "BJ", "BM", "BN", "BO", "BR", "BS", "BT", "BV", "BW", "BY", "BZ", "CA", "CC", "CD", "CF", "CG", "CH", "CI", "CK", "CL", "CM", "CN", "CO", "COM", "COOP", "CR", "CU", "CV", "CX", "CY", "CZ", "DE", "DJ", "DK", "DM", "DO", "DZ", "EC", "EDU", "EE", "EG", "ER", "ES", "ET", "EU", "FI", "FJ", "FK", "FM", "FO", "FR", "GA", "GB", "GD", "GE", "GF", "GG", "GH", "GI", "GL", "GM", "GN", "GOV", "GP", "GQ", "GR", "GS", "GT", "GU", "GW", "GY", "HK", "HM", "HN", "HR", "HT", "HU", "ID", "IE", "IL", "IM", "IN", "INFO", "INT", "IO", "IQ", "IR", "IS", "IT", "JE", "JM", "JO", "JP", "KE", "KG", "KH", "KI", "KM", "KN", "KR", "KW", "KY", "KZ", "LA", "LB", "LC", "LI", "LK", "LR", "LS", "LT", "LU", "LV", "LY", "MA", "MC", "MD", "MG", "MH", "MIL", "MK", "ML", "MM", "MN", "MO", "MP", "MQ", "MR", "MS", "MT", "MU", "MUSEUM", "MV", "MW", "MX", "MY", "MZ", "NA", "NAME", "NC", "NE", "NET", "NF", "NG", "NI", "NL", "NO", "NP", "NR", "NU", "NZ", "OM", "ORG", "PA", "PE", "PF", "PG", "PH", "PK", "PL", "PM", "PN", "PR", "PRO", "PS", "PT", "PW", "PY", "QA", "RE", "RO", "RU", "RW", "SA", "SB", "SC", "SD", "SE", "SG", "SH", "SI", "SJ", "SK", "SL", "SM", "SN", "SO", "SR", "ST", "SU", "SV", "SY", "SZ", "TC", "TD", "TF", "TG", "TH", "TJ", "TK", "TL", "TM", "TN", "TO", "TP", "TR", "TT", "TV", "TW", "TZ", "UA", "UG", "UK", "UM", "US", "UY", "UZ", "VA", "VC", "VE", "VG", "VI", "VN", "VU", "WF", "WS", "YE", "YT", "YU", "ZA", "ZM", "ZW");

	$eMails = split( ",", str_replace( ", ", ",", $eMail ) );

	for ( $i = 0; $i < sizeof( $eMails ); $i++ ) {
		# check format
		if ( !preg_match( "/^([a-zA-Z0-9\\+\\-\\._])+@([a-zA-Z0-9ÄäÜüÖö\\-]{2,255}\\.)+([a-zA-Z]){2,6}$/" , $eMails[$i] ) ) {
			return false;
		}
		# check tld
		if( $checkTLD && !in_array( strtoupper( substr( $eMails[$i], strrpos( $eMails[$i], "." ) + 1 ) ), $tlds ) ) {
			return false;
		}
	}

	return true;

}

?>