-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 07:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propose`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `email` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mode` varchar(11) NOT NULL,
  `type` int(5) NOT NULL,
  `otp` int(6) NOT NULL,
  `business` varchar(20) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `company` varchar(20) NOT NULL,
  `about` varchar(255) NOT NULL,
  `pictures` varchar(255) NOT NULL DEFAULT 'default_avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `status`, `title`, `fname`, `contact`, `email`, `gender`, `address`, `password`, `mode`, `type`, `otp`, `business`, `job_title`, `company`, `about`, `pictures`) VALUES
(1, 'Active now', '', 'admin', '', 'admin@admin.com', 'Male', 'San Juan (Pob.)', 'admin', '', 0, 0, '', '', '', '', 'default_avatar.png'),
(2, 'Active now', '', 'Ace Malto', '09876587654', 'acemalto28@gmail.com', 'Male', 'San Juan (Pob.)', 'acemalto', 'work', 1, 0, '', '', '', '', 'ace.jpg'),
(3, 'Offline now', '', 'Mark Limpo', '09876587657', 'limpomark26@gmail', 'Male', 'San Juan (Pob.)', 'marklimpo', 'user', 1, 0, '', '', '', '', 'default_avatar.png'),
(4, 'Offline now', '', 'Aldon Rodriguez', '09869987654', 'aldon@gmail.com', 'Male', 'San Juan (Pob.)', 'aldon', 'user', 1, 0, '', '', '', '', 'default_avatar.png'),
(5, 'Active now', '', 'Dianne Binucas', '09876548765', 'dianne@gmail.com', 'Female', 'Agnas (San Miguel Island)', 'dianne', 'work', 1, 0, '', '', '', '', 'default_avatar.png'),
(6, 'Offline now', '', 'Ivy Toledo', '09876897654', 'ivytoledo@gmail.com', 'Female', 'Agnas (San Miguel Island)', 'ivytoledo', 'user', 1, 0, '', '', '', '', 'default_avatar.png'),
(7, 'Offline now', '', 'James Bond', '09876876547', 'james@gmail.com', 'Male', 'Bangkilingan', 'jamesbond', 'user', 1, 0, '', '', '', '', 'default_avatar.png'),
(8, 'Offline now', '', 'Macey Devera', '09876543765', 'macey@gmail.com', 'Female', 'Bantayan', 'maceydevera', 'work', 1, 0, '', '', '', '', 'default_avatar.png'),
(9, 'Offline now', '', 'Shuhaily Casan', '09876548765', 'shuhaily@gmail.com', 'Male', 'Bogñabong', 'shuhaily', 'work', 1, 0, '', '', '', '', 'default_avatar.png'),
(10, 'Active now', '', 'Nicky Palero', '09876598765', 'nickypalero@gmail.com', 'Male', 'Baranghawon', 'nickypalero', 'work', 1, 0, '', '', '', '', 'default_avatar.png'),
(11, 'Offline now', '', 'De Vera', '09398765435', 'devera@gmail.com', 'Male', 'eh', 'devera', '', 2, 0, 'Acee D Store', '', '', 'None', 'default_avatar.png'),
(12, 'Active now', '', 'Lim uy', '09098765487', 'lim@gmail.com', 'Male', 'Basagan', '123456', '', 2, 0, 'Lim Parts', '', '', '', 'default_avatar.png'),
(13, 'Offline now', '', 'Gemmy Borneo', '09876547654', 'gemmys@gmail.com', 'Female', 'Tabiguian', '123456', '', 2, 0, 'Gemmy Candles', '', '', '', 'default_avatar.png'),
(14, 'Offline now', '', 'Jackson Torre', '09876547865', 'jackson@gmail.com', 'Male', 'Mariroc', '123456', '', 2, 0, 'Jack Tabak', '', '', '', 'default_avatar.png'),
(15, 'Offline now', '', 'Mike Miller', '09876587654', 'miller@gmail.com', 'Male', 'Bangkilingan', '123456', '', 3, 0, '', '', 'Recruiter BPO', '', 'default_avatar.png'),
(16, 'Offline now', '', 'Arriane Asis', '09876578654', 'arriane22@gmail.com', 'Female', 'Salvacion', '123456', '', 3, 0, '', '', 'HR - Amando Cope', '', 'default_avatar.png'),
(17, 'Offline now', '', 'Veldad', '09098765465', 'veldad@gmail.com', 'Male', 'Albay', '123456', '', 3, 0, '', '', 'Hr - Concentrixs', '', '1919364616.jpg'),
(18, 'Offline now', '', 'selvin', '09876548765', 'melvin@gmail.com', 'Male', 'Cormidal', '123456', '', 3, 0, '', '', 'Hr - Accenture', '', 'default_avatar.png'),
(19, '', '', 'admin1', '', 'admin1@admin.com', '', '', 'admin1', '', 0, 0, '', '', '', '', 'default_avatar.png'),
(20, '', '', 'admin2', '', 'admin2@admin.com', '', '', 'admin2', '', 0, 0, '', '', '', '', 'default_avatar.png'),
(21, '', '', 'admin3', '', 'admin3@admin.com', '', '', 'admin3', '', 0, 0, '', '', '', '', 'default_avatar.png'),
(22, 'Offline now', '', 'Kant Lim', '12335347464', 'kant@gmail.com', 'Male', 'Baranghawon', 'kant', 'work', 1, 0, '', '', '', '', 'default_avatar.png'),
(23, 'Offline now', '', 'Kant Lim', '12335347464', 'kant@gmail.com', 'Male', 'Baranghawon', 'kant', 'work', 1, 0, '', '', '', '', 'default_avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
