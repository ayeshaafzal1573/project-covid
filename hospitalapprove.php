<?php
include('../connection.php');
?>
<?php
$query = "SELECT * FROM hospital";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['hospital_name'] . "</td>";
    echo "<td>" . $row['location'] . "</td>";
    echo "<td><a class='btn btn-success' id='link' href='hosp_approve.php?h_id=" . $row['hospital_id'] . "' type='submit' name='approve'>Approve</a></td>";
    echo "<td><a class='btn btn-danger' id='link' href='hosp_reject.php?h_id=" . $row['hospital_id'] . "' type='submit' name='reject'>Reject</a></td>";
    echo "</tr>";
}
?>
