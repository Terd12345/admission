<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pearl of The Orient</title>
    <link rel="shortcut icon" href="./assets/images/logopearl.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="./assets/css/style.css">
</head>


<body data-bs-spy="scroll" data-bs-target=".navbar">




 <!-- DATE AND TIME WITH NAVBAR -->
<div class="sticky-top bg-light">
    <!-- DATE AND TIME DISPLAY -->
    <div class="container-fluid text-center py-2 date-time-container">
        <span id="date-time" class="text-dark fw-bold" style="font-size: 0.9rem;"></span>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./assets/images/logopearl.png" alt="" height="100px" width="100px">Pearl of The Orient
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php#hero">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">About Us</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php#about">Vision, Mission and Philosophy</a></li>
                            <li><a class="dropdown-item" href="index.php#map">Location</a></li>
                            <li><a class="dropdown-item" href="employee.php#admin">Staff Directory</a></li>
                            <li><a class="dropdown-item" href="index.php#portfolio">Our Seminary Grounds</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="index.php#reviews">Courses</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admissions</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php#proc">How to Apply</a></li>
                            <li><a class="dropdown-item" href="index.php#services">Why Pearl of The Orient?</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="news.php#articles">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#portfolio">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="./studentsPortal/" target="_blank">Student Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>





    <script>
        function updateTime() {
            const dateTimeDisplay = document.getElementById('date-time');
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            dateTimeDisplay.textContent = now.toLocaleDateString('en-US', options);
        }
        setInterval(updateTime, 1000);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="./assets/js/main.js"></script>