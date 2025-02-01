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
</head>

<?php
session_start();
include('connection.php');

$query = "SELECT `slot_date` FROM `slots` GROUP BY `slot_date` ORDER BY `slot_date` ASC";
$dateQuery = mysqli_query($con, $query);
$firstDate = '';

$slotsQuery = "SELECT `slot_date`, `slot_time`, `id` FROM `slots`";
$slotsResult = mysqli_query($con, $slotsQuery);
$timeSlots = [];
while ($row = mysqli_fetch_assoc($slotsResult)) {
    $timeSlots[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDate = mysqli_real_escape_string($con, $_POST['date']);
    $selectedTime = mysqli_real_escape_string($con, $_POST['time']);
    $userID = $_SESSION['userid'];

    $slotID = null;
    foreach ($timeSlots as $slot) {
        if ($slot['slot_date'] === $selectedDate && $slot['slot_time'] === $selectedTime) {
            $slotID = $slot['id'];
            break;
        }
    }

    if ($slotID) {
        $insertQuery = "INSERT INTO booking_details (book_id, date, time, userID) VALUES ('$slotID', '$selectedDate', '$selectedTime', '$userID')";
        if (mysqli_query($con, $insertQuery)) {
            echo "<script>alert('Booking successfully recorded!');</script>";
        } else {
            echo "<script>alert('Failed to record booking. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid date or time selected. Please try again.');</script>";
    }
}
?>

<body>
    <div class="main-booking">
        <!-- start of container-booking -->
        <div class="container-booking">
            <div class="heading-confirmation text-center">
                Book Slot Pass for Wajebaat Takhmin
            </div>
            <!-- start of userdetails -->
            <br>
            <div class="userdetails">
                <div class="row align-items-start">
                    <div class="col">
                        <label for="Sabilno">Sabil No.:</label>
                        <span id="Sabilno">QS227</span>
                    </div>
                    <div class="col">
                        <label for="itsno">HOF ITS:</label>
                        <span id="itsno">50445540</span>
                    </div>
                </div>
                <br>
                <div class="row align-items-start">
                    <div class="col">
                        <label for="username">Name:</label>
                        <span id="username">Abbas bhai Huzefa bhai Challawala</span>
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
                        <span id="Sabilno">40,000</span>
                    </div>
                    <div class="col">
                        <label for="Sabilno">Sabil Due Amount:</label>
                        <span id="Sabilno">40,000</span>
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
                    session_start();
                    if (isset($_SESSION['userid'])) {
                    ?>
                        <h1><?php echo $_SESSION['userid']; ?></h1>
                    <?php
                    }
                    ?>
                    <br>
                    <div class="dateselect">
                        <select class="form-select" id="date" name="date" onchange="updateTimeSlots()" aria-label="Select Your Date">
                            <?php
                            $isFirst = true;
                            while ($row = mysqli_fetch_assoc($dateQuery)) {
                                if ($isFirst) {
                                    $firstDate = $row['slot_date'];
                                    $isFirst = false;
                                }
                                echo '<option value="' . $row['slot_date'] . '">' . $row['slot_date'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="timeselect">
                        <select class="form-select" id="time" name="time" aria-label="Select Your Slot Time">
                            <!-- Time slots will be populated dynamically -->
                        </select>
                    </div>
                </div>
                <!-- end of selectslot -->
                <br>
                <div class="text-center">
                    <button type="submit" id="" class="btn">Submit Your Slot</button>
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
            var selectedDate = document.getElementById('date').value || "<?php echo $firstDate; ?>";
            console.log('Selected Date:', selectedDate); // Log selected date

            // Clear the existing time dropdown
            var timeDropdown = document.getElementById('time');
            timeDropdown.innerHTML = '';

            // Time slots fetched in PHP
            var timeSlots = <?php echo json_encode($timeSlots); ?>;

            // Filter times based on the selected date and populate the dropdown
            var filteredTimes = timeSlots.filter(slot => slot.slot_date === selectedDate);
            filteredTimes.forEach(function(slot) {
                console.log('Adding time option:', slot.slot_time); // Log each time
                var option = document.createElement('option');
                option.value = slot.slot_time;
                option.textContent = slot.slot_time;
                timeDropdown.appendChild(option);
            });
        }

        // Automatically trigger time slots for the default first date
        document.addEventListener('DOMContentLoaded', function() {
            updateTimeSlots();
        });
    </script>
</body>

</html>
