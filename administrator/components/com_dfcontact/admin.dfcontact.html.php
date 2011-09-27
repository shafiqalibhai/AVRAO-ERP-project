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

/**
* @package DFContact
*/
class HTML_dfcontact {

	function show( $option, $dfcontact, $languages ) {
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			submitform( pressbutton );
		}
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo DFCONTACT; ?></th>
		</tr>
		</table>
		<?php
		$tabs = new mosTabs( 0 );
		$tabs->startPane( "dfcontact" );
		$tabs->startTab( DFCONTACT_TAB_GENERAL , "tabGeneral" );
		?>
		<table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminForm">
		<colgroup>
			<col style="width:12em;" />
			<col style="width:24em;" />
			<col />
		</colgroup>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_DESTINATIONMAIL . ":" ?></th>
			<td align="left" valign="top"><input type="text" name="dfcontact[destinationMail]" value="<?php echo ( !empty( $dfcontact["destinationMail"] ) ? htmlentities( $dfcontact["destinationMail"] ) : "" ); ?>"></td>
			<td align="left" valign="top"><?php echo DFCONTACT_DESTINATIONMAIL_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_PAGETITLE . ":" ?></th>
			<td align="left" valign="top"><input type="text" name="dfcontact[pageTitle]" value="<?php echo ( !empty( $dfcontact["pageTitle"] ) ? htmlentities( $dfcontact["pageTitle"] ) : "" ); ?>"></td>
			<td align="left" valign="top"><?php echo DFCONTACT_PAGETITLE_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_INFOTEXT . ":" ?></th>
			<td align="left" valign="top"><textarea class="inputbox" cols="30" rows="4" name="dfcontact[infoText]"><?php echo ( !empty( $dfcontact["infoText"] ) ? htmlentities( $dfcontact["infoText"] ) : "" ); ?></textarea></td>
			<td align="left" valign="top"><?php echo DFCONTACT_INFOTEXT_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_FORMTEXT . ":" ?></th>
			<td align="left" valign="top"><textarea class="inputbox" cols="30" rows="4" name="dfcontact[formText]"><?php echo ( !empty( $dfcontact["formText"] ) ? htmlentities( $dfcontact["formText"] ) : "" ); ?></textarea></td>
			<td align="left" valign="top"><?php echo DFCONTACT_FORMTEXT_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_BUTTONTEXT . ":" ?></th>
			<td align="left" valign="top"><input type="text" name="dfcontact[buttonText]" value="<?php echo ( !empty( $dfcontact["buttonText"] ) ? htmlentities( $dfcontact["buttonText"] ) : "" ); ?>"></td>
			<td align="left" valign="top"><?php echo DFCONTACT_BUTTONTEXT_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_LANGUAGE . ":" ?></th>
			<td align="left" valign="top"><?php
			$options = array();
			$languages = ( is_array( $languages ) ? $languages : array() );
			while( list( $key, $value ) = each( $languages ) ) {
				if ( !$value ) {
					continue;
				}
				$options[] = mosHTML::makeOption( $value, $value );
			}
			$options = mosHTML::selectList( $options, 'dfcontact[language]', 'class="inputbox" size="1"', 'value', 'text', ( !empty( $dfcontact["language"] ) ? htmlentities( $dfcontact["language"] ) : "" ) );
			echo $options;
			?></td>
			<td align="left" valign="top"><?php echo "" ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_ADDRESSSTYLE . ":" ?></th>
			<td align="left" valign="top"><?php
			$options = array();
			$options[] = mosHTML::makeOption( 'de', 'de' );
			$options[] = mosHTML::makeOption( 'fr', 'fr' );
			$options[] = mosHTML::makeOption( 'uk', 'uk' );
			$options[] = mosHTML::makeOption( 'us', 'us' );
			$options = mosHTML::selectList( $options, 'dfcontact[addressStyle]', 'class="inputbox" size="1"', 'value', 'text', ( !empty( $dfcontact["addressStyle"] ) ? htmlentities( $dfcontact["addressStyle"] ) : "" ) );
			echo $options;
			?></td>
			<td align="left" valign="top"><?php echo DFCONTACT_ADDRESSSTYLE_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_CLICKABLELINKS . ":" ?></th>
			<td align="left" valign="top"><?php
			echo mosHTML::yesnoRadioList( 'dfcontact[links]', 'class="inputbox"', ( !empty( $dfcontact["links"] ) ? htmlentities( $dfcontact["links"] ) : "0" ) );
			?></td>
			<td align="left" valign="top"><?php echo DFCONTACT_CLICKABLELINKS_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_CAPTCHA . ":" ?></th>
			<td align="left" valign="top"><?php
			echo mosHTML::yesnoRadioList( 'dfcontact[captcha]', 'class="inputbox"', ( !empty( $dfcontact["captcha"] ) ? htmlentities( $dfcontact["captcha"] ) : "0" ) );
			?></td>
			<td align="left" valign="top"><?php echo DFCONTACT_CAPTCHA_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_HTMLMAILS . ":" ?></th>
			<td align="left" valign="top"><?php
			echo mosHTML::yesnoRadioList( 'dfcontact[htmlMails]', 'class="inputbox"', ( !empty( $dfcontact["htmlMails"] ) ? htmlentities( $dfcontact["htmlMails"] ) : "0" ) );
			?></td>
			<td align="left" valign="top"><?php echo DFCONTACT_HTMLMAILS_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_ADDSERVERDATA . ":" ?></th>
			<td align="left" valign="top"><?php
			echo mosHTML::yesnoRadioList( 'dfcontact[addServerData]', 'class="inputbox"', ( !empty( $dfcontact["addServerData"] ) ? htmlentities( $dfcontact["addServerData"] ) : "0" ) );
			?></td>
			<td align="left" valign="top"><?php echo DFCONTACT_ADDSERVERDATA_INFO ?></td>
		</tr>
		<tr>
			<th align="left" valign="top"><?php echo DFCONTACT_DISPLAYUSERINPUT . ":" ?></th>
			<td align="left" valign="top"><?php
			echo mosHTML::yesnoRadioList( 'dfcontact[displayUserInput]', 'class="inputbox"', ( !empty( $dfcontact["displayUserInput"] ) ? htmlentities( $dfcontact["displayUserInput"] ) : "0" ) );
			?></td>
			<td align="left" valign="top"><?php echo DFCONTACT_DISPLAYUSERINPUT_INFO ?></td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( DFCONTACT_TAB_YOUR_DATA , "tabYourData" );
		?>
		<table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminForm">
		<colgroup>
			<col style="width:12em;" />
			<col style="width:18em;" />
			<col style="width:30em;" />
			<col />
		</colgroup>
		<?php
		$counter = 0;
		$dfcontact["field"] = ( !empty( $dfcontact["field"] ) && is_array( $dfcontact["field"] ) ? $dfcontact["field"] : array() );
		reset( $dfcontact["field"] );
		while( list( $key, $value ) = each( $dfcontact["field"] ) ) {
			if ( $key == "checkbox" || $key == "message" ) {
				continue;
			}
		?>
			<tr>
				<th align="left" valign="top"><?php echo constant( "DFCONTACT_" . strtoupper( $key ) ) . ":" ?></th>
				<td align="left" valign="top"><input type="text" name="dfcontact[field][<?php echo $key; ?>][value]" value="<?php echo ( !empty( $value["value"] ) ? htmlentities( $value["value"] ) : "" ); ?>"></td>
				<?php
				echo ($counter++ == 0 ? "<td align=\"left\" valign=\"top\" rowspan=\"" . sizeof($dfcontact["field"]) . "\">" . DFCONTACT_TAB_YOUR_DATA_INFO . "</td>" : "");
				?>
				<td></td>
			</tr>
		<?php
		}
		?>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( DFCONTACT_TAB_FORM_FIELDS , "tabFormFields" );
		?>
		<script language="Javascript">
		function dfcontactRefreshDuty(field) {
			var fieldnameDisplay = field + "[display]";
			var fieldnameDuty = field + "[duty]";
			if ( document.getElementById(fieldnameDisplay).options[document.getElementById(fieldnameDisplay).selectedIndex].value == "0" ) {
				document.getElementById(fieldnameDuty).disabled = true;
			} else {
				document.getElementById(fieldnameDuty).disabled = false;
			}
		}
		</script>
		<table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminForm">
		<colgroup>
			<col style="width:12em;" />
			<col style="width:18em;" />
			<col style="width:30em;" />
			<col />
		</colgroup>
		<?php
		$counter = 0;
		$dfcontact["field"] = ( !empty( $dfcontact["field"] ) && is_array( $dfcontact["field"] ) ? $dfcontact["field"] : array() );
		reset( $dfcontact["field"] );
		while( list( $key, $value ) = each( $dfcontact["field"] ) ) {
			if ( $key == "checkbox" ) {
				continue;
			}
			?>
			<tr>
				<th align="left" valign="top"><?php echo constant( "DFCONTACT_" . strtoupper( $key ) ) . ":" ?></th>
				<td align="left" valign="top"><?php
				$options = array();
				$options[] = mosHTML::makeOption( 0, DFCONTACT_HIDE );
				$options[] = mosHTML::makeOption( 1, DFCONTACT_SHOW );
				$options = mosHTML::selectList( $options, 'dfcontact[field][' . $key . '][display]', 'class="inputbox" size="1" id="dfcontact[field][' . $key . '][display]" onChange="dfcontactRefreshDuty(\'dfcontact[field][' . $key . ']\')"', 'value', 'text', ( !empty( $value["display"] ) ? htmlentities( $value["display"] ) : "" ) );
				echo $options;
				echo "&nbsp;&nbsp;&nbsp;";
				$options = array();
				$options[] = mosHTML::makeOption( 0, DFCONTACT_OPTIONAL );
				$options[] = mosHTML::makeOption( 1, DFCONTACT_DUTY );
				$options = mosHTML::selectList( $options, 'dfcontact[field][' . $key . '][duty]', 'class="inputbox" size="1" id="dfcontact[field][' . $key . '][duty]"' . ( !$value["display"] ? " disabled=\"disabled\"" : "" ), 'value', 'text', ( !empty( $value["duty"] ) ? htmlentities( $value["duty"] ) : "" ) );
				echo $options;
				?></td>
				<?php
				echo ($counter++ == 0 ? "<td align=\"left\" valign=\"top\" rowspan=\"" . ( sizeof( $dfcontact["field"] ) - 1 ) . "\">" . DFCONTACT_TAB_FORM_FIELDS_INFO . "</td>" : "");
				?>
				<td></td>
			</tr>
		<?php
		}
		?>
			<tr>
				<th align="left" valign="top"><?php echo DFCONTACT_CHECKBOX . ":" ?></th>
				<td align="left" valign="top"><?php				
				$options = array();
				$options[] = mosHTML::makeOption( 0, DFCONTACT_HIDE );
				$options[] = mosHTML::makeOption( 1, DFCONTACT_SHOW );
				$options = mosHTML::selectList( $options, 'dfcontact[field][checkbox][display]', 'class="inputbox" size="1" id="dfcontact[field][checkbox][display]" onChange="dfcontactRefreshDuty(\'dfcontact[field][checkbox]\')"', 'value', 'text', ( !empty( $dfcontact["field"]["checkbox"]["display"] ) ? htmlentities( $dfcontact["field"]["checkbox"]["display"] ) : "" ) );
				echo $options;
				echo "&nbsp;&nbsp;&nbsp;";
				$options = array();
				$options[] = mosHTML::makeOption( 0, DFCONTACT_OPTIONAL );
				$options[] = mosHTML::makeOption( 1, DFCONTACT_DUTY );
				$options = mosHTML::selectList( $options, 'dfcontact[field][checkbox][duty]', 'class="inputbox" size="1" id="dfcontact[field][checkbox][duty]"' . ( empty( $dfcontact["field"]["checkbox"]["display"] ) ? " disabled=\"disabled\"" : "" ), 'value', 'text', ( !empty( $dfcontact["field"]["checkbox"]["duty"] ) ? htmlentities( $dfcontact["field"]["checkbox"]["duty"] ) : "" ) );
				echo $options;
				?></td>
				<td><?php echo DFCONTACT_CHECKBOX_INFO ?></td>
				<td></td>
			</tr>
			<tr>
				<th align="left" valign="top"><?php echo DFCONTACT_CHECKBOX_TEXT . ":" ?></th>
				<td align="left" valign="top"><input type="text" name="dfcontact[field][checkbox][text]" value="<?php echo ( !empty( $dfcontact["field"]["checkbox"]["text"] ) ? htmlentities( $dfcontact["field"]["checkbox"]["text"] ) : "" ); ?>"></td>
				<td><?php echo DFCONTACT_CHECKBOX_TEXT_INFO ?></td>
				<td></td>
			</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab( DFCONTACT_TAB_ABOUT , "tabAbout" );
		?>
		<table width="100%" border="0" cellpadding="4" cellspacing="2" class="adminFform">
		<colgroup>
			<col style="width:40em;" />
			<col />
		</colgroup>
		<tr>
			<td>
			<p><b><?php echo DFCONTACT_ABOUT_SUPPORT_US ?></b><br />
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=daniel%2efilzhut%40web%2ede&item_name=DFContact&item_number=DFContact&no_shipping=1&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8" target="_blank"><img src="http://paypal.com/images/x-click-but04.gif" style="cursor:pointer;" align="right" border="0" /></a><?php echo DFCONTACT_ABOUT_SUPPORT_US_INFO ?></p>
			<p><b><?php echo DFCONTACT_ABOUT_MODIFICATION_SERVICE ?></b><br /><?php echo DFCONTACT_ABOUT_MODIFICATION_SERVICE_INFO ?></p>
			<p><b><?php echo DFCONTACT_ABOUT_PROGRAM ?></b><br /><?php echo DFCONTACT_ABOUT_PROGRAM_INFO ?></p>
			<p><b><?php echo DFCONTACT_ABOUT_VERSION ?></b><br />1.0.3, Thu, 15 Feb 2007 11:00:00 +0100</p>
			<p><b><?php echo DFCONTACT_ABOUT_AUTHOR ?></b><br /><?php echo DFCONTACT_ABOUT_AUTHOR_INFO ?></p>
			<p><b><?php echo DFCONTACT_ABOUT_WARRANTY ?></b><br /><?php echo DFCONTACT_ABOUT_WARRANTY_INFO ?></p>
			</td>
			<td></td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->endPane();
		?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}

}

?>