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
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
        </tr>
        <!-- PHP -->
        <?php
        $query = "SELECT * FROM patient";
        $result = mysqli_query($con, $query);
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>$row[patient_id]</td>";
            echo "<td>$row[patient_name]</td>";
            echo "<td>$row[address]</td>";
            echo "<td>$row[email]</td>";
            echo "</tr>";
        }
        ?>
        <!-- PHP -->
    </table>
</body>

</html>