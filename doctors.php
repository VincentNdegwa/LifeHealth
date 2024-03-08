<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Management</title>
    <link rel="stylesheet" href="styles/doctors.css">
</head>

<body>
    <?php
    include("./components/header.php");
    include("./Database/Database.php");


    ?>

    <?php
    $doctors_array = [];
    try {
        if ($conn != null) {
            if (isset($_POST["add_doc_button"])) {
                date_default_timezone_set('Africa/Nairobi');
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $username = $_POST["username"];
                $speciality = $_POST["speciality"];

                $open_availability = date('Y-m-d H:i:s');
                $close_availability = date('Y-m-d H:i:s', strtotime('+10 hours', strtotime($open_availability)));

                $availability = 'true';

                $insert_query = "INSERT INTO doctors (first_name, last_name, username, speciality, open_availability, close_availability,availability) 
                 VALUES ('$first_name', '$last_name', '$username', '$speciality', '$open_availability', '$close_availability', '$availability')";


                $result = mysqli_query($conn, $insert_query);

                if ($result) {
                    echo "Doctor added successfully";
                } else {
                    $errorMessage = mysqli_error($conn);
                    echo "<script> alert('Error: $errorMessage'); </script>";
                }
                header('Location: doctors.php');
                exit();
            }

            $select_query = "SELECT first_name,last_name,username, speciality, open_availability, close_availability FROM doctors";

            $select_results = mysqli_query($conn, $select_query);
            if ($select_results) {
                while ($doctor = mysqli_fetch_assoc($select_results)) {
                    $doctors_array[] = $doctor;
                }
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
    } catch (\Throwable $th) {
        $errorMessage = addslashes($th->getMessage());
        echo "<script>
            alert('Error: $errorMessage');
          </script>";
    }
    ?>
    <div class="container">
        <h2 class="text-center mb-4">Doctor Management</h2>

        <!-- Toggle Button -->
        <button class="btn btn-primary mb-3" id="toggleButton">Add New Doctor</button>

        <!-- Add Doctor Form -->
        <div class="add-doctor-form card d-none">
            <div class="card-body">
                <h5 class="card-title">New Doctor</h5>
                <form method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter last name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="doctorName">Doctor Name</label>
                            <input type="text" name="username" class="form-control" id="doctorName" placeholder="Enter doctor's name eg Dr John" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="speciality">Speciality</label>
                            <input type="text" name="speciality" class="form-control" id="speciality" placeholder="Enter speciality" required>
                        </div>
                    </div>

                    <button type="submit" name="add_doc_button" class="btn btn-primary">Add Doctor</button>
                </form>
            </div>
        </div>

        <!-- Doctor List -->
        <div class="doctor-list">
            <!-- Filter and Search -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Filter and Search</h5>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="specialityFilter">Speciality</label>
                            <input type="text" class="form-control" id="specialityFilter" placeholder="Enter speciality">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="availabilityFilter">Availability</label>
                            <select id="availabilityFilter" class="form-control">
                                <option value="">All</option>
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="searchDoctor">Search</label>
                            <input type="text" class="form-control" id="searchDoctor" placeholder="Enter doctor's name">
                        </div>
                    </div>
                </div>
                <h5 class="mb-3">Existing Doctors</h5>
                <div class="doctor-card card">
                    <div class="card-body">
                        <?php if (count($doctors_array) > 0) { ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Speciality</th>
                                            <th>Availability</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($doctors_array as $doctor) { ?>
                                            <tr>
                                                <td class="text-nowrap overflow-hidden" style="max-width: 200px;">
                                                    <?php echo $doctor["first_name"] . " " . $doctor["last_name"]; ?>
                                                </td>
                                                <td class="text-nowrap overflow-hidden" style="max-width: 150px;">
                                                    <?php echo $doctor["username"]; ?>
                                                </td>
                                                <td class="text-nowrap overflow-hidden" style="max-width: 200px;">
                                                    <?php echo $doctor["speciality"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    date_default_timezone_set('Africa/Nairobi');
                                                    echo date(date('Y-m-d H:i:s')) . "," .  $doctor["open_availability"];
                                                    if (date('Y-m-d H:i:s') > $doctor["open_availability"] && date('Y-m-d H:i:s') < $doctor["close_availability"]) {
                                                        echo '<span class="badge badge-success">Available</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Not Available</span>';
                                                    }
                                                    ?>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <h3 class="text-info">No Doctor available, Please proceed to Doctors page to add one</h3>
                        <?php } ?>

                    </div>
                </div>
                <!-- Add more doctor cards as needed -->
            </div>

        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var toggleButton = document.getElementById("toggleButton");
                var addDoctorForm = document.querySelector(".add-doctor-form");
                var doctorList = document.querySelector(".doctor-list");
                var overlay = document.getElementById("overlay");

                // Toggle button functionality
                toggleButton.addEventListener("click", function() {
                    if (addDoctorForm.classList.contains("d-none")) {
                        addDoctorForm.classList.replace("d-none", "d-block")
                        doctorList.style.display = "none"
                        toggleButton.innerText = "View Doctors"
                    } else {
                        doctorList.style.display = "block"
                        addDoctorForm.classList.replace("d-block", "d-none")
                        toggleButton.innerText = "Add New Doctor"

                    }
                });
            });
        </script>
</body>

</html>