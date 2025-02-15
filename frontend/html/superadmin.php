<?php
include 'connection.php';
include 'function.php';
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
            text-align: center;
            display: flex;
            justify-content: space-between;
        }

        table th,
        td {
            text-align: center;
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

        .delete:hover {
            background-color: rgb(226, 177, 177) !important;
            color: darkred !important;
            border-bottom: solid 4px red;
        }

        .delete {
            background-color: darkred !important;
            border-color: darkred !important;
            color: white !important;
            width: 100%;
            margin-bottom: 10px;
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
            Slot Booking for Wajebaat - <u> Super Admin Dashboard </u>
        </div>
        <div class="container-dashboard">

            <br>
            <div class="selecdate">

            </div>
            <div class="col gap-2">
                <a href="createadmin.php" class="btn">Create Admin</a>
                <button class="btn" id="refreshTable" onclick="resetTable()">Refresh Table</button>
            </div>
            <div class="card">


                <?php

                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];   // Print the message
                    unset($_SESSION['message']); // Remove it so it doesn’t show again on refresh
                }
                ?>
                <table id="slotTable" class="display nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Its</th>
                            <th>Mobile No</th>
                            <th>Status</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data -->
                        <tr>
                            <?php
                            $slots = "SELECT * FROM `admin`";
                            $slotResult = mysqli_query($con, $slots);
                            while ($slotItems = mysqli_fetch_assoc($slotResult)) {
                                ?>
                                <td><?php echo $slotItems['id']; ?></td>
                                <td><?php echo $slotItems['name']; ?></td>
                                <td><?php echo $slotItems['its_no']; ?></td>
                                <td><?php echo $slotItems['mobile_no']; ?></td>



                                <td>
                                    <?php
                                    if (isset($_POST['submit'])) {

                                        // Get the slot ID from the form
                                        $id = $_POST['itsno'];

                                        $status = $_POST['status']; // Get the selected status
                                
                                        // Update query
                                        // $updateQuery = "INSERT INTO booked_slot (`s_status`) VALUES ('$status') WHERE `sabil_no`='$id'";
                                
                                        if ($status == 'Active') {


                                            $activeQuery = "UPDATE `admin` SET `status` = '0' WHERE `its_no`='$id'";
                                            $activeResult = mysqli_query($con, $activeQuery);
                                            if ($activeResult) {
                                                $_SESSION['message'] = "<div class='alert alert-success'>Updated!!</div>";

                                            }

                                        } else {

                                            $inactiveQuery = "UPDATE `admin` SET `status`='1' WHERE `its_no`='$id'";
                                            $inactiveresult = mysqli_query($con, $inactiveQuery);
                                            if ($inactiveresult) {
                                                $_SESSION['message'] = "<div class='alert alert-success'>Updated!!</div>";
                                            }
                                        }

                                    }

                                    ?>
                                    <form method='post'>
                                        <select class="form-select" name='status'>
                                            <option value="">
                                                <?php

                                                echo $slotItems['status'] == '0' ? 'Active' : 'In Active';
                                                ?>
                                            </option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>

                                </td>
                                <input type="hidden" name="itsno" value="<?php echo $slotItems['its_no']; ?>">

                                <td>
                                    <button type="submit" name='submit' class='btn'>Update</button>

                                </td>
                                <td>
                                    <a href="deleteadmin.php?id=<?= $slotItems['id']; ?>" name='submit'
                                        class='btn delete'>Delete</a>

                                </td>
                                </form>
                            </tr>
                        <?php } ?>

                </table>
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