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
    include("./components/header.php")
    ?>
    <div class="container">
        <h2 class="text-center mb-4">Doctor Management</h2>

        <!-- Toggle Button -->
        <button class="btn btn-primary mb-3" id="toggleButton">Add New Doctor</button>

        <!-- Add Doctor Form -->
        <div class="add-doctor-form card d-none">
            <div class="card-body">
                <h5 class="card-title">New Doctor</h5>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="doctorName">Doctor Name</label>
                            <input type="text" class="form-control" id="doctorName" placeholder="Enter doctor's name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="speciality">Speciality</label>
                            <input type="text" class="form-control" id="speciality" placeholder="Enter speciality" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Doctor</button>
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
                        <h5 class="card-title">Doctor Name</h5>
                        <p class="card-text">ID: 123 | Status: Available</p>
                        <button class="btn btn-success set-availability">Set Availability</button>
                    </div>
                </div>
                <!-- Add more doctor cards as needed -->
            </div>

            <!-- Availability Overlay -->
            <div class="overlay" id="overlay">
                <div class="overlay-content">
                    <h5>Select Availability Reasons</h5>
                    <!-- Add reasons selection content (checkboxes, buttons, etc.) -->
                    <button class="btn btn-primary close-overlay">Close</button>
                </div>
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

                // Set Availability button functionality
                document.addEventListener("click", function(event) {
                    if (event.target.classList.contains("set-availability")) {
                        overlay.style.display = "flex";
                    }
                });

                // Close overlay button functionality
                document.addEventListener("click", function(event) {
                    if (event.target.classList.contains("close-overlay")) {
                        overlay.style.display = "none";
                    }
                });
            });
        </script>
</body>

</html>