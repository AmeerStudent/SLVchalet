-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 11:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `icnumber` int(11) NOT NULL,
  `username` text NOT NULL,
  `full_name` text NOT NULL,
  `gender` text NOT NULL,
  `email` text NOT NULL,
  `phone_num` text NOT NULL,
  `password` text NOT NULL,
  `user_type` text NOT NULL,
  `profile_pic` text NOT NULL,
  `address` text NOT NULL,
  `acc_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`icnumber`, `username`, `full_name`, `gender`, `email`, `phone_num`, `password`, `user_type`, `profile_pic`, `address`, `acc_status`) VALUES
(2147483647, 'system', 'administrator', 'Male', 'wwee@gmail.com', '01234543212', '$2y$10$PnFmUPfE3cQVwb417he4Q.XctRyBbWEROvgShy3GzboKD9dD8lF2i', '', 'profile.png', '', 'Unverified'),
(2147483647, 'systemflower', 'administrator', 'Male', 'wweeeee@gmail.com', '01234543212', '$2y$10$ZQkDSUFzrhZ.Y90UY81aNuNNuUa15Rr/d/if832S/bC2LHrTC8zv.', '', 'profile.png', 'no 21 jalan 28 taman kluang barat', 'Unverified'),
(2147483647, 'harapan', 'Ibtiqari taufail', 'Male', 'wwwwwwee@gmail.com', '1234563333', '$2y$10$n.5V2YcEhwjmtE6DWX8LWus8nz4wVZx5xp4E4UEnZAO18ks53TCfa', '', 'profile.png', 'no banyak jalan kaki taman permainan', 'Unverified'),
(2147483647, 'taufail123', 'abussi', 'Male', 'wweeeeeee@gmail.com', '01117736178', '$2y$10$0X.AvsVr2Mg5.dGaHX0iD.JLYf2.OX9SGyM9G0iKgR8tOUtpC2Gq2', '', 'profile.png', 'no 22 jalan kaki taman permainan', 'Unverified'),
(455454877, 'hared', 'ahmad', 'Male', 'ah@gmail.com', '0145487455', '$2y$10$fA7r/cpmXmlWKH5dIRw8EetrkZhz1aE9tY45.vyW7xM6xulFGLjxG', '', 'profile.png', 'skudai', ''),
(87726632, 'Hensem', 'Harith', 'Male', 'harith@gmail.com', '012388874', '$2y$10$z/qJewtk.U.ICXe6R5hc8u7.FL7VmhMEMQO5FZqQZIu94g/yGLwDe', '', 'profile.png', 'Pulai Indah , Johor Bharu', ''),
(8274747, 'harith', 'harith adham', 'Male', 'harith12@gmail.com', '027747474', '$2y$10$vIRs2xxzqmmidkGZ/fc5c.w3rRuK.aAfmkMznEq7d9CLvyP2614Gu', '', 'profile.png', 'tmn pulai', ''),
(2147483647, 'Red', 'SlepvyRed', 'Male', 'Red12@gmail.com', '015544878787', '$2y$10$vSu8tWz2lB2VW8lAOkP.k.eUyHdHPH/RtOarQuAHE8zuZqOe4JaLy', '', 'profile.png', 'Skudai, Johor', ''),
(1115454445, 'hared12', 'haredadham', 'Male', 'hared@gmail.com', '0115448774', '$2y$10$sIbIdRluw4yOEmNVODQiOO82g5cSioBe6uwfNmIfxQcLfpJZsxR0S', '', 'profile.png', 'mendapat', '');

-- --------------------------------------------------------

--
-- Table structure for table `pic_product`
--

CREATE TABLE `pic_product` (
  `product_id` int(11) NOT NULL,
  `pic_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pic_product`
--

INSERT INTO `pic_product` (`product_id`, `pic_name`) VALUES
(0, '16575613070.jpg'),
(0, '16575614900.jpg'),
(3, '16575615510.jpg'),
(9985, '16575616840.jpg'),
(652, '16575639040.jpg'),
(600, '16575646440.jpg'),
(1, '16575648020.jpg'),
(0, '16575723820.JPG'),
(2147483647, '16575730970.JPG'),
(0, '16575731530.jpg'),
(271, '16575737080.jpg'),
(6, '16575738200.jpg'),
(0, '16575765000.jpg'),
(0, '16575766230.jpg'),
(5, '16575769760.jpg'),
(0, '16575770080.jpg'),
(95193081, '16575778570.JPG'),
(740999, '16575809900.JPG'),
(3266, '16577330480.jpg'),
(3, '16578171620.jpg'),
(8, '16595918140.jpg'),
(9, '16595923640.jpg'),
(3, '16595930190.jpg'),
(0, '16601092670.jpg'),
(2147483647, '16601103260.jpg'),
(0, '16601105210.jpg'),
(3, '16601107720.jpg'),
(2147483647, '16601110020.jpg'),
(93100, '16890610370.jpeg'),
(3, '16890614300.jpeg'),
(0, '16890616210.jpeg'),
(0, '16890616211.jpeg'),
(0, '16890616980.jpeg'),
(0, '16890616981.jpeg'),
(42, '16890618440.jpeg'),
(6294453, '16890620620.jpeg'),
(6294453, '16890620621.jpeg'),
(0, '16890912280.jpeg'),
(292, '16891014960.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` text NOT NULL,
  `product_des` text NOT NULL,
  `type` text NOT NULL,
  `product_category` text NOT NULL,
  `product_date` date NOT NULL,
  `user_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_des`, `type`, `product_category`, `product_date`, `user_id`) VALUES
