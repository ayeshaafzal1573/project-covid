<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>My Appointment</h1>
    <?php
    if (isset($_SESSION['patient_id'])) {
        $patient_id = $_SESSION['patient_id'];

        $query = "SELECT appointment.app_date,appointment.app_time,patient.patient_name,hospital.hospital_name
        FROM appointment JOIN patient ON appointment.patient_id = patient.patient_id JOIN hospital ON appointment.hospital_id = hospital.hospital_id
        WHERE appointment.patient_id = $patient_id";
        $result = mysqli_query($con, $query);
        if (!$result) {
            die("Error executing the query: " . mysqli_error($con));
        }
        ?>

        <table>
            <tr>
                <th>Patient Name</th>
                <th>Hospital Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <?= $row['patient_name'] ?>
                    </td>
                    <td>
                        <?= $row['hospital_name'] ?>
                    </td>
                    <td>
                        <?= $row['app_date'] ?>
                    </td>
                    <td>
                        <?= $row['app_time'] ?>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
        <?php
    } else {
        echo "Patient not logged in.";
    }
    ?>

    </table>
</body>

</html>