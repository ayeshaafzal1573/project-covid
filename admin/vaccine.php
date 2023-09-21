<?php
//Database Connection
include("../connection.php");
// Session Start
session_start();
//if user log out
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
    <title>Patient Record</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" href="../images/corona_icon.png">
    <link rel="stylesheet" href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- SIDEBAR STARTS -->
    <div id="sidebar">
        <header>
            <a href="#"><img src="../images/corona_icon.png" alt="" style="width:70px ; padding: 20px;"></a>
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
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../images/admin.jpg" alt="Admin Profile" class="adminpic">
                        <?php echo $_SESSION['admin_id']; ?> <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="zmdi zmdi-notifications text-danger"></i> Notifications</a></li>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAV END -->
    <!-- TABLE STARTS -->
    <div class="container-fluid" id="all-products">
        <h1 class="text-center">Vaccine Availability</h1>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vaccine ID</th>
                        <th>Hospital Name</th>
                        <th>Vaccine Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP -->
                    <?php
                    $query = "SELECT v.vac_id, v.patient_id, v.hospital_id, v.vac_status, h.hospital_name
          FROM vaccination v
          LEFT JOIN hospital h ON v.hospital_id = h.hospital_id";

                    $result = mysqli_query($con, $query);

                    if (!$result) {
                        die("Error executing the query: " . mysqli_error($con));
                    }
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?= $row['vac_id'] ?>
                            </td>

                            <td>
                                <?= $row['hospital_name'] ?>
                            </td>
                            <td>
                                <?= $row['vac_status'] ?>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                    <!-- PHP END -->
                </tbody>
            </table>
        </div>
    </div>
    <!-- TABLE END -->

    <!-- LINKS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>