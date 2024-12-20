-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2024 at 09:34 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sljp`
--

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

DROP TABLE IF EXISTS `degree`;
CREATE TABLE IF NOT EXISTS `degree` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`id`, `title`) VALUES
(1, 'BICT Honors'),
(2, 'BSc Honors'),
(3, 'BET Honors');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `institude` int DEFAULT NULL,
  `degree` varchar(50) NOT NULL,
  `field` varchar(50) NOT NULL,
  `smonth` varchar(2) NOT NULL,
  `syear` varchar(4) NOT NULL,
  `emonth` varchar(2) NOT NULL,
  `eyear` varchar(4) NOT NULL,
  `grade` decimal(3,2) NOT NULL,
  `activities` text,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `institude` (`institude`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `user_id`, `institude`, `degree`, `field`, `smonth`, `syear`, `emonth`, `eyear`, `grade`, `activities`, `description`) VALUES
(1, 1, 1, 'BICT Honors', 'Software Engineering', '11', '2022', '11', '2026', 3.52, 'N/A', 'I am a dedicated **Software Developer** with expertise in **Full-Stack Development**, **DevOps**, and **UI/UX Design**. Skilled in programming languages like **JavaScript, Python, PHP, Java, Kotlin**, and more, I specialize in building responsive web applications, designing intuitive interfaces, and optimizing system workflows. Passionate about solving complex problems, I strive to deliver efficient, user-focused solutions while continuously learning and exploring new technologies.'),
(2, 6, 1, 'BICT Honors', 'Software Engineering', '09', '2020', '11', '2026', 3.00, 'N/A', 'N/A'),
(6, 7, 1, 'BICT Honors', 'Software Engineering', '09', '2022', '12', '2026', 3.00, 'N/A', 'N/A'),
(4, 2, 1, 'BICT Honors', 'Gaming & Animation', '09', '2022', '12', '2026', 3.80, 'N/A', 'N/A'),
(5, 3, 1, 'BICT Honors', 'Gaming & Animation', '09', '2022', '12', '2026', 3.50, 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

DROP TABLE IF EXISTS `field`;
CREATE TABLE IF NOT EXISTS `field` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `title`) VALUES
(1, 'Software Engineering'),
(2, 'Gaming & Animation'),
(3, 'Sustainable'),
(4, 'Automation'),
(5, 'Material');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

DROP TABLE IF EXISTS `follower`;
CREATE TABLE IF NOT EXISTS `follower` (
  `user_id` int NOT NULL,
  `follow_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`follow_id`),
  KEY `follow_id` (`follow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`user_id`, `follow_id`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `follow_request`
--

DROP TABLE IF EXISTS `follow_request`;
CREATE TABLE IF NOT EXISTS `follow_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `request_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`request_id`),
  KEY `request_id` (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `send` int DEFAULT NULL,
  `recv` int DEFAULT NULL,
  `msg_data` varchar(256) DEFAULT NULL,
  `date_time` datetime DEFAULT (now()),
  `msg_type` enum('text','image','post') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `send` (`send`),
  KEY `recv` (`recv`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `send`, `recv`, `msg_data`, `date_time`, `msg_type`) VALUES
(1, 1, 2, 'hey', '2024-12-20 16:38:02', 'text'),
(2, 2, 1, 'hello, what\'s going on!', '2024-12-20 16:39:01', 'text'),
(3, 1, 2, 'I\'m fine', '2024-12-20 16:39:46', 'text'),
(4, 1, 3, 'hello', '2024-12-20 16:47:45', 'text'),
(5, 3, 1, 'hi', '2024-12-20 16:48:13', 'text'),
(6, 2, 3, 'hey', '2024-12-20 17:13:07', 'text'),
(7, 3, 2, 'hello', '2024-12-20 17:13:29', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `evt_data` int DEFAULT NULL,
  `evt_type` enum('follow','post','event') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `post_text` text NOT NULL,
  `post_source` varchar(255) DEFAULT NULL,
  `posted_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `post_text`, `post_source`, `posted_at`) VALUES
