<?php
// Database Connection
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST["patientName"];
    $selectedVaccine = $_POST["selectedVaccine"];

    // Check if the patient exists in the database
    $checkPatientQuery = "SELECT patient_id FROM patient WHERE patient_name = ?";
    $stmt = mysqli_prepare($con, $checkPatientQuery);
    mysqli_stmt_bind_param($stmt, "s", $patientName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $patientId);

    if (mysqli_stmt_fetch($stmt)) {
        // Patient exists, update the report table
        $updateQuery = "INSERT INTO report (patient_id, vac_suggest) VALUES (?, ?)
ON DUPLICATE KEY UPDATE vac_suggest = ?
";
        $stmt2 = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt2, "iss", $patientId, $selectedVaccine, $selectedVaccine);

        if (mysqli_stmt_execute($stmt2)) {
            echo "Vaccine suggestion saved successfully.";
        } else {
            echo "Error saving vaccine suggestion: " . mysqli_error($con);
        }
    } else {
        echo "Patient not found.";
    }

    mysqli_close($con);
}
?>