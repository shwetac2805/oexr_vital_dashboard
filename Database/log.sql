SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2286,
  `user_id` char(36) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `request_time` datetime NOT NULL,
  `question` varchar(100) DEFAULT NULL,
  `level_` varchar(100) DEFAULT NULL,
  `year_` varchar(100) DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `time_basis` varchar(100) DEFAULT NULL,
  `campus` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `residency` varchar(100) DEFAULT NULL,
  `living` varchar(100) DEFAULT NULL,
  `smart_devices` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
