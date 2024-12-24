-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 24, 2024 at 04:27 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(1, 1, 1, 'give me some likes for more contents', '2024-12-24 20:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `founder` int DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `cover` varchar(255) DEFAULT 'default.jpg',
  `logo` varchar(255) DEFAULT 'default.jpg',
  `founded_at` date DEFAULT (now()),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `founder`, `name`, `location`, `industry`, `website`, `cover`, `logo`, `founded_at`) VALUES
(1, 9, 'digizen', 'Sri Lanka', 'IT ', 'digizen.com', 'logo (1).jpg', 'digizen_logo_vertical.jpg', '2024-12-24'),
(2, 8, 'Sri Lankan Job Portal', 'Sri Lanka', 'IT', 'www.sljp.lk', '8.jpg', 'Screenshot 2024-12-24 203820.png', '2024-12-24');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `user_id`, `institude`, `degree`, `field`, `smonth`, `syear`, `emonth`, `eyear`, `grade`, `activities`, `description`) VALUES
(1, 1, 1, 'BICT Honors', 'Software Engineering', '11', '2022', '11', '2026', 3.52, 'N/A', 'I am a dedicated **Software Developer** with expertise in **Full-Stack Development**, **DevOps**, and **UI/UX Design**. Skilled in programming languages like **JavaScript, Python, PHP, Java, Kotlin**, and more, I specialize in building responsive web applications, designing intuitive interfaces, and optimizing system workflows. Passionate about solving complex problems, I strive to deliver efficient, user-focused solutions while continuously learning and exploring new technologies.'),
(2, 6, 1, 'BICT Honors', 'Software Engineering', '09', '2020', '11', '2026', 3.00, 'N/A', 'N/A'),
(6, 7, 1, 'BICT Honors', 'Software Engineering', '09', '2022', '12', '2026', 3.00, 'N/A', 'N/A'),
(4, 2, 1, 'MICT Honors', 'Gaming & Animation', '09', '2022', '12', '2026', 3.80, 'N/A', 'N/A'),
(5, 3, 1, 'MICT Honors', 'Gaming & Animation', '09', '2022', '12', '2026', 3.50, 'N/A', 'N/A'),
(7, 8, 2, 'BSc Honors', 'Software Engineering', '01', '2015', '08', '2019', 3.85, 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `company_id` int DEFAULT NULL,
  `position` enum('owner','recruiter') DEFAULT 'recruiter',
  `department` enum('HR','IT','Marketing','Finance') DEFAULT 'HR',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 7),
(1, 8),
(2, 1),
(2, 3),
(3, 1),
(3, 2),
(7, 1),
(8, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE IF NOT EXISTS `job` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `location` varchar(100) NOT NULL,
  `vacancy` int NOT NULL,
  `place` enum('On-Site','Remote','Hybrid') DEFAULT 'Hybrid',
  `type` enum('Full Time','Part Time','Freelance','Internship','Contract','Temporary','Volenteer') DEFAULT 'Full Time',
  `posted_at` datetime DEFAULT (now()),
  `status` enum('Active','Inactive') DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `company_id`, `title`, `description`, `salary`, `location`, `vacancy`, `place`, `type`, `posted_at`, `status`) VALUES
