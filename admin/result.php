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
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>$row[test_id]</td>";
            echo "<td>$row[patient_id]</td>";
            echo "<td>$row[hospital_id]</td>";
            echo "<td>$row[test_date]</td>";
            echo "</tr>";
        }
        ?>
       <!-- PHP -->
    </table>
</body>

</html>