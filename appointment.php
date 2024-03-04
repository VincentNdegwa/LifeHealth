<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management</title>
    <link rel="stylesheet" href="styles/appointment.css">
</head>

<body>
    <?php
    include("./components/header.php");
    ?>
    <div class="container">
        <h2>Appointment Management</h2>

        <!-- Search Form -->
        <form action="" method="post" class="search-container">
            <input class="form-control" type="text" name="searchInput" placeholder="Search by Patient's Name or ID">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Table of Patients Not Treated -->
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data (Replace with dynamic data from your backend) -->
                <tr>
                    <td>John Doe</td>
                    <td>P12345</td>
                    <td>Male</td>
                    <td><button class="btn btn-secondary" onclick="showAppointmentOverlay('John Doe')">Schedule</button></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>

        <!-- Appointment Overlay -->
        <div class="overlay" id="appointmentOverlay">
            <div class="overlay-content">
                <h3>Schedule Appointment</h3>
                <p>Select appointment date and time:</p>
                <!-- Replace the following with a date picker or time picker of your choice -->
                <input type="date" class="form-control" id="datepicker" placeholder="Select Date">
                <input type="time" class="form-control" id="datepicker" placeholder="Select Date">

                <button class="btn btn-primary mt-2" onclick="showDoctorList()">Next</button>
                <button class="btn btn-danger mt-2" onclick="removerOverlay()">Cancel</button>

            </div>
        </div>
    </div>

    <script>
        function showAppointmentOverlay(patientName) {
            document.getElementById('appointmentOverlay').style.display = 'flex';
        }

        function showDoctorList() {
            document.getElementById('appointmentOverlay').style.display = 'none';
            alert('Select Doctor Overlay - Replace with Doctor List and Selection');
        }

        function removerOverlay() {
            document.getElementById('appointmentOverlay').style.display = 'none';
        }
    </script>


</body>

</html>