-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 12:25 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `userID`, `movieID`, `mark`) VALUES
(1, 2, 1, 10),
(2, 3, 1, 8),
(3, 4, 1, 6),
(4, 2, 13, 10),
(5, 10, 13, 8),
(6, 2, 3, 5),
(7, 2, 4, 4),
(8, 2, 12, 9),
(9, 11, 13, 10);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `ganre` varchar(100) NOT NULL,
  `screenwriter` varchar(30) NOT NULL,
  `director` varchar(30) NOT NULL,
  `production` varchar(30) NOT NULL,
  `actors` varchar(1000) NOT NULL,
  `year` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `poster` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `description`, `ganre`, `screenwriter`, `director`, `production`, `actors`, `year`, `duration`, `poster`) VALUES
(13, 'Pulp Fiction', 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'Crime, Drama', 'Quentin Tarantino', 'Quentin Tarantino', 'Miramax', 'John Travolta, Uma Thurman, Samuel L. Jackson', 1994, 154, 'PulpFiction.jpg'),
(3, 'The Invisible Guest', 'A successful entrepreneur accused of murder and a witness preparation expert have less than three hours to come up with an impregnable defense.', 'Crime, Drama, Mystery', 'Oriol Paulo', 'Oriol Paulo', 'Balter Gallart', 'Mario Casas, Ana Wagener, Jose Coronado,  Bï¿½rbara Lennie,Francesc Orella, Paco Tous', 2016, 106, 'The Invisible Guest.jpg'),
(4, 'Perfect Strangers', 'Seven long-time friends get together for a dinner. When they decide to share with each other the content of every text message, email and phone call they receive, many secrets start to unveil and the equilibrium trembles.', 'Comedy, Drama', 'Paolo Genovese', 'Paolo Genovese', 'Italia', 'Giuseppe Battiston, Anna Foglietta, Marco Giallini, Edoardo Leo, Valerio Mastandrea, Alba Rohrwacher, Kasia Smutniak', 2016, 96, 'Perfect Strangers.jpg'),
(12, 'Lord of War', 'An arms dealer confronts the morality of his work as he is being chased by an INTERPOL Agent.', 'Action, Crime, Drama', 'Andrew Niccol', 'Andrew Niccol', 'Miramax', 'Nicolas Cage, Ethan Hawke, Jared Leto', 2005, 122, 'LordOfWar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `username`, `password`, `isAdmin`) VALUES
(1, 'Ana', 'Pavlovic', 'ana@gmail.com', 'ana', 'ana', 1),
(2, 'Pera', 'Peric', 'pera@gmail.com', 'pera', 'pera', 0),
(3, 'Laza', 'Lazic', 'laza@gmail.com', 'laza', 'laza', 0),
(4, 'Zika', 'Zikic', 'zika@gmail.com', 'zika', 'zika', 0),
(8, 'test', 'test', 'test@gmail.com', 'test', 'test', 0),
(9, 'Momcilo', 'Jontulovic', 'momcilo@gmail.com', 'momcilo', 'momcilo', 0),
(10, 'John', 'Doe', 'jd@gmail.com', 'JohnDoe', 'JohnDoe', 0),
(11, 'Luka', 'Ivanovic', 'li@gmail.com', 'luka', 'luka', 0),
(12, 'Danny', 'Melone', 'dm@gmail.com', 'dm', 'dm', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
