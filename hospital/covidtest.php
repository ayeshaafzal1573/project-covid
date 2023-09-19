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
    <title>Patient Test</title>
</head>

<body>
<?php
echo "<table>";
echo "<tr>";
echo "<th>Patient Name</th>";
echo "<th>Hospital Name</th>";
echo "<th>Appointment Date</th>";
echo "<th>Test Name</th>";
echo "<th>Test Result</th>";
echo "</tr>";

$query = "SELECT * FROM appointment";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error executing the query: " . mysqli_error($con));
}
?>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <?php
    $patient_id = $row['patient_id'];
    $hospital_id = $row['hospital_id'];

    $patient_query = "SELECT patient_name FROM patient WHERE patient_id = $patient_id";
    $patient_result = mysqli_query($con, $patient_query);

    $hospital_query = "SELECT hospital_name FROM hospital WHERE hospital_id = $hospital_id";
    $hospital_result = mysqli_query($con, $hospital_query);

    if ($patient_result && $hospital_result):
        $patient_data = mysqli_fetch_assoc($patient_result);
        $hospital_data = mysqli_fetch_assoc($hospital_result);

        $patient_name = $patient_data['patient_name'];
        $hospital_name = $hospital_data['hospital_name'];
        ?>
        <tr id="row_<?= $row['app_id'] ?>">
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
                <?= $row['test_name'] ?>
            </td>
            <td>
                <button class="positive-button" data-appid="<?= $row['app_id'] ?>">Positive</button>
                <button class="negative-button" data-appid="<?= $row['app_id'] ?>">Negative</button>
            </td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="5">Error fetching data.</td>
        </tr>
    <?php endif; ?>
<?php endwhile; ?>


</table>
<!-- AJAX  -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".positive-button, .negative-button").forEach(function (button) {
            button.addEventListener("click", function () {
                var app_id = this.getAttribute("data-appid");
                var isPositive = this.classList.contains("positive-button");

                // Determine the URL based on the button clicked
                var url = isPositive ? "test_active.php" : "test_deactive.php";
                var xhr = new XMLHttpRequest();
                xhr.open("GET", url + "?app_id=" + app_id, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Remove the corresponding row from the table
                        var row = document.getElementById("row_" + app_id);
                        if (row) {
                            row.remove();
                        } else {
                            console.error("Row not found.");
                        }
                    }
                };
                xhr.send();
            });
        });
    });
</script>

    <!-- PHP -->

</body>

</html>