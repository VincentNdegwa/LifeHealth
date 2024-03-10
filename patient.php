<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/patient.css">
    <title>Patient Management</title>
</head>

<body>
    <?php
    include("./components/header.php");
    include("./Database/Database.php");
    ?>

    <?php
    $patients_array = [];
    try {
        if ($conn != null) {
            $patients_query = "SELECT id_number, first_name, last_name, status FROM patients ORDER BY id ASC LIMIT 10 ";
            $patient_results = mysqli_query($conn, $patients_query);
            if ($patient_results) {
                while ($row = mysqli_fetch_assoc($patient_results)) {
                    $patients_array[] = $row;
                }
            }
            if (isset($_POST["add_patient_button"])) {
                print_r($_POST);
                $query = "INSERT INTO patients 
                (first_name, last_name, id_number, age, phone_number, gender, conditions) 
                VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[id_number]', '$_POST[age]', '$_POST[phone_number]', '$_POST[gender]', '$_POST[conditions]')";

                $results = mysqli_query($conn, $query);
                if ($results) {
                    echo '<script>
                    alert("Patient Inserted");
                  </script>';
                    header("Location: patient.php");
                    exit();
                } else {
                    echo '<script>
                    alert("Failed to Insert patients");
                  </script>';
                }
            }
        } else {
            echo '<script>
                    alert("Failed to connect to the Database");
                  </script>';
        }

        if (isset($_GET["search_btn"])) {
            $patients_array = [];
            $sql = "SELECT * FROM patients WHERE gender = '{$_GET['gender']}' AND status = '{$_GET['status']}'";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $patients_array[] = $row;
                }

                mysqli_close($conn);
            }
        }
    } catch (\Throwable $th) {
        $errorMessage = addslashes($th->getMessage());
        echo "<script>
            alert('Error: $errorMessage');
          </script>";
    }
    ?>

    <div class="container">
        <h2 class="text-center mt-4">Patient Management</h2>

        <!-- Toggle Button -->
        <button class="btn btn-primary mb-3" id="toggleButton">Add New Patient</button>

        <!-- Add Patient Form -->
        <div class="add-patient-form d-none">
            <div class="card-body">
                <h5 class="card-title">New Patient</h5>
                <form method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idNumber">ID Number</label>
                            <input type="text" name="id_number" class="form-control" id="idNumber" placeholder="ID Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" name="phone_number" class="form-control" id="phoneNumber" placeholder="Phone Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age">Age</label>
                            <input type="number" name="age" class="form-control" id="age" placeholder="Age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="conditions">Conditions</label>
                        <textarea class="form-control" name="conditions" id="conditions" rows="3" placeholder="Enter conditions"></textarea>
                    </div>
                    <button type="submit" name="add_patient_button" class="btn btn-primary">Add Patient</button>
                </form>
            </div>
        </div>

        <!-- Patient List -->
        <div class="patient-list">
            <!-- Filter and Search -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filter and Search</h5>
                    <form method="get">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="genderFilter">Gender</label>
                                <select id="genderFilter" name="gender" class="form-control">
                                    <option value="">All</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="statusFilter">Status</label>
                                <select id="statusFilter" name="status" class="form-control">
                                    <option value="">All</option>
                                    <option value="treated">Treated</option>
                                    <option value="not treated">Not Treated</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="search">Search</label>
                                <div class="input-group">
                                    <button class="btn btn-primary" name="search_btn" value="search" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <h5 class="mb-3">Existing Patients</h5>
            <?php if (count($patients_array) > 0) { ?>
                <div class="patient-card card">
                    <?php foreach ($patients_array as $patient) { ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $patient["first_name"] ?> <?php echo $patient["last_name"] ?></h5>
                            <p class="card-text"> <span class="text-info">ID:</span> <?php echo $patient["id_number"] ?> | <span class="text-info">Status: </span><?php echo $patient["status"] ?> </p>
                        </div>
                    <?php }; ?>

                </div>

            <?php } else { ?>
                <h3 class="text-info">No Added patients, Please proceed to Patient page to add patient</h3>
            <?php  } ?>
            <!-- Add more patient cards as needed -->
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Toggle button functionality
            const toggleButton = document.getElementById("toggleButton");
            const addPatientForm = document.querySelector(".add-patient-form");
            const patientList = document.querySelector(".patient-list");
            addPatientForm.style.display === "none"
            toggleButton.addEventListener("click", function() {

                if (addPatientForm.classList.contains("d-none")) {
                    addPatientForm.classList.replace("d-none", "d-block");
                    patientList.style.display = "none";
                    toggleButton.innerText = "View Patients";
                } else {
                    addPatientForm.classList.replace("d-block", "d-none");
                    patientList.style.display = "block";
                    toggleButton.innerText = "Add New Patient";
                }

            });
        });
    </script>
</body>

</html>