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
    <h1>Hospital Details</h1>
    <table>
        <tr>
            <th>Hospital ID</th>
            <th>Hospital Name</th>
            <th>Location</th>
        </tr>
        <!-- PHP -->
        <?php
        $query = "SELECT * FROM hospital";
        $result = mysqli_query($con, $query);
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>{$row['hospital_id']}</td>";
            echo "<td>{$row['hospital_name']}</td>";
            echo "<td>{$row['location']}</td>";
            echo "</tr>";
        }
        ?>
        <!-- PHP -->
    </table>
</body>

</html>