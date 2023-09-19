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
    <title>Book Appointment</title>
</head>

<body>
    <form method="POST">
  <label for="patient_name">Patient ID:</label>
<input type="text" id="patient_name" name="patient_name"><br><br>
<select name="test_name">
            <option hidden>Select Covid Test</option>
            <option>PCR</option>
            <option>Naats</option>
        </select><br><br>
        <select name="hospital_selection">
            <option hidden>Hospital Name</option>
            <?php
            $query = "SELECT * FROM hospital";
            $result = mysqli_query($con, $query);

            foreach ($result as $row) {
                echo "<option value='{$row['hospital_id']}'>{$row['hospital_name']}</option>";
            }
            ?>
        </select><br><br>
        <label for="date">Select Appointment Date:</label>
        <input type="date" name="app_date"><br><br>
        <label for="app_time">Select Appointment Time:</label>
        <input type="time" name="app_time" required><br><br>
        <input type="submit" value="Book An Appointment">
    </form>
    <!-- PHP -->
    <?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $testname = $_POST["test_name"];
        $patient_name = $_POST["patient_name"];
        $hospital_id = $_POST["hospital_selection"];
        $app_date = $_POST["app_date"];
        $app_time = $_POST["app_time"];
        // Validate and sanitize data 
        if (empty($patient_name) || empty($hospital_id) || empty($testname) || empty($app_date) || empty($app_time)) {
            echo "Please fill in all fields.";
        } else {
            $query =
                "INSERT INTO appointment (patient_id, hospital_id,test_name,app_date, app_time)VALUES((SELECT patient_id FROM patient WHERE patient_name = '$patient_name'),$hospital_id,'$testname','$app_date','$app_time')";
            //Connection Check
            if (mysqli_query($con, $query)) {
                echo "Appointment booked successfully.";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    }
    ?>

    <!-- PHP -->
</body>

</html>