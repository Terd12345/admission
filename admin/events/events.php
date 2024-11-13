<?php include '../template/template.php'; ?>
<?php
include 'db_conn.php';
include 'post_model.php';

// Fetch events data
$sql = "SELECT * FROM events";
$stmt = $pdo->query($sql);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Events</title>
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="content-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <ul class="breadcrumb">
                                        <li><a href="/Admin_Caps/index.php" style="color: gray;">Home</a></li>
                                        <li><i class='bx bx-chevron-right'>></i></li>
                                        <li><a class="active" href="/Admin_Caps/subjects/subjects.php">Events</a></li>
                                    </ul>
                                </div>
                                <br><br>

                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEventModal">Create Event</button>
                                <br><br>

                                <!-- Event Table -->
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Author</th>
                                            <th>Picture</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($events)): ?>
                                            <?php foreach ($events as $event): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($event['title']) ?></td>
                                                    <td><?= htmlspecialchars($event['description']) ?></td>
                                                    <td><?= htmlspecialchars($event['start']) ?></td>
                                                    <td><?= htmlspecialchars($event['end']) ?></td>
                                                    <td><?= htmlspecialchars($event['author']) ?></td>
                                                    <td><a href="uploads/<?= htmlspecialchars($event['picture']) ?>" data-lightbox="event-photos">
                                                            <img src="uploads/<?= htmlspecialchars($event['picture']) ?>" width="100">
                                                        </a></td>
                                                    <td>
                                                        <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#updateEventModal'
                                                            data-id='<?= $event['id'] ?>' data-title='<?= htmlspecialchars($event['title']) ?>'
                                                            data-description='<?= htmlspecialchars($event['description']) ?>'
                                                            data-author='<?= htmlspecialchars($event['author']) ?>'
                                                            data-start='<?= htmlspecialchars($event['start']) ?>'
                                                            data-end='<?= htmlspecialchars($event['end']) ?>'
                                                            data-picture='<?= htmlspecialchars($event['picture']) ?>'>Edit</button>
                                                        <button class='btn btn-danger' onclick='confirmDelete(<?= $event['id'] ?>)'>Delete</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7">No events found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!-- Create Event Modal -->
    <div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="post_model.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEventModalLabel">Create Event</h5>
                        <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter event title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter event description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" name="author" id="author" placeholder="Enter event author" required>
                        </div>
                        <div class="form-group">
                            <label for="start">Start Date:</label>
                            <input type="datetime-local" class="form-control" name="start" id="start" required>
                        </div>
                        <div class="form-group">
                            <label for="end">End Date:</label>
                            <input type="datetime-local" class="form-control" name="end" id="end" required>
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture:</label>
                            <input type="file" class="form-control-file" name="picture" id="picture" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="create_event" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Update Event Modal -->
    <div class="modal fade" id="updateEventModal" tabindex="-1" aria-labelledby="updateEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="post_model.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateEventModalLabel">Update Event</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update_title">Title:</label>
                            <input type="text" class="form-control" name="update_title" id="update_title" required>
                        </div>
                        <div class="form-group">
                            <label for="update_description">Description:</label>
                            <textarea class="form-control" name="update_description" id="update_description" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="update_author">Author:</label>
                            <input type="text" class="form-control" name="update_author" id="update_author" required>
                        </div>
                        <div class="form-group">
                            <label for="update_start">Start Date:</label>
                            <input type="datetime-local" class="form-control" name="update_start" id="update_start">
                        </div>
                        <div class="form-group">
                            <label for="update_end">End Date:</label>
                            <input type="datetime-local" class="form-control" name="update_end" id="update_end">
                        </div>
                        <div class="form-group">
                            <label for="update_picture">Picture:</label>
                            <input type="file" class="form-control-file" name="update_picture" id="update_picture" accept="image/*">
                        </div>
                        <input type="hidden" name="event_id" id="event_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_event" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script>
        $('#updateEventModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find('#event_id').val(button.data('id')); // Corrected selector
            modal.find('#update_title').val(button.data('title'));
            modal.find('#update_description').val(button.data('description'));
            modal.find('#update_author').val(button.data('author'));
            modal.find('#update_start').val(new Date(button.data('start')).toISOString().slice(0, 16));
            modal.find('#update_end').val(new Date(button.data('end')).toISOString().slice(0, 16));
        });

        // Confirm Deletion
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this event?')) {
                window.location.href = 'delete_event.php?id=' + id;
            }
        }
    </script>
</body>

</html>


