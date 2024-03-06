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
    include("./Database/Database.php");
    ?>
    <?php
    $patients_array = [];
    if ($conn) {
        try {

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $patients_array = [];
                if (isset($_GET["mode"])) {
                    $search = $_GET["search"];
                    $search_query = "SELECT first_name, last_name, id, id_number, gender FROM patients WHERE first_name LIKE '%" . $search . "%' OR last_name LIKE '%" . $search . "%' OR id LIKE '%" . $search . "%'";
                    $results = mysqli_query($conn, $search_query);
                    while ($patient = mysqli_fetch_assoc($results)) {
                        $patients_array[] = $patient;
                    }
                } else {
                    $select_query = "SELECT first_name, last_name, id, id_number, gender FROM patients";
                    $select_results = mysqli_query($conn, $select_query);
                    while ($patient = mysqli_fetch_assoc($select_results)) {
                        $patients_array[] = $patient;
                    }
                }
            }
        } catch (\Throwable $th) {
            $errorMessage = addslashes($th->getMessage());
            echo "<script>
                    alert('Error: $errorMessage');
                   </script>";
        }
    } else {
        echo '
            <script>
        const toastLiveExample = document.querySelector("#liveToast")
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastBootstrap.show()
    </script>

        ';
    }


    ?>
    <div class="container">
        <h2>Appointment Management</h2>

        <!-- Search Form -->
        <form action="" method="GET" class="search-container">
            <input class="form-control" type="text" name="search" placeholder="Search by Patient's Name or ID">
            <button type="submit" name="mode" value="Search" class="btn btn-primary">Search</button>
        </form>

        <!-- Table of Patients Not Treated -->
        <?php if (count($patients_array) > 0) { ?>
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
                    <?php foreach ($patients_array as $patient) { ?>
                        <tr>
                            <td><?php echo $patient["first_name"] . " " . $patient["last_name"] ?></td>
                            <td><?php echo $patient["id_number"]  ?></td>
                            <td><?php echo strtoupper($patient["gender"]) ?></td>
                            <td><button class="btn btn-secondary" onclick="showAppointmentOverlay(<?php echo $patient['id'] ?>)">Schedule</button></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        <?php } else { ?>
            <h3 class="text-info mt-4">There are currently no added patients. Please proceed to the Patient page to add a new patient.</h3>
        <?php } ?>

        <!-- Appointment Overlay -->
        <div class="overlay" id="appointmentOverlay">
            <div class="overlay-content">
                <h3>Schedule Appointment</h3>
                <p>Select appointment date and time:</p>
                <input type="time" class="form-control" id="datepicker" placeholder="Select Date">

                <button class="btn btn-primary mt-2" onclick="showDoctorList()">Next</button>
                <button class="btn btn-danger mt-2" onclick="removerOverlay()">Cancel</button>

            </div>
        </div>
    </div>

    <script>
        function showAppointmentOverlay(patientId) {
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