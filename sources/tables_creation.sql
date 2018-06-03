SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `flow` (
  `sharer` smallint(6) NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permalink` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `id` char(22) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `href` varchar(101) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(101) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` int(11) NOT NULL,
  `sharer` smallint(6) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sharers` (
  `id` smallint(6) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated` int(11) DEFAULT '0',
  `feed` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_entry_updated` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tags` (
  `tag` varchar(255) NOT NULL,
  `hits` mediumint(9) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `flow`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `href` (`href`);

ALTER TABLE `sharers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uri` (`uri`),
  ADD KEY `uri_2` (`uri`);

ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag`),
  ADD KEY `tag` (`tag`);


ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `sharers`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
