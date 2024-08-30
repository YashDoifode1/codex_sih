-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 08:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'human', 'skidde7@gmail.com', 'batman', '2024-08-12 11:57:53'),
(2, 'god', 'admin@gmail.com', 'superman', '2024-08-12 11:57:53'),
(3, 'demigod', 'demo@gmail.com', 'dark', '2024-08-12 12:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applied`
--

INSERT INTO `applied` (`id`, `user_id`, `username`, `cv`, `email`, `job_id`, `applied_at`) VALUES
(1, 2, 'user2', 'resumes/Resume.docx', 'user1@gmail.com', 1, '2024-08-03 02:56:25'),
(2, 2, 'user2', 'resumes/Resume.docx', 'user1@gmail.com', 2, '2024-08-03 02:56:47'),
(4, 3, 'user2', 'resumes/Resume.docx', 'user2@gmail.com', 4, '2024-08-04 06:32:09'),
(6, 4, 'yashdoifode', 'resumes/Resume.docx', 'skidde7@gmail.com', 1, '2024-08-06 14:56:10'),
(7, 4, 'yashdoifode', 'resumes/Resume.docx', 'skidde7@gmail.com', 3, '2024-08-06 15:17:27'),
(8, 4, 'yashdoifode', 'resumes/Resume.docx', 'skidde7@gmail.com', 1, '2024-08-06 15:33:38'),
(13, 0, 'user1', 'resumes/Resume.docx', 'user1@gmail.com', 1, '2024-08-30 17:47:05'),
(14, 0, 'user1', 'resumes/Resume.docx', 'user1@gmail.com', 5, '2024-08-30 17:47:50'),
(15, 0, 'user1', 'resumes/Resume.docx', 'user1@gmail.com', 5, '2024-08-30 17:48:14'),
(16, 1, 'user1', 'resumes/Resume.docx', 'user1@gmail.com', 5, '2024-08-30 17:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'technology', NULL, '2024-08-14 07:52:01'),
(3, 'cs', NULL, '2024-08-14 07:52:23'),
(4, 'it', NULL, '2024-08-14 07:52:23'),
(5, 'web design', NULL, '2024-08-14 07:53:15'),
(6, 'software', NULL, '2024-08-14 07:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(6) UNSIGNED NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `state` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `job_time` varchar(255) NOT NULL,
  `vacancy` int(11) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `responsibility` text NOT NULL,
  `education_required` varchar(255) NOT NULL,
  `username` varchar(250) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `company_image` varchar(255) DEFAULT NULL,
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `location` varchar(255) NOT NULL,
  `company_tagline` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `company_fb` varchar(255) DEFAULT NULL,
  `company_tw` varchar(255) DEFAULT NULL,
  `company_linkedin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `description`, `state`, `region`, `job_time`, `vacancy`, `salary`, `experience`, `responsibility`, `education_required`, `username`, `company_name`, `company_email`, `company_id`, `company_image`, `posted_at`, `location`, `company_tagline`, `company_website`, `company_fb`, `company_tw`, `company_linkedin`) VALUES
(1, 'Ethical Hacker', 'Pentester', 'Maharashtra', 'Mumbai', 'Morning', 5, '10k', 'Fresher', 'Cybersecurity', '12th pass', 'user1', 'IBM', 'company@gmail.com', '2', 'Google.png', '2024-07-27 06:54:15', '', NULL, NULL, NULL, NULL, NULL),
(5, 'Web developer', '', '', 'Mumbai', 'Morning', 0, '10k', 'Fresher', 'No-Experience', '12th pass', '', 'user1', 'user1@gmail.com', '', 'Google.png', '2024-08-30 17:09:27', 'Nagpur', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `skills` text NOT NULL,
  `qualification` text NOT NULL,
  `education` text NOT NULL,
  `objective` text NOT NULL,
  `declaration` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`id`, `name`, `dob`, `email`, `address`, `skills`, `qualification`, `education`, `objective`, `declaration`, `created_at`) VALUES
(1, '', '0000-00-00', '', '', '', '', '', '', '', '2024-08-22 16:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `saved_job`
--

CREATE TABLE `saved_job` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saved_job`
--

INSERT INTO `saved_job` (`id`, `user_id`, `job_id`, `saved_at`) VALUES
(5, 3, 1, '2024-08-02 08:26:55'),
(6, 3, 1, '2024-08-02 08:31:16'),
(7, 3, 1, '2024-08-02 09:56:06'),
(8, 3, 1, '2024-08-02 10:04:54'),
(9, 3, 1, '2024-08-02 10:08:32'),
(10, 3, 3, '2024-08-02 10:15:53'),
(11, 3, 3, '2024-08-02 10:15:53'),
(12, 3, 3, '2024-08-02 10:17:54'),
(13, 3, 1, '2024-08-03 02:02:23'),
(14, 3, 4, '2024-08-04 06:32:06'),
(20, 1, 5, '2024-08-30 17:51:40'),
(21, 1, 5, '2024-08-30 18:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `cv` varchar(50) DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Bio` varchar(250) DEFAULT NULL,
  `Instagram` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `linkedin` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `image`, `usertype`, `password`, `cv`, `Title`, `Bio`, `Instagram`, `facebook`, `linkedin`, `created_at`) VALUES
(1, 'user1', 'user1@gmail.com', '', 'Organisation', 'pass', 'resumes/Resume.docx', 'EThical hacker', ' CEH', 'http://localhost/5/login/profile.php', 'http://localhost/5/login/profile.php', 'http://localhost/5/login/profile.php', '2024-07-26 04:26:59'),
(3, 'user2', 'user2@gmail.com', NULL, 'worker', '1122', 'resumes/Resume.docx', 'Intelligence Officer', 'OSINT', 'http://localhost/5/login/bio.php', 'http://localhost/5/login/bio.php', 'http://localhost/5/login/bio.php', '2024-07-26 09:53:00'),
(5, 'Yash', 'skidde7@gmail.com', 'p.png', 'Student', '1234', NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-29 12:15:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_job`
--
ALTER TABLE `saved_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applied`
--
ALTER TABLE `applied`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resume`
--
ALTER TABLE `resume`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saved_job`
--
ALTER TABLE `saved_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
