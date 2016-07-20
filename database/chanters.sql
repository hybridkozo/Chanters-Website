-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 20 Ιουλ 2016 στις 17:40:46
-- Έκδοση διακομιστή: 10.0.17-MariaDB
-- Έκδοση PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `chanters`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `menu`
--

CREATE TABLE `menu` (
  `idmenu` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `sequence` int(10) UNSIGNED NOT NULL,
  `submenu` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `menu`
--

INSERT INTO `menu` (`idmenu`, `name`, `description`, `link`, `sequence`, `submenu`) VALUES
(1, 'Αρχική', 'Ανοίγει την αρχική σελίδα ', 'index.php', 1, NULL),
(2, 'Ο Σύλογος', 'Μενού με διάφορες πληροφορίες από τον σύλογο', '', 2, 1),
(3, 'Τα νέα μας', 'Διάφορα άρθρα με νέα από τον σύλλογο ', '', 3, NULL),
(4, 'Επικοινωνία', 'Φόρμα επικοινωνίας για τους επισκέπτες', '', 4, NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `submenu`
--

CREATE TABLE `submenu` (
  `idsubmenu` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `sequence` int(4) UNSIGNED NOT NULL,
  `idmenu` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `submenu`
--

INSERT INTO `submenu` (`idsubmenu`, `name`, `description`, `link`, `sequence`, `idmenu`) VALUES
(1, 'Η ιστορία μας', 'Ένα κείμενο με την ιστορία του συλλόγου', '', 0, 2),
(2, 'Κανονισμός Ιεροψαλτών', 'Κανονισμός Ιεροψαλτών κείμενο', '', 1, 2),
(3, 'Διοικητικό Συμβούλιο', 'Διοικητικό Συμβούλιο κείμενο περιγραφή ', '', 2, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmcode` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `phone_number`, `username`, `password`, `confirmcode`, `admin`) VALUES
(7, 'giannis kozompolis', 'g.kozompolis@gmail.com', '', 'g.kozompolis@gma', '0266da91fb2890e9f24b093da6d74f3e', 'y', NULL);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Ευρετήρια για πίνακα `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`idsubmenu`),
  ADD KEY `idmenu` (`idmenu`),
  ADD KEY `idmenu_2` (`idmenu`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT για πίνακα `submenu`
--
ALTER TABLE `submenu`
  MODIFY `idsubmenu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
