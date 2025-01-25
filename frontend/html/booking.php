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


include('connection.php');


$query = "SELECT `slot_date` FROM `slots` GROUP BY `slot_date` ORDER BY `slot_date` ASC";
$dateQuery = mysqli_query($con,$query);




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
             <div class="userdue"><!-- start of userdue -->
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
             </div><!-- end of userdue -->
             <br>
             <hr>
             <br>
             <div class="selectslot"><!-- start of selectslot -->
                <h4>Select Slot For Wajebaat Takhmin</h4>
                <?php
                
                session_start();
                   if(isset($_SESSION['userid'])){
                    ?>

                        <h1><?php  echo $_SESSION['userid']; ?></h1>                
<?php
                   } 

                    unset($_SESSION['userid']);
                ?>
                <br>
                <div class="dateselect">
                    <select class="form-select" id="date" name='date' onchange="updateTimeSlots()" aria-label="Select Your Date">
                      <?php 
                     
                      
                      
                      ?>
                            <?php foreach ($availableDates as $date): ?>
                                <option value="<?= $date ?>"><?= $date ?></option>
                            <?php endforeach; ?>
<?php

                            while ($row = mysqli_fetch_assoc($dateQuery)) {
                                echo '<option value="' . $row['slot_date'] . '">' . $row['slot_date'] . '</option>';
                            }
                           
     ?>                       

                    </select>
                </div>
                <br>
                <div class="timeselect">
                    <select class="form-select" id="time" name="time"  aria-label="Select Your Slot Time">
                    <?php
                    // Retrieve selected date from POST request
                    // if (isset($_POST['selectedDate'])) {
                    //     $selectedDate = mysqli_real_escape_string($con, $_POST['selectedDate']);
                        
                        // Query for available times based on selected date
                        $selectedDate = $_POST['date'];
                        $timeQuery = "SELECT `slot_time` FROM `slots` WHERE `slot_date` = '$selectedDate'";
                        $result = mysqli_query($con, $timeQuery);
                        // $timeQuery = "SELECT `slot_time` FROM `slots` WHERE `slot_date` = $selectedDate";
                        // $result = mysqli_query($con, $timeQuery);

                        // Populate dropdown options dynamically
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?= $row['slot_time'] ?>"><?= $row['slot_time'] ?></option>
                            <?php


                        }
                        ?>
                        // while ($row = mysqli_fetch_assoc($result)) 
                        //   
                
                     
         
                    </select>
                </div>
             </div><!-- end of selectslot -->
             <br>
             <div class="text-center">
                <button type="submit" id="" class="btn" onclick="location.href='confirmation.html'">Submit Your Slot</button>
             </div>
        </div>
        <!-- end of container-booking -->
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/js.js"></script>
    <script>



$(document).ready(()=>{
//    $('#date').change();
$('#date').change(function() {

    var selectedDate = $(this).val();
    console.log(selectedDate);
    
    // You can now use the selectedDate variable in PHP for conditions
});



})
        // Function to dynamically update time slots based on selected date
      </script>
</body>

</html>