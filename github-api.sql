-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:1234
-- Généré le :  Ven 01 Juin 2018 à 11:37
-- Version du serveur :  5.6.35
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `github-api`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`, `prenom`, `date_naissance`) VALUES
(1, 'Prevert', 'Jacques', '1900-02-04 00:00:00'),
(2, 'Hugo', 'Victor', '1802-02-28 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `livre_id` int(11) DEFAULT NULL,
  `texte` longtext COLLATE utf8_unicode_ci NOT NULL,
  `note` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `livre_id`, `texte`, `note`) VALUES
(1, 1, 'Super livre !', 15),
(2, 1, 'Compliqué à lire...', 12),
(3, 1, 'Très inspirant !', 17.5),
(7, 2, 'Grande littérature', 14),
(8, 2, 'Je n\'ai pas tout compris...', 12.4),
(9, 2, 'Incroyable !', 18),
(10, 3, 'Le plus beau livre de tout les temps !', 20);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id` int(11) NOT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_parution` datetime NOT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`id`, `auteur_id`, `titre`, `date_parution`, `genre`, `prix`) VALUES
(1, 1, 'Histoires', '1946-07-28 00:00:00', 'Poésie', 12.95),
(2, 1, 'Contes pour enfants pas sages', '1947-03-12 00:00:00', 'Livres pour enfants', 7.99),
(3, 2, 'Les misérables', '1862-08-19 00:00:00', 'Roman', 20.75),
(4, 2, 'Notre-Dame de Paris', '1831-09-03 00:00:00', 'Roman', 16.8);

-- --------------------------------------------------------

--
-- Structure de la table `security`
--

CREATE TABLE `security` (
  `id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `security`
--

INSERT INTO `security` (`id`, `token`) VALUES
(1, '6c89030400dbcd6561f8e03c8ccbeff4d8150988e635af53a581622da3223e37a64abb3f26a1cff7f0014c32e4ca615e76534fb53830e54c67603b892124c8d1');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `token`
--

INSERT INTO `token` (`id`, `token`, `date_creation`, `date_expiration`) VALUES
(10, '5b1111ecd3165', '2018-06-01 11:29:16', '2018-06-02 11:29:16'),
(11, '5b11121656963', '2018-06-01 11:29:58', '2018-06-02 11:29:58'),
(12, '5b111246e0195', '2018-06-01 11:30:46', '2018-06-02 11:30:46'),
(13, '5b1112a34efa4', '2018-06-01 11:32:19', '2018-06-02 11:32:19'),
(14, '5b1112cdef54c', '2018-06-01 11:33:01', '2018-06-02 11:33:01');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC37D925CB` (`livre_id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC634F9960BB6FE6` (`auteur_id`);

--
-- Index pour la table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5F37A13B5F37A13B` (`token`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `security`
--
ALTER TABLE `security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC37D925CB` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_AC634F9960BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`) ON DELETE SET NULL;
