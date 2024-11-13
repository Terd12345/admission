


<?php

include '../database/db_conn.php'; // Include the database connection


$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);

$sql = "SELECT subjects.*, course.course_name 
        FROM subjects 
        JOIN course ON subjects.course_id = course.course_id";

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

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
        <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/main.php" style="color: gray; text-decoration: none;">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/subjects/subjects.php">Subjects</a>
                </li>
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h1>List of Subjects</h1>
                <!-- New Button that triggers Modal -->
                <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button>
            </div>
        </div>

        <!-- DataTable Structure -->
        <div class="table-responsive" style="overflow-x: hidden;">
            <table id="applicantsTable" class="display table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Pre-Requisite</th>
                        <th>Course</th>
                        <th>Semester</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['subj_id']}</td>
                        <td style='width: 20%;'>{$row['subj_code']}</td>
                        <td>{$row['subj_desc']}</td>
                        <td>{$row['unit']}</td>
                        <td>{$row['pre_requisite']}</td>
                        <td>{$row['course_id']}</td>
                        <td>{$row['semester']}</td>
                      
                        <td>
                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['subj_id']}'>Edit</button>
                            <button class='btn btn-danger delete-btn' data-id='{$row['subj_id']}'>Delete</button>
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
    </div>
</div>

<!-- Bootstrap Modal for adding new subject -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">Add New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addSubj" method="POST" action="subject_action.php">
                <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="subj_code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" name="subj_code" id="subj_code" placeholder="Enter subject name">
                    </div>
                    <div class="mb-3">
                        <label for="subj_desc" class="form-label">Description</label>
                        <textarea class="form-control" name="subj_desc" id="subj_desc" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="number" name="unit" class="form-control" id="unit" placeholder="Enter unit">
                    </div>
                    <div class="mb-3">
                        <label for="pre_requisite" class="form-label">Pre-Requisite</label>
                        <input type="text" name="pre_requisite" class="form-control" id="pre_requisite" placeholder="Enter pre-requisite">
                    </div>
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <input type="text" name="course_id" class="form-control" id="course_id" placeholder="Enter course/year">
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-control" name="semester" id="semester" required>
                            <option disabled selected>--Select--</option>
                            <option>First</option>
                            <option>Second</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="addSubj" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>




<!-- Bootstrap Modal for editing subject -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSubj">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="editSubjId">
                    <input type="hidden" name="id" id="editSubjId">
                    <div class="mb-3">
                        <label for="editSubjectCode" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" name="editSubjectCode" id="editSubjectCode" placeholder="Enter subject name">
                    </div>
                    <div class="mb-3">
                        <label for="editSubjectDesc" class="form-label">Description</label>
                        <textarea class="form-control" name="editSubjectDesc" id="editSubjectDesc" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editSubjectUnit" class="form-label">Unit</label>
                        <input type="number" class="form-control" name="editSubjectUnit" id="editSubjectUnit" placeholder="Enter unit">
                    </div>
                    <div class="mb-3">
                        <label for="editSubjectPreReq" class="form-label">Pre-Requisite</label>
                        <input type="text" class="form-control" name="editSubjectPreReq" id="editSubjectPreReq" placeholder="Enter pre-requisite">
                    </div>
                    <div class="mb-3">
                        <label for="editSubjectCourse" class="form-label">Course</label>
                        <input type="text" class="form-control" name="editSubjectCourse" id="editSubjectCourse" placeholder="Enter course/year">
                    </div>
                    <div class="mb-3">
                        <label for="editSubjectSemester" class="form-label">Semester</label>
                        <select class="form-control" name="editSubjectSemester" id="editSubjectSemester">
                            <option disabled selected>--Select--</option>
                            <option>First</option>
                            <option>Second</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
    // Handle form submission for adding a new course
    jq('#newButton').on('click', function() {
        jq('#addSubj').trigger("reset"); // Reset the form
    });

    jq('#addSubj').on('submit', function(e) {
        e.preventDefault();
        var formData = jq(this).serialize() + "&action=add";
        jq.ajax({
            url: 'subject_action.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Subject Added',
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
            url: 'subject_action.php',
            type: 'POST',
            data: { id: id, action: 'fetch' },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                jq('#editSubjId').val(response.data.subj_id);
                jq('#editSubjectCode').val(response.data.subj_code);
                jq('#editSubjectDesc').val(response.data.subj_desc);
                jq('#editSubjectUnit').val(response.data.unit);
                jq('#editSubjectPreReq').val(response.data.pre_requisite);
                jq('#editSubjectCourse').val(response.data.course_id);
                jq('#editSubjectSemester').val(response.data.semester);
            } else {
                Swal.fire('Error', response.message, 'error');
            }
            }
        });
    });

    // Save changes in Edit modal
    jq('#editModal .btn-primary').on('click', function() {
    var id = jq('#editSubjId').val(); // Get the subject ID
    var subjectCode = jq('#editSubjectCode').val();
    var subjectDesc = jq('#editSubjectDesc').val();
    var unit = jq('#editSubjectUnit').val();
    var preRequisite = jq('#editSubjectPreReq').val();
    var courseId = jq('#editSubjectCourse').val();
    var semester = jq('#editSubjectSemester').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to update this subject!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#27ae60',
        cancelButtonColor: '#2980b9',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            jq.ajax({
                url: 'subject_action.php', // Your server-side script to update data
                type: 'POST',
                data: {
                    id: id,
                    subj_code: subjectCode,
                    subj_desc: subjectDesc,
                    unit: unit,
                    pre_requisite: preRequisite,
                    course_id: courseId,
                    semester: semester,
                    action: 'edit'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Updated!', 'Your subject has been updated.', 'success').then(() => {
                            location.reload(); // Refresh the page
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
                url: 'subject_action.php',
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