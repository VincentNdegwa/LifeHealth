<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management</title>
    <link rel="stylesheet" href="styles/appointment.css">


</head>

<script src="./scripts/appointment.js"></script>

<body>
    <!-- Appointment Overlay -->
    <div class="overlay" id="appointmentOverlay">
        <div class="overlay-content">
            <h3>Schedule Appointment</h3>
            <p>Select appointment date and time:</p>
            <form action="" method="get">
                <input type="text" name="id" class="id_input form-control" readonly>
                <input type="date" name="date" class="form-control" placeholder="Delect Date">
                <input type="time" name="time" class="form-control" id="datepicker" placeholder="Select Time">

                <button type="submit" class="btn btn-primary mt-2">Next</button>
                <button type="button" class="btn btn-danger mt-2" onclick="removerOverlay()">Cancel</button>
            </form>

        </div>
    </div>
    <?php
    include("./components/header.php");
    include("./Database/Database.php");
    ?>
    <?php
    if ($conn) {
        try {

            $patient_id = "";
            $date = "";
            $time = "";
            $doctor_id = "";

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $patients_array = [];
                $doctors_avalable = [];
                if (isset($_GET["mode"])) {
                    $search = $_GET["search"];
                    $search_query = "SELECT first_name, last_name, p.id, id_number, gender 
                    FROM patients AS p 
                    LEFT JOIN appointments AS app ON p.id = app.patient_id 
                    WHERE app.patient_id IS NULL 
                    AND (first_name LIKE '%" . $search . "%' OR last_name LIKE '%" . $search . "%' OR p.id LIKE '%" . $search . "%')";

                    $results = mysqli_query($conn, $search_query);
                    while ($patient = mysqli_fetch_assoc($results)) {
                        $patients_array[] = $patient;
                    }
                } elseif (isset($_GET["time"]) && $_GET["date"]) {
                    $dateTime = $_GET["date"] . " " . $_GET['time'];
                    $date = $_GET["date"];
                    $time = $_GET["time"];
                    $patient_id = $_GET["id"];
                    $select_query = "SELECT id, first_name, last_name, speciality, open_availability, close_availability FROM doctors WHERE '$dateTime' >= open_availability AND '$dateTime' < close_availability";
                    $select_results = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($select_results)) {
                        $doctors_avalable[] = $row;
                    }
                } elseif (isset($_GET["schedule_doc"])) {
                    $doctor_id = $_GET["doctor_id"];
                    $id_patient = $_GET["patient_id"];
                    print_r($_GET);
                    $insert_query = "INSERT INTO appointments (patient_id, doctor_id)VALUES('$id_patient', '$doctor_id')";
                    mysqli_query($conn, $insert_query);
                    header("Location: appointment.php");
                    exit();
                } else {
                    $select_query = "SELECT first_name, last_name, p.id, id_number, gender FROM patients as p LEFT JOIN appointments as app ON p.id = app.patient_id = p.id WHERE app.patient_id IS NULL";
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
                            <td><button class="btn btn-secondary schedule_button" value="<?php echo $patient["id"] ?>">Schedule</button></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        <?php } else { ?>
            <h3 class="text-info mt-4">There are currently no added patients. Please proceed to the Patient page to add a new patient.</h3>
        <?php } ?>
        <!-- Table of available doctors in the selected time time -->
        <?php if (count($doctors_avalable) > 0) { ?>
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
                    <?php foreach ($doctors_avalable as $doctor) { ?>
                        <tr>
                            <td><?php echo $doctor["first_name"] . " " . $doctor["last_name"] ?></td>
                            <td><?php echo $doctor["speciality"]  ?></td>
                            <td><?php echo $doctor["open_availability"]  ?></td>
                            <td><?php echo $doctor["close_availability"]  ?></td>
                            <td>
                                <form method="get">
                                    <input type="number" name="doctor_id" value="<?php echo $doctor["id"] ?>" />
                                    <input type="text" name="doctor_date" value="<?php echo $date ?>" />
                                    <input type="text" name="doctor_time" value="<?php echo $time ?>" />
                                    <input type="number" name="patient_id" value="<?php echo $patient_id ?>" />

                                    <button class="btn btn-success" name="schedule_doc" value="<?php echo $doctor["first_name"] ?>">Schedule</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        <?php } else { ?>
            <h3 class="text-info mt-4">There are currently no added patients. Please proceed to the Patient page to add a new patient.</h3>
        <?php } ?>


    </div>




</body>

</html>