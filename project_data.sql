-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2024 at 04:27 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` varchar(10) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_pass`) VALUES
('admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `std_id` varchar(8) NOT NULL,
  `que_id` varchar(3) NOT NULL,
  `exam_id` varchar(20) NOT NULL,
  UNIQUE KEY `answers_unique` (`exam_id`,`std_id`,`que_id`),
  KEY `answers_student` (`std_id`),
  KEY `answers_question_paper` (`que_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appears_student_exam`
--

DROP TABLE IF EXISTS `appears_student_exam`;
CREATE TABLE IF NOT EXISTS `appears_student_exam` (
  `std_id` varchar(8) NOT NULL,
  `exam_id` varchar(20) NOT NULL,
  `appearing_date` date NOT NULL,
  UNIQUE KEY `appears_student_exam_unique` (`exam_id`,`std_id`),
  KEY `appears_student_exam_student` (`std_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(6) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `credit` int DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `credit`) VALUES
('CS413', 'Database Management System', 3),
('CS519', 'Computer Networks', 4),
('', 'Major Project', 16),
('CS515', 'major project', 16);

-- --------------------------------------------------------

--
-- Table structure for table `course_ob`
--

DROP TABLE IF EXISTS `course_ob`;
CREATE TABLE IF NOT EXISTS `course_ob` (
  `course_id` varchar(6) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `course_ob_no` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_ob`
--

INSERT INTO `course_ob` (`course_id`, `description`, `course_ob_no`) VALUES
('CS519', 'Understanding the principle and the design of layered Computer Network Architecture.', 'CO1'),
('CS519', 'Choose appropriate protocol and parameters under given use cases and network conditions.', 'CO3'),
('CS413', 'Discuss the needs of various protocols in Computer Applications.', 'CO1'),
('CS413', 'Basic understanding of Database Management Software.', 'CO2'),
('', '', 'CO1'),
('', '', 'CO1'),
('', '', 'CO1'),
('CS515', 'this is a major project', 'CO1'),
('', '', ''),
('CS515', '', 'CO2'),
('CS515', '', 'CO2'),
('CS515', 'major projgect', 'CO2');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` varchar(10) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
('ME', 'Mechanical Engineering'),
('CSE', 'Computer Science & Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` varchar(20) NOT NULL,
  `course_id` varchar(6) NOT NULL,
  `exam_name` varchar(20) NOT NULL,
  `exam_date` date NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `course_id`, `exam_name`, `exam_date`) VALUES
('1', 'CS413', 'Test 1', '2024-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` varchar(10) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  PRIMARY KEY (`faculty_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `f_name`, `l_name`, `dept_id`, `phone_no`, `passwd`) VALUES
('SIS', 'S.Ibotombi', 'Singh', 'cse', '8638872477', 'password'),
('USharma', 'Utpal', 'Sharma', 'cse', '08136028282', 'pass'),
('RS', 'Rosy', 'Sharma', 'CSE', '457643578876', 'Rosy@56');

-- --------------------------------------------------------

--
-- Table structure for table `has_exam_question`
--

DROP TABLE IF EXISTS `has_exam_question`;
CREATE TABLE IF NOT EXISTS `has_exam_question` (
  `que_id` varchar(3) NOT NULL,
  `exam_id` varchar(20) NOT NULL,
  UNIQUE KEY `has_exam_question_unique` (`que_id`,`exam_id`),
  KEY `has_exam_question_exam` (`exam_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `has_programme_programme_ob`
--

DROP TABLE IF EXISTS `has_programme_programme_ob`;
CREATE TABLE IF NOT EXISTS `has_programme_programme_ob` (
  `program_id` varchar(10) NOT NULL,
  `program_ob_no` varchar(10) NOT NULL,
  UNIQUE KEY `has_programme_programme_ob_unique` (`program_id`,`program_ob_no`),
  KEY `has_programme_programme_ob_program_ob_no` (`program_ob_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maps_to_programme_ob_course_ob`
--

DROP TABLE IF EXISTS `maps_to_programme_ob_course_ob`;
CREATE TABLE IF NOT EXISTS `maps_to_programme_ob_course_ob` (
  `course_ob_no` varchar(10) NOT NULL,
  `program_ob_no` varchar(10) NOT NULL,
  `mapping_with` varchar(10) NOT NULL,
  UNIQUE KEY `maps_to_programme_ob_course_ob_unique` (`course_ob_no`,`program_ob_no`),
  KEY `maps_to_programme_ob_course_ob_programme_ob` (`program_ob_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `program_id` varchar(10) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `dept_id` varchar(10) NOT NULL,
  PRIMARY KEY (`program_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`program_id`, `program_name`, `dept_id`) VALUES
('MCA', 'Masters of Computer Application', 'CSE');

-- --------------------------------------------------------

--
-- Table structure for table `programme_ob`
--

DROP TABLE IF EXISTS `programme_ob`;
CREATE TABLE IF NOT EXISTS `programme_ob` (
  `program_ob_no` varchar(10) NOT NULL,
  `program_ob_description` varchar(1000) NOT NULL,
  `dept_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`program_ob_no`),
  KEY `dept_id` (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `programme_ob`
--

INSERT INTO `programme_ob` (`program_ob_no`, `program_ob_description`, `dept_id`) VALUES
('PO1', 'blah blah', 'CSE');

-- --------------------------------------------------------

--
-- Table structure for table `question_paper`
--

DROP TABLE IF EXISTS `question_paper`;
CREATE TABLE IF NOT EXISTS `question_paper` (
  `que_id` varchar(3) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  `exam_id` varchar(20) NOT NULL,
  PRIMARY KEY (`que_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `question_paper`
--

INSERT INTO `question_paper` (`que_id`, `description`, `answer`, `exam_id`) VALUES
('1', 'what is?', 'nothing', '1');

-- --------------------------------------------------------

--
-- Table structure for table `register_student_course`
--

DROP TABLE IF EXISTS `register_student_course`;
CREATE TABLE IF NOT EXISTS `register_student_course` (
  `course_id` varchar(6) NOT NULL,
  `std_id` varchar(8) NOT NULL,
  UNIQUE KEY `register_student_course_unique` (`course_id`,`std_id`),
  KEY `register_student_course_student` (`std_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `std_id` varchar(8) NOT NULL,
  `std_name` varchar(50) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  PRIMARY KEY (`std_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_id`, `std_name`, `reg_no`) VALUES
('CSM22044', 'Swati Chanchal', '44');

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

DROP TABLE IF EXISTS `targets`;
CREATE TABLE IF NOT EXISTS `targets` (
  `que_id` varchar(3) NOT NULL,
  `course_ob_no` varchar(10) NOT NULL,
  UNIQUE KEY `targets_unique` (`que_id`,`course_ob_no`),
  KEY `targets_course_ob` (`course_ob_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teaches_faculty_course`
--

DROP TABLE IF EXISTS `teaches_faculty_course`;
CREATE TABLE IF NOT EXISTS `teaches_faculty_course` (
  `faculty_id` varchar(10) NOT NULL,
  `course_id` varchar(6) NOT NULL,
  `academaics` varchar(10) NOT NULL,
  `sessions` varchar(10) NOT NULL,
  UNIQUE KEY `teaches_faculty_course_unique` (`course_id`,`faculty_id`),
  KEY `teaches_faculty_course_faculty` (`faculty_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
