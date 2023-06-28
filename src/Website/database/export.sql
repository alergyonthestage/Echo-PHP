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
  `time` date NOT NULL,
  `public` char(1) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_song` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `singer`
--

CREATE TABLE `singer` (
  `id_singer` int(11) NOT NULL,
  `stage_name` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `singersong`
--

CREATE TABLE `singersong` (
  `id_singer` int(11) NOT NULL,
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
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `email` varchar(255) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id_user`, `username`, `name`, `surname`, `bio`, `password`, `email`, `pic`, `verified`) VALUES
(1, 'paul98', 'Paul', 'Smith', 'Love Techno music 💿\r\nFrom California 🇺🇸\r\n04/21 ❤️', 'a', 'paul98@gmail.com', 'paul98.png', 0),
(2, 'alergyonthestage', 'Alessandro', 'Antonini', 'Love Techno music 💿\r\nFrom California 🇺🇸\r\n04/21 ❤️', 'a', 'alergy@gmail.com', 'alergyonthestage.png', 0),
(3, 'echo', 'ECHO', '', 'Official profile of ECHO team', 'a', 'echo@echo.local', NULL, 1);

--
-- Indici per le tabelle scaricate
--

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
-- Indici per le tabelle `singer`
--
ALTER TABLE `singer`
  ADD PRIMARY KEY (`id_singer`);

--
-- Indici per le tabelle `singersong`
--
ALTER TABLE `singersong`
  ADD PRIMARY KEY (`id_song`,`id_singer`),
  ADD KEY `FKapp_Art` (`id_singer`);

--
-- Indici per le tabelle `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id_song`),
  ADD KEY `FKcanzone_genere` (`id_genre`);

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
-- AUTO_INCREMENT per la tabella `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id_playlist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `singer`
--
ALTER TABLE `singer`
  MODIFY `id_singer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `song`
--
ALTER TABLE `song`
  MODIFY `id_song` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Limiti per la tabella `singersong`
--
ALTER TABLE `singersong`
  ADD CONSTRAINT `FKapp_Art` FOREIGN KEY (`id_singer`) REFERENCES `singer` (`id_singer`),
  ADD CONSTRAINT `FKapp_Can` FOREIGN KEY (`id_song`) REFERENCES `song` (`id_song`);

--
-- Limiti per la tabella `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `FKcanzone_genere` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
