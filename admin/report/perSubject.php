<html>
<head>
    <title>Pearl of The Orient</title>
    

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
        /* .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            display: flex;
            align-items: center;
        }
        .header h1 i {
            margin-right: 10px;
        }
        .header .date {
            font-size: 14px;
        } */
        .form-inline {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-inline select, .form-inline input {
            margin-right: 10px;
        }
        .table-container {
            margin-top: 20px;
        }
        .table-container .total-students {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
        .table-container .total-students .print-btn {
            margin-left: 10px;
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
                    <a href="/admin_page/index.php" style="color: gray;">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/utilization/utilization.php">Report</a>
                </li>

                <li><i class='bx bx-chevron-right' >></i></li>

                <li>
                    <a class="active" href="/Admin_Caps/report/report.php">Per Subject</a>
                </li>

            </ul>
        </div>
<br>

   
           <span> <h1><i class="fas fa-globe"></i>Pearl of The Orient <span></h1>
            <div class="date" style="float: right; font-weight: bold; color: gray;">Date: 10/15/2024</div><br><br> 
        </div>
        <form class="form-inline">
            <div class="form-group" style="margin-left: 80%;">
                <label for="academicYear">Subject</label>
                <select class="form-control" id="academicYear">
                    <option>English</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="table-container">
            <h2><i class="fas fa-globe"></i>List Of Students</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID.</th>
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
                    <!-- Add student rows here -->
                </tbody>
            </table>
            <div class="total-students">
                <div>Total Number of Student/s : 0</div>
                <button class="btn btn-primary print-btn">Print</button>
            </div>
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