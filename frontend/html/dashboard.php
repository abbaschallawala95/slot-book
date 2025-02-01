<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wajebaat Slot Booking - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .main-dashboard {
            padding: 20px;
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
    </style>
</head>
<body>
    <div class="main-dashboard">
        <div class="heading">
            <br>
            Slot Booking for Wajebaat - Dashboard
        </div>
        <div class="container-dashboard">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" onclick="location.href='slotcreation.html'">Slot Creation</button>
                </div>
                <div class="col generate">
                    <button type="button" class="btn btn-success">Generate New Slot</button>
                </div>
            </div>
            <br>
            <div class="selecdate">
                <div class="dateselect">
                    <select class="form-select" id="filter-date" onchange="filterByDate()" aria-label="Select Your Date">
                        <option value="" disabled selected>Select a date</option>
                        <option value="2025-03-05">5 March 2025</option>
                        <option value="2025-03-06">6 March 2025</option>
                        <option value="2025-03-07">7 March 2025</option>
                        <option value="2025-03-08">8 March 2025</option>
                        <option value="2025-03-09">9 March 2025</option>
                        <option value="2025-03-10">10 March 2025</option>
                    </select>
                </div>
            </div>
            <div class="card">
            <table id="slotTable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Slot ID</th>
                        <th>User Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    <tr><td>1</td><td>Ali</td><td>2025-03-05</td><td>9:00 AM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>2</td><td>Ahmed</td><td>2025-03-06</td><td>9:30 AM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>3</td><td>Fatima</td><td>2025-03-07</td><td>10:00 AM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>4</td><td>Hassan</td><td>2025-03-08</td><td>10:30 AM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>5</td><td>Zainab</td><td>2025-03-09</td><td>11:00 AM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>6</td><td>Aliya</td><td>2025-03-10</td><td>11:30 AM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>7</td><td>Bilal</td><td>2025-03-05</td><td>12:00 PM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>8</td><td>Sara</td><td>2025-03-06</td><td>12:30 PM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>9</td><td>Omar</td><td>2025-03-07</td><td>1:00 PM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>10</td><td>Maryam</td><td>2025-03-08</td><td>1:30 PM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>11</td><td>Yusuf</td><td>2025-03-09</td><td>2:00 PM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>12</td><td>Hina</td><td>2025-03-10</td><td>2:30 PM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>13</td><td>Saad</td><td>2025-03-05</td><td>3:00 PM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>14</td><td>Nadia</td><td>2025-03-06</td><td>3:30 PM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>15</td><td>Khalid</td><td>2025-03-07</td><td>4:00 PM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>16</td><td>Fariha</td><td>2025-03-08</td><td>4:30 PM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>17</td><td>Hamza</td><td>2025-03-09</td><td>5:00 PM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>18</td><td>Laila</td><td>2025-03-10</td><td>5:30 PM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>19</td><td>Imran</td><td>2025-03-05</td><td>6:00 PM</td><td>Booked</td><td><button class="btn btn-info">Details</button></td></tr>
                    <tr><td>20</td><td>Farah</td><td>2025-03-06</td><td>6:30 PM</td><td>Available</td><td><button class="btn btn-info">Details</button></td></tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#slotTable').DataTable({
                responsive: true,
                pagingType: "full_numbers",
                dom: '<"top"f<"clear">>rt<"bottom"ip<"clear">>',
                columnDefs: [
                    { targets: -1, orderable: false }
                ]
            });

            window.filterByDate = function() {
                var selectedDate = $('#filter-date').val();
                table.column(2).search(selectedDate).draw();
            };
        });
    </script>
</body>
</html>
