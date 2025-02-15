<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wajebaat Slot Booking - New Appointment</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- Your custom CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .main-appointment {
      padding: 10px 20px;
    }

    .main-dashboard {
      padding: 20px;
      width: 100%;
    }

    .heading {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
    }

    .container-dashboard {
      margin-top: 20px;
    }

    .btn {
      background-color: #164954;
      border-color: #164954;
      color: white;
      width: 100%;
      margin-bottom: 10px;
    }

    .dateselect {
      text-align: center;
      margin: 20px 0;
    }

    .dataTables_wrapper .dataTables_filter {
      text-align: center;
    }

    .dataTables_wrapper .dataTables_paginate {
      display: flex;
      justify-content: space-between;
    }



    .btn:hover {
      background-color: #bfe7ef;
      color: #164954;
      border-bottom: solid 4px #164954;
    }
  </style>
</head>
<?php
session_start();

require "connection.php";
require "function.php";







$query = "SELECT `s_date` FROM `booking` GROUP BY `s_date` ORDER BY `s_date` ASC";
$dateQuery = mysqli_query($con, $query);
$firstDate = '';

$slotsQuery = "SELECT `s_date`, `s_time`, `count` FROM `booking`";
$slotsResult = mysqli_query($con, $slotsQuery);
$timeSlots = [];
while ($row = mysqli_fetch_assoc($slotsResult)) {
  $timeSlots[] = $row;
}

if (isset($_POST["check"])) {
  //   // checking booking availability
  checkBookingStatus($_POST['checksabil'], $con);
}

if (isset($_POST["submit"])) {
  // fetching users based on sabil_no
  $userCheck = mysqli_query($con, "SELECT * FROM users WHERE `sabil_no` = '$_POST[sabilno]'");
  $items = mysqli_fetch_assoc($userCheck);
  // Validate inputs
  if (empty($_POST['date']) || empty($_POST['time'])) {
    http_response_code(400);
    echo "Please select both date and time.";
    exit();
  }
  // Format date and time
  $selectedDate = date('Y-m-d', strtotime($_POST['date']));
  $selectedTime = date('H:i:s', strtotime($_POST['time']));
  // Check slot availability
  $slotQuery = "SELECT id, count, category FROM booking 
                          WHERE s_date = '$selectedDate' 
                          AND s_time = '$selectedTime' 
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

      // Slot Booking
      slotBook($con, $selectedDate, $selectedTime, $items['id'], $category, $items['sabil_no'], $items['its_no'], $items['name']);



      // Updating Booking Count
      updateBookingCount($slotID, $con);
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

<body>
  <div class="main-appointment">
    <div class="container-appointment">
      <div class="heading-slotcreation">Book New Appointment</div>
      <!-- <a href="dashboard.html" class="goback"><i class="fa-solid fa-backward"></i> go back to previous page</a> -->

      <form action="" method="POST">
        <label for="check" class="form-label">Check Booking:</label>
        <input type="text" id="check" name="checksabil" class="form-control" placeholder="Enter Sabil No">
        <br>
        <button class="btn" name="check">Check Slot</button>
        <br>
        <h5 align="center">
          <?php
          if (isset($_SESSION["checkBookingStatus"])) {

            echo $_SESSION['checkBookingStatus'];
            session_unset();
          } else {
            echo '';
          }

          ?>
        </h5>
      </form>
      <form action="" method="POST" name="form">
        <div class="pt-3">
          <label for="date" class="form-label">Category:</label>
          <select name='category' class="form-select" id="category" aria-label="Select Your category">
            <option value="" disabled selected>Select a category</option>
            <option value="Public">Public</option>
            <option value="Payment">Payment</option>
            <option value="Meeting">Meeting</option>
          </select>
        </div>
        <br />
        <div class="selectslot">
          <!-- start of selectslot -->
          <div>
            <label for="sabilno" class="form-label">Sabil No:</label>
            <input type="text" class="form-control" placeholder="Enter Sabil No" id="sabilno" name="sabilno" value="" />
          </div>
          <div class="selectslot">
            <!-- start of selectslot -->

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
                $slotsQuery = "SELECT s_time, count FROM booking WHERE s_date = '$firstDate'";
                $slotsResult = mysqli_query($con, $slotsQuery);
                while ($row = mysqli_fetch_assoc($slotsResult)) {
                  if ($row['count'] > 0) {
                    echo '<option value="' . $row['s_time'] . '">' . $row['s_time'] . ' (Available: ' . $row['count'] . ')</option>';
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
          <h5 align="center">
            <?php

            echo $_SESSION['booking_status'] ?? '';
            session_unset();
            ?>
          </h5>
      </form>
      <br />


    </div>
  </div>
  <br />
  <div id="footer"></div>
  <br />
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap Bundle with Popper -->
  <script src="../js/bootstrap.bundle.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
              option.value = slot.s_time;
              option.textContent = slot.s_time + ' (' + slot.category + ' - Available: ' + slot.count + ')';
              timeDropdown.appendChild(option);
            });
          } else {
            var option = document.createElement('option');
            option.textContent = 'No available slots';
            timeDropdown.appendChild(option);
          }
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


    fetch("").then(response => response.json()).then(data => {
      if (data.status === "already_booked") {
        let userConfirm = confirm("This slot is already booked. Do you want to proceed?");
        if (userConfirm) {
          fetch("", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ force_book: true })
          }).then(response => response.json()).then(result => {
            if (result.status == 'success') {
              alert("Slot booked successfully!");
            } else {
              alert("You canceled.");
            }
          })
        }
      }
    })


  </script>
</body>

</html>