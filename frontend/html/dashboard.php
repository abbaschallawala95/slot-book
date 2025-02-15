<?php
include 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wajebaat Slot Booking - Dashboard</title>
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
        .main-dashboard {
            padding: 20px;
        }

        .card {
            overflow-y: scroll;
        }

        .heading {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .container-dashboard {
            margin-top: 20px;
            height: auto;
        }

        .btn {
            width: 100%;

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

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            background-color: #164954;
            border-color: #164954;
            color: white;
            width: 100%;
            margin-bottom: 10px;
        }

        .btn:hover {
            background-color: #bfe7ef;
            color: #164954;
            border-bottom: solid 4px #164954;
        }
    </style>
</head>
<?php
if (!isset($_SESSION['admin'])) {
    header('Location:admin.php');
}
?>

<body>
    <div class="main-dashboard">
        <div class="heading">
            Slot Booking for Wajebaat - Dashboard
        </div>
        <div class="container-dashboard">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#slotCreationModal">Slot Creation</button>
                </div>
                <div class="col generate">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#appointmentModal">Book New Appointment</button>
                </div>
                <div class="col">
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#silaModal">Sila Fitra Counter</button> -->
                    <a href="silafitra.html" target='_blank' class='btn'>Sila Fitra Counter</a>

                </div>
            </div>
            <!-- <div class="row">

                <div class="col generate">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#wajebaatModal">Wajebaat Amount Splitter</button>
                </div>
            </div> -->
            <!-- slot creation Modal -->
            <div class="modal fade " id="slotCreationModal" tabindex="-1" aria-labelledby="slotCreationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="slotCreationModalLabel">Create Slots for Wajebaat Booking</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="slotcreation.php" style="width:100%; height:500px; border:none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slot creation Modal -->
            <!-- Appointment Modal -->
            <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="appointmentModalLabel">Book New Appointment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="newappointment.php" style="width:100%; height:500px; border:none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!--appointment Modal-->
            <!-- confirmation Modal -->
            <div class="modal fade" id="confirmnationModal" tabindex="-1" aria-labelledby="confirmnationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmnationModalLabel">View Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="confirmation.php" style="width:100%; height:500px; border:none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!--confirmation Modal-->
            <!-- silafitra Modal -->
            <div class="modal fade" id="silaModal" tabindex="-1" aria-labelledby="silaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="silaModalLabel">Sila Fitra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="silafitra.html" style="width:100%; height:500px; border:none;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!--silafitra Modal-->

            <br>
            <div class="selecdate">
                <div class="dateselect text-center">
                    <select class="form-select" id="filter-date" onchange="filterByDate()"
                        aria-label="Select Your Date">
                        <option value="" selected>Select a date</option>
                        <?php
                        $slots = "SELECT * FROM `booking`";
                        $slotResult = mysqli_query($con, $slots);
                        while ($slotItems = mysqli_fetch_assoc($slotResult)) {

                            ?>
                            <option><?php echo $slotItems['s_date']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button class="btn" id="refreshTable" onclick="resetTable()">Refresh Table</button>
            <div class="card">

                <table id="slotTable" class="display nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Sabil No</th>
                            <th>HOF Its</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data -->
                        <tr>
                            <?php
                            $slots = "SELECT * FROM `booked_slot`";
                            $slotResult = mysqli_query($con, $slots);
                            while ($slotItems = mysqli_fetch_assoc($slotResult)) {
                                ?>
                                <td><?php echo $slotItems['id']; ?></td>
                                <td><?php echo $slotItems['s_date']; ?></td>
                                <td><?php echo $slotItems['s_time']; ?></td>
                                <td><?php echo $slotItems['sabil_no']; ?></td>
                                <td><?php echo $slotItems['hof_its']; ?></td>
                                <td><?php echo $slotItems['hof_name']; ?></td>
                                <td><?php echo $slotItems['category']; ?></td>
                                <td>
                                    <!-- wajebaat Modal -->


                                    <!-- Button to Open Modal -->
                                    <a class="btn btn-info"
                                        href="adminconfirmation.php?id=<?php echo $slotItems['sabil_no']; ?>"
                                        target='_blank'>
                                        Details
                                    </a>
                                    <!-- <a href="adminconfirmation.php?id=<?php echo $slotItems['sabil_no']; ?>">link</a> -->
                                    <!--wajebaat Modal-->

                                </td>


                                <td>
                                    <?php
                                    if (isset($_POST['submit'])) {

                                        // Get the slot ID from the form
                                        $id = $_POST['sabilno'];

                                        $status = $_POST['status']; // Get the selected status
                                
                                        // Update query
                                        // $updateQuery = "INSERT INTO booked_slot (`s_status`) VALUES ('$status') WHERE `sabil_no`='$id'";
                                
                                        $updateQuery = "UPDATE booked_slot SET `s_status`='$status' WHERE `sabil_no`='$id'";
                                        $result = mysqli_query($con, $updateQuery);
                                        if ($result) {
                                            $_SESSION['message'] = "<div class='alert alert-success'>Updated!!</div>";
                                        }

                                    }

                                    ?>
                                    <form method='post'>
                                        <select class="form-select" name='status'>
                                            <option value=""><?php
                                            if ($slotItems['s_status'] == null) {
                                                echo 'Select Status';
                                            } else {
                                                echo $slotItems['s_status'];
                                            }

                                            ?></option>
                                            <option value="Completed">Completed</option>
                                            <option value="Absent">Absent</option>
                                        </select>

                                </td>
                                <input type="hidden" name="sabilno" value="<?php echo $slotItems['sabil_no']; ?>">

                                <td>
                                    <button type="submit" name='submit' class='btn'>Update</button>

                                </td>
                                <td>
                                    <button type="submit" name='submit' class='btn'>Update</button>

                                </td>
                                </form>
                            </tr>
                        <?php } ?>

                </table>
                <?php

                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];   // Print the message
                    unset($_SESSION['message']); // Remove it so it doesn’t show again on refresh
                }
                ?>
                </tbody>
            </div>

            <br>
            <?php // Start the session
            if (isset($_POST['logout'])) {

                session_unset();

            }
            ?>
            <form action="" method="post">


                <div class="logout text-center ">
                    <button type='submit' name='logout' class='btn'>Logout<i
                            class="fa-solid fa-right-from-bracket"></i></button>
                </div>
            </form>
        </div>

    </div>
    <div id="footer"></div>
    <br>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../js/js.js"></script>
    <script>


        fetch('footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
        $(document).ready(function () {
            var table = $('#slotTable').DataTable({
                responsive: true,
                pagingType: "full_numbers",
                dom: '<"top"f<"clear">>rt<"bottom"ip<"clear">>',
                columnDefs: [{ targets: -1, orderable: false }]
            });

            $("#filter-date").on("change", function () {
                var selectedDate = $(this).val();
                table
                    .column(1)
                    .search(selectedDate ? "^" + selectedDate + "$" : "", true, false)
                    .draw();
            });

            $("#refreshTable").click(function () {
                $("#filter-date").val("").change();
                table.search("").columns().search("").draw();
            });

            // Capture Status Dropdown Selection
            $('.status-dropdown').on('change', function () {
                var selectedStatus = $(this).val();
                console.log("Status selected:", selectedStatus);
            });
        });

        // open model
        function openModal(id) {
            let iframe = document.getElementById("modalIframe");

            // Set iframe src dynamically
            let url = "adminconfirmation.php?id=" + id + "&t=" + new Date().getTime();
            console.log("Opening Modal with URL:", url); // Debugging log

            iframe.src = url;

            // Open the Bootstrap modal manually
            var myModal = new bootstrap.Modal(document.getElementById('confirmnationModal'));
            myModal.show();
        }



        function logout() {
            window.location.href = "index.php";
        }
        function openSilaFitraCounter() {
            window.open("silafitra.html", "_blank");
        }

    </script>
</body>

</html>