(2, 1, 'Post testing', 'post-2.jpg', '2024-12-20 20:20:52'),
(5, 2, 'In an MVC structure for posting content, the Model handles the database operations, such as saving, retrieving, or updating posts. The View displays the user interface, like forms for creating posts or pages showing the content. The Controller processes user input, validates data, and interacts with the Model to fetch or save data, passing the results to the View. For example, when a user submits a post, the Controller validates it, updates the Model, and then refreshes the View to reflect the changes. This separation ensures clean, maintainable, and scalable code.', 'post-5.jpg', '2024-12-20 21:08:40'),
(6, 3, 'jQuery is a fast, lightweight JavaScript library that simplifies HTML document traversal, event handling, animations, and AJAX interactions. It helps developers write less code while achieving more functionality across different browsers. Despite modern frameworks like React or Angular, jQuery remains useful for quick projects and enhancing legacy systems. Its simplicity and wide adoption have made it a cornerstone in the evolution of web development.', 'post-6.jpg', '2024-12-20 21:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `title`) VALUES
(1, 'Web Development'),
(2, 'UI/UX Designer'),
(3, 'Software Development'),
(6, 'Java Programming'),
(5, 'Python Development'),
(7, 'MongoDB'),
(8, 'MySQL DMBS'),
(9, 'HTML 5'),
(10, 'JavaScript'),
(11, 'Jquery');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE IF NOT EXISTS `university` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`, `logo`) VALUES
(1, 'University of Kelaniya', 'Kel.png'),
(2, 'University of Colombo', 'col.jpg'),
(3, 'University of Jayapura', 'J\'pure.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first` varchar(100) NOT NULL,
  `last` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT 'Male',
  `dob` date NOT NULL,
  `address` text,
  `profile` varchar(256) DEFAULT 'default.jpg',
  `cover` varchar(256) DEFAULT 'default.jpg',
  `nic` varchar(20) DEFAULT NULL,
  `role` enum('seeker','provider','admin') DEFAULT NULL,
  `status` enum('Open','Hire','None') DEFAULT 'None',
  `headline` varchar(512) DEFAULT 'N/A',
  `show_school` enum('show','hide') DEFAULT 'show',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `contact` (`contact`),
  UNIQUE KEY `nic` (`nic`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first`, `last`, `username`, `password`, `email`, `contact`, `gender`, `dob`, `address`, `profile`, `cover`, `nic`, `role`, `status`, `headline`, `show_school`) VALUES
(1, 'Saroath', 'Farvees', 'farvees', '123', 'farvees@gmail.com', '756720854', 'Female', '2001-01-01', '337/A, Central Road, Maligaikadu - West', 'profile-1.jpg', 'default.jpg', '200112803638', 'seeker', 'None', 'Software Developer | DevOps | UI/UX Designer', 'show'),
(2, 'pramodya', 'pumal', 'pumal', '123', 'pumal@gmail.com', '754323765', 'Female', '2001-01-01', 'Pumal address somewhere', 'profile-2.jpg', 'default.jpg', '200134209876', 'seeker', 'None', 'Game Developer | Content Writer | UI/UX Designer', 'show'),
(3, 'sachini', 'dissanayeka', 'sachini', '123', 'sachini@gmail.com', '765482543', 'Male', '2001-01-01', 'Scahini home town at Kandy', 'profile-3.jpg', 'default.jpg', '200134129854', 'seeker', 'None', 'Game Designer | Story Writer', 'show'),
(4, 'mohamed', 'ijas', 'ijas', '123', 'ijas@gmail.com', '752354123', 'Male', '2001-12-02', 'Anuradapura, khahattagasthigaliya', 'profile-4.jpg', 'default.jpg', '200123904523', 'admin', 'None', 'N/A', 'show'),
(6, 'Abdullah', 'Naleem', 'naleem', '123', 'naleem@gmail.com', '765434234', 'Female', '1998-01-01', 'Marudhana', 'profile-6.jpg', 'default.jpg', '199813603212', 'seeker', 'None', 'UI/UX Designer | Web Developer | Software Developer', 'show'),
(7, 'Mohamed', 'Arthath', 'arthath', '123', 'arthath@gmail.com', '765467564', 'Female', '1999-01-01', 'Kinniya', 'profile-7.jpg', 'default.jpg', '200132207876', 'seeker', 'None', 'Full Stack | DevOps', 'show');

-- --------------------------------------------------------

--
-- Table structure for table `user_skill`
--

DROP TABLE IF EXISTS `user_skill`;
CREATE TABLE IF NOT EXISTS `user_skill` (
  `user_id` int NOT NULL,
  `skill` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`skill`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_skill`
--

INSERT INTO `user_skill` (`user_id`, `skill`) VALUES
(1, 'HTML 5'),
(1, 'Java Programming'),
(1, 'MySQL DMBS'),
(1, 'Software Development'),
(1, 'UI/UX Designer'),
(1, 'Web Development'),
(2, 'UI/UX Designer'),
(6, 'UI/UX Designer'),
(6, 'Web Development');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
