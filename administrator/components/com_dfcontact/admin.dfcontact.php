<?php
/**
* DFContact - A Joomla! contact form component
* @version 1.0.3
* @package DFContact
* @copyright (C) 2005 by Daniel Filzhut
* @license Released under the terms of the GNU General Public License
**/

// no direct access
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'admin_html' ) );

switch ($task) {

	case "save":
		save( $option, ( PHP_VERSION >= '4.1' ? $_REQUEST["dfcontact"] : $HTTP_POST_VARS["dfcontact"]) );
		break;

	case "cancel":
		mosRedirect( 'index2.php' );
		break;

	default:
		show( $option );
		break;
}


############################################################################
############################################################################

function show( $option ) {

	global $mosConfig_absolute_path;

	// Load configuration data
	include( $mosConfig_absolute_path . "/administrator/components/com_dfcontact/config.dfcontact.php" );

	// Load active language
	include( $mosConfig_absolute_path . "/administrator/components/com_dfcontact/languages/" . ( !empty( $dfcontact["language"] ) ? $dfcontact["language"] : "english" ) . ".php" );

	// Load languages
	$languages = array();
	$dh = opendir( $mosConfig_absolute_path . "/administrator/components/com_dfcontact/languages/" );
	while( $file = readdir( $dh ) ) {
		if ( $file == "." || $file == ".." || !substr_count( $file, "." ) ) {
			continue;
		}
		$languages[] = substr( $file, 0, strpos( $file, "." ) );
	}
	closedir( $dh );

	// Display configuration tables
	HTML_dfcontact::show( $option, $dfcontact, $languages );

}

function save( $option, $dfcontact ) {

	global $mosConfig_absolute_path;

	// Load active language
	include( $mosConfig_absolute_path . "/administrator/components/com_dfcontact/languages/" . ( !empty( $dfcontact["language"] ) ? $dfcontact["language"] : "english" ) . ".php" );

	// Define config file
	$configFile = $mosConfig_absolute_path . "/administrator/components/com_dfcontact/config.dfcontact.php";

	// Make config file writeable
	@chmod ( $configFile, 0766 );
	if ( !is_writable( $configFile ) ) {
		mosRedirect( "index2.php?option=$option&task=showConfig", DFCONTACT_ERROR . ": " . DFCONTACT_CONFIG_ERROR_FILE_CHMOD );
		break;
	}

	// Create config file contents
	$config = "<?php\n";
	$config .= "\$dfcontact = " . var_export( $dfcontact, TRUE ) . ";\n";
	$config .= "?>";

	// Try to write config file
	if ( $fp = fopen( $configFile, "w" ) ) {
		if ( !fwrite( $fp, $config, strlen( $config ) ) ) {
			mosRedirect( "index2.php?option=$option&task=showConfig", DFCONTACT_ERROR . ": " . DFCONTACT_CONFIG_ERROR_FILE_OPEN );
		}
		fclose( $fp );
	} else {
		mosRedirect( "index2.php?option=$option&task=showConfig", DFCONTACT_ERROR . ": " . DFCONTACT_CONFIG_ERROR_FILE_WRITE );
	}

	mosRedirect( "index2.php?option=$option&task=showConfig", DFCONTACT_CONFIG_SUCCESS );

}

?>