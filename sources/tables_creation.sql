CREATE TABLE `flow` (
 `sharer` smallint(6) NOT NULL,
 `link_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
 `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `permalink` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
 `published` int(8) NOT NULL DEFAULT '0',
 `updated` int(8) NOT NULL DEFAULT '0',
 `first_share` char(22) COLLATE utf8mb4_unicode_ci NOT NULL,
 `id` char(22) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`) USING BTREE,
 KEY `INDEX` (`link_hash`(191)) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `flow_pending` (
 `sharer` text COLLATE utf8mb4_unicode_ci NOT NULL,
 `updated` int(8) NOT NULL DEFAULT '0',
 `datas` text COLLATE utf8mb4_unicode_ci NOT NULL,
 `via` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `id` char(22) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`) USING BTREE,
 KEY `via` (`via`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `sharers` (
 `id` smallint(6) NOT NULL AUTO_INCREMENT,
 `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `subtitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `updated` int(8) NOT NULL DEFAULT '0',
 `feed` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `uri` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `last_update` int(8) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 UNIQUE KEY `uri` (`uri`),
 KEY `uri_2` (`uri`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `tags` (
 `tag` varchar(255) NOT NULL,
 `hits` mediumint(9) DEFAULT '1',
 PRIMARY KEY (`tag`),
 KEY `tag` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8