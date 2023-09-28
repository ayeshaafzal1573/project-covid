<?php
// Database Connection
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST["patient_name"];
    $selectedVaccine = $_POST["vac_name"];

    // Check if the patient exists in the database
    $checkPatientQuery = "SELECT patient_id FROM patient WHERE patient_name = ?";
    $stmt = mysqli_prepare($con, $checkPatientQuery);
    mysqli_stmt_bind_param($stmt, "s", $patientName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $patientId);

    if (mysqli_stmt_fetch($stmt)) {
        // Patient exists, insert the vaccine suggestion into the report table
        $insertQuery = "INSERT INTO report (patient_id, vac_suggest) VALUES (?, ?)";
        $stmt2 = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt2, "is", $patientId, $selectedVaccine);

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