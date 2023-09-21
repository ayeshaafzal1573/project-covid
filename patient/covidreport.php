<?php
// Database Connection
include("../connection.php");

// Session Start
session_start();
if (isset($_SESSION['patient_id'])) {
    $patient_id = $_SESSION['patient_id'];

    // Fetch patient's reports with hospital name from the 'appointment' table
    $query = "SELECT appointment.app_date, appointment.app_time, appointment.test_name, appointment.status, hospital.hospital_name
              FROM appointment
              JOIN hospital ON appointment.hospital_id = hospital.hospital_id
              WHERE appointment.patient_id = $patient_id";

    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error executing the query: " . mysqli_error($con));
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Patient Reports</title>
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">My Reports</h1>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Test Name</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?= $row['hospital_name'] ?>
                            </td>
                            <td>
                                <?= $row['app_date'] ?>
                            </td>
                            <td>
                                <?= $row['app_time'] ?>
                            </td>
                            <td>
                                <?= $row['test_name'] ?>
                            </td>
                            <td>
                                <?= $row['status'] == 1 ? 'Positive' : 'Negative' ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Include Bootstrap JS (optional) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>

    <?php
} else {
    echo "Patient not logged in.";
}
?>