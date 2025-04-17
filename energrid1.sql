-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 07:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `energrid`
--

-- --------------------------------------------------------

--
-- Table structure for table `automation events`
--

CREATE TABLE `automation events` (
  `id` int(11) NOT NULL,
  `room` varchar(100) NOT NULL,
  `time` time NOT NULL,
  `action` varchar(255) NOT NULL,
  `icon` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_user` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `energy_limit` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_name`, `energy_limit`, `created_at`) VALUES
(1, 'ac', 5, '2025-04-14 12:04:17'),
(2, 'tv', 6, '2025-04-14 12:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `device_usage`
--

CREATE TABLE `device_usage` (
  `id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `today_usage` decimal(5,2) NOT NULL,
  `yesterday_usage` decimal(5,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device_usage`
--

INSERT INTO `device_usage` (`id`, `device_name`, `today_usage`, `yesterday_usage`, `date`) VALUES
(1, 'AC', 3.20, 2.50, '2025-04-16'),
(2, 'Fridge', 1.50, 1.40, '2025-04-16'),
(3, 'Washing Machine', 0.80, 0.60, '2025-04-16'),
(4, 'Lights', 1.20, 1.00, '2025-04-16'),
(5, 'fan', 3.90, 5.60, '2025-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `emissions`
--

CREATE TABLE `emissions` (
  `id` int(11) NOT NULL,
  `month` varchar(20) NOT NULL,
  `total_emissions` float NOT NULL,
  `reduction_goal_percent` int(11) NOT NULL,
  `offset_percent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emissions`
--

INSERT INTO `emissions` (`id`, `month`, `total_emissions`, `reduction_goal_percent`, `offset_percent`) VALUES
(1, 'April 2025', 1600, 10, 20),
(2, 'Jan 2025', 3200, 10, 20),
(3, 'Feb 2025', 2900, 10, 25),
(4, 'Mar 2025', 3100, 15, 22),
(5, 'Apr 2025', 2700, 20, 30),
(6, 'May 2025', 2600, 25, 35),
(7, 'Jun 2025', 2500, 25, 40),
(8, 'Jul 2025', 2400, 30, 45);

-- --------------------------------------------------------

--
-- Table structure for table `emission_sources`
--

CREATE TABLE `emission_sources` (
  `id` int(11) NOT NULL,
  `source_name` varchar(50) NOT NULL,
  `amount_kg` float NOT NULL,
  `percentage` int(11) NOT NULL,
  `icon` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emission_sources`
--

INSERT INTO `emission_sources` (`id`, `source_name`, `amount_kg`, `percentage`, `icon`) VALUES
(1, 'Electricity', 680, 42, '🔵'),
(2, 'Lighting', 320, 20, '💡'),
(3, 'Supplies', 280, 17, '📦'),
(4, 'Machinery', 220, 14, '⚙️');

-- --------------------------------------------------------

--
-- Table structure for table `energy_limits`
--

CREATE TABLE `energy_limits` (
  `id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `energy_limit` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faults`
--

CREATE TABLE `faults` (
  `id` int(11) NOT NULL,
  `device` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `fault_type` varchar(255) NOT NULL,
  `severity` varchar(255) NOT NULL,
  `detected_at` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faults`
--

INSERT INTO `faults` (`id`, `device`, `location`, `fault_type`, `severity`, `detected_at`, `status`) VALUES
(1, 'Smoke Detector D4', 'Hallway', 'Sensor Failure', 'Critical', '2025-04-15 12:41:07', ''),
(2, 'HVAC Sensor A1', 'Lobby', 'Overheating', 'High', '2025-04-15 12:42:53', ''),
(5, 'Smoke Detector D4', 'Hallway', 'Sensor Failure', 'Critical', '2025-04-15 12:41:07', '');

-- --------------------------------------------------------

--
-- Table structure for table `insights`
--

CREATE TABLE `insights` (
  `id` int(11) NOT NULL,
  `insight_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insights`
--

INSERT INTO `insights` (`id`, `insight_text`) VALUES
(1, 'Optimize HVAC schedule'),
(2, 'Spikes from weekend usage'),
(3, 'Switch to LED lighting'),
(4, 'Optimize HVAC schedule'),
(5, 'Spikes from weekend usage'),
(6, 'Switch to LED lighting');

-- --------------------------------------------------------

--
-- Table structure for table `manual_overrides`
--

CREATE TABLE `manual_overrides` (
  `id` int(11) NOT NULL,
  `temp` int(11) NOT NULL,
  `brightness` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fan_speed` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manual_overrides`
--

INSERT INTO `manual_overrides` (`id`, `temp`, `brightness`, `updated_at`, `fan_speed`) VALUES
(1, 38, 90, '2025-04-15 11:49:35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `id` int(11) NOT NULL,
  `temperature` float DEFAULT NULL,
  `humidity` float DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensor_data`
--

INSERT INTO `sensor_data` (`id`, `temperature`, `humidity`, `timestamp`) VALUES
(1, 25.3, 65.2, '2025-04-16 19:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `rule_name` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `rule_name`, `is_active`) VALUES
(1, 'Auto AC', 1),
(2, 'Auto Fan', 0),
(3, 'Auto Brightness', 1);

-- --------------------------------------------------------

--
-- Table structure for table `voice_chat_settings`
--

CREATE TABLE `voice_chat_settings` (
  `id` int(11) NOT NULL,
  `mic_mode` varchar(50) NOT NULL,
  `chat_assistant` tinyint(1) NOT NULL,
  `tts_enabled` tinyint(1) NOT NULL,
  `voice_language` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voice_chat_settings`
--

INSERT INTO `voice_chat_settings` (`id`, `mic_mode`, `chat_assistant`, `tts_enabled`, `voice_language`, `updated_at`) VALUES
(7, 'Push-to-talk', 1, 1, 'German', '2025-04-15 20:58:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automation events`
--
ALTER TABLE `automation events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_usage`
--
ALTER TABLE `device_usage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emissions`
--
ALTER TABLE `emissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emission_sources`
--
ALTER TABLE `emission_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `energy_limits`
--
ALTER TABLE `energy_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faults`
--
ALTER TABLE `faults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insights`
--
ALTER TABLE `insights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_overrides`
--
ALTER TABLE `manual_overrides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voice_chat_settings`
--
ALTER TABLE `voice_chat_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automation events`
--
ALTER TABLE `automation events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `device_usage`
--
ALTER TABLE `device_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emissions`
--
ALTER TABLE `emissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `emission_sources`
--
ALTER TABLE `emission_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `energy_limits`
--
ALTER TABLE `energy_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faults`
--
ALTER TABLE `faults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `insights`
--
ALTER TABLE `insights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manual_overrides`
--
ALTER TABLE `manual_overrides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sensor_data`
--
ALTER TABLE `sensor_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voice_chat_settings`
--
ALTER TABLE `voice_chat_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
