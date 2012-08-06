DROP TABLE IF EXISTS `#__jexchoose_locations`;

DROP TABLE IF EXISTS `#__jexchoose_items`;

DROP TABLE IF EXISTS `#__jexchoose_xref`;

DROP TABLE IF EXISTS `#__jexchoose_groups`;


CREATE TABLE `#__jexchoose_locations` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`catid` int(11) NOT NULL DEFAULT '0',	
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` int(1) NOT NULL DEFAULT '0',
	`name` VARCHAR(1024) NOT NULL,
	`link` VARCHAR(1024) NOT NULL,
	`logo` VARCHAR(512) NOT NULL,
	`mtime` INT(255) NOT NULL,
	`params` VARCHAR(1024) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MYISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__jexchoose_items`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`catid` int(11) NOT NULL DEFAULT '0',
	`group_id` int(11) NOT NULL,
	`ordering` int(11) NOT NULL DEFAULT '0',
	`published` int(1) NOT NULL DEFAULT '0',
	`text` VARCHAR(1024) NOT NULL,
	`mtime` INT(255) NOT NULL,
	`params` VARCHAR(1024) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE=MYISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__jexchoose_xref`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`location_id` int(11) NOT NULL,
	`item_id` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MYISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__jexchoose_groups`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(1024) NOT NULL,
	`text` VARCHAR(1024) NOT NULL,
	`catid` int(11) NOT NULL DEFAULT '0',
	`published` int(1) NOT NULL DEFAULT '0',
	`ordering` int(11) NOT NULL,
	`params` VARCHAR(1024) NOT NULL,
	PRIMARY KEY(`id`)
) ENGINE=MYISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__jexchoose_locations` (`name`) VALUES
	('Testkip Land'),
	('In Den Ouden Testkip');

INSERT INTO `#__jexchoose_items` (`text`) VALUES
	('Hanen'),
	('Kippen');

INSERT INTO `#__jexchoose_xref` (`location_id`,`item_id`) VALUES
	('1','1'),
	('1','2'),
	('2','2');
	
INSERT INTO `#__jexchoose_groups` (`title`, `text`) VALUES
	('Basis','Basis'),
	('Extra','Extra');