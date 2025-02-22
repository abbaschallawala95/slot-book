<?php
include("connection.php");
if (isset($_POST)) {
    // Validate and format date/time
    $sdate = date('Y-m-d', strtotime($_POST['date']));
    $sftime = date('Y-m-d h:i A', strtotime($_POST['from']));
    $sttime = date('Y-m-d h:i A', strtotime($_POST['to']));
    $count = intval($_POST['count']);
    $category = mysqli_real_escape_string($con, $_POST['category']);

    // Escape the formatted values
    $sdate = mysqli_real_escape_string($con, $sdate);
    $sttime = mysqli_real_escape_string($con, $sttime);
    $sftime = mysqli_real_escape_string($con, $sftime);
    $count = mysqli_real_escape_string($con, $count);

    // Insert with proper data types
    $query = "INSERT INTO booking (s_date, s_ftime, s_ttime, count, category) VALUES ('$sdate','$sftime','$sttime', '$count','$category')";

    if (mysqli_query($con, $query)) {
        echo 1;
    } else {
        echo mysqli_error($con);
    }
}
?>