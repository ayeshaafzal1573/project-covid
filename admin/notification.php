<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
</head>

<body>
    <h1>Notifications</h1>
    <ul>
        <?php
        // Query the database for unread notifications
        $query = "SELECT * FROM notifications WHERE hospital_id = {$_SESSION['hospital_id']} AND status = 'unread'";
        $result = mysqli_query($con, $query);

        if ($result) {
            while ($notification = mysqli_fetch_assoc($result)) {
                echo "<li>{$notification['message']}</li>";

                // Update the notification status to "read" after displaying it
                $notification_id = $notification['notification_id'];
                mysqli_query($con, "UPDATE notifications SET status = 'read' WHERE notification_id = $notification_id");
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
        ?>
    </ul>
</body>

</html>