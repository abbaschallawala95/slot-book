<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wajebaat Slot Booking</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
        // Get user data from localStorage
        const userData = JSON.parse(localStorage.getItem('sabil_no'));
        
        // Verify user data exists
        if (!userData || !) {
            alert('Please login first');
            window.location.href = 'index.php';
        }
    </script> -->
</head>

<?php
session_start();



include('connection.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Please login to book a slot.');</script>";
    header("Location:index.php");
}

$sessionID = $_SESSION['userid'];

$query = "SELECT `s_date` FROM `booking` GROUP BY `s_date` ORDER BY `s_date` ASC";
$dateQuery = mysqli_query($con, $query);
$firstDate = '';

$slotsQuery = "SELECT `s_date`, `s_ftime`, `s_ttime`,`count` FROM `booking`";
$slotsResult = mysqli_query($con, $slotsQuery);
$timeSlots = [];
while ($row = mysqli_fetch_assoc($slotsResult)) {
    $timeSlots[] = $row;
}

// Verify user exists
$userCheck = mysqli_query($con, "SELECT * FROM users WHERE sabil_no = '$sessionID'");
$message = false;
if (mysqli_num_rows($userCheck) !== 1) {
    $message = true;
}
$items = mysqli_fetch_assoc($userCheck);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate inputs
    if (empty($_POST['date']) || empty($_POST['time'])) {
        http_response_code(400);
        echo "Please select both date and time.";
        exit();
    }

    // Split the time into from and to parts
    $timeParts = explode('-', $_POST['time']);
    if (count($timeParts) !== 2) {
        http_response_code(400);
        echo "Invalid time format.";
        exit();
    }

    $selectedFromTime = trim($timeParts[0]); // First part is from time
    $selectedToTime = trim($timeParts[1]);   // Second part is to time

    // Format date and times
    $selectedDate = date('Y-m-d', strtotime($_POST['date']));
    $formattedFromTime = date('H:i A', strtotime($selectedFromTime)); // Only time (24-hour format)
    $formattedToTime = date('H:i A', strtotime($selectedToTime));     // Only time (24-hour format)
    $userID = $items['id'];

    // Debugging: Print the received data
    error_log("Selected Date: $selectedDate");
    error_log("From Time: $selectedFromTime");
    error_log("To Time: $selectedToTime");
    error_log("User ID: $userID");

    $_SESSION['newid'] = $userID;

    // Check slot availability
    $slotQuery = "SELECT id, count, category FROM booking 
                 WHERE s_date = '$selectedDate' 
                 AND s_ftime = '$formattedFromTime' 
                 AND s_ttime = '$formattedToTime' 
                 AND count > 0";
    $slotResult = mysqli_query($con, $slotQuery);

    if (!$slotResult) {
        http_response_code(500);
        echo "Slot Query Failed: " . mysqli_error($con);
        exit();
    }

    if (mysqli_num_rows($slotResult) === 1) {
        $slot = mysqli_fetch_assoc($slotResult);
        $slotID = $slot['id'];
        $currentCount = $slot['count'];
        $category = $slot['category'];

        // Start transaction
        mysqli_begin_transaction($con);



        try {
            $checkQuery = "SELECT * FROM booked_slot 
                           WHERE user_id = '$userID' 
                           AND s_date = '$selectedDate' 
                           AND s_ftime = '$formattedFromTime' 
                           AND s_ttime = '$formattedToTime'";
            $checkResult = mysqli_query($con, $checkQuery);
            if (!$checkResult) {
                throw new Exception('Check Query Failed: ' . mysqli_error($con));
            }

            if (mysqli_num_rows($checkResult) == 0) {
                http_response_code(400);
                // Insert booking with category and slot_id
                $insertQuery = "INSERT INTO booked_slot 
                               (slot_id,s_date, s_ftime, s_ttime, user_id, category, sabil_no, hof_its, hof_name) 
                               VALUES ('$slotID','$selectedDate', '$formattedFromTime', '$formattedToTime', 
                                       '$userID', '$category','$sessionID','$items[its_no]','$items[name]')";

                // Debugging: Print the insert query


                // Execute insert query
                $insertResult = mysqli_query($con, $insertQuery);

                if (!$insertResult) {
                    throw new Exception('Insert error: ' . mysqli_error($con));
                }

                // Update slot count
                $updateQuery = "UPDATE booking 
                              SET count = count - 1 
                              WHERE id = $slotID";
                $updateResult = mysqli_query($con, $updateQuery);

                if ($updateResult) {
                    mysqli_commit($con);
                    echo "Booking successful!";
                    header('Location:confirmation.php');
                    exit();
                } else {
                    throw new Exception('Update error: ' . mysqli_error($con));
                }
            } else {

            }
        } catch (Exception $e) {
            mysqli_rollback($con);
            http_response_code(500);
            echo "Failed to record booking: {$e->getMessage()}";
            exit();
        }
    } else {
        http_response_code(400);
        echo "Invalid date/time or no slots available.";
        exit();
    }
}
?>




<?php


?>
<style>
    .container-booking {
        height: auto;
    }
</style>

