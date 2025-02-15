<?php
include("connection.php");
if(isset($_POST))
{
    // Validate and format date/time
    $sdate = date('Y-m-d', strtotime($_POST['date']));
    $stime = date('H:i:s', strtotime($_POST['time']));
    $count = intval($_POST['count']);
    $category = mysqli_real_escape_string($con, $_POST['category']);

    // Escape the formatted values
    $sdate = mysqli_real_escape_string($con, $sdate);
    $stime = mysqli_real_escape_string($con, $stime);
    $count = mysqli_real_escape_string($con, $count);

    // Insert with proper data types
    $query = "INSERT INTO booking (s_date, s_time, count, category) VALUES ('$sdate','$stime', '$count','$category')";
    
    if(mysqli_query($con, $query)) {
        echo 1;
    } else {
        echo mysqli_error($con);
    }
}
?>
