


<?php

include '../database/db_conn.php'; // Include your database connection file

// Fetch schedules from the database
$query = "SELECT * FROM schedule"; // Adjust the table name as per your database
$result = $conn->query($query);

// $instructorsQuery = "SELECT id, name FROM instructors";
// $instructorsResult = $conn->query($instructorsQuery);

// Check for query errors
// if (!$instructorsResult) {
//     die("Database query failed: " . $conn->error);
// }

// $query = "SELECT 
//             s.id,
//             s.time_from, 
//             s.time_to, 
//             s.days, 
//             s.subject, 
//             s.semester, 
//             s.school_year, 
//             s.course_year, 
//             i.name AS instructor_name 
//         FROM 
//             schedule s 
//         JOIN 
//             instructors i ON s.instructor_id = i.id"; 

// $result = $conn->query($query);


?>


<link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<style>
    /* Adjusting table header colors */
    #applicantsTable thead th {
        background-color: #34495e;
        color: #ecf0f1;
        padding: 12px;
    }

    /* Alternating row colors */
    #applicantsTable tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #applicantsTable tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    /* Hover effect for table rows */
    #applicantsTable tbody tr:hover {
        background-color: #d1d8e0;
    }

    /* Button Styles */
    .btn-success {
        background-color: #27ae60 !important;
        border-color: #27ae60 !important;
        color: #fff !important;
    }

    .btn-warning {
        background-color: #2980b9 !important;
        border-color: #2980b9 !important;
        color: #fff !important;
    }

    .btn-danger {
        background-color: #e74c3c !important;
        border-color: #e74c3c !important;
        color: #fff !important;
    }

    /* Restore breadcrumb styling */
    ul.breadcrumb {
        padding: 10px 16px;
        list-style: none;
        /* background-color: #f9f9f9; */
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
        color: #007bff;
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


<?php include "../template/template.php"; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row"></div>


        <div class="row">
        <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/main.php" style="color: gray; text-decoration: none">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/subjects/subjects.php">Schedule</a>
                </li>
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h1>List of Schedules</h1>
                <!-- New Button that triggers Modal -->
                <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button>
            </div>
        </div>

        <!-- DataTable Structure -->
        <div class="table-responsive">
            <table id="applicantsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Days</th>
                        <th>Subject</th>
                        <th>Semester</th>
                        <th>School Year</th>
                        <th>Course & Year</th>
                        <th>Instructor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                // Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generate table rows for each record
        echo "<tr>
                <td>{$row['time_from']} - {$row['time_to']}</td>
                <td>{$row['days']}</td>
                <td>{$row['subject']}</td>
                <td>{$row['semester']}</td>
                <td>{$row['school_year']}</td>
                <td>{$row['course_year']}</td>
                <td>{$row['instructor']}</td>
                <td>
                    <button class='btn btn-warning' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#editModal'>
                        <i class='fa-solid fa-pencil'></i> 
                   </button>
                   <button class='btn btn-danger delete-btn' data-id='" . $row['id'] . "' style='background-color: #e74c3c !important; border-color: #e74c3c !important;'>
                        <i class='fa-solid fa-trash'></i> 
                    </button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found.</td></tr>"; // Display a message if no records exist
}
?>

                </tbody>
            </table>
        </div>






        <!-- The Modal -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">New Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your Form Starts Here -->
                <form id="addScheduleForm" method="POST" action="schedule_action.php">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="time-from" class="form-label">From:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="time_from" name="time_from" required>
                            <span class="input-group-text">To:</span>
                            <input type="time" class="form-control" id="time_to" name="time_to" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="days" class="form-label">Days:</label>
                        <input type="text" class="form-control" id="days" name="days" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester:</label>
                        <select class="form-control" id="semester" name="semester" required>
                            <option disabled selected>--Select Semester--</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="school_year" class="form-label">School Year:</label>
                        <input type="text" class="form-control" id="school_year" name="school_year" required>
                    </div>


                    <div class="mb-3">
                        <label for="course_year" class="form-label">Course Year:</label>
                        <input type="text" class="form-control" id="course_year" name="course_year" required>
                    </div>

                    <div class="mb-3">
                        <label for="instructor" class="form-label">Instructor:</label>
                        <input type="text" class="form-control" id="instructor" name="instructor" required>
                    </div>
                    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addScheduleForm">Save</button>
            </div>
                </form>
                <!-- Your Form Ends Here -->
            </div>
        </div>
    </div>
