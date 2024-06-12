-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 juin 2024 à 23:44
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
(2, 'Supermaker', 'Discover the freshest produce and a wide variety of organic options at our supermarket. Your one-stop shop for quality groceries at unbeatable prices.', '664dec97816e2_664dc70608734_superMaker.jpg'),
(3, 'Health & Beauty', 'Rejuvenate your skin with our all-natural skincare line, packed with vitamins and antioxidants to keep you glowing all day long.', '664dcbbbc148a_Health & Beauty.jpg'),
(4, 'Home & Office', 'Transform your workspace with our ergonomic office chairs, designed for maximum comfort and productivity. Style meets function with our sleek designs.', '664dcbdb47b9f_Home & Office.jpg'),
(5, 'Appliance', 'Upgrade your kitchen with our state-of-the-art blender, featuring multiple speed settings and a durable stainless steel blade for effortless blending.', '664f388454ffb_fY0wJ-QaIKghQ87Qs9ufsshTAws.png'),
(6, 'Phone & Tablets', 'Stay connected with our latest smartphone, boasting a stunning display, powerful processor, and long-lasting battery life. Your perfect tech companion.', '664dcc2944b3f_Phone & Tablets.jpg'),
(8, 'Electronics', 'Experience cinematic sound with our premium wireless headphones, offering crystal-clear audio and noise-cancellation for an immersive listening experience.', '664dcc632d7d8_Electronics.jpg'),
(9, 'Fashion', 'Step out in style with our new summer collection, featuring trendy designs and vibrant colors. From casual wear to elegant outfits, we have something for every occasion.', '664dcc8d6da6d_Fashion.jpg'),
(10, 'Baby Products', 'Ensure your baby\'s comfort with our ultra-soft, hypoallergenic diapers, designed to keep your little one dry and happy all day long.', '664dd311b5355_jomjakkapat-parrueng-qaUMOLJwb48-unsplash.jpg'),
(14, 'Toys & Games', 'Unlock a world of fun and creativity with our latest building block set! Perfect for kids and adults alike, this set promotes problem-solving skills and endless hours of imaginative play. Safe, durable, and colorful – the ultimate addition to your toy collection.', '666a032323cea_1660896887938.jpeg');

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

--
-- Déchargement des données de la table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailID`, `OrderID`, `ProductID`, `Quantity`, `UnitPrice`) VALUES
(1, 3, 1, 2, 12.00),
(2, 3, 2, 3, 332.00),
(3, 3, 4, 1, 22.00);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `TotalAmount` decimal(10,2) NOT NULL,
  `Status` enum('pending','processing','completed','shipped','cancelled') NOT NULL DEFAULT 'pending',
  `ShippingAddress` varchar(255) DEFAULT NULL,
  `BillingAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `OrderDate`, `TotalAmount`, `Status`, `ShippingAddress`, `BillingAddress`) VALUES
