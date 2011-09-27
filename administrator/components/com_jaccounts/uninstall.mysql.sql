DROP TABLE `#__jinvoices`;
DROP TABLE `#__jquotes`;
DROP TABLE `#__jservices`;
DROP TABLE `#__jservicerelation`;

DELETE FROM `#__modules` WHERE `title` = 'jMenu';
DELETE FROM `#__menu` WHERE `menutype` = 'jmenu';