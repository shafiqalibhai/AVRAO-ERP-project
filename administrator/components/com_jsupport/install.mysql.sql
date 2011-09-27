CREATE TABLE IF NOT EXISTS `#__jtickets` (
`id` int(25) NOT NULL auto_increment,
`subject` varchar(100) default 'NULL',
`contactid` int(19) default '0',
`accountid` varchar(100) default 'NULL',
`manager` int(19) default '0',
`description` text,
`priority` varchar(100) default 'NULL',
`status` varchar(100) default 'NULL',
`category` varchar(100) default 'NULL',
`solution` varchar(100) default 'NULL',
`published` tinyint(2) NOT NULL default '0',
`created` datetime NOT NULL,
`modified` datetime NOT NULL,
`converted` tinyint(2) NOT NULL default '0',		
 PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jsupportcomments` (
`id` int(25) NOT NULL auto_increment,
`faqid` int(19) default '0',
`ticketid` int(19) default '0',		
`creatorname` varchar(100) default 'NULL',
`creatoremail` varchar(255) default 'NULL',
`contactid` int(19) default '0',		
`comment` text,
`published` tinyint(2) NOT NULL default '0',
`created` datetime NOT NULL,
`modified` datetime NOT NULL,
 PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jsupportcategories` (
`id` int(25) NOT NULL auto_increment,
`name` varchar(100) default 'NULL',		
`description` text,
`published` tinyint(2) NOT NULL default '0',
 PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS`#__jfaqs` (
`id` int(25) NOT NULL auto_increment,
`subject` varchar(100) default 'NULL',
`description` text,
`keywords` varchar(255) default 'NULL',
`category` varchar(100) default 'NULL',
`solution` varchar(100) default 'NULL',
`published` tinyint(2) NOT NULL default '0',
`score` int(19) NOT NULL default '0',
`hits` int(19) NOT NULL default '0',
`created` datetime NOT NULL,
`modified` datetime NOT NULL,
 PRIMARY KEY  (`id`)
);

INSERT INTO `#__menu` (`id`, `menutype`, `name`, `link`, `type`, `published`, `parent`, `componentid`, `sublevel`, `ordering`, `checked_out`, `checked_out_time`, `pollid`, `browserNav`, `access`, `utaccess`, `params`) VALUES
('', 'usermenu', 'Submit Ticket', 'index.php?option=com_jsupport&task=newTicket', 'url', 1, 0, 0, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, 'menu_image=-1'),
('', 'usermenu', 'My Tickets', 'index.php?option=com_jsupport&task=listTickets', 'url', 1, 0, 0, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, 'menu_image=-1');