(292, 'Rock Climbing', 'Rock Climbing is a ........', 'Product', 'Others', '0000-00-00', 'Harapan'),
(6294453, 'Challet', 'River view Room - \r\nNo RIver view -', 'Product', 'Others', '0000-00-00', 'harapan');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(11) NOT NULL,
  `receipt_date` date NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `receipt_date`, `username`) VALUES
(0, '0000-00-00', 'ahmad'),
(3, '0000-00-00', 'Yaya'),
(4, '0000-00-00', 'Yaya'),
(6, '0000-00-00', 'amal'),
(26, '0000-00-00', 'hakim'),
(43, '0000-00-00', 'hakimm'),
(45, '0000-00-00', 'Adham'),
(627, '0000-00-00', 'hared'),
(9376, '0000-00-00', 'ahmad'),
(969535, '0000-00-00', 'mysara'),
(2147483647, '0000-00-00', 'hakimm');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `review_username` text NOT NULL,
  `review_content` text NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `var_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `username`, `var_product_id`, `product_id`, `quantity`) VALUES
(0, '', 10, 271, 8),
(0, '', 24, 3266, 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ic_staff` int(11) NOT NULL,
  `susername` text NOT NULL,
  `staff_name` text CHARACTER SET utf8 NOT NULL,
  `gender` text NOT NULL,
  `staff_email` text NOT NULL,
  `staff_phonenum` int(10) NOT NULL,
  `staff_password` text NOT NULL,
  `staff_type` text CHARACTER SET utf8 NOT NULL,
  `staff_address` text NOT NULL,
  `staff_profilepic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `matricid` int(11) NOT NULL,
  `username` text NOT NULL,
  `full_name` text NOT NULL,
  `gender` text NOT NULL,
  `email` text NOT NULL,
  `phone_num` text NOT NULL,
  `password` text NOT NULL,
  `user_type` text NOT NULL,
  `profile_pic` text NOT NULL,
  `address` text NOT NULL,
  `acc_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`matricid`, `username`, `full_name`, `gender`, `email`, `phone_num`, `password`, `user_type`, `profile_pic`, `address`, `acc_status`) VALUES
(2022780202, 'taufail', 'ibtiqari taufail', 'Male', 'thespiritwalker017@gmail.com', '01117736164', '$2y$10$CapDHl7G10jBz3GEPVaNUu73xbmMxiIwahMUlUcqcW1boIsxhf8uy', 'Student', '1657581815.png', 'Mahallah Al-Faruq', 'Verified'),
(1544548, 'am', 'adham', 'Male', 'am@gmail.com', '0111245745', '$2y$10$EzFNsZoFhTUOfHCZ7DQKgeI/bOSTPTyxf7WHEFAnTX.7yol97sldi', 'Staff', 'profile.png', 'skudai', 'Verified'),
(987736622, 'Amal', 'Amal Ahmad', 'Male', 'amal@gmail.com', '012455334', '$2y$10$64OXnrCwfs254xOyrjvxK.PDn9BZ4d1gDAFO.nJtlahOuKFGnRGs2', 'Staff', '1660111327.png', 'TAMAN DESA CEMERLANG', 'Unverified'),
(2147483647, 'Hared', 'Hared Adham', 'Male', 'hared@gmail.com', '011154874544', '$2y$10$oZqVcr8bKyiCCKDuHDDkVegeDt0YyIklAFlk2vJYrqsyVGcWF.o42', 'Staff', 'profile.png', 'Skudai', 'Unverified'),
(45454154, 'Adham', 'Harith Adham', 'Male', 'Red@gmail.com', '0115448774', '$2y$10$DFzFNXDrapA/PzePHkYfzuSiVxOdvjIS3STV7iAMp9qtaykhL6tD6', 'Staff', '1689065977.png', 'Sri Mendapat', 'Unverified'),
(2147483647, 'Harith', 'Harith Adha', 'Male', 'hared12@gmail.com', '0155454541', '$2y$10$8nHVKEvqO3TR7scZC8iuwuYP22HX3Rzbx6Z9ApTaBaE3woUxHZWDu', 'Staff', 'profile.png', 'Sri kembangan', 'Unverified'),
(2147483647, 'Adhamdanyel', 'Adhamdanyel', 'Male', 'adham12@gmail.com', '01226655555', '$2y$10$/rhxpw798kqLCVCKkTQ3R.uJ1JpnM/0PNMjn1TJMPF/i96/iWC8qK', 'Staff', '1689101682.png', 'melaka', 'Unverified'),
(1544010154, 'hared22', 'haredadham', 'Male', 'hared22@gmail.com', '0122588888', '$2y$10$8t1ByxI9Ow5b/pu12vbeoOes71QMcK9yed4J4UJuCyP7t3CfeeWmq', 'Staff', 'profile.png', 'skudai', 'Unverified'),
(2147483647, 'mysara', 'mysara', 'Female', 'mysara@gmail.com', '0145864487', '$2y$10$PBsiSe1WXbx4fdWKKxczRukzIp74D8oRa0Zidqnp2WmWB2CtlGs6S', 'Staff', 'profile.png', 'mendapat', 'Unverified');

