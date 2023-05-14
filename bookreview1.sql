-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 05:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookreview`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbook`
--

CREATE TABLE `tblbook` (
  `Book_Key` int(15) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Category_Key` int(11) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `Authors_Firstname` varchar(100) NOT NULL,
  `Authors_Lastname` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `cover` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbook`
--

INSERT INTO `tblbook` (`Book_Key`, `Title`, `Category_Key`, `ISBN`, `Authors_Firstname`, `Authors_Lastname`, `description`, `cover`) VALUES
(1, 'The Alchmist', 10, ' 9780061122415', 'Paulo', 'Cohelo', '', ''),
(2, 'The Immortal Life of Henrietta Lacks', 2, '9781400052189 ', 'Rebeka', 'Scloot', '', ''),
(3, 'A Brief History of Time', 2, '9780553380163', 'stephen', 'hawkins', '', ''),
(4, 'The Handmaid\'s Tale', 7, '9781400052189 ', 'Margaret ', 'Doe', '', ''),
(5, 'The Girl with the Dragon Tattoo', 1, '9780307949486', 'Steig', 'Larson', '', ''),
(6, 'The Hunger Games', 7, ' 9780439023481', 'Suzzane', 'Collins', '', ''),
(7, 'The Road', 2, '9780553380163', 'Cormac', 'MCarthy', '', ''),
(8, 'The Power of Now', 1, '9781400052189 ', 'Ekhart', 'Tolle', '', ''),
(9, 'The Complete Calvin and Hobbes', 11, '9780553380163', 'Bill', 'Waterson', '', ''),
(10, 'The Da Vinci Code', 15, '9780307474278', 'Dan', 'Brown', '', ''),
(11, 'Thinking, Fast and Slow', 8, '9780307949486', 'Daniel', 'Khaneman', '', ''),
(12, 'The God of Small Things', 10, '9780812979657', 'Arundahati', 'Roy', '', ''),
(13, 'The Old Man and the Sea', 7, '9780553380163', 'Ernis', 'Hemingway', '', ''),
(14, 'The Name of the Wind', 10, '9780812979657', 'Patrik', 'Ruthfus', '', ''),
(15, 'The Brief Wondrous Life of Oscar Wao', 8, '9781594483295', 'Oscar', 'Wao', '', ''),
(16, 'Quiet', 1, ' 9780439023481', 'Susan', 'Cain', '', ''),
(17, 'Guns, Germs, and Steel', 7, '9780553380163', 'Jared', 'Diamond', '', ''),
(18, 'The Wind-Up Bird Chronicle', 10, '9780812979657', 'Haruki', 'Murakami', '', ''),
(19, 'Sapien', 7, '9781400052189 ', 'Yuval', 'Noah', '', ''),
(20, 'One Piece', 1, '9780307949486', 'Oshiro', 'Oda', '', ''),
(21, 'The Added Book', 1, '9780307949422', 'John Quinnvic', 'Taboada', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `Category_Key` int(15) NOT NULL,
  `Category_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`Category_Key`, `Category_Name`) VALUES
(1, 'Fantasy'),
(2, 'Sci-Fi'),
(3, 'Mystery'),
(4, 'Thriller'),
(5, 'Romance'),
(6, 'Westerns'),
(7, 'Southern Gothic fiction'),
(10, 'Fiction'),
(11, 'Dystopian Fiction'),
(12, 'Classic Romance'),
(13, 'Coming-of-Age Fiction'),
(14, 'Jazz Age Fiction'),
(15, 'Philosophical Fiction'),
(16, 'Winds'),
(17, 'Christopher'),
(18, 'New Cats');

-- --------------------------------------------------------

--
-- Table structure for table `tblreview`
--

CREATE TABLE `tblreview` (
  `Review_ID` int(11) NOT NULL,
  `Book_Key` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Time` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Review` varchar(150) NOT NULL,
  `Rating` int(5) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreview`
--

INSERT INTO `tblreview` (`Review_ID`, `Book_Key`, `Username`, `Date`, `Time`, `Title`, `Review`, `Rating`, `Status`) VALUES
(1, 1, 'admin', 'May 16,2002', '05:16 PM', 'Complex', 'It is very amazing how complex the novel is. I would love to reread this again', 5, 1),
(4, 1, 'JoeTestUser', '2023-05-13', '16:55:51', 'It\'s actually Phenomenal', 'Amazing if I may say so myself', 5, 1),
(6, 2, 'TestMod', '2023-05-13', '17:20:29', 'SupahAmazing', 'It\'s good as hell. Love love', 5, 1),
(9, 4, 'TestMod', '2023-05-13', '22:40:06', 'Titi', 'Titi', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `userType` int(1) NOT NULL DEFAULT 0,
  `Email` varchar(30) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`Firstname`, `Lastname`, `Username`, `Password`, `userType`, `Email`, `Status`) VALUES
('admin', 'admin', 'admin', 'admin', 2, '', 0),
('Joe', 'Ed', 'JoeTestUser', 'JoeTestUser', 0, 'JoeTestUser@gmail.com', 0),
('mod', 'mod', 'TestMod', 'mod', 1, 'Testmod@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbook`
--
ALTER TABLE `tblbook`
  ADD PRIMARY KEY (`Book_Key`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`Category_Key`);

--
-- Indexes for table `tblreview`
--
ALTER TABLE `tblreview`
  ADD PRIMARY KEY (`Review_ID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbook`
--
ALTER TABLE `tblbook`
  MODIFY `Book_Key` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `Category_Key` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblreview`
--
ALTER TABLE `tblreview`
  MODIFY `Review_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
