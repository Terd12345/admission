<?php
session_start();
include 'db_conn.php';

global $pdo;
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle event creation
        if (isset($_POST['create_event'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $start = $_POST['start'];
            $end = $_POST['end'];
            $author = $_POST['author'];
            $picture = $_FILES['picture']['name'];
            $target = "uploads/" . basename($picture);

            if (empty($title) || empty($description) || empty($start) || empty($end) || empty($author)) {
                $_SESSION['error'] = "All fields are required.";
                header('Location: events.php');
                exit();
            }

            $sql = "INSERT INTO events (title, description, start, end, author, picture) 
                    VALUES (:title, :description, :start, :end, :author, :picture)";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute(['title' => $title, 'description' => $description, 'start' => $start, 'end' => $end, 'author' => $author, 'picture' => $picture])) {
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
                    header('Location: events.php');
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to upload picture.";
                    header('Location: events.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = "Failed to create event.";
                header('Location: events.php');
                exit();
            }
        }

        // Handle event update
        if (isset($_POST['update_event'])) {
            $id = $_POST['event_id'];
            $title = $_POST['update_title'];
            $description = $_POST['update_description'];
            $start = $_POST['update_start'];
            $end = $_POST['update_end'];
            $author = $_POST['update_author'];
            $picture = $_FILES['update_picture']['name'];
            $target = "uploads/" . basename($picture);

            if (empty($title) || empty($description) || empty($start) || empty($end) || empty($author)) {
                $_SESSION['error'] = "All fields are required.";
                header('Location: events.php');
                exit();
            }

            // Check if a new picture is uploaded
            $sql = $picture
                ? "UPDATE events SET title = :title, description = :description, start = :start, end = :end, author = :author, picture = :picture WHERE id = :id"
                : "UPDATE events SET title = :title, description = :description, start = :start, end = :end, author = :author WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $params = [
                'title' => $title,
                'description' => $description,
                'start' => $start,
                'end' => $end,
                'author' => $author,
                'id' => $id
            ];

            if ($picture) {
                $params['picture'] = $picture;
            }

            if ($stmt->execute($params)) {
                if ($picture && move_uploaded_file($_FILES['update_picture']['tmp_name'], $target)) {
                    $_SESSION['success'] = "Event updated successfully!";
                } elseif (!$picture) {
                    $_SESSION['success'] = "Event updated successfully without changing picture.";
                } else {
                    $_SESSION['error'] = "Failed to upload new picture.";
                }
                header('Location: events.php');
                exit();
            } else {
                $_SESSION['error'] = "Failed to update event.";
                header('Location: events.php');
                exit();
            }
        }
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('Location: events.php');
    exit();
}


function eventDisplay($pdo)
{
?>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            width: 18rem;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .card-text {
            font-size: 0.95rem;
            color: #333;
        }

        .card button {
            margin-top: 10px;
        }
    </style>

    <div class="card-container">
        <?php
        $stmt = $pdo->prepare("SELECT title, description, picture, start, end FROM events ORDER BY start DESC LIMIT 5");
        $stmt->execute();
        $events = $stmt->fetchAll();

        if ($events) {
            foreach ($events as $event) {
                $imagePath = './events/uploads/' . htmlspecialchars($event['picture']);
                $title = htmlspecialchars($event['title']);
                $description = htmlspecialchars($event['description']);
                $start = htmlspecialchars($event['start']);
                $end = htmlspecialchars($event['end']);
                $formattedStartDate = date('F j, Y, g:i A', strtotime($start));
                $formattedEndDate = date('F j, Y, g:i A', strtotime($end));
        ?>
                <div class="card">
                    <img src="<?php echo $imagePath; ?>" alt="Event Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $title; ?></h5>
                        <h6 class="card-subtitle mb-2"><?php echo $formattedStartDate . ' - ' . $formattedEndDate; ?></h6>
                        <p class="card-text"><?php echo substr($description, 0, 150) . '...'; ?></p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="popover" data-bs-trigger="focus" title="<?php echo $title; ?>" data-bs-content="<?php echo $description . " (Start: " . $formattedStartDate . ", End: " . $formattedEndDate . ")."; ?>">
                            View Details
                        </button>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>No events available.</p>";
        }
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        });
    </script>

<?php
}
?>