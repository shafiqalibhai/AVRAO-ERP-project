<?
defined( '_JEXEC' ) or die( 'Restricted access' );
class invoices extends JTable {
	var $id = null;
	var $subject = null;
	var $contactid = null;
	var $quoteid = null;
	var $type = null;
	var $subtotal = null;
	var $total = null;
	var $discount_percent = null;
	var $discount_amount = null;
	var $invoicestatus = null;
	var $paymentmethod = null;
	var $published = null;
	var $validtill = null;
	var $accountid = null;
	var $projectid = null;
	var $gid = null;
	var $mid = null;
	var $created = null;
	var $modified = null;

function __construct(&$db)
	{
	parent::__construct( '#__jinvoices', 'id', $db );
	}
}

class quotes extends JTable {
	var $id = null;
	var $subject = null;
	var $quotestage = null;
	var $contactid = null;
	var $subtotal = null;
	var $total = null;
	var $discount_percent = null;
	var $discount_amount = null;
	var $published = null;
	var $viewed = null;
	var $validtill = null;
	var $accountid = null;
	var $projectid = null;
	var $gid = null;
	var $mid = null;
	var $created = null;
	var $modified = null;

function __construct(&$db)
	{
	parent::__construct( '#__jquotes', 'id', $db );
	}
}

class services extends JTable{
	var $id = null;
	var $productname = null;
	var $product_description = null;
	var $unit_price = null;
	var $gid = null;
	var $mid = null;
	var $created = null;
	var $modified = null;	

function __construct(&$db)
	{
	parent::__construct( '#__jservices', 'id', $db );
	}
}

class servicerelation extends JTable {
	var $id = null;
	var $quoteid = null;
	var $invoiceid = null;
	var $serviceid = null;
	var $quantity = null;
	var $listprice = null;
	var $discount_percent = null;
	var $discount_amount = null;
	var $total = null;
	var $comment = null;

function __construct(&$db)
	{
	parent::__construct( '#__jservicerelation', 'id', $db );
	}
}

?>