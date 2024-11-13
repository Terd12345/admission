
<?php

include '../database/db_conn.php'; // Include the database connection

$sql = "SELECT * FROM course";
$result = $conn->query($sql);

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
                <div class="row">

        <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/main.php" style="color: gray; text-decoration: none">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/subjects/subjects.php">Courses</a>
                </li>
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h1>List of Courses</h1>
                <!-- New Button that triggers Modal -->
                <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button>
            </div>
        </div>

        <!-- DataTable Structure -->
        <div class="table-responsive">
            <table id="applicantsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Level</th>
                        <!-- <th>Units</th> -->
                        <th>Pre-Requisites</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['course_id']}</td>
                        <td >{$row['course_name']}</td>
                        <td>{$row['course_level']}</td>
                         
                        <td style='width: 20%;'>{$row['pre_requisite']}</td>
                      
                        <td>
                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['course_id']}'>Edit</button>
                            <button class='btn btn-danger delete-btn' data-id='{$row['course_id']}'>Delete</button>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No courses found</td></tr>";
        }
        ?>
    </tbody>
            </table>
        </div>  





        <!-- Modal Structure -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCourse" method="POST" action="course_action.php">
                    <input type="hidden" name="action" value="add">
                    <!-- Form fields go here -->
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name" id="course_name" placeholder="Enter Course Name">
                    </div>
                    <div class="mb-3">
                        <label for="course_level" class="form-label">Level</label>
                        <input type="number" class="form-control" name="course_level" id="course_level" placeholder="Enter Level">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="units" class="form-label">Units</label>
                        <input type="number" class="form-control" name="units" id="pre_requisite" placeholder="Enter Number of Units">
                    </div> -->
                    <div class="mb-3">
                        <label for="pre_requisite" class="form-label">Pre-requisite</label>
                        <input type="text" class="form-control" name="pre_requisite" id="pre_requisite" placeholder="Enter Pre-requisite">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="addCourse" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


</div>
</div>






<!-- Bootstrap Modal for editing subject -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCourse">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="editCourseId">
                    <div class="mb-3">
                        <label for="editcourse_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="editcourse_name" id="editcourse_name" placeholder="Enter Course Name">
                    </div>
                    <div class="mb-3">
                        <label for="editcourse_level" class="form-label">Level</label>
                        <input type="number" class="form-control" name="editcourse_level" id="editcourse_level" rows="3" placeholder="Enter Level">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="editunits" class="form-label">Units</label>
                        <input type="number" class="form-control" id="editunits" name="editunits" rows="3" placeholder="Enter Number of Units">
                    </div> -->
                    <div class="mb-3">
                        <label for="editpre-requisite" class="form-label">Pre-Requisite</label>
                        <input type="text" class="form-control" name="editpre-requisite" id="editpre-requisite" placeholder="Enter pre-requisite">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary">Save changes</button>
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


// Add Course functionality
var jq = jQuery.noConflict();
jq(document).ready(function() {
    // Handle form submission for adding a new course
    jq('#newButton').on('click', function() {
        jq('#addCourse').trigger("reset"); // Reset the form
    });

    jq('#addCourse').on('submit', function(e) {
        e.preventDefault();
        var formData = jq(this).serialize() + "&action=add";
        jq.ajax({
            url: 'course_action.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Course Added',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Refresh the page after closing the SweetAlert
                    });
                } else {
                    Swal.fire('Error!', response.message, 'error');
                }
            }
        });
    });
});
            







// Handle Edit button click
jq(document).on('click', '.btn-warning', function() {
        var id = jq(this).data('id');
        jq.ajax({
            url: 'course_action.php',
            type: 'POST',
            data: { id: id, action: 'fetch' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    jq('#editCourseId').val(response.data.course_id);
                    jq('#editcourse_name').val(response.data.course_name);
                    jq('#editcourse_level').val(response.data.course_level);
                    // jq('#editunits').val(response.data.units);
                    jq('#editpre-requisite').val(response.data.pre_requisite);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });

    // Save changes in Edit modal
    jq('#editModal .btn-primary').on('click', function() {
        var id = jq('#editCourseId').val();
        var courseName = jq('#editcourse_name').val();
        var level = jq('#editcourse_level').val();
        // var units = jq('#editunits').val();
        var preRequisite = jq('#editpre-requisite').val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to update this course!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#27ae60',
            cancelButtonColor: '#2980b9',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                jq.ajax({
                    url: 'course_action.php',
                    type: 'POST',
                    data: {
                        id: id,
                        course_name: courseName,
                        course_level: level,
                        // units: units,
                        pre_requisite: preRequisite,
                        action: 'edit'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire('Updated!', 'Your course has been updated.', 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    }
                });
            }
        });
    });







   // JavaScript to handle SweetAlert for the Delete button
   jq(document).on('click', '.delete-btn', function() {
    var id = jq(this).data('id');
    console.log("Delete button clicked for ID:", id); // Debugging line
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
                url: 'course_action.php',
                type: 'POST',
                data: { id: id, action: 'delete' },
                dataType: 'json',
                success: function(response) {
                    console.log("Response from delete:", response); // Debugging line
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
