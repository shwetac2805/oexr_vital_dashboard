<?php
    # Redirect users who have already logged in
    if (isset($_COOKIE["user_id"])) {
        header("Location: ./");   
    }

    # Check that user submitted form
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["institution"]) && isset($_POST["role"]) && isset($_POST["interest"])) {
    
        # Load database credentials and attempt connection
        include("_insert_ai_logs_credentials.php"); # Instantiates $insert_conn for logging
        
        # Create UUID as user ID
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        
        # Create log
        $sql_logging = "CALL new_user('{$uuid}', '{$_POST['name']}', '{$_POST['email']}', '{$_POST['institution']}', '{$_POST['role']}', '{$_POST['interest']}');";
        
        # Send log to database
        $result = mysqli_query($insert_conn, $sql_logging);
        
        # Create cookie
        setcookie("user_id", $uuid, time() + (86400 * 365), "/");
        
        # Redirect to dashboard
        header("Location: ./");
        exit();
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SDSU AI Student Survey Dashboard</title>
        <link rel = "stylesheet" href = "https://unpkg.com/purecss@1.0.0/build/pure-min.css" />
        <link rel = "apple-touch-icon" sizes = "180x180" href = "https://ou-resources.sdsu.edu/crimson/icons/apple-touch-icon.png" />
        <link rel = "icon" type="image/png" sizes = "32x32" href = "https://ou-resources.sdsu.edu/crimson/icons/favicon-32x32.png" />
        <link rel = "icon" type="image/png" sizes = "16x16" href = "https://ou-resources.sdsu.edu/crimson/icons/favicon-16x16.png" />
    </head>
    <body style = "margin:2%">
        <table style = "width:100%"><tr><td><h1>SDSU AI Student Survey Dashboard</h1></td><td style = "text-align:right;"><a href = "https://sdsu.edu" target = "_BLANK"><img src = "img/sdsu_logo_full.png" height = "40px"></a></td></tr></table>
        <p>SDSU's AI student survey was launched campus-wide in the fall 2023 semester. If you use this work, please cite the research at <a href = 'https://it.sdsu.edu/projects-innovation/ai/publications' target = '_BLANK'>this link</a>.</p>
        <p>Before accessing the dashboard, please answer a few questions about who you are and how you plan to use this data.</p>
        <br />
        <form method = "post" id = "tlform" class = "pure-form pure-form-aligned">
            <fieldset>
                <div class = "pure-control-group">
                    <label for = "name">Name:</label>
                    <input type = "text" placeholder = "Name" name = "name" id = "name" required />
                </div>
                <div class = "pure-control-group">
                    <label for = "email">Email:</label>
                    <input type = "email" placeholder = "Email" name = "email" id = "email" required />
                </div>
                <div class = "pure-control-group">
                    <label for = "institution">Institution:</label>
                    <input type = "text" placeholder = "Institution" name = "institution" id = "institution" required />
                </div>
                <div class = "pure-control-group">
                    <label for = "role">Role:</label>
                    <select name = "role" id = "role">
                        <option value = "Academic leadership">Academic leadership</option>
                        <option value = "Faculty">Faculty</option>
                        <option value = "Staff">Staff</option>
                        <option value = "Student">Student</option>
                        <option value = "Other">Other</option>
                    </select>
                </div>
                <div class = "pure-control-group">
                    <label for = "interest">Interest:</label>
                    <select name = "interest" id = "interest">
                        <option value = "Academic research">Academic research</option>
                        <option value = "Equity">Equity</option>
                        <option value = "Institutional research">Institutional research</option>
                        <option value = "Other">Other</option>
                    </select>
                </div>
                <div class = "pure-controls">
                    <button type = "submit" name = "select" class = "pure-button pure-button-primary">Submit</button>
                </div>
                
            </fieldset>
        </form>
    </body>
</html>