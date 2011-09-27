<?
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( $mainframe->getPath( 'toolbar_html' ) ); 
$task = JRequest::getVar('task');
switch ( $task ) {

case 'editGroup':
case 'newGroup':
menuCLIENTS::GROUPS_MENU();
break;
case 'listGroups':
default:
menuCLIENTS::DEFAULTGROUPS_MENU();
break;
}
?>