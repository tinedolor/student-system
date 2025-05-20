-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 09:19 AM
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
-- Database: `studentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcementtable`
--

CREATE TABLE `announcementtable` (
  `announcemendId` int(255) NOT NULL,
  `announcement` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coursetable`
--

CREATE TABLE `coursetable` (
  `CourseId` varchar(45) NOT NULL,
  `Course` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `Department` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursetable`
--

INSERT INTO `coursetable` (`CourseId`, `Course`, `status`, `Department`) VALUES
('BSA', 'Bachelor of Science in Accountancy', 'Active', 'CBA'),
('BSCS', 'Bachelor of Science in Computer Studies', 'Active', 'CSS'),
('BSIT', 'Bachelor of Science in Information Technology', 'Active', 'CCS'),
('general', 'general', 'Active', 'general');

-- --------------------------------------------------------

--
-- Table structure for table `deparmenttable`
--

CREATE TABLE `deparmenttable` (
  `DepartmentId` varchar(20) NOT NULL,
  `Departmentname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deparmenttable`
--

INSERT INTO `deparmenttable` (`DepartmentId`, `Departmentname`) VALUES
('CBA', 'College of Business Administration'),
('CCS', 'College of Computer Studies'),
('General', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `facultylogin`
--

CREATE TABLE `facultylogin` (
  `FacultyloginId` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `Role` varchar(25) NOT NULL,
  `FacultyId` varchar(25) NOT NULL,
  `Attempt` int(11) NOT NULL,
  `Status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facultylogin`
--

INSERT INTO `facultylogin` (`FacultyloginId`, `Username`, `Password`, `Role`, `FacultyId`, `Attempt`, `Status`) VALUES
(1, 'JhoannaNavarro', 'Jhoanna2020', 'Admin', 'P1', 3, 'Active'),
(2, 'GwenethSantos', 'Stacy2021', 'Professor', 'P2', 3, 'Active'),
(3, 'SantiagoAgustin', 'Santi2017', 'Professor', 'P3', 3, 'Active'),
(4, 'JustinGuevara', 'Justin2020', 'Professor', 'P4', 3, 'Active'),
(5, 'LaurenceFerrer', 'Ferrer1945', 'Professor', 'P5', 3, 'Active'),
(6, 'GivenciBugatti', 'Italia213', 'Professor', 'P6', 3, 'Active'),
(7, 'Geneva', 'Christian345', 'Professor', 'P7', 2, 'Active'),
(8, 'DaleSugilon', 'Dale756', 'Professor', 'P8', 3, 'Active'),
(9, 'Admin404', '404login', 'Admin', 'P9', 3, 'Active'),
(10, 'seth1', '12345', 'Professor', 'P11', 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `facultytable`
--

CREATE TABLE `facultytable` (
  `id` int(11) NOT NULL,
  `FacultyId` varchar(11) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `Position` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facultytable`
--

INSERT INTO `facultytable` (`id`, `FacultyId`, `LastName`, `FirstName`, `Position`) VALUES
(1, 'P1', 'Navarro', 'Jhoanna', 'Dean'),
(2, 'P2', 'Santos', 'Gweneth', 'Professor'),
(3, 'P3', 'Agustin', 'Santiago', 'Professor'),
(4, 'P4', 'Guevera', 'Justin', 'Professor'),
(5, 'P5', 'Ferrer', 'Laurence', 'Professor'),
(6, 'P6', 'Bugatti', 'Givenci', 'Part-Time'),
(7, 'P7', 'Geneva', 'Christian', 'Part-Time'),
(8, 'P8', 'Sugilon', 'Dale', 'Part-Time'),
(9, 'P9', 'Ash', 'Lyn', 'Admin'),
(11, 'P10', 'Lupa', 'Lyn', 'Professor'),
(16, 'P11', 'Elven', 'Seth', 'Part-timer');

-- --------------------------------------------------------

--
-- Table structure for table `gradetable`
--

CREATE TABLE `gradetable` (
  `GradeId` int(11) NOT NULL,
  `StudentId` varchar(25) NOT NULL,
  `Subjectcode` varchar(25) NOT NULL,
  `Prelim` varchar(25) DEFAULT NULL,
  `Midterm` varchar(25) DEFAULT NULL,
  `PreFinal` varchar(25) DEFAULT NULL,
  `Final` varchar(25) DEFAULT NULL,
  `Prelim Grade` varchar(10) NOT NULL,
  `Midterm Grade` varchar(10) NOT NULL,
  `Prefinal Grade` varchar(10) NOT NULL,
  `Final Grade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gradetable`
--

INSERT INTO `gradetable` (`GradeId`, `StudentId`, `Subjectcode`, `Prelim`, `Midterm`, `PreFinal`, `Final`, `Prelim Grade`, `Midterm Grade`, `Prefinal Grade`, `Final Grade`) VALUES
(1, '1000-25', 's6', '89', NULL, NULL, NULL, '2.00', '', '', ''),
(2, '1000-25', 's9', NULL, NULL, NULL, NULL, '', '', '', ''),
(3, '1000-25', 's10', NULL, NULL, NULL, NULL, '', '', '', ''),
(4, '1000-25', 's11', NULL, NULL, NULL, NULL, '', '', '', ''),
(5, '1000-25', 's13', NULL, NULL, NULL, NULL, '', '', '', ''),
(6, '1000-25', 's8', NULL, NULL, NULL, NULL, '', '', '', ''),
(8, '1001-25', 's6', NULL, NULL, NULL, NULL, '', '', '', ''),
(9, '1001-25', 's9', NULL, NULL, NULL, NULL, '', '', '', ''),
(10, '1001-25', 's10', NULL, NULL, NULL, NULL, '', '', '', ''),
(11, '1001-25', 's11', NULL, NULL, NULL, NULL, '', '', '', ''),
(12, '1001-25', 's13', NULL, NULL, NULL, NULL, '', '', '', ''),
(13, '1001-25', 's8', NULL, NULL, NULL, NULL, '', '', '', ''),
(15, '1002-25', 's6', NULL, NULL, NULL, NULL, '', '', '', ''),
(16, '1002-25', 's9', NULL, NULL, NULL, NULL, '', '', '', ''),
(17, '1002-25', 's10', NULL, NULL, NULL, NULL, '', '', '', ''),
(18, '1002-25', 's11', NULL, NULL, NULL, NULL, '', '', '', ''),
(19, '1002-25', 's13', NULL, NULL, NULL, NULL, '', '', '', ''),
(20, '1002-25', 's8', NULL, NULL, NULL, NULL, '', '', '', ''),
(22, '1004-25', 's6', NULL, NULL, NULL, NULL, '', '', '', ''),
(23, '1004-25', 's9', NULL, NULL, NULL, NULL, '', '', '', ''),
(24, '1004-25', 's10', NULL, NULL, NULL, NULL, '', '', '', ''),
(25, '1004-25', 's11', NULL, NULL, NULL, NULL, '', '', '', ''),
(26, '1004-25', 's13', NULL, NULL, NULL, NULL, '', '', '', ''),
(27, '1004-25', 's8', NULL, NULL, NULL, NULL, '', '', '', ''),
(29, '1005-25', 's6', NULL, NULL, NULL, NULL, '', '', '', ''),
(30, '1005-25', 's9', NULL, NULL, NULL, NULL, '', '', '', ''),
(31, '1005-25', 's10', NULL, NULL, NULL, NULL, '', '', '', ''),
(32, '1005-25', 's11', NULL, NULL, NULL, NULL, '', '', '', ''),
(33, '1004-25', 's13', NULL, NULL, NULL, NULL, '', '', '', ''),
(34, '1005-25', 's8', NULL, NULL, NULL, NULL, '', '', '', ''),
(37, '1007-25', 's16', NULL, NULL, NULL, NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sectiontable`
--

CREATE TABLE `sectiontable` (
  `SectionID` int(25) NOT NULL,
  `section` varchar(25) NOT NULL,
  `sectioncourse` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sectiontable`
--

INSERT INTO `sectiontable` (`SectionID`, `section`, `sectioncourse`) VALUES
(1, '11M1', 'BSA'),
(2, '11M2', 'BSA'),
(3, '12M1', 'BSA'),
(4, '12M2', 'BSA'),
(5, '21A1', 'BSA'),
(6, '21A2', 'BSA'),
(7, '22A1', 'BSA'),
(8, '22A2', 'BSA'),
(9, '31A1', 'BSA'),
(10, '31A2', 'BSA'),
(11, '32A1', 'BSA'),
(12, '32A2', 'BSA'),
(13, '41A1', 'BSA'),
(14, '41A2', 'BSA'),
(15, '42A1', 'BSA'),
(16, '42A2', 'BSA'),
(17, '11M1', 'BSIT'),
(18, '11M2', 'BSIT'),
(19, '12M1', 'BSIT'),
(20, '12M2', 'BSIT'),
(21, '21A1', 'BSIT'),
(22, '21A2', 'BSIT'),
(23, '22A1', 'BSIT'),
(24, '22A2', 'BSIT'),
(25, '31A1', 'BSIT'),
(33, '31A2', 'BSIT'),
(34, '32A1', 'BSIT'),
(35, '32A2', 'BSIT'),
(36, '41A1', 'BSIT'),
(37, '41A2', 'BSIT'),
(38, '42A1', 'BSIT'),
(39, '42A2', 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `studentlogin`
--

CREATE TABLE `studentlogin` (
  `StudentAccId` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `StudentId` varchar(255) NOT NULL,
  `Try` int(25) NOT NULL,
  `Status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentlogin`
--

INSERT INTO `studentlogin` (`StudentAccId`, `Username`, `Password`, `StudentId`, `Try`, `Status`) VALUES
(1, 'jeromegabriel', 'jeromepogi26', '1000-25', 3, 'Active'),
(2, 'ChristianDale', 'Christianlangto25', '1001-25', 3, 'Active'),
(3, 'JustineDolor', 'Dolor230', '1002-25', 3, 'Active'),
(4, 'ReinaldMarinay', 'ReinaldMarinay21', '1004-25', 3, 'Active'),
(5, 'PreciousCostales', 'PreciousAubrey', '1005-25', 3, 'Active'),
(6, 'Casto', 'rice1234', '1006-25', 3, 'Active'),
(7, 'kirito', 'sao1', '1007-25', 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `studenttable`
--

CREATE TABLE `studenttable` (
  `StudentId` varchar(11) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studenttable`
--

INSERT INTO `studenttable` (`StudentId`, `LastName`, `FirstName`, `Course`, `Section`) VALUES
('1000-25', 'Almenie', 'Jerome Gabriel', 'BSIT', '32A1'),
('1001-25', 'Alfaro', 'Christian Dale', 'BSIT', '32A1'),
('1002-25', 'Dolor', 'Justine', 'BSIT', '32A1'),
('1004-25', 'Marinay', 'Reinald', 'BSIT', '32A1'),
('1005-25', 'Costales', 'Precious Aubrey', 'BSIT', '32A1'),
('1006-25', 'Nether', 'Castorice', 'BSA', '32M1'),
('1007-25', 'kirigaya', 'kazuto', 'BSA', '11M1');

-- --------------------------------------------------------

--
-- Table structure for table `subjecttable`
--

CREATE TABLE `subjecttable` (
  `SubjectId` int(11) NOT NULL,
  `SubjectName` varchar(50) NOT NULL,
  `facultyId` varchar(25) NOT NULL,
  `Unit` int(11) NOT NULL,
  `Department` varchar(11) NOT NULL,
  `subjectcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjecttable`
--

INSERT INTO `subjecttable` (`SubjectId`, `SubjectName`, `facultyId`, `Unit`, `Department`, `subjectcode`) VALUES
(1, 'Contemporary World ', 'P2', 3, 'General', 's1'),
(2, 'Discrete Mathematics', 'P3', 3, 'General', 's2'),
(3, 'Programming 1', 'P4', 3, 'CCS', 's3'),
(4, 'Understanding the Self', 'P5', 3, 'General', 's4'),
(5, 'Networking 1', 'P6', 3, 'CCS', 's5'),
(6, 'Panitikan', 'P7', 3, 'General', 's6'),
(7, 'Kontekswalisado', 'P8', 3, 'General', 's7'),
(8, 'Quantitative Methods(Modeling & Simulation)', 'P5', 3, 'CCS', 's8'),
(9, 'Capstone Project and Research 1', 'P1', 3, 'CCS', 's9'),
(10, 'Information Assurance And Security 1', 'P4', 3, 'CCS', 's10'),
(11, 'System Integration & Architure 1', 'P5', 3, 'CCS', 's11'),
(13, 'IT Elective 3', 'P4', 2, 'CCS', 's13'),
(14, 'Ethics', 'P9', 3, 'General', 's14'),
(15, 'Basic Photography', 'P8', 3, 'CCS', 's15'),
(16, 'Bussiness Math', 'P10', 3, 'CBA', 's16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursetable`
--
ALTER TABLE `coursetable`
  ADD PRIMARY KEY (`CourseId`);

--
-- Indexes for table `deparmenttable`
--
ALTER TABLE `deparmenttable`
  ADD PRIMARY KEY (`DepartmentId`);

--
-- Indexes for table `facultylogin`
--
ALTER TABLE `facultylogin`
  ADD PRIMARY KEY (`FacultyloginId`);

--
-- Indexes for table `facultytable`
--
ALTER TABLE `facultytable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradetable`
--
ALTER TABLE `gradetable`
  ADD PRIMARY KEY (`GradeId`);

--
-- Indexes for table `sectiontable`
--
ALTER TABLE `sectiontable`
  ADD PRIMARY KEY (`SectionID`);

--
-- Indexes for table `studentlogin`
--
ALTER TABLE `studentlogin`
  ADD PRIMARY KEY (`StudentAccId`);

--
-- Indexes for table `studenttable`
--
ALTER TABLE `studenttable`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `subjecttable`
--
ALTER TABLE `subjecttable`
  ADD PRIMARY KEY (`SubjectId`),
  ADD KEY `subjectcode` (`subjectcode`),
  ADD KEY `subjectcode_2` (`subjectcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facultylogin`
--
ALTER TABLE `facultylogin`
  MODIFY `FacultyloginId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `facultytable`
--
ALTER TABLE `facultytable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gradetable`
--
ALTER TABLE `gradetable`
  MODIFY `GradeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sectiontable`
--
ALTER TABLE `sectiontable`
  MODIFY `SectionID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `studentlogin`
--
ALTER TABLE `studentlogin`
  MODIFY `StudentAccId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjecttable`
--
ALTER TABLE `subjecttable`
  MODIFY `SubjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
