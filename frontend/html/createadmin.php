<?php
session_start();
include('connection.php');
include('function.php');



if (isset($_POST["submit"])) {
    $itsNo = $_POST['itsno'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $status = $_POST['status'];
    $superAdmin = $_POST['superadmin'];

    // adminLogin($con, $itsNo, $password);

    adminCreation($con, $name, $itsNo, $mobile, $password, $superAdmin, $status);

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
<style>
    .main {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 0;
        padding: 30px;
    }



    .container {
        height: auto;
    }
</style>

<body>
    <div class="main">
        <div class="heading">
            <h1>
                Admin Creation
            </h1>
        </div>

        <div class="container">
            <div class="mb-3 mt-4">

                <form method="post">

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Name</label>
                        <input type="text" placeholder="Name" name="name" class="form-control"
                            id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Its No.</label>
                        <input type="text" placeholder="Its No." name="itsno" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mobile No.</label>
                        <input type="text" placeholder="Mobile No" name="mobile" class="form-control"
                            id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" placeholder="Password" name="password" class="form-control"
                            id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name='status'>
                            <option value="">
                                Set Status
                            </option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name='superadmin'>
                            <option value="">
                                Set Super Admin
                            </option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="submit" value="Create Admin" class="btn" />
                    </div>
                </form>
                <h5>
                    <?php
                    if (isset($_SESSION['c_admin'])) {
                        echo $_SESSION['c_admin'];
                        session_unset();
                    } else {
                        echo '';
                    }
                    ?>
                </h5>
            </div>
        </div>
        <!-- <button onclick="location.href='tregister.php'">Register</button> -->
        <!-- Bootstrap Bundle with Popper -->
        <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>