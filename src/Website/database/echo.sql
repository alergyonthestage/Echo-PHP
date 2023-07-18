-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 88.99.13.116
-- Creato il: Lug 18, 2023 alle 20:38
-- Versione del server: 8.0.33
-- Versione PHP: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `echo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `artist`
--

CREATE TABLE `artist` (
  `id_artist` int NOT NULL,
  `stage_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `artist`
--

INSERT INTO `artist` (`id_artist`, `stage_name`, `pic`) VALUES
(1, 'Alergy', ''),
(2, 'Fred Again', ''),
(3, 'Mochakk', ''),
(4, 'Rihanna', ''),
(5, 'Maroon 5', ''),
(6, 'Justin Timberlake', ''),
(7, 'Eminem', ''),
(8, 'Jason Derulo', ''),
(9, 'Ed Sheeran', ''),
(10, 'El Profesor', ''),
(11, 'Bastille', ''),
(12, 'Ariana', ''),
(13, 'The Weeknd', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `comment`
--

INSERT INTO `comment` (`id_post`, `id_user`, `timestamp`, `text`) VALUES
(4, 3, '2023-07-18 18:28:50', 'ciao'),
(8, 3, '2023-07-18 14:39:57', 'Come darti torto'),
(9, 3, '2023-07-18 14:41:17', '🕺🕺🕺'),
(13, 3, '2023-07-18 20:34:14', 'I agree with you, let\'s go back to our adolescence together.'),
(13, 4, '2023-07-18 20:36:23', 'love ya <3'),
(9, 6, '2023-07-18 14:33:58', 'Anche a me, balliamo insiemeeee'),
(10, 6, '2023-07-18 14:32:32', 'C\'è a chi piace ed a chi no'),
(11, 6, '2023-07-18 14:31:42', 'Mah, mi dissocio...'),
(1, 7, '2023-07-18 14:38:23', 'Rihanna come non adorarla'),
(10, 7, '2023-07-18 14:28:59', 'Ma cosa a dici, a me è piaciuta invece'),
(11, 7, '2023-07-18 14:28:32', 'Justin uno dei migliori');

-- --------------------------------------------------------

--
-- Struttura della tabella `friendship`
--

CREATE TABLE `friendship` (
  `friend1` int NOT NULL,
  `friend2` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `friendship`
--

INSERT INTO `friendship` (`friend1`, `friend2`, `timestamp`) VALUES
(2, 1, '2023-07-17 14:46:13'),
(3, 1, '2023-07-17 14:22:13'),
(4, 1, '2023-07-17 14:25:23'),
(1, 2, '2023-07-17 14:21:06'),
(3, 2, '2023-07-17 14:46:20'),
(4, 2, '2023-07-17 14:14:44'),
(5, 2, '2023-07-17 14:56:37'),
(6, 2, '2023-07-18 14:08:53'),
(8, 2, '2023-07-18 14:36:46'),
(1, 3, '2023-07-17 14:21:41'),
(2, 3, '2023-07-17 14:45:56'),
(4, 3, '2023-07-17 14:20:10'),
(5, 3, '2023-07-17 14:56:05'),
(7, 3, '2023-07-18 14:37:15'),
(8, 3, '2023-07-18 14:36:29'),
(1, 4, '2023-07-17 14:21:21'),
(2, 4, '2023-07-17 14:15:57'),
(3, 4, '2023-07-17 14:19:31'),
(5, 4, '2023-07-17 14:56:21'),
(3, 5, '2023-07-17 14:57:13'),
(4, 5, '2023-07-17 15:26:16'),
(3, 6, '2023-07-18 19:53:25'),
(8, 6, '2023-07-18 14:22:23'),
(3, 7, '2023-07-18 14:37:55'),
(6, 7, '2023-07-18 14:33:29'),
(8, 7, '2023-07-18 14:21:45'),
(3, 8, '2023-07-18 14:37:36'),
(6, 8, '2023-07-18 14:23:58'),
(7, 8, '2023-07-18 14:24:47');

-- --------------------------------------------------------

--
-- Struttura della tabella `genre`
--

CREATE TABLE `genre` (
  `id_genre` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `genre`
--

INSERT INTO `genre` (`id_genre`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Hip Hop'),
(4, 'R&B'),
(5, 'Country'),
(6, 'Jazz'),
(7, 'Blues'),
(8, 'Reggae'),
(9, 'Electronic'),
(10, 'Classical'),
(11, 'Folk'),
(12, 'Metal'),
(13, 'Alternative'),
(14, 'Punk'),
(15, 'Soul'),
(16, 'Gospel'),
(17, 'Funk'),
(18, 'Disco'),
(19, 'Latin'),
(20, 'Indie'),
(21, 'Dance'),
(22, 'Techno'),
(23, 'Ska'),
(24, 'Instrumental'),
(25, 'Reggaeton'),
(26, 'Opera'),
(27, 'Country Rock'),
(28, 'Trance'),
(29, 'Salsa'),
(30, 'House'),
(31, 'Popolare');

-- --------------------------------------------------------

--
-- Struttura della tabella `likedpost`
--

CREATE TABLE `likedpost` (
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `likedpost`
--

INSERT INTO `likedpost` (`id_post`, `id_user`, `timestamp`) VALUES
(4, 3, '2023-07-18 19:15:22'),
(6, 3, '2023-07-18 13:54:38'),
(7, 3, '2023-07-18 14:40:38'),
(8, 3, '2023-07-18 14:39:16'),
(9, 3, '2023-07-18 14:39:10'),
(11, 3, '2023-07-18 14:41:37'),
(13, 3, '2023-07-18 20:33:42'),
(14, 3, '2023-07-18 20:33:38'),
(1, 4, '2023-07-18 15:56:16'),
(6, 5, '2020-07-18 09:43:17'),
(9, 6, '2023-07-18 14:33:45'),
(10, 6, '2023-07-18 14:32:12'),
(11, 6, '2023-07-18 14:31:12'),
(1, 7, '2023-07-18 14:38:10'),
(9, 7, '2023-07-18 14:14:40'),
(10, 7, '2023-07-18 14:27:53'),
(11, 7, '2023-07-18 14:25:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `notification`
--

CREATE TABLE `notification` (
  `id_notification` int NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int NOT NULL,
  `id_sender` int NOT NULL,
  `id_recipient` int NOT NULL,
  `id_post` int DEFAULT NULL,
  `to_read` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `notification`
--

INSERT INTO `notification` (`id_notification`, `timestamp`, `type`, `id_sender`, `id_recipient`, `id_post`, `to_read`) VALUES
(69, '2023-07-17 14:14:45', 3, 4, 2, NULL, 0),
(70, '2023-07-17 14:15:57', 4, 2, 4, NULL, 0),
(71, '2023-07-17 14:19:31', 3, 3, 4, NULL, 0),
(72, '2023-07-17 14:20:10', 4, 4, 3, NULL, 0),
(73, '2023-07-17 14:21:06', 3, 1, 2, NULL, 0),
(74, '2023-07-17 14:21:22', 3, 1, 4, NULL, 0),
(75, '2023-07-17 14:21:41', 3, 1, 3, NULL, 0),
(76, '2023-07-17 14:22:13', 4, 3, 1, NULL, 1),
(77, '2023-07-17 14:25:24', 4, 4, 1, NULL, 1),
(78, '2023-07-17 14:45:56', 3, 2, 3, NULL, 0),
(79, '2023-07-17 14:46:13', 4, 2, 1, NULL, 1),
(80, '2023-07-17 14:46:20', 4, 3, 2, NULL, 0),
(81, '2023-07-17 14:47:47', 1, 3, 3, 1, 0),
(82, '2023-07-17 14:56:06', 3, 5, 3, NULL, 0),
(83, '2023-07-17 14:56:22', 3, 5, 4, NULL, 0),
(84, '2023-07-17 14:56:37', 3, 5, 2, NULL, 0),
(85, '2023-07-17 14:57:13', 4, 3, 5, NULL, 0),
(89, '2023-07-17 15:26:17', 4, 4, 5, NULL, 0),
(90, '2023-07-17 16:59:02', 2, 3, 3, 1, 0),
(91, '2023-07-17 16:59:05', 2, 3, 3, 1, 0),
(92, '2023-07-18 08:50:37', 2, 4, 3, 4, 0),
(93, '2023-07-18 09:43:18', 2, 5, 5, 6, 0),
(94, '2023-07-18 13:54:39', 2, 3, 5, 6, 1),
(95, '2023-07-18 14:08:53', 3, 6, 2, NULL, 0),
(96, '2023-07-18 14:09:10', 3, 6, 3, NULL, 0),
(97, '2023-07-18 14:14:42', 2, 7, 7, 9, 0),
(98, '2023-07-18 14:21:46', 3, 8, 7, NULL, 0),
(99, '2023-07-18 14:22:23', 3, 8, 6, NULL, 0),
(100, '2023-07-18 14:23:58', 4, 6, 8, NULL, 1),
(101, '2023-07-18 14:24:47', 4, 7, 8, NULL, 1),
(102, '2023-07-18 14:25:04', 2, 7, 8, 11, 1),
(103, '2023-07-18 14:27:54', 2, 7, 8, 10, 1),
(104, '2023-07-18 14:28:33', 1, 7, 8, 11, 1),
(105, '2023-07-18 14:29:00', 1, 7, 8, 10, 1),
(106, '2023-07-18 14:31:13', 2, 6, 8, 11, 1),
(107, '2023-07-18 14:31:43', 1, 6, 8, 11, 1),
(108, '2023-07-18 14:32:13', 2, 6, 8, 10, 1),
(109, '2023-07-18 14:32:33', 1, 6, 8, 10, 1),
(110, '2023-07-18 14:33:29', 3, 6, 7, NULL, 1),
(111, '2023-07-18 14:33:47', 2, 6, 7, 9, 1),
(112, '2023-07-18 14:33:59', 1, 6, 7, 9, 1),
(113, '2023-07-18 14:35:33', 2, 3, 4, 4, 0),
(114, '2023-07-18 14:35:48', 4, 3, 6, NULL, 1),
(115, '2023-07-18 14:36:30', 3, 8, 3, NULL, 0),
(116, '2023-07-18 14:36:47', 3, 8, 2, NULL, 0),
(117, '2023-07-18 14:37:16', 3, 7, 3, NULL, 0),
(118, '2023-07-18 14:37:36', 4, 3, 8, NULL, 1),
(119, '2023-07-18 14:37:55', 4, 3, 7, NULL, 1),
(120, '2023-07-18 14:38:11', 2, 7, 3, 1, 0),
(121, '2023-07-18 14:38:24', 1, 7, 3, 1, 0),
(122, '2023-07-18 14:39:11', 2, 3, 7, 9, 1),
(123, '2023-07-18 14:39:17', 2, 3, 6, 8, 1),
(124, '2023-07-18 14:39:58', 1, 3, 6, 8, 1),
(125, '2023-07-18 14:40:40', 2, 3, 6, 7, 1),
(126, '2023-07-18 14:41:18', 1, 3, 7, 9, 1),
(127, '2023-07-18 14:41:38', 2, 3, 8, 11, 1),
(128, '2023-07-18 15:31:46', 2, 2, 4, 4, 0),
(129, '2023-07-18 15:31:49', 2, 2, 4, 4, 0),
(130, '2023-07-18 15:56:18', 2, 4, 3, 1, 0),
(131, '2023-07-18 18:28:51', 1, 3, 4, 4, 0),
(132, '2023-07-18 19:15:24', 2, 3, 4, 4, 0),
(133, '2023-07-18 19:53:26', 3, 3, 6, NULL, 1),
(134, '2023-07-18 20:31:37', 2, 4, 4, 12, 0),
(135, '2023-07-18 20:33:40', 2, 3, 3, 14, 1),
(136, '2023-07-18 20:33:43', 2, 3, 4, 13, 0),
(137, '2023-07-18 20:34:15', 1, 3, 4, 13, 0),
(138, '2023-07-18 20:36:24', 1, 4, 4, 13, 1),
(139, '2023-07-18 20:36:26', 1, 4, 4, 13, 1),
(140, '2023-07-18 20:36:28', 1, 4, 4, 13, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `notificationtype`
--

CREATE TABLE `notificationtype` (
  `id_type` int NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `notificationtype`
--

INSERT INTO `notificationtype` (`id_type`, `description`) VALUES
(1, 'commented on your post'),
(2, 'liked your post'),
(3, 'has sent you a friend request'),
(4, 'has accepted your friend request'),
(5, 'rejected your friend request');

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id_post` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL,
  `id_user` int NOT NULL,
  `id_song` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`id_post`, `description`, `timestamp`, `id_user`, `id_song`) VALUES
(1, 'Adoro questa canzone, Rihanna ti amo <3', '2023-07-17 14:35:14', 3, 4),
(4, 'Maroon 5 the best', '2023-07-18 14:02:56', 4, 10),
(6, 'This song reminds me of something 🤔', '2020-04-19 22:00:01', 5, 30),
(7, 'Wow, questa canzone è semplicemente esplosiva!', '2023-06-18 14:08:28', 6, 13),
(8, 'Questa canzone è pura poesia! ', '2023-07-10 14:09:54', 6, 5),
(9, 'Mi viene voglia di ballare, grandi!', '2023-06-18 14:14:02', 7, 11),
(10, 'Non mi è piaciuta tanto, ma l\'ascolto comunque.', '2023-07-10 14:17:15', 8, 22),
(11, 'Justin non mi deludi mai, una delle mie canzoni preferite!', '2023-07-15 14:20:25', 8, 14),
(12, 'Chills.', '2023-07-18 20:31:08', 4, 33),
(13, 'This song takes me back in my teenage years <3', '2023-07-18 20:32:11', 4, 32),
(14, 'Ari love you, this is my fav song 😭', '2023-07-18 20:32:25', 3, 31);

-- --------------------------------------------------------

--
-- Struttura della tabella `song`
--

CREATE TABLE `song` (
  `id_song` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_genre` int NOT NULL,
  `id_artist` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `song`
--

INSERT INTO `song` (`id_song`, `title`, `cover`, `youtube`, `id_genre`, `id_artist`) VALUES
(1, 'Brain in The Jelly', '1.png', 'IYYKQIMY9wQ', 22, 1),
(2, 'Delilah', '2.png', 'Cl6Rz1Uvi2M', 21, 2),
(3, 'DaFunk', '3.png', '6gq-MlQGkOY', 9, 3),
(4, 'We Found Love', '4.png', 'QrJosGJj7w0', 2, 4),
(5, 'Umbrella', '5.png', 'Dle7VRQ3ofM', 2, 4),
(6, 'Diamonds', '6.png', 'uGZh6b-Fkxo', 2, 4),
(7, 'Love On The Brain', '7.png', 'Anr_L9U2kkw', 2, 4),
(8, 'Only Girl', '8.png', 'qrjUQQN5ats', 2, 4),
(9, 'Payphone', '9.png', 'fuP4Lkt1vAo', 21, 5),
(10, 'Maps', '10.png', 'Y7ix6RITXM0', 21, 5),
(11, 'Moves Like Jagger', '11.png', 'GzUMdeecB_s', 21, 5),
(12, 'Memories', '12.png', 'K_iH2YSaY3U', 21, 5),
(13, 'CAN\'T STOP THE FEELING! ', '13.png', 'wWPY-Qi0aVQ', 1, 6),
(14, 'SexyBack ', '14.png', 'Cg6IDiTqIUs', 2, 6),
(15, 'Mirrors ', '15.png', 'ZFlpVBFSEis', 2, 6),
(16, 'Rock Your Body ', '16.png', 'NUclNUwW2zo', 1, 6),
(17, 'Mockingbird', '17.png', '3jFntHKHmi8', 21, 7),
(18, 'Without Me', '18.png', '-8xhmV3JoG4', 21, 7),
(19, 'The Real Slim Shady', '19.png', 'UMPofnwxgKI', 21, 7),
(20, 'Lose Yourself', '20.png', 'WvBOITPDiEQ', 21, 7),
(21, 'Acapulco', '21.png', 'Puuv-d9cTZE', 2, 8),
(22, 'Want to Want Me', '22.png', 'A5EvJ5qxycM', 2, 8),
(23, 'Whatcha Say', '23.png', 'tnOXjYootTM', 2, 8),
(24, 'Savage Love', '24.png', 'KH3Ur8GWkpM', 2, 8),
(25, 'Take You Dancing', '25.png', 'S4wS-YonJM8', 2, 8),
(26, 'Eyes Closed', '26.png', 'jPW3ZL9Y0P8', 2, 9),
(27, 'Shape of You', '27.png', 'Vds8ddYXYZY', 2, 9),
(28, 'Shivers', '28.png', 'RRUkmZkN-P4', 2, 9),
(29, 'Photograph', '29.png', 'HpphFd_mzXE', 2, 9),
(30, 'Bella ciao', '30.png', 'jhgJV0Pg54Y', 31, 10),
(31, 'Dangerous Woman', '31.png', 'WBMx99g8R9Y', 2, 12),
(32, 'Pompeii', '32.png', 'ilLEuwH4hws', 13, 11),
(33, 'The Hills', '33.png', 'yzTuBuRdAyA', 4, 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bio` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pepper_id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id_user`, `username`, `name`, `surname`, `bio`, `password`, `salt`, `pepper_id`, `email`, `pic`, `verified`) VALUES
(1, 'echo', 'Echo', 'Team', 'The Officil Profile of the Echo\'s Team', '96d5663115f7413c77939aada8f5cd7d874dadc4e895b7ff098e38fd08de34e1', 'c71d5f707a8f87c09c24b09a2ef3adadbe0bfb4e8a92f73f57f9ec024575044c', 1, 'echo@echo.it', '1.png', 1),
(2, 'alergyonthestage', 'Alessandro', 'Antonini', 'Techno producer and DJ\nBorn in 2001', '923759f4e826b4d3101d658f42f7d5e56987f9db8dcd726d4af6777691c9ebbe', 'a253ece6579562b8bc51715d909e88efa20601ce5690c3dd4f30986945848fb1', 2, 'alergy.official@gmail.com', '2.jpg', 1),
(3, 'brtmnl', 'Emanuele', 'Bertolero', 'Lover of pop musicc\nI\'m 22yo\nitaly', '0f081520a6e1ce5cc01ae7332733f534be562f285b40d678d9f7ffbe0315797c', 'bfdd0c7eaf1d6b6a0da05732ced56be4b709596f2573bfc9f67f17edb434cb7d', 0, 'bertoleroemanuele@gmail.com', '3.png', 1),
(4, 'angelina', 'Angela', 'Speranza', '\"Bella, where the hell have you been, loca?\"', 'e3ebf4619ca1f30ee453b7a7a2a33410642ead923d23e64fa3f956d7988a2b66', '8f9cc7838ef49c84c88bcdac10b196b240dc28dd86f5c864d9d217299b0039be', 0, 'angela.speranza@studio.unibo.it', '4.jpeg', 1),
(5, 'berlino', 'Berlino', '🐶', 'Woof Woof, love you.\n@brtmnl\'s dog', '30c411b7ed677013727d64b7ca147dd0a33d022e54ba1307665dcc6df7d54f6e', '33e09ce22b8b91618bc84572814eec376476a83bf66c3e59f1756857f1dcad12', 1, 'berlino@fakemail.com', '5.jpg', 1),
(6, 'rockstar88', 'Giulia', 'Bianchi', 'Sono una rockstar nel cuore e nell\'anima. Le chitarre e i riff potenti mi fanno sentire viva. ', '10087bc195cb7c779386fc7c7e909a23ab94b939b98a8354d2726e94d6ab0872', '036f91c501d38c3190d7b043e33a8cf4b0c6dc5be6f5b1feb861974808fa56a6', 0, 'RockStar88@fakemail.com', '6.jpg', 0),
(7, 'artsoul', 'Sofia', 'Fiorelli', 'Sono un\'appassionata d\'arte e di tutte le sue sfaccettature.', '8282ad818b9a3597bea2b0566481a3519784c5b8d9f68d8aa0dc2fc7d2f4a63d', '3df8b73916d4a7d420ba442398ad9dffb052ca9c82c5b0e55c5a9aeb91a52efc', 1, 'artsoul@fakemail.com', '7.jpg', 0),
(8, 'ale98', 'Alessio', 'Marchetti', 'Pronto a condividere la mia passione con voi e scoprire nuovi amici', 'a87104d7d150cfb206ac883afe316739de677fd140b099cecdcd8dc5628215c3', 'caac4203c5def1100e7d839bf733e692279a74c4bcf5d852b24afd42b87d3c4b', 2, 'ale98@gmail.com', '8.jpg', 0),
(9, 'lil_fra', 'Francesco', 'Tosi', NULL, 'c9ca2dca3c6de16a8f1f4a93b3f9b038e443c7e56325f031ae6a231164330cb5', '007b4baa5a4c50f791beabb377ea777aa53d30572f7c9b7981314aa08d05370f', 1, 'lilfra@bro.it', NULL, 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id_artist`);

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_user`,`id_post`,`timestamp`),
  ADD KEY `FKCom_Pos` (`id_post`);

--
-- Indici per le tabelle `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`friend2`,`friend1`),
  ADD KEY `FKAmico2` (`friend1`);

--
-- Indici per le tabelle `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indici per le tabelle `likedpost`
--
ALTER TABLE `likedpost`
  ADD PRIMARY KEY (`id_user`,`id_post`),
  ADD KEY `FKLik_Pos` (`id_post`);

--
-- Indici per le tabelle `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `fk_sender` (`id_sender`),
  ADD KEY `fk_recipient` (`id_recipient`),
  ADD KEY `fk_notificationtype` (`type`),
  ADD KEY `fk_post` (`id_post`);

--
-- Indici per le tabelle `notificationtype`
--
ALTER TABLE `notificationtype`
  ADD PRIMARY KEY (`id_type`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `FKpubblicazione` (`id_user`),
  ADD KEY `FKinclusione` (`id_song`);

--
-- Indici per le tabelle `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id_song`),
  ADD KEY `FKcanzone_genere` (`id_genre`),
  ADD KEY `FKsong_artist` (`id_artist`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `artist`
--
ALTER TABLE `artist`
  MODIFY `id_artist` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT per la tabella `notificationtype`
--
ALTER TABLE `notificationtype`
  MODIFY `id_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `song`
--
ALTER TABLE `song`
  MODIFY `id_song` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FKCom_Pos` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `FKCom_Ute` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `FKAmico1` FOREIGN KEY (`friend2`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FKAmico2` FOREIGN KEY (`friend1`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `likedpost`
--
ALTER TABLE `likedpost`
  ADD CONSTRAINT `FKLik_Pos` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `FKLik_Ute` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_notificationtype` FOREIGN KEY (`type`) REFERENCES `notificationtype` (`id_type`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_recipient` FOREIGN KEY (`id_recipient`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_sender` FOREIGN KEY (`id_sender`) REFERENCES `user` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FKinclusione` FOREIGN KEY (`id_song`) REFERENCES `song` (`id_song`),
  ADD CONSTRAINT `FKpubblicazione` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `FKcanzone_genere` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  ADD CONSTRAINT `FKsong_artist` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id_artist`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
