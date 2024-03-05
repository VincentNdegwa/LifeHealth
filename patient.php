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
    try {
        if ($conn != null) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_patient_button"])) {
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
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="genderFilter">Gender</label>
                                <select id="genderFilter" class="form-control">
                                    <option value="">All</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="statusFilter">Status</label>
                                <select id="statusFilter" class="form-control">
                                    <option value="">All</option>
                                    <option value="treated">Treated</option>
                                    <option value="notTreated">Not Treated</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="search">Search</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" placeholder="Enter name or ID number">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <h5 class="mb-3">Existing Patients</h5>
            <div class="patient-card card">
                <div class="card-body">
                    <h5 class="card-title">Patient Name</h5>
                    <p class="card-text">ID: 123 | Gender: Female | Status: Treated</p>
                    <button class="btn btn-success">Assign Doctor</button>
                </div>
            </div>
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