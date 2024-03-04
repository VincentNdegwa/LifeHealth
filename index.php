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
    include("./Database/Database.php");
    include("./components/header.php");

    if ($conn) {
        echo "connected";
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
                <!-- Add your medicine count details here -->
            </div>
        </div>

        <!-- Total Number of Patients -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Total Number of Patients</h5>
                <!-- Add your total number of patients details here -->
            </div>
        </div>

        <!-- Patients Being Administered -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Patients Being Administered</h5>
                <!-- Add your patients being administered details here -->
            </div>
        </div>

        <!-- Counts of Available Doctors -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Counts of Available Doctors</h5>
                <!-- Add your counts of available doctors details here -->
            </div>
        </div>

        <!-- List of Latest 5 Patients -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Latest 5 Patients</h5>
                <ul class="list-group">
                    <!-- Add your list of latest 5 patients details here -->
                    <li class="list-group-item">Name: John Doe | ID Number: XXXX | ID: 123 | Time Created: 2024-03-04 12:00 PM</li>
                    <li class="list-group-item">Name: Jane Doe | ID Number: YYYY | ID: 124 | Time Created: 2024-03-04 12:30 PM</li>
                    <!-- Add more list items as needed -->
                </ul>
            </div>
        </div>
    </div>
</body>

</html>