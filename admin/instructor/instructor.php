


<?php

include '../database/db_conn.php';

// Fetch instructors
$sql = "SELECT * FROM instructors"; // Replace 'instructors' with your actual table name
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
                    <a href="/Admin_Caps/main.php" style="color: gray; text-decoration:none;">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/subjects/subjects.php">Instructors</a>
                </li>
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h1>List of Instructors </h1>
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
                <th>Name</th>
                <th>Major</th>
                <th>Contact No.</th>
                <th>E-Mail</th>
                <th>Date of Birth</th>
                <th>Civil Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
       if ($result->num_rows > 0) {
           // Output data of each row
           while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . htmlspecialchars($row['id']) . "</td>
           <td style='max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>" . htmlspecialchars($row['name']) . "</td>
           <td style='max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>" . htmlspecialchars($row['major']) . "</td>
           <td style='max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>" . htmlspecialchars($row['contact']) . "</td>
           <td style='max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>" . htmlspecialchars($row['email']) . "</td>
           <td>" . htmlspecialchars($row['birthday']) . "</td>
           <td>" . htmlspecialchars($row['civil_stats']) . "</td>
          

           <td>
                <a href='profile.php?id=" . $row['id'] . "'>
<button class='btn btn-success'>
<i class='fa-solid fa-eye'></i> 
</button>
</a>
                <button class='btn btn-warning' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#editInstructor'>
                        <i class='fa-solid fa-pencil'></i> 
                    </button>
               <button class='btn btn-danger delete-btn' data-id='" . $row['id'] . "' style='background-color: #e74c3c !important; border-color: #e74c3c !important;'>
                   <i class='fa-solid fa-trash'></i> 
               </button>
           </td>
         </tr>";
}
} else {
echo "<tr><td colspan='4'>No records found</td></tr>";
}
?>
    </tbody>
    </table>
</div>

    </div>
</div>



<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">Add New Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="addInstructorForm" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">

                <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6">
                            <label for="major" class="form-label">Major</label>
                            <textarea class="form-control" id="major" name="major" rows="3" placeholder="Enter Major"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contact" class="form-label">Contact No.</label>
                            <input type="number" class="form-control" id="contact" name="contact" placeholder="Enter Contact Number">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="birthday" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="col-md-6">
                            <label for="civil_stats" class="form-label">Civil Status</label>
                            <input type="text" class="form-control" id="civil_stats" name="civil_stats" placeholder="Enter Civil Status">
                        </div>
                    </div>

                    <!-- File Uploads -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="portfolio" class="form-label">Upload Portfolio</label>
                            <input type="file" class="form-control" id="portfolio" name="portfolio" accept=".docx,.pdf,.png,.jpg,.jpeg">
                        </div>
                        <div class="col-md-6">
                            <label for="cv" class="form-label">Upload CV</label>
                            <input type="file" class="form-control" id="cv" name="cv" accept=".docx,.pdf,.png,.jpg,.jpeg">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="transcripts" class="form-label">Upload Transcripts</label>
                            <input type="file" class="form-control" id="transcripts" name="transcripts" accept=".docx,.pdf,.png,.jpg,.jpeg">
                        </div>
                        <div class="col-md-6">
                            <label for="validId" class="form-label">Upload Valid ID</label>
                            <input type="file" class="form-control" id="valid_id" name="valid_id" accept=".docx,.pdf,.png,.jpg,.jpeg">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="coverLetter" class="form-label">Upload Cover Letter</label>
                        <input type="file" class="form-control" id="cover_letter" name="cover_letter" accept=".docx,.pdf,.png,.jpg,.jpeg">
                    </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
                </form>
            </div>
        </div>
    </div>
</div>







