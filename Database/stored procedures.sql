### Stored procedures

DELIMITER $$
CREATE DEFINER=`dgoldberg`@`localhost` PROCEDURE `new_user`(user_id CHAR(36), name VARCHAR(100), email VARCHAR(100), institution VARCHAR(100), role VARCHAR(100), interest VARCHAR(100))
INSERT INTO users VALUES (user_id, name, email, institution, role, interest)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`dgoldberg`@`localhost` PROCEDURE `queries_log`()
SELECT l.*, u.name, u.email, u.institution, u.role, u.interest FROM log l LEFT JOIN users u ON l.user_id = u.user_id ORDER BY l.request_id asc$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`dgoldberg`@`localhost` PROCEDURE `user_interaction`(IN question VARCHAR(100), level_ VARCHAR(100), year_ VARCHAR(100), college VARCHAR(100), residency VARCHAR(100), time_basis VARCHAR(100), campus VARCHAR(100), living VARCHAR(100), age VARCHAR(100), smart_devices VARCHAR(100), ip_address VARCHAR(100), request_time DATETIME, user_id CHAR(36))
INSERT INTO log (question, level_, year_, college, residency, time_basis, campus, living, age, smart_devices, ip_address, request_time, user_id) VALUES (question, level_, year_, college, residency, time_basis, campus, living, age, smart_devices, ip_address, request_time, user_id)$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`dgoldberg`@`localhost` PROCEDURE `users_log`()
SELECT u.*, COUNT(l.request_id) AS request_count FROM users u JOIN log l ON u.user_id = l.user_id GROUP BY u.user_id ORDER BY request_count DESC$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`dgoldberg`@`localhost` PROCEDURE `validate_user`(_user_id CHAR(36))
select count(*) as count
from users
where user_id = _user_id$$
DELIMITER ;

### NOTE: This stored procedure is a representative example. For every question in the survey, there is a corresponding generic stored procedure. This represents the Òattend_workshopsÓ question.

DELIMITER $$
CREATE DEFINER=`dgoldberg`@`localhost` PROCEDURE `generic_attend_workshops`()
select attend_workshops as question, count(attend_workshops) as count
from survey
where attend_workshops > 0
group by attend_workshops
order by attend_workshops asc$$
DELIMITER ;

### NOTE: This stored procedure is a representative example. For every question in the survey, there is a corresponding filtered stored procedure. This represents the Òattend_workshopsÓ question.

DELIMITER $$
CREATE DEFINER=`dgoldberg`@`localhost` PROCEDURE `filtered_attend_workshops`(IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))
select attend_workshops as question, count(attend_workshops) as count
from survey
where attend_workshops > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by attend_workshops
order by attend_workshops asc$$
DELIMITER ;
