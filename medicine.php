<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Management</title>
    <link rel="stylesheet" href="styles/medicine.css">

    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    include("./components/header.php");
    include("./Database/Database.php");

    $medicine_array = [];
    if (isset($_POST["add_medicine"])) {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $measurement = mysqli_real_escape_string($conn, $_POST["measurements"]);

        $count_query = "SELECT `count`, `id` FROM medicines WHERE name = '$name' AND measurements = '$measurement' LIMIT 1";
        $results = mysqli_query($conn, $count_query);

        if ($results) {
            $row = mysqli_fetch_assoc($results);
            $count = $row['count'];
            if ($count > 0) {
                $insert_query = "UPDATE medicines SET `count` = `count` + 1 WHERE name = '$name' AND measurements = '$measurement'";
            } else {
                $insert_query = "INSERT INTO medicines (`name`, `measurements`, `count`) VALUES ('$name', '$measurement', '1')";
            }
        } else {
            $insert_query = "INSERT INTO medicines (`name`, `measurements`, `count`) VALUES ('$name', '$measurement', '0')";
        }

        mysqli_query($conn, $insert_query);

        if (mysqli_error($conn)) {
            echo "Error executing the query: " . mysqli_error($conn);
        } else {
            echo "Medicine added successfully.";
        }
        header('Location: medicine.php');
        exit();
    }
    $select_query = "SELECT * FROM medicines";
    $result = mysqli_query($conn, $select_query);
    while ($row = mysqli_fetch_assoc($result)) {
        $medicine_array[] = $row;
    }
    ?>
    <div class="container">
        <h2 class="text-center mb-4">Medicine Management</h2>

        <!-- Toggle Button -->
        <button class="btn btn-primary mb-3" id="toggleButtonMedicine">Add New Medicine</button>

        <!-- Add Medicine Form -->
        <div class="add-medicine-form card d-none">
            <div class="card-body">
                <h5 class="card-title">New Medicine</h5>
                <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="medicineName">Medicine Name</label>
                            <input type="text" class="form-control" name="name" id="medicineName" placeholder="Enter medicine's name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unitGrams">Unit in Grams</label>
                            <input type="text" name="measurements" class="form-control" id="unitGrams" placeholder="Enter unit in grams" required>
                        </div>
                    </div>
                    <button type="submit" name="add_medicine" class="btn btn-primary">Add Medicine</button>
                </form>
            </div>
        </div>



        <div class="row medicine-list">
            <!-- Medicine List -->

            <div class="col-md-6">
                <h5 class="mb-3">All Medicines</h5>
                <?php foreach ($medicine_array as $medicine) { ?>
                    <div class="medicine-card card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $medicine["name"] ?></h5>
                            <p class="card-text">Grams: <span class="badge badge-success"><?php echo $medicine["measurements"] ?></span> | Count: <span class="badge badge-success"><?php echo $medicine["count"] ?></span></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Chart Container -->
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="medicineChart"></canvas>
                </div>
            </div>
        </div>


        <!-- Availability Overlay -->
        <div class="overlay" id="overlayMedicine">
            <div class="overlay-content">
                <h5>Select Availability Reasons</h5>
                <!-- Add reasons selection content (checkboxes, buttons, etc.) -->
                <button class="btn btn-primary close-overlay">Close</button>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var toggleButtonMedicine = document.getElementById("toggleButtonMedicine");
                var addMedicineForm = document.querySelector(".add-medicine-form");
                var medicineList = document.querySelector(".medicine-list");
                var overlayMedicine = document.getElementById("overlayMedicine");
                var chartContainer = document.querySelector(".chart-container");


                let medicineArray = <?php echo json_encode($medicine_array); ?>;
                console.log(medicineArray)
                var medicineData = {
                    labels: medicineArray.map((item) => item.name),
                    datasets: [{
                        label: 'Medicine Counts',
                        data: medicineArray.map((item) => item.count),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 0.1
                    }]
                };
                renderMedicineChart();

                // Toggle button functionality
                toggleButtonMedicine.addEventListener("click", function() {
                    if (addMedicineForm.classList.contains("d-none")) {
                        addMedicineForm.classList.replace("d-none", "d-block");
                        medicineList.style.display = "none";
                        chartContainer.style.display = "none";
                        toggleButtonMedicine.innerText = "View Medicines";
                    } else {
                        medicineList.style.display = "block";
                        addMedicineForm.classList.replace("d-block", "d-none");
                        chartContainer.style.display = "block";
                        toggleButtonMedicine.innerText = "Add New Medicine";
                        // Render the chart when switching to view medicines
                        renderMedicineChart();
                    }
                });

                // Close overlay button functionality
                document.addEventListener("click", function(event) {
                    if (event.target.classList.contains("close-overlay")) {
                        overlayMedicine.style.display = "none";
                    }
                });

                // Function to render the medicine count chart
                function renderMedicineChart() {
                    var ctx = document.getElementById('medicineChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: medicineData,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        </script>
    </div>
</body>

</html>