-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 12:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `start-up`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `Id` int(11) NOT NULL,
  `PId` varchar(200) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `File` varchar(200) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`Id`, `PId`, `Title`, `Description`, `File`, `Status`) VALUES
(1, '5', 'ads', 'fds', 'unnamed_7.png', '0'),
(2, '5', 'sad', 'dsa', 'unnamed_7.png', '1'),
(3, '5', 'sa', 'Sa', 'unnamed_7.png', '1'),
(4, '5', 'a', 'aaa', 'unnamed_7.png', '0'),
(5, '5', 'dsad', 'asdasdas', 'unnamed_7.png', '0'),
(6, '5', 'dsad', 'asdasdas', 'unnamed_7.png', '0'),
(7, '5', 'bbbbbb', 'bbbbbbbbb', 'unnamed_7.png', '0'),
(8, '5', 'vccccc', 'ccccccccc', 'download_11.jpg', '0'),
(9, '5', 'sd', 'fds', '1745643708_download (11).jpg', '0'),
(10, '6', 'tilrw', 'yesss', 'download_11.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `case_evidence`
--

CREATE TABLE `case_evidence` (
  `Id` int(11) NOT NULL,
  `case_Id` varchar(200) DEFAULT NULL,
  `Title` varchar(400) DEFAULT NULL,
  `Files` varchar(400) DEFAULT NULL,
  `Time_stamp` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_evidence`
--

INSERT INTO `case_evidence` (`Id`, `case_Id`, `Title`, `Files`, `Time_stamp`) VALUES
(1, '15', 'yes', 'uploads/1745517090_images (11).jpg', NULL),
(2, '15', 'done', 'uploads/1745554834_download (11).jpg', '2025-04-25 06:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `request_id` varchar(200) DEFAULT NULL,
  `sender_name` varchar(200) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `created_at` varchar(200) DEFAULT NULL,
  `investid` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `request_id`, `sender_name`, `message`, `created_at`, `investid`) VALUES
(1, '6', 'ENTREPRENEUR', 'hello', '2025-04-29 11:42:46', '7'),
(2, '7', 'MENTOR', 'ss', '2025-04-29 11:43:45', '6'),
(3, '6', 'MENTOR', 'ss', '2025-04-29 11:45:30', '7'),
(4, '6', 'ENTREPRENEUR', 'got it', '2025-04-29 11:45:54', '7'),
(5, '6', 'MENTOR', 'hello', '2025-04-29 11:46:30', '7'),
(6, '7', 'ENTREPRENEUR', 'hello', '2025-04-29 11:53:33', '4'),
(7, '7', 'INVENTOR', 'yes', '2025-04-29 11:53:55', '4');

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `District` varchar(200) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `Aadhar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`Id`, `Name`, `Contact`, `Gender`, `DOB`, `District`, `Address`, `Aadhar`) VALUES
(1, 'abi', '1236547896', '1', '2025-04-22', 'Kasargod', 'Kl', '45789651452'),
(4, 'mob', '09876543212', 'Female', '', 'Kannur', 'KL', '87654398765431'),
(5, 'roopika', '45789654121', 'Female', '', 'Idukki', 'KLS', '54789654124578');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `Pid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `usertype` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `Pid`, `title`, `description`, `photo`, `usertype`) VALUES
(4, 1, 'aaaaaaaaa', 'aaaaaaaaaaaaaaa', 'download (11).jpg', 'INVENTOR'),
(5, 5, 'bbbbbbbbbbb', 'bbbbbbbbbbbbbbb', 'unnamed (7).png', 'MENTOR'),
(6, 6, 'cccccc', 'cccccccccccccccc', 'download (10).jpg', 'ENTREPRENEUR');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Id` int(11) NOT NULL,
  `eventname` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` text DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Id`, `eventname`, `date`, `title`, `description`, `location`, `category`, `file`) VALUES
(1, 'dss', '2025-04-23', 'sads', 'das', 'das', 'dasd', '../upload/unnamed (7).png');

-- --------------------------------------------------------

--
-- Table structure for table `event_reg`
--

