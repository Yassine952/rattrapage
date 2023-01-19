-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : jeu. 19 jan. 2023 à 12:23
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php`
--

-- --------------------------------------------------------

--
-- Structure de la table `rattrapage_user`
--

CREATE TABLE `rattrapage_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `confirmation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rattrapage_user`
--

INSERT INTO `rattrapage_user` (`id`, `firstname`, `lastname`, `birthday`, `email`, `pwd`, `confirmation`) VALUES
(106, 'Antoine', 'Schub', '2000-03-18', 'yassine.abdelkader95@gmail.com', '$2y$10$aSHVZSHn4S.6OxAALg5leODTQPM92RJp/pDJxrsRLJ5jNHgn0Be.W', 1),
(107, 'Younes', 'Abdelkader', '2004-02-12', 'yassine95210@hotmail.com', '$2y$10$RBZy7tZhlbsdoSEEAshSuORfPapZej7XLHzEuZkCkaVUTiQyg8wnC', 1),
(108, 'testupdate', 'Testupdate', '2000-02-18', 't@t.c', '$2y$10$vvwIVS239OBGNYcfBvyOQeAzLurOP84oCjSsnGbuVu4Ui60D71HQC', 0),
(109, 'Antoine', 'Schub', '2000-03-18', 'zearzer@erzrze.com', '$2y$10$P6cZMIquszl6wiDo.6OHnul2AmS3ADaHHy3L4VjeceEAmSEE.MIiK', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `rattrapage_user`
--
ALTER TABLE `rattrapage_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `rattrapage_user`
--
ALTER TABLE `rattrapage_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
