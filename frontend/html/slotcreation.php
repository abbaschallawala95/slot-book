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
    <div class="main-slotcreation">
        <div class="container-slotcreation">
            <div class="heading-slotcreation">
                Create Slots for Wajebaat Booking
            </div>
            <div class="row">
                <label for="date" class="form-label">Date:</label>
                <input type="text" class="form-control" placeholder="Enter Your Date" id="date" name="date" value=""/>
            </div>
            <br>
            <div class="row">
                <label for="time" class="form-label">Time:</label>
                <input type="text" class="form-control" placeholder="Enter Your Time" id="time" name="time" value=""/>
            </div>
            <br>
            <div class="row">
                <label for="time" class="form-label">No of Slots Count:</label>
                <input type="text" class="form-control" placeholder="Enter Your Slots Count" id="time" name="time" value=""/>
            </div>
            <br>
            <div class="row">
            <label for="date" class="form-label">Category:</label>
                    <select class="form-select" id="category" aria-label="Select Your category">
                        <option value="" disabled selected>Select a category</option>
                        <option value="Public">Public</option>
                        <option value="Payment">Payment</option>
                        <option value="Meeting">Meeting</option>
                    </select>
            </div>
            <br>
            <div class="text-center">
                <button type="submit" class="btn" onclick="">Create Slots</button>
              </div>
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/js.js"></script>
</body>
</html>