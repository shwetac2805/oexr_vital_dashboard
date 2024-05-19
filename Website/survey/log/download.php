<?php

    # Validate login
    session_start();
    if (isset($_SESSION["login"])) {
        if ($_SESSION["login"] !== "16c72330-d2f1-4922-bb29-b1cf33532e79") {
            header("Location: ./landing.php");
            exit();
        }
    } else {
        header("Location: ./landing.php");
        exit();
    }

    # Parse selected log option
    try {
        $option = strtolower($_GET["option"]);
    } catch (Exception $e) {
        header("Location: ./");
        exit();
    }

    # Load database credentials and attempt connection
    include("/home/dgoldberg/_select_ai_logs_credentials.php"); # Instantiates $select_log_conn for data selection

    # Check if the connection was successful
    if (!$select_log_conn) {
        die();
    }
    
    # Create file
    $date = date('Y-m-d');
    
    if ($option === "queries") {
        $filename = "SDSU AI Student Survey Dashboard Query Log {$date}.csv"; 
        $file = fopen("php://memory", "w");
        
        # Header row
        fputcsv($file, array("Request ID", "Request time", "User ID", "Name", "Email", "Institution", "Role", "Interest", "IP address", "Question", "Level", "Year", "College", "Time basis", "Campus", "Age", "Residency", "Living", "Smart devices"), ",");
        
        # Data rows
        $sql = "CALL queries_log();";
        $result = mysqli_query($select_log_conn, $sql);
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, array($row["request_id"], $row["request_time"], $row["user_id"], $row["name"], $row["email"], $row["institution"], $row["role"], $row["interest"], $row["ip_address"], $row["question"], $row["level_"], $row["year_"], $row["college"], $row["time_basis"], $row["campus"], $row["age"], $row["residency"], $row["living"], $row["smart_devices"]), ","); 
        }
    } elseif ($option === "users") {
        $filename = "SDSU AI Student Survey Dashboard User Log {$date}.csv"; 
        $file = fopen("php://memory", "w");
        
        # Header row
        fputcsv($file, array("User ID", "Name", "Email", "Institution", "Role", "Interest", "Request count"), ",");
        
        # Data rows
        $sql = "CALL users_log();";
        $result = mysqli_query($select_log_conn, $sql);
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, array($row["user_id"], $row["name"], $row["email"], $row["institution"], $row["role"], $row["interest"], $row["request_count"]), ","); 
        }
    } else {
        header("Location: ./");
        exit();
    }
        
    # Download file
    fseek($file, 0);
    header("Content-Type: text/csv"); 
    header("Content-Disposition: attachment; filename = {$filename};"); 
    fpassthru($file);
    exit();

?>