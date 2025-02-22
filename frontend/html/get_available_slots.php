<?php
include('connection.php');

if (isset($_GET['date'])) {
    $date = mysqli_real_escape_string($con, $_GET['date']);

    // Debugging: Check received date
    error_log("Fetching slots for date: $date");

    $query = "SELECT s_ftime, s_ttime, count, category 
              FROM booking 
              WHERE s_date = '$date' 
              AND count > 0
              AND category = 'Public'
              ORDER BY s_ftime ASC";
    $result = mysqli_query($con, $query);

    if (!$result) {
        // Log database error
        error_log("Database error: " . mysqli_error($con));
        http_response_code(500);
        die(json_encode(['error' => 'Database error']));
    }

    $slots = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $slots[] = [
            's_ftime' => date('h:i A', strtotime($row['s_ftime'])),  // Format to 12-hour AM/PM
            's_ttime' => date('h:i A', strtotime($row['s_ttime'])),  // Format to 12-hour AM/PM
            'count' => (int) $row['count'],
            'category' => $row['category']
        ];
    }

    // Debugging: Log the slots being returned
    error_log("Slots found: " . print_r($slots, true));

    header('Content-Type: application/json');
    echo json_encode($slots);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Date parameter is required']);
}
?>