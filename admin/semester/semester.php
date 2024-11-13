
<?php include '../database/db_conn.php'; // Include the database connection ?>



<?php

include '../database/db_conn.php'; // Include the database connection

if (isset($_POST['sem_id'])) {
    $sem_id = $_POST['sem_id'];

    // Reset all semesters to 0
    $resetQuery = "UPDATE sem SET setsem = 0";
    $conn->query($resetQuery);

    // Set the selected semester to 1
    $setQuery = "UPDATE sem SET setsem = 1 WHERE sem_id = ?";
    $stmt = $conn->prepare($setQuery);
    $stmt->bind_param("i", $sem_id);

    if ($stmt->execute()) {
        echo "Semester updated successfully";
    } else {
        echo "Error updating semester: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();


?>

<!-- Additional CSS and JS for styling and functionality -->
<link rel="shortcut icon" href="../assets/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
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

<!-- Custom Styles -->
<style>
    /* Custom styles for the table and buttons */
    #applicantsTable thead th {
        background-color: #34495e;
        color: #ecf0f1;
        padding: 12px;
    }
    #applicantsTable tbody tr:nth-child(even) { background-color: #f2f2f2; }
    #applicantsTable tbody tr:nth-child(odd) { background-color: #ffffff; }
    #applicantsTable tbody tr:hover { background-color: #d1d8e0; }
    .btn-success { background-color: #27ae60 !important; border-color: #27ae60 !important; color: #fff !important; }
    .btn-warning { background-color: #2980b9 !important; border-color: #2980b9 !important; color: #fff !important; }
    .btn-danger { background-color: #e74c3c !important; border-color: #e74c3c !important; color: #fff !important; }
    ul.breadcrumb { padding: 10px 16px; list-style: none; display: flex; align-items: center; border-radius: 4px; margin-bottom: 20px; }
    ul.breadcrumb li a { color: #007bff; text-decoration: none; padding: 0 5px; }
</style>

<?php include "../template/template.php"; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <ul class="breadcrumb">
                        <li><a href="/Admin_Caps/admin/main.php" style="color: gray; text-decoration: none;">Home</a></li>
                        <li><i class='bx bx-chevron-right'>></i></li>
                        <li><a class="active" style="color: gray;" href="/Admin_Caps/admin/semester/semester.php">Semester</a></li>
                    </ul>
                </div>
                <div class="left" style="display: flex; align-items: center;">
                    <h1>Set Semester</h1>
                </div>
            </div>

            <!-- DataTable Structure -->
            <div class="table-responsive" style="overflow-x: hidden;">
                <table id="applicantsTable" class="display table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Semester Name</th>
                            <th>Current</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
    <?php
    // Fetch data from the `sem` table
    $query = "SELECT * FROM sem";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['semester']}</td>
                    <td>" . ($row['setsem'] == 1 ? "Active" : "Innactive") . "</td>
                    <td>
                        <button class='btn btn-success set-btn' onclick='setSemester({$row['sem_id']})'>Set</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No semesters found</td></tr>";
    }
    ?>
</tbody>

<script>
    function setSemester(semId) {
        $.ajax({
            url: 'set_semester.php', // The PHP script to handle the request
            type: 'POST',
            data: { sem_id: semId },
            success: function(response) {
                // Reload the page or update the table row to reflect changes
                location.reload(); // Refreshes the page to show updated data
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", error);
            }
        });
    }
</script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/js/script.js"></script>