CREATE TABLE `event_reg` (
  `Id` int(11) NOT NULL,
  `EenterId` varchar(200) DEFAULT NULL,
  `Eventid` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_reg`
--

INSERT INTO `event_reg` (`Id`, `EenterId`, `Eventid`) VALUES
(1, '6', '1'),
(2, '7', '1');

-- --------------------------------------------------------

--
-- Table structure for table `evidance_report`
--

CREATE TABLE `evidance_report` (
  `ID` int(11) NOT NULL,
  `Pid` varchar(200) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Document` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidance_report`
--

INSERT INTO `evidance_report` (`ID`, `Pid`, `Title`, `Document`) VALUES
(12, '15', 'mobile was lost', '../uploads/1745488189_images11.jpg'),
(13, '16', 'heee', '../uploads/1745570182_cyber-freight-trucks.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inventor_register`
--

CREATE TABLE `inventor_register` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Investing_category` varchar(100) DEFAULT NULL,
  `Contactnumber` varchar(100) DEFAULT NULL,
  `Occupation` varchar(100) DEFAULT NULL,
  `Organization` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Nationality` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Profile` varchar(200) DEFAULT NULL,
  `Upload_Document` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventor_register`
--

INSERT INTO `inventor_register` (`id`, `Name`, `Investing_category`, `Contactnumber`, `Occupation`, `Organization`, `Description`, `Nationality`, `Address`, `Profile`, `Upload_Document`) VALUES
(1, 'fewr', 'sdfds', '1234567890', 'dfdsfds', 'fdsf', 'fdsfd', 'India ', 'dsa', 'download (11).jpg', 'unnamed (7).png'),
(2, 'abir', '1', '12345678909', 'Business ', 'Comapny', 'yes', 'India', 'KL', 'images (11).jpg', 'CV.png'),
(3, 'moon', '1', '45789654124', 'Job', 'company', 'Good', 'India', 'Kl', 'CV.png', 'images (11).jpg'),
(4, 'test2', 'stocks', '1234567890', 'Good', 'org', 'very good', 'india', 'Kl', 'images (10).jpg', 'pngegg.png');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `RegId` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Usertype` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Id`, `RegId`, `Email`, `Password`, `Usertype`, `username`, `Status`) VALUES
(3, '1', 'plip@gmail.com', '$2y$10$KNFy1z7IJ/8OeGJzP8hX4ObGbMKaI0CpS6MPdGRC.tWmPq4ILHw8a', 'INVENTOR', 'abi', 'active'),
(5, '2', 'ram@gmail.com', '$2y$10$7bAUoRIz5kwfzxM5El3Qc.H64BLwFmhBWv9uNUSp8HM7S43QT29ym', 'MENTOR', 'ram', 'active'),
(6, '3', 'demo@gmail.com', '$2y$10$zin7Lz2xuv2OHWcU/nFWNO64O.RfJyXg3duIg1RDXM9D6KBJj.1qa', 'MENTOR', 'demo@gmail.com', 'inactive'),
(7, '2', 'ram@gmail.com', '$2y$10$j/3b7SJ2HE6cWI2jku/gx.N4AyzQwQy8yQn9tbrTch5Cl.KlvzsGi', 'INVENTOR', 'ram', 'active'),
(9, '4', 'mob@gmail.com', '$2y$10$huRJfmeXkiw612wDHo4aH.FHipaNHQS8RMkhiR2e3gvK4seNiumwa', 'ENTREPRENEUR', 'mob@gmail.com', 'active'),
(10, '3', 'mon@gmail.com', '$2y$10$/U9Q5s0Feze1j/x.hkBj0O0Am0R6ZMCK6wRcLDr2sDm8T6hx3k18q', 'INVENTOR', 'mon@gmail.com', 'active'),
(11, '4', 'mob@gmail.com', '$2y$10$7bAUoRIz5kwfzxM5El3Qc.H64BLwFmhBWv9uNUSp8HM...', 'MENTOR', 'mob@gmail.com', 'active'),
(12, '5', 'pop@gmail.com', '$2y$10$C3Yv3hPPTS7NbBnqfTs1zOAwMMgaTC7B/afHwGiC6S.mxJYgvp8km', 'MENTOR', 'pop@gmail.com', 'active'),
(13, '5', 'ap@gmail.com', '$2y$10$7bAUoRIz5kwfzxM5El3Qc.H64BLwFmhBWv9uNUSp8HM7S43QT29ym', 'ENTREPRENEUR', 'fs', 'active'),
(14, '6', 'mouse@gmail.com', '$2y$10$PpnllXQkOBj3/qAFr7SnMOYVgsuUdu5etnwopTfHyjA6hvEJW/neG', 'ENTREPRENEUR', 'buyb', 'active'),
(15, '6', 'test1@gmail.com', '$2y$10$IfNk7wKJTcnZFUeiMKNbyenhCLN1.aVQXulkAxdjVjrf3YB5UoZDS', 'MENTOR', 'test1@gmail.com', 'active'),
(16, '4', 'test2@gmail.com', '$2y$10$nOPkx9H/ltv0JOTg6fVejO0tOjCt1IVmRYxJMxbcnoG.Hs5avoYbK', 'INVENTOR', 'test2@gmail.com', 'active'),
(17, '7', 'test3@gmail.com', '$2y$10$j/3b7SJ2HE6cWI2jku/gx.N4AyzQwQy8yQn9tbrTch5Cl.KlvzsGi', 'ENTREPRENEUR', 'aa', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `mentor_register`
--

CREATE TABLE `mentor_register` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Expertise_area` varchar(50) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `Subscription_amount` varchar(100) DEFAULT NULL,
  `demo_vedio` varchar(100) DEFAULT NULL,
  `Profile` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor_register`
--

INSERT INTO `mentor_register` (`id`, `Name`, `Expertise_area`, `Description`, `contact`, `Subscription_amount`, `demo_vedio`, `Profile`) VALUES
(1, 'mobile', '2', 'Good', '1234567898', '100', 'https://www.google.com/', 'pngegg.png'),
(2, 'pary', '1', 'goog', '1234567890', '100', 'https://www.google.com/', 'CV.png'),
(3, 'demo1', '1', 'okay', '12345678909', '100', '6011601_People_Person_3840x2160.mp4', 'download (10).jpg'),
(4, 'mobile', 'One', 'goods', '12345678909', '100', '6011601_People_Person_3840x2160.mp4', 'images (11).jpg'),
(5, 'po', 'One', 'yesss', '', '200', '6011601_People_Person_3840x2160.mp4', 'pngegg.png'),
(6, 'test', 'Web Development', 'yes', '1234567890', '100', '6011601_People_Person_3840x2160.mp4', 'images (11).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(200) DEFAULT NULL,
  `LastName` varchar(200) DEFAULT NULL,
  `CompanyName` varchar(200) DEFAULT NULL,
  `CorporateId` varchar(100) DEFAULT NULL,
  `Industry_sector` varchar(100) DEFAULT NULL,
  `Company_description` varchar(200) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `Contactnumber` varchar(200) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Profile` varchar(200) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`Id`, `FirstName`, `LastName`, `CompanyName`, `CorporateId`, `Industry_sector`, `Company_description`, `Location`, `Contactnumber`, `Address`, `Profile`, `Status`) VALUES
(4, 'Abi', 'A', 'company', 'KJG678', 'Healthcare', 'Good', 'KL', '12365478966', 'kl', 'home-button (2).png', NULL),
(5, 'aprna', 'ap', 'sics', 'KHG556', 'IT', 'good', 'kl', '54789654123', 'sd', 'default_photo.jpg', NULL),
(6, 'mouse', 'm', 'company', 'KHG8778', 'IT', 'good', 'Kl', '1456987123', 'kl', 'default_photo.jpg', NULL),
(7, 'tetst3', 'tt', 'company', 'GFR455', 'IT', 'good', 'kl', '1234567890', 'aa', 'default_photo.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requestinvestor`
--

CREATE TABLE `requestinvestor` (
  `Id` int(11) NOT NULL,
  `EntrepreneurId` varchar(100) DEFAULT NULL,
  `InvestorsId` varchar(100) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestinvestor`
--

INSERT INTO `requestinvestor` (`Id`, `EntrepreneurId`, `InvestorsId`, `Status`) VALUES
(1, '5', '2', '0'),
(3, '5', '1', '1'),
(4, '7', '4', '1'),
(5, '7', '2', '0'),
(6, '7', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `startup_pitch`
--

CREATE TABLE `startup_pitch` (
  `PitchId` int(11) NOT NULL,
  `RegId` int(11) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Audience` text DEFAULT NULL,
  `Problem` text DEFAULT NULL,
  `SecretSauce` text DEFAULT NULL,
  `DefinedMarket` text DEFAULT NULL,
  `MarketValue` varchar(255) DEFAULT NULL,
  `Competitor1` varchar(255) DEFAULT NULL,
  `Competitor2` varchar(255) DEFAULT NULL,
  `Differentiator` text DEFAULT NULL,
  `CurrentState` text DEFAULT NULL,
  `Ask` text DEFAULT NULL,
  `HelpPurpose` text DEFAULT NULL,
  `EquityOffering` varchar(100) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `startup_pitch`
--

INSERT INTO `startup_pitch` (`PitchId`, `RegId`, `CompanyName`, `Category`, `Audience`, `Problem`, `SecretSauce`, `DefinedMarket`, `MarketValue`, `Competitor1`, `Competitor2`, `Differentiator`, `CurrentState`, `Ask`, `HelpPurpose`, `EquityOffering`, `Status`) VALUES
(8, 4, 'company', '1', 'audeance', 'problem', 'sauce', 'market', 'value', 'comp1', 'comp2', 'diff', 'team', 'ask', 'askssaa', 'offering', '0'),
(9, 4, 'demo', '2', 'yes', 'ppppss', 'sauces', 'makerstsjhj', '2021', 'props1', 'props2', 'yes', 'temas', 'kkk', 'we can', 'lllppp', '1'),
(10, 5, 'apn', '2', 'opa', 'we can', 'ss', 'pp', '10', 'pop', 'ded', 'oo', 'hbhj', 'hubuy', 'hbuh', '100', '0'),
(11, 7, 'company', 'Idea Stage', 'yes need it', 'need to solve', 'sauses', 'yeses', 'latest', 'comp', 'comp2', 'we can ', 'product', 'task is ask', 'wee cann doo ittt', 'niooooo', '0');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `Id` int(11) NOT NULL,
  `EntpId` varchar(200) DEFAULT NULL,
  `MentorId` varchar(200) DEFAULT NULL,
  `card_number` text DEFAULT NULL,
  `DD` varchar(300) DEFAULT NULL,
  `MM` varchar(300) DEFAULT NULL,
  `YY` varchar(300) DEFAULT NULL,
  `Cv` varchar(300) DEFAULT NULL,
  `Amount` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`Id`, `EntpId`, `MentorId`, `card_number`, `DD`, `MM`, `YY`, `Cv`, `Amount`) VALUES
(11, '5', '5', '1234567890111133', '11', '12', '11', '1111', '200'),
(12, '6', '5', '1111111111111111', '11', '11', '11', '1111', '200'),
(13, '1', '1', '1111111111111111', '11', '11', '11', '1111', '100'),
(14, '7', '6', '1111111111111111', '11', '11', '11', '1111', '100');

-- --------------------------------------------------------

--
-- Table structure for table `tutorail`
--

CREATE TABLE `tutorail` (
  `Id` int(11) NOT NULL,
  `Pid` varchar(200) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `File` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutorail`
--

INSERT INTO `tutorail` (`Id`, `Pid`, `Title`, `Description`, `File`) VALUES
(1, '5', 'fds', 'sdf', '../../uploads/unnamed_7.png'),
(2, '5', 'das', 'das', '../uploads/unnamed_7.png'),
(3, '5', 'dsa', 'das', 'unnamed_7.png'),
(4, '5', 'sdfvbnm', 'tryrtytry', '6011601_People_Person_3840x2160.mp4'),
(5, '5', 'sdfvbnm', 'tryrtytry', '6011601_People_Person_3840x2160.mp4'),
(6, '5', 'sdfvbnm', 'tryrtytry', '1745597115_teacher-welcoming-students-at-school-animation-download-in-lottie-json-gif-static-svg-file-formats--welcome-student-education-pack-animations-8458836.mp4'),
(7, '6', 'hello', 'new tutuo', '6011601_People_Person_3840x2160.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `event_reg`
--
ALTER TABLE `event_reg`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `inventor_register`
--
ALTER TABLE `inventor_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `mentor_register`
--
ALTER TABLE `mentor_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `requestinvestor`
--
ALTER TABLE `requestinvestor`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `startup_pitch`
--
ALTER TABLE `startup_pitch`
  ADD PRIMARY KEY (`PitchId`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tutorail`
--
ALTER TABLE `tutorail`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_reg`
--
ALTER TABLE `event_reg`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventor_register`
--
ALTER TABLE `inventor_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mentor_register`
--
ALTER TABLE `mentor_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requestinvestor`
--
ALTER TABLE `requestinvestor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `startup_pitch`
--
ALTER TABLE `startup_pitch`
  MODIFY `PitchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tutorail`
--
ALTER TABLE `tutorail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
