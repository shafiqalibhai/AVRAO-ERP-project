<?
defined( '_JEXEC' ) or die( 'Restricted access' );

class jaccessgroups extends JTable {
	var $id = null;
	var $groupname = null;
	var $groupowner = null;
	var $groupmembers = null;
	var $jaccounts_quotes = null;
	var $jaccounts_invoices = null;
	var $jaccounts_services = null;
	var $jcontacts_leads = null;
	var $jcontacts_contacts = null;
	var $jcontacts_accounts = null;
	var $jprojects_tasks = null;
	var $jprojects_projects = null;
	var $jprojects_timer = null;
	var $jsupport_tickets = null;
	var $jsupport_faqs = null;
	var $jsupport_categories = null;
	var $published = null;
	
function __construct(&$db)
	{
	parent::__construct( '#__jaccessgroups', 'id', $db );
	}
}

?>