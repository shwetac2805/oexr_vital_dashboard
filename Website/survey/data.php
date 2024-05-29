<?php
// Database connection
$servername = "localhost"; // Update with your server name
$username = "root"; // Update with your username
$password = "password"; // Update with your password
$dbname = "survey_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Set the connection to use utf8mb4_unicode_ci collation
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected question from the request
$selected_question = $_GET['question'];

if ($selected_question) {
    // Call the stored procedure to fetch data
    $sql = "CALL get_content_ranking_data(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selected_question);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    $stmt->close();
    $conn->close();

    // Output data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No question selected']);
}
?>
