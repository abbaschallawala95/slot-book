<?php
session_start();
include('connection.php');
include('function.php');



if (isset($_SESSION['admin'])) {

  header("Location: dashboard.php");
} else {
  if (isset($_POST["submit"])) {
    $itsNo = $_POST['itsno'];
    $password = $_POST['password'];



    adminLogin($con, $itsNo, $password);


    // $sql = "SELECT * FROM `admin` WHERE `its_no`='$itsNo' AND `password`='$password'";
    // $res = mysqli_query($con, $sql);

    // if (!$res) {


    //     die("Query Failed: " . mysqli_error($con));
    // }

    // if(mysqli_num_rows($res) == 1){
    //     echo "<div class='alert alert-success'>Updated!!</div>";
    //         } else {
    //             // Allow login and redirect to instructions.html
    //             $_SESSION['admin'] = $itsNo;
    //             echo "<script>localStorage.setItem('sabil_no', '$sabil');</script>";
    //             header("Location: dashboard.php");
    //             exit();
    //         }
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- Your custom CSS -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="main">
    <div class="heading">
      Admin Login

    </div>

    <div class="container ">
      <div class="mb-3 mt-4">

        <form method="post">
          <?php
          if (isset($_SESSION['admin'])) {
            ?>
            <div class="alert alert-danger" role="alert">

              <?php echo $_SESSION['checkadmin']; ?>

            </div>
            <?php

            unset($_SESSION['status']);
            unset($_SESSION['checkadmin']);
          } else {
            echo '';
          }
          ?>
          <label for="exampleInputEmail1" class="form-label">Its No.</label>
          <input type="text" placeholder="Its No." name="itsno" class="form-control" id="exampleInputEmail1"
            aria-describedby="emailHelp">
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="text" placeholder="Password" name="password" class="form-control" id="exampleInputPassword1">
      </div>

      <div class="text-center">
        <input type="submit" name="submit" value="Login" class="btn" />
      </div>
      </form>







    </div>
  </div>
  <!-- <button onclick="location.href='tregister.php'">Register</button> -->
  <!-- Bootstrap Bundle with Popper -->
  <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>