-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 25 Mai 2019 à 09:42
-- Version du serveur :  5.7.11
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `AgvBdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administrateurs`
--

CREATE TABLE `Administrateurs` (
  `id` varchar(255) NOT NULL,
  `mdp` varchar(30) DEFAULT NULL,
  `adresseMail` varchar(255) DEFAULT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `dateModifMdp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Administrateurs`
--

INSERT INTO `Administrateurs` (`id`, `mdp`, `adresseMail`, `nom`, `prenom`, `dateModifMdp`) VALUES
('gu', 'azerty', 'gyomang@gmail.com', 'Anguenot', 'Guillaume', '2019-04-29'),
('Raph', '12345678', 'raphaeldeoliveira68@gmail.com', 'De Oliveira', 'Raphaël', '2019-04-30');

-- --------------------------------------------------------

--
-- Structure de la table `Articles`
--

CREATE TABLE `Articles` (
  `idArticle` int(11) NOT NULL,
  `texte` text,
  `dateAjout` datetime DEFAULT NULL,
  `estSignale` tinyint(1) DEFAULT '0',
  `idJeu` int(11) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Articles`
--

INSERT INTO `Articles` (`idArticle`, `texte`, `dateAjout`, `estSignale`, `idJeu`, `idCategorie`) VALUES
(1, 'Un jeu original qui déstabilise car un gameplay sans bas ni haut, on en perd son centre de gravité.', '2019-05-08 08:12:15', 0, 1, 2),
(2, 'Un univers qui fait rêver de mystères sur la nature de ce monde hors du commun avec un arbre géant, des trous noirs, des villes sur des cailloux qui flottent dans l\'air...', '2019-04-29 00:00:00', 0, 1, 1),
(3, 'Ce moment où tu te bats avec des ennemis et que tu dois leur sauter 4-5 fois dessus pour les tuer alors qu\'il y en a 10, c\'est chiant.', '2019-04-29 00:00:00', 0, 1, 3),
(4, 'Une sorte de tunnel infini qui finit dans un trou noir quoi de plus mystérieux ça donne envie d\'en voir plus.', '2019-04-29 00:00:00', 0, 1, 1),
(27, 'Colorer et enfantin quoi de mieux pour s\'amuser dans une 2d franchement reussi.\r\nMeme les ennemis sont mignon et tout rond.', '2019-05-08 10:00:00', 0, 12, 1),
(28, 'C\'est le jeu qu\'il faut acheter sur PSP car Locoroco est un chef-d\'oeuvre grâce à un monde féérique et poétique.', '2019-05-07 00:25:00', 0, 12, 1),
(29, 'Avec les gâchettes on tourne le monde de manière a rouler sur le plafond et on peut se diviser en plusieurs mini moi pour passer n importe ou.', '2019-05-07 00:00:00', 0, 12, 2),
(30, 'Ce que j\'ai préférer c\'est se diviser ou se rassembler c\'est très jouissif.', '2019-05-07 02:00:00', 0, 12, 3),
(31, 'Un univers dantesque puisque c\'est celui de Staaaaaaaaar Waaaaaaaars.', '2019-05-08 15:23:00', 0, 13, 1),
(32, 'On en veux tous simplement plus, toutes ces possibilités qu\'offre la force c\'est impressionnant et cette manière de découper ses ennemis en tout petit morceau c\'est tout a fait marrant.', '2019-05-07 06:00:00', 0, 13, 2),
(33, 'Ce moment ou tu repousse un énorme vaisseau mère a la simple puissance de la force.', '2019-05-07 03:00:00', 0, 13, 3),
(34, 'Cela un cote mignon et legoesque a star wars, tout pourrait être déconstruit, reconstruis, cela offre un tas de possibilité.', '2019-05-08 15:00:00', 0, 14, 1),
(35, 'Ce cote simple du gameplay des lego c\'est tout simplement efficace.', '2019-05-08 16:02:07', 0, 14, 2),
(36, 'Quand tu te bas avec au sabre c\'est styler après un petit bemole quand tu tire au pistolet c\'est un peu ennuyeux.', '2019-05-07 12:07:00', 0, 14, 3),
(37, 'Un univers des plus western avec tout le charme des anciens films qui passait le dimanche après midi.', '2019-05-07 16:00:00', 0, 16, 1),
(38, 'Qui a déjà jouer a GTA ? Et bein c\'est la même, un gameplay au petit onions plutôt réaliste.', '2019-05-07 18:00:00', 0, 16, 2),
(40, 'Des plus spartiate l\'univers s\'inspire de la mythologie grec et le fait a merveille et avec démesure.', '2019-05-08 09:13:00', 0, 18, 1),
(41, 'Brutale et sanglant cela rend les joueur violent.', '2019-05-07 23:16:00', 0, 18, 2),
(42, 'Lors du \'finish him\' que tu impose au pauvre monstres boss dieu.', '2019-05-07 23:29:00', 0, 18, 3),
(44, 'qsdfsdfqsdfqsdfqsd', '2019-05-20 16:15:26', 0, 1, 2),
(45, 'Abobo', '2019-05-20 16:32:55', 0, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

CREATE TABLE `Categories` (
  `idCategorie` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Categories`
--

INSERT INTO `Categories` (`idCategorie`, `libelle`) VALUES
(1, 'Univers'),
(2, 'Feeling'),
(3, 'Instant');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaires`
--

CREATE TABLE `Commentaires` (
  `idCommentaire` int(11) NOT NULL,
  `texte` text,
  `dateAjout` datetime DEFAULT NULL,
  `estSignale` tinyint(1) DEFAULT '0',
  `idArticle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Commentaires`
--

INSERT INTO `Commentaires` (`idCommentaire`, `texte`, `dateAjout`, `estSignale`, `idArticle`) VALUES
(1, 'Oui ont apprécie quand on se pose sur une surface pour respirer un peu.', '2019-04-29 12:34:56', 0, 1),
(2, 'Salut tu sais qu\'il en existe un 2eme mais j\'y ai jamais jouer', '2019-04-29 00:00:00', 0, 4),
(3, 'Oui c\'est vite brouillon, ça aurai été mieux en étant plus contemplatif une sorte Jeux d’enquête.', '2019-04-29 00:00:00', 0, 1),
(5, 'Un instant inoubliable...', '2019-05-01 15:54:49', 1, 4),
(6, 'J\'adore cette sensation !', '2019-05-15 04:10:19', 0, 1),
(7, 'Perso c\'est ce qui fait que je n\'ai jamais vraiment pu me mettre à ce jeu', '2019-05-14 14:10:29', 0, 1),
(8, 'C\'est ce qui fait que ce jeu est si original', '2019-05-16 10:17:12', 0, 1),
(9, 'Ca me donne le tournis', '2019-05-14 05:41:19', 0, 1),
(10, 'C\'est grave stylé !!!', '2019-05-17 09:41:17', 0, 1),
(11, 'C\'est grave stylé !!!', '2019-05-13 08:46:13', 0, 2),
(12, 'Les trous noirs, ça me fait penser à un gars que je connais et qui fait que manger lol', '2019-05-03 17:51:41', 0, 2),
(13, 'C\'est une architecture assez incroyable', '2019-05-09 19:45:30', 0, 2),
(14, 'Comment il s\'appelle ton gars qui fait que de manger? J\'en connais un comme ça aussi ! XD', '2019-05-19 01:34:27', 0, 2),
(15, 'L\'arbre géant -> the best !', '2019-05-09 02:07:10', 0, 2),
(16, 'Weaaaaaaaaaaaaaaaaaak !', '2019-05-15 09:15:34', 0, 3),
(17, 'Git gud !', '2019-05-17 00:00:00', 0, 3),
(18, 'C\'est clair c\'est grave chiant', '2019-05-14 15:16:10', 0, 3),
(19, 'En même temps c\'est la mécanique du jeu donc...', '2019-05-19 08:32:21', 0, 3),
(20, 'Mécanique ou pas c\'est relou quand-même', '2019-05-19 12:14:21', 0, 3),
(21, 'De loin mon moment préféré !', '2019-05-16 06:28:07', 0, 4),
(22, 'Tripant à souhait!', '2019-05-08 23:26:41', 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Compoimgjeu`
--

CREATE TABLE `Compoimgjeu` (
  `idImage` int(11) NOT NULL,
  `idJeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Images`
--

CREATE TABLE `Images` (
  `idImage` int(11) NOT NULL,
  `nomImage` varchar(255) DEFAULT NULL,
  `dateAjout` datetime DEFAULT NULL,
  `estSignale` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Jeux`
--

CREATE TABLE `Jeux` (
  `idJeu` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `dateAjout` datetime DEFAULT NULL,
  `estSignale` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Jeux`
--

INSERT INTO `Jeux` (`idJeu`, `titre`, `dateAjout`, `estSignale`) VALUES
(1, 'Gravity Rush', '2019-04-29 06:06:06', 1),
(2, 'GTA 4', '2019-04-29 00:00:00', 0),
(3, 'COD Modern Warfare 2', '2019-04-30 00:00:00', 0),
(12, 'LocoRoco', '2019-05-07 00:00:00', 0),
(13, 'Star Wars: The Force Unleashed', '2019-05-07 09:00:00', 0),
(14, 'Lego Star Wars : La Saga complète', '2019-05-07 00:35:00', 0),
(15, 'Apex Legends', '2019-05-07 14:00:00', 0),
(16, 'Red Dead Redemption 2', '2019-05-07 19:00:00', 0),
(17, 'Diablo 3', '2019-05-07 23:00:00', 0),
(18, 'God of War', '2019-05-07 23:27:25', 0),
(19, '999 nine hours nine persons nine doors', '2019-05-21 13:04:36', 0),
(20, '^_^', '2019-05-24 10:19:35', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Administrateurs`
--
ALTER TABLE `Administrateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `FK_Articles_idJeu` (`idJeu`),
  ADD KEY `FK_Articles_idCategorie` (`idCategorie`);

--
-- Index pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD KEY `FK_Commentaires_idArticle` (`idArticle`);

--
-- Index pour la table `Compoimgjeu`
--
ALTER TABLE `Compoimgjeu`
  ADD PRIMARY KEY (`idImage`,`idJeu`),
  ADD KEY `FK_CompoImgJeu_idJeu` (`idJeu`);

--
-- Index pour la table `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`idImage`);

--
-- Index pour la table `Jeux`
--
ALTER TABLE `Jeux`
  ADD PRIMARY KEY (`idJeu`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Articles`
--
ALTER TABLE `Articles`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `Compoimgjeu`
--
ALTER TABLE `Compoimgjeu`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Images`
--
ALTER TABLE `Images`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Jeux`
--
ALTER TABLE `Jeux`
  MODIFY `idJeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Articles`
--
ALTER TABLE `Articles`
  ADD CONSTRAINT `FK_Articles_idCategorie` FOREIGN KEY (`idCategorie`) REFERENCES `Categories` (`idCategorie`),
  ADD CONSTRAINT `FK_Articles_idJeu` FOREIGN KEY (`idJeu`) REFERENCES `Jeux` (`idJeu`);

--
-- Contraintes pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD CONSTRAINT `FK_Commentaires_idArticle` FOREIGN KEY (`idArticle`) REFERENCES `Articles` (`idArticle`);

--
-- Contraintes pour la table `Compoimgjeu`
--
ALTER TABLE `Compoimgjeu`
  ADD CONSTRAINT `FK_CompoImgJeu_idImage` FOREIGN KEY (`idImage`) REFERENCES `Images` (`idImage`),
  ADD CONSTRAINT `FK_CompoImgJeu_idJeu` FOREIGN KEY (`idJeu`) REFERENCES `Jeux` (`idJeu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
