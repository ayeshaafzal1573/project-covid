<?php
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Approval</title>
</head>

<body>
    <table>


        <thead>
            <tr>
                <th>NAME:</th>
                <th>Location:</th>
                <th>Action:</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $fetch_hospital = mysqli_query($con, "SELECT * FROM hospital");

            if ($fetch_hospital) {
                while ($hospital = mysqli_fetch_assoc($fetch_hospital)) {
                    echo "<tr>";
                    echo "<td>{$hospital['hospital_name']}</td>";
                    echo "<td>{$hospital['location']}</td>";

                    echo "<td> 
            <a href='hospital_active.php?id={$hospital['hospital_id']}'>
                <button>Approve</button>
            </a>
            <a href='hospital_deactive.php?id={$hospital['hospital_id']}'>
                <button>Reject</button>
            </a>
        </td>";
                    echo "</tr>";
                }
            } else {
                echo "Error: " . mysqli_error($con);
            }
            ?>

        </tbody>
    </table>
</body>

</html>