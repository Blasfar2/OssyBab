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
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `CategoryImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `producttypes`
--

CREATE TABLE `producttypes` (
  `ProductTypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `producttypecategories`
--

CREATE TABLE `producttypecategories` (
  `ProductTypeID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

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
-- Déchargement des données de la table `cartitems`
--

INSERT INTO `cartitems` (`CartItemID`, `UserID`, `ProductID`, `Quantity`, `AddedAt`) VALUES
(11, 1, 14, 1, '2023-11-11 21:02:04'),
(16, 1, 5, 1, '2023-11-11 22:14:59'),
(17, 1, 7, 1, '2023-11-11 22:15:02');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailID`, `OrderID`, `ProductID`, `Quantity`, `UnitPrice`) VALUES
(14, 1, 5, 2, '29.00'),
(15, 1, 1, 2, '65.00'),
(16, 2, 7, 1, '69.00'),
(17, 2, 5, 1, '29.00');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `OrderDate`, `TotalAmount`, `Status`, `ShippingAddress`, `BillingAddress`) VALUES
(1, 1, '2023-11-11 21:00:00', '187.00', 'completed', NULL, NULL),
(2, 1, '2023-11-12 00:04:36', '98.00', 'completed', NULL, NULL);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`PaymentID`, `OrderID`, `PaymentMethod`, `Amount`, `PaymentDate`, `PaymentStatus`, `TransactionID`) VALUES
(1, 1, 'credit card', '187.00', '2023-11-11 21:00:00', 'completed', NULL),
(2, 2, 'credit card', '98.00', '2023-11-12 00:04:36', 'completed', NULL);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `productattributevalues`
--

INSERT INTO `productattributevalues` (`AttributeValueID`, `ProductID`, `AttributeID`, `ValueString`, `ValueInteger`, `ValueDecimal`, `ValueBoolean`, `ValueDate`) VALUES
(1, 7, 1, 'lenovo', NULL, NULL, NULL, NULL),
(2, 7, 2, NULL, 1, NULL, NULL, NULL),
(3, 7, 3, NULL, NULL, NULL, NULL, '2023-11-11');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `productattributes`
--

INSERT INTO `productattributes` (`AttributeID`, `ProductTypeID`, `AttributeName`, `DataType`) VALUES
(1, 1, 'brand', 'string'),
(2, 1, 'core', 'integer'),
(3, 1, 'createdAt', 'date');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Description`, `Price`, `Stock`, `ProductImage`, `ProductTypeID`, `CreatedAt`, `UpdatedAt`, `IsDeleted`) VALUES
(1, 'adidas', 'Adidas shoes description', '120.00', 10, '664dca176262b_Adidas (1).jpg', NULL, '2023-11-11 20:53:19', '2023-11-11 20:53:19', 0),
(2, 'Apple', 'Apple 13pro max description', '900.00', 5, '664dca59bd31a_IMG_7831.jpg', NULL, '2023-11-11 20:54:14', '2023-11-11 20:54:14', 0),
(3, 'Lg', 'Lg tv description', '200.00', 8, '664dca71be270_IMG_7832.jpg', NULL, '2023-11-11 20:54:34', '2023-11-11 20:54:34', 0),
(4, 'samsung', 'Samsung S23 Ultra description', '800.00', 7, '664dcaa6b53da_samsung (1).jpg', NULL, '2023-11-11 20:55:18', '2023-11-11 20:55:18', 0),
(5, 'watch', 'Apple Watch description', '29.00', 5, '664dcaedb8a24_IMG_7832.jpg', NULL, '2023-11-11 20:56:37', '2023-11-11 20:56:37', 0),
(6, 'Headphone', 'Sony headphones description', '49.00', 10, '664dcb2748f46_IMG_7832.jpg', NULL, '2023-11-11 20:57:43', '2023-11-11 20:57:43', 0),
(7, 'lenovo', 'Lenovo ThinkPad description', '69.00', 15, '664dcb4f01ff8_IMG_7832.jpg', NULL, '2023-11-11 20:58:23', '2023-11-11 20:58:23', 0);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `producttypecategories`
--

INSERT INTO `producttypecategories` (`ProductTypeID`, `CategoryID`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `producttypes`
--

INSERT INTO `producttypes` (`ProductTypeID`, `TypeName`) VALUES
(1, 'Computer');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `Email`, `FirstName`, `LastName`, `Address`, `City`, `ZipCode`, `PhoneNumber`, `is_admin`, `UserImage`, `archived`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'admin', '$2y$10$H/U1/QK9qlnRFuWkvi9Wu.PGhBPDdRQQlGZZBd7pTdtYlfWcrlE62', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'uploads/648209ef5d4a6_mii.png', 0, '2023-11-11 22:24:56', '2023-11-11 22:24:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