-- --------------------------------------------------------

--
-- Table structure for table `var_product`
--

CREATE TABLE `var_product` (
  `product_id` int(11) NOT NULL,
  `var_product_id` int(11) NOT NULL,
  `var_product_title` text NOT NULL,
  `var_product_price` text NOT NULL,
  `var_product_quan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `var_product`
--

INSERT INTO `var_product` (`product_id`, `var_product_id`, `var_product_title`, `var_product_price`, `var_product_quan`) VALUES
(93100, 34, 'Long Climbing', '20', 0),
(93100, 35, 'Short Climbing', '15', 0),
(3, 36, 'River view', '120', 0),
(3, 37, 'No river view', '100', 0),
(0, 38, 'River View', '130', 10),
(0, 39, 'No River View', '100', 10),
(0, 40, 'River View', '120', 10),
(0, 41, 'No River View', '100', 10),
(42, 42, 'BBQ SET', '60', 0),
(6294453, 43, 'View River', '120', 1),
(6294453, 44, 'No River View', '100', 4),
(0, 45, 'BBQ SET', '50', 0),
(292, 46, 'Long Climbing', '15', 10),
(292, 47, 'Short Climbing', '10', 8);

-- --------------------------------------------------------

--
-- Table structure for table `var_receipt`
--

CREATE TABLE `var_receipt` (
  `product_id` int(11) NOT NULL,
  `product_title` text NOT NULL,
  `var_product_price` text NOT NULL,
  `var_product_title` text NOT NULL,
  `var_product_quan` int(11) NOT NULL,
  `var_seller` text NOT NULL,
  `status` text NOT NULL,
  `review_status` text NOT NULL,
  `username` text NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `notifcation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `var_receipt`
--

INSERT INTO `var_receipt` (`product_id`, `product_title`, `var_product_price`, `var_product_title`, `var_product_quan`, `var_seller`, `status`, `review_status`, `username`, `receipt_id`, `notifcation`) VALUES
(3266, '3NA6124', '15000', '1', 1, 'harapan', 'Pending', 'NO', 'hakim', 0, 'Pending'),
(9, 'zrl1000p', '750', '1', 1, 'harapan', 'Pending', 'NO', 'amal', 6, 'Pending'),
(8, '6SE6440-2UD17-5AA1', '2000', '2', 1, 'harapan', 'Pending', 'NO', 'hared', 4763, 'Pending'),
(6294453, 'Challet', '120', 'View River', 2, 'harapan', 'Pending', 'NO', 'hared', 627, 'Pending'),
(42, 'BBQ ', '60', 'BBQ SET', 1, 'harapan', 'Pending', 'NO', 'Adham', 45, 'Pending'),
(6294453, 'Challet', '120', 'View River', 2, 'harapan', 'Pending', 'NO', 'Harith', 0, 'Pending'),
(6294453, 'Challet', '100', 'No River View', 1, 'harapan', 'Pending', 'NO', 'Harith', 3, 'Pending'),
(292, 'Rock Climbing', '10', 'Short Climbing', 2, 'Harapan', 'Pending', 'NO', 'mysara', 969535, 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`);

--
-- Indexes for table `var_product`
--
ALTER TABLE `var_product`
  ADD PRIMARY KEY (`var_product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `var_product`
--
ALTER TABLE `var_product`
  MODIFY `var_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
