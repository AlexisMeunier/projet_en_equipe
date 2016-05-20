-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Mai 2016 à 18:29
-- Version du serveur :  10.1.10-MariaDB
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_en_equipe`
--

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `content`, `picture`, `date_add`, `user_id`) VALUES
(7, 'Ceviche péruvien', '- Préparation : 30 minutes - Cuisson : 20 minutes -\r\n- Repos : 1 heure -\r\nLes ingrédients ...\r\n... pour 2 personnes\r\n250g de lieu - 250g de patate douce - 3 à 4CS de maïs - 2 grosses feuilles de salade - 2 citrons verts - 1 piment rouge - 1 oignon rouge -', '../img/user-1463674550.jpg', '2016-05-19 18:15:50', 1),
(8, 'Quiche ruban', 'Les ingrédients ...\r\n... pour 4 personnes\r\n400g de fromage blanc (0% MG autorisé) - 4 oeufs - 8CS rases de farine de quinoa (ou toute autre farine) - 4CS de concentré de tomate - 1CS de moutarde à l''ancienne - 3 carottes violettes - 3 carottes - 1 courget', '../img/user-1463674848.jpg', '2016-05-19 18:20:48', 1),
(9, 'Tarte aux fraises et crème d''Amandes', '- Préparation : 1h30 - Cuisson : 25 minutes -\r\n- Repos : 2 heures -\r\nLes ingrédients ...\r\n... pour 6 personnes / un moule de 24 cm ø\r\n500g de fraises type Gariguette // Le nappage : 5cl d''eau - 50g de sucre // La pâte sucrée : 23g d''amandes en poudre - 20', '../img/user-1463675125.jpg', '2016-05-19 18:25:25', 1),
(10, 'Samosa façon jardinière', 'Les ingrédients ...\r\n... pour 16 samossas\r\n600g de pommes de terre à purée (ici de la Nicola) - 90g de petits pois - 1 carotte - 1 oignon rouge - 5 brins de coriandre - 2cc de cumin - 1 cc de piment doux - 8 feuilles de bricks - 1 jaune d''oeuf - 15cl d''ea', '../img/user-1463675251.jpg', '2016-05-19 18:27:31', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
