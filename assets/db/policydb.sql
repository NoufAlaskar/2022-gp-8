-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2022 at 02:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `policydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `moderator_id` int(11) NOT NULL,
  `reset` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `grade`, `fullname`, `username`, `password`, `group_id`, `email`, `moderator_id`, `reset`) VALUES
(1, 'Admin', 'admin1', 'admin1', '$2y$10$baCCIMrcoO7H9jtofqMdiOHTuEnil3UemtU7fclM6iZJgNjNABaoG', 1, 'admin1@policies.com', 1, 1),
(2, 'Admin', 'admin2', 'admin2', '$2y$10$DKrmVmC9p72NEpw94x7LUuSJDr.cQwj8qy.qUrsg72QnS3jhGhY9O', 1, 'admin2@policies.com', 1, 1),
(3, 'Admin', 'admin3', 'admin3', '$2y$10$2piHJmVlyasuiDITdGhGUOWtxzUr.BkwPCkcB452MAZ9d7XIzWLv.', 1, 'admin3@policies.com', 1, 1),
(4, 'Admin', 'admin4', 'admin4', '$2y$10$pEBbZjaugCNo6qXfjF2jUOfScB4tXOPvWZqrfWPDM7sjRLYMwjZc6', 1, 'admin4@policies.com', 1, 1),
(7, 'Head', 'headIT', 'HeadIT', '$2y$10$zwTrOih91dVxJeXHfm3JNuKBSsbf1ngYqdD84TPhbJ.UDm0VuaPiG', 1, 'HeadIT@policies.com', 1, 1),
(8, 'Executive', 'CEO', 'CEO', '$2y$10$P4xQyKMYX9lYNb6b.fWYeOZ/Vzgt9aMUxS9H6y4kO/7Z4kn5QRxsO', 0, 'ceo@policies.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `moderator_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `reset` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `fullname`, `email`, `username`, `password`, `group_id`, `moderator_id`, `active`, `reset`) VALUES
(4, 'Reema', 'reema@policies.com', 'Reema', '$2y$10$XTtJaTtHWPgv6PsRUJ998uua4KpFyV3ymAbZJKrdwfW7X3A5Cf7nC', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `moderator_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`moderator_id`, `username`, `password`) VALUES
(1, 'mod1', '$2y$10$PjvtJj.X0C6lOUJ2JtllT.LLoigrv5jXRMbE8elwqdfrTwLaI9sv2');

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `policy_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `publish_date` date NOT NULL,
  `admin_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `sendToHead` int(11) NOT NULL DEFAULT '0',
  `headReview` text,
  `examSendToHead` int(11) NOT NULL DEFAULT '0',
  `examHeadReview` text,
  `sendToExec` int(11) NOT NULL DEFAULT '0',
  `approvedByExtuctive` int(11) NOT NULL DEFAULT '0',
  `extuctiveReview` text,
  `published` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policy_id`, `title`, `description`, `publish_date`, `admin_id`, `group_id`, `approved`, `sendToHead`, `headReview`, `examSendToHead`, `examHeadReview`, `sendToExec`, `approvedByExtuctive`, `extuctiveReview`, `published`) VALUES
(2, 'سياسة اختيار كلمة المرور', '1. فرض كلمة مرور قوية: يجب أن تكون كلمة المرور قوية وألا تتضمن في تركيبها الكلمات التي يسهل على الأخرين إيجادها.\r\n2. يجب تخزين كلمة المرور بطريقة آمنة تضمن عدم كشفها.\r\n3. الحفاظ على سرية كلمات المرور: يجب عدم مشاركة أو كشف كلمة المرور مع أي شخص لأي سبب من الأسباب.\r\n4. كلمات المرور الأولى (المؤقتة): يجب تغيير كلمات المرور الأولية للمستخدمين وفرض مدة انتهاء لصلاحيتها لإجبار المستخدم على تغييرها.\r\n6. يجب منع الولوج للأنظمة الداخلية والخاصة بعد 3 محاولات خاطئة خلال مدة زمنية لا تتجاوز 15 دقيقة. ويستمر المنع لمدة أقلها 30 دقيقة وأكثرها 3ساعات.\r\n7. يجب على المستخدم في حالة أن يشتبه أو يلاحظ وجود مشكلة أمنية أو أن كلمة المرور الخاصة به قد تعرضت للاختراق الإبلاغ عن الحادث وتغيير جميع كلمات المرور.\r\n8. يجب أن يُطلب من المستخدمين التوقيع على بيان للحفاظ على سرية كلمات المرور الشخصية؛ يمكن تضمين هذا البيان في شروط التوظيف.\r\n9. يجب أن يكون المستخدم على علم ودراية أنه المسؤول الوحيد عن حماية كلمة السر/المرور الخاصة به.', '2022-11-08', 1, 1, 1, 1, 'جيدة\r\n', 0, 'الاختبار ممتاز', 1, 1, 'تم الاعتماد', 1);

