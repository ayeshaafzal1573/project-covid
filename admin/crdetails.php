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
    <title>COVID Results</title>
</head>

<body>
    <h1>Covid Results</h1>
    <table>
        <tr>
            <th>Patient</th>
            <th>Hospital</th>
            <th>Date</th>
            <th>Results</th>
            <th>Report</th>
        </tr>
        <!-- PHP -->
        <?php
        $query = "SELECT * FROM appointment";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $patient_id = $row['patient_id'];
            $hospital_id = $row['hospital_id'];

            $patient_query = "SELECT patient_name FROM patient WHERE patient_id = $patient_id";
            $patient_result = mysqli_query($con, $patient_query);

            $hospital_query = "SELECT hospital_name FROM hospital WHERE hospital_id = $hospital_id";
            $hospital_result = mysqli_query($con, $hospital_query);

            if ($patient_result && $hospital_result) {
                $patient_data = mysqli_fetch_assoc($patient_result);
                $hospital_data = mysqli_fetch_assoc($hospital_result);

                $patient_name = $patient_data['patient_name'];
                $hospital_name = $hospital_data['hospital_name'];
                ?>
                <tr>
                    <td>
                        <?= $patient_name ?>
                    </td>
                    <td>
                        <?= $hospital_name ?>
                    </td>
                    <td>
                        <?= $row['app_date'] ?>
                    </td>
                    <td>
                        <?= $row['status'] == 1 ? 'Positive' : 'Negative' ?>
                    </td>
                    <td><!-- Add the report link or content here --></td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td colspan="5">Error fetching data.</td>
                </tr>
            <?php }
        }
        ?>
        <!-- PHP -->
    </table>
</body>

</html>