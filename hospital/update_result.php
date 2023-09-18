<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_ids = $_POST["patient_id"];
    $hospital_ids = $_POST["hospital_id"];
    $test_dates = $_POST["test_date"];
    $new_results = $_POST["result"];

    // Loop through the submitted data and update the test results for each record
    for ($i = 0; $i < count($patient_ids); $i++) {
        $patient_id = $patient_ids[$i];
        $hospital_id = $hospital_ids[$i];
        $test_date = $test_dates[$i];
        $new_result = $new_results[$i];

        // Update the test result in the database
        $query = "UPDATE covid_test 
                  SET result = '$new_result'
                  WHERE patient_id = '$patient_id' 
                  AND hospital_id = '$hospital_id' 
                  AND test_date = '$test_date'";

        if (mysqli_query($con, $query)) {
            echo "Test result updated successfully for Patient ID: $patient_id, Hospital ID: $hospital_id, Test Date: $test_date<br>";
        } else {
            echo "Error updating test result: " . mysqli_error($con) . "<br>";
        }
    }

    mysqli_close($con);
} else {
    echo "Invalid request. Please use the form to update test results.";
}
?>