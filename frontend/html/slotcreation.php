<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wajebaat Booking - Slot Creation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <style>
        .main-slotcreation {
            padding: 10px 20px;
        }

        .container-slotcreation {
            height: auto;
            margin-top: -15px;
            background-color: transparent;
        }
    </style>
    <div class="main-slotcreation">
        <div class="container-slotcreation">
            <div class="heading-slotcreation">
                Create Slots for Wajebaat Booking
            </div>

            <form id="slotCreationForm">
                <div class="row">
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <br>
                <div class="row">
                    <label for="from" class="form-label">From:</label>
                    <input type="time" class="form-control" id="from" name="from" required>
                </div>
                <div class="row">
                    <label for="to" class="form-label">To:</label>
                    <input type="time" class="form-control" id="to" name="to" required>
                </div>
                <br>
                <div class="row">
                    <label for="count" class="form-label">No of Slots Count:</label>
                    <input type="text" class="form-control" placeholder="Enter Your Slots Count" id="count"
                        name="count" />
                </div>
                <br>
                <div class="row">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select" id="category" aria-label="Select Your category" name="category">
                        <option value="" disabled selected>Select a category</option>
                        <option value="Public">Public</option>
                        <option value="Payment">Payment</option>
                        <option value="Meeting">Meeting</option>
                    </select>
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" id="submit" class="btn">Create Slots</button>
                </div>
                <div id="message">

                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- Your custom script -->
    <script>
        $(document).ready(function () {
            $("#slotCreationForm").validate({
                rules: {
                    date: { required: true },
                    from: { required: true },
                    to: { required: true },
                    count: { required: true, digits: true },
                    category: { required: true }
                },
                messages: {
                    date: "Please enter a date",
                    from: "Please enter a to time",
                    to: "Please enter a end time",
                    count: "Please enter a valid number",
                    category: "Please select a category"
                },
                submitHandler: function (form) {
                    $("#submit").hide();
                    var formData = new FormData($("#slotCreationForm")[0]);
                    $.ajax({
                        type: 'post',
                        url: 'slot_insert.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $("#submit").show();
                            console.log(data);

                            if (data == 1) {
                                $("#message").html("<div class='alert alert-success'>Successfully submitted</div>");
                                setTimeout(function () {
                                    $("#message").html("");
                                    document.getElementById("slotCreationForm").reset();
                                }, 2000);
                            } else {
                                $("#message").html("<div class='alert alert-warning'>Something went wrong!</div>");
                                setTimeout(function () {
                                    $("#message").html("");
                                }, 2000);
                            }
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
</qodoArtifact>