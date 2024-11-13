<?php include "../template/template.php"; ?>
<?php 

include "../database/db_conn.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT department_name, description, department_id FROM department"; // Modify this based on your table structure
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
    <link rel="stylesheet" href="../assets/css/users.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>




<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">


        <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/index.php" style="color: gray;">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/department/department.php">Department</a>
                </li>
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h1>List of Department</h1>
                <!-- New Button that triggers Modal -->
                <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button>
            </div>
        </div>

       <div class="table-responsive">
       <table id="applicantsTable" class="display" style="width:100%">
           <thead>
               <tr>
                   <th>Department Name</th>
                   <th>Description</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
               <?php
               if ($result->num_rows > 0) {
                   // Output data of each row
                   while($row = $result->fetch_assoc()) {
                       echo "<tr>
                               <td>" . htmlspecialchars($row['department_name']) . "</td>
                               <td>" . htmlspecialchars($row['description']) . "</td>
                               <td>
                                    
                                   <button class='btn btn-warning' data-id='" . $row['department_id'] . "' data-bs-toggle='modal' data-bs-target='#editModal'>
                                        <i class='fa-solid fa-pencil'></i> Edit
                                    </button>
                                   <button class='btn btn-danger delete-btn' data-id='" . $row['department_id'] . "' style='background-color: #e74c3c !important; border-color: #e74c3c !important;'>
                                       <i class='fa-solid fa-trash'></i> Delete
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
   




<!-- Add User Modal -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">New Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="addUserForm" method="POST" action="actionDepartment.php">
                    <input type="hidden" name="action" value="add">

                    <div class="mb-3">
                        <label for="department_name" class="form-label">Department Name</label>
                        <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="addUserForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>




<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="department_id" id="editDepartmentId">
                    <div class="mb-3">
                        <label for="department_name" class="form-label">Department Name</label>
                        <input type="text" class="form-control" id="editDepartment_name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                        <textarea type="text" class="form-control" id="editDescription" name="description" placeholder="Enter description" required></textarea>
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editUserForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
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
    var table = jq('#applicantsTable').DataTable();

    // Handle form submission for adding new user
    jq('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        var formData = jq(this).serialize() + "&action=add";
        jq.ajax({
            url: 'actionDepartment.php',
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






    // Handle edit button click
    jq(document).on('click', '.btn-warning', function() {
        var id = jq(this).data('id');
        // Fetch user data and populate the edit form
        jq.ajax({
            url: 'actionDepartment.php',
            type: 'POST',
            data: { department_id: id, action: 'fetch' }, // Add a fetch action
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Populate the fields with the user data
                    jq('#editDepartmentId').val(response.data.department_id);
                    jq('#editDepartment_name').val(response.data.department_name);
                    jq('#editDescription').val(response.data.description);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });



    // Handle form submission for editing user
    jq('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        var formData = jq(this).serialize() + "&action=edit";
        jq.ajax({
            url: 'actionDepartment.php',
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
                    url: 'actionDepartment.php',
                    type: 'POST',
                    data: { department_id: id, action: 'delete' },
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
});
</script>


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>
