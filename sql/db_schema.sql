CREATE TABLE `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`link_id`),
  UNIQUE KEY `idx_links_history_link_id` (`link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `items_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_items_list_link_id` (`link_id`),
  KEY `fk_items_list_item_id` (`item_id`),
  CONSTRAINT `fk_items_list_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  CONSTRAINT `fk_items_list_link_id` FOREIGN KEY (`link_id`) REFERENCES `links` (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



