Utilisation du site en local:

dans /public lancer php -S localhost:[port]

Le projet repose sur Symfony. Pour créer les tables de la base de données du site,
il suffit d'effectuer une migration des entités vers la base avec les commandes de doctrine.
Sinon, utiliser le script de création ci-dessous.

Afin d'avoir des véhicules initialement dans la base, nous avons également mis, quelques tuples à insérer.

-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
-- Jeu de données pour avoir des véhicules en base


--
-- Base de données :  `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `marque`
--

INSERT INTO `marque` (`id`, `name`) VALUES
(1, 'Mercedes'),
(2, 'Irisbus'),
(3, 'Iveco'),
(4, 'MAN'),
(5, 'Irizar'),
(6, 'Renault'),
(7, 'Setra');

-- --------------------------------------------------------



--
-- Structure de la table `modele`
--

CREATE TABLE `modele` (
  `id` int(11) NOT NULL,
  `marque_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `modele`
--

INSERT INTO `modele` (`id`, `marque_id`, `name`) VALUES
(5, 1, 'Intouro'),
(6, 1, 'Citaro'),
(7, 6, 'Agora'),
(8, 3, 'Urbanway'),
(9, 2, 'Crossway'),
(10, 3, 'Evadys'),
(11, 7, 'S415'),
(12, 5, 'iee'),
(13, 1, 'Tourismo');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C849554A4A3511` (`vehicule_id`),
  KEY `IDX_42C84955A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) 



-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `modele_id` int(11) NOT NULL,
  `ptac` double NOT NULL,
  `nb_places` int(11) NOT NULL,
  `energie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `norme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `critair` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `modele_id`, `ptac`, `nb_places`, `energie`, `annee`, `norme`, `critair`, `description`, `photo_path`, `price`) VALUES
(1, 5, 18000, 49, 'Diesel', 2011, '€5', 3, 'C\'est l\'un des cars de lignes et scolaire les plus vendus en Europe et en Turquie !\r\nIci en version boite de vitesse manuelle à 6 rapports, il conviendra pour du transport scolaires ou des petits voyages d\'1 à 2h.', 'Mercedes_Intouro.jpg', 120),
(2, 9, 18000, 55, 'Diesel', 2005, '€4', 4, 'L\'irisbus crossway est un car de ligne réputé dans les lignes régulières. Son moteur de 360ch donne un confort de conduite sur les petites routes de campagnes en montée, ainsi que pour effectuer des dépassements efficaces !\r\nIdéal donc pour du transport de courte durée en campagne et petites villes. ', 'Irisbus_Crossway.jpg', 90),
(3, 8, 165, 60, 'GNV', 2014, '€6', 1, 'L\'iveco Urbanway est l\'un des bus les plus présents dans la capitale (lignes 92 Porte d\'Orléans et 27 porte d4ivry entre autre)\r\nEquipé d\'un moteur GNV, il est idéal pour le transport en grande métropole', 'IVECO_Urbanway.jpg', 152),
(4, 7, 19, 80, 'GNV', 2002, '€3', 1, 'La fiabilité du Renault Agora n\'est plus à présenter... Encore présent sur de nombreuses lignes de la capitales, il est idéal pour du transport de personnes en zones urbaines.\r\nAvec son moteur au gaz naturel, vous pourrez entrer dans n\'importe quelle ville même en cas de pic de pollution.\r\nIdéal pour les petits budgets', 'Renault_Agora.jpg', 30),
(5, 5, 18, 49, 'Diesel', 2014, '€6', 2, 'C\'est l\'un des cars de lignes et scolaire les plus vendus en Europe et en Turquie !\r\nIci en version boite de vitesse automatique  PowerShift 8 rapports et équipé de climatisation, il pourra satisfaire pour des petits voyages d\'une durée de 1 à 4h', 'Mercedes_Intouro.jpg', 180),
(6, 11, 15, 47, 'Diesel', 2018, '€6', 2, 'Le setra S415 UL à plancher bas, dispose de tout le confort d\'un bus en terme d\'échange de voyageurs mais avec les avantages d\'un car. Disposant d\'un plaché bas, il est idéal pour le transport de personnes à mobilité réduites.\r\nHomologué \"car\" (bridage 100 km/h et non 70 hm/h), il saura vous satisfaire sur un trajet essentiellement urbain qui nécessite l’empreint de routes nationales, voies rapides ou autoroute.', 'S415_bas.jpg', 100),
(7, 12, 15, 70, 'Electricité', 2016, '€6', 0, 'L\'Irizar IEE est un bus urbain 100% électrique ! Silence et 0 émissions de CO2 sont de mise, avec le même confort passagers et conducteur que sur les bus thermiques.\r\nEn phase de test dans la ville du Havre en 2016, la ville en a acquis 3 définitivement.\r\nQu\'attendez-vous pour l\'essayer ?', 'iee.jpg', 110),
(8, 13, 23, 45, 'Diesel', 2014, '€6', 2, 'Vous voulez faire un voyage de plus de 4h ? Du tourisme international ? Ou tout simplement apporter un confort maximal à vos passagers ?\r\nLe Tourismo répond aux plus grandes exigences. Sièges en cuire pour les passagers, climatisation, toilettes et grand volume de soute c\'est le car idéal pour des voyages de plusieurs jours.\r\nCe car est conçu pour les grandes distances et dans certaines compagnies sert même à assurer du transport international de grande distance, tel que des liaisons entre l\'Europe et l\'Afrique du nord.', 'tourismo.jpg', 355),
(9, 10, 19, 45, 'Diesel', 2019, '€6', 2, 'L\'Iveco Evadys dernière génération du nom est la version tourisme du Crossway. Ce qui le différencie principalement de ses concurrents, c\'est sa porte arrière située dans le prote-à-faux du véhicule afin de garantir un espace maximal en soute.\r\nDoté de tout le confort d\'un car de tourisme (WC, clim ...), c\'est un parfait compromis entre car de tourisme et car de ligne. De plus, il reprend les principales caractéristiques du Crossway notamment au niveau du poste de conduite, un conducteur habitué au Crossway ne sera donc pas dépaysé par l\'Evadys.\r\nIdéal pour une excursion de plusieurs jours.', 'evadys.jpg', 300);


