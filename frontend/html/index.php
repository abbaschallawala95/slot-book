<?php
session_start();
include('connection.php');

if(isset($_POST["submit"])){
    $sabil = $_POST['sabilno'];
    $hofits = $_POST['hofits'];

    $sql = "SELECT * FROM `users` WHERE `sabil_no`='$sabil' ";
    $res = mysqli_query($con, $sql);

    if (!$res) {
        die("Query Failed: " . mysqli_error($con));
    }

    if(mysqli_num_rows($res) == 1){
        // Check if sabil_no is already in booked_slot

        foreach($res as $item){

            $check = "SELECT * FROM booked_slot WHERE `user_id`='$item[id]'";
            $resCheck = mysqli_query($con, $check);
    
            if (!$resCheck) {
                die("Query Failed: " . mysqli_error($con));
            }
    
            if(mysqli_num_rows($resCheck) > 0){
                // Redirect to confirmation.php if already booked
                $_SESSION['userid'] = $sabil;
                $_SESSION['newid'] = $item['id'];
                header("Location: confirmation.php");
                exit();
            } else {
                // Allow login and redirect to instructions.html
                $_SESSION['userid'] = $sabil;
                echo "<script>localStorage.setItem('sabil_no', '$sabil');</script>";
                header("Location: instructions.html");
                exit();
            }
        }

    } else {
        $_SESSION['status'] = 'Enter Correct Information';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wajebaat Slot Booking</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="main">
        <div class="heading">
            Qutbi Mohallah Dohad
            <br>
            Slot Booking for Wajebaat
         </div>

         <div class="container ">
            <div class="mb-3 mt-4">
              
              <form method="post">
                <?php
                if(isset($_SESSION['status'])){
                  ?>
                  <div class="alert alert-danger" role="alert">
                 <?php echo $_SESSION['status'];?>
                 
                      </div>
                      <?php

                      unset($_SESSION['status']);
                }
                ?>
                <label for="exampleInputEmail1" class="form-label">Sabil No.</label>
                <input type="text" placeholder="Sabil No." name="sabilno" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>

              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">HOF ITS</label>
                <input type="text" placeholder="HOF ITS" name="hofits" class="form-control" id="exampleInputPassword1">
              </div>

              <div class="text-center">
                <input type="submit" name="submit" value="Login" class="btn"  />
              </div>
              </form>



             

               
              
         </div>
    </div>
        <!-- <button onclick="location.href='tregister.php'">Register</button> -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>