(1, 1, '2024-05-29 22:19:15', 250.00, 'pending', 'ddvgsgds', 'gdsgsd'),
(2, 1, '2024-05-29 22:20:01', 78787.00, 'cancelled', '3212315', '654ds654s64f6s4fs54fs64f'),
(3, 1, '2024-05-30 21:40:02', 54.00, 'shipped', '4545', '4545'),
(4, 1, '2024-05-30 21:40:02', 4545.00, 'completed', NULL, NULL),
(5, 2, '2024-06-01 10:16:01', 250.00, 'shipped', NULL, NULL),
(6, 2, '2024-06-01 10:16:01', 4545.00, 'processing', NULL, NULL),
(7, 4, '2024-06-01 10:16:01', 5454.00, 'pending', NULL, NULL);

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
(97, 9, 'name', 'string'),
(98, 9, 'Color', 'string'),
(99, 9, 'Style', 'string'),
(100, 9, 'Material', 'string'),
(101, 9, 'Occasion', 'string'),
(102, 9, 'Mosaic Material', 'string'),
(103, 9, 'Plating', 'string'),
(104, 9, 'Holiday', 'string'),
(106, 10, 'Color', 'string'),
(107, 10, 'Applicable Age Group', 'string'),
(108, 10, 'Material', 'string'),
(109, 10, 'Reusability', 'string'),
(110, 10, 'Style', 'string'),
(111, 10, 'Major Material', 'string'),
(113, 10, 'Theme', 'string'),
(114, 11, 'name', 'string'),
(115, 11, 'Shoe Size', 'string'),
(116, 11, 'Color', 'string'),
(117, 11, 'Pattern', 'string'),
(118, 11, 'Upper Material', 'string');

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
(67, 15, 88, 'Men\'s Jewelry', NULL, NULL, NULL, NULL),
(68, 15, 89, 'white', NULL, NULL, NULL, NULL),
(69, 15, 90, 'Cute', NULL, NULL, NULL, NULL),
(70, 15, 91, 'Plastic', NULL, NULL, NULL, NULL),
(71, 15, 92, 'Gift-giving Occasion', NULL, NULL, NULL, NULL),
(72, 15, 93, 'Rhinestones', NULL, NULL, NULL, NULL),
(73, 15, 94, 'Silver Plated', NULL, NULL, NULL, NULL),
(74, 15, 95, 'Campus Related', NULL, NULL, NULL, NULL),
(75, 15, 96, NULL, NULL, 70.00, NULL, NULL),
(76, 15, 97, 'Men\'s Jewelry', NULL, NULL, NULL, NULL),
(77, 15, 98, 'white', NULL, NULL, NULL, NULL),
(78, 15, 99, 'Plastic', NULL, NULL, NULL, NULL),
(79, 15, 100, 'Vacation Occasion', NULL, NULL, NULL, NULL),
(80, 15, 101, 'Gift-giving Occasion', NULL, NULL, NULL, NULL),
(81, 15, 102, 'Imitation Pearl', NULL, NULL, NULL, NULL),
(82, 15, 103, 'Silver Plated', NULL, NULL, NULL, NULL),
(83, 15, 104, 'Spring Festival', NULL, NULL, NULL, NULL),
(84, 16, 106, 'white', NULL, NULL, NULL, NULL),
(85, 16, 107, '14+', NULL, NULL, NULL, NULL),
(86, 16, 108, 'Plastic', NULL, NULL, NULL, NULL),
(87, 16, 109, 'Reusable', NULL, NULL, NULL, NULL),
(88, 16, 110, 'Casual', NULL, NULL, NULL, NULL),
(89, 16, 111, 'Latex', NULL, NULL, NULL, NULL),
(90, 16, 113, 'Vehicles', NULL, NULL, NULL, NULL),
(91, 17, 106, 'yellow', NULL, NULL, NULL, NULL),
(92, 17, 107, '12 years old (not included) - 14 years old (included)', NULL, NULL, NULL, NULL),
(93, 17, 108, 'Plastic', NULL, NULL, NULL, NULL),
(94, 17, 109, 'Single Use', NULL, NULL, NULL, NULL),
(95, 17, 110, 'Simple', NULL, NULL, NULL, NULL),
(96, 17, 111, 'PP', NULL, NULL, NULL, NULL),
(97, 17, 113, 'Vehicles', NULL, NULL, NULL, NULL),
(98, 18, 97, 'Women\'s Jewelry', NULL, NULL, NULL, NULL),
(99, 18, 98, 'white', NULL, NULL, NULL, NULL),
(100, 18, 99, 'Vintage', NULL, NULL, NULL, NULL),
(101, 18, 100, 'Acrylic', NULL, NULL, NULL, NULL),
(102, 18, 101, 'Wedding Occasion', NULL, NULL, NULL, NULL),
(103, 18, 102, 'moissanite', NULL, NULL, NULL, NULL),
(104, 18, 103, '14K Gold Plated', NULL, NULL, NULL, NULL),
(105, 18, 104, 'Valentine\'s Day', NULL, NULL, NULL, NULL),
(106, 19, 97, 'Women\'s Glasses', NULL, NULL, NULL, NULL),
(107, 19, 98, 'yellow', NULL, NULL, NULL, NULL),
(108, 19, 99, 'Elegant', NULL, NULL, NULL, NULL),
(109, 19, 100, '925 Silver', NULL, NULL, NULL, NULL),
(110, 19, 101, 'Celebrate The Festival', NULL, NULL, NULL, NULL),
(111, 19, 102, 'Synthetic Gems', NULL, NULL, NULL, NULL),
(112, 19, 103, '925 Silver Plated', NULL, NULL, NULL, NULL),
(113, 19, 104, 'Valentine\'s Day', NULL, NULL, NULL, NULL),
(114, 20, 97, 'Women\'s Jewelry', NULL, NULL, NULL, NULL),
(115, 20, 98, 'white', NULL, NULL, NULL, NULL),
(116, 20, 99, 'Vintage', NULL, NULL, NULL, NULL),
(117, 20, 100, 'Acrylic', NULL, NULL, NULL, NULL),
(118, 20, 101, 'Celebrate The Festival', NULL, NULL, NULL, NULL),
(119, 20, 102, 'Zircon', NULL, NULL, NULL, NULL),
(120, 20, 103, 'Antique Silver Plated', NULL, NULL, NULL, NULL),
(121, 20, 104, 'Valentine\'s Day', NULL, NULL, NULL, NULL),
(122, 21, 97, 'Women\'s Jewelry', NULL, NULL, NULL, NULL),
(123, 21, 98, 'white', NULL, NULL, NULL, NULL),
(124, 21, 99, 'Vintage', NULL, NULL, NULL, NULL),
(125, 21, 100, '925 Silver', NULL, NULL, NULL, NULL),
(126, 21, 101, 'Celebrate The Festival', NULL, NULL, NULL, NULL),
(127, 21, 102, 'moissanite', NULL, NULL, NULL, NULL),
(128, 21, 103, 'Platinum Plated', NULL, NULL, NULL, NULL),
(129, 21, 104, 'Valentine\'s Day', NULL, NULL, NULL, NULL),
(130, 22, 97, 'Women\'s Jewelry', NULL, NULL, NULL, NULL),
(131, 22, 98, 'red', NULL, NULL, NULL, NULL),
(132, 22, 99, 'Plastic', NULL, NULL, NULL, NULL),
(133, 22, 100, '925 Silver', NULL, NULL, NULL, NULL),
(134, 22, 101, 'Celebrate The Festival', NULL, NULL, NULL, NULL),
(135, 22, 102, 'Synthetic Gems', NULL, NULL, NULL, NULL),
(136, 22, 103, 'Antique Silver Plated', NULL, NULL, NULL, NULL),
(137, 22, 104, 'Valentine\'s Day', NULL, NULL, NULL, NULL),
(138, 23, 97, 'Women\'s Jewelry', NULL, NULL, NULL, NULL),
(139, 23, 98, 'yellow', NULL, NULL, NULL, NULL),
(140, 23, 99, 'Elegant', NULL, NULL, NULL, NULL),
(141, 23, 100, '925 Silver', NULL, NULL, NULL, NULL),
(142, 23, 101, 'Wedding Occasion', NULL, NULL, NULL, NULL),
(143, 23, 102, 'moissanite', NULL, NULL, NULL, NULL),
(144, 23, 103, '925 Silver Plated', NULL, NULL, NULL, NULL),
(145, 23, 104, 'Spring Festival', NULL, NULL, NULL, NULL),
(146, 24, 97, 'Women\'s Jewelry', NULL, NULL, NULL, NULL),
(147, 24, 98, 'white', NULL, NULL, NULL, NULL),
(148, 24, 99, 'Elegant', NULL, NULL, NULL, NULL),
(149, 24, 100, 'Polyester', NULL, NULL, NULL, NULL),
(150, 24, 101, 'Party Occasion', NULL, NULL, NULL, NULL),
(151, 24, 102, 'Weekend Casual', NULL, NULL, NULL, NULL),
(152, 24, 103, 'Imitation Pearl', NULL, NULL, NULL, NULL),
(153, 24, 104, 'Silver Plated', NULL, NULL, NULL, NULL),
(154, 25, 97, 'Women\'s Jewelry', NULL, NULL, NULL, NULL),
(155, 25, 98, 'white', NULL, NULL, NULL, NULL),
(156, 25, 99, 'Elegant', NULL, NULL, NULL, NULL),
(157, 25, 100, 'Polyester', NULL, NULL, NULL, NULL),
(158, 25, 101, 'Gift-giving Occasion', NULL, NULL, NULL, NULL),
(159, 25, 102, 'moissanite', NULL, NULL, NULL, NULL),
(160, 25, 103, 'Platinum Plated', NULL, NULL, NULL, NULL),
(161, 25, 104, 'Spring Festival', NULL, NULL, NULL, NULL),
(162, 26, 114, 'Women\'s Pumps', NULL, NULL, NULL, NULL),
(163, 26, 115, NULL, 30, NULL, NULL, NULL),
(164, 26, 116, 'pink', NULL, NULL, NULL, NULL),
(165, 26, 117, 'Flowers', NULL, NULL, NULL, NULL),
(166, 26, 118, 'Denim', NULL, NULL, NULL, NULL),
(167, 27, 114, 'Women\'s Pumps', NULL, NULL, NULL, NULL),
(168, 27, 115, NULL, 31, NULL, NULL, NULL),
(169, 27, 116, 'white', NULL, NULL, NULL, NULL),
(170, 27, 117, 'Plaid', NULL, NULL, NULL, NULL),
(171, 27, 118, 'Bovine Leather', NULL, NULL, NULL, NULL);

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
(15, 'Luxury Shiny Rhinestone Tennis Bracelet Stretch Hand Jewelry For Women Men Daily Wear', 'Plating: Silver Plated Mosaic Material: Rhinestones', 10.00, 10, '6669ecf1b50a1_4305114ee122b84578f93dd0bcd99f94.jpg', 9, '2024-06-12 18:46:09', '2024-06-12 20:03:49', 0),
(16, ' Mini Alloy Car ', '.', 150.00, 1, '666a09b6f2cff_toyVericles.jpg', 10, '2024-06-12 20:48:54', '2024-06-12 20:53:37', 0),
(17, 'Car Steering Toys Steering Wheel Toy Car Mainan Baby Steering Toys Kids Baby ', 'Toys Steering Wheel Kids', 50.00, 5, '666a0c6958ced_1687249779889-ccbcf50a2eca4201b0b9d5577a639439-goods.jpeg', 10, '2024-06-12 21:00:25', '2024-06-12 21:00:25', 0),
(18, 'Delicate Rhinestone Alloy Butterfly Necklace Elegant Neck Jewelry Ornament ', 'Accessories Gift', 20.00, 50, '666a0d1a17942_6ebf1d42263f982a631cb34e1527cbe9.jpg', 9, '2024-06-12 21:03:22', '2024-06-12 21:03:22', 0),
(19, '7pcs/Set Fashion Trend Simple Art Design Ring Retro Palace Light', 'Luxury Snake Geometric Rhinestone Green Alloy Personality Cool Style Ring Cover For Female', 100.00, 5, '666a0d80c30fd_eb158e6ae9de3d3cc6339f29acc59247.jpg', 9, '2024-06-12 21:05:04', '2024-06-12 21:05:04', 0),
(20, 'Shiny Butterfly Thin Tennis Bracelet Elegant Hand', 'Chain Jewelry Decoration For Women', 30.00, 2, '666a0f84e6906_4eeed5d6b04a0b072863cae616c5f7bb.jpg', 9, '2024-06-12 21:13:40', '2024-06-12 21:13:40', 0),
(21, 'Elegant 4-Piece Jewelry Set, Rhinestone Studded Necklace, Ring and Earrings', ' Simplistic Design, Ideal for Daily Wear, Vacation Style, Minimalist Fashion', 24.00, 1, '666a0fdec37d7_e561324f-fb41-4d5b-a608-a3b271e5008c.jpg', 9, '2024-06-12 21:15:10', '2024-06-12 21:15:10', 0),
(22, 'Creative Design Red Love Heart Inlaid Zircon Ring', 'For Women Daily Casual Jewelry Wedding Engagement Accessories Anniversary Gift', 80.00, 5, '666a101150c45_001dc6aa19f9aa3f232323c79c16bd60.jpg', 9, '2024-06-12 21:16:01', '2024-06-12 21:16:01', 0),
(23, 'Golden 26 Letters Rings For Women Zircon Rhinestone Studded', 'Open Adjustable Rings Jewelry Accessory Gifts', 50.00, 3, '666a106e0eb8c_9081bf49-8f5a-4da4-9a68-0c43683e196d_1340x1340.jpeg', 9, '2024-06-12 21:17:34', '2024-06-12 21:17:34', 0),
(24, 'Love Heart Open Ring 2pcs', 'Set Personality Design Ring Temperament Jewelry', 13.00, 10, '666a10d6f415d_9aa530e0cbbb1314f04122e245e567c6.jpg', 9, '2024-06-12 21:19:19', '2024-06-12 21:19:19', 0),
(25, '2 Pcs Of Sun And Moon Charm Bracelets Set Alloy Jewelry Simple', 'Creative Design Ladies Friendship Blessing Card Adjustable Jewelry Accessory', 11.00, 5, '666a110f4c168_339f3a88-046b-4eeb-8ae9-988cd29507d4.jpg', 9, '2024-06-12 21:20:15', '2024-06-12 21:20:15', 0),
(26, 'Summer Linen Sole Slides', 'Casual Open Toe Slip On Shoes, Comfortable Indoor Home Slides', 45.00, 10, '666a12a349aae_b6dc4734-5cd6-4c81-b17c-9ba4daf1d15a.jpg', 11, '2024-06-12 21:26:59', '2024-06-12 21:26:59', 0),
(27, 'Simple Summer Slippers', ' Casual Open Toe Slip On Shoes, Comfortable Indoor Home Slippers', 100.00, 1, '666a12f730e23_43a12bce-e57c-4efe-af28-b6c1712c7566.jpg', 11, '2024-06-12 21:28:23', '2024-06-12 21:28:23', 0);

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
(9, 9),
(10, 10),
(10, 14),
(11, 3),
(11, 4),
(11, 9);

