CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`idparent` int(5) unsigned NOT NULL DEFAULT "0",
`user` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL,
`text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`date` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM 
DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1;
