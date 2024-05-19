CREATE PROCEDURE filtered_too_complex (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select too_complex as question, count(too_complex) as count
from survey
where too_complex > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by too_complex
order by too_complex asc;

CREATE PROCEDURE filtered_follow_news (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select follow_news as question, count(follow_news) as count
from survey
where follow_news > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by follow_news
order by follow_news asc;

CREATE PROCEDURE filtered_regularly_discuss (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select regularly_discuss as question, count(regularly_discuss) as count
from survey
where regularly_discuss > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by regularly_discuss
order by regularly_discuss asc;

CREATE PROCEDURE filtered_attend_workshops (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select attend_workshops as question, count(attend_workshops) as count
from survey
where attend_workshops > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by attend_workshops
order by attend_workshops asc;

CREATE PROCEDURE filtered_seen_opportunities (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select seen_opportunities as question, count(seen_opportunities) as count
from survey
where seen_opportunities > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by seen_opportunities
order by seen_opportunities asc;

CREATE PROCEDURE filtered_regularly_use (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select regularly_use as question, count(regularly_use) as count
from survey
where regularly_use > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by regularly_use
order by regularly_use asc;

CREATE PROCEDURE filtered_essential_for_success (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select essential_for_success as question, count(essential_for_success) as count
from survey
where essential_for_success > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by essential_for_success
order by essential_for_success asc;

CREATE PROCEDURE filtered_verify_accuracy (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select verify_accuracy as question, count(verify_accuracy) as count
from survey
where verify_accuracy > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by verify_accuracy
order by verify_accuracy asc;

CREATE PROCEDURE filtered_positive_learning_experience (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select positive_learning_experience as question, count(positive_learning_experience) as count
from survey
where positive_learning_experience > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by positive_learning_experience
order by positive_learning_experience asc;

CREATE PROCEDURE filtered_negative_learning_experience (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select negative_learning_experience as question, count(negative_learning_experience) as count
from survey
where negative_learning_experience > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by negative_learning_experience
order by negative_learning_experience asc;

CREATE PROCEDURE filtered_outside_classwork (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select outside_classwork as question, count(outside_classwork) as count
from survey
where outside_classwork > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by outside_classwork
order by outside_classwork asc;

CREATE PROCEDURE filtered_turn_in_answer (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select turn_in_answer as question, count(turn_in_answer) as count
from survey
where turn_in_answer > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by turn_in_answer
order by turn_in_answer asc;

CREATE PROCEDURE filtered_positive_social_issues_1 (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select positive_social_issues_1 as question, count(positive_social_issues_1) as count
from survey
where positive_social_issues_1 > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by positive_social_issues_1
order by positive_social_issues_1 asc;

CREATE PROCEDURE filtered_personal_privacy (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select personal_privacy as question, count(personal_privacy) as count
from survey
where personal_privacy > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by personal_privacy
order by personal_privacy asc;

CREATE PROCEDURE filtered_more_transparent (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select more_transparent as question, count(more_transparent) as count
from survey
where more_transparent > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by more_transparent
order by more_transparent asc;

CREATE PROCEDURE filtered_creativity_innovation (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select creativity_innovation as question, count(creativity_innovation) as count
from survey
where creativity_innovation > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by creativity_innovation
order by creativity_innovation asc;

CREATE PROCEDURE filtered_trust_accuracy (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select trust_accuracy as question, count(trust_accuracy) as count
from survey
where trust_accuracy > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by trust_accuracy
order by trust_accuracy asc;

CREATE PROCEDURE filtered_ethics_concern (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select ethics_concern as question, count(ethics_concern) as count
from survey
where ethics_concern > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by ethics_concern
order by ethics_concern asc;

CREATE PROCEDURE filtered_human_biases (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select human_biases as question, count(human_biases) as count
from survey
where human_biases > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by human_biases
order by human_biases asc;

CREATE PROCEDURE filtered_job_security (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select job_security as question, count(job_security) as count
from survey
where job_security > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by job_security
order by job_security asc;

CREATE PROCEDURE filtered_interested_training (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select interested_training as question, count(interested_training) as count
from survey
where interested_training > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by interested_training
order by interested_training asc;

CREATE PROCEDURE filtered_lack_exposure (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select lack_exposure as question, count(lack_exposure) as count
from survey
where lack_exposure > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by lack_exposure
order by lack_exposure asc;

CREATE PROCEDURE filtered_professors_encourage (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select professors_encourage as question, count(professors_encourage) as count
from survey
where professors_encourage > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by professors_encourage
order by professors_encourage asc;

CREATE PROCEDURE filtered_seeking_opportunities (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select seeking_opportunities as question, count(seeking_opportunities) as count
from survey
where seeking_opportunities > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by seeking_opportunities
order by seeking_opportunities asc;

CREATE PROCEDURE filtered_sdsu_offers (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select sdsu_offers as question, count(sdsu_offers) as count
from survey
where sdsu_offers > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by sdsu_offers
order by sdsu_offers asc;

CREATE PROCEDURE filtered_skeptical_benefits (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select skeptical_benefits as question, count(skeptical_benefits) as count
from survey
where skeptical_benefits > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by skeptical_benefits
order by skeptical_benefits asc;

CREATE PROCEDURE filtered_potential_solve_global (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select potential_solve_global as question, count(potential_solve_global) as count
from survey
where potential_solve_global > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by potential_solve_global
order by potential_solve_global asc;

CREATE PROCEDURE filtered_essential_most_professions (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select essential_most_professions as question, count(essential_most_professions) as count
from survey
where essential_most_professions > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by essential_most_professions
order by essential_most_professions asc;

CREATE PROCEDURE filtered_negative_creativity (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select negative_creativity as question, count(negative_creativity) as count
from survey
where negative_creativity > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by negative_creativity
order by negative_creativity asc;

CREATE PROCEDURE filtered_long_term_concerns (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select long_term_concerns as question, count(long_term_concerns) as count
from survey
where long_term_concerns > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by long_term_concerns
order by long_term_concerns asc;

CREATE PROCEDURE filtered_unregulated_risk (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select unregulated_risk as question, count(unregulated_risk) as count
from survey
where unregulated_risk > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by unregulated_risk
order by unregulated_risk asc;

CREATE PROCEDURE filtered_significant_career (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select significant_career as question, count(significant_career) as count
from survey
where significant_career > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by significant_career
order by significant_career asc;

CREATE PROCEDURE filtered_chatgpt (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select chatgpt as question, count(chatgpt) as count
from survey
where chatgpt > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by chatgpt
order by chatgpt asc;

CREATE PROCEDURE filtered_grammarly (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select grammarly as question, count(grammarly) as count
from survey
where grammarly > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by grammarly
order by grammarly asc;

CREATE PROCEDURE filtered_adobe (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select adobe as question, count(adobe) as count
from survey
where adobe > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by adobe
order by adobe asc;

CREATE PROCEDURE filtered_dalle (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select dalle as question, count(dalle) as count
from survey
where dalle > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by dalle
order by dalle asc;

CREATE PROCEDURE filtered_bard (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select bard as question, count(bard) as count
from survey
where bard > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by bard
order by bard asc;

CREATE PROCEDURE filtered_notion (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select notion as question, count(notion) as count
from survey
where notion > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by notion
order by notion asc;

CREATE PROCEDURE filtered_bing (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select bing as question, count(bing) as count
from survey
where bing > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by bing
order by bing asc;

CREATE PROCEDURE filtered_zoom (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select zoom as question, count(zoom) as count
from survey
where zoom > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by zoom
order by zoom asc;

CREATE PROCEDURE filtered_github (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select github as question, count(github) as count
from survey
where github > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by github
order by github asc;

CREATE PROCEDURE filtered_midjourney (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select midjourney as question, count(midjourney) as count
from survey
where midjourney > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by midjourney
order by midjourney asc;

