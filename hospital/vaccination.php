<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Vaccination Table</title>
</head>

<body>
    <h2>Vaccination Table</h2>
    <table>
        <tr>
            <th>Vaccination ID</th>
            <th>Patient ID</th>
            <th>Hospital ID</th>
            <th>Vaccination Status</th>
        </tr>
        <!-- PHP -->
        <?php
        $query = "SELECT v.vac_id,v.vac_status,p.patient_name,h.hospital_name FROM vaccination LEFT JOIN
        patient p ON v.patient_id = p.patient_id LEFT JOIN hospital h ON v.hospital_id = h.hospital_id;";
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['vac_id'] . "</td>";
            echo "<td>" . $row['patient_id'] . "</td>";
            echo "<td>" . $row['hospital_id'] . "</td>";
            echo "<td>" . $row['vac_status'] . "</td>";
            echo "</tr>";
        }
        ?>
        <!-- PHP -->
    </table>
</body>

</html>