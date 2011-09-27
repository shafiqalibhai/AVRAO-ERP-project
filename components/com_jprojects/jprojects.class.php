<?
defined('_JEXEC') or die('Restricted access');

class projects extends JTable {
	var $id = null;
	var $subject = null;
	var $description = null;
	var $contactid = null;
	var $published = null;
	var $accountid = null;
	var $manager = null;
	var $startdate = null;
	var $completiondate = null;
	var $created = null;
	var $modified = null;

function __construct(&$db)
	{
	parent::__construct( '#__jprojects', 'id', $db );
	}
}

class tasks extends JTable {
	var $id = null;
	var $subject = null;
	var $description = null;
	var $assignedto = null;
	var $stage = null;
	var $priority = null;
	var $published = null;
	var $projectid = null;
	var $manager = null;
	var $startdate = null;
	var $completiondate = null;
	var $created = null;
	var $modified = null;

function __construct(&$db)
	{
	parent::__construct( '#__jtasks', 'id', $db );
	}
}


class documents extends JTable{
	var $id = null;
	var $filename = null;
	var $description = null;
	var $projectid = null;
	var $filelocation = null;
	var $dateadded = null;
	var $author = null;	

function __construct(&$db)
	{
	parent::__construct( '#__jdocuments', 'id', $db );
	}
}


class milestones extends JTable {
	var $id = null;
	var $projectid = null;
	var $name = null;
	var $description = null;
	var $manager = null;
	var $startdate = null;
	var $completiondate = null;
	var $completed = null;
	var $created = null;
	var $modified = null;	

function __construct(&$db)
	{
	parent::__construct( '#__jmilestones', 'id', $db );
	}
}


class timetracker extends JTable {
	var $id = null;
	var $user = null;
	var $description = null;
	var $projectid = null;
	var $taskid = null;
	var $manager = null;
	var $starttime = null;
	var $completiontime = null;
	var $created = null;
	var $modified = null;

function __construct(&$db)
	{
	parent::__construct( '#__jtimetracker', 'id', $db );
	}
}


?>