(1, 2, 'Senior Software Engineer', '<h3><strong>Job&nbsp;Title:&nbsp;Senior&nbsp;Software&nbsp;Engineer</strong></h3><p><strong>Location:</strong>&nbsp;[City,&nbsp;State/Remote/Hybrid]</p><p><strong>Employment&nbsp;Type:</strong>&nbsp;[Full-Time/Part-Time/Contract]</p><h3><strong>About&nbsp;Us</strong></h3><p>[Your&nbsp;Company&nbsp;Name]&nbsp;is&nbsp;a&nbsp;[brief&nbsp;description&nbsp;of&nbsp;your&nbsp;company,&nbsp;e.g.,&nbsp;&quot;fast-growing&nbsp;tech&nbsp;company&nbsp;focused&nbsp;on&nbsp;delivering&nbsp;innovative&nbsp;solutions&nbsp;in&nbsp;[industry/sector].&quot;]</p><p>We&nbsp;are&nbsp;passionate&nbsp;about&nbsp;[highlight&nbsp;your&nbsp;mission&nbsp;or&nbsp;core&nbsp;values,&nbsp;e.g.,&nbsp;&quot;empowering&nbsp;businesses&nbsp;with&nbsp;AI-driven&nbsp;insights&quot;]&nbsp;and&nbsp;are&nbsp;looking&nbsp;for&nbsp;talented&nbsp;individuals&nbsp;to&nbsp;help&nbsp;us&nbsp;achieve&nbsp;our&nbsp;goals.</p><h3><strong>About&nbsp;the&nbsp;Role</strong></h3><p>We&nbsp;are&nbsp;seeking&nbsp;a&nbsp;highly&nbsp;skilled&nbsp;and&nbsp;experienced&nbsp;<strong>Senior&nbsp;Software&nbsp;Engineer</strong>&nbsp;to&nbsp;join&nbsp;our&nbsp;dynamic&nbsp;team.&nbsp;In&nbsp;this&nbsp;role,&nbsp;you&nbsp;will&nbsp;lead&nbsp;the&nbsp;design,&nbsp;development,&nbsp;and&nbsp;deployment&nbsp;of&nbsp;scalable,&nbsp;high-quality&nbsp;software&nbsp;solutions.&nbsp;You&nbsp;will&nbsp;collaborate&nbsp;with&nbsp;cross-functional&nbsp;teams,&nbsp;mentor&nbsp;junior&nbsp;developers,&nbsp;and&nbsp;play&nbsp;a&nbsp;key&nbsp;role&nbsp;in&nbsp;shaping&nbsp;the&nbsp;technical&nbsp;direction&nbsp;of&nbsp;our&nbsp;projects.</p><h3><strong>Key&nbsp;Responsibilities</strong></h3><ul><li>Design,&nbsp;develop,&nbsp;test,&nbsp;and&nbsp;maintain&nbsp;high-quality&nbsp;software&nbsp;solutions.</li><li>Collaborate&nbsp;with&nbsp;product&nbsp;managers,&nbsp;designers,&nbsp;and&nbsp;other&nbsp;engineers&nbsp;to&nbsp;deliver&nbsp;exceptional&nbsp;user&nbsp;experiences.</li><li>Architect&nbsp;and&nbsp;implement&nbsp;scalable&nbsp;backend&nbsp;systems&nbsp;using&nbsp;[specific&nbsp;tech&nbsp;stack,&nbsp;e.g.,&nbsp;Java,&nbsp;Python,&nbsp;Node.js,&nbsp;etc.].</li><li>Ensure&nbsp;code&nbsp;quality&nbsp;through&nbsp;peer&nbsp;reviews,&nbsp;automated&nbsp;testing,&nbsp;and&nbsp;adherence&nbsp;to&nbsp;best&nbsp;practices.</li><li>Optimize&nbsp;application&nbsp;performance&nbsp;and&nbsp;scalability.</li><li>Troubleshoot&nbsp;and&nbsp;resolve&nbsp;complex&nbsp;technical&nbsp;issues.</li><li>Mentor&nbsp;and&nbsp;guide&nbsp;junior&nbsp;team&nbsp;members,&nbsp;fostering&nbsp;a&nbsp;culture&nbsp;of&nbsp;growth&nbsp;and&nbsp;learning.</li><li>Stay&nbsp;updated&nbsp;with&nbsp;the&nbsp;latest&nbsp;industry&nbsp;trends&nbsp;and&nbsp;integrate&nbsp;them&nbsp;into&nbsp;your&nbsp;work.</li></ul><h3><strong>Qualifications</strong></h3><p><strong>Must-Haves:</strong></p><ul><li>&nbsp;years&nbsp;of&nbsp;experience&nbsp;in&nbsp;software&nbsp;development,&nbsp;with&nbsp;a&nbsp;strong&nbsp;focus&nbsp;on&nbsp;[specific&nbsp;areas,&nbsp;e.g.,&nbsp;backend&nbsp;development,&nbsp;full-stack&nbsp;development,&nbsp;etc.].</li><li>Proficiency&nbsp;in&nbsp;[specific&nbsp;programming&nbsp;languages/technologies,&nbsp;e.g.,&nbsp;JavaScript,&nbsp;Python,&nbsp;C#,&nbsp;etc.].</li><li>Hands-on&nbsp;experience&nbsp;with&nbsp;[frameworks/tools,&nbsp;e.g.,&nbsp;React,&nbsp;Angular,&nbsp;Django,&nbsp;etc.].</li><li>Deep&nbsp;understanding&nbsp;of&nbsp;software&nbsp;architecture,&nbsp;design&nbsp;patterns,&nbsp;and&nbsp;algorithms.</li><li>Experience&nbsp;with&nbsp;cloud&nbsp;platforms&nbsp;such&nbsp;as&nbsp;AWS,&nbsp;Azure,&nbsp;or&nbsp;GCP.</li><li>Strong&nbsp;problem-solving&nbsp;and&nbsp;analytical&nbsp;skills.</li><li>Excellent&nbsp;communication&nbsp;and&nbsp;collaboration&nbsp;abilities.</li></ul><p><strong>Nice-to-Haves:</strong></p><ul><li>Experience&nbsp;with&nbsp;DevOps&nbsp;tools&nbsp;and&nbsp;practices&nbsp;(e.g.,&nbsp;Docker,&nbsp;Kubernetes,&nbsp;CI/CD&nbsp;pipelines).</li><li>Knowledge&nbsp;of&nbsp;database&nbsp;technologies&nbsp;(SQL/NoSQL).</li><li>Prior&nbsp;experience&nbsp;in&nbsp;[specific&nbsp;domain,&nbsp;e.g.,&nbsp;fintech,&nbsp;healthcare,&nbsp;etc.].</li></ul><h3><strong>What&nbsp;We&nbsp;Offer</strong></h3><ul><li>Competitive&nbsp;salary&nbsp;and&nbsp;benefits&nbsp;package.</li><li>Opportunities&nbsp;for&nbsp;career&nbsp;growth&nbsp;and&nbsp;professional&nbsp;development.</li><li>Flexible&nbsp;work&nbsp;arrangements&nbsp;(remote&nbsp;or&nbsp;hybrid&nbsp;options).</li><li>A&nbsp;supportive&nbsp;and&nbsp;inclusive&nbsp;company&nbsp;culture.</li><li>[Add&nbsp;unique&nbsp;perks,&nbsp;e.g.,&nbsp;&quot;Annual&nbsp;learning&nbsp;stipend,&quot;&nbsp;&quot;Wellness&nbsp;programs,&quot;&nbsp;etc.].</li></ul><h3><strong>How&nbsp;to&nbsp;Apply</strong></h3><p>Ready&nbsp;to&nbsp;make&nbsp;an&nbsp;impact?&nbsp;Click&nbsp;&quot;Apply&nbsp;JOB&quot;&nbsp;or&nbsp;send&nbsp;your&nbsp;resume&nbsp;and&nbsp;a&nbsp;brief&nbsp;cover&nbsp;letter&nbsp;to&nbsp;[your&nbsp;email&nbsp;address].</p><p><strong>Join&nbsp;us&nbsp;in&nbsp;building&nbsp;solutions&nbsp;that&nbsp;[impact&nbsp;statement,&nbsp;e.g.,&nbsp;&quot;transform&nbsp;how&nbsp;businesses&nbsp;operate&quot;]&nbsp;and&nbsp;take&nbsp;your&nbsp;career&nbsp;to&nbsp;the&nbsp;next&nbsp;level!</strong></p>', 265000.00, 'Sri Lanka', 5, 'On-Site', 'Full Time', '2024-12-24 20:44:15', 'Active'),
(2, 2, 'Project Manager', '<h3><strong>Job&nbsp;Title:&nbsp;Project&nbsp;Manager</strong></h3><p><strong>Location:</strong>&nbsp;Colombo</p><p><strong>Employment&nbsp;Type:</strong>&nbsp;Full-Time</p><h3><strong>About&nbsp;Us</strong></h3><p>At&nbsp;[Your&nbsp;Company&nbsp;Name],&nbsp;we&nbsp;are&nbsp;leaders&nbsp;in&nbsp;[industry/sector],&nbsp;delivering&nbsp;cutting-edge&nbsp;solutions&nbsp;that&nbsp;transform&nbsp;the&nbsp;way&nbsp;businesses&nbsp;and&nbsp;individuals&nbsp;achieve&nbsp;their&nbsp;goals.&nbsp;Our&nbsp;mission&nbsp;is&nbsp;[insert&nbsp;mission&nbsp;statement,&nbsp;e.g.,&nbsp;&quot;to&nbsp;drive&nbsp;innovation&nbsp;and&nbsp;efficiency&nbsp;through&nbsp;exceptional&nbsp;project&nbsp;delivery&quot;].&nbsp;We’re&nbsp;looking&nbsp;for&nbsp;an&nbsp;experienced&nbsp;<strong>Project&nbsp;Manager</strong>&nbsp;to&nbsp;join&nbsp;our&nbsp;growing&nbsp;team&nbsp;and&nbsp;lead&nbsp;high-impact&nbsp;initiatives&nbsp;that&nbsp;shape&nbsp;the&nbsp;future&nbsp;of&nbsp;our&nbsp;organization.</p><h3><strong>The&nbsp;Role</strong></h3><p>As&nbsp;a&nbsp;<strong>Project&nbsp;Manager</strong>,&nbsp;you&nbsp;will&nbsp;play&nbsp;a&nbsp;critical&nbsp;role&nbsp;in&nbsp;planning,&nbsp;executing,&nbsp;and&nbsp;delivering&nbsp;projects&nbsp;of&nbsp;varying&nbsp;scope&nbsp;and&nbsp;complexity.&nbsp;You’ll&nbsp;serve&nbsp;as&nbsp;the&nbsp;bridge&nbsp;between&nbsp;stakeholders,&nbsp;team&nbsp;members,&nbsp;and&nbsp;leadership,&nbsp;ensuring&nbsp;all&nbsp;efforts&nbsp;are&nbsp;aligned,&nbsp;on&nbsp;schedule,&nbsp;and&nbsp;within&nbsp;budget.&nbsp;This&nbsp;role&nbsp;requires&nbsp;strategic&nbsp;thinking,&nbsp;attention&nbsp;to&nbsp;detail,&nbsp;and&nbsp;the&nbsp;ability&nbsp;to&nbsp;lead&nbsp;teams&nbsp;in&nbsp;a&nbsp;collaborative&nbsp;environment.</p><h3><strong>Key&nbsp;Responsibilities</strong></h3><ul><li>Define&nbsp;project&nbsp;objectives,&nbsp;scope,&nbsp;deliverables,&nbsp;and&nbsp;success&nbsp;criteria.</li><li>Create&nbsp;and&nbsp;manage&nbsp;project&nbsp;plans,&nbsp;schedules,&nbsp;and&nbsp;budgets.</li><li>Coordinate&nbsp;cross-functional&nbsp;teams,&nbsp;ensuring&nbsp;effective&nbsp;communication&nbsp;and&nbsp;task&nbsp;alignment.</li><li>Identify&nbsp;and&nbsp;mitigate&nbsp;risks&nbsp;to&nbsp;ensure&nbsp;smooth&nbsp;project&nbsp;execution.</li><li>Monitor&nbsp;progress,&nbsp;track&nbsp;milestones,&nbsp;and&nbsp;provide&nbsp;regular&nbsp;updates&nbsp;to&nbsp;stakeholders.</li><li>Ensure&nbsp;quality&nbsp;standards&nbsp;are&nbsp;met&nbsp;and&nbsp;projects&nbsp;are&nbsp;delivered&nbsp;within&nbsp;scope.</li><li>Build&nbsp;and&nbsp;maintain&nbsp;strong&nbsp;relationships&nbsp;with&nbsp;clients,&nbsp;vendors,&nbsp;and&nbsp;internal&nbsp;teams.</li></ul><h3><strong>What&nbsp;We’re&nbsp;Looking&nbsp;For</strong></h3><p><strong>Required&nbsp;Skills&nbsp;and&nbsp;Experience:</strong></p><ul><li>Bachelor’s&nbsp;degree&nbsp;in&nbsp;[relevant&nbsp;field,&nbsp;e.g.,&nbsp;Business,&nbsp;Engineering,&nbsp;Computer&nbsp;Science].</li><li>[X+]&nbsp;years&nbsp;of&nbsp;experience&nbsp;in&nbsp;project&nbsp;management&nbsp;or&nbsp;a&nbsp;related&nbsp;role.</li><li>Proficiency&nbsp;in&nbsp;project&nbsp;management&nbsp;tools&nbsp;such&nbsp;as&nbsp;[Jira,&nbsp;Trello,&nbsp;MS&nbsp;Project,&nbsp;or&nbsp;others].</li><li>Strong&nbsp;knowledge&nbsp;of&nbsp;project&nbsp;management&nbsp;methodologies&nbsp;(Agile,&nbsp;Scrum,&nbsp;Waterfall).</li><li>Excellent&nbsp;communication,&nbsp;leadership,&nbsp;and&nbsp;problem-solving&nbsp;skills.</li><li>Ability&nbsp;to&nbsp;manage&nbsp;multiple&nbsp;projects&nbsp;and&nbsp;priorities&nbsp;simultaneously.</li></ul><p><strong>Preferred&nbsp;Qualifications:</strong></p><ul><li>PMP,&nbsp;Prince2,&nbsp;or&nbsp;Agile&nbsp;certifications.</li><li>Experience&nbsp;in&nbsp;[specific&nbsp;industry,&nbsp;e.g.,&nbsp;technology,&nbsp;construction,&nbsp;finance].</li><li>Familiarity&nbsp;with&nbsp;budget&nbsp;management&nbsp;and&nbsp;resource&nbsp;allocation.</li></ul><h3><strong>Why&nbsp;Join&nbsp;Us?</strong></h3><ul><li>Competitive&nbsp;salary&nbsp;and&nbsp;comprehensive&nbsp;benefits&nbsp;package.</li><li>Opportunities&nbsp;for&nbsp;professional&nbsp;growth&nbsp;and&nbsp;certification&nbsp;support.</li><li>A&nbsp;dynamic,&nbsp;inclusive,&nbsp;and&nbsp;innovative&nbsp;work&nbsp;culture.</li><li>Flexible&nbsp;work&nbsp;arrangements&nbsp;(remote&nbsp;or&nbsp;hybrid&nbsp;options).</li><li>[Highlight&nbsp;unique&nbsp;perks,&nbsp;e.g.,&nbsp;“Employee&nbsp;wellness&nbsp;programs,”&nbsp;“Quarterly&nbsp;team&nbsp;retreats,”&nbsp;etc.].</li></ul><h3><strong>How&nbsp;to&nbsp;Apply</strong></h3><p>Ready&nbsp;to&nbsp;take&nbsp;your&nbsp;project&nbsp;management&nbsp;expertise&nbsp;to&nbsp;the&nbsp;next&nbsp;level?&nbsp;Submit&nbsp;your&nbsp;resume&nbsp;and&nbsp;a&nbsp;brief&nbsp;cover&nbsp;letter&nbsp;to&nbsp;[your&nbsp;email&nbsp;address]&nbsp;or&nbsp;apply&nbsp;directly&nbsp;via&nbsp;[application&nbsp;link].</p><p>Let’s&nbsp;build&nbsp;something&nbsp;extraordinary&nbsp;together&nbsp;at&nbsp;SLJP!</p>', 500000.00, 'Sri Lanka', 2, 'On-Site', 'Full Time', '2024-12-24 20:50:41', 'Active'),
(3, 1, 'Junior Software Engineer', '<h3><strong>Junior&nbsp;Software&nbsp;Engineer&nbsp;-&nbsp;PHP&nbsp;Development</strong></h3><p>Are&nbsp;you&nbsp;a&nbsp;passionate&nbsp;Junior&nbsp;Software&nbsp;Engineer&nbsp;looking&nbsp;to&nbsp;grow&nbsp;your&nbsp;skills&nbsp;in&nbsp;backend&nbsp;development&nbsp;and&nbsp;handle&nbsp;complex&nbsp;scenarios&nbsp;like&nbsp;division&nbsp;by&nbsp;zero?</p><p><strong>About&nbsp;the&nbsp;Role</strong>:</p><p>We’re&nbsp;seeking&nbsp;a&nbsp;motivated&nbsp;Junior&nbsp;Software&nbsp;Engineer&nbsp;to&nbsp;join&nbsp;our&nbsp;dynamic&nbsp;development&nbsp;team,&nbsp;where&nbsp;you’ll&nbsp;be&nbsp;working&nbsp;on&nbsp;PHP-based&nbsp;applications&nbsp;and&nbsp;ensuring&nbsp;robust&nbsp;error&nbsp;handling.&nbsp;A&nbsp;core&nbsp;part&nbsp;of&nbsp;this&nbsp;role&nbsp;involves&nbsp;understanding&nbsp;and&nbsp;managing&nbsp;edge&nbsp;cases,&nbsp;such&nbsp;as&nbsp;division&nbsp;by&nbsp;zero,&nbsp;while&nbsp;contributing&nbsp;to&nbsp;the&nbsp;development&nbsp;of&nbsp;scalable&nbsp;and&nbsp;efficient&nbsp;solutions.</p><h3><strong>Key&nbsp;Responsibilities</strong>:</h3><ul><li>Implement&nbsp;and&nbsp;maintain&nbsp;PHP&nbsp;codebases&nbsp;with&nbsp;a&nbsp;focus&nbsp;on&nbsp;best&nbsp;practices&nbsp;and&nbsp;code&nbsp;quality.</li><li>Handle&nbsp;error&nbsp;scenarios&nbsp;such&nbsp;as&nbsp;division&nbsp;by&nbsp;zero&nbsp;and&nbsp;other&nbsp;exceptional&nbsp;cases&nbsp;gracefully.</li><li>Collaborate&nbsp;with&nbsp;senior&nbsp;engineers&nbsp;to&nbsp;ensure&nbsp;optimal&nbsp;functionality&nbsp;and&nbsp;performance.</li><li>Write&nbsp;clean,&nbsp;maintainable&nbsp;code&nbsp;with&nbsp;effective&nbsp;exception&nbsp;handling&nbsp;techniques.</li><li>Support&nbsp;the&nbsp;development&nbsp;of&nbsp;scalable&nbsp;backend&nbsp;systems&nbsp;with&nbsp;minimal&nbsp;downtime&nbsp;and&nbsp;error.</li></ul><h3><strong>What&nbsp;You’ll&nbsp;Bring</strong>:</h3><ul><li>Strong&nbsp;understanding&nbsp;of&nbsp;PHP&nbsp;fundamentals&nbsp;and&nbsp;web&nbsp;development.</li><li>Proficiency&nbsp;in&nbsp;handling&nbsp;exceptions&nbsp;and&nbsp;managing&nbsp;edge&nbsp;cases&nbsp;(e.g.,&nbsp;division&nbsp;by&nbsp;zero).</li><li>Basic&nbsp;knowledge&nbsp;of&nbsp;web&nbsp;technologies,&nbsp;databases,&nbsp;and&nbsp;version&nbsp;control&nbsp;(e.g.,&nbsp;Git).</li><li>Eagerness&nbsp;to&nbsp;learn&nbsp;and&nbsp;grow&nbsp;in&nbsp;a&nbsp;collaborative,&nbsp;fast-paced&nbsp;environment.</li></ul><h3><strong>Why&nbsp;Join&nbsp;Us</strong>:</h3><ul><li><strong>Growth&nbsp;Opportunities</strong>:&nbsp;Work&nbsp;with&nbsp;experienced&nbsp;engineers&nbsp;to&nbsp;improve&nbsp;your&nbsp;skills.</li><li><strong>Challenging&nbsp;Projects</strong>:&nbsp;Dive&nbsp;into&nbsp;complex&nbsp;technical&nbsp;challenges,&nbsp;including&nbsp;error&nbsp;handling&nbsp;and&nbsp;system&nbsp;optimization.</li><li><strong>Team&nbsp;Collaboration</strong>:&nbsp;Be&nbsp;part&nbsp;of&nbsp;a&nbsp;supportive&nbsp;team&nbsp;that&nbsp;values&nbsp;innovation&nbsp;and&nbsp;continuous&nbsp;learning.</li></ul><p></p>', 120000.00, 'Sri Lanka', 3, 'Hybrid', 'Freelance', '2024-12-24 21:04:38', 'Active'),
(4, 1, 'Full Stack Intern - Software Engineer', '<p>🔍&nbsp;<strong>We’re&nbsp;Hiring:&nbsp;Full&nbsp;Stack&nbsp;Development&nbsp;Intern</strong>&nbsp;🚀</p><p><strong>Location:</strong>&nbsp;[Insert&nbsp;location&nbsp;or&nbsp;remote]</p><p><strong>Duration:</strong>&nbsp;[Insert&nbsp;duration]</p><p><strong>Industry:</strong>&nbsp;[Insert&nbsp;industry,&nbsp;e.g.,&nbsp;Technology,&nbsp;Software&nbsp;Development]</p><p>We’re&nbsp;looking&nbsp;for&nbsp;a&nbsp;<strong>Full&nbsp;Stack&nbsp;Development&nbsp;Intern</strong>&nbsp;to&nbsp;join&nbsp;our&nbsp;dynamic&nbsp;team!&nbsp;As&nbsp;an&nbsp;intern,&nbsp;you&nbsp;will&nbsp;have&nbsp;the&nbsp;opportunity&nbsp;to&nbsp;work&nbsp;with&nbsp;both&nbsp;<strong>frontend</strong>&nbsp;and&nbsp;<strong>backend</strong>&nbsp;technologies,&nbsp;contributing&nbsp;to&nbsp;real-world&nbsp;projects,&nbsp;and&nbsp;learning&nbsp;from&nbsp;experienced&nbsp;developers.</p><h3>🌟&nbsp;<strong>Key&nbsp;Responsibilities:</strong></h3><ul><li>Assist&nbsp;in&nbsp;building&nbsp;responsive&nbsp;and&nbsp;user-friendly&nbsp;<strong>web&nbsp;applications</strong>&nbsp;using&nbsp;technologies&nbsp;like&nbsp;<strong>HTML,&nbsp;CSS,&nbsp;JavaScript</strong>,&nbsp;and&nbsp;<strong>React</strong>.</li><li>Work&nbsp;with&nbsp;backend&nbsp;frameworks&nbsp;such&nbsp;as&nbsp;<strong>Node.js</strong>,&nbsp;<strong>Express</strong>,&nbsp;or&nbsp;<strong>Python/Django</strong>&nbsp;to&nbsp;build&nbsp;robust,&nbsp;scalable&nbsp;solutions.</li><li>Collaborate&nbsp;with&nbsp;team&nbsp;members&nbsp;to&nbsp;design&nbsp;and&nbsp;implement&nbsp;new&nbsp;features.</li><li>Utilize&nbsp;<strong>Git</strong>&nbsp;for&nbsp;version&nbsp;control,&nbsp;ensuring&nbsp;smooth&nbsp;collaboration&nbsp;and&nbsp;code&nbsp;management&nbsp;across&nbsp;the&nbsp;team.</li><li>Troubleshoot,&nbsp;debug,&nbsp;and&nbsp;optimize&nbsp;web&nbsp;applications&nbsp;for&nbsp;performance.</li><li>Participate&nbsp;in&nbsp;code&nbsp;reviews&nbsp;and&nbsp;gain&nbsp;exposure&nbsp;to&nbsp;industry&nbsp;best&nbsp;practices.</li></ul><h3>💡&nbsp;<strong>What&nbsp;You’ll&nbsp;Learn:</strong></h3><ul><li><strong>Full&nbsp;Stack&nbsp;Development</strong>:&nbsp;Experience&nbsp;working&nbsp;across&nbsp;both&nbsp;<strong>frontend</strong>&nbsp;and&nbsp;<strong>backend</strong>&nbsp;technologies.</li><li><strong>Git&nbsp;and&nbsp;GitHub</strong>:&nbsp;Master&nbsp;version&nbsp;control,&nbsp;branching,&nbsp;and&nbsp;collaboration&nbsp;workflows.</li><li><strong>Agile&nbsp;Practices</strong>:&nbsp;Work&nbsp;within&nbsp;an&nbsp;agile&nbsp;team&nbsp;environment&nbsp;and&nbsp;contribute&nbsp;to&nbsp;sprints.</li><li><strong>Industry-Standard&nbsp;Tools</strong>:&nbsp;Exposure&nbsp;to&nbsp;tools&nbsp;like&nbsp;<strong>VS&nbsp;Code</strong>,&nbsp;<strong>Docker</strong>,&nbsp;and&nbsp;cloud&nbsp;platforms&nbsp;(AWS,&nbsp;Azure,&nbsp;etc.).</li></ul><h3>✅&nbsp;<strong>Who&nbsp;You&nbsp;Are:</strong></h3><ul><li>A&nbsp;<strong>self-motivated</strong>&nbsp;learner&nbsp;with&nbsp;a&nbsp;passion&nbsp;for&nbsp;coding&nbsp;and&nbsp;web&nbsp;development.</li><li>Familiar&nbsp;with&nbsp;basic&nbsp;web&nbsp;technologies:&nbsp;<strong>HTML</strong>,&nbsp;<strong>CSS</strong>,&nbsp;<strong>JavaScript</strong>.</li><li>Experience&nbsp;with&nbsp;<strong>React</strong>&nbsp;(or&nbsp;similar&nbsp;frontend&nbsp;frameworks)&nbsp;and&nbsp;backend&nbsp;technologies&nbsp;(e.g.,&nbsp;<strong>Node.js</strong>,&nbsp;<strong>Express</strong>,&nbsp;<strong>Python</strong>).</li><li>A&nbsp;strong&nbsp;communicator&nbsp;who&nbsp;thrives&nbsp;in&nbsp;<strong>collaborative&nbsp;environments</strong>.</li><li>Familiarity&nbsp;with&nbsp;<strong>Git</strong>&nbsp;for&nbsp;version&nbsp;control,&nbsp;or&nbsp;a&nbsp;willingness&nbsp;to&nbsp;learn&nbsp;quickly.</li></ul><h3>🎯&nbsp;<strong>Why&nbsp;Join&nbsp;Us?</strong></h3><ul><li>Gain&nbsp;hands-on&nbsp;experience&nbsp;with&nbsp;a&nbsp;<strong>full&nbsp;stack</strong>&nbsp;tech&nbsp;stack&nbsp;in&nbsp;a&nbsp;real-world&nbsp;setting.</li><li>Mentorship&nbsp;from&nbsp;senior&nbsp;developers&nbsp;to&nbsp;help&nbsp;you&nbsp;grow.</li><li>Opportunity&nbsp;to&nbsp;contribute&nbsp;to&nbsp;meaningful&nbsp;projects&nbsp;and&nbsp;build&nbsp;your&nbsp;portfolio.</li><li>Flexible&nbsp;work&nbsp;environment&nbsp;(remote&nbsp;or&nbsp;in-office).</li></ul><p>🚀&nbsp;If&nbsp;you&#39;re&nbsp;ready&nbsp;to&nbsp;start&nbsp;your&nbsp;career&nbsp;in&nbsp;Full&nbsp;Stack&nbsp;Development&nbsp;and&nbsp;have&nbsp;a&nbsp;passion&nbsp;for&nbsp;learning&nbsp;new&nbsp;technologies,&nbsp;we&nbsp;want&nbsp;to&nbsp;hear&nbsp;from&nbsp;you!</p><p>Apply&nbsp;now:&nbsp;[Insert&nbsp;application&nbsp;link]</p><p>#FullStackDevelopment&nbsp;#Internship&nbsp;#JobOpening&nbsp;#WebDevelopment&nbsp;#SoftwareEngineering&nbsp;#Git&nbsp;#VersionControl&nbsp;#CodingInternship&nbsp;#TechCareers&nbsp;#RemoteWork</p>', 35000.00, 'Sri Lanka', 8, 'Remote', 'Part Time', '2024-12-24 21:09:17', 'Active'),
(5, 2, 'Technical Assistance', '<h3><strong>Technical&nbsp;Assistance&nbsp;Role</strong></h3><p>Are&nbsp;you&nbsp;passionate&nbsp;about&nbsp;providing&nbsp;technical&nbsp;support&nbsp;and&nbsp;ensuring&nbsp;seamless&nbsp;IT&nbsp;solutions&nbsp;for&nbsp;users?&nbsp;We&nbsp;are&nbsp;looking&nbsp;for&nbsp;a&nbsp;<strong>Technical&nbsp;Assistant</strong>&nbsp;to&nbsp;join&nbsp;our&nbsp;dynamic&nbsp;team&nbsp;and&nbsp;offer&nbsp;exceptional&nbsp;support&nbsp;in&nbsp;resolving&nbsp;technical&nbsp;issues.</p><h3><strong>About&nbsp;the&nbsp;Role</strong></h3><p>In&nbsp;this&nbsp;role,&nbsp;you&nbsp;will&nbsp;serve&nbsp;as&nbsp;the&nbsp;first&nbsp;point&nbsp;of&nbsp;contact&nbsp;for&nbsp;troubleshooting&nbsp;technical&nbsp;issues,&nbsp;guiding&nbsp;users&nbsp;through&nbsp;solutions,&nbsp;and&nbsp;ensuring&nbsp;efficient&nbsp;IT&nbsp;operations.&nbsp;You’ll&nbsp;collaborate&nbsp;with&nbsp;cross-functional&nbsp;teams&nbsp;to&nbsp;improve&nbsp;system&nbsp;performance&nbsp;and&nbsp;provide&nbsp;outstanding&nbsp;technical&nbsp;support.</p><h3><strong>Key&nbsp;Responsibilities</strong></h3><ul><li>Provide&nbsp;technical&nbsp;support&nbsp;for&nbsp;hardware,&nbsp;software,&nbsp;and&nbsp;network-related&nbsp;issues.</li><li>Diagnose&nbsp;and&nbsp;resolve&nbsp;technical&nbsp;problems&nbsp;efficiently&nbsp;and&nbsp;effectively.</li><li>Manage&nbsp;user&nbsp;requests,&nbsp;issues,&nbsp;and&nbsp;escalate&nbsp;when&nbsp;necessary.</li><li>Maintain&nbsp;and&nbsp;update&nbsp;IT&nbsp;documentation,&nbsp;including&nbsp;support&nbsp;guides&nbsp;and&nbsp;knowledge&nbsp;bases.</li><li>Collaborate&nbsp;with&nbsp;IT&nbsp;teams&nbsp;to&nbsp;improve&nbsp;system&nbsp;performance&nbsp;and&nbsp;security.</li><li>Ensure&nbsp;user&nbsp;satisfaction&nbsp;by&nbsp;delivering&nbsp;prompt&nbsp;and&nbsp;professional&nbsp;technical&nbsp;assistance.</li></ul><h3><strong>Required&nbsp;Skills</strong></h3><ul><li>Strong&nbsp;problem-solving&nbsp;and&nbsp;troubleshooting&nbsp;abilities.</li><li>Knowledge&nbsp;of&nbsp;computer&nbsp;systems,&nbsp;hardware,&nbsp;and&nbsp;software&nbsp;applications.</li><li>Familiarity&nbsp;with&nbsp;IT&nbsp;support&nbsp;tools&nbsp;and&nbsp;ticketing&nbsp;systems.</li><li>Excellent&nbsp;communication&nbsp;and&nbsp;interpersonal&nbsp;skills.</li><li>Ability&nbsp;to&nbsp;handle&nbsp;multiple&nbsp;tasks&nbsp;in&nbsp;a&nbsp;fast-paced&nbsp;environment.</li></ul><h3><strong>Preferred&nbsp;Qualifications</strong></h3><ul><li>Previous&nbsp;experience&nbsp;in&nbsp;a&nbsp;technical&nbsp;support&nbsp;or&nbsp;IT&nbsp;assistance&nbsp;role.</li><li>Familiarity&nbsp;with&nbsp;networking&nbsp;concepts,&nbsp;cybersecurity&nbsp;practices,&nbsp;and&nbsp;cloud&nbsp;services.</li><li>Relevant&nbsp;certifications&nbsp;(e.g.,&nbsp;CompTIA&nbsp;A+,&nbsp;Microsoft&nbsp;Certified&nbsp;Support&nbsp;Specialist).</li></ul><h3><strong>Why&nbsp;Join&nbsp;Us</strong></h3><ul><li><strong>Growth&nbsp;Opportunities</strong>:&nbsp;Continuous&nbsp;learning&nbsp;and&nbsp;development&nbsp;in&nbsp;the&nbsp;IT&nbsp;field.</li><li><strong>Collaborative&nbsp;Environment</strong>:&nbsp;Work&nbsp;alongside&nbsp;a&nbsp;dedicated&nbsp;team&nbsp;focused&nbsp;on&nbsp;providing&nbsp;outstanding&nbsp;support.</li><li><strong>Flexible&nbsp;Work&nbsp;Arrangements</strong>:&nbsp;Option&nbsp;for&nbsp;remote&nbsp;or&nbsp;hybrid&nbsp;work.</li></ul><h3><strong>&nbsp;Role</strong></h3><p>Are&nbsp;you&nbsp;passionate&nbsp;about&nbsp;providing&nbsp;technical&nbsp;support&nbsp;and&nbsp;ensuring&nbsp;seamless&nbsp;IT&nbsp;solutions&nbsp;for&nbsp;users?&nbsp;We&nbsp;are&nbsp;looking&nbsp;for&nbsp;a&nbsp;<strong>Technical&nbsp;Assistant</strong>&nbsp;to&nbsp;join&nbsp;our&nbsp;dynamic&nbsp;team&nbsp;and&nbsp;offer&nbsp;exceptional&nbsp;support&nbsp;in&nbsp;resolving&nbsp;technical&nbsp;issues.</p><h3><strong>About&nbsp;the&nbsp;Role</strong></h3><p>In&nbsp;this&nbsp;role,&nbsp;you&nbsp;will&nbsp;serve&nbsp;as&nbsp;the&nbsp;first&nbsp;point&nbsp;of&nbsp;contact&nbsp;for&nbsp;troubleshooting&nbsp;technical&nbsp;issues,&nbsp;guiding&nbsp;users&nbsp;through&nbsp;solutions,&nbsp;and&nbsp;ensuring&nbsp;efficient&nbsp;IT&nbsp;operations.&nbsp;You’ll&nbsp;collaborate&nbsp;with&nbsp;cross-functional&nbsp;teams&nbsp;to&nbsp;improve&nbsp;system&nbsp;performance&nbsp;and&nbsp;provide&nbsp;outstanding&nbsp;technical&nbsp;support.</p><h3><strong>Key&nbsp;Responsibilities</strong></h3><ul><li>Provide&nbsp;technical&nbsp;support&nbsp;for&nbsp;hardware,&nbsp;software,&nbsp;and&nbsp;network-related&nbsp;issues.</li><li>Diagnose&nbsp;and&nbsp;resolve&nbsp;technical&nbsp;problems&nbsp;efficiently&nbsp;and&nbsp;effectively.</li><li>Manage&nbsp;user&nbsp;requests,&nbsp;issues,&nbsp;and&nbsp;escalate&nbsp;when&nbsp;necessary.</li><li>Maintain&nbsp;and&nbsp;update&nbsp;IT&nbsp;documentation,&nbsp;including&nbsp;support&nbsp;guides&nbsp;and&nbsp;knowledge&nbsp;bases.</li><li>Collaborate&nbsp;with&nbsp;IT&nbsp;teams&nbsp;to&nbsp;improve&nbsp;system&nbsp;performance&nbsp;and&nbsp;security.</li><li>Ensure&nbsp;user&nbsp;satisfaction&nbsp;by&nbsp;delivering&nbsp;prompt&nbsp;and&nbsp;professional&nbsp;technical&nbsp;assistance.</li></ul><h3><strong>Required&nbsp;Skills</strong></h3><ul><li>Strong&nbsp;problem-solving&nbsp;and&nbsp;troubleshooting&nbsp;abilities.</li><li>Knowledge&nbsp;of&nbsp;computer&nbsp;systems,&nbsp;hardware,&nbsp;and&nbsp;software&nbsp;applications.</li><li>Familiarity&nbsp;with&nbsp;IT&nbsp;support&nbsp;tools&nbsp;and&nbsp;ticketing&nbsp;systems.</li><li>Excellent&nbsp;communication&nbsp;and&nbsp;interpersonal&nbsp;skills.</li><li>Ability&nbsp;to&nbsp;handle&nbsp;multiple&nbsp;tasks&nbsp;in&nbsp;a&nbsp;fast-paced&nbsp;environment.</li></ul><h3><strong>Preferred&nbsp;Qualifications</strong></h3><ul><li>Previous&nbsp;experience&nbsp;in&nbsp;a&nbsp;technical&nbsp;support&nbsp;or&nbsp;IT&nbsp;assistance&nbsp;role.</li><li>Familiarity&nbsp;with&nbsp;networking&nbsp;concepts,&nbsp;cybersecurity&nbsp;practices,&nbsp;and&nbsp;cloud&nbsp;services.</li><li>Relevant&nbsp;certifications&nbsp;(e.g.,&nbsp;CompTIA&nbsp;A+,&nbsp;Microsoft&nbsp;Certified&nbsp;Support&nbsp;Specialist).</li></ul><h3><strong>Why&nbsp;Join&nbsp;Us</strong></h3><ul><li><strong>Growth&nbsp;Opportunities</strong>:&nbsp;Continuous&nbsp;learning&nbsp;and&nbsp;development&nbsp;in&nbsp;the&nbsp;IT&nbsp;field.</li><li><strong>Collaborative&nbsp;Environment</strong>:&nbsp;Work&nbsp;alongside&nbsp;a&nbsp;dedicated&nbsp;team&nbsp;focused&nbsp;on&nbsp;providing&nbsp;outstanding&nbsp;support.</li><li><strong>Flexible&nbsp;Work&nbsp;Arrangements</strong>:&nbsp;Option&nbsp;for&nbsp;remote&nbsp;or&nbsp;hybrid&nbsp;work.</li></ul><p></p>', 80000.00, 'Colombo', 2, 'On-Site', 'Part Time', '2024-12-24 21:14:15', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `job_applicant`
--

DROP TABLE IF EXISTS `job_applicant`;
CREATE TABLE IF NOT EXISTS `job_applicant` (
  `job_id` int NOT NULL,
  `applicant` int NOT NULL,
  PRIMARY KEY (`job_id`,`applicant`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_applicant`
--

INSERT INTO `job_applicant` (`job_id`, `applicant`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `job_skill`
--

DROP TABLE IF EXISTS `job_skill`;
CREATE TABLE IF NOT EXISTS `job_skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int DEFAULT NULL,
  `skill` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_skill`
--

INSERT INTO `job_skill` (`id`, `job_id`, `skill`) VALUES
(1, 1, 'Web Development'),
(2, 1, 'UI/UX Designer'),
(3, 1, 'MongoDB'),
(4, 1, 'HTML 5'),
(5, 1, 'JavaScript'),
(6, 1, 'Jquery'),
(7, 2, 'Selenium'),
(8, 2, 'JUnit'),
(9, 2, 'Postman'),
(10, 2, 'Jira'),
(11, 2, 'AWS'),
(12, 2, 'Java Programming'),
(13, 2, 'Python Development'),
(14, 2, 'Docker'),
(15, 3, 'Web Developement'),
(16, 3, 'PHP'),
(17, 3, 'MySQL'),
(18, 3, 'UI/UX Designer'),
(19, 3, 'HTML 5'),
(20, 3, 'Jquery'),
(21, 3, 'JavaScript'),
(22, 4, 'Web Development'),
(23, 4, 'UI/UX Designer'),
(24, 4, 'MongoDB'),
(25, 4, 'Jquery'),
(26, 4, 'HTML 5'),
(27, 5, 'Web Development'),
(28, 5, 'UI/UX Designer'),
(29, 5, 'MongoDB'),
(30, 5, 'HTML 5'),
(31, 5, 'JavaScript'),
(32, 5, 'Jquery');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`post_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `send`, `recv`, `msg_data`, `date_time`, `msg_type`) VALUES
(1, 1, 2, '1', '2024-12-24 20:02:04', 'post'),
(2, 1, 7, '3', '2024-12-24 21:36:13', 'post');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `post_text` text NOT NULL,
  `post_source` varchar(255) DEFAULT 'N/A',
  `type` enum('new','copy') DEFAULT 'new',
  `posted_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `post_text`, `post_source`, `type`, `posted_at`) VALUES
(1, 1, '<p>🚀&nbsp;<strong>Master&nbsp;Web&nbsp;Development&nbsp;with&nbsp;W3Schools!</strong>&nbsp;🌐</p><p>Whether&nbsp;you&#39;re&nbsp;a&nbsp;beginner&nbsp;looking&nbsp;to&nbsp;dive&nbsp;into&nbsp;the&nbsp;world&nbsp;of&nbsp;web&nbsp;development&nbsp;or&nbsp;an&nbsp;experienced&nbsp;developer&nbsp;aiming&nbsp;to&nbsp;refresh&nbsp;your&nbsp;skills,&nbsp;W3Schools&nbsp;is&nbsp;a&nbsp;go-to&nbsp;resource&nbsp;for&nbsp;learning&nbsp;key&nbsp;technologies&nbsp;such&nbsp;as:</p><ul><li><strong>HTML</strong>:&nbsp;Building&nbsp;the&nbsp;structure&nbsp;of&nbsp;the&nbsp;web.</li><li><strong>CSS</strong>:&nbsp;Styling&nbsp;and&nbsp;creating&nbsp;visually&nbsp;stunning&nbsp;websites.</li><li><strong>JavaScript</strong>:&nbsp;Adding&nbsp;interactivity&nbsp;and&nbsp;dynamic&nbsp;behavior.</li><li><strong>Python</strong>:&nbsp;Backend&nbsp;programming&nbsp;for&nbsp;modern&nbsp;web&nbsp;applications.</li><li><strong>SQL</strong>:&nbsp;Managing&nbsp;and&nbsp;querying&nbsp;databases.</li><li><strong>And&nbsp;much&nbsp;more!</strong>&nbsp;🔥</li></ul><p>W3Schools&nbsp;offers&nbsp;interactive&nbsp;tutorials,&nbsp;coding&nbsp;examples,&nbsp;and&nbsp;certifications&nbsp;to&nbsp;help&nbsp;developers&nbsp;enhance&nbsp;their&nbsp;skills&nbsp;at&nbsp;their&nbsp;own&nbsp;pace.&nbsp;It&#39;s&nbsp;a&nbsp;fantastic&nbsp;way&nbsp;to&nbsp;stay&nbsp;ahead&nbsp;in&nbsp;an&nbsp;ever-evolving&nbsp;field.</p><p>Here’s&nbsp;why&nbsp;W3Schools&nbsp;stands&nbsp;out:&nbsp;✅&nbsp;<strong>Beginner-friendly</strong>:&nbsp;Easy-to-follow&nbsp;tutorials.&nbsp;✅&nbsp;<strong>Interactive&nbsp;Code&nbsp;Examples</strong>:&nbsp;Learn&nbsp;by&nbsp;doing!&nbsp;✅&nbsp;<strong>Free&nbsp;&amp;&nbsp;Accessible</strong>:&nbsp;Learn&nbsp;at&nbsp;your&nbsp;own&nbsp;pace,&nbsp;anytime,&nbsp;anywhere.&nbsp;✅&nbsp;<strong>Certificates</strong>:&nbsp;Earn&nbsp;credentials&nbsp;to&nbsp;showcase&nbsp;your&nbsp;skills&nbsp;to&nbsp;employers.</p><p>Check&nbsp;it&nbsp;out&nbsp;today&nbsp;and&nbsp;start&nbsp;building&nbsp;your&nbsp;web&nbsp;development&nbsp;journey&nbsp;from&nbsp;scratch!</p><p>#webdevelopment&nbsp;#programming&nbsp;#HTML&nbsp;#CSS&nbsp;#JavaScript&nbsp;#Python&nbsp;#SQL&nbsp;#LearnToCode&nbsp;#W3Schools</p>', 'post-1.jpg', 'new', '2024-12-24 19:59:35'),
(2, 1, '<p>🔧&nbsp;<strong>Boost&nbsp;Your&nbsp;Development&nbsp;Workflow&nbsp;with&nbsp;Git!</strong>&nbsp;🚀</p><p>As&nbsp;a&nbsp;developer,&nbsp;managing&nbsp;code&nbsp;changes&nbsp;efficiently&nbsp;and&nbsp;collaborating&nbsp;with&nbsp;teams&nbsp;is&nbsp;critical.&nbsp;That&#39;s&nbsp;where&nbsp;<strong>Git</strong>&nbsp;comes&nbsp;in!&nbsp;Git&nbsp;is&nbsp;a&nbsp;distributed&nbsp;version&nbsp;control&nbsp;system&nbsp;that&nbsp;allows&nbsp;developers&nbsp;to:</p><ul><li><strong>Track&nbsp;changes</strong>:&nbsp;Keep&nbsp;a&nbsp;record&nbsp;of&nbsp;every&nbsp;modification&nbsp;in&nbsp;your&nbsp;codebase,&nbsp;so&nbsp;you&nbsp;can&nbsp;always&nbsp;revert&nbsp;to&nbsp;earlier&nbsp;versions&nbsp;if&nbsp;needed.</li><li><strong>Collaborate&nbsp;seamlessly</strong>:&nbsp;Whether&nbsp;you’re&nbsp;working&nbsp;alone&nbsp;or&nbsp;with&nbsp;a&nbsp;team,&nbsp;Git&nbsp;makes&nbsp;it&nbsp;easier&nbsp;to&nbsp;merge&nbsp;code,&nbsp;track&nbsp;contributions,&nbsp;and&nbsp;resolve&nbsp;conflicts.</li><li><strong>Branching&nbsp;and&nbsp;merging</strong>:&nbsp;Git&nbsp;allows&nbsp;you&nbsp;to&nbsp;create&nbsp;branches&nbsp;for&nbsp;new&nbsp;features&nbsp;or&nbsp;bug&nbsp;fixes,&nbsp;without&nbsp;affecting&nbsp;the&nbsp;main&nbsp;codebase,&nbsp;and&nbsp;later&nbsp;merge&nbsp;them&nbsp;smoothly.</li></ul><p>Why&nbsp;you&nbsp;should&nbsp;use&nbsp;<strong>Git</strong>:&nbsp;🔹&nbsp;<strong>Efficiency</strong>:&nbsp;It&nbsp;handles&nbsp;large&nbsp;projects&nbsp;with&nbsp;ease&nbsp;and&nbsp;speed.&nbsp;🔹&nbsp;<strong>Collaboration</strong>:&nbsp;Git&nbsp;enables&nbsp;smooth&nbsp;collaboration&nbsp;across&nbsp;teams&nbsp;of&nbsp;any&nbsp;size.&nbsp;🔹&nbsp;<strong>Distributed</strong>:&nbsp;Every&nbsp;developer&nbsp;has&nbsp;a&nbsp;full&nbsp;local&nbsp;copy&nbsp;of&nbsp;the&nbsp;project&nbsp;history,&nbsp;allowing&nbsp;work&nbsp;to&nbsp;continue&nbsp;offline.&nbsp;🔹&nbsp;<strong>Open-source</strong>:&nbsp;It’s&nbsp;free,&nbsp;widely&nbsp;used,&nbsp;and&nbsp;supported&nbsp;by&nbsp;a&nbsp;vibrant&nbsp;community.</p><p>📈&nbsp;<strong>GitHub</strong>,&nbsp;<strong>GitLab</strong>,&nbsp;and&nbsp;<strong>Bitbucket</strong>&nbsp;are&nbsp;great&nbsp;platforms&nbsp;that&nbsp;complement&nbsp;Git,&nbsp;providing&nbsp;remote&nbsp;repositories&nbsp;and&nbsp;additional&nbsp;features&nbsp;like&nbsp;issue&nbsp;tracking,&nbsp;continuous&nbsp;integration,&nbsp;and&nbsp;more.</p><p>Mastering&nbsp;Git&nbsp;is&nbsp;a&nbsp;game&nbsp;changer&nbsp;for&nbsp;any&nbsp;developer—whether&nbsp;you&#39;re&nbsp;managing&nbsp;your&nbsp;own&nbsp;projects&nbsp;or&nbsp;contributing&nbsp;to&nbsp;open&nbsp;source.&nbsp;🚀</p><p>If&nbsp;you&nbsp;haven’t&nbsp;already,&nbsp;start&nbsp;learning&nbsp;Git&nbsp;today&nbsp;and&nbsp;elevate&nbsp;your&nbsp;development&nbsp;skills&nbsp;to&nbsp;the&nbsp;next&nbsp;level!</p><p>#Git&nbsp;#VersionControl&nbsp;#DevelopmentTools&nbsp;#Programming&nbsp;#SoftwareEngineering&nbsp;#Collaboration&nbsp;#OpenSource&nbsp;#DeveloperTools&nbsp;#CodeManagement</p>', 'post-2.jpg', 'new', '2024-12-24 20:23:22'),
(3, 1, '<p>🔧&nbsp;<strong>Boost&nbsp;Your&nbsp;Development&nbsp;Workflow&nbsp;with&nbsp;Git!</strong>&nbsp;🚀</p><p>As&nbsp;a&nbsp;developer,&nbsp;managing&nbsp;code&nbsp;changes&nbsp;efficiently&nbsp;and&nbsp;collaborating&nbsp;with&nbsp;teams&nbsp;is&nbsp;critical.&nbsp;That&#39;s&nbsp;where&nbsp;<strong>Git</strong>&nbsp;comes&nbsp;in!&nbsp;Git&nbsp;is&nbsp;a&nbsp;distributed&nbsp;version&nbsp;control&nbsp;system&nbsp;that&nbsp;allows&nbsp;developers&nbsp;to:</p><ul><li><strong>Track&nbsp;changes</strong>:&nbsp;Keep&nbsp;a&nbsp;record&nbsp;of&nbsp;every&nbsp;modification&nbsp;in&nbsp;your&nbsp;codebase,&nbsp;so&nbsp;you&nbsp;can&nbsp;always&nbsp;revert&nbsp;to&nbsp;earlier&nbsp;versions&nbsp;if&nbsp;needed.</li><li><strong>Collaborate&nbsp;seamlessly</strong>:&nbsp;Whether&nbsp;you’re&nbsp;working&nbsp;alone&nbsp;or&nbsp;with&nbsp;a&nbsp;team,&nbsp;Git&nbsp;makes&nbsp;it&nbsp;easier&nbsp;to&nbsp;merge&nbsp;code,&nbsp;track&nbsp;contributions,&nbsp;and&nbsp;resolve&nbsp;conflicts.</li><li><strong>Branching&nbsp;and&nbsp;merging</strong>:&nbsp;Git&nbsp;allows&nbsp;you&nbsp;to&nbsp;create&nbsp;branches&nbsp;for&nbsp;new&nbsp;features&nbsp;or&nbsp;bug&nbsp;fixes,&nbsp;without&nbsp;affecting&nbsp;the&nbsp;main&nbsp;codebase,&nbsp;and&nbsp;later&nbsp;merge&nbsp;them&nbsp;smoothly.</li></ul><p>Why&nbsp;you&nbsp;should&nbsp;use&nbsp;<strong>Git</strong>:&nbsp;🔹&nbsp;<strong>Efficiency</strong>:&nbsp;It&nbsp;handles&nbsp;large&nbsp;projects&nbsp;with&nbsp;ease&nbsp;and&nbsp;speed.&nbsp;🔹&nbsp;<strong>Collaboration</strong>:&nbsp;Git&nbsp;enables&nbsp;smooth&nbsp;collaboration&nbsp;across&nbsp;teams&nbsp;of&nbsp;any&nbsp;size.&nbsp;🔹&nbsp;<strong>Distributed</strong>:&nbsp;Every&nbsp;developer&nbsp;has&nbsp;a&nbsp;full&nbsp;local&nbsp;copy&nbsp;of&nbsp;the&nbsp;project&nbsp;history,&nbsp;allowing&nbsp;work&nbsp;to&nbsp;continue&nbsp;offline.&nbsp;🔹&nbsp;<strong>Open-source</strong>:&nbsp;It’s&nbsp;free,&nbsp;widely&nbsp;used,&nbsp;and&nbsp;supported&nbsp;by&nbsp;a&nbsp;vibrant&nbsp;community.</p><p>📈&nbsp;<strong>GitHub</strong>,&nbsp;<strong>GitLab</strong>,&nbsp;and&nbsp;<strong>Bitbucket</strong>&nbsp;are&nbsp;great&nbsp;platforms&nbsp;that&nbsp;complement&nbsp;Git,&nbsp;providing&nbsp;remote&nbsp;repositories&nbsp;and&nbsp;additional&nbsp;features&nbsp;like&nbsp;issue&nbsp;tracking,&nbsp;continuous&nbsp;integration,&nbsp;and&nbsp;more.</p><p>Mastering&nbsp;Git&nbsp;is&nbsp;a&nbsp;game&nbsp;changer&nbsp;for&nbsp;any&nbsp;developer—whether&nbsp;you&#39;re&nbsp;managing&nbsp;your&nbsp;own&nbsp;projects&nbsp;or&nbsp;contributing&nbsp;to&nbsp;open&nbsp;source.&nbsp;🚀</p><p>If&nbsp;you&nbsp;haven’t&nbsp;already,&nbsp;start&nbsp;learning&nbsp;Git&nbsp;today&nbsp;and&nbsp;elevate&nbsp;your&nbsp;development&nbsp;skills&nbsp;to&nbsp;the&nbsp;next&nbsp;level!</p><p>#Git&nbsp;#VersionControl&nbsp;#DevelopmentTools&nbsp;#Programming&nbsp;#SoftwareEngineering&nbsp;#Collaboration&nbsp;#OpenSource&nbsp;#DeveloperTools&nbsp;#CodeManagement</p>', 'post-3.jpg', 'new', '2024-12-24 20:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_title` (`title`)
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first`, `last`, `username`, `password`, `email`, `contact`, `gender`, `dob`, `address`, `profile`, `cover`, `nic`, `role`, `status`, `headline`, `show_school`) VALUES
(1, 'Saroath', 'Farvees', 'farvees', '123', 'farvees@gmail.com', '756720854', 'Female', '2001-01-01', '337/A, Central Road, Maligaikadu - West', 'profile-1.jpg', '2.jpg', '200112803638', 'seeker', 'None', 'Software Developer | DevOps | UI/UX Designer', 'show'),
(2, 'pramodya', 'pumal', 'pumal', '123', 'pumal@gmail.com', '754323765', 'Female', '2001-01-01', 'Pumal address somewhere', 'profile-2.jpg', '7.jpg', '200134209876', 'seeker', 'None', 'Game Developer | Content Writer | UI/UX Designer | Director of Legion', 'show'),
(3, 'sachini', 'dissanayeka', 'sachini', '123', 'sachini@gmail.com', '765482543', 'Male', '2001-01-01', 'Scahini home town at Kandy', 'profile-3.jpg', '4.jpg', '200134129854', 'seeker', 'None', 'Game Designer | Story Writer | Senior Analyst', 'show'),
(4, 'mohamed', 'ijas', 'ijas', '123', 'ijas@gmail.com', '752354123', 'Male', '2001-12-02', 'Anuradapura, khahattagasthigaliya', 'profile-4.jpg', 'default.jpg', '200123904523', 'admin', 'None', 'N/A', 'show'),
(6, 'Abdullah', 'Naleem', 'naleem', '123', 'naleem@gmail.com', '765434234', 'Female', '1998-01-01', 'Marudhana', 'profile-6.jpg', '5.jpg', '199813603212', 'seeker', 'None', 'UI/UX Designer | Web Developer | Software Developer', 'show'),
(7, 'Mohamed', 'Arthath', 'arthath', '123', 'arthath@gmail.com', '765467564', 'Female', '1999-01-01', 'Kinniya', 'profile-7.jpg', '1.jpg', '200132207876', 'seeker', 'None', 'Full Stack | DevOps', 'show'),
(8, 'Omila', 'Jayawardana', 'omila', '123', 'omila@gmail.com', '765498345', 'Female', '2001-01-01', 'Somewhere', 'Screenshot 2024-12-24 194018.png', '3.jpg', '200117803768', 'provider', 'None', 'Founder & CEO at Skills Internationals | Software Developer | Project Manager | DevOps', 'show'),
(9, 'Aashiq', 'Aathambawa', 'aashiq', '123', 'aashiq@gmail.com', '754521435', 'Female', '1992-02-03', 'Somewhere', 'profile-9.jpg', 'default.jpg', '19924351235V', 'provider', 'None', 'N/A', 'show');

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
(3, 'Jquery'),
(6, 'UI/UX Designer'),
(6, 'Web Development'),
(7, 'HTML 5'),
(8, 'HTML 5'),
(8, 'Java Programming'),
(8, 'JavaScript'),
(8, 'Jquery'),
(8, 'MongoDB'),
(8, 'MySQL DMBS'),
(8, 'Python Development'),
(8, 'Software Development'),
(8, 'UI/UX Designer'),
(8, 'Web Development');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
