<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
//if user loggout
if (!isset($_SESSION['hospital_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Status</title>
    <link rel="stylesheet" href="../admin/assets/style.css">
    <link rel="icon" href="../images/covidlogo.png">
    <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- SIDEBAR -->
    <div id="sidebar">
        <header>
            <a href="#"><img src="../images/covidlogo.png" alt="" style="width:120px ; height:120;padding: 20px;"></a>
        </header>
        <ul class="nav">
            <li>
                <a href="patientlist.php">
                    <i class="zmdi zmdi-account"></i>Patients
                </a>
            </li>
            <li>
                <a href="patientappointment.php">
                    <i class="zmdi zmdi-calendar"></i>Patient Appointment
                </a>
            </li>
            <li>
                <a href="addvaccine.php">
                    <i class="zmdi zmdi-plus"></i>Add Vaccination
                </a>
            </li>
            <li>
                <a href="vacstatus.php">
                    <i class="zmdi zmdi-hospital"></i>Vaccination
                </a>
            </li>
            <li>
                <a href="patientvacstatus.php">
                    <i class="fas fa-syringe"></i> Patient Vaccination
                </a>
            </li>
        </ul>

    </div>
    </div>
    </div>
    <!-- SIDEBAR END -->
    <!-- NAV STARTS -->
    <nav class="navbar">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../images/hospitaluser.png" alt="Admin Profile" class="adminpic">
                        <?php echo $_SESSION['hospital_name']; ?> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAV ENDS -->
    <!-- TABLE STARTS -->
    <div class="container-fluid" id="all-products">
        <h1 class="text-center">Patient Vaccination Status</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Test Result</th>
                        <th>Vaccination Suggestion</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP -->
                    <?php

                    $hospital_id = $_SESSION['hospital_id'];
                    $query = "SELECT p.patient_name, a.status, r.vac_suggest FROM patient p
                    INNER JOIN appointment a ON p.patient_id = a.patient_id
                    LEFT JOIN report r ON p.patient_id = r.patient_id
                    WHERE a.hospital_id='$hospital_id'";

                    $result = mysqli_query($con, $query);

                    if (!$result) {
                        die("Error executing the query: " . mysqli_error($con));
                    }

                    while ($row = mysqli_fetch_assoc($result)):
                        $patient_name = $row['patient_name'];
                        $status = ($row['status'] == 0) ? "Negative" : "Positive";
                        $vac_suggest = $row['vac_suggest'];

                        // Fetch available vaccines from the vaccination table
                        $vaccine_query = "SELECT vac_name FROM vaccination WHERE vac_status = 'Available'";
                        $vaccine_result = mysqli_query($con, $vaccine_query);

                        ?>
                        <tr id="row_<?= $patient_name ?>">
                            <td>
                                <?= $patient_name ?>
                            </td>
                            <td>
                                <?= $status ?>
                            </td>
                            <td>
                                <select name="vac_suggest[<?= $patient_name ?>]">
                                    <option value="hidden">Select Vaccine</option>
                                    <?php
                                    while ($vaccine_row = mysqli_fetch_assoc($vaccine_result)) {
                                        $selected = ($vaccine_row['vac_name'] == $vac_suggest) ? 'selected' : '';
                                        echo "<option value='" . $vaccine_row['vac_name'] . "' $selected>" . $vaccine_row['vac_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary"
                                    onclick="saveVaccineSuggestion('<?= $patient_name ?>')">Save</button>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                    <!-- PHP -->

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>