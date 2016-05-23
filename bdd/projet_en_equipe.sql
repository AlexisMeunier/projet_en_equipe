-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Mai 2016 à 13:27
-- Version du serveur :  10.0.17-MariaDB
-- Version de PHP :  5.6.14

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
-- Structure de la table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `email`
--

INSERT INTO `email` (`id`, `email`, `objet`, `content`, `is_read`) VALUES
(4, 'meunier_33@live.fr', 'azeaze', 'azeaze', 1),
(5, 'meunier_33@live.fr', 'azerty', 'azeaze', 1),
(6, 'meunier_33@live.fr', 'azerty', 'erzerzerzerzerzerzerzerzerzerzerzerzer', 1),
(7, 'teste@email.fr', 'zerzerzer', 'zersfsdrgdgxdfgxdxfghfhcfghfghfghfghrg', 1),
(8, 'meunier_33@live.fr', 'sefsefsef', 'sefsefsefsefsef', 1);

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `infos`
--

INSERT INTO `infos` (`id`, `name`, `address`, `phone`, `picture`, `email`) VALUES
(1, 'Au Mess d''Elpis', '1 avenue des Dieux, 00000 L''Olympe', '0123456789', '../img/user-1463997738.jpg', 'mess.elpis@free.fr');

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
(10, 'Samosa façon jardinière', 'Les ingrédients ...\r\n... pour 16 samossas\r\n600g de pommes de terre à purée (ici de la Nicola) - 90g de petits pois - 1 carotte - 1 oignon rouge - 5 brins de coriandre - 2cc de cumin - 1 cc de piment doux - 8 feuilles de bricks - 1 jaune d''oeuf - 15cl d''ea', '../img/user-1463675251.jpg', '2016-05-19 18:27:31', 1),
(12, 'Bricks légères à la ricotta', 'Temps de préparation : 5 minutes\r\nTemps de cuisson : 15 minutes\r\n\r\nIngrédients (pour 6 personnes) :\r\n- 6 feuilles de bricks\r\n- 250 g de ricotta\r\n- 2 boîtes de miettes de crabe\r\n- basilic frais\r\n- sel, poivre\r\n\r\nPréparation de la recette :\r\n\r\nFouetter à la', '../img/user-1463989429.jpg', '2016-05-23 09:43:49', 1),
(13, 'Confit de courgettes', 'Temps de préparation : 5 minutes\r\nTemps de cuisson : 20 minutes\r\n\r\nIngrédients (pour 6 personnes) :\r\n- 1 kg de courgettes moyennes (6 à 8)\r\n- 1 poivron rouge\r\n- 1 poivron vert (ou jaune)\r\n- 2 tomates \r\n- ail (selon goût) \r\n- ciboulette\r\n- cerfeuil\r\n- pers', '../img/user-1463989667.jpg', '2016-05-23 09:47:47', 1),
(14, 'Méli-mélo courgettes-mangues', 'Temps de préparation : 20 minutes\r\nTemps de cuisson : 20 minutes\r\n\r\nIngrédients (pour 4 personnes) :\r\n- 4 courgettes de taille moyenne \r\n- 2 mangues pas trop mûres\r\n- 1 oignon blanc\r\n- huile d''olive, sel, poivre, muscade\r\n\r\nPréparation de la recette :\r\n\r\n', '../img/user-1463989714.jpg', '2016-05-23 09:48:34', 1),
(15, 'Les Timbales de Jeanne', 'Temps de préparation : 10 minutes\r\nTemps de cuisson : 3 minutes\r\n\r\nIngrédients (pour 4 personnes) :\r\n- 4 tranches de saumon fumé\r\n- 2 courgettes\r\n- 3 oeufs\r\n- 10 cl de crème fraîche épaisse\r\n- 1 petite gousse d''ail\r\n- 1 cuillère à soupe d''huile d''olive\r\n-', '../img/user-1463989763.jpg', '2016-05-23 09:49:23', 1),
(16, 'Petit soufflé léger au fromage de chèvre', 'Temps de préparation : 10 minutes\r\nTemps de cuisson : 10 minutes\r\n\r\nIngrédients (pour 1 personne) :\r\n- 1 oeuf\r\n- 50 g de fromage blanc à 0%\r\n- 50 g de fromage de chèvre frais\r\n- huile\r\n- sel, poivre\r\n- muscade\r\n\r\nPréparation de la recette :\r\n\r\nSéparer le ', '../img/user-1463989803.jpg', '2016-05-23 09:50:03', 1),
(17, 'Salade de céleri diététique', 'Temps de préparation : 20 minutes\r\nTemps de cuisson : 0 minutes\r\n\r\nIngrédients (pour 6 personnes) :\r\n- 2 céleris raves\r\n- 2 ou 3 gousses d''ail, selon votre goût\r\n- 1,5 yaourt\r\n- le jus d''1 citron\r\n- piment rouge fort en poudre\r\n- huile d''holive\r\n- sel et ', '../img/user-1463989840.jpg', '2016-05-23 09:50:40', 1),
(18, 'Salade minceur céleri et pomme', 'Temps de préparation : 10 minutes\r\nTemps de cuisson : 0 minutes\r\n\r\nIngrédients (pour 4 personnes) :\r\n- 6 belles branches de céleri\r\n- 1 grosse pomme (granny smith, de préférence) \r\n- 200 g de fromage blanc (0, 20 , 40 % au choix...) \r\n- 1 cuillerée à café', '../img/user-1463989922.jpg', '2016-05-23 09:52:02', 1),
(19, 'Salade pommes et feta', 'Temps de préparation : 10 minutes\r\nTemps de cuisson : 0 minutes\r\n\r\nIngrédients (pour 4 personnes) :\r\n- 200 g de feta nature \r\n- 2 pommes (Granny smith)\r\n- pour la verdure: j''ai une préférence pour les pousses d''épinard, mais vous pouvez opter pour de la m', '../img/user-1463993590.jpg', '2016-05-23 10:53:10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `token_pswd`
--

CREATE TABLE `token_pswd` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_exp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('member','admin') NOT NULL,
  `register_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `register_date`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.fr', '$2y$10$BLM93q.pCXaFcSEMKO3euuTO67VU.Ybj4HuEr7z0M5up8Eo6RnXTe', 'admin', '2016-05-19 13:33:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `token_pswd`
--
ALTER TABLE `token_pswd`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `token_pswd`
--
ALTER TABLE `token_pswd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
