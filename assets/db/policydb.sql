-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2022 at 03:43 PM
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
  `moderator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `grade`, `fullname`, `username`, `password`, `group_id`, `email`, `moderator_id`) VALUES
(1, 'Admin', 'الرئيس الاول', 'Admin1', '12345678', 1, 'admin1@site.com', 1),
(2, 'Admin', 'الرئيس الثاني', 'admin2', '12345678', 1, 'admin2@site.com', 1),
(3, 'Admin', 'الرئيس الثالث', 'admin3', '12345678', 1, 'admin3@site.com', 1),
(4, 'Admin', 'الرئيس الرابع', 'admin4', '12345678', 1, 'admin4@site.com', 1),
(5, 'Head', 'Head', 'head1', '12345678', 1, 'Head@site.com', 1),
(7, 'Executive', 'CEO', 'CEO', '12345678', 1, 'CEO@site.com', 1);

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
  `moderator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `fullname`, `email`, `username`, `password`, `group_id`, `moderator_id`) VALUES
(1, 'ساره', 'sara@hotmail.com', 'sara', '12345678', 1, 1),
(2, 'نوف', 'ha2@yahoo.com', 'Nouf', '12345678', 1, 1);

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
(1, 'mod', 'mod');

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
  `sendToExec` int(11) NOT NULL DEFAULT '0',
  `approvedByExtuctive` int(11) NOT NULL DEFAULT '0',
  `extuctiveReview` text,
  `published` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policy_id`, `title`, `description`, `publish_date`, `admin_id`, `group_id`, `approved`, `sendToHead`, `headReview`, `sendToExec`, `approvedByExtuctive`, `extuctiveReview`, `published`) VALUES
(3, 'سياسة استخدام الايميل', 'السياسات التي ينبغي مراعاتها لاستخدام البريد الإلكتروني من أجل الحفاظ على الخصوصية والاستخدام الامثل للخدمة كالتالي:\r\n\r\nالتحلي بحُسن التقدير فيما يختص بمعقولية الاستخدام الشخصي للبريد الالكتروني.\r\n\r\nعدم ممارسة في أية أنشطة غير قانونية كالاختراق، والدخول غير المصرح به، أو التسبب بإدخال ما يضر بالحواسيب أو إدخال الفيروسات، أو القيام بتصرفات من شأنها التسبب في تعطيل استخدام البريد الالكتروني والتي قد يعاقب عليها النظام.\r\n\r\nيرجى الحفاظ على عدم تضمين البريد الالكتروني بالمحتوى الغير مرغوب فيه والضار والتصيد ومن الأمثلة على المحتوى أو السلوك غير المرغوب فيه:\r\n\r\n استخدام معلومات أو مواد محمية بأنظمة الحماية الفكرية.\r\n\r\nاستخدام التصيد للمحاولة في التخفي في هوية كاذبة للحصول على بيانات المستخدمين الآخرين مثل كلمات المرور والتفاصيل المالية وأرقام الهوية الصادرة عن جهات حكومية.\r\n\r\nاستخدام البريد الإلكتروني لإنشاء أو توزيع أي هجوم، أو الرسائل التخريبية، بما في ذلك رسائل تتضمن تعليقات مسيئة عن العرق أو الجنس أو السن أو التوجه الجنسي، المواد الإباحية، والديني أو المعتقدات السياسية، أو الأصل القومي أو الإعاقة.\r\n\r\nإرسال رسائل إلكترونية غير مرحب بها أو تطوعية.\r\n\r\nإرسال رسائل أو صور مغرضة أو ذات محتوى تهديدي أو كل ما يشابه ذلك.\r\n\r\nإرسال رسائل إلكترونية تنتهك قانون CAN-SPAM أو أية قوانين أخرى لمكافحة المحتوى غير المرغوب فيه\r\n\r\nبيع أو تبادل أو نشر عناوين البريد الإلكتروني لأي شخص بدون موافقته.\r\n\r\nاستخدامoffice365 في تنفيذ مخططات احتيالية أو خداع المستخدمين بأية وسيلة أخرى\r\n\r\nإرسال رسائل غير مصرح بها عبر خوادم مفتوحة أو خوادم جهات خارجية.\r\n\r\nتوزيع برامج ضارة مثل الفيروسات والفيروسات المتنقلة ونقاط الخلل وأحصنة طروادة والملفات التالفة وأية عناصر أخرى من هذا القبيل ذات طبيعة تخريبية أو خداعية.\r\n\r\nفي حال حصولك على أي رسائل بريد الإلكتروني مشابه لهذا المحتوى يجب تبليغ هذا الأمر إلى عمادة تقنية المعلومات على الفور عبر بريد (infosec@mu.edu.sa) ليتم اتخاذ الاجراء اللازم.\r\n\r\nيجب عدم نقل المعلومات الشخصية أو إطلاع أية جهة أخرى عليها.\r\n\r\nعدم السماح للمستخدمين بتبادل أسماء المستخدمين وكلمات المرور فيما بينهم.\r\n\r\nعدم استخدام البريد الالكتروني الجامعي في الأنشطة التجارية، ما لم يصدر بشأنه موافقة الجهات المختصة في الجامعة.\r\n\r\nالحفاظ على خصوصية وسرية اسم المستخدم وكلمة مرور البريد الالكتروني، وتخصيصها وإستخدامها بصورة آمنة .\r\n\r\nالالتزام بالقواعد التي تنصح بها عمادة تقنية المعلومات عند اختيار كلمة المرور ، للاطلاع على القواعد اضغط هنا.\r\n\r\nفي حال وجود أي شك بانكشاف كلمة المرور يجب تغييرها فوراً و إبلاغ عمادة تقنية المعلومات عبر الخدمات الالكترونية (es.mu.edu.sa) يحق للمنسوب الاشتراك في المجموعات البريدية التي تحقق أهداف العمل وليس أهداف شخصية.\r\n\r\nيتم تعطيل بريد الموظف في حاله عدم استخدامه للبريد لمدة 90 يوماً.\r\n\r\nيتم حذف الموظف من كل المجموعات فور طي قيده من الجامعة.\r\n\r\nيسمح لمستخدمي البريد الالكتروني الجامعي الاستفادة من المميزات المتاحة في office 365 بغرض الإفادة منها لأهداف تخدم العمل الرسمي من النواحي الإدارية والأكاديمية والبحثية وخدمة المجتمع.\r\n\r\nيتم تقيد الاستخدام حسب قوانين المملكة المعمول بها مع عدم وضع صور مخالفة أو استخدام البريد أو تغيير البيانات الخاصة بالمستخدم من المعلومات\r\n\r\nالشخصية أو اسم المعرف أو صورة المعرف وما يتبعها من مسمى صور أو ما شابه ذلك إلى اي دلالات لا تتوافق مع سياسات وقوانين المملكة أو سياسات الجامعة المنشورة.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\nسياسة استخدام خدمة مركز الرسائل:\r\n\r\n \r\n\r\n-المناسبات التي برعاية معالي مدير الجامعة او سعادة وكيل الجامعة\r\n\r\n-المناسبات العامة سواء لأعضاء هيئة التدريس والموظفين، او بتوجيه من مدير الجامعة أو أصحاب السعادة وكلاء الجامعة أو من عمداء العمادات المساندة .\r\n\r\n- المناسبات المختصة بالطلاب او الطالبات الجامعة ، بتوجيه من معالي مدير الجـامعة او أصحاب السعادة وكلاء الجامعة .\r\n\r\n- التهنئة بالأعياد والمناسبات الوطنية الرسمية.\r\n\r\n- حفل التخرج.\r\n\r\n- التنبيهات و التوعية الأمنية.\r\n\r\n-رسائل تحديث الأنظمة الإلكترونية والإعلانات عن توقف الخدمات الإلكترونية للصيانة.\r\n\r\n-الاستبانات المجازة من معالي مدير الجامعة أو سعادة وكيل الجامعة للدراسات العليا والبحث العلمي.', '2022-05-14', 1, 1, 0, 0, NULL, 0, 0, NULL, 0);

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
(2, 'المالية'),
(3, 'التسويق');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `policy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `policygroup`
--
ALTER TABLE `policygroup`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
