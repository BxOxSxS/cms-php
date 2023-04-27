-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2023 at 09:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fb`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `value`) VALUES
(1, 11, 20, 1),
(2, 11, 13, -1),
(3, 8, 11, 1),
(4, 18, 12, 1),
(5, 20, 16, -1),
(6, 2, 10, 1),
(7, 16, 2, -1),
(8, 7, 4, 1),
(9, 19, 9, -1),
(10, 15, 3, 1),
(11, 5, 13, 0),
(12, 6, 10, 1),
(13, 15, 15, 1),
(14, 2, 1, -1),
(15, 17, 5, -1),
(16, 4, 13, -1),
(17, 10, 2, -1),
(18, 6, 14, -1),
(19, 5, 10, 1),
(20, 18, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `timestamp`) VALUES
(1, 13, 'luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus orci luctus', '2023-04-27 17:44:49'),
(2, 7, 'at turpis donec posuere metus vitae ipsum aliquam non mauris', '2023-04-27 17:44:49'),
(3, 5, 'nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia', '2023-04-27 17:44:49'),
(4, 5, 'vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede', '2023-04-27 17:44:49'),
(5, 11, 'rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi', '2023-04-27 17:44:49'),
(6, 15, 'turpis eget elit sodales scelerisque mauris sit', '2023-04-27 17:44:49'),
(7, 11, 'non pretium quis lectus suspendisse', '2023-04-27 17:44:49'),
(8, 15, 'nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor', '2023-04-27 17:44:49'),
(9, 3, 'morbi odio odio elementum eu interdum eu tincidunt in leo maecenas', '2023-04-27 17:44:49'),
(10, 3, 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis', '2023-04-27 17:44:49'),
(11, 9, 'vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis', '2023-04-27 17:44:49'),
(12, 5, 'sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel', '2023-04-27 17:44:49'),
(13, 18, 'curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est', '2023-04-27 17:44:49'),
(14, 19, 'sed augue aliquam erat volutpat in congue etiam justo etiam pretium', '2023-04-27 17:44:49'),
(15, 20, 'nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti', '2023-04-27 17:44:49'),
(16, 11, 'ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices', '2023-04-27 17:44:49'),
(17, 17, 'montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl', '2023-04-27 17:44:49'),
(18, 15, 'mi integer ac neque duis bibendum morbi non quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl', '2023-04-27 17:44:49'),
(19, 17, 'donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac', '2023-04-27 17:44:49'),
(20, 19, 'varius ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus', '2023-04-27 17:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `users_bio`
--

CREATE TABLE `users_bio` (
  `id` int(11) DEFAULT NULL,
  `bio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_bio`
--

INSERT INTO `users_bio` (`id`, `bio`) VALUES
(1, 'Salter-Harris Type IV physeal fracture of lower en'),
(2, 'Focal chorioretin inflam, macular or paramacular, '),
(3, 'Unsp fx first MC bone, unsp hand, subs for fx w ma'),
(4, 'Nondisp fx of lateral condyle of r femr, 7thE'),
(5, 'Corrosions involving 30-39% of body surface'),
(6, 'Frostbite with tissue necrosis of right toe(s)'),
(7, 'Unspecified superficial injury of left upper arm, '),
(8, 'Mucopolysaccharidosis, unspecified'),
(9, 'Laceration without foreign body of thyroid gland, '),
(10, 'Nondisp fx of body of left calcaneus, init for clo'),
(11, 'Unsp physl fx lower end r fibula, subs for fx w ro'),
(12, 'Parasomnia in conditions classified elsewhere'),
(13, 'Salter-Harris Type IV physeal fracture of right ca'),
(14, 'Corrosion of cornea and conjunctival sac, unsp eye'),
(15, 'Myositis ossificans traumatica, unspecified site'),
(16, 'Displacmnt of cardiac and vascular devices and imp'),
(17, 'Corros 30-39% of body surface w 30-39% third degre'),
(18, 'Other streptococcal arthritis, left hand'),
(19, 'Displaced unspecified fracture of unspecified less'),
(20, 'Unspecified open wound, unspecified thigh, subs en');

-- --------------------------------------------------------

--
-- Table structure for table `users_email`
--

CREATE TABLE `users_email` (
  `id` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_email`
--

INSERT INTO `users_email` (`id`, `email`) VALUES
(1, 'jnewell0@smugmug.com'),
(2, 'pstukings1@illinois.edu'),
(3, 'avallery2@businessinsider.com'),
(4, 'agauge3@uol.com.br'),
(5, 'ltooting4@yandex.ru'),
(6, 'jhaszard5@toplist.cz'),
(7, 'khammonds6@skyrock.com'),
(8, 'nrolley7@cdbaby.com'),
(9, 'rsyalvester8@amazonaws.com'),
(10, 'jcoie9@uiuc.edu'),
(11, 'klambertoa@uol.com.br'),
(12, 'mlocalb@google.ru'),
(13, 'rrubenovicc@gravatar.com'),
(14, 'afeckeyd@angelfire.com'),
(15, 'shruse@biblegateway.com'),
(16, 'fwidocksf@prweb.com'),
(17, 'cenochssong@i2i.jp'),
(18, 'agarthlandh@slate.com'),
(19, 'dbarenskiei@theguardian.com'),
(20, 'dfoggoj@1und1.de');