-- --------------------------------------------------------

--
-- Table structure for table `policyexamresult`
--

CREATE TABLE `policyexamresult` (
  `result_id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `result` int(11) NOT NULL,
  `exam_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policyexamresult`
--

INSERT INTO `policyexamresult` (`result_id`, `policy_id`, `employee_id`, `result`, `exam_date`) VALUES
(1, 1, 1, 90, '2022-10-21'),
(2, 1, 1, 50, '2022-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `policygroup`
--

CREATE TABLE `policygroup` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policygroup`
--

INSERT INTO `policygroup` (`group_id`, `group_name`) VALUES
(1, 'تقنية المعلومات'),
(2, 'الموارد البشرية'),
(3, 'المالية'),
(4, 'التسويق');

-- --------------------------------------------------------

--
-- Table structure for table `policyreaded`
--

CREATE TABLE `policyreaded` (
  `read_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `read_date` date NOT NULL,
  `acknowledge` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policyreaded`
--

INSERT INTO `policyreaded` (`read_id`, `employee_id`, `policy_id`, `read_date`, `acknowledge`) VALUES
(2, 4, 2, '2022-11-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `policyreviews`
--

CREATE TABLE `policyreviews` (
  `review_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1',
  `publishedDate` date NOT NULL,
  `policy_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policyreviews`
--

INSERT INTO `policyreviews` (`review_id`, `comment`, `published`, `publishedDate`, `policy_id`, `admin_id`, `group_id`) VALUES
(4, 'جيدة', 1, '2022-11-08', 2, 2, 1),
(5, 'ممتازة', 1, '2022-11-08', 2, 3, 1),
(6, 'رائعة', 1, '2022-11-08', 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `total_mark` int(11) NOT NULL DEFAULT '10',
  `policy_id` int(11) NOT NULL DEFAULT '1',
  `answer1` varchar(255) NOT NULL,
  `answer2` varchar(255) NOT NULL,
  `answer3` varchar(255) NOT NULL,
  `answer4` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `hidden` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `number`, `title`, `total_mark`, `policy_id`, `answer1`, `answer2`, `answer3`, `answer4`, `correct_answer`, `hidden`) VALUES
(11, 1, 'ماهي كلمة المرور التي تعتبر قوية؟', 10, 2, 'Nouf123', '123456', '0000', 'Sfiu$&f12jjn', '4', 0),
(12, 2, 'السؤال الثاني', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '3', 0),
(13, 3, 'السؤال الثالث', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '3', 0),
(14, 4, 'السؤال الرابع', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '2', 0),
(15, 5, 'السؤال الخامس', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '4', 0),
(16, 6, 'السؤال السادس', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '4', 0),
(17, 7, 'السؤال السابع', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '4', 0),
(18, 8, 'السؤال الثامن', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '4', 0),
(19, 9, 'السؤال التاسع', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '4', 0),
(20, 10, 'السؤال الاخير', 10, 2, 'الخيار الاول', 'الخيار الثاني', 'الخيار الثالث', 'الخيار الرابع', '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `violation`
--

CREATE TABLE `violation` (
  `violation_id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `violation_text` text NOT NULL,
  `violation_date` date NOT NULL,
  `v_status` int(11) NOT NULL DEFAULT '1' COMMENT '1-new, 2-solved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`moderator_id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `policyexamresult`
--
ALTER TABLE `policyexamresult`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `policygroup`
--
ALTER TABLE `policygroup`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `policyreaded`
--
ALTER TABLE `policyreaded`
  ADD PRIMARY KEY (`read_id`);

--
-- Indexes for table `policyreviews`
--
ALTER TABLE `policyreviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `violation`
--
ALTER TABLE `violation`
  ADD PRIMARY KEY (`violation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `policy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `policyexamresult`
--
ALTER TABLE `policyexamresult`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `policygroup`
--
ALTER TABLE `policygroup`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `policyreaded`
--
ALTER TABLE `policyreaded`
  MODIFY `read_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `policyreviews`
--
ALTER TABLE `policyreviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `violation`
--
ALTER TABLE `violation`
  MODIFY `violation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
