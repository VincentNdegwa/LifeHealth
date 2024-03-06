<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/header.css">
    <title>Dashboard</title>
</head>


<body>
    <?php
    include("./components/header.php");
    include("./Database/Database.php");

    $patient_count = 0;
    $medicine_count = 0;
    $administered_patients = 0;
    $available_docs = 0;

    $added_patients = [];
    if ($conn) {

        $patient_count_query = "SELECT COUNT(*) as patient_count FROM patients";
        $doctor_count_query = "SELECT COUNT(*) as doctor_count FROM doctors WHERE availability = 'true'";
        $medicine_count_query = "SELECT COUNT(*) as medicine_count FROM medicines";
        $appointment_count_query = "SELECT COUNT(*) as appointment_count FROM appointments";

        $patient_count_result = mysqli_query($conn, $patient_count_query);
        $doctor_count_result = mysqli_query($conn, $doctor_count_query);
        $medicine_count_result = mysqli_query($conn, $medicine_count_query);
        $appointment_count_result = mysqli_query($conn, $appointment_count_query);

        if ($patient_count_result && $doctor_count_result && $medicine_count_result && $appointment_count_result) {
            $patient_count_row = mysqli_fetch_assoc($patient_count_result);
            $patient_count = $patient_count_row['patient_count'];

            $doctor_count_row = mysqli_fetch_assoc($doctor_count_result);
            $doctor_count = $doctor_count_row['doctor_count'];

            $medicine_count_row = mysqli_fetch_assoc($medicine_count_result);
            $medicine_count = $medicine_count_row['medicine_count'];

            $appointment_count_row = mysqli_fetch_assoc($appointment_count_result);
            $appointment_count = $appointment_count_row['appointment_count'];
        } else {
            echo "Error in executing queries: " . mysqli_error($conn);
        }
        $patient_list_query = "SELECT first_name, last_name, id_number, gender FROM patients LIMIT 5";
        $patient_list_result = mysqli_query($conn, $patient_list_query);

        if ($patient_list_result) {
            while ($patient = mysqli_fetch_assoc($patient_list_result)) {
                $added_patients[] = $patient;
            }
        } else {
            echo "Error in executing patient list query: " . mysqli_error($conn);
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
        <h2 class="text-center">Medical Dashboard</h2>

        <!-- Medicine Counts -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Medicine Counts</h5>
                <span><?php echo $medicine_count; ?></span>
            </div>
        </div>

        <!-- Total Number of Patients -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Total Number of Patients</h5>
                <span><?php echo $patient_count; ?></span>
            </div>
        </div>

        <!-- Patients Being Administered -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Patients Being Administered</h5>
                <span><?php echo $administered_patients; ?></span>

            </div>
        </div>

        <!-- Counts of Available Doctors -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Counts of Available Doctors</h5>
                <span><?php echo $available_docs; ?></span>
            </div>
        </div>
        <!-- List of Latest 5 Patients -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Latest 5 Patients</h5>
                <ul class="list-group">
                    <!-- Add your list of latest 5 patients details here -->
                    <?php if (count($added_patients) > 0) { ?>
                        <?php foreach ($added_patients as $item) { ?>
                            <li class="list-group-item">
                                Name: <?php echo $item["first_name"] . " " . $item["last_name"] ?> |
                                ID Number: <?php echo $item["id_number"] ?> |
                                Gender: <?php echo $item["gender"] ?> 
                        <?php }; ?>

                    <?php } else { ?>
                        <h3 class="text-info">No Added patients, Please proceed to Patient page to add patient</h3>
                    <?php } ?>
                    <!-- Add more list items as needed -->
                </ul>
            </div>
        </div>
    </div>
</body>

</html>