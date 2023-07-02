-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 02 juil. 2023 à 13:11
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `service_id`, `booking_date`) VALUES
(1, 1, 3, '2023-06-01'),
(2, 2, 4, '2023-06-02'),
(3, 3, 1, '2023-06-03'),
(4, 4, 2, '2023-06-04'),
(5, 5, 6, '2023-06-05'),
(6, 6, 5, '2023-06-06');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Santé'),
(2, 'Transport'),
(3, 'Éducation'),
(4, 'Coiffeur'),
(5, 'Alimentation'),
(6, 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `rating` decimal(10,0) DEFAULT NULL,
  `comment_reviews` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `service_id`, `rating`, `comment_reviews`) VALUES
(1, 1, 3, 4, 'Service de réparation d\'ordinateurs très professionnel. Je suis très satisfait.'),
(2, 2, 4, 5, 'Les cours de cuisine italienne étaient incroyables ! J\'ai appris beaucoup de recettes délicieuses.'),
(3, 3, 1, 3, 'La consultation médicale était informative, mais le médecin était pressé.'),
(4, 4, 2, 4, 'Le cours de mathématiques m\'a beaucoup aidé. Le tuteur était patient et compétent.'),
(5, 5, 6, 5, 'Les séances d\'entraînement personnel étaient intenses et motivantes. Je recommande vivement.'),
(6, 6, 5, 4, 'Le service de stylisme personnel était professionnel. J\'ai reçu de précieux conseils de mode.');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` varchar(100) NOT NULL,
  `pictures` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`service_id`, `user_id`, `category_id`, `service_name`, `description`, `location`, `price`, `availability`, `pictures`) VALUES
(1, 2, 1, 'Consultation médicale', 'Consultation générale avec un médecin', 'Cabinet médical', 50.00, 'Disponible', './images/san2.jpeg'),
(2, 4, 3, 'Cours de mathématiques', 'Cours particulier de mathématiques', 'En ligne', 30.00, 'Disponible', './images/edu2.jpeg'),
(3, 1, 2, 'Transport publique', 'Rapide, fiable, pratique.', 'Les stations de BUS', 80.00, 'Disponible', './images/tran2.jpeg'),
(4, 3, 5, 'Cours de cuisine italienne', 'Cours de cuisine italienne traditionnelle', 'École de cuisine', 45.00, 'Disponible', './images/cui2.jpeg'),
(5, 6, 4, 'Stylisme personnel', 'Conseils de stylisme et création de coupe', 'Salon de Coiffure', 60.00, 'Disponible', './images/coif2.jpeg'),
(6, 5, 6, 'Entraînement personnel', 'Séances d\'entraînement individuelles', 'Salle de sport', 40.00, 'Disponible', './images/spo2.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `service_requests`
--

CREATE TABLE `service_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `request_text` text DEFAULT NULL,
  `status` enum('Pending','Accepted','Declined') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service_requests`
--

INSERT INTO `service_requests` (`request_id`, `user_id`, `service_id`, `request_text`, `status`) VALUES
(1, 1, 3, 'J\'aimerais réserver une consultation médicale pour demain matin.', 'Pending'),
(2, 2, 4, 'Je suis intéressé par les cours de cuisine italienne. Quelles sont les prochaines disponibilités ?', 'Pending'),
(3, 3, 1, 'J\'ai besoin d\'une consultation médicale urgente. Est-ce que vous pouvez me voir aujourd\'hui ?', 'Pending'),
(4, 4, 2, 'J\'aimerais réserver des cours de mathématiques pour mon fils de 15 ans.', 'Pending'),
(5, 5, 6, 'Je cherche un entraîneur personnel pour me préparer à un marathon.', 'Pending'),
(6, 6, 5, 'J\'aimerais obtenir des conseils de stylisme pour une occasion spéciale.', 'Pending');

-- --------------------------------------------------------

--
-- Structure de la table `service_subcategory`
--

CREATE TABLE `service_subcategory` (
  `service_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `profil_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `full_name`, `user_email`, `user_password`, `profil_picture`) VALUES
(1, 'johnDoe', 'John Doe', 'john.doe@example.com', 'password123', 'profile1.jpg'),
(2, 'janeSmith', 'Jane Smith', 'jane.smith@example.com', 'password456', 'profile2.jpg'),
(3, 'bobJohnson', 'Bob Johnson', 'bob.johnson@example.com', 'password789', 'profile3.jpg'),
(4, 'emmaBrown', 'Emma Brown', 'emma.brown@example.com', 'passwordabc', 'profile4.jpg'),
(5, 'mikeDavis', 'Mike Davis', 'mike.davis@example.com', 'passworddef', 'profile5.jpg'),
(6, 'sarahWilson', 'Sarah Wilson', 'sarah.wilson@example.com', 'passwordxyz', 'profile6.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user_services`
--

CREATE TABLE `user_services` (
  `user_service_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `is_provider` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
