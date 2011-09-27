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
class TOOLBAR_dfcontact {

	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}
}
?>