<!-- Edit Modal -->
<div class="modal fade" id="editInstructor" tabindex="-1" aria-labelledby="editInstructorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInstructorLabel">Edit Applicant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST" action="instructor.php">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="editInstId">
                    
                    <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="editName">
                    </div>
                    <div class="col-md-6">
                        <label for="editMajor" class="form-label">Major</label>
                        <textarea type="text" class="form-control" id="editMajor" name="editMajor"> </textarea>
                    </div>
                    </div>

                    <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="editContact" class="form-label">Contact No.</label>
                        <input type="text" class="form-control" id="editContact" name="editContact">
                    </div>
                    <div class="col-md-6">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="editEmail">
                    </div>
                    </div>

                    <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="editBirthday" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="editBirthday" name="editBirthday">
                    </div>
                    <div class="col-md-6">
                        <label for="editCivil_stats" class="form-label">Civil Status</label>
                        <input type="text" class="form-control" id="editCivil_stats" name="editCivil_stats">
                    </div>
                    </div>


                    <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="editPortfolio" class="form-label">Portfolio</label>
                        <input type="file" class="form-control" id="editPortfolio" name="editPortfolio">
                    </div>
                    <div class="col-md-6">
                        <label for="editCv" class="form-label">Cv</label>
                        <input type="file" class="form-control" id="editCv" name="editCv">
                    </div>
                    </div>

                    
                    <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="editTranscripts" class="form-label">Transcripts</label>
                        <input type="file" class="form-control" id="editTranscripts" name="editTranscripts">
                    </div>
                    <div class="col-md-6">
                        <label for="editTranscripts" class="form-label">Valid ID</label>
                        <input type="file" class="form-control" id="editTranscripts" name="editTranscripts">
                    </div>
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
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

    // add function

var jq = jQuery.noConflict();
    jq(document).ready(function() {
        jq('#applicantsTable').DataTable();

        // Handle form submission for adding new instructor
        jq('#addInstructorForm').on('submit', function(e) {
            e.preventDefault(); // Prevent th   e default form submission
            var formData = new FormData(this); // Create FormData object
            jq('#saveButton').prop('disabled', true); // Disable the save button

            jq.ajax({
                url: 'instructor_action.php', // Ensure this URL is correct
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Instructor Added',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Refresh the page after closing the SweetAlert
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while adding the instructor.'
                    });
                },
                complete: function() {
                    jq('#saveButton').prop('disabled', false); // Re-enable the save button
                }
            });
        });
    });



    

  


// Handle edit button click
    jq(document).on('click', '.btn-warning', function() {
        var id = jq(this).data('id');
        // Fetch user data and populate the edit form
        jq.ajax({
            url: 'instructor_action.php',
            type: 'POST',
            data: { id: id, action: 'fetch' }, // Add a fetch action
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Populate the fields with the user data
                    jq('#editInstId').val(response.data.id);
                    jq('#editName').val(response.data.name);
                    jq('#editMajor').val(response.data.major);
                    jq('#editContact').val(response.data.contact);
                    jq('#editEmail').val(response.data.email);
                    jq('#editBirthday').val(response.data.birthday);
                    jq('#editCivil_stats').val(response.data.civil_stats);
                    jq('#editPortfolio').val(response.data.portfolio);
                    jq('#editCv').val(response.data.cv);
                    jq('#editTranscripts').val(response.data.transcripts);
                    jq('#editValid_id').val(response.data.valid_id);
                    jq('#editCover_letter').val(response.data.cover_letter);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });

    // Handle form submission for editing user
    // jq('#editInstForm').on('submit', function(e) {
    //     e.preventDefault();
    //     var formData = jq(this).serialize() + "&action=edit";
    //     jq.ajax({
    //         url: 'instructor_action.php',
    //         type: 'POST',
    //         data: formData,
    //         dataType: 'json',
    //         success: function(response) {
    //             if (response.status === 'success') {
    //                 Swal.fire('Success', response.message, 'success').then(() => {
    //                     location.reload(); // Refresh the page
    //                 });
    //             } else {
    //                 Swal.fire('Error', response.message, 'error');
    //             }
    //         }
    //     });
    // });
    jq('#editInstructor .btn-primary').on('click', function() {
    var id = jq('#editInstId').val(); // Get the subject ID
    var Name = jq('#name').val();
    var Major = jq('#editMajor').val();
    var Contact = jq('#editContact').val();
    var Email = jq('#editEmail').val();
    var Birthday = jq('#editBirthday').val();
    var Civil_stats = jq('#editCivil_stats').val();
    var Portfolio = jq('#editPortfolio').val();
    var Cv = jq('#editCv').val();
    var Transcripts = jq('#editTranscripts').val();
    var Valid_id = jq('#editValid_id').val();
    var Cover_letter = jq('#editCover_letter').val();

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
                url: 'instructor_action.php', // Your server-side script to update data
                type: 'POST',
                data: {
                    id: id,
                    name: Name,
                    major: Major,
                    contact: Contact,
                    email: Email,
                    birthday: Birthday,
                    civil_stats: Civil_stats,
                    action: 'edit'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Updated!', 'Instructor has been updated.', 'success').then(() => {
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

</script>



<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>
    