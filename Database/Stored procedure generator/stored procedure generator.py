import csv

with open("stored_procedures1.sql", "w") as write_file:
    with open("survey_questions.csv", "r") as read_file:
        reader = csv.reader(read_file)
        for row in reader:
            column = row[0]

            stored_procedure = f"""CREATE PROCEDURE filtered_{column} (IN _level_ VARCHAR(50), IN _year_ VARCHAR(50), IN _college VARCHAR(50), IN _residency VARCHAR(50), IN _time_basis VARCHAR(50), IN _campus VARCHAR(50), IN _living VARCHAR(50), IN age_min INT, IN age_max INT, IN _smart_devices VARCHAR(50))

select {column} as question, count({column}) as count
from survey
where {column} > 0
and level_ LIKE _level_ and year_ LIKE _year_ and college LIKE _college
and residency LIKE _residency and time_basis LIKE _time_basis and
campus LIKE _campus and living LIKE _living
and (age between age_min and age_max) and smart_devices LIKE _smart_devices
group by {column}
order by {column} asc;

"""

            write_file.write(stored_procedure)