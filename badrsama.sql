-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 mai 2024 à 15:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `badrsama`
--

-- --------------------------------------------------------

--
-- Structure de la table `cartitems`
--

CREATE TABLE `cartitems` (
  `CartItemID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `AddedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `CategoryImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Description`, `CategoryImage`) VALUES
(1, 'Foods', 'For you and your family and me', '664f3b1e92bd3_IMG_7832.jpg'),
(2, 'Supermaker', 'Supermaker', '664dec97816e2_664dc70608734_superMaker.jpg'),
(3, 'Health & Beauty', 'Health & Beauty', '664dcbbbc148a_Health & Beauty.jpg'),
(4, 'Home & Office', 'Home & Office', '664dcbdb47b9f_Home & Office.jpg'),
(5, 'Appliance', 'Appliance', '664f388454ffb_fY0wJ-QaIKghQ87Qs9ufsshTAws.png'),
(6, 'Phone & Tablets', 'Phone & Tablets', '664dcc2944b3f_Phone & Tablets.jpg'),
(7, 'Computing', 'Computing', '664dcc41469ea_Computing.jpg'),
(8, 'Electronics', 'Electronics', '664dcc632d7d8_Electronics.jpg'),
(9, 'Fashion', 'Fashion', '664dcc8d6da6d_Fashion.jpg'),
(10, 'Baby Products', 'Baby Products', '664dd311b5355_jomjakkapat-parrueng-qaUMOLJwb48-unsplash.jpg'),
(11, 'carte graphic', 'qsdfghyjkl', '66531ff8ea484_8083c857-f3ca-48a8-97cd-ace3b8666886.png');

-- --------------------------------------------------------

--
-- Structure de la table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderDetailID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `UnitPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `TotalAmount` decimal(10,2) NOT NULL,
  `Status` enum('pending','processing','completed','shipped','cancelled') NOT NULL,
  `ShippingAddress` varchar(255) DEFAULT NULL,
  `BillingAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `PaymentMethod` enum('credit card','cash on delivery') NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `PaymentDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `PaymentStatus` enum('pending','processing','completed','cancelled') NOT NULL,
  `TransactionID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `productattributes`
--