-- --------------------------------------------------------

--
-- Table structure for table `users_firstname`
--

CREATE TABLE `users_firstname` (
  `id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_firstname`
--

INSERT INTO `users_firstname` (`id`, `first_name`) VALUES
(1, 'Sam'),
(2, 'Peterus'),
(3, 'Ruddy'),
(4, 'Shaine'),
(5, 'Gustave'),
(6, 'Giles'),
(7, 'Corey'),
(8, 'Moses'),
(9, 'Lind'),
(10, 'Barry'),
(11, 'Ian'),
(12, 'Tandy'),
(13, 'Bradly'),
(14, 'Ettie'),
(15, 'Cati'),
(16, 'Eunice'),
(17, 'Giselle'),
(18, 'Amanda'),
(19, 'Faunie'),
(20, 'Nisse');

-- --------------------------------------------------------

--
-- Table structure for table `users_gender`
--

CREATE TABLE `users_gender` (
  `id` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_gender`
--

INSERT INTO `users_gender` (`id`, `gender`) VALUES
(1, '空'),
(2, '廖'),
(3, '汤'),
(4, '桂'),
(5, '温'),
(6, '缪'),
(7, '沈'),
(8, '终'),
(9, '郁'),
(10, '步'),
(11, '訾'),
(12, '能'),
(13, '松'),
(14, '左'),
(15, '蔡'),
(16, '严'),
(17, '纪'),
(18, '怀'),
(19, '聂'),
(20, '居');

-- --------------------------------------------------------

--
-- Table structure for table `users_lastname`
--

CREATE TABLE `users_lastname` (
  `id` int(11) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_lastname`
--

INSERT INTO `users_lastname` (`id`, `last_name`) VALUES
(1, 'Canny'),
(2, 'Prydie'),
(3, 'Wilcock'),
(4, 'Caro'),
(5, 'Stoodale'),
(6, 'Tynnan'),
(7, 'Blakeborough'),
(8, 'Ferney'),
(9, 'Dundendale'),
(10, 'Disman'),
(11, 'Mont'),
(12, 'Sperski'),
(13, 'Nibley'),
(14, 'Bonny'),
(15, 'Mc Caghan'),
(16, 'Itzkin'),
(17, 'Marklew'),
(18, 'Barr'),
(19, 'Cribbins'),
(20, 'MacCulloch');

-- --------------------------------------------------------

--
-- Table structure for table `users_password`
--

CREATE TABLE `users_password` (
  `id` int(11) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_password`
--

INSERT INTO `users_password` (`id`, `password`) VALUES
(1, 'ByAiETV'),
(2, 'QczCmSdF'),
(3, 'SCpZWiWCVtE5'),
(4, 'cnJYlIaVSH'),
(5, 'ctcf5FNq'),
(6, 'GlUres'),
(7, 'mGoO0j'),
(8, 'jguG3FN3IY'),
(9, 'M7lbf2Qk'),
(10, '8bMnJJ'),
(11, '2d8avYsp'),
(12, 'PMMuII9cP'),
(13, 'u70yb4'),
(14, 'Vy6hNj'),
(15, '7fhyFsdhXI3'),
(16, 'CBHnV28'),
(17, '2vg18e'),
(18, 'Tz034VJjLxbP'),
(19, 'kKSTMAV'),
(20, '5KagPBt2wXaW');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile_picture`
--

CREATE TABLE `users_profile_picture` (
  `id` int(11) DEFAULT NULL,
  `profile_picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_profile_picture`
--

INSERT INTO `users_profile_picture` (`id`, `profile_picture`) VALUES
(1, '3aogQjBXYTTI'),
(2, 'wyoKnYA'),
(3, '5pzspmPKxUhx'),
(4, 'pwU6jiOGf4'),
(5, 'ZI6fKevosNb3'),
(6, 'IBXcgR3WRS'),
(7, '7fqTObzYafB'),
(8, 'iOds6G3Q2Pb'),
(9, 'bbWOV2zRZWK'),
(10, 'oTtw6Q'),
(11, 'DRoY2Y'),
(12, 'CPFRXPn'),
(13, '9PVo0S'),
(14, 'z8peUW'),
(15, '8mDqkFX'),
(16, 'RgZXJ4tgUF'),
(17, 'tLoplSW7EW8'),
(18, 'fBH56P'),
(19, 'ryvsUvem5'),
(20, '41O4Bv4hLF3B');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
