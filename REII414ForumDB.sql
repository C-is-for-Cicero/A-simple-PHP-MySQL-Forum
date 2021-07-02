-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 03:20 PM
-- Server version: 10.5.9-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reii414forumdb`
--
CREATE DATABASE IF NOT EXISTS `reii414forumdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reii414forumdb`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(8) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'Animals', 'This is a category dedicated to animals'),
(2, 'Plants', 'This is a category dedicated to plants.'),
(3, 'Test', 'Test category');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `votes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `title`, `votes`) VALUES
(1, 1, 'Yes', 7),
(2, 1, 'No', 1),
(3, 2, 'Yes', 2),
(4, 2, 'No', 3),
(5, 2, 'Consult vet', 4),
(6, 3, '1', 22),
(7, 3, '2', 2),
(8, 3, '3', 0),
(9, 3, '4', 0),
(10, 3, '5', 0),
(11, 5, 'yes', 1),
(12, 5, 'no', 2),
(13, 6, '1', 0),
(14, 6, '2', 0),
(15, 6, '3', 0),
(16, 6, '4', 0),
(17, 6, '5', 0),
(18, 6, '6', 0),
(19, 6, '7', 1),
(20, 8, '1', 0),
(21, 8, '2', 0),
(22, 8, '3', 0),
(23, 8, '', 0),
(24, 9, '1', 0),
(25, 9, '2', 0),
(26, 9, '3', 0),
(27, 9, '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(8) NOT NULL,
  `post_content` text DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_topic` int(8) DEFAULT NULL,
  `post_by` int(8) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `poll_title` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`, `file_name`, `poll_title`) VALUES
(1, 'Here we will discuss our dogs.', '2021-07-02 12:11:38', 1, 1, NULL, NULL),
(2, 'This is my dog. He is an English bulldog.', '2021-07-02 12:13:26', 1, 3, '6e597367fe9843c36f800e6dfec0a9d4c9bebaba4989154df0d81e66ee7bf172', 'Is he cute?'),
(3, 'This is my dog. He is a Shiba Inu.', '2021-07-02 12:14:48', 1, 3, 'c00e1cc99606b4c16529c865e0f03e0635739340cee0591e80d09a41fe61e0a7', 'Should I shave him in summer?'),
(4, 'Cutes dogos. This is my dog', '2021-07-02 12:16:39', 1, 2, '290caa808cb3af17bf58619beb18ff84d48e8ca73e6a3ed7ac92a6e4d3cf5787', 'Rank his beauty (1-5)'),
(5, 'This is a discussion abouts cats', '2021-07-02 13:47:40', 2, 4, NULL, NULL),
(6, 'I like cats', '2021-07-02 13:48:50', 2, 4, '290caa808cb3af17bf58619beb18ff84d48e8ca73e6a3ed7ac92a6e4d3cf5787', 'Do you like cats'),
(7, 'I dont', '2021-07-02 13:51:28', 2, 1, 'c00e1cc99606b4c16529c865e0f03e0635739340cee0591e80d09a41fe61e0a7', 'Do you'),
(8, 'Test topic', '2021-07-02 14:03:23', 3, 1, NULL, NULL),
(9, 'Test', '2021-07-02 14:04:14', 3, 1, '28365a136f668fd7584bcb247914c14a745e7279c06710a98e62822bffff7507', 'Poll'),
(10, 'test2', '2021-07-02 14:04:58', 3, 1, 'f69ece1677beb53326fe6d1cdb088b63e515ed2dec1b790df7fc3734d81c1cb0', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(8) NOT NULL,
  `topic_subject` varchar(255) DEFAULT NULL,
  `topic_date` datetime DEFAULT NULL,
  `topic_cat` int(8) DEFAULT NULL,
  `topic_by` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(1, 'Dogs', '2021-07-02 12:11:38', 1, 1),
(2, 'Cats', '2021-07-02 13:47:39', 1, 4),
(3, 'Test Topic', '2021-07-02 14:03:22', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_date` datetime DEFAULT NULL,
  `user_level` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`) VALUES
(1, 'dave', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'dave@gmail.com', '2021-07-02 12:06:47', 1),
(2, 'ben', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ben@gmail.com', '2021-07-02 12:08:42', 0),
(3, 'adam', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'adam@gmail.com', '2021-07-02 12:08:56', 0),
(4, 'testuser', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'test@email.com', '2021-07-02 13:46:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name_unique` (`cat_name`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_unique` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
