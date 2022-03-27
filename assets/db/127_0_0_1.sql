-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2022 at 03:44 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `policyDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fullname`, `username`, `password`, `group_id`) VALUES
(1, 'admin 1', 'admin1', 'admin1', 2),
(2, 'admin 2', 'admin2', 'admin2', 2),
(3, 'admin 3', 'admin3', 'admin3', 2),
(4, 'admin 4', 'admin4', 'admin4', 2),
(5, 'admin 5', 'admin5', 'admin5', 3);

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
  `approved` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `policyGroup`
--

CREATE TABLE `policyGroup` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `policyGroup`
--

INSERT INTO `policyGroup` (`group_id`, `group_name`) VALUES
(1, 'Accounting'),
(2, 'IT'),
(3, 'Finance'),
(4, 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `policyReviews`
--

CREATE TABLE `policyReviews` (
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
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `policyGroup`
--
ALTER TABLE `policyGroup`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `policyReviews`
--
ALTER TABLE `policyReviews`
  ADD PRIMARY KEY (`review_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `policy_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `policyGroup`
--
ALTER TABLE `policyGroup`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `policyReviews`
--
ALTER TABLE `policyReviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;