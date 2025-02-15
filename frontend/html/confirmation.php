<?php
session_start();
include('connection.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}




if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
}







$newID = $_SESSION['newid'];
$sabilID = $_SESSION['userid'];



$user = "SELECT * FROM `users` WHERE `sabil_no`='$sabilID'";
$result = mysqli_query($con, $user);

// Debugging: Check user query result
if (!$result) {
    die("User Query Failed: " . mysqli_error($con));
}

$slot = "SELECT * FROM `booked_slot` WHERE `sabil_no`='$sabilID' LIMIT 1";
$result2 = mysqli_query($con, $slot);

// Debugging: Check slot query result
if (!$result2) {
    die("Slot Query Failed: " . mysqli_error($con));
}



if (isset($_POST['cancel'])) {
    $cancel = "DELETE FROM `booked_slot` WHERE `user_id`='$newID'";
    $cancelRes = mysqli_query($con, $cancel);
    if (!$cancelRes) {
        die("Slot Delete Failed: " . mysqli_error($con));
    } else {
        echo '<script>alert("Your slot has been deleted!!")</script>';
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Slot</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="main-confirmation">
        <div class="container-confirmation">
            <div class="heading-confirmation text-center">
                Wajebaat Takhmin Slot Pass
            </div>
            <br>
            <div class="userdetails-confirmation">
                <div class="row align-items-start">
                    <div class="col">
                        <?php
                        if (mysqli_num_rows($result2) > 0 && mysqli_num_rows($result) > 0) {
                            $item = mysqli_fetch_assoc($result);

                            ?>
                            <label for="Sabilno">Sabil No.:</label>
                            <span id="Sabilno"><?= htmlspecialchars($item['sabil_no']); ?></span>
                        </div>
                        <div class="col">
                            <label for="itsno">HOF ITS:</label>
                            <span id="itsno"><?= htmlspecialchars($item['its_no']); ?></span>
                        </div>
                    </div>
                    <br>
                    <div class="row align-items-start">
                        <div class="col">
                            <label for="username">Name:</label>
                            <span id="username"><?= htmlspecialchars($item['name']); ?></span>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <?php
                $item2 = mysqli_fetch_assoc($result2);
                ?>
                <div class="selectslot-confirmation">
                    <h4 class="text-center">Your Slot has been Selected Successfully</h4>
                    <div class="text-center">
                        <span id="date"><?= htmlspecialchars($item2['s_date']); ?></span><span
                            id="time">&nbsp;<?= htmlspecialchars($item2['s_time']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="userdue-confirmation">
                    <div>
                        <p>1446 Dues:</p>
                    </div>
                    <div class="row align-items-start">
                        <div class="col">
                            <label for="Sabilno">FMB Due Amount:</label>

                            <?php
                            if (htmlspecialchars($item['fmb_amount']) == 0) {
                                echo "<span style='color:green;'>" . htmlspecialchars($item['fmb_amount']) . "</span>";
                            } else {
                                echo "<span style='color:red;'>" . htmlspecialchars($item['fmb_amount']) . "</span>";
                            }


                            ?>

                        </div>
                        <div class="col">
                            <label for="Sabilno">Sabil Due Amount:</label>
                            <?php
                            if (htmlspecialchars($item['sabil_due_amount']) == 0) {
                                echo "<span style='color:green;'>" . htmlspecialchars($item['sabil_due_amount']) . "</span>";
                            } else {
                                echo "<span style='color:red;'> " . htmlspecialchars($item['sabil_due_amount']) . "</span>";
                            }


                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="text-center">
                        <p>Note: If you recently paid the Sabil / FMB dues then please Ignore This</p>
                    </div>
                </div>
                <hr>
                <br>
                <div class="actionbuttons text-center">
                    <div>
                        <button type="button" onclick="downloadSlotPass()" class="btn">Download Your Slot Pass</button>
                    </div>
                    <br>
                    <form action="" method='post'>


                        <div class="text-center" id="cancelSlotButtonContainer">
                            <button type="submit" name='cancel' id="cancelSlotButton" class="btn text-center">Cancel
                                Slot</button>
                        </div>
                    </form>
                    <br>
                    <form method='post' onsubmit="clearStorage()">
                        <div class="logout">
                            <button type='submit' class='btn' name='logout'>Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
                        } else {



                            ?>
        <div class='alert alert-warning'>
            <p>No booking found. Please book a slot first.</p>
        </div>


    <?php }
                        ?>
    <br>
    <div id="footer"></div>
    <br>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/js.js"></script>
    <script>


        const sabilDue = document.getElmentById('sabil_due').textContent;

        if (sabilDue === 0) {
            document.getElementById('sabil_due').style.color = 'green';
        }

        fetch('footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);

        document.addEventListener('DOMContentLoaded', function () {
            const userRole = localStorage.getItem('role');

            if (userRole === 'admin') {
                document.getElementById('cancelSlotButton').style.display = 'block';
            } else {
                document.getElementById('cancelSlotButton').style.display = 'none';
            }
        });

        function downloadSlotPass() {
            const element = document.querySelector('.container-confirmation');
            html2canvas(element, { scale: 2 }).then(canvas => {
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/jpeg', 1.0);
                link.download = 'Slot_Pass.jpg';
                link.click();
            });
        }

        function clearStorage() {
            localStorage.clear();
        }
    </script>
</body>

</html>