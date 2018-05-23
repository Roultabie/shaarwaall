CREATE TABLE `flow` (
 `sharer` smallint(6) NOT NULL,
 `link_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
 `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `permalink` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
 `published` datetime NOT NULL,
 `updated` datetime NOT NULL,
 `first_share` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
 `id` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `UNIQUE` (`link_hash`(191)) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci