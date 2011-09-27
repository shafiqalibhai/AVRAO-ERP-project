<?
defined( '_JEXEC' ) or die( 'Restricted access' );

class tickets extends JTable {
	var $id = null;
	var $subject = null;
	var $contactid = null;
	var $accountid = null;
	var $manager = null;
	var $description = null;
	var $priority = null;
	var $status = null;
	var $category = null;
	var $solution = null;
	var $published = null;
	var $created = null;
	var $modified = null;
	var $converted = null;
function __construct(&$db)
	{
	parent::__construct( '#__jtickets', 'id', $db );
	}
}

class supportcomments extends JTable {
	var $id = null;
	var $ticketid = null;
	var $faqid = null;
	var $creatorname = null;
	var $creatoremail = null;
	var $contactid = null;
	var $comment = null;
	var $published = null;
	var $created = null;
	var $modified = null;

function __construct(&$db)
	{
	parent::__construct( '#__jsupportcomments', 'id', $db );
	}
}

class supportcategories extends JTable{
	var $id = null;
	var $name = null;
	var $published = null;
	var $description = null;
	
function __construct(&$db)
	{
	parent::__construct( '#__jsupportcategories', 'id', $db );
	}
}

class faqs extends JTable{
	var $id = null;
	var $subject = null;
	var $description = null;
	var $keywords = null;
	var $category = null;
	var $solution = null;
	var $published = null;
	var $created = null;
	var $modified = null;
	var $score = null;
	var $hits = null;	

function __construct(&$db)
	{
	parent::__construct( '#__jfaqs', 'id', $db );
	}
}
?>