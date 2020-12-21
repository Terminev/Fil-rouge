-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 21 déc. 2020 à 17:59
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `filrouge`
--

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `id_question_id` int(11) NOT NULL,
  `choix` varchar(250) NOT NULL,
  `nombre` int(11) NOT NULL DEFAULT '0',
  `resultat` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`answer_id`, `id_question_id`, `choix`, `nombre`, `resultat`) VALUES
(1, 4, 'Oeuf', 0, NULL),
(2, 4, 'Poule', 1, NULL),
(3, 5, 'A', 0, NULL),
(4, 5, 'B', 0, NULL),
(5, 5, 'C', 0, NULL),
(6, 5, 'D', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

CREATE TABLE `friend` (
  `friend_id` int(11) NOT NULL,
  `user_id_A` int(11) NOT NULL,
  `user_id_B` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friend`
--

INSERT INTO `friend` (`friend_id`, `user_id_A`, `user_id_B`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `user_id_author` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `image` varchar(10000) NOT NULL,
  `date_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `user_id_author`, `question`, `image`, `date_fin`) VALUES
(4, 3, 'L\'Å“uf ou la Poule ?', 'https://img.maxisciences.com/article/mourir-moins-con/alors-oeuf-ou-poule_ea67c14d685b8a8fb992facada0995dd883235a2.jpg', '2021-02-03 18:44:00'),
(5, 3, 'Je prÃ©fÃ¨re', 'https://saviezvous.fr/wp-content/uploads/2020/04/point-d-interrogation-730x480.jpg', '2021-01-07 18:46:00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mdp` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `statut` tinyint(1) DEFAULT '0',
  `point` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `email`, `mdp`, `date`, `statut`, `point`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin', '$2y$10$9oQmtpiqC4WZENyrJQ/CL.3vaJDySRRvUys1tTDrH/fOe25QIaTRi', '2020-12-21', 1, 170),
(2, '123', '123', '123', '123@123', '$2y$10$OTlQKBEzH85MBDhMg0QbVOCL20qah7fzCqB/fLrKjL6EYro2ImZym', '2020-12-21', 0, 15),
(3, '1', '1', '1', '1@1', '$2y$10$/7T05sywTQEpHQDOpk/yfOUoDg516K/ZKObnQHr8fbMgrdT5DsE2S', '2020-12-21', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_answer`
--

INSERT INTO `user_answer` (`id`, `user_id`, `answer_id`, `id_question`) VALUES
(1, 1, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user_comment`
--

CREATE TABLE `user_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_question_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_comment`
--

INSERT INTO `user_comment` (`id`, `user_id`, `id_question_id`, `comment`, `date`) VALUES
(1, 3, 4, 'cool', '2020-12-21 18:47:08'),
(2, 3, 4, 'ahahaha', '2020-12-21 18:47:15'),
(3, 1, 4, '+1', '2020-12-21 18:48:01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Index pour la table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`friend_id`),
  ADD UNIQUE KEY `friend_id` (`friend_id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Id` (`id`,`pseudo`,`email`);

--
-- Index pour la table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_comment`
--
ALTER TABLE `user_comment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `friend`
--
ALTER TABLE `friend`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user_comment`
--
ALTER TABLE `user_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
