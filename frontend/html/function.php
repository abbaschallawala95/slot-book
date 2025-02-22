<?php

include "connection.php";

function updateBookingCount($slotID, $con)
{

    $updateQuery = "UPDATE booking
    SET count = count - 1
    WHERE id = $slotID";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        mysqli_commit($con);
        $_SESSION['booking_status'] = "<div class='alert alert-success'>Booked Successfully!!!</div>";
        // echo "<div class='alert alert-success'>Booked Successfully</div>";
        // header('Location:confirmation.php');
        // exit();
    } else {
        throw new Exception('Update error: ' . mysqli_error($con));
    }
}
function checkBookingStatus($sabil, $con)
{

    // checking booking availability
    $query = "SELECT * FROM booked_slot WHERE sabil_no = '$sabil'";
    $checkSlot = mysqli_query($con, $query);
    if (mysqli_num_rows($checkSlot) > 0) {
        $_SESSION['checkBookingStatus'] = "<div class='alert alert-warning'>Already Booked!!!!</div>";

    } else {
        echo "<div class='alert alert-warning'>No Previous Booking Found</div>";
    }


}

function slotBook($con, $date, $time, $id, $category, $sabil, $its, $name)
{
    $insertQuery = "INSERT INTO booked_slot (s_date, s_time, user_id, category, sabil_no, hof_its, hof_name) 
    VALUES ('$date', '$time', $id,'$category','$sabil','$its','$name')";
    $insertResult = mysqli_query($con, $insertQuery);

    if (!$insertResult) {
        throw new Exception('Insert error: ' . mysqli_error($con));
    }
}



function adminLogin($con, $itsNo, $password)
{

    $admin = "SELECT * FROM `admin` WHERE `its_no`='$itsNo' AND `status`= '0'";
    $query = mysqli_query($con, $admin);
    $data = mysqli_fetch_assoc($query);





    if (mysqli_num_rows($query) > 0) {



        if (password_verify($password, $data['password'])) {



            // Redirect based on superadmin status
            echo $data['is_superadmin'];

            if ($data['is_superadmin'] == '0') {
                $_SESSION['admin'] = $data['its_no'];

                header('Location: superadmin.php');
                exit();
            } elseif ($data['is_superadmin'] == '1') {
                $_SESSION['admin'] = $data['its_no'];
                header('Location:dashboard.php');
                exit();
            }



        } else {
            echo "<div class='alert alert-warning'>Password is wrong</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>You are currently Inactive</div>";
    }
}
function adminCreation($con, $name, $itsNo, $mobile, $password, $superAdmin, $status)
{

    $has = password_hash($password, PASSWORD_DEFAULT);

    $convertedStatus = $status == 'Active' ? '0' : '1';
    $convertedSuperAdmin = $superAdmin == 'Yes' ? '0' : '1';
    $insertAdmin = "INSERT INTO `admin` (`name`, `its_no`, `mobile_no`, `password`, `is_superadmin`, `status`) VALUES ('$name', '$itsNo', '$mobile', '$has', '$convertedSuperAdmin', '$convertedStatus')";
    $inserResult = mysqli_query($con, $insertAdmin);
    if ($inserResult) {
        $_SESSION['c_admin'] = "<div class='alert alert-success'>Successfully Created !!!</div>";
    } else {
        $_SESSION['c_admin'] = "<div class='alert alert-warning'>Failed Creating Admin !!!</div>";
    }
}




function deleteAdmin($con, $id)
{
    $delete = "DELETE FROM `admin` WHERE `id`=$id";
    $result = mysqli_query($con, $delete);
    if ($result) {
        $_SESSION['message'] = "<div class='alert alert-success'>Delete Successfull</div>";
        header("Location:superadmin.php");
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger'>Delete Failed</div>";
        header("Location:superadmin.php");
    }
}
?>