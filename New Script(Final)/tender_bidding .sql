-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2019 at 04:41 PM
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
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `surname`, `id_num`, `gender`, `email`, `contact_no`, `status`, `user_id`) VALUES
(1, 'jackson', 'kambule', 9709085739086, 'Male', 'jackson.k47@gmail.com', '0724966578', 'Approved', 4),
(2, 'xolani', 'jetmi', 6701096822091, 'Male', 'xolani@gmail.com', '0712243653', 'Approved', 12),
(3, 'senzo', 'atmost', 9708095678087, 'Male', 'senzo@gmail.com', '0724966578', 'Approved', 13),
(8, 'thembelani', 'shalule', 8608167476081, 'Male', 'peter@abasa.co.za', '836889937', 'Waiting Approval', 19);

-- --------------------------------------------------------

--
-- Table structure for table `bidder`
--

CREATE TABLE `bidder` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `id_num` bigint(13) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `company` varchar(25) NOT NULL,
  `industry` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidder`
--

INSERT INTO `bidder` (`id`, `name`, `surname`, `id_num`, `gender`, `company`, `industry`, `email`, `contact_no`, `user_id`) VALUES
(5, 'sanele', 'sithole', 9211095739086, 'Male', 'Reverside Technology', 'Infomation Technology', 'sanelesithole001@gmail.com', 724966578, 9),
(6, 'sbusiso', 'sithole', 8809115766087, 'Male', 'Adapt IT', 'Infomation Technology', 'sbusiso.sithole@adaptit.co.za', 812471082, 10),
(7, 'busisiwe', 'machai', 8601093438081, 'Female', 'Mayibuye Care', 'Health', 'busisiwe@care.co.za', 831237766, 11),
(8, 'Thabiso', 'sithole', 9210236658087, 'Male', 'Dev Technologies', 'Infomation Technology', 'thabiso@gmail.com', 817423341, 14);

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
(7, '2019-09-20', 250000.00, 'Won', 6, 'TBS/19-XHD'),
(8, '2019-09-20', 120000.00, 'Won', 7, 'TBS/19-JTY'),
(9, '2019-09-24', 210000.00, 'Bidded', 5, 'TBS/19-NLQ'),
(12, '2019-09-25', 1200000.00, 'Bidded', 6, 'TBS/19-WNJ'),
(13, '2019-09-25', 1400000.00, 'Won', 5, 'TBS/19-WNJ'),
(15, '2019-09-30', 200000.00, 'Bidded', 5, 'TBS/19-XHD');

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
(98, 'Admin', 'BusiMc', 'Cogratulation You have just been awarded a tender,<a href=\" bidstats.php\">Clic here to check the awarde bids</a>', '26/10/2019', '04:11:05'),
(99, 'Admin', 'SanzaTs', 'Cogratulation You have just been awarded a tender,<a href=\" bidstats.php\">Clic here to check the awarde bids</a>', '26/10/2019', '04:11:05'),
(100, 'Admin', 'Sbudda', 'Cogratulation You have just been awarded a tender,<a href=\" bidstats.php\">Clic here to check the awarde bids</a>', '26/10/2019', '04:11:05');

-- --------------------------------------------------------

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
('TBS/19-LUB', 'RDP Construction', 'Build RDP Houses', 'Gauteng government is looking for constr.uction company who will  build RDP Houses at Soshsanguve ', 'Construction', '2019-10-18', 200000.00, 10000000.00, 1),
('TBS/19-NLQ', 'IT Supply ', 'Supply IT Gadget', 'ABSA is looking for company to supply IT Equipment for our new branch and other upcoming branch for the next 5 years.If interested please place your bid and the highest will be awarded', 'Infomation Technology', '2019-10-31', 100000.00, 2000000.00, 1),
('TBS/19-SQK', 'IT Migration', 'Migrating OLD with New', 'We need IT consultant who are going to offer us migration from our legacy system to  ERP Systems  and maintain it during the pilot phase till phase out', 'Infomation Technology', '2019-10-29', 1000000.00, 4000000.00, 1),
('TBS/19-WNJ', 'IT Maintainance', 'Provide IT Mantainance', 'We invite IT Companies to make a bid to be our contract mantainance for the next 2 years .', 'Infomation Technology', '2019-09-25', 1000000.00, 600000.00, 1),
('TBS/19-XHD', 'Software Consultant', 'Payroll System', 'Department of Labour is looking for a Software Development company who is going to implement the Departments payroll system as the current has been rejected based on many problems.', 'Infomation Technology', '2019-10-26', 200000.00, 4000000.00, 1),
('TBS/19-YWX', 'IT Outsourcing', 'Built In-House Systems', 'SARS is looking for a software development company to take part in a project for building our new system.', 'Infomation Technology', '2019-10-16', 180000.00, 4000000.00, 1),
('TBS/19-ZGD', 'IT Audit', 'Risk management', 'We need it campany who is going to offer us their service for risk management  and fra', 'Infomation Technology', '2019-10-31', 1000000.00, 6000000.00, 1);

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
(13, 'atmost', 'password', 'Admin', '2019-09-28', 'offline'),
(14, 'Thabzin', 'password', 'Bidder', '2019-09-30', 'offline'),
(19, 'Peters', 'password', 'Admin', '2019-10-26', 'online');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bidder`
--
ALTER TABLE `bidder`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bidding`
--
ALTER TABLE `bidding`
  MODIFY `bid_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
