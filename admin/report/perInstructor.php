<html>
<head>
    <title>Class List</title>

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
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
        .container {
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
        .total-students {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
        }
        .print-button {
            text-align: right;
            margin-top: 10px;
        }


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



                <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/index.php">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/report/report.php">Report</a>
                </li>

                <li><i class='bx bx-chevron-right' >></i></li>

                <li>
                    <a class="active" href="/Admin_Caps/report/report.php">Per Instructor</a>
                </li>


            </ul>
            </div>
<br><br>    


    <!-- <div class="container"> -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="instructor" class="form-label">Instructor</label>
                <select id="instructor" class="form-select">
                    <option selected>Select</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div class="col-md-3">
                <label for="section" class="form-label">Section</label>
                <select id="section" class="form-select">
                    <option selected>Section 1</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div><br>
        <h2 class="text-center">Class List</h2>
        <hr>
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Instructor :</strong></p>
            </div>
            <div class="col-md-6">
                <p><strong>Day(s)/Time :</strong></p>
            </div>
            <hr>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Subject :</strong></p>
            </div>
            <div class="col-md-6">
                <p><strong>Section :</strong></p>
            </div>
            <hr>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Sex</th>
                    <th>AGE</th>
                    <th>Contact No.</th>
                    <th>Civil Status</th>
                    <th>Course/Year</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add rows as needed -->
            </tbody>
        </table>
        <div class="total-students">
            Total Number of Student/s : 0
        </div>
        <div class="print-button">
            <button type="button" class="btn btn-primary">Print</button>
        </div>
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