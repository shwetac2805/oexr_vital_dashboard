-- Drop the database if it already exists
DROP DATABASE IF EXISTS `survey_db`;

-- Create the database with the desired collation
CREATE DATABASE IF NOT EXISTS `survey_db`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- Use the newly created database
USE `survey_db`;

-- Set the necessary SQL mode and start a transaction
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Create the `survey` table with the desired collation
CREATE TABLE IF NOT EXISTS `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_ranking_1` int(11) DEFAULT NULL,
  `content_ranking_2` int(11) DEFAULT NULL,
  `content_ranking_3` int(11) DEFAULT NULL,
  `content_ranking_4` int(11) DEFAULT NULL,
  `content_ranking_5` int(11) DEFAULT NULL,
  `content_ranking_6` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert original data for "Content and User Interface Functionality Ranking"
INSERT INTO `survey` (`question`, `content_ranking_1`, `content_ranking_2`, `content_ranking_3`, `content_ranking_4`, `content_ranking_5`) VALUES
('Content and User Interface Functionality Ranking', 41, 42, 45, 19, 6),
('Content and User Interface Functionality Ranking', 34, 42, 32, 30, 15),
('Content and User Interface Functionality Ranking', 44, 24, 30, 36, 19),
('Content and User Interface Functionality Ranking', 4, 8, 21, 42, 78),
('Content and User Interface Functionality Ranking', 30, 37, 25, 26, 35);

-- Insert original data for "Collaboration and Contribution Functionality Ranking"
INSERT INTO `survey` (`question`, `content_ranking_1`, `content_ranking_2`, `content_ranking_3`, `content_ranking_4`, `content_ranking_5`, `content_ranking_6`) VALUES
('Collaboration and Contribution Functionality Ranking', 54, 33, 28, 22, 12, 2),
('Collaboration and Contribution Functionality Ranking', 36, 57, 16, 23, 13, 6),
('Collaboration and Contribution Functionality Ranking', 15, 19, 46, 31, 30, 10),
('Collaboration and Contribution Functionality Ranking', 7, 8, 9, 29, 46, 52),
('Collaboration and Contribution Functionality Ranking', 14, 12, 25, 14, 34, 52),
('Collaboration and Contribution Functionality Ranking', 25, 22, 27, 32, 16, 29);

INSERT INTO `survey` (`question`, `content_ranking_1`, `content_ranking_2`, `content_ranking_3`, `content_ranking_4`) VALUES
('What subscription model do you think would be most sustainable for the OEXR library', 83, 25, 21, 22),
('What subscription model do you think would be most sustainable for the OEXR library', 29, 62, 43, 17),
('What subscription model do you think would be most sustainable for the OEXR library', 26, 52, 59, 14),
('What subscription model do you think would be most sustainable for the OEXR library', 13, 12, 28, 98);

-- Create a stored procedure to fetch the content ranking data
DELIMITER //
CREATE PROCEDURE get_content_ranking_data(IN selected_question VARCHAR(255))
BEGIN
    SELECT
        question,
        COALESCE(content_ranking_1, 0) AS max,
        COALESCE(
            CASE
                WHEN content_ranking_6 IS NOT NULL THEN content_ranking_6
                WHEN content_ranking_5 IS NOT NULL THEN content_ranking_5
                WHEN content_ranking_4 IS NOT NULL THEN content_ranking_4
                ELSE NULL
            END,
            0
        ) AS min,
        (COALESCE(content_ranking_1, 0) + COALESCE(content_ranking_2, 0) + COALESCE(content_ranking_3, 0) + COALESCE(content_ranking_4, 0) + COALESCE(content_ranking_5, 0) + COALESCE(content_ranking_6, 0)) AS total_responses
    FROM survey
    WHERE question = selected_question;
END //
DELIMITER ;




-- End the transaction
COMMIT;

-- Reset the SQL mode to the default settings
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
