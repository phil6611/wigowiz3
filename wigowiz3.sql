-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 05 Juillet 2016 à 19:25
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `wigowiz3`
--

-- --------------------------------------------------------

--
-- Structure de la table `url_liens`
--

CREATE TABLE IF NOT EXISTS `url_liens` (
  `id_liens` char(36) NOT NULL,
  `adresse_liens` varchar(256) NOT NULL,
  `raccourci_liens` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_agenda`
--

CREATE TABLE IF NOT EXISTS `wigowiz_agenda` (
`id_agenda` int(11) NOT NULL,
  `participant_id` int(11) DEFAULT NULL,
  `code_agenda` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8 COMMENT='Cette table contient les informations pour créer les agendas des utilisateurs.\n';

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_agenda_partage`
--

CREATE TABLE IF NOT EXISTS `wigowiz_agenda_partage` (
  `id_agenda_partage` int(11) NOT NULL,
  `nom_agenda_partage` varchar(45) NOT NULL,
  `description_agenda_partage` varchar(256) DEFAULT NULL,
  `code_agenda_partage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cette table contient la liste des agendas partagés';

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_blog_billets`
--

CREATE TABLE IF NOT EXISTS `wigowiz_blog_billets` (
`id_blog_billets` int(11) NOT NULL,
  `titre_blog_billets` varchar(256) NOT NULL,
  `description_blog_billets` varchar(256) DEFAULT NULL,
  `chapeau_blog_billets` varchar(256) NOT NULL,
  `texte_blog_billets` text,
  `blog_utilisateurs_id` int(11) NOT NULL,
  `date_blog_billets` date DEFAULT NULL,
  `blog_etat_id` int(11) DEFAULT NULL,
  `blog_thematique_id` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_blog_billets_motscles_jointure`
--

CREATE TABLE IF NOT EXISTS `wigowiz_blog_billets_motscles_jointure` (
`id_blog_billets_motscles_jointure` int(11) NOT NULL,
  `motscles_id_blog_billets_motscles_jointure` int(11) DEFAULT NULL,
  `billets_id_blog_billets_motscles_jointure` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_blog_etats`
--

CREATE TABLE IF NOT EXISTS `wigowiz_blog_etats` (
`id_blog_etats` int(11) NOT NULL,
  `blog_nom_etats` varchar(45) DEFAULT NULL,
  `blog_commentaires_etats` varchar(256) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_blog_motscles`
--

CREATE TABLE IF NOT EXISTS `wigowiz_blog_motscles` (
`id_blog_motscles` int(11) NOT NULL,
  `blog_texte_motscles` varchar(45) DEFAULT NULL,
  `blog_commentaires_motscles` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_blog_thematiques`
--

CREATE TABLE IF NOT EXISTS `wigowiz_blog_thematiques` (
`id_blog_thematiques` int(11) NOT NULL,
  `blog_nom_thematiques` varchar(45) DEFAULT NULL,
  `blog_commentaires_thematiques` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_categories`
--

CREATE TABLE IF NOT EXISTS `wigowiz_categories` (
`id_categories` int(11) NOT NULL,
  `nom_categories` varchar(5) DEFAULT NULL,
  `nom_complet_categories` varchar(256) DEFAULT NULL,
  `commentaires_categories` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_cibles_categories`
--

CREATE TABLE IF NOT EXISTS `wigowiz_cibles_categories` (
`id_categorie` int(11) NOT NULL,
  `intitule` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_contacts`
--

CREATE TABLE IF NOT EXISTS `wigowiz_contacts` (
`id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_evenements`
--

CREATE TABLE IF NOT EXISTS `wigowiz_evenements` (
`id_evenement` int(11) NOT NULL,
  `id_createur` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `ville` varchar(200) NOT NULL,
  `pays` varchar(250) NOT NULL,
  `date_evenement` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `envoi_alerte` int(1) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `code` varchar(50) NOT NULL,
  `code_admin` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_informations_site`
--

CREATE TABLE IF NOT EXISTS `wigowiz_informations_site` (
`id_informations_site` int(11) NOT NULL,
  `nom_site` varchar(100) DEFAULT NULL,
  `email_site` varchar(100) DEFAULT NULL,
  `commentaires_site` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cette table contient toutes les informations techniques sur ';

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_langues`
--

CREATE TABLE IF NOT EXISTS `wigowiz_langues` (
`id_langues` int(11) NOT NULL,
  `nom_langues` varchar(45) DEFAULT NULL,
  `raccourci_langues` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_messages`
--

CREATE TABLE IF NOT EXISTS `wigowiz_messages` (
`id_message` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `message_expediteur` text NOT NULL,
  `date_message` datetime NOT NULL,
  `etat_message` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_pages`
--

CREATE TABLE IF NOT EXISTS `wigowiz_pages` (
`id_pages` int(11) NOT NULL,
  `nom_pages` varchar(45) DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_participants`
--

CREATE TABLE IF NOT EXISTS `wigowiz_participants` (
`id_participant` int(11) NOT NULL,
  `nom_participant` varchar(250) NOT NULL,
  `prenom_participant` varchar(250) NOT NULL,
  `adresse_participant` varchar(250) NOT NULL,
  `cp_participant` varchar(50) NOT NULL,
  `ville_participant` varchar(250) NOT NULL,
  `pays_participant` varchar(250) NOT NULL DEFAULT 'France',
  `email_participant` varchar(250) NOT NULL,
  `token_participant` varchar(40) NOT NULL,
  `cacher_email` int(1) NOT NULL,
  `cacher_adresse` int(1) NOT NULL,
  `tel_participant` varchar(200) NOT NULL,
  `vehicule` int(1) NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL,
  `motdepasse` varchar(200) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_relations`
--

CREATE TABLE IF NOT EXISTS `wigowiz_relations` (
`id_relation` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL,
  `id_participant` int(11) NOT NULL,
  `distance` float NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_relation_agenda_partage`
--

CREATE TABLE IF NOT EXISTS `wigowiz_relation_agenda_partage` (
`id_relation_agenda_partage` int(11) NOT NULL,
  `utilisateurs_id` int(11) NOT NULL,
  `agenda_partage_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_rss`
--

CREATE TABLE IF NOT EXISTS `wigowiz_rss` (
`id_rss` int(11) NOT NULL,
  `titre_rss` varchar(256) DEFAULT NULL,
  `texte_rss` text,
  `lien_rss` text,
  `pubdate_rss` text,
  `date_evenement_rss` varchar(256) DEFAULT NULL,
  `tri_rss` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_securite`
--

CREATE TABLE IF NOT EXISTS `wigowiz_securite` (
`id_securite` int(11) NOT NULL,
  `niveau_securite` varchar(45) DEFAULT NULL,
  `numero_securite` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_textes`
--

CREATE TABLE IF NOT EXISTS `wigowiz_textes` (
`id_textes` int(11) NOT NULL,
  `titre_textes` varchar(256) DEFAULT NULL,
  `description_textes` varchar(256) DEFAULT NULL,
  `mots_cles_textes` varchar(256) DEFAULT NULL,
  `contenu_textes` text,
  `pages_id` int(11) DEFAULT NULL,
  `langues_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_themes`
--

CREATE TABLE IF NOT EXISTS `wigowiz_themes` (
`id_themes` int(11) NOT NULL,
  `nom_themes` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wigowiz_utilisateurs`
--

CREATE TABLE IF NOT EXISTS `wigowiz_utilisateurs` (
`id_utilisateurs` int(11) NOT NULL,
  `uuid_utilisateurs` varchar(36) DEFAULT NULL,
  `nom_utilisateurs` varchar(100) DEFAULT NULL,
  `prenom_utilisateurs` varchar(100) DEFAULT NULL,
  `email_utilisateurs` varchar(256) DEFAULT NULL,
  `securite_id` int(11) DEFAULT NULL,
  `mdp_utilisateurs` varchar(256) DEFAULT NULL,
  `langues_utilisateurs` int(11) DEFAULT NULL,
  `login_utilisateurs` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `url_liens`
--
ALTER TABLE `url_liens`
 ADD PRIMARY KEY (`id_liens`);

--
-- Index pour la table `wigowiz_agenda`
--
ALTER TABLE `wigowiz_agenda`
 ADD PRIMARY KEY (`id_agenda`), ADD KEY `fk_wigowiz_agenda_participant_idx` (`participant_id`);

--
-- Index pour la table `wigowiz_agenda_partage`
--
ALTER TABLE `wigowiz_agenda_partage`
 ADD PRIMARY KEY (`id_agenda_partage`);

--
-- Index pour la table `wigowiz_blog_billets`
--
ALTER TABLE `wigowiz_blog_billets`
 ADD PRIMARY KEY (`id_blog_billets`);

--
-- Index pour la table `wigowiz_blog_billets_motscles_jointure`
--
ALTER TABLE `wigowiz_blog_billets_motscles_jointure`
 ADD PRIMARY KEY (`id_blog_billets_motscles_jointure`);

--
-- Index pour la table `wigowiz_blog_etats`
--
ALTER TABLE `wigowiz_blog_etats`
 ADD PRIMARY KEY (`id_blog_etats`);

--
-- Index pour la table `wigowiz_blog_motscles`
--
ALTER TABLE `wigowiz_blog_motscles`
 ADD PRIMARY KEY (`id_blog_motscles`);

--
-- Index pour la table `wigowiz_blog_thematiques`
--
ALTER TABLE `wigowiz_blog_thematiques`
 ADD PRIMARY KEY (`id_blog_thematiques`);

--
-- Index pour la table `wigowiz_categories`
--
ALTER TABLE `wigowiz_categories`
 ADD PRIMARY KEY (`id_categories`);

--
-- Index pour la table `wigowiz_cibles_categories`
--
ALTER TABLE `wigowiz_cibles_categories`
 ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `wigowiz_contacts`
--
ALTER TABLE `wigowiz_contacts`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `wigowiz_evenements`
--
ALTER TABLE `wigowiz_evenements`
 ADD PRIMARY KEY (`id_evenement`), ADD KEY `fk_evenements_participant` (`id_createur`);

--
-- Index pour la table `wigowiz_informations_site`
--
ALTER TABLE `wigowiz_informations_site`
 ADD PRIMARY KEY (`id_informations_site`);

--
-- Index pour la table `wigowiz_langues`
--
ALTER TABLE `wigowiz_langues`
 ADD PRIMARY KEY (`id_langues`);

--
-- Index pour la table `wigowiz_messages`
--
ALTER TABLE `wigowiz_messages`
 ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `wigowiz_pages`
--
ALTER TABLE `wigowiz_pages`
 ADD PRIMARY KEY (`id_pages`), ADD KEY `fk_categories_idx` (`categories_id`);

--
-- Index pour la table `wigowiz_participants`
--
ALTER TABLE `wigowiz_participants`
 ADD PRIMARY KEY (`id_participant`), ADD UNIQUE KEY `unique_participant` (`email_participant`,`prenom_participant`,`nom_participant`,`motdepasse`);

--
-- Index pour la table `wigowiz_relations`
--
ALTER TABLE `wigowiz_relations`
 ADD PRIMARY KEY (`id_relation`), ADD UNIQUE KEY `inscription_unique` (`id_evenement`,`id_participant`) COMMENT 'empêche de s''inscrire plusieurs fois au même événement', ADD KEY `fk_relations_evenement_idx` (`id_evenement`), ADD KEY `fk_relations_participant_idx` (`id_participant`);

--
-- Index pour la table `wigowiz_relation_agenda_partage`
--
ALTER TABLE `wigowiz_relation_agenda_partage`
 ADD PRIMARY KEY (`id_relation_agenda_partage`), ADD KEY `fk_wigowiz_relation_agenda_partage_utilisateurs_idx` (`utilisateurs_id`), ADD KEY `fk_wigowiz_relation_agenda_partage_agenda_idx` (`agenda_partage_id`);

--
-- Index pour la table `wigowiz_rss`
--
ALTER TABLE `wigowiz_rss`
 ADD PRIMARY KEY (`id_rss`);

--
-- Index pour la table `wigowiz_securite`
--
ALTER TABLE `wigowiz_securite`
 ADD PRIMARY KEY (`id_securite`);

--
-- Index pour la table `wigowiz_textes`
--
ALTER TABLE `wigowiz_textes`
 ADD PRIMARY KEY (`id_textes`), ADD KEY `fk_textes_pages_idx` (`pages_id`), ADD KEY `fk_textes_langues_idx` (`langues_id`), ADD FULLTEXT KEY `fulltext_textes` (`titre_textes`,`description_textes`,`contenu_textes`);

--
-- Index pour la table `wigowiz_themes`
--
ALTER TABLE `wigowiz_themes`
 ADD PRIMARY KEY (`id_themes`);

--
-- Index pour la table `wigowiz_utilisateurs`
--
ALTER TABLE `wigowiz_utilisateurs`
 ADD PRIMARY KEY (`id_utilisateurs`), ADD KEY `fk_utilisateurs_securite_idx` (`securite_id`), ADD KEY `fk_utilisateurs_langue_idx` (`langues_utilisateurs`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `wigowiz_agenda`
--
ALTER TABLE `wigowiz_agenda`
MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT pour la table `wigowiz_blog_billets`
--
ALTER TABLE `wigowiz_blog_billets`
MODIFY `id_blog_billets` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_blog_billets_motscles_jointure`
--
ALTER TABLE `wigowiz_blog_billets_motscles_jointure`
MODIFY `id_blog_billets_motscles_jointure` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_blog_etats`
--
ALTER TABLE `wigowiz_blog_etats`
MODIFY `id_blog_etats` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `wigowiz_blog_motscles`
--
ALTER TABLE `wigowiz_blog_motscles`
MODIFY `id_blog_motscles` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_blog_thematiques`
--
ALTER TABLE `wigowiz_blog_thematiques`
MODIFY `id_blog_thematiques` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_categories`
--
ALTER TABLE `wigowiz_categories`
MODIFY `id_categories` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_cibles_categories`
--
ALTER TABLE `wigowiz_cibles_categories`
MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_contacts`
--
ALTER TABLE `wigowiz_contacts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `wigowiz_evenements`
--
ALTER TABLE `wigowiz_evenements`
MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT pour la table `wigowiz_informations_site`
--
ALTER TABLE `wigowiz_informations_site`
MODIFY `id_informations_site` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_langues`
--
ALTER TABLE `wigowiz_langues`
MODIFY `id_langues` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_messages`
--
ALTER TABLE `wigowiz_messages`
MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `wigowiz_pages`
--
ALTER TABLE `wigowiz_pages`
MODIFY `id_pages` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_participants`
--
ALTER TABLE `wigowiz_participants`
MODIFY `id_participant` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT pour la table `wigowiz_relations`
--
ALTER TABLE `wigowiz_relations`
MODIFY `id_relation` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT pour la table `wigowiz_relation_agenda_partage`
--
ALTER TABLE `wigowiz_relation_agenda_partage`
MODIFY `id_relation_agenda_partage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `wigowiz_rss`
--
ALTER TABLE `wigowiz_rss`
MODIFY `id_rss` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_securite`
--
ALTER TABLE `wigowiz_securite`
MODIFY `id_securite` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `wigowiz_textes`
--
ALTER TABLE `wigowiz_textes`
MODIFY `id_textes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_themes`
--
ALTER TABLE `wigowiz_themes`
MODIFY `id_themes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `wigowiz_utilisateurs`
--
ALTER TABLE `wigowiz_utilisateurs`
MODIFY `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `wigowiz_agenda`
--
ALTER TABLE `wigowiz_agenda`
ADD CONSTRAINT `fk_wigowiz_agenda_participant` FOREIGN KEY (`participant_id`) REFERENCES `wigowiz_participants` (`id_participant`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `wigowiz_evenements`
--
ALTER TABLE `wigowiz_evenements`
ADD CONSTRAINT `fk_evenements_participant` FOREIGN KEY (`id_createur`) REFERENCES `wigowiz_participants` (`id_participant`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `wigowiz_pages`
--
ALTER TABLE `wigowiz_pages`
ADD CONSTRAINT `fk_pages_categories` FOREIGN KEY (`categories_id`) REFERENCES `wigowiz_categories` (`id_categories`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `wigowiz_relations`
--
ALTER TABLE `wigowiz_relations`
ADD CONSTRAINT `fk_relations_evenement` FOREIGN KEY (`id_evenement`) REFERENCES `wigowiz_evenements` (`id_evenement`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_relations_participant` FOREIGN KEY (`id_participant`) REFERENCES `wigowiz_participants` (`id_participant`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `wigowiz_relation_agenda_partage`
--
ALTER TABLE `wigowiz_relation_agenda_partage`
ADD CONSTRAINT `fk_wigowiz_relation_agenda_partage_agenda` FOREIGN KEY (`agenda_partage_id`) REFERENCES `wigowiz_agenda_partage` (`id_agenda_partage`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_wigowiz_relation_agenda_partage_utilisateurs` FOREIGN KEY (`utilisateurs_id`) REFERENCES `wigowiz_participants` (`id_participant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
