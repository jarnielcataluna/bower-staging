-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2016 at 12:10 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nestlebower`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `contact_number` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `best_from` varchar(100) NOT NULL,
  `best_to` varchar(100) NOT NULL,
  `area_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `frequency` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `channel` varchar(255) NOT NULL,
  `bracket_number` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `contact_person`, `contact_number`, `address`, `latitude`, `longitude`, `best_from`, `best_to`, `area_id`, `city_id`, `frequency`, `category_id`, `channel`, `bracket_number`, `status`) VALUES
(1, 'Walk In', 'Walk In Account', '09171234567', 'N/A', NULL, NULL, '6:00 AM', '6:00 PM', 1, 1, 'F12', 1, '', 3, 1),
(2, 'Joy', 'Joy', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '6:00 AM', '7:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(3, 'Michael', 'Michael', '09171234567', '123 Test St, Test Brgy, Test City', '14.6561305556', '121.0295416667', '7:00 AM', '8:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(4, 'Bining', 'Bining', '09171234567', '123 Test St, Test Brgy, Test City', '14.563668', '121.021653', '7:00 AM', '8:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(5, 'Cathy', 'Cathy', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '8:00 AM', '9:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(6, 'Baby', 'Baby', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '8:00 AM', '9:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(7, 'Chona', 'Chona', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '9:00 AM', '10:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(8, 'Josie', 'Josie', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '9:00 AM', '10:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(9, 'Tessie', 'Tessie', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '10:00 AM', '11:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(10, 'JS Kapihan', 'Julie', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '10:00 AM', '11:00 AM', 1, 1, 'F12', 1, '', 1, 1),
(11, 'Doods', 'Doods', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '11:00 AM', '12:00 PM', 1, 1, 'F12', 1, '', 1, 1),
(12, 'Virgie', 'Virgie', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '11:00 AM', '12:00 PM', 1, 1, 'F12', 1, '', 1, 1),
(13, 'Marevic', 'Marevic', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '2:00 PM', '3:00 PM', 1, 1, 'F12', 1, '', 1, 1),
(14, 'Alma', 'Alma', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '7:00 AM', '8:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(15, 'RMN', 'Test', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '7:00 AM', '8:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(16, 'Jellies', 'Jellies', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '8:00 AM', '9:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(17, 'Sally', 'Sally', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '8:00 AM', '9:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(18, 'Angels', 'Angel', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '9:00 AM', '10:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(19, 'Fe', 'Fe', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '9:00 AM', '10:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(20, 'Prince & Princess', 'Princess', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '10:00 AM', '11:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(21, 'Arturo', 'Arturo', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '10:00 AM', '11:00 AM', 1, 1, 'F12', 2, '', 1, 1),
(22, 'Cynthia', 'Cynthia', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '11:00 AM', '12:00 PM', 1, 1, 'F12', 2, '', 1, 1),
(23, 'Jun & Juvy''s', 'Jun', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '11:00 AM', '12:00 PM', 0, 1, 'F12', 2, '', 1, 1),
(24, 'Berras', 'Berras', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '10:00 AM', '11:00 AM', 2, 1, 'F12', 1, '', 2, 1),
(25, 'Triple F', 'Jean', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '11:00 AM', '12:00 PM', 2, 1, 'F12', 1, '', 2, 1),
(26, 'Nita Eatery', 'Nita', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '11:00 AM', '12:00 PM', 2, 1, 'F12', 1, '', 2, 1),
(27, 'Alvin Eatery', 'Alvin', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '2:00 PM', '3:00 PM', 2, 1, 'F12', 1, '', 2, 1),
(28, 'Joan Eatery', 'Joan', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '7:00 AM', '8:00 AM', 2, 1, 'F12', 1, '', 2, 1),
(29, 'Elijah Eatery', 'Elijah', '09171234567', '123 Test St, Test Brgy, Test City', '14.571981', '121.101422', '2:00 PM', '3:00 PM', 2, 1, 'F12', 1, '', 2, 1),
(37, 'Dexter’s Carinderia', 'Dexter Loor', '9173176758', '456 Street, Brgy. Test', '14.571981', '121.101422', '9:00AM', '11:00AM', 1, 1, 'F12', 1, '', 1, 1),
(38, 'AJ’s Store', 'AJ', '9173176758', '789 Street, Brgy. Qwerty', '14.5382603', '121.0162967', '12:00 PM', '2:00 PM', 7, 6, 'F12', 2, '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(100) NOT NULL,
  `area` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`, `city_id`, `status`) VALUES
(1, 'Floodway Westbank', 1, 1),
(2, 'Cainta Market', 1, 1),
(7, 'Magallanes', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bower`
--

CREATE TABLE `bower` (
  `id` int(100) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `bdate` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `area_id` int(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bower`
--

INSERT INTO `bower` (`id`, `fname`, `lname`, `contact_number`, `bdate`, `username`, `password`, `area_id`, `status`) VALUES
(1, 'Enrico', 'Villegas', '09267056650', '1975-03-01', 'bowerenrico', 'bowerenrico', 1, 1),
(2, 'Pedro', 'Dimaculangan', '09171234567', '1985-08-21', 'bowerpedro', 'bowerpedro', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bower_account`
--

CREATE TABLE `bower_account` (
  `id` int(11) NOT NULL,
  `bower_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bower_account`
--

INSERT INTO `bower_account` (`id`, `bower_id`, `account_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 0),
(9, 1, 9, 0),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 1, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 1),
(17, 1, 17, 1),
(18, 1, 18, 1),
(19, 1, 19, 1),
(20, 1, 20, 1),
(21, 1, 21, 1),
(22, 1, 22, 1),
(23, 1, 23, 1),
(24, 1, 24, 1),
(25, 1, 25, 1),
(26, 1, 26, 1),
(27, 1, 27, 1),
(28, 1, 28, 1),
(29, 1, 29, 1),
(30, 2, 30, 1),
(31, 1, 31, 1),
(32, 2, 32, 1),
(33, 1, 33, 1),
(34, 2, 34, 1),
(35, 1, 35, 1),
(36, 2, 36, 1),
(37, 1, 37, 1),
(38, 2, 38, 1),
(39, 1, 8, 0),
(40, 1, 8, 0),
(41, 1, 8, 1),
(42, 1, 9, 0),
(43, 1, 9, 0),
(44, 1, 9, 0),
(45, 1, 9, 0),
(46, 1, 9, 0),
(47, 1, 9, 0),
(48, 2, 9, 1),
(49, 1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(100) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `status`) VALUES
(1, 'Milo', 1),
(2, 'Nescafe', 1),
(3, 'Maggi', 1),
(4, 'Bear Brand', 1),
(5, 'Chuckie', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand_product`
--

CREATE TABLE `brand_product` (
  `id` int(100) NOT NULL,
  `brand_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_product`
--

INSERT INTO `brand_product` (`id`, `brand_id`, `product_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 3, 7),
(8, 3, 8),
(9, 4, 9),
(10, 5, 10),
(11, 1, 11),
(12, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `status`) VALUES
(1, 'Carinderia', 1),
(2, 'Combi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province_id` int(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city`, `province_id`, `status`) VALUES
(1, 'Cainta', 1, 1),
(6, 'Makati', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `id` int(11) NOT NULL,
  `day` varchar(45) NOT NULL,
  `bracket_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`id`, `day`, `bracket_number`) VALUES
(1, 'Monday', 1),
(2, 'Tuesday', 2),
(3, 'Wednesday', 1),
(4, 'Thursday', 2),
(5, 'Friday', 1),
(6, 'Saturday', 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `receipt_id` varchar(255) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `account_id` int(11) NOT NULL,
  `sold_to` varchar(255) NOT NULL,
  `bower_id` int(11) NOT NULL,
  `sales` float NOT NULL,
  `skus` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `receipt_id`, `invoice_date`, `account_id`, `sold_to`, `bower_id`, `sales`, `skus`, `status`) VALUES
(1, '1-20160113174918', '2016-01-13 17:49:18', 5, 'Cathy', 1, 21, 1, 1),
(2, '1-20160113174920', '2016-01-13 17:49:20', 3, 'Michael', 1, 24, 1, 1),
(3, '1-20160113174922', '2016-01-13 17:49:22', 6, 'Baby', 1, 9, 1, 1),
(4, '1-20160113185339', '2016-01-13 18:53:39', 21, 'Arturo', 1, 26.9711, 1, 1),
(5, '1-20160114113632', '2016-01-14 11:36:32', 24, 'Berras', 1, 2.55769, 1, 1),
(6, '1-20160114113757', '2016-01-14 11:37:57', 26, 'Nita', 1, 2.55769, 1, 1),
(7, '1-20160114120606', '2016-01-14 12:06:06', 24, 'Berras', 1, 2.55769, 1, 1),
(8, '1-20160114115525', '2016-01-14 11:55:25', 1, 'alex', 1, 2.55769, 1, 1),
(9, '1-20160114115225', '2016-01-14 11:52:25', 2, 'Joy', 1, 15.3461, 2, 1),
(10, '1-20160114174150', '2016-01-14 17:41:50', 24, 'Berras', 1, 16.1827, 1, 1),
(11, '1-20160114175511', '2016-01-14 17:55:11', 4, 'Bining', 1, 85.4135, 11, 1),
(12, '1-20160114175228', '2016-01-14 17:52:28', 25, 'Jean', 1, 85.4135, 11, 1),
(13, '1-20160114174619', '2016-01-14 17:46:19', 24, 'Berras', 1, 87.9712, 11, 1),
(14, '1-20160114175511', '2016-01-14 17:55:11', 4, 'Bining', 1, 85.4135, 11, 1),
(15, '1-20160114175228', '2016-01-14 17:52:28', 25, 'Jean', 1, 85.4135, 11, 1),
(16, '1-20160114174619', '2016-01-14 17:46:19', 24, 'Berras', 1, 87.9712, 11, 1),
(17, '1-20160115151946', '2016-01-15 15:19:46', 1, 'alex', 1, 0, 0, 1),
(18, '1-20160115151613', '2016-01-15 15:16:13', 1, 'alex', 1, 20.7404, 3, 1),
(19, '1-20160115161520', '2016-01-15 16:15:20', 1, 'Juan', 1, 59.3365, 1, 1),
(20, '1-20160120222726', '2016-01-20 22:27:26', 1, 'Juan Dela Cruz', 1, 1041.39, 12, 1),
(21, '1-20160121122243', '2016-01-21 12:22:43', 24, 'Berras', 1, 56.6058, 3, 1),
(22, '1-20160121093509', '2016-01-21 09:35:09', 24, 'Berras', 1, 129.462, 2, 1),
(23, '1-20160121140835', '2016-01-21 14:08:35', 24, 'Berras', 1, 300.077, 6, 1),
(24, '1-20160122145809', '2016-01-22 14:58:09', 2, 'Joy', 1, 46.875, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total_sales` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `invoice_id`, `product_id`, `unit_price`, `qty`, `total_sales`) VALUES
(1, 1, 1, 7, 3, 21),
(2, 2, 1, 6, 4, 24),
(3, 3, 1, 9, 1, 9),
(4, 4, 1, 5.39423, 5, 26.9711),
(5, 5, 7, 2.55769, 1, 2.55769),
(6, 6, 7, 2.55769, 1, 2.55769),
(7, 7, 7, 2.55769, 1, 2.55769),
(8, 8, 7, 2.55769, 1, 2.55769),
(9, 9, 12, 0, 1, 0),
(10, 9, 7, 2.55769, 6, 15.3461),
(11, 10, 1, 5.39423, 3, 16.1827),
(12, 11, 12, 0, 1, 0),
(13, 11, 10, 17.75, 1, 17.75),
(14, 11, 9, 10.9135, 1, 10.9135),
(15, 11, 8, 8.625, 1, 8.625),
(16, 11, 6, 5.59615, 1, 5.59615),
(17, 11, 5, 5.59615, 1, 5.59615),
(18, 11, 4, 5.59615, 1, 5.59615),
(19, 11, 3, 5.59615, 1, 5.59615),
(20, 11, 2, 5, 1, 5),
(21, 11, 1, 5.39423, 1, 5.39423),
(22, 11, 7, 2.55769, 6, 15.3461),
(23, 12, 10, 17.75, 1, 17.75),
(24, 12, 9, 10.9135, 1, 10.9135),
(25, 12, 8, 8.625, 1, 8.625),
(26, 12, 12, 0, 1, 0),
(27, 12, 7, 2.55769, 6, 15.3461),
(28, 12, 6, 5.59615, 1, 5.59615),
(29, 12, 5, 5.59615, 1, 5.59615),
(30, 12, 4, 5.59615, 1, 5.59615),
(31, 12, 3, 5.59615, 1, 5.59615),
(32, 12, 2, 5, 1, 5),
(33, 12, 1, 5.39423, 1, 5.39423),
(34, 13, 10, 17.75, 1, 17.75),
(35, 13, 9, 10.9135, 1, 10.9135),
(36, 13, 8, 8.625, 1, 8.625),
(37, 13, 12, 0, 1, 0),
(38, 13, 7, 2.55769, 7, 17.9038),
(39, 13, 6, 5.59615, 1, 5.59615),
(40, 13, 5, 5.59615, 1, 5.59615),
(41, 13, 4, 5.59615, 1, 5.59615),
(42, 13, 3, 5.59615, 1, 5.59615),
(43, 13, 2, 5, 1, 5),
(44, 13, 1, 5.39423, 1, 5.39423),
(45, 14, 12, 0, 1, 0),
(46, 14, 10, 17.75, 1, 17.75),
(47, 14, 9, 10.9135, 1, 10.9135),
(48, 14, 8, 8.625, 1, 8.625),
(49, 14, 6, 5.59615, 1, 5.59615),
(50, 14, 5, 5.59615, 1, 5.59615),
(51, 14, 4, 5.59615, 1, 5.59615),
(52, 14, 3, 5.59615, 1, 5.59615),
(53, 14, 2, 5, 1, 5),
(54, 14, 1, 5.39423, 1, 5.39423),
(55, 14, 7, 2.55769, 6, 15.3461),
(56, 15, 10, 17.75, 1, 17.75),
(57, 15, 9, 10.9135, 1, 10.9135),
(58, 15, 8, 8.625, 1, 8.625),
(59, 15, 12, 0, 1, 0),
(60, 15, 7, 2.55769, 6, 15.3461),
(61, 15, 6, 5.59615, 1, 5.59615),
(62, 15, 5, 5.59615, 1, 5.59615),
(63, 15, 4, 5.59615, 1, 5.59615),
(64, 15, 3, 5.59615, 1, 5.59615),
(65, 15, 2, 5, 1, 5),
(66, 15, 1, 5.39423, 1, 5.39423),
(67, 16, 10, 17.75, 1, 17.75),
(68, 16, 9, 10.9135, 1, 10.9135),
(69, 16, 8, 8.625, 1, 8.625),
(70, 16, 12, 0, 1, 0),
(71, 16, 7, 2.55769, 7, 17.9038),
(72, 16, 6, 5.59615, 1, 5.59615),
(73, 16, 5, 5.59615, 1, 5.59615),
(74, 16, 4, 5.59615, 1, 5.59615),
(75, 16, 3, 5.59615, 1, 5.59615),
(76, 16, 2, 5, 1, 5),
(77, 16, 1, 5.39423, 1, 5.39423),
(78, 18, 12, 0, 1, 0),
(79, 18, 7, 2.55769, 6, 15.3461),
(80, 18, 1, 5.39423, 1, 5.39423),
(81, 19, 1, 5.39423, 11, 59.3365),
(82, 20, 10, 17.75, 15, 266.25),
(83, 20, 9, 10.9135, 20, 218.27),
(84, 20, 12, 0, 3, 0),
(85, 20, 7, 2.55769, 20, 51.1538),
(86, 20, 6, 5.59615, 7, 39.173),
(87, 20, 5, 5.59615, 6, 33.5769),
(88, 20, 4, 5.59615, 10, 55.9615),
(89, 20, 3, 5.59615, 7, 39.173),
(90, 20, 2, 5, 5, 25),
(91, 20, 8, 8.625, 5, 43.125),
(92, 20, 11, 0, 4, 0),
(93, 20, 1, 5.39423, 50, 269.711),
(94, 21, 9, 10.9135, 1, 10.9135),
(95, 21, 6, 5.59615, 2, 11.1923),
(96, 21, 8, 8.625, 4, 34.5),
(97, 22, 11, 0, 2, 0),
(98, 22, 1, 5.39423, 24, 129.462),
(99, 23, 9, 10.9135, 8, 87.308),
(100, 23, 6, 5.59615, 10, 55.9615),
(101, 23, 11, 0, 1, 0),
(102, 23, 12, 0, 6, 0),
(103, 23, 7, 2.55769, 36, 92.0768),
(104, 23, 1, 5.39423, 12, 64.7308),
(105, 24, 1, 5.39423, 3, 16.1827),
(106, 24, 12, 0, 2, 0),
(107, 24, 7, 2.55769, 12, 30.6923);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(100) NOT NULL,
  `product_category_id` int(100) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `background_color` varchar(255) NOT NULL,
  `font_color` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `base_price` float NOT NULL,
  `vat` float NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_category_id`, `sku`, `name`, `background_color`, `font_color`, `image`, `thumbnail`, `base_price`, `vat`, `date_added`, `status`, `type`) VALUES
(1, 1, '', 'MILO Activ-Go', '#005051', '#FFFFFF', 'milo-activ-go.png', '', 5.39423, 0, '2015-12-21 13:30:00', 1, 1),
(2, 1, '', 'NESCAFE 3in1 Original', '#2D2D2D', '#FFFFFF', 'nescafe-3-in-1-original.png', '', 5, 0, '2015-12-21 13:30:00', 1, 1),
(3, 1, '', 'NESCAFE 3in1 Chocolatte', '#30012C', '#FFFFFF', 'nescafe-chocolatte.png', '', 5.59615, 0, '2015-12-21 13:30:00', 1, 1),
(4, 1, '', 'NESCAFE 3in1 Creamylatte', '#441402', '#FFFFFF', 'nescafe-creamy-latte.png', '', 5.59615, 0, '2015-12-21 13:30:00', 1, 1),
(5, 1, '', 'NESCAFE 3in1 Brown N Creamy', '#543501', '#FFFFFF', 'nescafe-brown-and-creamy.png', '', 5.59615, 0, '2015-12-21 13:30:00', 1, 1),
(6, 1, '', 'NESCAFE 3in1 Creamy White', '#024570', '#FFFFFF', 'nescafe-creamy-white.png', '', 5.59615, 0, '2015-12-21 13:30:00', 1, 1),
(7, 2, '', 'MAGGI Magic Sarap', '#043165', '#FFFFFF', 'magic-sarap.png', '', 2.55769, 0, '2015-12-21 13:30:00', 1, 1),
(8, 2, '', 'MAGGI Magic Sinigang', '#e6510b', '#FFFFFF', 'magic-sinigang.png', '', 8.625, 0, '2015-12-21 13:30:00', 1, 1),
(9, 3, '', 'Bear Brand Swak Pack', '#005051', '#FFFFFF', 'bear-brand-captain-pack.png', '', 10.9135, 0, '2015-12-21 13:30:00', 1, 1),
(10, 3, '', 'Chuckie Tetra Pack 180mL', '#9E5C23', '#FFFFFF', 'chuckie-bumblebug.png', '', 17.75, 0, '2015-12-21 13:30:00', 1, 1),
(11, 1, '', 'MILO Activ-Go', '#005051', '#FFFFFF', 'milo-activ-go.png', '', 0, 0, '2016-01-06 16:29:01', 1, 2),
(12, 2, '', 'MAGGI Magic Sarap', '#043165', '#FFFFFF', 'magic-sarap.png', '', 0, 0, '2016-01-07 11:39:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(100) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_category`, `status`) VALUES
(1, 'Beverage', 1),
(2, 'Culinary', 1),
(3, 'Others', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `rule_id`, `name`, `description`, `status`) VALUES
(1, 1, '12+1 Milo Activ-Go', 'Buy 12 pieces of Milo Activ-Go get 1 Free', 1),
(2, 2, '6+1 Free MAGGI Magic Sarap', 'Buy 6 pieces MAGGI Magic Sarap get 1 Free', 1);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `province`, `region_id`, `status`) VALUES
(1, 'Rizal', 1, 1),
(6, 'Metro Manila', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region`, `status`) VALUES
(1, 'CALABARZON', 1),
(6, 'NCR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty_to_qualify` int(11) NOT NULL,
  `qty_free` int(11) NOT NULL,
  `promo_product_id` int(11) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `product_id`, `qty_to_qualify`, `qty_free`, `promo_product_id`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 12, 1, 11, '2016-01-06', '2016-01-25', 1),
(2, 7, 6, 1, 12, '2016-01-07', '2016-01-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `id` int(11) NOT NULL,
  `bower_id` int(11) NOT NULL,
  `total_sales` float NOT NULL,
  `total_skus` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_report`
--

INSERT INTO `sales_report` (`id`, `bower_id`, `total_sales`, `total_skus`, `date`, `status`) VALUES
(1, 1, 21, 1, '2016-01-13 17:49:32', 1),
(2, 1, 24, 1, '2016-01-13 17:49:41', 1),
(3, 1, 9, 1, '2016-01-13 17:49:43', 1),
(4, 1, 26.9711, 1, '2016-01-13 18:55:25', 1),
(5, 1, 2.55769, 1, '2016-01-14 11:37:34', 1),
(6, 1, 2.55769, 1, '2016-01-14 11:38:31', 1),
(7, 1, 20.4615, 4, '2016-01-14 12:08:22', 1),
(8, 1, 16.1827, 1, '2016-01-14 17:43:05', 1),
(9, 1, 258.798, 33, '2016-01-14 17:55:41', 1),
(10, 1, 258.798, 33, '2016-01-14 17:55:49', 1),
(11, 1, 20.7404, 3, '2016-01-15 15:50:24', 1),
(12, 1, 59.3365, 1, '2016-01-15 16:29:08', 1),
(13, 1, 1041.39, 12, '2016-01-20 22:27:39', 1),
(14, 1, 186.067, 5, '2016-01-21 12:24:08', 1),
(15, 1, 300.077, 6, '2016-01-21 14:09:24', 1),
(16, 1, 46.875, 3, '2016-01-22 14:58:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_report_invoice`
--

CREATE TABLE `sales_report_invoice` (
  `id` int(11) NOT NULL,
  `sales_report_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_report_invoice`
--

INSERT INTO `sales_report_invoice` (`id`, `sales_report_id`, `invoice_id`, `status`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 1),
(5, 5, 5, 1),
(6, 6, 6, 1),
(7, 7, 7, 1),
(8, 7, 8, 1),
(9, 7, 9, 1),
(10, 8, 10, 1),
(11, 9, 11, 1),
(12, 9, 12, 1),
(13, 9, 13, 1),
(14, 10, 14, 1),
(15, 10, 15, 1),
(16, 10, 16, 1),
(17, 11, 17, 1),
(18, 11, 18, 1),
(19, 12, 19, 1),
(20, 13, 20, 1),
(21, 14, 21, 1),
(22, 14, 22, 1),
(23, 15, 23, 1),
(24, 16, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `password`, `level`, `department`, `last_login`, `token`, `status`) VALUES
(1, 'Bower', 'Admin', 'admin', '123nestleBOW@@', 'ADMIN', 'Nestle', '', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `contact_person` (`contact_person`),
  ADD KEY `best_from` (`best_from`),
  ADD KEY `best_to` (`best_to`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area` (`area`);

--
-- Indexes for table `bower`
--
ALTER TABLE `bower`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fname` (`fname`),
  ADD KEY `lname` (`lname`),
  ADD KEY `username` (`username`),
  ADD KEY `password` (`password`);

--
-- Indexes for table `bower_account`
--
ALTER TABLE `bower_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `brand_product`
--
ALTER TABLE `brand_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city` (`city`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `day` (`day`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sku` (`sku`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`product_category`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province` (`province`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_report_invoice`
--
ALTER TABLE `sales_report_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bower`
--
ALTER TABLE `bower`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bower_account`
--
ALTER TABLE `bower_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `brand_product`
--
ALTER TABLE `brand_product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sales_report_invoice`
--
ALTER TABLE `sales_report_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
