<?php
// Database Connection
include("../connection.php");
// Session Start
session_start();
//if user logout
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approval</title>
    <link rel="stylesheet" href="assets/style.css">
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
            <a href="#"><img src="../images/covidlogo.png" alt="" style="width:120px ; height:120px;padding: 20px;"></a>
        </header>
        <ul class="nav">
            <li>
                <a href="admin.php">
                    <i class="fas fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="patientrecord.php">
                    <i class="fas fa-users"></i>Patients
                </a>
            </li>
            <li>
                <a href="hospitaldetails.php">
                    <i class="fas fa-hospital"></i>Hospitals
                </a>
            </li>
            <li>
                <a href="crdetails.php">
                    <i class="fas fa-chart-bar"></i>Reports
                </a>
            </li>
            <li>
                <a href="testdetails.php">
                    <i class="fas fa-file-medical"></i>Patient Test Details
                </a>
            </li>
            <li>
                <a href="vaccine.php">
                    <i class="fas fa-syringe"></i>Vaccine Availability
                </a>
            </li>


        </ul>
    </div>
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
                        <img src="../images/adminuser.png" alt="Admin Profile" class="adminpic">
                        <?php echo $_SESSION['username']; ?> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="notification.php"><i class="zmdi zmdi-notifications text-danger"></i>
                                Notifications</a></li>
                        <li><a href="../login.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAV ENDS -->
    <!-- HOSPITAL APPROVAL -->
    <?php
    // Handle hospital approval/rejection
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hospitalId = $_POST['hospital_id'];
        $action = $_POST['action'];
        // Update the approval status in the database
        $query = "UPDATE hospital SET approval_status = '$action' WHERE hospital_id = $hospitalId";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>alert('Hospital $action successfully');</script>";
        } else {
            echo "<script>alert('Error updating hospital status: " . mysqli_error($con) . "');</script>";
        }
    }
    $query = "SELECT * FROM hospital WHERE approval_status = 'Pending'";
    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Error executing the query: " . mysqli_error($con));
    }
    ?>
    <div class="container-fluid" id="all-products">
        <h1 class="text-center">Hospital Approval</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP -->
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?= $row['hospital_name'] ?>
                            </td>
                            <td>
                                <?= $row['location'] ?>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="hospital_id" value="<?= $row['hospital_id'] ?>">
                                    <button type="submit" name="action" value="Approved"
                                        class="btn btn-success">Approve</button>
                                    <button type="submit" name="action" value="Rejected"
                                        class="btn btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                    <!-- PHP END -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- PATIENT APPROVAL -->
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['action'])) {
        $appointmentId = $_GET['id'];
        $action = $_GET['action'];

        if ($action === 'approve') {
            $updateQuery = "UPDATE appointment SET approval_status = 'Approved' WHERE app_id = $appointmentId";
            $updateResult = mysqli_query($con, $updateQuery);

            if (!$updateResult) {
                die("Error updating appointment status: " . mysqli_error($con));
            }
        } elseif ($action === 'reject') {
            $updateQuery = "UPDATE appointment SET approval_status = 'Rejected' WHERE app_id = $appointmentId";
            $updateResult = mysqli_query($con, $updateQuery);

            if (!$updateResult) {
                die("Error updating appointment status: " . mysqli_error($con));
            }
        }
    }

    $query = "SELECT a.*, p.patient_name FROM appointment a JOIN patient p ON a.patient_id = p.patient_id WHERE a.approval_status = 'Pending'";

    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error executing the query: " . mysqli_error($con));
    }
    ?>

    <div class="container-fluid" id="all-products">
        <h1 class="text-center">Patient Approval</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Appointment Date</th>
                        <th>Test Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP -->
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?= $row['patient_name'] ?>
                            </td>
                            <td>
                                <?= $row['app_date'] ?>
                            </td>
                            <td>
                                <?= $row['test_name'] ?>
                            </td>
                            <td>
                                <a href="?id=<?= $row['app_id'] ?>&action=approve" class="btn btn-success">Approve</a>
                                <a href="?id=<?= $row['app_id'] ?>&action=reject" class="btn btn-danger">Reject</a>
                            </td>

                        </tr>
                    <?php endwhile; ?>

                    <!-- PHP END -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>