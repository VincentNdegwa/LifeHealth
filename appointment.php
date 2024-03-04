<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin: 50px auto;
            max-width: 800px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            font-size: 14px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            border: 1px solid #007bff;
            color: #007bff;
            border-radius: 4px;
            background-color: #fff;
        }

        .search-container {
            width: 100%;
            display: grid;
            grid-template-columns: 5fr 1fr;
            margin-top: 2rem;

        }

        .form-control {
            height: auto !important;
        }


        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .overlay-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    include("./components/header.php");
    ?>
    <div class="container">
        <h2>Appointment Management</h2>

        <!-- Search Form -->
        <form action="" method="post" class="search-container">
            <input class="form-control" type="text" name="searchInput" placeholder="Search by Name or ID">
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