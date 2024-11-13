<?php 

include "../database/db_conn.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT name, username, role, id FROM users"; // Modify this based on your table structure
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


<?php include "../template/template.php"; ?>


<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">


        <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/main.php" style="color: gray; text-decoration: none;">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/subjects/subjects.php">Users</a>
                </li>
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h1>List of Users</h1>
                <!-- New Button that triggers Modal -->
                <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button>
            </div>
        </div>

       <div class="table-responsive">
       <table id="applicantsTable" class="display" style="width:100%">
           <thead>
               <tr>
                   <th>Account Name</th>
                   <th>Username</th>
                   <th>Role</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
               <?php
               if ($result->num_rows > 0) {
                   // Output data of each row
                   while($row = $result->fetch_assoc()) {
                       echo "<tr>
                               <td>" . htmlspecialchars($row['name']) . "</td>
                               <td>" . htmlspecialchars($row['username']) . "</td>
                               <td>" . htmlspecialchars($row['role']) . "</td>
                               <td>
                                    <a href='../profile/profile.php?id=" . $row['id'] . "'>
        <button class='btn btn-warning'>
            <i class='fa-solid fa-eye'></i> 
        </button>
    </a>
                                    <button class='btn btn-success edit-btn' data-id='" . $row['id'] . "' data-bs-toggle='modal' data-bs-target='#editUserForm'>
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
   




<!-- Add User Modal -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subjectModalLabel">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" method="POST" action="user_actions.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                        </div>
                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                        <!-- Role -->
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="" disabled selected>Select a role</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Registrar">Registrar</option>
                                <option value="Instructor">Instructor</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Contact Number -->
                        <div class="col-md-6 mb-3">
                            <label for="contact_num" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_num" name="contact_num" placeholder="Enter Contact Number" required>
                        </div>
                        <!-- Address -->
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                        </div>
                    </div>


                    <!-- <div class="row">
                    
                        <div class="col-md-6 mb-3">
                            <label for="portfolio" class="form-label">Portfolio</label>
                            <input type="file" class="form-control" id="portfolio" name="portfolio" placeholder="Enter Portfolio File" required>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="cv" class="form-label">CV</label>
                            <input type="file" class="form-control" id="cv" name="cv" placeholder="Enter Address" required>
                        </div>
                    </div>

                    <div class="row">
                    
                        <div class="col-md-6 mb-3">
                            <label for="transcript" class="form-label">Transcripts</label>
                            <input type="file" class="form-control" id="transcripts" name="transcripts" placeholder="Enter Portfolio File" required>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="cover_letter" class="form-label">Cover Letter</label>
                            <input type="file" class="form-control" id="cover_letter" name="cover_letter" placeholder="Enter Address" required>
                        </div>
                    </div> -->


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
<div class="modal fade" id="editUserForm" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="editUserId">
                    
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="editName" placeholder="Enter name" required>
                        </div>
                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" name="editUsername" placeholder="Enter Username" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Role -->
                        <div class="col-md-6 mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole" name="editRole" required>
                                <option value="" disabled selected>Select a role</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Registrar">Registrar</option>
                                <option value="Instructor">Instructor</option>
                            </select>
                        </div>
                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label for="editDob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="editDob" name="editDob" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="editEmail" placeholder="Enter Email" required>
                        </div>
                        <!-- Contact Number -->
                        <div class="col-md-6 mb-3">
                            <label for="editContactNum" class="form-label">Contact Number</label>
                            <input type="number" class="form-control" id="editContactNum" name="editContactNum" placeholder="Enter Contact Number" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Address -->
                        <div class="col-md-6 mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="editAddress" placeholder="Enter Address" required>
                        </div>
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
            url: 'user_actions.php',
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
    jq(document).on('click', '.edit-btn', function() {
        var id = jq(this).data('id');
        // Fetch user data and populate the edit form
        jq.ajax({
            url: 'user_actions.php',
            type: 'POST',
            data: { id: id, action: 'fetch' }, // Add a fetch action
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Populate the fields with the user data
                    jq('#editUserId').val(response.data.id);
                    jq('#editName').val(response.data.name);
                    jq('#editUsername').val(response.data.username);
                    jq('#editRole').val(response.data.role);
                    jq('#editDob').val(response.data.dob);
                    jq('#editEmail').val(response.data.email);
                    jq('#editContactNum').val(response.data.contact_num);
                    jq('#editAddress').val(response.data.address);
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });


    jq('#editUserForm .btn-primary').on('click', function() {
    var id = jq('#editUserId').val(); // Get the subject ID
    var Name = jq('#editName').val();
    var Username = jq('#editUsername').val();
    var Role = jq('#editRole').val();
    var Dob = jq('#editDob').val();
    var Email = jq('#editEmail').val();
    var ContactNum = jq('#editContactNum').val();
    var Address = jq('#editAddress').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "You Want to Update This User!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#27ae60',
        cancelButtonColor: '#2980b9',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            jq.ajax({
                url: 'user_actions.php', // Your server-side script to update data
                type: 'POST',
                data: {
                    id: id,
                    name: Name,
                    username: Username,
                    role: Role,
                    dob: Dob,
                    email: Email,
                    contact_num:ContactNum,
                    address: Address,
                    action: 'edit'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Updated!', 'User Has Been Updated.', 'success').then(() => {
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
                    url: 'user_actions.php',
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
});
</script>


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>
