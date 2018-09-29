-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 11 juin 2018 à 14:15
-- Version du serveur :  10.1.33-MariaDB
-- Version de PHP :  7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shaarwaall`
--

-- --------------------------------------------------------

--
-- Structure de la table `sharers`
--

CREATE TABLE `sharers` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated` int(8) DEFAULT '0',
  `feed` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_entry_updated` int(8) DEFAULT '0',
  `status` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sharers`
--

INSERT INTO `sharers` (`id`, `title`, `subtitle`, `updated`, `feed`, `author`, `uri`, `last_entry_updated`, `status`) VALUES
(1, 'Liens en vrac de sebsauvage', '', 1528730880, 'http://sebsauvage.net/links/?do=atom', 'http://sebsauvage.net/links/', 'http://sebsauvage.net/links/', 1528730820, '200'),
(2, 'Les piti liens de Vader', '', 1526326761, 'http://liens.vader.fr/?do=atom', 'http://liens.vader.fr/', 'http://liens.vader.fr/', 1510072215, '200'),
(3, 'Olivier Dossmann', '', 1522143839, 'https://olivier.dossmann.net/liens/?do=atom', 'https://olivier.dossmann.net/liens/', 'https://olivier.dossmann.net/liens/', 1500569485, '200'),
(4, 'herveleblouch', '', 1503182378, 'http://herveleblouch.free.fr/liens/?do=atom', 'http://herveleblouch.free.fr/liens/', 'http://herveleblouch.free.fr/liens/', 1372674354, '200'),
(6, 'lepaille', '', 1463090981, 'http://lepaille.fr/bookmark/?do=atom', 'http://lepaille.fr/bookmark/', 'http://lepaille.fr/bookmark/', 1431649236, '200'),
(7, 'Cochise', '', 1526642400, 'http://cochi.se/links/?do=atom', 'http://cochi.se/links/', 'http://cochi.se/links/', 1508752803, '200'),
(8, 'librementvôtre', '', 1528730880, 'http://www.librement-votre.fr/shaarli/?do=atom', 'http://www.librement-votre.fr/shaarli/', 'http://www.librement-votre.fr/shaarli/', 1528730880, '200'),
(9, 'De tout et de rien...', '', 1428527168, 'http://naxos.fr.free.fr/shaarli/?do=atom', 'http://naxos.fr.free.fr/shaarli/', 'http://naxos.fr.free.fr/shaarli/', 1400670463, '200'),
(10, 'Liste de liens d\'AkaiKen : tech, miam, art, sociologie', '', 1403699337, 'http://lamecarlate.net/links/?do=atom', 'http://lamecarlate.net/links/', 'http://lamecarlate.net/links/', 1403699337, '200'),
(11, 'Manuel Flury', '', 1521069071, 'http://manuel.flury.free.fr/shaarli/?do=atom', 'http://manuel.flury.free.fr/shaarli/', 'http://manuel.flury.free.fr/shaarli/', 1415572592, '200'),
(12, 'Kita59', '', 1397054250, 'http://azikan.free.fr/bookmarks/?do=atom', 'http://azikan.free.fr/bookmarks/', 'http://azikan.free.fr/bookmarks/', 1373538820, '200'),
(13, 'Liens', '', 1527938245, 'https://famille-michon.fr/links/?do=atom', 'https://famille-michon.fr/links/', 'https://famille-michon.fr/links/', 1527936738, '200'),
(14, 'Liens vrac de Galsungen', '', 1527756045, 'http://shaarli.galsungen.net/?do=atom', 'http://shaarli.galsungen.net/', 'http://shaarli.galsungen.net/', 1472584762, '200'),
(15, 'Les liens que je découvre au fil du Web', '', 1498484873, 'https://links.alwaysdata.net/?do=atom', 'https://links.alwaysdata.net/', 'https://links.alwaysdata.net/', 1470421392, '200'),
(16, 'HowTommy', '', 1528586646, 'http://liens.howtommy.net/?do=atom', 'http://liens.howtommy.net/', 'http://liens.howtommy.net/', 1524147073, '200'),
(17, 'sensini42', '', 1528643153, 'http://sensini42.free.fr/shaarli/?do=atom', 'http://sensini42.free.fr/shaarli/', 'http://sensini42.free.fr/shaarli/', 1465904083, '200'),
(18, 'Liens Ecyseo', '', 1528730880, 'http://bookmarks.ecyseo.net/?do=atom', 'http://bookmarks.ecyseo.net/', 'http://bookmarks.ecyseo.net/', 1528730820, '200'),
(19, 'Anadrark - Liens en bordel', '', 1464124494, 'http://anadrark.com/links/?do=atom', 'http://anadrark.com/links/', 'http://anadrark.com/links/', 1406544310, '200'),
(21, 'bookmark pingouin', '', 1454944338, 'http://lepingouin.info/bookmark/?do=atom', 'http://lepingouin.info/bookmark/', 'http://lepingouin.info/bookmark/', 1412981176, '200'),
(22, 'dotmana', '', 1508757861, 'http://www.dotmana.com/shaarli/?do=atom', 'http://www.dotmana.com/shaarli/', 'http://www.dotmana.com/shaarli/', 1486467725, '200'),
(23, 'Fiat tux microblogging', '', 1341095332, 'https://mublog.fiat-tux.fr/?do=atom', 'https://mublog.fiat-tux.fr/', 'https://mublog.fiat-tux.fr/', 1319716591, '200'),
(24, 'Les liens de Mohja', '', 1376919810, 'http://liens.mohja.fr/?do=atom', 'http://liens.mohja.fr/', 'http://liens.mohja.fr/', 1332237101, '200'),
(26, 'porneia', '', 1415693744, 'http://porneia.free.fr/pub/links/?do=atom', 'http://porneia.free.fr/pub/links/', 'http://porneia.free.fr/pub/links/', 1413748128, '200'),
(27, 'Shared links on https://url.bidouille.info/', '', 0, 'https://url.bidouille.info/?do=atom', 'https://url.bidouille.info/', 'https://url.bidouille.info/', 0, ''),
(28, 'Zertrin\'s links', '', 1526881382, 'https://shaarli.zertrin.org/?do=atom', 'https://shaarli.zertrin.org/', 'https://shaarli.zertrin.org/', 1471478165, '200'),
(30, 'chabotsi', '', 1527334710, 'https://chabotsi.fr/links/?do=atom', 'https://chabotsi.fr/links/', 'https://chabotsi.fr/links/', 0, '200'),
(31, 'Aloco', '', 1483549998, 'http://aloco.free.fr/info/?do=atom', 'http://aloco.free.fr/info/', 'http://aloco.free.fr/info/', 1433098058, '200'),
(32, 'Vigor', '', 1490009587, 'http://www.viggor.eu/shaarli/?do=atom', 'http://www.viggor.eu/shaarli/', 'http://www.viggor.eu/shaarli/', 1415837991, '200'),
(33, 'Liens en bazar', '', 1528405174, 'https://links.kevinvuilleumier.net/?do=atom', 'https://links.kevinvuilleumier.net/', 'https://links.kevinvuilleumier.net/', 1520095110, '200'),
(35, 'GF | Transformation sociale, etc...', '', 1487212571, 'https://bleu-pale.fr/links/?do=atom', 'https://bleu-pale.fr/links/', 'https://bleu-pale.fr/links/', 1410040011, '200'),
(36, 'Arthur Hoaro\'s Links', '', 1527847448, 'https://links.hoa.ro/?do=atom', 'https://links.hoa.ro/', 'https://links.hoa.ro/', 1503064135, '200'),
(37, 'Fou à lier', '', 1527765308, 'https://foualier.gregory-thibault.com/?do=atom', 'https://foualier.gregory-thibault.com/', 'https://foualier.gregory-thibault.com/', 1521633929, '200'),
(38, 'Vinc3r\'s links', '', 1528296231, 'https://www.nothing-is-3d.com/links/?do=atom', 'https://www.nothing-is-3d.com/links/', 'https://www.nothing-is-3d.com/links/', 1521540691, '200'),
(39, 'Liens en vrac de JeromeJ', '', 0, 'https://www.olissea.com/mb/links/1/?do=atom', 'https://www.olissea.com/mb/links/1/', 'https://www.olissea.com/mb/links/1/', 0, ''),
(40, 'JJL\'s Links', '', 1491513268, 'https://dinask.eu/shaarli/?do=atom', 'https://dinask.eu/shaarli/', 'https://dinask.eu/shaarli/', 1386149396, '200'),
(41, 'fspot', '', 1427536221, 'https://fspot.org/lnk/?do=atom', 'https://fspot.org/lnk/', 'https://fspot.org/lnk/', 1409790743, '200'),
(42, 'stuper', '', 1526678996, 'https://stuper.info/shaarli/?do=atom', 'https://stuper.info/shaarli/', 'https://stuper.info/shaarli/', 1508064592, '200'),
(43, 'Link (The Legend of Zelda)', '', 1451474467, 'https://mescanefeux.com/link/?do=atom', 'https://mescanefeux.com/link/', 'https://mescanefeux.com/link/', 1427230687, '200'),
(44, 'Shaarlo', '', 1489659346, 'https://www.shaarli.fr/shaarli/?do=atom', 'https://www.shaarli.fr/shaarli/', 'https://www.shaarli.fr/shaarli/', 1436289285, '200'),
(45, 'Serendipity', '', 1503310670, 'https://www.margaux-perrin.com/serendipity/?do=atom', 'https://www.margaux-perrin.com/serendipity/', 'https://www.margaux-perrin.com/serendipity/', 1493378810, '200'),
(46, 'liens de tolima', '', 1528318305, 'https://www.tolima.fr/shaarli/?do=atom', 'https://www.tolima.fr/shaarli/', 'https://www.tolima.fr/shaarli/', 1458055674, '200'),
(47, 'Liens de Neuromancien', '', 1528651227, 'https://deleurme.net/liens/?do=atom', 'https://deleurme.net/liens/', 'https://deleurme.net/liens/', 1528199046, '200'),
(48, '/Yome/links', '', 1528450901, 'https://links.yome.ch/?do=atom', 'https://links.yome.ch/', 'https://links.yome.ch/', 1520265460, '200'),
(49, 'Brèves du Planet Libre', '', 0, 'http://liens.planet-libre.org/?do=atom', 'http://liens.planet-libre.org/', 'http://liens.planet-libre.org/', 0, '200'),
(50, 'Liens \"A lire ailleurs\" du diplodocus', '', 1404291915, 'https://www.ventredudiplodocus.fr/liens/?do=atom', 'https://www.ventredudiplodocus.fr/liens/', 'https://www.ventredudiplodocus.fr/liens/', 1337857019, '200'),
(51, 'www.rakforgeron.fr - Actualité de la généalogie', '', 0, 'https://www.rakforgeron.fr/shaarli/?do=atom', 'https://www.rakforgeron.fr/shaarli/', 'https://www.rakforgeron.fr/shaarli/', 0, ''),
(52, 'Marquetapages Shazen', '', 1528730880, 'http://lien.shazen.fr/?do=atom', 'http://lien.shazen.fr/', 'http://lien.shazen.fr/', 1528730460, '200'),
(53, 'Aceawan\'s links', '', 1440082435, 'https://shaarli.fr/my/aceawan/?do=atom', 'https://shaarli.fr/my/aceawan/', 'https://shaarli.fr/my/aceawan/', 1407848051, '200'),
(56, 'f.0x2501.org', '', 0, 'https://www.f.0x2501.org/s/?do=atom', 'https://www.f.0x2501.org/s/', 'https://www.f.0x2501.org/s/', 0, ''),
(57, 'Hoab - Shaarli', '', 1526049786, 'https://hoab.fr/shaarli/?do=atom', 'https://hoab.fr/shaarli/', 'https://hoab.fr/shaarli/', 1512988834, '200'),
(58, 'JdxLabs Links', '', 1528730880, 'https://jdxlabs.com/links/?do=atom', 'http://jdxlabs.com/links/', 'https://jdxlabs.com/links/', 1528730820, '200'),
(59, 'Le bazar du petit panda roux.', '', 1497721094, 'https://shaarli.pandouillaroux.fr/?do=atom', 'https://shaarli.pandouillaroux.fr/', 'https://shaarli.pandouillaroux.fr/', 1490557603, '200'),
(61, 'Liens de WebManiaK', '', 1527954908, 'https://powerjpm.info/liens/?do=atom', 'https://powerjpm.info/liens/', 'https://powerjpm.info/liens/', 1515935619, '200'),
(62, 'Morgangeek - Liens', '', -2147483648, 'https://morgangeek.be/shaarli/?do=atom', 'https://www.morgangeek.be/shaarli/', 'https://morgangeek.be/shaarli/', 1528727220, '200'),
(63, 'partage de liens - nonymous', '', 1528469171, 'https://liens.nonymous.fr/?do=atom', 'https://liens.nonymous.fr/', 'https://liens.nonymous.fr/', 1526388469, '200'),
(64, 'Red Beard', '', 1528479676, 'http://redbeard.free.fr/links/?do=atom', 'http://redbeard.free.fr/links/', 'http://redbeard.free.fr/links/', 1524766992, '200'),
(66, 'Ziirish\'s cave', '', 1491332607, 'https://ziirish.info/bm/?do=atom', 'https://ziirish.info/bm/', 'https://ziirish.info/bm/', 1402390597, '200'),
(67, 'ZeShaarli', '', 1525452187, 'https://shaarli.zeseb.fr/?do=atom', 'https://shaarli.zeseb.fr/', 'https://shaarli.zeseb.fr/', 1505928586, '200'),
(68, 'OpenNews', '', 1528485939, 'https://www.ecirtam.net/opennews/?do=atom', 'https://www.ecirtam.net/opennews/', 'https://www.ecirtam.net/opennews/', 1528226792, '200'),
(69, 'Élie', '', 1421667725, 'http://tools.exppad.com/shaarli/?do=atom', 'http://tools.exppad.com/shaarli/', 'http://tools.exppad.com/shaarli/', 1413165629, '200'),
(70, 'JMLRT', '', 1528122092, 'https://julien.mailleret.fr/links/?do=atom', 'https://julien.mailleret.fr/links/', 'https://julien.mailleret.fr/links/', 1521624689, '200'),
(71, 'Tech-Blog.fr', '', 1528127689, 'https://shaarli.tech-blog.fr/?do=atom', 'https://shaarli.tech-blog.fr/', 'https://shaarli.tech-blog.fr/', 1522765094, '200'),
(72, 'Nono\'s Links', '', 1527902454, 'https://shaarli.m0le.net/?do=atom', 'https://shaarli.m0le.net/', 'https://shaarli.m0le.net/', 1524822570, '200'),
(73, 'Oros links', '', 1528730880, 'https://www.ecirtam.net/links/?do=atom', 'https://www.ecirtam.net/links/', 'https://www.ecirtam.net/links/', 1528730880, '200'),
(75, 'Alex\'s shaarli', '', 1479466458, 'https://macahute.net/shaarli/?do=atom', 'https://macahute.net/shaarli/', 'https://macahute.net/shaarli/', 1433520966, '200'),
(76, 'Nekoblog.org :: Marque-pages', '', 0, 'https://links.nekoblog.org/?do=atom', 'https://links.nekoblog.org/', 'https://links.nekoblog.org/', 0, ''),
(77, 'Peacecopathe', '', 1440552845, 'http://peacecopathe.free.fr/peacecoLiens/?do=atom', 'http://peacecopathe.free.fr/peacecoLiens/', 'http://peacecopathe.free.fr/peacecoLiens/', 1368900892, '200'),
(78, 'dooby', '', 1528730880, 'https://dooby.fr/links/?do=atom', 'https://dooby.fr/links/', 'https://dooby.fr/links/', 1528730760, '200'),
(79, 'biblio.chine.coree.japon.infos', '', 1508231131, 'http://france.besson.free.fr/?do=atom', 'http://france.besson.free.fr/', 'http://france.besson.free.fr/', 1365607680, '200'),
(80, 'Shaarlo', '', 1489659346, 'http://shaarli.fr/shaarli/?do=atom', 'http://shaarli.fr/shaarli/', 'http://shaarli.fr/shaarli/', 1436289285, '200'),
(81, 'Une cascade de liens', '', 1527465768, 'http://lalleau.com.free.fr/?do=atom', 'http://lalleau.com.free.fr/', 'http://lalleau.com.free.fr/', 1474385874, '200'),
(82, 'Doo\'s bookmarks', '', 1528730880, 'https://arnaudb.net/links/?do=atom', 'https://arnaudb.net/links/', 'https://arnaudb.net/links/', 1528730760, '200'),
(83, 'Favoris', '', 1528485904, 'http://crashweb.org/?do=atom', 'http://crashweb.org/', 'http://crashweb.org/', 1526311915, '200'),
(84, 'Liens en vrac de Clem', '', 1511599491, 'http://vermot.net/links/?do=atom', 'http://vermot.net/links/', 'http://vermot.net/links/', 1460159630, '200'),
(85, 'Les liens de Jim', '', 1527706167, 'https://www.e-jim.be/liens/?do=atom', 'https://www.e-jim.be/liens/', 'https://www.e-jim.be/liens/', 1524700390, '200'),
(87, 'Shaarli ladmasmien', '', 1528713102, 'http://www.ladmasma.fr/shaarli/?do=atom', 'http://www.ladmasma.fr/shaarli/', 'http://www.ladmasma.fr/shaarli/', 1517479031, '200'),
(88, 'Les hypertextes du barbu digressif', '', 1528665677, 'https://www.lagilb.fr/Shaarli/?do=atom', 'https://www.lagilb.fr/Shaarli/', 'https://www.lagilb.fr/Shaarli/', 1526749949, '200'),
(89, 'Liens et divers de Nicolas Constant', '', 1528387235, 'http://links.nicolas-constant.com/?do=atom', 'http://links.nicolas-constant.com/', 'http://links.nicolas-constant.com/', 1524582158, '200'),
(90, 'Lien en vrac et message de Biniou', '', 1526950590, 'https://biniou.shost.ca/Shaarli/?do=atom', 'https://biniou.shost.ca/Shaarli/', 'https://biniou.shost.ca/Shaarli/', 1515505864, '200'),
(91, 'L\'archive du renard', '', 1496613644, 'https://www.shaarli.fr/my/Killiox/?do=atom', 'https://www.shaarli.fr/my/Killiox/', 'https://www.shaarli.fr/my/Killiox/', 1473850898, '200'),
(92, 'Vrac En Depit Du Bon Sens', '', 1430732868, 'https://www.endepitdubonsens.fr/vrac/?do=atom', 'https://www.endepitdubonsens.fr/vrac/', 'https://www.endepitdubonsens.fr/vrac/', 1417526881, '200'),
(93, 'actualités et liens du Net, booster le ref avec Shaarli', '', 1461955147, 'http://refok.fr/4/?do=atom', 'http://refok.fr/4/', 'http://refok.fr/4/', 1460830676, '200'),
(95, 'JMLRT\'s Shaarli', '', 0, 'https://julien.mailleret.fr/?do=atom', 'https://julien.mailleret.fr/', 'https://julien.mailleret.fr/', 0, ''),
(97, 'tinu', '', 1441920115, 'https://www.shaarli.fr/my/tinu/?do=atom', 'https://www.shaarli.fr/my/tinu/', 'https://www.shaarli.fr/my/tinu/', 1430591304, '200'),
(98, 'liens', '', 1526311829, 'https://www.shaarli.fr/my/georgesa/?do=atom', 'https://www.shaarli.fr/my/georgesa/', 'https://www.shaarli.fr/my/georgesa/', 1518531201, '200'),
(99, 'Abel', '', 1527944583, 'http://abel.antunes.free.fr/shaarli/?do=atom', 'http://abel.antunes.free.fr/shaarli/', 'http://abel.antunes.free.fr/shaarli/', 1510087579, '200'),
(100, 'Partage de liens et d\'humeurs / from &Eacute;ric', '', 0, 'https://eric.bugnet.fr/shaarli/?do=atom', 'https://eric.bugnet.fr/shaarli/', 'https://eric.bugnet.fr/shaarli/', 0, ''),
(101, 'Liens de TD (ancien shaarli)', '', 1426085158, 'https://shaarli.fr/my/TD/?do=atom', 'https://shaarli.fr/my/TD/', 'https://shaarli.fr/my/TD/', 1422396630, '200'),
(102, 'Hello', '', 1431132780, 'https://www.shaarli.fr/my/lolol/?do=atom', 'https://www.shaarli.fr/my/lolol/', 'https://www.shaarli.fr/my/lolol/', 1427570789, '200'),
(103, 'Passe-Temps', '', 1501446278, 'https://shaarli.fr/my/pastan/?do=atom', 'https://shaarli.fr/my/pastan/', 'https://shaarli.fr/my/pastan/', 1464977092, '200'),
(105, 'Necture', '', 1406630687, 'https://shaarli.fr/my/bdv89/?do=atom', 'https://shaarli.fr/my/bdv89/', 'https://shaarli.fr/my/bdv89/', 1316026800, '200'),
(106, 'Gezar\'s links', '', 1426155481, 'https://shaarli.fr/my/gezar/?do=atom', 'https://shaarli.fr/my/gezar/', 'https://shaarli.fr/my/gezar/', 1409160793, '200'),
(107, 'spl33n', '', 1411986305, 'https://shaarli.fr/my/spl33n/?do=atom', 'https://shaarli.fr/my/spl33n/', 'https://shaarli.fr/my/spl33n/', 1406037636, '200'),
(108, 'Where\'s Waldo', '', 1434374766, 'https://shaarli.fr/my/titerin/?do=atom', 'https://shaarli.fr/my/titerin/', 'https://shaarli.fr/my/titerin/', 1409317432, '200'),
(109, 'Grywald\'s Shaarli', '', 1412993302, 'https://shaarli.fr/my/grywald/?do=atom', 'https://shaarli.fr/my/grywald/', 'https://shaarli.fr/my/grywald/', 1316026800, '200'),
(110, 'shaarli 2 charly', '', 1527347308, 'https://shaarli.fr/my/shaarli.de.charly/?do=atom', 'https://shaarli.fr/my/shaarli.de.charly/', 'https://shaarli.fr/my/shaarli.de.charly/', 1506806676, '200'),
(111, 'Carter Phoenix à la rescousse', '', 1523872492, 'https://shaarli.fr/my/carterphoenix/?do=atom', 'https://shaarli.fr/my/carterphoenix/', 'https://shaarli.fr/my/carterphoenix/', 1486573066, '200'),
(112, 'toto', '', 1454369664, 'https://shaarli.fr/my/toto/?do=atom', 'https://shaarli.fr/my/toto/', 'https://shaarli.fr/my/toto/', 1427816816, '200'),
(113, 'yuntux', '', 1466424544, 'https://www.dumaine.me/shaarli/?do=atom', 'https://www.dumaine.me/shaarli/', 'https://www.dumaine.me/shaarli/', 1446126752, '200'),
(114, 'justine', '', 1527082550, 'http://vracaliens.etnik0j.fr/?do=atom', 'http://vracaliens.etnik0j.fr/', 'http://vracaliens.etnik0j.fr/', 1488396393, '200'),
(115, 'Favoris de Chassegnouf', '', 1523394180, 'http://shaarli.chassegnouf.net/?do=atom', 'http://shaarli.chassegnouf.net/', 'http://shaarli.chassegnouf.net/', 1455728164, '200'),
(116, 'AmauryPi', '', -2147483648, 'https://shaarli.amaury.carrade.eu/?do=atom', 'http://shaarli.amaury.carrade.eu/', 'https://shaarli.amaury.carrade.eu/', 1528726320, '200'),
(117, 'Les tout petits liens de Zouzou', '', 0, 'https://dial.contestataire.net/?do=atom', 'https://dial.contestataire.net/', 'https://dial.contestataire.net/', 0, ''),
(118, 'Partager de Alpha à Zeta et bien plus... ', '', 1437801327, 'https://shaarli.fr/my/AlphaZeta/?do=atom', 'https://shaarli.fr/my/AlphaZeta/', 'https://shaarli.fr/my/AlphaZeta/', 1435842978, '200'),
(119, 'CAFAI Liens en Vrac', '', 1504715208, 'https://shaarli.cafai.fr/?do=atom', 'https://shaarli.cafai.fr/', 'https://shaarli.cafai.fr/', 1498014275, '200'),
(120, 'gatitac', '', 1439983419, 'https://links.gatitac.eu/?do=atom', 'https://links.gatitac.eu/', 'https://links.gatitac.eu/', 1397043938, '200'),
(121, 'Belfäläs', '', 1458323558, 'https://links.belfalas.eu/?do=atom', 'https://links.belfalas.eu/', 'https://links.belfalas.eu/', 1406826912, '200'),
(122, 'Shaarli de Sam Ganegie', '', 1528730880, 'http://sameganegie.biz/shaarli/?do=atom', 'http://sameganegie.biz/shaarli/', 'http://sameganegie.biz/shaarli/', 1528730880, '200'),
(123, 'Shaarli geek de geekz0ne.fr', '', 0, 'https://geekz0ne.fr/shaarli/?do=atom', 'https://geekz0ne.fr/shaarli/', 'https://geekz0ne.fr/shaarli/', 0, ''),
(124, 'gathered', '', 1522284644, 'https://ayoglife.net/gathered/?do=atom', 'https://ayoglife.net/gathered/', 'https://ayoglife.net/gathered/', 1499852744, '200'),
(125, 'Shaarli | Orangina Rouge', '', 1527191893, 'https://orangina-rouge.org/shaarli/?do=atom', 'https://orangina-rouge.org/shaarli/', 'https://orangina-rouge.org/shaarli/', 1524531215, '200'),
(126, 'mitsu', '', 1528555747, 'https://suumitsu.eu/links/?do=atom', 'https://suumitsu.eu/links/', 'https://suumitsu.eu/links/', 1508546304, '200'),
(128, 'sebw.info', '', 1528368916, 'http://shaarli.sebw.info/?do=atom', 'http://shaarli.sebw.info/', 'http://shaarli.sebw.info/', 1527628534, '200'),
(129, 'Liens de poneyworld', '', 1525535494, 'http://lafrite.poneyworld.net/liens/?do=atom', 'http://lafrite.poneyworld.net/liens/', 'http://lafrite.poneyworld.net/liens/', 1463024928, '200'),
(130, 'dans mes oreilles', '', 1438165994, 'https://www.shaarli.fr/my/mac551me/?do=atom', 'https://www.shaarli.fr/my/mac551me/', 'https://www.shaarli.fr/my/mac551me/', 1438093035, '200'),
(131, 'Apmez', '', 1494157635, 'https://www.shaarli.fr/my/Apmez/?do=atom', 'https://www.shaarli.fr/my/Apmez/', 'https://www.shaarli.fr/my/Apmez/', 1316026800, '200'),
(132, 'BTS-SIO', '', 1316026800, 'https://www.shaarli.fr/my/BTSSIO/?do=atom', 'https://www.shaarli.fr/my/BTSSIO/', 'https://www.shaarli.fr/my/BTSSIO/', 1316026800, '200'),
(133, 'les liens de Thomas', '', 1447175876, 'https://www.shaarli.fr/my/t0m/?do=atom', 'https://www.shaarli.fr/my/t0m/', 'https://www.shaarli.fr/my/t0m/', 1439481622, '200'),
(134, 'Les lien de Jay Snyper', '', 1316026800, 'https://www.shaarli.fr/my/JaySnyper/?do=atom', 'https://www.shaarli.fr/my/JaySnyper/', 'https://www.shaarli.fr/my/JaySnyper/', 1316026800, '200'),
(135, 'Liens de TD', '', 0, 'https://thomasd.eu/shaarli/?do=atom', 'https://thomasd.eu/shaarli/', 'https://thomasd.eu/shaarli/', 0, ''),
(136, 'Mind Sticky', '', 1514500177, 'https://www.shaarli.fr/my/oOo.Manu.oOo/?do=atom', 'https://www.shaarli.fr/my/oOo.Manu.oOo/', 'https://www.shaarli.fr/my/oOo.Manu.oOo/', 1430986425, '200'),
(137, 'Links from tsyr2ko\'s wandering', '', 1479071559, 'https://www.shaarli.fr/my/tsyr2ko/?do=atom', 'https://www.shaarli.fr/my/tsyr2ko/', 'https://www.shaarli.fr/my/tsyr2ko/', 1453817087, '200'),
(139, 'Crounchez la vie', '', 1458913981, 'https://www.shaarli.fr/my/crounch/?do=atom', 'https://www.shaarli.fr/my/crounch/', 'https://www.shaarli.fr/my/crounch/', 1443611916, '200'),
(141, 'liberté de jouer', '', 1443127607, 'https://www.shaarli.fr/my/4urelienjo/?do=atom', 'https://www.shaarli.fr/my/4urelienjo/', 'https://www.shaarli.fr/my/4urelienjo/', 1442263812, '200'),
(142, '@jeekajoo links', '', 1528284950, 'https://jeekajoo.eu/links/?do=atom', 'https://jeekajoo.eu/links/', 'https://jeekajoo.eu/links/', 1520634058, '200'),
(143, 'Les Liens de Memiks', '', 1528118428, 'https://shaarli.memiks.fr/?do=atom', 'https://shaarli.memiks.fr/', 'https://shaarli.memiks.fr/', 1526362956, '200'),
(144, 'Les petits liens d\'Alda', '', 1528534628, 'https://tools.aldarone.fr/share/?do=atom', 'https://tools.aldarone.fr/share/', 'https://tools.aldarone.fr/share/', 1524749374, '200'),
(145, 'Les petits liens de Angeraph', '', 0, 'http://www.angeraph.fr/?do=atom', 'http://www.angeraph.fr/', 'http://www.angeraph.fr/', 0, ''),
(146, 'grolimur\'s shared links', '', 1528703349, 'https://www.gerardmenvussa.ch/shaarli/?do=atom', 'https://www.gerardmenvussa.ch/shaarli/', 'https://www.gerardmenvussa.ch/shaarli/', 1525471852, '200'),
(147, 'Capabilities', '', 1448683063, 'https://www.shaarli.fr/my/capabilities/?do=atom', 'https://www.shaarli.fr/my/capabilities/', 'https://www.shaarli.fr/my/capabilities/', 1448451853, '200'),
(148, 'Liens de Cochise', '', 1526642400, 'https://links.cochi.se/?do=atom', 'https://links.cochi.se/', 'https://links.cochi.se/', 1508752803, '200'),
(149, 'Liens des pleutres', '', 1525273876, 'https://sh.ack.red/?do=atom', 'https://sh.ack.red/', 'https://sh.ack.red/', 1466697199, '200'),
(150, 'glanaged2de', '', 1446698454, 'https://www.shaarli.fr/my/dididi/?do=atom', 'https://www.shaarli.fr/my/dididi/', 'https://www.shaarli.fr/my/dididi/', 1316026800, '200'),
(151, 'Moinot', '', 1527971777, 'https://www.shaarli.fr/my/Moinot/?do=atom', 'https://www.shaarli.fr/my/Moinot/', 'https://www.shaarli.fr/my/Moinot/', 1493328304, '200'),
(152, 'Liandri\'s Links.', '', 1528730880, 'https://shaar.libox.fr/?do=atom', 'https://shaar.libox.fr/', 'https://shaar.libox.fr/', 1528730880, '200'),
(153, 'Eyes of Universe', '', 1509139536, 'https://eyes-of-universe.eu/shaarli/?do=atom', 'https://eyes-of-universe.eu/shaarli/', 'https://eyes-of-universe.eu/shaarli/', 1487965457, '200'),
(154, 'Plop Links', '', 1528636567, 'http://shaarli.plop.me/?do=atom', 'http://shaarli.plop.me/', 'http://shaarli.plop.me/', 1528152285, '200'),
(155, 'nabella', '', 1457948288, 'http://nabella.digital-engine.info/shaarli/?do=atom', 'http://nabella.digital-engine.info/shaarli/', 'http://nabella.digital-engine.info/shaarli/', 1413984341, '200'),
(156, 'Fylhan\\\'s links lounge', '', 1528296961, 'http://links.la-bnbox.fr/?do=atom', 'http://links.la-bnbox.fr/', 'http://links.la-bnbox.fr/', 1523023985, '200'),
(157, 'Mes petits liens à sauvegarder', '', 1441049371, 'http://shaarli.matronix.fr/?do=atom', 'http://shaarli.matronix.fr/', 'http://shaarli.matronix.fr/', 1391014039, '200'),
(158, 'Geek and Tips links', '', 1449664019, 'http://geekandtips.com/links/?do=atom', 'http://geekandtips.com/links/', 'http://geekandtips.com/links/', 1434642046, '200'),
(159, 'Les petits liens de Angeraph', '', 1512469622, 'http://angeraph.fr/shaarli/?do=atom', 'http://angeraph.fr/shaarli/', 'http://angeraph.fr/shaarli/', 1490352002, '200'),
(160, 'Les petits liens de Angeraph', '', 1512469622, 'http://www.angeraph.fr/shaarli/?do=atom', 'http://www.angeraph.fr/shaarli/', 'http://www.angeraph.fr/shaarli/', 1490352002, '200'),
(161, 'ToutEtRien | Codeur Impulsif', '', 1515683689, 'https://toutetrien.lithio.fr/links/?do=atom', 'https://toutetrien.lithio.fr/links/', 'https://toutetrien.lithio.fr/links/', 1443904350, '200'),
(162, 'Dhoko/liens', '', 1528709010, 'http://dhoko.me/liens/?do=atom', 'http://dhoko.me/liens/', 'http://dhoko.me/liens/', 1525120417, '200'),
(163, 'Links · Devenet', '', 1528472670, 'https://web.devenet.eu/links/?do=atom', 'https://web.devenet.eu/links/', 'https://web.devenet.eu/links/', 1510090639, '200'),
(164, 'Eyes of Universe', '', 0, 'http://eyes-of-universe.eu/?do=atom', 'http://eyes-of-universe.eu/', 'http://eyes-of-universe.eu/', 0, ''),
(166, 'Les Liens de Maxsowilli', '', 0, 'https://www.shaarli.fr/my/maxsowilli/?do=atom', 'https://www.shaarli.fr/my/maxsowilli/', 'https://www.shaarli.fr/my/maxsowilli/', 0, '200'),
(167, 'Puzobo', '', 1526819878, 'https://www.shaarli.fr/my/puzobo/?do=atom', 'https://www.shaarli.fr/my/puzobo/', 'https://www.shaarli.fr/my/puzobo/', 1502418088, '200'),
(168, 'fhosatte', '', 1465312073, 'https://www.shaarli.fr/my/fhosatte/?do=atom', 'https://www.shaarli.fr/my/fhosatte/', 'https://www.shaarli.fr/my/fhosatte/', 1444907475, '200'),
(169, 'PoGo', '', 1513594321, 'https://wtf.roflcopter.fr/links/pogo/?do=atom', 'https://wtf.roflcopter.fr/links/pogo/', 'https://wtf.roflcopter.fr/links/pogo/', 1469614501, '200'),
(170, 'Shaarlithake | Max\'s links', '', 1505139645, 'https://ithake.eu/shaarli/?do=atom', 'https://ithake.eu/shaarli/', 'https://ithake.eu/shaarli/', 1485960426, '200'),
(171, 'Les liens de Fanch', '', 1528633359, 'https://links.qth.fr/?do=atom', 'https://links.qth.fr/', 'https://links.qth.fr/', 1525213925, '200'),
(173, 'Liens [quaternum]', '', 1401799517, 'https://liens.quaternum.net/?do=atom', 'https://liens.quaternum.net/', 'https://liens.quaternum.net/', 1356879622, '200'),
(174, 'palkeo - liens', '', 1528730880, 'https://links.palkeo.com/?do=atom', 'https://www.palkeo.com/shaarli/', 'https://links.palkeo.com/', 1528730160, '200'),
(176, 'Les liens de Brihx', '', 1526322106, 'https://shaarli.brihx.fr/?do=atom', 'https://shaarli.brihx.fr/', 'https://shaarli.brihx.fr/', 1511540540, '200'),
(177, 'mon surf en partage', '', 1466114768, 'https://shaarli.fr/my/uNouss/?do=atom', 'https://shaarli.fr/my/uNouss/', 'https://shaarli.fr/my/uNouss/', 1461998200, '200'),
(178, 'Ginko\'s Link Dump', '', 1525957437, 'https://ginkobox.fr/shaarli/?do=atom', 'https://ginkobox.fr/shaarli/', 'https://ginkobox.fr/shaarli/', 1506685260, '200'),
(179, 'shaarliGor', '', 1526279298, 'https://id-libre.org/shaarli/?do=atom', 'https://id-libre.org/shaarli/', 'https://id-libre.org/shaarli/', 1518594698, '200'),
(180, 'Liens en vrac de Tiger-222', '', 1528359895, 'http://www.tiger-222.fr/links/?do=atom', 'http://www.tiger-222.fr/links/', 'http://www.tiger-222.fr/links/', 1519941266, '200'),
(181, 'Les liens de Knah Tsaeb', '', 1526369503, 'https://book.knah-tsaeb.org/?do=atom', 'https://book.knah-tsaeb.org/', 'https://book.knah-tsaeb.org/', 1517389290, '200'),
(182, 'Shaarli de Marc', '', 1528480138, 'https://www.ascadia.net/links/?do=atom', 'https://www.ascadia.net/links/', 'https://www.ascadia.net/links/', 1526024775, '200'),
(183, 'Jcfrog\'s shaarli', '', 1528648273, 'https://jcfrog.com/shaarli41/?do=atom', 'https://jcfrog.com/shaarli41/', 'https://jcfrog.com/shaarli41/', 1527671203, '200'),
(184, 'alexis j : : web', '', 1526557128, 'https://liens.effingo.be/?do=atom', 'https://liens.effingo.be/', 'https://liens.effingo.be/', 1523357736, '200'),
(185, 'pierreghz', '', 1392566542, 'https://pierreghz.legtux.org/links/?do=atom', 'https://pierreghz.legtux.org/links/', 'https://pierreghz.legtux.org/links/', 1378974085, '200'),
(186, 'Valentin Champer', '', 1520026287, 'https://tviblindi.legtux.org/shaarli/?do=atom', 'https://tviblindi.legtux.org/shaarli/', 'https://tviblindi.legtux.org/shaarli/', 1511620978, '200'),
(187, 'Les liens de Nagumo', '', 1519926056, 'https://www.lacaryatide.fr/liens/?do=atom', 'https://www.lacaryatide.fr/liens/', 'https://www.lacaryatide.fr/liens/', 1467392339, '200'),
(188, 'Gopi', '', 1425479031, 'https://perso.ens-lyon.fr/guillaume.aupy/shaarli/?do=atom', 'https://perso.ens-lyon.fr/guillaume.aupy/shaarli/', 'https://perso.ens-lyon.fr/guillaume.aupy/shaarli/', 1388697019, '200'),
(189, 'Sykius - Shaarli', '', 1521070940, 'https://sykius.fr/shaarli/?do=atom', 'https://sykius.fr/shaarli/', 'https://sykius.fr/shaarli/', 1396363799, '200'),
(190, ' e-loquens', '', 1528730460, 'https://shaarli.e-loquens.fr/?do=atom', 'https://shaarli.e-loquens.fr/shaarli/', 'https://shaarli.e-loquens.fr/', -2147483648, '200'),
(191, 'GuiGui\'s Show - Liens', '', 1528655244, 'https://shaarli.guiguishow.info/?do=atom', 'https://shaarli.guiguishow.info/', 'https://shaarli.guiguishow.info/', 1528024475, '200'),
(192, 'sbgodin.fr', '', 1518174496, 'https://shaarli.sbgodin.fr/?do=atom', 'https://shaarli.sbgodin.fr/', 'https://shaarli.sbgodin.fr/', 1488895737, '200'),
(194, 'Les liens de Kevin Merigot', '', 1528474998, 'https://www.mypersonnaldata.eu/shaarli/?do=atom', 'https://www.mypersonnaldata.eu/shaarli/', 'https://www.mypersonnaldata.eu/shaarli/', 1527517062, '200'),
(195, 'Best of the best links', '', 1525207013, 'https://qosgof.fr/fosteb/?do=atom', 'https://qosgof.fr/fosteb/', 'https://qosgof.fr/fosteb/', 1525110162, '200'),
(196, 'Links | Adrian Gaudebert', '', 1526514090, 'https://adrian.gaudebert.fr/feed/?do=atom', 'https://adrian.gaudebert.fr/feed/', 'https://adrian.gaudebert.fr/feed/', 1507548515, '200'),
(197, 'BastLiens', '', 1391683906, 'https://www.tribuleblanc.com/shaarli/?do=atom', 'https://www.tribuleblanc.com/shaarli/', 'https://www.tribuleblanc.com/shaarli/', 1316026800, '200'),
(198, 'bookmarks', '', 1522410158, 'https://www.la-pub-dans-les-films.fr/shaarli/?do=atom', 'https://www.la-pub-dans-les-films.fr/shaarli/', 'https://www.la-pub-dans-les-films.fr/shaarli/', 1447118016, '200'),
(199, 'xuv\'s bookmarks', '', 1527466844, 'https://b.xuv.be/?do=atom', 'https://b.xuv.be/', 'https://b.xuv.be/', 1518330675, '200'),
(200, 'Le bazar de mydjey', '', 1528581348, 'https://shaarli.mydjey.eu/?do=atom', 'https://shaarli.mydjey.eu/', 'https://shaarli.mydjey.eu/', 1523782270, '200'),
(201, 'Maih.eu - Links', '', 1528238644, 'https://links.maih.eu/?do=atom', 'https://links.maih.eu/', 'https://links.maih.eu/', 1499030275, '200'),
(204, 'yakmoijebrille', '', 1528710929, 'https://fabienm.eu/shaarli/?do=atom', 'https://fabienm.eu/shaarli/', 'https://fabienm.eu/shaarli/', 1527603840, '200'),
(205, 'Aceawan\'s links', '', 1440082435, 'https://my.shaarli.fr/aceawan/?do=atom', 'https://my.shaarli.fr/aceawan/', 'https://my.shaarli.fr/aceawan/', 1407848051, '200'),
(206, 'BiblioManchot', '', 1528699738, 'https://gilles.wittezaele.fr/pro/liens/?do=atom', 'https://gilles.wittezaele.fr/pro/liens/', 'https://gilles.wittezaele.fr/pro/liens/', 1520324230, '200'),
(207, 'La vache libre', '', 1431209103, 'https://la-vache-libre.org/shaarli/?do=atom', 'https://la-vache-libre.org/shaarli/', 'https://la-vache-libre.org/shaarli/', 1426788377, '200'),
(208, 'spl33n', '', 1411986305, 'https://my.shaarli.fr/spl33n/?do=atom', 'https://my.shaarli.fr/spl33n/', 'https://my.shaarli.fr/spl33n/', 1406037636, '200'),
(209, 'Links from tsyr2ko\'s wandering', '', 1479071559, 'https://my.shaarli.fr/tsyr2ko/?do=atom', 'https://my.shaarli.fr/tsyr2ko/', 'https://my.shaarli.fr/tsyr2ko/', 1453817087, '200'),
(210, 'Passe-Temps', '', 1501446278, 'https://my.shaarli.fr/pastan/?do=atom', 'https://my.shaarli.fr/pastan/', 'https://my.shaarli.fr/pastan/', 1464977092, '200'),
(212, 'Necture', '', 1406630687, 'https://my.shaarli.fr/bdv89/?do=atom', 'https://my.shaarli.fr/bdv89/', 'https://my.shaarli.fr/bdv89/', 1316026800, '200'),
(213, 'Gezar\'s links', '', 1426155481, 'https://my.shaarli.fr/gezar/?do=atom', 'https://my.shaarli.fr/gezar/', 'https://my.shaarli.fr/gezar/', 1409160793, '200'),
(214, 'Where\'s Waldo', '', 1434374766, 'https://my.shaarli.fr/titerin/?do=atom', 'https://my.shaarli.fr/titerin/', 'https://my.shaarli.fr/titerin/', 1409317432, '200'),
(215, 'Vous reprendrez bien quelques liens', '', 1500979897, 'https://my.shaarli.fr/regishamann/?do=atom', 'https://my.shaarli.fr/regishamann/', 'https://my.shaarli.fr/regishamann/', 1488787045, '200'),
(216, 'shaarli 2 charly', '', 1527347308, 'https://my.shaarli.fr/shaarli.de.charly/?do=atom', 'https://my.shaarli.fr/shaarli.de.charly/', 'https://my.shaarli.fr/shaarli.de.charly/', 1506806676, '200'),
(217, 'Grywald\'s Shaarli', '', 1412993302, 'https://my.shaarli.fr/grywald/?do=atom', 'https://my.shaarli.fr/grywald/', 'https://my.shaarli.fr/grywald/', 1316026800, '200'),
(218, 'Freedom Comments', '', 1406285450, 'https://my.shaarli.fr/Funvrac/?do=atom', 'https://my.shaarli.fr/Funvrac/', 'https://my.shaarli.fr/Funvrac/', 1406142181, '200'),
(219, 'Liens d\'Elgrosp', '', 1410253768, 'https://my.shaarli.fr/elgrosp/?do=atom', 'https://my.shaarli.fr/elgrosp/', 'https://my.shaarli.fr/elgrosp/', 1366643545, '200'),
(220, 'Carter Phoenix à la rescousse', '', 1523872492, 'https://my.shaarli.fr/carterphoenix/?do=atom', 'https://my.shaarli.fr/carterphoenix/', 'https://my.shaarli.fr/carterphoenix/', 1486573066, '200'),
(221, 'L\'archive du renard', '', 1496613644, 'https://my.shaarli.fr/Killiox/?do=atom', 'https://my.shaarli.fr/Killiox/', 'https://my.shaarli.fr/Killiox/', 1473850898, '200'),
(222, 'Mes Bookmarks / Favoris', '', 1528407789, 'https://bookmarks.xavierbarbot.com/?do=atom', 'https://bookmarks.xavierbarbot.com/', 'https://bookmarks.xavierbarbot.com/', 1520596977, '200'),
(223, 'Chez OuahOuah - des liens et du hack !', '', 1527714405, 'https://www.ouahouah.eu/links/?do=atom', 'https://www.ouahouah.eu/links/', 'https://www.ouahouah.eu/links/', 1462551246, '200'),
(224, 'tinu', '', 1441920115, 'https://my.shaarli.fr/tinu/?do=atom', 'https://my.shaarli.fr/tinu/', 'https://my.shaarli.fr/tinu/', 1430591304, '200'),
(226, 'Pas de pierre, pas de palais... Pas de palais... Pas de palais !', '', 1528536531, 'https://my.shaarli.fr/dave_idem/?do=atom', 'https://my.shaarli.fr/dave_idem/', 'https://my.shaarli.fr/dave_idem/', 1526162288, '200'),
(227, 'wdavidoff', '', 1528016621, 'https://my.shaarli.fr/wdavidoff/?do=atom', 'https://my.shaarli.fr/wdavidoff/', 'https://my.shaarli.fr/wdavidoff/', 1470160576, '200'),
(228, 'Liens d\'un Parigot-Manchot', '', 1528068903, 'https://gilles.wittezaele.fr/liens/?do=atom', 'https://gilles.wittezaele.fr/liens/', 'https://gilles.wittezaele.fr/liens/', 1526203090, '200'),
(229, 'Shared links on http://my.shaarli.fr/aguy/', '', 1459807736, 'https://my.shaarli.fr/aguy/?do=atom', 'https://my.shaarli.fr/aguy/', 'https://my.shaarli.fr/aguy/', 1459524526, '200'),
(230, 'Zestes d\'id&eacute;es // Ideas\' zests', '', 1527623500, 'https://my.shaarli.fr/Kumquat/?do=atom', 'https://my.shaarli.fr/Kumquat/', 'https://my.shaarli.fr/Kumquat/', 1520965881, '200'),
(231, '&#9668; Raphael\'s shaarlinks &#9658;', '', 1511197582, 'https://my.shaarli.fr/raphael/?do=atom', 'https://my.shaarli.fr/raphael/', 'https://my.shaarli.fr/raphael/', 1494891786, '200'),
(232, 'wagabow', '', 1452121836, 'https://my.shaarli.fr/wagabow/?do=atom', 'https://my.shaarli.fr/wagabow/', 'https://my.shaarli.fr/wagabow/', 1438184951, '200'),
(233, 'Celeanos Bookmarks', '', 1437642415, 'https://my.shaarli.fr/Celeano/?do=atom', 'https://my.shaarli.fr/Celeano/', 'https://my.shaarli.fr/Celeano/', 1316026800, '200'),
(234, 'LoicGDL', '', 1440536726, 'https://my.shaarli.fr/LoicGDL/?do=atom', 'https://my.shaarli.fr/LoicGDL/', 'https://my.shaarli.fr/LoicGDL/', 1316026800, '200'),
(235, 'The Artist Links', '', 1524564950, 'https://planetexpress.fr/links/?do=atom', 'https://planetexpress.fr/links/', 'https://planetexpress.fr/links/', 1493025444, '200'),
(236, 'Du Quertz', '', 1448475108, 'https://my.shaarli.fr/Jadiquertz/?do=atom', 'https://my.shaarli.fr/Jadiquertz/', 'https://my.shaarli.fr/Jadiquertz/', 1316026800, '200'),
(237, 'Strak.ch | Actu et liens en vrac', '', 1528730880, 'https://liens.strak.ch/?do=atom', 'https://liens.strak.ch/', 'https://liens.strak.ch/', 1528730820, '200'),
(238, 'Liens en vrac de SimonLefort', '', 1527844745, 'http://www.simonlefort.be/links/?do=atom', 'http://www.simonlefort.be/links/', 'http://www.simonlefort.be/links/', 1513765140, '200'),
(241, 'Kalvn\'s links', '', 1528730880, 'https://links.kalvn.net/?do=atom', 'https://links.kalvn.net/', 'https://links.kalvn.net/', 1528730820, '200'),
(242, 'AMOK WEB Shaarli - Liens en vrac de Ludo', '', 1527499482, 'http://ludo.amok.free.fr/shaarli/?do=atom', 'http://ludo.amok.free.fr/shaarli/', 'http://ludo.amok.free.fr/shaarli/', 1508411234, '200'),
(243, 'Letouane - Mes ressources', '', 1522061976, 'http://afnet.esy.es/?do=atom', 'http://afnet.esy.es/', 'http://afnet.esy.es/', 1512562611, '200'),
(244, 'iGoX\'s Links', '', 1528670582, 'https://shaarli.igox.org/?do=atom', 'https://shaarli.igox.org/', 'https://shaarli.igox.org/', 1522804107, '200'),
(245, 'Liens d\'ellerauqa', '', 1467141974, 'https://www.shaarli.fr/my/ellerauqa/?do=atom', 'https://www.shaarli.fr/my/ellerauqa/', 'https://www.shaarli.fr/my/ellerauqa/', 1462495367, '200'),
(247, 'Bill2\'s Links', '', 1528529299, 'http://links.bill2-software.com/shaarli/?do=atom', 'http://links.bill2-software.com/shaarli/', 'http://links.bill2-software.com/shaarli/', 1515147265, '200'),
(248, 'maniakteam', '', 1528301202, 'https://bahadour.fr/link/?do=atom', 'https://bahadour.fr/link/', 'https://bahadour.fr/link/', 1456314826, '200'),
(249, 'Riff\'s Links', '', 1528730880, 'https://www.seven-ash-street.fr/links/?do=atom', 'https://www.seven-ash-street.fr/links/', 'https://www.seven-ash-street.fr/links/', 1528730880, '200'),
(251, 'Roy’s Pilofshiet', '', 1468440422, 'https://rdmz.lockhart.fr/shaarli/?do=atom', 'https://rdmz.lockhart.fr/shaarli/', 'https://rdmz.lockhart.fr/shaarli/', 1458494463, '200'),
(252, 'Les Post-It de la MerMouY', '', 1526151792, 'http://shaarli.youm.org/?do=atom', 'http://shaarli.youm.org/', 'http://shaarli.youm.org/', 1487814183, '200'),
(253, 'Dans la poche de Dimtion', '', 0, 'https://shaarli.dimtion.fr/?do=atom', 'https://shaarli.dimtion.fr/', 'https://shaarli.dimtion.fr/', 0, '200'),
(254, 'BASE Jump et mauvaise humeur', '', 1512338626, 'https://shaarli.base-jump.info/?do=atom', 'https://shaarli.base-jump.info/', 'https://shaarli.base-jump.info/', 1466452554, '200'),
(255, 'Les bons liens du Gégé...', '', 1527847790, 'https://bookmarks.geekandfree.org/?do=atom', 'https://bookmarks.geekandfree.org/', 'https://bookmarks.geekandfree.org/', 1516058283, '200'),
(257, 'li.sajous.net', '', 1528319684, 'https://li.sajous.net/?do=atom', 'https://li.sajous.net/', 'https://li.sajous.net/', 1495180988, '200'),
(258, 'Nos liens débiles', '', 0, 'https://shaarli.bananium.fr/?do=atom', 'https://shaarli.bananium.fr/', 'https://shaarli.bananium.fr/', 0, ''),
(259, 'Shaarli des OrAnGeS', '', 1480367427, 'https://www.forum-des-oranges.fr/shaarli/?do=atom', 'https://www.forum-des-oranges.fr/shaarli/', 'https://www.forum-des-oranges.fr/shaarli/', 1435333478, '200'),
(260, 'Vivi\'s Links', '', 1370994275, 'http://links.vivihome.net/?do=atom', 'http://links.vivihome.net/', 'http://links.vivihome.net/', 1360285660, '200'),
(261, 'Yosko\'s shaarli', '', 1512728427, 'https://links.yosko.net/?do=atom', 'https://links.yosko.net/', 'https://links.yosko.net/', 1390578373, '200'),
(262, 'Actu sécu', '', 1518522835, 'https://piau-informatique.net/shaarli/?do=atom', 'https://piau-informatique.net/shaarli/', 'https://piau-informatique.net/shaarli/', 1498648245, '200'),
(263, 'Liens de Mut', '', 1521721726, 'https://www.apprenti-polyglotte.net/liens/?do=atom', 'https://www.apprenti-polyglotte.net/liens/', 'https://www.apprenti-polyglotte.net/liens/', 1378216582, '200'),
(264, 'Mon GN - News Gnistes', '', 1440258238, 'http://www.lochot.com/flux/?do=atom', 'http://www.lochot.com/flux/', 'http://www.lochot.com/flux/', 1415781630, '200'),
(265, 'FouineShaar', '', 1528630730, 'https://lafouinebox.fr/Shaarli/?do=atom', 'https://lafouinebox.fr/Shaarli/', 'https://lafouinebox.fr/Shaarli/', 1519069431, '200'),
(266, 'phyks', '', 1523120743, 'https://links.phyks.me/?do=atom', 'https://links.phyks.me/', 'https://links.phyks.me/', 1514381005, '200'),
(267, '~ sweet ~', '', 1525425537, 'https://dukeart.netlib.re/shaarli/?do=atom', 'https://dukeart.netlib.re/shaarli/', 'https://dukeart.netlib.re/shaarli/', 1504436083, '200'),
(268, 'Shaarli de Erase', '', 1528400054, 'https://links.green-effect.fr/?do=atom', 'https://links.green-effect.fr/', 'https://links.green-effect.fr/', 1525444586, '200'),
(270, '2038 - Links', '', 1519375025, 'https://2038.net/links/?do=atom', 'https://2038.net/links/', 'https://2038.net/links/', 1468757172, '200'),
(271, 'MisterK\'s link selection', '', 1481125982, 'http://www.kassabji.org/shaarli/?do=atom', 'http://www.kassabji.org/shaarli/', 'http://www.kassabji.org/shaarli/', 1453058186, '200'),
(272, 'Liens de Neros', '', 1527606353, 'https://links.neros.fr/?do=atom', 'https://links.neros.fr/', 'https://links.neros.fr/', 1525470759, '200'),
(273, 'de Riduidel', '', 1528730880, 'https://nicolas-delsaux.hd.free.fr/Shaarli/?do=atom', 'https://nicolas-delsaux.hd.free.fr/Shaarli/', 'https://nicolas-delsaux.hd.free.fr/Shaarli/', 1528730880, '200'),
(274, 'aceawan@links', '', 1527957224, 'https://shaarli.aceawan.eu/?do=atom', 'https://shaarli.aceawan.eu/', 'https://shaarli.aceawan.eu/', 1524662989, '200'),
(275, 'Choses vues, sur le web et ailleurs', '', 1528473684, 'https://www.sammyfisherjr.net/Shaarli/?do=atom', 'https://www.sammyfisherjr.net/Shaarli/', 'https://www.sammyfisherjr.net/Shaarli/', 1527789729, '200'),
(276, 'Kourai\'s Bookmarks and Saves', '', 1528384098, 'http://yggz.org/Shaarli/?do=atom', 'http://yggz.org/Shaarli/', 'http://yggz.org/Shaarli/', 1519313196, '200'),
(278, 'Wr0ng.Name', '', 1527915763, 'https://links.wr0ng.name/?do=atom', 'https://links.wr0ng.name/', 'https://links.wr0ng.name/', 1518606913, '200'),
(279, 'mayaj', '', 1528306769, 'http://mayaweb.fr/links/?do=atom', 'http://mayaweb.fr/links/', 'http://mayaweb.fr/links/', 1515687678, '200'),
(280, 'Martouf', '', 1528730880, 'https://martouf.ch/liens/?do=atom', 'https://martouf.ch/liens/', 'https://martouf.ch/liens/', 1528730880, '200'),
(282, 'Liens utiles et à partager', '', 1528453073, 'https://chezsoi.org/shaarli/?do=atom', 'https://chezsoi.org/shaarli/', 'https://chezsoi.org/shaarli/', 1525097008, '200'),
(283, 'L\'espace... Cifiste', '', 1528650783, 'https://daniel.gorgones.net/shaarli/?do=atom', 'https://daniel.gorgones.net/shaarli/', 'https://daniel.gorgones.net/shaarli/', 1525618273, '200'),
(285, 'Un catalogue hétéroclite (shaarli d\'e-loquens.fr)', '', 1521901573, 'https://e-loquens.fr/?do=atom', 'https://e-loquens.fr/', 'https://e-loquens.fr/', 1487666672, '200'),
(286, 'Dream', '', 1517143747, 'http://costumescrime.net/shaarli/?do=atom', 'http://costumescrime.net/shaarli/', 'http://costumescrime.net/shaarli/', 1448378075, '200'),
(291, 'L!NKS', '', 0, 'http://spynaej.eu/links/?do=atom', 'http://spynaej.eu/links/', 'http://spynaej.eu/links/', 0, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `sharers`
--
ALTER TABLE `sharers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uri` (`uri`),
  ADD KEY `uri_2` (`uri`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sharers`
--
ALTER TABLE `sharers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
