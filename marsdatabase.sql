-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2019 at 04:46 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marsdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeId`, `userId`, `postId`) VALUES
(1, 4, 2),
(2, 2, 3),
(3, 5, 3),
(4, 6, 4),
(5, 6, 2),
(6, 2, 5),
(7, 2, 6),
(8, 7, 7),
(9, 1, 1),
(10, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `userId` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`userId`, `ownerId`, `message`) VALUES
(4, 1, 'hi noura '),
(4, 2, 'ahmed do you remember me '),
(2, 4, 'hi maya how are '),
(2, 0, 'yes i remember you'),
(2, 0, 'h'),
(2, 4, 'gggg'),
(5, 4, 'hi'),
(5, 4, 'how are you'),
(4, 5, 'hi '),
(6, 5, 'hi'),
(6, 5, 'are you fine'),
(2, 6, 'hi kenzy'),
(2, 6, 'how are you'),
(2, 1, 'hi'),
(2, 1, 'take the pen from mariam'),
(2, 6, 'hjgjygyu'),
(7, 1, 'hi'),
(1, 7, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postDescription` mediumtext NOT NULL,
  `likebutton` int(11) NOT NULL,
  `chatbutton` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `userId`, `postDescription`, `likebutton`, `chatbutton`) VALUES
(1, 2, '<pre>good morning</pre>', 1, 2),
(2, 1, '<pre>hi everything is good?</pre>', 2, 1),
(3, 4, '<pre>how to travel to london any one know?\r\n</pre>', 3, 4),
(4, 5, '<pre>ay haga</pre>', 4, 5),
(5, 6, '<pre>be happy</pre>', 5, 6),
(6, 1, '<pre>hiii</pre>', 6, 1),
(7, 7, '<pre>hi </pre>', 7, 7),
(8, 1, '<pre>good morning everyone\r\n</pre>', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(30) NOT NULL,
  `userPhoto` varchar(100) NOT NULL DEFAULT 'defaultavatar.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `userPhoto`) VALUES
(1, 'noura', 'noura@gmail.com', '12345678', 'unnamed.jpg'),
(2, 'ahmed', 'a@hotmail.com', '123456789', 'Mental-health-2.png'),
(3, 'sayed', 's@yahoo.com', '99999999', 'defaultavatar.jpeg'),
(4, 'maya', 'm@gmail.com', '11112345', 'defaultavatar.jpeg'),
(5, 'mariam', 'marian@a.com', '44444444', 'defaultavatar.jpeg'),
(6, 'kinzy', 'k@m.com', '111111111', 'Untitled-1.jpg'),
(7, 'mohamed', 'f@h.com', 'llhhhhhhh', 'defaultavatar.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
