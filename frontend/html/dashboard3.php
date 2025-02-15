<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wajebaat Slot Booking - Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <!-- Your custom CSS -->
  <link rel="stylesheet" href="../css/style.css" />
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
      <br />
      Slot Booking for Wajebaat - Dashboard
    </div>
    <div class="container-dashboard">
      <div class="row">
        <div class="col">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slotCreationModal">
            Slot Creation
          </button>
        </div>
        <div class="col generate">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#appointmentModal">
            Book New Appointment
          </button>
        </div>
        <div class="col">
          <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#silaModal">Sila Fitra Counter</button> -->
          <button type="button" class="btn btn-primary" onclick="openSilaFitraCounter()">
            Sila Fitra Counter
          </button>
        </div>
      </div>
      <!-- <div class="row">
                
                <div class="col generate">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#wajebaatModal">Wajebaat Amount Splitter</button>
                </div>
            </div> -->
      <!-- slot creation Modal -->
      <div class="modal fade" id="slotCreationModal" tabindex="-1" aria-labelledby="slotCreationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="slotCreationModalLabel">
                Create Slots for Wajebaat Booking
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <iframe src="slotcreation.html" style="width: 100%; height: 500px; border: none"></iframe>
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
              <h5 class="modal-title" id="appointmentModalLabel">
                Book New Appointment
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <iframe src="newappointment.html" style="width: 100%; height: 500px; border: none"></iframe>
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
              <h5 class="modal-title" id="confirmnationModalLabel">
                View Details
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <iframe src="confirmation.html" style="width: 100%; height: 500px; border: none"></iframe>
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
              <iframe src="silafitra.html" style="width: 100%; height: 500px; border: none"></iframe>
            </div>
          </div>
        </div>
      </div>
      <!--silafitra Modal-->
      <!-- wajebaat Modal -->
      <div class="modal fade" id="wajebaatModal" tabindex="-1" aria-labelledby="wajebaatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="wajebaatModalLabel">
                Wajebaat Counter
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <iframe src="wajebaatcounter.html" style="width: 100%; height: 500px; border: none"></iframe>
            </div>
          </div>
        </div>
      </div>
      <!--wajebaat Modal-->
      <br />
      <div class="selecdate">
        <div class="dateselect text-center">
          <select class="form-select" id="filter-date" onchange="filterByDate()" aria-label="Select Your Date">
            <option value="" selected>Select a date</option>
            <option value="05-03-2025">5 March 2025</option>
            <option value="06-03-2025">6 March 2025</option>
            <option value="07-03-2025">7 March 2025</option>
            <option value="08-03-2025">8 March 2025</option>
            <option value="09-03-2025">9 March 2025</option>
            <option value="10-03-2025">10 March 2025</option>
          </select>
        </div>
      </div>
      <button class="btn" id="refreshTable" onclick="resetTable()">
        Refresh Table
      </button>
      <div class="card">
        <table id="slotTable" class="display nowrap" style="width: 100%">
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
            </tr>
          </thead>
          <tbody>
            <!-- Sample Data -->
            <tr>
              <td>1</td>
              <td>05-03-2025</td>
              <td>8:30 - 9:00AM</td>
              <td>01</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>06-03-2025</td>
              <td>9:30 - 10:00AM</td>
              <td>02</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>07-03-2025</td>
              <td>10:30 - 11:00AM</td>
              <td>03</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>08-03-2025</td>
              <td>11:00 - 11:30AM</td>
              <td>04</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Meeting</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>5</td>
              <td>09-03-2025</td>
              <td>10:00 - 10:30AM</td>
              <td>05</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>6</td>
              <td>10-03-2025</td>
              <td>9:30 - 10:00AM</td>
              <td>06</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Payment</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>7</td>
              <td>05-03-2025</td>
              <td>10:30 - 11:00AM</td>
              <td>07</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>8</td>
              <td>06-03-2025</td>
              <td>9:30 - 10:00AM</td>
              <td>08</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>9</td>
              <td>07-03-2025</td>
              <td>8:30 - 9:00AM</td>
              <td>09</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Payment</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>10</td>
              <td>08-03-2025</td>
              <td>9:30 - 10:00AM</td>
              <td>10</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>11</td>
              <td>09-03-2025</td>
              <td>10:30 - 11:00AM</td>
              <td>11</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>12</td>
              <td>10-03-2025</td>
              <td>8:30 - 9:00AM</td>
              <td>12</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>13</td>
              <td>05-03-2025</td>
              <td>11:00 - 11:30AM</td>
              <td>13</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Meeting</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>14</td>
              <td>06-03-2025</td>
              <td>9:30 - 10:00AM</td>
              <td>14</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>15</td>
              <td>07-03-2025</td>
              <td>8:30 - 9:00AM</td>
              <td>15</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>16</td>
              <td>08-03-2025</td>
              <td>9:30 - 10:00AM</td>
              <td>16</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Meeting</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>17</td>
              <td>09-03-2025</td>
              <td>11:00 - 11:30AM</td>
              <td>17</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>18</td>
              <td>10-03-2025</td>
              <td>11:00 - 11:30AM</td>
              <td>18</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>19</td>
              <td>05-03-2025</td>
              <td>9:30 - 10:00AM</td>
              <td>19</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Public</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>20</td>
              <td>06-03-2025</td>
              <td>10:00 - 10:30AM</td>
              <td>20</td>
              <td>12345678</td>
              <td>admin</td>
              <td>Payment</td>
              <td>
                <button data-bs-toggle="modal" data-bs-target="#confirmnationModal" class="btn btn-info">
                  Details
                </button>
              </td>
              <td>
                <select class="form-select" onchange="updateStatus(this)">
                  <option value="">Select Status</option>
                  <option value="Completed">Completed</option>
                  <option value="Absent">Absent</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <br />
      <div class="logout text-center">
        <a href="#" onclick="logout()">Logout<i class="fa-solid fa-right-from-bracket"></i></a>
      </div>
    </div>
  </div>
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
    fetch("footer.html")
      .then((response) => response.text())
      .then((data) => (document.getElementById("footer").innerHTML = data));
    $(document).ready(function () {
      var table = $("#slotTable").DataTable({
        responsive: true,
        pagingType: "full_numbers",
        dom: '<"top"f<"clear">>rt<"bottom"ip<"clear">>',
        columnDefs: [{ targets: -1, orderable: false }],
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
      $(".status-dropdown").on("change", function () {
        var selectedStatus = $(this).val();
        console.log("Status selected:", selectedStatus);
      });
    });

    function logout() {
      window.location.href = "index.html";
    }
    function openSilaFitraCounter() {
      window.open("silafitra.html", "_blank");
    }
  </script>
</body>

</html>