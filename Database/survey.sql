SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17026,
  -- `level_` varchar(255) NOT NULL,
  -- `year_` varchar(255) DEFAULT NULL,
  -- `college` varchar(255) NOT NULL,
  -- `time_basis` varchar(255) NOT NULL,
  -- `campus` varchar(255) NOT NULL,
  `cr1` int(11) DEFAULT NULL,
  `cr2` int(11) DEFAULT NULL,
  `cr3` int(11) DEFAULT NULL,
  `cr4` int(11) DEFAULT NULL,
  `cr5` int(11) DEFAULT NULL,
  -- `org` text DEFAULT NULL,
  -- `follow_news` int(11) DEFAULT NULL,
  -- `regularly_discuss` int(11) DEFAULT NULL,
  -- `attend_workshops` int(11) DEFAULT NULL,
  -- `seen_opportunities` int(11) DEFAULT NULL,
  -- `regularly_use` int(11) DEFAULT NULL,
  -- `essential_for_success` int(11) DEFAULT NULL,
  -- `verify_accuracy` int(11) DEFAULT NULL,
  -- `positive_learning_experience` int(11) DEFAULT NULL,
  -- `negative_learning_experience` int(11) DEFAULT NULL,
  -- `outside_classwork` int(11) DEFAULT NULL,
  -- `turn_in_answer` int(11) DEFAULT NULL,
  -- `positive_social_issues_1` int(11) DEFAULT NULL,
  -- `personal_privacy` int(11) DEFAULT NULL,
  -- `more_transparent` int(11) DEFAULT NULL,
  -- `creativity_innovation` int(11) DEFAULT NULL,
  -- `trust_accuracy` int(11) DEFAULT NULL,
  -- `ethics_concern` int(11) DEFAULT NULL,
  -- `human_biases` int(11) DEFAULT NULL,
  -- `job_security` int(11) DEFAULT NULL,
  -- `interested_training` int(11) DEFAULT NULL,
  -- `lack_exposure` int(11) DEFAULT NULL,
  -- `professors_encourage` int(11) DEFAULT NULL,
  -- `seeking_opportunities` int(11) DEFAULT NULL,
  -- `sdsu_offers` int(11) DEFAULT NULL,
  -- `skeptical_benefits` int(11) DEFAULT NULL,
  -- `potential_solve_global` int(11) DEFAULT NULL,
  -- `essential_most_professions` int(11) DEFAULT NULL,
  -- `negative_creativity` int(11) DEFAULT NULL,
  -- `long_term_concerns` int(11) DEFAULT NULL,
  -- `unregulated_risk` int(11) DEFAULT NULL,
  -- `significant_career` int(11) DEFAULT NULL,
  -- `positive_social_issues_2` int(11) DEFAULT NULL,
  -- `questions_concerns` text DEFAULT NULL,
  -- `study_habits` text DEFAULT NULL,
  -- `future_role` text DEFAULT NULL,
  -- `resources_training` text DEFAULT NULL,
  -- `involve_students` text DEFAULT NULL,
  -- `chatgpt` int(11) DEFAULT NULL,
  -- `grammarly` int(11) DEFAULT NULL,
  -- `adobe` int(11) DEFAULT NULL,
  -- `dalle` int(11) DEFAULT NULL,
  -- `bard` int(11) DEFAULT NULL,
  -- `notion` int(11) DEFAULT NULL,
  -- `bing` int(11) DEFAULT NULL,
  -- `zoom` int(11) DEFAULT NULL,
  -- `github` int(11) DEFAULT NULL,
  -- `midjourney` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