CREATE TABLE `productattributes` (
  `AttributeID` int(11) NOT NULL,
  `ProductTypeID` int(11) DEFAULT NULL,
  `AttributeName` varchar(100) NOT NULL,
  `DataType` enum('string','integer','decimal','boolean','date') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `productattributes`
--

INSERT INTO `productattributes` (`AttributeID`, `ProductTypeID`, `AttributeName`, `DataType`) VALUES
(10, 1, '1', 'integer'),
(12, 1, '5 dfgh', 'date'),
(53, 2, 'lovr', 'string'),
(54, 2, 'dq', 'decimal'),
(61, 2, 'qsc', 'string'),
(62, 2, 'ssqqdds', 'decimal'),
(64, 2, 'lazaza', 'string'),
(66, 1, 'love', 'string'),
(67, 3, 'Int', 'integer'),
(68, 3, 'deci', 'decimal'),
(69, 3, 'booo', 'boolean'),
(70, 3, 'date', 'date'),
(71, 3, 'String', 'string'),
(72, 4, 'dsqdsq', 'string'),
(74, 4, 'er', 'date'),
(75, 5, 'sgdsf', 'date'),
(76, 5, 'qfsqfq', 'integer'),
(77, 5, 'qsf', 'date'),
(78, 1, 'xwwxf', 'boolean'),
(79, 6, 'str', 'string'),
(80, 6, 'int', 'integer'),
(81, 6, 'deci', 'decimal'),
(82, 6, 'bool', 'boolean'),
(83, 6, 'date', 'date');

-- --------------------------------------------------------

--
-- Structure de la table `productattributevalues`
--

CREATE TABLE `productattributevalues` (
  `AttributeValueID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `AttributeID` int(11) DEFAULT NULL,
  `ValueString` varchar(255) DEFAULT NULL,
  `ValueInteger` int(11) DEFAULT NULL,
  `ValueDecimal` decimal(10,2) DEFAULT NULL,
  `ValueBoolean` tinyint(1) DEFAULT NULL,
  `ValueDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `productattributevalues`
--

INSERT INTO `productattributevalues` (`AttributeValueID`, `ProductID`, `AttributeID`, `ValueString`, `ValueInteger`, `ValueDecimal`, `ValueBoolean`, `ValueDate`) VALUES
(4, 5, 75, NULL, NULL, NULL, NULL, '2024-05-08'),
(5, 5, 76, NULL, 2, NULL, NULL, NULL),
(6, 5, 77, NULL, NULL, NULL, NULL, '2024-06-09'),
(7, 6, 72, 'fjhgfdsgh,jgfdhj', NULL, NULL, NULL, NULL),
(8, 6, 74, NULL, NULL, NULL, NULL, '2024-06-01'),
(9, 7, 67, NULL, 111, NULL, NULL, NULL),
(10, 7, 68, NULL, 222, NULL, NULL, NULL),
(11, 7, 70, NULL, NULL, NULL, NULL, '2024-05-30'),
(12, 7, 71, 'DEZA', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `ProductImage` text NOT NULL,
  `ProductTypeID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IsDeleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Description`, `Price`, `Stock`, `ProductImage`, `ProductTypeID`, `CreatedAt`, `UpdatedAt`, `IsDeleted`) VALUES
(1, '1312', '123456', 234.00, 26, '6653c1451219f_IMG_7830.jpg', 6, '2024-05-26 23:09:57', '2024-05-26 23:09:57', 0),
(2, 'qqsssqsqs', 'dfgh;,nbvc', 0.32, 20, '6653c985c83b2_a4b524ee-6492-493b-adf8-4fc850079bbb.jpeg', 1, '2024-05-26 23:45:09', '2024-05-26 23:45:09', 0),
(3, 'qqsssqsqs', 'dfgh;,nbvc', 0.32, 20, '6653cb7aaecd7_a4b524ee-6492-493b-adf8-4fc850079bbb.jpeg', 1, '2024-05-26 23:53:30', '2024-05-26 23:53:30', 0),
(4, 'qqsssqsqs', 'dfgh;,nbvc', 0.32, 20, '6653ccfe8b837_a4b524ee-6492-493b-adf8-4fc850079bbb.jpeg', 1, '2024-05-26 23:59:58', '2024-05-26 23:59:58', 0),
(5, 'dwfd', 'sfdsfsfs', 0.01, 1, '6653ce0696b99_4e1d9222-059b-4b0a-a820-7b9a7f6e84a0.png', 5, '2024-05-27 00:04:22', '2024-05-27 00:04:22', 0),
(6, 'zae', 'aezaz', 0.03, 1, '6653cf521023b_IMG_7830.jpg', 4, '2024-05-27 00:09:54', '2024-05-27 00:09:54', 0),
(7, 'sqdq', 'dqsdqq', 0.05, 4, '66542781c936e_Greenskull_apartment_micro_black_hole_in_the_center_of_the_room_dd3f62e5-c060-435d-a2c8-4ccfaa11c84f.png', 3, '2024-05-27 06:26:09', '2024-05-27 06:26:09', 0);

-- --------------------------------------------------------

--
-- Structure de la table `producttypecategories`
--

CREATE TABLE `producttypecategories` (
  `ProductTypeID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `producttypecategories`
--

INSERT INTO `producttypecategories` (`ProductTypeID`, `CategoryID`) VALUES
(1, 7),
(1, 9),
(1, 10),
(2, 4),
(3, 1),
(3, 5),
(4, 2),
(4, 5),
(5, 1),
(5, 2),
(5, 3),
(5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `producttypes`
--

CREATE TABLE `producttypes` (
  `ProductTypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `producttypes`
--

INSERT INTO `producttypes` (`ProductTypeID`, `TypeName`) VALUES
(4, 'bvc'),
(3, 'eee'),
(6, 'love and care'),
(1, 'test'),
(5, 'test here'),
(2, 'yutre');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `ZipCode` varchar(20) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `UserImage` text NOT NULL,
  `archived` tinyint(1) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `Email`, `FirstName`, `LastName`, `Address`, `City`, `ZipCode`, `PhoneNumber`, `is_admin`, `UserImage`, `archived`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'LoveBird', '$2y$10$tXov3cucd5HJEYsWxvGjHe2uiNJBZan5qWbRZbnM36BBnDogZcuUC', 'badr@mail.com', 'Oussama', 'LEKHAL', NULL, NULL, NULL, NULL, 1, '', 0, '2024-05-18 12:03:36', '2024-05-18 20:29:46'),
(2, 'CleverTimes', '$2y$10$tXov3cucd5HJEYsWxvGjHe2uiNJBZan5qWbRZbnM36BBnDogZcuUC', 'oussa@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, '2024-05-18 20:06:01', '2024-05-18 20:32:55'),
(4, 'CleverTimes_', '$2y$10$m8lCSTkv2KnGHN6degq4qOIQVkztTAmT2Np9STKWwUv578Aqqzere', 'yacin@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, '2024-05-18 20:35:15', '2024-05-18 20:35:15');

-- --------------------------------------------------------

--
-- Structure de la table `wishlistitems`
--

CREATE TABLE `wishlistitems` (
  `WishlistItemID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `AddedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`CartItemID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Index pour la table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD UNIQUE KEY `TransactionID` (`TransactionID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Index pour la table `productattributes`
--
ALTER TABLE `productattributes`
  ADD PRIMARY KEY (`AttributeID`),
  ADD KEY `ProductTypeID` (`ProductTypeID`);

--
-- Index pour la table `productattributevalues`
--
ALTER TABLE `productattributevalues`
  ADD PRIMARY KEY (`AttributeValueID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `AttributeID` (`AttributeID`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `fk_ProductTypeID` (`ProductTypeID`);

--
-- Index pour la table `producttypecategories`
--
ALTER TABLE `producttypecategories`
  ADD PRIMARY KEY (`ProductTypeID`,`CategoryID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Index pour la table `producttypes`
--
ALTER TABLE `producttypes`
  ADD PRIMARY KEY (`ProductTypeID`),
  ADD UNIQUE KEY `TypeName` (`TypeName`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `wishlistitems`
--
ALTER TABLE `wishlistitems`
  ADD PRIMARY KEY (`WishlistItemID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productattributes`
--
ALTER TABLE `productattributes`
  MODIFY `AttributeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `productattributevalues`
--
ALTER TABLE `productattributevalues`
  MODIFY `AttributeValueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `ProductTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `wishlistitems`
--
ALTER TABLE `wishlistitems`
  MODIFY `WishlistItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Contraintes pour la table `productattributes`
--
ALTER TABLE `productattributes`
  ADD CONSTRAINT `productattributes_ibfk_1` FOREIGN KEY (`ProductTypeID`) REFERENCES `producttypes` (`ProductTypeID`);

--
-- Contraintes pour la table `productattributevalues`
--
ALTER TABLE `productattributevalues`
  ADD CONSTRAINT `productattributevalues_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `productattributevalues_ibfk_2` FOREIGN KEY (`AttributeID`) REFERENCES `productattributes` (`AttributeID`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_ProductTypeID` FOREIGN KEY (`ProductTypeID`) REFERENCES `producttypes` (`ProductTypeID`) ON DELETE SET NULL;

--
-- Contraintes pour la table `producttypecategories`
--
ALTER TABLE `producttypecategories`
  ADD CONSTRAINT `producttypecategories_ibfk_1` FOREIGN KEY (`ProductTypeID`) REFERENCES `producttypes` (`ProductTypeID`),
  ADD CONSTRAINT `producttypecategories_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Contraintes pour la table `wishlistitems`
--
ALTER TABLE `wishlistitems`
  ADD CONSTRAINT `wishlistitems_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `wishlistitems_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