-- --------------------------------------------------------

--
-- Structure de la table `producttypes`
--

CREATE TABLE `producttypes` (
  `ProductTypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL,
  `IsDeleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `producttypes`
--

INSERT INTO `producttypes` (`ProductTypeID`, `TypeName`, `IsDeleted`) VALUES
(9, 'jewelry stand', 0),
(10, 'necklace organizer', 0),
(11, 'Women Shoes', 0);

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
  `UserImage` text NOT NULL DEFAULT 'profile.jpg',
  `archived` tinyint(1) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `PasswordHash`, `Email`, `FirstName`, `LastName`, `Address`, `City`, `ZipCode`, `PhoneNumber`, `is_admin`, `UserImage`, `archived`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Love', '$2y$10$dMfLhWChDyMDfxjpHk.acuReiZv68ZSvu5al.GiJAJpShwVFQfUeW', 'badr@mail.com', 'Oussama', 'LEKHAL', 'fill addres here ', 'sale', '1233', '+212 234 3242', 1, '665c98b188c60.png', 0, '2024-05-18 12:03:36', '2024-06-03 11:46:15'),
(2, 'CleverTimes', '$2y$10$dMfLhWChDyMDfxjpHk.acuReiZv68ZSvu5al.GiJAJpShwVFQfUeW', 'oussa@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'profile.jpg', 1, '2024-05-18 20:06:01', '2024-06-10 20:04:25'),
(4, 'CleverTimes_hh', '$2y$10$m8lCSTkv2KnGHN6degq4qOIQVkztTAmT2Np9STKWwUv578Aqqzere', 'yacin@mail.com', 'Yacin', 'bchkl', '', 'q<sdfh', '', '', 0, 'profile.jpg', 0, '2024-05-18 20:35:15', '2024-06-06 17:10:50'),
(5, 'BqdTimes_hh', '$2y$10$68wE3mMUTvmY/oCFywD7a.pdQoY0J.Y.iKs2t.IKl0Y0mkHpH3mwu', 'mail@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'profile.jpg', 0, '2024-06-11 14:03:38', '2024-06-11 14:03:38');

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
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);

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
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productattributes`
--
ALTER TABLE `productattributes`
  MODIFY `AttributeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT pour la table `productattributevalues`
--
ALTER TABLE `productattributevalues`
  MODIFY `AttributeValueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `producttypes`
--
ALTER TABLE `producttypes`
  MODIFY `ProductTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `wishlistitems`
--
ALTER TABLE `wishlistitems`
  MODIFY `WishlistItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- Contraintes pour la table `productattributevalues`
--
ALTER TABLE `productattributevalues`
  ADD CONSTRAINT `productattributevalues_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `productattributevalues_ibfk_2` FOREIGN KEY (`AttributeID`) REFERENCES `productattributes` (`AttributeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
