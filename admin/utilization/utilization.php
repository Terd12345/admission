<html>
<head>


<link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <style>
        /* .schedule-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .schedule-header i {
            font-size: 24px;
            margin-right: 10px;
        }
        .schedule-header h2 {
            margin: 0;
        } */
        .form-inline {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        /* .form-inline .form-group {
            margin-right: 10px;
        } */
        /* .table-container {
            margin-top: 20px;
        }
        .btn-print {
            float: right;
        } */

             /* Restore breadcrumb styling */
    ul.breadcrumb {
        padding: 10px 1px;
        list-style: none;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    ul.breadcrumb li {
        display: inline;
        font-size: 18px;
    }

    ul.breadcrumb li a {
        /* color: #007bff; */
        text-decoration: none;
        padding: 0 5px;
    }

    ul.breadcrumb li a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    ul.breadcrumb li i {
        margin: 0 10px;
        color: #6c757d;
    }

    ul.breadcrumb li:last-child a {
        color: #6c757d;
        pointer-events: none;
    }

    ul.breadcrumb li:last-child a.active {
        font-weight: bold;
    }
    </style>
</head>
<body>


<?php include "../template/template.php"; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
        <ul class="breadcrumb">
                <li>
                    <a href="/admin_caps/main.php" style="color: gray; text-decoration: none">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/utilization/utilization.php">Classroom Utilization</a>
                </li>
            </ul>
        </div>

        <br><br>



    <!-- <div class="container"> -->
        <div class="form-inline">
            <div class="form-group">
                <label for="days">Day(s)</label>
                <select class="form-control" id="days">
                    <option>MWF</option>
                    <option>TT</option>
                    <option>SS</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" id="semester">
                    <option>First</option>
                    <option>Second</option>
                </select>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <select class="form-control" id="time">
                    <option>07:30 am-08:30 am</option>
                    <option>08:30 am-09:30 am</option>
                    <option>09:30 am-10:30 am</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="schedule-header">
            <i class="fas fa-globe"></i>
            <h2>List Of Schedules</h2>
        </div>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Days</th>
                        <th>Subject</th>
                        <th>Semester</th>
                        <th>School Year</th>
                        <th>Course and Year</th>
                        <th>Room</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add rows here as needed -->
                </tbody>
            </table>
        </div><br>
        <button class="btn btn-primary btn-print">Print</button>
    </div>




    </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>




<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>