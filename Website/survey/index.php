<!DOCTYPE html>
<html>
    <?php
        # Redirect users who have not logged in to landing page
        if (!(isset($_COOKIE["user_id"]))) {
            header("Location: landing.php");
            exit();
        }
    
        # Load database credentials and attempt connection
        include("_select_ai_data_credentials.php"); # Instantiates $select_conn for data selection
        include("_insert_ai_logs_credentials.php"); # Instantiates $insert_conn for logging
    
        # End execution if the connection was unsuccessful
        if ((!$select_conn) or (!$insert_conn)) {
            die("</html>");
        }
        
        # Update SESSION data from POST variables
        session_start();
        foreach ($_POST as $key => $val) {
          $_SESSION[$key] = $val;
        }
        
        # Get survey question
        if (isset($_SESSION["question"])) {
            $question = $_SESSION["question"];
        } else {
            $question = "too_complex"; # Default to first question if unspecified
        }
        
        # Generic SQL query
        $sql_generic = "CALL generic_{$question}();";
        $result = mysqli_query($select_conn, $sql_generic);
        $data = [];
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            $count += $row["count"];
        }
        
        # Reload database credentials and attempt connection - required due to MySQL stored procedure buffering behavior
        include("_select_ai_data_credentials.php"); # Reinstantiates $select_conn for data selection
        
        # Reconcile age selection
        if (isset($_SESSION["age"])) {
            if ($_SESSION["age"] == "1") {
                $age_min = 0;
                $age_max = 19;
                $age_str = "age <= 19";
            } elseif ($_POST["age"] == "2") {
                $age_min = 20;
                $age_max = 29;
                $age_str = "age between 20 and 29";
            } elseif ($_POST["age"] == "3") {
                $age_min = 30;
                $age_max = 39;
                $age_str = "age between 30 and 39";
            } elseif ($_POST["age"] == "4") {
                $age_min = 40;
                $age_max = 999;
                $age_str = "age >= 40";
            } else {
                $age_min = 0;
                $age_max = 999;
                $age_str = "";
            }
            
            # Filtered SQL query
            $sql_filtered = "CALL filtered_{$question}('{$_SESSION['level_']}', '{$_SESSION['year_']}', '{$_SESSION['college']}', '{$_SESSION['residency']}', '{$_SESSION['time_basis']}', '{$_SESSION['campus']}', '{$_SESSION['living']}', {$age_min}, {$age_max}, '{$_SESSION['smart_devices']}');";
            $result1 = mysqli_query($select_conn, $sql_filtered);
            $data1 = [];
            $count1 = 0;
            while ($row = $result1->fetch_assoc()) {
                $data1[] = $row;
                $count1 += $row["count"];
            }
        
        } else {
            $age_str = ""; # Still used for logging
        }
        
        # Insert log
        $now = date('Y-m-d H:i:s');
        $user_id = $_COOKIE["user_id"];
        $sql_logging = "CALL user_interaction('{$question}', '{$_SESSION['level_']}', '{$_SESSION['year_']}', '{$_SESSION['college']}', '{$_SESSION['residency']}', '{$_SESSION['time_basis']}', '{$_SESSION['campus']}', '{$_SESSION['living']}', '{$age_str}', '{$_SESSION['smart_devices']}', '{$_SERVER['REMOTE_ADDR']}', '{$now}', '{$user_id}');";
        $sql_logging = str_replace("'%'", "''", $sql_logging);
        $result2 = mysqli_query($insert_conn, $sql_logging);
        
        # Mapping from query results to display
        $usage_questions = ["chatgpt", "grammarly", "adobe", "dalle", "bard", "notion", "bing", "zoom", "github", "midjourney"];
        if (in_array($question, $usage_questions)) {
            $mapping = array("1" => "1. Student uses tool", "2. Student does not use tool");
        } else {
            $mapping = array("1" => "1. Strongly disagree", "2" => "2. Disagree", "3" => "3. Somewhat disagree", "4" => "4. Somewhat agree", "5" => "5. Agree", "6" => "6. Strongly agree");
        }

    ?>
    <head>
        <title>SDSU AI Student Survey Dashboard</title>
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" />
        <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/grids-responsive-min.css" />
        <link rel = "stylesheet" href = "https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
        <link rel = "stylesheet" href = "https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	    <link rel = "stylesheet" href = "css/style.css" />
        <link rel = "apple-touch-icon" sizes = "180x180" href = "https://ou-resources.sdsu.edu/crimson/icons/apple-touch-icon.png" />
        <link rel = "icon" type="image/png" sizes = "32x32" href = "https://ou-resources.sdsu.edu/crimson/icons/favicon-32x32.png" />
        <link rel = "icon" type="image/png" sizes = "16x16" href = "https://ou-resources.sdsu.edu/crimson/icons/favicon-16x16.png" />
        <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type = "text/javascript" src = "https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
        <script type = "text/javascript" src = "https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
        <script type = "text/javascript" src = "https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script type = "text/javascript" src = "https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
        <script type = "text/javascript" src = "scripts/script.js"></script>
        <script type = "text/javascript">
            google.charts.load('current', {packages: ['corechart']});
    
            function drawChart() {
                var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                
                var data = google.visualization.arrayToDataTable([
                   ['Response', 'Percent'],
                   <?php foreach ($data as $key => $value) {
                       $q = $value["question"];
                       if (in_array($question, $usage_questions)) {
                           $val = $value["count"];
                       } else {
                           $val = number_format($value["count"] / $count * 100, 2);
                       }
                       echo("['{$q}', {$val}],");
                   } ?>
                ]);
                <?php 
                    if (in_array($question, $usage_questions)) {
                        echo("var chart = new google.visualization.PieChart(document.getElementById('chart_area'));\n\t\t\t\tchart.draw(data, {height: 200, width: width / 2, colors: ['#0078e7', '#e76f00']});\n");
                    } else {
                        echo("var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));\n\t\t\t\tchart.draw(data, {height: 200, width: width / 2, legend: 'none', hAxis: {title: 'Response'}, vAxis: {title: 'Percent'}, colors: ['#0078e7']});\n");
                    }
                ?>
                var data1 = google.visualization.arrayToDataTable([
                   ['Response', 'Percent'],
                   <?php foreach ($data1 as $key => $value) {
                       $q = $value["question"];
                       if (in_array($question, $usage_questions)) {
                           $val = $value["count"];
                       } else {
                           $val = number_format($value["count"] / $count1 * 100, 2);
                       }
                       echo("['{$q}', {$val}],");
                   } ?>
                ]);
                <?php 
                    if (in_array($question, $usage_questions)) {
                        echo("var chart1 = new google.visualization.PieChart(document.getElementById('chart_area1'));\n\t\t\t\tchart1.draw(data1, {height: 200, width: width / 2, colors: ['#0078e7', '#e76f00']});");
                    } else {
                        echo("var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_area1'));\n\t\t\t\tchart1.draw(data1, {height: 200, width: width / 2, legend: 'none', hAxis: {title: 'Response'}, vAxis: {title: 'Percent'}, colors: ['#0078e7']});");
                    }
                    
                ?>
                
             }
             
             google.charts.setOnLoadCallback(drawChart);
             window.onresize = drawChart;
        </script>
    </head>
    <body>
        <table style = "width:100%"><tr><td><h1>SDSU AI Student Survey Dashboard&nbsp;<i class = "fa fa-info-circle" style = "font-size: 28px;" onclick = "info();"></i></h1></td><td style = "text-align:right;"><a href = "https://sdsu.edu" target = "_BLANK"><img src = "img/sdsu_logo_full.png" height = "40px"></a></td></tr></table>
        <form method = "post" id = "tlform" class = "pure-form pure-form-stacked">
            <fieldset>
                <legend style = "font-size: 20px"><strong>Survey question</strong></legend>
                    <select name = "question" id = "question" onchange = "submitForm('tlform')">
                        <option value = "too_complex" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "too_complex") { echo("selected"); } } ?>>AI technology is too complex for me to grasp</option>
                        <option value = "follow_news" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "follow_news") { echo("selected"); } } ?>>I regularly follow news and updates about AI</option>
                        <option value = "regularly_discuss" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "regularly_discuss") { echo("selected"); } } ?>>I regularly discuss AI topics with friends, family, or classmates</option>
                        <option value = "attend_workshops" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "attend_workshops") { echo("selected"); } } ?>>I have attended workshops or seminars on AI</option>
                        <option value = "seen_opportunities" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "seen_opportunities") { echo("selected"); } } ?>>I have seen opportunities to learn more about AI around the SDSU campus</option>
                        <option value = "regularly_use" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "regularly_use") { echo("selected"); } } ?>>I regularly use AI-powered tools or applications in my studies</option>
                        <option value = "essential_for_success" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "essential_for_success") { echo("selected"); } } ?>>AI-powered tools are essential for my academic success</option>
                        <option value = "verify_accuracy" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "verify_accuracy") { echo("selected"); } } ?>>I feel that it is necessary to verify the validity and accuracy of the responses that AI generates</option>
                        <option value = "positive_learning_experience" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "positive_learning_experience") { echo("selected"); } } ?>>AI has positively affected my learning experience at SDSU</option>
                        <option value = "negative_learning_experience" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "negative_learning_experience") { echo("selected"); } } ?>>AI has negatively affected my learning experience at SDSU</option>
                        <option value = "outside_classwork" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "outside_classwork") { echo("selected"); } } ?>>I use AI outside of my classwork</option>
                        <option value = "turn_in_answer" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "turn_in_answer") { echo("selected"); } } ?>>I am comfortable submitting a prompt to an AI like ChatGPT and turning in the answer it provides</option>
                        <option value = "positive_social_issues_1" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "positive_social_issues_1") { echo("selected"); } } ?>>AI can contribute positively to social issues</option>
                        <option value = "personal_privacy" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "personal_privacy") { echo("selected"); } } ?>>I worry about AI's impact on personal privacy</option>
                        <option value = "more_transparent" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "more_transparent") { echo("selected"); } } ?>>AI algorithms should be more transparent</option>
                        <option value = "creativity_innovation" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "creativity_innovation") { echo("selected"); } } ?>>AI technology can enhance creativity and innovation</option>
                        <option value = "trust_accuracy" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "trust_accuracy") { echo("selected"); } } ?>>I trust AI algorithms to provide accurate information</option>
                        <option value = "ethics_concern" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "ethics_concern") { echo("selected"); } } ?>>The ethical use of AI is a major concern for me</option>
                        <option value = "human_biases" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "human_biases") { echo("selected"); } } ?>>AI has the potential to reduce human biases</option>
                        <option value = "job_security" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "job_security") { echo("selected"); } } ?>>I have concerns about AI's impact on job security</option>
                        <option value = "interested_training" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "interested_training") { echo("selected"); } } ?>>I am interested in receiving formal training in AI through coursework or other resources at SDSU</option>
                        <option value = "lack_exposure" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "lack_exposure") { echo("selected"); } } ?>>My curriculum lacks adequate exposure to AI</option>
                        <option value = "professors_encourage" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "professors_encourage") { echo("selected"); } } ?>>My SDSU professors encourage the use of AI in coursework</option>
                        <option value = "seeking_opportunities" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "seeking_opportunities") { echo("selected"); } } ?>>I am actively seeking opportunities to learn more about AI</option>
                        <option value = "sdsu_offers" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "sdsu_offers") { echo("selected"); } } ?>>SDSU offers adequate AI training opportunities</option>
                        <option value = "skeptical_benefits" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "skeptical_benefits") { echo("selected"); } } ?>>I am skeptical about the benefits of AI in education</option>
                        <option value = "potential_solve_global" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "potential_solve_global") { echo("selected"); } } ?>>I see potential for AI to solve complex global problems</option>
                        <option value = "essential_most_professions" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "essential_most_professions") { echo("selected"); } } ?>>AI will become an essential part of most professions</option>
                        <option value = "negative_creativity" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "negative_creativity") { echo("selected"); } } ?>>I worry about AI negatively affecting human creativity</option>
                        <option value = "long_term_concerns" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "long_term_concerns") { echo("selected"); } } ?>>I have concerns about AI's long-term societal impact</option>
                        <option value = "unregulated_risk" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "unregulated_risk") { echo("selected"); } } ?>>Unregulated AI development may lead to unforeseen risks</option>
                        <option value = "significant_career" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "significant_career") { echo("selected"); } } ?>>AI will play a significant role in my future career</option>
                        <option value = "chatgpt" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "chatgpt") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [ChatGPT]</option>
                        <option value = "grammarly" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "grammarly") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [Grammarly]</option>
                        <option value = "adobe" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "adobe") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [Adobe Express/Spark]</option>
                        <option value = "dalle" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "dalle") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [DALL-E]</option>
                        <option value = "bard" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "bard") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [Google Bard]</option>
                        <option value = "notion" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "notion") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [Notion AI]</option>
                        <option value = "bing" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "bing") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [Bing AI]</option>
                        <option value = "zoom" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "zoom") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [Zoom IQ]</option>
                        <option value = "github" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "github") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [GitHub Copilot]</option>
                        <option value = "midjourney" <?php if(isset($_SESSION["question"])) { if($_SESSION["question"] == "midjourney") { echo("selected"); } } ?>>Which of the following AI tools do you, or have you, used regularly? [Midjourney]</option>
                    </select>
            </fieldset>
        </form>

        <h3>Survey results for all students</h3>
        <table>
            <tr>
                <td style = "width:50%">
                    <table class = "stripe row-border" id = "table1">
                        <thead>
                            <tr>
                                <th>Response</th>
                                <th>Number of responses</th>
                                <th>Percent of responses</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            # Loop through query results row-by-row
                            # Each row will be stored in the $row variable
                            foreach ($data as $key => $value) {
                                $q = $mapping[$value["question"]];
                                $val = number_format($value["count"]);
                                $prop = number_format($value["count"] / $count * 100, 2);
                                echo("<tr><td>{$q}</td><td>{$val}</td><td>{$prop}%</td></tr>");
                            }
                            $count = number_format($count);
                            echo("<tr><td>Total</td><td>{$count}</td><td>100.00%</td></tr>");
                        ?>
                        </tbody>
                    </table>
                </td>
                <td style = "width:50%" id = "chart_area"></td>
                </tr>
        </table>
        <br />
        
        <form method = "post" id = "tlform1" class = "pure-form pure-form-stacked">
            <fieldset>
                <legend style = "font-size: 20px"><strong>Educational status filters&nbsp;<i class = "fa fa-rotate-left" style = "font-size: 20px;" onclick = "reset('education');"></i></strong></legend>
                <div class = "pure-g">
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "level_">Level</label>
                        <select name = "level_" id = "level_" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "Undergraduate" <?php if(isset($_SESSION["level_"])) { if($_SESSION["level_"] == "Undergraduate") { echo("selected"); } } ?>>Undergraduate</option>
                            <option value = "Graduate" <?php if(isset($_SESSION["level_"])) { if($_SESSION["level_"] == "Graduate") { echo("selected"); } } ?>>Graduate</option>
                        </select>
                    </div>
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "year_">Year</label>
                        <select name = "year_" id = "year_" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "1" <?php if(isset($_SESSION["year_"])) { if($_SESSION["year_"] == "1") { echo("selected"); } } ?>>1</option>
                            <option value = "2" <?php if(isset($_SESSION["year_"])) { if($_SESSION["year_"] == "2") { echo("selected"); } } ?>>2</option>
                            <option value = "3" <?php if(isset($_SESSION["year_"])) { if($_SESSION["year_"] == "3") { echo("selected"); } } ?>>3</option>
                            <option value = "4" <?php if(isset($_SESSION["year_"])) { if($_SESSION["year_"] == "4") { echo("selected"); } } ?>>4</option>
                            <option value = "5+" <?php if(isset($_SESSION["year_"])) { if($_SESSION["year_"] == "5+") { echo("selected"); } } ?>>5+</option>
                        </select>
                    </div>
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "college">College</label>
                        <select name = "college" id = "college" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "Arts & Letters" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Arts & Letters") { echo("selected"); } } ?>>Arts & Letters</option>
                            <option value = "Business" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Business") { echo("selected"); } } ?>>Business</option>
                            <option value = "Education" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Education") { echo("selected"); } } ?>>Education</option>
                            <option value = "Engineering" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Engineering") { echo("selected"); } } ?>>Engineering</option>
                            <option value = "Health & Human Services" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Health & Human Services") { echo("selected"); } } ?>>Health & Human Services</option>
                            <option value = "Professional Studies & Fine Arts" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Professional Studies & Fine Arts") { echo("selected"); } } ?>>Professional Studies & Fine Arts</option>
                            <option value = "Sciences" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Sciences") { echo("selected"); } } ?>>Sciences</option>
                            <option value = "Graduate Division" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Graduate Division") { echo("selected"); } } ?>>Graduate Division</option>
                            <option value = "Undergraduate Studies" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Undergraduate Studies") { echo("selected"); } } ?>>Undergraduate Studies</option>
                            <option value = "Undeclared" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Undeclared") { echo("selected"); } } ?>>Undeclared</option>
                            <option value = "Unsure" <?php if(isset($_SESSION["college"])) { if($_SESSION["college"] == "Unsure") { echo("selected"); } } ?>>Unsure</option>
                        </select>
                    </div>
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "time_basis">Time basis</label>
                        <select name = "time_basis" id = "time_basis" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "Full-time" <?php if(isset($_SESSION["time_basis"])) { if($_SESSION["time_basis"] == "Full-time") { echo("selected"); } } ?>>Full-time</option>
                            <option value = "Part-time" <?php if(isset($_SESSION["time_basis"])) { if($_SESSION["time_basis"] == "Part-time") { echo("selected"); } } ?>>Part-time</option>
                        </select>
                    </div>
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "campus">Campus</label>
                        <select name = "campus" id = "campus" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "San Diego" <?php if(isset($_SESSION["campus"])) { if($_SESSION["campus"] == "San Diego") { echo("selected"); } } ?>>San Diego</option>
                            <option value = "Imperial Valley" <?php if(isset($_SESSION["campus"])) { if($_SESSION["campus"] == "Imperial Valley") { echo("selected"); } } ?>>Imperial Valley</option>
                        </select>
                    </div>
                </div>
                <br />
                
                <legend style = "font-size: 20px"><strong>Background filters&nbsp;<i class = "fa fa-rotate-left" style = "font-size: 20px;" onclick = "reset('background');"></i></strong></legend>
                <div class = "pure-g">
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "age">Age</label>
                        <select name = "age" id = "age" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "0">--</option>
                            <option value = "1" <?php if(isset($_SESSION["age"])) { if($_SESSION["age"] == "1") { echo("selected"); } } ?>>19 or younger</option>
                            <option value = "2" <?php if(isset($_SESSION["age"])) { if($_SESSION["age"] == "2") { echo("selected"); } } ?>>20-29</option>
                            <option value = "3" <?php if(isset($_SESSION["age"])) { if($_SESSION["age"] == "3") { echo("selected"); } } ?>>30-39</option>
                            <option value = "4" <?php if(isset($_SESSION["age"])) { if($_SESSION["age"] == "4") { echo("selected"); } } ?>>40 or older</option>
                        </select>
                    </div>
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "residency">Residency</label>
                        <select name = "residency" id = "residency" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "California resident" <?php if(isset($_SESSION["residency"])) { if($_SESSION["residency"] == "California resident") { echo("selected"); } } ?>>California resident</option>
                            <option value = "Out-of-state" <?php if(isset($_SESSION["residency"])) { if($_SESSION["residency"] == "Out-of-state") { echo("selected"); } } ?>>Out-of-state</option>
                            <option value = "International" <?php if(isset($_SESSION["residency"])) { if($_SESSION["residency"] == "International") { echo("selected"); } } ?>>International</option>
                        </select>
                    </div>
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "living">Living situation</label>
                        <select name = "living" id = "living" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "On-campus" <?php if(isset($_SESSION["living"])) { if($_SESSION["living"] == "On-campus") { echo("selected"); } } ?>>On-campus</option>
                            <option value = "Off-campus" <?php if(isset($_SESSION["living"])) { if($_SESSION["living"] == "Off-campus") { echo("selected"); } } ?>>Off-campus</option>
                        </select>
                    </div>
                    <div class = "pure-u-1 pure-u-md-1-5">
                        <label for = "smart_devices">Smart devices owned</label>
                        <select name = "smart_devices" id = "smart_devices" class = "pure-u-23-24" onchange = "submitForm('tlform1')">
                            <option value = "%">--</option>
                            <option value = "0" <?php if(isset($_SESSION["smart_devices"])) { if($_SESSION["smart_devices"] == "0") { echo("selected"); } } ?>>0</option>
                            <option value = "1" <?php if(isset($_SESSION["smart_devices"])) { if($_SESSION["smart_devices"] == "1") { echo("selected"); } } ?>>1</option>
                            <option value = "2" <?php if(isset($_SESSION["smart_devices"])) { if($_SESSION["smart_devices"] == "2") { echo("selected"); } } ?>>2</option>
                            <option value = "3" <?php if(isset($_SESSION["smart_devices"])) { if($_SESSION["smart_devices"] == "3") { echo("selected"); } } ?>>3</option>
                            <option value = "4+" <?php if(isset($_SESSION["smart_devices"])) { if($_SESSION["smart_devices"] == "4+") { echo("selected"); } } ?>>4+</option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </form>
        
        <h3 <?php if (($data == $data1) or is_null($data1)) { echo('style = "display:none"'); } ?>>Survey results for filtered students</h3>
        <table <?php if (($data == $data1) or is_null($data1)) { echo('style = "display:none"'); } ?>>
            <tr>
                <td style = "width:50%">
                    <table class = "stripe row-border" id = "table2">
                        <thead>
                            <tr>
                                <th>Response</th>
                                <th>Number of responses</th>
                                <th>Percent of responses</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            # Loop through query results row-by-row
                            # Each row will be stored in the $row variable
                            foreach ($data1 as $key => $value) {
                                $q = $mapping[$value["question"]];
                                $val = number_format($value["count"]);
                                $prop = number_format($value["count"] / $count1 * 100, 2);
                                echo("<tr><td>{$q}</td><td>{$val}</td><td>{$prop}%</td></tr>");
                            }
                            $count1 = number_format($count1);
                            echo("<tr><td>Total</td><td>{$count1}</td><td>100.00%</td></tr>");
                        ?>
                        </tbody>
                    </table>
                </td>
                <td style = "width:50%" id = "chart_area1"></td>
            </tr>
        </table>
    </body>
</html>