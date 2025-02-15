<?php
if (isset($_POST['update'])) {
    $id = $_GET['id']; // Get the slot ID from the form
    $status = $_POST['status']; // Get the selected status
    echo $id;
    // Update query
    $updateQuery = "UPDATE booked_slot SET `s_status`='$status' WHERE `sabil_no`='$id'";
    $result = mysqli_query($con, $updateQuery);

}
?>