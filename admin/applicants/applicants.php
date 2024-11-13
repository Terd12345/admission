

<?php 
include '../database/db_conn.php'; 

// Fetch applicants data from the database with a JOIN on the course table
// $sql = "SELECT applicants.id, applicants.given_name, applicants.middle_name, applicants.last_name, 
//                applicants.sex, applicants.address, applicants.age, applicants.contact_no, 
//                applicants.email, course.course_name 
//         FROM applicants 
//         JOIN course ON applicants.course_id = course.course_id"; 
// $result = $conn->query($sql);



$sql = "SELECT id, given_name, middle_name, last_name, 
               sex, address, age, contact_no, 
               email, course.course_name 
        FROM applicants 
        LEFT JOIN course ON applicants.course_id = course.course_id";

$result = $conn->query($sql);
?>

<link rel="shortcut icon" href="../assets/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/plugins/feather/feather.css">
<link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/applicants.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


<?php include "../template/template.php"; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <ul class="breadcrumb">
                        <li><a href="/Admin_Caps/main.php" style="text-decoration: none"; >Home</a></li>
                        <li><i class='bx bx-chevron-right' >></i></li>
                        <li><a class="active" href="/Admin_Caps/applicants/applicants.php">New Applicants</a></li>
                    </ul>
                </div>
                <br><br>
                <div class="" style="margin-top: -2%;">
                    <div class="left" style="display: flex; align-items: center;">
                        <h1>List of Applicants</h1>
                    </div>
                </div>


                <br>

                <!-- <div class="upload-section">
    <h3>Upload Applicants Excel File</h3>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel_file" accept=".xlsx, .xls" required>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div> -->



<!-- Button to trigger the modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
    Upload Applicants Excel File
</button>

<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Applicants Excel File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="excel_file">Select Excel File</label>
                        <input type="file" class="form-control" name="excel_file" accept=".xlsx, .xls" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<br><br>
                

                <div class="table-responsive">
                    <table id="applicantsTable" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";

                                    $full_name = $row['given_name'] . " " ;


                                    if($row['middle_name'] != 'Not Applicable'){
                                        $full_name .= $row['middle_name'];
                                    }

                                    $full_name .=  " " . $row['last_name'];

                                    echo "<td>" . $full_name . "</td>";
                                    echo "<td>" . $row['sex'] . "</td>";
                                    echo "<td>" . $row['age'] . "</td>";
                                    echo "<td>" . $row['address'] . "</td>";
                                    echo "<td>" . $row['contact_no'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['course_name'] . "</td>"; // Display course_name here
                                    echo "<td>
                                            <div class='action-buttons'>
                                                <button class='btn btn-warning confirm-email' title='Email' data-id='" . $row['id'] . "'>
                                                    <i class='fa-solid fa-envelope'></i>
                                                </button>

                                                <button class='btn btn-success'>
                                                    <a href='profile.php?id=" . $row['id'] . "' style='color: white;' title='View'><i class='fa-solid fa-eye'></i></a> 
                                                </button>
                                                
                                                <button class='btn btn-warning confirm-btn' title='Confirm' data-id='" . $row['id'] . "'>
                                                    <i class='fa-solid fa-check'></i>
                                                </button>

                                                <button class='btn btn-danger delete-btn' title='Delete' data-id='" . $row['id'] . "'>
                                                    <i class='fa-solid fa-trash'></i>
                                                </button>
                                            </div>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No applicants found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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

<script>
    var jq = jQuery.noConflict(); // Avoid conflicts with other libraries using $
    jq(document).ready(function() {
        // Initialize DataTable only once
        var table = jq('#applicantsTable').DataTable();

        // Event delegation for Delete button
        jq(document).on('click', '.delete-btn', function() {
            var id = jq(this).data('id'); // Get the data-id for the specific row

            // SweetAlert confirmation for Delete
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
                    // AJAX request to delete the applicant
                    jq.ajax({
                        url: 'delete_applicant.php', // PHP file to handle deletion
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            var result = JSON.parse(response);

                            if (result.status === 'success') {
                                // Show success message
                                Swal.fire('Deleted!', result.message, 'success');
                                // Remove the deleted row from the table
                                table.row(jq(`button[data-id="${id}"]`).parents('tr')).remove().draw();
                            } else {
                                Swal.fire('Error!', result.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong with the request.', 'error');
                        }
                    });
                }
            });
        });

        // Event delegation for Confirm button
        jq(document).on('click', '.confirm-btn', function() {
            var id = jq(this).data('id');

            Swal.fire({
                title: 'Confirm Student',
                text: "Move this applicant to students?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, confirm it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    jq.ajax({
                        url: 'confirm_student.php',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            var result = JSON.parse(response);

                            if (result.status === 'success') {
                                Swal.fire('Confirmed!', result.message, 'success');
                                // Remove the confirmed row from the table
                                table.row(jq(`button[data-id="${id}"]`).parents('tr')).remove().draw();
                            } else {
                                Swal.fire('Error!', result.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong with the request.', 'error');
                        }
                    });
                }
            });
        });
    });








    jq(document).on('click', '.confirm-email', function() {
    var id = jq(this).data('id');
    var button = jq(this); // Reference to the button element

    Swal.fire({
        title: 'Send Email',
        text: "Do you want to send an email to this applicant?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send it!'
    }).then((result) => {
        if (result.isConfirmed) {
            jq.ajax({
                url: 'send_email.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    var result = JSON.parse(response);

                    if (result.status === 'success') {
                        Swal.fire('Sent!', result.message, 'success');
                        button.prop('disabled', true); // Disable the button after sending
                    } else {
                        Swal.fire('Error!', result.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong with the request.', 'error');
                }
            });
        }
    });
});


</script>











<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/js/script.js"></script>
