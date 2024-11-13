



<?php 

require '../database/db_conn.php'; // Your DB connection

// Fetch students from the database
// $query = "SELECT * FROM students"; 
// $result = $conn->query($query);

$sql = "SELECT stud_id, id, given_name, middle_name, last_name, 
               sex, address, age, contact_no, 
               email, course.course_name 
        FROM students 
        LEFT JOIN course ON students.course_id = course.course_id";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/students.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>



<?php include '../template/template.php'; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    
                    
                <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/index.php" style="color: gray; text-decoration: none;">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/admin_page/subjects/subjects.php">Students</a>
                </li>
                
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h1>List of Students</h1>
                <!-- New Button that triggers Modal -->
                <!-- <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button> -->
            </div>
        </div>



        <!-- DataTable Structure -->
        <div class="table-responsive">
            <table id="applicantsTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Course</th>
                        <!-- <th>Section</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['stud_id']); ?></td>
            <td style="max-width: 150px;"><?php echo htmlspecialchars($row['given_name'] . ' ' . $row['last_name']); ?></td>
            <td><?php echo htmlspecialchars($row['sex']); ?></td>
            <td><?php echo htmlspecialchars($row['age']); ?></td>
            <td style="max-width: 150px;"><?php echo htmlspecialchars($row['address']); ?></td>
            <td><?php echo htmlspecialchars($row['contact_no']); ?></td>
            <td style="max-width: 150px;"><?php echo htmlspecialchars($row['course_name']); ?></td>
            <!-- <td><?php echo htmlspecialchars($row['section']); ?></td> -->
             <!-- <td>adsfd</td> -->
            <td>
                <button class='btn btn-primary'>
               <?php echo " <a href='profile.php?id=" . $row['id'] . "' style='color: white;' title='View'><i class='fa-solid fa-eye'></i></a> 
                </button> "?>
                <a href="/Admin_Caps/admin/students/grades.php" style="text-decoration: none; color: white;">
                    <button title="Grades" class="btn btn-success">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                </a>
                <button class="btn btn-danger delete-btn" id="delete-btn" title="Delete" data-id="<?php echo htmlspecialchars($row['stud_id']); ?>" style="background-color: #e74c3c !important; border-color: #e74c3c !important;">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
    <?php endwhile; ?>
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
                <form>
                    <!-- Form fields go here -->
                    <div class="mb-3">
                        <label for="departmentName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="departmentName" placeholder="Enter department name">
                    </div>
                    <div class="mb-3">
                        <label for="departmentDesc" class="form-label">Level</label>
                        <input type="number" class="form-control" id="departmentDesc" placeholder="Enter department description">
                    </div>

                    <div class="mb-3">
                        <label for="major" class="form-label">Major</label>
                        <input type="text" class="form-control" id="major" placeholder="Enter department description">
                    </div>
                    <div class="mb-3">
                        <label for="pre_requisite" class="form-label">Pre-Requisite</label>
                        <input type="text" class="form-control" id="pre_requisite" placeholder="Enter department description">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" placeholder="Enter department description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-control" id="department">
                            <option disabled selected>--Select--</option>
                            <option>IS</option>
                            <option>PSYC</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
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
                <form>
                    <div class="mb-3">
                        <label for="courseName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="courseName" placeholder="Enter subject name">
                    </div>
                    <div class="mb-3">
                        <label for="editLevel" class="form-label">Level</label>
                        <input type="text" class="form-control" id="editLevel" rows="3" placeholder="Enter Level">
                    </div>
                    <div class="mb-3">
                        <label for="editMajor" class="form-label">Major</label>
                        <input type="text" class="form-control" id="editMajor" placeholder="Enter Major">
                    </div>
                    <div class="mb-3">
                        <label for="editPreReq" class="form-label">Pre-Requisite</label>
                        <input type="text" class="form-control" id="editPreReq" placeholder="Enter pre-requisite">
                    </div>
                    <div class="mb-3">
                        <label for="editDesc" class="form-label">Description</label>
                        <input type="text" class="form-control" id="editDesc" placeholder="Enter course/year">
                    </div>
                    <div class="mb-3">
                        <label for="editDepartment" class="form-label">Department</label>
                        <select class="form-control" id="editDepartment">
                            <option disabled selected>--Select--</option>
                            <option>IT</option>
                            <option>IICS</option>
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
        jq('#applicantsTable').DataTable();

        // Handle Delete button with SweetAlert
        jq(document).on('click', '.delete-btn', function() {
            var id = jq(this).data('id'); // Get the data-id for the specific row
            var row = jq(this).closest('tr'); // Store reference to the row

            // SweetAlert confirmation
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
                    // If confirmed, proceed with deletion
                    jq.ajax({
                        url: 'actions.php', // Replace with your deletion URL
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.success) {
                                // Remove the row from the DataTable
                                jq('#applicantsTable').DataTable().row(row).remove().draw();
                                Swal.fire(
                                    'Deleted!',
                                    'Your record has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem deleting the record: ' + res.error,
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was a problem with the AJAX request.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });

</script>




<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>