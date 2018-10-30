-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 30 Octobre 2018 à 11:58
-- Version du serveur :  5.7.24-0ubuntu0.16.04.1
-- Version de PHP :  7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ToDoList`
--

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `member`
--

INSERT INTO `member` (`id`, `pseudo`, `pass`, `email`, `date_inscription`) VALUES
(1, 'test', 'test', 'fsd@hotmail.com', '2018-09-27'),
(2, 'admin', '$2y$10$l8LlO6mxIOVswkeb9FqRL.LGUoJDkD.psL.UZtwqvEgvQ7Zqh0LUq', 'hallaert.nicolas@hotmail.com', '2018-09-28'),
(3, 'testfd', '$2y$10$2qWvwtaVT4Vl2odIUhdDFe1UkyNqlOZ.KWAfHuukZ50zDEH6uOu4S', 'hallaert.nicolas@hotmail.com', '2018-09-28'),
(4, 'test6', '$2y$10$oq8DTX9nrUszq0B8M/kOsOGfRg17Qn6Ng5n3cU8xn7b3CqqfWi0Tq', 'tes455t@gmail.com', '2018-09-28'),
(5, 'nico', '$2y$10$3mTT0o33qGDtQsOI1zLWteVb4kf/vyJ0dPjgjeSQq4Yu4TxaViHOu', 'hallaert.nicolas@hotmail.com', '2018-09-29'),
(6, 'test45', '$2y$10$9UyiRZtO54Avti1NxW9S5eEg8JQD6fDmrPS.y4BjjHl8SpOMoLcm2', 'dsqd@gmail.com', '2018-09-29');

-- --------------------------------------------------------

--
-- Structure de la table `Projects`
--

CREATE TABLE `Projects` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Projects`
--

INSERT INTO `Projects` (`id`, `name`, `description`, `deadline`, `member_id`) VALUES
(1, 'Project 1', 'Just a test', '2018-09-25 13:10:13', 0),
(3, 'salut', 'test test', '2018-09-20 22:00:00', 0),
(9, 'test', 'Test Test Test', '2018-09-29 22:00:00', 1),
(10, 'terds', 'dsfdsf', '2018-09-29 22:00:00', 2),
(12, 'dqsd', 'dsqfds', '2018-09-29 22:00:00', 2),
(18, 'fsdfds', 'dsqdfs', '2018-09-29 22:00:00', 2),
(19, 'dsqdÅ“', 'sds', '2018-10-20 22:00:00', 5),
(20, 'dsqdÅ“', 'sds', '2018-10-20 22:00:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `Tasks`
--

CREATE TABLE `Tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `deadline` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `list_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Tasks`
--

INSERT INTO `Tasks` (`id`, `name`, `deadline`, `list_id`, `status`) VALUES
(1, 'ds', '2018-09-28 07:46:24', 2, 1),
(4, 'dfsdf', '2018-10-11 22:00:00', 13, 0),
(5, 'gfg', '2018-10-17 22:00:00', 13, 0),
(6, 'gdfg', '2018-10-19 22:00:00', 13, 0),
(7, 'dsfsd', '2018-10-26 22:00:00', 14, 0),
(8, '1-1', '2018-10-17 22:00:00', 16, 0),
(9, '1-2', '2018-10-18 22:00:00', 16, 0),
(10, '2-1', '2018-10-25 22:00:00', 17, 0),
(11, 'gfd', '2018-10-10 22:00:00', 19, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ToDoLists`
--

CREATE TABLE `ToDoLists` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ToDoLists`
--

INSERT INTO `ToDoLists` (`id`, `name`, `project_id`) VALUES
(2, 'test2', 1),
(10, 'dsq', 3),
(11, 'fsdf', 1),
(13, 'fsdfsdf', 19),
(14, 'bvvb', 19),
(15, 'bb', 19),
(16, 'list 1', 12),
(17, 'list 2', 12),
(18, 'list 3', 12),
(19, 'dsqd', 10);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Projects`
--
ALTER TABLE `Projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Index pour la table `Tasks`
--
ALTER TABLE `Tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`list_id`);

--
-- Index pour la table `ToDoLists`
--
ALTER TABLE `ToDoLists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Projects`
--
ALTER TABLE `Projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `Tasks`
--
ALTER TABLE `Tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `ToDoLists`
--
ALTER TABLE `ToDoLists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Tasks`
--
ALTER TABLE `Tasks`
  ADD CONSTRAINT `delete_task_on_list` FOREIGN KEY (`list_id`) REFERENCES `ToDoLists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ToDoLists`
--
ALTER TABLE `ToDoLists`
  ADD CONSTRAINT `delete_list_on_project` FOREIGN KEY (`project_id`) REFERENCES `Projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
