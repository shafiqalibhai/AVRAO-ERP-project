CREATE TABLE IF NOT EXISTS `#__jprojects` (
  `id` int(25) NOT NULL auto_increment,
  `subject` varchar(100) default 'NULL',
  `description` text NOT NULL,
  `contactid` int(19) default '0',
  `published` tinyint(2) NOT NULL default '0',
  `accountid` varchar(255) NOT NULL,
  `manager` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `completiondate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jtasks` (
  `id` int(25) NOT NULL auto_increment,
  `subject` varchar(100) default 'NULL',
  `description` text NOT NULL,
  `assignedto` int(19) default '0',
  `stage` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `published` tinyint(2) NOT NULL default '0',
  `projectid` int(11) NOT NULL,
  `manager` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `completiondate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jdocuments` (
  `id` int(25) NOT NULL auto_increment,
  `filename` varchar(100) default NULL,
  `description` text NOT NULL,
  `projectid` varchar(255) NOT NULL,
  `filelocation` varchar(255) NOT NULL,
  `dateadded` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jmilestones` (
  `id` int(25) NOT NULL auto_increment,
  `projectid` int(11) NOT NULL,
  `name` varchar(100) default 'NULL',
  `description` text,
  `manager` varchar(255) NOT NULL,
  `startdate` datetime NOT NULL,
  `completiondate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `completed` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jtimetracker` (
  `id` int(25) NOT NULL auto_increment,
  `user` int(19) default NULL,
  `description` text,
  `projectid` varchar(255) NOT NULL,
  `taskid` varchar(255) NOT NULL,
  `manager` varchar(255) NOT NULL,
  `starttime` datetime NOT NULL,
  `completiontime` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ;