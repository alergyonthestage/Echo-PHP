-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 28, 2023 alle 15:05
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

CREATE DATABASE echo;

USE echo;

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
-- Struttura della tabella `comment`
--

CREATE TABLE `artist` (
  `id_artist` int(11) NOT NULL,
  `stage_name` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `artist`
--

INSERT INTO `artist` (`id_artist`, `stage_name`, `pic`) VALUES
(1, 'Alergy', '1.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` date NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `friendship`
--

CREATE TABLE `friendship` (
  `friend1` int(11) NOT NULL,
  `friend2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
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
(30, 'House');

-- --------------------------------------------------------

--
-- Struttura della tabella `likedplaylist`
--

CREATE TABLE `likedplaylist` (
  `id_playlist` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `likedpost`
--

CREATE TABLE `likedpost` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `message`
--

CREATE TABLE `message` (
  `recipient` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` date NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `playlistcomposition`
--

CREATE TABLE `playlistcomposition` (
  `id_song` int(11) NOT NULL,
  `id_playlist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `public` char(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_song` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `song`
--

CREATE TABLE `song` (
  `id_song` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `id_artist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `song`
--

INSERT INTO `song` (`id_song`, `title`, `cover`, `id_genre`, `id_artist`) VALUES
(1, 'Brain in The Jelly', '1.png', 22, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `pepper_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id_user`, `username`, `name`, `surname`, `bio`, `password`, `salt`, `pepper_id`, `email`, `pic`, `verified`) VALUES
(1, 'echo', 'ECHO', '', 'Official profile of the ECHO Team!', '88c92a385d93755355ea0791005748223130d5002eaba5d5bc1538fa25a36873', 'c7cb53cc051a7af6ce688d98740a8ca14869b891132805b61cd643de8597d5f0', 1, 'echo@gmail.com', '1.png', 1),
(2, 'alergyonthestage', 'Alessandro', 'Antonini', 'Techno lover', 'e3a1adba75b33ea1ae69540c342dbcadcd171bfd3aa957b48eda0d1b6946431f', '5c21e1eec5a5f13320dfc8f9b44b74fa9fbbc29bc814673cda4a8d198bc1153b', 0, 'alergy@gmail.com', '2.png', 0),
(3, 'brtmnl', 'Emanuele', 'Bertolero', 'Pop lover, arianator xD', 'd597f21baece2f920ce8aa6758842296f9f98fea48c2c611a62dd6426feba39f', '8b4f096932e24ff30c96f662d9df8e78a9b6b194de3b70653b8d6315831cec65', 0, 'brtmnl@gmail.com', '3.png', 0),
(4, 'unquadrodikandinskij', 'Angela', 'Speranza', 'INTJ-T', 'a9793cc8bf8ff9548aaa2c9d49fbd3bd6992d172bd7e0ad2eb314a64a0b41b8f', '6d1a240384962e5a0ebba255c08e0892af124bd4cdee43612c45dc444f5b1b90', 2, 'unquadrodikandinskij@gmail.com', '4.png', 0),
(5, 'paul98', 'Paul', 'Smith', 'Seguimi mentre combino la mia passione per l\'avventura con l\'innovazione tecnologica. ', '9e7353de733c91f4f35a795ee088d73f132a513e47be5969e274eb78f02c3612', 'a275a4d2d0fa5b3325bc446492c7a17537aefa60edff7c93fc40e8495980a8e1', 1, 'paul98@gmail.com', '5.png', 0),
(6, 'sunshine22', 'Sofia', 'Rossi', 'Amante del sole, della natura e delle giornate spensierate. Sono appassionata di viaggi, fotografia e dolci fatti in casa.', '5963432a350294e138d8b82eefe0eae17daffb3d3d5ac8e192ef29eb951e34e1', 'e65538d64a16ab14671c17dd7c10ac3e1e5fb87fdbae2fade7b5ee9ecd98c8a5', 2, 'sunshine22@gmail.com', '6.png', 0),
(7, 'jazzcat', 'Luca', 'Bianchi', 'Sono un amante del jazz e un gatto nella mia anima. Troverai la mia anima musicale in cerca di nuove melodie e jam session. ', '85a0475dac00d8e808fd5c9532517a019fb628453e004e24a8321aadde10bf77', 'a402a7d3a5175e37448fef9fc3e4b1b3e68d79b9b8d6a0ffb7b7bf4458e47094', 0, 'jazzcat@gmail.com', '7.png', 0),
(8, 'mysticdreamer', 'Isabella', 'Lopez', 'Sogno ad occhi aperti e mi immergo nel mondo della spiritualità. ', 'cb7a5e87faee2fad4461b224a28cdc5546aacfcc37d013c489b1a8b933754fb3', '6b33f8dfe02661ac164c27811ec10f523590dfb2bf958547ff165800f29f4e48', 2, 'mysticdreamer@gmail.com', '8.png', 0),
(9, 'wildspirit', 'Alex', 'Thompson', 'Un\'anima libera con un cuore selvaggio. Mi piace esplorare la natura, fare escursioni, provare nuove avventure.', '76ca004659601271bc210fc6e880f28fafad35eb2b0a8d4b1a654d68f643c858', 'f66841cf9111e0a38c21f6c95d5f2796191163b2fe2d9c7e807f5f379a73ee41', 0, 'wildspirit@gmail.com', '9.png', 0),
(10, 'artisticmind', 'Mia', 'Patel', 'Un\'artista che danza con colori e forme. La mia passione è l\'arte in tutte le sue sfumature.', '389ef4abb8d3cf7ad78f6ef53c24f1f8f64ac59c1e3b752b53dcf994cd889c9b', 'c58117d29f2b74d9ca8416fdcd3ee51144e25f668bf8e29b20a3aa68fa4af5e3', 0, 'artisticmind@gmail.com', '10.png', 0);

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
  ADD PRIMARY KEY (`id_user`,`id_post`,`date`,`time`),
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
-- Indici per le tabelle `likedplaylist`
--
ALTER TABLE `likedplaylist`
  ADD PRIMARY KEY (`id_user`,`id_playlist`),
  ADD KEY `FKLik_Pla` (`id_playlist`);

--
-- Indici per le tabelle `likedpost`
--
ALTER TABLE `likedpost`
  ADD PRIMARY KEY (`id_user`,`id_post`),
  ADD KEY `FKLik_Pos` (`id_post`);

--
-- Indici per le tabelle `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`sender`,`recipient`,`date`,`time`),
  ADD KEY `FKInterlocutore2` (`recipient`);

--
-- Indici per le tabelle `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id_playlist`),
  ADD KEY `FKproprietà` (`id_user`),
  ADD KEY `FKplaylist_genere` (`id_genre`);

--
-- Indici per le tabelle `playlistcomposition`
--
ALTER TABLE `playlistcomposition`
  ADD PRIMARY KEY (`id_playlist`,`id_song`),
  ADD KEY `FKcom_Can` (`id_song`);

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
  MODIFY `id_artist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id_playlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `song`
--
ALTER TABLE `song`
  MODIFY `id_song` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Limiti per la tabella `likedplaylist`
--
ALTER TABLE `likedplaylist`
  ADD CONSTRAINT `FKLik_Pla` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id_playlist`),
  ADD CONSTRAINT `FKLik_Ute_Play` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `likedpost`
--
ALTER TABLE `likedpost`
  ADD CONSTRAINT `FKLik_Pos` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `FKLik_Ute` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FKInterlocutore1` FOREIGN KEY (`sender`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FKInterlocutore2` FOREIGN KEY (`recipient`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FKplaylist_genere` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  ADD CONSTRAINT `FKproprietà` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Limiti per la tabella `playlistcomposition`
--
ALTER TABLE `playlistcomposition`
  ADD CONSTRAINT `FKcom_Can` FOREIGN KEY (`id_song`) REFERENCES `song` (`id_song`),
  ADD CONSTRAINT `FKcom_Pla` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id_playlist`);

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