

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
                    <a class="active" href="/Admin_Caps/students/students.php" style="color: gray; text-decoration: none;">Students</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/subjects/subjects.php">Grades</a>
                </li>
            </ul>
        </div>

        <br><br>

        <div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <h2>Name of The Student</h2>
                <!-- New Button that triggers Modal -->
                <!-- <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button> -->
            </div>
        </div>

<hr>
<br>

<div class="" style="margin-top: -2%;">
            <div class="left" style="display: flex; align-items: center;">
                <p style="font-size: 25px;">Course/Year :</p>
                <span><p style="font-size: 25px; margin-left: 395%;">Department:</p></span>
                <!-- New Button that triggers Modal -->
                <!-- <button id="newButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subjectModal" style="margin-right: auto;">New</button> -->
            </div>
        </div>

        <br><br>


        <!-- DataTable Structure -->
        <div class="table-responsive">
            <table id="applicantsTable" class="display" style="width:100%">
                <thead>
                <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Description</th>
                <th>Unit</th>
                <th>First</th>
                <th>Second</th>
                <th>Third</th>
                <th>Fourth</th>
                <th>Average</th>
                <th>Remarks</th>
                <th>Semester</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>8</td>
                <td>English Plus</td>
                <td>English Plus</td>
                <td>2</td>
                <td>3</td>
                <td>3</td>
                <td>3</td>
                <td>3</td>
                <td>3</td>
                <td>Failed</td>
                <td>First</td>
                <td><a href="#">+ Add grades</a></td>
            </tr>
            <tr>
                <td>40</td>
                <td>Eng 111</td>
                <td>CommunicationArts 1</td>
                <td>3</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td></td>
                <td>First</td>
                <td><a href="#">+ Add grades</a></td>
            </tr>
            <!-- Additional rows here -->
                </tbody>
            </table>
        </div>





        <!-- Modal Structure -->
<!-- Modal -->
<div class="modal fade" id="addGradesModal" tabindex="-1" role="dialog" aria-labelledby="addGradesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGradesModalLabel">Add Grades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gradesForm">
          <div class="form-group">
            <label for="subject">Subject:</label>
            <textarea class="form-control" id="subject" rows="1" readonly></textarea>
          </div>
          <div class="form-group">
            <label for="firstGrading">First Grading:</label>
            <input type="number" class="form-control" id="firstGrading">
          </div>
          <div class="form-group">
            <label for="secondGrading">Second Grading:</label>
            <input type="number" class="form-control" id="secondGrading">
          </div>
          <div class="form-group">
            <label for="thirdGrading">Third Grading:</label>
            <input type="number" class="form-control" id="thirdGrading">
          </div>
          <div class="form-group">
            <label for="fourthGrading">Fourth Grading:</label>
            <input type="number" class="form-control" id="fourthGrading">
          </div>
          <div class="form-group">
            <label for="average">Average:</label>
            <input type="number" class="form-control" id="average" readonly>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveGrades">Save</button>
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

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>