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
            <!-- PHP -->
           <?php
           $query = "SELECT a.app_date, a.app_time, ct.result, p.patient_name, h.hospital_name, ct.test_date
          FROM appointment AS a
          LEFT JOIN covid_test AS ct ON a.patient_id = ct.patient_id AND a.hospital_id = ct.hospital_id AND a.app_date = ct.test_date
          LEFT JOIN patient AS p ON a.patient_id = p.patient_id
          INNER JOIN hospital AS h ON a.hospital_id = h.hospital_id";

           $result = mysqli_query($con, $query);

           if ($result) {
               echo "<form action='update_result.php' method='POST'>"; // Start a form to submit the edits
               echo "<table>";
               echo "<tr>";
               echo "<th>Patient Name</th>";
               echo "<th>Hospital Name</th>";
               echo "<th>Appointment Date</th>";
               echo "<th>Appointment Time</th>";
               echo "<th>Test Result</th>";
               echo "<th>Action</th>"; // Add a column for the edit dropdown
               echo "</tr>";

               while ($row = mysqli_fetch_assoc($result)) {
                   echo "<tr>";
                   echo "<td>{$row['patient_name']}</td>";
                   echo "<td>{$row['hospital_name']}</td>";
                   echo "<td>{$row['app_date']}</td>";
                   echo "<td>{$row['app_time']}</td>";
                   echo "<td>";
                   echo "<select name='result[]'>";
                   echo "<option value='Positive' " . ($row['result'] == 'Positive' ? 'selected' : '') . ">Positive</option>";
                   echo "<option value='Negative' " . ($row['result'] == 'Negative' ? 'selected' : '') . ">Negative</option>";
                   echo "</select>";
                   echo "</td>";
                   // Include hidden inputs for patient_id, hospital_id, and test_date
                   echo "<td>";
                   echo "<input type='hidden' name='patient_id[]' value='{$row['patient_id']}'>";
                   echo "<input type='hidden' name='hospital_id[]' value='{$row['hospital_id']}'>";
                   echo "<input type='hidden' name='test_date[]' value='{$row['test_date']}'>";
                   echo "</td>";
                   echo "</tr>";
               }

               echo "</table>";
               echo "<input type='submit' value='Update Results'>"; // Add a submit button to update results
               echo "</form>"; // Close the form
           } else {
               echo "Error executing the query: " . mysqli_error($con);
           }

           mysqli_close($con);
           ?>

            <!-- PHP -->

</body>

</html>