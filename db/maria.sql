-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2018 at 05:46 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maria`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrative`
--

CREATE TABLE `administrative` (
  `aid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrative`
--

INSERT INTO `administrative` (`aid`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cateogory`
--

CREATE TABLE `cateogory` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `cat_description` varchar(200) NOT NULL,
  `cat_created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cateogory`
--

INSERT INTO `cateogory` (`cat_id`, `cat_name`, `cat_description`, `cat_created_at`) VALUES
(10, 'Jersey', '', '2018-10-30'),
(11, 'Fleece', '', '2018-10-30'),
(13, 'Twill', '', '2018-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `c_payment`
--

CREATE TABLE `c_payment` (
  `pay_id` int(11) NOT NULL,
  `invoiceno` varchar(200) NOT NULL,
  `customerid` varchar(200) NOT NULL,
  `payamount` varchar(200) NOT NULL,
  `paymentdate` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL DEFAULT 'cp'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_payment`
--

INSERT INTO `c_payment` (`pay_id`, `invoiceno`, `customerid`, `payamount`, `paymentdate`, `token`) VALUES
(9, '20181030143026', '4', '1000', '2018-10-30', 'cp');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `p_id` int(11) NOT NULL,
  `pro_id` varchar(200) NOT NULL,
  `pro_name` varchar(200) NOT NULL,
  `product_cat` varchar(200) NOT NULL,
  `unit` int(200) NOT NULL,
  `opening_stock` varchar(200) NOT NULL,
  `purchase_price` varchar(200) NOT NULL,
  `selling_price` varchar(200) NOT NULL,
  `re_order_warning` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`p_id`, `pro_id`, `pro_name`, `product_cat`, `unit`, `opening_stock`, `purchase_price`, `selling_price`, `re_order_warning`, `description`, `created_at`) VALUES
(8, 'J01', 'Single jersey', '10', 0, '100', '180', '190', '10', '', '2018-10-30'),
(9, 'J02', 'Double jersey', '10', 0, '100', '300', '320', '10', '', '2018-10-30'),
(10, 'J03', 'Interlock Jersey', '10', 0, '150', '150', '180', '10', '', '2018-10-30'),
(11, 'T01', 'Cotton Twill', '13', 0, '500', '200', '220', '20', '', '2018-10-30'),
(12, 'T02', 'Poly Twill', '13', 0, '500', '150', '180', '20', '', '2018-10-30'),
(13, 'R401', 'Clean Nammy', '13', 0, '400', '500', '550', '30', '', '2018-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseid` int(11) NOT NULL,
  `billchallan` varchar(200) NOT NULL,
  `purchasedate` varchar(200) NOT NULL,
  `supplier` varchar(200) NOT NULL,
  `productid` varchar(200) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `payment_taka` varchar(200) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `purchaseentryby` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL DEFAULT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseid`, `billchallan`, `purchasedate`, `supplier`, `productid`, `quantity`, `price`, `payment_taka`, `discount`, `purchaseentryby`, `token`) VALUES
(17, '20181030142155', '2018-10-30', '5', 'J01', '150', '180', '25000', '0', '1', 'p'),
(18, '20181115175119', '2018-11-15', '5', 'J02', '450', '300', '134500', '500', '', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `pr_id` int(11) NOT NULL,
  `memono` varchar(200) NOT NULL,
  `productid` varchar(200) NOT NULL,
  `supplierId` varchar(200) NOT NULL,
  `quntity` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `discount` int(200) DEFAULT '0',
  `return_date` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL DEFAULT 'pr'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_return`
--

INSERT INTO `purchase_return` (`pr_id`, `memono`, `productid`, `supplierId`, `quntity`, `price`, `discount`, `return_date`, `token`) VALUES
(14, '20181030142155', 'J01', '5', '50', '180', 0, '2018-10-30', 'pr');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sellid` int(11) NOT NULL,
  `selldate` varchar(200) NOT NULL,
  `billchallan` varchar(200) NOT NULL,
  `customerid` varchar(200) NOT NULL,
  `productid` varchar(200) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `weight` varchar(200) NOT NULL,
  `transport` varchar(200) NOT NULL,
  `vat` varchar(200) NOT NULL,
  `payment_taka` varchar(200) NOT NULL,
  `comission` varchar(200) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `sellby` int(200) NOT NULL,
  `token` varchar(200) NOT NULL DEFAULT 's'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sellid`, `selldate`, `billchallan`, `customerid`, `productid`, `quantity`, `price`, `weight`, `transport`, `vat`, `payment_taka`, `comission`, `discount`, `sellby`, `token`) VALUES
(25, '2018-10-30', '20181030143026', '4', 'J01', '70', '200', '', '', '', '13000', '', '0', 0, 's'),
(26, '2018-11-14', '20181114231025', '4', 'J02', '500', '300', '', '', '', '149500', '', '500', 0, 's'),
(27, '2018-11-15', '2018111572450', '4', 'T02', '50', '580', '', '', '', '28500', '', '500', 0, 's'),
(28, '2018-11-15', '2018111515943', '4', 'T02', '100', '580', '', '', '', '57500', '', '500', 0, 's'),
(29, '2018-11-15', '20181115151036', '4', 'J03', '120', '580', '', '', '', '69100', '', '500', 0, 's'),
(30, '2018-11-15', '20181115175315', '4', 'T01', '200', '230', '', '', '', '45500', '', '500', 0, 's'),
(31, '2018-11-15', '20181115221734', '4', 'J03', '25', '580', '', '', '', '14000', '', '500', 0, 's');

-- --------------------------------------------------------

--
-- Table structure for table `sell_return`
--

CREATE TABLE `sell_return` (
  `sr_id` int(11) NOT NULL,
  `memono` varchar(200) NOT NULL,
  `customerid` varchar(200) NOT NULL,
  `productid` varchar(200) NOT NULL,
  `quntity` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `discount` int(200) DEFAULT '0',
  `return_date` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL DEFAULT 'sr'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sell_return`
--

INSERT INTO `sell_return` (`sr_id`, `memono`, `customerid`, `productid`, `quntity`, `price`, `discount`, `return_date`, `token`) VALUES
(13, '20181030143026', '4', 'J01', '20', '200', 0, '2018-10-30', 'sr');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `unit_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_description`) VALUES
(0, 'Pound', ''),
(0, 'KG', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_number` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `employeetype` varchar(200) NOT NULL,
  `opening_balance` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `user_role`, `name`, `password`, `email`, `contact_number`, `address`, `employeetype`, `opening_balance`, `created_at`) VALUES
(2, 'Choose option', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', '01735623513', 'feni\r\nfeni2', 'Choose option', '0', '2018-10-24'),
(4, '1', 'Jakia', 'e10adc3949ba59abbe56e057f20f883e', 'jakia@gmail.com', '01674837906', 'Dhaka', '0', '1000', '2018-10-30'),
(5, '2', 'Kashif', 'e10adc3949ba59abbe56e057f20f883e', 'kashif@gmail.cpm', '01678954367', 'Dhaka', '0', '3000', '2018-10-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrative`
--
ALTER TABLE `administrative`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `cateogory`
--
ALTER TABLE `cateogory`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `c_payment`
--
ALTER TABLE `c_payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseid`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sellid`);

--
-- Indexes for table `sell_return`
--
ALTER TABLE `sell_return`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrative`
--
ALTER TABLE `administrative`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cateogory`
--
ALTER TABLE `cateogory`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `c_payment`
--
ALTER TABLE `c_payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sellid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sell_return`
--
ALTER TABLE `sell_return`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
