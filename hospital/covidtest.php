<?php
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Test</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Patient Name:</th>
                <th>Hospital Name:</th>
                <th>Date:</th>
                <th>Time:</th>
                <th>Result:</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT a.app_date, a.app_time, ct.result, p.patient_name, h.hospital_name
                      FROM appointment AS a
                      INNER JOIN covid_test AS ct ON a.patient_id = ct.patient_id AND a.hospital_id = ct.hospital_id AND a.app_date = ct.test_date
                      INNER JOIN patient AS p ON a.patient_id = p.patient_id
                      INNER JOIN hospital AS h ON a.hospital_id = h.hospital_id
                      WHERE a.patient_id = 14";

            $result = mysqli_query($con, $query);

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>{$row['patient_name']}</td>";
                echo "<td>{$row['hospital_name']}</td>";
                echo "<td>{$row['app_date']}</td>";
                echo "<td>{$row['app_time']}</td>";
                echo "<td>{$row['result']}</td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
</body>

</html>