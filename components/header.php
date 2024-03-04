<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Database</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Connection Failed
                </div>
            </div>
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