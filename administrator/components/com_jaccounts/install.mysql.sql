CREATE TABLE IF NOT EXISTS `#__jinvoices` (
  `id` int(25) NOT NULL auto_increment,
  `subject` varchar(100) default 'NULL',
  `contactid` int(19) default '0',
  `quoteid` varchar(100) default 'NULL',
  `type` varchar(100) default 'NULL',
  `subtotal` decimal(11,2) default '0.00',
  `total` decimal(11,2) default '0.00',
  `discount_percent` decimal(11,2) default '0.00',
  `discount_amount` decimal(11,2) default '0.00',
  `invoicestatus` varchar(100) default 'NULL',
  `paymentmethod` int(19) NOT NULL,
  `published` tinyint(2) NOT NULL default '0',
  `validtill` datetime NOT NULL,
  `accountid` varchar(255) NOT NULL,
  `projectid` varchar(255) NOT NULL,
  `gid` varchar(255) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jquotes` (
 `id` int(25) NOT NULL auto_increment,
  `subject` varchar(100) default 'NULL',
  `contactid` int(19) default '0',
  `quotestage` varchar(100) default 'NULL',
  `subtotal` decimal(11,2) default '0.00',
  `total` decimal(11,2) default '0.00',
  `published` tinyint(2) NOT NULL default '0',
  `validtill` datetime NOT NULL,
  `viewed` tinyint(2) default '0',
  `accountid` varchar(255) NOT NULL,
  `projectid` varchar(255) NOT NULL,
  `gid` varchar(255) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jservicerelation` (
  `id` int(25) NOT NULL auto_increment,
  `quoteid` varchar(100) default 'NULL',
  `invoiceid` varchar(100) default 'NULL',
  `serviceid` varchar(100) default 'NULL',
  `quantity` varchar(100) default 'NULL',
  `listprice` decimal(11,2) default '0.00',
  `total` decimal(11,2) default '0.00',
  `discount_percent` decimal(7,2) default '0.00',
  `discount_amount` decimal(7,2) default '0.00',
  `comment` text,
  PRIMARY KEY  (`id`)
);

CREATE TABLE IF NOT EXISTS `#__jservices` (
  `id` int(25) NOT NULL auto_increment,
  `productname` varchar(100) default 'NULL',
  `product_description` text,
  `unit_price` decimal(11,2) default '0.00',
  `gid` varchar(255) NOT NULL,
  `mid` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
);