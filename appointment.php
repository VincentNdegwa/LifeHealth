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
    if ($conn) {
        try {


            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $patients_array = [];
                $doctors_avalable = [];
                if (isset($_GET["mode"])) {
                    $search = $_GET["search"];
                    $search_query = "SELECT first_name, last_name, id, id_number, gender FROM patients WHERE first_name LIKE '%" . $search . "%' OR last_name LIKE '%" . $search . "%' OR id LIKE '%" . $search . "%'";
                    $results = mysqli_query($conn, $search_query);
                    while ($patient = mysqli_fetch_assoc($results)) {
                        $patients_array[] = $patient;
                    }
                } elseif (isset($_GET["time"])) {
                    $url = 'http://localhost:5000/schedule';
                    $data = ['time' => $_GET["time"]];
                    $options = [
                        'http' => [
                            'header' => 'Content-Type: application/json',
                            'method' => 'POST',
                            'content' => json_encode($data),
                        ],
                    ];
                    $context = stream_context_create($options);
                    $result = file_get_contents($url, false, $context);
                    $decoded_array = json_decode($result, true);

                    $doctors_avalable = $decoded_array;
                    print_r($doctors_avalable);
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
        <!-- Table of available doctors in the selected time time -->
        <?php if (count($doctors_avalable["data"]) > 0) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Open</th>
                        <th>Close</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctors_avalable["data"] as $doctor) { ?>
                        <tr>
                            <td><?php echo $doctor["first_name"] . " " . $doctor["last_name"] ?></td>
                            <td><?php echo $doctor["speciality"]  ?></td>
                            <td><?php echo $doctor["open_availability"]  ?></td>
                            <td><?php echo $doctor["close_availability"]  ?></td>
                            <td><button class="btn btn-success" onclick="showAppointmentOverlay(<?php echo $patient['id'] ?>)">Schedule</button></td>
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
                <form action="" method="get">
                    <input type="time" name="time" class="form-control" id="datepicker" placeholder="Select Date">

                    <button type="submit" class="btn btn-primary mt-2">Next</button>
                    <button type="button" class="btn btn-danger mt-2" onclick="removerOverlay()">Cancel</button>
                </form>

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