<body>
    <div class="main-booking">
        <!-- start of container-booking -->
        <div class="container-booking">
            <?php
            $user = "SELECT * FROM `users` WHERE `sabil_no`='$_SESSION[userid]'";
            $userResult = mysqli_query($con, $user);
            $userData = mysqli_fetch_assoc($userResult);




            $check = "SELECT * FROM `booked_slot` WHERE `sabil_no`='$_SESSION[userid]'";
            $checkResult = mysqli_query($con, $check);
            if (!$checkResult) {

            } else {
            }

            ?>
            <div class="heading-confirmation text-center">
                Book Slot Pass for Wajebaat Takhmin
            </div>
            <!-- start of userdetails -->
            <br>
            <div class="userdetails">
                <div class="row align-items-start">
                    <div class="col">
                        <label for="Sabilno">Sabil No.:</label>
                        <span id="Sabilno"><?= $userData['sabil_no']; ?></span>
                    </div>
                    <div class="col">
                        <label for="itsno">HOF ITS:</label>
                        <span id="itsno"><?= $userData['its_no']; ?></span>
                    </div>
                </div>
                <br>
                <div class="row align-items-start">
                    <div class="col">
                        <label for="username">Name:</label>
                        <span id="username"><?= $userData['name']; ?></span>
                    </div>
                </div>
            </div>
            <!-- end of userdetails -->
            <br>
            <hr>
            <div class="userdue">
                <!-- start of userdue -->
                <div class="text-center">
                    <p>1445 Dues</p>
                </div>
                <div class="row align-items-start">
                    <div class="col">
                        <label for="Sabilno">FMB Due Amount:</label>

                        <?php
                        if (htmlspecialchars($userData['fmb_amount']) == 0) {
                            echo "<span style='color:green;'>" . htmlspecialchars($userData['fmb_amount']) . "</span>";
                        } else {
                            echo "<span style='color:red;'>" . htmlspecialchars($userData['fmb_amount']) . "</span>";
                        }


                        ?>

                    </div>
                    <div class="col">
                        <label for="Sabilno">Sabil Due Amount:</label>
                        <?php
                        if (htmlspecialchars($userData['sabil_due_amount']) == 0) {
                            echo "<span style='color:green;'>" . htmlspecialchars($userData['sabil_due_amount']) . "</span>";
                        } else {
                            echo "<span style='color:red;'> " . htmlspecialchars($userData['sabil_due_amount']) . "</span>";
                        }


                        ?>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <p>Note: If you recently paid the Sabil / FMB dues then please Ignore This</p>
                </div>
            </div>
            <!-- end of userdue -->
            <br>
            <hr>
            <br>
            <form action="" method="POST" name="form">
                <div class="selectslot">
                    <!-- start of selectslot -->
                    <h4>Select Slot For Wajebaat Takhmin</h4>
                    <?php
                    // session_start();
                    // if (isset($_SESSION['userid'])) {
                    
                    // }
                    // ?>
                    <br>
                    <div class="dateselect">
                        <select class="form-select" id="date" name="date" onchange="updateTimeSlots()"
                            aria-label="Select Your Date">
                            <?php
                            $isFirst = true;
                            while ($row = mysqli_fetch_assoc($dateQuery)) {
                                if ($isFirst) {
                                    $firstDate = $row['s_date'];
                                    $isFirst = false;
                                }
                                echo '<option value="' . $row['s_date'] . '">' . $row['s_date'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="timeselect">
                        <select class="form-select" id="time" name="time" aria-label="Select Your Slot Time">

                            <?php
                            $timeSlots = [];
                            $slotsQuery = "SELECT s_ftime, s_ttime, count FROM booking WHERE s_date = '$firstDate' AND category= 'Public'";
                            $slotsResult = mysqli_query($con, $slotsQuery);
                            while ($row = mysqli_fetch_assoc($slotsResult)) {
                                echo $row['s_ftime'];
                                if ($row['count'] > 0) {

                                    echo '<option value="' . $row['s_ftime'] . '-' . $row['s_ttime'] . '">' . $row['s_ftime'] . '' . $row['s_ttime'] . ' (Available: ' . $row['count'] . ')</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- end of selectslot -->
                <br>
                <div class="text-center">



                    <button class="btn" type='submit' name='submit'>Submit Your Slot</button>



                </div>
            </form>
        </div>
        <!-- end of container-booking -->
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/js.js"></script>
    <script>
        function updateTimeSlots() {
            var selectedDate = document.getElementById('date').value;
            var timeDropdown = document.getElementById('time');
            timeDropdown.innerHTML = '';

            fetch('get_available_slots.php?date=' + selectedDate)
                .then(response => response.json())
                .then(data => {
                    console.log('Received data:', data);

                    // Clear existing options
                    timeDropdown.innerHTML = '';

                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(slot => {
                            var option = document.createElement('option');
                            option.value = slot.s_ftime + '-' + slot.s_ttime;
                            option.textContent = slot.s_ftime + ' to ' + slot.s_ttime + 
                                ' (' + slot.category + ' - Available: ' + slot.count + ')';
                            timeDropdown.appendChild(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.textContent = 'No available slots';
                        timeDropdown.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    var option = document.createElement('option');
                    option.textContent = 'Error loading slots';
                    timeDropdown.appendChild(option);
                });
        }

        // Automatically trigger time slots for the default first date
        document.addEventListener('DOMContentLoaded', function () {
            updateTimeSlots();
        });

        function submitBooking() {
            const userData = JSON.parse(localStorage.getItem('userData'));
            const form = document.forms['form'];
            const formData = new FormData(form);

            // Add user ID to form data
            formData.append('user_id', userData.id);

            fetch('', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    document.body.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Booking failed. Please try again.');
                });
        }
    </script>
</body>

</html>