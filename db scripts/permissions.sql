-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2022 at 08:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2022-09-26 10:58:09', '2022-09-26 10:58:09'),
(2, 'role-create', 'web', '2022-09-26 10:58:09', '2022-09-26 10:58:09'),
(3, 'role-edit', 'web', '2022-09-26 10:58:09', '2022-09-26 10:58:09'),
(4, 'role-delete', 'web', '2022-09-26 10:58:09', '2022-09-26 10:58:09'),
(6, 'create-user', 'web', '2022-09-27 10:06:44', NULL),
(7, 'edit-user', 'web', '2022-09-26 23:17:44', NULL),
(9, 'delete-user', 'web', '2022-09-27 10:06:44', NULL),
(11, 'list-users', 'web', '2022-09-27 11:19:47', NULL),
(13, 'list-company', 'web', '2022-09-27 12:53:44', '2022-09-27 12:53:44'),
(15, 'create-company', 'web', '2022-09-27 12:53:44', '2022-09-27 12:53:44'),
(17, 'edit-company', 'web', '2022-09-27 12:52:44', '2022-09-27 12:53:44'),
(19, 'delete-company', 'web', '2022-09-27 11:19:47', '2022-09-27 12:53:44'),
(21, 'activate-user', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(23, 'create-company-users', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(25, 'edit-company-users', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(27, 'view-company-users', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(29, 'add-company-approvers', 'web', NULL, NULL),
(32, 'edit-company-approvers', 'web', '2022-09-27 12:53:44', '2022-09-27 12:53:44'),
(33, 'assign-driver-trip', 'web', '2022-10-03 10:24:03', '2022-09-03 08:39:25'),
(36, 'view-vehicles', 'web', '2022-09-27 10:06:44', '2022-09-27 10:06:44'),
(38, 'assign-vehicle', 'web', '2022-09-27 10:06:44', '2022-09-27 10:06:44'),
(39, 'activate-vehicle-availability\r\n', 'web', '2022-10-03 10:24:03', '2022-10-03 10:24:03'),
(44, 'deactivate-vehicle-availability', 'web', '2022-09-27 10:06:44', '2022-09-27 10:06:44'),
(45, 'add-user', 'web', '2022-10-03 10:24:03', '2022-10-03 10:24:03'),
(51, 'activate user', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(53, 'disable-user', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(54, 'set-trip-approvers', 'web', '2022-10-03 10:24:03', '2022-10-03 10:24:03'),
(57, 'view-trip-costs', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(58, 'view-trips', 'web', '2022-10-03 10:24:03', '2022-10-03 10:24:03'),
(61, 'approve-trip', 'web', '2022-09-27 12:53:44', '2022-09-27 12:53:44'),
(62, 'reject-trip\r\n', 'web', '2022-10-03 10:24:03', '2022-10-03 10:24:03'),
(69, 'edit-company-profile\r\n', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(72, 'approve-trip\r\n', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(74, 'view-company-trips', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(76, 'view-trips\r\n', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(78, 'register', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(80, 'book-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(82, 'cancel-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 10:06:44'),
(84, 'Pause-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(87, 'check-in', 'web', '2022-09-27 10:06:44', '2022-09-27 10:06:44'),
(89, 'book-vehicle', 'web', '2022-09-27 12:53:44', '2022-09-27 12:53:44'),
(91, 'reject-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(93, 'start-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(96, 'resume-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(98, 'end-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(100, 'accept-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(103, 'assigns-trip', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(106, 'edit-trip-status', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(108, 'Issue-invoice', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(110, 'view-invoices', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(112, 'edit-own-profile', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44'),
(114, 'edit-own-password', 'web', '2022-09-27 10:06:44', '2022-09-27 12:53:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
