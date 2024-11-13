
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/logoPearl.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: lightcyan;
        }
        .header {
            background-color: #217807;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .header img {
            height: 50px;
            vertical-align: middle;
        }
        .header h1 {
            display: inline;
            font-size: 24px;
            margin: 0;
            padding-left: 10px;
        }
        .header p {
            margin: 0;
            font-size: 12px;
        }
        .sidebar {
            height: 100%;
            width: 250px; /* Set width of sidebar */
            position: fixed;
            top: 0;
            left: -250px; /* Hide sidebar off-screen */
            background-color: #136c15;
            transition: left 0.3s ease;
            z-index: 1000; /* Ensure sidebar is above other content */
        }
        .sidebar.active {
            left: 0; /* Show sidebar when active */
        }
        .sidebar .nav-link {
            color: white;
            padding: 15px;
            text-align: left;
            transition: background-color 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: #8B0000;
        }
        .toggle-btn {
            position: fixed;
            top: 20px; /* Adjusted for better visibility */
            left: 20px; /* Adjusted for better visibility */
            z-index: 1001; /* Above sidebar */
            padding: 10px 15px; /* Increased padding for better touch target */
            border: none;
            background-color: #136c15; /* Match sidebar color */
            color: white;
            font-size: 24px; /* Increased font size */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor */
            transition: background-color 0.3s, transform 0.3s; /* Transition effects */
        }
        .toggle-btn:hover {
            background-color: #8B0000; /* Change color on hover */
        }
        .toggle-btn.active {
            transform: rotate(90deg); /* Rotate button when active */
        }
        .control-number {
            text-align: center;
            margin-top: 15px;
            font-size: 18px;
            color: #333;
        }
    </style>



</head>
<body>
    <div class="header">
        <img alt="logoG" src="../assets/images/logoPearl.png" />
        <h1>PEARL OF THE ORIENT THEOLOGICAL SEMINARY AND COLLEGES INC.</h1>
        <p>B151 L14-20 Ph1, Mabuhay City Subd., Paliparan III, Dasmariñas, Philippines</p>
    </div>
    
    <button class="btn toggle-btn" id="toggleSidebar" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <nav class="sidebar" id="sidebar">
        <ul class="navbar-nav">
            <br><br><br><br>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Profile</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Schedule</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Grades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Password</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Log Out</a>
            </li>
        </ul>
    </nav>

    <div class="control-number">
        <?php echo "Control Number: " . $_SESSION['control_num']; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            toggleSidebar.classList.toggle('active'); // Toggle active class on button
        });

        // Display the Alertify notification if showAlert is true
        <?php if ($showAlert): ?>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('Welcome to Applicant Portal, <?php echo $_SESSION['username']; ?>');
        <?php endif; ?>
    </script>
</body>
</html>

