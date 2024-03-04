<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="styles/header.css">
    <title>LifeHealth</title>
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">LifeHealth</a>
        <i class="fas fa-bars" id="toggleNav"></i>
        <div class="navbar-nav">
            <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a class="nav-link" href="patient.php"><i class="fas fa-user"></i> Patient</a>
            <a class="nav-link" href="doctors.php"><i class="fas fa-user-md"></i> Doctors</a>
            <a class="nav-link" href="medicine.php"><i class="fas fa-pills"></i> Medicine</a>
            <a class="nav-link" href="appointment.php"><i class="far fa-calendar-alt"></i> Appointments</a>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var toggleNavButton = document.getElementById("toggleNav");
                var navbarNav = document.querySelector(".navbar-nav");

                toggleNavButton.addEventListener("click", function() {
                    navbarNav.style.display = (navbarNav.style.display === "flex") ? "none" : "flex";
                });
            });
        </script>
    </nav>
</body>

</html>