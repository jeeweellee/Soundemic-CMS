-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 04:01 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soundemic`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `songId` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `userId`, `comment`, `songId`, `datetime`) VALUES
(2, 27, 'I&#039;ve been listening to this song lately.', 16, '2021-12-04 22:21:16'),
(3, 16, 'This is my favorite!', 14, '2021-12-04 22:34:53'),
(7, 26, 'I can listen to this all day.', 42, '2021-12-06 12:37:15'),
(68, 15, 'This breaks my heart :(', 17, '2021-12-10 07:39:20'),
(87, 28, 'Falling in love with this &lt;3', 43, '2021-12-10 08:27:21'),
(88, 28, 'It&#039;s always been in my playlist.', 14, '2021-12-10 08:36:22'),
(89, 16, 'This is an art', 43, '2021-12-12 23:27:26'),
(90, 16, 'Amazing', 42, '2021-12-13 06:35:08'),
(91, 16, 'Music to my ears!!!', 16, '2021-12-13 08:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreId` int(11) NOT NULL,
  `genre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genreId`, `genre`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Jazz'),
(4, 'Soul'),
(5, 'R&B'),
(6, 'Reggae'),
(27, 'Country'),
(28, 'Electric');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `songId` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` mediumtext NOT NULL,
  `artist` varchar(150) NOT NULL,
  `genreId` int(11) NOT NULL,
  `currentDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`songId`, `title`, `description`, `artist`, `genreId`, `currentDate`) VALUES
(14, 'I&#039;ll Always Love You', '<p>And I&#39;ll always love youDeep inside this heart of mine I do love you And I&#39;ll always need you And if you ever change your mind I&#39;ll stil I will love you</p>\r\n', 'Michael Johnson', 2, '2021-12-13 14:36:20'),
(16, 'Yesterday Once More', '<p>When I was young I&#39;d listen to the radio Waitin&#39; for my favorite songs When they played I&#39;d sing along It made me smile.</p>\r\n', 'Carpenters', 1, '2021-12-13 14:34:30'),
(17, 'Till My Heartaches End', '<p>Then you left without even saying that you&#39;re leaving I was hurt, and it really won&#39;t be easy to forget.</p>\r\n\r\n<p>Yesterday, and I pray that you would stay But then you&#39;re gone and, oh, so far away</p>\r\n', 'Ella Mae Saison', 1, '2021-12-13 14:36:31'),
(42, 'Through The Fire', '<p>Through the fire To the limit, to the wall For a chance to be with you I&#39;d gladly risk it all</p>\r\n\r\n<p>Through the fire Through whatever, come what may</p>\r\n', 'Chaka Khan', 2, '2021-12-13 14:35:24'),
(43, 'Can&#039;t Help Falling In Love ', '<p>Wise men say Only fools rush in But I can&#39;t help falling in love with you Shall I stay? Would it be a sin If I can&#39;t help falling in love with you?</p>\r\n', 'Elvis Presley', 1, '2021-12-13 14:34:14'),
(44, 'Piano In The Dark', 'Just as I walk to the door\r\nI can feel your emotion\r\nIt&#039;s pulling me back\r\nBack to love you', 'Brenda Russell', 1, '2021-12-04 02:05:51'),
(51, 'Bruises', '<p>There must be something in the water Cause everyday its getting colder If only I can hold you You keep my hands from going under</p>\r\n', 'Lewis Capaldi', 5, '2021-12-13 14:35:56'),
(89, 'Feeling Good', '<p>It&#39;s a new dawn It&#39;s a new day It&#39;s a new life For me<br />\r\nAnd I&#39;m feeling good I&#39;m feeling good</p>\r\n', 'Michael Buble', 3, '2021-12-13 14:19:41'),
(90, 'What A Wonderful World', '<p>I see trees of green, red roses too I see them bloom for me and you<br />\r\nAnd I think to myself What a wonderful world</p>\r\n', 'Louis Armstrong', 3, '2021-12-13 14:23:17'),
(91, 'Respect', '<p>I ain&#39;t gon&#39; do you wrong while you&#39;re gone Ain&#39;t gon&#39; do you wrong &#39;cause I don&#39;t wanna</p>\r\n\r\n<p>All I&#39;m askin&#39; is for a little respect when you come home</p>\r\n', 'Aretha Franklin', 4, '2021-12-13 14:24:47'),
(92, 'Stuck On You', '<p>Stuck on you I&#39;ve got this feeling down deep in my soul that I just can&#39;t lose<br />\r\nGuess I&#39;m on my way Needed a friend And the way I feel now I guess I&#39;ll be with you &#39;til the end<br />\r\nGuess I&#39;m on my way Mighty glad you stayed</p>\r\n', 'Lionel Richie', 4, '2021-12-13 14:27:18'),
(93, 'At My Worst', '<p>I need somebody who can love me at my worst No, I&#39;m not perfect, but I hope you see my worth<br />\r\n&#39;Cause it&#39;s only you, nobody new, I put you first And for you, girl, I swear I&#39;ll do the worst</p>\r\n', 'Pink Sweat', 5, '2021-12-13 14:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `hashpassword` char(60) NOT NULL,
  `userType` varchar(30) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `email`, `hashpassword`, `userType`, `joined`, `image`) VALUES
(15, 'admin', 'admin@soundemic.com', '$2y$10$hk4WGXrUl.O1I0.Sph2z5OL0tPvzzAZAlgiQCE/W2hhnmcxpmJrKm', 'Admin', '2021-11-25 07:45:54', 'moneyheist.jpg'),
(16, 'jewel', 'jewel@soundemic.com', '$2y$10$MZyWm5Ka7vIZ0YbalUuGHOdWz44ifanMWj4ppngIRuC6cOswHCpb.', 'User', '2021-11-25 07:50:15', 'kowalski (2).jpg'),
(26, 'alan', 'alan@soundemic.com', '$2y$10$Q.ZIRi8qaXAoAQYUBt17/Og4lALWf7jUCoX12.XSQKNhzJzvYSwMS', 'User', '2021-12-06 18:20:42', 'alan.png'),
(27, 'faith', 'faith@soundemic.com', '$2y$10$sNS4iTIJW86fM/QfbgIycOvpbjLOZ8JQ8Zc1zyb/dBpqFi.dkD006', 'User', '2021-12-10 13:09:32', 'penguin (2).jpg'),
(28, 'feliciano', 'feliciano@soundemic.com', '$2y$10$LXMNamb8hiqZfxfnNocGO.63.r0.LW2cV1SIZL1yeErLrfLJW6xjq', 'User', '2021-12-10 13:21:03', 'spongebob.jpg'),
(29, 'simpson', 'simpson@soundemic.com', '$2y$10$6ji3k66hNCF9SEG3zn99WObOIPQSFZRuJNwlcgonvvXccN0OZjIEq', 'User', '2021-12-10 14:59:44', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `comments_ibfk_2` (`songId`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreId`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`songId`),
  ADD KEY `genreId` (`genreId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genreId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `songId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`songId`) REFERENCES `songs` (`songId`) ON DELETE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`genreId`) REFERENCES `genre` (`genreId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
