<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management</title>
    <style>
        .container {
            margin-top: 50px;
        }

        .patient-list {
            display: block;
        }

        .add-patient-form {
            display: "" !important;
        }

        .patient-card {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <?php
    include("./components/header.php")
    ?>

    <div class="container">
        <h2 class="text-center mb-4">Patient Management</h2>

        <!-- Toggle Button -->
        <button class="btn btn-primary mb-3" id="toggleButton">Add New Patient</button>

        <!-- Add Patient Form -->
        <div class="add-patient-form d-none">
            <div class="card-body">
                <h5 class="card-title">New Patient</h5>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="idNumber">ID Number</label>
                            <input type="text" class="form-control" id="idNumber" placeholder="ID Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select id="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber" placeholder="Phone Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" placeholder="Age" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="conditions">Conditions</label>
                        <textarea class="form-control" id="conditions" rows="3" placeholder="Enter conditions"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Patient</button>
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