</div>


</div>
</div>








<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">Edit Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your Form Starts Here -->
                <form id="editScheduleForm">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="editScheduleId">
                    <div class="mb-3">
                        <label for="time-from" class="form-label">From:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="editTime_from" name="time_from" required>
                            <span class="input-group-text">To:</span>
                            <input type="time" class="form-control" id="editTime_to" name="time_to" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="days" class="form-label">Days:</label>
                        <input type="text" class="form-control" id="editDays" name="days" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" class="form-control" id="editSubject" name="subject" required>
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester:</label>
                        <select class="form-control" id="editSemester" name="semester" required>
                            <option disabled selected>--Select Semester--</option>
                            <option value="First">First</option>
                            <option value="Second">Second</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="school_year" class="form-label">School Year:</label>
                        <input type="text" class="form-control" id="editSchool_year" name="school_year" required>
                    </div>


                    <div class="mb-3">
                        <label for="course_year" class="form-label">Course Year:</label>
                        <input type="text" class="form-control" id="editCourse_year" name="course_year" required>
                    </div>

                    <div class="mb-3">
                        <label for="instructor" class="form-label">Instructor:</label>
                        <input type="text" class="form-control" id="editInstructor" name="instructor" required>
                    </div>
                    
                </form>
                <!-- Your Form Ends Here -->
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="editScheduleForm">Save</button>
            </div>
            </div>
        </div>
    </div>
</div>


</div>
</div>





<div class="footer">
            <div class="copyright">
                <p style="font-size: 15px; color: grey;">Pearl of The Orient</p>
            </div>
        </div>


        </div>
            </div>
        </div>
    </div>
</div>


        <script>
    var jq = jQuery.noConflict();
    jq(document).ready(function() {
        jq('#applicantsTable').DataTable();
    });
</script>



<script>

var jq = jQuery.noConflict();
jq(document).ready(function() {
    var table = jq('#applicantsTable').DataTable();

    // Handle form submission for adding new user
    jq('#addScheduleForm').on('submit', function(e) {
        e.preventDefault();
        var formData = jq(this).serialize() + "&action=add";
        jq.ajax({
            url: 'schedule_action.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // alert('User  added successfully: ' + response.message);
                    Swal.fire({
                    icon: 'success',
                    title: 'User Added',
                    text: response.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Refresh the page after closing the SweetAlert
                });
                    // location.reload();
                } else {
                    alert('Error adding user: ' + response.message); // Use alert instead of SweetAlert
                }
            }
        });
    });
});














// Handle edit button click
jq(document).on('click', '.btn-warning', function() {
        var id = jq(this).data('id');
        // Fetch user data and populate the edit form
        jq.ajax({
            url: 'schedule_action.php',
            type: 'POST',
            data: { id: id, action: 'fetch' }, // Add a fetch action
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Populate the fields with the user data
                    jq('#editScheduleId').val(response.data.id);
                    jq('#editTime_from').val(response.data.time_from);
                    jq('#editTime_to').val(response.data.time_to);
                    jq('#editDays').val(response.data.days);
                    jq('#editSubject').val(response.data.subject);
                    jq('#editSemester').val(response.data.semester);
                    jq('#editSchool_year').val(response.data.school_year);
                    jq('#editCourse_year').val(response.data.course_year);
                    jq('#editInstructor').val(response.data.instructor);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });

    // Handle form submission for editing user
    jq('#editScheduleForm').on('submit', function(e) {
        e.preventDefault();
        var formData = jq(this).serialize() + "&action=edit";
        jq.ajax({
            url: 'schedule_action.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        location.reload(); // Refresh the page
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });













    // Handle delete button click
    jq(document).on('click', '.delete-btn', function() {
        var id = jq(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#2980b9',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                jq.ajax({
                    url: 'schedule_action.php',
                    type: 'POST',
                    data: { id: id, action: 'delete' },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire('Deleted!', response.message, 'success').then(() => {
                                location.reload(); // Refresh the page
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });
    });
</script>



<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>
