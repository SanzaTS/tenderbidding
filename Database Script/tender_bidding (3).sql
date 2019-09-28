-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2019 at 10:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tender_bidding`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `id_num` bigint(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `surname`, `id_num`, `email`, `contact_no`, `user_id`) VALUES
(1, 'jackson', 'kambule', 1234567890123, 'jackson.k47@gmail.com', '0724966578', 4),
(2, 'xolani', 'jetmi', 6701094822091, 'xolani@gmail.com', '0712243653', 12),
(3, 'senzo', 'atmost', 9708095678087, 'senzo@gmail.com', '0724966578', 13);

-- --------------------------------------------------------

--
-- Table structure for table `bidder`
--

CREATE TABLE `bidder` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `id_num` int(13) NOT NULL,
  `company` varchar(25) NOT NULL,
  `industry` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidder`
--

INSERT INTO `bidder` (`id`, `name`, `surname`, `id_num`, `company`, `industry`, `email`, `contact_no`, `user_id`) VALUES
(5, 'sanele', 'sithole', 2147483647, 'Reverside Technology', 'Infomation Technology', 'sanelesithole001@gmail.com', 724966578, 9),
(6, 'sbusiso', 'sithole', 2147483647, 'Adapt IT', 'Infomation Technology', 'sbusiso.sithole@adaptit.co.za', 812471082, 10),
(7, 'busisiwe', 'machai', 2147483647, 'Mayibuye Care', 'Health', 'busisiwe@care.co.za', 831237766, 11);

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
--

CREATE TABLE `bidding` (
  `bid_no` int(10) NOT NULL,
  `bid_date` varchar(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `bidder_id` int(10) NOT NULL,
  `tender_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidding`
--

INSERT INTO `bidding` (`bid_no`, `bid_date`, `amount`, `status`, `bidder_id`, `tender_no`) VALUES
(6, '2019-09-20', 200000.00, 'Bidded', 6, 'TBS/19-NLQ'),
(7, '2019-09-20', 250000.00, 'Bidded', 6, 'TBS/19-XHD'),
(8, '2019-09-20', 120000.00, 'Bidded', 7, 'TBS/19-JTY'),
(9, '2019-09-24', 210000.00, 'Bidded', 5, 'TBS/19-NLQ'),
(12, '2019-09-25', 1200000.00, 'Bidded', 6, 'TBS/19-WNJ'),
(13, '2019-09-25', 1400000.00, 'Won', 5, 'TBS/19-WNJ');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `mid` int(11) NOT NULL,
  `sender` varchar(30) NOT NULL,
  `reciever` varchar(30) NOT NULL,
  `Msg` varchar(250) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`mid`, `sender`, `reciever`, `Msg`, `date`, `time`) VALUES
(1, 'Admin', 'SanzaTs', 'Hey man are you good', '28/09/2019', '01:23:43'),
(2, 'Sbudda', 'Admin', 'Sho', '28/09/2019', '02:45:44'),
(5, 'Admin', 'SanzaTs', 'Cogratulation You have just been awarded a tender,<a href=\" bidstats.php\">Click here to check the awarde bids</a>', '28/09/2019', '08:33:35'),


--
-- Table structure for table `tender`
--

CREATE TABLE `tender` (
  `tenderId` varchar(15) NOT NULL,
  `tender_title` varchar(20) NOT NULL,
  `short_description` varchar(50) NOT NULL,
  `full_description` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `due_date` varchar(10) NOT NULL,
  `min_budget` double(10,2) NOT NULL,
  `max_budget` double(10,2) NOT NULL,
  `admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender`
--

INSERT INTO `tender` (`tenderId`, `tender_title`, `short_description`, `full_description`, `category`, `due_date`, `min_budget`, `max_budget`, `admin_id`) VALUES
('TBS/19-JAI', 'Tourism', 'Provide B&B', 'The tender is to provide  tourist with B&B ', 'Hospitality', '2019-10-01', 100000.00, 4000000.00, 1),
('TBS/19-JTY', 'HEALTH Supplier', 'Supply Hospital with medi', 'The bid is to supply hospital across Gauteng forthe next 2 years', 'Health', '2019-10-24', 20000.00, 4000000.00, 1),
('TBS/19-NLQ', 'IT Supply ', 'Supply IT Gadget', 'ABSA is looking for company to supply IT Equipment for our new branch and other upcoming branch for the next 5 years.If interested please place your bid and the highest will be awarded', 'Infomation Technology', '2019-10-31', 100000.00, 2000000.00, 1),
('TBS/19-WNJ', 'IT Maintainance', 'Provide IT Mantainance', 'We invite IT Companies to make a bid to be our contract mantainance for the next 2 years .', 'Infomation Technology', '2019-09-25', 1000000.00, 600000.00, 1),
('TBS/19-XHD', 'Software Consultant', 'Payroll System', 'Department of Labour is looking for a Software Development company who is going to implement the Departments payroll system as the current has been rejected based on many problems.', 'Infomation Technology', '2019-10-26', 200000.00, 4000000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL,
  `createdAt` varchar(10) NOT NULL,
  `Active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `createdAt`, `Active`) VALUES
(4, 'Admin', 'password', 'Admin', '2019-08-19', 'online'),
(9, 'SanzaTs', 'password', 'Bidder', '2019-08-22', 'offline'),
(10, 'Sbudda', 'password', 'Bidder', '2019-08-22', 'offline'),
(11, 'BusiMc', 'password', 'Bidder', '2019-08-23', 'offlline'),
(12, 'jetmi', 'password', 'Admin', '2019-09-28', 'offline'),
(13, 'atmost', 'password', 'Admin', '2019-09-28', 'offline');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bidder`
--
ALTER TABLE `bidder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bidding`
--
ALTER TABLE `bidding`
  ADD PRIMARY KEY (`bid_no`),
  ADD KEY `bidder_id` (`bidder_id`),
  ADD KEY `tender_no` (`tender_no`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `tender`
--
ALTER TABLE `tender`
  ADD PRIMARY KEY (`tenderId`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bidder`
--
ALTER TABLE `bidder`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bidding`
--
ALTER TABLE `bidding`
  MODIFY `bid_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bidder`
--
ALTER TABLE `bidder`
  ADD CONSTRAINT `bidder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bidding`
--
ALTER TABLE `bidding`
  ADD CONSTRAINT `bidding_ibfk_1` FOREIGN KEY (`bidder_id`) REFERENCES `bidder` (`id`),
  ADD CONSTRAINT `bidding_ibfk_2` FOREIGN KEY (`tender_no`) REFERENCES `tender` (`tenderId`);

--
-- Constraints for table `tender`
--
ALTER TABLE `tender`
  ADD CONSTRAINT `tender_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
